
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
<div id="content"></span>
</body>
<?php
if(isset($_GET["set"])){
    $d_bpm=$_GET["d_bpm"];
    $d_spo2=$_GET["d_spo2"];
    $dp_id=$_GET["dp_id"];
    $set=$_GET["set"];
    //$url = "http://192.168.127.67/EPM/adding.php?d_bpm=".$d_bpm."&d_spo2=".$d_spo2."&dp_id=".$dp_id."&set=1";
    //$response = file_get_contents($url);
    //echo $response;
    header("Location: http://192.168.127.67/EPM/adding.php?d_bpm=".$d_bpm."&d_spo2=".$d_spo2."&dp_id=".$dp_id."&set=1");
}
?>
<script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>  
    <script src="js/Chart.js"></script>
    <script> 
    var url = <?php echo "'http://192.168.127.67/EPM/adddata.php?d_bpm=".$d_bpm."&d_spo2=".$d_spo2."&dp_id=".$dp_id."&set=1';" ; ?> // Replace with your URL
   // window.location.href =url;
    </script>
</html>