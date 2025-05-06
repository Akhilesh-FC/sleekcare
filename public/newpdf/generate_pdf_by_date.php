<?php

include "pdfcrowd.php";
$conn = mysqli_connect("localhost", "u873167744_sleekcare", "u873167744_Sleekcare", "u873167744_sleekcare");

$phone=$_GET['phone'];
$id=$_GET['id'];
try
{
    // create the API client instance
    $client = new \Pdfcrowd\HtmlToPdfClient("demo", "ce544b6ea52a5621fb9d55f8b542d14d");
     $filename=rand(111111,999999);
    // run the conversion and write the result to a file
    $client->convertUrlToFile("https://sleekcare.apponrent.co.in/public/newpdf/view_pdf_bydate.php?phone=$phone&id=$id", "pdf_save/$filename.pdf");
    mysqli_query($conn,"UPDATE `medication` SET `pdf_url`='https://sleekcare.apponrent.co.in/public/newpdf/pdf_save/$filename.pdf' WHERE id='$id'");
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