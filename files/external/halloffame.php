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
                <?php foreach ($mysqli->query('SELECT * FROM player_accounts WHERE rankId != 21 AND rank > 0 ORDER BY rank ASC LIMIT 300') as $value) { ?>
                  <tr>
                    <td><?php echo $value['pilotName']; ?></td>
                    <td>&nbsp;&nbsp;<?php echo $value['rank']; ?></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/img/companies/logo_<?php echo ($value['factionId'] == 1 ? 'mmo' : ($value['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png"></td>
                    <td>&nbsp;<?php echo $value['rankPoints']; ?></td>
                    <td>&nbsp;&nbsp;<img src="<?php echo DOMAIN; ?>img/ranks/rank_<?php echo $value['rankId']; ?>.png"></td>
                  </tr>
                <?php } ?>
                <?php if ($player['rank'] > 300) { ?>
                  <tr>
                    <td><?php echo $player['pilotName']; ?></td>
                    <td>&nbsp;&nbsp;<?php echo $player['rank']; ?></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/img/companies/logo_<?php echo ($value['factionId'] == 1 ? 'mmo' : ($value['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png"></td>
                    <td>&nbsp;<?php echo $player['rankPoints']; ?></td>
                    <td>&nbsp;&nbsp;<img src="<?php echo DOMAIN; ?>img/ranks/rank_<?php echo $value['rankId']; ?>.png"></td>
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
                <?php foreach ($mysqli->query('SELECT * FROM server_clans WHERE rank > 0 ORDER BY rank ASC LIMIT 300') as $value) { ?>
                  <tr>
                    <td><a href="<?php echo DOMAIN; ?>clan/clan-details/<?php echo $value['id'] ?>">[<?php echo $value['tag']; ?>] <?php echo $value['name']; ?></a></td>
                    <td><?php echo $value['rank']; ?></td>
                    <td><?php echo $value['rankPoints']; ?></td>
                  </tr>
                <?php } ?>
                <?php if (isset($clan) && $clan['rank'] > 9) { ?>
                  <tr>
                    <td>[<?php echo $clan['tag']; ?>] <?php echo $clan['name']; ?></td>
                    <td><?php echo $clan['rank']; ?></td>
                    <td><?php echo $clan['rankPoints']; ?></td>
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