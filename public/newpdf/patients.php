<?php
// Create connection
$conn = mysqli_connect("localhost", "u873167744_sleekcare", "u873167744_Sleekcare", "u873167744_sleekcare");


$phone=$_GET['phone'];


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data including images
$sql = "SELECT medication.*, medication.date AS dateeeeee, patients.name AS patientsname, patients.phone AS patientsphone, patients.uhid,docters.name AS doctor_name, docters.logo, docters.signature, docters.about,docters.mobile, docters.time AS date,docters.hospital_number AS hospital_name, docters.address,medication.blood_group AS blood_pressure, medication.tables AS after_food , medication.notes_remark AS notes_remarks ,medication.medical_details  ,medication.date AS date_time, docters.time AS date ,docters.address  FROM medication JOIN appointments ON medication.appointment_id = appointments.id JOIN patients ON appointments.phone = patients.phone JOIN docters ON docters.id=medication.doctor_id WHERE patients.phone ='$phone'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // echo "<div class='appointment-card'>";
        // echo "<div class='doctor-info'>";

        // Display doctor's logo directly
        $logo_url = $row["logo"];
    // //   echo "<img src='" . htmlspecialchars($logo_url) . "' alt='Doctor Signature' style='height: 100px;'>";

        // Display doctor's signature directly
         $signature_url = $row["signature"];
      ////   echo "<img src='" . htmlspecialchars($signature_url) . "' alt='Doctor Signature' style='height: 100px;'>";
      
      $app_id = $row["appointment_id"];
      $medic_id = $row["id"];
      $dd= json_decode($row["medication"])    ;  
      $dd[0];
      $mr= json_decode($row["medicine_remark"])    ;  
      $mr[0];
      $bb= json_decode($row["dignosis"])    ;  
      $bb[0];
      $br= json_decode($row["diagnosis_remark"])    ;  
      $br[0];
      $sy= json_decode($row["symptoms"])    ;  
      $sy[0];
      $sr= json_decode($row["symptoms_remark"])    ;  
      $sr[0];
      $ss= json_decode($row["tme_to_take"])    ;  
      $ss[0];
      $ll= json_decode($row["lab"])    ;  
      $ll[0];
      $lr= json_decode($row["lab_remark"])    ;  
      $lr[0];
       $nn= json_decode($row["notes_remarks"])    ;  
      $nn[0];
      $nr= json_decode($row["notes"])    ;  
      $nr[0];

  ////  echo  $dd[0]; Medicine le liye
    //// echo  $dd[1]; second Medicine le liye

     // Display other doctor information
     ////   echo "<h2>Doctor: " . htmlspecialchars($row["doctor_name"]) . "</h2>";
     ////    echo "<p>Hospital: " . htmlspecialchars($row["hospital_name"]) . "</p>";
        // echo "<p>Address: " . htmlspecialchars($row["address"]) . "</p>";
    ////     echo "<p>Contact: " . htmlspecialchars($row["mobile"]) . "</p>";
    ////     echo "<p>Date: " . htmlspecialchars($row["date"]) . "</p>";
        // echo "<p>About Doctor: " . htmlspecialchars($row["about"]) . "</p>";
        // echo "</div>";
        
        // echo "<div class='patient-info'>";
        // echo "<h2>Patient: " . htmlspecialchars($row["name"]) . "</h2>";
        // echo "<p>Gender: " . htmlspecialchars($row["gender"]) . "</p>";
       ////  echo "<p>UHID: " . htmlspecialchars($row["uhid"]) . "</p>";
        // echo "<p>Blood Pressure: " . htmlspecialchars($row["blood_pressure"]) . "</p>";
        // echo "</div>";
        // echo "<div class='medication-info'>";
        // echo "<h2>Medication Details</h2>";
     // //   echo "<p>Notes: " . htmlspecialchars($row["notes"]) . "</p>";
      ////   echo "<p>Notes: " . htmlspecialchars($row["notes"]) . "</p>";
        // echo "<p>SPO2: " . htmlspecialchars($row["spo2"]) . "</p>";
        // echo "<p>Report Suggestion: " . htmlspecialchars($row["report_suggestion"]) . "</p>";
        // echo "<p>Temperature: " . htmlspecialchars($row["temprature"]) . "</p>";
        // echo "<p>Weight: " . htmlspecialchars($row["weights"]) . "</p>";
        // echo "<p>Pulse: " . htmlspecialchars($row["pulse"]) . "</p>";
        // echo "<p>Height: " . htmlspecialchars($row["height"]) . "</p>";
        // echo "<p>After Food: " . htmlspecialchars($row["after_food"]) . "</p>";
        // echo "<p>Medication: " . htmlspecialchars($row["medication"]) . "</p>";
        // echo "</div>";
        // echo "</div>";
    ?>
