<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/public/css/style-gg3hg.css" />

<?php require_once(INCLUDES . 'data.php'); ?>
<div class="page galaxyGates">
<div class="noSelect galaxyGates-container">
<div class="gg-container">
<div id="messagebox" style="display:none; position:absolute; text-align:center; width:768px; height:400px; border:1px solid black; background:rgba(0,0,0,0.9); z-index:100;">
</div>


<?php
$userId = $player['userId'];

// Helper function to get gate data
function getGateProgress($mysqli, $userId, $gateId, $maxParts) {
    $gateTP = 0;
    $requireGateParts = 0;
    $gateUnlocked = false;

    $stmtPlayerGate = $mysqli->prepare("SELECT parts FROM player_galaxygates WHERE userId = ? AND gateId = ?");
    $stmtPlayerGate->bind_param("ii", $userId, $gateId);
    $stmtPlayerGate->execute();
    $resultPlayerGate = $stmtPlayerGate->get_result();

    if ($resultPlayerGate->num_rows > 0) {
        $fetchGateQ = $resultPlayerGate->fetch_assoc();
        $dataParts = json_decode($fetchGateQ['parts']);
        if (is_array($dataParts)) {
            foreach ($dataParts as $part) {
                $gateTP += (int)$part;
            }
        }
        if ($gateTP >= $maxParts) {
            $gateTP = $maxParts;
            $gateUnlocked = true;
        }
    }
    $stmtPlayerGate->close();

    $stmtInfoGate = $mysqli->prepare("SELECT parts FROM info_galaxygates WHERE gateId = ?");
    $stmtInfoGate->bind_param("i", $gateId);
    $stmtInfoGate->execute();
    $resultInfoGate = $stmtInfoGate->get_result();

    if ($resultInfoGate->num_rows > 0) {
        $fetchInfoGate = $resultInfoGate->fetch_assoc();
        $requireGateParts = (int)$fetchInfoGate['parts'];
    }
    $stmtInfoGate->close();

    return ["parts" => $gateTP . "/" . $requireGateParts, "unlocked" => $gateUnlocked];
}

$alphaData = getGateProgress($mysqli, $userId, 1, 34);
$alphaParts = $alphaData['parts'];
$alphaUnlocked = $alphaData['unlocked'];

$betaData = getGateProgress($mysqli, $userId, 2, 48);
$betaParts = $betaData['parts'];
$betaUnlocked = $betaData['unlocked'];

$gammaData = getGateProgress($mysqli, $userId, 3, 82);
$gammaParts = $gammaData['parts'];
$gammaUnlocked = $gammaData['unlocked'];

$deltaData = getGateProgress($mysqli, $userId, 4, 128);
$deltaParts = $deltaData['parts'];
$deltaUnlocked = $deltaData['unlocked'];

$epsilonData = getGateProgress($mysqli, $userId, 5, 99);
$epsilonParts = $epsilonData['parts'];
$epsilonUnlocked = $epsilonData['unlocked'];

$lambdaData = getGateProgress($mysqli, $userId, 8, 45);
$lambdaParts = $lambdaData['parts'];
$lambdaUnlocked = $lambdaData['unlocked'];

$kappaData = getGateProgress($mysqli, $userId, 7, 120);
$kappaParts = $kappaData['parts'];
$kappaUnlocked = $kappaData['unlocked'];

$hadesData = getGateProgress($mysqli, $userId, 10, 45);
$hadesParts = $hadesData['parts'];
$hadesUnlocked = $hadesData['unlocked'];

$kronosData = getGateProgress($mysqli, $userId, 9, 120);
$kronosParts = $kronosData['parts'];
$kronosUnlocked = $kronosData['unlocked'];

?>

