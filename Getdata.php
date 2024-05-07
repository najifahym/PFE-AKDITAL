<?php
require("connect.php");

// Query to fetch data
$result = $conn->query("SELECT d_rr,d_spo2,d_bpm,d_temp FROM `data` WHERE  dp_id='".$_GET["p_id"]."'");
 
// Fetch data as an associative array


while ($row = $result->fetch_assoc()) {
    $ecg = $row['d_bpm'];
    $spo2 = $row['d_spo2'];
    $rr = $row['d_rr'];
    $temp = $row['d_temp'];
    
}

// Convert data to JSON format
if(isset($_GET["ecg"])){echo $ecg;}
if(isset($_GET["spo2"])){echo $spo2;}
if(isset($_GET["temp"])){echo $temp;}
if(isset($_GET["rr"])){echo $rr;}


// Close database connection
$conn->close();
?>