<?php
$stmt_open_apps = $mysqli->prepare('SELECT * FROM server_clan_diplomacy_applications WHERE senderClanId = ?');
$stmt_open_apps->bind_param("i", $player['clanId']);
$stmt_open_apps->execute();
$result_open_apps = $stmt_open_apps->get_result();
$openApplications = $result_open_apps->fetch_all(MYSQLI_ASSOC);
$stmt_open_apps->close();
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
      <?php
      $stmt_diplomacy = $mysqli->prepare('SELECT * FROM server_clan_diplomacy WHERE toClanId = ? OR senderClanId = ?');
      $stmt_diplomacy->bind_param("ii", $player['clanId'], $player['clanId']);
      $stmt_diplomacy->execute();
      $result_diplomacy = $stmt_diplomacy->get_result();
      $existing_diplomacies = $result_diplomacy->fetch_all(MYSQLI_ASSOC);
      $stmt_diplomacy->close();

      $stmt_clan_name = $mysqli->prepare('SELECT name FROM server_clans WHERE id = ?');

      foreach ($existing_diplomacies as $value) {
        $clanId = ($player['clanId'] == $value['senderClanId'] ? $value['toClanId'] : $value['senderClanId'] );

        $clanName = "Unknown";
        $stmt_clan_name->bind_param("i", $clanId);
        $stmt_clan_name->execute();
        $result_clan_name = $stmt_clan_name->get_result();
        if($row_clan_name = $result_clan_name->fetch_assoc()){
            $clanName = $row_clan_name['name'];
        }
        // $result_clan_name->close(); // Not needed for get_result
      ?>
<div style="width:748px; background:rgba(20,20,20,0.3);">
<span style="display:inline-block; padding-left:20px; width:240px;"> <?php echo htmlspecialchars($clanName, ENT_QUOTES, 'UTF-8'); ?></span>
<span style="display:inline-block; text-align:center; width:100px;"><?php echo ($value['diplomacyType'] == 1 ? 'Alliance' : ($value['diplomacyType'] == 2 ? 'NAP' : 'War')); ?></span>
<span style="display:inline-block; text-align:center; width:200px;"><?php echo htmlspecialchars(date('d.m.Y', strtotime($value['date'])), ENT_QUOTES, 'UTF-8'); ?></span>
<span style="display:inline-block; text-align:center; width:120px; float:right; padding-right:20px;">
  
  <?php if ($value['diplomacyType'] == 3) { ?>
    <a onclick="$('#clan-diplomacy-abort').css('display', 'block');  $('.clanId').val(<?php echo (int)$clanId; ?>); $('.tyPe').val(4);" style="cursor:pointer;"><b>Abort War</b></a>
	<?php } else if ($value['diplomacyType'] == 1) { ?>
		<!--<a data-diplomacy-id="<?php echo (int)$value['id']; ?>" class="cancel-request" style="cursor:pointer;"><b>CANCEL</b></a>-->
    <a onclick="$('#clan-diplomacy-abort').css('display', 'block');  $('.clanId').val(<?php echo (int)$clanId; ?>); $('.tyPe').val(5);" style="cursor:pointer;"><b>Cancel Alliance</b></a>
	<?php } else if ($value['diplomacyType'] == 2) { ?>
    <a onclick="$('#clan-diplomacy-abort').css('display', 'block');  $('.clanId').val(<?php echo (int)$clanId; ?>); $('.tyPe').val(6);" style="cursor:pointer;"><b>Cancel NAP</b></a>
	<?php } ?>

</span>
</div>

 <?php } $stmt_clan_name->close(); ?>