<div style="float:left; width:150px; height:425px; border-right:1px solid #5cb85c; padding-top:10px; padding-left:5px; padding-right:10px;">
<div style="text-align:center; padding-bottom:5px;"><b>AVAILABLE GATES</b></div>
<div data-gate="gate-alpha" class="gg-gate-button alpha-button fg-<?= ($alphaUnlocked) ? 'white' : 'red'; ?>" onclick="selectGate(this, 1);"><?= ($alphaUnlocked) ? '<i class="fa fa-unlock"></i>' : '<i class="fa fa-lock"></i>'; ?> Alpha gate</div>
<div data-gate="gate-beta" class="gg-gate-button beta-button fg-<?= ($betaUnlocked) ? 'white' : 'red'; ?>" onclick="selectGate(this, 2);"><?= ($betaUnlocked) ? '<i class="fa fa-unlock"></i>' : '<i class="fa fa-lock"></i>'; ?> Beta gate</div>
<div data-gate="gate-gamma" class="gg-gate-button gamma-button fg-<?= ($gammaUnlocked) ? 'white' : 'red'; ?>" onclick="selectGate(this, 3);"><?= ($gammaUnlocked) ? '<i class="fa fa-unlock"></i>' : '<i class="fa fa-lock"></i>'; ?> Gamma gate</div>
<div data-gate="gate-delta" class="gg-gate-button delta-button fg-<?= ($deltaUnlocked) ? 'white' : 'red'; ?>" onclick="selectGate(this, 4);"><?= ($deltaUnlocked) ? '<i class="fa fa-unlock"></i>' : '<i class="fa fa-lock"></i>'; ?> Delta gate</div>
<div data-gate="gate-kappa" class="gg-gate-button kappa-button fg-<?= ($kappaUnlocked) ? 'white' : 'red'; ?>" onclick="selectGate(this, 7);"><?= ($kappaUnlocked) ? '<i class="fa fa-unlock"></i>' : '<i class="fa fa-lock"></i>'; ?> Kappa gate</div>
<div data-gate="gate-kronos" class="gg-gate-button kronos-button fg-<?= ($kronosUnlocked) ? 'white' : 'red'; ?>" onclick="selectGate(this, 9);"><?= ($kronosUnlocked) ? '<i class="fa fa-unlock"></i>' : '<i class="fa fa-lock"></i>'; ?> Kronos gate</div>
<div data-gate="gate-lambda" class="gg-gate-button lambda-button fg-<?= ($lambdaUnlocked) ? 'white' : 'red'; ?>" onclick="selectGate(this, 8);"><?= ($lambdaUnlocked) ? '<i class="fa fa-unlock"></i>' : '<i class="fa fa-lock"></i>'; ?> Lambda gate</div>



</div>

<div style="float:left; width:360px; height:425px; border-right:1px solid rgba(200,200,200,0.1); padding-top:10px; padding-left:5px; padding-right:5px;">

<div id="gate-alpha" class="contentC" style="width: 330px; height: 272px; margin-left: 8px; position: absolute; border: 3px solid gray; border-radius: 5px; display: none; background: url(&quot;../public/img/galaxyGates/alpha/bg.jpg&quot;) no-repeat; style="width: 100px; height: 100px;"">
    <div id="gate-alpha.img" style="width: 235px; height: 290px; margin-top: -12px; margin-left: 35px;">
        <div style="bottom:0px; position:absolute; right:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-alpha-parts"><?= htmlspecialchars($alphaParts, ENT_QUOTES, 'UTF-8'); ?></div>
        <div style="display:none;bottom:0px; position:absolute; left:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-alpha-lives">Life(s): -1/3</div>
    </div>
</div>

<div id="gate-beta" class="contentC" style="width: 330px; height: 272px; margin-left: 8px; position: absolute; border: 3px solid gray; border-radius: 5px; display: none; background: url(&quot;../public/img/galaxyGates/beta/bg.jpg&quot;) no-repeat; style="width: 100px; height: 100px;"">
    <div id="gate-beta-img" style="width: 235px; height: 290px; margin-top: -12px; margin-left: 35px;">
        <div style="bottom:0px; position:absolute; right:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-beta-parts"><?= htmlspecialchars($betaParts, ENT_QUOTES, 'UTF-8'); ?></div>
        <div style="display:none;bottom:0px; position:absolute; left:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-beta-lives">Life(s): -1/3</div>
    </div>
</div>

