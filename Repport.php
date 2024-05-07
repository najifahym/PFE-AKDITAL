<?php
require("connect.php");
$u_name="";
$u_cab="";
$u_id="";
if (isset($_COOKIE["user"])) { 
    $u_id=$_COOKIE["user"]; 
    $p_pt=base64_decode($_GET["pt"]);

    $sql1 = 'SELECT * FROM `users` WHERE u_id='.$u_id;                  
    $result = $conn->query($sql1);
    $i=0;
    if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              $u_name=base64_decode($row["u_name"]);  
              $u_mail=base64_decode($row["u_mail"]);  
              $u_cab=base64_decode($row["u_cab"]);  
              $u_spi=base64_decode($row["u_spi"]);  
              $u_tel=base64_decode($row["u_tel"]);  
              $u_add=base64_decode($row["u_add"]);  
    }
    }
    
    $sql2 = 'SELECT * FROM `patients` WHERE p_id='.base64_decode($_GET["pt"]);                
    $result2 = $conn->query($sql2);    
    if ($result2->num_rows > 0) {
          while($row2 = $result2->fetch_assoc()) {
              $P_name=$row2["p_sname"]." ".$row2["p_fname"];  
              $P_cin=$row2["p_cin"];  
              $p_ddn =base64_decode($row2["p_ddn"]);
              $p_tel =base64_decode($row2["p_tel"]);
              $p_ville =base64_decode($row2["p_ville"]);
              $p_sang =base64_decode($row2["p_sang"]);
              $p_mal =base64_decode($row2["p_mal"]);
              $p_mal =base64_decode($row2["p_mal"]);
              $p_datein =$row2["p_datein"];
              $p_dateout =$row2["p_dateout"];
              $p_etab =base64_decode($row2["p_etab"]);
             
             
    }
    }

$bpm="[";
$spo2="[";
$temp="[";
$nibps="[";
$nibpd="[";
$label="[";
$cont=0;
$maxbpm=0;
$minbpm=1000;
$moybpm=0;

$maxspo2=0;
$minspo2=1000;
$moyspo2=0;

$maxtemp=0;
$mintemp=1000;
$moytemp=0;

    $sql3 = 'SELECT * FROM `data` WHERE dp_id='.base64_decode($_GET["pt"]);                
    $result3 = $conn->query($sql3);    
    if ($result3->num_rows > 0) {
          while($row3 = $result3->fetch_assoc()) {
               
            $bpm=$bpm."".$row3["d_bpm"].",";
            $spo2=$spo2."".$row3["d_spo2"].",";
            $temp=$temp."".$row3["d_temp"].",";
            $nibps=$nibps."".$row3["d_nibps"].",";
            $nibpd=$nibpd."".$row3["d_nibpd"].",";
            $label=$label."".$row3["d_id"].",";
            $cont=$cont+1;
            $moybpm=$moybpm+$row3["d_bpm"];
            $moyspo2=$moyspo2+$row3["d_spo2"];
            $moytemp=$moytemp+$row3["d_temp"];
            if ($row3["d_bpm"]>$maxbpm) {
               $maxbpm=$row3["d_bpm"];
            }
            if ($row3["d_spo2"]>$maxspo2) {
               $maxspo2=$row3["d_spo2"];
            }
            if ($row3["d_temp"]>$maxtemp) {
               $maxtemp=$row3["d_temp"];
            }

            if ($row3["d_bpm"]<$minbpm) {
                $minbpm=$row3["d_bpm"];
             }
             if ($row3["d_spo2"]<$minspo2) {
                $minspo2=$row3["d_spo2"];
             }
             if ($row3["d_temp"]<$mintemp) {
                $mintemp=$row3["d_temp"];
             }
             
    }

    $moybpm=number_format($moybpm/$cont,0);
    $moyspo2=number_format($moyspo2/$cont,0);
    $moytemp=number_format($moytemp/$cont,0);

    $bpm=substr($bpm, 0, -1);
    $spo2=substr($spo2, 0, -1);
    $temp=substr($temp, 0, -1);
    $nibps=substr($nibps, 0, -1);
    $nibpd=substr($nibpd, 0, -1);
    $label=substr($label, 0, -1);

    $bpm=$bpm."]";
    $spo2=$spo2."]";
    $temp=$temp."]";
    $nibps=$nibps."]";
    $nibpd=$nibpd."]";
    $label=$label."]";
    
    }




} 

else{header("Location: Login.php");}

?>
<head><title><?php echo $P_name; ?></title></head>
<link rel="stylesheet" href="css/rapport.css">

