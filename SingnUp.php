<?php
require("connect.php");
if (isset($_POST["signup"])) {
      
    setcookie("name", $_POST["name"], time()+3600);
    setcookie("pass", $_POST["pass"], time()+3600);
    setcookie("email", $_POST["email"], time()+3600);
  
    header("Location: Setup.php");
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Akdital -- Inscription</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    .err{
        background-color: #ec68109d;
    }
    .red{
        border-color: red;
        color: red;;
    }
</style>
<body>

    <div class="main">

        <!-- Sign up form -->
        <form action="singnUp.php" method="POST" class="register-form" id="register-form">
          
            <section class="signup signup2" id="signup2">
                <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Créer un Nouveau Compte</h2> 
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                 <input type="text" name="name" id="name" placeholder="Votre Nom Complet" required/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Votre E-mail" required/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" class="Passing"  placeholder="Mot de Passe" required minlength="8" onkeyup="verf()"/>
                            </div>
                            <div class="form-group" >
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" class="Passing" placeholder="Confirmer le Mot de Passe" required minlength="8" onkeyup="verf()"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term checke" required />
                                <label for="agree-term" class="label-agree-term" id="labchek"><span><span></span></span>Accepter Tous <a href="#" class="term-service">Les Termes d'utilisation</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Suivant" onclick="chek()" />
                            </div> 
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="Login.php" class="signup-image-link">Deja Membre</a>
                    </div>
                </div>
                </div>
            </section>
        </form>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function chek(){
           let isChecked = $(".checke").is(':checked')
           if(isChecked== false){
                $("#labchek").addClass("err");
            }else{
                $("#labchek").removeClass("err");
            } 
        }
        
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