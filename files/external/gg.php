<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/public/css/style-gg3hg.css" />

<?php require_once(INCLUDES . 'data.php'); ?>
<div class="page galaxyGates">
<div class="noSelect galaxyGates-container">
<div class="gg-container">
<div id="messagebox" style="display:none; position:absolute; text-align:center; width:768px; height:400px; border:1px solid black; background:rgba(0,0,0,0.9); z-index:100;">
</div>


<?php
// Gate: Alpha | ID: 1;
$alphaQ = $mysqli->query("SELECT * FROM player_galaxygates WHERE userId = '".$player['userId']."' AND gateId = '1'");
$alphaIQ = $mysqli->query("SELECT * FROM info_galaxygates WHERE gateId = '1'");


$alphaTP = 0;
$requireAlphaParts = 0;

if ($alphaQ->num_rows > 0){
    $fetchAlphaQ = $alphaQ->fetch_assoc();
    $dataParts = json_decode($fetchAlphaQ['parts']);

    foreach ($dataParts as $part){
        $alphaTP += $part;
    }

    if ($alphaTP >= 34){
        $alphaTP = 34;
        $alphaUnlocked = true;
    }

}

if ($alphaIQ->num_rows > 0){
    $fetchAlphaIQ = $alphaIQ->fetch_assoc();

    $requireAlphaParts = $fetchAlphaIQ['parts'];
}
//

$alphaParts = $alphaTP."/".$requireAlphaParts;

// Gate: Beta | ID: 2;
$betaQ = $mysqli->query("SELECT * FROM player_galaxygates WHERE userId = '".$player['userId']."' AND gateId = '2'");
$betaIQ = $mysqli->query("SELECT * FROM info_galaxygates WHERE gateId = '2'");

$betaTP = 0;
$requireBetaParts = 0;

if ($betaQ->num_rows > 0){
    $fetchBetaQ = $betaQ->fetch_assoc();
    $dataParts = json_decode($fetchBetaQ['parts']);

    foreach ($dataParts as $part){
        $betaTP += $part;
    }

    if ($betaTP >= 48){
        $betaTP = 48;
        $betaUnlocked = true;
    }

}

if ($betaIQ->num_rows > 0){
    $fetchBetaIQ = $betaIQ->fetch_assoc();

    $requireBetaParts = $fetchBetaIQ['parts'];
}
//

$betaParts = $betaTP."/".$requireBetaParts;

// Gate: Ganna | ID: 3;
$gammaQ = $mysqli->query("SELECT * FROM player_galaxygates WHERE userId = '".$player['userId']."' AND gateId = '3'");
$gammaIQ = $mysqli->query("SELECT * FROM info_galaxygates WHERE gateId = '3'");

$gammaTP = 0;
$requireGammaParts = 0;

if ($gammaQ->num_rows > 0){
    $fetchGammaQ = $gammaQ->fetch_assoc();
    $dataParts = json_decode($fetchGammaQ['parts']);

    foreach ($dataParts as $part){
        $gammaTP += $part;
    }

    if ($gammaTP >= 82){
        $gammaTP = 82;
        $gammaUnlocked = true;
    }

}

if ($gammaIQ->num_rows > 0){
    $fetchGammaIQ = $gammaIQ->fetch_assoc();

    $requireGammaParts = $fetchGammaIQ['parts'];
}
//

$gammaParts = $gammaTP."/".$requireGammaParts;

// Gate: Delta | ID: 4;
$deltaQ = $mysqli->query("SELECT * FROM player_galaxygates WHERE userId = '".$player['userId']."' AND gateId = '4'");
$deltaIQ = $mysqli->query("SELECT * FROM info_galaxygates WHERE gateId = '4'");

$deltaTP = 0;
$requiredeltaParts = 0;

if ($deltaQ->num_rows > 0){
    $fetchdeltaQ = $deltaQ->fetch_assoc();
    $dataParts = json_decode($fetchdeltaQ['parts']);

    foreach ($dataParts as $part){
        $deltaTP += $part;
    }

    if ($deltaTP >= 128){
        $deltaTP = 128;
        $deltaUnlocked = true;
    }

}

