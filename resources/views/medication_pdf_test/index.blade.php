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
            <div class="footer-left" style="font-size: 20px;  font-weight: bold; color: #e53935;">
            Dr. {{ $medication->doctor_name }}<br>
            <span class="doctor-detail">{{ $medication->about ?? 'Doctor\'s details not available' }}</span>
            </div>
            <div class="footer-right" style="margin-top:-35px">
             <img src="{{ $medication->profile_image }}" alt="Doctor's Profile" width="80px" height="70px">
            </div>
        </div>
        <!-- Patient Information Table -->
        <table class="avoid-page-break">
            <tr class="bg-yellow">
                <td colspan="2">Patient's Name: <strong>{{ $medication->patient_name }}</strong></td>
                <td colspan="2">
                   Date: <strong>{{ date('d F Y, h:i A', strtotime($medication->created_at)) }}</strong>
                </td>
            </tr>
            <tr class="bg-blue">
                <td>Phone No: <strong>{{ $medication->patient_phone }}</strong></td>
                 <td>Date of Birth: <strong>{{ date('d/m/Y', strtotime($medication->dob)) }}</strong></td>
                  <td>Blood Group: <strong>{{ $medication->blood_group}}</strong></td>
            </tr>
            <tr class="bg-yellow">
                <td>Age: <strong>{{ $medication->age }} years</strong></td>
                <td>Sex: <strong>{{ $medication->gender }}</strong></td>
                <td>Height: <strong>{{ $medication->height ?? 'N/A' }}</strong></td>
                 <td>Weight: <strong>{{ $medication->weight ?? 'N/A' }} kg</strong></td>
            </tr>
            </table>
            
            <table class="avoid-page-break">
                 <tr class="bg-blue">
                <td colspan="2">Blood Pressure: <strong>{{ $medication->blood_pressure ?? 'N/A' }}</strong></td>
                <td colspan="2">Pulse Rate: <strong>{{ $medication->pulse ?? 'N/A' }}</strong></td>
            </tr>
            <tr class="bg-yellow">
                <td colspan="2">Temperature: <strong>{{ $medication->temperature ?? 'N/A' }}</strong></td>
                <td colspan="1">Diabetic: <strong>{{ $medication->diabetic ?? 'N/A' }}</strong></td>
                <td colspan="1">SPO2: <strong>{{ $medication->spo2 ?? 'N/A' }}</strong></td>
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
        <table class="avoid-page-break">
            <tr class="bg-blue">
              <td colspan="4">Diagnosis: 
                 
                   @foreach(json_decode($medication->diagnosis) as $diagnosis)
                    <strong> {{ $diagnosis->diagnosis }} </strong>( {{ $diagnosis->remark }}),
                   @endforeach
                  
              </td>
            </tr>
        </table>



            
            <table class="avoid-page-break">
                    <tr class="bg-yellow">
                  <td colspan="4">Lab Test: 
                     
                       @foreach(json_decode($medication->labtest) as $lab)
                      <strong>   {{ $lab->lab }}</strong> ({{ $lab->remark }}),
                       @endforeach
                      
                  </td>
                </tr>
            </table>

        <!-- Medicine Details Table -->
        <table class="avoid-page-break">
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
        <table class="avoid-page-break">
            <tr class="bg-yellow">
                <td>Notes: 
                  
                        @foreach(json_decode($medication->notes) as $note)
                           <strong>   {{ $note->symptoms }}</strong> ({{ $note->remark }}),
                        @endforeach
                    
                </td>
            </tr>
        </table>

        <!-- Footer Section -->
        <div class="footer">
            <div class="footer-left">
                Sleekcare<br>
                www.sleekcare.com
            </div>
            <div class="footer-right">
                Signature of Physician: <img src="{{ $medication->signature }}" alt="Doctor's Signature" width="80px" height="30px">
            </div>
        </div>
    </div>

</body>
</html>
