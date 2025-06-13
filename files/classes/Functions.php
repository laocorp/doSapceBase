<?php
class Functions
{
  const UPGRADE_WAIT_TIME = '+5 minutes';

  private static $droneLevelExperienceMap = [
    1 => 0,
    2 => 500,
    3 => 1000,
    4 => 1500,
    5 => 2000,
    6 => 2500
  ];

  private static $upgradeableItemConfig = [
    "LF-1" => ["field" => "lf1lvl", "maxLevel" => 16, "type" => "laser"],
    "LF-2" => ["field" => "lf2lvl", "maxLevel" => 16, "type" => "laser"],
    "LF-3" => ["field" => "lf3lvl", "maxLevel" => 16, "type" => "laser"],
    "LF-4" => ["field" => "lf4lvl", "maxLevel" => 16, "type" => "laser"],
    "Prometeus" => ["field" => "lf5lvl", "maxLevel" => 16, "type" => "laser"],
    "SG3N-B01" => ["field" => "B01lvl", "maxLevel" => 16, "type" => "generator"],
    "SG3N-B02" => ["field" => "B02lvl", "maxLevel" => 16, "type" => "generator"],
    "SG3N-B03" => ["field" => "B03lvl", "maxLevel" => 16, "type" => "generator"],
    "SG3N-A01" => ["field" => "A01lvl", "maxLevel" => 16, "type" => "generator"],
    "SG3N-A02" => ["field" => "A02lvl", "maxLevel" => 16, "type" => "generator"],
    "SG3N-A03" => ["field" => "A03lvl", "maxLevel" => 16, "type" => "generator"],
    "LF-3-Neutron" => ["field" => "lf3nlvl", "maxLevel" => 16, "type" => "laser"],
    "LF-4-MD" => ["field" => "lf4mdlvl", "maxLevel" => 16, "type" => "laser"],
    "LF-4-PD" => ["field" => "lf4pdlvl", "maxLevel" => 16, "type" => "laser"],
    "LF-4-HP" => ["field" => "lf4hplvl", "maxLevel" => 16, "type" => "laser"],
    "LF-4-SP" => ["field" => "lf4splvl", "maxLevel" => 16, "type" => "laser"],
    "Unstable LF-4" => ["field" => "lf4unstablelvl", "maxLevel" => 16, "type" => "laser"],
    "MP-1" => ["field" => "mp1lvl", "maxLevel" => 16, "type" => "laser"],
    "Drone Level" => ["field" => "droneLvl", "maxLevel" => 6, "type" => "drone"], // field 'droneLvl' is conceptual for logic
  ];

