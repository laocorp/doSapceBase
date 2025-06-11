<?php require_once(INCLUDES . 'header.php'); ?>
<?php require_once(INCLUDES . 'data.php'); ?>
<link rel="stylesheet" href="/public/css/infoclan.css" />

<link rel="stylesheet" href="/public/css/bootstrap-3.3.5.min2.css" />
<style>
.button, input, select, textarea {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
}
.button, select {
    text-transform: none;
}
.button, input, optgroup, select, textarea {
    margin: 0;
    font: inherit;
    color: inherit;
}

.select {
    -webkit-writing-mode: horizontal-tb !important;
    text-rendering: auto !important;
    color: -internal-light-dark-color(black, white) !important;
    letter-spacing: normal !important;
    word-spacing: normal !important;
    text-transform: none !important;
    text-indent: 0px !important;
    text-shadow: none !important;
    display: inline-block !important;
    text-align: start !important;
    -webkit-appearance: menulist !important;
    box-sizing: border-box;
    align-items: center;
    white-space: pre;
    -webkit-rtl-ordering: logical;
    background-color: -internal-light-dark-color(rgb(255, 255, 255), rgb(59, 59, 59));
    cursor: default;
    margin: 0em;
    font: 400 13.3333px Arial;
    border-radius: 0px;
    border-width: 1px;
    border-style: solid;
    border-color: -internal-light-dark-color(rgb(118, 118, 118), rgb(195, 195, 195));
    border-image: initial;
}

.scrollable-content {
  height: 273px !important;
  overflow: auto;
}

</style>

<div class="page clan styleUpdate">
<div class="clan-container">


<script type="text/javascript">
		  $(function() { 
			//init custom scrollbar
			$('#clan-news').perfectScrollbar();
		  });
</script>

 <title><?= SERVERNAME; ?> - Information</title>
<div class="clan-infos">

<div id="clan-edit-infos" style="z-index: 100; width: 500px; height: 320px; display: none;" class="clan-window">
<div id="infos-loader" style="margin-top: 0px !important; margin-left:0px !important;">
<div style="margin-top:150px;"></div>
<center>
<i style="font-size:64px;" class="fa fa-spin fa-cog"></i><br>
<span style="font-size:32px;">Please wait...</span>
</center>
</div>
<span style="dispay:inline-block; width:32px; height:32px; font-size:24px; background:gray; float:right; text-align:center; cursor:pointer;" onclick="$('#clan-edit-infos').css('display', 'none'); setTimeout(function(){ location.reload(); }, 0000);">X</span>
<div style="padding-left:30px; padding-right:30px; padding-top:20px;">

<form method="post" id="change_clan_settings">
<b style="width:100px; display:inline-block;">Tag:</b> <input style="background:rgba(50,50,50,0.9); width:50px;" maxlength="4" type="text" name="tag" value="<?php echo $clan['tag']; ?>"><br>
<b style="width:100px; display:inline-block;">Name:</b> <input style="background:rgba(50,50,50,0.9);" maxlength="30" type="text" name="name" value="<?php echo $clan['name']; ?>"><br>
<b style="width:100px; display:inline-block;">Photo:</b> <input style="background:rgba(50,50,50,0.9);" maxlength="255" type="text" name="profile" value="<?php echo $clan['profile']; ?>"><br>

<b style="width:100px; display:inline-block;">Recruitment:</b>
<input type="radio" name="Recruitment" value="0" <?= ($clan['recruiting'] == 0) ? 'checked' : ''; ?> > NO <input type="radio" name="Recruitment" value="1" <?= ($clan['recruiting'] == 1) ? 'checked' : ''; ?>> YES
<br>
<b style="width:100px; display:inline-block;">Company:</b>
<input type="radio" name="Company" value="0" <?= ($clan['factionId'] == '0') ? 'checked' : ''; ?>> ALL <input type="radio" name="Company" value="3" <?= ($clan['factionId'] == 3) ? 'checked' : ''; ?>> VRU  <input type="radio" id="female" name="Company" value="2" <?= ($clan['factionId'] == 2) ? 'checked' : ''; ?>> EIC  <input type="radio" id="female" name="Company" value="1" <?= ($clan['factionId'] == 1) ? 'checked' : ''; ?>> MMO
<br><br>
<b style="width:100px; display:inline-block;">Description:</b><br>
<textarea name="description" style="width:440px; height:70px; background:rgba(50,50,50,0.9); resize:none;"><?php echo $clan['description']; ?></textarea>
<br>
<center><button type="submit" class="btn btn-lg btn-default">Save</button></center>
<br>
</form>

