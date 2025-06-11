
<link rel="stylesheet" href="/public/css/menber.css" />
<title><?= htmlspecialchars(SERVERNAME, ENT_QUOTES, 'UTF-8'); ?> - Members</title>

<div class="page clan styleUpdate">
<div class="clan-container">
<div class="clan-infos">

<div class="left-menu">
<a href="/clan/join" class="clan-button ">Infos</a>
<a href="/clan/members" class="clan-button clan-button-active ">Members</a>
<a href="/clan/diplomacy" class="clan-button ">Diplomacy</a>
</div> 


<script type="text/javascript">
	$(function() { 
	//init custom scrollbar
	$('#clan-members').perfectScrollbar();
	$('#clan-applications').perfectScrollbar();
	});
</script>

<div id="clan-resign" style="z-index:105; display:none; width:500px; height:140px; margin-top:85px;" class="clan-window">
<div id="infos-loader" style="margin-top: 0px !important; margin-left:0px !important;">
<div style="margin-top:150px;"></div>
<center>
<i style="font-size:64px;" class="fa fa-spin fa-cog"></i><br>
<span style="font-size:32px;">Please wait...</span>
</center>
</div>
<span style="dispay:inline-block; width:32px; height:32px; font-size:24px; background:gray; float:right; text-align:center; cursor:pointer;" onclick="$('#clan-resign').css('display', 'none'); setTimeout(function(){ location.reload(); }, 0000);">X</span>
<div style="padding-left:30px; padding-right:30px; padding-top:20px;">
<form method="post" id="formNewLeaderClan">
<b style="width:170px; display:inline-block;">Transfer leadership to:</b>
<select name="newLeaderId" style="width:230px; background:gray;">
<?php
$clanMembersForSelect = self::getMembersClan($clan['id']); // Assuming this is safe and returns an array
if (is_array($clanMembersForSelect)) {
    foreach($clanMembersForSelect as $dataMembers) {
        if ($player['userId'] !== $dataMembers['userId']) { ?>
		<option value="<?= htmlspecialchars($dataMembers['userId'], ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($dataMembers['pilotName'], ENT_QUOTES, 'UTF-8'); ?></option>
	<?php   }
    }
} ?>
</select>
<br><br>
<center><button type="submit" class="btn btn-lg btn-default">Transfer</button></center>
</form>
</div>
</div>

<div id="clan-delete" style="z-index:105; display:none; width:500px; height:140px; margin-top:85px;" class="clan-window">
<div id="infos-loader-clan" style="margin-top: 0px !important; margin-left:0px !important;">
<div style="margin-top:150px;"></div>
<center>
<i style="font-size:64px;" class="fa fa-spin fa-cog"></i><br>
<span style="font-size:32px;">Please wait...</span>
</center>
</div>
<span style="dispay:inline-block; width:32px; height:32px; font-size:24px; background:gray; float:right; text-align:center; cursor:pointer;" onclick="$('#clan-delete').css('display', 'none'); setTimeout(function(){ location.reload(); }, 0000);">X</span>
<div style="padding-left:30px; padding-right:30px; padding-top:20px;">
<form method="post" id="formDeleteClan">
<input type="hidden" name="subAction" value="deleteClan">
Do you really want to delete your clan ? This can't be undone.
<br><br>
<center>
<button type="submit" class="btn btn-lg btn-danger">Delete</button>
</center>
</form>
</div>
</div>

<div id="member-delete" style="z-index:105; display:none; width:500px; height:140px; margin-top:85px;" class="clan-window">
<div id="infos-loader-clan2" style="margin-top: 0px !important; margin-left:0px !important;">
<div style="margin-top:150px;"></div>
<center>
<i style="font-size:64px;" class="fa fa-spin fa-cog"></i><br>
<span style="font-size:32px;">Please wait...</span>
</center>
</div>
<span style="dispay:inline-block; width:32px; height:32px; font-size:24px; background:gray; float:right; text-align:center; cursor:pointer;" onclick="$('#clan-delete').css('display', 'none'); setTimeout(function(){ location.reload(); }, 0000);">X</span>
<div style="padding-left:30px; padding-right:30px; padding-top:20px;">
<form method="post" id="formDeleteMember">
<input type="hidden" id="memberId" name="memberId" value="">
Do you really want to delete a <span id="member" style="font-weight: bold;"></span>? This can't be undone.
<br><br>
<center>
<button type="submit" class="btn btn-lg btn-danger">Delete</button>
</center>
</form>
</div>
</div>