if ($deltaIQ->num_rows > 0){
    $fetchdeltaIQ = $deltaIQ->fetch_assoc();

    $requiredeltaParts = $fetchdeltaIQ['parts'];
}
//

$deltaParts = $deltaTP."/".$requiredeltaParts;

// Gate: Epsilon | ID: 5;
$epsilonQ = $mysqli->query("SELECT * FROM player_galaxygates WHERE userId = '".$player['userId']."' AND gateId = '5'");
$epsilonIQ = $mysqli->query("SELECT * FROM info_galaxygates WHERE gateId = '5'");

$epsilonTP = 0;
$requireepsilonParts = 0;

if ($epsilonQ->num_rows > 0){
    $fetchepsilonQ = $epsilonQ->fetch_assoc();
    $dataParts = json_decode($fetchepsilonQ['parts']);

    foreach ($dataParts as $part){
        $epsilonTP += $part;
    }

    if ($epsilonTP >= 99){
        $epsilonTP = 99;
        $epsilonUnlocked = true;
    }

}

if ($epsilonIQ->num_rows > 0){
    $fetchepsilonIQ = $epsilonIQ->fetch_assoc();

    $requireepsilonParts = $fetchepsilonIQ['parts'];
}
//

$epsilonParts = $epsilonTP."/".$requireepsilonParts;

// Gate: Lambda | ID: 8;
$lambdaQ = $mysqli->query("SELECT * FROM player_galaxygates WHERE userId = '".$player['userId']."' AND gateId = '8'");
$lambdaIQ = $mysqli->query("SELECT * FROM info_galaxygates WHERE gateId = '8'");

$lambdaTP = 0;
$requirelambdaParts = 0;

if ($lambdaQ->num_rows > 0){
    $fetchlambdaQ = $lambdaQ->fetch_assoc();
    $dataParts = json_decode($fetchlambdaQ['parts']);

    foreach ($dataParts as $part){
        $lambdaTP += $part;
    }

    if ($lambdaTP >= 45){
        $lambdaTP = 45;
        $lambdaUnlocked = true;
    }

}

if ($lambdaIQ->num_rows > 0){
    $fetchlambdaIQ = $lambdaIQ->fetch_assoc();

    $requirelambdaParts = $fetchlambdaIQ['parts'];
}
//

$lambdaParts = $lambdaTP."/".$requirelambdaParts;
// Gate: Kappa | ID: 7;
$kappaQ = $mysqli->query("SELECT * FROM player_galaxygates WHERE userId = '".$player['userId']."' AND gateId = '7'");
$kappaIQ = $mysqli->query("SELECT * FROM info_galaxygates WHERE gateId = '7'");

$kappaTP = 0;
$requirekappaParts = 0;

if ($kappaQ->num_rows > 0){
    $fetchkappaQ = $kappaQ->fetch_assoc();
    $dataParts = json_decode($fetchkappaQ['parts']);

    foreach ($dataParts as $part){
        $kappaTP += $part;
    }

    if ($kappaTP >= 120){
        $kappaTP = 120;
        $kappaUnlocked = true;
    }

}

if ($kappaIQ->num_rows > 0){
    $fetchkappaIQ = $kappaIQ->fetch_assoc();

    $requirekappaParts = $fetchkappaIQ['parts'];
}
//

$kappaParts = $kappaTP."/".$requirekappaParts;

// Gate: Hades | ID: 10;
$hadesQ = $mysqli->query("SELECT * FROM player_galaxygates WHERE userId = '".$player['userId']."' AND gateId = '10'");
$hadesIQ = $mysqli->query("SELECT * FROM info_galaxygates WHERE gateId = '10'");

$hadesTP = 0;
$requirehadesParts = 0;

if ($hadesQ->num_rows > 0){
    $fetchhadesQ = $hadesQ->fetch_assoc();
    $dataParts = json_decode($fetchhadesQ['parts']);

    foreach ($dataParts as $part){
        $hadesTP += $part;
    }

    if ($hadesTP >= 45){
        $hadesTP = 45;
        $hadesUnlocked = true;
    }

}

if ($hadesIQ->num_rows > 0){
    $fetchhadesIQ = $hadesIQ->fetch_assoc();

    $requirehadesParts = $fetchhadesIQ['parts'];
}
//

