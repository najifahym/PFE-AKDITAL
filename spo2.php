<?php
require("connect.php");
 
if (isset($_COOKIE["user"])) {  
    if (isset($_GET["pt"])) {  

    $sql1 = "SELECT * FROM `data` WHERE `dp_id`=".base64_decode($_GET["pt"])."";

                  
    $result = $conn->query($sql1);
     $i="";
    if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
           $i=$row["d_spo2"]  ;
    }
    echo $i;
    } 
    
}
}

else{header("Location: Login.php");}

?>