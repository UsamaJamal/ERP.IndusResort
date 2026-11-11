@php
    $img = fn ($name) => public_path('images/invoice/'.$name);
    $d = fn ($v) => \Carbon\Carbon::parse($v)->format('d M Y');
    $rangeLabel = $d($st['from']).' – '.$d($st['to']);
    $m = fn ($n) => ($n < 0 ? '- ' : '').'PKR '.number_format(abs((int) $n));
    $neg = fn ($n) => $n < 0 ? 'neg' : '';
@endphp
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style>
@page{margin:42mm 12mm 18mm 12mm;header:html_reportHeader;footer:html_reportFooter}
body{font-family:lato,sans-serif;color:#1a1f1c;font-size:9.5pt}
table{width:100%;border-collapse:collapse}
.header{width:100%;background:#eef2ee;border-bottom:1px solid #dce6df}
.header td{vertical-align:middle}
.brand{font-size:17pt;font-weight:bold;letter-spacing:1px;color:#2f5a45;line-height:1.1}
.brand-sub{font-size:8pt;letter-spacing:4px;color:#2f5a45;margin-top:1mm}
.tag{font-size:8pt;font-style:italic;color:#5b6a62;margin-top:1.5mm}
.contact{font-size:8pt;line-height:1.6;color:#3d4a43}
.title{font-size:24pt;font-weight:bold;color:#111;margin:0 0 1mm}
.muted{font-size:9pt;color:#68756d}
.meta{background:#f5f8f5;border:1px solid #e1e7e2;border-radius:3mm;padding:3mm 4mm;margin-top:5mm}
.section{font-size:11pt;font-weight:bold;color:#2f5a45;margin:7mm 0 2mm}
.note{font-size:8pt;color:#68756d;margin:1.5mm 0 0}
.items{border:1px solid #e1e7e2;border-radius:2mm}
.items th{background:#e6f4ea;color:#26362c;text-align:left;font-size:8pt;padding:2.5mm 2.5mm;border-bottom:1px solid #d9e6dc}
.items td{padding:2.5mm 2.5mm;border-bottom:1px solid #e9eeea;vertical-align:top}
.items tr:last-child td{border-bottom:0}
.num{text-align:right;white-space:nowrap}
.items th.num{text-align:right}
.strong td{background:#f5f8f5;font-weight:bold;color:#1f3d2e}
.in{color:#2f6b4f}
.out,.neg{color:#b3352f}
.sub{color:#68756d;font-size:8pt}
.empty{text-align:center;padding:8mm 5mm;background:#f5f8f5;border-radius:3mm;color:#68756d;margin-top:2mm}
.footer{border-top:1px solid #dce6df;color:#647269;font-size:8pt;padding-top:2mm}
</style>
</head>
<body>
<htmlpageheader name="reportHeader">
<table class="header" cellpadding="0" cellspacing="0">
<tr>
<td width="16%" style="padding:4mm 3mm 4mm 0"><img src="{{ $img('logo-round.png') }}" style="width:22mm;height:22mm"></td>
<td width="49%" style="padding:4mm 2mm">
<div class="brand">INDUS RESORT</div><div class="brand-sub">RESTAURANT</div><div class="tag">Your Perfect Stay in Murree</div>
</td>
<td width="35%" class="contact" style="padding:4mm 0 4mm 3mm">Governor House Road, Aliot Bazar,<br>Kohala Road, Murree<br>03352015555<br>indusresort7861@gmail.com</td>
</tr></table>
</htmlpageheader>
<htmlpagefooter name="reportFooter"><table class="footer"><tr><td>INDUS RESORT RESTAURANT · CASH REPORT</td><td class="num">Page {PAGENO} of {nbpg}</td></tr></table></htmlpagefooter>
<sethtmlpageheader name="reportHeader" value="on" show-this-page="1" />
<sethtmlpagefooter name="reportFooter" value="on" />

<div class="title">Cash Report</div>
<div class="muted">Money in, money out and balances · Generated {{ now()->format('d M Y, g:i A') }} PKT by {{ $by }}</div>
<div class="meta"><strong>Report period:</strong> {{ $rangeLabel }}</div>

{{-- 1. Balances --}}
<div class="section">Cash summary</div>
<table class="items"><thead><tr><th width="28%"></th><th width="18%" class="num">MANAGER CASH</th><th width="18%" class="num">OWNER CASH</th><th width="18%" class="num">PETTY CASH</th><th width="18%" class="num">TOTAL</th></tr></thead><tbody>
<tr><td>Opening balance<br><span class="sub">before {{ $d($st['from']) }}</span></td><td class="num {{ $neg($st['income']['opening']) }}">{{ $m($st['income']['opening']) }}</td><td class="num {{ $neg($st['owner']['opening']) }}">{{ $m($st['owner']['opening']) }}</td><td class="num {{ $neg($st['petty']['opening']) }}">{{ $m($st['petty']['opening']) }}</td><td class="num {{ $neg($st['total']['opening']) }}">{{ $m($st['total']['opening']) }}</td></tr>
<tr><td>Money in</td><td class="num in">{{ $m($st['income']['in']) }}</td><td class="num in">{{ $m($st['owner']['in']) }}</td><td class="num in">{{ $m($st['petty']['in']) }}</td><td class="num in">{{ $m($st['total']['in']) }}</td></tr>
<tr><td>Money out</td><td class="num out">{{ $m($st['income']['out']) }}</td><td class="num out">{{ $m($st['owner']['out']) }}</td><td class="num out">{{ $m($st['petty']['out']) }}</td><td class="num out">{{ $m($st['total']['out']) }}</td></tr>
<tr class="strong"><td>Closing balance<br><span class="sub">end of {{ $d($st['to']) }}</span></td><td class="num {{ $neg($st['income']['closing']) }}">{{ $m($st['income']['closing']) }}</td><td class="num {{ $neg($st['owner']['closing']) }}">{{ $m($st['owner']['closing']) }}</td><td class="num {{ $neg($st['petty']['closing']) }}">{{ $m($st['petty']['closing']) }}</td><td class="num {{ $neg($st['total']['closing']) }}">{{ $m($st['total']['closing']) }}<br><span class="sub">Cash in hand</span></td></tr>
</tbody></table>
<div class="note">Money moved between wallets (a handover from the manager to the owner, a transfer into petty cash) counts as out of one and into the other, but not in the Total column, because it never left the business.@if($st['handovers'] > 0) The manager handed PKR {{ number_format($st['handovers']) }} to the owner in this period.@endif</div>

{{-- 2. Where money came from --}}
<div class="section">Where the money came from</div>
@if($st['sources']->isEmpty())
<div class="empty">No money came in during this period.</div>
@else
<table class="items"><thead><tr><th width="56%">SOURCE</th><th width="18%" class="num">ENTRIES</th><th width="26%" class="num">AMOUNT</th></tr></thead><tbody>
@foreach($st['sources'] as $name => $row)
<tr><td>{{ $name }}</td><td class="num">{{ $row['count'] }}</td><td class="num in">{{ $m($row['amount']) }}</td></tr>
@endforeach
</tbody></table>
@endif

{{-- 3. Where money went --}}
<div class="section">Where the money went</div>
@if($st['byCategory']->isEmpty() && array_sum($st['cashOut']) === 0)
<div class="empty">No money went out during this period.</div>
@else
<table class="items"><thead><tr><th width="32%">EXPENSE CATEGORY</th><th width="17%" class="num">BY MANAGER</th><th width="17%" class="num">BY OWNER</th><th width="17%" class="num">FROM PETTY</th><th width="17%" class="num">TOTAL</th></tr></thead><tbody>
@foreach($st['byCategory'] as $name => $row)
<tr><td>{{ $name }} <span class="sub">({{ $row['count'] }})</span></td><td class="num">{{ $row['income'] ? $m($row['income']) : '—' }}</td><td class="num">{{ $row['owner'] ? $m($row['owner']) : '—' }}</td><td class="num">{{ $row['petty'] ? $m($row['petty']) : '—' }}</td><td class="num out">{{ $m($row['amount']) }}</td></tr>
@endforeach
<tr class="strong"><td>All expenses</td><td class="num">{{ $m($st['expenseTotal']['income']) }}</td><td class="num">{{ $m($st['expenseTotal']['owner']) }}</td><td class="num">{{ $m($st['expenseTotal']['petty']) }}</td><td class="num">{{ $m($st['expenseTotal']['amount']) }}</td></tr>
@if(array_sum($st['cashOut']) > 0)
<tr><td>Cash out <span class="sub">taken out of the business, not an expense</span></td><td class="num">{{ $st['cashOut']['income'] ? $m($st['cashOut']['income']) : '—' }}</td><td class="num">{{ $st['cashOut']['owner'] ? $m($st['cashOut']['owner']) : '—' }}</td><td class="num">{{ $st['cashOut']['petty'] ? $m($st['cashOut']['petty']) : '—' }}</td><td class="num out">{{ $m(array_sum($st['cashOut'])) }}</td></tr>
@endif
</tbody></table>
@endif

{{-- 4. Profit --}}
<div class="section">Profit for the period</div>
<table class="items"><tbody>
<tr><td width="74%">Income earned <span class="sub">room bookings and kitchen sales</span></td><td class="num in">{{ $m($st['profit']['earned']) }}</td></tr>
<tr><td>Expenses <span class="sub">whoever paid them</span></td><td class="num out">{{ $m($st['profit']['spent']) }}</td></tr>
<tr class="strong"><td>Net profit</td><td class="num {{ $neg($st['profit']['net']) }}">{{ $m($st['profit']['net']) }}</td></tr>
</tbody></table>
<div class="note">Money sent by the owner is not income, so it raises cash but not profit.</div>

{{-- 5. Every entry --}}
@if($detail)
<div class="section">All entries</div>
@if($st['entries']->isEmpty())
<div class="empty">There are no entries in this date range.</div>
@else
<table class="items"><thead><tr><th width="12%">DATE</th><th width="32%">ENTRY</th><th width="17%">TYPE</th><th width="13%" class="num">MANAGER</th><th width="13%" class="num">OWNER</th><th width="13%" class="num">PETTY</th></tr></thead><tbody>
@foreach($st['entries'] as $e)
<tr>
<td>{{ \Carbon\Carbon::parse($e['date'])->format('d M Y') }}</td>
<td>{{ $e['label'] }}@if($e['detail'])<br><span class="sub">{{ $e['detail'] }}</span>@endif</td>
<td>{{ $e['group'] === 'Expenses' ? $e['category'] : $e['group'] }}</td>
@foreach(['income', 'owner', 'petty'] as $wk)
<td class="num {{ $e[$wk] > 0 ? 'in' : ($e[$wk] < 0 ? 'out' : '') }}">{{ $e[$wk] ? ($e[$wk] > 0 ? '+ ' : '- ').number_format(abs($e[$wk])) : '—' }}</td>
@endforeach
</tr>
@endforeach
</tbody></table>
@endif
@endif
</body>
</html>
