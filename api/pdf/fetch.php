<?php
$con=mysqli_connect("localhost","u873167744_sleekcare","u873167744_sleekcare","u873167744_sleekcare");
// $query="SELECT patients.name,patients.gender,patients.uhid,docters.name AS docters,medication.notes_remark as notes ,medication.spo2,medication.lab as report_suggetion,docters.hospital_number AS hospital_name ,docters.address, medication.temprature ,medication.weights ,medication.pulse,medication.height ,medication.tables AS Altter_food ,medication.medical_details AS medication ,docters.mobile ,docters.time AS date ,medication.blood_group as bp FROM medication,patients,docters WHERE patients.id=medication.patients_id AND docters.id = medication.doctor_id;";



// SQL query to retrieve data
$sql = "SELECT patients.name, patients.gender, patients.uhid, patients.id, docters.name AS doctor_name, docters.signature ,medication.notes_remark AS notes, medication.spo2, medication.lab AS report_suggestion, docters.hospital_number AS hospital_name, docters.address, medication.temprature, medication.weights, medication.pulse, medication.height, medication.tables AS after_food, medication.medical_details AS medication, docters.mobile, docters.time AS date, medication.blood_group AS blood_pressure FROM medication, patients, docters WHERE patients.id = medication.patients_id AND docters.id = medication.doctor_id AND docters.id='5'";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      //  echo "Patient Name: " . $row["name"]. "<br>";
       // echo "Gender: " . $row["gender"]. "<br>";
      //  echo "UHID: " . $row["uhid"]. "<br>";
     //   echo "Doctor's Name: " . $row["doctor_name"]. "<br>";
        echo "Notes: " . $row["notes"]. "<br>";
      //  echo "SpO2: " . $row["spo2"]. "<br>";
        echo "Report Suggestion: " . $row["report_suggestion"]. "<br>";
        echo "Hospital Name: " . $row["hospital_name"]. "<br>";
        echo "Doctor's Address: " . $row["address"]. "<br>";
      //  echo "Temperature: " . $row["temprature"]. "<br>";
      //  echo "Weight: " . $row["weights"]. "<br>";
     //   echo "Pulse: " . $row["pulse"]. "<br>";
     //   echo "Height: " . $row["height"]. "<br>";
        echo "After Food: " . $row["after_food"]. "<br>";
        echo "Medication: " . $row["medication"]. "<br>";
        echo "Doctor's Mobile: " . $row["mobile"]. "<br>";
        echo "Date: " . $row["date"]. "<br>";
        $doctor_signature_url = $row['signature'];

         $dd= json_decode($row["medication"])    ;  
        $dd[0];
     //   echo "Blood Pressure: " . $row["blood_pressure"]. "<br>";
        echo "<hr>";
   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    .row {
        display: flex;
        justify-content: space-between;
    }

    .column {
        flex: 1;
        text-align: center;
    }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Prescription UI</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
        integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
</head>

<body>

    <body>
        <div class="container">
            <header>
                <div class="logoo">
                    <h1>wellbe</h1>
                    <h3>Sujata Clinic</h3>
                </div>
                <div class="clinic">
                    <h2></h2>
                </div>
                <div class="doctor-info">
                    <p>Dr. Dan Steve</p>
                    <button>About the doctor</button>
                </div>
            </header>
            <section class="patient-details">
                <div class="row">
                    <div class="col">
                        <p>Name: <span><?php echo $row["name"]; ?></span></p>
                        <p>Age/Gender: <span><?php echo  $row["gender"];?></span></p>
                        <p>UHID: <span><?php echo $row["uhid"]; ?></span></p>
                    </div>
                    <div class="col">
                        <p>Doctor: <span><?php echo  $row["doctor_name"]; ?> </span></p>
                        <p>Department: <span>Cardiology</span></p>
                        <p>Date & Time: <span><?php echo $row["date"]; ?></span></p>
                    </div>
                </div>
            </section>
            <section class="vital-info">
                <div class="row">
                    <div class="col">
                        <p>Temperature: <span><?php echo  $row["temprature"];?></span><span>°F</span></p>
                        <p>Pulse: <span><?php  echo  $row["pulse"]; ?></span><span>pm</span></p>
                    </div>
                    <div class="col">
                        <p>Height: <span><?php  echo  $row["height"]; ?></span></p>
                        <p>Weight: <span><?php echo  $row["weights"]; ?></span><span>kg</span></p>
                    </div>
                    <div class="col">
                        <p>BP: <span><?php echo $row["blood_pressure"]; ?></span></p>
                        <p>SPO<sub>2</sub>:<span><?php echo$row["spo2"]; ?></span><span>%</span></p>
                    </div>
                </div>
            </section>
            <section class="medicines">
                <h3>Medicines:</h3>
                <table>
                    <tr>
                        <td>Sulisent :<span><?php echo  $dd[0]; ?></span></td>
                        <td>1-0-1-1 (After Food)</td>
                    </tr>
                    <tr>
                        <td>Sulisent :<span><?php echo  $dd[1]; ?></span></td>
                        <td>0-1-1-1 (After Food)</td>
                    </tr>
                    <tr>
                        <td>Sulisent 100 mg Tab (30 tabs)</td>
                        <td>0-0-1-0 (After Food)</td>
                    </tr>
                </table>
            </section>
            <section class="report-suggestion">
                <h3>Report Suggestion:</h3>
                <p>1. X-Ray - John Smith</p>
                <p>2. X-Ray - John Smith</p>
                <?php      echo '<img src="' . $doctor_signature_url . '" alt="Doctor Signature" style="height: 75px; width: 180px; display:inline; float:right; margin-top:-90px;">' ?>
            </section>
            <section class="notes">
                <h3>Additional Notes/Advance Care:</h3>
                <p>A patient note is the primary communication tool to other clinicians treating the patient.</p>
                <h4 class="doctor-infoo">Dr. Dan Steve</h4 </section>
                <!-- footer -->
                <div class="row">
                    <div class="column" id="part1">
                        <!-- Content for Part 1 -->a
                    </div>
                    <div class="column" id="part2">
                        <!-- Content for Part 2 -->b
                    </div>
                    <div class="column" id="part3">
                        <!-- Content for Part 3 -->c
                    </div>
                </div>
                <!-- endfooter -->
        </div>
    </body>

</html>
</body>

</html>
<?php  }
} else {
    echo "0 results";
    
}


?>