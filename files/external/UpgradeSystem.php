<?php //if (isset($_SESSION) && isset($_SESSION['account']['id']) && $_SESSION['account']['id'] != 1){ die('Forbidden'); return; }?>
<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/css/updagrde.css" />

<?php require_once(INCLUDES . 'data.php');

// Step 1: Fetch player's equipment items
$player_equipment_items_json = null;
$player_equipment_items = [];
$player_user_id_for_equip = (int)($player['userId'] ?? 0); // Ensure player ID is an int

if ($player_user_id_for_equip > 0) {
    $stmt_equip_items = $mysqli->prepare("SELECT items FROM player_equipment WHERE userId = ?");
    if ($stmt_equip_items) {
        $stmt_equip_items->bind_param("i", $player_user_id_for_equip);
        $stmt_equip_items->execute();
        $result_equip_items = $stmt_equip_items->get_result();
        if ($result_equip_items && $result_equip_items->num_rows > 0) {
            $player_equipment_items_json = $result_equip_items->fetch_assoc()['items'];
            if ($player_equipment_items_json) {
                $player_equipment_items = json_decode($player_equipment_items_json, true);
            }
        }
        $stmt_equip_items->close();
    }
}

// Step 2: Fetch all item IDs currently being upgraded by the user
$upgrading_item_ids = [];
if ($player_user_id_for_equip > 0) {
    $stmt_upgrading_ids = $mysqli->prepare("SELECT itemId FROM upgradesSystem WHERE idUser = ?");
    if ($stmt_upgrading_ids) {
        $stmt_upgrading_ids->bind_param("i", $player_user_id_for_equip);
        $stmt_upgrading_ids->execute();
        $upgrading_query_result = $stmt_upgrading_ids->get_result();
        if ($upgrading_query_result) {
            while($row = $upgrading_query_result->fetch_assoc()) {
                $upgrading_item_ids[] = $row['itemId'];
            }
            $upgrading_query_result->close();
        }
        $stmt_upgrading_ids->close();
    }
}

// Step 3: Fetch all relevant item levels
$player_item_levels = [];
if ($player_user_id_for_equip > 0) {
    $stmt_item_levels = $mysqli->prepare("SELECT lf1lvl, lf2lvl, lf3lvl, lf4lvl, lf5lvl, B01lvl, B02lvl, B03lvl, A01lvl, A02lvl, A03lvl, lf3nlvl, lf4mdlvl, lf4pdlvl, lf4hplvl, lf4splvl, lf4unstablelvl, mp1lvl FROM player_equipment WHERE userId = ?");
    if ($stmt_item_levels) {
        $stmt_item_levels->bind_param("i", $player_user_id_for_equip);
        $stmt_item_levels->execute();
        $item_levels_result = $stmt_item_levels->get_result();
        if ($item_levels_result && $item_levels_result->num_rows > 0) {
            $player_item_levels = $item_levels_result->fetch_assoc();
        }
        $stmt_item_levels->close();
    }

    $stmt_account_data = $mysqli->prepare("SELECT droneExp FROM player_accounts WHERE userId = ?");
    if ($stmt_account_data) {
        $stmt_account_data->bind_param("i", $player_user_id_for_equip);
        $stmt_account_data->execute();
        $account_data_result = $stmt_account_data->get_result();
        if ($account_data_result && $account_data_result->num_rows > 0) {
            $player_account_data = $account_data_result->fetch_assoc();
            $player_item_levels['droneExp'] = $player_account_data['droneExp'] ?? 0;
        } else {
            $player_item_levels['droneExp'] = 0;
        }
        $stmt_account_data->close();
    } else {
        $player_item_levels['droneExp'] = 0;
    }
}
?>


​​​<div class="page upgrade ">
<div class="upgrade-container styleUpdate" style="border: 0px; border-bottom: 3px solid #ffc300 !important;">
<div class="loader" style="display: none;">
<div class="content">
<i class="fa fa-cog fa-spin"></i><br>
Loading
</div>
</div>
<div class="upgradeItemsButton noselect" style="width:100% !important; text-align:center; background-color: transparent;">
<div class="btn-group">
<?php
$active_status = 1;
$stmt_cat1 = $mysqli->prepare("SELECT id, cat FROM categoryUpgradeSystem WHERE active = ?");
$stmt_cat1->bind_param("i", $active_status);
$stmt_cat1->execute();
$sQuery = $stmt_cat1->get_result();