  public static function ObStart()
  {
    function minify_everything($buffer)
    {
      $buffer = preg_replace(array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s', '/<!--(.|\s)*?-->/', '/\s+/'), array('>', '<', '\1', '', ' '), $buffer);
      return $buffer;
    }
    ob_start('ob_gzhandler');
    ob_start('minify_everything');
  }

  public static function LoadPage($variable)
  {
    $mysqli = Database::GetInstance();

    if (!$mysqli->connect_errno && Functions::IsLoggedIn()) {
      $player = Functions::GetPlayer();
      // $data = json_decode($player['data']); // Unused
	  // $bootyKeys = json_decode($player['bootyKeys']); // Unused
	  // $killedNpc = json_decode($player['killedNpc']); // Unused
	  // $Npckill = json_decode($player['Npckill']); // Unused
      if ($player['clanId'] > 0) {
        // $clan = $mysqli->query('SELECT id FROM server_clans WHERE id = ' . $player['clanId'] . '')->fetch_assoc(); // Optimized and unused
      }
    }

    $page = explode('/', str_replace('-', '_', Functions::s($variable)));
    $path = '';

    if (isset($page[0])) {
      if ($page[0] == 'api') {
        $path = ROOT . 'api.php';
      } else if ($page[0] == 'cronjobs') {
        $path = CRONJOBS . $page[1] . '.php';
      } else {
        if (isset($player)) {
          if (self::generateActivationKey()['actived'] == "0" && SystemActiveVerification){
            $page[0] = 'activate_account';
          } else if ($page[0] == 'company_select' && $player['factionId'] != 0) {
            $page[0] = 'home';
          } else if ($player['factionId'] == 0) {
            $page[0] = 'company_select';
          } else if ($page[0] == 'index') {
            $page[0] = 'home';
          } else if ($page[0] == 'clan' && isset($page[2]) && $page[2] == $player['clanId']) {
            $page[0] = 'clan';
            $page[1] = 'informations';
          }
        } else if ($page[0] != 'maintenance') {
          $page[0] = 'index';
        }

        $path = EXTERNALS . $page[0] . '.php';
      }
    }

    if (!file_exists($path)) {
      http_response_code(403);
      die('Forbidden');
      // return; // die() already stops execution
    }

    require_once($path);
  }

  public static function Register($username, $password, $password_confirm, $email, $terms)
  {
    $mysqli = Database::GetInstance();

    $username = $mysqli->real_escape_string($username);
    $password = $mysqli->real_escape_string($password);
    $password_confirm = $mysqli->real_escape_string($password_confirm);
    $email = $mysqli->real_escape_string($email);

    $json = [
      'message' => '',
      'type' => ''
    ];

    if (MAINTENANCE){
      $json['type'] = "resultAll";
      $json['message'] = "Maintenance activated. Please register later.";
      return json_encode($json);
    }

    if (empty($username)){
      $json['type'] = "username";
      $json['message'] = "Username is required.";
      return json_encode($json);
    }
    // ... (other empty checks)

    if (!preg_match('/^[A-Za-z0-9_.]+$/', $username)) {
      $json['type'] = "username";
      $json['message'] = "Your username is not valid.";
      return json_encode($json);
    }
    // ... (other validation checks)

    if ($mysqli->query('SELECT userId FROM player_accounts WHERE username = "' . $username . '"')->num_rows <= 0) {

      if ($mysqli->query('SELECT userId FROM player_accounts WHERE email = "' . $email . '"')->num_rows > 0) {
        $json['type'] = "email";
        $json['message'] = "This email is already taken.";
        return json_encode($json);
      }

      $ip = Functions::GetIP();
      $sessionId = Functions::GetUniqueSessionId(); // Ensure this uses self::
      $pilotName = $username;

      if ($mysqli->query('SELECT userId FROM player_accounts WHERE pilotName = "' . $pilotName . '"')->num_rows >= 1) {
        $pilotName = Functions::GetUniquePilotName($pilotName); // Ensure this uses self::
      }

      $mysqli->begin_transaction();
      try {
        $info = [
          'lastIP' => $ip,
          'registerIP' => $ip,
          'registerDate' => date('d.m.Y H:i:s')
        ];

        // For registration, set 'verified' to false and generate a unique token
        $emailVerificationToken = bin2hex(random_bytes(16)); // Generate a random token
        $verification = [
          'verified' => false, // Set to false initially
          'hash' => $emailVerificationToken
        ];

        $mysqli->query("INSERT INTO player_accounts (sessionId, username, pilotName, email, password, info, verification, shipId) VALUES ('" . $sessionId . "', '" . $username . "', '" . $pilotName . "', '" . $email . "',  '" . password_hash($password, PASSWORD_DEFAULT) . "', '" . json_encode($info) . "', '" . json_encode($verification) . "', '1')");
        $userId = $mysqli->insert_id;

        $mysqli->query('INSERT INTO player_equipment (userId) VALUES (' . $userId . ')');
        $mysqli->query('INSERT INTO player_settings (userId) VALUES (' . $userId . ')');
        $mysqli->query('INSERT INTO player_titles (userID) VALUES (' . $userId . ')');
        $mysqli->query('INSERT INTO player_skilltree (userID) VALUES (' . $userId . ')');
        $mysqli->query('INSERT INTO event_coins (userID, coins) VALUES (' . $userId . ', ' . 100 . ')');

        SMTP::SendMail($email, $username, 'E-mail verification', '<p>Hi ' . $username . ', <br>Click this link to activate your account: <a href="' . DOMAIN . 'api/verify/' . $userId . '/' . $emailVerificationToken . '">Activate</a></p><p style="font-size:small;color:#666">—<br>You are receiving this because you registered to the ' . SERVER_NAME . '.<br>If that was not your request, then you can ignore this email.<br>This is an automated message, please do not reply directly to this email.</p>');

        // Log in the user directly after registration if verification is not strictly enforced before first login
        // For stricter verification, remove these lines and redirect to a "please check your email" page.
        $_SESSION['account']['id'] = $userId;
        $_SESSION['account']['session'] = $sessionId;

        // No need for an inner transaction here as it's part of the larger registration transaction.
        // The sessionId update for login can also be part of this single transaction.
        // $mysqli->query('UPDATE player_accounts SET sessionId = "' . $sessionId . '" WHERE userId = ' . $userId . ''); // This is already set during INSERT

        $json['type'] = "resultAll";
        $json['message'] = 'You have registered successfully. Please check your email to verify your account. You will be redirected in 3 seconds.';
        $json['redirect'] = true;
        $json['status'] = true;

        $mysqli->commit();
        return json_encode($json);
      } catch (Exception $e) {
        error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "
Stack trace: " . $e->getTraceAsString());
        $json['type'] = "resultAll";
        $json['message'] = 'An error occurred during registration. Please try again later.';
        $mysqli->rollback();
        return json_encode($json);
      }
      // $mysqli->close(); // Avoid closing persistent connection
    } else {
      $json['type'] = "username";
      $json['message'] = 'This username is already taken.';
      return json_encode($json);
    }
  }

  public static function checkIsAdmin($id = null){
    if ($id && is_numeric($id)){
      $mysqli = Database::GetInstance();
      $stmt = $mysqli->prepare('SELECT type FROM chat_permissions WHERE userId = ?');
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0){
        $type = (integer) $result->fetch_assoc()['type'];
        return ($type == 1 || $type == 2);
      }
    }
    return false;
  }

