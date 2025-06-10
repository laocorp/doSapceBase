<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/public/css/premiun2.css">
<link rel="stylesheet" href="/public/css/v3b/pages/1/index.css" />

<div class="page shop"><br>
<div class="shop-container styleUpdate" style="border: 0px; border-bottom: 3px solid #ffc300 !important;">
    <div style="text-align:center;">

<table style="text-align:center;">


  <tr>

    <th>TOP</th>
    <th>Name</th>
    <th>Faction</th>
    <th>Rank</th>
	<th>Deaths</th>

  </tr>

<?php
$numero = 0;

$query = $mysqli->query("SELECT COUNT(killer_id) as total_kills, killer_id FROM log_player_kills GROUP BY `killer_id` ORDER by total_kills DESC LIMIT 30");

while($value = $query->fetch_array()){

$query3 = $mysqli->query("SELECT userId, pilotName, factionId, rankId FROM player_accounts WHERE userId = '$value[killer_id]'");

$query2 = $mysqli->query("SELECT type FROM chat_permissions WHERE userId = '$value[killer_id]'");

$dataPlayer = $query3->fetch_array();

$seeRank = 1;

if ($query2->num_rows > 0 AND $query2->fetch_array()['type'] == 1){
    $seeRank = 0;
}

if ($seeRank){

$numero++;
if ($numero == 1){
    $estilo = "#4f4731"; // Oro.
}elseif ($numero == 2){
    $estilo = "#595959"; // Plata.
}elseif($numero == 3){
     $estilo = "#594a3d"; //Bronce
}elseif($numero%2==0){
    $estilo = "#2d2d2d"; // Pares.
}else{
    $estilo = "#1d1d1d"; // Impares.
}
?>
  <tr>
    <td><?php echo $numero; ?></td>
    <td><?php echo $dataPlayer['pilotName']; ?></td>
    <td><img src="/img/companies/logo_<?php echo ($dataPlayer['factionId'] == 1 ? 'mmo' : ($dataPlayer['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png"></td>
    <td><img src="<?php echo DOMAIN; ?>img/ranks/rank_<?php echo $dataPlayer['rankId']; ?>.png"></td>
    <td><?php echo number_format($value['total_kills'], 0, ',', '.'); ?></td>
  </tr>

 <?php } } ?>

</table>

    </div>
    </div>
	</div>

	
	<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
    border: 1px solid #211f1f;
    text-align: center;
    padding: 8px;
    background-color: linen;
}
.h2, h2 {
    font-size: 30px;
    background-color: beige;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<?php require_once(INCLUDES . 'footer.php'); ?>