<script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>  
    <script src="js/Chart.js"></script>
<div> 
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:normal;">&nbsp;</p>
    <table cellspacing="0" cellpadding="0" style='border: 0.75pt solid rgb(159, 184, 205); border-collapse: collapse; empty-cells: show; max-width: 100%; color: rgb(0, 0, 0); font-family: "Times New Roman"; font-size: medium; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: center; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; width: 858px; margin-right: auto; margin-left: auto;'>
        <tbody>
            <tr style="user-select: none;">
                <td style="min-width: 5px; border-width: 1px 0.75pt 1px 1px; border-style: solid; border-color: rgb(221, 221, 221) rgb(159, 184, 205) rgb(221, 221, 221) rgb(221, 221, 221); border-image: initial; user-select: text; width: 17.5pt; vertical-align: top; background-color: rgb(159, 184, 205);">
                    <p style="margin-bottom: 0pt; margin-top: 0pt; font-size: 10pt;">&nbsp;</p>
                </td>
                <td style="min-width: 5px; border-width: 1px 1px 1px 0.75pt; border-style: solid; border-color: rgb(221, 221, 221) rgb(221, 221, 221) rgb(221, 221, 221) rgb(159, 184, 205); border-image: initial; user-select: text; width: 432.15pt; padding: 18pt 17.62pt; vertical-align: top;">
                    <p style="margin-bottom: 0pt; margin-top: 0pt; text-align: right; font-size: 20pt;"><span style='font-family: "Wingdings 3"; letter-spacing: 0.5pt; color: rgb(98, 139, 173);'></span><span style='font-family: "Bookman Old Style"; color: rgb(82, 90, 125);'><?php echo $P_name; ?></span></p>
                    <p style="margin-bottom: 0pt; margin-top: 10pt; font-size: 9pt; text-align: left;"><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>CIN</span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>&nbsp;</span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>: <?php echo $P_cin; ?></span></p>
                    <p style="margin-bottom: 0pt; margin-top: 0pt; font-size: 9pt; text-align: left;"><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>Date de Naissance</span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>&nbsp;</span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>: <?php echo $p_ddn; ?></span></p>
                    <p style="margin-bottom: 0pt; margin-top: 0pt; font-size: 9pt; text-align: left;"><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>Téléphone </span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>: <?php echo $p_tel; ?></span></p>
                    <p style="margin-bottom: 0pt; margin-top: 0pt; font-size: 9pt; text-align: left;"><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'> </span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'></span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>Ville </span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>: <?php echo $p_ville; ?></span></p>
                    <p style="margin-bottom: 0pt; margin-top: 0pt; font-size: 9pt; text-align: left;"><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>Groupage</span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>&nbsp;</span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>: <?php echo $p_sang; ?></span></p>
                    <p style="margin-bottom: 0pt; margin-top: 0pt; font-size: 9pt; text-align: left;"><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>Maladie</span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>&nbsp;</span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>: <?php echo $p_mal; ?>&nbsp;</span></p>
                    <p style="margin-bottom: 0pt; margin-top: 0pt; font-size: 9pt;"><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>&nbsp;</span></p>
                    <p style="margin-bottom: 0pt; margin-top: 0pt; font-size: 9pt; text-align: right;"><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>Entrée Le</span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>&nbsp;</span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>: <?php echo $p_datein; ?></span></p>
                    <p style="margin-bottom: 0pt; margin-top: 0pt; font-size: 9pt; text-align: right;"><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>Sortie</span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>&nbsp;</span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>&nbsp;Le</span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>&nbsp;</span><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'>: <?php echo $p_dateout; ?></span></p>
                    <p style="margin-bottom: 0pt; margin-top: 0pt; font-size: 9pt; text-align: right;"><span style='font-family: "Bookman Old Style"; color: rgb(159, 184, 205);'><?php echo $p_etab; ?></span></p>
                </td>
            </tr>
        </tbody>
    </table>
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:normal;"><br></p> 
    <div style="text-align:center;">
        <table cellspacing="0" cellpadding="0" style="width:100%; margin-right:auto; margin-left:auto; border:0.75pt solid #aab0c7; border-collapse:collapse;">
            <tbody>
                <tr style="height:248.3pt;">
                    <td style="width:0.3pt; border-right:0.75pt solid #aab0c7; border-bottom:0.75pt solid #aab0c7; padding-right:3.12pt; padding-left:3.12pt; vertical-align:top; background-color:#aab0c7;">
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt;">&nbsp;</p>
                    </td>
                    <td style="width:438.45pt; border-left:0.75pt solid #aab0c7; border-bottom:0.75pt solid #aab0c7; padding-right:3.12pt; padding-left:3.12pt; vertical-align:top;">
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:20pt;"><span style="font-family:'Bookman Old Style'; letter-spacing:0.5pt; color:#628bad;">BPM</span></p>
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">&nbsp;</span></strong></p>
                        <p style="margin-top: 0pt; margin-bottom: 6pt; font-size: 12pt; text-align: left;"><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">Evolution en bpm&nbsp;</span></strong></p>
                        <p style="margin-top: 0pt; margin-bottom: 16pt; line-height: 115%; font-size: 10pt; text-align: left;">
                        <canvas alt=""id="line-bpm" style="width: 825px; height: 182.398px;" width="825" height="182.398">
                        </canvas>
                       
                        </p>
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:12pt;"><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">Moyenne</span></strong><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></strong><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">MIN</span></strong><span style="font-size:10pt;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">MAX</span></strong></p>
                        <div style="display: flex; padding-left: calc(50% - 135px);">
                        <svg viewBox="0 0 36 36" class="circular-chart green"> <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <path class="circle" stroke-dasharray="<?php echo $moybpm; ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <text x="18" y="20.35" class="percentage"><?php echo $moybpm; ?></text> </svg>
                        <svg viewBox="0 0 36 36" class="circular-chart orange"> <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <path class="circle" stroke-dasharray="<?php echo $minbpm; ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <text x="18" y="20.35" class="percentage"><?php echo $minbpm; ?></text> </svg>
                        <svg viewBox="0 0 36 36" class="circular-chart blue"> <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <path class="circle" stroke-dasharray="<?php echo $maxbpm; ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <text x="18" y="20.35" class="percentage"><?php echo $maxbpm; ?></text> </svg>
                        </div>
                        

                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><span style="height:0pt; display:block; position:absolute; z-index:2;"><br></span><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">&nbsp;</span></strong></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <p style="margin-top:0pt; margin-bottom:10pt;">&nbsp;</p>
    <div style="text-align:center;">
        <table cellspacing="0" cellpadding="0" style="width:100%; margin-right:auto; margin-left:auto; border:0.75pt solid #aab0c7; border-collapse:collapse;">
            <tbody>
                <tr style="height:248.3pt;">
                    <td style="width:0.3pt; border-top:0.75pt solid #aab0c7; border-right:0.75pt solid #aab0c7; padding-right:3.12pt; padding-left:3.12pt; vertical-align:top; background-color:#aab0c7;">
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt;">&nbsp;</p>
                    </td>
                    <td style="width:438.45pt; border-top:0.75pt solid #aab0c7; border-left:0.75pt solid #aab0c7; padding-right:3.12pt; padding-left:3.12pt; vertical-align:top;">
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:20pt;"><span style="font-family:'Bookman Old Style'; letter-spacing:0.5pt; color:#628bad;">SPO2</span></p>
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">&nbsp;</span></strong></p>
                        <p style="margin-top: 0pt; margin-bottom: 6pt; font-size: 12pt; text-align: left;"><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">Evolution en % &nbsp;</span></strong></p>
                        <canvas alt=""id="line-spo2" style="width: 825px; height: 182.398px;" width="825" height="182.398">
                        </canvas>
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:12pt;"><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">Moyenne</span></strong><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></strong><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">MIN</span></strong><span style="font-size:10pt;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">MAX</span></strong></p>
                        <div style="display: flex; padding-left: calc(50% - 135px);">
                        <svg viewBox="0 0 36 36" class="circular-chart green"> <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <path class="circle" stroke-dasharray="<?php echo $moyspo2; ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <text x="18" y="20.35" class="percentage"><?php echo $moyspo2; ?>%</text> </svg>
                        <svg viewBox="0 0 36 36" class="circular-chart orange"> <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <path class="circle" stroke-dasharray="<?php echo $minspo2; ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <text x="18" y="20.35" class="percentage"><?php echo $minspo2; ?>%</text> </svg>
                        <svg viewBox="0 0 36 36" class="circular-chart blue"> <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <path class="circle" stroke-dasharray="<?php echo $maxspo2; ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <text x="18" y="20.35" class="percentage"><?php echo $maxspo2; ?>%</text> </svg>
                        </div>
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">&nbsp;</span></strong></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <br>
    <br>
    <p style="margin-top:30pt; margin-bottom:10pt;">&nbsp;</p>

    <div style="text-align:center;">
        <table cellspacing="0" cellpadding="0" style="width:100%; margin-right:auto; margin-left:auto; border-collapse:collapse;">
            <tbody>
                <tr style="height:248.3pt;">
                    <td style="width:0.3pt; border:0.75pt solid #aab0c7; padding-right:3.12pt; padding-left:3.12pt; vertical-align:top; background-color:#aab0c7;">
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt;">&nbsp;</p>
                    </td>
                    <td style="width:438.45pt; border:0.75pt solid #aab0c7; padding-right:3.12pt; padding-left:3.12pt; vertical-align:top;">
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:20pt;"><span style="font-family:'Bookman Old Style'; letter-spacing:0.5pt; color:#628bad;">TEMPERATURE</span></p>
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">&nbsp;</span></strong></p>
                        <p style="margin-top: 0pt; margin-bottom: 6pt; font-size: 12pt; text-align: left;"><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">Evolution en °C &nbsp;</span></strong></p>
                        <canvas alt=""id="line-temp" style="width: 825px; height: 182.398px;" width="825" height="182.398">
                        </canvas>
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:12pt;"><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">Moyenne</span></strong><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></strong><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">MIN</span></strong><span style="font-size:10pt;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">MAX</span></strong></p>
                        <div style="display: flex; padding-left: calc(50% - 135px);">
                        <svg viewBox="0 0 36 36" class="circular-chart green"> <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <path class="circle" stroke-dasharray="<?php echo $moytemp; ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <text x="18" y="20.35" class="percentage"><?php echo $moytemp; ?></text> </svg>
                        <svg viewBox="0 0 36 36" class="circular-chart orange"> <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <path class="circle" stroke-dasharray="<?php echo $mintemp; ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <text x="18" y="20.35" class="percentage"><?php echo $mintemp; ?></text> </svg>
                        <svg viewBox="0 0 36 36" class="circular-chart blue"> <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <path class="circle" stroke-dasharray="<?php echo $maxtemp; ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" /> <text x="18" y="20.35" class="percentage"><?php echo $maxtemp; ?></text> </svg>
                        </div>
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">&nbsp;</span></strong></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <p style="margin-top:0pt; margin-bottom:10pt;">&nbsp;</p>
    <div style="text-align:center;">
        <table cellspacing="0" cellpadding="0" style="width:100%; margin-right:auto; margin-left:auto; border:0.75pt solid #aab0c7; border-collapse:collapse;">
            <tbody>
                <tr style="height:248.3pt;">
                    <td style="width:0.3pt; border:0.75pt solid #aab0c7; padding-right:3.12pt; padding-left:3.12pt; vertical-align:top; background-color:#aab0c7;">
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt;">&nbsp;</p>
                    </td>
                    <td style="width:438.45pt; border:0.75pt solid #aab0c7; padding-right:3.12pt; padding-left:3.12pt; vertical-align:top;">
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:20pt;"><span style="font-family:'Bookman Old Style'; color:#525a7d;">NBIP</span></p>
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">&nbsp;</span></strong></p>
                        <p style="margin-top: 0pt; margin-bottom: 6pt; font-size: 12pt; text-align: left;"><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">Evolution en mmHg&nbsp;</span></strong></p>
                        <canvas alt=""id="line-nbip" style="width: 825px; height: 182.398px;" width="825" height="182.398">
                        </canvas>
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><strong><span style="font-family:'Bookman Old Style'; color:#9fb8cd;">&nbsp;</span></strong></p>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
    <p style="margin-top:0pt; margin-bottom:10pt;">&nbsp;</p>
    <div style="text-align:center;">
        <table cellspacing="0" cellpadding="0" style="width:100%; margin-right:auto; margin-left:auto; border:0.75pt solid #aab0c7; border-collapse:collapse;">
            <tbody>
                <tr style="height:75.1pt;">
                    <td style="width:0.3pt; border:0.75pt solid #aab0c7; padding-right:3.12pt; padding-left:3.12pt; vertical-align:top; background-color:#aab0c7;">
                        <p style="margin-top:10pt; padding-bottom:10pt; font-size:10pt;">&nbsp;</p>
                    </td>

                    <td style="width:438.45pt; border:0.75pt solid #aab0c7; padding-right:3.12pt; padding-left:3.12pt;  padding-top:5.12pt; padding-bottom:5.12pt; vertical-align:top;">
                    <p style="margin-top:5pt;  font-size:10pt;">&nbsp;</p>
                        <p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 20pt;"><span style="font-family:'Wingdings 3'; color:#525a7d;"></span><span style="font-family:'Bookman Old Style'; color:#525a7d;">DR. <?php echo $u_name; ?></span></p>
                        <p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 9pt; text-align: center;"><span style="font-family:'Bookman Old Style'; color:#9fb8cd;"><?php echo $u_spi; ?></span></p>
                        <p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 9pt; text-align: center;"><span style="font-family:'Bookman Old Style'; color:#9fb8cd;"><?php echo $u_mail; ?></span></p>
                        <p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 9pt; text-align: center;"><span style="font-family:'Bookman Old Style'; color:#9fb8cd;"><?php echo $u_tel; ?></span></p>
                        <p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 9pt; text-align: center;"><span style="font-family:'Bookman Old Style'; color:#9fb8cd;"><?php echo $u_cab; ?></span> 
                        <p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 9pt; text-align: center;"><span style="font-family:'Bookman Old Style'; color:#9fb8cd;"><?php echo $u_add; ?></span></p>
                        <p style="margin-top:5pt;   font-size:10pt;">&nbsp;</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <p style="margin-top:10pt; padding-bottom:10pt;">&nbsp;</p>