<!-- html section start -->
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
        i
        {
            margin-left:5px;
        }
       @media(max-width:1000px){
            .col-sm-12{
                font-size:12px;
            } 
        }

    </style>
</head>
<body>

<div class="container card mt-5 p-4">
    <div class="row">
            <div class="row">
                <div class="col-sm-4">
                    <img src="<?php echo htmlspecialchars($logo_url) ?>" height="100px" width="100px" style="margin-left:15px;margin-bottom:20px;"><br>
                    <span class="dr"style="margin-left:18px;"><?php echo htmlspecialchars($row["hospital_name"]) ?></span>
                </div>
                <div class="col-sm-4">
                     <!--<span class="dr"style="margin-right:5px;"></span>-->
                </div>
                <div class="col-sm-4">
                  <span> <h4 class="text-center"><b style="color:black;"><?php echo htmlspecialchars($row["doctor_name"]) ?></b></h4></span><br>
                    <span class="drhead"><?php echo htmlspecialchars($row["about"]) ?></span>
                </div>
            </div>
 
        
        
        <div class="col-9 headerr">
           
          
          
        </div>
        <hr>
      <div class="col-md-12 col-sm-12 mt-2">
            <span class="col-sm-12"><strong class="col-sm-12"><b> Name:-</b></strong><?php echo htmlspecialchars($row["name"])?>,</strong></span><span class="col-sm-12"><strong class="col-sm-12"><b>Gender:- </b> </strong><?php echo htmlspecialchars($row["gender"]) ?></span>&nbsp;&nbsp;<strong class="col-sm-12"><b>Age:-  </b></strong><?php echo htmlspecialchars($row["age"]) ?><i>Years</i></span><span class="text-end">
               
         </span>
           
                         
            <span class="col-sm-12"><strong style="width: 97px; "><br><b>Mobile No:-</b></strong> <?php echo htmlspecialchars($row["phone"]) ?></span>
         
            
            <strong><b style="width: 71px;"> &nbsp;&nbsp;UHID :- </b></strong><span><?php echo htmlspecialchars($row["uhid"]) ?></span>
            <br>
                 <strong><b>Date :</b> </strong><span><?php echo htmlspecialchars($row["dateeeeee"]) ?></span>
       
        </div>
        <?php if(!empty($row["temprature"]) || !empty($row["blood_pres"]) || !empty($row["dibitic"]) || !empty($row["dibitic"]) || !empty($row["blood_pressure"]) || !empty($row["spo2"]) || !empty($row["height"]) || !empty($row["weights"])){ ?>
        <div class="col-12">
           <center> <h4 class="text-center" ><b>VITALS</b></h4></center>
            <table class="table table-bordered prescription-table">
                <thead class="table-secondary">
                    <tr>
                        <?php if($row["temprature"]){ ?>
                        <th>Temperature</th>
                        <?php } ?>
                        <?php if($row["blood_pres"]){ ?>
                        <th>Blood Pressure</th>
                        <?php } ?>
                        <?php if($row["dibitic"]){ ?>
                        <th>Diastatic</th>
                        <?php } ?>
                        <?php if($row["pulse"]){ ?>
                         <th>Pulse</th>
                         <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php if($row["temprature"]){ ?>
                        <td><?php echo  htmlspecialchars($row["temprature"]) ?></td>
                        <?php } ?>
                        <?php if($row["blood_pres"]){ ?>
                        <td><?php echo  htmlspecialchars($row["blood_pres"]) ?></td>
                        <?php } ?>
                        <?php if($row["dibitic"]){ ?>
                        <td><?php  echo htmlspecialchars($row["dibitic"]) ?></td>
                        <?php } ?>
                        <?php if($row["pulse"]){ ?>
                        <td><?php  echo htmlspecialchars($row["pulse"]) ?></td>
                        <?php } ?>
                    </tr>
                </tbody>
                
                <thead class="table-secondary">
                    <tr>
                        
                        <?php  if(htmlspecialchars($row["blood_pressure"])){ ?>
                        <th>Blood Group</th>
                        <?php } ?>
                        <?php  if(htmlspecialchars($row["spo2"])){ ?>
                        <th><sapn>SPO<sub>2</sub></sapn></th>
                        <?php } ?>
                        <?php  if(htmlspecialchars($row["height"])){ ?>
                        <th>Height</th>
                        <?php } ?>
                        <?php  if(htmlspecialchars($row["weights"])){ ?>
                        <th>Weight</th>
                        <?php } ?>
                         
                     
                    
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php  if(htmlspecialchars($row["blood_pressure"])){ ?>
                        <td><?php echo  htmlspecialchars($row["blood_pressure"]) ?></td>
                        <?php } ?>
                        <?php  if(htmlspecialchars($row["spo2"])){ ?>
                        <td><?php  echo htmlspecialchars($row["spo2"]) ?></td>
                        <?php } ?>
                        <?php  if(htmlspecialchars($row["height"])){ ?>
                        <td><?php echo  htmlspecialchars($row["height"]) ?></td>
                        <?php } ?>
                        <?php  if(htmlspecialchars($row["weights"])){ ?>
                        <td><?php echo  htmlspecialchars($row["weights"]) ?></td>
                        <?php } ?>
                    </tr>
                </tbody> 
             
              
              
            </table>
        </div>
        <?php } ?>
        <?php if(!empty($bb[1]) || !empty($bb[0]) || !empty($br[1]) || !empty($br[0])){ ?>
        
        <div class="col-12">
           <center> <h4 class="text-center" ><b>DIAGNOSIS</b></h4></center>
            <table class="table table-bordered prescription-table">
                <thead class="table-secondary">
                    <tr>
                        <?php if($bb[0] || $bb[1]){ ?>
                        <th>Diagnosis</th>
                        <?php } ?>
                        <?php if($br[0] || $br[1]){ ?>
                        <th>Remark</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php if($bb[0] || $bb[1]){ ?>
                        <td><?php  echo  $bb[0]; ?> <br><?php  echo  $bb[1];?></td>
                        <?php } ?>
                        <?php if($br[0] || $br[1]){ ?>
                        <td><?php  echo  $br[0]; ?> <br><?php  echo  $br[1];?></td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php } ?>
        <?php if(!empty($sy[1]) || !empty($sy[0]) || !empty($sr[1]) || !empty($sr[0])){ ?>
            <div class="col-12">
           <center> <h4 class="text-center"><b>SYMPTOMS</b></h4></center>
            <table class="table table-bordered prescription-table">
                <thead class="table-secondary">
                    <tr>
                        <?php if($sy[0] || $sy[1]){ ?>
                        <th>Symptoms</th>
                        <?php } ?>
                        <?php if($sr[0] || $sr[1]){ ?>
                        <th>Remark</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php if($sy[0] || $sy[1]){ ?>
                        <td><?php  echo  $sy[0]; ?> <br><?php  echo  $sy[1];?></td>
                        <?php } ?>
                        <?php if($sr[0] || $sr[1]){ ?>
                        <td><?php  echo  $sr[0]; ?> <br><?php  echo  $sr[1];?></td>
                        <?php } ?>
                                        
                    </tr>
                </tbody>
                
                
              
              
            </table>
        </div>
        <?php } ?>
         <?php if(!empty($ll[1]) || !empty($ll[0]) || !empty($lr[1]) || !empty($lr[0])){ ?>
        <div class="col-12">
          <center> <h4 class="text-center"><b>LAB TESTS</b></h4></center> 
            <table class="table table-bordered prescription-table">
                <thead class="table-secondary">
                    <tr>
                        <?php if($ll[0] || $ll[1]){ ?>
                        <th>Lab Tests</th>
                        <?php } ?>
                        <?php if($lr[0] || $lr[1]){ ?>
                        <th>Remark</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php if($ll[0] || $ll[1]){ ?>
                        <td><?php  echo  $ll[0]; ?> <br><?php  echo  $ll[1];?></td>
                        <?php } ?>
                        <?php if($lr[0] || $lr[1]){ ?>
                        <td><?php  echo  $lr[0]; ?> <br><?php  echo  $lr[1];?></td>
                        <?php } ?>
                        
                        
                    </tr>
                </tbody>
            </table>
        </div>
        <?php } ?>
        
        <div class="col-12">
           <center> <h4 class="text-center"><b>MEDICINE DETAILS</b</h4></center>
            <table class="table table-bordered prescription-table">
                <thead class="table-secondary">
                    <tr>
                       
                        <th>Medicine Details</th>
                       
                      
                        <th>Tablets</th>
                    
                         <th>Time</th>
                    
                        <th>Remark</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php 
        $medicine_sql="SELECT 
            REPLACE(REPLACE(REPLACE(SUBSTRING_INDEX(SUBSTRING_INDEX(moc.medical_details, ',', numbers.n), ',', -1), '[', ''), ']', ''), '', '') AS medicine_name,
            REPLACE(REPLACE(REPLACE(SUBSTRING_INDEX(SUBSTRING_INDEX(moc.tme_to_take, ',', numbers.n), ',', -1), '[', ''), ']', ''), '', '') AS frequency
            , REPLACE(REPLACE(REPLACE(SUBSTRING_INDEX(SUBSTRING_INDEX(moc.tables, ',', numbers.n), ',', -1), '[', ''), ']', ''), '', '') AS tables
            , REPLACE(REPLACE(REPLACE(SUBSTRING_INDEX(SUBSTRING_INDEX(moc.to_be_taken, ',', numbers.n), ',', -1), '[', ''), ']', ''), '', '') AS to_be_taken
        FROM 
            medication moc
        LEFT JOIN (
            SELECT 1 AS n UNION ALL
            SELECT 2 UNION ALL
            SELECT 3 UNION ALL
            SELECT 4 UNION ALL
            SELECT 5 UNION ALL
            SELECT 6 UNION ALL
            SELECT 7 UNION ALL
            SELECT 8 UNION ALL
            SELECT 9 UNION ALL
            SELECT 10 UNION ALL
            SELECT 11 UNION ALL
            SELECT 12 UNION ALL
            SELECT 13 UNION ALL
            SELECT 14 UNION ALL
            SELECT 15 UNION ALL
            SELECT 16 UNION ALL
            SELECT 17 UNION ALL
            SELECT 18 UNION ALL
            SELECT 19 UNION ALL
            SELECT 20 -- Add more if needed
        ) AS numbers 
        ON CHAR_LENGTH(moc.medical_details) - CHAR_LENGTH(REPLACE(moc.medical_details, ',', '')) >= numbers.n - 1
        WHERE 
            moc.id = '$medic_id' && moc.appointment_id='$app_id'";

$result_sql = mysqli_query($conn,$medicine_sql);
foreach($result_sql as $result_sqlt)
{
        ?>
                    <tr>
                       
                        <td><?php  echo  str_replace('"', '', $result_sqlt['medicine_name']); ?></td>
                    
                       
                        <td><?php  echo  str_replace('"', '', $result_sqlt['frequency']); ?></td>
                       
                        <td><?php  echo  str_replace('"', '', $result_sqlt['tables']); ?></td>

                        <td><?php  echo str_replace('"', '', $result_sqlt['to_be_taken']); ?></td>
                    
                    </tr>
                    
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php if(!empty($nr[0]) || !empty($nr[1]) || !empty($nn[0]) || !empty($nn[0])){ ?>
         <div class="col-12">
           <center> <h4 class="text-center"><b>NOTES</b></h4></center>
            <table class="table table-bordered prescription-table">
                <thead class="table-secondary">
                    <tr>
                        <?php if($nr[0] || $nr[1]){ ?>
                        <th>Notes</th>
                        <?php } ?>
                        <?php if($nn[0] || $nn[1]){ ?>
                        <th>Remark</th>
                        <?php } ?>
                       
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php if($nr[0] || $nr[1]){ ?>
                        <td><?php  echo  $nr[0]; ?> <br><?php  echo  $nr[1];?></td>
                        <?php } ?>
                        <?php if($nn[0] || $nn[1]){ ?>
                        <td><?php  echo  $nn[0]; ?> <br><?php  echo  $nn[1];?></td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php } ?>
         
        <div class="col-md-12">
           
          <div class="row">
              <div class="col-md-9"></div>
               <div class="col-md-3">
              Doctor Sign:
              </div>
          </div>
          <div class="row" tyle="float:right">
              <div class="col-md-9"></div>
              <div class="col-md-3">
           <?php  echo "<img src='" . htmlspecialchars($signature_url) . "' alt='image'  width='50px' height='50px' >";  ?>
          </div>
           </div>
          
         
          <!-- signature  image parts -->
        </div>
         <div class="col-12" >
           <center> <h4 class="text-center text-white"></center>
            <table class="table table-bordered prescription-table" style="--bs-table-bg-state:bg-secondary;
    --bs-table-color: white;">
                <thead class="table-secondary">
                    <tr>
                        <th><?php echo htmlspecialchars($row["mobile"]) ?></th>
                        <th><?php echo htmlspecialchars($row["date"]) ?></th>
                        <th><?php echo htmlspecialchars($row["address"]) ?></th>
                    </tr>
                </thead>
               
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

<br><br>
<!-- html section end -->
<?php
}
} else {
    echo "0 results";
}

$conn->close();

?>