</div>
</div>

<div id="clan-add-news" style="z-index:105; width:500px; height:210px; display:none;" class="clan-window">
<div id="infos-loader-clan" style="margin-top: 0px !important; margin-left:0px !important;">
<div style="margin-top:150px;"></div>
<center>
<i style="font-size:64px;" class="fa fa-spin fa-cog"></i><br>
<span style="font-size:32px;">Please wait...</span>
</center>
</div>
<span style="dispay:inline-block; width:32px; height:32px; font-size:24px; background:gray; float:right; text-align:center; cursor:pointer;" onclick="$('#clan-add-news').css('display', 'none'); setTimeout(function(){ location.reload(); }, 0000);">X</span>
<div style="padding-left:30px; padding-right:30px; padding-top:20px;">
<form method="post" id="formNewMessageClan">
<b style="width:100px; display:inline-block;">Message:</b><br>
<textarea name="message" maxlength="25" style="width:440px; height:70px; background:rgba(50,50,50,0.9); resize:none;"></textarea>
<br><br>
<center><button type="submit" class="btn btn-lg btn-default">Send</button></center>
</form>
</div>
</div>

<div class="left-menu">
<a href="/clan/join" class="clan-button clan-button-active">Infos</a>
<a href="/clan/members" class="clan-button ">Members</a>
<a href="/clan/diplomacy" class="clan-button ">Diplomacy</a>
</div> 



<div style="display:inline-block;">
<div style="width:620px; padding-left:30px; padding-top:20px;">
<div style="width:570px; background:rgba(20,20,20,0.3);">
<b style="width:100px; display:inline-block;">Clan:</b> <b>[<?php echo htmlspecialchars($clan['tag']); ?>]</b> <?php echo htmlspecialchars($clan['name']); ?>  <?php if ($clan['leaderId'] == $player['userId']) { ?><i style="cursor:pointer;" onclick="viewModalinfoedit(); return;" class="fa fa-cog"></i><?php } ?><br>
</div>
<div style="width:570px; background:rgba(30,30,30,0.6);">
<b style="width:100px; display:inline-block;">Leader:</b> <?php
                    $leaderNameInfo = "N/A";
                    $stmt_leader_info = $mysqli->prepare('SELECT pilotName FROM player_accounts WHERE userId = ?');
                    $stmt_leader_info->bind_param("i", $clan['leaderId']);
                    $stmt_leader_info->execute();
                    $leader_result_info = $stmt_leader_info->get_result();
                    if ($leader_data_info = $leader_result_info->fetch_assoc()) {
                      $leaderNameInfo = $leader_data_info['pilotName'];
                    }
                    $stmt_leader_info->close();
                    echo htmlspecialchars($leaderNameInfo);
                  ?><br>
</div>
<div style="width:570px; background:rgba(20,20,20,0.3);">
<b style="width:100px; display:inline-block;">Position:</b> 0<br>
</div>
<div style="width:570px; background:rgba(30,30,30,0.6);">
<b style="width:100px; display:inline-block;">Members:</b> <?php
                    $memberCountInfo = 0;
                    $stmt_members_info = $mysqli->prepare('SELECT COUNT(userId) as member_count FROM player_accounts WHERE clanId = ?');
                    $stmt_members_info->bind_param("i", $clan['id']);
                    $stmt_members_info->execute();
                    $member_result_info = $stmt_members_info->get_result();
                    if ($member_data_info = $member_result_info->fetch_assoc()) {
                      $memberCountInfo = $member_data_info['member_count'];
                    }
                    $stmt_members_info->close();
                    echo $memberCountInfo;
                  ?><br>
