@extends('layouts.backend')
@section('title', 'Registrations')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-file-pen" style="color:var(--primary);margin-right:8px"></i>Certification Registrations</h1>
    <p>Manage, verify and issue certificates to registered applicants.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-outline" onclick="exportTable()"><i class="fa-solid fa-download"></i> Export</button>
    <button class="btn btn-primary" onclick="openModal('addModal')"><i class="fa-solid fa-plus"></i> Add Registration</button>
  </div>
</div>

{{-- Alerts --}}
@if(session('success'))
<div class="alert-success" id="flashMsg">
  <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
</div>
@endif

{{-- Stats --}}
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Total</div><div class="stat-value" style="margin-top:8px">{{ $stats['total'] }}</div></div>
      <div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-file-lines"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">All submissions</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Pending</div><div class="stat-value" style="margin-top:8px;color:var(--warning)">{{ $stats['pending'] }}</div></div>
      <div class="stat-icon" style="background:var(--warning-soft);color:var(--warning)"><i class="fa-solid fa-clock"></i></div>
    </div>
    <div class="stat-footer"><a href="{{ route('admin.registration.pending') }}" class="card-link">View pending →</a></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Approved</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $stats['approved'] }}</div></div>
      <div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div>
    </div>
    <div class="stat-footer"><a href="{{ route('admin.registration.approved') }}" class="card-link">View approved →</a></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Rejected</div><div class="stat-value" style="margin-top:8px;color:var(--danger)">{{ $stats['rejected'] }}</div></div>
      <div class="stat-icon" style="background:var(--danger-soft);color:var(--danger)"><i class="fa-solid fa-circle-xmark"></i></div>
    </div>
    <div class="stat-footer"><a href="{{ route('admin.registration.rejected') }}" class="card-link">View rejected →</a></div>
  </div>
</div>

{{-- Filters --}}
<form method="GET" action="{{ route('admin.registration.personal') }}" class="filters-bar" id="filterForm">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by firm, name, district…" oninput="debounceSubmit()"/>
  </div>
  <select name="status" class="filter-select" onchange="this.form.submit()">
    <option value="">All Statuses</option>
    <option value="Pending"  {{ request('status')=='Pending'  ? 'selected':'' }}>Pending</option>
    <option value="Approved" {{ request('status')=='Approved' ? 'selected':'' }}>Approved</option>
    <option value="Rejected" {{ request('status')=='Rejected' ? 'selected':'' }}>Rejected</option>
  </select>
  @if(request('search') || request('status'))
  <a href="{{ route('admin.registration.personal') }}" class="btn btn-outline" style="padding:8px 14px"><i class="fa-solid fa-xmark"></i> Clear</a>
  @endif
</form>

