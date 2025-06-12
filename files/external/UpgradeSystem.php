<?php //if (isset($_SESSION) && isset($_SESSION['account']['id']) && $_SESSION['account']['id'] != 1){ die('Forbidden'); return; }?>
<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/css/updagrde.css" />

<?php require_once(INCLUDES . 'data.php'); ?>


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
$stmt_cat2 = $mysqli->prepare("SELECT id, cat FROM categoryUpgradeSystem WHERE active = ?");
$stmt_cat2->bind_param("i", $active_status);
$stmt_cat2->execute();
$sQuery2 = $stmt_cat2->get_result();

if ($sQuery2->num_rows > 0){
    while($data2 = $sQuery2->fetch_assoc()){
?>
<div class="upgradeableItemsContainer" id="<?= htmlspecialchars(strtolower(str_replace(" ", "", $data2['cat'])), ENT_QUOTES, 'UTF-8'); ?>" style="<?= ($data2['id'] == "1" ? "" : "display:none;"); ?>">

<?php
$catId = (int)$data2['id'];
$stmt_items = $mysqli->prepare("SELECT * FROM itemsUpgradeSystem WHERE active = ? AND catId = ?");
$stmt_items->bind_param("ii", $active_status, $catId);
$stmt_items->execute();
$sQuery3 = $stmt_items->get_result();

if ($sQuery3->num_rows > 0){
    while($data3 = $sQuery3->fetch_assoc()){
        $data3_id_escaped = htmlspecialchars($data3['id'], ENT_QUOTES, 'UTF-8');
        $availableLasers = 1; // Default
        if (!empty($data3['checkLaser'])){
            $stmt_player_equip = $mysqli->prepare('SELECT items FROM player_equipment WHERE userId = ?');
            $player_user_id_int = (int)$player['userId']; // Ensure it's int for binding
            $stmt_player_equip->bind_param("i", $player_user_id_int);
            $stmt_player_equip->execute();
            $items_result = $stmt_player_equip->get_result();
            $checkItems_assoc = $items_result->fetch_assoc();
            $stmt_player_equip->close();
            $checkItems = json_decode($checkItems_assoc['items']);

            if ($data3['checkLaser'] == "apis|zeus"){
                if (isset($checkItems->apis) && $checkItems->apis == true || isset($checkItems->zeus) && $checkItems->zeus == true){
                    $availableLasers = 1;
                } else {
                    $availableLasers = 0;
                }
            } else {
                $laserCountKey = $data3['checkLaser']."Count";
                $availableLasers = isset($checkItems->$laserCountKey) ? $checkItems->$laserCountKey : 0;
            }
        }

        if ($availableLasers > 0){
            $stmt_in_process = $mysqli->prepare("SELECT itemId FROM upgradesSystem WHERE itemId = ? and idUser = ?");
            $item_id_for_process_check = (int)$data3['id'];
            $player_user_id_for_process_check = (int)$player['userId'];
            $stmt_in_process->bind_param("ii", $item_id_for_process_check, $player_user_id_for_process_check);
            $stmt_in_process->execute();
            $checkInProcess = $stmt_in_process->get_result();
            $is_in_process = $checkInProcess->num_rows > 0;
            $stmt_in_process->close();

            if (!$is_in_process){
                if ($data3['name'] == "LF-1"){
                    $laserLvl = Functions::getLaserLvl("lf1");
                    if ($laserLvl < 16){
    ?>

<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($laserLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-2") {
    $laserLvl = Functions::getLaserLvl("lf2");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($laserLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-3") {
    $laserLvl = Functions::getLaserLvl("lf3");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($laserLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-3-Neutron") {
    $laserLvl = Functions::getLaserLvl("lf3n");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($laserLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-4-MD") {
    $laserLvl = Functions::getLaserLvl("lf4md");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($laserLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-4-PD") {
    $laserLvl = Functions::getLaserLvl("lf4pd");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($laserLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-4-HP") {
    $laserLvl = Functions::getLaserLvl("lf4hp");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($laserLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-4-SP") {
    $laserLvl = Functions::getLaserLvl("lf4sp");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($laserLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "Unstable LF-4") {
    $laserLvl = Functions::getLaserLvl("lf4unstable");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($laserLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "MP-1") {
    $laserLvl = Functions::getLaserLvl("mp1");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($laserLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-4") {
    $laserLvl = Functions::getLaserLvl("lf4");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($laserLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "Prometeus") {
    $laserLvl = Functions::getLaserLvl("lf5");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($laserLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "SG3N-A01") {
    $shieldLvl = Functions::getLaserLvl("A01");
    if ($shieldLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($shieldLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "SG3N-A02") {
    $shieldLvl = Functions::getLaserLvl("A02");
    if ($shieldLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($shieldLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "SG3N-A03") {
    $shieldLvl = Functions::getLaserLvl("A03");
    if ($shieldLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($shieldLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "SG3N-B01") {
    $shieldLvl = Functions::getLaserLvl("B01");
    if ($shieldLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($shieldLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "SG3N-B02") {
    $shieldLvl = Functions::getLaserLvl("b02"); // Note: original uses "b02", ensure case consistency if Functions::getLaserLvl is case-sensitive
    if ($shieldLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($shieldLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php } } else if ($data3['name'] == "SG3N-B03") {
    $shieldLvl = Functions::getLaserLvl("b03");
    if ($shieldLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($shieldLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
    <?php
} } else if ($data3['name'] == "Drone Level") {
    $droneLvl = Functions::getDroneLvl();
    if ($droneLvl < 6){
    ?>
<div class="item" id="ItemT_<?= $data3_id_escaped; ?>" onclick="selectItem('<?= $data3_id_escaped; ?>');">
<div class="img"><img src="<?= htmlspecialchars($data3['image'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<div class="name"><?= htmlspecialchars($data3['name'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="level" id="level_<?= $data3_id_escaped; ?>">Level <?= htmlspecialchars($droneLvl, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
    <?php
} } } } $stmt_items->close(); } } $stmt_cat2->close(); ?>
</div>
<?php } } ?>

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
