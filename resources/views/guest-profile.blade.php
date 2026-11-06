<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Guest Profile - Indus Resort Restaurant</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--lime:#e8fb82;--mint:#d2f3e4;--ink:#151515;--muted:#8f8f8f;--bg:#f6f6f5;--line:#eee;--red:#ff4e52;--label:#9a9a9a}
*{box-sizing:border-box}
body{margin:0;display:flex;background:var(--bg);font-family:Lato,Arial,sans-serif;color:var(--ink);zoom:.9}
@media(min-width:1301px) and (max-width:1700px){body{zoom:.82}}
@media(min-width:1101px) and (max-width:1300px){body{zoom:.72}}
@media(min-width:701px) and (max-width:1100px){body{zoom:.62}}
.main{flex:1;min-width:0;padding:26px 30px 16px}
.top{display:flex;justify-content:space-between;align-items:center;margin-bottom:22px}
.tl{display:flex;align-items:center;gap:14px}
.back{width:42px;height:42px;border:1px solid #e8e8e8;background:#fff;border-radius:11px;display:grid;place-items:center;cursor:pointer}
.back svg{width:20px;height:20px;fill:none;stroke:#333;stroke-width:2}
.tl h1{font-size:28px;font-weight:800;margin:0;line-height:1.1}
.tl .bc{font-size:13px;color:var(--label);margin-top:3px}
.tl .bc a{color:#8bbf3a;text-decoration:none}
.profile{display:flex;align-items:center;gap:13px}
.avatar{width:46px;height:46px;border-radius:50%;background:var(--lime);display:grid;place-items:center;font-weight:700;font-size:15px}
.pinfo b{display:block;font-size:16px;line-height:1.1}.pinfo small{color:#888;font-size:13px}
.tools{display:flex;gap:10px;margin-left:14px}
.tool{width:44px;height:44px;border:1px solid #e8e8e8;background:#fff;border-radius:11px;display:grid;place-items:center;cursor:pointer;position:relative}
.tool svg{width:20px;height:20px;fill:none;stroke:#4a4a4a;stroke-width:1.8}
.tool.bell:after{content:'';position:absolute;top:9px;right:11px;width:8px;height:8px;border-radius:50%;background:var(--red);border:2px solid #fff}
.gtop{display:grid;grid-template-columns:1fr 1.75fr 1fr;gap:20px;margin-bottom:20px;align-items:start}
.card{background:#fff;border-radius:18px;padding:22px}
.chd{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px}
.chd h2{font-size:18px;margin:0}
.chd .dots{color:#c4c4c4;font-size:18px}
.chd .vd{color:#333;font-size:14px;text-decoration:none}
.who{display:flex;align-items:center;gap:16px;margin-bottom:18px}
.who img,.who .ph{width:70px;height:70px;border-radius:50%;object-fit:cover;background:var(--lime);display:grid;place-items:center;font-weight:800;font-size:22px}
.who b{font-size:24px;display:block}
.who small{color:var(--label);font-size:14px}
.contact{display:grid;gap:12px;padding-bottom:18px;border-bottom:1px solid var(--line)}
.contact div{display:flex;align-items:center;gap:12px;font-size:14px}
.contact .ci{width:34px;height:34px;border-radius:9px;background:var(--mint);display:grid;place-items:center;flex:0 0 34px}
.contact .ci svg{width:17px;height:17px;fill:none;stroke:#3f8b6d;stroke-width:1.8}
.sec{padding:18px 0;border-bottom:1px solid var(--line)}
.sec:last-child{border-bottom:0;padding-bottom:0}
.sec h3{font-size:16px;margin:0 0 14px}
.pairs{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.pair .l{color:var(--label);font-size:13px;margin-bottom:4px}
.pair .v{font-size:15px}
.chip{display:inline-block;background:var(--lime);color:#2f3a0c;border-radius:8px;padding:6px 12px;font-size:14px;font-weight:600}
/* booking info */
.bconf{display:inline-flex;align-items:center;gap:8px;background:var(--mint);color:#2f6b4f;border-radius:8px;padding:6px 12px;font-size:14px;font-weight:600;margin-bottom:14px}
.bconf svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:2.5}
.bid{font-size:26px;font-weight:800;margin:0 0 4px}
.bdate{color:var(--label);font-size:14px;margin-bottom:20px}
.brow{display:grid;grid-template-columns:1fr 1fr 1fr;gap:18px;margin-bottom:20px}
.notes-l{color:var(--label);font-size:13px;margin-bottom:5px}
.divider{border-top:1px solid var(--line);margin:6px 0 20px}
.binfo-btns{display:flex;justify-content:flex-end;gap:12px;margin-top:20px}
.bbtn{height:40px;border:0;border-radius:9px;padding:0 22px;font-size:14px;font-weight:700;cursor:pointer}
.bbtn.edit{background:#f2f2f2;color:#333}
.bbtn.cancel{background:#ffe1e1;color:#b3352f}
.amen{display:grid;gap:9px}
.amen div{display:flex;align-items:center;gap:9px;font-size:14px}
.amen svg{width:15px;height:15px;fill:none;stroke:#5aa17e;stroke-width:2.5}
/* room info */
.roominfo{background:#fbfbfb}
.rimg{width:100%;height:190px;object-fit:cover;border-radius:12px;margin-bottom:16px}
.pair .sub.real{color:#2f6b4f;font-weight:600}
.gstats{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:12px}
.gstats div{background:#f4f8f5;border-radius:11px;padding:11px 10px;text-align:center}
.gstats b{display:block;font-size:19px;line-height:1.2;color:#123527}
.gstats small{display:block;color:var(--label);font-size:11.5px;margin-top:3px}
.gsince{color:var(--label);font-size:12.5px}
.rname{font-size:15px;font-weight:700;margin:0 0 12px;color:#123527}
.rname small{display:block;color:var(--label);font-size:12.5px;font-weight:500;margin-top:3px}
.bbtn.soft{background:#e6f4ea;color:#1e4a36}
.rspecs{display:flex;flex-wrap:wrap;gap:10px 16px;color:#555;font-size:13.5px;padding-bottom:16px;border-bottom:1px solid var(--line)}
.rspecs span{display:inline-flex;align-items:center;gap:7px}
.rspecs svg{width:17px;height:17px;fill:none;stroke:#777;stroke-width:1.7}
.psum{display:flex;align-items:center;gap:10px;margin:18px 0 14px}
.psum h3{font-size:17px;margin:0}
.psum .paid,.psum .unpaid{border-radius:7px;padding:3px 10px;font-size:12px;font-weight:700}
.psum .paid{background:var(--lime);color:#2f3a0c}
.psum .unpaid{background:#ffe1e1;color:#b3352f}
.psum .partial{background:#fff1c8;color:#886300;border-radius:7px;padding:3px 10px;font-size:12px;font-weight:700}
.pline{display:flex;justify-content:space-between;font-size:14px;color:#555;margin-bottom:12px}
.ptotal{display:flex;justify-content:space-between;font-size:16px;font-weight:800;padding-top:12px;border-top:1px solid var(--line);margin-bottom:16px}
.partial-summary{margin:0 0 16px;padding:12px;border-radius:10px;background:#fffaf0;border:1px solid #f2e2ad}.partial-summary h4{margin:0 0 9px;font-size:13px;color:#886300}.partial-summary .pline{margin-bottom:7px}.partial-summary .pline:last-child{margin-bottom:0;font-weight:800;color:#2f3a0c}
.pp-btns{display:flex;flex-wrap:wrap;gap:6px;justify-content:flex-end}
.payment-proof-card{display:flex;align-items:center;justify-content:space-between;gap:14px;margin:14px 0 16px;padding:13px 16px;border:1px solid #cce5d6;border-radius:14px;background:linear-gradient(135deg,#f4fbf6 0%,#ffffff 100%);box-shadow:0 2px 10px rgba(32,85,57,.05);transition:all .2s ease}.payment-proof-card:hover{border-color:#b5dac2;box-shadow:0 4px 16px rgba(32,85,57,.09);transform:translateY(-1px)}.payment-proof-card .pp-left{display:flex;align-items:center;gap:12px;min-width:0}.payment-proof-card .pp-icon{width:42px;height:42px;border-radius:11px;background:#e2f4ea;border:1px solid #c6ebd5;color:#1f6b47;display:grid;place-items:center;flex:0 0 42px;box-shadow:0 2px 6px rgba(31,107,71,.08)}.payment-proof-card .pp-icon svg{width:20px;height:20px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}.payment-proof-card .pp-meta{min-width:0}.payment-proof-card .pp-head{display:flex;align-items:center;gap:7px}.payment-proof-card .pp-title{font-size:14px;font-weight:800;color:#123527;letter-spacing:-.01em}.payment-proof-card .pp-badge{display:inline-flex;align-items:center;gap:3px;background:#d7f4e3;color:#17653c;font-size:10.5px;font-weight:700;padding:2px 7px;border-radius:6px;letter-spacing:.02em;line-height:1.2}.payment-proof-card .pp-badge svg{width:11px;height:11px;fill:none;stroke:currentColor;stroke-width:2.8;stroke-linecap:round;stroke-linejoin:round}.payment-proof-card .pp-desc{display:block;margin-top:3px;color:#60756a;font-size:12px;font-weight:500;line-height:1.35}.payment-proof-card .pp-btn{display:inline-flex;align-items:center;gap:7px;flex:0 0 auto;border-radius:10px;background:#1e6c48;color:#fff;padding:9px 15px;text-decoration:none;font-size:13px;font-weight:700;box-shadow:0 3px 10px rgba(30,108,72,.22);transition:all .18s ease;white-space:nowrap}.payment-proof-card .pp-btn:hover{background:#155536;box-shadow:0 5px 14px rgba(30,108,72,.32);transform:translateY(-1px);color:#fff}.payment-proof-card .pp-btn svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:2.2;stroke-linecap:round;stroke-linejoin:round}@media(max-width:480px){.payment-proof-card{flex-direction:column;align-items:stretch;gap:12px;padding:12px 14px}.payment-proof-card .pp-btn{justify-content:center;width:100%;padding:10px 14px}}
.pnote-l{color:var(--label);font-size:13px;margin-bottom:5px}
.pnote{font-size:13px;color:#555;line-height:1.5}
/* history */
.hhead{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;gap:12px;flex-wrap:wrap}
.hhead h2{font-size:20px;margin:0}
.hh-r{display:flex;gap:12px;align-items:center}
.searchbox{position:relative}
.searchbox>svg{position:absolute;left:15px;top:50%;transform:translateY(-50%);width:18px;height:18px;fill:none;stroke:#b0b0b0;stroke-width:1.8}
.search{height:44px;width:240px;border:0;border-radius:11px;background:#f4f4f4;padding:0 16px 0 42px;font-size:14px;color:#333;font-family:inherit}
.search::placeholder{color:#b0b0b0}
.pill{height:44px;border:0;border-radius:11px;padding:0 16px;display:inline-flex;align-items:center;gap:9px;font-size:15px;background:#f4f4f4;color:#333;cursor:pointer;white-space:nowrap}
.pill svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.8}
.tbl{width:100%;overflow-x:auto}
.thead,.trow{display:grid;grid-template-columns:.8fr 1.1fr 1.2fr 1fr 1fr 1.2fr 1.2fr .9fr .4fr;align-items:center;min-width:1050px}
.thead{background:#eefaf3;border-radius:12px;padding:16px 22px;color:#8a8a8a;font-size:15px;font-weight:600}
.thead span{display:inline-flex;align-items:center;gap:6px}
.thead svg{width:12px;height:12px;fill:none;stroke:#b5b5b5;stroke-width:2}
.trow{padding:14px 22px;border-bottom:1px solid var(--line);font-size:15px}
.trow:last-child{border-bottom:0}
.trow img{width:56px;height:44px;border-radius:9px;object-fit:cover}
.rt{display:inline-flex;align-items:center;padding:5px 12px;border-radius:8px;font-size:13px;font-weight:600;background:var(--lime);color:#2f3a0c;width:max-content}
.sub{color:var(--label);font-size:13px}
.dotbtn{border:0;background:none;color:#c4c4c4;font-size:18px;cursor:pointer}
footer{display:flex;justify-content:space-between;align-items:center;padding:20px 6px 8px;color:#9a9a9a;font-size:14px;flex-wrap:wrap;gap:14px}
.flinks{display:flex;gap:26px}.flinks a{color:#9a9a9a;text-decoration:none}.flinks span:first-child{color:#666}
.fsoc{display:flex;gap:16px;align-items:center}.fsoc a{color:#c2c2c2}.fsoc svg{width:18px;height:18px;fill:currentColor}
@media(max-width:1200px){.gtop{grid-template-columns:1fr}}
@media(max-width:700px){body{zoom:1}.main{padding:18px 14px}.tl h1{font-size:22px}.profile .pinfo,.tools{display:none}.brow,.pairs{grid-template-columns:1fr}footer{flex-direction:column;align-items:flex-start}}
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
 /* The amenity list used to run as one tall column and stretched the middle card
    far past the Room Info card beside it. Two columns keep the three cards level. */
 .amen{grid-template-columns:repeat(2,minmax(0,1fr));gap:10px 22px}
 .amen div{font-size:13.5px}
 .amen svg{width:14px;height:14px}
 .gtop{align-items:stretch}
 .gtop>.card{display:flex;flex-direction:column}
 .binfo-btns{margin-top:auto;padding-top:18px}
 .brow{margin-bottom:16px}
 .divider{margin:2px 0 16px}
 @media(min-width:1500px){.amen{grid-template-columns:repeat(3,minmax(0,1fr))}}
}
</style>
<style>
/* ===== Phone booking details (Figma clone). Only on screens up to 768px; desktop layout untouched. ===== */
.m-gp{display:none}
@media(max-width:768px){
    body{zoom:1!important;background:#eef3f1!important;display:block!important}
    .main{padding:10px 16px 40px!important}
    .main>*:not(.m-gp){display:none!important}
    .app-menu-toggle{display:none!important}
    .app-sidebar .app-menu{top:70px!important}
    .m-gp{display:block;font-family:Lato,Arial,sans-serif;color:#111}
    .gp-top{display:grid;grid-template-columns:44px minmax(0,1fr) 44px;align-items:center;gap:8px;padding:4px 0 14px}
    .gp-top h1{margin:0;font-size:20px;font-weight:800;text-align:center;line-height:1.15}
    .gp-top p{margin:2px 0 0;font-size:13px;color:#666;text-align:center}
    .gp-sq{width:44px;height:44px;border:0;border-radius:12px;background:#fff;display:grid;place-items:center;color:#222;cursor:pointer;box-shadow:0 1px 4px rgba(0,0,0,.06)}
    .gp-sq svg{width:20px;height:20px;fill:none;stroke:currentColor;stroke-width:2.2;stroke-linecap:round;stroke-linejoin:round}
    .gp-card{background:#fff;border-radius:18px;padding:16px;margin-bottom:12px;box-shadow:0 4px 18px rgba(16,24,40,.05);border:1px solid #eef0ee}
    .gp-card.guest{background:#dff3ea;border-color:#d3ece0}
    .gp-who{display:grid;grid-template-columns:auto minmax(0,1fr) auto;gap:12px;align-items:start}
    .gp-av{width:64px;height:64px;border-radius:50%;background:#d9f26a;color:#1f3a10;display:grid;place-items:center;font-weight:800;font-size:20px}
    .gp-who b{display:block;font-size:20px;font-weight:800;line-height:1.1;padding-top:4px;word-break:break-word}
    .gp-who small{display:block;font-size:14px;color:#555;margin-top:4px;word-break:break-all}
    .gp-cta{display:grid;gap:8px}
    .gp-cta a{display:inline-flex;align-items:center;justify-content:center;gap:7px;height:38px;padding:0 12px;border-radius:12px;font:700 13px Lato,Arial,sans-serif;text-decoration:none;color:#123;white-space:nowrap}
    .gp-cta a.call{background:#b8ebcf}.gp-cta a.msg{background:#f3f7f5}
    .gp-cta svg{width:17px;height:17px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .gp-contact{display:flex;flex-wrap:wrap;gap:8px 18px;margin:14px 0 0;padding-bottom:14px;border-bottom:1px solid #c9e3d6;font-size:14px;color:#222}
    .gp-contact span{display:inline-flex;align-items:center;gap:7px;min-width:0;word-break:break-all}
    .gp-contact svg{width:17px;height:17px;flex:0 0 17px;fill:none;stroke:#1f7a4d;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .gp-facts{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));margin-top:14px;gap:12px 0}
    @media(max-width:419px){.gp-facts{grid-template-columns:1fr 1fr}.gp-facts div:nth-child(3){padding-left:0;border-left:0}.gp-who{grid-template-columns:auto minmax(0,1fr)}.gp-cta{grid-column:1 / -1;grid-template-columns:1fr 1fr}}
    .gp-facts div{padding:0 10px;border-left:1px solid #c9e3d6;min-width:0}
    .gp-facts div:first-child{padding-left:0;border-left:0}
    .gp-facts small{display:block;font-size:12px;color:#555;margin-bottom:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .gp-facts b{display:block;font-size:14px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .gp-h{display:flex;align-items:center;gap:10px;margin-bottom:14px}
    .gp-h .ic{width:40px;height:40px;border-radius:11px;display:grid;place-items:center;flex:0 0 40px}
    .gp-h .ic svg{width:20px;height:20px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .gp-h .ic.mint{background:#d9f5e5;color:#1f7a4d}.gp-h .ic.blue{background:#dfebfb;color:#1e4f8f}.gp-h .ic.gold{background:#fdf3d2;color:#8a6200}
    .gp-h h2{margin:0;font-size:17px;font-weight:800;flex:1;min-width:0}
    .gp-pill{display:inline-flex;align-items:center;gap:5px;padding:6px 11px;border-radius:14px;font-size:12px;font-weight:700;white-space:nowrap}
    .gp-pill svg{width:14px;height:14px;fill:none;stroke:currentColor;stroke-width:3;stroke-linecap:round;stroke-linejoin:round}
    .gp-pill.confirmed,.gp-pill.paid{background:#c9efd9;color:#1f5f3f}.gp-pill.pending,.gp-pill.unpaid{background:#ffe1e1;color:#c0392b}.gp-pill.checked_in{background:#e8fb82;color:#3d4a10}.gp-pill.checked_out{background:#ececec;color:#666}.gp-pill.partial{background:#fdf3d2;color:#8a6200}
    .gp-pill .gp-long{margin-right:-5px}@media(max-width:419px){.gp-pill .gp-long{display:none}}
    .gp-link{display:inline-flex;align-items:center;gap:4px;color:#1d6ae5;font-size:14px;font-weight:700;text-decoration:none;white-space:nowrap}
    .gp-link svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:2.4;stroke-linecap:round;stroke-linejoin:round}
    .gp-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px 0}
    .gp-grid div{padding:0 10px;border-left:1px solid #e6e6e6;min-width:0}
    .gp-grid div:nth-child(3n+1){padding-left:0;border-left:0}
    .gp-grid small{display:block;font-size:12px;color:#666;margin-bottom:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .gp-grid b{display:block;font-size:14px;font-weight:600;word-break:break-word}
    .gp-grid i{display:block;font-style:normal;font-size:12px;color:#777;margin-top:3px}
    .gp-notes{margin-top:16px;padding-top:14px;border-top:1px solid #e6e6e6}
    .gp-notes small{display:block;font-size:13px;color:#666;margin-bottom:4px}.gp-notes b{font-size:15px;font-weight:600}
    .gp-room{display:grid;grid-template-columns:122px minmax(0,1fr);gap:12px}
    .gp-room img{width:122px;height:100%;min-height:150px;border-radius:12px;object-fit:cover;background:#e9e9e9}
    .gp-room b{display:block;font-size:17px;font-weight:800}
    .gp-specs{display:flex;flex-wrap:wrap;gap:4px 12px;margin-top:8px;font-size:13px;color:#333}
    .gp-specs span{display:inline-flex;align-items:center;gap:5px;white-space:nowrap}
    .gp-specs svg{width:15px;height:15px;flex:0 0 15px;fill:none;stroke:#333;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .gp-desc{margin:8px 0 0;font-size:13px;line-height:1.4;color:#555;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .gp-chips{display:flex;flex-wrap:wrap;gap:6px;margin-top:10px}
    .gp-chips span{display:inline-flex;align-items:center;gap:5px;height:30px;padding:0 10px;border-radius:9px;background:#f1f3f2;font-size:12px;font-weight:600;color:#333;white-space:nowrap}
    .gp-chips span.more{color:#777}
    .gp-chips svg{width:13px;height:13px;fill:none;stroke:#333;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .gp-line{display:flex;justify-content:space-between;gap:12px;font-size:15px;color:#555;margin-top:8px}
    .gp-line.total{font-size:17px;font-weight:800;color:#111;margin-top:10px}
    .gp-partial{margin-top:12px;padding:10px 12px;border-radius:10px;background:#fffaf0;border:1px solid #f2e2ad}
    .gp-partial h4{margin:0 0 6px;font-size:13px;color:#886300}.gp-partial .gp-line{font-size:14px;margin-top:4px}
    .gp-partial a{font-size:12px;color:#52613b;font-weight:700}
    .gp-btns{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px}
    .gp-btns.one{grid-template-columns:1fr}
    .gp-btns button{display:inline-flex;align-items:center;justify-content:center;gap:8px;height:50px;border:0;border-radius:14px;font:700 15px Lato,Arial,sans-serif;cursor:pointer}
    .gp-btns .edit{background:#f1f1f1;color:#222}.gp-btns .cancel{background:#ffe1e1;color:#c0392b}
    .gp-btns svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .gp-hist a{display:grid;grid-template-columns:62px minmax(0,1fr) auto 20px;align-items:center;gap:10px;padding:12px 0;border-top:1px solid #eee;text-decoration:none;color:#111}
    .gp-hist a:first-child{border-top:0;padding-top:4px}
    .gp-hist img{width:62px;height:50px;border-radius:9px;object-fit:cover;background:#e9e9e9}
    .gp-hist b{display:block;font-size:14px;font-weight:700}.gp-hist small{display:block;font-size:12px;color:#666;margin-top:2px}
    .gp-hist .rt{display:inline-block;padding:5px 10px;border-radius:9px;font-size:12px;font-weight:700;background:#d9f5e5;color:#1f5f3f;margin-bottom:3px}
    .gp-hist .rt.standard{background:#dfebfb;color:#1e4f8f}.gp-hist .rt.suite{background:#e8fb82;color:#3d4a10}.gp-hist .rt.family{background:#fdf3d2;color:#8a6200}
    .gp-hist .rm{display:block;font-size:13px;color:#333;white-space:nowrap}
    .gp-hist svg{width:18px;height:18px;fill:none;stroke:#333;stroke-width:2.2;stroke-linecap:round;stroke-linejoin:round}
}
@media(max-width:360px){
    .m-gp .gp-top h1{font-size:17px}
    .m-gp .gp-facts{grid-template-columns:1fr 1fr;gap:12px 0}.m-gp .gp-facts div:nth-child(3){padding-left:0;border-left:0}
    .m-gp .gp-grid{grid-template-columns:1fr 1fr}.m-gp .gp-grid div:nth-child(3n+1){padding-left:10px;border-left:1px solid #e6e6e6}.m-gp .gp-grid div:nth-child(2n+1){padding-left:0;border-left:0}
    .m-gp .gp-room{grid-template-columns:96px minmax(0,1fr)}.m-gp .gp-room img{width:96px}
    .m-gp .gp-hist a{grid-template-columns:52px minmax(0,1fr) auto 18px;gap:8px}.m-gp .gp-hist img{width:52px;height:42px}
}
</style>
<main class="main">
    @php
        $gpStatus = $booking->status ?? 'pending';
        $gpStatusLabel = ['pending'=>'Pending','confirmed'=>'Confirmed','checked_in'=>'Checked-In','checked_out'=>'Checked-Out'][$gpStatus] ?? ucfirst($gpStatus);
        $gpNights = max(1, (int) preg_replace('/\D+/', '', (string) $booking->duration));
        $gpRoom = (int) $booking->price_per_night * $gpNights;
        $gpExtra = (int) ($booking->extra_charges ?? 0);
        $gpTotal = (int) $booking->amount ?: ($gpRoom + $gpExtra);
        $gpAdvance = min($gpTotal, (int) $booking->advance_amount);
        $gpRemaining = max(0, $gpTotal - $gpAdvance);
        $gpPay = $booking->invoice_status === 'paid' ? 'paid' : ($booking->invoice_status === 'partial' ? 'partial' : 'unpaid');
        $gpFac = $room ? array_values(array_filter((array) ($room->facilities ?: $room->features ?: []))) : [];
        usort($gpFac, function ($a, $b) { $rank = fn($x) => preg_match('/wi-?fi|\btv\b|air/i', $x) ? 0 : 1; return $rank($a) <=> $rank($b); });
        $gpChipIcon = function ($f) {
            $f = strtolower($f);
            if (strpos($f, 'wi-fi') !== false || strpos($f, 'wifi') !== false) return ['Wi-Fi', '<path d="M5 12.5a10 10 0 0 1 14 0M8.5 16a5 5 0 0 1 7 0"/><circle cx="12" cy="19" r="1"/>'];
            if (strpos($f, 'tv') !== false) return ['TV', '<rect x="2" y="4" width="20" height="13" rx="2"/><path d="M8 21h8"/>'];
            if (strpos($f, 'air') !== false) return ['AC', '<path d="M12 2v20M2 12h20M5 5l14 14M19 5 5 19"/>'];
            return [$f === strtolower($f) ? ucfirst($f) : $f, '<circle cx="12" cy="12" r="8"/>'];
        };
        $gpRoomGuests = $room && $room->guests ? (preg_match('/^\d+$/', trim($room->guests)) ? trim($room->guests).' guests' : $room->guests) : null;
    @endphp
    <section class="m-gp">
        <header class="gp-top">
            <button class="gp-sq" type="button" aria-label="Back" onclick="history.length>1?history.back():location.href='{{ url('/reservation') }}'"><svg viewBox="0 0 24 24"><path d="m15 18-6-6 6-6"/></svg></button>
            <div><h1>Guest Booking Details</h1><p>Reservation / Guest Profile</p></div>
            <button class="gp-sq" type="button" aria-label="Menu" onclick="document.getElementById('appMenu').classList.toggle('open')"><svg viewBox="0 0 24 24" style="fill:currentColor;stroke:none"><circle cx="5" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/></svg></button>
        </header>
        <section class="gp-card guest">
            <div class="gp-who">
                <span class="gp-av">{{ collect(explode(' ', $guest->name))->map(fn($w)=>$w[0])->take(2)->implode('') }}</span>
                <div><b>{{ $guest->name }}</b><small>{{ $guest->code ?: $booking->code }}</small></div>
                <div class="gp-cta">
                    @if($guest->phone)<a class="call" href="tel:{{ preg_replace('/[^\d+]/', '', $guest->phone) }}"><svg viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.7 2z"/></svg>Call</a>@endif
                    @if($guest->email)<a class="msg" href="mailto:{{ $guest->email }}"><svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 6 10 7L22 6"/></svg>Message</a>@endif
                </div>
            </div>
            @if($guest->phone || $guest->email)<div class="gp-contact">@if($guest->phone)<span><svg viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.7 2z"/></svg>{{ $guest->phone }}</span>@endif @if($guest->email)<span><svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 6 10 7L22 6"/></svg>{{ $guest->email }}</span>@endif</div>@endif
            <div class="gp-facts">
                <div><small>Date of Birth</small><b>{{ $guest->dob ?: '—' }}</b></div>
                <div><small>Gender</small><b>{{ $guest->gender ?: '—' }}</b></div>
                <div><small>Nationality</small><b>{{ $guest->nationality ?: '—' }}</b></div>
                <div><small>Passport No.</small><b>{{ $guest->passport_no ?: '—' }}</b></div>
            </div>
        </section>
        <section class="gp-card">
            <div class="gp-h"><span class="ic mint"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 10h18M8 2v4M16 2v4"/></svg></span><h2>Booking Information</h2><span class="gp-pill {{ $gpStatus }}">@if($gpStatus !== 'pending')<svg viewBox="0 0 24 24"><path d="m5 12 5 5 9-9"/></svg>@endif<span class="gp-long">{{ $gpStatus === 'confirmed' ? 'Booking ' : '' }}</span>{{ $gpStatusLabel }}</span></div>
            <div class="gp-grid">
                <div><small>Booking ID</small><b>{{ $booking->code }}</b></div>
                <div><small>Booking Date</small><b>{{ \Carbon\Carbon::parse($booking->created_at)->format('M j, Y') }}</b><i>{{ \Carbon\Carbon::parse($booking->created_at)->format('g:i A') }}</i></div>
                <div><small>Guests</small><b>{{ $booking->guests ?: 2 }} {{ ($booking->guests ?: 2) == 1 ? 'Guest' : 'Guests' }}</b></div>
                <div><small>Room Type</small><b>{{ $booking->room_type ?: '—' }}</b></div>
                <div><small>Room Number</small><b>{{ $booking->room_number ?: '—' }}</b></div>
                <div><small>Request</small><b>{{ $booking->request ?: 'None' }}</b></div>
                <div><small>Check-In</small><b>{{ $booking->check_in ? \Carbon\Carbon::parse($booking->check_in)->format('M j, Y') : '—' }}</b><i>12:00 PM</i></div>
                <div><small>Check-Out</small><b>{{ $booking->check_out ? \Carbon\Carbon::parse($booking->check_out)->format('M j, Y') : '—' }}</b><i>12:00 PM</i></div>
                <div><small>Duration</small><b>{{ $booking->duration ?: $gpNights.' nights' }}</b></div>
            </div>
            <div class="gp-notes"><small>Notes</small><b>{{ $booking->amenity_notes ?: ($booking->request ?: 'None') }}</b></div>
        </section>
        <section class="gp-card">
            <div class="gp-h"><span class="ic blue"><svg viewBox="0 0 24 24"><path d="M3 18V8M3 14h18v4M21 14v-3a2 2 0 0 0-2-2h-8v5"/><path d="M5 11a2.5 2.5 0 0 1 5 0"/></svg></span><h2>Room Information</h2><a class="gp-link" href="{{ url('/rooms') }}">View Room <svg viewBox="0 0 24 24"><path d="m9 6 6 6-6 6"/></svg></a></div>
            <div class="gp-room">
                <img src="{{ asset($room->image ?? 'images/room-info-hero.jpg') }}" alt="">
                <div>
                    <b>{{ $room->name ?? $booking->room_type }} Room</b>
                    <div class="gp-specs">@if($room && $room->size)<span><svg viewBox="0 0 24 24"><path d="M3 8V3h5M21 8V3h-5M3 16v5h5M21 16v5h-5"/></svg>{{ $room->size }}</span>@endif @if($room && $room->bed)<span><svg viewBox="0 0 24 24"><path d="M2 10V6h20v12M2 14h20M2 18v-4M6 10V8h5v2"/></svg>{{ $room->bed }}</span>@endif @if($gpRoomGuests)<span><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20a6 6 0 0 1 12 0M15 20a5 5 0 0 1 6-1"/></svg>{{ $gpRoomGuests }}</span>@endif</div>
                    @if($room && $room->description)<p class="gp-desc">{{ $room->description }}</p>@endif
                    @if(count($gpFac))<div class="gp-chips">@foreach(array_slice($gpFac, 0, 3) as $f)@php [$lbl, $ico] = $gpChipIcon($f); @endphp<span><svg viewBox="0 0 24 24">{!! $ico !!}</svg>{{ $lbl }}</span>@endforeach @if(count($gpFac) > 3)<span class="more">+{{ count($gpFac) - 3 }} more</span>@endif</div>@endif
                </div>
            </div>
        </section>
        <section class="gp-card">
            <div class="gp-h"><span class="ic gold"><svg viewBox="0 0 24 24"><path d="M12 3v18M16.5 7.5a4 4 0 0 0-4.5-2c-2 0-3.5 1.2-3.5 2.8s1.5 2.5 3.5 2.7 3.5 1.2 3.5 2.8-1.5 2.7-3.5 2.7a4 4 0 0 1-4.5-2"/></svg></span><h2>Price Summary</h2><span class="gp-pill {{ $gpPay }}">{{ ucfirst($gpPay) }}</span></div>
            <div class="gp-line"><span>Room Total ({{ $gpNights }} {{ $gpNights === 1 ? 'night' : 'nights' }})</span><span>PKR {{ number_format($gpRoom) }}</span></div>@if($gpExtra > 0)<div class="gp-line"><span>Extra Charges</span><span>PKR {{ number_format($gpExtra) }}</span></div>@endif
            <div class="gp-line total"><span>Total Price</span><span>PKR {{ number_format($gpTotal) }}</span></div>
            @if(auth()->user()->can_access('invoice'))@if($booking->status !== 'pending')<div class="gp-btns" style="margin:14px 0 0"><button class="edit" type="button" onclick="showInvoice({{ $booking->id }})"><svg viewBox="0 0 24 24"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 8h8M8 12h8M8 16h5"/></svg>View Invoice</button><button type="button" style="background:#dff55f;color:#1f2a08" onclick="downloadInvoice({{ $booking->id }})"><svg viewBox="0 0 24 24"><path d="M12 3v12m0 0 4-4m-4 4-4-4M4 21h16"/></svg>Download</button></div>@else<div class="gp-line" style="font-size:13px;color:#888">Invoice becomes available once the booking is confirmed.</div>@endif @endif
            @php $gpPay = $booking->attachments->where('kind', 'payment')->values(); $gpAdv = $booking->attachments->where('kind', 'advance')->values(); @endphp
            @if($gpPay->isNotEmpty())<div class="payment-proof-card"><div class="pp-left"><span class="pp-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h5"/></svg></span><div class="pp-meta"><div class="pp-head"><span class="pp-title">Payment Proof</span><span class="pp-badge"><svg viewBox="0 0 24 24"><path d="m5 12 5 5 9-9"/></svg>Attached</span></div><small class="pp-desc">Receipt attached for this reservation's payment</small></div></div><div class="pp-btns">@foreach($gpPay as $gpFile)<a class="pp-btn" href="{{ asset($gpFile->path) }}" target="_blank" rel="noopener" title="{{ $gpFile->name }}"><svg viewBox="0 0 24 24"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg><span>{{ $gpPay->count() > 1 ? 'View '.$loop->iteration : 'View Proof' }}</span></a>@endforeach</div></div>@endif
            @if($booking->partial_payment || $booking->advance_amount > 0)<div class="gp-partial"><h4>Partial Payment</h4><div class="gp-line"><span>Advance Paid</span><span>PKR {{ number_format($gpAdvance) }}</span></div><div class="gp-line"><span>Remaining Balance</span><span>PKR {{ number_format($gpRemaining) }}</span></div>@foreach($gpAdv as $gpFile)<div style="margin-top:6px"><a href="{{ asset($gpFile->path) }}" target="_blank" rel="noopener">View advance receipt{{ $gpAdv->count() > 1 ? ' '.$loop->iteration : '' }}</a></div>@endforeach</div>@endif
        </section>
        <div class="gp-btns {{ auth()->user()->role === 'admin' ? '' : 'one' }}">
            <button class="edit" type="button" onclick="location.href='{{ url('/reservation') }}?edit={{ $booking->id }}'"><svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>Edit Booking</button>
            @if(auth()->user()->role === 'admin')<button class="cancel" type="button" onclick="if(confirm('Cancel this booking?'))post('/bookings/{{ $booking->id }}','DELETE')"><svg viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2M6 6l1 14h10l1-14M10 11v6M14 11v6"/></svg>Cancel Booking</button>@endif
        </div>
        <section class="gp-card">
            <div class="gp-h"><span class="ic blue"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span><h2>Booking History</h2><a class="gp-link" href="{{ url('/reservation') }}">View All <svg viewBox="0 0 24 24"><path d="m9 6 6 6-6 6"/></svg></a></div>
            <div class="gp-hist">
                @foreach($history as $h)
                <a href="{{ url('/guest-profile?id='.$h->id) }}"><img src="{{ asset('images/room-info-hero.jpg') }}" alt=""><div><b>{{ $h->code }}</b><small>{{ \Carbon\Carbon::parse($h->created_at)->format('M j, Y') }} · {{ \Carbon\Carbon::parse($h->created_at)->format('g:i A') }}</small></div><div><span class="rt {{ strtolower($h->room_type) }}">{{ $h->room_type }}</span><span class="rm">Room {{ $h->room_number }}</span></div><svg viewBox="0 0 24 24"><path d="m9 6 6 6-6 6"/></svg></a>
                @endforeach
            </div>
        </section>
    </section>
    <header class="top">
        <div class="tl">
            <button class="back" onclick="history.length>1?history.back():location.href='{{ url('/reservation') }}'"><svg viewBox="0 0 24 24"><path d="m15 18-6-6 6-6"/></svg></button>
            <div><h1>Guest Profile</h1><div class="bc"><a href="{{ url('/reservation') }}">Reservation</a> / Guest Profile</div></div>
        </div>
        <div class="profile">
            <span class="avatar hdr-avatar" style="cursor:pointer;overflow:hidden" onclick="openAccount()" title="My account">@if(auth()->user()->avatar)<img src="{{ asset(auth()->user()->avatar) }}" alt="">@else{{ auth()->user()->initials() }}@endif</span>
            <div class="pinfo"><b>{{ auth()->user()->name }}</b><small>{{ ucfirst(auth()->user()->role) }}</small></div>
            <div class="tools">
                <button class="tool" type="button" title="My account" onclick="openAccount()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></button>
                <button class="tool bell" type="button" title="Notifications" onclick="showNotifications()"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
            </div>
        </div>
    </header>
    <div class="gtop">
        <section class="card">
            <div class="chd"><h2>Profile</h2><span class="dots">···</span></div>
            <div class="who"><span class="ph">{{ collect(explode(' ', $guest->name))->map(fn($w)=>$w[0])->take(2)->implode('') }}</span><div><b>{{ $guest->name }}</b><small>{{ $guest->code }}</small></div></div>
            <div class="contact">
                <div><span class="ci"><svg viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.7 2z"/></svg></span>{{ $guest->phone }}</div>
                <div><span class="ci"><svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 6 10 7L22 6"/></svg></span>{{ $guest->email }}</div>
            </div>
            <div class="sec"><h3>Personal Information</h3><div class="pairs"><div class="pair"><div class="l">Date of Birth</div><div class="v">{{ $guest->dob ?: '—' }}</div></div><div class="pair"><div class="l">Gender</div><div class="v">{{ $guest->gender ?: '—' }}</div></div><div class="pair"><div class="l">Nationality</div><div class="v">{{ $guest->nationality ?: '—' }}</div></div><div class="pair"><div class="l">Passport No.</div><div class="v">{{ $guest->passport_no ?: '—' }}</div></div></div></div>
            <div class="sec"><h3>Stay Summary</h3>
                <div class="gstats">
                    <div><b>{{ $stats['bookings'] }}</b><small>{{ $stats['bookings'] == 1 ? 'Booking' : 'Bookings' }}</small></div>
                    <div><b>{{ $stats['nights'] }}</b><small>{{ $stats['nights'] == 1 ? 'Night' : 'Nights' }}</small></div>
                    <div><b>{{ number_format($stats['spend'] / 1000, 1) }}K</b><small>PKR Spent</small></div>
                </div>
                <div class="gsince">Guest since {{ $stats['since'] ?: '—' }} &middot; {{ $booking->source ?: 'Direct Booking' }}</div>
            </div>
        </section>
        <section class="card">
            <div class="chd"><h2>Booking Info</h2><span class="dots">···</span></div>
            <span class="bconf"><svg viewBox="0 0 24 24"><path d="m5 12 5 5 9-9"/></svg>Booking Confirmed</span>
            <h3 class="bid">Booking ID: {{ $booking->code }}</h3>
            <div class="bdate">{{ \Carbon\Carbon::parse($booking->created_at)->format('F j, Y, g.i A') }}</div>
            <div class="brow">
                <div class="pair"><div class="l">Room Type</div><div class="v">{{ $booking->room_type }}</div></div>
                <div class="pair"><div class="l">Room Number</div><div class="v">{{ $booking->room_number }}</div></div>
                <div class="pair"><div class="l">Price</div><div class="v">PKR {{ $booking->price_per_night }}<span style="color:var(--label);font-size:13px">/night</span></div></div>
            </div>
            <div class="brow">
                <div class="pair"><div class="l">Guests</div><div class="v">{{ $booking->guests ?: 2 }} {{ ($booking->guests ?: 2) == 1 ? 'Guest' : 'Guests' }}</div></div>
                <div class="pair"><div class="l">Booking Source</div><div class="v">{{ $booking->source ?: 'Direct Booking' }}</div></div>
                <div class="pair"><div class="l">Status</div><div class="v">{{ ucfirst($booking->status) }}</div></div>
            </div>
            <div class="brow">
                <div class="pair"><div class="l">Check In</div><div class="v">{{ $booking->arrival_date ? \Carbon\Carbon::parse($booking->arrival_date)->format('F j, Y') : 'Not set' }}</div><div class="sub {{ $booking->hasArrivalTime() ? 'real' : '' }}">{{ $booking->arrivalLabel() ?: 'Add a date from Edit' }}{{ $booking->hasArrivalTime() ? ' · arrived' : '' }}</div></div>
                <div class="pair"><div class="l">Check Out</div><div class="v">{{ $booking->departure_date ? \Carbon\Carbon::parse($booking->departure_date)->format('F j, Y') : 'Not set' }}</div><div class="sub {{ $booking->hasDepartureTime() ? 'real' : '' }}">{{ $booking->departureLabel() ?: 'Add a date from Edit' }}{{ $booking->hasDepartureTime() ? ' · left' : '' }}</div></div>
                <div class="pair"><div class="l">Duration</div><div class="v">{{ $booking->duration }} {{ (int) $booking->duration === 1 ? 'Night' : 'Nights' }}</div></div>
            </div>
            <div class="pair" style="margin-bottom:20px"><div class="notes-l">Notes</div><div class="v" style="font-size:14px">{{ $booking->request ?: 'None' }}</div></div>
            <div class="divider"></div>
            @php $selectedAmenities = json_decode($booking->amenities ?? '[]', true) ?: []; @endphp
            <div class="pair" style="margin-bottom:20px"><div class="l">Room Features &amp; Amenities</div><div class="amen">
                @forelse($selectedAmenities as $amenity)
                    <div><svg viewBox="0 0 24 24"><path d="m5 12 5 5 9-9"/></svg>{{ $amenity }}</div>
                @empty
                    @unless($booking->amenity_notes)<div class="v">No amenities selected</div>@endunless
                @endforelse
                @if($booking->amenity_notes)
                    <div><svg viewBox="0 0 24 24"><path d="m5 12 5 5 9-9"/></svg>{{ $booking->amenity_notes }}</div>
                @endif
            </div></div>
            <div class="binfo-btns"><button class="bbtn edit" onclick="location.href='{{ url('/reservation') }}?edit={{ $booking->id }}'">Edit</button>@if(auth()->user()->role === 'admin')<button class="bbtn cancel" onclick="if(confirm('Cancel this booking?'))post('/bookings/{{ $booking->id }}','DELETE')">Cancel Booking</button>@endif</div>
        </section>
        <section class="card roominfo">
            @php
                $nights = max(1, (int) preg_replace('/\D+/', '', (string) $booking->duration));
                $roomTotal = (int) $booking->price_per_night * $nights;
                $extraCharges = (int) ($booking->extra_charges ?? 0);
                $bookingTotal = (int) $booking->amount ?: ($roomTotal + $extraCharges);
                $advancePaid = min($bookingTotal, (int) $booking->advance_amount);
                $remainingBalance = max(0, $bookingTotal - $advancePaid);
            @endphp
            <div class="chd"><h2>Room Info</h2><a href="{{ url('/rooms') }}" class="vd">View Detail</a></div>
            <img class="rimg" src="{{ asset($room->image ?? 'images/room-info-hero.jpg') }}" alt="{{ $room->name ?? 'Room' }}">
            <div class="rname">{{ $room->name ?? $booking->room_type }}<small>Room {{ $booking->room_number }}</small></div>
            <div class="rspecs"><span><svg viewBox="0 0 24 24"><path d="M3 8V3h5M21 8V3h-5M3 16v5h5M21 16v5h-5"/></svg>{{ $room->size ?? '35 m²' }}</span><span><svg viewBox="0 0 24 24"><path d="M2 10V6h20v12M2 14h20"/></svg>{{ $room->bed ?? 'King Bed' }}</span><span><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20a6 6 0 0 1 12 0"/></svg>{{ $room->guests ?? '2 guests' }}</span></div>
            <div class="psum"><h3>Price Summary</h3><span class="{{ $booking->invoice_status === 'paid' ? 'paid' : ($booking->invoice_status === 'partial' ? 'partial' : 'unpaid') }}">{{ $booking->invoice_status === 'paid' ? 'Paid' : ($booking->invoice_status === 'partial' ? 'Partial' : 'Unpaid') }}</span></div>
            @php $bookedNights = $booking->check_in && $booking->check_out ? max(1, \Carbon\Carbon::parse($booking->check_in)->diffInDays(\Carbon\Carbon::parse($booking->check_out))) : $nights; @endphp
            <div class="pline"><span>Room Total ({{ $nights }} {{ $nights === 1 ? 'night' : 'nights' }})</span><span>PKR {{ number_format($roomTotal) }}</span></div>
            @if($booking->billed_nights && $booking->billed_nights > $bookedNights)
                <div class="pline" style="color:#7a5400"><span>Late checkout · {{ $booking->billed_nights - $bookedNights }} extra {{ $booking->billed_nights - $bookedNights === 1 ? 'night' : 'nights' }}</span><span>included above</span></div>
            @endif
            @if($extraCharges > 0)<div class="pline"><span>Extra Charges</span><span>PKR {{ number_format($extraCharges) }}</span></div>@endif
            <div class="ptotal"><span>Total Price</span><span>PKR {{ number_format($bookingTotal) }}</span></div>
            @if(auth()->user()->can_access('invoice'))<div class="binfo-btns" style="justify-content:flex-start;margin:0 0 16px">@if($booking->status !== 'pending')<button class="bbtn edit" onclick="showInvoice({{ $booking->id }})">View Invoice</button><button class="bbtn soft" onclick="downloadInvoice({{ $booking->id }})">Download PDF</button>@else<span class="pnote">Invoice becomes available once the booking is confirmed.</span>@endif</div>@endif
            @php $gpPay = $booking->attachments->where('kind', 'payment')->values(); $gpAdv = $booking->attachments->where('kind', 'advance')->values(); @endphp
            @if($gpPay->isNotEmpty())<div class="payment-proof-card"><div class="pp-left"><span class="pp-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h5"/></svg></span><div class="pp-meta"><div class="pp-head"><span class="pp-title">Payment Proof</span><span class="pp-badge"><svg viewBox="0 0 24 24"><path d="m5 12 5 5 9-9"/></svg>Attached</span></div><small class="pp-desc">Receipt attached for this reservation's payment</small></div></div><div class="pp-btns">@foreach($gpPay as $gpFile)<a class="pp-btn" href="{{ asset($gpFile->path) }}" target="_blank" rel="noopener" title="{{ $gpFile->name }}"><svg viewBox="0 0 24 24"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg><span>{{ $gpPay->count() > 1 ? 'View '.$loop->iteration : 'View Proof' }}</span></a>@endforeach</div></div>@endif
            @if($booking->partial_payment || $booking->advance_amount > 0)
            <div class="partial-summary"><h4>Partial Payment</h4><div class="pline"><span>Advance Paid</span><span>PKR {{ number_format($advancePaid) }}</span></div><div class="pline"><span>Remaining Balance</span><span>PKR {{ number_format($remainingBalance) }}</span></div>@foreach($gpAdv as $gpFile)<div style="margin-top:8px"><a href="{{ asset($gpFile->path) }}" target="_blank" rel="noopener" style="font-size:12px;color:#52613b;font-weight:700">View advance receipt{{ $gpAdv->count() > 1 ? ' '.$loop->iteration : '' }}</a></div>@endforeach</div>
            @endif
        </section>
    </div>
    <section class="card">
        <div class="hhead">
            <h2>Booking History</h2>
            <div class="hh-r">
                <div class="searchbox"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg><input class="search" id="histSearch" placeholder="Search booking, room, etc" oninput="renderHistory(this.value)"></div>
            </div>
        </div>
        <div class="tbl">
            <div class="thead">
                <span>Image @include('partials.sort')</span>
                <span>Booking ID @include('partials.sort')</span>
                <span>Booking Date @include('partials.sort')</span>
                <span>Room Type @include('partials.sort')</span>
                <span>Room Number @include('partials.sort')</span>
                <span>Check-In @include('partials.sort')</span>
                <span>Check-Out @include('partials.sort')</span>
                <span>Guests @include('partials.sort')</span>
                <span></span>
            </div>
            <div id="rows"></div>
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
@include('partials.invoice-modal')
<script>
const HERO="{{ asset('images/room-info-hero.jpg') }}";
const fmt=d=>{if(!d)return'';const p=String(d).slice(0,10).split('-');const M=['January','February','March','April','May','June','July','August','September','October','November','December'];return M[+p[1]-1]+' '+(+p[2])+', '+p[0]};
const data=@json($history);
const roomImg=@json($roomImages);
INV[{{ $booking->id }}]=@json($booking);
const timeOf=v=>v?new Date(v).toLocaleTimeString([],{hour:'numeric',minute:'2-digit'}):'';
function renderHistory(q){q=(q||'').toLowerCase();document.getElementById('rows').innerHTML=data.filter(b=>!q||[b.code,b.room_type,b.room_number,b.guest_name].join(' ').toLowerCase().includes(q)).map(b=>`<div class="trow"><span><img src="${roomImg[b.room_type]?'/'+roomImg[b.room_type]:HERO}" alt=""></span><span>${b.code}</span><span>${fmt(b.created_at)}<div class="sub">${timeOf(b.created_at)}</div></span><span><em class="rt">${b.room_type||''}</em></span><span>Room ${b.room_number||''}</span><span>${fmt(b.check_in)}<div class="sub">12:00 PM</div></span><span>${fmt(b.check_out)}<div class="sub">12:00 PM</div></span><span>${b.guests||2} Guests</span><span><button class="dotbtn">···</button></span></div>`).join('')||'<div class="trow"><span>No bookings found</span></div>';}
renderHistory('');
</script>
</body>
</html>
