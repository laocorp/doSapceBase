<?php //if (isset($_SESSION) && isset($_SESSION['account']['id']) && $_SESSION['account']['id'] != 1){ die('Forbidden'); return; }?>
<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/css/labor.css" />

<?php require_once(INCLUDES . 'data.php'); ?>
<div class="page styleUpdate lab">
<div class="lab-container">
<div class="loader">
<div class="content">
<i class="fa fa-cog fa-spin"></i><br>
Loading
</div>
</div>
<div class="menu">
<div class="item tab-drones active">TITLES</div>
</div>
<div class="drones" style="display: block;">
<div style="width:100%; height:40%; border: 1px dashed rebeccapurple; margin-bottom:15px;">
In this area you can choose a title to put it on the server.
<div id="form" style="padding-top: 25px;">
<?php
  $titles_available = false;
  if (isset($player['userId'])) {
    $stmt_titles = $mysqli->prepare("SELECT titles FROM player_titles WHERE userID = ?");
    $stmt_titles->bind_param("i", $player['userId']);
    $stmt_titles->execute();
    $titles_result = $stmt_titles->get_result();
    if ($titles_data = $titles_result->fetch_assoc()) {
        $dataJson = json_decode($titles_data['titles'], true);
        if (is_array($dataJson) && count($dataJson) > 0){
            $titles_available = true;
            ?>
            <select id="title" class="white-text" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px;">
                <?php
                foreach ($dataJson as $dj){
                    $selected_attr = (isset($player['title']) && $player['title'] == $dj) ? "selected" : "";
                    ?>
                    <option value="<?= htmlspecialchars($dj, ENT_QUOTES, 'UTF-8'); ?>" <?= $selected_attr ?>><?= htmlspecialchars($dj, ENT_QUOTES, 'UTF-8'); ?></option>
                    <?php
                }
                ?>
            </select>
            <input type="submit" onClick="saveTitle();" value="Save title" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;">
            <?php
        }
    }
    $stmt_titles->close();
  }
  if (!$titles_available) {
    ?>
        <div style="border: 1px dashed red; padding:10px; width:70%; margin:auto;">You no have custom titles or could not fetch them.</div>
    <?php
  }
?>
</div>
<div id="message" style="text-align:center; border: 1px dashed green; padding:15px; margin:auto; width:50%; margin-top:15px; display:none;"></div>
</div>
<div style="width:100%; height:45%; border: 1px dashed rebeccapurple;">
<div id="form" style="padding-top: 25px;">
<input id="title_name" type="text" class="white-text" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px;">
<input type="submit" onClick="buyTitle();" value="Buy title" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;">
</div>
<div style="font-weight: bold; color:red; padding-top:15px;">** Important: Cost of title: 300 E.C. The titles will be added every Friday. The process is manual.</div>
<div id="messageB" style="text-align:center; border: 1px dashed green; padding:15px; margin:auto; width:50%; margin-top:15px; display:none;"></div>
</div>
</div>
</div>
</div>
<?php require_once(INCLUDES . 'footer.php'); ?>