<div style="width:748px; background:rgba(100,100,100,0.5);">
<span style="display:inline-block; padding-left:20px; width:190px;">Username</span>
<span style="display:inline-block; text-align:center; width:50px;">Faction</span>
<span style="display:inline-block; text-align:center; width:50px;">Grade</span>
<span style="display:inline-block; text-align:center; width:60px;">Level</span>
<span style="display:inline-block; text-align:center; width:150px;">Experience</span>
<span style="display:inline-block; text-align:center; width:100px;">Action</span>
</div>
<div id="clan-members" style="position:relative; height:280px; overflow:auto;" class="ps-container">
<?php foreach (self::getMembersClan($clan['id']) as $value) { ?>
<div class="col s12" id="memberlista_<?= $value['userId']; ?>">
<div style="width:748px; height:30px; line-height:30px; background:rgba(0,90,140,0.2);">
<span style="display:inline-block; padding-left:20px; width:190px;"><?= htmlspecialchars($value['pilotName'], ENT_QUOTES, 'UTF-8'); ?></span>
<span style="display:inline-block; text-align:center; width:50px;"><img src="/img/companies/logo_<?= ($value['factionId'] == 1 ? 'mmo' : ($value['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png"></span>
<span style="display:inline-block; text-align:center; width:50px;"><img src="<?= htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>img/ranks/rank_<?= htmlspecialchars($value['rankId'], ENT_QUOTES, 'UTF-8'); ?>.png"></span>
<span style="display:inline-block; text-align:center; width:60px;"><?= htmlspecialchars(Functions::GetLevel(json_decode($value['data'], true)['experience']), ENT_QUOTES, 'UTF-8'); ?></span>
<span style="display:inline-block; text-align:center; width:150px;"><?= htmlspecialchars(number_format(json_decode($value['data'])->experience), ENT_QUOTES, 'UTF-8'); ?></span>
<span style="display:inline-block; text-align:center; width:160px;">
<small>

<?php if ($clan['leaderId'] == $player['userId'] && $value['userId'] == $clan['leaderId']) { ?>
	<a style="cursor:pointer;" onclick="$('#clan-resign').css('display', 'block');"><b><i class="fas fa-retweet"></i> Resign</b></a> | <a style="cursor:pointer;" onclick="$('#clan-delete').css('display', 'block');"><b><i class="far fa-trash-alt"></i> Delete Clan</b></a>
<?php } else if ($clan['leaderId'] == $player['userId'] && $value['userId'] != $clan['leaderId']) { ?>
	<a style="cursor:pointer;" onclick="$('#member-delete').css('display', 'block'); document.getElementById('memberId').value = '<?= htmlspecialchars($value['userId'], ENT_QUOTES, 'UTF-8'); ?>'; document.getElementById('member').innerHTML = '<?= htmlspecialchars($value['pilotName'], ENT_QUOTES | ENT_JS, 'UTF-8'); ?>';"><b><i class="far fa-trash-alt"></i> Delete</b></a>
 <?php } else if ($clan['leaderId'] != $player['userId'] && $value['userId'] == $player['userId']) { ?>|
 	<a style="cursor:pointer;" id="confirm-leave-clan" class="leave-clan"><b>Leave clan</b></a>
<?php } ?>

</small>
</span>
</div>
</div>
<?php } ?>
</div>

<div style="background:rgba(100,100,100,0.5); width:748px; padding-left:20px;  height:30px; line-height:30px;">Applications</div>
  <?php
  $stmt_clan_apps = $mysqli->prepare('SELECT * FROM server_clan_applications WHERE clanId = ?');
  $stmt_clan_apps->bind_param("i", $clan['id']);
  $stmt_clan_apps->execute();
  $result_clan_apps = $stmt_clan_apps->get_result();
  $array = $result_clan_apps->fetch_all(MYSQLI_ASSOC);
  $stmt_clan_apps->close();

  if (count($array) >= 1) {
	  $numero = 0;
  ?>
<div style="position:relative; height:170px; overflow:auto;" class="ps-container">
<div class="col s12">

    <?php
    $stmt_user_details = $mysqli->prepare('SELECT userId, pilotName, factionId, rankId, data FROM player_accounts WHERE userId = ?');
    foreach ($array as $value) {
      $user_id_app = $value['userId'];
      $stmt_user_details->bind_param("i", $user_id_app);
      $stmt_user_details->execute();
      $result_user_details = $stmt_user_details->get_result();
      $user = $result_user_details->fetch_assoc();
      // $result_user_details->close(); // Not strictly needed for get_result

      if ($user) { // Check if user data was found
        $userData = json_decode($user['data']);
	  
		$numero++;
		if($numero%2==0){
			$estilo = ""; // Pares.
		}else{
			$estilo = "background:rgba(20,20,20,0.3)"; // Impares.
		}
    ?>
<div id="application-user-<?php echo htmlspecialchars($user['userId'], ENT_QUOTES, 'UTF-8'); ?>" style="width:748px; height:30px; line-height:30px; <?= $estilo; ?>">
 <div class="card white-text grey darken-3 padding-5">
<span style="display:inline-block; padding-left:20px; width:190px;"><?php echo htmlspecialchars($user['pilotName'], ENT_QUOTES, 'UTF-8'); ?></span>
<span style="display:inline-block; text-align:center; width:50px;"><img src="/img/companies/logo_<?php echo ($user['factionId'] == 1 ? 'mmo' : ($user['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png"></span>
<span style="display:inline-block; text-align:center; width:50px;"><img src="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>img/ranks/rank_<?php echo htmlspecialchars($user['rankId'], ENT_QUOTES, 'UTF-8'); ?>.png"></span>
<span style="display:inline-block; text-align:right; width:400px;">
<?php if ($clan['leaderId'] == $player['userId'] && $value['userId'] != $clan['leaderId']) { ?>
 <a style="cursor:pointer;" onclick="deleteMemberClan(<?php echo (int)$user['userId']; ?>); return;">Decline</a>
|<a style="cursor:pointer;" onclick="aceptMemberClan(<?php echo (int)$user['userId']; ?>); return;">Accept</a>
<?php } ?>
</div>
</div>

<?php } }
    if(isset($stmt_user_details)) { $stmt_user_details->close(); } ?>

</div>
 <?php } ?>
</div>
</div>
</div>




<?php require_once(INCLUDES . 'footer.php'); ?>