{{-- Table --}}
<div class="card">
  <div class="card-header">
    <div>
      <div class="card-title">All Registrations</div>
      <div class="card-subtitle">{{ $data->firstItem() ?? 0 }}–{{ $data->lastItem() ?? 0 }} of {{ $data->total() }} entries</div>
    </div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table" id="mainTable">
      <thead>
        <tr>
          <th style="width:36px"><input type="checkbox" id="selectAll" style="cursor:pointer"/></th>
          <th>#</th>
          <th>Firm / Association</th>
          <th>Proprietor</th>
          <th>District</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>Status</th>
          <th>Certificate</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $item)
        <tr data-id="{{ $item->id }}">
          <td><input type="checkbox" class="rowCheck" style="cursor:pointer"/></td>
          <td style="color:var(--text-muted);font-size:12px">{{ $item->id }}</td>
          <td>
            <div class="user-name">{{ $item->firm_name }}</div>
            <div class="user-email">{{ $item->association }}</div>
          </td>
          <td style="color:var(--text-secondary)">{{ $item->proprietor }}</td>
          <td style="color:var(--text-secondary)">{{ $item->district }}</td>
          <td style="color:var(--text-secondary);font-family:monospace;font-size:12px">{{ $item->mobile_primary }}</td>
          <td style="color:var(--text-secondary);font-size:12px">{{ $item->email }}</td>
          <td>
            @php
              $cls = 'tag-pending';
              if($item->status=='Approved') $cls='tag-approved';
              if($item->status=='Rejected') $cls='tag-rejected';
            @endphp
            <span class="tag {{ $cls }}">{{ $item->status }}</span>
          </td>
          <td>
            @if($item->certificate)
              <span class="tag tag-approved" style="font-family:monospace;font-size:10px">{{ $item->certificate->cert_id }}</span>
            @elseif($item->status=='Approved')
              <button class="btn btn-outline" style="padding:4px 10px;font-size:11px;color:var(--primary)" onclick="issueCertificate({{ $item->id }}, '{{ $item->firm_name }}')">
                <i class="fa-solid fa-certificate"></i> Issue
              </button>
            @else
              <span style="color:var(--text-muted);font-size:12px">—</span>
            @endif
          </td>
          <td>
            <div class="action-group">
              <button class="icon-btn view" title="View Details" onclick="viewRecord({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>
              <button class="icon-btn edit" title="Edit" onclick="editRecord({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
              @if($item->status=='Pending')
              <button class="icon-btn" title="Approve" style="background:var(--success-soft);color:var(--success)" onclick="approveRecord({{ $item->id }}, '{{ addslashes($item->firm_name) }}')"><i class="fa-solid fa-check"></i></button>
              <button class="icon-btn" title="Reject" style="background:var(--danger-soft);color:var(--danger)" onclick="rejectRecord({{ $item->id }}, '{{ addslashes($item->firm_name) }}')"><i class="fa-solid fa-xmark"></i></button>
              @endif
              <button class="icon-btn delete" title="Delete" onclick="deleteRecord({{ $item->id }}, '{{ addslashes($item->firm_name) }}')"><i class="fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="10" style="text-align:center;padding:48px;color:var(--text-muted)">
          <i class="fa-solid fa-inbox" style="font-size:28px;display:block;margin-bottom:10px"></i>No registrations found.
        </td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">
    {{ $data->links('pagination::bootstrap-4') }}
  </div>
</div>

{{-- ═══ VIEW MODAL ═══ --}}
<div class="modal-overlay" id="viewModal">
  <div class="modal" style="width:720px">
    <div class="modal-header">
      <h2><i class="fa-solid fa-eye" style="color:var(--primary);margin-right:8px"></i>Registration Details</h2>
      <button class="modal-close" onclick="closeModal('viewModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body" id="viewContent"><div class="loader-wrap"><i class="fa-solid fa-spinner fa-spin" style="font-size:24px;color:var(--primary)"></i></div></div>
    <div class="modal-footer" id="viewFooter">
      <button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button>
    </div>
  </div>
</div>

{{-- ═══ EDIT MODAL ═══ --}}
<div class="modal-overlay" id="editModal">
  <div class="modal" style="width:720px">
    <div class="modal-header">
      <h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit Registration</h2>
      <button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <form id="editForm">
        @csrf
        @method('PUT')
        <input type="hidden" id="editId"/>
        <div class="detail-grid" style="gap:14px">
          <div class="detail-item"><label>Association</label><input type="text" class="form-input" name="association" id="e_association"/></div>
          <div class="detail-item"><label>Firm Name</label><input type="text" class="form-input" name="firm_name" id="e_firm_name"/></div>
          <div class="detail-item"><label>Proprietor</label><input type="text" class="form-input" name="proprietor" id="e_proprietor"/></div>
          <div class="detail-item"><label>District</label><input type="text" class="form-input" name="district" id="e_district"/></div>
          <div class="detail-item" style="grid-column:1/-1"><label>Address</label><textarea class="form-input" name="address" id="e_address" rows="2"></textarea></div>
          <div class="detail-item"><label>Primary Mobile</label><input type="text" class="form-input" name="mobile_primary" id="e_mobile_primary"/></div>
          <div class="detail-item"><label>Email</label><input type="email" class="form-input" name="email" id="e_email"/></div>
          <div class="detail-item"><label>Contact 2 Name</label><input type="text" class="form-input" name="contact2_name" id="e_contact2_name"/></div>
          <div class="detail-item"><label>Secondary Mobile</label><input type="text" class="form-input" name="mobile_secondary" id="e_mobile_secondary"/></div>
          <div class="detail-item"><label>Website</label><input type="text" class="form-input" name="website" id="e_website"/></div>
          <div class="detail-item" style="grid-column:1/-1"><label>Companies Dealt With</label><input type="text" class="form-input" name="companies_dealt_with" id="e_companies_dealt_with"/></div>
        </div>
        <div id="editError" class="form-error" style="display:none"></div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('editModal')">Cancel</button>
      <button class="btn btn-primary" onclick="submitEdit()"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
    </div>
  </div>
