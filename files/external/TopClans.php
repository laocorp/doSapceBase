<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/public/css/premiun2.css">
<link rel="stylesheet" href="/public/css/v3b/pages/1/index.css" />

<div class="page shop"><br>
<div class="shop-container styleUpdate">
    <div style="text-align:center;">

<table style="text-align:center;">


  <tr>

    <th>Name</th>
    <th>Top</th>
    <th>Points</th>

  </tr>

  <?php
  $dataRankingClan = Functions::getDataRankingClan(300);
  if ($dataRankingClan['data'] != null){
  foreach ($dataRankingClan['data'] as $data){
    ?>
    <tr>
    <td>[<?php echo $data['tag']; ?>] <?php echo $data['name']; ?></td>
    <td><?php echo $data['rank']; ?></td>
    <td><?php echo number_format($data['rankPoints'], 0, ',', '.'); ?></td>
    </tr>
    <?php
  } }
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
