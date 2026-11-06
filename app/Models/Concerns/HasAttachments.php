<?php

namespace App\Models\Concerns;

use App\Models\Attachment;

/** Gives a model its uploaded receipts. The model names its owner type in ATTACHMENT_TYPE. */
trait HasAttachments
{
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'owner_id')->where('owner_type', static::ATTACHMENT_TYPE)->orderBy('id');
    }
}