$hadesParts = $hadesTP."/".$requirehadesParts;

// Gate: Kronos | ID: 9;
$kronosQ = $mysqli->query("SELECT * FROM player_galaxygates WHERE userId = '".$player['userId']."' AND gateId = '9'");
$kronosIQ = $mysqli->query("SELECT * FROM info_galaxygates WHERE gateId = '9'");

$kronosTP = 0;
$requirekronosParts = 0;

if ($kronosQ->num_rows > 0){
    $fetchkronosQ = $kronosQ->fetch_assoc();
    $dataParts = json_decode($fetchkronosQ['parts']);

    foreach ($dataParts as $part){
        $kronosTP += $part;
    }

    if ($kronosTP >= 120){
        $kronosTP = 120;
        $kronosUnlocked = true;
    }

}

if ($kronosIQ->num_rows > 0){
    $fetchkronosIQ = $kronosIQ->fetch_assoc();

    $requirekronosParts = $fetchkronosIQ['parts'];
}
//

$kronosParts = $kronosTP."/".$requirekronosParts;
?>

<div style="float:left; width:150px; height:425px; border-right:1px solid #5cb85c; padding-top:10px; padding-left:5px; padding-right:10px;">
<div style="text-align:center; padding-bottom:5px;"><b>AVAILABLE GATES</b></div>
<div data-gate="gate-alpha" class="gg-gate-button alpha-button fg-<?= (isset($alphaUnlocked)) ? 'white' : 'red'; ?>" onclick="selectGate(this, 1);"><?= (isset($alphaUnlocked)) ? '<i class="fa fa-unlock"></i>' : '<i class="fa fa-lock"></i>'; ?> Alpha gate</div>
<div data-gate="gate-beta" class="gg-gate-button beta-button fg-<?= (isset($betaUnlocked)) ? 'white' : 'red'; ?>" onclick="selectGate(this, 2);"><?= (isset($betaUnlocked)) ? '<i class="fa fa-unlock"></i>' : '<i class="fa fa-lock"></i>'; ?> Beta gate</div>
<div data-gate="gate-gamma" class="gg-gate-button gamma-button fg-<?= (isset($gammaUnlocked)) ? 'white' : 'red'; ?>" onclick="selectGate(this, 3);"><?= (isset($gammaUnlocked)) ? '<i class="fa fa-unlock"></i>' : '<i class="fa fa-lock"></i>'; ?> Gamma gate</div>
<div data-gate="gate-delta" class="gg-gate-button delta-button fg-<?= (isset($deltaUnlocked)) ? 'white' : 'red'; ?>" onclick="selectGate(this, 4);"><?= (isset($deltaUnlocked)) ? '<i class="fa fa-unlock"></i>' : '<i class="fa fa-lock"></i>'; ?> Delta gate</div>
<div data-gate="gate-kappa" class="gg-gate-button kappa-button fg-<?= (isset($kappaUnlocked)) ? 'white' : 'red'; ?>" onclick="selectGate(this, 7);"><?= (isset($kappaUnlocked)) ? '<i class="fa fa-unlock"></i>' : '<i class="fa fa-lock"></i>'; ?> Kappa gate</div>
<div data-gate="gate-kronos" class="gg-gate-button kronos-button fg-<?= (isset($kronosUnlocked)) ? 'white' : 'red'; ?>" onclick="selectGate(this, 9);"><?= (isset($kronosUnlocked)) ? '<i class="fa fa-unlock"></i>' : '<i class="fa fa-lock"></i>'; ?> Kronos gate</div>
<div data-gate="gate-lambda" class="gg-gate-button lambda-button fg-<?= (isset($lambdaUnlocked)) ? 'white' : 'red'; ?>" onclick="selectGate(this, 8);"><?= (isset($lambdaUnlocked)) ? '<i class="fa fa-unlock"></i>' : '<i class="fa fa-lock"></i>'; ?> Lambda gate</div>



</div>

<div style="float:left; width:360px; height:425px; border-right:1px solid rgba(200,200,200,0.1); padding-top:10px; padding-left:5px; padding-right:5px;">

