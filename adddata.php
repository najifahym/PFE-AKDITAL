<?php
require("connect.php");
 
function estimateRespiratoryRate($bp, $spo) {
    // Define respiratory rate ranges for different scenarios
    $respiratoryRates = array(
        // Elevated SpO2 and Lower bp
        array('spo2_range' => range(96, 100), 'bpm_range' => range(0, 69), 'rr_range' => array(12, 20)),
        // Normal SpO2 and Lower BPM
        array('spo2_range' => range(96, 100), 'bpm_range' => range(69, 90), 'rr_range' => array(20, 30)),
        // Normal SpO2 and Elevated BPM
        array('spo2_range' => range(96, 100), 'bpm_range' => range(90, 200), 'rr_range' => array(8, 13)), 
        
        // Elevated SpO2 and Lower BPM
        array('spo2_range' => range(55, 96), 'bpm_range' => range(0, 69), 'rr_range' => array(27, 35)),
        // Normal SpO2 and Lower BPM
        array('spo2_range' => range(55, 96), 'bpm_range' => range(69, 90), 'rr_range' => array(24, 30)),
        // Normal SpO2 and Elevated BPM
        array('spo2_range' => range(55, 96), 'bpm_range' => range(90, 200), 'rr_range' => array(40,45)), 
        
        // Elevated SpO2 and Lower BPM
        array('spo2_range' => range(0, 55), 'bpm_range' => range(0, 69), 'rr_range' => array(12, 19)),
        // Normal SpO2 and Lower BPM
        array('spo2_range' => range(0, 55), 'bpm_range' => range(69, 90), 'rr_range' => array(34, 40)),
        // Normal SpO2 and Elevated BPM
        array('spo2_range' => range(0, 55), 'bpm_range' => range(90, 200), 'rr_range' => array(33, 38)), 
    );

    // Iterate through scenarios to find matching range
    foreach ($respiratoryRates as $scenario) {
        if (in_array($spo, $scenario['spo2_range']) && in_array($bp, $scenario['bpm_range'])) {
            $rr_range = $scenario['rr_range'];
            // Calculate estimated respiratory rate
            $estimated_rr = rand($rr_range[0], $rr_range[1]);
            return $estimated_rr;
            

        }
    }
 
}