if ($sQuery->num_rows > 0){
    while($data = $sQuery->fetch_assoc()){
?>
<button type="button" class="btn buttonI" onclick="selectTab('<?= htmlspecialchars(strtolower(str_replace(" ", "", $data['cat'])), ENT_QUOTES, 'UTF-8'); ?>');"><?= htmlspecialchars($data['cat'], ENT_QUOTES, 'UTF-8'); ?></button>
<?php } } $stmt_cat1->close(); ?>
</div>
</div>


<div class="upgradeableItems noselect ps-container">

<?php
$item_name_to_level_key = [
    "LF-1" => "lf1lvl",
    "LF-2" => "lf2lvl",
    "LF-3" => "lf3lvl",
    "LF-4" => "lf4lvl",
    "Prometeus" => "lf5lvl",
    "SG3N-B01" => "B01lvl",
    "SG3N-B02" => "B02lvl", // Original code used Functions::getLaserLvl("b02") - ensure $player_item_levels key is 'B02lvl' for consistency
    "SG3N-B03" => "B03lvl",
    "SG3N-A01" => "A01lvl",
    "SG3N-A02" => "A02lvl",
    "SG3N-A03" => "A03lvl",
    "LF-3-Neutron" => "lf3nlvl",
    "LF-4-MD" => "lf4mdlvl",
    "LF-4-PD" => "lf4pdlvl",
    "LF-4-HP" => "lf4hplvl",
    "LF-4-SP" => "lf4splvl",
    "Unstable LF-4" => "lf4unstablelvl",
    "MP-1" => "mp1lvl",
    "Drone Level" => "droneExp"
];

$stmt_cat2 = $mysqli->prepare("SELECT id, cat FROM categoryUpgradeSystem WHERE active = ?");
$stmt_cat2->bind_param("i", $active_status);
$stmt_cat2->execute();
$sQuery2 = $stmt_cat2->get_result();

