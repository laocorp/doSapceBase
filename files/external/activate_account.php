<?php //if (isset($_SESSION) && isset($_SESSION['account']['id']) && $_SESSION['account']['id'] != 1){ die('Forbidden'); return; }?>
<?php if (empty(SystemActiveVerification)){ die('Forbidden'); return; } ?>
<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/css/labor.css" />

<?php require_once(INCLUDES . 'data.php'); ?>
<div class="page styleUpdate lab">
<div class="lab-container">
<div class="loader">
<div class="content">
<i class="fa fa-cog fa-spin"></i><br>
Loading
</div>
</div>
<div class="menu">
<div class="item tab-drones active">Activate Account</div>
</div>
<div class="drones" style="display: block;">
<div style="width:100%; height:50%; border: 1px dashed rebeccapurple; margin-bottom:15px;">
<br>
Hello <b><?= htmlspecialchars($player['pilotName'], ENT_QUOTES, 'UTF-8'); ?></b>, please need activate the account.
<div id="form" style="padding-top: 25px;">
<input id="title_name" type="text" value=" !activate<?= htmlspecialchars(Functions::generateActivationKey()['key'], ENT_QUOTES, 'UTF-8');?>" class="white-text" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px;" readonly>
</div>
<div style="font-weight: bold; color:red; padding-top:15px;">Type this command in #activation channel: <font color='white'>!activate <?= htmlspecialchars(Functions::generateActivationKey()['key'], ENT_QUOTES, 'UTF-8'); ?><b></b></font></div>
<div style="font-weight: bold; color:red; padding-top:15px;">Account status: <font color='white'><?= (Functions::generateActivationKey()['actived'] == 1) ? "<font color=green>Active</color>" : "<font color=red>No active</color>"; ?><b></b></font></div>
<div style="font-weight: bold; color:red; padding-top:15px;">Go to discord to activate: <font color='white'><a href="https://discord.gg/7BXZk8tf" target="_blank">!CLICK HERE!</a> <b></b></font></div>
<div id="message" style="text-align:center; border: 1px dashed green; padding:15px; margin:auto; width:50%; margin-top:15px; display:none;"></div>
</div>
</div>
</div>
</div>

<?php require_once(INCLUDES . 'footer.php'); ?>