<div id="gate-alpha" class="contentC" style="width: 330px; height: 272px; margin-left: 8px; position: absolute; border: 3px solid gray; border-radius: 5px; display: none; background: url(&quot;../public/img/galaxyGates/alpha/bg.jpg&quot;) no-repeat; style="width: 100px; height: 100px;"">
    <div id="gate-alpha.img" style="width: 235px; height: 290px; margin-top: -12px; margin-left: 35px;">
        <div style="bottom:0px; position:absolute; right:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-alpha-parts"><?= $alphaParts; ?></div>
        <div style="display:none;bottom:0px; position:absolute; left:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-alpha-lives">Life(s): -1/3</div>
    </div>
</div>

<div id="gate-beta" class="contentC" style="width: 330px; height: 272px; margin-left: 8px; position: absolute; border: 3px solid gray; border-radius: 5px; display: none; background: url(&quot;../public/img/galaxyGates/beta/bg.jpg&quot;) no-repeat; style="width: 100px; height: 100px;"">
    <div id="gate-beta-img" style="width: 235px; height: 290px; margin-top: -12px; margin-left: 35px;">
        <div style="bottom:0px; position:absolute; right:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-beta-parts"><?= $betaParts; ?></div>
        <div style="display:none;bottom:0px; position:absolute; left:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-beta-lives">Life(s): -1/3</div>
    </div>
</div>

<div id="gate-gamma" class="contentC" style="width: 330px; height: 272px; margin-left: 8px; position: absolute; border: 3px solid gray; border-radius: 5px; display: none; background: url(&quot;../public/img/galaxyGates/gamma/bg.jpg&quot;) no-repeat; ">
    <div id="gate-gamma-img" style="width: 235px; height: 290px; margin-top: -12px; margin-left: 35px; ">
        <div style="bottom:0px; position:absolute; right:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-gamma-parts"><?= $gammaParts; ?></div>
        <div style="display:none;bottom:0px; position:absolute; left:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-gamma-lives">Life(s): -1/3</div>
    </div>
</div>

<div id="gate-delta" class="contentC" style="width: 330px; height: 272px; margin-left: 8px; position: absolute; border: 3px solid gray; border-radius: 5px; display: none; background: url(&quot;../public/img/galaxyGates/delta/bg.jpg&quot;) no-repeat; ">
    <div id="gate-delta-img" style="width: 235px; height: 290px; margin-top: -12px; margin-left: 35px; ">
        <div style="bottom:0px; position:absolute; right:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-delta-parts"><?= $deltaParts; ?></div>
        <div style="display:none;bottom:0px; position:absolute; left:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-delta-lives">Life(s): -1/3</div>
    </div>
</div>

<div id="gate-kappa" class="contentC" style="width: 330px; height: 272px; margin-left: 8px; position: absolute; border: 3px solid gray; border-radius: 5px; display: none; background: url(&quot;../public/img/galaxyGates/kappa/bg.jpg&quot;) no-repeat; ">
    <div id="gate-kappa-img" style="width: 235px; height: 290px; margin-top: -12px; margin-left: 35px; ">
        <div style="bottom:0px; position:absolute; right:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-kappa-parts"><?= $kappaParts; ?></div>
        <div style="display:none;bottom:0px; position:absolute; left:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-kappa-lives">Life(s): -1/3</div>
    </div>
</div>

<div id="gate-kronos" class="contentC" style="width: 330px; height: 272px; margin-left: 8px; position: absolute; border: 3px solid gray; border-radius: 5px; display: none; background: url(&quot;../public/img/galaxyGates/kronos/bg.jpg&quot;) no-repeat; ">
    <div id="gate-kronos-img" style="width: 235px; height: 290px; margin-top: -12px; margin-left: 35px; ">
        <div style="bottom:0px; position:absolute; right:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-kronos-parts"><?= $kronosParts; ?></div>
        <div style="display:none;bottom:0px; position:absolute; left:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-kronos-lives">Life(s): -1/3</div>
    </div>
</div>

