{{--
  Reusable CRUD partial — include at the top of any @section('script').
  Provides:
    - openModal / closeModal
    - showToast(msg, type)
    - crudView(url, renderFn)   — fetch record → fill viewModal
    - crudEdit(url, fillFn)     — fetch record → fill editModal
    - crudDelete(url, name, cb) — confirm → DELETE → toast → reload
    - crudSave(url, formData, method) — POST/PUT → toast → reload
  Requires: #viewModal, #editModal with standard structure.
--}}
<style>
.toast{position:fixed;bottom:28px;right:28px;z-index:9999;padding:13px 20px;border-radius:10px;font-size:13px;font-weight:500;display:flex;align-items:center;gap:10px;box-shadow:0 8px 30px rgba(0,0,0,.18);animation:slideUp .3s;max-width:380px;}
.toast.success{background:var(--success);color:#fff;}
.toast.error{background:var(--danger);color:#fff;}
.toast.info{background:var(--primary);color:#fff;}
@keyframes slideUp{from{transform:translateY(20px);opacity:0}to{transform:translateY(0);opacity:1}}
.form-error{background:var(--danger-soft);color:var(--danger);border:1px solid #FECACA;border-radius:8px;padding:10px 14px;font-size:13px;margin-top:12px;}
.modal-spinner{display:flex;justify-content:center;align-items:center;padding:48px;}
</style>
<script>
const _CSRF = '{{ csrf_token() }}';

/* ── modal helpers ────────────────────────────── */
function openModal(id)  { const m=document.getElementById(id); if(m) m.classList.add('open'); }
function closeModal(id) { const m=document.getElementById(id); if(m) m.classList.remove('open'); }

/* close on backdrop click */
document.addEventListener('DOMContentLoaded',()=>{
  document.querySelectorAll('.modal-overlay').forEach(m=>{
    m.addEventListener('click',e=>{ if(e.target===m) m.classList.remove('open'); });
  });
});

/* ── toast ────────────────────────────────────── */
function showToast(msg, type='success'){
  document.querySelectorAll('.toast').forEach(t=>t.remove());
  const ic = type==='success'?'circle-check':type==='error'?'circle-exclamation':'circle-info';
  const t=document.createElement('div');
  t.className='toast '+type;
  t.innerHTML=`<i class="fa-solid fa-${ic}"></i><span>${msg}</span>`;
  document.body.appendChild(t);
  setTimeout(()=>{ t.style.cssText='opacity:0;transition:opacity .4s'; setTimeout(()=>t.remove(),400); },3500);
}

/* ── reload helper ────────────────────────────── */
function _reload(delay=700){ setTimeout(()=>location.reload(), delay); }

/* ── spinner ──────────────────────────────────── */
function _spin(){ return '<div class="modal-spinner"><i class="fa-solid fa-spinner fa-spin" style="font-size:24px;color:var(--primary)"></i></div>'; }

/* ── generic fetch GET → JSON ─────────────────── */
function _get(url){ return fetch(url,{headers:{'X-Requested-With':'XMLHttpRequest','Accept':'application/json'}}).then(r=>{if(!r.ok)throw new Error(r.statusText);return r.json();}); }

/* ── generic POST/PUT/DELETE ─────────────────── */
function _send(url, method, body){
  const opts={method:'POST',headers:{'X-CSRF-TOKEN':_CSRF,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'}};
  if(body instanceof FormData){ opts.body=body; }
  else { opts.headers['Content-Type']='application/json'; opts.body=JSON.stringify(Object.assign({_method:method},body||{})); }
  return fetch(url,opts).then(r=>r.json());
}

/* ── VIEW ─────────────────────────────────────── */
function crudView(url, renderFn){
  const body=document.getElementById('viewModalBody');
  const footer=document.getElementById('viewModalFooter');
  if(body) body.innerHTML=_spin();
  openModal('viewModal');
  _get(url).then(d=>{
    if(body) body.innerHTML=renderFn(d);
    if(footer && typeof window._viewFooterFn==='function') window._viewFooterFn(d, footer);
  }).catch(()=>{ if(body) body.innerHTML='<p style="color:var(--danger);padding:20px">Failed to load record.</p>'; });
}

/* ── EDIT ─────────────────────────────────────── */
function crudEdit(url, fillFn){
  _get(url).then(d=>{
    fillFn(d);
    const err=document.getElementById('editModalError');
    if(err){ err.textContent=''; err.style.display='none'; }
    openModal('editModal');
  }).catch(()=>showToast('Failed to load record.','error'));
}

/* ── DELETE ───────────────────────────────────── */
function crudDelete(url, name, onSuccess){
  if(!confirm(`Delete "${name}"?\nThis action cannot be undone.`)) return;
  _send(url,'DELETE',null).then(res=>{
    if(res.success){ showToast(res.message||'Deleted.'); if(onSuccess) onSuccess(); else _reload(); }
    else showToast(res.message||'Delete failed.','error');
  }).catch(()=>showToast('Network error.','error'));
}

/* ── SAVE (Add/Edit) ──────────────────────────── */
function crudSave(url, formData, errorElId, onSuccess){
  _send(url,'POST',formData).then(res=>{
    if(res.success){
      showToast(res.message||'Saved.');
      if(onSuccess) onSuccess(); else _reload();
    } else {
      const errEl=document.getElementById(errorElId);
      if(errEl){ errEl.textContent=res.message||res.errors?Object.values(res.errors||{}).flat().join(', '):'Error.'; errEl.style.display='block'; }
      else showToast(res.message||'Save failed.','error');
    }
  }).catch(()=>showToast('Network error.','error'));
}

/* ── Detail grid renderer helper ─────────────── */
function detailRow(label, value, fullWidth=false){
  if(!value && value!==0) value='—';
  return `<div class="detail-item"${fullWidth?' style="grid-column:1/-1"':''}><label>${label}</label><p>${value}</p></div>`;
}
</script>
