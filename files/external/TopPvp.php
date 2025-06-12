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
	<th>Kills</th> <?php // Changed "Deaths" to "Kills" as 'rankPoints' refers to PvP kills ?>

  </tr>

<?php
$dataRankingPvp = Functions::getDataRankingPvp(30); // Call the refactored function

if ($dataRankingPvp['data'] != null){
  // The 'rank' key is already provided by getDataRankingPvp, which includes the $numero logic.
  // The 'color' key is also provided for styling.
  foreach ($dataRankingPvp['data'] as $data){
?>
  <tr style="background-color:<?= htmlspecialchars($data['color'], ENT_QUOTES, 'UTF-8'); ?>;">
    <td><?php echo htmlspecialchars($data['rank'], ENT_QUOTES, 'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($data['pilotName'], ENT_QUOTES, 'UTF-8'); ?></td>
    <td><img src="/img/companies/logo_<?php echo ($data['factionId'] == 1 ? 'mmo' : ($data['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png"></td>
    <td><img src="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>img/ranks/rank_<?php echo htmlspecialchars($data['rankId'], ENT_QUOTES, 'UTF-8'); ?>.png"></td>
    <td><?php echo htmlspecialchars(number_format($data['rankPoints'], 0, ',', '.'), ENT_QUOTES, 'UTF-8'); // PvP kills are in 'rankPoints' ?></td>
  </tr>

 <?php
  } // End foreach
} else {
?>
  <tr><td colspan="5">No data available in PvP ranking.</td></tr>
<?php
} // End if
?>

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