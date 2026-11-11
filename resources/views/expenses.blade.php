<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Expense - Indus Resort Restaurant</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--lime:#e8fb82;--mint:#d2f3e4;--mint-d:#b6d8cb;--olive:#cbd877;--plime:#f4fac3;--pmint:#eefbf4;--ink:#151515;--muted:#8f8f8f;--bg:#f6f6f5;--line:#f0f0f0;--red:#ff4e52}
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
/* top area: stats+earnings on left, donut on right */
.fin-top{display:grid;grid-template-columns:minmax(0,1fr);gap:20px;margin-bottom:20px}
.fin-left{display:grid;gap:20px;align-content:start}
.stat-row{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.fin-row2{margin-top:16px}
/* Period selector at the top of Financials */
.fin-period{display:flex;align-items:center;flex-wrap:wrap;gap:10px 14px;margin:0 0 18px}
.fp-tabs{display:inline-flex;gap:4px;padding:4px;border:1px solid #dfe8e2;border-radius:12px;background:#fff}
.fp-tabs a,.fp-tabs button{display:inline-flex;align-items:center;height:34px;padding:0 14px;border:0;border-radius:9px;background:none;color:#4b5a52;font:700 13px Inter,Lato,sans-serif;text-decoration:none;cursor:pointer;white-space:nowrap}
.fp-tabs a:hover,.fp-tabs button:hover{background:#eef5f0;color:#1e4a36}
.fp-tabs a.on,.fp-tabs button.on{background:#1e4a36;color:#fff}
.fp-custom{display:none;align-items:center;gap:8px}
.fin-period.open .fp-custom{display:inline-flex}
.fp-custom input[type=date]{height:42px;padding:0 10px;border:1px solid #dfe8e2;border-radius:10px;background:#fff;font:500 13px Inter,Lato,sans-serif;color:#26362c}
.fp-custom span{color:#7a867f;font-size:13px}
.fp-custom button{height:42px;padding:0 16px;border:0;border-radius:10px;background:#1e4a36;color:#fff;font:700 13px Inter,Lato,sans-serif;cursor:pointer}
.fp-label{margin-left:auto;color:#68756d;font-size:13px}.fp-label b{color:#1f3d2e}
@media(max-width:768px){.fin-period{margin:0 0 12px;gap:8px}.fp-tabs{display:flex;width:100%}.fp-tabs a,.fp-tabs button{flex:1;justify-content:center;padding:0 6px;font-size:12.5px}.fp-custom{width:100%}.fin-period.open .fp-custom{display:flex}.fp-custom input[type=date]{flex:1;min-width:0}.fp-label{margin-left:0;width:100%;font-size:12.5px}}
.cash-head{display:flex;align-items:center;justify-content:space-between;margin:0 2px 10px}
.cash-head h3{margin:0;font-size:12px;font-weight:800;letter-spacing:.6px;text-transform:uppercase;color:#6b7671}
.stat-row+.cash-head{margin-top:18px}
.cash-btn{height:36px;border:0;border-radius:10px;background:#1e4a36;color:#fff;padding:0 14px;font:700 13px Inter,Lato,sans-serif;cursor:pointer}
.cash-actions{display:inline-flex;gap:8px;align-items:center}
.cash-btn.soft{display:inline-flex;align-items:center;gap:7px;background:#e6f4ea;color:#1e4a36;border:1px solid #d5e8dc}
.cash-btn.soft svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.rp-quick{display:flex;flex-wrap:wrap;gap:8px;margin:4px 0 2px}
.rp-quick button{height:34px;border:1px solid #d5e8dc;border-radius:9px;background:#f4f8f5;color:#1e4a36;padding:0 12px;font:700 12.5px Inter,Lato,sans-serif;cursor:pointer}
.rp-quick button.on{background:#1e4a36;border-color:#1e4a36;color:#fff}
.modal label.rp-check{display:flex;align-items:center;gap:9px;margin:14px 0 0;color:#374151;font-size:13.5px;cursor:pointer}
.modal label.rp-check input{width:16px;height:16px;padding:0;accent-color:#2f6b4f}
.mx-report{display:block;width:100%;height:42px;margin:0 0 12px;border:1px solid #d5e8dc;border-radius:12px;background:#e6f4ea;color:#1e4a36;font:700 14px Lato,Arial,sans-serif;cursor:pointer}
.lg-wallet{display:inline-block;margin-top:3px;font-size:11px;font-weight:700;border-radius:6px;padding:2px 7px}
.lg-wallet.income{background:#e6f4ea;color:#2f6b4f}.lg-wallet.petty{background:#fdf1d3;color:#7a5400}
.lg-type.cash{background:#dfebfb;color:#1e4f8f}
.lg-amt.move{color:#1e4f8f}
.lg-pick{width:16px;height:16px;margin:0 9px 0 0;accent-color:#2f6b4f;vertical-align:-2px;cursor:pointer}
.lg-bulk{display:none;align-items:center;gap:10px;flex-wrap:wrap;margin:0 0 12px;padding:10px 12px;border:1px solid #d5e8dc;border-radius:11px;background:#f1f8f3;font-size:13px;color:#1e4a36}
.lg-bulk.on{display:flex}
.lg-bulk button{height:32px;border:1px solid #b9d3c4;border-radius:8px;background:#fff;color:#1e4a36;padding:0 12px;font:700 12.5px Inter,Lato,sans-serif;cursor:pointer}
.cash-rc{display:flex;align-items:center;gap:10px;flex-wrap:wrap;font-size:13px;color:#6b7671}
.cash-rc input[type=file]{position:absolute;width:1px;height:1px;opacity:0;overflow:hidden;clip:rect(0,0,0,0);padding:0;border:0}
.modal .cash-rc .cash-rc-btn{display:inline-flex;align-items:center;gap:7px;height:38px;margin:0;padding:0 14px;border:1px dashed #b9d3c4;border-radius:9px;background:#f4f8f5;color:#1e4a36;font-size:13px;font-weight:700;cursor:pointer}
.cash-rc-btn svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
a.att-pill{text-decoration:none;margin-left:4px;cursor:pointer}
a.lg-rc.lg-ed{border-color:#d5e8dc;background:#fff;color:#1e4a36}
a.lg-rc{display:inline-grid;place-items:center;width:34px;height:34px;border:1px solid #cfe0f7;background:#f3f8ff;border-radius:9px;color:#1e4f8f;text-decoration:none}
a.lg-rc svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.pf-hint{margin-top:7px;font-size:12.5px;color:#6b7671}
.pf-hint.warn{color:#b3352f;font-weight:700}
@media(max-width:768px){.mx-h .exp-report-btn{height:34px;padding:0 10px;font-size:12px}.mx-h>div{gap:7px!important}}
.sc-click{cursor:pointer;transition:box-shadow .15s,border-color .15s;border:1px solid transparent}
.sc-click:hover{box-shadow:0 6px 18px rgba(16,24,40,.08)}
.sc-click.on{border-color:#2f6b4f;box-shadow:0 0 0 3px rgba(47,107,79,.12)}
/* The theme pins .scard's border and background with !important, so the selected state
   has to outrank it: green border, soft green fill and a "showing below" tag. */
.scard.sc-click.on{border:1.5px solid #2f6b4f!important;background:#eef7f1!important;box-shadow:0 0 0 4px rgba(47,107,79,.14)!important;position:relative}
.scard.sc-click.on .sc-ic{background:#2f6b4f!important}.scard.sc-click.on .sc-ic svg{stroke:#fff!important}
.fin-top{align-items:start}
/* partials.responsive still reserves a 320px donut column on laptops; outrank it. */
.main .fin-top{grid-template-columns:minmax(0,1fr)!important}
.sc-sub{width:100%;color:#8b948f;font-size:11.5px;margin-top:2px}
.sc-num.neg{color:#b3352f}
.sc-ic.amber{background:#fdf1d3}.sc-ic.amber svg{stroke:#9a7100}
.sc-ic.red{background:#fde3e5}.sc-ic.red svg{stroke:#b3352f}
.sc-go{margin-left:auto;font-size:12px;font-weight:700;color:#1e4a36;text-decoration:none;background:#e6f4ea;border-radius:8px;padding:4px 9px}
/* Ledger rows: money in is green with a plus, money out is red with a minus. */
.lg-name b{display:block;font-weight:600;font-size:13.5px}
.lg-name small{display:block;color:#9ca3af;font-size:12px;margin-top:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.lg-amt{font-weight:700;white-space:nowrap}
.lg-amt.in{color:#2f6b4f}.lg-amt.out{color:#b3352f}
.lg-type{display:inline-flex;align-items:center;gap:7px;padding:6px 11px;border-radius:20px;font-size:12.5px;font-weight:700;font-style:normal;width:max-content}
.lg-type:before{content:'';width:7px;height:7px;border-radius:50%;background:currentColor}
.lg-type.in{background:#e6f4ea;color:#2f6b4f}.lg-type.out{background:#fde3e5;color:#b3352f}
.lg-open{display:inline-flex;align-items:center;height:34px;padding:0 13px;border-radius:9px;border:1px solid #d5e8dc;background:#e6f4ea;color:#1e4a36;font-size:12.5px;font-weight:700;text-decoration:none}
a.dl{text-decoration:none}
.lg-sum{display:flex;gap:10px;flex-wrap:wrap;margin:0 0 14px}
.lg-sum span{display:inline-flex;align-items:center;gap:7px;background:#f4f8f5;border-radius:9px;padding:7px 12px;font-size:12.5px;color:#55605a}
.lg-sum b{color:#123527;font-size:13.5px}
.scard{background:#fff;border-radius:16px;padding:20px}
.sc-head{display:flex;align-items:center;gap:10px;color:#7a7a7a;font-size:15px;margin-bottom:14px}
.sc-ic{width:34px;height:34px;border-radius:9px;background:var(--mint);display:grid;place-items:center;flex:0 0 34px}
.sc-ic svg{width:18px;height:18px;fill:none;stroke:#3f8b6d;stroke-width:1.8}
.sc-head .dots{margin-left:auto;color:#c4c4c4;font-size:18px;letter-spacing:1px}
.sc-body{display:flex;align-items:flex-end;justify-content:space-between;gap:8px}
.sc-num{font-size:30px;font-weight:800;letter-spacing:-.5px}
.sc-delta{text-align:right}
.sc-delta .p{display:inline-flex;align-items:center;gap:4px;padding:4px 9px;border-radius:12px;font-size:13px;font-weight:700;background:var(--lime);color:#3d4a10}
.sc-delta .p.down{background:#ffe1e1;color:#b3352f}
.sc-delta small{display:block;color:#9a9a9a;font-size:12px;margin-top:5px}
/* earnings */
.earn{background:#fff;border-radius:16px;padding:22px}
.earn-top{display:flex;justify-content:space-between;align-items:center}
.earn-top h2{font-size:19px;margin:0}
.yearsel{height:40px;border:1px solid #ededed;background:#fff;border-radius:10px;padding:0 14px;display:inline-flex;align-items:center;gap:8px;font-size:14px;cursor:pointer}
.yearsel svg{width:16px;height:16px;fill:none;stroke:#555;stroke-width:1.8}
.legend{display:flex;gap:20px;margin:14px 0 6px;font-size:14px;color:#666}
.legend i{display:inline-block;width:12px;height:12px;border-radius:3px;margin-right:7px;vertical-align:-1px}
.legend .li{background:var(--lime)}.legend .le{background:var(--mint)}
.ec{display:flex;gap:12px}
.ey{display:flex;flex-direction:column;justify-content:space-between;height:280px;font-size:12px;color:#aaa;text-align:right;flex:0 0 34px;padding:4px 0}
.eplot{position:relative;flex:1;height:280px;display:flex;align-items:stretch}
.eplot:before,.gl{content:'';position:absolute;left:0;right:0;border-top:1px dashed #ededed}
.eplot .g0{top:50%;border-top:1px dashed #d9d9d9}.eplot .g1{top:25%}.eplot .g3{top:75%}
.mo{position:relative;flex:1}
.mo .up{position:absolute;left:50%;transform:translateX(-50%);bottom:50%;width:24px;background:var(--mint);border-radius:7px 7px 0 0}
.mo .dn{position:absolute;left:50%;transform:translateX(-50%);top:50%;width:24px;background:var(--lime);border-radius:0 0 7px 7px}
.mo .ml{position:absolute;top:calc(100% + 10px);left:0;right:0;text-align:center;font-size:12px;color:#888}
.mo.hl .up,.mo.hl .dn{outline:6px solid rgba(210,243,228,.5);border-radius:8px}
.tip{display:none;position:absolute;bottom:calc(50% + 90px);left:50%;transform:translateX(-50%);background:var(--lime);border-radius:10px;padding:10px 12px;font-size:12px;white-space:nowrap;z-index:3;box-shadow:0 6px 16px rgba(0,0,0,.08)}
.mo:hover .tip{display:block}
.tip b{font-weight:700}.tip .r{display:flex;justify-content:space-between;gap:18px;margin-top:4px}.tip .r span:first-child{color:#5b6b2f}
/* donut card */
.donut-card{background:#fff;border-radius:16px;padding:20px;display:flex;flex-direction:column}
.toggle{display:flex;background:#f4f4f4;border-radius:12px;padding:5px;margin-bottom:8px}
.toggle button{flex:1;height:40px;border:0;background:transparent;border-radius:9px;font-size:15px;font-weight:600;color:#777;cursor:pointer}
.toggle button.on{background:var(--lime);color:#2f3a0c}
.donut{width:220px;height:220px;border-radius:50%;margin:14px auto 6px;position:relative;background:conic-gradient(var(--mint) 0 50%,#fff 50% 50.7%,var(--mint-d) 50.7% 66.67%,#fff 66.67% 67.37%,var(--olive) 67.37% 80%,#fff 80% 80.7%,var(--lime) 80.7% 90%,#fff 90% 90.7%,var(--plime) 90.7% 96.67%,#fff 96.67% 97.37%,var(--pmint) 97.37% 100%)}
.donut .hole{position:absolute;inset:50px;background:#fff;border-radius:50%;display:grid;place-content:center;text-align:center}
.donut .hole b{font-size:28px;font-weight:800}.donut .hole span{font-size:13px;color:#8a8a8a}
.ec-empty{flex:1;min-height:240px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;text-align:center;color:#8b948f;background:#fafcfb;border:1px dashed #dfe7e2;border-radius:14px;padding:24px}
.ec-empty svg{width:30px;height:30px;fill:none;stroke:#b7c9bf;stroke-width:1.7;stroke-linecap:round}
.ec-empty b{color:#123527;font-size:15px}
.ec-empty span{font-size:13px;max-width:360px;line-height:1.5}
.dlegend{margin-top:10px;display:grid;gap:14px}
.dl-row{display:grid;grid-template-columns:14px 1fr auto;align-items:center;gap:10px;font-size:14px;color:#444}
.dl-row i{width:13px;height:13px;border-radius:3px}
.dl-row .pct{color:#9a9a9a;font-size:13px}
.dl-row b{font-weight:700}
/* transactions panel */
.panel{background:#fff;border-radius:18px;padding:22px 22px 8px}
.pt{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;gap:12px;flex-wrap:wrap}
.pt h2{font-size:20px;margin:0}
.pt-r{display:flex;gap:12px;align-items:center;flex-wrap:wrap}
.exp-report-btn{height:42px;padding:0 14px;border:1px solid #d6e7dc;border-radius:10px;background:#eef8f0;color:#245a3c;font:700 13px Lato,Arial,sans-serif;cursor:pointer;white-space:nowrap}
.pill{height:44px;border:0;border-radius:11px;padding:0 16px;display:inline-flex;align-items:center;gap:9px;font-size:15px;background:#f4f4f4;color:#333;cursor:pointer;white-space:nowrap}
.pill.lime{background:var(--lime)}
.pill svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:1.8}
.searchbox{position:relative}
.searchbox>svg{position:absolute;left:15px;top:50%;transform:translateY(-50%);width:18px;height:18px;fill:none;stroke:#b0b0b0;stroke-width:1.8}
.search{height:44px;width:250px;border:0;border-radius:11px;background:#f4f4f4;padding:0 16px 0 42px;font-size:14px;color:#333;font-family:inherit}
.search::placeholder{color:#b0b0b0}
.tbl{width:100%;overflow-x:auto}
/* Every row is its own grid. Plain fr tracks grow with their content, so a row with
   four action buttons sized its columns differently from a row with one and the cells
   stopped lining up. minmax(0, fr) plus a fixed action track makes all rows identical. */
.thead,.trow{display:grid;grid-template-columns:minmax(0,1.6fr) minmax(0,1.3fr) minmax(0,.7fr) minmax(0,.95fr) minmax(0,1.1fr) minmax(0,.85fr) 284px;column-gap:12px;align-items:center;min-width:1060px}
.trow>span{min-width:0}
.trow>span:nth-child(2),.trow>span:nth-child(5){white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.trow .act{justify-content:flex-start;flex-wrap:nowrap}
.thead{background:#eefaf3;border-radius:12px;padding:16px 24px;color:#8a8a8a;font-size:15px;font-weight:600}
.thead span{display:inline-flex;align-items:center;gap:6px}
.thead svg{width:12px;height:12px;fill:none;stroke:#b5b5b5;stroke-width:2}
.trow{padding:18px 24px;border-bottom:1px solid var(--line);font-size:15px}
.trow:last-child{border-bottom:0}
.st{display:inline-flex;align-items:center;gap:8px;padding:6px 12px;border-radius:7px;font-size:14px;font-weight:600;width:max-content;background:var(--mint);color:#2f6b4f}
.st:before{content:'';width:9px;height:9px;border-radius:2px;background:#7cc3a0}
.act{display:flex;gap:11px;align-items:center}
.eye{width:40px;height:40px;border:1px solid #ededed;background:#fff;border-radius:9px;display:grid;place-items:center;cursor:pointer}
.eye svg{width:19px;height:19px;fill:none;stroke:#555;stroke-width:1.7}
.dl{height:40px;border:0;border-radius:9px;background:var(--lime);padding:0 16px;display:inline-flex;align-items:center;gap:7px;font-size:14px;font-weight:600;color:#2f3a0c;cursor:pointer}
.dl svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.9}
.tbottom{display:flex;justify-content:space-between;align-items:center;padding:20px 4px 16px;color:#8a8a8a;font-size:15px}
.pages{display:flex;gap:8px}
.pg{min-width:40px;height:40px;border:0;border-radius:9px;background:#f4f4f4;font-size:15px;color:#555;cursor:pointer;display:grid;place-items:center}
.pg.active{background:var(--lime);color:#2f3a0c;font-weight:700}
footer{display:flex;justify-content:space-between;align-items:center;padding:20px 6px 8px;color:#9a9a9a;font-size:14px;flex-wrap:wrap;gap:14px}
.flinks{display:flex;gap:26px}.flinks a{color:#9a9a9a;text-decoration:none}.flinks span:first-child{color:#666}
.fsoc{display:flex;gap:16px;align-items:center}.fsoc a{color:#c2c2c2}.fsoc svg{width:18px;height:18px;fill:currentColor}
@media(max-width:1000px){.fin-top{grid-template-columns:1fr}.stat-row{grid-template-columns:1fr}}
@media(max-width:700px){body{zoom:1}.main{padding:18px 14px}.top h1{font-size:24px}.profile .pinfo,.tools{display:none}footer{flex-direction:column;align-items:flex-start}}
/* Searchable category picker */
.modal .catpick{position:relative}
.modal .catlist{display:none;position:absolute;left:0;right:0;top:calc(100% + 4px);max-height:260px;overflow:auto;background:#fff;border:1px solid #e2e2e2;border-radius:10px;box-shadow:0 10px 30px rgba(0,0,0,.12);z-index:20;padding:6px}
.modal .catlist.open{display:block}
.modal .cathead{font-size:11px;font-weight:800;letter-spacing:.4px;text-transform:uppercase;color:#7f8a3a;padding:8px 10px 4px}
.modal .catitem{padding:8px 10px;border-radius:7px;font-size:13.5px;color:#222;cursor:pointer}
.modal .catitem:hover,.modal .catitem.hl{background:#f3f8e6}
.modal .catitem.hide,.modal .catgroup.hide,.modal .catnew.hide{display:none}
.modal .catnew{margin-top:4px;padding:9px 10px;border-top:1px solid #f0f0f0;font-size:13px;color:#2f5a45;cursor:pointer}
.modal .catnew:hover{background:#f3f8e6;border-radius:7px}
</style>
@include('partials.theme-head')
</head>
<body>
@include('partials.crud')
@include('partials.sidebar')
@include('partials.responsive')
@include('partials.desktop-theme')
@include('partials.mobile-theme')
<main class="main">
<section class="m-page">
@php $msAct = '<button class="ms-add" type="button" onclick="openExpenseCreator()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>Add Expense</button>'; @endphp
@include('partials.mobile-shell', ['msTitle'=>'Expenses','msSubtitle'=>'Track and manage your expenses','msAction'=>$msAct])
<style>@media(max-width:768px){
.mx-stats{display:flex;gap:10px;overflow-x:auto;margin:0 -16px 12px;padding:2px 16px 6px;scrollbar-width:none}.mx-stats::-webkit-scrollbar{display:none}
.mx-stat{flex:0 0 186px;background:#fff;border-radius:16px;padding:14px;box-shadow:0 4px 18px rgba(16,24,40,.05);border:1px solid #eef0ee}
.mx-stat .h{display:flex;align-items:center;gap:10px;font-size:13px;color:#333;white-space:nowrap}.mx-stat .h i{width:36px;height:36px;border-radius:10px;background:#d9f5e5;display:grid;place-items:center;flex:0 0 36px}.mx-stat .h svg{width:18px;height:18px;fill:none;stroke:#1f5f3f;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.mx-stat .v{font-size:22px;font-weight:800;margin:12px 0 10px;letter-spacing:-.4px;white-space:nowrap}
.mx-stat .d{display:flex;align-items:center;gap:8px;font-size:11px;color:#666;white-space:nowrap}.mx-stat .d b{display:inline-flex;align-items:center;gap:3px;background:#cdeb8c;color:#2f5b1f;border-radius:12px;padding:4px 8px;font-size:11px;font-weight:700}.mx-stat.down .d b{background:#ffe1e1;color:#c0392b}.mx-stat .d b svg{width:10px;height:10px;fill:none;stroke:currentColor;stroke-width:3;stroke-linecap:round;stroke-linejoin:round}
.mx-card{background:#fff;border-radius:18px;padding:16px;margin-bottom:12px;box-shadow:0 4px 18px rgba(16,24,40,.05);border:1px solid #eef0ee}
.mx-h{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:10px}.mx-h h2{margin:0;font-size:17px;font-weight:800}
.mx-year{display:inline-flex;align-items:center;gap:6px;height:36px;padding:0 12px;border:1px solid #e6e6e6;border-radius:10px;font-size:13px;font-weight:600;background:#fff;white-space:nowrap}.mx-year svg{width:15px;height:15px;fill:none;stroke:#333;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.mx-link{display:inline-flex;align-items:center;gap:4px;color:#1d6ae5;font-size:14px;font-weight:700;text-decoration:none;white-space:nowrap}.mx-link svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:2.4;stroke-linecap:round;stroke-linejoin:round}
.mx-leg{display:flex;gap:16px;font-size:13px;color:#333;margin-bottom:8px}.mx-leg span{display:inline-flex;align-items:center;gap:6px}.mx-leg i{width:12px;height:12px;border-radius:3px;display:inline-block}
.mx-chart{display:grid;grid-template-columns:36px minmax(0,1fr);gap:6px}
.mx-y{display:flex;flex-direction:column;justify-content:space-between;height:200px;font-size:11px;color:#666;text-align:right;line-height:1}.mx-y span{transform:translateY(-5px)}.mx-y span:last-child{transform:translateY(0)}
.mx-plot{position:relative;height:200px;border-left:1px solid #e6e6e6;border-bottom:1px solid #e6e6e6;background:linear-gradient(to bottom,#ededed 1px,transparent 1px) 0 0/100% 25%}
.mx-plot .zero{position:absolute;left:0;right:0;top:50%;border-top:1px solid #cfcfcf}
.mx-plot .mo{position:absolute;top:0;bottom:0}.mx-plot .up,.mx-plot .dn{position:absolute;left:50%;transform:translateX(-50%);width:62%;max-width:16px}.mx-plot .up{bottom:50%;background:#dff55f;border-radius:5px 5px 0 0}.mx-plot .dn{top:50%;background:#b8ebcf;border-radius:0 0 5px 5px}
.mx-x{display:grid;margin-left:42px;font-size:10px;color:#666;text-align:center;margin-top:6px}
.mx-empty{padding:40px 16px;text-align:center;color:#8b948f;font-size:13px;background:#fafcfb;border:1px dashed #dfe7e2;border-radius:12px}
.mx-tog{display:flex;background:#f1f3f2;border-radius:12px;padding:4px;margin-bottom:14px}.mx-tog button{flex:1;height:36px;border:0;border-radius:9px;background:none;font:700 14px Lato,Arial,sans-serif;color:#555;cursor:pointer}.mx-tog button.on{background:#dff55f;color:#1f2a08}
.mx-donut{width:190px;height:190px;border-radius:50%;margin:0 auto 14px;position:relative;background:conic-gradient(#d9f5e5 0 100%)}.mx-donut:after{content:'';position:absolute;inset:36px;border-radius:50%;background:#fff}.mx-donut .c{position:absolute;inset:0;display:grid;place-content:center;text-align:center;z-index:1}.mx-donut .c b{font-size:19px;font-weight:800;line-height:1.1;display:block}.mx-donut .c small{font-size:12px;color:#777;display:block;margin-top:3px}
.mx-dl{display:grid;gap:8px}.mx-dl div{display:grid;grid-template-columns:12px minmax(0,1fr) auto;align-items:center;gap:8px;font-size:12px;color:#333}.mx-dl i{width:12px;height:12px;border-radius:4px;display:inline-block;border:1px solid rgba(0,0,0,.06)}.mx-dl span{white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
/* The empty-state row has no colour swatch, so it must not sit in the 12px column. */
.mx-dl div:not(:has(i)){grid-template-columns:minmax(0,1fr)}
.mx-dl div:not(:has(i)) span{white-space:normal;text-align:center}.mx-dl em{font-style:normal;color:#888}.mx-dl b{font-weight:800;white-space:nowrap}
.mx-cal{flex:0 0 auto;width:42px;height:42px;border:1px solid #e6e6e6;border-radius:12px;background:#fff;display:grid;place-items:center;color:#222;cursor:pointer}
.mx-cal svg{width:17px;height:17px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.mx-cal.on{background:#1e4a36;border-color:#1e4a36;color:#fff}
.mx-dates{display:none;margin:-2px 0 12px}
.mx-dates.open{display:block}
.mx-dates input{width:100%;height:46px;border:1px solid #e6e6e6;border-radius:12px;background:#fff;padding:0 14px;font:400 14px Lato,Arial,sans-serif;color:#333}
.mx-flt{display:flex;gap:8px;overflow-x:auto;margin:0 -16px 10px;padding:2px 16px 6px;scrollbar-width:none}.mx-flt::-webkit-scrollbar{display:none}
.mx-flt .ms-search{flex:0 0 180px;height:42px;border:1px solid #e6e6e6;box-shadow:none;border-radius:12px}.mx-flt .ms-sel{flex:0 0 auto;height:42px;border:1px solid #e6e6e6;box-shadow:none;font-size:13px;border-radius:12px}
.mx-date{display:inline-flex;align-items:center;gap:7px;flex:0 0 auto;height:42px;padding:0 12px;border:1px solid #e6e6e6;border-radius:12px;background:#fff;font-size:13px;color:#333}.mx-date svg{width:15px;height:15px;fill:none;stroke:#333;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}.mx-date input{border:0;background:none;font:400 13px Lato,Arial,sans-serif;color:#333;width:120px;padding:0;outline:0}
.mx-row{display:grid;grid-template-columns:44px minmax(0,1fr) auto 16px;align-items:center;gap:9px;padding:11px;border:1px solid #eef0ee;border-radius:14px;margin-bottom:8px;cursor:pointer;background:#fff}
.mx-row .ic{width:44px;height:44px;border-radius:12px;display:grid;place-items:center}.mx-row .ic svg{width:20px;height:20px;fill:none;stroke:currentColor;stroke-width:1.9;stroke-linecap:round;stroke-linejoin:round}
.mx-row .ic.mint{background:#d9f5e5;color:#1f5f3f}.mx-row .ic.blue{background:#dfebfb;color:#1e4f8f}.mx-row .ic.gold{background:#fdf3d2;color:#8a6200}.mx-row .ic.pink{background:#fde2e5;color:#b02c2c}.mx-row .ic.purple{background:#e9e4fb;color:#4b3a8f}.mx-row .ic.gray{background:#f1f3f2;color:#555}
.mx-row .tx{min-width:0}.mx-row .tx b{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;font-size:14px;font-weight:800;line-height:1.2}.mx-row .tx small{display:block;font-size:11px;color:#777;margin-top:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.mx-row .amt{text-align:right}.mx-row .amt b{display:block;font-size:14px;font-weight:800;white-space:nowrap}.mx-row .amt .ms-pill{margin-top:5px;padding:3px 8px;font-size:10px}
.mx-row .chev{width:18px;height:18px;fill:none;stroke:#333;stroke-width:2.2;stroke-linecap:round;stroke-linejoin:round}
.mx-card .ms-pager{padding-top:10px}
}</style>
@include('partials.fin-period')
<div class="mx-stats">
<article class="mx-stat {{ $cashView['total'] < 0 ? 'down' : '' }}"><div class="h"><i><svg viewBox="0 0 24 24"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="3"/></svg></i>Cash in Hand</div><div class="v">PKR {{ number_format($cashView['total']) }}</div><div class="d">{{ $cashView['as_of'] ? 'closing on '.$cashView['as_of'] : 'income plus petty, now' }}</div></article>
<article class="mx-stat {{ $cashView['income'] < 0 ? 'down' : '' }}"><div class="h"><i><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v10"/></svg></i>Income Cash</div><div class="v">PKR {{ number_format($cashView['income']) }}</div><div class="d">from bookings and kitchen</div></article>
<article class="mx-stat {{ $cashView['petty'] < 0 ? 'down' : '' }}"><div class="h"><i><svg viewBox="0 0 24 24"><path d="M20 7H5a2 2 0 0 1 0-4h13v4M3 5v13a2 2 0 0 0 2 2h15v-4"/></svg></i>Petty Cash</div><div class="v">PKR {{ number_format($cashView['petty']) }}</div><div class="d">sent by the owner</div></article>
<article class="mx-stat {{ $balanceChange < 0 ? 'down' : '' }}"><div class="h"><i><svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M16 12h2"/></svg></i>Net Profit</div><div class="v">PKR {{ number_format($totalBalance) }}</div><div class="d">@if($balanceChange === null)all time @else<b>{!! $balanceChange < 0 ? '<svg viewBox="0 0 24 24"><path d="M7 7l10 10M15 17H7V9"/></svg>' : '<svg viewBox="0 0 24 24"><path d="M7 17 17 7M9 7h8v8"/></svg>' !!}{{ number_format(abs($balanceChange), 2) }}%</b>{{ $period['compare'] }}@endif</div></article>
<article class="mx-stat {{ $incomeChange < 0 ? 'down' : '' }}"><div class="h"><i><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v10M9.5 14c0 1 1 2 2.5 2s2.5-.7 2.5-2-1-1.7-2.5-2-2.5-1-2.5-2 1-2 2.5-2 2.5 1 2.5 2"/></svg></i>Total Income</div><div class="v">PKR {{ number_format($totalIncome) }}</div><div class="d">@if($incomeChange === null)all time @else<b>{!! $incomeChange < 0 ? '<svg viewBox="0 0 24 24"><path d="M7 7l10 10M15 17H7V9"/></svg>' : '<svg viewBox="0 0 24 24"><path d="M7 17 17 7M9 7h8v8"/></svg>' !!}{{ number_format(abs($incomeChange), 2) }}%</b>{{ $period['compare'] }}@endif</div></article>
<article class="mx-stat {{ $expenseChange < 0 ? 'down' : '' }}"><div class="h"><i><svg viewBox="0 0 24 24"><path d="M4 20V10M10 20V4M16 20v-8M22 20H2"/></svg></i>Total Expenses</div><div class="v">PKR {{ number_format($totalExpense) }}</div><div class="d">@if($expenseChange === null)all time @else<b>{!! $expenseChange < 0 ? '<svg viewBox="0 0 24 24"><path d="M7 7l10 10M15 17H7V9"/></svg>' : '<svg viewBox="0 0 24 24"><path d="M7 17 17 7M9 7h8v8"/></svg>' !!}{{ number_format(abs($expenseChange), 2) }}%</b>{{ $period['compare'] }}@endif</div></article>
<article class="mx-stat"><div class="h"><i><svg viewBox="0 0 24 24"><path d="M3 18V8M3 14h18v4M21 14v-3a2 2 0 0 0-2-2h-8v5"/><path d="M5 11a2.5 2.5 0 0 1 5 0"/></svg></i>Room Income</div><div class="v">PKR {{ number_format($roomIncome) }}</div><div class="d">paid bookings</div></article>
<article class="mx-stat"><div class="h"><i><svg viewBox="0 0 24 24"><path d="M6 3v7a2 2 0 0 0 4 0V3M8 12v9M17 3c-2 0-3.5 2.2-3.5 5.5S15 13 17 13v8"/></svg></i>Kitchen Sales</div><div class="v">PKR {{ number_format($kitchenIncome) }}</div><div class="d">paid orders</div></article>
<article class="mx-stat {{ $kitchenIncome - $kitchenCosts < 0 ? 'down' : '' }}"><div class="h"><i><svg viewBox="0 0 24 24"><path d="M3 17l6-6 4 4 8-8M15 7h6v6"/></svg></i>Kitchen Profit</div><div class="v">PKR {{ number_format($kitchenIncome - $kitchenCosts) }}</div><div class="d">after PKR {{ number_format($kitchenCosts) }} costs</div></article>
</div>
@if(auth()->user()->role !== 'staff')<button type="button" class="mx-report" onclick="openCashReport()">Export Cash Report</button>@endif
{{-- Earnings chart disabled on request.
<section class="mx-card"><div class="mx-h"><h2>Earnings Overview</h2><span class="mx-year"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 10h18M8 2v4M16 2v4"/></svg>This Year<svg viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></svg></span></div><div class="mx-leg"><span><i style="background:#2f6b4f"></i>Income</span><span><i style="background:#bcd9c8"></i>Expense</span></div><div class="mx-chart"><div class="mx-y" id="mxY"></div><div class="mx-plot" id="mxPlot"><div class="zero"></div></div></div><div class="mx-x" id="mxX"></div></section>
--}}
{{-- Income/Expense donut disabled on request.
<section class="mx-card"><div class="mx-tog"><button type="button" id="mxIncBtn" onclick="mxDonut('income')">Income</button><button type="button" class="on" id="mxExpBtn" onclick="mxDonut('expense')">Expense</button></div><div class="mx-donut" id="mxDonut"><div class="c"><b id="mxTotal"></b><small id="mxLabel"></small></div></div><div class="mx-dl" id="mxLegend"></div></section>
--}}
<section class="mx-card">
<div class="mx-h"><h2>Transactions</h2><div style="display:flex;align-items:center;gap:12px">@if(auth()->user()->role !== 'staff')<button class="exp-report-btn" type="button" onclick="openCashEntry()">Cash Entry</button>@endif<button class="exp-report-btn" type="button" onclick="openExpenseReport()">Export PDF</button><a class="mx-link" href="javascript:void(0)" onclick="mxViewAll()">View All <svg viewBox="0 0 24 24"><path d="m9 6 6 6-6 6"/></svg></a></div></div>
<div class="mx-flt"><label class="ms-search"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg><input id="mSearch" type="search" placeholder="Search records..."></label><select class="ms-sel" id="mCat"><option value="">All Category</option>@foreach($categoryGroups as $group => $items)<optgroup label="{{ $group }}">@foreach($items as $item)<option>{{ $item }}</option>@endforeach</optgroup>@endforeach</select><select class="ms-sel" id="mStatus"><option value="">All Records</option><option value="cash_income">Income Cash</option><option value="cash_petty">Petty Cash</option><option value="pl">Income &amp; Expenses</option><option value="income">All Income</option><option value="room">Room Bookings</option><option value="kitchen_sales">Kitchen Sales</option><option value="expense">Expenses</option><option value="kitchen">Kitchen only</option></select><button class="mx-cal" id="mCalBtn" type="button" aria-label="Filter by date" onclick="document.getElementById('mxDates').classList.toggle('open');this.classList.toggle('on')"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 10h18M8 2v4M16 2v4"/></svg></button></div><div class="mx-dates" id="mxDates"><input id="mDate" type="date" aria-label="Filter by date"></div>
<div id="mRows"></div><div class="ms-pager" id="mPager"></div>
</section>
@include('partials.mobile-nav')
</section>
    <header class="top">
        <h1>Expense</h1>
        <div class="profile">
            <span class="avatar hdr-avatar" style="cursor:pointer;overflow:hidden" onclick="openAccount()" title="My account">@if(auth()->user()->avatar)<img src="{{ asset(auth()->user()->avatar) }}" alt="">@else{{ auth()->user()->initials() }}@endif</span>
            <div class="pinfo"><b>{{ auth()->user()->name }}</b><small>{{ ucfirst(auth()->user()->role) }}</small></div>
            <div class="tools">
                <button class="tool" type="button" title="My account" onclick="openAccount()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></button>
                <button class="tool bell" type="button" title="Notifications" onclick="showNotifications()"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
            </div>
        </div>
    </header>
@include('partials.page-head', ['pgTitle'=>'Financials','pgSub'=>'Income, expenses and transactions.'])
@include('partials.fin-period')
    <div class="fin-top">
        <div class="fin-left">
            {{-- Where the cash physically is. Separate from profit below: owner top-ups raise cash, not income. --}}
            <div class="cash-head"><h3>Cash</h3>@if(auth()->user()->role !== 'staff')<span class="cash-actions"><button type="button" class="cash-btn soft" onclick="openCashReport()"><svg viewBox="0 0 24 24"><path d="M12 3v12m0 0 4-4m-4 4-4-4M4 21h16"/></svg>Export Report</button><button type="button" class="cash-btn" onclick="openCashEntry()">+ Cash Entry</button></span>@endif</div>
            <div class="stat-row cash-row">
                <div class="scard sc-click" data-filter="" title="Show these records below">
                    <div class="sc-head"><span class="sc-ic"><svg viewBox="0 0 24 24"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="3"/></svg></span>Cash in Hand</div>
                    <div class="sc-body"><div class="sc-num {{ $cashView['total'] < 0 ? 'neg' : '' }}">PKR {{ number_format($cashView['total']) }}</div><div class="sc-sub">{{ $cashView['as_of'] ? 'closing balance on '.$cashView['as_of'] : 'income cash plus petty cash, right now' }}</div></div>
                </div>
                <div class="scard sc-click" data-filter="cash_income" title="Show these records below">
                    <div class="sc-head"><span class="sc-ic"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v10M9.5 14c0 1 1 2 2.5 2s2.5-.7 2.5-2-1-1.7-2.5-2-2.5-1-2.5-2 1-2 2.5-2 2.5 1 2.5 2"/></svg></span>Income Cash</div>
                    <div class="sc-body"><div class="sc-num {{ $cashView['income'] < 0 ? 'neg' : '' }}">PKR {{ number_format($cashView['income']) }}</div><div class="sc-sub">PKR {{ number_format($cashView['income_in']) }} received, PKR {{ number_format($cashView['income_out']) }} out {{ $period['word'] }}</div></div>
                </div>
                <div class="scard sc-click" data-filter="cash_petty" title="Show these records below">
                    <div class="sc-head"><span class="sc-ic amber"><svg viewBox="0 0 24 24"><path d="M20 7H5a2 2 0 0 1 0-4h13v4M3 5v13a2 2 0 0 0 2 2h15v-4"/><path d="M20 12h-4a2 2 0 0 0 0 4h4z"/></svg></span>Petty Cash</div>
                    <div class="sc-body"><div class="sc-num {{ $cashView['petty'] < 0 ? 'neg' : '' }}">PKR {{ number_format($cashView['petty']) }}</div><div class="sc-sub">PKR {{ number_format($cashView['petty_in']) }} added, PKR {{ number_format($cashView['petty_out']) }} spent {{ $period['word'] }}</div></div>
                </div>
            </div>
            <div class="cash-head"><h3>Profit</h3></div>
            <div class="stat-row">
                <div class="scard sc-click" data-filter="pl" title="Show these records below">
                    <div class="sc-head"><span class="sc-ic"><svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M16 12h2"/></svg></span>Net Profit<span class="dots">···</span></div>
                    <div class="sc-body"><div class="sc-num">PKR {{ number_format($totalBalance) }}</div><div class="sc-delta">@if($balanceChange === null)<small>all time</small>@else<span class="p {{ $balanceChange < 0 ? 'down' : '' }}">{{ $balanceChange < 0 ? '↘' : '↗' }} {{ number_format(abs($balanceChange), 2) }}%</span><small>{{ $period['compare'] }}</small>@endif</div></div>
                </div>
                <div class="scard sc-click" data-filter="income" title="Show these records below">
                    <div class="sc-head"><span class="sc-ic"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v10M9.5 14c0 1 1 2 2.5 2s2.5-.7 2.5-2-1-1.7-2.5-2-2.5-1-2.5-2 1-2 2.5-2 2.5 1 2.5 2"/></svg></span>Total Income<span class="dots">···</span></div>
                    <div class="sc-body"><div class="sc-num">PKR {{ number_format($totalIncome) }}</div><div class="sc-delta">@if($incomeChange === null)<small>all time</small>@else<span class="p {{ $incomeChange < 0 ? 'down' : '' }}">{{ $incomeChange < 0 ? '↘' : '↗' }} {{ number_format(abs($incomeChange), 2) }}%</span><small>{{ $period['compare'] }}</small>@endif</div></div>
                </div>
                <div class="scard sc-click" data-filter="expense" title="Show these records below">
                    <div class="sc-head"><span class="sc-ic"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8 12h8M12 8l-4 4 4 4"/></svg></span>Total Expenses<span class="dots">···</span></div>
                    <div class="sc-body"><div class="sc-num">PKR {{ number_format($totalExpense) }}</div><div class="sc-delta">@if($expenseChange === null)<small>all time</small>@else<span class="p {{ $expenseChange < 0 ? 'down' : '' }}">{{ $expenseChange < 0 ? '↘' : '↗' }} {{ number_format(abs($expenseChange), 2) }}%</span><small>{{ $period['compare'] }}</small>@endif</div></div>
                </div>
            </div>
            {{-- Where the money comes from, and how the restaurant is doing on its own. --}}
            <div class="stat-row fin-row2">
                <div class="scard sc-click" data-filter="room" title="Show these records below">
                    <div class="sc-head"><span class="sc-ic"><svg viewBox="0 0 24 24"><path d="M3 18V8M3 14h18v4M21 14v-3a2 2 0 0 0-2-2h-8v5"/><path d="M5 11a2.5 2.5 0 0 1 5 0"/></svg></span>Room Income</div>
                    <div class="sc-body"><div class="sc-num">PKR {{ number_format($roomIncome) }}</div><div class="sc-sub">{{ $totalIncome ? round($roomIncome / $totalIncome * 100) : 0 }}% of income · paid bookings</div></div>
                </div>
                <div class="scard sc-click" data-filter="kitchen_sales" title="Show these records below">
                    <div class="sc-head"><span class="sc-ic amber"><svg viewBox="0 0 24 24"><path d="M6 3v7a2 2 0 0 0 4 0V3M8 12v9M17 3c-2 0-3.5 2.2-3.5 5.5S15 13 17 13v8"/></svg></span>Kitchen Sales<a class="sc-go" href="{{ url('/kitchen') }}">Open</a></div>
                    <div class="sc-body"><div class="sc-num">PKR {{ number_format($kitchenIncome) }}</div><div class="sc-sub">{{ $totalIncome ? round($kitchenIncome / $totalIncome * 100) : 0 }}% of income · paid orders</div></div>
                </div>
                <div class="scard sc-click" data-filter="kitchen" title="Show these records below">
                    <div class="sc-head"><span class="sc-ic {{ $kitchenIncome - $kitchenCosts < 0 ? 'red' : '' }}"><svg viewBox="0 0 24 24"><path d="M3 17l6-6 4 4 8-8M15 7h6v6"/></svg></span>Kitchen Profit</div>
                    <div class="sc-body"><div class="sc-num {{ $kitchenIncome - $kitchenCosts < 0 ? 'neg' : '' }}">PKR {{ number_format($kitchenIncome - $kitchenCosts) }}</div><div class="sc-sub">sales minus PKR {{ number_format($kitchenCosts) }} kitchen costs</div></div>
                </div>
            </div>
            {{-- Earnings chart disabled on request. Remove this comment to bring it back.
            <div class="earn">
                <div class="earn-top"><h2>Earnings</h2><select class="fsel" style="height:38px" onchange="location.href='{{ url('/expenses') }}?year='+this.value">@foreach($years as $y)<option value="{{ $y }}" {{ $y == $chartYear ? 'selected' : '' }}>{{ $y == now()->year ? 'This Year' : $y }}</option>@endforeach</select></div>
                <div class="legend"><span><i class="li"></i>Income</span><span><i class="le"></i>Expense</span></div>
                <div class="ec">
                    @php
                        // With a small scale the half-step rounds to the same label as the top one
                        // ("1K, 1K, 0, -1K, -1K"), so fall back to three ticks.
                        $tickTop = $chartMax / 1000;
                        $tickMid = $chartMax / 2000;
                        $showMid = round($tickTop) != round($tickMid) && round($tickMid) > 0;
                    @endphp
                    <div class="ey"><span>{{ number_format($tickTop, 0) }}K</span>@if($showMid)<span>{{ number_format($tickMid, 0) }}K</span>@endif<span>0</span>@if($showMid)<span>-{{ number_format($tickMid, 0) }}K</span>@endif<span>-{{ number_format($tickTop, 0) }}K</span></div>
                    <div class="eplot" id="eplot"><div class="gl g1"></div><div class="gl g0"></div><div class="gl g3"></div></div>
                </div>
            </div>
            --}}
        </div>
        {{-- Income/Expense donut disabled on request. Remove this comment to bring it back.
        <div class="donut-card">
            <div class="toggle"><button type="button" id="incomeToggle" onclick="showDonut('income')">Income</button><button type="button" id="expenseToggle" class="on" onclick="showDonut('expense')">Expense</button></div>
            @php $acc=0; $stops=[]; foreach($cats as $c){ $end=$acc+$c['percent']; $stops[]=$c['color'].' '.$acc.'% '.max($acc,$end-0.8).'%'; $stops[]='#fff '.max($acc,$end-0.8).'% '.$end.'%'; $acc=$end; } $conic=count($stops)?'conic-gradient('.implode(',',$stops).')':'conic-gradient(var(--mint) 0 100%)'; @endphp
            <div class="donut" id="donut" style="background:{{ $conic }}"><div class="hole"><b id="donutTotal">PKR {{ number_format($totalExpense) }}</b><span id="donutLabel">Total Expense</span></div></div>
            <div class="dlegend" id="donutLegend">
                @foreach($cats as $c)
                <div class="dl-row"><i style="background:{{ $c['color'] }}"></i><span>{{ $c['name'] }} <span class="pct">({{ rtrim(rtrim(number_format($c['percent'],2),'0'),'.') }}%)</span></span><b>PKR {{ number_format($c['amount']) }}</b></div>
                @endforeach
                @if(!count($cats))<div class="dl-row"><span style="color:#aaa">No expenses yet</span></div>@endif
            </div>
        </div>
        --}}
    </div>
    <section class="panel">
        <div class="pt">
            <h2>Transactions</h2>
            <div class="pt-r">
                <div class="searchbox"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg><input class="search" id="fSearch" placeholder="Search records"></div>
                <select class="fsel" id="fCat"><option value="">All Category</option>@foreach($categoryGroups as $group => $items)<optgroup label="{{ $group }}">@foreach($items as $item)<option>{{ $item }}</option>@endforeach</optgroup>@endforeach</select>
                <select class="fsel" id="fStatus"><option value="">All Records</option><option value="cash_income">Income Cash</option><option value="cash_petty">Petty Cash</option><option value="pl">Income &amp; Expenses</option><option value="income">All Income</option><option value="room">Room Bookings</option><option value="kitchen_sales">Kitchen Sales</option><option value="expense">Expenses</option><option value="kitchen">Kitchen only</option></select>
                <div class="pill" style="padding:0 12px"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/></svg><input id="fFrom" type="date" style="border:0;background:transparent;font:inherit;color:#333;width:130px" aria-label="From"><span style="color:#9a9a9a">to</span><input id="fTo" type="date" style="border:0;background:transparent;font:inherit;color:#333;width:130px" aria-label="To"></div>
                <button class="exp-report-btn" type="button" onclick="openExpenseReport()">Export PDF</button>
                <button class="pill" style="background:var(--lime);color:#2f3a0c;font-weight:700" onclick="openExpenseCreator()">+ Add Expense</button>
            </div>
        </div>
        <div class="lg-sum" id="lgSum"></div>
        <div class="lg-bulk" id="lgBulk"><span id="lgBulkCount"></span><button type="button" onclick="bulkPaidFrom('petty')">Paid from Petty Cash</button><button type="button" onclick="bulkPaidFrom('income')">Paid from Income Cash</button><button type="button" onclick="bulkClear()">Clear</button></div>
        <div class="tbl">
            <div class="thead">
                <span onclick="sortCol('exp','name',applyFilters)" style="cursor:pointer">Record @include('partials.sort')</span>
                <span onclick="sortCol('exp','category',applyFilters)" style="cursor:pointer">Category @include('partials.sort')</span>
                <span onclick="sortCol('exp','quantity',applyFilters)" style="cursor:pointer">Quantity @include('partials.sort')</span>
                <span onclick="sortCol('exp','amount',applyFilters)" style="cursor:pointer">Amount @include('partials.sort')</span>
                <span onclick="sortCol('exp','date',applyFilters)" style="cursor:pointer">Date @include('partials.sort')</span>
                <span onclick="sortCol('exp','kind',applyFilters)" style="cursor:pointer">Type @include('partials.sort')</span>
                <span>Action</span>
            </div>
            <div id="rows"></div>
        </div>
        <div class="tbottom">
            <span id="expInfo">Showing…</span>
            <div class="pages" id="expPages"></div>
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
// Earnings diverging bars. [month, incomeK, expenseK, highlight]
const H=140, MAX={{ $chartMax }};
const earn=@json($earnings);
// With nothing booked or spent this year the bars are all zero and the grid reads as broken.
const hasEarnings = earn.some(m => Number(m.income) > 0 || Number(m.expense) > 0);
if(!hasEarnings && document.querySelector('.ec')){
  document.querySelector('.ec').innerHTML =
    '<div class="ec-empty"><svg viewBox="0 0 24 24"><path d="M4 20V10M10 20V4M16 20v-8M22 20H2"/></svg>'+
    '<b>No earnings recorded for {{ $chartYear }} yet</b>'+
    '<span>Income appears here once a booking has check-in dates and is marked paid.</span></div>';
}
document.getElementById('eplot') && hasEarnings && document.getElementById('eplot').insertAdjacentHTML('beforeend', earn.map(m=>{
 const up=Math.round(m.income/MAX*H), dn=Math.round(m.expense/MAX*H);
 const tip='<div class="tip"><b>'+m.month+' {{ $chartYear }}</b><div class="r"><span>Income</span><b>PKR '+m.income.toLocaleString()+'</b></div><div class="r"><span>Expense</span><b>PKR '+m.expense.toLocaleString()+'</b></div></div>';
 return '<div class="mo">'+tip+'<div class="up" style="height:'+up+'px"></div><div class="dn" style="height:'+dn+'px"></div><span class="ml">'+m.month+'</span></div>';
}).join(''));
const expenseDonut=@json($cats), incomeDonut=@json($incomeCats);
function showDonut(type){const categories=type==='income'?incomeDonut:expenseDonut;const total=categories.reduce((sum,item)=>sum+Number(item.amount||0),0);let start=0;const stops=[];categories.forEach(item=>{const end=start+Number(item.percent||0);stops.push(item.color+' '+start+'% '+Math.max(start,end-.8)+'%','#fff '+Math.max(start,end-.8)+'% '+end+'%');start=end;});document.getElementById('donut').style.background=stops.length?'conic-gradient('+stops.join(',')+')':'conic-gradient(#eefbf4 0 100%)';document.getElementById('donutTotal').textContent='PKR '+total.toLocaleString();document.getElementById('donutLabel').textContent=type==='income'?'Total Income':'Total Expense';document.getElementById('donutLegend').innerHTML=categories.length?categories.map(item=>'<div class="dl-row"><i style="background:'+item.color+'"></i><span>'+item.name+' <span class="pct">('+Number(item.percent).toFixed(2).replace(/\.00$/,'')+'%)</span></span><b>PKR '+Number(item.amount).toLocaleString()+'</b></div>').join(''):'<div class="dl-row"><span style="color:#aaa">No '+type+' data yet</span></div>';document.getElementById('incomeToggle').classList.toggle('on',type==='income');document.getElementById('expenseToggle').classList.toggle('on',type==='expense');}
// Transactions
const eye='<svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>';
const dl='<svg viewBox="0 0 24 24"><path d="M12 3v12m0 0 4-4m-4 4-4-4M4 21h16"/></svg>';
const data=@json($expenses);
// One ledger: expenses, plus paid restaurant orders and paid bookings as income.
const KITCHEN_CATS=@json($kitchenCats);
const ledger=[...data.map(e=>({...e,kind:'expense'})),...@json($incomeRecords),...@json($cashRecords)];
const CASH=@json($cash);
const WLABEL={income:'Income Cash',petty:'Petty Cash'};
const walletOf=e=>e.paid_from==='petty'?'petty':'income';
// Does a record move money in or out of a wallet? Returns +1, -1 or 0.
function walletSign(r,w){
  if(r.kind==='income')return w==='income'?1:0;
  if(r.kind==='expense')return walletOf(r)===w?-1:0;
  if(r.type==='topup')return w==='petty'?1:0;
  if(r.type==='transfer')return w==='petty'?1:-1;
  return r.wallet===w?-1:0; // cash_out
}
const isKitchen=r=>r.kind==='income'?r.source==='kitchen':KITCHEN_CATS.includes(r.category);
const esc=x=>String(x==null?'':x).replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
const fmt=d=>{if(!d)return'';const p=String(d).slice(0,10).split('-');const M=['January','February','March','April','May','June','July','August','September','October','November','December'];return M[+p[1]-1]+' '+(+p[2])+', '+p[0]};
function mExpDetail(id){const e=data.find(x=>x.id===id);if(e)showDetail(e.name,'Category: '+(e.category||'-')+'<br>Quantity: '+e.quantity+'<br>Amount: PKR '+e.amount+'<br>Date: '+fmt(e.date)+'<br>Status: Completed');}
function mExpDownload(id){const e=data.find(x=>x.id===id);if(e)downloadFile('expense-'+e.id+'.pdf','INDUS RESORT RESTAURANT EXPENSE\n===============\nExpense: '+e.name+'\nCategory: '+(e.category||'')+'\nQuantity: '+e.quantity+'\nAmount: PKR '+e.amount+'\nDate: '+fmt(e.date));}
const mxIcons={'Supplies':['mint','<path d="M6 8h12l-1 12H7z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/>'],'Utilities':['blue','<path d="M13 2 4 14h7l-1 8 9-12h-7z"/>'],'Marketing and Advertising':['gold','<path d="M3 11v2a2 2 0 0 0 2 2h2l6 4V5L7 9H5a2 2 0 0 0-2 2z"/><path d="M17 8a5 5 0 0 1 0 8"/>'],'Maintenance and Repairs':['pink','<path d="M14.7 6.3a4 4 0 0 0-5.4 5.4L3 18l3 3 6.3-6.3a4 4 0 0 0 5.4-5.4l-2.6 2.6-2.1-2.1z"/>'],'Salaries and Wages':['purple','<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20a6.5 6.5 0 0 1 13 0"/><circle cx="17" cy="9" r="2.5"/><path d="M16 15.5a5 5 0 0 1 5.5 4.5"/>']};
function renderMobile(list){const el=document.getElementById('mRows');if(!el)return;el.innerHTML=list.map(e=>{
  if(e.kind==='income'){const svg=e.source==='kitchen'?'<path d="M6 3v7a2 2 0 0 0 4 0V3M8 12v9M17 3c-2 0-3.5 2.2-3.5 5.5S15 13 17 13v8"/>':'<path d="M3 18V8M3 14h18v4M21 14v-3a2 2 0 0 0-2-2h-8v5"/><path d="M5 11a2.5 2.5 0 0 1 5 0"/>';
    return `<div class="mx-row" onclick="location.href='${e.link}'"><span class="ic mint"><svg viewBox="0 0 24 24">${svg}</svg></span><div class="tx"><b>${esc(e.name)}</b><small>${esc(e.category)}</small><small>${esc(e.detail||'')} &nbsp;•&nbsp; ${msDate(e.date)}</small></div><div class="amt"><b style="color:#2f6b4f">+ ${msMoney(e.amount)}</b><span class="ms-pill completed">Income</span>${attButton(e.receipts,'ms-pill blue att-pill',(e.receipts||[]).length>1?'Receipts':'Receipt','Receipts · '+e.name,true)}${CAN_MANAGE?`<span class="ms-pill blue" style="margin-left:4px" onclick="event.stopPropagation();location.href='${e.source==='kitchen'?'/kitchen':'/reservation'}?edit=${e.ref}'">Edit</span>`:''}</div><svg class="chev" viewBox="0 0 24 24"><path d="m9 6 6 6-6 6"/></svg></div>`;}
  if(e.kind==='cash'){const w=window.LG_WALLET, sg=w?walletSign(e,w):(e.type==='topup'?1:e.type==='cash_out'?-1:0);
    return `<div class="mx-row" style="cursor:default"><span class="ic blue"><svg viewBox="0 0 24 24"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="3"/></svg></span><div class="tx"><b>${esc(e.name)}</b><small>${esc(e.category)}</small><small>${esc(e.detail||'')} &nbsp;•&nbsp; ${msDate(e.date)}</small></div><div class="amt"><b style="color:${sg>0?'#2f6b4f':sg<0?'#b3352f':'#1e4f8f'}">${sg>0?'+ ':sg<0?'− ':''}${msMoney(e.amount)}</b><span class="ms-pill blue">Cash</span>${attButton(e.receipts,'ms-pill blue att-pill',(e.receipts||[]).length>1?'Receipts':'Receipt','Receipts · '+e.name,true)}${CAN_MANAGE?`<span class="ms-pill blue" style="margin-left:4px" onclick="event.stopPropagation();openCashEntry(${e.ref})">Edit</span>`:''}</div><span></span></div>`;}
  const ic=mxIcons[e.category]||['gray','<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 8h8M8 12h8M8 16h5"/>'];
  return `<div class="mx-row" onclick="viewExpense(${e.id})"><span class="ic ${ic[0]}"><svg viewBox="0 0 24 24">${ic[1]}</svg></span><div class="tx"><b>${esc(e.name)}</b><small>${esc(e.category||'')}</small><small>${WLABEL[walletOf(e)]} &nbsp;•&nbsp; ${msDate(e.date)}</small></div><div class="amt"><b style="color:#b3352f">− ${msMoney(e.amount)}</b><span class="ms-pill red">Expense</span>${CAN_MANAGE?`<span class="ms-pill blue" style="margin-left:4px" onclick="event.stopPropagation();openExpenseEditor(${e.id})">Edit</span>`:''}</div><svg class="chev" viewBox="0 0 24 24"><path d="m9 6 6 6-6 6"/></svg></div>`;
}).join('')||'<div class="ms-empty">No records found</div>';}
function render(list){renderMobile(list);document.getElementById('rows').innerHTML=list.map(e=>{
  if(e.kind==='income'){
    return `<div class="trow"><span class="lg-name"><b>${esc(e.name)}</b><small title="${esc(e.detail||'')}">${esc(e.detail||'')}</small></span><span>${esc(e.category)}</span><span>${e.quantity} ${e.source==='room'?(e.quantity===1?'night':'nights'):(e.quantity===1?'item':'items')}</span><span class="lg-amt in">+ PKR ${Number(e.amount).toLocaleString()}</span><span>${fmt(e.date)}</span><span><em class="lg-type in">Income</em></span><span class="act">${attButton(e.receipts,'lg-rc',rcIco,'Receipts · '+e.name)}${CAN_MANAGE?`<a class="lg-rc lg-ed" title="${e.source==='kitchen'?'Edit order':'Edit reservation'}" href="${e.source==='kitchen'?'/kitchen':'/reservation'}?edit=${e.ref}">${edIco}</a>`:''}<a class="lg-open" href="${e.link}">${e.source==='kitchen'?'Open Kitchen':'View Booking'}</a></span></div>`;}
  if(e.kind==='cash'){
    const w=window.LG_WALLET, sg=w?walletSign(e,w):(e.type==='topup'?1:e.type==='cash_out'?-1:0);
    const amt=sg>0?`<span class="lg-amt in">+ PKR ${Number(e.amount).toLocaleString()}</span>`:sg<0?`<span class="lg-amt out">− PKR ${Number(e.amount).toLocaleString()}</span>`:`<span class="lg-amt move">PKR ${Number(e.amount).toLocaleString()}</span>`;
    return `<div class="trow"><span class="lg-name"><b>${esc(e.name)}</b><small title="${esc(e.detail)}">${esc(e.detail)}</small></span><span>${esc(e.category)}</span><span>—</span>${amt}<span>${fmt(e.date)}</span><span><em class="lg-type cash">Cash</em></span><span class="act">${attButton(e.receipts,'lg-rc',rcIco,'Receipts · '+e.name)}${CAN_MANAGE?`<button class="eye" title="Edit cash entry" onclick="openCashEntry(${e.ref})"><svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></svg></button>`:''}${IS_ADMIN?`<button class="eye" title="Delete cash entry" onclick="if(confirm('Delete this cash entry?'))post('/cash/${e.ref}','DELETE')">🗑</button>`:''}</span></div>`;}
  return `<div class="trow" style="cursor:pointer" onclick="viewExpense(${e.id})"><span class="lg-name"><b>${CAN_MANAGE?`<input type="checkbox" class="lg-pick" value="${e.id}" ${PICKED.has(e.id)?'checked':''} onclick="event.stopPropagation();bulkToggle(${e.id},this.checked)">`:''}${esc(e.name)}</b><small><i class="lg-wallet ${walletOf(e)}" style="font-style:normal">${WLABEL[walletOf(e)]}</i></small></span><span>${esc(e.category||'')}</span><span>${e.quantity}</span><span class="lg-amt out">− PKR ${Number(e.amount).toLocaleString()}</span><span>${fmt(e.date)}</span><span><em class="lg-type out">Expense</em></span><span class="act"><button class="eye" title="View" onclick="event.stopPropagation();viewExpense(${e.id})">${eye}</button><a class="dl" href="/expenses/${e.id}/download" onclick="event.stopPropagation()">${dl} Download</a>${editExpenseButton(e.id)}${deleteExpenseButton(e.id)}</span></div>`;
}).join('')||'<div class="trow"><span>No results</span></div>';}
const expensesById=Object.fromEntries(data.map(expense=>[expense.id,expense]));
function viewExpense(id){const e=expensesById[id];if(!e)return;const files=e.attachments||[];const receipt=files.length?'<div style="margin-top:14px"><b>'+(files.length>1?files.length+' Receipts':'Receipt')+'</b>'+files.map(f=>/\.pdf$/i.test(f.path)?'':'<a href="/'+attEsc(f.path)+'" target="_blank" rel="noopener"><img src="/'+attEsc(f.path)+'" alt="Expense receipt" style="display:block;max-width:100%;max-height:320px;margin-top:8px;border:1px solid #e5e5e5;border-radius:8px"></a>').join('')+attLinks(files)+'</div>':'<div style="margin-top:14px;color:#888">No receipt uploaded.</div>';showDetail(e.name,'Category: '+(e.category||'-')+'<br>Quantity: '+e.quantity+'<br>Amount: PKR '+e.amount+'<br>Date: '+fmt(e.date)+'<br>Paid from: '+WLABEL[walletOf(e)]+'<br>Status: Completed'+receipt);}
function downloadExpensePdf(id){const e=expensesById[id];if(!e)return;const content=['INDUS RESORT RESTAURANT EXPENSE','================================','Expense: '+e.name,'Category: '+(e.category||''),'Quantity: '+e.quantity,'Amount: PKR '+e.amount,'Date: '+fmt(e.date)].join(String.fromCharCode(10));downloadFile('expense-'+e.id+'.pdf',content);}

/* Category picker: filter the grouped list as you type; Enter or the "Add" row keeps a custom category. */
function catOpen(){document.getElementById('catList').classList.add('open');catFilter(document.getElementById('catInput').value);}
function catClose(){document.getElementById('catList').classList.remove('open');}
function catFilter(q){q=(q||'').trim().toLowerCase();let any=false,exact=false;document.querySelectorAll('#catList .catgroup').forEach(g=>{let vis=0;g.querySelectorAll('.catitem').forEach(it=>{const v=it.dataset.v.toLowerCase();const ok=!q||v.includes(q)||g.dataset.group.toLowerCase().includes(q);it.classList.toggle('hide',!ok);it.classList.remove('hl');if(ok)vis++;if(v===q)exact=true;});g.classList.toggle('hide',!vis);if(vis)any=true;});const nw=document.getElementById('catNew');nw.classList.toggle('hide',!q||exact);document.getElementById('catNewText').textContent=q?document.getElementById('catInput').value.trim():'';}
function catPickItem(v){const i=document.getElementById('catInput');i.value=v;catClose();}
function catKey(e){if(e.key==='Enter'){e.preventDefault();const first=document.querySelector('#catList .catitem:not(.hide)');const q=e.target.value.trim();if(first&&first.dataset.v.toLowerCase()===q.toLowerCase())catPickItem(first.dataset.v);else catClose();}else if(e.key==='Escape')catClose();}
document.addEventListener('mousedown',e=>{if(!e.target.closest('#catPick'))catClose();});
function openExpenseCreator(){const f=document.getElementById('expForm');f.reset();f.action='{{ url('/expenses') }}';document.getElementById('expMethod').value='';document.getElementById('expModalTitle').textContent='Add Expense';document.getElementById('receiptName').textContent='No file selected';attEditable('expReceiptNow',[]);PF_ORIG=null;pfSync();openModal('addExp');}
function openExpenseEditor(id){const e=(window.expensesById&&expensesById[id])||data.find(x=>x.id===id);if(!e)return;const f=document.getElementById('expForm');f.reset();f.action='{{ url('/expenses') }}/'+e.id;document.getElementById('expMethod').value='PUT';document.getElementById('expModalTitle').textContent='Edit Expense';document.getElementById('receiptName').textContent='No file selected';attEditable('expReceiptNow',e.attachments);['name','quantity','amount'].forEach(k=>{if(f.elements[k])f.elements[k].value=e[k]??'';});if(f.elements.date)f.elements.date.value=String(e.date||'').slice(0,10);if(f.elements.category)f.elements.category.value=e.category||'';if(f.elements.paid_from)f.elements.paid_from.value=walletOf(e);PF_ORIG=e;pfSync();openModal('addExp');}
function editExpenseButton(id){return CAN_MANAGE?'<button class="eye" title="Edit" onclick="event.stopPropagation();openExpenseEditor('+id+')"><svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></svg></button>':'';}
function deleteExpenseButton(id){return IS_ADMIN?'<button class="eye" title="Delete" onclick="event.stopPropagation();if(confirm(\'Delete this expense?\'))post(\'/expenses/'+id+'\',\'DELETE\')">🗑</button>':'';}
function openExpenseReport(){document.getElementById('expenseReportForm').reset();document.getElementById('reportFrom').value='{{ now()->startOfMonth()->format('Y-m-d') }}';document.getElementById('reportTo').value='{{ now()->format('Y-m-d') }}';openModal('expenseReportModal');}
function submitExpenseReport(form){const button=form.querySelector('button[type="submit"]');if(button){button.disabled=true;button.textContent='Preparing PDF…';button.style.opacity='.7';}closeModal('expenseReportModal');return true;}
// ---- Bulk re-filing: tick expenses, then say which wallet paid for them. ----
const PICKED=new Set();
function bulkToggle(id,on){on?PICKED.add(id):PICKED.delete(id);bulkSync();}
function bulkSync(){const bar=document.getElementById('lgBulk');if(!bar)return;bar.classList.toggle('on',PICKED.size>0);document.getElementById('lgBulkCount').textContent=PICKED.size+(PICKED.size===1?' expense selected. Mark as:':' expenses selected. Mark as:');}
function bulkClear(){PICKED.clear();applyFilters();}
function bulkPaidFrom(w){if(!PICKED.size)return;const f=document.createElement('form');f.method='POST';f.action='/expenses/paid-from';f.style.display='none';let h='<input name="_token" value="'+document.querySelector('meta[name=csrf-token]').content+'"><input name="paid_from" value="'+w+'">';PICKED.forEach(id=>h+='<input name="ids[]" value="'+id+'">');f.innerHTML=h;document.body.appendChild(f);f.submit();}

// ---- Cash report modal: quick ranges fill the two dates ----
const RP_FIRST=@json(optional(\App\Support\Cashbook::entries()->first())['date'] ?? now()->toDateString());
function rpRange(kind){const pad=n=>String(n).padStart(2,'0'), iso=d=>d.getFullYear()+'-'+pad(d.getMonth()+1)+'-'+pad(d.getDate());
  const now=new Date(); let a,b=now;
  if(kind==='month')a=new Date(now.getFullYear(),now.getMonth(),1);
  else if(kind==='last'){a=new Date(now.getFullYear(),now.getMonth()-1,1);b=new Date(now.getFullYear(),now.getMonth(),0);}
  else if(kind==='year')a=new Date(now.getFullYear(),0,1);
  else{document.getElementById('rpFrom').value=RP_FIRST;document.getElementById('rpTo').value=iso(now);return;}
  document.getElementById('rpFrom').value=iso(a);document.getElementById('rpTo').value=iso(b);}
function rpPick(kind){rpRange(kind);document.querySelectorAll('#rpQuick button').forEach(x=>x.classList.toggle('on',x.dataset.range===kind));}
const FIN_PERIOD=@json(['key' => $period['key'], 'from' => $period['from'], 'to' => $period['to']]);
function openCashReport(){const k=FIN_PERIOD.key;
  if(k==='custom'){rpPick('');document.getElementById('rpFrom').value=FIN_PERIOD.from;document.getElementById('rpTo').value=FIN_PERIOD.to;}
  else rpPick(k==='last_month'?'last':k==='all'?'all':'month');
  openModal('cashReportModal');}
document.addEventListener('click',e=>{const b=e.target.closest('#rpQuick button');if(b)rpPick(b.dataset.range);});
document.addEventListener('input',e=>{if(e.target.id==='rpFrom'||e.target.id==='rpTo')document.querySelectorAll('#rpQuick button').forEach(x=>x.classList.remove('on'));});

// ---- Cash entry modal ----
const edIco='<svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>';
const rcIco='<svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 14h8M8 18h5"/></svg>';
/* With an id the same form edits that cash entry; without one it records a new entry. */
function openCashEntry(id){const f=document.getElementById('cashForm'),m=id?ledger.find(r=>r.kind==='cash'&&r.ref===id):null;f.reset();
 f.action=m?'/cash/'+m.ref:'/cash';document.getElementById('cashMethod').value=m?'PUT':'';document.getElementById('cashTitle').textContent=m?'Edit Cash Entry':'Cash Entry';
 document.getElementById('cashReceiptName').textContent='No file attached';attEditable('cashReceiptNow',m?m.receipts:[]);
 if(m){f.elements.type.value=m.type;f.elements.wallet.value=m.wallet||'income';f.elements.amount.value=m.amount;f.elements.date.value=String(m.date||'').slice(0,10);f.elements.note.value=m.detail||'';}
 cashTypeSync();openModal('cashModal');}
function cashTypeSync(){const t=document.getElementById('cashType').value;document.getElementById('cashWalletWrap').style.display=t==='cash_out'?'':'none';
  const hint={topup:'Money the owner sent. It goes into Petty Cash and is not counted as income.',transfer:'Moves money from Income Cash (PKR '+Number(CASH.income).toLocaleString()+') into Petty Cash.',cash_out:'Cash leaving the resort, for example handed to the owner or banked.'};
  document.getElementById('cashHint').textContent=hint[t];}

// ---- "Paid from" on the expense form: show what the wallet holds and what would be left. ----
let PF_ORIG=null; // the expense being edited, so its own amount is not counted twice
function pfSync(){const sel=document.getElementById('expPaidFrom'),hint=document.getElementById('pfHint');if(!sel||!hint)return;
  const w=sel.value, amt=parseInt(document.querySelector('#expForm [name=amount]').value)||0;
  let bal=Number(CASH[w]); if(PF_ORIG&&walletOf(PF_ORIG)===w)bal+=Number(PF_ORIG.amount||0);
  const left=bal-amt;
  hint.className='pf-hint'+(left<0?' warn':'');
  hint.textContent=WLABEL[w]+' has PKR '+bal.toLocaleString()+'. After this expense: PKR '+left.toLocaleString()+(left<0?'. This is more than the wallet holds.':'.');
  return left;}

function applyFilters(){
  const q=(document.getElementById('fSearch').value||'').toLowerCase();const cat=document.getElementById('fCat').value;const kind=document.getElementById('fStatus').value;
  const from=(document.getElementById('fFrom')||{}).value, to=(document.getElementById('fTo')||{}).value;
  const day=r=>String(r.date||'').slice(0,10);
  const list=ledger.filter(r=>(!mxDate()||day(r)===mxDate())&&(!from||day(r)>=from)&&(!to||day(r)<=to)
    &&(!cat||r.category===cat)
    &&(!kind||(kind==='cash_income'?walletSign(r,'income')!==0:kind==='cash_petty'?walletSign(r,'petty')!==0:kind==='pl'?(r.kind==='income'||r.kind==='expense'):kind==='kitchen'?(r.kind!=='cash'&&isKitchen(r)):kind==='room'?(r.kind==='income'&&r.source==='room'):kind==='kitchen_sales'?(r.kind==='income'&&r.source==='kitchen'):r.kind===kind))
    &&(!q||[r.name,r.category,r.detail].join(' ').toLowerCase().includes(q)));
  // Newest first unless a column sort is active.
  list.sort((a,b)=>day(b).localeCompare(day(a)));
  const inc=list.filter(r=>r.kind==='income').reduce((t,r)=>t+Number(r.amount||0),0), exp=list.filter(r=>r.kind==='expense').reduce((t,r)=>t+Number(r.amount||0),0);
  const sum=document.getElementById('lgSum');
  const wal=kind==='cash_income'?'income':kind==='cash_petty'?'petty':null;
  if(sum&&wal){
    // A wallet view totals what came in and went out of that wallet for the rows shown.
    const cin=list.reduce((t,r)=>t+(walletSign(r,wal)>0?Number(r.amount||0):0),0), cout=list.reduce((t,r)=>t+(walletSign(r,wal)<0?Number(r.amount||0):0),0);
    sum.innerHTML=`<span>Records <b>${list.length}</b></span><span>In <b style="color:#2f6b4f">PKR ${cin.toLocaleString()}</b></span><span>Out <b style="color:#b3352f">PKR ${cout.toLocaleString()}</b></span><span>${WLABEL[wal]} now <b style="color:${CASH[wal]<0?'#b3352f':'#123527'}">PKR ${Number(CASH[wal]).toLocaleString()}</b></span>`;
  } else if(sum)sum.innerHTML=`<span>Records <b>${list.length}</b></span><span>Income <b style="color:#2f6b4f">PKR ${inc.toLocaleString()}</b></span><span>Expenses <b style="color:#b3352f">PKR ${exp.toLocaleString()}</b></span><span>Net <b style="color:${inc-exp<0?'#b3352f':'#123527'}">PKR ${(inc-exp).toLocaleString()}</b></span>`;
  window.LG_WALLET=wal; bulkSync();
  pgReset('exp');paginateRender('exp',sortList('exp',list),8,render);}
msMirror([['mSearch','fSearch','input'],['mCat','fCat'],['mStatus','fStatus']]);
// The form's markup comes after this script, so listen on the document instead of the form.
document.addEventListener('submit',e=>{if(e.target.id!=='expForm')return;const left=pfSync();const w=document.getElementById('expPaidFrom').value;if(left<0&&!confirm(WLABEL[w]+' does not hold this much. It will go PKR '+Math.abs(left).toLocaleString()+' below zero. Save anyway?'))e.preventDefault();});
// A card is a shortcut to the records it summarises.
document.querySelectorAll('.sc-click').forEach(card=>card.addEventListener('click',e=>{
  if(e.target.closest('a'))return;
  const f=document.getElementById('fStatus'), m=document.getElementById('mStatus');
  f.value=card.dataset.filter; if(m)m.value=card.dataset.filter;
  applyFilters();
  document.querySelectorAll('.sc-click').forEach(c=>c.classList.toggle('on',c===card));
  const panel=document.querySelector('.main>.panel'); if(panel)panel.scrollIntoView({behavior:'smooth',block:'start'});
}));
document.getElementById('fStatus').addEventListener('change',()=>{const v=document.getElementById('fStatus').value;document.querySelectorAll('.sc-click').forEach(c=>c.classList.toggle('on',c.dataset.filter===v));});
// Total Balance covers every record, so it is the selected card when the page opens.
(()=>{const v=document.getElementById('fStatus').value||'';document.querySelectorAll('.sc-click').forEach(c=>c.classList.toggle('on',c.dataset.filter===v));})();
function mxDate(){const d=document.getElementById('mDate');return d?d.value:'';}
(function(){const d=document.getElementById('mDate');if(d)d.addEventListener('change',applyFilters);})();
function mxViewAll(){['mSearch','fSearch','mCat','fCat','mStatus','fStatus','mDate'].forEach(id=>{const el=document.getElementById(id);if(el)el.value='';});applyFilters();}
/* Phone earnings chart: income bars up, expense bars down, from the same monthly data as the desktop chart. */
(function(){const plot=document.getElementById('mxPlot'),y=document.getElementById('mxY'),x=document.getElementById('mxX');if(!plot||!earn.length)return;if(!hasEarnings){const chart=plot.closest('.mx-chart');if(chart){chart.innerHTML='<div class="mx-empty">No earnings recorded for {{ $chartYear }} yet</div>';chart.style.display='block';}if(x)x.innerHTML='';return;}const H2=100,n=earn.length,w=100/n;const k=v=>{const t=Math.abs(v)/1000;return (v<0?'-':'')+(t>=10?Math.round(t):Math.round(t*10)/10)+'K';};y.innerHTML=[MAX,MAX/2,0,-MAX/2,-MAX].map(v=>'<span>'+(v?k(v):'0')+'</span>').join('');plot.insertAdjacentHTML('beforeend',earn.map((m,i)=>'<div class="mo" style="left:'+(i*w)+'%;width:'+w+'%"><div class="up" style="height:'+Math.round(Math.min(1,m.income/MAX)*H2)+'px"></div><div class="dn" style="height:'+Math.round(Math.min(1,m.expense/MAX)*H2)+'px"></div></div>').join(''));x.style.gridTemplateColumns='repeat('+n+',1fr)';x.innerHTML=earn.map(m=>'<span>'+m.month+'</span>').join('');})();
function mxDonut(type){const cats=type==='income'?incomeDonut:expenseDonut;const total=cats.reduce((s,c)=>s+Number(c.amount||0),0);let start=0;const stops=[];cats.forEach(c=>{const end=start+Number(c.percent||0);stops.push(c.color+' '+start+'% '+Math.max(start,end-.8)+'%','#fff '+Math.max(start,end-.8)+'% '+end+'%');start=end;});const d=document.getElementById('mxDonut');if(!d)return;d.style.background=stops.length?'conic-gradient('+stops.join(',')+')':'conic-gradient(#d9f5e5 0 100%)';document.getElementById('mxTotal').textContent=msMoney(total);document.getElementById('mxLabel').textContent=type==='income'?'Total Income':'Total Expense';document.getElementById('mxLegend').innerHTML=cats.length?cats.map(c=>'<div><i style="background:'+c.color+'"></i><span>'+c.name+' <em>('+Number(c.percent).toFixed(2).replace(/\.00$/,'')+'%)</em></span><b>'+msMoney(c.amount)+'</b></div>').join(''):'<div><span style="color:#aaa">No '+type+' data yet</span></div>';document.getElementById('mxIncBtn').classList.toggle('on',type==='income');document.getElementById('mxExpBtn').classList.toggle('on',type!=='income');}
if(document.getElementById('mxDonut'))mxDonut('expense');
['fSearch','fCat','fStatus','fFrom','fTo'].forEach(id=>{const el=document.getElementById(id);if(el)el.addEventListener(id==='fSearch'?'input':'change',applyFilters);});
applyFilters();
</script>
<div class="modal-ov" id="addExp"><div class="modal"><h3 id="expModalTitle">Add Expense</h3><form id="expForm" method="POST" action="{{ url('/expenses') }}" enctype="multipart/form-data">@csrf<input type="hidden" name="_method" id="expMethod" value="">
<label>Expense Name</label><input name="name" placeholder="Housekeeping Supplies" required>
<label>Category</label>
<div class="catpick" id="catPick">
  <input type="text" name="category" id="catInput" autocomplete="off" placeholder="Search or type a category, e.g. Electricity Bill" required onfocus="catOpen()" oninput="catFilter(this.value)" onkeydown="catKey(event)">
  <div class="catlist" id="catList">
    @foreach($categoryGroups as $group => $items)
    <div class="catgroup" data-group="{{ $group }}"><div class="cathead">{{ $group }}</div>@foreach($items as $item)<div class="catitem" data-v="{{ $item }}" onmousedown="catPickItem('{{ addslashes($item) }}')">{{ $item }}</div>@endforeach</div>
    @endforeach
    <div class="catnew" id="catNew" onmousedown="catPickItem(document.getElementById('catInput').value.trim())">Add "<b id="catNewText"></b>" as a new category</div>
  </div>
</div>
<div class="mrow"><div><label>Quantity</label><input type="number" name="quantity" value="1"></div><div><label>Amount (PKR)</label><input type="number" name="amount" value="0" oninput="pfSync()"></div></div>
<label>Date</label><input type="date" name="date" value="{{ now()->format('Y-m-d') }}">
<label>Paid from</label>
<select name="paid_from" id="expPaidFrom" onchange="pfSync()">
  <option value="income">Income Cash (PKR {{ number_format($cash['income']) }} available)</option>
  <option value="petty">Petty Cash (PKR {{ number_format($cash['petty']) }} available)</option>
</select>
<div class="pf-hint" id="pfHint"></div>
<label>Receipts / Pictures <span style="color:#9ca3af;font-weight:400">(optional: one or several, image or PDF)</span></label><div style="display:flex;align-items:center;gap:10px"><label for="receipt" style="margin:0;background:var(--lime);color:#2f3a0c;border-radius:8px;padding:10px 14px;font-weight:700;cursor:pointer">Upload Receipts</label><span id="receiptName" style="color:#777;font-size:13px">No file selected</span></div><input id="receipt" type="file" name="receipts[]" multiple accept="image/*,.pdf" style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0)" onchange="attPicked(this,'receiptName')"><div id="expReceiptNow"></div>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('addExp')">Cancel</button><button class="mbtn save">Save</button></div>
</form></div></div>
{{-- Cash entry: owner top-up, income-to-petty transfer, or cash leaving the resort --}}
<div class="modal-ov" id="cashModal"><div class="modal"><h3 id="cashTitle">Cash Entry</h3>
<form method="POST" id="cashForm" action="{{ url('/cash') }}" enctype="multipart/form-data">@csrf<input type="hidden" name="_method" id="cashMethod" value="">
<label>What happened</label>
<select name="type" id="cashType" onchange="cashTypeSync()">
  <option value="topup">Owner sent money (add to Petty Cash)</option>
  <option value="transfer">Move Income Cash into Petty Cash</option>
  <option value="cash_out">Cash out (handed over or banked)</option>
</select>
<div class="pf-hint" id="cashHint"></div>
<div id="cashWalletWrap" style="display:none"><label>Taken from</label><select name="wallet"><option value="income">Income Cash (PKR {{ number_format($cash['income']) }})</option><option value="petty">Petty Cash (PKR {{ number_format($cash['petty']) }})</option></select></div>
<div class="mrow"><div><label>Amount (PKR) *</label><input type="number" name="amount" min="1" required></div><div><label>Date</label><input type="date" name="date" value="{{ now()->format('Y-m-d') }}"></div></div>
<label>Note</label><input name="note" maxlength="255" placeholder="e.g. Sent with October salaries">
<label>Receipts <span style="color:#9ca3af;font-weight:400">(optional: one or several screenshots, slips or PDFs)</span></label>
<div class="cash-rc"><label class="cash-rc-btn" for="cashReceipt"><svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/></svg>Attach receipts</label><input type="file" name="receipts[]" multiple id="cashReceipt" accept="image/jpeg,image/png,image/webp,application/pdf" onchange="attPicked(this,'cashReceiptName','No file attached')"><span id="cashReceiptName">No file attached</span></div><div id="cashReceiptNow"></div>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('cashModal')">Cancel</button><button class="mbtn save">Save Entry</button></div>
</form></div></div>
{{-- Cash report: a statement for any date range, downloaded as a PDF --}}
<div class="modal-ov" id="cashReportModal"><div class="modal"><h3>Export Cash Report</h3>
<form method="GET" id="cashReportForm" action="{{ url('/cash/report') }}" target="_blank">
<label>Period</label>
<div class="rp-quick" id="rpQuick">
  <button type="button" data-range="month">This Month</button>
  <button type="button" data-range="last">Last Month</button>
  <button type="button" data-range="year">This Year</button>
  <button type="button" data-range="all">All Time</button>
</div>
<div class="mrow"><div><label>From</label><input type="date" name="from" id="rpFrom" required></div><div><label>To</label><input type="date" name="to" id="rpTo" required></div></div>
<label class="rp-check"><input type="checkbox" name="detail" value="1" checked> Include the full list of entries</label>
<p style="margin:10px 0 0;font-size:12.5px;color:#8b948f">The report shows opening and closing balances for Income Cash and Petty Cash, where money came from, where it went, and profit for the period.</p>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('cashReportModal')">Cancel</button><button type="submit" class="mbtn save" onclick="setTimeout(()=>closeModal('cashReportModal'),300)">Download PDF</button></div>
</form></div></div>
<div class="modal-ov" id="expenseReportModal"><div class="modal"><h3>Export Expense PDF</h3><form id="expenseReportForm" method="GET" action="{{ url('/expenses/export/pdf') }}" onsubmit="return submitExpenseReport(this)">
<p style="margin:10px 0 14px;color:#687076;font-size:13px">Date-wise Kitchen aur Room expenses report download karein.</p>
<div class="mrow"><div><label for="reportFrom">From date</label><input id="reportFrom" name="from" type="date" required></div><div><label for="reportTo">To date</label><input id="reportTo" name="to" type="date" required></div></div>
<label for="reportArea">Report</label><select id="reportArea" name="area" required><option value="all">All expenses</option><option value="both">Kitchen + Room expenses</option><option value="kitchen">Kitchen expenses</option><option value="rooms">Room / housekeeping expenses</option></select>
<p style="margin:10px 0 0;color:#78827b;font-size:12px">Room report mein Housekeeping &amp; Supplies aur Maintenance &amp; Repairs categories shamil hain.</p>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('expenseReportModal')">Cancel</button><button type="submit" class="mbtn save" onclick="closeModal('expenseReportModal')">Download PDF</button></div>
</form></div></div>
</body>
</html>