</div>
<div style="background:rgba(100,100,100,0.5); width:748px; padding-left:20px;  height:30px; line-height:30px;">Requests</div>
<div id="clan-diplomacy-requests" style="position:relative; height:170px; overflow:auto;" class="ps-container" data-ps-id="655958ba-dd14-7d8f-218b-7068e5515094">
  <?php
  $stmt_apps = $mysqli->prepare('SELECT * FROM server_clan_diplomacy_applications WHERE toClanId = ?');
  $stmt_apps->bind_param("i", $player['clanId']);
  $stmt_apps->execute();
  $result_apps = $stmt_apps->get_result();
  $incoming_applications = $result_apps->fetch_all(MYSQLI_ASSOC);
  $stmt_apps->close();

  $stmt_req_clan_name = $mysqli->prepare('SELECT name FROM server_clans WHERE id = ?');

  foreach ($incoming_applications as $value) {
      $requestClanName = "Unknown";
      $stmt_req_clan_name->bind_param("i", $value['senderClanId']);
      $stmt_req_clan_name->execute();
      $result_req_clan_name = $stmt_req_clan_name->get_result();
      if($row_req_clan_name = $result_req_clan_name->fetch_assoc()){
          $requestClanName = $row_req_clan_name['name'];
      }
      // $result_req_clan_name->close(); // Not needed for get_result

      $diplomacyType = ($value['diplomacyType'] == 1 ? 'Alliance' : ($value['diplomacyType'] == 2 ? 'NAP' : ($value['diplomacyType'] == 3 ? 'War' : ($value['diplomacyType'] == 4 ? 'End War' : ($value['diplomacyType'] == 5 ? 'End Alliance' : ($value['diplomacyType'] == 6 ? 'End NAP' : ''))))));
    ?>
<div style="width:748px; background:rgba(20,20,20,0.3); padding: 10px; border-bottom:1px solid white;">
<span style="display:inline-block; padding-left:20px; width:240px;"><?php echo htmlspecialchars($requestClanName, ENT_QUOTES, 'UTF-8'); ?></span>
<span style="display:inline-block; text-align:center; width:100px;"><?php echo htmlspecialchars($diplomacyType, ENT_QUOTES, 'UTF-8'); ?></span>
<span style="display:inline-block; text-align:center; width:200px;"><?php echo htmlspecialchars(date('d.m.Y', strtotime($value['date'])), ENT_QUOTES, 'UTF-8'); ?></span>
<span style="display:inline-block; text-align:center; float:right; padding-right:20px;">
<a onclick="accept_request_diplomacy(<?php echo (int)$value['id']; ?>);" style="cursor:pointer;"><b>ACCEPT</b></a> / <a onclick="denied_request_diplomacy(<?php echo (int)$value['id']; ?>);" style="cursor:pointer;"><b>DENIED</b></a>
</span>
<?php if (!empty($value['message'])){ ?>
<div style="text-align:center; padding-top: 10px; padding-bottom:10px;"><span style="font-weight:bold;">Message:</span></div>
<div style="padding-top:5px; border: 1px solid white; border-radius: 15px; padding:5px; width:98% !important;"><?= htmlspecialchars($value['message'], ENT_QUOTES, 'UTF-8'); ?></div>
<?php } ?>
</div>

<?php } $stmt_req_clan_name->close(); ?>

</div>
<div style="width:748px; padding-top:10px; border-top:1px solid lightgray; position:absolute; text-align:center;">

    <form id="diplomacy-request" method="post">
      <input type="hidden" name="subAction" value="sendDiplomacy">
      <b>Clan:</b>
      <select name="clanId" style="color:black; width:250px; max-width:250px; font-size:12px;">
      <?php
        $dataClans = Functions::getAllClans(); // Assuming this function is safe or handled
        if ($dataClans){ // Functions::getAllClans() now returns array or false
          foreach($dataClans as $dc){ // Iterate as array
            if ($dc['leaderId'] != $player['userId']){
      ?>
      <option value="<?= htmlspecialchars($dc['id'], ENT_QUOTES, 'UTF-8'); ?>">[<?= htmlspecialchars($dc['tag'], ENT_QUOTES, 'UTF-8'); ?>] <?= htmlspecialchars($dc['name'], ENT_QUOTES, 'UTF-8'); ?></option>
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
