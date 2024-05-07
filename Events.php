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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Akdital -- Evenements</title>

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
    border-collapse: separate;
    border-spacing: 0 10px; 
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

    <div class="">
            <section class="" >
                <div class="container con1" >
                <div class="signup-content" style="padding: 2px; padding-top: 50px;">
                    
                <?php include("navbar.php"); ?>
                    <div class="contens"> 
                            <nav class=" topelemnt navbar navbar-light bg-white">
                                <a class="navbar-brand">Liste des Evenements</a>
                                <form class="form-inline" method="get" action="Index.php">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search" name="q">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="zmdi zmdi-search material-icons-name"></i></button>
                                </form>
                              </nav> 
                        <div class="bodyelement" style="  overflow: hidden; overflow-y: scroll; max-height: 83vh; background-color: transparent; box-shadow: none;">
                            <br>
                            <table class="table" border="0">
                                <thead  class="header">
                                <tr>
                                    <th scope="col"> Date</th>
                                    <th scope="col"> Heure</th>
                                    <th scope="col"> CIN</th>
                                    <th scope="col"> Nom</th>
                                    <th scope="col"> Prénom</th> 
                                    <th scope="col"> Maladie</th>
                                    <th scope="col"> BPM</th>
                                    <th scope="col"> SPO2</th>
                                    <th scope="col"> Evenement</th>
                                    <th scope="col"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            <?php 

                                if (isset($_COOKIE["user"])) {  

                                        $sql3 ='SELECT patients.p_id,patients.p_cin,patients.p_fname,patients.p_sname,patients.p_mal,events.e_bpm,events.e_spo2,events.e_msg,events.e_date,events.e_time,events.e_urg FROM patients INNER JOIN events ON events.eu_id=patients.p_id AND events.e_show="0" AND patients.p_doc='.$_COOKIE["user"].' ORDER BY events.e_id DESC ';
                                                    
                                        $result3 = $conn->query($sql3);
                                    
                                        if ($result3->num_rows > 0) {
                                            while($row3 = $result3->fetch_assoc()) { 
                                                if($row3["e_urg"]=="red"){
                                                    $icon="zmdi-alert-triangle ";
                                                }elseif($row3["e_urg"]=="blue"){
                                                    $icon="zmdi-notifications-add ";
                                                }else {
                                                    $icon="zmdi-alert-octagon ";
                                                }
                                                echo '
                                                <tr class="'.$row3["e_urg"].'">
                                                <td> '.$row3["e_date"].'</td>
                                                <td> '.$row3["e_time"].'</td>
                                                <td> '.$row3["p_cin"].'</td>
                                                <td> '.$row3["p_sname"].'</td>
                                                <td> '.$row3["p_fname"].'</td>
                                                <td> '.base64_decode($row3["p_mal"]).'</td> 
                                                <td> '.$row3["e_bpm"].' bpm</td>
                                                <td> '.$row3["e_spo2"].' %</td> 
                                                <td> '.base64_decode($row3["e_msg"]).'</td> 
                                            <td><a href="data.php?pt='.base64_encode($row3["p_id"]).'&n='.$row3["p_sname"].'&s='.$row3["p_fname"].'" title="Visualisation"><i class="zmdi '.$icon.' material-icons-name" style="color: '.$row3["e_urg"].';"></i></a></td>
                                            </tr>
                                                ';
                                                
                                        }
                                        }}
                                        ?> 
                               
                                             
                                 
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
</body> 
</html>