if ($sQuery2 && $sQuery2->num_rows > 0){ // Added null check for $sQuery2
    while($data2 = $sQuery2->fetch_assoc()){
?>
<div class="upgradeableItemsContainer" id="<?= htmlspecialchars(strtolower(str_replace(" ", "", $data2['cat'])), ENT_QUOTES, 'UTF-8'); ?>" style="<?= ($data2['id'] == "1" ? "" : "display:none;"); ?>">

<?php
$catId = (int)$data2['id'];
$stmt_items = $mysqli->prepare("SELECT * FROM itemsUpgradeSystem WHERE active = ? AND catId = ?"); // Not changing to specific columns as $data3 is used broadly
$stmt_items->bind_param("ii", $active_status, $catId);
$stmt_items->execute();
$sQuery3 = $stmt_items->get_result();

if ($sQuery3 && $sQuery3->num_rows > 0){ // Added null check for $sQuery3
    while($data3 = $sQuery3->fetch_assoc()){
        $data3_id_escaped = htmlspecialchars($data3['id'], ENT_QUOTES, 'UTF-8');
        $available_item_count = 1; // Default for items not needing inventory check (like drone level) or if checkLaser is empty

        if (!empty($data3['checkLaser'])){
            if ($data3['checkLaser'] == "apis|zeus"){
                $available_item_count = (isset($player_equipment_items['apis']) && $player_equipment_items['apis'] == true) || (isset($player_equipment_items['zeus']) && $player_equipment_items['zeus'] == true) ? 1 : 0;
            } else {
                $item_count_key = $data3['checkLaser']."Count";
                $available_item_count = isset($player_equipment_items[$item_count_key]) ? (int)$player_equipment_items[$item_count_key] : 0;
            }
        }

        if ($available_item_count > 0){
            $is_in_process = in_array($data3['id'], $upgrading_item_ids);

            if (!$is_in_process){
                $current_level = 0;
                $level_key = $item_name_to_level_key[$data3['name']] ?? null;

                if ($level_key && isset($player_item_levels[$level_key])) {
                    if ($data3['name'] == "Drone Level") {
                        $droneEXP = (int)$player_item_levels['droneExp'];
                        if ($droneEXP >= 2500) $current_level = 6;
                        elseif ($droneEXP >= 2000) $current_level = 5;
                        elseif ($droneEXP >= 1500) $current_level = 4;
                        elseif ($droneEXP >= 1000) $current_level = 3;
                        elseif ($droneEXP >= 500) $current_level = 2;
                        else $current_level = 1;
                    } else {
                        $current_level = (int)$player_item_levels[$level_key];
                    }
                }

                $max_level = ($data3['name'] == "Drone Level") ? 6 : 16;

                if ($level_key && $current_level < $max_level){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($current_level, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
    <?php
                }
            }
        }
    }
    $stmt_items->close();
}
?>
</div>
<?php } $stmt_cat2->close(); ?>
</div>
<?php } ?>

<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
<div class="upgradeContainer">
<div class="toUpgradeDetails">
<div class="itemPreview">
<div id="itemPreviewUpgradeTo" class="level"></div>
<div class="imageContainer">
<img id="itemPreviewImage" style="padding-top: 10px;" src="">
</div>
<div id="itemPreviewName" class="itemname"></div>
</div>
<div class="itemDetails">
<div class="itemChangeUpgrade">
<div class="decreaseButton" onclick="Chance();">
<button><i class="fas fa-angle-left"></i></button>
</div>
<div class="chance">
<input id="itemPreviewUpgradeChance" type="text" value="5 %" readonly="">
</div>
<div class="increaseButton" onclick="Chance();">
<button><i class="fas fa-angle-right"></i></button>
</div>
</div>
<table style="width:100%">
<tbody><tr>
<td>Chance of upgrade success:</td>
<td id="chanceInfo" data-chance="5">5 %</td>
</tr>
<tr>
<td>Total cost of upgrade:</td>
<td id="costsInfo"></td>
</tr>
</tbody></table>
</div>
</div>
<div class="upgradeButton noselect">
<div class="buttonContainer">
<button id="upgradeButton" onclick="upgrade();">UPGRADE</button>
</div>
</div>
<div class="finishAllButton noselect">
<button onclick="finishAll();">Finish all</button>
</div>
<div class="upgradedItems noselect ps-container" data-ps-id="952ca80a-47b0-40d7-c6e6-4b499e8af8ab" style="overflow:auto">
<div class="items" id="upgradingItems" style="display: block;">

<?php
$player_user_id_for_upgrading_check = (int)$player['userId'];
$stmt_upgrading = $mysqli->prepare("SELECT * FROM upgradesSystem WHERE idUser = ?");
$stmt_upgrading->bind_param("i", $player_user_id_for_upgrading_check);
$stmt_upgrading->execute();
$sQuery_upgrading = $stmt_upgrading->get_result();

if ($sQuery_upgrading->num_rows > 0){
    while($dataUP = $sQuery_upgrading->fetch_assoc()){
    $dataUP_id_escaped = htmlspecialchars($dataUP['id'], ENT_QUOTES, 'UTF-8');

    $date1 = $dataUP['timeNow'];
    $date2 = $dataUP['waitTime'];
    $today = time();
    $timePast = $today - $date1;
    $duration = $date2 - $date1;
    $completed  = floor(($timePast/$duration)*100);

    if ($completed >= 100){
        $completed = 100;
    }

?>

<div class="item fadeInLeft animated <?= ($completed == 100 ? "finished" : ""); ?>" id="UitemId_<?= $dataUP_id_escaped; ?>" onclick="finish(<?= $dataUP_id_escaped; ?>);">
<div class="img"><img src="<?= htmlspecialchars($dataUP['img'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($dataUP['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="lvlToUpgrade"><?= htmlspecialchars($dataUP['lvl_base'], ENT_QUOTES, 'UTF-8'); ?> → <?= htmlspecialchars($dataUP['new_lvl'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="progress2" id="PitemId_<?= $dataUP_id_escaped; ?>" data-id="<?= $dataUP_id_escaped; ?>"><progress max="100" value="<?= htmlspecialchars($completed, ENT_QUOTES, 'UTF-8'); ?>"></progress></div>
</div>

<?php } } $stmt_upgrading->close(); ?>

</div>
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
</div>
</div>
</div>


<?php require_once(INCLUDES . 'footer.php'); ?>
