{{-- Shared CRUD helpers: csrf token, modal styles, post() helper --}}
@php
    $pendingN = \App\Models\Booking::where('status', 'pending')->count();
    $lowN = \App\Models\InventoryItem::where('availability', '!=', 'available')->count();
    $cleanN = \App\Models\HousekeepingTask::where('status', 'needs')->count();
    $arriveN = \App\Models\Booking::where('status', 'confirmed')->whereDate('check_in', now()->toDateString())->count();
    $notifs = array_values(array_filter([
        $pendingN ? $pendingN.' reservation(s) waiting for confirmation' : null,
        $arriveN ? $arriveN.' guest(s) arriving today' : null,
        $cleanN ? $cleanN.' room(s) need cleaning' : null,
        $lowN ? $lowN.' inventory item(s) low or out of stock' : null,
    ]));
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
<script>window.ROLE='{{ auth()->user()->role ?? '' }}';window.IS_ADMIN=(ROLE==='admin');window.CAN_MANAGE=(ROLE==='admin'||ROLE==='manager');</script>
<style>
.modal-ov{position:fixed;inset:0;background:rgba(0,0,0,.4);display:none;align-items:center;justify-content:center;z-index:1300;zoom:1}
.modal-ov.open{display:flex}
.modal-ov{padding:16px}
.modal{background:#fff;border-radius:16px;padding:0;width:440px;max-width:100%;max-height:calc(100vh - 32px);overflow:auto;font-family:Lato,Arial,sans-serif;display:flex;flex-direction:column;box-shadow:0 20px 60px rgba(0,0,0,.25)}
.modal.wide{width:760px}
/* Title stays at the top and the action buttons at the bottom while the form scrolls between them. */
.modal h3{position:sticky;top:0;z-index:2;margin:0;padding:22px 26px 14px;font-size:20px;background:#fff;border-bottom:1px solid #f0f0f0}
.modal form,.modal #detailBody{padding:4px 26px 0}
.modal .mact{position:sticky;bottom:0;z-index:2;margin:20px -26px 0;padding:14px 26px 18px;background:#fff;border-top:1px solid #f0f0f0}
.modal>.mact{margin:20px 0 0}
.modal .msec{margin:18px 0 2px;font-size:12px;font-weight:800;letter-spacing:.4px;text-transform:uppercase;color:#7f8a3a}
.modal .msec:first-child{margin-top:12px}
.modal .mrow.three{grid-template-columns:1fr 1fr 1fr}
.modal.wide .amenity-grid{grid-template-columns:repeat(4,1fr)}
@media(max-width:640px){.modal .mrow,.modal .mrow.three,.modal.wide .amenity-grid{grid-template-columns:1fr 1fr}.modal .mrow.three{grid-template-columns:1fr}.modal h3{padding:18px 18px 12px;font-size:18px}.modal form,.modal #detailBody{padding:4px 18px 0}.modal .mact{margin:20px -18px 0;padding:12px 18px 16px}.modal-ov{padding:10px}.modal{max-height:calc(100vh - 20px)}}
.modal label{display:block;font-size:13px;color:#777;margin:12px 0 5px}
.modal input,.modal select,.modal textarea{width:100%;height:42px;border:1px solid #e2e2e2;border-radius:9px;padding:0 12px;font-size:14px;font-family:inherit;color:#222}
.modal textarea{height:70px;padding:9px 12px}
.modal .mrow{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.modal .mact{display:flex;justify-content:flex-end;gap:10px;margin-top:20px}
.modal .mbtn{height:42px;border:0;border-radius:9px;padding:0 20px;font-size:14px;font-weight:700;cursor:pointer}
.modal .mbtn.cancel{background:#f2f2f2;color:#444}
.modal .mbtn.save{background:#e8fb82;color:#2f3a0c}
.modal .partial-payment-toggle{display:flex;align-items:center;gap:10px;margin:16px 0 0!important;padding:11px 12px!important;border:1px solid #e4edc8;border-radius:10px;background:#fbfef0!important;color:#28330e!important;cursor:pointer}
.modal .partial-payment-toggle input{width:18px!important;height:18px!important;padding:0!important;accent-color:#9db343;flex:0 0 18px}
.modal .partial-payment-toggle b{display:block;font-size:13px;line-height:1.15}.modal .partial-payment-toggle small{display:block;margin-top:3px;color:#78826a;font-size:11px;font-weight:400}
.modal .partial-payment-fields{display:none;margin-top:10px;padding:14px;border:1px solid #e4edc8;border-radius:12px;background:#f8fce9}
.modal .partial-payment-fields label{color:#596447;font-weight:600;margin-top:0}.modal .partial-payment-fields label+input{background:#fff}
.modal .receipt-upload{display:flex!important;align-items:center;gap:9px;margin:7px 0 0!important;padding:10px 11px!important;border:1px dashed #b8c995!important;border-radius:9px!important;background:#fff!important;color:#52613b!important;font-size:12px!important;cursor:pointer}
.modal .receipt-upload span{font-weight:700}.modal .receipt-upload small{margin-left:auto;color:#8a927c;font-size:11px;font-weight:400;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.modal .receipt-upload input{display:none!important}
.modal .amenity-box{margin-top:14px;padding:13px;border:1px solid #dfead3;border-radius:12px;background:#fbfef8}.modal .amenity-box h4{margin:0 0 9px;font-size:13px;color:#405126}.modal .amenity-grid{display:grid;grid-template-columns:1fr 1fr;gap:7px}.modal .amenity-grid label{display:flex!important;align-items:center;gap:7px;margin:0!important;padding:7px 8px!important;border-radius:7px;background:#fff!important;color:#51613b!important;font-size:11px!important;cursor:pointer}.modal .amenity-grid input{width:15px!important;height:15px!important;padding:0!important;accent-color:#9db343;flex:0 0 15px}
.flash{position:fixed;top:20px;right:20px;background:#e8fb82;color:#2f3a0c;padding:12px 18px;border-radius:10px;font-weight:700;z-index:200;box-shadow:0 6px 18px rgba(0,0,0,.12);font-family:Lato,Arial,sans-serif;zoom:1;z-index:1400}
select.fsel{height:44px;border:0;border-radius:11px;padding:0 36px 0 16px;font-size:15px;font-family:Lato,Arial,sans-serif;background-color:#f4f4f4;color:#333;cursor:pointer;-webkit-appearance:none;appearance:none;background-image:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23555' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'><path d='m6 9 6 6 6-6'/></svg>");background-repeat:no-repeat;background-position:right 12px center}
select.fsel.lime{background-color:#e8fb82;color:#2f3a0c;font-weight:700}
</style>
@if(session('ok'))<div class="flash" id="flash">{{ session('ok') }}</div>@endif
@php $me = auth()->user(); @endphp
<style>
.acct-av{width:74px;height:74px;border-radius:50%;background:#e6f4ea;display:grid;place-items:center;font-weight:800;font-size:24px;color:#1e4a36;overflow:hidden;flex:0 0 74px}
.acct-av img{width:100%;height:100%;object-fit:cover}
.acct-row{display:flex;align-items:center;gap:16px;margin:6px 0 4px}
.acct-row small{display:block;color:#888;font-size:12px;margin-top:4px}
.acct-tabs{display:flex;gap:6px;margin:0 0 6px;background:#f2f2f2;border-radius:10px;padding:4px}
.acct-tabs button{flex:1;height:36px;border:0;border-radius:8px;background:none;font:700 13px Lato,Arial,sans-serif;color:#555;cursor:pointer}
.acct-tabs button.on{background:#fff;color:#111;box-shadow:0 1px 4px rgba(0,0,0,.08)}
.acct-pane{display:none}.acct-pane.on{display:block}
.modal label.acct-upload{display:inline-flex!important;align-items:center;justify-content:center;gap:8px;height:36px!important;padding:0 14px!important;margin:0!important;border-radius:9px;background:#1e4a36;color:#fff!important;font-weight:700;font-size:13px!important;line-height:1;cursor:pointer;white-space:nowrap}
.acct-actions{display:flex;flex-wrap:wrap;gap:8px;margin-top:10px}
.acct-upload input{display:none}
.acct-remove{display:inline-flex;align-items:center;height:36px;padding:0 12px;border-radius:9px;background:#fff1f1;color:#b3352f;font-weight:700;font-size:13px;cursor:pointer;border:0}
@media(max-width:640px){.acct-row{gap:12px}.acct-av{width:62px;height:62px;flex-basis:62px;font-size:20px}.acct-row b{font-size:15px}.acct-row small{font-size:11.5px;word-break:break-all}}
.hdr-avatar{padding:0!important;overflow:hidden!important;border-radius:50%!important;-webkit-appearance:none;appearance:none}.hdr-avatar img{width:100%;height:100%;object-fit:cover;border-radius:50%;display:block}
</style>
<div class="modal-ov" id="accountModal"><div class="modal"><h3>My Account</h3>
<div style="padding:16px 26px 0">
<div class="acct-tabs"><button type="button" class="on" onclick="acctTab(0,this)">Profile</button><button type="button" onclick="acctTab(1,this)">Password</button></div>
</div>
<form class="acct-pane on" method="POST" action="{{ url('/profile') }}" enctype="multipart/form-data">@csrf
<div class="acct-row"><span class="acct-av" id="acctPreview">@if($me->avatar)<img src="{{ asset($me->avatar) }}" alt="">@else{{ $me->initials() }}@endif</span><div><b>{{ $me->name }}</b><small>{{ $me->email }} · {{ ucfirst($me->role) }}</small><div class="acct-actions"><label class="acct-upload"><svg viewBox="0 0 24 24" style="width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round"><path d="M4 7h3l2-2h6l2 2h3v12H4z"/><circle cx="12" cy="13" r="3.5"/></svg>Choose photo<input type="file" name="avatar" accept="image/*" onchange="acctPreview(this)"></label>@if($me->avatar)<button type="submit" class="acct-remove" name="remove_avatar" value="1">Remove</button>@endif</div></div></div>
<label>Display Name</label><input name="name" value="{{ $me->name }}" required maxlength="80">
<label>Email</label><input value="{{ $me->email }}" disabled style="background:#f7f7f7;color:#888">
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('accountModal')">Cancel</button><button class="mbtn save">Save Profile</button></div>
</form>
<form class="acct-pane" method="POST" action="{{ url('/profile/password') }}">@csrf
<label>Current Password</label><input type="password" name="current_password" required autocomplete="current-password">
<label>New Password</label><input type="password" name="password" required minlength="6" autocomplete="new-password">
<label>Confirm New Password</label><input type="password" name="password_confirmation" required minlength="6" autocomplete="new-password">
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('accountModal')">Cancel</button><button class="mbtn save">Change Password</button></div>
</form>
</div></div>
<script>
function openAccount(tab){openModal('accountModal');if(tab!==undefined){const b=document.querySelectorAll('#accountModal .acct-tabs button')[tab];if(b)acctTab(tab,b);}}
function acctTab(i,btn){document.querySelectorAll('#accountModal .acct-tabs button').forEach(b=>b.classList.remove('on'));btn.classList.add('on');document.querySelectorAll('#accountModal .acct-pane').forEach((p,k)=>p.classList.toggle('on',k===i));}
function acctPreview(inp){const f=inp.files&&inp.files[0];if(!f)return;const r=new FileReader();r.onload=e=>{document.getElementById('acctPreview').innerHTML='<img src="'+e.target.result+'" alt="">';};r.readAsDataURL(f);}
</script>
<style>
/* Receipt lists and the count badge on a receipt icon */
.att-list{display:flex;flex-direction:column;gap:6px;margin-top:8px}
.att-chip{display:flex;align-items:center;gap:10px;padding:8px 11px;border:1px solid #dfe8e2;border-radius:9px;background:#f7faf8;font-size:12.5px;color:#2b3a32;line-height:1.3}
.att-chip a{flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:#1e4a36;font-weight:700;text-decoration:none}
.att-chip a:hover{text-decoration:underline}
.att-chip em{font-style:normal;color:#7a867f;font-size:11.5px;white-space:nowrap}
.att-chip.gone{opacity:.55}.att-chip.gone a{text-decoration:line-through}
.modal .att-chip .att-rm{display:inline-flex;align-items:center;gap:5px;margin:0!important;padding:0!important;border:0!important;background:none!important;color:#b3352f!important;font-size:12px!important;font-weight:700!important;cursor:pointer;white-space:nowrap}
.modal .att-chip .att-rm input{width:14px!important;height:14px!important;padding:0!important;margin:0!important;accent-color:#b3352f;flex:0 0 14px}
.att-none{margin-top:7px;font-size:12px;color:#7a867f}
.att-many{position:relative}
.att-n{position:absolute;top:-6px;right:-6px;min-width:17px;height:17px;padding:0 4px;border-radius:9px;background:#1e4a36;color:#fff;font:700 10px/17px system-ui,sans-serif;font-style:normal;text-align:center;box-shadow:0 0 0 2px #fff}
</style>
<div class="modal-ov" id="detailModal"><div class="modal"><h3 id="detailTitle"></h3><div id="detailBody" style="font-size:14px;line-height:1.9;color:#444"></div><div class="mact"><button class="mbtn cancel" onclick="closeModal('detailModal')">Close</button></div></div></div>
<script>
function openModal(id){document.getElementById(id).classList.add('open')}
function closeModal(id){document.getElementById(id).classList.remove('open')}
/* Keep the session alive while a page stays open, and refresh the CSRF token so long-open pages never hit 419. */
(function(){function ping(){fetch('/session/ping',{credentials:'same-origin',headers:{'X-Requested-With':'XMLHttpRequest'}}).then(r=>r.ok?r.json():null).then(j=>{if(j&&j.token){document.querySelector('meta[name=csrf-token]').content=j.token;document.querySelectorAll('input[name=_token]').forEach(i=>i.value=j.token);}}).catch(()=>{});}setInterval(ping,10*60*1000);document.addEventListener('visibilitychange',()=>{if(!document.hidden)ping();});})();
function post(url,method,data){
  const f=document.createElement('form');f.method='POST';f.action=url;f.style.display='none';
  const t=document.querySelector('meta[name=csrf-token]').content;
  let h='<input name="_token" value="'+t+'">'+(method&&method!=='POST'?'<input name="_method" value="'+method+'">':'');
  if(data)for(const k in data)h+='<input name="'+k+'" value="'+data[k]+'">';
  f.innerHTML=h;document.body.appendChild(f);f.submit();
}
window.PGSTATE={};
function paginateRender(key,list,per,renderFn){
 const st=(PGSTATE[key]=PGSTATE[key]||{page:1});
 const total=list.length,pages=Math.max(1,Math.ceil(total/per));
 if(st.page>pages)st.page=pages; if(st.page<1)st.page=1;
 const start=(st.page-1)*per;
 renderFn(list.slice(start,start+per));
 const info=document.getElementById(key+'Info'); if(info)info.textContent='Showing '+(total?start+1:0)+'-'+Math.min(start+per,total)+' of '+total;
 const pg=document.getElementById(key+'Pages');
 if(pg){let h='<button class="pg" data-p="prev">‹</button>';for(let i=1;i<=pages;i++)h+='<button class="pg '+(i===st.page?'active':'')+'" data-p="'+i+'">'+i+'</button>';h+='<button class="pg" data-p="next">›</button>';pg.innerHTML=h;pg.querySelectorAll('.pg').forEach(b=>b.onclick=()=>{const p=b.dataset.p;if(p==='prev')st.page--;else if(p==='next')st.page++;else st.page=+p;paginateRender(key,list,per,renderFn);});}
}
function pgReset(key){if(PGSTATE[key])PGSTATE[key].page=1;}
function downloadPdf(name, content){
  const safe=String(content).replace(/[^\x20-\x7E\n]/g,'?').replace(/[()\\]/g,'\\$&');
  const lines=safe.split('\n');
  const body=['BT','/F1 16 Tf','50 790 Td'];
  lines.forEach((line,index)=>{if(index)body.push('0 -18 Td');body.push('('+line+') Tj')});
  body.push('ET');
  const stream=body.join('\n');
  const objects=['<< /Type /Catalog /Pages 2 0 R >>','<< /Type /Pages /Kids [3 0 R] /Count 1 >>','<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 5 0 R >> >> /Contents 4 0 R >>','<< /Length '+stream.length+' >>\nstream\n'+stream+'\nendstream','<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>'];
  let pdf='%PDF-1.4\n';const offsets=[0];
  objects.forEach((object,index)=>{offsets.push(pdf.length);pdf+=(index+1)+' 0 obj\n'+object+'\nendobj\n'});
  const xref=pdf.length;pdf+='xref\n0 '+(objects.length+1)+'\n0000000000 65535 f \n';
  offsets.slice(1).forEach(offset=>pdf+=String(offset).padStart(10,'0')+' 00000 n \n');
  pdf+='trailer\n<< /Size '+(objects.length+1)+' /Root 1 0 R >>\nstartxref\n'+xref+'\n%%EOF';
  const url=URL.createObjectURL(new Blob([pdf],{type:'application/pdf'}));const link=document.createElement('a');link.href=url;link.download=name;document.body.appendChild(link);link.click();link.remove();setTimeout(()=>URL.revokeObjectURL(url),1000);
}
function downloadFile(name,content){if(name.toLowerCase().endsWith('.pdf'))return downloadPdf(name,content);const b=new Blob([content],{type:'text/plain'});const u=URL.createObjectURL(b);const a=document.createElement('a');a.href=u;a.download=name;document.body.appendChild(a);a.click();a.remove();URL.revokeObjectURL(u);}
window.NOTIFS=@json($notifs);
function showNotifications(){const n=window.NOTIFS||[];showDetail('Notifications',n.length?'<ul style="margin:0;padding-left:18px">'+n.map(x=>'<li>'+x+'</li>').join('')+'</ul>':'<b>All clear</b><br>No pending reservations, low stock or rooms waiting for cleaning.');}
/* ---- Receipts: any record can carry several files (see App\Models\Attachment). ---- */
const attEsc=s=>String(s??'').replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
window.ATT_REG={};
/* The control that opens a record's files: one file opens directly, several open a list.
   `inner` is the icon or text; `plain` leaves out the count badge (for text buttons). */
function attButton(files,cls,inner,title,plain){files=files||[];if(!files.length)return '';
  if(files.length===1)return `<a class="${cls}" title="View ${attEsc(String(files[0].label||'receipt').toLowerCase())}" href="/${attEsc(files[0].path)}" target="_blank" rel="noopener" onclick="event.stopPropagation()">${inner}</a>`;
  const k='a'+files.map(f=>f.id).join('_');ATT_REG[k]={files,title:title||'Receipts'};
  return `<a class="${cls} att-many" href="#" title="View ${files.length} receipts" onclick="event.preventDefault();event.stopPropagation();attOpen('${k}')">${inner}${plain?' ('+files.length+')':'<i class="att-n">'+files.length+'</i>'}</a>`;}
function attOpen(k){const r=ATT_REG[k];if(r)showDetail(r.title,attLinks(r.files));}
function attLinks(files){return '<div class="att-list">'+(files||[]).map(f=>`<div class="att-chip"><a href="/${attEsc(f.path)}" target="_blank" rel="noopener">${attEsc(f.name||String(f.path).split('/').pop())}</a><em>${attEsc(f.label||'Receipt')}</em></div>`).join('')+'</div>';}
/* The same list inside an edit form, each file with a Remove tick that is applied on Save. */
function attEditable(elId,files,none){const el=document.getElementById(elId);if(!el)return;files=files||[];
  el.innerHTML=files.length?'<div class="att-list">'+files.map(f=>`<div class="att-chip"><a href="/${attEsc(f.path)}" target="_blank" rel="noopener">${attEsc(f.name||String(f.path).split('/').pop())}</a><em>${attEsc(f.label||'Receipt')}</em><label class="att-rm"><input type="checkbox" name="remove_attachments[]" value="${f.id}" onchange="this.closest('.att-chip').classList.toggle('gone',this.checked)">Remove</label></div>`).join('')+'</div>':(none?`<div class="att-none">${none}</div>`:'');}
/* Feedback for a multi-file input, with the same limits the server enforces. */
function attPicked(input,labelId,empty){const fs=[...input.files];
  if(fs.length>6){alert('Attach at most 6 files at a time.');input.value='';}
  else if(fs.some(f=>f.size>5*1024*1024)){alert('Each file must be 5 MB or smaller.');input.value='';}
  const n=input.files.length,el=document.getElementById(labelId);if(el)el.textContent=n?(n===1?input.files[0].name:n+' files selected'):(empty||'No file selected');}
function showDetail(title,html){const t=document.getElementById('detailTitle'),b=document.getElementById('detailBody');if(t)t.textContent=title;if(b)b.innerHTML=html;openModal('detailModal');}
document.addEventListener('click',event=>{const button=event.target.closest('.tool');if(!button)return;if(button.classList.contains('bell')){showDetail('Notifications','<b>Notifications</b><br>No new notifications right now.');return;}showDetail('Settings','<b>Indus Resort Restaurant</b><br>System settings are available to the administrator.');});
window.SORT={};
function sortCol(key,f,apply){const st=SORT[key]=SORT[key]||{};if(st.f===f)st.a=!st.a;else{st.f=f;st.a=true;}apply();}
function sortList(key,list){const st=SORT[key];if(!st||!st.f)return list;return [...list].sort((a,b)=>{let x=a[st.f],y=b[st.f];const nx=parseFloat(x),ny=parseFloat(y);if(!isNaN(nx)&&!isNaN(ny)&&String(x).match(/^[$]?[\d.]+/)&&String(y).match(/^[$]?[\d.]+/))return (nx-ny)*(st.a?1:-1);return String(x==null?'':x).localeCompare(String(y==null?'':y))*(st.a?1:-1);});}
/* A modal marked data-sticky holds a long form: a stray click outside must not throw the typing away, so only its Cancel button closes it. */
document.addEventListener('click',e=>{if(e.target.classList&&e.target.classList.contains('modal-ov')&&!e.target.hasAttribute('data-sticky'))e.target.classList.remove('open')});
setTimeout(()=>{const fl=document.getElementById('flash');if(fl)fl.remove()},2500);
</script>