</div>

{{-- ═══ ADD MODAL ═══ --}}
<div class="modal-overlay" id="addModal">
  <div class="modal" style="width:720px">
    <div class="modal-header">
      <h2><i class="fa-solid fa-plus" style="color:var(--primary);margin-right:8px"></i>Add Registration</h2>
      <button class="modal-close" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <form id="addForm" method="POST" action="{{ route('admin.registration.store') }}">
        @csrf
        <div class="detail-grid" style="gap:14px">
          <div class="detail-item"><label>Association *</label><input type="text" class="form-input" name="association" required/></div>
          <div class="detail-item"><label>Firm Name *</label><input type="text" class="form-input" name="firm_name" required/></div>
          <div class="detail-item"><label>Proprietor *</label><input type="text" class="form-input" name="proprietor" required/></div>
          <div class="detail-item"><label>District *</label><input type="text" class="form-input" name="district" required/></div>
          <div class="detail-item" style="grid-column:1/-1"><label>Address *</label><textarea class="form-input" name="address" rows="2" required></textarea></div>
          <div class="detail-item"><label>Primary Mobile *</label><input type="text" class="form-input" name="mobile_primary" required/></div>
          <div class="detail-item"><label>Email *</label><input type="email" class="form-input" name="email" required/></div>
          <div class="detail-item"><label>Contact 2 Name</label><input type="text" class="form-input" name="contact2_name"/></div>
          <div class="detail-item"><label>Secondary Mobile</label><input type="text" class="form-input" name="mobile_secondary"/></div>
          <div class="detail-item"><label>Website</label><input type="text" class="form-input" name="website" placeholder="https://"/></div>
          <div class="detail-item" style="grid-column:1/-1"><label>Companies Dealt With *</label><input type="text" class="form-input" name="companies_dealt_with" required placeholder="HP, Dell, Lenovo…"/></div>
          <div class="detail-item"><label>Services Offered *</label>
            <div style="display:flex;flex-wrap:wrap;gap:8px;margin-top:4px">
              @foreach(['Hardware Sales','Software Sales','IT Services','Networking','Cloud Solutions','CCTV Installation','Data Recovery','Printer Repairs'] as $svc)
              <label style="display:flex;align-items:center;gap:5px;font-size:12px;cursor:pointer">
                <input type="checkbox" name="services_offered[]" value="{{ $svc }}"> {{ $svc }}
              </label>
              @endforeach
            </div>
          </div>
          <div class="detail-item"><label>Status</label>
            <select class="form-input" name="status">
              <option value="Pending">Pending</option>
              <option value="Approved">Approved</option>
              <option value="Rejected">Rejected</option>
            </select>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('addModal')">Cancel</button>
      <button class="btn btn-primary" onclick="document.getElementById('addForm').submit()"><i class="fa-solid fa-save"></i> Save</button>
    </div>
  </div>
</div>

{{-- ═══ REJECT MODAL ═══ --}}
<div class="modal-overlay" id="rejectModal">
  <div class="modal" style="width:480px">
    <div class="modal-header">
      <h2><i class="fa-solid fa-xmark" style="color:var(--danger);margin-right:8px"></i>Reject Registration</h2>
      <button class="modal-close" onclick="closeModal('rejectModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <p style="font-size:13px;color:var(--text-secondary);margin-bottom:14px">You are rejecting: <strong id="rejectFirmName"></strong></p>
      <input type="hidden" id="rejectId"/>
      <label class="detail-item"><label>Rejection Reason (optional)</label>
        <textarea class="form-input" id="rejectReason" rows="3" placeholder="State reason for rejection…"></textarea>
      </label>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('rejectModal')">Cancel</button>
      <button class="btn" style="background:var(--danger);color:#fff" onclick="submitReject()"><i class="fa-solid fa-xmark"></i> Confirm Reject</button>
    </div>
  </div>
</div>

