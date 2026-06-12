@extends('layouts.backend')

@section('title', 'Generate Certificate')

@section('content')

@php
  // Dynamic Template Colors
  $outerBorder = '#0F172A'; // Default Navy
  $innerBorder = '#D97706'; // Default Gold
  $sealColor = '#D97706';
  
  if ($selectedTemplate && stripos($selectedTemplate->name, 'premium') !== false) {
      $outerBorder = '#1E293B'; // Dark Slate
      $innerBorder = '#0EA5E9'; // Emerald
      $sealColor = '#0EA5E9';
  } elseif ($selectedTemplate && stripos($selectedTemplate->name, 'standard') !== false) {
      $outerBorder = '#166534'; // Forest Green
      $innerBorder = '#EAB308'; // Yellow Gold
      $sealColor = '#EAB308';
  }
@endphp

<style>
  /* Premium Certificate Styling */
  .cert-container {
    max-width: 1050px;
    margin: 0 auto;
    background: #fff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    position: relative;
  }
  
  .cert-border-outer {
    border: 12px solid {{ $outerBorder }};
    padding: 8px;
    background: #fff;
  }

  .cert-border-inner {
    border: 3px solid {{ $innerBorder }};
    padding: 50px;
    position: relative;
    background: #FAF9F6;
    background-image: radial-gradient(#E2E8F0 1px, transparent 1px);
    background-size: 20px 20px;
  }

  .cert-header {
    text-align: center;
    margin-bottom: 40px;
  }

  .cert-logo {
    width: 100px;
    height: 100px;
    background: {{ $outerBorder }};
    border-radius: 50%;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: {{ $innerBorder }};
    font-size: 40px;
    border: 3px solid {{ $innerBorder }};
  }

  .cert-title {
    font-family: 'Playfair Display', serif;
    font-size: 48px;
    font-weight: 700;
    color: {{ $outerBorder }};
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 10px;
  }

  .cert-subtitle {
    font-family: 'Merriweather', serif;
    font-size: 18px;
    color: {{ $innerBorder }};
    font-style: italic;
    letter-spacing: 0.05em;
  }

  .cert-body {
    text-align: center;
    margin: 50px 0;
  }

  .cert-text {
    font-size: 18px;
    color: #475569;
    margin-bottom: 20px;
  }

  .cert-recipient {
    font-family: 'Playfair Display', serif;
    font-size: 54px;
    font-weight: 700;
    color: {{ $outerBorder }};
    margin: 20px 0;
    border-bottom: 2px solid {{ $innerBorder }};
    display: inline-block;
    padding: 0 40px 10px;
  }

  .cert-description {
    font-size: 18px;
    color: #475569;
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.8;
  }

  .cert-footer {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-top: 80px;
    padding: 0 40px;
  }

  .cert-signature {
    text-align: center;
    width: 250px;
  }

  .cert-signature-line {
    border-top: 1px solid {{ $outerBorder }};
    margin-top: 40px;
    padding-top: 10px;
    font-weight: 600;
    color: {{ $outerBorder }};
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .cert-seal {
    width: 120px;
    height: 120px;
    background: {{ $sealColor }};
    border-radius: 50%;
    border: 4px dashed #fff;
    box-shadow: 0 0 0 4px {{ $sealColor }};
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: bold;
    text-align: center;
    font-size: 14px;
    text-transform: uppercase;
  }

  .generator-form {
    background: var(--surface);
    padding: 20px 24px;
    border-radius: 12px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
  }

  .form-group {
    flex: 1;
    min-width: 250px;
  }

  .form-group label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: var(--text-muted);
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .form-group select {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid var(--border);
    border-radius: 8px;
    background: var(--bg);
    color: var(--text-main);
    font-family: var(--font);
    font-size: 14px;
    outline: none;
  }
  
  .form-group select:focus {
    border-color: var(--primary);
  }

  /* Actions Bar */
  .actions-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
  }

  /* Print Styles */
  @media print {
    body * {
      visibility: hidden;
    }
    .cert-container, .cert-container * {
      visibility: visible;
    }
    .cert-container {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      box-shadow: none;
      padding: 0;
    }
    .actions-bar, .generator-form, #header, #sidebar {
      display: none !important;
    }
    @page {
      size: landscape;
      margin: 0;
    }
  }