function getRandomTemperature($age_days) {
    if ($age_days >= 0 && $age_days <= 28) {
        return round(rand(365, 375) / 10, 1); // Newborns (0-28 days)
    } elseif ($age_days > 28 && $age_days <= 365) {
        return round(rand(364, 380) / 10, 1); // Infants (1-12 months)
    } elseif ($age_days > 365 && $age_days <= 1095) {
        return round(rand(361, 378) / 10, 1); // Toddlers & Preschoolers (1-3 years)
    } elseif ($age_days > 1095 && $age_days <= 4380) {
        return round(rand(361, 378) / 10, 1); // School-age children (4-12 years)
    } elseif ($age_days > 4380 && $age_days <= 6570) {
        return round(rand(361, 378) / 10, 1); // Adolescents (13-18 years)
    } else {
        return round(rand(361, 372) / 10, 1); // Adults (>18 years)
    }
}
    $sql1 = "SELECT * FROM `patients` ";

                  
    $result = $conn->query($sql1);
     $i="";
    if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $i=$i."<option value='".$row["p_id"]."'>".$row["p_sname"]." ". $row["p_fname"]."</option> ";
    }
     
    }
     if(isset($_GET["set"])){
 
        $dp_id=$_GET["dp_id"];

        $d_bpm=$_GET["d_bpm"];

        $d_spo2=$_GET["d_spo2"];

         
        $d_temp=null;

        $d_rr=null;


        $bpm = $d_bpm; // beats per minute
$spo2 = $d_spo2; // peripheral oxygen saturation

// Initialize variables for SBP and DBP
$sbp = null;
$dbp = null;

// Define blood pressure ranges and corresponding SBP and DBP values
if ($spo2 >= 95) {
    if ($bpm >= 90 && $bpm <= 120) {
        $sbp = 120;
        $dbp = 80;
    } elseif ($bpm >= 120 && $bpm <= 129) {
        $sbp = 129;
        $dbp = 80;
    } elseif ($bpm >= 130 && $bpm <= 139) {
        $sbp = 139;
        $dbp = 89;
    } elseif ($bpm >= 140 && $bpm <= 180) {
        $sbp = 180;
        $dbp = 120;
    } elseif ($bpm >= 75 && $bpm <= 90){
        // Handle cases where BPM doesn't fall into any defined range
        $sbp = 100;
        $dbp = 60;
    } else{
        // Handle cases where BPM doesn't fall into any defined range
        $sbp = 87;
        $dbp = 50;
    }
} elseif($spo2 >= 75)  {
    // Handle cases where SpO2 is below 95%
    
    if ($bpm >= 90 && $bpm <= 120) {
        $sbp = 130;
        $dbp = 85;
    } elseif ($bpm >= 120 && $bpm <= 129) {
        $sbp = 139;
        $dbp = 90;
    } elseif ($bpm >= 130 && $bpm <= 139) {
        $sbp = 169;
        $dbp = 99;
    } elseif ($bpm >= 140 && $bpm <= 180) {
        $sbp = 210;
        $dbp = 150;
    } elseif ($bpm >= 75 && $bpm <= 90){
        // Handle cases where BPM doesn't fall into any defined range
        $sbp = 80;
        $dbp = 60;
    } else{
        // Handle cases where BPM doesn't fall into any defined range
        $sbp = 77;
        $dbp = 40;
    }
} else{
    // Handle cases where SpO2 is below 95%
    
    if ($bpm >= 90 && $bpm <= 120) {
        $sbp = 140;
        $dbp = 110;
    } elseif ($bpm >= 120 && $bpm <= 129) {
        $sbp = 169;
        $dbp = 120;
    } elseif ($bpm >= 130 && $bpm <= 139) {
        $sbp = 199;
        $dbp = 99;
    } elseif ($bpm >= 140 && $bpm <= 180) {
        $sbp = 210;
        $dbp = 120;
    } elseif ($bpm >= 75 && $bpm <= 90){
        // Handle cases where BPM doesn't fall into any defined range
        $sbp = 80;
        $dbp = 40;
    } else{
        // Handle cases where BPM doesn't fall into any defined range
        $sbp = 77;
        $dbp = 450;
    }
}
 
$d_nibps=$sbp ;
$d_nibpd=$dbp ;


$d_rr = estimateRespiratoryRate($d_bpm, $d_spo2);

   $sql4 = 'SELECT * FROM `patients` WHERE p_id='.$dp_id;
                  
    $result4 = $conn->query($sql4);
    
    if ($result4->num_rows > 0) {
        while($row4 = $result4->fetch_assoc()) { 
             
            $start_date = strtotime(base64_decode($row4["p_ddn"]));
            $end_date = strtotime(date("Y-m-d"));
            
            $jr = floor(($end_date - $start_date) / (60 * 60 * 24));
            
                $d_temp = getRandomTemperature($jr);
             
        }
    }


        $sql = "INSERT INTO `data`( `dp_id`, `d_date`, `d_time`, `d_bpm`, `d_spo2`, `d_nibps`,`d_nibpd`, `d_temp`, `d_rr`)  VALUES ('".$dp_id."','".date('d/m/y')."','".date('h:i:s')."','".$d_bpm."','".$d_spo2."','".$d_nibps."','".$d_nibpd."','".$d_temp."','".$d_rr."')";
        $e_msg="";
        $e_err="";
        $e_urg="";
        mysqli_query($conn, $sql); 
        if ($d_spo2<85) {
         $e_msg="Hypoxie Sévère";
         $e_err="2";
         $e_urg="red";
        }elseif ($d_spo2<90) {
         $e_msg="Hypoxie Modérée";
         $e_err="2";
         $e_urg="orange";
        } elseif ($d_spo2<95) {
         $e_msg="Légère Hypoxie";
         $e_err="2";
         $e_urg="blue";
        }
          
  

        $e_msg=base64_encode($e_msg);
        if($e_err!=""){
           
           $sql2 = "INSERT INTO `events`(`eu_id`, `e_bpm`, `e_spo2`, `e_date`, `e_time`, `e_msg`, `e_err`, `e_urg`) VALUES ('".$dp_id."','".$d_bpm."','".$d_spo2."','".date('d/m/y')."','".date('h:i:s')."','".$e_msg."','".$e_err."','".$e_urg."')";
    
           mysqli_query($conn, $sql2); 
           

        } 
        $e_msg="";
        $e_err="";
        $e_urg="";

          if ($d_bpm<45) {
           $e_msg="Bradycardie Sévère";
           $e_err="1";
           $e_urg="red";
          }elseif ((45<$d_bpm) && ($d_bpm <59) ) {
           $e_msg="Hypoxie Modérée";
           $e_err="1";
           $e_urg="orange";
          } elseif ((75<$d_bpm) && ($d_bpm<89)) {
            $e_msg="Tachycardie légère";
            $e_err="1";
            $e_urg="blue";
           }elseif (90<$d_bpm) {
            $e_msg="Tachycardie Grave";
            $e_err="1";
            $e_urg="red";
           }
            

     $e_msg=base64_encode($e_msg);
     if($e_err!=""){
        
        $sql3 = "INSERT INTO `events`(`eu_id`, `e_bpm`, `e_spo2`, `e_date`, `e_time`, `e_msg`, `e_err`, `e_urg`) VALUES ('".$dp_id."','".$d_bpm."','".$d_spo2."','".date('d/m/y')."','".date('h:i:s')."','".$e_msg."','".$e_err."','".$e_urg."')";
 
        mysqli_query($conn, $sql3); 
        
     }
 
            }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Akdital -- DATA</title>

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
    <section class="sign-in">
            <form action="adddata.php" method="GET">
                <div class="container">
                    <div class="signin-content"> 
                    
                        <div class="signin-form">
                            <h2 class="form-title">Espace de test</h2>
                            <form method="GET" class="register-form" id="login-form">
                                 
                                <div class="form-group">
                                    <label for="dp_id"><i class="zmdi zmdi-male-female "></i></label>
                                        <select name="dp_id" id="dp_id" placeholder="Patient" required>
                                               <?php echo $i;?>         
                                        </select>
                                </div>
                                <!--div class="form-group">
                                    <label for="d_bpm"><i class="zmdi zmdi zmdi-edit"></i></label>
                                    <input type="number" name="d_bpm" id="d_bpm" placeholder="BPM" required/>
                                </div> 
                                
                                <div class="form-group">
                                    <label for="d_spo2"><i class="zmdi zmdi zmdi-edit"></i></label>
                                    <input type="number" name="d_spo2" id="d_spo2" placeholder="SPO2" required/>
                                </div> 
                                
                                <div class="form-group">
                                    <label for="d_temp"><i class="zmdi zmdi zmdi-edit"></i></label>
                                    <input type="number" name="d_temp" id="d_temp" placeholder="TEMPERATURE" required/>
                                </div> 
                                
                                <div class="form-group">
                                    <label for="d_nibp"><i class="zmdi zmdi zmdi-edit"></i></label>
                                    <input type="number" name="d_nibps" id="d_nibps" placeholder="NIBPS" required/>
                                </div> 
                                
                                <div class="form-group">
                                    <label for="d_nibp"><i class="zmdi zmdi zmdi-edit"></i></label>
                                    <input type="number" name="d_nibpd" id="d_nibpd" placeholder="NIBPD" required/>
                                </div> 
                                
                                <div class="form-group">
                                    <label for="d_rr"><i class="zmdi zmdi zmdi-edit"></i></label>
                                    <input type="number" name="d_rr" id="d_rr" placeholder="Fréquence Resperatoire" required/>
                                </div--> 
                                
                                <div class="form-group form-button">
                                                <input type="button" name="set" id="set" class="form-submit" value="Envoyer" />
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