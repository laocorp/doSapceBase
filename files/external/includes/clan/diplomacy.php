<?php
$openApplications = $mysqli->query('SELECT * FROM server_clan_diplomacy_applications WHERE senderClanId = '.$player['clanId'].'')->fetch_all(MYSQLI_ASSOC);
?>


<link rel="stylesheet" href="/public/css/menber.css" />

<div class="page clan styleUpdate" style="border: 0px; border-bottom: 3px solid #ffc300 !important;margin-top:60px;">
<div class="clan-container">

<div id="clan-message" style="z-index:105; width:500px; height:200px; background:rgba(10,10,10,0.98); position:absolute; margin-left:200px; margin-top:120px; border:1px solid gray; display:none;">
<span style="dispay:inline-block; width:32px; height:32px; font-size:24px; background:gray; float:right; text-align:center; cursor:pointer;" onclick="$('#clan-message').css('display', 'none'); setTimeout(function(){ location.reload(); }, 0000);">X</span>
<div style="font-size:24px; padding-top:5px;" id="infosClanMessage">
<center>
<i style="font-size:64px;" class="fa fa-spin fa-cog"></i><br>
<span style="font-size:32px;">Please wait...</span>
</center>
</div>
<br>
<div>
<center>
<a onclick="$('#clan-message').css('display', 'none'); setTimeout(function(){ location.reload(); }, 0000);" class="btn btn-default">Ok</a>
</center>
</div>
</div>

<div class="clan-infos">
<div class="left-menu">

<a href="/clan/join" class="clan-button ">Infos</a>
<a href="/clan/members" class="clan-button  ">Members</a>
<a href="/clan/diplomacy" class="clan-button clan-button-active ">Diplomacy</a>
</div>

<div id="clan-diplomacy-abort" style="z-index:105; display:none; width:500px; height:190px;" class="clan-window">
<div id="infos-loader" style="margin-top: 0px !important; margin-left:0px !important;">
<div style="margin-top:150px;"></div>
<center>
<i style="font-size:64px;" class="fa fa-spin fa-cog"></i><br>
<span style="font-size:32px;">Please wait...</span>
</center>
</div>
<span style="dispay:inline-block; width:32px; height:32px; font-size:24px; background:gray; float:right; text-align:center; cursor:pointer;" onclick="$('#clan-diplomacy-abort').css('display', 'none'); setTimeout(function(){ location.reload(); }, 0000);">X</span>
<div style="padding-left:30px; padding-right:30px; padding-top:20px;">
<b>Message:</b><br>
<center>
<form method="post" id="formAbotDiplomacy">
<input type="hidden" name="clanId" class="clanId">
<input type="hidden" name="tyPe" class="tyPe">
<textarea name="message" style="width:440px; height:70px; background:rgba(50,50,50,0.9); resize:none;"></textarea>
<b style="color:red;">Do you really want to abort the war?</b>
<br>
<button type="submit" class="btn btn-lg btn-success">Yes</button>
</form>
</center>
</div>
</div>

<div id="clan-diplomacy" style="z-index:105; width:500px; height:180px; margin-top:155px;" class="clan-window ps-container" data-ps-id="ee809fa6-b361-dcd4-c3c2-1d881ee24ff4">
<span style="dispay:inline-block; width:32px; height:32px; font-size:24px; background:gray; float:right; text-align:center; cursor:pointer;" onclick="$('#clan-diplomacy').css('display', 'none');">X</span>


<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
<div style="width:748px; background:rgba(100,100,100,0.5);">
<span style="display:inline-block; padding-left:20px; width:240px;">Clan</span>
<span style="display:inline-block; text-align:center; width:100px;">Type</span>
<span style="display:inline-block; text-align:center; width:200px;">Started</span>
<span style="display:inline-block; text-align:center; width:120px; float:right; padding-right:20px;">Action</span>
</div>
<div id="clan-diplomacy" style="position:relative; height:240px; overflow:auto;" class="ps-container">
      <?php foreach ($mysqli->query('SELECT * FROM server_clan_diplomacy WHERE toClanId = '.$player['clanId'].' OR senderClanId = '.$player['clanId'].'')->fetch_all(MYSQLI_ASSOC) as $value) {
        $clanId = ($player['clanId'] == $value['senderClanId'] ? $value['toClanId'] : $value['senderClanId'] );
        $clanName = $mysqli->query('SELECT name FROM server_clans WHERE id = '.$clanId.'')->fetch_assoc()['name'];
      ?>
<div style="width:748px; background:rgba(20,20,20,0.3);">
<span style="display:inline-block; padding-left:20px; width:240px;"> <?php echo $clanName; ?></span>
<span style="display:inline-block; text-align:center; width:100px;"><?php echo ($value['diplomacyType'] == 1 ? 'Alliance' : ($value['diplomacyType'] == 2 ? 'NAP' : 'War')); ?></span>
<span style="display:inline-block; text-align:center; width:200px;"><?php echo date('d.m.Y', strtotime($value['date'])); ?></span>
<span style="display:inline-block; text-align:center; width:120px; float:right; padding-right:20px;">
  
  <?php if ($value['diplomacyType'] == 3) { ?>
    <a onclick="$('#clan-diplomacy-abort').css('display', 'block');  $('.clanId').val(<?php echo $clanId; ?>); $('.tyPe').val(4);" style="cursor:pointer;"><b>Abort War</b></a>
	<?php } else if ($value['diplomacyType'] == 1) { ?>
		<!--<a data-diplomacy-id="<?php echo $value['id']; ?>" class="cancel-request" style="cursor:pointer;"><b>CANCEL</b></a>-->
    <a onclick="$('#clan-diplomacy-abort').css('display', 'block');  $('.clanId').val(<?php echo $clanId; ?>); $('.tyPe').val(5);" style="cursor:pointer;"><b>Cancel Alliance</b></a>
	<?php } else if ($value['diplomacyType'] == 2) { ?>
    <a onclick="$('#clan-diplomacy-abort').css('display', 'block');  $('.clanId').val(<?php echo $clanId; ?>); $('.tyPe').val(6);" style="cursor:pointer;"><b>Cancel NAP</b></a>
	<?php } ?>

</span>
</div>

 <?php } ?>
