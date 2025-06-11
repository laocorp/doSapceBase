
<?php
$clans_per_page = 10;
$page_n = isset($page[2]) && preg_match('/^[1-9][0-9]*$/', $page[2]) && $page[2] >= 1 ? intval($page[2] - 1) : 0;

$stmt_all_clans = $mysqli->prepare('SELECT * FROM server_clans');
$stmt_all_clans->execute();
$result_all_clans = $stmt_all_clans->get_result();
$clans = $result_all_clans->fetch_all(MYSQLI_ASSOC);
$stmt_all_clans->close();

$number_of_pages = intval(count($clans) / $clans_per_page) + 1;

if ($page_n + 1 > $number_of_pages) {
  $page_n = 0;
}
?>

<?php require_once(INCLUDES . 'header.php');?>
<link rel="stylesheet" href="/public/css/clanupdate.css" />

<div class="page clan styleUpdate">
<div class="clan-container">

<!----- modal ---->

<div id="user-applications">
<div style="float:right; margin-right:-40px; margin-top:-20px; background:gray; display:inline-block; width:32px; height:32px; cursor:pointer; text-align:center; font-size:24px;" onclick="$('#user-applications').css('display', 'none');">X</div>
<b>Your Open Clan applications:</b><br><br>
<div style="height:360px; overflow:auto;" id="applicationsSend">
<?php
$query_applications_data = Functions::getClanApplications(); // Assumes this returns an array or false
if ($query_applications_data && count($query_applications_data) > 0){
  foreach($query_applications_data as $data_applications){ // Iterate as array if it's already fetched
?>
<div id="application_<?= htmlspecialchars($data_applications['appId'], ENT_QUOTES, 'UTF-8'); ?>">
- <b>[<?= htmlspecialchars($data_applications['tag'], ENT_QUOTES, 'UTF-8'); ?>]</b> <?= htmlspecialchars($data_applications['name'], ENT_QUOTES, 'UTF-8'); ?>.<a onclick="cancelApplication(<?= (int)$data_applications['appId']; ?>);" style="float:right; margin-right:5px; cursor:pointer;">Cancel</a>
</div>
<div style="border:1px solid red; border-radius:5px; padding:5px; text-align:center; display:none;" id="noApp">No result found.</div>
<?php } } else { ?>
  <div style="border:1px solid red; border-radius:5px; padding:5px; text-align:center;" id="noApp">No result found.</div>
<?php } ?>
</div>
</div>
<title><?= htmlspecialchars(SERVERNAME, ENT_QUOTES, 'UTF-8'); ?> - List</title>

<div id="infos" style="display: none;">
<div id="infos-loader">
<div style="margin-top:150px;"></div>
<center>
<i style="font-size:64px;" class="fa fa-spin fa-cog"></i><br>
<span style="font-size:32px;">Please wait...</span>
</center>
</div>
<div style="float:right; margin-right:-40px; margin-top:-20px; background:gray; display:inline-block; width:32px; height:32px; cursor:pointer; text-align:center; font-size:24px;" onclick="$('#infos').css('display', 'none'); current_view_id=0;">X</div>
<img src="/public/img/clan/logo_default.jpg" id="infos-avatar" style="vertical-align:top;width:81px !important;height:81px; !important;">
<div style="display:inline-block; margin-left:15px; max-width:290px;">
<b style="width:100px; display:inline-block;">Clan:</b> <span id="infos-name"></span><br>
<b style="width:100px; display:inline-block;">Leader:</b> <span id="infos-leader"></span><br>
<b style="width:100px; display:inline-block;">Members:</b> <span id="infos-members"></span><br>
<b style="width:100px; display:inline-block;">Position:</b> <span id="infos-position"></span><br>
<b style="width:100px; display:inline-block;">Founded:</b> <span id="infos-created"></span><br>
</div>
<div style="margin-top:20px;"></div>
<b>Description:</b><br>
<textarea id="infos-description" style="width:420px; height:70px; background:rgba(50,50,50,0.6); resize:none;" readonly=""></textarea>
<br><br>
<b>Application Text:</b><br>
<?php if ($player['clanId'] == 0) { ?>

<form id="send_clan_application" method="post">
	<input type="hidden" name="clanId" id="infos-clanId" value="">
	<div class="input-field col s12">
		<textarea name="text" placeholder="A short text to explain why you want to join this clan..." style="width:420px; height:70px; background:rgba(50,50,50,0.9); resize:none;" maxlength="255"></textarea>
	</div>
	<div class="input-field center col s12">				 
		<center><button class="btn btn-primary btn-lg"  id="infos-send-button" style="margin-top:10px;">Send</button></center>
	</div>
</form>

<?php }  ?>
</div>

<!----- modal ---->

