<?php
require("connect.php");
 
 

    $sql1 = "SELECT * FROM `patients` ";

                  
    $result = $conn->query($sql1);
     $i="";
    if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $i=$i."<option value='".$row["p_id"]."'>".$row["p_sname"]." ". $row["p_fname"]."</option> ";
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<style> 

::-webkit-scrollbar {
  width: 0px;
}
@keyframes leadingCircle {
            0% {
                transform: translateX(0%);
                opacity: 1;
                background-color:red;
            }
            50% {
                transform: translateX(2500%);
                opacity: 0;
            }
            
            100% {
                transform: translateX(350%);
                opacity: 1;
                background-color:#efc225;
            }
        }
         

        .circle, .circle1, .circle2, .circle3{
            width: 10px;
            height: 10px;
            background-color: red;
            border-radius: 50%;
            position: absolute; 
        }
        
       .circle{ 
            animation: leadingCircle 1s linear infinite;
        }
       .circle1{ 
            animation: leadingCircle 1.1s linear infinite;
        }
       .circle2{ 
            animation: leadingCircle 1.2s linear infinite;
        }
       .circle3{ 
            animation: leadingCircle 1.3s linear infinite;
        }
        .block{display:block;}
        .none{display:none;}
</style>
<body>

    <div class="main" style="padding:  20px 0;">
    <section class="sign-in"> 
                <div class="container">
                    <div class="signin-content"> 
                    
                        <div class="signin-form">
                            <h4 class="form-title">Espace de test</h4> 
                            
                                <div class="form-group">
                                    <label for="dp_id"><i class="zmdi zmdi-male-female "></i></label>
                                        <select name="dp_id" id="dp_id" placeholder="Patient" required>
                                               <?php echo $i;?>         
                                        </select>
                                </div> 
                                
                                <div style="width:100%; height:20px;position:relative;overflow:hidden; " class="disp none"><div class="circle" ></div><div class="circle1"></div><div class="circle2"></div><div class="circle3"></div></div>
                                
                                <div class="form-group form-button">
                                                <input type="button" name="set" id="set" class="form-submit" value="Envoyer" onclick="setdata()" />
                                                 
                                </div> 
                                <div class="form-group form-button">
                                                <input type="button" name="set" id="sett" class="btn btn-danger" value="Annuler" onclick="annuledata()" />
                                </div> 
                        </div>
                    </div>
                </div>
             
        </section> 
    </div> 
    
    </body>
<script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script> 

<script>
    
    var d_ed = 0;
    function annuledata() {   d_ed = 0; $(".disp").addClass("none");$(".disp").removeClass("block");}
    function setdata() {   d_ed = $("#dp_id").val();$(".disp").addClass("block");$(".disp").removeClass("none");sendDataToBackend(); }
    function sendDataToBackend() {
         
    // Generate random values for each variable within the specified ranges
   
    const d_bpm = Math.floor(Math.random() * (102 - 70 + 1)) + 70;
    const d_spo2 = Math.floor(Math.random() * (100 - 60 + 1)) + 60; 
    const d_iid=d_ed;
    const set = 1;

    // Create a URL with the generated data
    const url = `adddata.php?d_bpm=${d_bpm}&d_spo2=${d_spo2}&dp_id=${d_iid}&set=${set}`;

    // Send the data to the backend using fetch API
    if(d_ed>0){
        console.log(d_ed);
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            console.log('Data sent successfully:');
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }else{console.log("No Patients Selected")}
}
setInterval(sendDataToBackend,12000);
</script>
</html>