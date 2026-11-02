<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 12px;
        color: #000;
        line-height: 1.5;
    }

    .header {
        width: 100%;
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }

    .header-table {
        width: 100%;
    }

    .header-table td {
        vertical-align: middle;
    }

    .logo {
        width: 80px;
    }

    .title {
        font-size: 18px;
        font-weight: bold;
    }

    .subtitle {
        font-size: 11px;
        color: #555;
    }

    .section {
        margin-top: 15px;
    }

    .section-title {
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 5px;
        border-bottom: 1px solid #000;
        padding-bottom: 3px;
    }

    .box {
        border: 1px solid #ccc;
        padding: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 4px;
    }

    .label {
        font-weight: bold;
    }

    .image-box {
        text-align: center;
        margin-top: 10px;
    }

    .footer {
        margin-top: 20px;
        font-size: 10px;
        color: #555;
    }
</style>
</head>

@php
    $logo = public_path('images/logo.png');
@endphp

@if(file_exists($logo))
    <div style="margin-bottom:15px;">
        <img src="{{ $logo }}" height="100">
    </div>
@endif

<!-- HEADER -->
<!-- <div class="header">

    <table class="header-table">
        <tr>

            <td width="90">
                @php
                    $logoPath = public_path('images/logo.png');
                @endphp

                @if(file_exists($logoPath))
                    <img src="{{ $logoPath }}" width="70">
                @endif
            </td>

            <td>
                <div class="title">BreastSense</div>
                <div class="subtitle">Breast Cancer Detection System</div>
            </td>

        </tr>
    </table>

</div> -->

<!-- PATIENT INFORMATION -->
<div class="section">

    <div class="section-title">Patient Information</div>

        <table>

        <tr>
            <td width="50%">
                <span class="label">Patient ID:</span>
                P{{ $report->id }}
            </td>

            <td width="50%">
                <span class="label">Patient Name:</span>
                {{ $report->patient->full_name ?? '-' }}
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">IC Number:</span>
                {{ $report->patient->ic_number ?? '-' }}
            </td>

            <td>
                <span class="label">Phone Number:</span>
                {{ $report->patient->phone ?? '-' }}
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Age:</span>
                {{ $report->patient->age ?? '-' }}
            </td>

            <td>
                <span class="label">Sex:</span>
                {{ $report->patient->sex ?? 'Female' }}
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Prediction Date:</span>
                {{ $report->created_at->format('d M Y H:i') }}
            </td>

            <td>
                <span class="label">Prepared By:</span>
                {{ explode('@', auth()->user()->email)[0] }}
            </td>
        </tr>

    </table>

</div>

<!-- IMAGE -->
<div class="section">

    <div class="section-title">Ultrasound Image</div>

    <div class="image-box">

        @php
    $imagePath = public_path('storage/' . $report->image_path);
    @endphp

    @if(file_exists($imagePath))
        <img src="{{ $imagePath }}" width="180">
    @else
        <p>Image not found.</p>
        <p>{{ $imagePath }}</p>
    @endif

    </div>

</div>

<!-- FINDINGS -->
<div class="section">

    <div class="section-title">Findings</div>

    <div class="box">

        Lesion analysis demonstrates
        {{ strtolower($report->shape ?? 'unspecified') }}
        morphology with
        {{ strtolower($report->margin ?? 'unspecified') }}
        margins and an estimated lesion size of
        {{ $report->size ?? 'not available' }}.
        The lesion was classified as
        <strong>{{ $report->prediction ?? '-' }}</strong>
        with a confidence score of
        {{ number_format($report->confidence ?? 0, 2) }}%.

    </div>

</div>

<!-- IMPRESSION -->
<div class="section">

    <div class="section-title">Impression</div>

    <div class="box">

        Based on the ultrasound image analysis and extracted lesion characteristics, the lesion is predicted as
        <strong>{{ $report->prediction ?? '-' }}</strong>
        with a BI-RADS assessment category of
        <strong>{{ $report->birads_score ?? '-' }}</strong>.
        Clinical correlation and appropriate follow-up management are recommended according to the BI-RADS classification.

    </div>

</div>

<!-- BI-RADS -->
<div class="section">

    <div class="section-title">BI-RADS Assessment Categories</div>

    <div class="box">

        <strong>0:</strong> Additional imaging needed before a category can be assigned.<br>
        <strong>1:</strong> Negative. Continue regular screening mammograms.<br>
        <strong>2:</strong> Benign. Continue regular screening mammograms.<br>
        <strong>3:</strong> Probably benign. Get a follow-up mammogram in six months.<br>
        <strong>4:</strong> Suspicious. Biopsy should be considered.<br>
        <strong>5:</strong> Highly suggestive of malignancy. Need to get a biopsy.<br>
        <strong>6:</strong> Known biopsy-proven malignancy. Continue with breast cancer treatment.

    </div>

</div>

<!-- RECOMMENDATION -->
<div class="section">

    <div class="section-title">Recommendation</div>

    <div class="box">

        {{ $report->recommendation ?? 'No recommendation available.' }}

    </div>

</div>

<div class="footer">
    Generated automatically by BreastSense Breast Cancer Classification System.
</div>

</body>
</html>