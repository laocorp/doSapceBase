<?php
if (!self::checkIsAdmin($player['userId'])){ header("Location: /"); return; }
require_once(INCLUDES . 'header.php');
$category = Functions::getAdminCategories();
$player = Functions::GetPlayer();
?>
<link rel="stylesheet" href="/public/css/shopupdate.css">
<style>
.toast {
    border-radius: 2px;
    top: -35px;
    float: right;
    width: auto;
    margin-top: -100px;
    position: relative;
    max-width: 25%;
    height: auto;
    min-height: 88px;
    line-height: 1.5em;
    background-color: #323232;
    padding: 10px 25px;
    font-size: 2.1rem;
    font-weight: 500;
    color: #fff;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    cursor: default;
}
</style>
<?php require_once(INCLUDES . 'data.php'); ?>
<div class="page shop">
<div class="shop-container styleUpdate" style="border: 0px; border-bottom: 3px solid #ffc300 !important;">
<div class="loader">
<div class="content"></div>
</div>
<div class="nav-left">

<?php foreach ($category as $value) { ?>
<a  class="ammo-button" onclick="menuContent('<?php echo $value['category']; ?>')" style = 'text-transform: uppercase;'><?php echo $value['category']; ?></a>	
<?php } ?>

</div>

<div class="items ps-scrollbar-y ps-container ps-active-y" style = 'overflow: auto; width:837px !important;'>

 <div  class="w3-container w3-border city"><center>
   <h1><blink> <p style="color:#5d5dd8;">Welcome <b><?= $player['username']; ?> to new admin zone.</b></p></blink></h1><br>
   <h2><p style="color:white;">This tool is in beta. So it may contain bugs. In case you find a bug contact me at discord <b>- starorbit#8582</b>.</p><h2>
 </center> </div>
  