<div id="gate-lambda" class="contentC" style="width: 330px; height: 272px; margin-left: 8px; position: absolute; border: 3px solid gray; border-radius: 5px; display: none; background: url(&quot;../public/img/galaxyGates/lambda/bg.jpg&quot;) no-repeat; ">
    <div id="gate-lambda-img" style="width: 235px; height: 290px; margin-top: -12px; margin-left: 35px; ">
        <div style="bottom:0px; position:absolute; right:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-lambda-parts"><?= $lambdaParts; ?></div>
        <div style="display:none;bottom:0px; position:absolute; left:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-lambda-lives">Life(s): -1/3</div>
    </div>
</div>





<center>
<button id="prepare-portal" style="display:none; margin-top:310px;" class="btn btn-success btn-lg" onclick="preparePortal()">Prepare portal</button>
</center>

</div>
<div style="float:right; width:240px;  height:400px;  padding-top:10px; padding-left:5px; padding-right:5px;">
<b>Uridium:</b> <span style="float:right; margin-right:15px;" id="gg-uridium"><?php echo number_format($data->uridium, 0, ',', '.'); ?></span><br>
<div style="display:none;" id="livesDiv"><b>Lives:</b> <span style="float:right; margin-right:15px;" id="gg-lives"><i class="fa fa-heart" aria-hidden="true"></i> -</span></div>
<div class="gg-energy-button" onclick="spin();" style="display:none;"></div>
<div class="gg-live-button" onclick="buyLive();" style="display:none;"></div>


<br>

<style>
#gg_log {
    width:220px;
    height:210px;
    background:rgba(0,0,0,0.2);
    position:relative;
    overflow:hidden;
    margin-top:5px;
}

#scrollable-content {
  height: 100% !important;
  overflow: auto;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
  color:black;
}

</style>

<div id="gg_log">

  <div id="scrollable-content">
    <?php
    $dataLog = $mysqli->query("SELECT * FROM gg_log WHERE userId = '".$player['userId']."' ORDER by id DESC");
    if ($dataLog->num_rows > 0){
        ?>
    <table id="tableGG">
        <thead>
            <tr>
                <th>Log</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while($dataL = $dataLog->fetch_assoc()){
                ?>
                    <tr>
                        <td><?= $dataL['log'] ;?></td>
                        <td><?= date("d-m-Y h:i:s", $dataL['date']); ?></td>
                    </tr>
                <?php
            }
        ?>
        </tbody>
    </table>
        <?php } else { ?>
        <table id="tableGG">
            <thead>
                <tr>
                    <th>Log</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <div style="padding:15px;" id="no_results">
            <div style="border: 1px solid red; border-radius:5px; text-align:center;">No results found.</div></th>
        </div>
        <?php } ?>
  </div>

</div>

</div>
</div>
</div>

