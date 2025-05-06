<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header, .footer {
            text-align: center;
            margin-top: 20px;
        }
        .prescription-table th, .prescription-table td {
            text-align: center;
            vertical-align: middle;
        }
        .followup, .referred {
            font-weight: bold;
        }
        .drhead
        {
            float:right;
            color:#5a03c0;
            font-size:18px;
            font-weight: 600;
        }
        .dr
        {
          
            color:#5a03c0;
            font-size:18px;
            font-weight: 600;
        }
        .rightdate
        {
            float:right;
        }
        .text-center
        {
            border-bottom: 1px solid #5a03c0;;
            display: inline-block;
            text-align: center;
            color:#5a03c0;
        }
        .tabl-dark
        {
           background-color:#e4d; 
        }

    </style>
</head>
<body>

<div class="container card mt-5 p-4">
    <div class="row">
    <div class="col-3 headerr">
            <img src="abc.jpg" height="80%"  class="ml-3" width="40%"alt="">       
        </div>
        <div class="col-9 headerr">
          <span class="dr">Dr. Ayush Mohan Rao</span><span class="drhead">Rao EyeCare</span>     
        </div>
        <hr>
        <div class="col-12 mt-4">
            <span><strong>Indra Mohan Rao</strong>, Male, 56 years</span> <span class="text-end"><strong class="rightdate">Saturday, December 3, 2022 6:51 PM</strong></span>
            <p><strong>+919140676370</strong></p>
            <p>UHID : EK1000I.</p>
        </div>
        <div class="col-12">
           <center> <h4 class="text-center">PRESCRIPTION</h4></center>
            <table class="table table-bordered prescription-table">
                <thead class="table-secondary">
                    <tr>
                        <th>Medicine</th>
                        <th>Dose</th>
                        <th>Frequency</th>
                        <th>Duration</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Verifica-M 500Mg/50Mg Tablet (tablet)<br>Metformin (500mg) + Vildagliptin (50mg)</td>
                        <td>1 tablet</td>
                        <td>1-0-1<br>Before Meal</td>
                        <td>1 Week</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <p class="followup">FOLLOWUP: Visit on <span class="text-primary">Tue Jan 03 2023</span></p>
            <p class="referred">REFERRED TO: Doctor: Meera, Cardiologist (+91 9405042500)</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