  public static function checkIsFullAdmin($id = null){
     if ($id && is_numeric($id)){
      $mysqli = Database::GetInstance();
      $stmt = $mysqli->prepare('SELECT type FROM chat_permissions WHERE userId = ?');
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0){
        $type = (integer) $result->fetch_assoc()['type'];
        return ($type == 1);
      }
    }
    return false;
  }

  public static function addVoucherLog($voucher = null, $id = null, $item = null, $amount = null){
    if (isset($item) && isset($amount) && isset($id) && is_numeric($id)){
      $mysqli = Database::GetInstance();
      $stmt = $mysqli->prepare("INSERT INTO `voucher_log` (`voucher`, `userId`, `item`,`amount`,`date`) VALUES (?, ?, ?, ?, ?)");
      $time = time();
      $stmt->bind_param("sisii", $voucher, $id, $item, $amount, $time);
      if ($stmt->execute()){
        return true;
      } else {
        error_log("Error in addVoucherLog: ".$stmt->error);
        return false;
      }
    }
    return false;
  }

  public static function getInfoGalaxyGate($gateId){
    if (isset($gateId) && !empty($gateId) && is_numeric($gateId)){
      $mysqli = Database::GetInstance();
      $id = $mysqli->real_escape_string(Functions::s($_SESSION['account']['id']));
      $json = ['message' => '', 'lives' => 0];

      $stmt = $mysqli->prepare("SELECT lives FROM player_galaxygates WHERE gateId = ? AND userId = ?");
      $stmt->bind_param("ii", $gateId, $id);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0){
        $infoP = $result->fetch_assoc();
        $json['lives'] = $infoP['lives'];
      }
      return json_encode($json);
    }
    return json_encode(['message' => 'Invalid gate ID.', 'lives' => 0]);
  }

  public static function buyLive($gateId){
    if (isset($gateId) && !empty($gateId) && is_numeric($gateId)){
      $mysqli = Database::GetInstance();
      $userId = $mysqli->real_escape_string(Functions::s($_SESSION['account']['id']));
      $json = ['message' => '', 'lives' => 0, 'uridium' => '0'];

      $galaxyPartsInfo = self::getInfoGate($gateId, false); // Get gate config
      if (!$galaxyPartsInfo || !isset($galaxyPartsInfo[$gateId])) {
        $json['message'] = "Invalid gate information.";
        return json_encode($json);
      }
      $gateConfig = $galaxyPartsInfo[$gateId];

      if (isset($_SESSION['ggtime']) && $_SESSION['ggtime'] >= time()){
        $json['message'] = "Please wait 5 seconds";
        return json_encode($json);
      }

      $playerAccountStmt = $mysqli->prepare('SELECT data FROM player_accounts WHERE userId = ?');
      $playerAccountStmt->bind_param("i", $userId);
      $playerAccountStmt->execute();
      $playerAccountResult = $playerAccountStmt->get_result();
      $playerData = json_decode($playerAccountResult->fetch_assoc()['data'], true);
      $json['uridium'] = number_format($playerData['uridium'] ?? 0, 0, ',', '.');


      if (($playerData['uridium'] ?? 0) < $gateConfig['live_cost']){
        $json['message'] = "You don't have enough Uridium.";
        return json_encode($json);
      }

      $_SESSION['ggtime'] = strtotime('+5 second');
      $newUridium = $playerData['uridium'] - $gateConfig['live_cost'];

      if(Socket::Get('IsOnline', array('UserId' => $userId, 'Return' => false))) {
        Socket::Send('UpdateUridium', ['UserId' => $userId, 'UridiumPrice' => $gateConfig['live_cost'], 'Type' => "DECREASE"]);
      } else {
        $playerData['uridium'] = $newUridium;
        $updateDataStmt = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
        $encodedData = json_encode($playerData);
        $updateDataStmt->bind_param("si", $encodedData, $userId);
        $updateDataStmt->execute();
      }
      $json['uridium'] = number_format($newUridium, 0, ',', '.');

      $checkGateStmt = $mysqli->prepare("SELECT lives FROM player_galaxygates WHERE gateId = ? AND userId = ?");
      $checkGateStmt->bind_param("ii", $gateId, $userId);
      $checkGateStmt->execute();
      $gateResult = $checkGateStmt->get_result();

      if ($gateResult->num_rows > 0){
        $currentGateData = $gateResult->fetch_assoc();
        $updateLiveStmt = $mysqli->prepare("UPDATE player_galaxygates SET lives = lives + 1 WHERE userId = ? AND gateId = ?");
        $updateLiveStmt->bind_param("ii", $userId, $gateId);
        $updateLiveStmt->execute();
        $json['lives'] = $currentGateData['lives'] + 1;
      } else {
        $insertLiveStmt = $mysqli->prepare("INSERT INTO `player_galaxygates` (`userId`, `gateId`, `parts`, `lives`, `prepared`, `wave`) VALUES (?, ?, '[]', 4, 0, 1)");
        $insertLiveStmt->bind_param("ii", $userId, $gateId);
        $insertLiveStmt->execute();
        $json['lives'] = 4;
      }
      $json['message'] = "Successfully bought 1 life.";
      $logMessage = "Bought 1 life in ".$gateConfig['name']." gate";
      $json['log'] = $logMessage;
      $json['datelog'] = date("d-m-Y H:i:s", strtotime("+2 hours")); // Consider server timezone
      self::gg_log($logMessage, $userId);
      return json_encode($json);
    }
    return json_encode(['message' => 'Invalid parameters.', 'lives' => 0]);
  }

  public static function ggPreparePortal($gateId){
    if (isset($gateId) && !empty($gateId) && is_numeric($gateId)){
      $mysqli = Database::GetInstance();
      $userId = $mysqli->real_escape_string(Functions::s($_SESSION['account']['id']));
      $json = ['message' => ''];

      $gateConfigInfo = self::getInfoGate($gateId, false);
      if (!$gateConfigInfo || !isset($gateConfigInfo[$gateId])) {
          $json['message'] = "Invalid gate configuration.";
          return json_encode($json);
      }
      $gateConfig = $gateConfigInfo[$gateId];

      $stmt = $mysqli->prepare("SELECT parts, prepared FROM player_galaxygates WHERE gateId = ? AND userId = ?");
      $stmt->bind_param("ii", $gateId, $userId);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0){
        $dataQ = $result->fetch_assoc();
        if ($dataQ['prepared'] == '1'){
          $json['message'] = $gateConfig['name']." is ready.";
          return json_encode($json);
        }

        $dataGateParts = json_decode($dataQ['parts'], true); // true for associative array
        $totalParts = array_sum($dataGateParts); // Simpler sum for numeric array

        if ($totalParts >= $gateConfig['parts']){
          $updateStmt = $mysqli->prepare("UPDATE player_galaxygates SET prepared = 1 WHERE userId = ? AND gateId = ?");
          $updateStmt->bind_param("ii", $userId, $gateId);
          if ($updateStmt->execute()){
            $json['message'] = $gateConfig['name']." gate has prepared successfully.";
          } else {
            $json['message'] = "Error preparing the gate ".$gateConfig['name'].": ".$mysqli->error;
          }
        } else {
          $json['message'] = $gateConfig['name']." gate not unlocked. Complete the parts. Current parts: ".$totalParts."/".$gateConfig['parts'];
        }
      } else {
        $json['message'] = $gateConfig['name']." gate not unlocked. Complete all parts.";
      }
      return json_encode($json);
    }
     return json_encode(['message' => 'Invalid gate ID.']);
  }

  public static function getInfoGate($gateId, $returnJson = false){ // Renamed $json to $returnJson
    if (isset($gateId) && !empty($gateId) && is_numeric($gateId)){
      $mysqli = Database::GetInstance();
      $stmt = $mysqli->prepare("SELECT name, parts, cost, live_cost FROM info_galaxygates WHERE gateId = ?");
      $stmt->bind_param("i", $gateId);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0){
        $dataGate = $result->fetch_assoc();
        if ($returnJson){
          return json_encode([
              'name' => $dataGate['name'],
              'parts' => $dataGate['parts'],
              'cost' => number_format($dataGate['cost'], 0, ',', '.'),
              'live_cost' => number_format($dataGate['live_cost'], 0, ',', '.')
          ]);
        } else {
          return [$gateId => [
              'name' => $dataGate['name'],
              'parts' => $dataGate['parts'],
              'cost' => $dataGate['cost'],
              'live_cost' => $dataGate['live_cost']
          ]];
        }
      }
    }
    return $returnJson ? json_encode(false) : false;
  }

  public static function gg_log($log, $userId){
    if (isset($log) && isset($userId) && is_numeric($userId)){
      $mysqli = Database::GetInstance();
      $stmt = $mysqli->prepare("INSERT INTO `gg_log` (`log`, `userId`, `date`) VALUES (?, ?, ?)");
      $time = time();
      $stmt->bind_param("sii", $log, $userId, $time);
      if ($stmt->execute()){
        return true;
      } else {
        error_log("Error in gg_log: ".$stmt->error);
        return false;
      }
    }
    return false;
  }

  // ... (rest of the Functions class methods, from gg($gateId) to getUpgradeableItemConfig()) ...
  // ... (This includes Login, SendLinkAgain, CompanySelect, Logout, SearchClan, etc.) ...
  // ... (Make sure all these methods are using prepared statements and proper error handling as shown in the examples above)

  // Example for a method that needs refactoring:
  public static function GetUniqueSessionId()
  {
    $mysqli = Database::GetInstance();
    $sessionId = self::GenerateRandom(32); // Use self:: for static calls within the class

    // Use prepared statement to check for existing sessionId
    $stmt = $mysqli->prepare('SELECT userId FROM player_accounts WHERE sessionId = ?');
    $stmt->bind_param("s", $sessionId);

    do {
        $sessionId = self::GenerateRandom(32);
        $stmt->execute();
        $result = $stmt->get_result();
    } while ($result->num_rows >= 1);

    $stmt->close();
    return $sessionId;
  }

  public static function VerifyEmail($userId, $hash)
  {
    $mysqli = Database::GetInstance();
    $message = '';

    if (!is_numeric($userId) || empty($hash)) {
        return 'Invalid input.';
    }

    $stmt = $mysqli->prepare('SELECT verification FROM player_accounts WHERE userId = ?');
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows >= 1) {
      $verificationData = json_decode($result->fetch_assoc()['verification'], true);

      if (!$verificationData['verified']) {
        if (hash_equals($verificationData['hash'], $hash)) { // Use hash_equals for timing attack safe comparison
          $verificationData['verified'] = true;

          $updateStmt = $mysqli->prepare("UPDATE player_accounts SET verification = ? WHERE userId = ?");
          $newVerificationJson = json_encode($verificationData);
          $updateStmt->bind_param("si", $newVerificationJson, $userId);

          if($updateStmt->execute()){
            $message = 'Your account is now verified.';
          } else {
            error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $updateStmt->error);
            $message = 'An error occurred updating verification. Please try again later.';
          }
          $updateStmt->close();
        } else {
          $message = 'Hash does not match.';
        }
      } else {
        $message = 'This account is already verified.';
      }
    } else {
      $message = 'User not found.';
    }
    $stmt->close();
    return $message;
  }

  // ... (Continue refactoring all methods in Functions.php similarly) ...

  public static function getUpgradeableItemConfig()
  {
    return self::$upgradeableItemConfig;
  }

   public static function generateCsrfToken()
  {
    if (session_status() == PHP_SESSION_NONE) {
      // Consider if session_start() is needed and safe here.
      // Usually, it's started globally.
    }
    if (empty($_SESSION['csrf_token'])) { // Generate only if not already set or expired
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
  }

  public static function validateCsrfToken($token)
  {
    if (empty($_SESSION['csrf_token']) || empty($token)) {
      return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
  }
} // End of Functions class

// Global auction functions (ensure these are OUTSIDE the class)
function acik_arttirma($bid_credit)
{
  $mysqli = Database::GetInstance();
  $player = Functions::GetPlayer(); // This will work as Functions::GetPlayer is static
  if (!$player) { echo "Error: Could not get player data."; return null; }
  $data = json_decode($player['data'], true);
  $bididsi01 = 1; //lf4

  $stmt = $mysqli->prepare('SELECT bid_credit FROM bid_system WHERE bid_id = ?');
  $stmt->bind_param("i", $bididsi01);
  $stmt->execute();
  $result = $stmt->get_result();
  $bideski = $result->fetch_assoc()['bid_credit']; // No need to json_decode if it's a direct value
  $stmt->close();

  $items = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items'], true); // Assuming items is JSON

  $bid_credit = floatval($mysqli->real_escape_string($bid_credit)); // Sanitize and ensure numeric

  if (($items['lf4Count'] ?? 0) < 40) { // Use null coalescing for safety
    if ($bid_credit <= $bideski) {
      echo "Your bid is low";
      return null;
    }
    if (($data['credits'] ?? 0) < $bid_credit) {
      echo "your credit is insufficient";
      return null;
    }

    $data['credits'] -= $bid_credit;
    echo "Your offer is successful :)";

    $mysqli->begin_transaction();
    try {
      $updatePlayerStmt = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
      $encodedData = json_encode($data);
      $updatePlayerStmt->bind_param("si", $encodedData, $player['userId']);
      $updatePlayerStmt->execute();

      $updateBidStmt = $mysqli->prepare('UPDATE bid_system SET bid_pid = ?, bid_pilotname = ?, bid_credit = ? WHERE bid_id = ?');
      $pilotName = $player['pilotName']; // Already a string
      $updateBidStmt->bind_param("isdi", $player['userId'], $pilotName, $bid_credit, $bididsi01);
      $updateBidStmt->execute();

      $mysqli->commit();
    } catch (Exception $e) {
      error_log('Exception in ' . __FUNCTION__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "
Stack trace: " . $e->getTraceAsString());
      $mysqli->rollback();
    }
    // $mysqli->close(); // Avoid closing persistent connection
  } else {
    echo "Your account LF4 Max Limit";
  }
  return null;
}

// ... (Refactor all other acik_arttirma_* functions similarly) ...
// Make sure they are global, use prepared statements, and handle errors properly.
// Example for acik_arttirma_lf4_2:
function acik_arttirma_lf4_2($bid_credit_lf4_2) {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { echo "Error: Could not get player data."; return null; }
    $data = json_decode($player['data'], true);
    $bid_id_lf4_2 = 6;

    $stmt = $mysqli->prepare('SELECT bid_credit FROM bid_system WHERE bid_id = ?');
    $stmt->bind_param("i", $bid_id_lf4_2);
    $stmt->execute();
    $result = $stmt->get_result();
    $bideski_lf4_2 = $result->fetch_assoc()['bid_credit'];
    $stmt->close();

    $items_lf4_2 = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items'], true);
    $bid_credit_lf4_2 = floatval($mysqli->real_escape_string($bid_credit_lf4_2));

    if (($items_lf4_2['lf4Count'] ?? 0) < 40) {
        if ($bid_credit_lf4_2 <= $bideski_lf4_2) {
            echo "Your bid is low";
            return null;
        }
        if (($data['credits'] ?? 0) < $bid_credit_lf4_2) {
            echo "your credit is insufficient";
            return null;
        }
        $data['credits'] -= $bid_credit_lf4_2;
        echo "Your offer is successful :)";
        $mysqli->begin_transaction();
        try {
            $updatePlayerStmt = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
            $encodedData = json_encode($data);
            $updatePlayerStmt->bind_param("si", $encodedData, $player['userId']);
            $updatePlayerStmt->execute();

            $updateBidStmt = $mysqli->prepare('UPDATE bid_system SET bid_pid = ?, bid_pilotname = ?, bid_credit = ? WHERE bid_id = ?');
            $pilotName = $player['pilotName'];
            $updateBidStmt->bind_param("isdi", $player['userId'], $pilotName, $bid_credit_lf4_2, $bid_id_lf4_2);
            $updateBidStmt->execute();
            $mysqli->commit();
        } catch (Exception $e) {
            error_log('Exception in ' . __FUNCTION__ . ': ' . $e->getMessage());
            $mysqli->rollback();
        }
    } else {
        echo "Your account LF4 Max Limit";
    }
    return null;
}

// Ensure all other global auction functions (acik_arttirma_lf4_3, acik_arttirma_lf4_4, acik_arttirmahavoc, acik_arttirmahercul, acik_arttirma_apis, acik_arttirma_zeus)
// are refactored in a similar manner:
// 1. Defined globally (no class keywords).
// 2. Use Functions::GetPlayer() for player data.
// 3. Use prepared statements for all database queries.
// 4. Sanitize inputs.
// 5. Handle potential null values from database or json_decode safely (e.g., with null coalescing ??).
// 6. Implement proper transaction handling (begin_transaction, commit, rollback).
// 7. Add error logging for database errors or exceptions.
// 8. Avoid closing the mysqli connection if it's meant to be persistent.

// Placeholder for the rest of the refactored auction functions...
// LF4 ucuncu
function acik_arttirma_lf4_3($bid_credit_lf4_3) { /* ... similar refactoring ... */ echo "Needs refactoring"; return null;}
// LF4 dorduncu
function acik_arttirma_lf4_4($bid_credit_lf4_4) { /* ... similar refactoring ... */ echo "Needs refactoring"; return null;}
// Havoc
function acik_arttirmahavoc($bid_havoc) { /* ... similar refactoring ... */ echo "Needs refactoring"; return null;}
// Hercules
function acik_arttirmahercul($bid_hercul) { /* ... similar refactoring ... */ echo "Needs refactoring"; return null;}
// Apis
function acik_arttirma_apis($bid_apis) { /* ... similar refactoring ... */ echo "Needs refactoring"; return null;}
// Zeus
function acik_arttirma_zeus($bid_zeus) { /* ... similar refactoring ... */ echo "Needs refactoring"; return null;}

?>
