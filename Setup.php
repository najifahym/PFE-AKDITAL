<?php
require("connect.php");
if (isset($_POST["configure"])) {
    

    $sql = "INSERT INTO `users`(`u_name`, `u_mail`, `u_pass`, `u_cab`, `u_spi`, `u_tel`, `u_add`) VALUES ('".base64_encode($_COOKIE["name"])."', '".base64_encode($_COOKIE["email"])."','".base64_encode($_COOKIE["pass"])."','".base64_encode($_POST["cabinet"])."', '".base64_encode($_POST["spic"])."', '".base64_encode($_POST["tel"])."', '".base64_encode($_POST["addr"])."')";
   
mysqli_query($conn, $sql);
setcookie("name", $orig, time()-3600);
setcookie("pass", $orig, time()-3600);
setcookie("email", $orig, time()-3600);
    header("Location: login.php");
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Akdital -- Configuration</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    .err{
        background-color: #ec68109d;
    }
</style>
<body>

    <div class="main">

        <!-- Sign up form -->
        <form action="Setup.php" method="POST" class="register-form" id="register-form">
          
            <section class="signup" >
                <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Configuration</h2> 
                            <div class="form-group">
                                <label for="cabinet"><i class="zmdi zmdi-balance material-icons-name"></i></label>
                                 <input type="text" name="cabinet" id="cabinet" placeholder="Nom de Cabinet" required/>
                            </div>
                            <div class="form-group">
                                <label for="spic"><i class="zmdi zmdi-assignment"></i></label>
                                <input type="spic" name="spic" id="spic" placeholder="Spicialitée" required/>
                            </div>
                            <div class="form-group">
                                <label for="tel"><i class="zmdi zmdi-phone"></i></label>
                                <input type="text" name="tel" id="tel" placeholder="N° de Teléphone" required/>
                            </div>
                            <div class="form-group">
                                <label for="addr"><i class="zmdi zmdi-bookmark"></i></label>
                                <input type="text" name="addr" id="addr" placeholder="Adresse" required/>
                            </div> 
                            <div class="form-group form-button">
                                <input type="submit" name="configure" id="configure" class="form-submit" value="Terminer"  />
                            </div> 
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="SingnUp.php" class="signup-image-link">Annuler</a>
                    </div>
                </div>
                </div>
            </section>
        </form>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script> 
</body> 
</html>