<div style="display:inline-block; margin-left:10px;">
<div class="title">Clanlists <span style="float:right; font-size:12px; padding-top:10px; cursor:pointer;" onclick="viewUserApplications()"><a>My applications</a></span></div>
<div style="width:880px; height:250px; background:rgba(0,0,0,0.5);">
<div style="width:100%; background:rgba(10,10,10,0.9); padding-left:10px; padding-right:10px;">
<span style="width:30px; display:inline-block;">#</span>
<span style="width:80px; display:inline-block;">Clan Tag</span>
<span style="width:320px; display:inline-block;">Clan Name</span>
<span style="width:100px; display:inline-block; text-align:center;">Clan Company</span>
<span style="width:100px; display:inline-block; text-align:center;">Membercount</span>
</div>

<?php
$num = 0;
$stmt_member_count = $mysqli->prepare('SELECT COUNT(userId) as member_count FROM player_accounts WHERE clanId = ?');

foreach (array_slice($clans, ($page_n * $clans_per_page), $clans_per_page) as $value) {
	$num++;
    $clan_id_loop = $value['id'];
    $stmt_member_count->bind_param("i", $clan_id_loop);
    $stmt_member_count->execute();
    $result_member_count = $stmt_member_count->get_result();
    $member_count_data = $result_member_count->fetch_assoc();
    $member_count = $member_count_data['member_count'] ?? 0;
    // $result_member_count->close(); // Not needed for get_result()
?>

<div style="background:rgba(60,60,60,0.4); padding-left:10px; padding-right:10px;">
<span style="width:30px; display:inline-block;"><?= htmlspecialchars($num, ENT_QUOTES, 'UTF-8'); ?></span>
<span style="width:80px; display:inline-block;">[<?php echo htmlspecialchars($value['tag'], ENT_QUOTES, 'UTF-8'); ?>]</span>
<span style="width:320px; display:inline-block;"> <?php echo htmlspecialchars($value['name'], ENT_QUOTES, 'UTF-8'); ?></span>
<span style="width:100px; display:inline-block; text-align:center;"><img src="/img/companies/logo_<?php echo ($value['factionId'] == 1 ? 'mmo' : ($value['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png"></span>
<span style="width:100px; display:inline-block; text-align:center;"><?php echo htmlspecialchars($member_count, ENT_QUOTES, 'UTF-8'); ?></span>
<span style="float:right; margin-right:40px; cursor:pointer;"><a onclick="viewModal(<?php echo (int)$value['id']?>); return;">View</a></span>
</div>
<?php }
if (isset($stmt_member_count)) { $stmt_member_count->close(); }
?>
<center>
    <?php if (($page_n + 1) !== 1) { ?>
      <?php if ($number_of_pages > 5 && ($page_n + 1) > 3) { ?>
      <a href="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>clan/join/1">1</a>
      <?php } ?>

    <a href="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>clan/join/<?php echo htmlspecialchars(($page_n === 0 ? 1 : $page_n), ENT_QUOTES, 'UTF-8'); ?>">
    <?php } ?>

    <?php for ($i = ($number_of_pages > 5 && ($page_n !== 0 && $page_n !== 1) ? ($page_n - 1) : 1); $i <= ($number_of_pages > 5 ? ($page_n + ($page_n === 0 ? 5 : ($page_n === 1 ? 4 : ($page_n + 1 === $number_of_pages ? 1 : ($page_n + 1 === $number_of_pages - 1 ? 1 : 3))))) : $number_of_pages); $i++) { ?>
    <a href="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>clan/join/<?php echo htmlspecialchars($i, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($i, ENT_QUOTES, 'UTF-8'); ?></a>
    <?php } ?>

    <?php if (($page_n + 1) !== $number_of_pages) { ?>
  

      <?php if ($number_of_pages > 5) { ?>
       <a href="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>clan/join/<?php echo htmlspecialchars($number_of_pages, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($number_of_pages, ENT_QUOTES, 'UTF-8'); ?></a>
      <?php } ?>
    <?php } ?>
	</center>
</div>

<br>
 <div class="title">Create Clan</div>
 </div>
<div style="height:230px; background:rgba(0,0,0,0.5); padding-top:10px; padding-left:20px;">
   <form id="found_clan" method="post">
<b style="width:100px; display:inline-block;">Tag:</b>

 <input name="tag" placeholder="3-4 chars max." style="text-indent:2px; background:rgba(10,10,10,0.9); border:none; border-radius:5px;" maxlength="4" type="text" >

<br>

<div style="margin-top:5px;"> </div>
<b style="width:100px; display:inline-block;">Name:</b>

 <input name="name" placeholder="25 chars max." style="text-indent:2px; background:rgba(10,10,10,0.9); border:none; border-radius:5px;" maxlength="25" type="text" >

 <br>
<div style="margin-top:5px;"> </div>
<b>Description:</b><br>

<textarea name="description" style="margin-left:100px; width:440px; height:70px; text-indent:2px; background:rgba(10,10,10,0.9); border:none; border-radius:5px; resize:none;" placeholder="A short text to describe your clan and its recruitment's criterias."></textarea>

<br><br>

 <button type="submit" class="btn btn-default">Create</button>

</form>
</div>
</div>

</div>
</div>

<?php require_once(INCLUDES . 'footer.php'); ?>

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
