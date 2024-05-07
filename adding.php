<?php
if(isset($_GET["set"])){
    $d_bpm=$_GET["d_bpm"];
    $d_spo2=$_GET["d_spo2"];
    $dp_id=$_GET["dp_id"];
    $set=$_GET["set"];
     header("Location: http://epm.rf.gd/adddata.php?d_bpm=".$d_bpm."&d_spo2=".$d_spo2."&dp_id=".$dp_id."&set=1");
}
?>