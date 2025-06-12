<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/public/css/premiun2.css">
<link rel="stylesheet" href="/public/css/v3b/pages/1/index.css" />

<div class="page shop"><br>
<div class="shop-container styleUpdate" style="border: 0px; border-bottom: 3px solid #ffc300 !important;">
    <div style="text-align:center;">

<table style="text-align:center;">


  <tr>

    <th>TOP</th>
    <th>PILOTNAME</th>
    <th>COMPANIES</th>
	<th>RANK</th>
    <th>HONOR</th>

  </tr>

<?php
$dataRankingHonor = Functions::getDataRankingHonor(30); // Call the new refactored function

if ($dataRankingHonor['data'] != null){
  // The 'rank' key is already provided by getDataRankingHonor, which includes the $numero logic.
  // The 'color' key is also provided for styling.
  // 'rankPoints' in the returned array actually holds 'honor' for this specific function.
  foreach ($dataRankingHonor['data'] as $data){
?>
  <tr style="background-color:<?= htmlspecialchars($data['color'], ENT_QUOTES, 'UTF-8'); ?>;">
    <td><?php echo htmlspecialchars($data['rank'], ENT_QUOTES, 'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($data['pilotName'], ENT_QUOTES, 'UTF-8'); ?></td>
    <td><img src="/img/companies/logo_<?php echo ($data['factionId'] == 1 ? 'mmo' : ($data['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png"></td>
    <td><img src="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>img/ranks/rank_<?php echo htmlspecialchars($data['rankId'], ENT_QUOTES, 'UTF-8'); ?>.png"></td>
    <td><?php echo htmlspecialchars(number_format($data['rankPoints'], 0, ',', '.'), ENT_QUOTES, 'UTF-8'); // This is honor, escaped for consistency ?></td>
  </tr>

 <?php
  } // End foreach
} else {
?>
  <tr><td colspan="5">No data available in honor ranking.</td></tr>
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