<script type="text/javascript">
    function spin(id){
        if (id){

            if (id == -1){
                toast('This gate will be enabled soon');

                return;
            }

            $.ajax({
                type: 'POST',
                url: '<?php echo DOMAIN; ?>api/',
                data: 'gateId='+id+'&action=gg',
                success: function(response) {

                    var json = jQuery.parseJSON(response);

                    if (json.message !== ""){
                        toast(json.message);
                    }

                    if (json.uridium !== ""){
                        $('.user-uridium').html(json.uridium);
                        $('#gg-uridium').html(json.uridium);
                    }

                    if (json.totalParts !== ""){
                        $('#gate-alpha-parts').html(json.totalParts);
                    }

                    if (json.completed == '1'){
                        setTimeout(() => {
                            location.reload();
                        }, 5000);
                    }

                    if (json.lives !== ""){
                        document.getElementById('gg-lives').innerHTML = '<i class="fa fa-heart" aria-hidden="true"></i> '+json.lives;
                    }
                    
                    if (json.log && json.datelog){
                        var table = document.getElementById("tableGG").getElementsByTagName('tbody')[0];

                        var row = table.insertRow(0);

                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);

                        cell1.innerHTML = json.log;
                        cell2.innerHTML = json.datelog;

                        if (document.getElementById('no_results')){
                            document.getElementById('no_results').style.display = 'none';
                        }

                    }

                }
            });
        } else {
            toast('Please select a unlock gate.');
        }
    }
    function selectGate(div, id){

        if (id == -1){
            toast('This gate will be enabled soon');

            return;
        }

        var x = document.getElementsByClassName("gg-gate-button");
        var i;
        for (i = 0; i < x.length; i++) {
            x[i].style.border = null;
        }

        var x = document.getElementsByClassName("contentC");
        var i;
        for (i = 0; i < x.length; i++) {
            x[i].style.display = 'none';
        }

        if (div){
            $(div).css("border", "1px solid white");
            document.getElementById($(div).data('gate')).style.display = 'block';
            document.getElementById('prepare-portal').setAttribute( "onClick", "preparePortal("+id+");" );
            document.getElementById('prepare-portal').style.display = 'block';
        }

        if (div){

            $.ajax({
                type: 'POST',
                url: '<?php echo DOMAIN; ?>api/',
                data: 'gateId='+id+'&action=getInfoGate',
                success: function(response) {
                    var json = jQuery.parseJSON(response);

                    document.getElementsByClassName('gg-energy-button')[0].style.display = 'block';
                    document.getElementsByClassName('gg-energy-button')[0].setAttribute( "onClick", "spin("+id+");" );
                    document.getElementsByClassName('gg-energy-button')[0].innerHTML = '<i class="fa fa-bolt" aria-hidden="true"></i> Energy ('+json.cost+' U)';

                    document.getElementsByClassName('gg-live-button')[0].style.display = 'block';
                    document.getElementsByClassName('gg-live-button')[0].setAttribute( "onClick", "buyLive("+id+");" );
                    document.getElementsByClassName('gg-live-button')[0].innerHTML = '<i class="fa fa-heart" aria-hidden="true"></i> Buy Live ('+json.live_cost+' U)';

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo DOMAIN; ?>api/',
                        data: 'gateId='+id+'&action=getLivesGate',
                        success: function(response) {
                            var json = jQuery.parseJSON(response);

                            if (json.lives !== ""){
                                document.getElementById('livesDiv').style.display = 'block';
                                document.getElementById('gg-lives').innerHTML = '<i class="fa fa-heart" aria-hidden="true"></i> '+json.lives;
                            }

                        }
                    });

                }
            });

        }

    }
    function preparePortal(id){
        if (id){

            if (id == -1){
                toast('This gate will be enabled soon');

                return;
            }

            $.ajax({
                type: 'POST',
                url: '<?php echo DOMAIN; ?>api/',
                data: 'gateId='+id+'&action=ggPreparePortal',
                success: function(response) {
                    console.log(response);var json = jQuery.parseJSON(response);

                    if (json.message !== ""){
                        toast(json.message);
                    }

                    if (json.uridium !== ""){
                        $('.user-uridium').html(json.uridium);
                        $('#gg-uridium').html(json.uridium);
                    }

                    if (json.totalParts !== ""){
                        $('#gate-alpha-parts').html(json.totalParts);
                    }

                }
            });
        } else {
            toast('Please select a unlock gate.');
        }
    }
    function buyLive(id){
        if (id){

            if (id == -1){
                toast('This gate will be enabled soon');

                return;
            }

            $.ajax({
                type: 'POST',
                url: '<?php echo DOMAIN; ?>api/',
                data: 'gateId='+id+'&action=buyLive',
                success: function(response) {

                    var json = jQuery.parseJSON(response);

                    if (json.message !== ""){
                        toast(json.message);
                    }

                    if (json.uridium !== ""){
                        $('.user-uridium').html(json.uridium);
                        $('#gg-uridium').html(json.uridium);
                    }

                    if (json.lives !== ""){
                        document.getElementById('gg-lives').innerHTML = '<i class="fa fa-heart" aria-hidden="true"></i> '+json.lives;
                    }
                    
                    if (json.log && json.datelog){
                        var table = document.getElementById("tableGG").getElementsByTagName('tbody')[0];

                        var row = table.insertRow(0);

                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);

                        cell1.innerHTML = json.log;
                        cell2.innerHTML = json.datelog;

                        if (document.getElementById('no_results')){
                            document.getElementById('no_results').style.display = 'none';
                        }
                        
                    }

                }
            });
        } else {
            toast('Please select a unlock gate.');
        }
    }
</script>


<?php require_once(INCLUDES . 'footer.php'); ?>