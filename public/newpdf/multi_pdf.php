<?php



$conn = mysqli_connect("localhost", "u873167744_sleekcare", "u873167744_Sleekcare", "u873167744_sleekcare");
$phone = $_GET['patient_id'];
// $doc = $_GET['doctor_id'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT docters.name AS doctor_name, appointments.`id`, appointments.`patient_id`, appointments.`doctor_id`, appointments.`date`, appointments.`status`, appointments.`uhid`, appointments.`name`, appointments.`age`, appointments.`gender`, appointments.`phone`, appointments.`image`, appointments.`bed_type`,appointments.`bed_no`, appointments.`payment`, appointments.`city`, appointments.`medication_pdf`, appointments.`updated_at`, appointments.`created_at` 
        FROM `appointments` JOIN docters ON docters.id=appointments.`doctor_id`
        WHERE appointments.`patient_id`='$phone'  ORDER BY appointments.`id` DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(['status' => false, 'message' => 'Query failed: ' . mysqli_error($conn)]);
    exit();
}

if (mysqli_num_rows($result) > 0) { 
    $pdfs = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf = $row['medication_pdf'];
        $ddd = "https://sleekcare.apponrent.co.in/" . $pdf;
        $date = $row['created_at'];
        $doctor_name = $row['doctor_name'];
        $pdfs[] = [
            'pdf_url' => $ddd,
            'doctor_name' => $doctor_name,
            'date' => $date
        ];
    }
    $data = ['status' => true, 'data' => $pdfs];
    echo json_encode($data);

} else {
    echo json_encode(['status' => false, 'message' => '0 results']);
}













die;


// Create connection
$conn = mysqli_connect("localhost", "u873167744_sleekcare", "u873167744_Sleekcare", "u873167744_sleekcare");

$phone = $_GET['phone'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data including images
$sql = "SELECT medication.id, DATE(medication.date) AS alldate 
        FROM medication 
        JOIN appointments ON medication.appointment_id = appointments.id 
        JOIN patients ON appointments.phone = patients.phone 
        JOIN docters ON docters.id = medication.doctor_id 
        WHERE patients.phone = '$phone'";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    $us = array(); // Array to hold the result

    // Output data of each row
    foreach ($result as $row) {
        $date_time = $row['alldate'];
        $id = $row['id'];

        $url = "https://sleekcare.apponrent.co.in/public/newpdf/generate_pdf_by_date.php?phone=$phone&id=$id";

        // Initialize a CURL session.
        $ch = curl_init(); 
        // Return Page contents.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Grab URL and pass it to the variable.
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);

        // SQL query to fetch PDF URLs
        $sql2 = "SELECT medication.pdf_url 
                 FROM medication 
                 JOIN appointments ON medication.appointment_id = appointments.id 
                 JOIN patients ON appointments.phone = patients.phone 
                 JOIN docters ON docters.id = medication.doctor_id 
                 WHERE DATE(medication.date) = '$date_time' AND patients.phone = '$phone'";
        $res = mysqli_query($conn, $sql2);
        
        // Fetch PDF URLs and group them by date
        while ($data = mysqli_fetch_assoc($res)) {
            $us[$date_time][] = array("pdf_url" => $data['pdf_url']);
        }
    }

    // Transform the array to the desired format
    $output = array();
    foreach ($us as $date => $pdfs) {
        $pdf_urls = array();
        foreach ($pdfs as $pdf) {
            if (!in_array($pdf, $pdf_urls)) {
                $pdf_urls[] = $pdf;
            }
        }
        $output[] = array("date" => $date, "pdf" => $pdf_urls);
    }

    echo json_encode($output);
} else {
    echo json_encode(array("0 results"));
}

$conn->close();
?>
