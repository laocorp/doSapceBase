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
$dataRankingUba = Functions::getDataRankingUba(100); // Call the refactored function

if ($dataRankingUba['data'] != null){
  // The 'rank' key is already provided by getDataRankingUba, which includes the $numero logic.
  // The 'color' key is also provided.
  foreach ($dataRankingUba['data'] as $data){
?>
  <tr style="background-color:<?= htmlspecialchars($data['color'], ENT_QUOTES, 'UTF-8') ?>;">
    <td><?php echo htmlspecialchars($data['pilotName'], ENT_QUOTES, 'UTF-8'); ?></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/img/companies/logo_<?php echo ($data['factionId'] == 1 ? 'mmo' : ($data['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png"></td>
    <td>&nbsp;<?php echo htmlspecialchars(number_format($data['puntos_totales'], 0, ',', '.'), ENT_QUOTES, 'UTF-8'); // Warpoints is 'puntos_totales' in getDataRankingUba ?></td>
    <td>&nbsp;<?php echo htmlspecialchars($data['rank'], ENT_QUOTES, 'UTF-8'); // This is $numero from the function ?></td>
    <td>&nbsp;&nbsp;<img src="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>img/ranks/rank_<?php echo htmlspecialchars($data['rankId'], ENT_QUOTES, 'UTF-8'); ?>.png"></td>
  </tr>

 <?php
  } // End foreach
} else {
?>
  <tr><td colspan="5">No data available in UBA ranking.</td></tr>
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
