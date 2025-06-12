<?php //if (isset($_SESSION) && isset($_SESSION['account']['id']) && $_SESSION['account']['id'] != 1){ die('Forbidden'); return; }?>
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
<div class="item tab-drones active">DRONES</div>
</div>
<div class="drones" style="display: block;">
<div class="item droneApis">
<div class="image"><img src="/do_img/global/items/drone/apis-0_100x100.png" style="width:100%;"></div>
<div class="description">
<b>Apis</b>
<p>This drone offers 2 extra equipments slots
Can only be collected from Silver loot boxes.</p>
<b>Requirements:</b>
<ul>
<li>45x Apis Drone Parts</li>
<li>1.102.500 Uridium</li>
</ul>
<b>You have:</b>
<ul>
<li><b><font color="green"><?= htmlspecialchars(Functions::getPartsDrones("Apis"), ENT_QUOTES, 'UTF-8'); ?>x</font></b> Apis Drone Parts</li>
<li><b><font color="green"><span class="uridiumCount"><?php echo htmlspecialchars(number_format($data->uridium, 0, ',', '.'), ENT_QUOTES, 'UTF-8'); ?></span></font></b> Uridium</li>
</ul>
</div>
<div class="action">
<div class="button buildDrone" data-drone="Apis"><i class="fa fa-wrench"></i> Build</div>
</div>
</div>
<div class="item droneZeus">
<div class="image"><img src="/do_img/global/items/drone/zeus-0_100x100.png" style="width:100%;"></div>
<div class="description">
<b>Zeus</b>
<p>This drone offers 2 extra equipments slots
Can only be collected from Silver loot boxes.</p>
<b>Requirements:</b>
<ul>
<li>45x Zeus Drone Parts</li>
<li>1.552.500 Uridium</li>
</ul>
<b>You have:</b>
<ul>
<li><b><font color="green"><?= htmlspecialchars(Functions::getPartsDrones("Zeus"), ENT_QUOTES, 'UTF-8'); ?>x</font></b> Zeus Drone Parts</li>
<li><b><font color="green"><span class="uridiumCount"><?php echo htmlspecialchars(number_format($data->uridium, 0, ',', '.'), ENT_QUOTES, 'UTF-8'); ?></span></font></b> Uridium</li>
</ul>
</div>
<div class="action">
<div class="button buildDrone" data-drone="Zeus"><i class="fa fa-wrench"></i> Build</div>
</div>
</div>
</div>
</div>

<?php require_once(INCLUDES . 'footer.php'); ?>