</style>

<!-- Google Fonts for Premium Typography -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@0;1&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

<!-- The Generator UI -->
<div class="actions-bar">
  <div>
    <h2 style="font-size:22px; font-weight:700; color:var(--text-main)"><i class="fa-solid fa-award" style="color:var(--primary); margin-right:8px"></i>Certificate Generator</h2>
    <p style="font-size:13px; color:var(--text-muted); margin-top:4px">Select an applicant and a template, then print or download the certificate.</p>
  </div>
  <div>
    <button class="btn btn-outline" onclick="window.history.back()"><i class="fa-solid fa-arrow-left"></i> Back</button>
    <button class="btn btn-primary" onclick="window.print()"><i class="fa-solid fa-print"></i> Download PDF</button>
  </div>
</div>

<form method="GET" action="{{ route('admin.certificates.generated') }}" class="generator-form">
  <div class="form-group">
    <label>Select Applicant (Firm Name)</label>
    <select name="reg_id">
      @foreach($registrations as $reg)
        <option value="{{ $reg->id }}" {{ ($selectedRegistration && $selectedRegistration->id == $reg->id) ? 'selected' : '' }}>
          {{ $reg->firm_name }} — {{ $reg->association }}
        </option>
      @endforeach
    </select>
  </div>
  
  <div class="form-group">
    <label>Select Template Design</label>
    <select name="template_id">
      @foreach($templates as $tmpl)
        <option value="{{ $tmpl->id }}" {{ ($selectedTemplate && $selectedTemplate->id == $tmpl->id) ? 'selected' : '' }}>
          {{ $tmpl->name }} ({{ $tmpl->orientation }})
        </option>
      @endforeach
    </select>
  </div>
  
  <div style="display:flex; align-items:flex-end;">
    <button type="submit" class="btn btn-primary" style="height:42px; padding:0 24px; margin-top:20px;">
      <i class="fa-solid fa-wand-magic-sparkles"></i> Generate
    </button>
  </div>
</form>

<!-- The Certificate Preview -->
@if($selectedRegistration)
<div class="cert-container">
  <div class="cert-border-outer">
    <div class="cert-border-inner">
      
      <div class="cert-header">
        <div class="cert-logo">
          <i class="fa-solid fa-building-shield"></i>
        </div>
        <div class="cert-title">Certificate of Registration</div>
        <div class="cert-subtitle">Punjab Association of Computer Traders</div>
      </div>

      <div class="cert-body">
        <div class="cert-text">This is to certify that</div>
        <div class="cert-recipient">{{ $selectedRegistration->firm_name }}</div>
        <div class="cert-description">
          Owned and operated by <strong>{{ $selectedRegistration->proprietor }}</strong>, located in the district of <strong>{{ $selectedRegistration->district }}</strong>, is officially recognized as a registered and verified member of the <strong>{{ $selectedRegistration->association }}</strong>.
        </div>
      </div>

      <div class="cert-footer">
        <div class="cert-signature">
          <div style="font-family:'Homemade Apple', cursive; font-size:24px; color:{{ $outerBorder }}; margin-bottom:-10px;">President</div>
          <div class="cert-signature-line">Association President</div>
        </div>
        
        <div class="cert-seal">
          Official<br>Seal<br>{{ date('Y') }}
        </div>

        <div class="cert-signature">
          <div style="font-family:'Homemade Apple', cursive; font-size:24px; color:{{ $outerBorder }}; margin-bottom:-10px;">Secretary</div>
          <div class="cert-signature-line">General Secretary</div>
        </div>
      </div>

    </div>
  </div>
</div>
@else
<div style="text-align:center; padding:60px; background:#fff; border-radius:12px; border:1px dashed var(--border); color:var(--text-muted);">
  <i class="fa-solid fa-certificate" style="font-size:40px; margin-bottom:14px; opacity:0.5;"></i>
  <h3 style="color:var(--text-main); margin-bottom:6px;">No Registration Selected</h3>
  <p>Please select an applicant from the dropdown above and click Generate to preview.</p>
</div>
@endif

@endsection