@extends('layouts.frontend')
@section('title')
Page Title
@endsection

@section('content')
<style>
/* ── PAGE-SPECIFIC STYLES ── */

/* Stepper */
.stepper{display:flex;align-items:center;gap:0;margin-bottom:48px;position:relative}
.step{display:flex;align-items:center;flex:1;position:relative}
.step:last-child{flex:0}
.step-circle{
  width:42px;height:42px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:14px;font-weight:800;flex-shrink:0;z-index:1;position:relative;
  border:2px solid var(--border);background:#fff;color:var(--muted);
  transition:all .3s;font-family:var(--font);
}
.step.done .step-circle{background:var(--blue2);border-color:var(--blue2);color:#fff}
.step.active .step-circle{background:var(--navy);border-color:var(--navy);color:var(--gold2);box-shadow:0 0 0 4px rgba(30,80,162,.15)}
.step-line{flex:1;height:2px;background:var(--border);margin:0 2px;transition:background .3s}
.step.done .step-line{background:var(--blue2)}
.step-label{position:absolute;top:52px;left:50%;transform:translateX(-50%);white-space:nowrap;font-size:11px;font-weight:600;color:var(--muted);text-align:center}
.step.active .step-label{color:var(--navy);font-weight:700}
.step.done .step-label{color:var(--blue2)}
.stepper-wrap{padding-bottom:36px}

/* Form card */
.form-card{background:#fff;border:1px solid var(--border);border-radius:20px;overflow:hidden;margin-bottom:28px}
.form-card-head{
  padding:22px 28px;border-bottom:1px solid var(--border);
  display:flex;align-items:center;gap:14px;
  background:linear-gradient(90deg,var(--light),#fff);
}
.form-card-head-ico{
  width:42px;height:42px;border-radius:11px;
  display:flex;align-items:center;justify-content:center;
  font-size:18px;flex-shrink:0;
}
.form-card-head h3{font-size:16px;font-weight:800;color:var(--navy);margin-bottom:2px}
.form-card-head p{font-size:12px;color:var(--muted)}
.form-card-body{padding:28px}

/* T&C box */
.tnc-box{
  background:var(--light);border:1px solid var(--border);
  border-radius:12px;padding:20px 22px;max-height:220px;
  overflow-y:auto;font-size:13px;color:var(--muted);line-height:1.75;
  margin-bottom:18px;
}
.tnc-box::-webkit-scrollbar{width:4px}
.tnc-box::-webkit-scrollbar-thumb{background:var(--border);border-radius:2px}
.tnc-box h5{font-size:13px;font-weight:700;color:var(--navy);margin:12px 0 6px}
.tnc-box h5:first-child{margin-top:0}
.tnc-box ol,.tnc-box ul{padding-left:18px;margin-bottom:8px}
.tnc-box li{margin-bottom:4px}

.tnc-accept{
  display:flex;align-items:center;gap:12px;
  padding:16px 20px;border-radius:12px;
  border:2px solid var(--border);cursor:pointer;
  transition:border-color .2s,background .2s;
  background:#fff;
}
.tnc-accept:hover{border-color:var(--blue2);background:rgba(30,80,162,.03)}
.tnc-accept.accepted{border-color:var(--blue2);background:rgba(30,80,162,.05)}
.tnc-checkbox{
  width:22px;height:22px;border-radius:6px;border:2px solid var(--border);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;transition:all .2s;background:#fff;
}
.tnc-accept.accepted .tnc-checkbox{background:var(--blue2);border-color:var(--blue2);color:#fff}
.tnc-accept-text{font-size:13px;font-weight:600;color:var(--text)}
.tnc-accept-text span{color:var(--blue2);text-decoration:underline;cursor:pointer}

/* Association select */
.assoc-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:16px}
.assoc-option{
  border:2px solid var(--border);border-radius:12px;padding:14px 16px;
  cursor:pointer;transition:all .2s;text-align:center;background:#fff;
}
.assoc-option:hover{border-color:var(--blue2);background:rgba(30,80,162,.03)}
.assoc-option.selected{border-color:var(--blue2);background:rgba(30,80,162,.07)}
.assoc-option .assoc-name{font-size:13px;font-weight:700;color:var(--navy);margin-bottom:2px}
.assoc-option .assoc-city{font-size:11px;color:var(--muted)}
.assoc-option .assoc-check{
  width:20px;height:20px;border-radius:50%;border:2px solid var(--border);
  margin:0 auto 10px;display:flex;align-items:center;justify-content:center;
  font-size:10px;transition:all .2s;background:#fff;
}
.assoc-option.selected .assoc-check{background:var(--blue2);border-color:var(--blue2);color:#fff}

.assoc-notice{
  background:rgba(245,166,35,.08);border:1px solid rgba(245,166,35,.25);
  border-radius:10px;padding:14px 18px;display:flex;align-items:flex-start;gap:10px;
  font-size:13px;color:#7A4A00;line-height:1.6;margin-top:14px;
}
.assoc-notice i{color:var(--gold);flex-shrink:0;margin-top:2px}
.assoc-notice a{color:var(--blue2);font-weight:600;text-decoration:underline}

/* Important notes */
.notes-box{
  background:rgba(30,80,162,.05);border:1px solid rgba(30,80,162,.15);
  border-radius:12px;padding:18px 20px;margin-bottom:24px;
}
.notes-box h5{font-size:13px;font-weight:800;color:var(--blue2);margin-bottom:10px;display:flex;align-items:center;gap:7px}
.notes-box ol{padding-left:18px;display:flex;flex-direction:column;gap:6px}
.notes-box ol li{font-size:13px;color:var(--text);line-height:1.6}
.notes-box ol li strong{color:var(--navy)}

/* Services checkboxes */
.services-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px}
.service-check{
  display:flex;align-items:center;gap:10px;
  padding:11px 14px;border:1.5px solid var(--border);
  border-radius:10px;cursor:pointer;transition:all .18s;
  background:#fff;
}
.service-check:hover{border-color:var(--blue2);background:rgba(30,80,162,.03)}
.service-check.checked{border-color:var(--blue2);background:rgba(30,80,162,.06)}
.service-check input[type="checkbox"]{
  width:16px;height:16px;accent-color:var(--blue2);
  pointer-events:none;flex-shrink:0;
}
.service-check label{font-size:12px;font-weight:600;color:var(--text);pointer-events:none;line-height:1.3}

/* Input with icon */
.input-icon-wrap{position:relative}
.input-icon-wrap .form-control{padding-left:42px}
.input-icon-wrap i{
  position:absolute;left:14px;top:50%;transform:translateY(-50%);
  font-size:13px;color:var(--muted);pointer-events:none;
}

/* Section divider inside card */
.field-section-title{
  font-size:12px;font-weight:800;color:var(--navy);
  text-transform:uppercase;letter-spacing:1.2px;
  margin:24px 0 14px;padding-bottom:8px;
  border-bottom:1px solid var(--border);display:flex;align-items:center;gap:8px;
}
.field-section-title i{font-size:12px;color:var(--blue2)}

/* Pay button row */
.pay-row{
  background:#fff;border:1px solid var(--border);
  border-radius:20px;padding:28px 32px;
  display:flex;align-items:center;justify-content:space-between;
  gap:24px;flex-wrap:wrap;
}
.pay-summary{}
.pay-summary h4{font-size:16px;font-weight:800;color:var(--navy);margin-bottom:4px}
.pay-summary p{font-size:13px;color:var(--muted)}
.pay-amount{text-align:right}
.pay-amount .amount{font-size:32px;font-weight:900;color:var(--navy);line-height:1}
.pay-amount .amount sup{font-size:16px;color:var(--muted)}
.pay-amount .amount-label{font-size:11px;color:var(--muted);font-weight:600;margin-top:3px}
.pay-btn{
  background:linear-gradient(135deg,var(--accent),#C02E0A);
  color:#fff;padding:16px 40px;border-radius:30px;
  font-family:var(--font);font-size:15px;font-weight:800;border:none;cursor:pointer;
  transition:all .25s;box-shadow:0 6px 22px rgba(224,58,18,.4);
  display:inline-flex;align-items:center;gap:10px;
  opacity:.5;pointer-events:none;
}
.pay-btn.enabled{opacity:1;pointer-events:all}
.pay-btn.enabled:hover{transform:translateY(-2px);box-shadow:0 12px 32px rgba(224,58,18,.5)}
.pay-lock{font-size:11px;color:var(--muted);display:flex;align-items:center;gap:5px;margin-top:8px;justify-content:flex-end}
.pay-lock i{color:var(--blue2)}

/* Sidebar summary */
.sidebar{display:flex;flex-direction:column;gap:18px}
.summary-card{background:#fff;border:1px solid var(--border);border-radius:18px;padding:22px}
.summary-card h4{font-size:14px;font-weight:800;color:var(--navy);margin-bottom:14px;padding-bottom:10px;border-bottom:1px solid var(--border)}
.summary-item{display:flex;align-items:flex-start;gap:10px;margin-bottom:12px}
.summary-item:last-child{margin-bottom:0}
.summary-item-ico{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0}
.summary-item-ico.blue{background:rgba(30,80,162,.09);color:var(--blue2)}
.summary-item-ico.gold{background:rgba(245,166,35,.12);color:#C47D00}
.summary-item-ico.green{background:rgba(16,140,80,.09);color:#108C50}
.summary-item-ico.red{background:rgba(224,58,18,.09);color:var(--accent)}
.summary-item-body strong{display:block;font-size:12px;font-weight:700;color:var(--navy)}
.summary-item-body span{font-size:11px;color:var(--muted);line-height:1.4}

.help-card{background:var(--navy);border-radius:18px;padding:22px}
.help-card h4{font-size:14px;font-weight:800;color:#fff;margin-bottom:12px}
.help-card p{font-size:12px;color:rgba(255,255,255,.5);line-height:1.6;margin-bottom:14px}
.help-contact{display:flex;align-items:center;gap:10px;margin-bottom:10px}
.help-contact i{width:30px;height:30px;border-radius:8px;background:rgba(255,255,255,.08);display:flex;align-items:center;justify-content:center;font-size:12px;color:var(--gold2);flex-shrink:0}
.help-contact a{font-size:12px;color:#fff;font-weight:600;transition:color .2s}
.help-contact a:hover{color:var(--gold2)}

/* Layout */
.reg-layout{display:grid;grid-template-columns:1fr 300px;gap:28px;align-items:start}

/* Progress bar */
.progress-bar-wrap{background:var(--light);border-radius:6px;height:6px;margin-bottom:6px;overflow:hidden}
.progress-bar-fill{height:100%;background:linear-gradient(90deg,var(--blue2),var(--blue));border-radius:6px;transition:width .4s}
.progress-label{font-size:11px;color:var(--muted);font-weight:600;text-align:right}

@media(max-width:1000px){
  .reg-layout{grid-template-columns:1fr}
  .assoc-grid{grid-template-columns:repeat(2,1fr)}
  .services-grid{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:600px){
  .assoc-grid{grid-template-columns:1fr 1fr}
  .services-grid{grid-template-columns:1fr 1fr}
  .pay-row{flex-direction:column;align-items:flex-start}
  .pay-amount{text-align:left}
  .pay-lock{justify-content:flex-start}
  .stepper-wrap{overflow-x:auto;padding-bottom:48px}
  .stepper{min-width:420px}
}
</style>

<!-- PAGE HERO -->
<div class="page-hero">
  <div class="hero-glow"></div>
  <div class="hero-glow2"></div>
  <div class="page-hero-inner">
    <div class="breadcrumb">
      <a href="index.html"><i class="fas fa-home"></i> Home</a>
      <i class="fas fa-chevron-right"></i>
      <a href="#">Members</a>
      <i class="fas fa-chevron-right"></i>
      <span class="active">Registration for Certification</span>
    </div>
    <div class="page-hero-tag"><span>Members</span></div>
    <h1>Registration for <span>Certification</span></h1>
    <p>{{ $settings['page_registration_intro'] ?? 'Complete your certification registration with P A C T. Fill in the details below carefully — our team will review and process your application.' }}</p>
  </div>
</div>

<!-- MAIN CONTENT -->
<div class="page-body">

  <!-- STEPPER -->
  <div class="stepper-wrap">
    <div class="stepper" id="stepper">
      <div class="step active" id="step-ind-1">
        <div class="step-circle">1</div>
        <div class="step-label">Terms & Conditions</div>
        <div class="step-line"></div>
      </div>
      <div class="step" id="step-ind-2">
        <div class="step-circle">2</div>
        <div class="step-label">Association</div>
        <div class="step-line"></div>
      </div>
      <div class="step" id="step-ind-3">
        <div class="step-circle">3</div>
        <div class="step-label">Applicant Details</div>
        <div class="step-line"></div>
      </div>
      <div class="step" id="step-ind-4">
        <div class="step-circle">4</div>
        <div class="step-label">Services & Payment</div>
      </div>
    </div>
  </div>

  <!-- PROGRESS BAR -->
  <div style="margin-bottom:36px">
    <div class="progress-bar-wrap"><div class="progress-bar-fill" id="prog-fill" style="width:25%"></div></div>
    <div class="progress-label" id="prog-label">Step 1 of 4 — Terms & Conditions</div>
  </div>

  <div class="reg-layout">

    <!-- ── MAIN FORM COLUMN ── -->
    <div>

      <!-- ════ STEP 1: T&C ════ -->
      <div id="form-step-1">

        <div class="form-card">
          <div class="form-card-head">
            <div class="form-card-head-ico ico-box blue md"><i class="fas fa-file-contract"></i></div>
            <div>
              <h3>Terms & Conditions</h3>
              <p>Please read carefully and accept to proceed with your certification registration.</p>
            </div>
          </div>
          <div class="form-card-body">

            <div class="tnc-box">
              <h5>1. Eligibility</h5>
              <p>Applicants must be an active member of a PACT-affiliated association in Punjab or Chandigarh. Membership must be current and in good standing at the time of application.</p>

              <h5>2. Accuracy of Information</h5>
              <p>All information submitted in this registration form must be accurate, complete, and truthful. Any false or misleading information will result in immediate rejection of the application and may lead to cancellation of existing membership.</p>

              <h5>3. Right to Approve or Reject</h5>
              <p>PACT Management reserves the sole right to accept or reject any registration for certification, without being required to provide reasons for such a decision. Submission of this form does not guarantee certification.</p>

              <h5>4. Fee Payment</h5>
              <p>The certification fee, once paid, is non-refundable. In the event that PACT rejects an application, the fee will be refunded after deduction of applicable processing charges.</p>

              <h5>5. Code of Conduct</h5>
              <p>Certified members are bound by PACT's Code of Conduct for IT Traders. Any violation may result in suspension or cancellation of the certification without refund.</p>

              <h5>6. Renewal</h5>
              <p>Certification is valid for one year from the date of issue and must be renewed annually. PACT will issue renewal reminders but responsibility for timely renewal rests with the member.</p>

              <h5>7. Use of PACT Certification Mark</h5>
              <p>The PACT certification mark may only be used in the manner prescribed by PACT guidelines. Misuse of the certification mark will result in immediate cancellation.</p>

              <h5>8. Data Privacy</h5>
              <p>By submitting this form, you consent to PACT storing and using your information for the purposes of processing your application, maintaining member records, and communicating with you regarding PACT activities.</p>

              <h5>9. Jurisdiction</h5>
              <p>Any disputes arising from this registration shall be subject to the jurisdiction of courts in Chandigarh, India.</p>
            </div>

            <div class="tnc-accept" id="tnc-accept-box" onclick="toggleTnC()">
              <div class="tnc-checkbox" id="tnc-checkbox">
                <i class="fas fa-check" style="font-size:11px;display:none" id="tnc-tick"></i>
              </div>
              <div class="tnc-accept-text">
                I have read and agree to the <span>Terms & Conditions</span> of P A C T Certification Registration.
              </div>
            </div>

            <div id="tnc-error" style="display:none;margin-top:10px" class="alert danger">
              <i class="fas fa-exclamation-circle"></i>
              Please accept the Terms & Conditions to proceed.
            </div>

          </div>
        </div>

        <div style="display:flex;justify-content:flex-end;margin-top:8px">
          <button class="btn-primary" onclick="goStep(2)">
            Next — Select Association <i class="fas fa-arrow-right" style="font-size:11px"></i>
          </button>
        </div>

      </div><!-- /step1 -->

      <!-- ════ STEP 2: ASSOCIATION ════ -->
      <div id="form-step-2" style="display:none">

        <div class="notes-box">
          <h5><i class="fas fa-info-circle"></i> Important Notes</h5>
          <ol>
            <li>You must be a <strong>current member</strong> of the association you select below.</li>
            <li><strong>PACT Management</strong> reserves the right to accept or reject any registration without providing a reason.</li>
          </ol>
        </div>

        <div class="form-card">
          <div class="form-card-head">
            <div class="form-card-head-ico ico-box gold md"><i class="fas fa-building"></i></div>
            <div>
              <h3>Association Selection</h3>
              <p>Select the PACT-affiliated association you are a member of.</p>
            </div>
          </div>
          <div class="form-card-body">

            <div class="form-group">
              <label class="form-label">Select Your Association <span class="req">*</span></label>
              <div class="assoc-grid" id="assoc-grid">
                <div class="assoc-option" onclick="selectAssoc(this,'Chandigarh IT Association')">
                  <div class="assoc-check"><i class="fas fa-check" style="font-size:9px;display:none"></i></div>
                  <div class="assoc-name">Chandigarh IT Association</div>
                  <div class="assoc-city">Chandigarh</div>
                </div>
                <div class="assoc-option" onclick="selectAssoc(this,'Ludhiana Computer Traders')">
                  <div class="assoc-check"><i class="fas fa-check" style="font-size:9px;display:none"></i></div>
                  <div class="assoc-name">Ludhiana Computer Traders</div>
                  <div class="assoc-city">Ludhiana</div>
                </div>
                <div class="assoc-option" onclick="selectAssoc(this,'Amritsar IT Association')">
                  <div class="assoc-check"><i class="fas fa-check" style="font-size:9px;display:none"></i></div>
                  <div class="assoc-name">Amritsar IT Association</div>
                  <div class="assoc-city">Amritsar</div>
                </div>
                <div class="assoc-option" onclick="selectAssoc(this,'Jalandhar Computer Dealers')">
                  <div class="assoc-check"><i class="fas fa-check" style="font-size:9px;display:none"></i></div>
                  <div class="assoc-name">Jalandhar Computer Dealers</div>
                  <div class="assoc-city">Jalandhar</div>
                </div>
                <div class="assoc-option" onclick="selectAssoc(this,'Patiala IT Traders')">
                  <div class="assoc-check"><i class="fas fa-check" style="font-size:9px;display:none"></i></div>
                  <div class="assoc-name">Patiala IT Traders</div>
                  <div class="assoc-city">Patiala</div>
                </div>
                <div class="assoc-option" onclick="selectAssoc(this,'Mohali Tech Association')">
                  <div class="assoc-check"><i class="fas fa-check" style="font-size:9px;display:none"></i></div>
                  <div class="assoc-name">Mohali Tech Association</div>
                  <div class="assoc-city">Mohali / SAS Nagar</div>
                </div>
                <div class="assoc-option" onclick="selectAssoc(this,'Bathinda IT Traders')">
                  <div class="assoc-check"><i class="fas fa-check" style="font-size:9px;display:none"></i></div>
                  <div class="assoc-name">Bathinda IT Traders</div>
                  <div class="assoc-city">Bathinda</div>
                </div>
                <div class="assoc-option" onclick="selectAssoc(this,'Phagwara IT Association')">
                  <div class="assoc-check"><i class="fas fa-check" style="font-size:9px;display:none"></i></div>
                  <div class="assoc-name">Phagwara IT Association</div>
                  <div class="assoc-city">Phagwara</div>
                </div>
                <div class="assoc-option" onclick="selectAssoc(this,'Other Association')">
                  <div class="assoc-check"><i class="fas fa-check" style="font-size:9px;display:none"></i></div>
                  <div class="assoc-name">Other Association</div>
                  <div class="assoc-city">Specify below</div>
                </div>
              </div>

              <div id="other-assoc-wrap" style="display:none;margin-top:12px">
                <input type="text" class="form-control" placeholder="Enter your association name" id="other-assoc-name">
              </div>
            </div>

            <div class="assoc-notice">
              <i class="fas fa-exclamation-triangle"></i>
              <div>If your association is <strong>not listed above</strong> or is not yet registered with PACT, please
                <a href="contact.html">register your association first</a>. Upon approval, return here to complete your certification registration.
              </div>
            </div>

            <div id="assoc-error" style="display:none;margin-top:14px" class="alert danger">
              <i class="fas fa-exclamation-circle"></i>
              Please select an association to proceed.
            </div>

          </div>
        </div>

        <div style="display:flex;justify-content:space-between;margin-top:8px;gap:12px">
          <button class="btn-ghost-light" onclick="goStep(1)">
            <i class="fas fa-arrow-left" style="font-size:11px"></i> Back
          </button>
          <button class="btn-primary" onclick="goStep(3)">
            Next — Applicant Details <i class="fas fa-arrow-right" style="font-size:11px"></i>
          </button>
        </div>

      </div><!-- /step2 -->

      <!-- ════ STEP 3: APPLICANT DETAILS ════ -->
      <div id="form-step-3" style="display:none">

        <div class="form-card">
          <div class="form-card-head">
            <div class="form-card-head-ico ico-box blue md"><i class="fas fa-user-edit"></i></div>
            <div>
              <h3>Applicant Details</h3>
              <p>All fields marked <span style="color:var(--accent);font-weight:700">*</span> are mandatory.</p>
            </div>
          </div>
          <div class="form-card-body">

            <!-- Firm Info -->
            <div class="field-section-title"><i class="fas fa-store"></i> Firm Information</div>
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Name of Firm <span class="req">*</span></label>
                <div class="input-icon-wrap">
                  <i class="fas fa-building"></i>
                  <input type="text" class="form-control" placeholder="e.g. Sharma Computer Traders" id="firm-name">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">District <span class="req">*</span></label>
                <div class="input-icon-wrap">
                  <i class="fas fa-map-marker-alt"></i>
                  <select class="form-control" id="district" style="padding-left:42px">
                    <option value="">— Select District —</option>
                    <option>Amritsar</option>
                    <option>Barnala</option>
                    <option>Bathinda</option>
                    <option>Chandigarh (UT)</option>
                    <option>Faridkot</option>
                    <option>Fatehgarh Sahib</option>
                    <option>Fazilka</option>
                    <option>Ferozepur</option>
                    <option>Gurdaspur</option>
                    <option>Hoshiarpur</option>
                    <option>Jalandhar</option>
                    <option>Kapurthala</option>
                    <option>Ludhiana</option>
                    <option>Mansa</option>
                    <option>Moga</option>
                    <option>Mohali (SAS Nagar)</option>
                    <option>Muktsar</option>
                    <option>Nawanshahr</option>
                    <option>Pathankot</option>
                    <option>Patiala</option>
                    <option>Phagwara</option>
                    <option>Ropar (Rupnagar)</option>
                    <option>Sangrur</option>
                    <option>Tarn Taran</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Address with Pin Code <span class="req">*</span></label>
              <textarea class="form-control" rows="3" placeholder="Shop / Office No., Street, Area, City — Pin Code" id="address"></textarea>
            </div>

            <!-- Proprietor -->
            <div class="field-section-title"><i class="fas fa-user-tie"></i> Proprietor / Partner / Director</div>
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Name of Proprietor / Partner / Director <span class="req">*</span></label>
                <div class="input-icon-wrap">
                  <i class="fas fa-user"></i>
                  <input type="text" class="form-control" placeholder="Full name" id="proprietor">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Primary Mobile Number <span class="req">*</span></label>
                <div class="input-icon-wrap">
                  <i class="fas fa-mobile-alt"></i>
                  <input type="tel" class="form-control" placeholder="+91 XXXXX XXXXX" id="mobile1" maxlength="13">
                </div>
              </div>
            </div>

            <!-- Second Contact -->
            <div class="field-section-title"><i class="fas fa-phone"></i> Second Contact Details</div>
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Second Contact Name</label>
                <div class="input-icon-wrap">
                  <i class="fas fa-user"></i>
                  <input type="text" class="form-control" placeholder="Full name of second contact" id="contact2-name">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Second Mobile Number</label>
                <div class="input-icon-wrap">
                  <i class="fas fa-mobile-alt"></i>
                  <input type="tel" class="form-control" placeholder="+91 XXXXX XXXXX" id="mobile2" maxlength="13">
                </div>
              </div>
            </div>

            <!-- Online -->
            <div class="field-section-title"><i class="fas fa-globe"></i> Digital Presence</div>
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Email ID <span class="req">*</span></label>
                <div class="input-icon-wrap">
                  <i class="fas fa-envelope"></i>
                  <input type="email" class="form-control" placeholder="info@yourfirm.com" id="email">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Website</label>
                <div class="input-icon-wrap">
                  <i class="fas fa-globe"></i>
                  <input type="url" class="form-control" placeholder="https://www.yourwebsite.com" id="website">
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Online Portal <span style="font-size:11px;color:var(--muted);font-weight:400">(if applicable)</span></label>
                <div class="input-icon-wrap">
                  <i class="fas fa-shopping-cart"></i>
                  <input type="url" class="form-control" placeholder="https://shop.yourfirm.com" id="portal">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Companies Dealt With <span class="req">*</span></label>
                <div class="input-icon-wrap">
                  <i class="fas fa-industry"></i>
                  <input type="text" class="form-control" placeholder="e.g. HP, Dell, Lenovo, Acer, Intel" id="companies">
                </div>
              </div>
            </div>

          </div>
        </div>

        <div style="display:flex;justify-content:space-between;margin-top:8px;gap:12px">
          <button class="btn-ghost-light" onclick="goStep(2)">
            <i class="fas fa-arrow-left" style="font-size:11px"></i> Back
          </button>
          <button class="btn-primary" onclick="goStep(4)">
            Next — Services & Payment <i class="fas fa-arrow-right" style="font-size:11px"></i>
          </button>
        </div>

      </div><!-- /step3 -->

      <!-- ════ STEP 4: SERVICES & PAYMENT ════ -->
      <div id="form-step-4" style="display:none">

        <div class="form-card">
          <div class="form-card-head">
            <div class="form-card-head-ico ico-box green md"><i class="fas fa-concierge-bell"></i></div>
            <div>
              <h3>Services Offered</h3>
              <p>Select all services your firm provides. At least one selection is required.</p>
            </div>
          </div>
          <div class="form-card-body">

            <div class="services-grid" id="services-grid">
              <div class="service-check" onclick="toggleService(this)">
                <input type="checkbox" id="s1"><label for="s1">Hardware Sales</label>
              </div>
              <div class="service-check" onclick="toggleService(this)">
                <input type="checkbox" id="s2"><label for="s2">Software Sales & Licensing</label>
              </div>
              <div class="service-check" onclick="toggleService(this)">
                <input type="checkbox" id="s3"><label for="s3">IT Infrastructure</label>
              </div>
              <div class="service-check" onclick="toggleService(this)">
                <input type="checkbox" id="s4"><label for="s4">Networking & Cabling</label>
              </div>
              <div class="service-check" onclick="toggleService(this)">
                <input type="checkbox" id="s5"><label for="s5">CCTV & Surveillance</label>
              </div>
              <div class="service-check" onclick="toggleService(this)">
                <input type="checkbox" id="s6"><label for="s6">AMC & Support Services</label>
              </div>
              <div class="service-check" onclick="toggleService(this)">
                <input type="checkbox" id="s7"><label for="s7">Cloud Services</label>
              </div>
              <div class="service-check" onclick="toggleService(this)">
                <input type="checkbox" id="s8"><label for="s8">Cybersecurity Solutions</label>
              </div>
              <div class="service-check" onclick="toggleService(this)">
                <input type="checkbox" id="s9"><label for="s9">System Integration</label>
              </div>
              <div class="service-check" onclick="toggleService(this)">
                <input type="checkbox" id="s10"><label for="s10">Printer & Peripherals</label>
              </div>
              <div class="service-check" onclick="toggleService(this)">
                <input type="checkbox" id="s11"><label for="s11">UPS & Power Solutions</label>
              </div>
              <div class="service-check" onclick="toggleService(this)">
                <input type="checkbox" id="s12"><label for="s12">Digital Marketing</label>
              </div>
              <div class="service-check" onclick="toggleService(this)">
                <input type="checkbox" id="s13"><label for="s13">Website Development</label>
              </div>
              <div class="service-check" onclick="toggleService(this)">
                <input type="checkbox" id="s14"><label for="s14">Mobile & Accessories</label>
              </div>
              <div class="service-check" onclick="toggleService(this)">
                <input type="checkbox" id="s15"><label for="s15">Other IT Services</label>
              </div>
            </div>

            <div id="service-error" style="display:none;margin-top:14px" class="alert danger">
              <i class="fas fa-exclamation-circle"></i>
              Please select at least one service offered by your firm.
            </div>

          </div>
        </div>

        <!-- Pay Row -->
        <div class="pay-row">
          <div class="pay-summary">
            <h4>Certification Registration Fee</h4>
            <p>One-time annual fee — valid for 12 months from date of issue.</p>
          </div>
          <div class="pay-amount">
            <div class="amount"><sup>₹</sup>1,500</div>
            <div class="amount-label">+ GST (18%)</div>
          </div>
          <div>
            <button class="pay-btn" id="pay-btn" onclick="submitForm()">
              <i class="fas fa-lock"></i> Pay & Submit Registration
            </button>
            <div class="pay-lock"><i class="fas fa-shield-alt"></i> Secured by Razorpay &nbsp;·&nbsp; SSL Encrypted</div>
          </div>
        </div>

        <div style="display:flex;justify-content:flex-start;margin-top:16px">
          <button class="btn-ghost-light" onclick="goStep(3)">
            <i class="fas fa-arrow-left" style="font-size:11px"></i> Back to Applicant Details
          </button>
        </div>

      </div><!-- /step4 -->

    </div><!-- /main col -->

    <!-- ── SIDEBAR ── -->
    <div class="sidebar">

      <div class="summary-card">
        <h4><i class="fas fa-clipboard-check" style="color:var(--blue2);margin-right:6px"></i> Registration Summary</h4>
        <div class="summary-item">
          <div class="summary-item-ico blue"><i class="fas fa-file-contract"></i></div>
          <div class="summary-item-body">
            <strong>Terms & Conditions</strong>
            <span id="sum-tnc">Not accepted yet</span>
          </div>
        </div>
        <div class="summary-item">
          <div class="summary-item-ico gold"><i class="fas fa-building"></i></div>
          <div class="summary-item-body">
            <strong>Association</strong>
            <span id="sum-assoc">Not selected yet</span>
          </div>
        </div>
        <div class="summary-item">
          <div class="summary-item-ico green"><i class="fas fa-user"></i></div>
          <div class="summary-item-body">
            <strong>Applicant Details</strong>
            <span id="sum-details">Not filled yet</span>
          </div>
        </div>
        <div class="summary-item">
          <div class="summary-item-ico red"><i class="fas fa-rupee-sign"></i></div>
          <div class="summary-item-body">
            <strong>Fee</strong>
            <span>₹1,500 + GST (18%)</span>
          </div>
        </div>
      </div>

      <div class="summary-card">
        <h4><i class="fas fa-award" style="color:var(--gold);margin-right:6px"></i> What You Get</h4>
        <div style="display:flex;flex-direction:column;gap:10px">
          <div style="display:flex;align-items:center;gap:9px;font-size:12px;color:var(--text)">
            <i class="fas fa-check-circle" style="color:#108C50;font-size:13px;flex-shrink:0"></i>
            Official PACT Certification Certificate
          </div>
          <div style="display:flex;align-items:center;gap:9px;font-size:12px;color:var(--text)">
            <i class="fas fa-check-circle" style="color:#108C50;font-size:13px;flex-shrink:0"></i>
            PACT Certified Member Badge
          </div>
          <div style="display:flex;align-items:center;gap:9px;font-size:12px;color:var(--text)">
            <i class="fas fa-check-circle" style="color:#108C50;font-size:13px;flex-shrink:0"></i>
            Listing in PACT Certified Directory
          </div>
          <div style="display:flex;align-items:center;gap:9px;font-size:12px;color:var(--text)">
            <i class="fas fa-check-circle" style="color:#108C50;font-size:13px;flex-shrink:0"></i>
            Valid for 12 months from issue date
          </div>
          <div style="display:flex;align-items:center;gap:9px;font-size:12px;color:var(--text)">
            <i class="fas fa-check-circle" style="color:#108C50;font-size:13px;flex-shrink:0"></i>
            Priority access to PACT events
          </div>
        </div>
      </div>

      <div class="help-card">
        <h4>Need Help?</h4>
        <p>If you face any issues with the registration form, contact the P A C T Secretariat.</p>
        <div class="help-contact">
          <i class="fas fa-phone-alt"></i>
          <a href="tel:+919417223355">+91 94172-23355</a>
        </div>
        <div class="help-contact">
          <i class="fas fa-envelope"></i>
          <a href="mailto:info@pact.org.in">info@pact.org.in</a>
        </div>
        <div class="help-contact">
          <i class="fas fa-clock"></i>
          <a href="#">Mon–Sat, 10 AM – 5 PM</a>
        </div>
      </div>

    </div><!-- /sidebar -->

  </div><!-- /reg-layout -->

</div><!-- /page-body -->


<script>
/* ── STATE ── */
let tncAccepted = false;
let selectedAssoc = '';

/* ── T&C TOGGLE ── */
function toggleTnC() {
  tncAccepted = !tncAccepted;
  const box   = document.getElementById('tnc-accept-box');
  const cb    = document.getElementById('tnc-checkbox');
  const tick  = document.getElementById('tnc-tick');
  box.classList.toggle('accepted', tncAccepted);
  tick.style.display = tncAccepted ? 'block' : 'none';
  document.getElementById('sum-tnc').textContent = tncAccepted ? '✅ Accepted' : 'Not accepted yet';
  document.getElementById('tnc-error').style.display = 'none';
}

/* ── ASSOCIATION SELECT ── */
function selectAssoc(el, name) {
  document.querySelectorAll('.assoc-option').forEach(o => {
    o.classList.remove('selected');
    o.querySelector('.assoc-check i').style.display = 'none';
  });
  el.classList.add('selected');
  el.querySelector('.assoc-check i').style.display = 'inline';
  selectedAssoc = name;
  document.getElementById('sum-assoc').textContent = name;
  document.getElementById('assoc-error').style.display = 'none';
  document.getElementById('other-assoc-wrap').style.display = (name === 'Other Association') ? 'block' : 'none';
}

/* ── SERVICE TOGGLE ── */
function toggleService(el) {
  const cb = el.querySelector('input[type="checkbox"]');
  cb.checked = !cb.checked;
  el.classList.toggle('checked', cb.checked);
  updatePayBtn();
  document.getElementById('service-error').style.display = 'none';
}

function updatePayBtn() {
  const anyChecked = [...document.querySelectorAll('#services-grid input[type="checkbox"]')].some(c => c.checked);
  const btn = document.getElementById('pay-btn');
  btn.classList.toggle('enabled', anyChecked);
}

/* ── STEP NAVIGATION ── */
const steps = ['form-step-1','form-step-2','form-step-3','form-step-4'];
const labels = [
  'Step 1 of 4 — Terms & Conditions',
  'Step 2 of 4 — Association Selection',
  'Step 3 of 4 — Applicant Details',
  'Step 4 of 4 — Services & Payment'
];
const progWidths = ['25%','50%','75%','100%'];

function goStep(n) {
  /* Validations */
  if (n === 2 && !tncAccepted) {
    document.getElementById('tnc-error').style.display = 'flex';
    return;
  }
  if (n === 3 && !selectedAssoc) {
    document.getElementById('assoc-error').style.display = 'flex';
    return;
  }
  if (n > 3) {
    const fn = document.getElementById('firm-name').value.trim();
    const em = document.getElementById('email').value.trim();
    const mo = document.getElementById('mobile1').value.trim();
    const ad = document.getElementById('address').value.trim();
    const pr = document.getElementById('proprietor').value.trim();
    const di = document.getElementById('district').value;
    const co = document.getElementById('companies').value.trim();
    if (!fn||!em||!mo||!ad||!pr||!di||!co) {
      alert('Please fill in all required fields before proceeding.');
      return;
    }
    document.getElementById('sum-details').textContent = '✅ ' + fn;
  }

  /* Hide all steps */
  steps.forEach(id => document.getElementById(id).style.display = 'none');
  document.getElementById(steps[n-1]).style.display = 'block';

  /* Update stepper */
  for (let i = 1; i <= 4; i++) {
    const si = document.getElementById('step-ind-' + i);
    if (!si) continue;
    si.classList.remove('active','done');
    if (i < n) si.classList.add('done');
    if (i === n) si.classList.add('active');
    const circ = si.querySelector('.step-circle');
    if (i < n) circ.innerHTML = '<i class="fas fa-check" style="font-size:12px"></i>';
    else circ.textContent = i;
  }

  /* Progress bar */
  document.getElementById('prog-fill').style.width = progWidths[n-1];
  document.getElementById('prog-label').textContent = labels[n-1];

  window.scrollTo({top:0,behavior:'smooth'});
}

/* ── SUBMIT ── */
function submitForm() {
  const checkboxes = document.querySelectorAll('#services-grid input[type="checkbox"]');
  const services = [...checkboxes].filter(c => c.checked).map(c => c.nextElementSibling.innerText);
  if (services.length === 0) {
    document.getElementById('service-error').style.display = 'flex';
    return;
  }

  const payload = {
    association: selectedAssoc === 'Other Association' ? document.getElementById('other-assoc-name').value : selectedAssoc,
    firm_name: document.getElementById('firm-name').value,
    district: document.getElementById('district').value,
    address: document.getElementById('address').value,
    proprietor: document.getElementById('proprietor').value,
    mobile_primary: document.getElementById('mobile1').value,
    contact2_name: document.getElementById('contact2-name').value,
    mobile_secondary: document.getElementById('mobile2').value,
    email: document.getElementById('email').value,
    website: document.getElementById('website').value,
    portal: document.getElementById('portal').value,
    companies_dealt_with: document.getElementById('companies').value,
    services_offered: services
  };

  const btn = document.getElementById('pay-btn');
  const originalText = btn.innerHTML;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
  btn.style.pointerEvents = 'none';

  fetch('{{ route('registration-certificate.store') }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'Accept': 'application/json'
    },
    body: JSON.stringify(payload)
  })
  .then(res => res.json())
  .then(data => {
    btn.innerHTML = originalText;
    btn.style.pointerEvents = 'all';
    if (data.success) {
      alert(data.message + '\n\nRedirecting to payment gateway...\n(In production this will open the Razorpay checkout)');
      // location.reload(); // optionally clear form
    } else {
      let errorMsg = data.message || 'Something went wrong.';
      if (data.errors) {
        errorMsg += '\n' + Object.values(data.errors).flat().join('\n');
      }
      alert('Error: ' + errorMsg);
    }
  })
  .catch(err => {
    btn.innerHTML = originalText;
    btn.style.pointerEvents = 'all';
    alert('Failed to submit. Please check your connection.');
  });
}
</script>
@endsection