{{-- ═══ DELETE CONFIRM MODAL ═══ --}}
<div class="modal-overlay" id="deleteModal">
  <div class="modal" style="width:420px">
    <div class="modal-header">
      <h2><i class="fa-solid fa-triangle-exclamation" style="color:var(--danger);margin-right:8px"></i>Confirm Delete</h2>
      <button class="modal-close" onclick="closeModal('deleteModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body" style="text-align:center;padding:30px 24px">
      <div style="width:64px;height:64px;border-radius:50%;background:var(--danger-soft);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:26px;color:var(--danger)">
        <i class="fa-solid fa-trash"></i>
      </div>
      <h3 style="font-size:16px;margin-bottom:8px">Delete Registration?</h3>
      <p style="font-size:13px;color:var(--text-muted)">You are about to delete <strong id="deleteRecordName"></strong>. This action cannot be undone.</p>
      <input type="hidden" id="deleteId"/>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('deleteModal')">Cancel</button>
      <button class="btn" style="background:var(--danger);color:#fff" onclick="submitDelete()"><i class="fa-solid fa-trash"></i> Yes, Delete</button>
    </div>
  </div>
</div>

{{-- ═══ ISSUE CERTIFICATE MODAL ═══ --}}
<div class="modal-overlay" id="issueModal">
  <div class="modal" style="width:460px">
    <div class="modal-header">
      <h2><i class="fa-solid fa-certificate" style="color:var(--success);margin-right:8px"></i>Issue Certificate</h2>
      <button class="modal-close" onclick="closeModal('issueModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body" style="text-align:center;padding:30px 24px">
      <div style="width:64px;height:64px;border-radius:50%;background:var(--success-soft);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:26px;color:var(--success)">
        <i class="fa-solid fa-certificate"></i>
      </div>
      <h3 style="font-size:16px;margin-bottom:8px" id="issueFirmTitle"></h3>
      <p style="font-size:13px;color:var(--text-muted)">A certificate will be generated with today's date and 3-year validity. This action creates a permanent certificate record.</p>
      <input type="hidden" id="issueRegId"/>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('issueModal')">Cancel</button>
      <button class="btn" style="background:var(--success);color:#fff" onclick="submitIssueCertificate()"><i class="fa-solid fa-certificate"></i> Issue Certificate</button>
    </div>
  </div>
</div>

@endsection

@section('script')
<style>
.alert-success {
  background: var(--success-soft); color: var(--success);
  border: 1px solid #BBF7D0; border-radius: 10px;
  padding: 12px 18px; margin-bottom: 20px;
  display: flex; align-items: center; gap: 10px; font-size: 13px; font-weight: 500;
}
.form-error {
  background: var(--danger-soft); color: var(--danger);
  border: 1px solid #FECACA; border-radius: 8px;
  padding: 10px 14px; margin-top: 12px; font-size: 13px;
}
.toast {
  position: fixed; bottom: 28px; right: 28px; z-index: 999;
  background: var(--text-main); color: #fff;
  padding: 13px 20px; border-radius: 10px; font-size: 13px; font-weight: 500;
  display: flex; align-items: center; gap: 10px;
  box-shadow: 0 8px 30px rgba(0,0,0,.18); animation: slideUp .3s ease;
  max-width: 380px;
}
.toast.success { background: var(--success); }
.toast.error   { background: var(--danger); }
@keyframes slideUp { from { transform:translateY(20px); opacity:0 } to { transform:translateY(0); opacity:1 } }
.loader-wrap { display:flex; justify-content:center; padding:40px; }
</style>

<script>
const CSRF = '{{ csrf_token() }}';

// ── Utilities ────────────────────────────────────────────────────────────────
function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-overlay').forEach(m =>
  m.addEventListener('click', e => { if(e.target===m) m.classList.remove('open'); })
);

function showToast(msg, type='success') {
  document.querySelectorAll('.toast').forEach(t => t.remove());
  const t = document.createElement('div');
  t.className = 'toast ' + type;
  t.innerHTML = `<i class="fa-solid fa-${type==='success'?'circle-check':'circle-exclamation'}"></i> ${msg}`;
  document.body.appendChild(t);
  setTimeout(() => { t.style.opacity='0'; t.style.transition='opacity .4s'; setTimeout(()=>t.remove(),400); }, 3500);
}

function reload() { setTimeout(() => location.reload(), 600); }

// ── Select all ───────────────────────────────────────────────────────────────
document.getElementById('selectAll').addEventListener('change', function() {
  document.querySelectorAll('.rowCheck').forEach(cb => cb.checked = this.checked);
});

