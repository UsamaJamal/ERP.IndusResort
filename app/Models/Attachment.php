<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

/** One uploaded receipt, belonging to a reservation, expense, cash entry or kitchen order. */
class Attachment extends Model
{
    protected $guarded = [];

    protected $hidden = ['owner_type', 'owner_id', 'user_id', 'created_at', 'updated_at'];

    protected $appends = ['label'];

    /** What this file is, in the words the pages print. */
    public function getLabelAttribute(): string
    {
        if ($this->owner_type === 'booking') {
            return $this->kind === 'advance' ? 'Advance receipt' : 'Payment receipt';
        }

        return $this->owner_type === 'kitchen' ? 'Payment proof' : 'Receipt';
    }

    /** Most files accepted in one save; six 5 MB files stay under the server's post limit. */
    public const MAX_PER_UPLOAD = 6;

    /** Where each owner's files are kept, and what their names start with. */
    private const FOLDERS = [
        'booking' => ['uploads/booking-payments', 'receipt_'],
        'expense' => ['uploads/expenses', 'expense_'],
        'cash'    => ['uploads/cash-receipts', 'cash_'],
        'kitchen' => ['uploads/kitchen-payments', 'kitchen_proof_'],
    ];

    /**
     * The files uploaded under any of the given field names, checked.
     * A field may hold one file (older forms) or several (name="field[]").
     *
     * @return UploadedFile[]
     */
    public static function uploaded(Request $r, array $fields, bool $required = false, string $label = 'receipt'): array
    {
        $files = [];
        foreach ($fields as $field) {
            foreach (Arr::wrap($r->file($field)) as $file) {
                if ($file instanceof UploadedFile) {
                    $files[] = $file;
                }
            }
        }

        Validator::make(['files' => $files], [
            'files' => ($required ? 'required|' : '').'array|max:'.self::MAX_PER_UPLOAD,
            'files.*' => 'file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
        ], [
            'files.required' => 'Please attach the '.$label.'.',
            'files.max' => 'Attach at most '.self::MAX_PER_UPLOAD.' files at a time.',
            'files.*.mimes' => 'Each '.$label.' must be an image (JPG, PNG, WebP) or a PDF.',
            'files.*.max' => 'Each '.$label.' must be 5 MB or smaller.',
            'files.*.file' => 'One of the files could not be uploaded.',
        ])->validate();

        return $files;
    }

    /** Move the uploaded files into place and record them against their owner. */
    public static function attach(array $files, string $type, int $ownerId, string $kind = 'receipt'): int
    {
        [$folder, $prefix] = self::FOLDERS[$type];
        $directory = public_path($folder);
        if ($files && ! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        foreach ($files as $file) {
            $original = $file->getClientOriginalName();
            // The extension comes from the file's content, not from the name it was uploaded under.
            $name = ($type === 'booking' && $kind === 'advance' ? 'advance_' : $prefix).$ownerId.'_'.time().'_'.uniqid().'.'.($file->extension() ?: 'jpg');
            $file->move($directory, $name);
            self::create([
                'owner_type' => $type, 'owner_id' => $ownerId, 'kind' => $kind,
                'path' => $folder.'/'.$name, 'name' => mb_substr($original, 0, 200),
                'user_id' => auth()->id(),
            ]);
        }

        return count($files);
    }

    /** Remove the ticked files of one owner. Ids that belong to anything else are ignored. */
    public static function detach($ids, string $type, int $ownerId): int
    {
        $ids = array_filter(array_map('intval', Arr::wrap($ids)));
        if (! $ids) {
            return 0;
        }
        $rows = self::where('owner_type', $type)->where('owner_id', $ownerId)->whereIn('id', $ids)->get();
        $rows->each->remove();

        return $rows->count();
    }

    /** Remove every file of an owner that is being deleted. */
    public static function purge(string $type, int $ownerId): void
    {
        self::where('owner_type', $type)->where('owner_id', $ownerId)->get()->each->remove();
    }

    /** Delete the row and its file, but only a file that really lives in an uploads folder of ours. */
    public function remove(): void
    {
        $path = (string) $this->path;
        $inOurFolder = false;
        foreach (self::FOLDERS as [$folder]) {
            $inOurFolder = $inOurFolder || strpos($path, $folder.'/') === 0;
        }
        // A file is only unlinked once no other row points at it.
        $shared = self::where('path', $path)->where('id', '!=', $this->id)->exists();
        if ($inOurFolder && ! $shared && strpos($path, '..') === false && is_file(public_path($path))) {
            @unlink(public_path($path));
        }
        $this->delete();
    }
}
