<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/public/css/shipupdate.css">

<?php require_once(INCLUDES . 'data.php'); ?>

<?php // The extra ?> above was in the original, keeping it for now. ?>

<style>
input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border-radius: 4px;
  background-color: #ffffff;
    color: black;


}

input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border-radius: 4px;
  background-color: #ffffff;
    color: black;


}
input[type=submit] {
  width: 100%;
  background-color: #00a5a4;
  color: white;
  padding: 4px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #ff0000;
}
</style>



<div class="container">
<div class="page ship">
<div class="ships styleUpdate">
<div class="popup">
<div class="popup-container">
<p class="popup-text"></p>
</div>
</div>
<div class="list">

<br>
<div class="list-container shipList ps-container" style="display: block;">  
<b>Username:</b> <input type="text" value="<?php echo Functions::s($player['username']); ?>" disabled=""><br>
<b>E-Mail:</b> <input type="text" value="<?php echo Functions::s($player['email']); ?>" disabled=""><br>
<b>Pilotname:</b>

<form  id="change_pilot_name" method="post">
<input class="white-text" type="text" name="pilotName" id="pilotName" value="<?php echo Functions::s($player['pilotName']); ?>" maxlength="20" autocomplete="off" required>
<input type="submit" value="Save Change PilotName">
</form>
<b>Name Pet:</b>
<form  id="change_pet_name" method="post">
<input class="white-text" type="text" name="petName" id="petName" value="<?php echo Functions::s($player['petName']); ?>" maxlength="20" autocomplete="off" required>
<b>Select pet design:</b>

<?php
if (isset($player['petSavedDesigns']) && !empty($player['petSavedDesigns'])){
  ?>
  <select class="white-text" name="petChoosed" id="petChoosed" style="border:1px solid gray; min-width:100%; background:rgba(30,30,30,0.6);">
  <?php
  $mySavedPets = json_decode($player['petSavedDesigns'], true);
  ?>
  <option value="22" <?= (isset($player['petDesign']) && $player['petDesign'] == 22) ? "selected" : ""; ?>>Default Pet</option> <?php // Corrected condition to check $player['petDesign'] ?>
  <?php
  if (is_array($mySavedPets)) { // Ensure $mySavedPets is an array before iterating
    foreach ($mySavedPets as $dataPets_design_id){ // Variable renamed for clarity
      // Assuming $dataPets_design_id is the petDesign ID itself from the $player['petSavedDesigns'] array
      $stmt = $mysqli->prepare("SELECT petDesign, name FROM shop_items WHERE petDesign = ?");
      $stmt->bind_param("s", $dataPets_design_id); // Assuming petDesign might be string like "petdesign-xyz"
      $stmt->execute();
      $checkDataPets = $stmt->get_result();

      if ($checkDataPets->num_rows > 0){
        $dataP = $checkDataPets->fetch_assoc();
        ?>
        <option value="<?= htmlspecialchars($dataP['petDesign'], ENT_QUOTES, 'UTF-8'); ?>" <?= (isset($player['petDesign']) && $player['petDesign'] == $dataP['petDesign']) ? "selected" : ""; ?>><?= htmlspecialchars($dataP['name'], ENT_QUOTES, 'UTF-8'); ?></option>
        <?php
      }
      $stmt->close();
    }
  }
  ?>
  </select>
<?php
} else {
  ?>
  <div style="padding:5px;">You do not have any pet designs to choose from.</div> <?php // Corrected typo "por" and message clarity ?>
  <?php
}
?>
<input type="submit" value="Save Change">
</form>


</div>
</div>
<div class="infos">
<div class="selected-ship">
<div class="item">
<img id="shipPreviewImage" src="<?php echo htmlspecialchars($player['profile'], ENT_QUOTES, 'UTF-8'); ?>">
</div>
<h2 class="ship-name"><?php echo Functions::s($player['pilotName']); ?></h2>
<div class="left-column">
<b>ID</b> <span class="ship-hp"> &nbsp;&nbsp;<?php echo $player['userId']; ?></span><br>
<b>RANK</b> <span class="ship-lasers">&nbsp;&nbsp; <?php echo htmlspecialchars(Functions::GetRankName($player['rankId']), ENT_QUOTES, 'UTF-8'); // Corrected to show rank name and escaped ?></span><br>
<b>LVL</b> <span class="ship-generators"> &nbsp;&nbsp;<?php echo Functions::GetLevel($data->experience); ?></span>
</div>
<b>VERSION 3D</b>
<span><input type="checkbox" alt="selected is 3d without selecting 2d" name="version" <?php echo $player['version'] ? 'checked' : ''; ?>></span>
		
<form  id="change_profile_url" method="post">
<input class="white-text" type="text" name="urlprofile" id="urlprofile" value="<?php echo Functions::s($player['profile']); ?>" maxlength="100" autocomplete="off" required>
<input type="submit" value="Save Change Photo">
</form>

<form  id="change_password" method="post">
  <label for="fname">Change Password</label>
  <input type="password" id="fname"  name="newpassword">
  <input type="password" id="lname"  name="repeatnewpassword">
  <input type="submit" value="Save Change Password">
</form>
</div>
</div>
</div>

<?php require_once(INCLUDES . 'footer.php'); ?>