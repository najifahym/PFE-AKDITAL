<?php
require("connect.php");
$u_name="";
$u_cab="";
$u_id="";
if (isset($_COOKIE["user"])) { 
    $u_id=$_COOKIE["user"]; 


    $sql1 = 'SELECT * FROM `users` WHERE u_id='.$u_id;
                  
    $result = $conn->query($sql1);
    $i=0;
    if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              $u_name=base64_decode($row["u_name"]);  
              $u_cab=base64_decode($row["u_cab"]);  
    }
    }
    if ($_GET["evsh"]){
         
         
        $sql3 = "UPDATE `events` SET `e_show` = '1' WHERE `events`.`e_id` =".$_GET["evsh"]."";
       
    mysqli_query($conn, $sql3); 
    }
}

else{header("Location: Login.php");}

?>