<div id="gate-gamma" class="contentC" style="width: 330px; height: 272px; margin-left: 8px; position: absolute; border: 3px solid gray; border-radius: 5px; display: none; background: url(&quot;../public/img/galaxyGates/gamma/bg.jpg&quot;) no-repeat; ">
    <div id="gate-gamma-img" style="width: 235px; height: 290px; margin-top: -12px; margin-left: 35px; ">
        <div style="bottom:0px; position:absolute; right:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-gamma-parts"><?= htmlspecialchars($gammaParts, ENT_QUOTES, 'UTF-8'); ?></div>
        <div style="display:none;bottom:0px; position:absolute; left:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-gamma-lives">Life(s): -1/3</div>
    </div>
</div>

<div id="gate-delta" class="contentC" style="width: 330px; height: 272px; margin-left: 8px; position: absolute; border: 3px solid gray; border-radius: 5px; display: none; background: url(&quot;../public/img/galaxyGates/delta/bg.jpg&quot;) no-repeat; ">
    <div id="gate-delta-img" style="width: 235px; height: 290px; margin-top: -12px; margin-left: 35px; ">
        <div style="bottom:0px; position:absolute; right:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-delta-parts"><?= htmlspecialchars($deltaParts, ENT_QUOTES, 'UTF-8'); ?></div>
        <div style="display:none;bottom:0px; position:absolute; left:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-delta-lives">Life(s): -1/3</div>
    </div>
</div>

<div id="gate-kappa" class="contentC" style="width: 330px; height: 272px; margin-left: 8px; position: absolute; border: 3px solid gray; border-radius: 5px; display: none; background: url(&quot;../public/img/galaxyGates/kappa/bg.jpg&quot;) no-repeat; ">
    <div id="gate-kappa-img" style="width: 235px; height: 290px; margin-top: -12px; margin-left: 35px; ">
        <div style="bottom:0px; position:absolute; right:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-kappa-parts"><?= htmlspecialchars($kappaParts, ENT_QUOTES, 'UTF-8'); ?></div>
        <div style="display:none;bottom:0px; position:absolute; left:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-kappa-lives">Life(s): -1/3</div>
    </div>
</div>

<div id="gate-kronos" class="contentC" style="width: 330px; height: 272px; margin-left: 8px; position: absolute; border: 3px solid gray; border-radius: 5px; display: none; background: url(&quot;../public/img/galaxyGates/kronos/bg.jpg&quot;) no-repeat; ">
    <div id="gate-kronos-img" style="width: 235px; height: 290px; margin-top: -12px; margin-left: 35px; ">
        <div style="bottom:0px; position:absolute; right:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-kronos-parts"><?= htmlspecialchars($kronosParts, ENT_QUOTES, 'UTF-8'); ?></div>
        <div style="display:none;bottom:0px; position:absolute; left:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-kronos-lives">Life(s): -1/3</div>
    </div>
</div>

<div id="gate-lambda" class="contentC" style="width: 330px; height: 272px; margin-left: 8px; position: absolute; border: 3px solid gray; border-radius: 5px; display: none; background: url(&quot;../public/img/galaxyGates/lambda/bg.jpg&quot;) no-repeat; ">
    <div id="gate-lambda-img" style="width: 235px; height: 290px; margin-top: -12px; margin-left: 35px; ">
        <div style="bottom:0px; position:absolute; right:0px; font-size:20px; background:rgba(0,30,50,0.5); width:90px; text-align:center;" id="gate-lambda-parts"><?= htmlspecialchars($lambdaParts, ENT_QUOTES, 'UTF-8'); ?></div>
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
    $stmt_log = $mysqli->prepare("SELECT log, date FROM gg_log WHERE userId = ? ORDER by id DESC");
    $stmt_log->bind_param("i", $userId);
    $stmt_log->execute();
    $dataLog = $stmt_log->get_result();

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
                        <td><?= htmlspecialchars($dataL['log'], ENT_QUOTES, 'UTF-8') ;?></td>
                        <td><?= htmlspecialchars(date("d-m-Y h:i:s", $dataL['date']), ENT_QUOTES, 'UTF-8'); ?></td>
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
        <?php } $stmt_log->close(); ?>
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