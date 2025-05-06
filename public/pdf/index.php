<?php
require('vendor/autoload.php');
$con=mysqli_connect("localhost","u873167744_sleekcare","u873167744_Sleekcare","u873167744_sleekcare");

$doctorid=$_GET['doctorid'];
$appointment_id=$_GET['appointment_id'];
$uhid=$_GET['uhid'];

$sql = "SELECT appointments.name, appointments.gender, appointments.uhid, medication.id, docters.name AS doctor_name, docters.logo , docters.signature ,docters.about, medication.notes_remark AS notes, medication.spo2, medication.lab AS report_suggestion, docters.hospital_number AS hospital_name, docters.address, medication.temprature, medication.weights, medication.pulse, medication.height, medication.tables AS after_food, medication.medical_details AS medication, docters.mobile, docters.time AS date, medication.blood_group AS blood_pressure FROM medication, appointments, docters WHERE appointments.id = medication.appointment_id AND docters.id = medication.doctor_id AND medication.doctor_id='$doctorid' AND medication.appointment_id='$appointment_id'AND appointments.uhid='$uhid' ;";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $doctor_signature_url = $row['signature'];
        $dd = json_decode($row["medication"], true);
        $array = explode(",", $dd[0]);
        $report_suggestion = json_decode($row["report_suggestion"], true);
        $report_suggestion = explode(",", $report_suggestion[0]);

        $html = '<html lang="en">
        <head>
            <style>
                .row { display: flex; justify-content: space-between; }
                .column { flex: 1; text-align: center; }
            </style>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Responsive Prescription UI</title>
            <link rel="stylesheet" href="styles.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        </head>
        <body>
            <div class="container">
                <header>
                    <div class="logoo">
                        <h1>wellbe</h1>
                        <p>' . $row["hospital_name"] . '</p>
                    </div>
                    <div class="clinic">
                        <h2></h2>
                    </div>
                    <div class="doctor-info">
                        <p>Dr. ' . $row["doctor_name"] . '</p>
                        <p>' . $row["about"] . '</p>
                    </div>
                </header>
                <section class="patient-details">
                    <div class="row">
                        <div class="col">
                            <p>Name: <span>' . $row["name"] . '</span></p>
                            <p>Age/Gender: <span>' . $row["gender"] . '</span></p>
                            <p>UHID: <span>' . $row["uhid"] . '</span></p>
                        </div>
                        <div class="col">
                            <p>Date & Time: <span>' . $row["date"] . '</span></p>
                        </div>
                    </div>
                </section>
                <section class="vital-info">
                    <div class="row">
                        <div class="col">
                            <p>Temperature: <span>' . $row["temprature"] . '</span><span>°F</span></p>
                            <p>Pulse: <span>' . $row["pulse"] . '</span><span>pm</span></p>
                        </div>
                        <div class="col">
                            <p>Height: <span>' . $row["height"] . '</span></p>
                            <p>Weight: <span>' . $row["weights"] . '</span><span>kg</span></p>
                        </div>
                        <div class="col">
                            <p>BP: <span>' . $row["blood_pressure"] . '</span></p>
                            <p>SPO<sub>2</sub>:<span>' . $row["spo2"] . '</span><span>%</span></p>
                        </div>
                    </div>
                </section>';

        if(count($array) > 0) {
            $html .= '<section class="medicines">
                <h3>Medicines:</h3>
                <table>';
                for($i = 0; $i < count($array); $i++) {
                    $html .= '<tr>
                        <td><span>' . $array[$i] . '</span></td>
                        <td>' . $row["after_food"] . ' (After Food)</td>
                    </tr>';
                }
                $html .= '</table>
            </section>';
        };
        
        
            
        

        $html .= '<div class="row">
            <div class="column" id="part1">
                <i class="fas fa-mobile-alt"></i> : ' . $row["mobile"] . '
            </div>
            <div class="column" id="part2">
                ' . $row["date"] . '
            </div>
            <div class="column" id="part3">
                <i class="fas fa-map-marker-alt"></i> : ' . $row["address"] . '
            </div>
        </div>
    </div>
</body>
</html>';

        // Create the PDF
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $file = 'media/' . time() . '.pdf';
        $mpdf->output($file, 'I');
    }
} else {
    echo "Data not found";
}
?>

pdf