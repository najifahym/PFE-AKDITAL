
<?php
require("connect.php");
$u_name="";
$u_cab="";
$p_name="";
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

    if (isset($_POST["signup"])) {
        
    $sql = "UPDATE `patients` SET `p_fname`='".$_POST["fname"]."',`p_sname`='".$_POST["sname"]."',`p_cin`='".$_POST["cin"]."',`p_ddn`='".base64_encode($_POST["ddn"])."',`p_sexe`='".base64_encode($_POST["sexe"])."',`p_tel`='".base64_encode($_POST["tel"])."',`p_ville`='".base64_encode($_POST["city"])."',`p_etab`='".base64_encode($_POST["addr"])."',`p_sang`='".base64_encode($_POST["blood"])."',`p_mal`='".base64_encode($_POST["mal"])."' WHERE p_id='".base64_decode($_COOKIE["pt"])."'";
       
    mysqli_query($conn, $sql);  
     header("Location: index.php");
       echo $sql;
    }
    
    if (isset($_GET["pt"])) { 
        setcookie("pt", $_GET["pt"], time()+3600);  
                                    
        $sql2 = 'SELECT * FROM `patients` WHERE p_id='.base64_decode($_GET["pt"]).'';
                    
        $result2 = $conn->query($sql2);
      
        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) { 
                $p_sname=$row2["p_sname"];
                $p_fname=$row2["p_fname"];
                $p_cin=$row2["p_cin"];
                $p_mal=base64_decode($row2["p_mal"]);
                $p_ville=base64_decode($row2["p_ville"]);
                $p_tel=base64_decode($row2["p_tel"]);
                $p_sang=base64_decode($row2["p_sang"]);
                $p_ddn=base64_decode($row2["p_ddn"]); 
                $p_sexe=base64_decode($row2["p_sang"]);
                $p_etab=base64_decode($row2["p_etab"]); 
            }
}
}
}

else{header("Location: Login.php");}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Akdital -- Modifier</title>

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
</style>
<body>

    <div class="">
            <section class="" >
                <div class="container con1" >
                <div class="signup-content" style="padding: 2px; padding-top: 50px;">
                    
                <?php include("navbar.php"); ?>
                    <div class="contens"> 
                            <nav class=" topelemnt navbar navbar-light bg-white">
                                <a class="navbar-brand">Modifier ( <?php echo $p_sname.' '.$p_fname; ?> )</a>
                                <form class="form-inline" method="get" action="Index.php">
                                  <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search" name="q">
                                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="zmdi zmdi-search material-icons-name"></i></button>
                                </form>
                              </nav> 
                        <div class="bodyelement" style="  overflow: hidden; overflow-y: scroll; max-height: 83vh;">
                            
                            <form action="Modifier.php" method="POST" class="register-form" id="register-form">
                           
                                <section class="signup signup2" > 
                                    <div class="signup-content">
                                        <div class="signup-form" style="padding: 0px; width: 300px; margin-left: 150px; margin-right: 0px;">
                                            
                                                <div class="form-group">
                                                    <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                                     <input type="text" name="fname" id="fname" placeholder="Nom" value="<?php echo $p_fname; ?>" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sname"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                                    <input type="text" name="sname" id="sname" placeholder="Prénom" value="<?php echo $p_sname; ?>" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="cin"><i class="zmdi zmdi-card"></i></label>
                                                    <input type="text" name="cin" id="cin"    placeholder="N° CIN" required value="<?php echo $p_cin; ?>"  required/>
                                                </div>
                                                <div class="form-group" >
                                                    <label for="ddn"><i class="zmdi zmdi-calendar"></i></label>
                                                    <input type="date" name="ddn" id="ddn"   placeholder="Date de Naissance" required value="<?php echo $p_ddn; ?>"  required/>
                                                </div> 
                                                <div class="form-group">
                                                    <label for="sexe"><i class="zmdi zmdi-male-female "></i></label>
                                                     <select name="sexe" id="sexe" placeholder="Sexe" value="<?php echo $p_sexe; ?>" required>
                                                        <option value="Homme">Homme</option>
                                                        <option value="Femme">Femme</option>
                                                     </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tel"><i class="zmdi zmdi-phone"></i></label>
                                                    <input type="text" name="tel" id="tel" placeholder="N° Téléphone" value="<?php echo $p_tel; ?>" required/>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="city"><i class="zmdi zmdi-city"></i></label>
                                                    <input type="text" name="city" id="city" placeholder="Ville" value="<?php echo $p_ville; ?>" required/>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="addr"><i class="zmdi zmdi-city-alt"></i></label>
                                                    <input type="text" name="addr" id="addr" placeholder="Etablissement" value="<?php echo $p_etab; ?>" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="blood"><i class="zmdi zmdi-invert-colors "></i></label>
                                                     <select name="blood" id="blood" placeholder="Groupe Sanguin" value="<?php echo $p_sang; ?>" required>
                                                        <option value="O +">O +</option>
                                                        <option value="O -">O -</option>
                                                        <option value="A +">A +</option>
                                                        <option value="A -">A -</option>
                                                        <option value="B +">B +</option>
                                                        <option value="B -">B -</option>
                                                        <option value="AB +">AB +</option>
                                                        <option value="AB -">AB -</option>
                                                     </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text"><i class="zmdi zmdi-dns"></i></label>
                                                    <input type="text" name="mal" id="mal" value="<?php echo $p_mal; ?>" placeholder="Maladie" />
                                                </div> 
                                        </div>
                                        <div class="signup-form" style="padding: 30px; width: 300px;">
                                            
                                            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

                                            <div class="form-group form-button">
                                                <input type="submit" name="signup" id="signup" class="form-submit" value="Modifier" />
                                            </div> 
                                        </div> 
                                    </div>
                                </section>
                            </form>
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