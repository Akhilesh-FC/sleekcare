<?php
$con=mysqli_connect("localhost","u873167744_sleekcare","u873167744_Sleekcare","u873167744_sleekcare");
$doctorid=$_GET['doctorid'];
$appointment_id=$_GET['appointment_id'];
$uhid=$_GET['uhid'];

$sql = "SELECT appointments.name, appointments.gender, appointments.uhid, medication.id, docters.name AS doctor_name, docters.logo , docters.signature ,docters.about, medication.notes_remark AS notes, medication.spo2, medication.lab AS report_suggestion, docters.hospital_number AS hospital_name, docters.address, medication.temprature, medication.weights, medication.pulse, medication.height, medication.tables AS after_food, medication.medical_details AS medication, docters.mobile, docters.time AS date, medication.blood_group AS blood_pressure FROM medication, appointments, docters WHERE appointments.id = medication.appointment_id AND docters.id = medication.doctor_id AND medication.doctor_id='$doctorid' AND medication.appointment_id='$appointment_id'AND appointments.uhid='$uhid' ;";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
   
         
        $doctor_signature_url = $row['signature'];

         $dd= json_decode($row["medication"]); 
         
         $array = explode(",", $dd[0]);

         $report_suggestion= json_decode($row["report_suggestion"]); 
        
         $report_suggestion = explode(",", $report_suggestion[0]);
    
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>


    <body>
        <div class="container">
            <header>
                <div class="logoo">
                    
                    <img src="<?php echo $logo; ?>" style="height: 75px; width: 180px;">
                     <p>Hospital Name: <span><?php echo $row["hospital_name"]; ?></span></p>
                </div>
                <div class="clinic">
                    <h2></h2>
                </div>
                <div class="doctor-info">
                    <p>Dr. <?php echo $row["doctor_name"]; ?></p>
                   <?php echo $row["about"]; ?></span></p>
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
            <?php if(count($array)>0){ ?>
            <section class="medicines">
                <h3>Medicines:</h3>
                <table>
                    <?php for($i=0;$i<count($array);$i++){ ?>
                    <tr>
                        <td><span><?php echo  $array[$i]; ?></span></td>
                        <td><?php echo  $row["after_food"]; ?> (After Food)</td>
                    </tr>
                    <?php } ?>
                    
                </table>
            </section>
            <?php } ?>
            <?php if(count($report_suggestion)>0){ ?>
            <section class="report-suggestion">
                <h3>Report Suggestion:</h3>
                 <?php for($i=0;$i<count($report_suggestion);$i++){ ?>
                <p><?php echo $i+1;?> . <?php echo $report_suggestion[$i];?></p>
                <?php } ?>
                <?php      echo '<img src="' . $doctor_signature_url . '" alt="Doctor Signature" style="height: 75px; width: 180px; display:inline; float:right; margin-top:-90px;">' ?>
            </section>
            <?php } ?>
            <section class="notes">
                <?php if(!empty($row["notes"])){ ?>
                <h3>Additional Notes/Advance Care:</h3>
                 <?php echo $row["notes"]; ?>
                 <?php } ?>
                <h4 class="doctor-infoo">Dr. Dan Steve</h4 </section>
                <!-- footer -->
                <div class="row">
                    <div class="column" id="part1">
                        <i class="fas fa-mobile-alt"></i> : <?php echo $row["mobile"]; ?>
                    </div>
                    <div class="column" id="part2">
                        <?php echo $row["date"]; ?>
                    </div>
                    <div class="column" id="part3">
                        <i class="fas fa-map-marker-alt"></i> : <?php echo $row["address"]; ?>
                    </div>
                </div>
                <!-- endfooter -->
        </div>
    </body>

</html>

<?php  }
} else {
    echo "0 results";
    
}


?>