// ── Search debounce ──────────────────────────────────────────────────────────
let searchTimer;
function debounceSubmit() {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(() => document.getElementById('filterForm').submit(), 600);
}

// ── View record ──────────────────────────────────────────────────────────────
function viewRecord(id) {
  openModal('viewModal');
  document.getElementById('viewContent').innerHTML = '<div class="loader-wrap"><i class="fa-solid fa-spinner fa-spin" style="font-size:24px;color:var(--primary)"></i></div>';
  fetch(`/admin/registration/${id}/show`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json())
    .then(d => {
      const services = Array.isArray(d.services_offered) ? d.services_offered.join(', ') : d.services_offered;
      const certHtml = d.certificate
        ? `<span class="tag tag-approved">${d.certificate.cert_id} — Issued ${d.certificate.issue_date}</span>`
        : (d.status === 'Approved' ? `<button class="btn btn-outline" style="padding:4px 12px;font-size:12px;color:var(--success)" onclick="closeModal('viewModal'); issueCertificate(${d.id}, '${d.firm_name}')"><i class="fa-solid fa-certificate"></i> Issue Certificate</button>` : '<span style="color:var(--text-muted)">Not yet issued</span>');

      document.getElementById('viewContent').innerHTML = `
        <div style="display:flex;align-items:center;gap:16px;padding-bottom:20px;border-bottom:1px solid var(--border);margin-bottom:20px">
          <div style="width:56px;height:56px;border-radius:14px;background:var(--primary);display:flex;align-items:center;justify-content:center;color:#fff;font-size:22px;font-weight:700;flex-shrink:0">
            ${d.firm_name.slice(0,2).toUpperCase()}
          </div>
          <div>
            <div style="font-size:17px;font-weight:700">${d.firm_name}</div>
            <div style="font-size:12px;color:var(--text-muted)">${d.association}</div>
            <div style="margin-top:6px">
              <span class="tag ${d.status==='Approved'?'tag-approved':d.status==='Rejected'?'tag-rejected':'tag-pending'}">${d.status}</span>
            </div>
          </div>
        </div>
        <div class="detail-grid">
          <div class="detail-item"><label>Proprietor</label><p>${d.proprietor}</p></div>
          <div class="detail-item"><label>District</label><p>${d.district}</p></div>
          <div class="detail-item"><label>Primary Mobile</label><p>${d.mobile_primary}</p></div>
          <div class="detail-item"><label>Email</label><p>${d.email}</p></div>
          ${d.contact2_name ? `<div class="detail-item"><label>Contact 2</label><p>${d.contact2_name}</p></div>` : ''}
          ${d.mobile_secondary ? `<div class="detail-item"><label>Secondary Mobile</label><p>${d.mobile_secondary}</p></div>` : ''}
          ${d.website ? `<div class="detail-item"><label>Website</label><p><a href="${d.website}" target="_blank" style="color:var(--primary)">${d.website}</a></p></div>` : ''}
          <div class="detail-item" style="grid-column:1/-1"><label>Address</label><p>${d.address}</p></div>
          <div class="detail-item" style="grid-column:1/-1"><label>Companies Dealt With</label><p>${d.companies_dealt_with}</p></div>
          <div class="detail-item" style="grid-column:1/-1"><label>Services Offered</label><p>${services}</p></div>
          <div class="detail-item" style="grid-column:1/-1"><label>Certificate</label><p>${certHtml}</p></div>
          ${d.rejection_reason ? `<div class="detail-item" style="grid-column:1/-1"><label style="color:var(--danger)">Rejection Reason</label><p style="color:var(--danger)">${d.rejection_reason}</p></div>` : ''}
        </div>`;
      // Show action buttons in footer if pending
      const footer = document.getElementById('viewFooter');
      if (d.status === 'Pending') {
        footer.innerHTML = `
          <button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button>
          <button class="btn" style="background:var(--danger-soft);color:var(--danger)" onclick="closeModal('viewModal'); rejectRecord(${d.id},'${d.firm_name}')"><i class="fa-solid fa-xmark"></i> Reject</button>
          <button class="btn btn-primary" onclick="closeModal('viewModal'); approveRecord(${d.id},'${d.firm_name}')"><i class="fa-solid fa-check"></i> Approve</button>`;
      } else {
        footer.innerHTML = `<button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button>`;
      }
    })
    .catch(() => {
      document.getElementById('viewContent').innerHTML = '<p style="color:var(--danger);padding:20px">Failed to load details.</p>';
    });
}

