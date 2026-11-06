<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Kitchen - Indus Resort Restaurant</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--lime:#e8fb82;--mint:#d2f3e4;--ink:#151515;--muted:#8f8f8f;--bg:#f6f6f5;--line:#f0f0f0;--red:#ff4e52}
*{box-sizing:border-box}
body{margin:0;display:flex;background:var(--bg);font-family:Lato,Arial,sans-serif;color:var(--ink)}
.main{flex:1;min-width:0;padding:26px 30px 16px}
.top{display:flex;justify-content:space-between;align-items:center;margin-bottom:22px}
.top h1{font-size:30px;font-weight:800;margin:0}
.profile{display:flex;align-items:center;gap:13px}
.avatar{width:46px;height:46px;border-radius:50%;background:var(--lime);display:grid;place-items:center;font-weight:700;font-size:15px;overflow:hidden}
.avatar img{width:100%;height:100%;object-fit:cover}
.pinfo b{display:block;font-size:16px;line-height:1.1}.pinfo small{color:#888;font-size:13px}
.tools{display:flex;gap:10px;margin-left:14px}
.tool{width:44px;height:44px;border:1px solid #e8e8e8;background:#fff;border-radius:11px;display:grid;place-items:center;cursor:pointer;position:relative}
.tool svg{width:20px;height:20px;fill:none;stroke:#4a4a4a;stroke-width:1.8}
.tool.bell:after{content:'';position:absolute;top:9px;right:11px;width:8px;height:8px;border-radius:50%;background:var(--red);border:2px solid #fff}
.panel{background:#fff;border-radius:18px;padding:22px 22px 8px}
.filters{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;gap:12px;flex-wrap:wrap}
.fl,.fr{display:flex;gap:12px;align-items:center}
.searchbox{position:relative}
.searchbox>svg{position:absolute;left:15px;top:50%;transform:translateY(-50%);width:18px;height:18px;fill:none;stroke:#b0b0b0;stroke-width:1.8}
.search{height:44px;width:290px;border:0;border-radius:11px;background:#f4f4f4;padding:0 16px 0 42px;font-size:14px;color:#333;font-family:inherit}
.search::placeholder{color:#b0b0b0}
.fsel{height:44px;border:0;border-radius:11px;background:#f4f4f4;padding:0 14px;font-size:14px;color:#333;font-family:inherit;cursor:pointer}
.add{height:44px;border:0;border-radius:11px;background:var(--lime);padding:0 20px;font-size:15px;font-weight:700;color:#2f3a0c;cursor:pointer}
.tbl{width:100%;overflow-x:auto}
.thead,.trow{display:grid;grid-template-columns:1fr 1.3fr 2.2fr 1fr .95fr .95fr 150px;align-items:center;min-width:940px;column-gap:12px}
.thead{background:#eefaf3;border-radius:12px;padding:16px 24px;color:#8a8a8a;font-size:15px;font-weight:600}
.thead span{display:inline-flex;align-items:center;gap:6px}
.thead svg{width:12px;height:12px;fill:none;stroke:#b5b5b5;stroke-width:2}
.trow{padding:14px 24px;border-bottom:1px solid var(--line);font-size:15px}
.trow:last-child{border-bottom:0}
.who{display:flex;align-items:center;gap:14px;min-width:0}
.pic{width:44px;height:44px;border-radius:50%;background:var(--mint);display:grid;place-items:center;font-weight:700;font-size:14px;color:#2f6b4f;flex:0 0 44px;overflow:hidden}
.pic img{width:100%;height:100%;object-fit:cover}
.who b{display:block;font-size:15px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.who small{color:#9a9a9a;font-size:13px}
.uemail{color:#555;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.rl{display:inline-flex;align-items:center;gap:7px;padding:6px 12px;border-radius:20px;font-size:12.5px;font-weight:700;width:max-content}
.rl:before{content:'';width:7px;height:7px;border-radius:50%;background:currentColor}
.rl.admin{background:#e6f4ea;color:#1e4a36}
.rl.manager{background:#dfebfb;color:#1e4f8f}
.rl.staff{background:#fdf1d3;color:#7a5400}
.you{margin-left:8px;font-size:11.5px;color:#8b948f;font-weight:600}
.act{display:flex;gap:8px;align-items:center;justify-content:flex-end}
.ib{width:34px;height:34px;border:1px solid #ededed;background:#fff;border-radius:9px;display:inline-grid;place-items:center;cursor:pointer;color:#555;transition:.15s}
.ib:hover{background:#f6f6f6}
.ib svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.ib.del{color:#b3352f;border-color:#f3d4d4;background:#fff7f7}.ib.del:hover{background:#ffe1e1}
.ib[disabled]{opacity:.35;cursor:not-allowed}
.tbottom{display:flex;justify-content:space-between;align-items:center;padding:20px 4px 16px;color:#8a8a8a;font-size:15px}
/* What each role can open, as compact chips so the three cards stay the same height. */
.roles{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px;margin-top:18px;align-items:stretch}
.rcard{background:#fff;border:1px solid var(--line);border-radius:16px;padding:18px;display:flex;flex-direction:column}
.rcard-h{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:4px}
.rcard-h b{font-size:12.5px;color:#8b948f;font-weight:600;white-space:nowrap}
.rcard p{margin:0 0 14px;color:#8b948f;font-size:12.5px}
.rchips{display:flex;flex-wrap:wrap;gap:7px;margin-top:auto}
.rchip{background:#f4f8f5;border:1px solid #e3ece6;border-radius:8px;padding:5px 10px;font-size:12px;color:#3f4f47;white-space:nowrap}
.rchip.off{background:#fafafa;border-color:#f0f0f0;color:#c2c8c4;text-decoration:line-through}
footer{display:flex;justify-content:space-between;align-items:center;padding:20px 6px 8px;color:#9a9a9a;font-size:14px;flex-wrap:wrap;gap:14px}
.flinks{display:flex;gap:26px}.flinks a{color:#9a9a9a;text-decoration:none}.flinks span:first-child{color:#666}
.fsoc{display:flex;gap:16px;align-items:center}.fsoc a{color:#c2c2c2}.fsoc svg{width:18px;height:18px;fill:currentColor}
@media(max-width:1100px){.roles{grid-template-columns:1fr}}
@media(max-width:700px){.main{padding:18px 14px}.top h1{font-size:24px}.profile .pinfo,.tools{display:none}.filters{flex-direction:column;align-items:stretch}.search{width:100%}footer{flex-direction:column;align-items:flex-start}}
</style>
@include('partials.theme-head')
</head>
<body>
@include('partials.crud')
@include('partials.sidebar')
@include('partials.responsive')
@include('partials.desktop-theme')
@include('partials.mobile-theme')
<style>
/* ---------- Kitchen page ---------- */
.kt-cards{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;margin:0 var(--gutter,28px) 16px}
.kt-card{background:#fff;border:1px solid #e5e9e6;border-radius:14px;padding:16px;display:flex;gap:12px;align-items:flex-start;min-width:0}
.kt-ic{width:36px;height:36px;border-radius:10px;display:grid;place-items:center;flex:0 0 36px;background:#e6f4ea}
.kt-ic svg{width:18px;height:18px;fill:none;stroke:#2f6b4f;stroke-width:1.9;stroke-linecap:round;stroke-linejoin:round}
.kt-ic.amber{background:#fdf1d3}.kt-ic.amber svg{stroke:#9a7100}
.kt-ic.blue{background:#dfebfb}.kt-ic.blue svg{stroke:#1e4f8f}
.kt-ic.red{background:#fde3e5}.kt-ic.red svg{stroke:#b3352f}
.kt-card small{display:block;color:#6b7671;font-size:12.5px;margin-bottom:5px}
.kt-card b{display:block;font-size:21px;letter-spacing:-.3px;color:#123527;line-height:1.15;white-space:nowrap}
.kt-card b.neg{color:#b3352f}
.kt-card i{display:block;font-style:normal;color:#8b948f;font-size:11.5px;margin-top:4px}
.kt-code b{display:block;font-weight:700;font-size:13.5px}
.kt-code small{display:block;color:#9ca3af;font-size:12px;margin-top:2px}
.kt-items{color:#55605a;font-size:13px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block}
.kt-items em{font-style:normal;color:#9ca3af}
.kt-total{font-weight:700;color:#123527}
.kt-total.free{color:#9ca3af;font-weight:500;text-decoration:line-through}
.kt-pill{display:inline-flex;align-items:center;gap:7px;padding:6px 11px;border-radius:20px;font-size:12.5px;font-weight:700;width:max-content;font-style:normal}
.kt-pill:before{content:'';width:7px;height:7px;border-radius:50%;background:currentColor}
.kt-pill.walk_in{background:#e6f4ea;color:#2f6b4f}
.kt-pill.room_guest{background:#dfebfb;color:#1e4f8f}
.kt-pill.complimentary{background:#eef1ef;color:#55605a}
.kt-pill.paid{background:#e6f4ea;color:#2f6b4f}
.kt-pill.unpaid{background:#fde3e5;color:#b3352f}
button.kt-pill{border:0;cursor:pointer;font-family:inherit}
/* Costs card under the table */
.kt-costs{background:#fff;border:1px solid #e5e9e6;border-radius:16px;padding:18px;margin:16px var(--gutter,28px) 0}
.kt-costs-h{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:6px}
.kt-costs-h h2{margin:0;font-size:16px}
.kt-costs-h p{margin:3px 0 0;color:#8b948f;font-size:12.5px}
.kt-cost{display:grid;grid-template-columns:1.6fr 1.2fr .8fr .8fr;gap:12px;padding:11px 2px;border-top:1px solid #f0f2f0;font-size:13.5px;align-items:center}
.kt-cost span:last-child{text-align:right;font-weight:700;color:#123527}
.kt-cost small{color:#8b948f}
.kt-soft{height:36px;border:1px solid #d5e8dc;border-radius:10px;background:#e6f4ea;color:#1e4a36;padding:0 14px;font:700 13px Inter,Lato,sans-serif;cursor:pointer;white-space:nowrap}
/* Order form lines */
.kt-lines{margin-top:6px}
.kt-line{display:grid;grid-template-columns:minmax(0,1fr) 74px 104px 96px 34px;gap:8px;align-items:center;margin-bottom:8px}
.kt-line input{margin:0}
.kt-line .lt{font-size:13.5px;font-weight:700;color:#123527;text-align:right;white-space:nowrap}
.kt-line .rm{width:34px;height:34px;border:1px solid #f3d4d4;background:#fff7f7;color:#b3352f;border-radius:9px;cursor:pointer;display:grid;place-items:center;font-size:16px;line-height:1}
.kt-lines-h{display:grid;grid-template-columns:minmax(0,1fr) 74px 104px 96px 34px;gap:8px;font-size:12px;color:#8b948f;margin:12px 0 6px}
.kt-lines-h span:nth-child(4){text-align:right}
.kt-addline{height:36px;border:1px dashed #b9d3c4;border-radius:9px;background:#f4f8f5;color:#1e4a36;padding:0 14px;font:700 13px Inter,Lato,sans-serif;cursor:pointer}
.kt-sum{display:flex;justify-content:space-between;align-items:center;margin-top:14px;padding:13px 14px;border-radius:11px;background:#f4f8f5;font-size:14px}
.kt-sum b{font-size:19px;color:#123527}
/* Payment proof attachment */
.kt-proof{display:flex;align-items:center;gap:10px;flex-wrap:wrap;font-size:13px;color:#6b7671}
.kt-proof input[type=file]{position:absolute;width:1px;height:1px;opacity:0;overflow:hidden;clip:rect(0,0,0,0);padding:0;border:0}
.modal .kt-proof .kt-proof-btn{display:inline-flex;align-items:center;gap:7px;height:38px;margin:0;padding:0 14px;border:1px dashed #b9d3c4;border-radius:9px;background:#f4f8f5;color:#1e4a36;font-size:13px;font-weight:700;cursor:pointer}
.kt-proof-btn svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.kt-proof a{color:#1e4a36;font-weight:700;text-decoration:underline}
.modal .kt-proof .kt-proof-rm{display:inline-flex;align-items:center;gap:6px;margin:0;color:#b3352f;font-size:13px;cursor:pointer}
.modal .kt-proof .kt-proof-rm input{width:15px;height:15px;padding:0;accent-color:#b3352f}
a.ib{text-decoration:none}
a.att-plain,a.att-pill{text-decoration:none}
a.ib.proof{color:#1e4f8f;border-color:#cfe0f7;background:#f3f8ff}
/* Receipt */
.kt-rc{font-size:13.5px}
.kt-rc-h{text-align:center;padding-bottom:10px;border-bottom:1px dashed #d5dcd7;margin-bottom:10px}
.kt-rc-h b{display:block;font-size:16px}
.kt-rc-h small{color:#8b948f}
.kt-rc-row{display:grid;grid-template-columns:1fr 40px 80px;gap:8px;padding:5px 0}
.kt-rc-row span:nth-child(2){text-align:center;color:#8b948f}
.kt-rc-row span:nth-child(3){text-align:right}
.kt-rc-t{display:flex;justify-content:space-between;border-top:1px dashed #d5dcd7;margin-top:8px;padding-top:10px;font-weight:800;font-size:15px}
@media(max-width:1200px){.kt-cards{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:768px){
 .kt-mstats{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:14px}
 .kt-mstats div{background:#fff;border:1px solid #eef0ee;border-radius:14px;padding:12px}
 .kt-mstats small{display:block;color:#777;font-size:12px}
 .kt-mstats b{display:block;font-size:18px;margin-top:3px;color:#123527;white-space:nowrap}
 .kt-mitems{margin-top:10px;font-size:13px;color:#555;line-height:1.5}
 .ms-pill.walk_in{background:#e6f4ea;color:#2f6b4f}.ms-pill.room_guest{background:#dfebfb;color:#1e4f8f}.ms-pill.complimentary{background:#ececec;color:#666}
 .kt-line,.kt-lines-h{grid-template-columns:minmax(0,1fr) 54px 78px 30px}
 .kt-line .lt,.kt-lines-h span:nth-child(4){display:none}
}
@media print{
 body *{visibility:hidden!important}
 #ktReceipt, #ktReceipt *{visibility:visible!important}
 #ktReceipt{position:fixed;left:0;top:0;width:72mm;padding:4mm}
}
</style>
@php
    $canManage = in_array(auth()->user()->role, ['admin', 'manager']);
    $ordersJson = $orders->map(fn ($o) => [
        'id' => $o->id,
        'code' => $o->code,
        'customer_name' => $o->customer_name,
        'type' => $o->type,
        'room_number' => $o->room_number,
        'total' => (int) $o->total,
        'payment_status' => $o->payment_status,
        'note' => $o->note,
        'proofs' => $o->attachments,
        'order_date' => $o->order_date,
        'time' => optional($o->created_at)->format('g:i A'),
        'date_label' => \Carbon\Carbon::parse($o->order_date)->format('M j, Y'),
        'items' => $o->items->map(fn ($i) => ['name' => $i->name, 'quantity' => (int) $i->quantity, 'price' => (int) $i->price, 'line_total' => (int) $i->line_total])->values(),
    ])->values();
@endphp
<main class="main">
<section class="m-page">
@php $msAct = '<button class="ms-add" type="button" onclick="openOrder()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>New Order</button>'; @endphp
@include('partials.mobile-shell', ['msTitle'=>'Kitchen','msSubtitle'=>'Restaurant orders and sales','msAction'=>$msAct])
<div class="kt-mstats">
    <div><small>Today's sales</small><b>PKR {{ number_format($stats['today']) }}</b></div>
    <div><small>This month</small><b>PKR {{ number_format($stats['month']) }}</b></div>
    <div><small>Kitchen costs</small><b>PKR {{ number_format($stats['costs']) }}</b></div>
    <div><small>Profit</small><b style="{{ $stats['profit'] < 0 ? 'color:#b3352f' : '' }}">PKR {{ number_format($stats['profit']) }}</b></div>
</div>
<div class="ms-filters one"><label class="ms-search"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg><input id="mSearch" type="search" placeholder="Search order, customer, item..."></label></div>
<div class="ms-selrow"><select class="ms-sel" id="mType"><option value="">All Types</option><option value="walk_in">Walk-in</option><option value="room_guest">Room Guest</option><option value="complimentary">Complimentary</option></select><select class="ms-sel" id="mPay"><option value="">All Payments</option><option value="paid">Paid</option><option value="unpaid">Unpaid</option></select></div>
<div id="mRows"></div><div class="ms-pager" id="mPager"></div>
@include('partials.mobile-nav')
</section>
    <header class="top">
        <h1>Kitchen</h1>
        <div class="profile">
            <span class="avatar hdr-avatar" style="cursor:pointer" onclick="openAccount()" title="My account">@if(auth()->user()->avatar)<img src="{{ asset(auth()->user()->avatar) }}" alt="">@else{{ auth()->user()->initials() }}@endif</span>
            <div class="pinfo"><b>{{ auth()->user()->name }}</b><small>{{ ucfirst(auth()->user()->role) }}</small></div>
            <div class="tools">
                <button class="tool" type="button" title="My account" onclick="openAccount()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></button>
                <button class="tool bell" type="button" title="Notifications" onclick="showNotifications()"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
            </div>
        </div>
    </header>
@include('partials.page-head', ['pgTitle'=>'Kitchen','pgSub'=>'Restaurant orders, sales and kitchen costs.'])
    <section class="kt-cards">
        <div class="kt-card"><span class="kt-ic"><svg viewBox="0 0 24 24"><path d="M6 3v7a2 2 0 0 0 4 0V3M8 12v9M17 3c-2 0-3.5 2.2-3.5 5.5S15 13 17 13v8"/></svg></span><div><small>Today's Sales</small><b>PKR {{ number_format($stats['today']) }}</b><i>{{ $stats['todayOrders'] }} {{ $stats['todayOrders'] === 1 ? 'order' : 'orders' }} today</i></div></div>
        <div class="kt-card"><span class="kt-ic blue"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 10h18M8 2v4M16 2v4"/></svg></span><div><small>Sales This Month</small><b>PKR {{ number_format($stats['month']) }}</b><i>{{ now()->format('F Y') }}</i></div></div>
        <div class="kt-card"><span class="kt-ic amber"><svg viewBox="0 0 24 24"><path d="M12 3v18M16.5 7.5a4 4 0 0 0-4.5-2c-2 0-3.5 1.2-3.5 2.8s1.5 2.5 3.5 2.7 3.5 1.2 3.5 2.8-1.5 2.7-3.5 2.7a4 4 0 0 1-4.5-2"/></svg></span><div><small>Kitchen Costs</small><b>PKR {{ number_format($stats['costs']) }}</b><i>groceries, gas, supplies this month</i></div></div>
        <div class="kt-card"><span class="kt-ic {{ $stats['profit'] < 0 ? 'red' : '' }}"><svg viewBox="0 0 24 24"><path d="M3 17l6-6 4 4 8-8M15 7h6v6"/></svg></span><div><small>Kitchen Profit</small><b class="{{ $stats['profit'] < 0 ? 'neg' : '' }}">PKR {{ number_format($stats['profit']) }}</b><i>sales minus costs{{ $stats['unpaid'] > 0 ? ' · PKR '.number_format($stats['unpaid']).' unpaid' : '' }}</i></div></div>
    </section>
    <section class="panel">
        <div class="filters">
            <div class="fl">
                <select class="fsel" id="fType"><option value="">All Types</option><option value="walk_in">Walk-in</option><option value="room_guest">Room Guest</option><option value="complimentary">Complimentary</option></select>
                <select class="fsel" id="fPay"><option value="">All Payments</option><option value="paid">Paid</option><option value="unpaid">Unpaid</option></select>
                <input class="fsel" id="fDate" type="date" title="Order date">
            </div>
            <div class="fr">
                <div class="searchbox"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg><input class="search" id="fSearch" placeholder="Search order, customer, item"></div>
                <button class="add" onclick="openOrder()">+ New Order</button>
            </div>
        </div>
        <div class="tbl">
            <div class="thead">
                <span onclick="sortCol('kt','id',applyFilters)" style="cursor:pointer">Order @include('partials.sort')</span>
                <span onclick="sortCol('kt','customer_name',applyFilters)" style="cursor:pointer">Customer @include('partials.sort')</span>
                <span>Items</span>
                <span onclick="sortCol('kt','type',applyFilters)" style="cursor:pointer">Type @include('partials.sort')</span>
                <span onclick="sortCol('kt','total',applyFilters)" style="cursor:pointer">Total @include('partials.sort')</span>
                <span onclick="sortCol('kt','payment_status',applyFilters)" style="cursor:pointer">Payment @include('partials.sort')</span>
                <span style="justify-content:flex-end">Action</span>
            </div>
            <div id="rows"></div>
        </div>
        <div class="tbottom"><span id="ktInfo">Showing…</span><div class="pages" id="ktPages"></div></div>
    </section>

    <section class="kt-costs">
        <div class="kt-costs-h">
            <div><h2>Kitchen Costs</h2><p>Expenses filed under Kitchen &amp; Restaurant. They also appear on the Financials page.</p></div>
            @if($canManage)<button class="kt-soft" type="button" onclick="openModal('addKitchenCost')">+ Add Kitchen Cost</button>@endif
        </div>
        @forelse($kitchenExpenses as $e)
            <div class="kt-cost"><span>{{ $e->name }}</span><span><small>{{ $e->category }}</small></span><span><small>{{ $e->date ? \Carbon\Carbon::parse($e->date)->format('M j, Y') : '—' }}</small></span><span>PKR {{ number_format((int) $e->amount) }}</span></div>
        @empty
            <div class="kt-cost" style="grid-template-columns:1fr"><span style="text-align:left;font-weight:400;color:#8b948f">No kitchen costs recorded yet. Groceries, gas and supplies added here count against kitchen profit.</span></div>
        @endforelse
    </section>

    <footer>
        <div class="flinks"><span>Copyright © 2026 Indus Resort Restaurant</span><a href="#">Privacy Policy</a><a href="#">Term and conditions</a><a href="#">Contact</a></div>
    </footer>
</main>

{{-- New / edit order --}}
<div class="modal-ov" id="orderModal"><div class="modal wide"><h3 id="orderTitle">New Order</h3>
<form method="POST" id="orderForm" action="{{ url('/kitchen') }}" enctype="multipart/form-data">@csrf <input type="hidden" name="_method" id="orderMethod" value="POST">
<div class="mrow three">
    <div><label>Order Type *</label><select name="type" id="oType" onchange="syncType()"><option value="walk_in">Walk-in</option><option value="room_guest">Room Guest</option><option value="complimentary">Complimentary / Staff</option></select></div>
    <div><label>Customer Name</label><input name="customer_name" id="oCustomer" placeholder="Optional"></div>
    <div id="oRoomWrap" style="display:none"><label>Room Number</label><input name="room_number" id="oRoom" placeholder="e.g. 101"></div>
    <div id="oDateWrap"><label>Date</label><input type="date" name="order_date" id="oDate" value="{{ now()->toDateString() }}"></div>
</div>
<div class="kt-lines-h"><span>Item</span><span>Qty</span><span>Price (PKR)</span><span>Total</span><span></span></div>
<div class="kt-lines" id="oLines"></div>
<button type="button" class="kt-addline" onclick="addLine()">+ Add item</button>
<datalist id="ktNames">@foreach($suggestions as $s)<option value="{{ $s['name'] }}"></option>@endforeach</datalist>
<div class="kt-sum"><span id="oSumLabel">Order total</span><b id="oSum">PKR 0</b></div>
<div class="mrow">
    <div id="oPayWrap"><label>Payment</label><select name="payment_status" id="oPay"><option value="paid">Paid</option><option value="unpaid">Unpaid (pay later)</option></select></div>
    <div><label>Note</label><input name="note" id="oNote" placeholder="Optional"></div>
</div>
<label>Payment Proof <span style="color:#9ca3af;font-weight:400">(optional: one or several screenshots, card slips or PDFs)</span></label>
<div class="kt-proof">
    <label class="kt-proof-btn" for="oProof"><svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/></svg>Attach file</label>
    <input type="file" name="payment_proofs[]" multiple id="oProof" accept="image/jpeg,image/png,image/webp,application/pdf" onchange="attPicked(this,'oProofName','No file attached')">
    <span id="oProofName">No file attached</span>
</div>
<div id="oProofNow"></div>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('orderModal')">Cancel</button><button class="mbtn save" id="orderSave">Save Order</button></div>
</form></div></div>

{{-- Receipt --}}
<div class="modal-ov" id="receiptModal"><div class="modal"><h3>Order Receipt</h3>
<div id="detailBodyKt" style="padding:14px 26px 0"><div id="ktReceipt" class="kt-rc"></div></div>
<div class="mact" style="padding:14px 26px 18px;margin:16px 0 0"><button type="button" class="mbtn cancel" onclick="closeModal('receiptModal')">Close</button><button type="button" class="mbtn save" onclick="window.print()">Print</button></div>
</div></div>

@if($canManage)
{{-- Kitchen cost: an ordinary expense, pre-filed under the kitchen category group --}}
<div class="modal-ov" id="addKitchenCost"><div class="modal"><h3>Add Kitchen Cost</h3>
<form method="POST" action="{{ url('/expenses') }}">@csrf
<label>What was bought *</label><input name="name" required placeholder="e.g. Vegetables and chicken">
<div class="mrow">
    <div><label>Category</label><select name="category">@foreach($expenseOptions as $opt)<option>{{ $opt }}</option>@endforeach</select></div>
    <div><label>Amount (PKR) *</label><input type="number" name="amount" min="1" required></div>
</div>
<div class="mrow">
    <div><label>Quantity</label><input type="number" name="quantity" value="1" min="1"></div>
    <div><label>Date</label><input type="date" name="date" value="{{ now()->toDateString() }}"></div>
</div>
<label>Paid from</label>
<select name="paid_from">
    <option value="income">Income Cash (PKR {{ number_format($cash['income']) }} available)</option>
    <option value="petty">Petty Cash (PKR {{ number_format($cash['petty']) }} available)</option>
</select>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('addKitchenCost')">Cancel</button><button class="mbtn save">Save Cost</button></div>
</form></div></div>
@endif

<script>
const orders = @json($ordersJson);
const SUGGEST = @json($suggestions);
const CAN_MANAGE_KT = {{ $canManage ? 'true' : 'false' }};
const IS_ADMIN_KT = {{ auth()->user()->role === 'admin' ? 'true' : 'false' }};
const TLABEL = {walk_in:'Walk-in', room_guest:'Room Guest', complimentary:'Complimentary'};
const money = n => 'PKR ' + Number(n || 0).toLocaleString();
const esc = s => String(s == null ? '' : s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));

const eyeIco  = '<svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>';
const editIco = '<svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>';
const proofIco = '<svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 14h8M8 18h5"/></svg>';
const delIco  = '<svg viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2M6 6l1 14h10l1-14M10 11v6M14 11v6"/></svg>';

function itemsText(o){
    const parts = o.items.map(i => esc(i.name) + (i.quantity > 1 ? ' <em>×' + i.quantity + '</em>' : ''));
    return parts.join(', ');
}
function payCell(o){
    if (o.type === 'complimentary') return '<em class="kt-pill complimentary">Free</em>';
    const label = o.payment_status === 'paid' ? 'Paid' : 'Unpaid';
    return CAN_MANAGE_KT
        ? `<button class="kt-pill ${o.payment_status}" title="Click to mark ${o.payment_status === 'paid' ? 'unpaid' : 'paid'}" onclick="post('/kitchen/${o.id}/paid','POST')">${label}</button>`
        : `<em class="kt-pill ${o.payment_status}">${label}</em>`;
}

function render(list){
    renderMobile(list);
    document.getElementById('rows').innerHTML = list.map(o => `<div class="trow">
        <span class="kt-code"><b>${o.code}</b><small>${o.date_label}${o.time ? ' · ' + o.time : ''}</small></span>
        <span>${esc(o.customer_name) || '<span style="color:#9ca3af">Guest</span>'}${o.room_number ? '<small style="display:block;color:#9ca3af;font-size:12px">Room ' + esc(o.room_number) + '</small>' : ''}</span>
        <span class="kt-items" title="${o.items.map(i => esc(i.name) + ' x' + i.quantity).join(', ')}">${itemsText(o)}</span>
        <span><em class="kt-pill ${o.type}">${TLABEL[o.type]}</em></span>
        <span class="kt-total ${o.type === 'complimentary' ? 'free' : ''}">${money(o.total)}</span>
        <span>${payCell(o)}</span>
        <span class="act">
            ${attButton(o.proofs, 'ib proof', proofIco, 'Payment proof · ' + o.code)}
            <button class="ib" title="Receipt" onclick="showReceipt(${o.id})">${eyeIco}</button>
            ${CAN_MANAGE_KT ? `<button class="ib" title="Edit order" onclick="openOrder(${o.id})">${editIco}</button>` : ''}
            ${IS_ADMIN_KT ? `<button class="ib del" title="Delete order" onclick="if(confirm('Delete order ${o.code}?'))post('/kitchen/${o.id}','DELETE')">${delIco}</button>` : ''}
        </span>
    </div>`).join('') || '<div class="trow"><span style="grid-column:1/-1;color:#8b948f">No orders yet. Use New Order to ring up the first one.</span></div>';
}

function renderMobile(list){
    const el = document.getElementById('mRows');
    if (!el) return;
    el.innerHTML = list.map(o => `<article class="ms-card">
        <div class="ms-top"><div class="ms-name"><b>${o.code}</b><small>${o.date_label}${o.time ? ' · ' + o.time : ''}${o.customer_name ? ' · ' + esc(o.customer_name) : ''}</small></div><span class="ms-pill ${o.type}">${TLABEL[o.type]}</span></div>
        <div class="kt-mitems">${itemsText(o)}</div>
        <div class="ms-kv two" style="margin-top:12px;padding-top:12px;border-top:1px solid #eee"><div><small>Total</small><b style="font-size:17px">${money(o.total)}</b></div><div><small>Payment</small><b>${o.type === 'complimentary' ? 'Free' : (o.payment_status === 'paid' ? 'Paid' : 'Unpaid')}</b></div></div>
        <div class="ms-act"><button type="button" class="ms-btn gray" onclick="showReceipt(${o.id})">Receipt</button>${attButton(o.proofs, 'ms-btn gray att-plain', 'Proof', 'Payment proof · ' + o.code, true)}${CAN_MANAGE_KT ? `<button type="button" class="ms-btn gray" onclick="openOrder(${o.id})">Edit</button>` : ''}${CAN_MANAGE_KT && o.type !== 'complimentary' ? `<button type="button" class="ms-btn lime" onclick="post('/kitchen/${o.id}/paid','POST')">${o.payment_status === 'paid' ? 'Mark Unpaid' : 'Mark Paid'}</button>` : ''}</div>
    </article>`).join('') || '<div class="ms-empty">No orders yet</div>';
}

/* ---------- order form ---------- */
let lineSeq = 0;
function addLine(item){
    const i = lineSeq++;
    const row = document.createElement('div');
    row.className = 'kt-line';
    row.innerHTML = `<input name="items[${i}][name]" list="ktNames" placeholder="Item name" required value="${item ? esc(item.name) : ''}">
        <input name="items[${i}][quantity]" type="number" min="1" max="999" value="${item ? item.quantity : 1}" required>
        <input name="items[${i}][price]" type="number" min="0" placeholder="0" value="${item ? item.price : ''}" required>
        <span class="lt">PKR 0</span>
        <button type="button" class="rm" title="Remove item">×</button>`;
    const [nm, qty, pr] = row.querySelectorAll('input');
    // A name typed before brings its last price with it.
    nm.addEventListener('change', () => { const s = SUGGEST.find(x => x.name.toLowerCase() === nm.value.trim().toLowerCase()); if (s && !pr.value) { pr.value = s.price; recalc(); } });
    [qty, pr].forEach(inp => inp.addEventListener('input', recalc));
    row.querySelector('.rm').addEventListener('click', () => { if (document.querySelectorAll('#oLines .kt-line').length > 1) { row.remove(); recalc(); } });
    document.getElementById('oLines').appendChild(row);
    recalc();
    return nm;
}
function recalc(){
    let total = 0;
    document.querySelectorAll('#oLines .kt-line').forEach(row => {
        const [, qty, pr] = row.querySelectorAll('input');
        const line = (parseInt(qty.value) || 0) * (parseInt(pr.value) || 0);
        row.querySelector('.lt').textContent = money(line);
        total += line;
    });
    document.getElementById('oSum').textContent = money(total);
}
function syncType(){
    const t = document.getElementById('oType').value;
    document.getElementById('oRoomWrap').style.display = t === 'room_guest' ? '' : 'none';
    document.getElementById('oPayWrap').style.visibility = t === 'complimentary' ? 'hidden' : 'visible';
    document.getElementById('oSumLabel').textContent = t === 'complimentary' ? 'Value (not charged)' : 'Order total';
}
/* Financials links here as /kitchen?edit=ID to open an order's form directly. */
document.addEventListener('DOMContentLoaded',()=>{const id=Number(new URLSearchParams(location.search).get('edit'));if(id&&CAN_MANAGE_KT&&orders.some(o=>o.id===id)){openOrder(id);history.replaceState(null,'',location.pathname);}});
function openOrder(id){
    const f = document.getElementById('orderForm');
    const o = id ? orders.find(x => x.id === id) : null;
    f.reset();
    document.getElementById('oLines').innerHTML = '';
    lineSeq = 0;
    f.action = o ? '/kitchen/' + o.id : '/kitchen';
    document.getElementById('orderMethod').value = o ? 'PUT' : 'POST';
    document.getElementById('orderTitle').textContent = o ? 'Edit ' + o.code : 'New Order';
    document.getElementById('orderSave').textContent = o ? 'Save Changes' : 'Save Order';
    document.getElementById('oProofName').textContent = 'No file attached';
    attEditable('oProofNow', o ? o.proofs : []);
    if (o) {
        document.getElementById('oType').value = o.type;
        document.getElementById('oCustomer').value = o.customer_name || '';
        document.getElementById('oRoom').value = o.room_number || '';
        document.getElementById('oDate').value = o.order_date;
        document.getElementById('oPay').value = o.payment_status;
        document.getElementById('oNote').value = o.note || '';
        o.items.forEach(addLine);
    } else {
        addLine().focus();
    }
    syncType();
    openModal('orderModal');
}


function showReceipt(id){
    const o = orders.find(x => x.id === id);
    if (!o) return;
    document.getElementById('ktReceipt').innerHTML = `
        <div class="kt-rc-h"><b>Indus Resort Restaurant</b><small>${o.code} · ${o.date_label}${o.time ? ' · ' + o.time : ''}</small>${o.customer_name ? '<div>' + esc(o.customer_name) + (o.room_number ? ' · Room ' + esc(o.room_number) : '') + '</div>' : ''}</div>
        ${o.items.map(i => `<div class="kt-rc-row"><span>${esc(i.name)}<br><small style="color:#8b948f">${money(i.price)} each</small></span><span>×${i.quantity}</span><span>${money(i.line_total)}</span></div>`).join('')}
        <div class="kt-rc-t"><span>Total</span><span>${money(o.total)}</span></div>
        <div style="text-align:center;margin-top:10px;color:#8b948f;font-size:12.5px">${o.type === 'complimentary' ? 'Complimentary, not charged' : (o.payment_status === 'paid' ? 'Paid. Thank you!' : 'Payment pending')}${o.note ? '<br>' + esc(o.note) : ''}</div>${(o.proofs || []).length ? attLinks(o.proofs) : ''}`;
    openModal('receiptModal');
}

function applyFilters(){
    const q = (document.getElementById('fSearch').value || '').toLowerCase();
    const type = document.getElementById('fType').value;
    const pay = document.getElementById('fPay').value;
    const date = document.getElementById('fDate').value;
    let list = orders.filter(o =>
        (!type || o.type === type) &&
        (!pay || o.payment_status === pay) &&
        (!date || o.order_date === date) &&
        (!q || [o.code, o.customer_name, o.room_number, ...o.items.map(i => i.name)].join(' ').toLowerCase().includes(q))
    );
    list = sortList('kt', list);
    paginateRender('kt', list, 10, render);
}
msMirror([['mSearch','fSearch','input'], ['mType','fType'], ['mPay','fPay']]);
['fSearch','fType','fPay','fDate'].forEach(id => document.getElementById(id).addEventListener('input', applyFilters));
applyFilters();
@if($errors->any())
// Validation failed on save: reopen the form so the message is not lost.
document.addEventListener('DOMContentLoaded', () => { openOrder(); alert(@json($errors->first())); });
@endif
</script>
</body>
</html>
