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
    
    $sql2 = 'SELECT * FROM `patients` WHERE p_id='.base64_decode($_GET["pt"]);
                  
    $result2 = $conn->query($sql2);
    
    if ($result2->num_rows > 0) {
          while($row2 = $result2->fetch_assoc()) {
              $P_name=$row2["p_sname"]." ".$row2["p_fname"];  
             
            $start_date = strtotime(base64_decode($row2["p_ddn"]));
            $end_date = strtotime(date("Y-m-d"));
            
            $jr = floor(($end_date - $start_date) / (60 * 60 * 24));
            if($jr<28){
                $ddn="Nouveau-né";
               }elseif($jr<365){
                $ddn="Bébé";
               }elseif($jr<2190){
                $ddn="Pédiatrique";
               }elseif($jr<6570){
                $ddn="Adolescent";
               }elseif($jr<10950){
                $ddn="Jeune Adulte";
               }else{
                $ddn="Adulte";
               }
               $ddn=$ddn." (".strval(number_format(($jr/365),0))." Ans) ";
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Akdital -- Visualisation</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    .Nav-bar{
    margin-left: 5px;
    margin-right: 5px;
    margin-top: 10px;
    order: 2;
    -moz-order: 2;
    -webkit-order: 2;
    -o-order: 2;
    -ms-order: 2;
    padding: 5px;
    margin-bottom: 10px;
    width: 15%;
    height: 90vh;
    background: white;
    box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
    border-radius: 10px;
    }
   .contens{
    margin-left: 5px;
    margin-top: 5px;
    margin-bottom: 10px;
    order: 2;
    -moz-order: 2;
    -webkit-order: 2;
    -o-order: 2;
    -ms-order: 2; 
    width: 76%;
    padding: 5px;
  }
    @media screen and (min-width: 1024px) {
  .container {
    max-width: 100%; } }
    .con1{
        width: 100%;
        background: #f8f8f8;
        box-shadow: none;
    }
    .bodyelement,.topelemnt{
        width: 100%;
    background: white;
    box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
    border-radius: 10px;
    
    }
    .topelemnt{
        height: 60px;
        margin-bottom: 10px;
    }
    .navelement input {
    padding: 1px;
    margin-bottom: 30%;
    border: none; 
    text-decoration: hidden; 
    text-align: left;
    padding-left: 5px;
}
.navelement span {
    background-color: white;
    border: none;
}
.navelement .input-group {
    padding: 1px;
    margin: 3px; 
    margin-bottom: 10px;
}
.logo{
    width: 66%;
    margin: 5px 14% 3px 14%;
}
.table{
    margin: 10px; 
    width: calc(100% - 20px);
    height: 80vh;
    border: transparent;
}
.image {	
        position:absolute;
        bottom: 50px;
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
.etat{
    margin-right: 2px;
}
.table tr , .table th,.table td{
    border: 1px solid black;
}
.table th,.table td{
    padding:2px 0  0 2px ; 
    width: 10%;
}
.table tr,.table thead{height: auto;padding: 0;}
canvas{margin-top: 6px;
    width: 100%;height: 100px;}
.table tr span {
    font-size: 2.5rem;
    font-weight: bold;
}
.bpmd h1{
   color: rgba(13, 243, 13, 0.829);
    margin-top: 5px;
}
h7{
    margin-left: 0px;
}
.bpmd{
    color: #ebfff4;
    text-shadow: 0px -2px 1px #52e7185e, 2px 0px 1px #52e7185e, 0px 2px 1px #52e7185e, -2px 0px 1px #52e7185e;
}

.spo2{
    color: #d9e9ff;
    text-shadow: 0px -2px 1px #1866e75e, 2px 0px 1px #1866e75e, 0px 2px 1px #1866e75e, -2px 0px 1px #1866e75e;
}

.temp{
    
    color: #fff2e6;
    text-shadow: 0px -2px 1px #ffaa5b5e, 2px 0px 1px #ffaa5b5e, 0px 2px 1px #ffaa5b5e, -2px 0px 1px #ffaa5b5e;
}

.nibp span{
    background-color: #ffa6a6;
    padding: 3px;
}


.nibp{
    color: #ffd9dc;
    text-shadow: 0px -2px 1px #f704049c, 2px 0px 1px #f704049c, 0px 2px 1px #f704049c, -2px 0px 1px #f704049c;
    font-size: 1.5rem;
    font-weight: bold;
}

.rr{
   
    color: #eae2fff2;
    text-shadow: 0px -2px 1px #625bff5e, 2px 0px 1px #625bff5e, 0px 2px 1px #625bff5e, -2px 0px 1px #625bff5e;
  }
  .face{background-color: white;}
</style>
<body>

    <div class="">
            <section class="" >
                <div class="container con1" >
                <div class="signup-content" style="padding: 2px; padding-top: 50px;">
                <?php include("navbar.php"); ?>
                    <div class="contens"> 
                            <nav class=" topelemnt navbar navbar-light bg-white">
                                <a class="navbar-brand">Visualisation</a>
                                <form class="form-inline" method="POST" action="Archive.php">
                                       <input type="hidden" name="ptid" value="<?php echo base64_decode($_GET["pt"]);?>"/>
                                    <button class="btn btn-outline-success my-2 my-sm-0 etat" type="submit" name="etat"  value="1"><a>Soigné </a></button>
                                    <button class="btn btn-outline-info my-2 my-sm-0 etat" type="submit" name="etat" value="2"><a>Désengager </a></button>
                                    <button class="btn btn-outline-danger my-2 my-sm-0 etat" type="submit" name="etat" value="3"><a>Décédé </a></button>
                                </form>
                              </nav> 
                        <div class="bodyelement" style="overflow: hidden; overflow-y: scroll; max-height: 83vh;">
                            <table class="table">
                                <thead class="header">
                                <tr>
                                    <th scope="col" colspan="9">
                                        <div class="d-flex justify-content-between">
                                            <div class="p-2"> Alarme <i class="zmdi zmdi-notifications-active material-icons-name" style="font-size: 20px; color: Red;"></i></div>
                                            <div class="p-2"> </div>
                                            <div class="p-2"> </div>
                                            
                                            <div class="ml-auto p-2"><?php echo $P_name;?> </div>
                                            <div class="p-2"> </div>
                                            <div class="p-2"> <?php echo $ddn;?></div>
                                            <div class="p-2"> </div>
                                            <div class="ml-auto p-2"> <?php echo date("d/M/yy");?></div>
                                        </div>
                                    </th> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr> 
                                    <td colspan="7" style="border-bottom: 1px solid transparent; "  class="face">
                                        <div class="charting">
                                        <div >
                                            <canvas id="myChart" width="800" height="140"></canvas>
                                        </div> 
                                          
                                    </div>
                                    </td>
                                    <td colspan="2"  >
                                        <div class="d-flex justify-content-between">
                                            <div class="p-2"> <h7>HR bpm</h7><br>
                                                 <i class="zmdi zmdi-favorite material-icons-name" style="font-size: 48px; color: Red;"></i>
                                            </div>
                                            <div class="ml-auto p-2 bpmd"> <span id="sbpm"></span> </div>
                                        </div> 
                                    </td>
                                </tr>
                                
                               
                                <tr> 
                                    <td colspan="7" style="border-bottom: 1px solid transparent;border-top: 1px solid transparent; " class="face">
                                        <div class="charting">
                                         
                                        <div >
                                            <canvas id="myChart2" width="800" height="140"></canvas>
                                        </div>  
                                    </div>
                                    </td>
                                    <td colspan="2" rowspan="2">

                                        <div class="d-flex justify-content-between">
                                            <div class="p-2"> <h7>SPO2 %</h7>
                                                <br>
                                                 <i class="zmdi zmdi-invert-colors material-icons-name" style="font-size: 48px; color: rgba(0, 110, 255, 0.897);"></i></div>
                                            
                                            <div class="ml-auto p-2 spo2"> <span id="sspo2"></span> </div>
                                        </div>
                                    </td>
                                    
                                </tr>
                               
                                <tr>
                                    
                                   
                                </tr>
                               
                                <tr>
                                    <td colspan="7" rowspan="2" style="border-top: 1px solid transparent; "class="face">
                                        <div class="charting">
                                         
                                        <div >
                                            <canvas id="myChart3" width="800" height="140"></canvas>
                                        </div> 
                                    </div>
                                    </td>
                                    <td colspan="2" rowspan="2">
                                        <div class="d-flex justify-content-between">
                                            <div class="p-2"> <h7>TEMP  °C</h7>
                                                <br>
                                                 <i class="zmdi zmdi-fire material-icons-name" style="font-size: 48px; color: rgba(255, 123, 0, 0.644);"></i></div>
                                            
                                            <div class="ml-auto p-2 temp"> <span id="stemp"> </span> </div>
                                        </div>
                                    </td>
                                    
                                </tr>
                               
                                <tr> 
                                     
                                </tr>
                               
                                <tr> 
                                    <td style="border-bottom: 1px solid transparent;border-right: 1px solid transparent; "></td>
                                    <td style="border-bottom: 1px solid transparent;border-left: 1px solid transparent;border-right: 1px solid transparent; "></td>
                                    <td style="border-bottom: 1px solid transparent;border-left: 1px solid transparent;border-right: 1px solid transparent; "></td>
                                    <td style="border-bottom: 1px solid transparent;border-left: 1px solid transparent;border-right: 1px solid transparent; "></td>
                                    <td style="border-bottom: 1px solid transparent;border-left: 1px solid transparent;border-right: 1px solid transparent; "></td>
                                    <td style="border-bottom: 1px solid transparent;border-left: 1px solid transparent; border-right: 1px solid transparent;"></td>
                                    <td style="border-bottom: 1px solid transparent;border-left: 1px solid transparent; "></td>
                                     
                                    <td colspan="2" rowspan="2">
                                         
                                            <div class=""> <h7>NIBP </h7> mmHg
                                                </div>
                                            
                                            <div class="ml-auto p-2 nibp"><span id="snibps"></span>/<span id="snibpd"></span></div>
                                        </div>
                                    </td>
                                     
                                </tr> 
                               
                                <tr style="padding: 0;"> 
                                    <td colspan="7" rowspan="3"style="padding: 0;margin:0;">
                                        <div id="even" style="height: 21vh;"></div>
                                    </td>
                                     
                                     
                                </tr>
                               
                                <tr> 
                                    <td colspan="2" rowspan="2">
                                        <div class="d-flex justify-content-between">
                                            <div class="p-2"> <h7>RR </h7>
                                                <br>
                                                 <i class="zmdi zmdi-swap material-icons-name" style="font-size: 48px; color: rgb(51, 255, 0);"></i></div>
                                            
                                            <div class="ml-auto p-2 rr"> <span id="srr"></span> </div>
                                        </div>
                                    </td>
                                     
                                </tr>
                               
                                <tr> 
                                    
                                     
                                </tr> 
                               
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </section> 
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>  
    <script src="js/Chart.js"></script>
    <script>
        <?php 
        echo 'var request="T_request.php?pt='.$_GET['pt'].'";';?>
        events();
window.setInterval(events, 5000);
function events(){
    $("#even").load(request);
    $("#sbpm").load(<?php echo '"bpm.php?pt='.$_GET['pt'].'"';?>);
    $("#sspo2").load(<?php echo '"spo2.php?pt='.$_GET['pt'].'"';?>);
    $("#stemp").load(<?php echo '"temp.php?pt='.$_GET['pt'].'"';?>);
    $("#snibpd").load(<?php echo '"nibpd.php?pt='.$_GET['pt'].'"';?>);
    $("#snibps").load(<?php echo '"nibps.php?pt='.$_GET['pt'].'"';?>);
    $("#srr").load(<?php echo '"rr.php?pt='.$_GET['pt'].'"';?>);

}
<?php echo 'var ptid="'.base64_decode($_GET['pt']).'";';
?>
 
        
    </script>
    <script src="js/chartmain.js"></script>
</body> 
</html>