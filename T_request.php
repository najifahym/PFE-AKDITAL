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
}

else{header("Location: Login.php");}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    
    .bodyelemet{
        width: 100%;
    background: white; 
  
    
    }
::-webkit-scrollbar {
  width: 0px;
}
.header{
    position: sticky;
    top: 0;
    z-index: 100;
    background-color: white;
}
tr{
    background-color:  white; 
}
.tab thead th,.tab th,.tab td { 
    border: 0;
}

.tab th,.tab td { 
   width: auto;
   text-align: center;
}
.tab{
    margin: -25px 1px 0px 0px;
    width: 100%;
    height: auto;
}

tr{
    background-color:  white; 
}
.table thead th,.table th,.table td { 
    border: 0;
}
.red {
    background-color: rgba(255, 0, 0, 0.363);
    border-radius: 10px;
}
.orange  {
    background-color: rgba(230, 255, 2, 0.363);
    border-radius: 10px;
}

.blue {
    background-color: rgba(2, 255, 255, 0.363);
    border-radius: 10px;
}
</style>
<body>
    <div class="bodyelemet" style="  overflow: hidden; overflow-y: scroll; max-height: 28vh; background-color: transparent; box-shadow: none;">
        <br>
        <table class="tab" border="0">
            <thead  class="header">
            <tr>
                <th scope="col"> </th>
                <th scope="col"> Date</th>
                <th scope="col"> Heure</th> 
                <th scope="col"> Const</th>
                <th scope="col"> Message d'alarme</th>
                 
            </tr>
        </thead>
        <tbody>
            <?php
        if (isset($_COOKIE["user"])) {  

                        $sql3 ='SELECT * FROM events WHERE eu_id='.base64_decode($_GET["pt"]).'  ORDER BY e_show ASC ';
                                    
                        $result3 = $conn->query($sql3);

                        if ($result3->num_rows > 0) {
                            while($row3 = $result3->fetch_assoc()) { 
                                
                                if($row3["e_show"]==1){
                                    $show="zmdi-eye ";
                                }else {
                                    $show="zmdi-eye-off ";
                                }
                                
                                if($row3["e_err"]==1){
                                    $err="BPM : ".$row3["e_bpm"];
                                }else{
                                    $err="SPO2 : ".$row3["e_spo2"]." %";
                                }
                                echo '
                                <tr class="'.$row3["e_urg"].'">
                                <td> <div><i class="zmdi '.$show.' I'.$row3["e_id"].' material-icons-name" style="color: rgb(7, 109, 134);" onclick="show('.$row3["e_id"].')" ></i></div></td> 
                                <td> '.$row3["e_date"].'</td>
                                <td> '.$row3["e_time"].'</td>
                                <td> '.$err.'</td> 
                                <td> '.base64_decode($row3["e_msg"]).'</td> 
                                </tr>
                                ';
                                
                        }
                        }}
                        ?> 
                        <div id="shr"></div>
            
        </tbody>
        </table>
    </div>
</body>
 <!-- JS -->
 <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script >
        function show(a){
            $("#shr").load("show.php?evsh="+a+""); 
            var ia=".I"+a;
            $(ia).removeClass("zmdi-eye-off");
            $(ia).addClass("zmdi-eye");
        }
    </script> 
</html>