</div>
<div style="background:rgba(100,100,100,0.5); width:748px; padding-left:20px;  height:30px; line-height:30px;">Requests</div>
<div id="clan-diplomacy-requests" style="position:relative; height:170px; overflow:auto;" class="ps-container" data-ps-id="655958ba-dd14-7d8f-218b-7068e5515094">
  <?php foreach ($mysqli->query('SELECT * FROM server_clan_diplomacy_applications WHERE toClanId = '.$player['clanId'].'')->fetch_all(MYSQLI_ASSOC) as $value) {
          $requestClanName = $mysqli->query('SELECT name FROM server_clans WHERE id = '.$value['senderClanId'].'')->fetch_assoc()['name'];
          $diplomacyType = ($value['diplomacyType'] == 1 ? 'Alliance' : ($value['diplomacyType'] == 2 ? 'NAP' : ($value['diplomacyType'] == 3 ? 'War' : ($value['diplomacyType'] == 4 ? 'End War' : ($value['diplomacyType'] == 5 ? 'End Alliance' : ($value['diplomacyType'] == 6 ? 'End NAP' : ''))))));
        ?>
<div style="width:748px; background:rgba(20,20,20,0.3); padding: 10px; border-bottom:1px solid white;">
<span style="display:inline-block; padding-left:20px; width:240px;"><?php echo $requestClanName; ?></span>
<span style="display:inline-block; text-align:center; width:100px;"><?php echo $diplomacyType; ?></span>
<span style="display:inline-block; text-align:center; width:200px;"><?php echo date('d.m.Y', strtotime($value['date'])); ?></span>
<span style="display:inline-block; text-align:center; float:right; padding-right:20px;">
<a onclick="accept_request_diplomacy(<?php echo $value['id']; ?>);" style="cursor:pointer;"><b>ACCEPT</b></a> / <a onclick="denied_request_diplomacy(<?php echo $value['id']; ?>);" style="cursor:pointer;"><b>DENIED</b></a>
</span>
<?php if (!empty($value['message'])){ ?>
<div style="text-align:center; padding-top: 10px; padding-bottom:10px;"><span style="font-weight:bold;">Message:</span></div>
<div style="padding-top:5px; border: 1px solid white; border-radius: 15px; padding:5px; width:98% !important;"><?= $value['message']; ?></div>
<?php } ?>
</div>

<?php } ?>

</div>
<div style="width:748px; padding-top:10px; border-top:1px solid lightgray; position:absolute; text-align:center;">

    <form id="diplomacy-request" method="post">
      <input type="hidden" name="subAction" value="sendDiplomacy">
      <b>Clan:</b>
      <select name="clanId" style="color:black; width:250px; max-width:250px; font-size:12px;">
      <?php
        $dataClans = Functions::getAllClans();
        if ($dataClans->num_rows > 0){
          while($dc = $dataClans->fetch_assoc()){
            if ($dc['leaderId'] != $player['userId']){
      ?>
      <option value="<?= $dc['id']; ?>">[<?= $dc['tag']; ?>] <?= $dc['name']; ?></option>
      <?php } } } ?>
      </select>
      <select name="diplomacyType" style="color:black; width:90px; font-size:12px;">
      <option value="1" style="color:green">Alliance</option>
      <option value="2" style="color:orange">NAP</option>
      <option value="3" style="color:red">War</option>
      </select>
      <div onclick="$('#diplomacy-request').submit()" style="width:120px; display:inline-block; height:25px; background:rgba(100,100,100,0.5); text-align:center; line-height:25px; cursor:pointer;">Send request</div>
    </form>
	
</div>
 
</div>
</div>
</div>
