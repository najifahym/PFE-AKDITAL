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

          $i=$row["u_id"]; 

          setcookie("user", $i, time()+3600);   
    }
    }
    if(isset($_GET["ptr"])){
        $sql5="UPDATE `patients` SET `p_etat` = '0' WHERE `patients`.`p_id` =".base64_decode($_GET["ptr"]);
            mysqli_query($conn, $sql5);  
     header("Location: index.php");
    }
}

else{header("Location: Login.php");}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title><?php echo $u_name; ?> -- Acceuil</title>
     <link rel="icon" type="image/x-icon" href="images/favicon.ico">

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
</style>
<body>

    <div class="">
            <section class="" >
                <div class="container con1" >
                <div class="signup-content" style="padding: 2px; padding-top: 50px;">
                    
                    <?php include("navbar.php"); ?>
                    <div class="contens"> 
                            <nav class=" topelemnt navbar navbar-light bg-white">
                                <a class="navbar-brand">Liste des Patients</a>
                                <form class="form-inline" method="get" action="index.php">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search" name="q">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="zmdi zmdi-search material-icons-name"></i></button>
                                </form>
                              </nav> 
                        <div class="bodyelement" style="  overflow: hidden; overflow-y: scroll; max-height: 83vh;">
                            <br>
                            <table class="table">
                                <thead class="header">
                                <tr>
                                    <th scope="col"> #</th>
                                    <th scope="col"> Nom</th>
                                    <th scope="col"> Prénom</th>
                                    <th scope="col"> CIN</th>
                                    <th scope="col"> Entrée</th>
                                    <th scope="col"> Maladie</th>
                                    <th scope="col"> Ville</th>
                                    <th scope="col"> Teléphone</th>
                                    <th scope="col"> Sang</th>
                                    <th scope="col"> BPM</th>
                                    <th scope="col"> SPO2</th>
                                    <th scope="col"> 

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php 

                                if (isset($_COOKIE["user"])) { 
                                    if (isset($_GET["q"])) {
                                        $spo2=0;
                                            $bpm=0;
                                        $sql3 = 'SELECT * FROM `patients` WHERE p_doc="'.$u_id.'" AND p_etat=0 AND `p_fname` LIKE "%'.$_GET["q"].'%" OR p_doc="'.$u_id.'" AND p_etat=0 AND  `p_sname` LIKE "%'.$_GET["q"].'%" OR p_doc="'.$u_id.'" AND p_etat=0 AND   `p_cin` LIKE "%'.$_GET["q"].'%" ORDER BY p_id DESC ';
                                                    
                                        $result3 = $conn->query($sql3);
                                      
                                        if ($result3->num_rows > 0) {
                                            while($row3 = $result3->fetch_assoc()) { 
                                                $sql4 = 'SELECT * FROM `data` WHERE dp_id="'.$row3["p_id"].'"';     
                                                $result4 = $conn->query($sql4);
                                                if ($result4->num_rows > 0) {
                                                    while($row4 = $result4->fetch_assoc()) { 
                                                        $spo2=$row4["d_spo2"];
                                                        $bpm=$row4["d_bpm"];
                                                    }
                                                }

                                                echo '<tr>
                                                <th scope="row"><a href="data.php?pt='.base64_encode($row3["p_id"]).'&n='.$row3["p_sname"].'&s='.$row3["p_fname"].'&c='.$row3["p_cin"].'" title="Visualisation"><i class="zmdi zmdi-hospital material-icons-name" style="color: #ff0707d3;"></i></a></th>
                                                <td> '.$row3["p_sname"].'</td>
                                                <td> '.$row3["p_fname"].'</td>
                                                <td> '.$row3["p_cin"].'</td>
                                                <td> '.$row3["p_datein"].'</td>
                                                <td> '.base64_decode($row3["p_mal"]).'</td>
                                                <td> '.base64_decode($row3["p_ville"]).'</td>
                                                <td> '.base64_decode($row3["p_tel"]).'</td>
                                                <td> '.base64_decode($row3["p_sang"]).'</td>
                                                <td>'.$bpm.'</td>
                                                <td>'.$spo2.'%</td> 

                                                <td><a href="Modifier.php?pt='.base64_encode($row3["p_id"]).'&n='.$row3["p_sname"].'&s='.$row3["p_fname"].'" title="Modifier"><i class="zmdi zmdi-edit material-icons-name" style="color: #ffc107;"></i></a></td>
                                            </tr>';
                                            $spo2=0;
                                            $bpm=0;
                                        }
                                        }}else{
                                            $spo2=0;
                                            $bpm=0;
                                        $sql2 = 'SELECT * FROM `patients` WHERE p_doc="'.$u_id.'" AND p_etat=0  ORDER BY p_id DESC ';
                                                    
                                        $result2 = $conn->query($sql2);
                                      
                                        if ($result2->num_rows > 0) {
                                            while($row2 = $result2->fetch_assoc()) { 
                                                $sql4 = 'SELECT * FROM `data` WHERE dp_id="'.$row2["p_id"].'"';     
                                                $result4 = $conn->query($sql4);
                                                if ($result4->num_rows > 0) {
                                                    while($row4 = $result4->fetch_assoc()) { 
                                                        $spo2=$row4["d_spo2"];
                                                        $bpm=$row4["d_bpm"];
                                                    }
                                                }

                                                echo '<tr>
                                                <th scope="row"><a href="data.php?pt='.base64_encode($row2["p_id"]).'&n='.$row2["p_sname"].'&s='.$row2["p_fname"].'&c='.$row2["p_cin"].'" title="Visualisation"><i class="zmdi zmdi-hospital material-icons-name" style="color: #ff0707d3;"></i></a></th>
                                                <td> '.$row2["p_sname"].'</td>
                                                <td> '.$row2["p_fname"].'</td>
                                                <td> '.$row2["p_cin"].'</td>
                                                <td> '.$row2["p_datein"].'</td>
                                                <td> '.base64_decode($row2["p_mal"]).'</td>
                                                <td> '.base64_decode($row2["p_ville"]).'</td>
                                                <td> '.base64_decode($row2["p_tel"]).'</td>
                                                <td> '.base64_decode($row2["p_sang"]).'</td>
                                                <td>'.$bpm.'</td>
                                                <td>'.$spo2.'%</td> 

                                                <td><a href="Modifier.php?pt='.base64_encode($row2["p_id"]).'&n='.$row2["p_sname"].'&s='.$row2["p_fname"].'" title="Modifier"><i class="zmdi zmdi-edit material-icons-name" style="color: #ffc107;"></i></a></td>
                                            </tr>';
                                            $spo2=0;
                                            $bpm=0;
                                        }
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