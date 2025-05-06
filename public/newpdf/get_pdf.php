<?php

include "pdfcrowd.php";
$doctorid=$_GET['doctorid'];
$appointment_id=$_GET['appointment_id'];
$uhid=$_GET['uhid'];

try
{
    // create the API client instance
    $client = new \Pdfcrowd\HtmlToPdfClient("foundercodetech", "03b6fdb21d5fb0bec516c89776a4df38");
     $filename=rand(111111,999999);
    // run the conversion and write the result to a file
    $client->convertUrlToFile("https://sleekcare.apponrent.co.in/public/newpdf/test.php?uhid=$uhid&appointment_id=$appointment_id&doctorid=$doctorid", "pdf_save/$filename.pdf");
    $res=array(
        "status"=>"200",
        "url"=>"https://sleekcare.apponrent.co.in/public/newpdf/pdf_save/$filename.pdf"
        );
        echo json_encode($res);
    //  header("Location: https://sleekcare.apponrent.co.in/public/newpdf/pdf_save/$filename.pdf");

}

catch(\Pdfcrowd\Error $why)
{
    error_log("Pdfcrowd Error: {$why}\n");
    throw $why;
}

?>