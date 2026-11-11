{{-- Shared invoice modal: register bookings in window.INV then call showInvoice(id). Used by the Invoice and Guest Profile pages. --}}
<script>
function money(n){return 'PKR '+Number(n).toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2});}
function invCalc(b){const nights=parseInt(b.duration)||1;const room=(+b.price_per_night||0)*nights;const extra=+b.extra_charges||0;const total=+b.amount||(room+extra);return{total,nights,room,extra};}
window.INV={};
function showInvoice(id){const b=INV[id];const c=invCalc(b);const paid=b.invoice_status==='paid';const isPartial=b.invoice_status==='partial'||Number(b.advance_amount)>0;const advance=Math.min(c.total,Number(b.advance_amount||0));const finalPayment=paid?Math.min(Math.max(0,c.total-advance),Number(b.final_payment_amount||Math.max(0,c.total-advance))):0;const afterAdvance=Math.max(0,c.total-advance);const remaining=Math.max(0,c.total-advance-finalPayment);const status=paid?'PAID':isPartial?'PARTIAL':'UNPAID';const statusBg=paid?'#e8fb82':isPartial?'#fff0c6':'#ffe1e1';const statusColor=paid?'#3d4a10':isPartial?'#9a6800':'#b3352f';const date=v=>v?new Date(v).toLocaleDateString():'';
 const html=`<div style="font-size:13px;color:#333">
  <div style="display:flex;justify-content:space-between;align-items:flex-start;border-bottom:3px solid #e8fb82;padding-bottom:12px;margin-bottom:14px">
   <div><div style="font-size:20px;font-weight:800;color:#151515">Indus Resort Restaurant</div><div style="color:#999;font-size:11px">Hotel Management System</div></div>
   <div style="text-align:right"><div style="font-weight:800;letter-spacing:1px">INVOICE</div><div style="color:#666">${b.code}</div><div style="color:#999;font-size:11px">${new Date().toLocaleDateString()}</div></div>
  </div>
  <div style="display:flex;justify-content:space-between;margin-bottom:14px">
   <div><div style="color:#999;font-size:11px;margin-bottom:2px">BILL TO</div><b style="font-size:14px">${b.guest_name}</b></div>
   <div style="text-align:right"><div style="color:#999;font-size:11px;margin-bottom:2px">STATUS</div><span style="font-weight:800;padding:3px 10px;border-radius:6px;background:${statusBg};color:${statusColor}">${status}</span></div>
  </div>
  <div style="background:#f7f9f2;border-radius:10px;padding:12px 14px;margin-bottom:14px">
   <div style="display:flex;justify-content:space-between;margin:3px 0"><span style="color:#777">Room</span><b>${b.room_label||''}</b></div>
   <div style="display:flex;justify-content:space-between;margin:3px 0"><span style="color:#777">Duration</span><b>${b.duration||''}</b></div>
   <div style="display:flex;justify-content:space-between;margin:3px 0"><span style="color:#777">Rate / night</span><b>PKR ${b.price_per_night}</b></div>
  </div>
  <div>
   <div style="display:flex;justify-content:space-between;margin:6px 0"><span>Room charge (${c.nights} night${c.nights>1?'s':''})</span><span>${money(c.room)}</span></div>${c.extra?`<div style="display:flex;justify-content:space-between;margin:6px 0"><span>Extra charges</span><span>${money(c.extra)}</span></div>`:''}
   <div style="display:flex;justify-content:space-between;margin-top:10px;padding-top:10px;border-top:2px solid #eee;font-size:16px;font-weight:800"><span>Total booking amount</span><span>${money(c.total)}</span></div>
  </div>
  <div style="margin-top:14px;padding:12px 14px;border:1px solid #f1d990;border-radius:10px;background:#fffaf0">
   <div style="font-size:14px;font-weight:800;color:#936100;margin-bottom:8px">Payment History</div>
   <div style="display:flex;justify-content:space-between;margin:5px 0"><span>Advance paid${advance&&b.created_at?' · '+date(b.created_at):''}</span><b>${money(advance)}</b></div>
   <div style="display:flex;justify-content:space-between;margin:5px 0"><span>Balance after advance</span><b>${money(afterAdvance)}</b></div>
   ${paid?`<div style="display:flex;justify-content:space-between;margin:5px 0"><span>Final payment${b.final_payment_paid_at?' · '+date(b.final_payment_paid_at):''}</span><b>${money(finalPayment)}</b></div>`:''}
   <div style="display:flex;justify-content:space-between;margin:8px 0 0;padding-top:8px;border-top:1px solid #eedca2;font-size:15px;font-weight:800"><span>Remaining Balance</span><span style="color:${remaining>0?'#bf501d':'#287552'}">${money(remaining)}</span></div>
  </div>
  <div style="margin-top:16px;display:flex;gap:8px">
   <button class="mbtn save" style="flex:1" onclick="downloadInvoice(${b.id})">⤓ Download</button>
   @if(auth()->user()->role!=='staff')${paid?`<button class="mbtn cancel" style="flex:1" onclick="post('/invoices/${b.id}/toggle','POST')">Mark Unpaid</button>`:`<button class="mbtn cancel" style="flex:1" onclick="post('/invoices/${b.id}/toggle','POST',{received_by:document.getElementById('invHolder').value})">Mark Paid</button>`}@endif
  </div>
  @if(auth()->user()->role!=='staff')${paid?'':`<div style="margin-top:10px;display:flex;align-items:center;gap:8px;font-size:13px;color:#555"><span style="white-space:nowrap">Balance received by</span><select id="invHolder" style="flex:1;height:38px;border:1px solid #dfe8e2;border-radius:9px;padding:0 10px;background:#fff"><option value="manager">Manager (at the resort)</option><option value="owner">Owner (paid to him directly)</option></select></div>`}@endif
 </div>`;
 showDetail('', html);
}
function downloadInvoice(id){window.location='/invoices/'+id+'/download';}
</script>