<?php foreach ($category as $value) { ?>
<div id="<?php echo $value['category']; ?>" class="<?php echo $value['category']; ?> city" style="display:none">

<div style="margin:auto;font-weight:bold;font-size: x-large;text-align:center;margin-bottom:15px;"><?= $value['category']; ?></div>

<?php if ($value['cc'] == 'events'){ ?>

<div style="border:1px dashed red;margin-bottom:15px;padding:5px;text-align:center;">From this area you can start the events that we have available on the server.</div>

<div id="msgResult" style="border:1px dashed yellow;margin-bottom:15px;padding:5px;text-align:center;display:none;"></div>

<div id="waitDiv" style="border:1px dashed #5d5dd8;height: 400px; padding:25px;display:none;"></div>

<div id="buttonsEvent" style="border:1px dashed #5d5dd8;height: 400px; padding:25px;">

<?php

$getEvents = $mysqli->query("SELECT * FROM manage_events");

if ($getEvents->num_rows > 0){

    while($row = $getEvents->fetch_assoc()){

        ?>
            <a id="event_<?= $row['event']; ?>" onclick="startEvent('<?= $row['event']; ?>');" style="width: 129px;line-height: 50px;color: #fff;text-align:center;font-size: 19px;display: inline-block;height: 50px;transition: all .2s ease-in;font-weight: 600;position: relative;cursor: pointer;margin-top: -2px;background: #5d5dd8; margin-top:5px;"><?= $row['event']; ?></a>
        <?php

    }

}

?>

</div>

<?php } else if ($value['cc'] == 'users' && Functions::checkIsFullAdmin($player['userId'])){ ?>

<div style="border:1px dashed red;margin-bottom:15px;padding:5px;text-align:center;">From this area you can manage the users.</div>

<div id="msgResultUD" style="border:1px dashed yellow;margin-bottom:15px;padding:5px;text-align:center;display:none;"></div>

<div id="waitDiv" style="border:1px dashed #5d5dd8;height: 400px; padding:25px;display:none;"></div>

<div id="buttonsEvent" style="border:1px dashed #5d5dd8;height: 400px; padding:25px; text-align:center;">

<div id="form" style="padding-top: 25px; padding-bottom:25px;">
    <input id="pilotName" type="text" class="white-text" placeholder="Type pilotname or userId or username" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px;"><input type="submit" onclick="searchUser();" value="Search" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;">
</div>

<div id="msgResultU" style="border:1px solid gray; border-radius: 5px; width:100%; height:250px; display:none; overflow-y: scroll;"></div>

</div>

<?php } else if ($value['cc'] == 'items' && Functions::checkIsFullAdmin($player['userId'])){ ?>

<div style="border:1px dashed red;margin-bottom:15px;padding:5px;text-align:center;">From this area you can add items to the users.</div>

<div id="msgResultUD" style="border:1px dashed yellow;margin-bottom:15px;padding:5px;text-align:center;display:none;"></div>

<div id="waitDiv" style="border:1px dashed #5d5dd8;height: 400px; padding:25px;display:none;"></div>

<div id="buttonsEvent" style="border:1px dashed #5d5dd8;height: auto; padding:25px; text-align:center;">

<div style="with:70%; padding:25px;">
    <div class="form-group">
    <label for="username">Username / UserId / PilotName</label>
    <input type="text" class="form-control" id="usernameS" value="" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
    </div>
    <div class="form-group">
    <label for="uridium">Uridium</label>
    <input type="text" class="form-control" id="uridiumS" value="" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
    </div>
    <div class="form-group">
    <label for="credits">Credits</label>
    <input type="text" class="form-control" id="creditsS" value="" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
    </div>
    <div class="form-group">
    <label for="honor">Honor</label>
    <input type="text" class="form-control" id="honorS" value="" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
    </div>
    <div class="form-group">
    <label for="experience">Experience</label>
    <input type="text" class="form-control" id="experienceS" value="" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
    </div>
    <div class="form-group">
    <label for="registeredDate">Event Coins</label>
    <input type="text" class="form-control" id="eventCoinsS" value="" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
    </div>
    <div class="form-group">
    <label for="registeredDate">Ship Design</label>
    <?php
    $dataShips = Functions::getAllShips()
    ?>
    <select class="form-control" id="designS" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;"> 
    <option value="" selected>Select a design.</option>
        <?php
        if ($dataShips && is_array($dataShips)){
            foreach($dataShips as $ships){
            ?>
        <option value="<?= $ships['shipID']; ?>"><?= $ships['lootID']; ?></option>
        <?php } } ?>
    </select>
    </div>
    <button type="button" id="buttonSendItemsToUser" class="btn btn-primary" onclick="sendItemsToUser();">Send</button>
</div>

<div id="msgResultUSE" style="border:1px solid gray; border-radius: 5px; display:none; padding:5px;"></div>

</div>

<?php } else if ($value['cc'] == 'logs' && ($player['userId'] == 1 || $player['userId'] == 656)){ ?>

<div style="border:1px dashed red;margin-bottom:15px;padding:5px;text-align:center;">From this area you can view the logs.</div>

<div id="msgResultUD" style="border:1px dashed yellow;margin-bottom:15px;padding:5px;text-align:center;display:none;"></div>

<div id="waitDiv" style="border:1px dashed #5d5dd8;height: 400px; padding:25px;display:none;"></div>

<div id="buttonsEvent" style="border:1px dashed #5d5dd8;height: 400px; padding:25px; text-align:center;">

<div style="border:1px solid gray; border-radius: 5px; width:100%; height:360px; overflow-y: scroll;">

    <?php 
    $queryLogs = $mysqli->query("SELECT * FROM admin_log ORDER by id DESC");
    if ($queryLogs->num_rows > 0){
    ?>

    <table class="table table-dark">
    <thead>
        <tr>
        <th scope="col" style="text-align:center;">Admin</th>
        <th scope="col" style="text-align:center;">ToUser</th>
        <th scope="col" style="text-align:center;">Log</th>
        <th scope="col" style="text-align:center;">Date</th>
        </tr>
    </thead>
    <tbody>
    <?php while($dataLogs = $queryLogs->fetch_assoc()){ ?>
        <tr>
        <th scope="row"><?= Functions::GetPlayerById($dataLogs['adminId'])['username']; ?> (ID: <?= $dataLogs['adminId']; ?>)</th>
        <td><?= (Functions::GetPlayerById($dataLogs['toUserId'] > 0)) ? Functions::GetPlayerById($dataLogs['toUserId'])['username']." (ID: ".$dataLogs['toUserId'].")" : "WebSite"; ?></td>
        <td><?= $dataLogs['logComplet']; ?></td>
        <td><?= $dataLogs['date']; ?></td>
        </tr>
    <?php } ?>
    </tbody>
    </table>

    <?php
    } else {
        echo "<div style='border: 1px solid yellow; padding:15px; width:60%; text-align:center; margin:15px auto; border-radius: 5px;'>No data available.</div>";
    }
    ?>

</div>

</div>

<?php } else { ?>
    <div style="border:1px dashed red; text-align:center; width:70%; margin:auto; padding:15px;">This zone is protected.</div>
<?php } ?>
</div>
<?php } ?>