</div>
<script>
// BPM
new Chart(document.getElementById("line-bpm"), {
  type: 'line',
  data: {
    labels: <?php echo $label; ?>,
    datasets: [{ 
        data: <?php echo $bpm; ?>,
        label: "BPM",
        borderColor: "#3e95cd",
        fill: true
      }
    ]
  },
  options: { 
    
    responsive: false,
        legend: {
          display: false,
                 },
        scales: {            
            xAxes: [{
              gridLines: {
                  color: "rgb(42 237 203 / 56%)",
                  display: true
                         },
                         ticks: {
                            display: false
                        },
                    }],
            yAxes: [{
                gridLines: {
                    color: "rgb(42 237 203 / 56%)",
                    display: true
                             },ticks: {
                    display: true
                            },
                 }]
                }
  }
});


// SPO2
new Chart(document.getElementById("line-spo2"), {
  type: 'line',
  data: {
    labels:<?php echo $label; ?>,
    datasets: [{ 
        data: <?php echo $spo2; ?>,
        label: "SPO2",
        borderColor: "#c45850",
        fill: true
      }
    ]
  },
  options: {
   
    responsive: false,
        legend: {
          display: false,
                 },
        scales: {            
            xAxes: [{
              gridLines: {
                  color: "rgb(60 158 229 / 71%)",
                  display: true
                         },
                         ticks: {
                            display: false
                        },
                    }],
            yAxes: [{
                gridLines: {
                    color: "rgb(60 158 229 / 71%)",
                    display: true
                             },ticks: {
                    display: true
                            },
                 }]
                }
  }
});

