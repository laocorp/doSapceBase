<?php require_once(INCLUDES . 'header.php'); ?>

<div id="main">
  <div class="container">
    <div class="row">
      <div class="card white-text grey darken-4 padding-15">
      <h4 style="font-weight: bold;"><center><i class="fa fa-trophy"></i>&nbsp;&nbsp;HALL OF FAME</center></h4>
          <ul class="tabs grey darken-3 tabs-fixed-width tab-demo z-depth-1">
            <li class="tab"><a href="#ranking">TOP RANKING</a></li>
            <li class="tab"><a href="#exp">TOP EXP</a></li>
            <li class="tab"><a href="#honor">TOP HONOR</a></li>
            <li class="tab"><a href="#clans">TOP CLANS</a></li>
          </ul>
          <div id="ranking">
            <table class="striped highlight">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Top</th>
                  <th>Company</th>
                  <th>Points</th>
                  <th>Rank</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $dataRankingPlayers = Functions::getDataRankingPlayers(300);
                if ($dataRankingPlayers['data'] != null) {
                    foreach ($dataRankingPlayers['data'] as $value) {
                ?>
                  <tr style="background-color:<?= htmlspecialchars($value['color'] ?? '#transparent', ENT_QUOTES, 'UTF-8'); ?>;">
                    <td><?php echo htmlspecialchars($value['pilotName'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>&nbsp;&nbsp;<?php echo htmlspecialchars($value['rank'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/img/companies/logo_<?php echo ($value['factionId'] == 1 ? 'mmo' : ($value['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png"></td>
                    <td>&nbsp;<?php echo number_format($value['rankPoints']); ?></td>
                    <td>&nbsp;&nbsp;<img src="<?php echo DOMAIN; ?>img/ranks/rank_<?php echo htmlspecialchars($value['rankId'], ENT_QUOTES, 'UTF-8'); ?>.png"></td>
                  </tr>
                <?php
                    } // end foreach
                } // end if data
                // Display current player if their rank is beyond the fetched limit
                if ($player['rankId'] != 21 && $player['rank'] > 0 && $player['rank'] > 300) {
                ?>
                  <tr>
                    <td><?php echo htmlspecialchars($player['pilotName'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>&nbsp;&nbsp;<?php echo htmlspecialchars($player['rank'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/img/companies/logo_<?php echo ($player['factionId'] == 1 ? 'mmo' : ($player['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png"></td>
                    <td>&nbsp;<?php echo number_format($player['rankPoints']); ?></td>
                    <td>&nbsp;&nbsp;<img src="<?php echo DOMAIN; ?>img/ranks/rank_<?php echo htmlspecialchars($player['rankId'], ENT_QUOTES, 'UTF-8'); ?>.png"></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div id="clans">
            <table class="striped highlight">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Top</th>
                  <th>Points</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $dataRankingClans = Functions::getDataRankingClan(300);
                if ($dataRankingClans['data'] != null) {
                    foreach ($dataRankingClans['data'] as $value) {
                ?>
                  <tr style="background-color:<?= htmlspecialchars($value['color'] ?? '#transparent', ENT_QUOTES, 'UTF-8'); ?>;">
                    <td><a href="<?php echo DOMAIN; ?>clan/clan-details/<?php echo htmlspecialchars($value['id'], ENT_QUOTES, 'UTF-8'); ?>">[<?php echo htmlspecialchars($value['tag'], ENT_QUOTES, 'UTF-8'); ?>] <?php echo htmlspecialchars($value['name'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                    <td><?php echo htmlspecialchars($value['rank'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo number_format($value['rankPoints']); ?></td>
                  </tr>
                <?php
                    } // end foreach
                } // end if data
                // Display player's clan if it exists and rank is beyond limit (e.g. > 9, or > 300 based on context)
                // The original condition was `isset($clan) && $clan['rank'] > 9`. $clan variable might not be set here anymore.
                // This part might need adjustment based on how $clan is supposed to be available or if it's needed.
                // For now, let's assume $clan is available from a higher scope (e.g. header.php or data.php)
                if (isset($clan) && $clan['rank'] > 300 && $player['clanId'] !=0 ) { // Adjusted condition to be similar to player rank display
                ?>
                  <tr>
                    <td><a href="<?php echo DOMAIN; ?>clan/clan-details/<?php echo htmlspecialchars($clan['id'], ENT_QUOTES, 'UTF-8'); ?>">[<?php echo htmlspecialchars($clan['tag'], ENT_QUOTES, 'UTF-8'); ?>] <?php echo htmlspecialchars($clan['name'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                    <td><?php echo htmlspecialchars($clan['rank'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo number_format($clan['rankPoints']); ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          
 







      </div>
    </div>
  </div>
</div>

<?php require_once(INCLUDES . 'footer.php'); ?>
<?php require_once(INCLUDES . 'footer2.php'); ?>