<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/public/css/premiun2.css">
<link rel="stylesheet" href="/public/css/v3b/pages/1/index.css" />

<div class="page shop"><br>
<div class="shop-container styleUpdate">
    <div style="text-align:center;">

<table style="text-align:center;">


  <tr>

    <th>TOP</th>
    <th>PILOTNAME</th>
    <th>COMPANIES</th>
	  <th>RANK</th>
    <th>POINTS</th>

  </tr>

<?php
$numero = 0;

foreach ($mysqli->query("SELECT * FROM player_accounts WHERE rankId != 22 AND rank > 0 ORDER BY rank ASC LIMIT 30") as $value) { 

$query2 = $mysqli->query("SELECT * FROM chat_permissions WHERE userId = $value[userId]");

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
    <td><?php echo $value['pilotName']; ?></td>
    <td><img src="/img/companies/logo_<?php echo ($value['factionId'] == 1 ? 'mmo' : ($value['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png"></td>
    <td><img src="<?php echo DOMAIN; ?>img/ranks/rank_<?php echo $value['rankId']; ?>.png"></td>
    <td><?php echo number_format($value['rankPoints'], 0, ',', '.'); ?></td>
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
