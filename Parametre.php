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
     
    if (isset($_POST["edit"])) {
        
    $sql = "UPDATE `users` SET `u_name`='".base64_encode($_POST["name"])."',`u_mail`='".base64_encode($_POST["email"])."',`u_cab`='".base64_encode($_POST["cabinet"])."',`u_spi`='".base64_encode($_POST["spic"])."',`u_tel`='".base64_encode($_POST["tel"])."',`u_add`='".base64_encode($_POST["addr"])."' WHERE u_id='".$_COOKIE["user"]."'";
      echo $sql; 
    mysqli_query($conn, $sql);  
     header("Location: Parametre.php"); 
    }
    
    if (isset($_COOKIE["user"])) {  
        $msg="";  
        $color="";    
        $display="none";
        $sql2 = 'SELECT * FROM `users` WHERE u_id='.$_COOKIE["user"].'';
                    
        $result2 = $conn->query($sql2);
      
        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) { 
                 
                $u_mail=base64_decode($row2["u_mail"]);
                $u_spi=base64_decode($row2["u_spi"]);
                $u_tel=base64_decode($row2["u_tel"]);
                $u_add=base64_decode($row2["u_add"]);
                $u_pass=base64_decode($row2["u_pass"]);  
            }
}

if (isset($_POST["change"])) {
         
    if ($_POST["oldpass"]==$u_pass) {
        # code... 
    $sql3 = "UPDATE `users` SET `u_pass`='".base64_encode($_POST["pass"])."' WHERE u_id='".$_COOKIE["user"]."'";
      
    mysqli_query($conn, $sql3);  
    
    $msg="Mot de passe bien changer";  
    $color="rgb(21 128 0 / 58%)";    
    $display="block"; 
       
    }else{
        
       $msg="Ancien Mot de Passe est Incorrect";  
       $color="rgb(227 123 139 / 58%)";    
       $display="block";
    }
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
.red{
        border-color: red;
        color: red;;
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
                                <a class="navbar-brand">Parametres</a>
                                <form class="form-inline" method="get" action="Index.php">
                                  <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search" name="q">
                                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="zmdi zmdi-search material-icons-name"></i></button>
                                </form>
                              </nav> 
                        <div class="bodyelement" style="  overflow: hidden; overflow-y: scroll; max-height: 83vh;">
                            
                                <section class="signup signup2" > 
                                    <div class="signup-content">
                                        <form action="Parametre.php" method="POST" class="register-form" id="register-form">
                                        <div class="signup-form"  style="padding: 0px; width: 250px; margin-left: 150px;  ">
                                           <div class="form-group"> 
                                                    <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                                     <input type="text" name="name" id="name" placeholder="Votre Nom Complet" value="<?php echo $u_name; ?>" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email"><i class="zmdi zmdi-email"></i></label>
                                                    <input type="email" name="email" id="email" placeholder="Votre E-mail" value="<?php echo $u_mail; ?>" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="cabinet"><i class="zmdi zmdi-balance material-icons-name"></i></label>
                                                     <input type="text" name="cabinet" id="cabinet" placeholder="Nom de Cabinet" value="<?php echo $u_cab; ?>" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="spic"><i class="zmdi zmdi-assignment"></i></label>
                                                    <input type="spic" name="spic" id="spic" placeholder="Spicialitée" value="<?php echo $u_spi; ?>" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tel"><i class="zmdi zmdi-phone"></i></label>
                                                    <input type="text" name="tel" id="tel" placeholder="N° de Teléphone" value="<?php echo $u_tel; ?>" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="addr"><i class="zmdi zmdi-bookmark"></i></label>
                                                    <input type="text" name="addr" id="addr" placeholder="Adresse" value="<?php echo $u_add; ?>" required/>
                                                </div> 
                                                <div class="form-group form-button">
                                                    <input type="submit" name="edit" id="edit" class="form-submit" value="Modifier"  />
                                                </div> 
                                        </div>
                                    </form>
                                    <form action="Parametre.php" method="POST" class="register-form" id="register-form">

                                        <div class="signup-form" style="margin-left: -10px;">
                                           <?php echo '<div style=" padding: 10px; border: 1.5px dashed darkgreen; border-radius: 12px; background-color: '.$color.'; font-size: 14px; font-weight: 500; color: white; display:'.$display.';">'; ?>
                                           <?php echo $msg; ?></div><br>
                                            <div class="form-group">
                                                <label for="oldpass"><i class="zmdi zmdi-lock"></i></label>
                                                <input type="password" name="oldpass" id="oldpass" class=""  placeholder="Ancien Mot de Passe" required minlength="8" value="<?php echo $u_pass; ?>" />
                                            </div>
                                            <div class="form-group">
                                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                                <input type="password" name="pass" id="pass" class="Passing"  placeholder="Nouveau Mot de Passe" required minlength="8" onkeyup="verf()"/>
                                            </div>
                                            <div class="form-group" >
                                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                                <input type="password" name="re_pass" id="re_pass" class="Passing" placeholder="Confirmer le Nouveau Mot de Passe" required minlength="8" onkeyup="verf()"/>
                                            </div> 
                                            <div class="form-group form-button">
                                                <input type="submit" name="change" id="change" class="form-submit" value="Changer le mot de passe"  />
                                            </div> 
                                        </div>
                                    </form>
                                    </div> 
                                </section>
                            
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
    <script>
        function verf(){
           
           if($("#re_pass").val()==$("#pass").val()){
               $(".Passing").removeClass("red");
               $("#signup").removeAttr("disabled");
           }else{
               $(".Passing").addClass("red");
               $("#signup").attr("disabled","");
           }
       }
    </script>
</body> 
</html>