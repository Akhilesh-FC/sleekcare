<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Prescription</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:white;
        }

        .prescription-container {
            width: 100%;
            margin: 0 auto;
            background-color: white;
            border: 1px solid #ddd;
            box-shadow: none;
        }

        /* Header Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }

        .logo-right {
            font-size: 16px;
            font-weight: bold;
            text-align: right;
        }

        .header .rx {
            text-align: right;
            width: 40%;
        }

        .header .rx img {
            height: auto;
            object-fit: cover;
              }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .section-header {
            background-color: #fafafa;
            font-weight: bold;
        }

        .bg-blue {
            background-color: #e0f7fa;
        }

        .bg-yellow {
            background-color: #fffde7;
        }

        /* Footer Styles */
        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        .footer-left {
            font-size: 12px;
            color: #888;
            font-weight: bold;
        }

        .footer-right {
            font-size: 16px;
            font-weight: bold;
            text-align: right;
        }

        /* Doctor Details */
        .doctor-detail {
            font-size: 13px;
            color: black;
        }

        /* Page Break Styles */
        .page-break {
            page-break-after: always;
        }

        .avoid-page-break {
            page-break-inside: avoid;
        }
    </style>
</head>

<body style="height:1754px;">
    
    <div class="prescription-container">
             
        <div class="footer">
             <div  class="footer-left">
             <img src="{{ $medication->logo }}" alt="Doctor's Profile" width="80px" height="70px">
             <p class="doctor-detail">{{ $medication->hospital_number ?? 'N/A' }}</p>
            </div>
            <div class="footer-right" style="font-size: 20px; margin-top:-80px;font-weight: bold; color: #e53935;">
            Dr. {{ $medication->doctor_name }}<br>
                <p class="doctor-detail">
                    @php
                        $d_about = json_decode($medication->about);
                    @endphp
                    @if($d_about != null)
                        @foreach($d_about as $key => $dc)
                            {{ $dc }}{{ $loop->last ? '' : ', ' }}
                        @endforeach
                    @else
                        {{ 'N/A' }}
                    @endif
            </p>
            </div>
        </div>
        <!-- Patient Information Table -->
        <table class="avoid-page-break" style="font-size:12px;">
            <tr class="bg-yellow">
                <td colspan="2">Patient's Name: <strong>{{ $medication->patient_name }}</strong></td>
                <td colspan="2">
                   Date: <strong>{{ date('d F Y, h:i A', strtotime($medication->created_at)) }}</strong>
                </td>
            </tr>
            <tr class="bg-blue">
                <td>Phone No: <strong>{{ $medication->patient_phone }}</strong></td>
                <td>Age: <strong>{{ $medication->age }} years</strong></td>
                <td>Sex: <strong>{{ $medication->gender }}</strong></td>
                <td></td>
            </tr>
            </table>
            <table class="avoid-page-break" style="font-size:12px;">
                 <tr class="bg-yellow">
                     <td>Blood Group: <strong>{{ $medication->blood_group??'N/A'}}</strong></td>
                     <td>Height: <strong>{{ $medication->height ?? 'N/A' }}</strong></td>
                     <td>Weight: <strong>{{ $medication->weight ?? 'N/A' }} kg</strong></td>
                </tr>
                 <tr class="bg-blue">
                    <td>Temperature: <strong>{{ $medication->temperature ?? 'N/A' }}</strong></td>
                    <td>Blood Pressure: <strong>{{ $medication->blood_pressure ?? 'N/A' }}</strong></td>
                    <td>Pulse Rate: <strong>{{ $medication->pulse ?? 'N/A' }}</strong></td>
                 </tr>
              <tr class="bg-yellow">
                 <td colspan="1">Diabetic: <strong>{{ $medication->diabetic ?? 'N/A' }}</strong></td>
                 <td colspan="1">SPO2: <strong>{{ $medication->spo2 ?? 'N/A' }}</strong></td>
                 <td></td>
            </tr>
            <tr class="bg-yellow">
                <td colspan="4">Symptoms: 
                        @foreach(json_decode($medication->symptoms) as $symptom)
                         <strong> {{ $symptom->symptoms }}</strong> ({{ $symptom->remark }}),
                        @endforeach
                </td>
            </tr>
          </table>
        <!-- Diagnosis Table -->
        <table class="avoid-page-break" style="font-size:12px;">
            <tr class="bg-blue">
              <td colspan="4">Diagnosis: 
                   @foreach(json_decode($medication->diagnosis) as $diagnosis)
                    <strong> {{ $diagnosis->diagnosis }} </strong>( {{ $diagnosis->remark }}),
                   @endforeach
              </td>
            </tr>
        </table>
            <table class="avoid-page-break" style="font-size:12px;">
                    <tr class="bg-yellow">
                  <td colspan="4">Lab Test: 
                       @foreach(json_decode($medication->labtest) as $lab)
                      <strong>   {{ $lab->lab }}</strong> ({{ $lab->remark }}),
                       @endforeach
                  </td>
                </tr>
            </table>
        <!-- Medicine Details Table -->
        <table class="avoid-page-break"  style="font-size:12px;">
            <tr class="section-header">
                <th>Medicine</th>
                <th>Time to Take</th>
                <th>To Be Taken</th>
                <th>Tablets</th>
            </tr>
            @foreach(json_decode($medication->medicine_details) as $medicine)
            <tr class="{{ $loop->index % 2 == 0 ? 'bg-blue' : 'bg-yellow' }}">
                <td>{{ $medicine->medicineData }}</td>
                <td>{{ $medicine->timeTake }}</td>
                <td>{{ $medicine->toBeTaken }}</td>
                <td>{{ $medicine->tablets }}</td>
            </tr>
            @endforeach
        </table>

        <!-- Notes Section -->
        <table class="avoid-page-break" style="font-size:12px;">
            <tr class="bg-yellow">
                <td>Notes: 
                        @foreach(json_decode($medication->notes) as $note)
                           <strong>   {{ $note->symptoms }}</strong> ({{ $note->remark }}),
                        @endforeach
                </td>
            </tr>
        </table>
               <div class="footer" style="border:none;font-size:12px" >
                   <div class="footer-left">
                      <b style="font-weight: bold;color:black;"> Doctor Name:</b>&nbsp;<u>{{ $medication->doctor_name }}</u>
                       </div>
                       <div class="footer-right" style="vertical-align: middle;">
                       </strong>  Doctor Sign:</strong>&nbsp;  <u><img src="{{ $medication->signature }}" alt="Doctor's Signature" width="80px" height="30px"></u>
                       </div>
                    </div>
            <table class="avoid-page-break"  style="font-size:12px;border:none;">
                <tr>
                    <td style="border:none;">
                        <img src="https://sleekcare.apponrent.co.in/icons/mobile_icon.png" alt="Phone Icon" width="20px" height="20px" style="vertical-align: middle;"> &nbsp; 
                        <span style="display: inline-block; vertical-align: middle;"> <strong>{{$medication->mobile}}</strong></span><br>
                        <img src="https://sleekcare.apponrent.co.in/icons/mobile_icon.png" alt="Phone Icon" width="20px" height="20px" style="vertical-align: middle;"> &nbsp; 
                        <span style="display: inline-block; vertical-align: middle;"> <strong>{{$medication->alternate_number}}</strong></span><br>
                    </td>
                                    <td style="border:none;">
                    @php
                        $m_time = json_decode($medication->time);
                    @endphp
                    @if($m_time != null)
                        @foreach($m_time as $m_t)
                            <span style="display: inline-block; vertical-align: middle;">
                                Time: <strong>{{ $m_t }}</strong>
                            </span><br>
                        @endforeach
                    @else
                        <span>N/A</span>
                    @endif
                </td>
                
                <td style="border:none;">
                    <img src="https://sleekcare.apponrent.co.in/icons/address_icon.png" alt="Address Icon" width="30px" height="30px" style="vertical-align: middle;"> &nbsp;
                    <span style="display: inline-block; vertical-align: middle;">
                        @php
                            $d_address = json_decode($medication->address);
                        @endphp
                        @if($d_address != null)
                            @foreach($d_address as $d_ad)
                                {{$loop->iteration}}. {{ $d_ad }}<br>
                            @endforeach
                        @else
                            {{ 'N/A' }}
                        @endif
                    </span>
                </td>

                </tr>
            </table>
    </div>
</body>
</html>