</div>
<div style="width:570px; background:rgba(20,20,20,0.3);">
<b style="width:100px; display:inline-block;">Created:</b> <?php echo date('Y.m.d h:i:s', strtotime($clan['date'])); ?><br>
</div>
<div style="width:570px; background:rgba(30,30,30,0.6);">
<b style="width:100px; display:inline-block;">Faction:</b> <?php echo ($clan['factionId'] == 0 ? 'All' : ($clan['factionId'] == 1 ? 'MMO' : ($clan['factionId'] == 2 ? 'EIC' : 'VRU'))); ?> <br>
</div>
<div style="width:570px; background:rgba(20,20,20,0.3);">
<b style="width:100px; display:inline-block;">Recruitment:</b> <?php echo ($clan['recruiting'] ? 'Recruiting' : 'Closed'); ?> <br>
</div>
</div>
</div>

<img src="/public/img/clan/<?php echo $clan['profile']; ?>" style="vertical-align:top; margin-top:20px; border:1px solid gray;width: 120px;height: 120px;">
<div style="display:inline-block; padding-left:30px; margin-top:15px;">
<b style="width:100px; display:inline-block;">Description:</b><br>
<div style="width:697px; padding-left:10px; padding-top:5px; border:1px solid gray; padding-right:10px; height:70px;word-wrap: break-word; OVERFLOW: AUTO; background:rgba(30,30,30,0.6);"><?php echo htmlspecialchars($clan['description']); ?></div>
</div>
<div style="padding-left:20px; margin-top:25px; font-size:20px; width:748px; background:rgba(100,100,100,0.5);">
News 
<?php if ($player['userId'] === $clan['leaderId']){ ?>
<a style="cursor:pointer;" class="noLink" onclick="$('#clan-add-news').css('display','block');"><i class="fa fa-plus"></i></a>
<?php } ?>
</div>
<div id="clan-news" style="max-height:279px; max-width:748px; word-wrap:break-word; padding-right:20px; padding-top:1px; position:relative; overflow-x: hidden;" class="ps-container scrollable-content">
<?php 
$stmt_clan_news = $mysqli->prepare("SELECT ncl.*, pa.pilotName
                                    FROM newsclantablelog ncl
                                    JOIN player_accounts pa on ncl.leaderId = pa.userId
                                    WHERE ncl.clanId = ? ORDER by ncl.id DESC");
$stmt_clan_news->bind_param("i", $clan['id']);
$stmt_clan_news->execute();
$clan_news_result = $stmt_clan_news->get_result();

while($row = $clan_news_result->fetch_assoc())
{
	if ($row['type'] == 'new'){
    //$color = "yellow";
    $color = "#656500";
	}elseif ($row['type'] == 'logbank'){
		$color = "rgba(140,130,0,0.2)";
	}elseif ($row['type'] == 'joinmember'){
		$color = "green";
	}elseif ($row['type'] == 'logusers'){
		$color = "blue";
	}elseif ($row['type'] == 'settings'){
        $color = "purple";
    }elseif ($row['type'] == 'systembank'){
        $color = "#96650c";
	} else {
		$color = "orange";
	}
	?>
	<div style="border-bottom: 1px solid #222; width:748px; height:30px; line-height:30px; background:<?= $color; ?>;">
		<span style="display:inline-block; padding-left:20px; width:165px;"><b><?= htmlspecialchars($row['date']) ?></b>:</span>
		<span style="display:inline-block; text-align:left; width:550px;"><b><?= htmlspecialchars(($row['type'] == 'systembank') ? 'System' : $row['pilotName']) ?><?= ($row['type'] == 'new') ? ' Posted: ' : ''; ?></b> <?= htmlspecialchars($row['texto']) ?></span>
	</div>
	<?php
}
$stmt_clan_news->close();
?>

<div style="border-bottom: 1px solid #222; width:748px; height:30px; line-height:30px; background:rgba(140,0,120,0.2);">
<span style="display:inline-block; padding-left:20px; width:165px;"><b><?php echo htmlspecialchars(date('Y.m.d h:i:s', strtotime($clan['date']))); ?></b></span>
<span style="display:inline-block; text-align:left; width:550px;"><b><?php echo htmlspecialchars($leaderNameInfo); // Re-use fetched leader name ?></b> Created <b><?php echo htmlspecialchars($clan['name']); ?></b>!</span>
</div>


<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;">
<div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
</div>
<div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
<div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div>
</div>
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;">
<div class="ps-scrollbar-x" style="left: 0px; width: 0px;">
</div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
<div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
</div>
</div>


</div>

<?php require_once(INCLUDES . 'footer.php'); ?>