// ── Edit record ──────────────────────────────────────────────────────────────
function editRecord(id) {
  openModal('editModal');
  document.getElementById('editError').style.display='none';
  fetch(`/admin/registration/${id}/show`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json())
    .then(d => {
      document.getElementById('editId').value              = d.id;
      document.getElementById('e_association').value       = d.association;
      document.getElementById('e_firm_name').value         = d.firm_name;
      document.getElementById('e_proprietor').value        = d.proprietor;
      document.getElementById('e_district').value          = d.district;
      document.getElementById('e_address').value           = d.address;
      document.getElementById('e_mobile_primary').value    = d.mobile_primary;
      document.getElementById('e_email').value             = d.email;
      document.getElementById('e_contact2_name').value     = d.contact2_name || '';
      document.getElementById('e_mobile_secondary').value  = d.mobile_secondary || '';
      document.getElementById('e_website').value           = d.website || '';
      document.getElementById('e_companies_dealt_with').value = d.companies_dealt_with;
    });
}

function submitEdit() {
  const id   = document.getElementById('editId').value;
  const form = document.getElementById('editForm');
  const data = new FormData(form);
  data.append('_method','PUT');
  fetch(`/admin/registration/${id}/update`, {
    method: 'POST', body: data,
    headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(r => r.json())
  .then(res => {
    if(res.success) {
      closeModal('editModal');
      showToast(res.message);
      reload();
    } else {
      const err = document.getElementById('editError');
      err.textContent = res.message || 'Update failed.';
      err.style.display = 'block';
    }
  });
}

// ── Approve ──────────────────────────────────────────────────────────────────
function approveRecord(id, name) {
  if(!confirm(`Approve registration for "${name}"?`)) return;
  fetch(`/admin/registration/${id}/approve`, {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest', 'Content-Type': 'application/json' }
  })
  .then(r => r.json())
  .then(res => {
    if(res.success) { showToast(res.message); reload(); }
    else showToast(res.message, 'error');
  });
}

// ── Reject ───────────────────────────────────────────────────────────────────
function rejectRecord(id, name) {
  document.getElementById('rejectId').value = id;
  document.getElementById('rejectFirmName').textContent = name;
  document.getElementById('rejectReason').value = '';
  openModal('rejectModal');
}

function submitReject() {
  const id     = document.getElementById('rejectId').value;
  const reason = document.getElementById('rejectReason').value;
  fetch(`/admin/registration/${id}/reject`, {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest', 'Content-Type': 'application/json' },
    body: JSON.stringify({ rejection_reason: reason })
  })
  .then(r => r.json())
  .then(res => {
    if(res.success) { closeModal('rejectModal'); showToast(res.message); reload(); }
    else showToast(res.message, 'error');
  });
}

// ── Delete ───────────────────────────────────────────────────────────────────
function deleteRecord(id, name) {
  document.getElementById('deleteId').value = id;
  document.getElementById('deleteRecordName').textContent = `"${name}"`;
  openModal('deleteModal');
}

function submitDelete() {
  const id = document.getElementById('deleteId').value;
  fetch(`/admin/registration/${id}/destroy`, {
    method: 'DELETE',
    headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(r => r.json())
  .then(res => {
    if(res.success) { closeModal('deleteModal'); showToast(res.message); reload(); }
    else showToast(res.message, 'error');
  });
}

// ── Issue Certificate ─────────────────────────────────────────────────────────
function issueCertificate(id, firmName) {
  document.getElementById('issueRegId').value = id;
  document.getElementById('issueFirmTitle').textContent = `Issue certificate to: ${firmName}`;
  openModal('issueModal');
}

function submitIssueCertificate() {
  const id = document.getElementById('issueRegId').value;
  fetch(`/admin/registration/${id}/issue-certificate`, {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(r => r.json())
  .then(res => {
    if(res.success) {
      closeModal('issueModal');
      showToast(res.message);
      reload();
    } else {
      showToast(res.message, 'error');
    }
  });
}

// Auto-hide flash
const flash = document.getElementById('flashMsg');
if(flash) setTimeout(() => { flash.style.opacity='0'; flash.style.transition='opacity .5s'; }, 4000);
</script>
@endsection
