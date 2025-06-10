<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/public/css/premiun2.css">
<link rel="stylesheet" href="/public/css/v3b/pages/1/index.css" />

<div class="page shop"><br>
<div class="shop-container styleUpdate">
    <div style="text-align:center;">

<table style="text-align:center;">


  <tr>

    <th>Name</th>
    <th>Company</th>
    <th>Points</th>
	  <th>TOP</th>
    <th>Rank</th>

  </tr>

<?php
$numero = 0;

$sql = $mysqli->query("SELECT pilotName, userId, factionId, warPoints, rankId FROM player_accounts WHERE warPoints > 0 ORDER by warPoints DESC LIMIT 100");

while($data = $sql->fetch_assoc()){

  $query2 = $mysqli->query("SELECT * FROM chat_permissions WHERE userId = $data[userId]");
  $seeRank = 1;

  if ($query2->num_rows > 0 AND $query2->fetch_array()['type'] == 1){
    $seeRank = 0;
  }

  $numero++;

  if ($seeRank){

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

  <td><?php echo $data['pilotName']; ?></td>
  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/img/companies/logo_<?php echo ($data['factionId'] == 1 ? 'mmo' : ($data['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png"></td>
  <td>&nbsp;<?php echo number_format($data['warPoints'], 0, ',', '.'); ?></td>
  <td>&nbsp;<?php echo $numero; ?></td>
  <td>&nbsp;&nbsp;<img src="<?php echo DOMAIN; ?>img/ranks/rank_<?php echo $data['rankId']; ?>.png"></td>
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
