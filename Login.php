<?php
require("connect.php");

$err="";
if (isset($_POST["signin"])) {   
    $u_mail=base64_encode($_POST["mail"]);
    $u_pass=base64_encode($_POST["pass"]); 


$sql1 = 'SELECT * FROM `users` WHERE u_mail="'.$u_mail.'" AND u_pass="'.$u_pass.'"';
              
$result = $conn->query($sql1);
$i=0;
if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $i=$row["u_id"]; 

          setcookie("user", $i, time()+3600);  
          header("Location: index.php"); 
}
}else{
    $err="Identifiants Incorrect";
}
}

if (isset($_COOKIE["user"])) { 
    header("Location: index.php"); 
 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Akdital -- Connexion</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <form action="Login.php" method="post">
                <div class="container">
                    <div class="signin-content">
                        <div class="signin-image">
                            <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                            <a href="SingnUp.php" class="signup-image-link">Créer Un Nouveau Compte</a>
                        </div>

                        <div class="signin-form">
                            <h2 class="form-title">Connexion</h2>
                            <form method="POST" class="register-form" id="login-form">
                                
                                <div class="form-group form-button">
                                   <span style="color :red;"><?php echo $err; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="mail"><i class="zmdi zmdi zmdi-email"></i></label>
                                    <input type="email" name="mail" id="your_name" placeholder="Adresse E-mail" required/>
                                </div>
                                <div class="form-group">
                                    <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="pass" id="your_pass" placeholder="Mot de Passe" required/>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                    <label for="remember-me" class="label-agree-term"><span><span></span></span>Rester Connecté</label>
                                </div>
                                <div class="form-group form-button">
                                    <input type="submit" name="signin" id="signin" class="form-submit" value="Se Connecter"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>