// TEMPERATURE
new Chart(document.getElementById("line-temp"), {
  type: 'line',
  data: {
    labels: <?php echo $label; ?>,
    datasets: [{ 
        data: <?php echo $temp; ?>,
        label: "TEMPERATURE",
        borderColor: "#3e95cd",
        fill: true
      }
    ]
  },
  options: {
    
    responsive: false,
        legend: {
          display: false,
                 },
        scales: {            
            xAxes: [{
              gridLines: {
                  color: "rgb(60 158 119 / 71%)",
                  display: true
                         },
                         ticks: {
                            display: false
                        },
                    }],
            yAxes: [{
                gridLines: {
                    color: "rgb(60 158 119 / 71%)",
                    display: true
                             },ticks: {
                    display: true
                            },
                 }]
                }
  }
});

// NBIP
new Chart(document.getElementById("line-nbip"), {
  type: 'line',
  data: {
    labels: <?php echo $label; ?>,
    datasets: [{ 
        data: <?php echo $nibpd; ?>,
        label: "DIASTOLIQUE", 
        borderColor: "#3e95ca",
        fill: true
      },  { 
        data: <?php echo $nibps; ?>,
        label: "SYSTOLIQUE", 
        borderColor: "#c45856",
        fill: true
      }
    ]
  },
  options: {
    
    responsive: false,
        legend: {
          display: true,
                 },
        scales: {            
            xAxes: [{
              gridLines: {
                  color: "rgb(42 37 03 / 56%)",
                  display: true
                         },
                         ticks: {
                            display: false
                        },
                    }],
            yAxes: [{
                gridLines: {
                    color: "rgb(42 37 03 / 56%)",
                    display: true
                             },ticks: {
                    display: true
                            },
                 }]
                }
  }
});






    window.addEventListener('afterprint',
    function(event){
        window.close();
    });
    var a=0.
    setInterval(function () {
        a=a+1
        console.log(a);
        if (a==2) {
        
        window.print();
        }
    }, 1000);
    
   
</script>