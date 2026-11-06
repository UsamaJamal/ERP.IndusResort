<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Reservations - Indus Resort Restaurant</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--lime:#e8fb82;--mint:#d2f3e4;--ink:#151515;--muted:#8f8f8f;--bg:#f6f6f5;--line:#f0f0f0;--red:#ff4e52}
*{box-sizing:border-box}
body{margin:0;display:flex;background:var(--bg);font-family:Lato,Arial,sans-serif;color:var(--ink);zoom:.9}
@media(min-width:1301px) and (max-width:1700px){body{zoom:.82}}
@media(min-width:1101px) and (max-width:1300px){body{zoom:.72}}
@media(min-width:701px) and (max-width:1100px){body{zoom:.62}}
.main{flex:1;min-width:0;padding:26px 30px 16px}
.top{display:flex;justify-content:space-between;align-items:center;margin-bottom:22px}
.top h1{font-size:30px;font-weight:800;margin:0}
.profile{display:flex;align-items:center;gap:13px}
.avatar{width:46px;height:46px;border-radius:50%;background:var(--lime);display:grid;place-items:center;font-weight:700;font-size:15px}
.pinfo b{display:block;font-size:16px;line-height:1.1}.pinfo small{color:#888;font-size:13px}
.tools{display:flex;gap:10px;margin-left:14px}
.tool{width:44px;height:44px;border:1px solid #e8e8e8;background:#fff;border-radius:11px;display:grid;place-items:center;cursor:pointer;position:relative}
.tool svg{width:20px;height:20px;fill:none;stroke:#4a4a4a;stroke-width:1.8}
.tool.bell:after{content:'';position:absolute;top:9px;right:11px;width:8px;height:8px;border-radius:50%;background:var(--red);border:2px solid #fff}
.panel{background:#fff;border-radius:18px;padding:22px 22px 8px}
.pt{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;gap:12px;flex-wrap:wrap}
.pt h2{font-size:20px;margin:0}
.pt-r{display:flex;gap:12px;align-items:center;flex-wrap:wrap}
.pill{height:44px;border:0;border-radius:11px;padding:0 16px;display:inline-flex;align-items:center;gap:9px;font-size:15px;background:#f4f4f4;color:#333;cursor:pointer;white-space:nowrap}
.pill.lime{background:var(--lime);color:#2f3a0c;font-weight:700}
.pill svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.8}
.searchbox{position:relative}
.searchbox>svg{position:absolute;left:15px;top:50%;transform:translateY(-50%);width:18px;height:18px;fill:none;stroke:#b0b0b0;stroke-width:1.8}
.search{height:44px;width:280px;border:0;border-radius:11px;background:#f4f4f4;padding:0 16px 0 42px;font-size:14px;color:#333;font-family:inherit}
.search::placeholder{color:#b0b0b0}
.date-filter{padding:0 12px!important}.date-filter input{width:112px;border:0;background:transparent;outline:0;color:#333;font:inherit;cursor:pointer}.date-filter .date-separator{color:#9a9a9a;font-size:13px}
.tbl{width:100%;overflow-x:auto}
.thead,.trow{display:grid;grid-template-columns:1.15fr .8fr .95fr .7fr 2.15fr .85fr 1.55fr;align-items:center;min-width:1250px}
.trow>span:nth-child(5){white-space:nowrap}
.thead{background:#eefaf3;border-radius:12px;padding:16px 22px;color:#8a8a8a;font-size:15px;font-weight:600}
.thead span{display:inline-flex;align-items:center;gap:6px}
.thead svg{width:12px;height:12px;fill:none;stroke:#b5b5b5;stroke-width:2}
.trow{padding:15px 22px;border-bottom:1px solid var(--line);font-size:15px}
.trow:last-child{border-bottom:0}
.g b{display:block;font-size:15px}.g small{color:#9a9a9a;font-size:13px}
.st{display:inline-flex;align-items:center;padding:6px 14px;border-radius:8px;font-size:14px;font-weight:600;width:max-content}
.st.confirmed{background:var(--mint);color:#2f6b4f}
.st.pending{background:#ffe1e1;color:#b3352f}
.st.checked_in{background:var(--lime);color:#3d4a10}
.st.checked_out{background:#ececec;color:#666}
.abtn.done{background:#ececec;color:#888;display:inline-flex;align-items:center;justify-content:center;padding:0 18px;height:38px;border-radius:9px;font-weight:700}
.act{display:flex;gap:8px;align-items:center}
.ib{width:36px;height:36px;flex:0 0 36px;border:1px solid #ededed;background:#fff;border-radius:9px;display:grid;place-items:center;cursor:pointer}
.ib svg{width:17px;height:17px;fill:none;stroke:#555;stroke-width:1.7}
.abtn{height:36px;border:0;border-radius:9px;padding:0 14px;font-size:13.5px;font-weight:700;cursor:pointer;white-space:nowrap}
.abtn.cancel{background:#ffe1e1;color:#b3352f}
.abtn.confirm{background:var(--lime);color:#2f3a0c}
.tbottom{display:flex;justify-content:space-between;align-items:center;padding:20px 4px 16px;color:#8a8a8a;font-size:15px}
.pages{display:flex;gap:8px}
.pg{min-width:40px;height:40px;border:0;border-radius:9px;background:#f4f4f4;font-size:15px;color:#555;cursor:pointer;display:grid;place-items:center}
.pg.active{background:var(--lime);color:#2f3a0c;font-weight:700}
footer{display:flex;justify-content:space-between;align-items:center;padding:20px 6px 8px;color:#9a9a9a;font-size:14px;flex-wrap:wrap;gap:14px}
.flinks{display:flex;gap:26px}.flinks a{color:#9a9a9a;text-decoration:none}.flinks span:first-child{color:#666}
.fsoc{display:flex;gap:16px;align-items:center}.fsoc a{color:#c2c2c2}.fsoc svg{width:18px;height:18px;fill:currentColor}
@media(max-width:700px){body{zoom:1}.main{padding:18px 14px}.top h1{font-size:24px}.profile .pinfo,.tools{display:none}.pt-r{width:100%}.search{width:100%}footer{flex-direction:column;align-items:flex-start}}
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
@media(min-width:769px){
 .rs-head{margin:20px var(--gutter,28px) 14px}
 .rs-head h2{margin:0;font-size:26px;font-weight:800;letter-spacing:-.4px}
 .rs-head h2::before{display:none}
 .rs-head p{margin:5px 0 0;font-size:13.5px;color:#6b7280}
 .rs-filters{display:flex;align-items:center;gap:12px;background:#fff;border:1px solid var(--line);border-radius:14px;padding:14px;margin:0 var(--gutter,28px) 14px}
 .rs-search{flex:1;min-width:0;display:flex;align-items:center;gap:10px;height:44px;border:1px solid var(--line);border-radius:10px;padding:0 14px;background:#fff}
 .rs-search svg{width:18px;height:18px;flex:0 0 18px;fill:none;stroke:#9ca3af;stroke-width:2;stroke-linecap:round}
 .rs-search input{flex:1;min-width:0;border:0;outline:0;background:none;font:400 13.5px Inter,Lato,sans-serif;color:#111}
 .rs-sel{height:44px;border:1px solid var(--line);border-radius:10px;padding:0 34px 0 14px;font:500 13.5px Inter,Lato,sans-serif;background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E") right 12px center/14px no-repeat;-webkit-appearance:none;appearance:none;color:#111}
 .rs-dates{display:flex;align-items:center;gap:8px;height:44px;border:1px solid var(--line);border-radius:10px;padding:0 12px;background:#fff;color:#6b7280;font-size:13px}
 .rs-dates svg{width:17px;height:17px;fill:none;stroke:#6b7280;stroke-width:2}
 .rs-dates input{border:0;outline:0;background:none;font:500 13px Inter,Lato,sans-serif;color:#111;width:112px}
 .rs-add{display:inline-flex;align-items:center;gap:8px;height:44px;padding:0 18px;border:0;border-radius:10px;background:var(--g800);color:#fff;font:700 13.5px Inter,Lato,sans-serif;cursor:pointer;white-space:nowrap}
 .rs-add:hover{background:var(--g900)}
 .rs-add svg{width:17px;height:17px;fill:none;stroke:currentColor;stroke-width:2.4;stroke-linecap:round}
 .rs-panel{padding:0!important;overflow:hidden}
 .rs-panel .tbl{padding:0}
 .rs-panel .thead,.rs-panel .trow{grid-template-columns:minmax(220px,1.55fr) minmax(190px,1.25fr) minmax(90px,.65fr) minmax(85px,.7fr) minmax(128px,1fr) minmax(128px,1fr) minmax(135px,1fr) minmax(92px,.85fr)!important;min-width:1200px!important;align-items:center}
 .rs-panel .thead{background:#f7faf8!important;border-radius:0!important;padding:14px 22px!important;border-bottom:1px solid var(--line)}
 .rs-panel .trow{padding:14px 22px!important;font-size:13.5px!important;border-bottom:1px solid #f1f4f2!important}
 .rs-panel .trow>span{min-width:0}
 .rs-guest{display:flex;align-items:center;gap:11px;min-width:0;overflow:hidden}
 .rs-guest>span:last-child,.rs-room{display:block;min-width:0;overflow:hidden}
 .rs-av{width:40px;height:40px;border-radius:50%;display:grid;place-items:center;font-weight:700;font-size:13px;flex:0 0 40px;background:#e6f4ea;color:#2f6b4f}
 .rs-av.c1{background:#dfebfb;color:#1e4f8f}.rs-av.c2{background:#fdf3d2;color:#7a5400}.rs-av.c3{background:#e6f4ea;color:#2f6b4f}.rs-av.c4{background:#ece7fb;color:#4b3a8f}
 .rs-guest b,.rs-room b,.rs-date b{display:block;font-weight:600;font-size:13.5px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
 .rs-guest small,.rs-room small,.rs-date small{display:block;color:#9ca3af;font-size:12px;margin-top:2px}
 /* A stamped arrival or departure is real data; the 12:00 PM fallback is not. */
 .rs-date small.rs-real{color:#2f6b4f;font-weight:700}
 .rs-panel .trow>span:nth-child(3),.rs-panel .trow>span:nth-child(4){white-space:nowrap}
 .rs-status{display:inline-flex;align-items:center;gap:7px;padding:6px 12px;border-radius:20px;font-size:12.5px;font-weight:600;font-style:normal;white-space:nowrap}
 .rs-status i{width:7px;height:7px;border-radius:50%;background:currentColor}
 .rs-status.confirmed{background:#e6f4ea;color:#2f6b4f}.rs-status.checked_in{background:#dfebfb;color:#1e4f8f}.rs-status.pending{background:#fdf0da;color:#a86b00}.rs-status.checked_out{background:#eceff0;color:#6b7280}
 .rs-panel .act{display:flex;gap:7px;align-items:center;justify-content:flex-end}
 .rs-ib{height:34px;min-width:34px;padding:0 9px;border:1px solid var(--line);background:#fff;border-radius:9px;display:inline-grid;place-items:center;cursor:pointer;color:#4b5563;font:700 12px Inter,Lato,sans-serif}
 .rs-ib:hover{background:#f7faf8}
 .rs-ib svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
 .rs-ib.next{background:var(--g100);border-color:#cfe3d6;color:var(--g800);padding:0 12px}
 .rs-ib.del{background:#fff5f5;border-color:#f3d4d4;color:#b3352f}
 .rs-panel .tbottom{padding:16px 22px!important;border-top:1px solid var(--line);color:#6b7280}
 .main>.rs-head+.rs-filters{margin-top:0}
}
</style>
<style>
/* ===== Phone reservations (Figma clone). Only on screens up to 768px; desktop table untouched. ===== */
.m-res{display:none}
@media(max-width:768px){
    body{zoom:1!important;background:#f4f6f5!important;display:block!important}
    .main{padding:10px 16px 100px!important}
    .main>*:not(.m-res){display:none!important}
    .m-res{display:block;font-family:Lato,Arial,sans-serif;color:#111}
    .mr-head{display:flex;align-items:center;justify-content:space-between;padding:6px 0 14px}
    .mr-brand{display:flex;align-items:center;gap:11px}
    .mr-brand img{width:46px;height:46px;border-radius:50%;object-fit:cover;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,.08)}
    .mr-brand b{display:block;font-size:17px;font-weight:800;line-height:1.1;color:#111}
    .mr-brand small{display:block;font-size:13px;color:#333;margin-top:2px}
    .mr-tools{display:flex;align-items:center;gap:8px}
    .mr-ib{width:44px;height:44px;border:0;border-radius:12px;background:#fff;display:grid;place-items:center;color:#222;cursor:pointer;position:relative;box-shadow:0 1px 4px rgba(0,0,0,.06)}
    .mr-ib svg{width:22px;height:22px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .mr-ib.bell:after{content:'';position:absolute;top:9px;right:10px;width:9px;height:9px;border-radius:50%;background:#ff3b30;border:2px solid #fff}
    .mr-avatar{width:48px;height:48px;border-radius:50%;background:#d7f0a0;color:#1f5f3f;display:grid;place-items:center;font-weight:800;font-size:16px;margin-left:4px}
    .mr-title{display:flex;align-items:center;justify-content:space-between;gap:10px;margin:2px 0 16px;flex-wrap:wrap}
    .mr-title h1{margin:0;font-size:26px;font-weight:800;letter-spacing:-.4px;min-width:0;flex:1 1 auto}
    .mr-add{display:inline-flex;align-items:center;justify-content:center;gap:8px;height:42px;padding:0 14px;border:0;border-radius:12px;background:#dff55f;color:#1f2a08;font:700 14px Lato,Arial,sans-serif;cursor:pointer;flex:0 0 auto;white-space:nowrap}
    .mr-add svg{width:20px;height:20px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round}
    .mr-filters{display:grid;grid-template-columns:minmax(0,1fr) auto auto;gap:8px;margin-bottom:14px}
    .mr-search{display:flex;align-items:center;gap:9px;height:50px;border-radius:14px;background:#fff;padding:0 14px;min-width:0;box-shadow:0 1px 4px rgba(0,0,0,.05)}
    .mr-search svg{width:20px;height:20px;flex:0 0 20px;fill:none;stroke:#222;stroke-width:2;stroke-linecap:round}
    .mr-search input{flex:1;min-width:0;border:0;outline:0;background:none;font:400 14px Lato,Arial,sans-serif;color:#111}
    .mr-search input::placeholder{color:#9a9a9a}
    .mr-sel{height:50px;border:0;border-radius:14px;background:#fff;padding:0 30px 0 12px;font:400 14px Lato,Arial,sans-serif;color:#111;appearance:none;-webkit-appearance:none;box-shadow:0 1px 4px rgba(0,0,0,.05);background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23222' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;background-size:14px}
    .mr-cal{width:50px;height:50px;border:0;border-radius:14px;background:#fff;display:grid;place-items:center;color:#222;cursor:pointer;box-shadow:0 1px 4px rgba(0,0,0,.05)}
    .mr-cal.on{background:#dff55f}
    .mr-cal svg{width:22px;height:22px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round}
    .mr-dates{display:none;grid-template-columns:1fr auto 1fr;align-items:center;gap:8px;margin:-4px 0 14px;font-size:13px;color:#777}
    .mr-dates.open{display:grid}
    .mr-dates input{height:44px;border:0;border-radius:12px;background:#fff;padding:0 12px;font:400 14px Lato,Arial,sans-serif;color:#111;min-width:0;width:100%;box-shadow:0 1px 4px rgba(0,0,0,.05)}
    .mr-card{background:#fff;border-radius:18px;padding:14px 14px 14px;margin-bottom:12px;box-shadow:0 4px 18px rgba(16,24,40,.05);border:1px solid #eef0ee}
    .mr-top{display:grid;grid-template-columns:auto minmax(0,1fr) auto auto;align-items:center;gap:12px 8px}
    .mr-av{width:52px;height:52px;border-radius:50%;display:grid;place-items:center;font-weight:800;font-size:17px;color:#1f5f3f;background:#d9f5e5}
    .mr-av.c1{background:#dfebfb;color:#1e4f8f}.mr-av.c2{background:#fdf3d2;color:#7a5a00}.mr-av.c3{background:#d9f5e5;color:#1f5f3f}.mr-av.c4{background:#e9e4fb;color:#4b3a8f}
    .mr-name{min-width:0}
    .mr-name b{display:block;font-size:16px;font-weight:800;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .mr-name small{display:block;font-size:14px;color:#8a8a8a;margin-top:2px}
    .mr-st{display:inline-flex;align-items:center;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:700;font-style:italic;white-space:nowrap}
    .mr-st.confirmed{background:#d9f5e5;color:#2f6b4f}.mr-st.pending{background:#ffe1e1;color:#c0392b}.mr-st.checked_in{background:#e8fb82;color:#3d4a10}.mr-st.checked_out{background:#ececec;color:#666}
    .mr-go{width:22px;height:28px;display:grid;place-items:center;color:#222;text-decoration:none}
    .mr-go svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:2.2;stroke-linecap:round;stroke-linejoin:round}
    .mr-meta{display:grid;grid-template-columns:auto minmax(0,1fr) auto;align-items:center;gap:8px;margin:14px 0 0;font-size:13px;color:#333}
    .mr-meta span{display:inline-flex;align-items:center;gap:5px;white-space:nowrap;min-width:0}
    .mr-meta span:nth-child(2){justify-content:center;overflow:hidden}.mr-meta span:nth-child(2) i{overflow:hidden;text-overflow:ellipsis;font-style:normal}
    .mr-meta svg{width:16px;height:16px;flex:0 0 16px;fill:none;stroke:#222;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .mr-act{display:flex;justify-content:flex-end;gap:10px;margin-top:14px}
    .mr-eye{width:52px;height:38px;border:1px solid #e3e3e3;background:#fff;border-radius:10px;display:grid;place-items:center;cursor:pointer;color:#333}
    .mr-eye svg{width:19px;height:19px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .mr-btn{height:38px;border:0;border-radius:10px;padding:0 20px;font:700 14px Lato,Arial,sans-serif;cursor:pointer;white-space:nowrap}
    .mr-btn.next{background:#dff55f;color:#1f2a08}.mr-btn.cancel{background:#ffe1e1;color:#c0392b}.mr-btn.done{background:#ececec;color:#888}
    .mr-empty{background:#fff;border-radius:18px;padding:28px;text-align:center;color:#888;font-size:14px}
    .mr-pager{display:flex;align-items:center;justify-content:space-between;padding:6px 4px 0;font-size:13px;color:#777}
    .mr-pager button{height:38px;padding:0 14px;border:0;border-radius:10px;background:#fff;font:700 13px Lato,Arial,sans-serif;color:#333;cursor:pointer;box-shadow:0 1px 4px rgba(0,0,0,.05)}
    .mr-pager button:disabled{opacity:.4;cursor:default}
}
@media(max-width:360px){
    .m-res .mr-title h1{font-size:22px}.m-res .mr-add{height:40px;padding:0 12px;font-size:14px}
    /* Narrow phones keep the calendar button too: forcing the raw date inputs open here
       is what made them show as dd/mm/yyyy instead of the icon. */
    .m-res .mr-filters{grid-template-columns:minmax(0,1fr) auto auto;gap:6px}
    .m-res .mr-sel{padding:0 26px 0 10px;font-size:13px}
    .m-res .mr-cal{width:44px;height:44px}
    .m-res .mr-search{height:44px}
    .m-res .mr-brand b{font-size:15px;white-space:nowrap}.m-res .mr-brand small{font-size:12px}.m-res .mr-brand img{width:40px;height:40px}.m-res .mr-ib{width:40px;height:40px}.m-res .mr-avatar{width:42px;height:42px;font-size:14px}
    .m-res .mr-av{width:44px;height:44px;font-size:15px}.m-res .mr-name b{font-size:15px}.m-res .mr-st{padding:5px 10px;font-size:11px}
    .m-res .mr-meta{display:flex;flex-wrap:wrap;gap:6px 14px;font-size:12px}.m-res .mr-meta span:nth-child(2){justify-content:flex-start;order:3;flex-basis:100%}.m-res .mr-btn{padding:0 14px}
}
</style>
<main class="main">
    <section class="m-res">
        <header class="mr-head">
            <div class="mr-brand"><img src="{{ asset('images/logo.png') }}" alt=""><div><b>Indus Resort</b><small>Restaurant</small></div></div>
            <div class="mr-tools">
                <button class="mr-ib bell" type="button" aria-label="Notifications" onclick="showNotifications()"><svg viewBox="0 0 24 24"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.9 1.9 0 0 0 3.4 0"/></svg></button>
                <span class="mr-avatar hdr-avatar" style="overflow:hidden;cursor:pointer" onclick="openAccount()">@if(auth()->user()->avatar)<img src="{{ asset(auth()->user()->avatar) }}" alt="">@else{{ auth()->user()->initials() }}@endif</span>
            </div>
        </header>
        <div class="mr-title"><h1>Reservations</h1>@if(auth()->user()->role !== 'staff')<button class="mr-add" type="button" onclick="openBookingCreator()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>Add Reservation</button>@endif</div>
        <div class="mr-filters">
            <label class="mr-search"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg><input id="mSearch" type="search" placeholder="Search guest, room, etc..."></label>
            <select class="mr-sel" id="mStatus"><option value="">All Status</option><option value="pending">Pending</option><option value="confirmed">Confirmed</option><option value="checked_in">Checked-In</option><option value="checked_out">Checked-Out</option></select>
            <button class="mr-cal" id="mCalBtn" type="button" aria-label="Filter by date" onclick="document.getElementById('mDates').classList.toggle('open');this.classList.toggle('on')"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 10h18M8 2v4M16 2v4"/></svg></button>
        </div>
        <div class="mr-dates" id="mDates"><input id="mDateStart" type="date" aria-label="Start date"><span>to</span><input id="mDateEnd" type="date" aria-label="End date"></div>
        <div id="mRows"></div>
        <div class="mr-pager" id="mPager"></div>
        @include('partials.mobile-nav')
    </section>
    <header class="top">
        <h1>Reservations</h1>
        <div class="profile">
            <span class="avatar hdr-avatar" style="cursor:pointer;overflow:hidden" onclick="openAccount()" title="My account">@if(auth()->user()->avatar)<img src="{{ asset(auth()->user()->avatar) }}" alt="">@else{{ auth()->user()->initials() }}@endif</span>
            <div class="pinfo"><b>{{ auth()->user()->name }}</b><small>{{ ucfirst(auth()->user()->role) }}</small></div>
            <div class="tools">
                <button class="tool" type="button" title="My account" onclick="openAccount()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></button>
                <button class="tool bell" type="button" title="Notifications" onclick="showNotifications()"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
            </div>
        </div>
    </header>
    <div class="rs-head"><h2>Reservations</h2><p>Manage all room reservations, check-ins and check-outs.</p></div>
    <section class="rs-filters">
        <div class="rs-search"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg><input id="fSearch" placeholder="Search guest name, email, phone, or booking ID..."></div>
        <select class="rs-sel" id="fStatus"><option value="">All Status</option><option value="pending">Pending</option><option value="confirmed">Confirmed</option><option value="checked_in">Checked-In</option><option value="checked_out">Checked-Out</option></select>
        <div class="rs-dates"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/></svg><input id="fDateStart" type="date" aria-label="Start date"><span>→</span><input id="fDateEnd" type="date" aria-label="End date"></div>
        @if(auth()->user()->role !== 'staff')<button class="rs-add" type="button" onclick="openBookingCreator()"><svg viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>Add Reservation</button>@endif
    </section>
    <section class="panel rs-panel">
        <div class="tbl">
            <div class="thead">
                <span onclick="sortCol('res','guest_name',applyFilters)" style="cursor:pointer">Guest</span>
                <span onclick="sortCol('res','room_label',applyFilters)" style="cursor:pointer">Room</span>
                <span onclick="sortCol('res','guests',applyFilters)" style="cursor:pointer">Guests</span>
                <span onclick="sortCol('res','duration',applyFilters)" style="cursor:pointer">Duration</span>
                <span onclick="sortCol('res','check_in',applyFilters)" style="cursor:pointer">Check-In</span>
                <span onclick="sortCol('res','check_out',applyFilters)" style="cursor:pointer">Check-Out</span>
                <span onclick="sortCol('res','status',applyFilters)" style="cursor:pointer">Status</span>
                <span>Action</span>
            </div>
            <div id="rows"></div>
        </div>
        <div class="tbottom">
            <span id="resInfo">Showing…</span>
            <div class="pages" id="resPages"></div>
        </div>
    </section>
    <footer>
        <div class="flinks"><span>Copyright © 2026 Indus Resort Restaurant</span><a href="#">Privacy Policy</a><a href="#">Term and conditions</a><a href="#">Contact</a></div>
        <div class="fsoc">
            <a href="https://www.facebook.com/people/Indus-Resort/61590518813137/" target="_blank" rel="noopener" aria-label="Facebook"><svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
            <a href="https://wa.me/923352015555" target="_blank" rel="noopener" aria-label="WhatsApp"><svg viewBox="0 0 24 24"><path d="M20.5 11.5a8.5 8.5 0 0 1-12.6 7.5L3.5 20.5 5 16.3A8.5 8.5 0 1 1 20.5 11.5Z"/><path d="M8.4 7.8c.2-.5.5-.5.7-.5h.5c.2 0 .4.1.5.4l.8 1.8c.1.3.1.5-.1.7l-.5.6c-.1.1-.1.3 0 .4.4.8 1.1 1.5 1.9 1.9.1.1.3.1.4 0l.6-.5c.2-.2.4-.2.7-.1l1.8.8c.3.1.4.3.4.5v.5c0 .2-.1.5-.5.7-.4.2-1.2.4-2.3-.1-1-.5-2.2-1.4-3.2-2.4-1-1-1.9-2.2-2.4-3.2-.5-1.1-.3-1.9-.1-2.3Z"/></svg></a>
            <a href="https://www.instagram.com/indus_resort/" target="_blank" rel="noopener" aria-label="Instagram"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg></a>


        </div>
    </footer>
</main>
<script>
const eye='<svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>';
const edit='<svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>';
const proofIcon='<svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 14h8M8 18h5"/></svg>';
const data=@json($bookings);
const roomRates=@json($rooms->pluck('price','name'));
const roomUnits=@json($units);
/* Room numbers come from the room-number list: only free rooms can be picked; booked ones are shown disabled. */
function fillRoomUnits(type,keep){const sel=document.getElementById('bookingRoomNumber'),inp=document.getElementById('bookingRoomInput');const list=roomUnits.filter(u=>u.type===type);if(!list.length){sel.style.display='none';sel.disabled=true;inp.style.display='';inp.disabled=false;return;}inp.style.display='none';inp.disabled=true;sel.style.display='';sel.disabled=false;const free=list.filter(u=>u.status==='available').length;sel.innerHTML='<option value="">'+(free?'Select room number ('+free+' available)':'No rooms available')+'</option>'+list.map(u=>{const ok=u.status==='available'||u.number===keep;return '<option value="'+u.number+'"'+(ok?'':' disabled')+(u.number===keep?' selected':'')+'>Room '+u.number+(ok?'':' - '+u.status.replace('_',' '))+'</option>';}).join('');if(keep){sel.value=keep;inp.value=keep;}}
const guestsById=@json($guests ?? []);
function bookingFormTidy(){document.getElementById('partialPaymentFields').style.display='none';document.getElementById('advanceReceiptName').textContent='No file selected';document.getElementById('bookingFullEdit').value='';document.getElementById('bookingStatusWrap').style.display='';document.getElementById('bookingReceiptNow').innerHTML='';}
function openBookingCreator(){const f=document.getElementById('bookingForm');f.reset();f.action='{{ url('/bookings') }}';document.getElementById('bookingMethod').value='';document.getElementById('bookingModalTitle').textContent='Add Reservation';bookingFormTidy();fillRoomUnits('');openModal('addBooking');}
function openBookingEditor(id){const b=data.find(x=>x.id===id);if(!b)return;const f=document.getElementById('bookingForm');f.reset();f.action='{{ url('/bookings') }}/'+b.id;document.getElementById('bookingMethod').value='PUT';document.getElementById('bookingModalTitle').textContent='Edit Reservation '+b.code;bookingFormTidy();
 const g=guestsById[b.guest_id]||{};['guest_name','cnic','request','duration','check_in','check_out','guests','price_per_night','extra_charges','status','source'].forEach(k=>{if(f.elements[k])f.elements[k].value=(b[k]??'')===null?'':(k==='check_in'||k==='check_out')?String(b[k]||'').slice(0,10):(b[k]??'');});
 ['phone','email','dob','gender','nationality','passport_no'].forEach(k=>{if(f.elements[k]&&g[k]!=null)f.elements[k].value=g[k];});
 if(f.elements.room_type){f.elements.room_type.value=b.room_type||'';fillRoomUnits(b.room_type||'',b.room_number);}
 /* Load everything the booking holds, so saving the form cannot blank a field it never showed. */
 let am=[];try{am=JSON.parse(b.amenities||'[]')||[];}catch(e){}
 f.querySelectorAll('input[name="amenities[]"]').forEach(c=>{c.checked=am.includes(c.value);});
 f.elements.amenity_notes.value=b.amenity_notes||'';
 const part=!!Number(b.partial_payment)&&Number(b.advance_amount)>0;
 f.elements.partial_payment.checked=part;f.elements.advance_amount.value=part?b.advance_amount:'';
 document.getElementById('partialPaymentFields').style.display=part?'block':'none';
 /* Status moves only through Confirm / Check-in / Check-out, which record the time. */
 document.getElementById('bookingStatusWrap').style.display='none';
 const rc=[[b.payment_proof_path,'payment receipt'],[b.advance_receipt_path,'advance receipt']].filter(x=>x[0]);
 document.getElementById('bookingReceiptNow').innerHTML=rc.length?'Attached now: '+rc.map(x=>`<a href="/${x[0]}" target="_blank" rel="noopener">View ${x[1]}</a>`).join(' · ')+'. A new upload replaces it.':'No receipt attached yet.';
 document.getElementById('bookingFullEdit').value='1';
 openModal('addBooking');}
/* Financials links here as /reservation?edit=ID to open a booking's form directly. */
document.addEventListener('DOMContentLoaded',()=>{const id=Number(new URLSearchParams(location.search).get('edit'));if(id&&CAN_MANAGE&&data.some(x=>x.id===id)){openBookingEditor(id);history.replaceState(null,'',location.pathname);}});
function fillRoomPrice(roomType){const rate=roomRates[roomType];if(rate!==undefined)document.getElementById('bookingPrice').value=rate;fillRoomUnits(roomType);}
const rsInitials=n=>String(n||'').split(' ').filter(Boolean).slice(0,2).map(w=>w[0].toUpperCase()).join('')||'?';
const trash='<svg viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2M6 6l1 14h10l1-14M10 11v6M14 11v6"/></svg>';
const fmtShort=d=>{if(!d)return '—';const p=String(d).slice(0,10).split('-');const M=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];return M[+p[1]-1]+' '+(+p[2])+', '+p[0];};
const fmt=d=>{if(!d)return'';const p=String(d).slice(0,10).split('-');const M=['January','February','March','April','May','June','July','August','September','October','November','December'];return M[+p[1]-1]+' '+(+p[2])+', '+p[0]};
const STL={pending:'Pending',confirmed:'Confirmed',checked_in:'Checked-In',checked_out:'Checked-Out'};
const NEXT={pending:['confirmed','Confirm'],confirmed:['checked_in','Check-In'],checked_in:['checked_out','Check-Out']};
const PAKISTAN_NOW=@json(now()->format('Y-m-d\\TH:i'));
function openStayStamp(id,status,code){const form=document.getElementById('stayStampForm');form.action='/bookings/'+id+'/status/'+status;const parts=PAKISTAN_NOW.split('T');document.getElementById('stayStampDate').value=parts[0];document.getElementById('stayStampTime').value=parts[1];document.getElementById('stayStampTitle').textContent=status==='checked_in'?'Record Check-In':'Record Check-Out';document.getElementById('stayStampBooking').textContent=code?'Reservation #'+code:'';openModal('stayStampModal');}
const mIcon={bed:'<svg viewBox="0 0 24 24"><path d="M3 18V8M3 14h18v4M21 14v-3a2 2 0 0 0-2-2h-8v5"/><path d="M5 11a2.5 2.5 0 0 1 5 0"/></svg>',cal:'<svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 10h18M8 2v4M16 2v4"/></svg>',moon:'<svg viewBox="0 0 24 24"><path d="M20 14.5A8 8 0 0 1 9.5 4a8 8 0 1 0 10.5 10.5z"/></svg>',chev:'<svg viewBox="0 0 24 24"><path d="m9 6 6 6-6 6"/></svg>'};
const MON=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
function mRange(ci,co){const a=ci?String(ci).slice(0,10).split('-'):null,b=co?String(co).slice(0,10).split('-'):null;const f=(p,y)=>MON[+p[1]-1]+' '+(+p[2])+(y?', '+p[0]:'');if(a&&b){if(a[0]===b[0]&&a[1]===b[1])return MON[+a[1]-1]+' '+(+a[2])+' \u2013 '+(+b[2])+', '+b[0];return f(a,a[0]!==b[0])+' \u2013 '+f(b,true);}if(a)return f(a,true);if(b)return f(b,true);return '';}
function mNights(b){const ci=Date.parse(String(b.check_in||'').slice(0,10)),co=Date.parse(String(b.check_out||'').slice(0,10));if(!isNaN(ci)&&!isNaN(co)&&co>ci){const n=Math.round((co-ci)/86400000);return n+(n===1?' night':' nights');}return b.duration||'';}
function mInitials(n){return String(n||'').split(' ').filter(Boolean).slice(0,2).map(w=>w[0].toUpperCase()).join('');}
let lastFiltered=[];
function renderMobile(list){
 const el=document.getElementById('mRows');if(!el)return;
 el.innerHTML=list.map((b,i)=>{
  const next=NEXT[b.status]?(b.status==='pending'?`<button class="mr-btn next" onclick="openPaymentProof(${b.id},'${b.code||''}')">Confirm</button>`:`<button class="mr-btn next" onclick="openStayStamp(${b.id},'${NEXT[b.status][0]}','${b.code||''}')">${NEXT[b.status][1]}</button>`):`<span class="mr-btn done" style="display:inline-flex;align-items:center">Done</span>`;
  const cancel=(IS_ADMIN&&(b.status==='pending'||b.status==='confirmed'))?`<button class="mr-btn cancel" onclick="if(confirm('Cancel this booking?'))post('/bookings/${b.id}','DELETE')">Cancel</button>`:'';
  const rcPath=b.payment_proof_path||b.advance_receipt_path;const proof=rcPath?`<a class="mr-eye" title="View payment receipt" href="/${rcPath}" target="_blank" rel="noopener">${proofIcon}</a>`:'';
  return `<article class="mr-card"><div class="mr-top"><span class="mr-av c${(i%4)+1}">${mInitials(b.guest_name)}</span><div class="mr-name"><b>${b.guest_name||''}</b><small>${b.code||''}</small></div><em class="mr-st ${b.status}">${STL[b.status]||b.status}</em><a class="mr-go" href="/guest-profile?id=${b.id}" aria-label="Open">${mIcon.chev}</a></div><div class="mr-meta"><span>${mIcon.bed}${b.room_label||((b.room_type||'')+' '+(b.room_number||''))}</span>${(b.check_in||b.check_out)?`<span>${mIcon.cal}<i>${mRange(b.check_in,b.check_out)}</i></span>`:''}<span>${mIcon.moon}${mNights(b)}</span></div><div class="mr-act"><button class="mr-eye" title="View guest profile" onclick="location.href='/guest-profile?id=${b.id}'">${eye}</button>${proof}${CAN_MANAGE?`<button class="mr-eye" title="Edit" onclick="openBookingEditor(${b.id})">${edit}</button>`:''}${next}${cancel}</div></article>`;
 }).join('')||'<div class="mr-empty">No reservations found</div>';
 const pg=document.getElementById('mPager'),st=(window.PGSTATE&&PGSTATE.res)||{page:1},pages=Math.max(1,Math.ceil(lastFiltered.length/8));
 if(pg)pg.innerHTML=pages>1?`<button ${st.page<=1?'disabled':''} onclick="mPage(-1)">\u2039 Prev</button><span>Page ${st.page} of ${pages}</span><button ${st.page>=pages?'disabled':''} onclick="mPage(1)">Next \u203a</button>`:'';
}
function mPage(d){PGSTATE.res.page+=d;paginateRender('res',lastFiltered,8,render);window.scrollTo({top:0,behavior:'smooth'});}
function render(list){
 renderMobile(list);
 document.getElementById('rows').innerHTML=list.map((b,i)=>{
  const avatar = `<span class="rs-av c${(i%4)+1}">${rsInitials(b.guest_name)}</span>`;
  const label = {pending:'Pending',confirmed:'Confirmed',checked_in:'Checked-In',checked_out:'Checked-Out'}[b.status]||b.status;
  return `<div class="trow" style="cursor:pointer" onclick="location.href='/guest-profile?id=${b.id}'">
   <span class="rs-guest">${avatar}<span><b>${b.guest_name||''}</b><small>#${b.code||''}</small></span></span>
   <span class="rs-room"><b>${b.room_type||''}</b><small>${b.room_number?('Room '+String(b.room_number).replace(/^Room /i,'')):''}</small></span>
   <span>${b.guests||2} ${(b.guests||2)==1?'Adult':'Adults'}</span>
   <span>${b.duration?(/night/i.test(b.duration)?b.duration:b.duration+' Nights'):'—'}</span>
   <span class="rs-date"><b>${fmtShort(b.arrival_date)}</b>${b.arrival_date?`<small${b.arrival_is_actual?' class="rs-real" title="Actual check-in"':''}>${b.arrival_time}</small>`:''}</span>
   <span class="rs-date"><b>${fmtShort(b.departure_date)}</b>${b.departure_date?`<small${b.departure_is_actual?' class="rs-real" title="Actual check-out"':''}>${b.departure_time}</small>`:''}</span>
   <span><em class="rs-status ${b.status}"><i></i>${label}</em></span>
   <span class="act" onclick="event.stopPropagation()">
     <button class="rs-ib" title="View guest profile" onclick="location.href='/guest-profile?id=${b.id}'">${eye}</button>
     ${(b.payment_proof_path||b.advance_receipt_path)?`<a class="rs-ib" title="View payment receipt" href="/${b.payment_proof_path||b.advance_receipt_path}" target="_blank" rel="noopener">${proofIcon}</a>`:''}
     ${CAN_MANAGE?`<button class="rs-ib" title="Edit reservation" onclick="openBookingEditor(${b.id})">${edit}</button>`:''}
     ${NEXT[b.status]?(b.status==='pending'?`<button class="rs-ib next" title="Confirm reservation" onclick="openPaymentProof(${b.id},'${b.code||''}')">Confirm</button>`:`<button class="rs-ib next" title="${NEXT[b.status][1]}" onclick="openStayStamp(${b.id},'${NEXT[b.status][0]}','${b.code||''}')">${NEXT[b.status][1]}</button>`):''}
     ${(IS_ADMIN&&(b.status==='pending'||b.status==='confirmed'))?`<button class="rs-ib del" title="Cancel booking" onclick="if(confirm('Cancel this booking?'))post('/bookings/${b.id}','DELETE')">${trash}</button>`:''}
   </span></div>`;
 }).join('')||'<div class="trow"><span>No results</span></div>';
}
function applyFilters(){
 const q=(document.getElementById('fSearch').value||'').toLowerCase();
 const st=document.getElementById('fStatus').value;
 const from=document.getElementById('fDateStart').value;
 const to=document.getElementById('fDateEnd').value;
 pgReset('res');lastFiltered=sortList('res',data.filter(b=>{const matchesText=!q||[b.guest_name,b.code,b.room_label,b.request].join(' ').toLowerCase().includes(q);const matchesStatus=!st||b.status===st;const matchesDate=(!from||String(b.check_out||'')>=from)&&(!to||String(b.check_in||'')<=to);return matchesText&&matchesStatus&&matchesDate;}));paginateRender('res',lastFiltered,8,render);
}
document.getElementById('fSearch').addEventListener('input',applyFilters);
document.getElementById('fStatus').addEventListener('change',applyFilters);
document.getElementById('fDateStart').addEventListener('change',applyFilters);
document.getElementById('fDateEnd').addEventListener('change',applyFilters);
/* Phone filters mirror into the desktop inputs so one applyFilters() serves both layouts. */
[['mSearch','fSearch','input'],['mStatus','fStatus','change'],['mDateStart','fDateStart','change'],['mDateEnd','fDateEnd','change']].forEach(([m,d,ev])=>{const me=document.getElementById(m),de=document.getElementById(d);if(me&&de)me.addEventListener(ev,()=>{de.value=me.value;applyFilters();});});
applyFilters();
(function(){const q=new URLSearchParams(location.search).get('q');if(q){['fSearch','mSearch'].forEach(i=>{const el=document.getElementById(i);if(el)el.value=q;});applyFilters();}})();
</script>
<style>.modal .rc-now{margin-top:7px;font-size:12px;color:#68756d}.modal .rc-now a{color:#1e4a36;font-weight:700}</style>
<div class="modal-ov" id="addBooking" data-sticky><div class="modal wide"><h3 id="bookingModalTitle">Add Reservation</h3><form id="bookingForm" method="POST" action="{{ url('/bookings') }}" enctype="multipart/form-data">@csrf<input type="hidden" name="_method" id="bookingMethod" value=""><input type="hidden" name="full_edit" id="bookingFullEdit" value="">
@if($errors->any())<div style="margin:0 0 12px;padding:10px 12px;border-radius:9px;background:#fff0f0;color:#b3352f;font-size:13px">Please check the highlighted details below. @foreach($errors->all() as $error)<div style="margin-top:3px">• {{ $error }}</div>@endforeach</div>@endif
<div class="msec">Guest details</div>
<div class="mrow"><div><label>Guest Name</label><input name="guest_name" required></div><div><label>CNIC</label><input name="cnic" inputmode="numeric" maxlength="20" placeholder="12345-1234567-1"></div></div>
<div class="mrow"><div><label>Phone Number</label><input name="phone" type="tel" placeholder="+92 300 0000000"></div><div><label>Email Address</label><input name="email" type="email" placeholder="guest@example.com"></div></div>
<div class="mrow"><div><label>Date of Birth</label><input name="dob" type="date"></div><div><label>Gender</label><select name="gender"><option value="">Select gender</option><option>Male</option><option>Female</option><option>Other</option></select></div></div>
<div class="mrow"><div><label>Nationality</label><input name="nationality" placeholder="Pakistani"></div><div><label>Passport No.</label><input name="passport_no" placeholder="Optional"></div></div>
<div class="msec">Stay details</div>
<div class="mrow"><div><label>Room Type</label><select name="room_type" onchange="fillRoomPrice(this.value)" required><option value="">Select room type</option>@foreach($rooms->pluck('name')->filter()->unique()->values() as $roomType)<option value="{{ $roomType }}">{{ $roomType }}</option>@endforeach</select></div><div><label>Room Number</label><select name="room_number" id="bookingRoomNumber"><option value="">Select room type first</option></select><input name="room_number" id="bookingRoomInput" placeholder="101" style="display:none" disabled></div></div>
<div class="amenity-box"><h4>Room Features, Facilities &amp; Amenities</h4><div class="amenity-grid"><label><input type="checkbox" name="amenities[]" value="Free Wi-Fi">Free Wi-Fi</label><label><input type="checkbox" name="amenities[]" value="Air Conditioning">Air Conditioning</label><label><input type="checkbox" name="amenities[]" value="Smart TV">Smart TV</label><label><input type="checkbox" name="amenities[]" value="Mini Fridge">Mini Fridge</label><label><input type="checkbox" name="amenities[]" value="Coffee / Tea Maker">Coffee / Tea Maker</label><label><input type="checkbox" name="amenities[]" value="In-room Safe">In-room Safe</label><label><input type="checkbox" name="amenities[]" value="24-hour Room Service">24-hour Room Service</label><label><input type="checkbox" name="amenities[]" value="Balcony / City View">Balcony / City View</label></div><label style="margin-top:10px">Other facility or amenity</label><input name="amenity_notes" placeholder="e.g. Extra bed, hairdryer, work desk"></div>
<div class="mrow three"><div><label>Guests</label><input type="number" name="guests" value="2" min="1" max="20"></div><div><label>Request</label><input name="request" placeholder="None"></div><div><label>Duration</label><input name="duration" placeholder="Set from the dates" readonly style="background:#f4f8f5;color:#55605a"></div></div>
<div class="mrow"><div><label>Booking Source</label><select name="source"><option>Direct Booking</option><option>Booking.com</option><option>Agoda</option><option>Airbnb</option><option>Hotels.com</option><option>Walk-in</option><option>Phone</option><option>Other</option></select></div><div id="bookingStatusWrap"><label>Status</label><select name="status"><option value="pending">Pending</option><option value="confirmed">Confirmed</option></select></div></div>
<div class="mrow"><div><label>Check In *</label><input type="date" name="check_in" required></div><div><label>Check Out *</label><input type="date" name="check_out" required></div></div>
<div class="msec">Payment</div>
<div class="mrow"><div><label>Price / night</label><input id="bookingPrice" type="number" name="price_per_night" min="1" required placeholder="Select a room type"></div><div><label>Extra Charges (PKR)</label><input type="number" name="extra_charges" value="0" min="0" placeholder="0 if none"></div></div>
<label class="partial-payment-toggle"><input type="checkbox" name="partial_payment" value="1" onchange="document.getElementById('partialPaymentFields').style.display=this.checked?'block':'none'"><span><b>Partial Payment</b><small>Record the advance payment received from the guest</small></span></label>
<div id="partialPaymentFields" class="partial-payment-fields">
<label>Advance Amount (PKR)</label><input type="number" name="advance_amount" min="0" placeholder="Enter advance amount">
</div>
{{-- The receipt is offered on every reservation, not only part-paid ones. --}}
<label style="margin-top:14px!important">Payment Receipt / Picture <small style="font-weight:400;color:#8a927c">optional</small></label><label class="receipt-upload"><span>Upload receipt</span><small id="advanceReceiptName">No file selected</small><input type="file" name="payment_receipt" accept="image/*,.pdf" onchange="document.getElementById('advanceReceiptName').textContent=this.files[0]?this.files[0].name:'No file selected'"></label>
<div id="bookingReceiptNow" class="rc-now"></div>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('addBooking')">Cancel</button><button class="mbtn save">Save</button></div>
</form></div></div>
<style>
#paymentProofModal .payment-proof-card{width:520px;border-radius:20px;overflow:hidden}
#paymentProofModal .payment-proof-title{position:static;display:flex;align-items:center;gap:12px;margin:0;padding:23px 26px 17px;border:0;background:linear-gradient(135deg,#f5fbf7,#fff);font-size:22px;color:#182332}
.payment-proof-icon{width:42px;height:42px;border-radius:13px;background:#e4f4e9;color:#287452;display:grid;place-items:center;flex:0 0 42px}.payment-proof-icon svg{width:22px;height:22px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
#paymentProofModal form{padding:0 26px 0}.proof-intro{margin:0;padding:0 0 18px;color:#687076;font-size:14px;line-height:1.55}.proof-ref{color:#2f6b4f;font-weight:800;white-space:nowrap}
.proof-label{display:flex!important;align-items:center;justify-content:space-between;color:#27333d!important;font-weight:800;font-size:13px!important;margin:0 0 8px!important}.proof-label small{color:#a33c3c;font-size:11px;font-weight:700}
.proof-drop{display:flex!important;align-items:center;gap:13px;min-height:86px;margin:0!important;padding:14px!important;border:1.5px dashed #9ec7aa!important;border-radius:14px!important;background:#f9fdf9!important;color:#294e39!important;cursor:pointer;transition:.18s ease}.proof-drop:hover{border-color:#2f8059!important;background:#f1fbf3!important;transform:translateY(-1px)}.proof-drop.has-file{border-style:solid!important;border-color:#77af89!important;background:#eef9f0!important}
.proof-drop-icon{width:40px;height:40px;border-radius:11px;background:#e1f2e6;color:#2f8059;display:grid;place-items:center;flex:0 0 40px}.proof-drop-icon svg{width:21px;height:21px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.proof-drop-text{min-width:0;display:block!important;color:#294e39;font-size:13px!important;font-weight:800!important}.proof-drop-text small{display:block;margin:4px 0 0;color:#7a8c80;font-size:11.5px;font-weight:500;white-space:normal;overflow:visible;text-overflow:clip}.proof-drop input{display:none!important}
.proof-note{display:flex;align-items:flex-start;gap:8px;margin:13px 0 1px;color:#78827b;font-size:11.5px;line-height:1.45}.proof-note svg{width:15px;height:15px;margin-top:1px;flex:0 0 15px;fill:none;stroke:#548062;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
#paymentProofModal .mact{margin:20px -26px 0;padding:15px 26px 18px;gap:10px;background:#fff}#paymentProofModal .mbtn{height:44px;border-radius:11px;padding:0 19px}#paymentProofModal .mbtn.save{background:#287452;color:#fff;box-shadow:0 6px 14px rgba(40,116,82,.18)}#paymentProofModal .mbtn.save:hover{background:#1e6243}
@media(max-width:640px){#paymentProofModal .payment-proof-title{padding:19px 18px 14px;font-size:19px}#paymentProofModal form{padding:0 18px}#paymentProofModal .mact{margin:20px -18px 0;padding:13px 18px 16px}.proof-drop{min-height:80px!important}}
</style>
<div class="modal-ov" id="paymentProofModal"><div class="modal payment-proof-card"><h3 class="payment-proof-title"><span class="payment-proof-icon"><svg viewBox="0 0 24 24"><path d="M12 3v12"/><path d="m7 10 5 5 5-5"/><path d="M5 21h14"/></svg></span>Confirm Reservation</h3><form id="paymentProofForm" method="POST" enctype="multipart/form-data">@csrf
<p class="proof-intro">Attach the guest's payment proof to confirm <span class="proof-ref" id="paymentProofCode"></span>.</p>
<label class="proof-label">Payment proof <small>REQUIRED</small></label><label class="proof-drop" id="paymentProofDrop"><span class="proof-drop-icon"><svg viewBox="0 0 24 24"><path d="M12 16V4"/><path d="m7 9 5-5 5 5"/><path d="M5 20h14"/></svg></span><span class="proof-drop-text" id="paymentProofName">Upload payment proof<small>JPG, PNG, WEBP or PDF · maximum 5 MB</small></span><input id="paymentProofInput" type="file" name="payment_proof" accept="image/jpeg,image/png,image/webp,application/pdf" required onchange="setPaymentProofName(this)"></label>
<p class="proof-note"><svg viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>Your uploaded file is stored securely with this reservation.</p>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('paymentProofModal')">Cancel</button><button class="mbtn save">Attach &amp; Confirm</button></div>
</form></div></div>
<script>
function setPaymentProofName(input){const name=input.files[0]?.name||'';const el=document.getElementById('paymentProofName'),drop=document.getElementById('paymentProofDrop');el.innerHTML=name?`<span>${name}</span><small>Payment proof ready to attach</small>`:'Upload payment proof<small>JPG, PNG, WEBP or PDF · maximum 5 MB</small>';drop.classList.toggle('has-file',Boolean(name));}
function openPaymentProof(id,code){const form=document.getElementById('paymentProofForm');form.action='/bookings/'+id+'/confirm';document.getElementById('paymentProofCode').textContent=code?'#'+code:'this reservation';const input=document.getElementById('paymentProofInput');input.value='';setPaymentProofName(input);openModal('paymentProofModal');}
</script>
<div class="modal-ov" id="stayStampModal"><div class="modal"><h3 id="stayStampTitle">Record Check-In</h3><form id="stayStampForm" method="POST">@csrf
<p style="margin:10px 0 14px;color:#687076;font-size:13px" id="stayStampBooking"></p>
<div class="mrow"><div><label for="stayStampDate">Date</label><input id="stayStampDate" name="actual_date" type="date" required></div><div><label for="stayStampTime">Time</label><input id="stayStampTime" name="actual_time" type="time" required></div></div>
<p style="margin:10px 0 0;color:#78827b;font-size:12px">Time Pakistan Standard Time (PKT) ke mutabiq save hoga.</p>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('stayStampModal')">Cancel</button><button class="mbtn save">Save</button></div>
</form></div></div>
@if($errors->any())<script>document.addEventListener('DOMContentLoaded',function(){openModal('addBooking');});

</script>@endif
<script>
// Duration mirrors the two dates so the form can never save a mismatched night count.
(function(){
  function sync(form){
    const ci=form.querySelector('[name="check_in"]'), co=form.querySelector('[name="check_out"]'), du=form.querySelector('[name="duration"]');
    if(!ci||!co||!du) return;
    const a=new Date(ci.value), b=new Date(co.value);
    if(!ci.value||!co.value||isNaN(a)||isNaN(b)||b<=a){ du.value=''; return; }
    const n=Math.round((b-a)/86400000);
    du.value=n+(n===1?' Night':' Nights');
  }
  document.addEventListener('change',e=>{
    if(e.target.name==='check_in'||e.target.name==='check_out'){
      const f=e.target.closest('form'); if(f) sync(f);
    }
  });
  document.querySelectorAll('form').forEach(sync);
})();
</script>
</body>
</html>
