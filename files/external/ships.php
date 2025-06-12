<?php require_once(INCLUDES . 'header.php');?>
<link rel="stylesheet" href="/public/css/ship2update.css">
<link rel="stylesheet" href="/public/css/perfect-scrollbar.min.css?cv=794f6b25f5d3bbb1753355bd513ecb66">
<script rel="javascript" type="text/javascript" charset="utf-8" src="http://pinkgalaxy.net/public/js/perfect-scrollbar.min.js"></script>

<?php require_once(INCLUDES . 'data.php'); ?>

<div class="page ship">
<div class="ships styleUpdate">
<div class="popup">
<div class="popup-container">
 <p class="popup-text"></p>
</div>
</div>
<div class="list">
<div class="menu">
<div onclick="selectTab('ship')" class="item tab-ship active">SHIP</div>
</div>
<br>
<div class="list-container shipList ps-container" data-ps-id="2036e852-7ce2-5dbf-ad41-7e70094b8019" style="display: block;">

<?php
                  $equipment = $mysqli->query('SELECT * FROM player_equipment WHERE userId = '.$player['userId'].'')->fetch_assoc();
                  $ships = json_decode($equipment['items'])->ships;
                  $minave = $mysqli->query('SELECT shipID FROM player_accounts WHERE userId = '.$player['userId'].'')->fetch_assoc()['shipID'];


                  foreach ($ships as $shipId) {
                    $ship = $mysqli->query('SELECT * FROM server_ships WHERE shipID = '.$shipId.'')->fetch_assoc();
                    $currentShip = $mysqli->query('SELECT * FROM server_ships WHERE shipID = '.$player['shipId'].'')->fetch_assoc();
                    $lootId = $currentShip['baseShipId'] != $shipId ? $ship['lootID'] : ($player['shipId'] == 69 ? 'ship_goliath_design_razer' : $currentShip['lootID']);
                    $lootId = str_replace('_', '/', $lootId);
                    $escaped_ship_id = htmlspecialchars($shipId, ENT_QUOTES, 'UTF-8');
                    $escaped_loot_id = htmlspecialchars($lootId, ENT_QUOTES, 'UTF-8');
                  ?>

<div id="<?php echo $escaped_ship_id; ?>" class="item info_ship<?php echo $currentShip['baseShipId'] == $shipId ? ' active' : ''; ?>">
<img src="<?php echo DOMAIN; ?>do_img/global/items/<?php echo $escaped_loot_id; ?>_100x100.png">
</div>

<?php } ?>
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div>
<div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="infos">
<div class="selected-ship">
<div class="item">
<img id="shipPreviewImage" src="/do_img/global/items/ship/phoenix_100x100.png">
</div>
<h2 class="ship-name">Phoenix</h2>
<div class="left-column">
<b>HP</b> <span class="ship-hp">15.000</span><br>
<b>LAS</b> <span class="ship-lasers">1</span><br>
<b>GEN</b> <span class="ship-generators">2</span><br>
</div>
<div class="right-column">
<b>SPD</b> <span class="ship-speed">320</span><br>
<b>DMG</b> <span class="ship-damage">320</span><br>
</div>
</div>
<div class="buttons">
<div id="<?php echo htmlspecialchars($shipId, ENT_QUOTES, 'UTF-8'); // Assuming $shipId from the loop is still in scope here, if not, this needs to be the correct variable ?>" class="button useNave"><i class="fa fa-wrench"></i> use ship</div>
</div>
</div>
</div>
</div>





<?php require_once(INCLUDES . 'footer.php'); ?>