<div style="border: 1px dashed red; padding:5px; font-weight:bold; text-align:center; width:70%; margin:15px auto;">** Important ** The system generates a log for each action in this area.</div>
</div>
</div>
</div>
</div>
<?php require_once(INCLUDES . 'footer.php'); ?>
<script>

function menuContent(content) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(content).style.display = "block";  
}

function startEvent(type){

    if (type == ""){ return; }

    document.getElementById("msgResult").style.display = "none";
    document.getElementById("buttonsEvent").style.display = "none";
    document.getElementById("waitDiv").style.display = "block";
    document.getElementById("waitDiv").innerHTML = "<center><img src='https://www.csisuministros.com/frontend/images/waiting.gif' width='120px'></center>";

    $.ajax({
        type: 'POST',
        url: '<?php echo DOMAIN; ?>api/',
        data: 'type='+type+'&action=startEvent',
        success: function(response) {
          var json = jQuery.parseJSON(response);

          if (json.message != ""){
              document.getElementById("msgResult").style.display = "block";
              document.getElementById("msgResult").innerHTML = json.message;
              document.getElementById("waitDiv").style.display = "none";
              document.getElementById("buttonsEvent").style.display = "block";
          }

        }
    });

}

function searchUser(){
    var pilot = $('#pilotName').val();

    if (pilot == ""){ return; }

    document.getElementById("msgResultU").style.display = "none";

    $.ajax({
        type: 'POST',
        url: '<?php echo DOMAIN; ?>api/',
        data: 'pilot='+pilot+'&action=searchUser',
        success: function(response) {
          console.log(response);
          document.getElementById("msgResultU").style.display = "block";
          document.getElementById("msgResultU").innerHTML = response;
        }
    });

}

function saveDataUser(){

    var username = $('#username').val();
    var pilotName = $('#pilotName2').val();
    var uridium = $('#uridium').val();
    var credits = $('#credits').val();
    var honor = $('#honor').val();
    var experience = $('#experience').val();
    var premium = $('#premium').val();
    var userId = $('#userId').val();

    document.getElementById("msgResultUD").style.display = "none";

    $.ajax({
        type: 'POST',
        url: '<?php echo DOMAIN; ?>api/',
        data: 'userId='+userId+'&username='+username+'&pilotName='+pilotName+'&uridium='+uridium+'&credits='+credits+'&honor='+honor+'&experience='+experience+'&premium='+premium+'&action=saveDataUser',
        success: function(response) {
            console.log(response);
            var json = jQuery.parseJSON(response);

            if (json.message != ""){
                document.getElementById("msgResultUD").style.display = "block";
                document.getElementById("msgResultUD").innerHTML = json.message;
            }

        }

    });

}

function sendItemsToUser(){

var username = $('#usernameS').val();
var uridium = $('#uridiumS').val();
var credits = $('#creditsS').val();
var honor = $('#honorS').val();
var experience = $('#experienceS').val();
var eventCoins = $('#eventCoinsS').val();
var design = $('#designS').val();

document.getElementById("msgResultUSE").style.display = "none";

document.getElementById('buttonSendItemsToUser').innerHTML = "Loading Please Wait...";
$('#buttonSendItemsToUser').attr('disabled','disabled');

$.ajax({
    type: 'POST',
    url: '<?php echo DOMAIN; ?>api/',
    data: 'username='+username+'&uridium='+uridium+'&credits='+credits+'&honor='+honor+'&experience='+experience+'&eventCoins='+eventCoins+'&design='+design+'&action=sendItemsToUser',
    success: function(response) {
        var json = jQuery.parseJSON(response);

        if (json.message != ""){
            $('#buttonSendItemsToUser').removeAttr('disabled');
            document.getElementById('buttonSendItemsToUser').innerHTML = "Send";
            document.getElementById("msgResultUSE").style.display = "block";
            document.getElementById("msgResultUSE").innerHTML = json.message;
        }

    }

});

}

</script>