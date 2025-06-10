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
$sQuery = $mysqli->query("SELECT * FROM categoryUpgradeSystem WHERE active = 1");
if ($sQuery->num_rows > 0){
    while($data = $sQuery->fetch_assoc()){
?>
<button type="button" class="btn buttonI" onclick="selectTab('<?= strtolower(str_replace(" ", "", $data['cat'])); ?>');"><?= $data['cat']; ?></button>
<?php } } ?>
</div>
</div>


<div class="upgradeableItems noselect ps-container">

<?php
$sQuery2 = $mysqli->query("SELECT * FROM categoryUpgradeSystem WHERE active = 1");
if ($sQuery2->num_rows > 0){
    while($data2 = $sQuery2->fetch_assoc()){
?>
<div class="upgradeableItemsContainer" id="<?= strtolower(str_replace(" ", "", $data2['cat'])); ?>" style="<?= ($data2['id'] == "1" ? "" : "display:none;"); ?>">

<?php
$sQuery3 = $mysqli->query("SELECT * FROM itemsUpgradeSystem WHERE active = 1 AND catId = '$data2[id]'");
if ($sQuery3->num_rows > 0){
    while($data3 = $sQuery3->fetch_assoc()){
        if (!empty($data3['checkLaser'])){
            if ($data3['checkLaser'] == "apis|zeus"){
                $checkItems = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);
                if ($checkItems->apis == true || $checkItems->zeus == true){
                    $availableLasers = 1;
                } else {
                    $availableLasers = 0;
                }
            } else {
                $checkItems = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);
                $availableLasers = $checkItems->{$data3['checkLaser']."Count"};
            }
        } else {
            $availableLasers = 1;
        }
        if ($availableLasers > 0){
            $checkInProcess = $mysqli->query("SELECT itemId FROM upgradesSystem WHERE itemId = '".$data3['id']."' and idUser = '".$player['userId']."'");
            if ($checkInProcess->num_rows == 0){
                if ($data3['name'] == "LF-1"){
                    $laserLvl = Functions::getLaserLvl("lf1");
                    if ($laserLvl < 16){
    ?>

<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $laserLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-2") {
    $laserLvl = Functions::getLaserLvl("lf2");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $laserLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-3") {
    $laserLvl = Functions::getLaserLvl("lf3");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $laserLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-3-Neutron") {
    $laserLvl = Functions::getLaserLvl("lf3n");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $laserLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-4-MD") {
    $laserLvl = Functions::getLaserLvl("lf4md");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $laserLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-4-PD") {
    $laserLvl = Functions::getLaserLvl("lf4pd");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $laserLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-4-HP") {
    $laserLvl = Functions::getLaserLvl("lf4hp");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $laserLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-4-SP") {
    $laserLvl = Functions::getLaserLvl("lf4sp");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $laserLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "Unstable LF-4") {
    $laserLvl = Functions::getLaserLvl("lf4unstable");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $laserLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "MP-1") {
    $laserLvl = Functions::getLaserLvl("mp1");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $laserLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "LF-4") {
    $laserLvl = Functions::getLaserLvl("lf4");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $laserLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "Prometeus") {
    $laserLvl = Functions::getLaserLvl("lf5");
    if ($laserLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $laserLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "SG3N-A01") {
    $shieldLvl = Functions::getLaserLvl("A01");
    if ($shieldLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $shieldLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "SG3N-A02") {
    $shieldLvl = Functions::getLaserLvl("A02");
    if ($shieldLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $shieldLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "SG3N-A03") {
    $shieldLvl = Functions::getLaserLvl("A03");
    if ($shieldLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $shieldLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "SG3N-B01") {
    $shieldLvl = Functions::getLaserLvl("B01");
    if ($shieldLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $shieldLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "SG3N-B02") {
    $shieldLvl = Functions::getLaserLvl("b02");
    if ($shieldLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $shieldLvl; ?></div>
</div>
<?php } } else if ($data3['name'] == "SG3N-B03") {
    $shieldLvl = Functions::getLaserLvl("b03");
    if ($shieldLvl < 16){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $shieldLvl; ?></div>
</div>
    <?php
} } else if ($data3['name'] == "Drone Level") {
    $droneLvl = Functions::getDroneLvl();
    if ($droneLvl < 6){
    ?>
<div class="item" id="ItemT_<?= $data3['id']; ?>" onclick="selectItem('<?= $data3['id']; ?>');">
<div class="img"><img src="<?= $data3['image']; ?>"></div>
<div class="name"><?= $data3['name']; ?></div>
<div class="level" id="level_<?= $data3['id']; ?>">Level <?= $droneLvl; ?></div>
</div>
    <?php
} } } } } } ?>
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
$sQuery = $mysqli->query("SELECT * FROM upgradesSystem WHERE idUser = '".$player['userId']."'");
if ($sQuery->num_rows > 0){
    while($dataUP = $sQuery->fetch_assoc()){

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

<div class="item fadeInLeft animated <?= ($completed == 100 ? "finished" : ""); ?>" id="UitemId_<?= $dataUP['id']; ?>" onclick="finish(<?= $dataUP['id']; ?>);">					
<div class="img"><img src="<?= $dataUP['img']; ?>"></div>
<div class="name"><?= $dataUP['name']; ?></div>
<div class="lvlToUpgrade"><?= $dataUP['lvl_base']; ?> → <?= $dataUP['new_lvl']; ?></div>
<div class="progress2" id="PitemId_<?= $dataUP['id']; ?>" data-id="<?= $dataUP['id']; ?>"><progress max="100" value="<?= $completed; ?>"></progress></div>
</div>

<?php } } ?>

</div>
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
</div>
</div>
</div>


<?php require_once(INCLUDES . 'footer.php'); ?>

