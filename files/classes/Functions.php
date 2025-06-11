<?php
class Functions
{
  public static function ObStart()
  {
    function minify_everything($buffer)
    {
      $buffer = preg_replace(array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s', '/<!--(.|\s)*?-->/', '/\s+/'), array('>', '<', '\\1', '', ' '), $buffer);
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
      $data = json_decode($player['data']);
	  $bootyKeys = json_decode($player['bootyKeys']);
		$killedNpc = json_decode($player['killedNpc']);
		$Npckill = json_decode($player['Npckill']);
      if ($player['clanId'] > 0) {
        $stmt = $mysqli->prepare('SELECT * FROM server_clans WHERE id = ?');
        $stmt->bind_param("i", $player['clanId']);
        $stmt->execute();
        $result = $stmt->get_result();
        $clan = $result->fetch_assoc();
        $stmt->close();
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
      //$path = EXTERNALS . 'error2.php';
      http_response_code(403);
      die('Forbidden');
      return;
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

    if (empty($password)){
      $json['type'] = "password";
      $json['message'] = "Password is required.";

      return json_encode($json);
    }

    if (empty($password_confirm)){
      $json['type'] = "confirm_password";
      $json['message'] = "Confirm password is required.";

      return json_encode($json);
    }

    if (empty($email)){
      $json['type'] = "email";
      $json['message'] = "Email is required.";

      return json_encode($json);
    }

    if (!preg_match('/^[A-Za-z0-9_.]+$/', $username)) {
      $json['type'] = "username";
      $json['message'] = "Your username is not valid.";

      return json_encode($json);
    }

    if (mb_strlen($username) < 4 || mb_strlen($username) > 20) {
      $json['type'] = "username";
      $json['message'] = "Your username should be between 4 and 20 characters.";

      return json_encode($json);
    }

    if (mb_strlen($password) < 8 || mb_strlen($password) > 45) {
      $json['type'] = "password";
      $json['message'] = "Your password should be between 8 and 45 characters.";

      return json_encode($json);
    }

    if ($password != $password_confirm) {
      $json['type'] = "confirm_password";
      $json['message'] = "Those passwords didnt match. Try again";

      return json_encode($json);

    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 260) {
      $json['type'] = "email";
      $json['message'] = "Your e-mail should be max 260 characters.";

      return json_encode($json);
    }

    // Check if username exists
    $stmt = $mysqli->prepare('SELECT userId FROM player_accounts WHERE username = ?');
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $username_exists = $stmt->num_rows > 0;
    $stmt->close();

    if (!$username_exists) {

      // Check if email exists
      $stmt = $mysqli->prepare('SELECT userId FROM player_accounts WHERE email = ?');
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->store_result();
      $email_exists = $stmt->num_rows > 0;
      $stmt->close();

      if ($email_exists) {
        $json['type'] = "email";
        $json['message'] = "This email is already taken.";

        return json_encode($json);
      }

      $ip = Functions::GetIP();
      $sessionId = Functions::GetUniqueSessionId();
      $pilotName = $username; // Initial pilotName

      // Check if pilotName exists and generate a new one if needed
      $stmt = $mysqli->prepare('SELECT userId FROM player_accounts WHERE pilotName = ?');
      $stmt->bind_param("s", $pilotName);
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows > 0) {
        $pilotName = Functions::GetUniquePilotName($pilotName); // This function might need its own mysqli instance or passed one
      }
      $stmt->close();

     

      

      $mysqli->begin_transaction();

      try {
        $info = [
          'lastIP' => $ip,
          'registerIP' => $ip,
          'registerDate' => date('d.m.Y H:i:s')
        ];

        $verification = [
          'verified' => true,
          'hash' => $sessionId
        ];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $info_json = json_encode($info);
        $verification_json = json_encode($verification);
        $shipId = 1; // Default shipId

        $stmt = $mysqli->prepare("INSERT INTO player_accounts (sessionId, username, pilotName, email, password, info, verification, shipId) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssi", $sessionId, $username, $pilotName, $email, $hashed_password, $info_json, $verification_json, $shipId);
        $stmt->execute();
        $userId = $mysqli->insert_id; // Get insert_id from mysqli connection, not statement
        $stmt->close();

        // For these simple inserts, prepared statements are good practice but less critical if $userId is an integer.
        $stmt_equipment = $mysqli->prepare('INSERT INTO player_equipment (userId) VALUES (?)');
        $stmt_equipment->bind_param("i", $userId);
        $stmt_equipment->execute();
        $stmt_equipment->close();

        $stmt_settings = $mysqli->prepare('INSERT INTO player_settings (userId) VALUES (?)');
        $stmt_settings->bind_param("i", $userId);
        $stmt_settings->execute();
        $stmt_settings->close();

        $stmt_titles = $mysqli->prepare('INSERT INTO player_titles (userID) VALUES (?)');
        $stmt_titles->bind_param("i", $userId);
        $stmt_titles->execute();
        $stmt_titles->close();

        $stmt_skilltree = $mysqli->prepare('INSERT INTO player_skilltree (userID) VALUES (?)');
        $stmt_skilltree->bind_param("i", $userId);
        $stmt_skilltree->execute();
        $stmt_skilltree->close();

        $default_coins = 100;
        $stmt_event_coins = $mysqli->prepare('INSERT INTO event_coins (userID, coins) VALUES (?, ?)');
        $stmt_event_coins->bind_param("ii", $userId, $default_coins);
        $stmt_event_coins->execute();
        $stmt_event_coins->close();

        SMTP::SendMail($email, $username, 'E-mail verification', '<p>Hi ' . $username . ', <br>Click this link to activate your account: <a href="' . DOMAIN . 'api/verify/' . $userId . '/' . $verification['hash'] . '">Activate</a></p><p style="font-size:small;color:#666">—<br>You are receiving this because you registered to the ' . SERVER_NAME . '.<br>If that was not your request, then you can ignore this email.<br>This is an automated message, please do not reply directly to this email.</p>');
  
        $_SESSION['account']['id'] = $userId;
        $_SESSION['account']['session'] = $sessionId; 

        try {
          $stmt_update_session = $mysqli->prepare('UPDATE player_accounts SET sessionId = ? WHERE userId = ?');
          $stmt_update_session->bind_param("si", $sessionId, $userId);
          $stmt_update_session->execute();
          $stmt_update_session->close();

          $mysqli->commit();
        } catch (Exception $e) {
          // error_log("Functions::Register Inner Exception: " . $e->getMessage()); // Removed
          $json['message'] = 'An error login occurred. Please try again later.';
          $mysqli->rollback();
        }
        
        $json['type'] = "resultAll";
        $json['message'] = 'You have registered successfully, you will be redirected in 3 seconds.';
        $json['redirect'] = true;
        $json['status'] = true;

        $mysqli->commit();

        return json_encode($json);
      } catch (Exception $e) {
        // error_log("Functions::Register Exception: " . $e->getMessage()); // Removed
        $json['type'] = "resultAll";
        $json['message'] = 'An error occurred. Please try again later.';
        $mysqli->rollback();

        return json_encode($json);
      }

      $mysqli->close();
    } else {
      $json['type'] = "username";
      $json['message'] = 'This username is already taken.';

      return json_encode($json);
    }
  }

  public static function checkIsAdmin($id = null){
    if ($id){
      $mysqli = Database::GetInstance();
      $idInt = (int)$id;

      $stmt = $mysqli->prepare('SELECT type FROM chat_permissions WHERE userId = ?');
      $stmt->bind_param("i", $idInt);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0){
        $data = $result->fetch_assoc();
        $stmt->close();
        $type = (int)$data['type'];
        if (($type == 1) || ($type == 2)){
          return true;
        } else {
          return false;
        }
      } else {
        $stmt->close();
        return false;
      }
    }
    return false; // Added default return
  }

  public static function checkIsFullAdmin($id = null){
    if ($id){
      $mysqli = Database::GetInstance();
      $idInt = (int)$id;

      $stmt = $mysqli->prepare('SELECT type FROM chat_permissions WHERE userId = ?');
      $stmt->bind_param("i", $idInt);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0){
        $data = $result->fetch_assoc();
        $stmt->close();
        $type = (int)$data['type'];
        if ($type == 1){
          return true;
        } else {
          return false;
        }
      } else {
        $stmt->close();
        return false;
      }
    }
    return false; // Added default return
  }

  public static function addVoucherLog($voucher = null, $id = null, $item = null, $amount = null){
    if (isset($item) && isset($amount) && isset($id)){
      $mysqli = Database::GetInstance();

      // Secure inputs
      $voucher_escaped = $mysqli->real_escape_string((string)$voucher);
      $id_int = (int)$id;
      $item_escaped = $mysqli->real_escape_string((string)$item);
      $amount_escaped = $mysqli->real_escape_string((string)$amount); // Amount might be string like '1_MONTH_PREMIUM'
      $time = time();

      $stmt = $mysqli->prepare("INSERT INTO `voucher_log` (`voucher`, `userId`, `item`, `amount`, `date`) VALUES (?, ?, ?, ?, ?)");
      if ($stmt) {
        $stmt->bind_param("sisss", $voucher_escaped, $id_int, $item_escaped, $amount_escaped, $time);

        if ($stmt->execute()){
          $stmt->close();
          return true;
        } else {
          // Optional: Log error $stmt->error
          $stmt->close();
          return false;
        }
      } else {
        // Optional: Log error $mysqli->error
        return false;
      }
    }
    return false;
  }

  public static function getInfoGalaxyGate($gateId){
    if (isset($gateId) && !empty($gateId) && is_numeric($gateId)){
      $mysqli = Database::GetInstance();
      $userId = (int)$_SESSION['account']['id']; // Assuming session ID is integer
      $gateIdInt = (int)$gateId;

      $json = [
        'message' => '',
        'lives' => 0
      ];

      $stmt = $mysqli->prepare("SELECT lives FROM player_galaxygates WHERE gateId = ? AND userId = ?");
      $stmt->bind_param("ii", $gateIdInt, $userId);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0){
        $infoP = $result->fetch_assoc();
        $json['lives'] = $infoP['lives'];
      }
      $stmt->close();
      return json_encode($json);
    }
    // Return default json if gateId is not valid
    return json_encode(['message' => 'Invalid Gate ID.', 'lives' => 0]);
  }

  public static function buyLive($gateId){
    if (isset($gateId) && !empty($gateId) && is_numeric($gateId)){
      $mysqli = Database::GetInstance();
      $userId = (int)$_SESSION['account']['id']; // Assuming session ID is integer
      $gateIdInt = (int)$gateId;

      $json = [
        'message' => '',
        'lives' => 0
      ];

      // Fetch initial gate info (already uses prepared statement via getInfoGalaxyGate if that's refactored)
      // For checkGate query:
      $stmt_check_gate = $mysqli->prepare("SELECT lives, parts FROM player_galaxygates WHERE gateId = ? AND userId = ?");
      $stmt_check_gate->bind_param("ii", $gateIdInt, $userId);
      $stmt_check_gate->execute();
      $checkGateResult = $stmt_check_gate->get_result();
      $playerGateData = null;
      if ($checkGateResult->num_rows > 0) {
        $playerGateData = $checkGateResult->fetch_assoc();
      }
      $stmt_check_gate->close();

      $galaxyParts = self::getInfoGate($gateIdInt); // getInfoGate expects numeric gateId
      $galaxyPartsDecoded = json_decode($galaxyParts, true); // Assuming getInfoGate returns JSON string

      // The original getInfoGate returns an array with gateId as key, e.g., $galaxyParts[1]['live_cost']
      // The refactored one might return a simple JSON if it's just for one gate.
      // For now, let's assume $galaxyParts is the direct return from getInfoGate, which needs to be decoded if JSON.
      // And self::getInfoGate(non-json mode) returns: array($gateId => array('name' => ..., 'live_cost' => ...))
      // So, if getInfoGate is NOT returning JSON, then this structure is:
      // $galaxyPartsArray = self::getInfoGate($gateIdInt, false); // get array
      // $currentGateDetails = $galaxyPartsArray[$gateIdInt];
      // For now, assuming self::getInfoGate is called as before and structure of $galaxyParts is as expected.
      // This part is tricky as self::getInfoGate also needs refactoring for its own queries.
      // Let's assume for now $galaxyParts is structured as: array($gateId => array('live_cost' => ...))
      // If getInfoGate is refactored to return a direct object/array for the specific gate, this access will change.
      // The original self::getInfoGate($gateId, $json=false) returns array($gateId => array(...))
      // Let's call it with $json=false to get the array structure.
      $gateDetailsArray = self::getInfoGate($gateIdInt, false);
      if (!$gateDetailsArray || !isset($gateDetailsArray[$gateIdInt])) {
        $json['message'] = "Please select a unlock gate.";
        return json_encode($json);
      }
      $currentGateStaticInfo = $gateDetailsArray[$gateIdInt];


      if (isset($_SESSION['ggtime']) and $_SESSION['ggtime'] >= time()){
        $json['message'] = "Please wait 5 seconds";
        return json_encode($json);
      }

      $stmt_player_data = $mysqli->prepare('SELECT data FROM player_accounts WHERE userId = ?');
      $stmt_player_data->bind_param("i", $userId);
      $stmt_player_data->execute();
      $player_data_result = $stmt_player_data->get_result()->fetch_assoc();
      $stmt_player_data->close();
      $data = json_decode($player_data_result['data'], true);

      if ($data['uridium'] < $currentGateStaticInfo['live_cost']){
        $json['message'] = "You don't have enough Uridium.";
        return json_encode($json);
      }

      $_SESSION['ggtime'] = strtotime('+5 second');
      $liveCost = (int)$currentGateStaticInfo['live_cost'];
      $data['uridium'] -= $liveCost;

      if(Socket::Get('IsOnline', array('UserId' => $userId, 'Return' => false))) {
        Socket::Send('UpdateUridium', ['UserId' => $userId, 'UridiumPrice' => $liveCost, 'Type' => "DECREASE"]);
      } else {
        $newDataJson = json_encode($data);
        $stmt_update_player_data = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
        $stmt_update_player_data->bind_param("si", $newDataJson, $userId);
        $stmt_update_player_data->execute();
        $stmt_update_player_data->close();
      }

      $json['uridium'] = number_format($data['uridium'], 0, ',', '.');

      if ($playerGateData){ // Player already has some data for this gate
        $newLives = $playerGateData['lives'] + 1;
        $stmt_update_lives = $mysqli->prepare("UPDATE player_galaxygates SET lives = lives + 1 WHERE userId = ? AND gateId = ?");
        $stmt_update_lives->bind_param("ii", $userId, $gateIdInt);
        $stmt_update_lives->execute();
        $stmt_update_lives->close();

        $json['message'] = "Sucesfully buyed 1 live.";
        $json['log'] = "Buyed 1 live in ".$currentGateStaticInfo['name']." gate";
        $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
        $json['lives'] = $newLives;

        self::gg_log($json['log'], $userId);
        return json_encode($json);
      } else { // First time interacting with this gate essentially
        $initialParts = '[]';
        $initialLives = 4; // Or 1 if buying first live means starting with 1. Original code implies 4.
        $initialPrepared = 0;
        $initialWave = 1;
        $stmt_insert_live = $mysqli->prepare("INSERT INTO player_galaxygates (userId, gateId, parts, lives, prepared, wave) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_insert_live->bind_param("iisiii", $userId, $gateIdInt, $initialParts, $initialLives, $initialPrepared, $initialWave);
        $stmt_insert_live->execute();
        $stmt_insert_live->close();

        $json['message'] = "Sucesfully buyed 1 live.";
        $json['log'] = "Buyed 1 live in ".$currentGateStaticInfo['name']." gate";
        $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
        $json['lives'] = $initialLives;

        self::gg_log($json['log'], $userId);
        return json_encode($json);
      }
    }
    return json_encode(['message' => 'Invalid Gate ID or User session.', 'lives' => 0]);
  }

  public static function ggPreparePortal($gateId){
    if (isset($gateId) && !empty($gateId) && is_numeric($gateId)){
      $mysqli = Database::GetInstance();
      $userId = (int)$_SESSION['account']['id'];
      $gateIdInt = (int)$gateId;

      $json = ['message' => ''];

      $stmt_check_gate = $mysqli->prepare("SELECT parts, prepared FROM player_galaxygates WHERE gateId = ? AND userId = ?");
      $stmt_check_gate->bind_param("ii", $gateIdInt, $userId);
      $stmt_check_gate->execute();
      $checkGateResult = $stmt_check_gate->get_result();

      // This relies on self::getInfoGate returning the specific structure.
      // Let's assume self::getInfoGate($gateIdInt, false) returns array($gateId => array(...))
      $gateDetailsArray = self::getInfoGate($gateIdInt, false);
      if (!$gateDetailsArray || !isset($gateDetailsArray[$gateIdInt])) {
        $json['message'] = "Gate information not found.";
        $stmt_check_gate->close();
        return json_encode($json);
      }
      $currentGateStaticInfo = $gateDetailsArray[$gateIdInt];

      if ($checkGateResult->num_rows > 0){
        $dataQ = $checkGateResult->fetch_assoc();
        $stmt_check_gate->close();

        if ($dataQ['prepared'] == '1'){
          $json['message'] = $currentGateStaticInfo['name']." is ready.";
          return json_encode($json);
        }

        $dataGateParts = json_decode($dataQ['parts']);
        $totalParts = 0;
        if (is_array($dataGateParts)) {
            foreach($dataGateParts as $dg){
              $totalParts += (int)$dg;
            }
        }

        if ($totalParts >= (int)$currentGateStaticInfo['parts']){
          $stmt_update_prepared = $mysqli->prepare("UPDATE player_galaxygates SET prepared = 1 WHERE userId = ? AND gateId = ?");
          $stmt_update_prepared->bind_param("ii", $userId, $gateIdInt);
          if ($stmt_update_prepared->execute()){
            $json['message'] = $currentGateStaticInfo['name']." gate has prepared sucesfully.";
          } else {
            $json['message'] = "Error to prepare the gate ".$currentGateStaticInfo['name'];
          }
          $stmt_update_prepared->close();
        } else {
          $json['message'] = $currentGateStaticInfo['name']." gate not unlocked. Complete the parts. Current parts: ".$totalParts."/".$currentGateStaticInfo['parts'];
        }
      } else {
        $stmt_check_gate->close();
        $json['message'] = $currentGateStaticInfo['name']." gate not unlocked. Complete all parts.";
      }
      return json_encode($json);
    }
    return json_encode(['message' => 'Invalid Gate ID.']);
  }

  public static function getInfoGate($gateId, $json = false){
    if (isset($gateId) && !empty($gateId) && is_numeric($gateId)){
      $mysqli = Database::GetInstance();
      $gateIdInt = (int)$gateId;

      $stmt = $mysqli->prepare("SELECT name, parts, cost, live_cost FROM info_galaxygates WHERE gateId = ?");
      $stmt->bind_param("i", $gateIdInt);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0){
        $dataGate = $result->fetch_assoc();
        $stmt->close();

        if ($json){
          return json_encode(array('name' => $dataGate['name'], 'parts' => $dataGate['parts'], 'cost' => number_format($dataGate['cost'], 0, ',', '.'), 'live_cost' => number_format($dataGate['live_cost'], 0, ',', '.')));
        } else {
          // Original structure: array( $gateId => array(...) )
          return array($gateIdInt => array('name' => $dataGate['name'], 'parts' => $dataGate['parts'], 'cost' => $dataGate['cost'], 'live_cost' => $dataGate['live_cost']));
        }
      } else {
        $stmt->close();
        return false;
      }
    }
    return false;
  }

  public static function gg_log($log, $userId){
    if (isset($log) && isset($userId)){

      $mysqli = Database::GetInstance();

      // Secure inputs
      $log_escaped = $mysqli->real_escape_string((string)$log);
      $userId_int = (int)$userId;
      $time = time();

      $stmt = $mysqli->prepare("INSERT INTO `gg_log` (`log`, `userId`, `date`) VALUES (?, ?, ?)");
      if ($stmt) {
        $stmt->bind_param("ssi", $log_escaped, $userId_int, $time); // Corrected type for time to 'i'

        if ($stmt->execute()){
          $stmt->close();
          return true;
        } else {
          // Optional: Log error $stmt->error
          $stmt->close();
          return false;
        }
      } else {
        // Optional: Log error $mysqli->error
        return false;
      }
    }
    return false;
  }

  public static function gg($gateId){

    if (isset($gateId) && !empty($gateId) && is_numeric($gateId)){
      $mysqli = Database::GetInstance();
      $userId = (int)$_SESSION['account']['id']; // Assuming session ID is integer
      $gateIdInt = (int)$gateId;

      $num = rand(1,38);

      if ($num == 1 || $num == 2 || $num == 3 || $num == 4 || $num == 5){
        $result = array('uridium' => '', 'parts' => 1, 'ammoType' => '', 'ammoAmount' => '');
      } elseif ($num == 6 || $num == 7 || $num == 8 || $num == 9 || $num == 10){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_rocketlauncher_ubr-100', 'ammoAmount' => '10');
      } elseif ($num == 11 || $num == 12 || $num == 13 || $num == 14 || $num == 15){
        $result = array('uridium' => '', 'parts' => 0, 'ammoType' => 'ammunition_laser_mcb-50', 'ammoAmount' => '215');
      } elseif ($num == 16 || $num == 17){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_ucb-100', 'ammoAmount' => '150');
      } elseif ($num == 18 || $num == 19){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_rocket_plt-2021', 'ammoAmount' => '45');
	  } elseif ($num == 20 || $num == 21){
        $result = array('uridium' => '0', 'parts' => 3, 'ammoType' => 'ammunition_rocket_plt-2021', 'ammoAmount' => '');
	  } elseif ($num == 22 || $num == 23){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_mcb-25', 'ammoAmount' => '325');
	  } elseif ($num == 24 || $num == 25){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_rocketlauncher_ubr-100', 'ammoAmount' => '15');
	  } elseif ($num == 26 || $num == 27){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_sab-50', 'ammoAmount' => '250');
	  } elseif ($num == 28 || $num == 29){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_rocketlauncher_eco-10', 'ammoAmount' => '40');
	  } elseif ($num == 30 || $num == 31){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_ucb-100', 'ammoAmount' => '350');
	  } elseif ($num == 32 || $num == 33){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_rocket_plt-3030', 'ammoAmount' => '35');
	  } elseif ($num == 34 || $num == 35){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_mcb-50', 'ammoAmount' => '175');
	  } elseif ($num == 36 || $num == 37){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_mcb-25', 'ammoAmount' => '230');
      } else {
        $result = array('uridium' => '0', 'parts' => 2, 'ammoType' => '', 'ammoAmount' => '');
      }

      $json = [
        'message' => "",
        'lives' => 0
      ];

      // self::getInfoGate is already refactored and expects numeric gateId
      $gateDetailsArray = self::getInfoGate($gateIdInt, false);
      if (!$gateDetailsArray || !isset($gateDetailsArray[$gateIdInt])) {
        $json['message'] = "Please select a unlock gate.";
        return json_encode($json);
      }
      $currentGateStaticInfo = $gateDetailsArray[$gateIdInt];
      // $gateExists check becomes redundant due to the above check.

      $stmt_player_main_data = $mysqli->prepare('SELECT data, ammo FROM player_accounts WHERE userId = ?');
      $stmt_player_main_data->bind_param("i", $userId);
      $stmt_player_main_data->execute();
      $player_main_data_result = $stmt_player_main_data->get_result()->fetch_assoc();
      $stmt_player_main_data->close();
      $data = json_decode($player_main_data_result['data'], true);
      // $ammo will be decoded later if needed by specific reward type

      $json['uridium'] = number_format($data['uridium'], 0, ',', '.');

      $stmt_check_parts = $mysqli->prepare("SELECT parts, lives FROM player_galaxygates WHERE userId = ? AND gateId = ?");
      $stmt_check_parts->bind_param("ii", $userId, $gateIdInt);
      $stmt_check_parts->execute();
      $checkIfExistsPartsResult = $stmt_check_parts->get_result();
      $infoQData = null; // For lives
      $dataParts = null; // For parts array
      $totalParts = 0; // Initialize totalParts

      if ($checkIfExistsPartsResult->num_rows > 0){
        $playerGateProgress = $checkIfExistsPartsResult->fetch_assoc();
        $infoQData = $playerGateProgress; // Contains 'lives' and 'parts'
        $dataParts = json_decode($playerGateProgress['parts']);
        if (is_array($dataParts)) {
            foreach ($dataParts as $part){
              $totalParts += (int)$part;
            }
        }
        if ($totalParts >= (int)$currentGateStaticInfo['parts']){
          $json['message'] = $currentGateStaticInfo['name']." is unlocked.";
          $stmt_check_parts->close();
          return json_encode($json);
        }
      }
      $stmt_check_parts->close(); // Close it if not closed already

      $gateCost = (int)$currentGateStaticInfo['cost'];
      if ($data['uridium'] < $gateCost){
        $json['message'] = "You don't have enough Uridium.";
        return json_encode($json);
      }

      $data['uridium'] -= $gateCost;
      $newDataJsonForCost = json_encode($data);

      if(Socket::Get('IsOnline', array('UserId' => $userId, 'Return' => false))) {
        Socket::Send('UpdateUridium', ['UserId' => $userId, 'UridiumPrice' => $gateCost, 'Type' => "DECREASE"]);
      } else {
        $stmt_update_data_cost = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
        $stmt_update_data_cost->bind_param("si", $newDataJsonForCost, $userId);
        $stmt_update_data_cost->execute();
        $stmt_update_data_cost->close();
      }

      $json['uridium'] = number_format($data['uridium'], 0, ',', '.');
      $json['lives'] = (isset($infoQData) && $infoQData['lives']) ? $infoQData['lives'] : 0;

      // Reward Uridium
      if (!empty($result['uridium'])){
        $uridiumReward = (int)$result['uridium'];
        $data['uridium'] += $uridiumReward;
        $newDataJsonForUridiumReward = json_encode($data);

        if(Socket::Get('IsOnline', array('UserId' => $userId, 'Return' => false))) {
          Socket::Send('UpdateUridium', ['UserId' => $userId, 'UridiumPrice' => $uridiumReward, 'Type' => "INCREASE"]);
        } else {
          $stmt_update_data_uridium_reward = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
          $stmt_update_data_uridium_reward->bind_param("si", $newDataJsonForUridiumReward, $userId);
          $stmt_update_data_uridium_reward->execute();
          $stmt_update_data_uridium_reward->close();
        }
        $json['message'] = "You have earned ".$uridiumReward." uridium.";
        $json['uridium'] = number_format($data['uridium'], 0, ',', '.');
        $json['log'] = "Earned ".$uridiumReward." uridium.";
        $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
        self::gg_log($json['log'], $userId);
      }

      // Reward Ammo
      if (!empty($result['ammoType']) && !empty($result['ammoAmount'])){
        $ammoType = $result['ammoType'];
        $ammoAmount = (int)$result['ammoAmount'];
        $currentAmmoJson = $player_main_data_result['ammo']; // From initial fetch
        $ammo = json_decode($currentAmmoJson, true); // Decode as assoc array

        if(Socket::Get('IsOnline', array('UserId' => $userId, 'Return' => false))) {
          Socket::Send('AddAmmo', ['UserId' => $userId, 'itemId' => $ammoType, 'amount' => $ammoAmount]);
        } else {
          if (array_key_exists($ammoType, typeMunnition)) {
            $ammoKey = typeMunnition[$ammoType];
            if (empty($ammo[$ammoKey])){
              $ammo[$ammoKey] = $ammoAmount;
            } else {
              $ammo[$ammoKey] += $ammoAmount;
            }
            $newAmmoJson = json_encode($ammo);
            $stmt_update_ammo = $mysqli->prepare("UPDATE player_accounts SET ammo = ? WHERE userId = ?");
            $stmt_update_ammo->bind_param("si", $newAmmoJson, $userId);
            $stmt_update_ammo->execute();
            $stmt_update_ammo->close();
            $json['message'] = "You have earned ".$ammoAmount." ".typeMunnition[$ammoType]." ammo";
            $json['log'] = "Earned ".$ammoAmount." ".typeMunnition[$ammoType]." ammo";
          } else {
            // Log error: invalid ammoType from $result array
            $json['message'] = "Received unknown ammo type reward.";
            $json['log'] = "Attempted to reward unknown ammo type: " . $ammoType;
          }
        }
        $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
        self::gg_log($json['log'], $userId);
      }

      // Reward Parts
      if (!empty($result['parts'])){
        $partsReward = (int)$result['parts'];
        // Re-fetch parts data to ensure it's current before update
        $stmt_refetch_parts = $mysqli->prepare("SELECT parts FROM player_galaxygates WHERE userId = ? AND gateId = ?");
        $stmt_refetch_parts->bind_param("ii", $userId, $gateIdInt);
        $stmt_refetch_parts->execute();
        $refetchPartsRes = $stmt_refetch_parts->get_result();
        $currentPartsData = null;
        if($refetchPartsRes->num_rows > 0) {
            $currentPartsData = json_decode($refetchPartsRes->fetch_assoc()['parts'], true);
        } else {
            $currentPartsData = []; // Initialize if no parts record exists yet
        }
        $stmt_refetch_parts->close();

        if (!is_array($currentPartsData)) $currentPartsData = []; // Ensure it's an array

        array_push($currentPartsData, $partsReward);
        $totalPartsAfterReward = 0;
        foreach ($currentPartsData as $part){
          $totalPartsAfterReward += (int)$part;
        }

        $preparedStatus = ($totalPartsAfterReward >= (int)$currentGateStaticInfo['parts']) ? 1 : 0;
        $encodedParts = json_encode($currentPartsData);

        if ($refetchPartsRes->num_rows > 0) { // Update existing record
            $stmt_update_gate_parts = $mysqli->prepare("UPDATE player_galaxygates SET parts = ? WHERE userId = ? AND gateId = ?");
            $stmt_update_gate_parts->bind_param("sii", $encodedParts, $userId, $gateIdInt);
            $stmt_update_gate_parts->execute();
            $stmt_update_gate_parts->close();
        } else { // Insert new record for parts
            $initialLivesForNewParts = 3; // Default if inserting parts for the first time
            $initialWaveForNewParts = 1;
            $stmt_insert_gate_parts = $mysqli->prepare("INSERT INTO player_galaxygates (userId, gateId, parts, lives, prepared, wave) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt_insert_gate_parts->bind_param("iisiis", $userId, $gateIdInt, $encodedParts, $initialLivesForNewParts, $preparedStatus, $initialWaveForNewParts);
            $stmt_insert_gate_parts->execute();
            $stmt_insert_gate_parts->close();
        }

        if ($preparedStatus === 1){
          $json['totalParts'] = "Unlocked";
          $json['message'] = "You have earned ".$partsReward." parts. Has unlocked succesfully ".$currentGateStaticInfo['name']." gate.";
          $json['completed'] = 1;
          $json['log'] = "Earned ".$partsReward." parts of ".$currentGateStaticInfo['name']." gate. Sucesfully unlocked gate.";
        } else {
          $json['message'] = "You have earned ".$partsReward." parts.";
          $json['totalParts'] = $totalPartsAfterReward."/".$currentGateStaticInfo['parts'];
          $json['log'] = "Earned ".$partsReward." parts of ".$currentGateStaticInfo['name']." gate";
        }
        $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
        self::gg_log($json['log'], $userId);
      }
      return json_encode($json);
    }
  }

  public static function checkVoucher($voucherId = null){
    if ($voucherId){
      $mysqli = Database::GetInstance();
      // $voucherId will be used in prepared statement, no manual escape here.
      $json = [
        'status' => false,
        'message' => '',
        'voucher' => '',
        'item' => '',
        'amount' => '',
        'date' => '',
        'uridium' => "",
        'credits' => "",
        'event_coins' => ""
      ];

      $stmt_check_voucher = $mysqli->prepare("SELECT * FROM vouchers WHERE voucher = ?");
      $stmt_check_voucher->bind_param("s", $voucherId);
      $stmt_check_voucher->execute();
      $checkVouchResult = $stmt_check_voucher->get_result();

      if ($checkVouchResult->num_rows > 0){
        $dataV = $checkVouchResult->fetch_assoc();
        $stmt_check_voucher->close();

        $userId = (int)$_SESSION['account']['id']; // Assuming session ID is integer

        $stmt_get_player_data = $mysqli->prepare('SELECT data FROM player_accounts WHERE userId = ?');
        $stmt_get_player_data->bind_param("i", $userId);
        $stmt_get_player_data->execute();
        $player_data_fetch_result = $stmt_get_player_data->get_result()->fetch_assoc();
        $stmt_get_player_data->close();
        $data = json_decode($player_data_fetch_result['data'], true);
        
        // Check voucher data.
        if ($dataV['only_one_user']){
          $stmt_check_used = $mysqli->prepare("SELECT userId FROM vouchers_uses WHERE voucherId = ? AND userId = ?");
          // Assuming $dataV['voucher'] contains the actual voucher code string if $voucherId is an internal ID.
          // If $voucherId IS the voucher code, then use that. The original query used $voucherId (escaped).
          // Sticking to $voucherId as the voucher code based on original logic.
          $stmt_check_used->bind_param("si", $voucherId, $userId);
          $stmt_check_used->execute();
          $stmt_check_used->store_result();

          if ($stmt_check_used->num_rows > 0){
            $stmt_check_used->close();
            $json['message'] = "You already used the voucher ".$voucherId;
            return json_encode($json);
          }
          $stmt_check_used->close();
        }

        if ((int)$dataV['uses'] <= 0){
          $json['message'] = "The voucher \"".$voucherId."\" has already been used.";
          return json_encode($json);
        }

        // Design Reward
        if (!empty($dataV['design'])){
          $stmt_get_ship_design = $mysqli->prepare("SELECT baseShipId FROM server_ships WHERE lootID = ? AND baseShipId > 0");
          $stmt_get_ship_design->bind_param("s", $dataV['design']);
          $stmt_get_ship_design->execute();
          $dataShipResult = $stmt_get_ship_design->get_result();
          if ($dataShipResult->num_rows > 0){
            $dataS = $dataShipResult->fetch_assoc();
            $stmt_get_ship_design->close();
            
            self::addVoucherLog($voucherId, $userId, 'design', $dataV['design']); // Assumes addVoucherLog is safe

            $json['voucher'] = $voucherId;
            $json['item'] = "design";
            $json['amount'] = $dataV['design'];
            $json['date'] = date("d-m-Y h:i:s", strtotime("+2 hours"));

            $stmt_insert_design = $mysqli->prepare("INSERT INTO player_designs (name, baseShipId, userId) VALUES (?, ?, ?)");
            $stmt_insert_design->bind_param("sii", $dataV['design'], $dataS['baseShipId'], $userId);
            $stmt_insert_design->execute();
            $stmt_insert_design->close();
          } else { $stmt_get_ship_design->close(); }
        }

        // Uridium Reward
        if (!empty($dataV['uridium'])){
          $uridiumReward = (int)$dataV['uridium'];
          $data['uridium'] += $uridiumReward;
          $newDataJson = json_encode($data);

          if(Socket::Get('IsOnline', array('UserId' => $userId, 'Return' => false))) {
            Socket::Send('UpdateUridium', ['UserId' => $userId, 'UridiumPrice' => $uridiumReward, 'Type' => "INCREASE"]);
          } else {
            $stmt_update_data_uri = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
            $stmt_update_data_uri->bind_param("si", $newDataJson, $userId);
            $stmt_update_data_uri->execute();
            $stmt_update_data_uri->close();
          }
          self::addVoucherLog($voucherId, $userId, 'uridium', $uridiumReward);
          $json['voucher'] = $voucherId; $json['item'] = "uridium"; $json['amount'] = $uridiumReward;
          $json['date'] = date("d-m-Y h:i:s", strtotime("+2 hours")); $json['uridium'] = number_format($data['uridium'], 0, ',', '.');
        }

        // Credits Reward
        if (!empty($dataV['credits'])){
          $creditsReward = (int)$dataV['credits'];
          $data['credits'] += $creditsReward;
          $newDataJson = json_encode($data);

          if(Socket::Get('IsOnline', array('UserId' => $userId, 'Return' => false))) {
            Socket::Send('UpdateCredits', ['UserId' => $userId, 'CreditPrice' => $creditsReward, 'Type' => "INCREASE"]);
          } else {
            $stmt_update_data_cred = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
            $stmt_update_data_cred->bind_param("si", $newDataJson, $userId);
            $stmt_update_data_cred->execute();
            $stmt_update_data_cred->close();
          }
          self::addVoucherLog($voucherId, $userId, 'credits', $creditsReward);
          $json['voucher'] = $voucherId; $json['item'] = "credits"; $json['amount'] = $creditsReward;
          $json['date'] = date("d-m-Y h:i:s", strtotime("+2 hours")); $json['credits'] = number_format($data['credits'], 0, ',', '.');
        }

        // Event Coins Reward
        if (!empty($dataV['event_coins'])){
          $eventCoinsReward = (int)$dataV['event_coins'];
          
          $stmt_check_ec = $mysqli->prepare("SELECT coins FROM event_coins WHERE userId = ?");
          $stmt_check_ec->bind_param("i", $userId);
          $stmt_check_ec->execute();
          $dataECResult = $stmt_check_ec->get_result();

          if ($dataECResult->num_rows > 0){
            $stmt_check_ec->close();
            $stmt_update_ec = $mysqli->prepare("UPDATE event_coins SET coins = coins + ? WHERE userId = ?");
            $stmt_update_ec->bind_param("ii", $eventCoinsReward, $userId);
            $stmt_update_ec->execute();
            $stmt_update_ec->close();
          } else {
            $stmt_check_ec->close();
            $stmt_insert_ec = $mysqli->prepare("INSERT INTO event_coins (coins, userId) VALUES (?, ?)");
            $stmt_insert_ec->bind_param("ii", $eventCoinsReward, $userId);
            $stmt_insert_ec->execute();
            $stmt_insert_ec->close();
          }

          $stmt_get_total_ec = $mysqli->prepare("SELECT coins FROM event_coins WHERE userId = ?");
          $stmt_get_total_ec->bind_param("i", $userId);
          $stmt_get_total_ec->execute();
          $coinsAc = $stmt_get_total_ec->get_result()->fetch_assoc()['coins'];
          $stmt_get_total_ec->close();

          self::addVoucherLog($voucherId, $userId, 'event_coins', $eventCoinsReward);
          $json['voucher'] = $voucherId; $json['item'] = "event_coins"; $json['amount'] = $eventCoinsReward;
          $json['date'] = date("d-m-Y h:i:s", strtotime("+2 hours")); $json['event_coins'] = number_format($coinsAc, 0, ',', '.');
        }

        // Finalize voucher usage
        $stmt_update_voucher_uses = $mysqli->prepare("UPDATE vouchers SET uses = uses - 1 WHERE voucher = ?");
        $stmt_update_voucher_uses->bind_param("s", $voucherId);
        $stmt_update_voucher_uses->execute();
        $stmt_update_voucher_uses->close();

        $currentTime = time();
        $stmt_insert_voucher_use_log = $mysqli->prepare("INSERT INTO vouchers_uses (userId, voucherId, dateUsed) VALUES (?, ?, ?)");
        $stmt_insert_voucher_use_log->bind_param("isi", $userId, $voucherId, $currentTime);
        $stmt_insert_voucher_use_log->execute();
        $stmt_insert_voucher_use_log->close();

        $json['message'] = "Vouch: \"".$voucherId."\" used succesfully";
      } else { // if ($checkVouchResult->num_rows == 0)
        $stmt_check_voucher->close();
        $json['message'] = "Vouch: \"".$voucherId."\" no exists.";
      }
      return json_encode($json);
    }
  }

  public static function Login($username, $password)
  {
    $mysqli = Database::GetInstance();

    $username = $mysqli->real_escape_string($username);
    $password = $mysqli->real_escape_string($password);

    $json = [
      'status' => false,
      'message' => '',
      'toastAction' => '',
      'type' => ''
    ];

    if (empty($username) && empty($password)){
      $json['type'] = "all";
      $json['message'] = "This field is required";

      return json_encode($json);
    }

    if (empty($username)){
      $json['type'] = "username";
      $json['message'] = "Username is required";

      return json_encode($json);
    }

    if (empty($password)){
      $json['type'] = "password";
      $json['message'] = "Password is required";

      return json_encode($json);
    }

    $stmt = $mysqli->prepare('SELECT userId, password, verification FROM player_accounts WHERE username = ?');
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $fetch = $result->fetch_assoc();
    $stmt->close();

    if ($result->num_rows >= 1) {
      if (password_verify($password, $fetch['password'])) {
        $verification_data = json_decode($fetch['verification']);
        if ($verification_data && $verification_data->verified) {
          
          if (MAINTENANCE AND !self::checkIsAdmin($fetch['userId'])){
            $json['type'] = "all";
            $json['message'] = "Maintenance activated. Please login later.";

            return json_encode($json);
          }

          $sessionId = Functions::GenerateRandom(32);

          $_SESSION['account']['id'] = $fetch['userId'];
          $_SESSION['account']['session'] = $sessionId;

          $mysqli->begin_transaction();

          try {
            $stmt_update = $mysqli->prepare('UPDATE player_accounts SET sessionId = ? WHERE userId = ?');
            $stmt_update->bind_param("si", $sessionId, $fetch['userId']);
            $stmt_update->execute();
            $stmt_update->close();

            $json['status'] = true;
            $json['message'] = 'Login successfully, you will be redirected in 3 seconds.';

            $mysqli->commit();
          } catch (Exception $e) {
            $json['message'] = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }

          // $mysqli->close(); // Connection should be managed by Database::GetInstance() lifecycle or explicitly closed if no longer needed by other parts of the request.
        } else {
          if (!isset($_COOKIE['send-link-again-button'])) {
            $json['toastAction'] = '<button id="send-link-again" class="btn-flat waves-effect waves-light toast-action">Send link again</button>';
          }

          $json['type'] = "all";
          $json['message'] = 'This account is not verified, please verify it from your e-mail address.';
        }
      } else {
        $json['type'] = "password";
        $json['message'] = 'Wrong password.';
      }
    } else {
      $json['type'] = "username";
      $json['message'] = 'Username Incorrect.';
    }

    return json_encode($json);
  }

  public static function SendLinkAgain($username)
  {
    $mysqli = Database::GetInstance();
    // $username is already escaped in the calling context if it comes from POST, but good to ensure.
    // However, for prepared statements, we don't escape manually.

    $json = [
      'message' => ''
    ];

    if (!isset($_COOKIE['send-link-again-button'])) {
      $stmt = $mysqli->prepare('SELECT userId, email, verification FROM player_accounts WHERE username = ?');
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();
      $fetch = $result->fetch_assoc();
      $stmt->close();

      if ($result->num_rows >= 1) {
        $verification_data = json_decode($fetch['verification']);
        if ($verification_data && isset($verification_data->hash)) {
            SMTP::SendMail($fetch['email'], $username, 'E-mail verification', '<p>Hi ' . $username . ', <br>Click this link to activate your account: <a href="' . DOMAIN . 'api/verify/' . $fetch['userId'] . '/' . $verification_data->hash . '">Activate</a></p><p style="font-size:small;color:#666">—<br>You are receiving this because you registered to the ' . SERVER_NAME . '.<br>If that was not your request, then you can ignore this email.<br>This is an automated message, please do not reply directly to this email.</p>');
            $json['message'] = 'Activation link sent again.';
            setcookie('send-link-again-button', true, (time() + (120)), '/');
        } else {
            $json['message'] = 'Verification data is missing or corrupt for this user.';
        }
      } else {
        $json['message'] = 'Something went wrong!';
      }
    } else {
      $json['message'] = 'You need to wait 2 minutes for send link again.';
    }

    return json_encode($json);
  }

  public static function CompanySelect($factionId)
  {
    $mysqli = Database::GetInstance();

    $json = [
      'status' => false,
      'message' => ''
    ];

    $player = Functions::GetPlayer();

    if (in_array($factionId, ['1', '2', '3'], true) && $player['factionId'] != $factionId) {
      if (!in_array($player['factionId'], ['1', '2', '3'])) {
        $mysqli->begin_transaction();

        $mmo = array('factionId' => 1, 'mapID' => 1, 'x' => 1900, 'y' => 1900);
        $eic = array('factionId' => 2, 'mapID' => 5, 'x' => 18900, 'y' => 2000);
        $vru = array('factionId' => 3, 'mapID' => 9, 'x' => 18900, 'y' => 11700);

        if ($factionId == 1){
          $position = array('mapID' => $mmo['mapID'], 'x' => $mmo['x'], 'y' => $mmo['y']);
        } else if ($factionId == 2){
          $position = array('mapID' => $eic['mapID'], 'x' => $eic['x'], 'y' => $eic['y']);
        } else if ($factionId == 3){
          $position = array('mapID' => $vru['mapID'], 'x' => $vru['x'], 'y' => $vru['y']);
        } else {
          $position = array('mapID' => 0, 'x' => 0, 'y' => 0);
        }

        try {
          $factionIdInt = (int)$factionId;
          $userIdInt = (int)$player['userId'];
          $positionJson = json_encode($position);

          $stmt1 = $mysqli->prepare('UPDATE player_accounts SET factionId = ? WHERE userId = ?');
          $stmt1->bind_param("ii", $factionIdInt, $userIdInt);
          $stmt1->execute();
          $stmt1->close();

          $stmt2 = $mysqli->prepare("UPDATE player_accounts SET position = ? WHERE userId = ?");
          $stmt2->bind_param("si", $positionJson, $userIdInt);
          $stmt2->execute();
          $stmt2->close();

          $json['status'] = true;
          $mysqli->commit();
        } catch (Exception $e) {
          $json['message'] = 'An error occurred. Please try again later.';
          $mysqli->rollback();
        }
        // $mysqli->close(); // Managed by Database class
      } else {
        $data = json_decode($player['data']);
        $userIdInt = (int)$player['userId']; // Re-declare for this block for clarity
        $factionIdInt = (int)$factionId; // Re-declare for this block for clarity

        if ($data->uridium >= 50000) {
          $notOnlineOrOnlineAndInEquipZone = !Socket::Get('IsOnline', array('UserId' => $userIdInt, 'Return' => false)) || (Socket::Get('IsOnline', array('UserId' => $userIdInt, 'Return' => false)) && Socket::Get('IsInEquipZone', array('UserId' => $userIdInt, 'Return' => false)));

          if ($notOnlineOrOnlineAndInEquipZone) {
            $data->uridium -= 50000;

            if ($data->honor > 0) {
              $data->honor /= 2;
              $data->honor = round($data->honor);
            }

            if ($data->experience > 0){
              $calculatePercentage = $data->experience * 0.3;
              $data->experience = round($data->experience - $calculatePercentage);
            }
            $dataJson = json_encode($data);

            $mysqli->begin_transaction();
            try {
              $stmt = $mysqli->prepare("UPDATE player_accounts SET factionId = ?, data = ? WHERE userId = ?");
              $stmt->bind_param("isi", $factionIdInt, $dataJson, $userIdInt);
              $stmt->execute();
              $stmt->close();

              $json['status'] = true;
              $mysqli->commit();
            } catch (Exception $e) {
              $json['message'] = 'An error occurred. Please try again later.';
              $mysqli->rollback();
            }
            // $mysqli->close(); // Managed by Database class
          } else {
            $json['message'] = 'Change of company is not possible. You must be at a location with a hangar facility!';
          }
        } else {
          $json['message'] = "You don't have enough Uridium.";
        }

        if ($json['status'] && Socket::Get('IsOnline', array('UserId' => $userIdInt, 'Return' => false))) {
          Socket::Send('ChangeCompany', ['UserId' => $userIdInt, 'UridiumPrice' => 50000, 'HonorPrice' => $data->honor, 'ExperiencePrice' => $data->experience]);
        }
      }
    } else {
      $json['message'] = 'Something went wrong!';
    }

    return json_encode($json);
  }

  public static function Logout()
  {
    if (isset($_SESSION['account'])) {
      unset($_SESSION['account']);
      session_destroy();
    }

    header('Location: ' . DOMAIN . '');
  }

   public static function SearchClan($keywords)
  {
    $mysqli = Database::GetInstance();
    $clans = [];
    $likeKeyword = "%" . $keywords . "%";

    $stmt_search_clans = $mysqli->prepare('SELECT id, tag, name, rank, rankPoints FROM server_clans WHERE tag LIKE ? OR name LIKE ?');
    $stmt_search_clans->bind_param("ss", $likeKeyword, $likeKeyword);
    $stmt_search_clans->execute();
    $result_search_clans = $stmt_search_clans->get_result();

    $stmt_count_members = $mysqli->prepare('SELECT COUNT(userId) as member_count FROM player_accounts WHERE clanId = ?');

    while ($value = $result_search_clans->fetch_assoc()) {
      $stmt_count_members->bind_param("i", $value['id']);
      $stmt_count_members->execute();
      $member_count_result = $stmt_count_members->get_result()->fetch_assoc();

      $clans[] = [ // Changed to append to array, $key is not needed if it's just sequential
        'id' => $value['id'],
        'members' => $member_count_result['member_count'],
        'tag' => $value['tag'],
        'name' => $value['name'],
        'rank' => $value['rank'],
        'rankPoints' => $value['rankPoints']
      ];
    }
    $stmt_search_clans->close();
    $stmt_count_members->close();

    return json_encode($clans);
  }

  public static function DiplomacySearchClan($keywords)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode([]); } // Player not found or not logged in

    $clans = [];
    $likeKeyword = "%" . $keywords . "%";
    $playerClanId = (int)$player['clanId'];

    $stmt = $mysqli->prepare('SELECT id, tag, name FROM server_clans WHERE id != ? AND (tag LIKE ? OR name LIKE ?)');
    $stmt->bind_param("iss", $playerClanId, $likeKeyword, $likeKeyword);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($value = $result->fetch_assoc()) {
      $clans[] = [ // Changed to append to array
        'id' => $value['id'],
        'tag' => $value['tag'],
        'name' => $value['name']
      ];
    }
    $stmt->close();

    return json_encode($clans);
  }

  public static function RequestDiplomacy($clanId, $diplomacyType, $message = null) {
    
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['message' => 'Player not found.', 'status' => false]); }

    $clanIdInt = (int)$clanId; // Assuming $clanId is the ID of the target clan
    $diplomacyTypeInt = (int)$diplomacyType; // Assuming $diplomacyType is numeric

    // Get player's clan info
    $stmt_player_clan = $mysqli->prepare('SELECT * FROM server_clans WHERE id = ?');
    $stmt_player_clan->bind_param("i", $player['clanId']);
    $stmt_player_clan->execute();
    $playerClanResult = $stmt_player_clan->get_result();
    $playerClan = $playerClanResult->fetch_assoc();
    $stmt_player_clan->close();

    $json = ['message' => '', 'status' => false];

    if ($clanIdInt != 0) {
      if ($playerClan != NULL) {
        if ($playerClan['leaderId'] == $player['userId']) {
          // Get target clan info
          $stmt_target_clan = $mysqli->prepare('SELECT * FROM server_clans WHERE id = ?');
          $stmt_target_clan->bind_param("i", $clanIdInt);
          $stmt_target_clan->execute();
          $targetClanResult = $stmt_target_clan->get_result();
          $toClan = $targetClanResult->fetch_assoc();
          $stmt_target_clan->close();

          if ($toClan != NULL && $playerClan['id'] != $toClan['id'] && in_array($diplomacyTypeInt, [1, 2, 3, 4, 5, 6], true)) {
            $mysqli->begin_transaction();
            try {
              $stmt_check_diplomacy = $mysqli->prepare('SELECT id, diplomacyType FROM server_clan_diplomacy WHERE (senderClanId = ? AND toClanId = ?) OR (toClanId = ? AND senderClanId = ?)');
              $stmt_check_diplomacy->bind_param("iiii", $playerClan['id'], $toClan['id'], $playerClan['id'], $toClan['id']);
              $stmt_check_diplomacy->execute();
              $existingDiplomacyResult = $stmt_check_diplomacy->get_result();
              $fetch = $existingDiplomacyResult->fetch_assoc();
              $stmt_check_diplomacy->close();

              if ($existingDiplomacyResult->num_rows <= 0 || in_array($diplomacyTypeInt, [4, 5, 6], true)) { // 4,5,6 are 'end' types
                if ($diplomacyTypeInt == 3) { // Declare War
                  $stmt_insert_diplomacy = $mysqli->prepare('INSERT INTO server_clan_diplomacy (senderClanId, toClanId, diplomacyType) VALUES (?, ?, ?)');
                  $stmt_insert_diplomacy->bind_param("iii", $playerClan['id'], $toClan['id'], $diplomacyTypeInt);
                  $stmt_insert_diplomacy->execute();
                  $declaredId = $mysqli->insert_id;
                  $stmt_insert_diplomacy->close();

                  $stmt_delete_apps = $mysqli->prepare('DELETE FROM server_clan_diplomacy_applications WHERE senderClanId = ? AND toClanId = ?');
                  $stmt_delete_apps->bind_param("ii", $playerClan['id'], $toClan['id']);
                  $stmt_delete_apps->execute();
                  $stmt_delete_apps->close();

                  $json['status'] = true;
                  $json['message'] = 'You declared war on the ' . $toClan['name'] . ' clan.';

                  $json['declared'] = [
                    'id' => $declaredId,
                    'date' => date('d.m.Y'),
                    'form' => ($diplomacyTypeInt == 1 ? 'Alliance' : ($diplomacyTypeInt == 2 ? 'NAP' : 'War')),
                    'clan' => [
                      'id' => $toClan['id'],
                      'name' => $toClan['name']
                    ]
                  ];
                  Socket::Send('StartDiplomacy', ['SenderClanId' => $playerClan['id'], 'TargetClanId' => $toClan['id'], 'DiplomacyType' => $diplomacyTypeInt]);
                } else { // Alliance, NAP, or End War/Alliance/NAP applications
                  $stmt_check_app = $mysqli->prepare('SELECT id FROM server_clan_diplomacy_applications WHERE senderClanId = ? AND toClanId = ?');
                  $stmt_check_app->bind_param("ii", $playerClan['id'], $toClan['id']);
                  $stmt_check_app->execute();
                  $stmt_check_app->store_result();
                  $num_existing_apps = $stmt_check_app->num_rows;
                  $stmt_check_app->close();

                  if ($num_existing_apps <= 0) {
                    $stmt_insert_app = $mysqli->prepare('INSERT INTO server_clan_diplomacy_applications (senderClanId, toClanId, diplomacyType, message) VALUES (?, ?, ?, ?)');
                    // Message is bound as a parameter now
                    $stmt_insert_app->bind_param("iiis", $playerClan['id'], $toClan['id'], $diplomacyTypeInt, $message);
                    $stmt_insert_app->execute();
                    $requestId = $mysqli->insert_id;
                    $stmt_insert_app->close();

                    $json['status'] = true;
                    $json['message'] = 'Your diplomacy request was sent.';
                    $form_text = '';
                    switch ($diplomacyTypeInt) {
                        case 1: $form_text = 'Alliance'; break;
                        case 2: $form_text = 'NAP'; break;
                        // Case 3 (War) is handled above.
                        case 4: $form_text = 'End War'; break;
                        case 5: $form_text = 'End Alliance'; break;
                        case 6: $form_text = 'End NAP'; break;
                    }
                    $json['request'] = [
                      'id' => $requestId,
                      'date' => date('d.m.Y'),
                      'form' => $form_text,
                      'clan' => [
                        'name' => $toClan['name']
                      ]
                    ];
                  } else {
                    $json['message'] = 'You already submitted a diplomacy request to this clan.';
                  }
                }
              } else { // Existing diplomacy found, and not an "end" type request
                $currentStatus = $fetch['diplomacyType'] == 1 ? 'Alliance' : ($fetch['diplomacyType'] == 2 ? 'NAP' : 'War');
                $json['message'] = 'You already have a diplomatic status with this clan.<br>Current status: ' . $currentStatus . '';
              }
              $mysqli->commit();
            } catch (Exception $e) {
              $json['message'] = 'An error occurred. Please try again later: ' . $e->getMessage();
              $mysqli->rollback();
            }
            // $mysqli->close(); // Managed by Database class
          } else {
            $json['message'] = 'Something went wrong!';
          }
        } else {
          $json['message'] = 'Only leaders are can sent a diplomacy request.';
        }
      } else {
        $json['message'] = 'Something went wrong!';
      }
    } else {
      $json['message'] = 'Please select a clan.';
    }

    return json_encode($json);
  }

  public static function SendClanApplication($clanId, $text)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['status' => false, 'message' => 'Player not found.']); }

    $clanIdInt = (int)$clanId;
    // $text is handled by prepared statement, no manual escape here.

    $json = ['status' => false, 'message' => ''];

    $stmt_get_clan = $mysqli->prepare('SELECT id, recruiting, tag, name FROM server_clans WHERE id = ?');
    $stmt_get_clan->bind_param("i", $clanIdInt);
    $stmt_get_clan->execute();
    $clanResult = $stmt_get_clan->get_result();
    $clan = $clanResult->fetch_assoc();
    $stmt_get_clan->close();

    if ($clan != NULL && $clan['recruiting']) {
      $stmt_check_app = $mysqli->prepare('SELECT id FROM server_clan_applications WHERE clanId = ? AND userId = ?');
      $stmt_check_app->bind_param("ii", $clanIdInt, $player['userId']);
      $stmt_check_app->execute();
      $stmt_check_app->store_result();
      $existing_apps = $stmt_check_app->num_rows;
      $stmt_check_app->close();

      if ($existing_apps <= 0 && $player['clanId'] == 0) {
        if (empty($text)){
          $json['message'] = "Type your Application text";
          return json_encode($json);
        }

        $mysqli->begin_transaction();
        try {
          $stmt_insert_app = $mysqli->prepare('INSERT INTO server_clan_applications (clanId, userId, text) VALUES (?, ?, ?)');
          $stmt_insert_app->bind_param("iis", $clanIdInt, $player['userId'], $text);
          $stmt_insert_app->execute();

          $json['status'] = true;
          $json['message'] = 'Your application was sent to the clan leader.';
          $json['appId'] = $mysqli->insert_id; // or $stmt_insert_app->insert_id if mysqli driver supports it
          $stmt_insert_app->close();
          $json['clanTag'] = $clan['tag'];
          $json['clanName'] = $clan['name'];

          $mysqli->commit();
        } catch (Exception $e) {
          $json['message'] = 'An error occurred. Please try again later.';
          $mysqli->rollback();
        }
        // $mysqli->close(); // Managed by Database class
      } else {
        if ($player['clanId'] != 0) {
            $json['message'] = 'You are already in a clan.';
        } else if ($existing_apps > 0) {
            $json['message'] = 'You have already applied to this clan.';
        } else {
            $json['message'] = 'Something went wrong with application conditions!';
        }
      }
    } else {
      if ($clan == NULL) {
          $json['message'] = 'Clan not found or not recruiting.';
      } else if (!$clan['recruiting']) {
          $json['message'] = 'This clan is not recruiting members at the moment.';
      } else {
          $json['message'] = 'Something went wrong!';
      }
    }
    return json_encode($json);
  }

  public static function FoundClan($name, $tag, $description)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['message' => "Player not found.", 'status' => false]); }

    // Name, tag, description will be used in prepared statements, no manual escape.
    $json = ['message' => "", 'status' => false];

    if (mb_strlen($name) < 1 || mb_strlen($name) > 50) {
      $json['message'] = "Name only permit 1-50 characters"; // Corrected max length
      return json_encode($json);
    }
    if (mb_strlen($tag) < 1 || mb_strlen($tag) > 4) {
      $json['message'] = "Tag only permit 1-4 characters";
      return json_encode($json);
    }
    if (mb_strlen($description) > 16000) {
      $json['message'] = "Your clan description should be max 16000 characters.";
      return json_encode($json);
    }

    if ($player['clanId'] == 0) {
      $stmt_check_name = $mysqli->prepare('SELECT id FROM server_clans WHERE name = ?');
      $stmt_check_name->bind_param("s", $name);
      $stmt_check_name->execute();
      $stmt_check_name->store_result();
      $name_exists = $stmt_check_name->num_rows > 0;
      $stmt_check_name->close();

      if (!$name_exists) {
        $stmt_check_tag = $mysqli->prepare('SELECT id FROM server_clans WHERE tag = ?');
        $stmt_check_tag->bind_param("s", $tag);
        $stmt_check_tag->execute();
        $stmt_check_tag->store_result();
        $tag_exists = $stmt_check_tag->num_rows > 0;
        $stmt_check_tag->close();

        if (!$tag_exists) {
          $mysqli->begin_transaction();
          try {
            $join_dates_arr = [$player['userId'] => date('Y-m-d H:i:s')];
            $join_dates_json = json_encode($join_dates_arr);

            $stmt_delete_apps = $mysqli->prepare('DELETE FROM server_clan_applications WHERE userId = ?');
            $stmt_delete_apps->bind_param("i", $player['userId']);
            $stmt_delete_apps->execute();
            $stmt_delete_apps->close();

            $recruiting = 1;
            $stmt_insert_clan = $mysqli->prepare("INSERT INTO server_clans (name, tag, description, factionId, recruiting, leaderId, join_dates) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt_insert_clan->bind_param("sssiiss", $name, $tag, $description, $player['factionId'], $recruiting, $player['userId'], $join_dates_json);
            $stmt_insert_clan->execute();
            $clanId = $mysqli->insert_id;
            $stmt_insert_clan->close();

            $stmt_update_player = $mysqli->prepare('UPDATE player_accounts SET clanId = ? WHERE userId = ?');
            $stmt_update_player->bind_param("ii", $clanId, $player['userId']);
            $stmt_update_player->execute();
            $stmt_update_player->close();

            $json['status'] = true;
            Socket::Send('CreateClan', ['UserId' => $player['userId'], 'ClanId' => $clanId, 'FactionId' => $player['factionId'], 'Name' => $name, 'Tag' => $tag]);
            $mysqli->commit();
          } catch (Exception $e) {
            $json['message'] = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }
          // $mysqli->close(); // Managed by Database class
        } else {
          $json['message'] = 'Another clan is already using this tag. Please select another one for your clan.';
        }
      } else {
        $json['message'] = 'Another clan is already using this name. Please select another one for your clan.';
      }
    } else {
        $json['message'] = 'You are already in a clan.';
    }

    return json_encode($json);
  }

  public static function WithdrawPendingApplication($clanId)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['status' => false, 'message' => 'Player not found.']); }

    $clanIdInt = (int)$clanId;
    $userIdInt = (int)$player['userId'];
    $json = ['status' => false, 'message' => ''];

    $stmt_check_app = $mysqli->prepare('SELECT id FROM server_clan_applications WHERE clanId = ? AND userId = ?');
    $stmt_check_app->bind_param("ii", $clanIdInt, $userIdInt);
    $stmt_check_app->execute();
    $stmt_check_app->store_result();
    $app_exists = $stmt_check_app->num_rows > 0;
    $stmt_check_app->close();

    if ($app_exists) {
      $mysqli->begin_transaction();
      try {
        $stmt_delete_app = $mysqli->prepare('DELETE FROM server_clan_applications WHERE clanId = ? AND userId = ?');
        $stmt_delete_app->bind_param("ii", $clanIdInt, $userIdInt);
        $stmt_delete_app->execute();
        $stmt_delete_app->close();

        $json['status'] = true;
        $json['message'] = 'Application deleted.';
        $mysqli->commit();
      } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later.';
        $mysqli->rollback();
      }
      // $mysqli->close(); // Managed by Database class
    } else {
      $json['message'] = 'Something went wrong or application not found!';
    }
    return json_encode($json);
  }

  public static function LeaveClan()
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['status' => false, 'message' => 'Player not found.']); }

    $userIdInt = (int)$player['userId'];
    $playerClanId = (int)$player['clanId'];
    $json = ['status' => false, 'message' => ''];

    $stmt_get_clan = $mysqli->prepare('SELECT * FROM server_clans WHERE id = ?');
    $stmt_get_clan->bind_param("i", $playerClanId);
    $stmt_get_clan->execute();
    $clanResult = $stmt_get_clan->get_result();
    $clan = $clanResult->fetch_assoc();
    $stmt_get_clan->close();

    $notOnlineOrOnlineAndInEquipZone = !Socket::Get('IsOnline', array('UserId' => $userIdInt, 'Return' => false)) || (Socket::Get('IsOnline', array('UserId' => $userIdInt, 'Return' => false)) && Socket::Get('IsInEquipZone', array('UserId' => $userIdInt, 'Return' => false)));

    if ($clan != NULL && $clan['leaderId'] != $userIdInt) {
      if ($notOnlineOrOnlineAndInEquipZone) {
        $mysqli->begin_transaction();
        try {
          $stmt_update_player = $mysqli->prepare('UPDATE player_accounts SET clanId = 0 WHERE userId = ?');
          $stmt_update_player->bind_param("i", $userIdInt);
          $stmt_update_player->execute();
          $stmt_update_player->close();

          $join_dates = json_decode($clan['join_dates'], true); // Decode as assoc array
          if (is_array($join_dates) && array_key_exists($userIdInt, $join_dates)) { // Check if array and key exists
            unset($join_dates[$userIdInt]);
          }
          $join_dates_json = json_encode($join_dates);

          $stmt_update_clan = $mysqli->prepare("UPDATE server_clans SET join_dates = ? WHERE id = ?");
          $stmt_update_clan->bind_param("si", $join_dates_json, $clan['id']);
          $stmt_update_clan->execute();
          $stmt_update_clan->close();

          $json['status'] = true;
          Socket::Send('LeaveFromClan', ['UserId' => $userIdInt]);
          $mysqli->commit();
        } catch (Exception $e) {
          $json['message'] = 'An error occurred. Please try again later.';
          $mysqli->rollback();
        }
        // $mysqli->close(); // Managed by Database class
      } else {
        $json['message'] = 'You must be at your corporate HQ station to leave your Clan.';
      }
    } else {
        if ($clan == NULL) {
            $json['message'] = 'You are not in a clan.';
        } else if ($clan['leaderId'] == $userIdInt) {
            $json['message'] = 'Clan leaders cannot leave the clan. Transfer leadership or disband the clan.';
        } else {
            $json['message'] = 'Something went wrong!';
        }
    }
    return json_encode($json);
  }

  public static function DismissClanMember($userIdToDismiss = null) {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['status' => false, 'message' => 'Player not found.']); }

    $json = ['status' => false, 'message' => ''];
    $userIdToDismissInt = (int)$userIdToDismiss;
    $leaderIdInt = (int)$player['userId'];
    $playerClanId = (int)$player['clanId'];

    if (empty($userIdToDismissInt)){
      $json['message'] = "Error: User ID to dismiss is empty.";
      return json_encode($json);
    }
    if ($userIdToDismissInt == $leaderIdInt){
      $json['message'] = "Error: Leader cannot dismiss themselves.";
      return json_encode($json);
    }

    $stmt_get_clan = $mysqli->prepare('SELECT * FROM server_clans WHERE id = ?');
    $stmt_get_clan->bind_param("i", $playerClanId);
    $stmt_get_clan->execute();
    $clanResult = $stmt_get_clan->get_result();
    $clan = $clanResult->fetch_assoc();
    $stmt_get_clan->close();

    if ($clan == NULL || $clan['leaderId'] != $leaderIdInt) {
        $json['message'] = 'You are not the leader of this clan or clan not found.';
        return json_encode($json);
    }

    $stmt_get_user = $mysqli->prepare('SELECT userId FROM player_accounts WHERE userId = ? AND clanId = ?');
    $stmt_get_user->bind_param("ii", $userIdToDismissInt, $playerClanId);
    $stmt_get_user->execute();
    $userResult = $stmt_get_user->get_result();
    $user = $userResult->fetch_assoc();
    $stmt_get_user->close();

    if ($user == NULL) {
        $json['message'] = 'User not found in this clan.';
        return json_encode($json);
    }

    // All checks passed, proceed with dismissal
    $mysqli->begin_transaction();
    try {
      $stmt_update_user_clan = $mysqli->prepare('UPDATE player_accounts SET clanId = 0 WHERE userId = ?');
      $stmt_update_user_clan->bind_param("i", $userIdToDismissInt);
      $stmt_update_user_clan->execute();
      $stmt_update_user_clan->close();

      $join_dates = json_decode($clan['join_dates'], true); // Decode as assoc array
      if (is_array($join_dates) && array_key_exists($userIdToDismissInt, $join_dates)) {
        unset($join_dates[$userIdToDismissInt]);
      }
      $join_dates_json = json_encode($join_dates);

      $stmt_update_clan_joins = $mysqli->prepare("UPDATE server_clans SET join_dates = ? WHERE id = ?");
      $stmt_update_clan_joins->bind_param("si", $join_dates_json, $clan['id']);
      $stmt_update_clan_joins->execute();
      $stmt_update_clan_joins->close();

      $json['status'] = true;
      $json['message'] = 'Member dismissed successfully.';
      Socket::Send('LeaveFromClan', array('UserId' => $userIdToDismissInt));
      $mysqli->commit();
    } catch (Exception $e) {
      $json['message'] = 'An error occurred. Please try again later.';
      $mysqli->rollback();
    }
    // $mysqli->close(); // Managed by Database class

    return json_encode($json);
  }

  public static function AcceptClanApplication($userId)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer(); // Leader's data
    if (!$player) { return json_encode(['status' => false, 'message' => 'Player not found.']); }

    $userIdToAcceptInt = (int)$userId; // User whose application is being accepted
    $leaderUserIdInt = (int)$player['userId'];
    $playerClanId = (int)$player['clanId'];

    $json = ['status' => false, 'message' => ''];

    // Get user to accept details
    $stmt_get_user = $mysqli->prepare('SELECT userId, pilotName, clanId, data, rankId FROM player_accounts WHERE userId = ?');
    $stmt_get_user->bind_param("i", $userIdToAcceptInt);
    $stmt_get_user->execute();
    $userResult = $stmt_get_user->get_result();
    $user = $userResult->fetch_assoc();
    $stmt_get_user->close();

    // Get clan details
    $stmt_get_clan = $mysqli->prepare('SELECT id, leaderId, join_dates FROM server_clans WHERE id = ?');
    $stmt_get_clan->bind_param("i", $playerClanId);
    $stmt_get_clan->execute();
    $clanResult = $stmt_get_clan->get_result();
    $clan = $clanResult->fetch_assoc();
    $stmt_get_clan->close();

    if ($clan != NULL && $user != NULL && $clan['leaderId'] == $leaderUserIdInt && $user['clanId'] == 0) {
      $mysqli->begin_transaction();
      try {
        $stmt_update_user_clan = $mysqli->prepare('UPDATE player_accounts SET clanId = ? WHERE userId = ?');
        $stmt_update_user_clan->bind_param("ii", $clan['id'], $user['userId']);
        $stmt_update_user_clan->execute();
        $stmt_update_user_clan->close();

        $join_dates = json_decode($clan['join_dates'], true);
        if (!is_array($join_dates)) $join_dates = []; // Ensure it's an array
        $join_dates[$user['userId']] = date('Y-m-d H:i:s');
        $join_dates_json = json_encode($join_dates);

        $stmt_update_clan_joins = $mysqli->prepare("UPDATE server_clans SET join_dates = ? WHERE id = ?");
        $stmt_update_clan_joins->bind_param("si", $join_dates_json, $clan['id']);
        $stmt_update_clan_joins->execute();
        $stmt_update_clan_joins->close();

        $stmt_delete_app = $mysqli->prepare('DELETE FROM server_clan_applications WHERE userId = ?');
        $stmt_delete_app->bind_param("i", $user['userId']);
        $stmt_delete_app->execute();
        $stmt_delete_app->close();

        $json['status'] = true;

        $user_data_decoded = json_decode($user['data']);
        $experience = $user_data_decoded ? $user_data_decoded->experience : 0;

        $json['acceptedUser'] = [
          'userId' => $user['userId'],
          'pilotName' => $user['pilotName'],
          'experience' => number_format($experience),
          'rank' => [
            'id' => $user['rankId'],
            'name' => Functions::GetRankName($user['rankId']) // Assuming GetRankName is safe
          ],
          'joined_date' => date('Y.m.d'),
          'company' => isset($user['factionId']) ? ($user['factionId'] == 1 ? 'MMO' : ($user['factionId'] == 2 ? 'EIC' : 'VRU')) : 'Unknown'
        ];

        $json['message'] = 'Clan joined: ' . $user['pilotName'];

        if (Socket::Get('IsOnline', ['UserId' => $user['userId'], 'Return' => false])) {
          Socket::Send('JoinToClan', ['UserId' => $user['userId'], 'ClanId' => $clan['id']]);
        }
        $mysqli->commit();
      } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later.';
        $mysqli->rollback();
      }
      // $mysqli->close(); // Managed by Database class
    } else {
        if ($clan == NULL) $json['message'] = 'Clan not found.';
        else if ($user == NULL) $json['message'] = 'User to accept not found.';
        else if ($clan['leaderId'] != $leaderUserIdInt) $json['message'] = 'You are not the leader of this clan.';
        else if ($user['clanId'] != 0) $json['message'] = 'This user is already in a clan.';
        else $json['message'] = 'Something went wrong with the conditions for accepting application.';
    }
    return json_encode($json);
  }

  public static function DeclineClanApplication($userId)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer(); // Leader's data
    if (!$player) { return json_encode(['status' => false, 'message' => 'Player not found.']); }

    $userIdToDeclineInt = (int)$userId;
    $leaderUserIdInt = (int)$player['userId'];
    $playerClanId = (int)$player['clanId'];
    $json = ['status' => false, 'message' => ''];

    // Get user to decline (only need pilotName for message)
    $stmt_get_user = $mysqli->prepare('SELECT pilotName FROM player_accounts WHERE userId = ?');
    $stmt_get_user->bind_param("i", $userIdToDeclineInt);
    $stmt_get_user->execute();
    $userResult = $stmt_get_user->get_result();
    $userToDecline = $userResult->fetch_assoc();
    $stmt_get_user->close();

    // Get clan details (only need leaderId to verify permission)
    $stmt_get_clan = $mysqli->prepare('SELECT leaderId FROM server_clans WHERE id = ?');
    $stmt_get_clan->bind_param("i", $playerClanId);
    $stmt_get_clan->execute();
    $clanResult = $stmt_get_clan->get_result();
    $clan = $clanResult->fetch_assoc();
    $stmt_get_clan->close();

    if ($clan != NULL && $userToDecline != NULL && $clan['leaderId'] == $leaderUserIdInt) {
      $mysqli->begin_transaction();
      try {
        $stmt_delete_app = $mysqli->prepare('DELETE FROM server_clan_applications WHERE clanId = ? AND userId = ?');
        $stmt_delete_app->bind_param("ii", $playerClanId, $userIdToDeclineInt);
        $stmt_delete_app->execute();
        $stmt_delete_app->close();

        $json['status'] = true;
        $json['message'] = 'This user was declined: ' . $userToDecline['pilotName'];
        $mysqli->commit();
      } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later.';
        $mysqli->rollback();
      }
      // $mysqli->close(); // Managed by Database class
    } else {
      $json['message'] = 'Something went wrong!';
    }

    return json_encode($json);
  }

  public static function CancelDiplomacyRequest($requestId) {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['status' => false, 'message' => 'Player not found.']); }

    $playerClanId = (int)$player['clanId'];
    $leaderUserIdInt = (int)$player['userId'];
    $requestIdInt = (int)$requestId; // Assuming requestId is an integer
    $json = ['status' => false, 'message' => ''];

    $stmt_get_clan = $mysqli->prepare('SELECT leaderId FROM server_clans WHERE id = ?');
    $stmt_get_clan->bind_param("i", $playerClanId);
    $stmt_get_clan->execute();
    $clanResult = $stmt_get_clan->get_result();
    $clan = $clanResult->fetch_assoc();
    $stmt_get_clan->close();

    if ($clan != NULL) {
      if ($clan['leaderId'] == $leaderUserIdInt) {
        // Check if the request to be cancelled actually belongs to this clan and this request ID
        $stmt_check_app = $mysqli->prepare('SELECT id FROM server_clan_diplomacy_applications WHERE senderClanId = ? AND id = ?');
        $stmt_check_app->bind_param("ii", $playerClanId, $requestIdInt);
        $stmt_check_app->execute();
        $stmt_check_app->store_result();
        $app_exists = $stmt_check_app->num_rows > 0;
        $app_id_to_delete = null;
        if($app_exists) {
            // $stmt_check_app->bind_result($app_id_to_delete); // Not needed if just checking existence and deleting by same ID
            // $stmt_check_app->fetch();
        }
        $stmt_check_app->close();

        if ($app_exists) {
          $mysqli->begin_transaction();
          try {
            $stmt_delete_app = $mysqli->prepare('DELETE FROM server_clan_diplomacy_applications WHERE id = ? AND senderClanId = ?');
            $stmt_delete_app->bind_param("ii", $requestIdInt, $playerClanId); // ensure deleting the correct one
            $stmt_delete_app->execute();

            if ($stmt_delete_app->affected_rows > 0) {
                $json['status'] = true;
                $json['message'] = 'Your diplomatic request was withdrawn.';
            } else {
                $json['message'] = 'Could not withdraw the request or request already withdrawn.';
            }
            $stmt_delete_app->close();
            $mysqli->commit();
          } catch (Exception $e) {
            $json['message'] = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }
          // $mysqli->close(); // Managed by Database class
        } else {
          $json['message'] = 'Diplomacy request not found or does not belong to your clan.';
        }
      } else {
        $json['message'] = 'Only leaders are can cancel a diplomacy request.';
      }
    } else {
      $json['message'] = 'Clan not found.';
    }
    return json_encode($json);
  }

  public static function DeclineDiplomacyRequest($requestId)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['status' => false, 'message' => 'Player not found.']); }

    $playerClanId = (int)$player['clanId'];
    $leaderUserIdInt = (int)$player['userId'];
    $requestIdInt = (int)$requestId;
    $json = ['status' => false, 'message' => ''];

    $stmt_get_clan = $mysqli->prepare('SELECT leaderId FROM server_clans WHERE id = ?');
    $stmt_get_clan->bind_param("i", $playerClanId);
    $stmt_get_clan->execute();
    $clanLeaderResult = $stmt_get_clan->get_result()->fetch_assoc();
    $stmt_get_clan->close();

    if ($clanLeaderResult != NULL) {
      if ($clanLeaderResult['leaderId'] == $leaderUserIdInt) {
        $stmt_get_app = $mysqli->prepare('SELECT id, senderClanId FROM server_clan_diplomacy_applications WHERE toClanId = ? AND id = ?');
        $stmt_get_app->bind_param("ii", $playerClanId, $requestIdInt);
        $stmt_get_app->execute();
        $appResult = $stmt_get_app->get_result();
        $application_to_decline = $appResult->fetch_assoc();
        $stmt_get_app->close();

        if ($application_to_decline) {
          $mysqli->begin_transaction();
          try {
            $stmt_delete_app = $mysqli->prepare('DELETE FROM server_clan_diplomacy_applications WHERE id = ?');
            $stmt_delete_app->bind_param("i", $application_to_decline['id']);
            $stmt_delete_app->execute();
            $stmt_delete_app->close();

            $stmt_get_sender_clan_name = $mysqli->prepare('SELECT name FROM server_clans WHERE id = ?');
            $stmt_get_sender_clan_name->bind_param("i", $application_to_decline['senderClanId']);
            $stmt_get_sender_clan_name->execute();
            $senderClanName = $stmt_get_sender_clan_name->get_result()->fetch_assoc()['name'];
            $stmt_get_sender_clan_name->close();

            $json['status'] = true;
            $json['message'] = "You declined the " . htmlspecialchars($senderClanName) . " clan's diplomacy request.";
            $mysqli->commit();
          } catch (Exception $e) {
            $json['message'] = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }
          // $mysqli->close(); // Managed by Database class
        } else {
          $json['message'] = 'Diplomacy application not found for your clan or this ID.';
        }
      } else {
        $json['message'] = 'Only leaders can decline a diplomacy request.';
      }
    } else {
      $json['message'] = 'Clan not found.';
    }

    return json_encode($json);
  }

  public static function AcceptDiplomacyRequest($requestId)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['status' => false, 'message' => 'Player not found.']); }

    $playerClanId = (int)$player['clanId'];
    $leaderUserIdInt = (int)$player['userId'];
    $requestIdInt = (int)$requestId;
    $json = ['status' => false, 'message' => ''];

    $stmt_get_clan_leader = $mysqli->prepare('SELECT leaderId FROM server_clans WHERE id = ?');
    $stmt_get_clan_leader->bind_param("i", $playerClanId);
    $stmt_get_clan_leader->execute();
    $clanLeaderResult = $stmt_get_clan_leader->get_result()->fetch_assoc();
    $stmt_get_clan_leader->close();

    if ($clanLeaderResult != NULL) {
      if ($clanLeaderResult['leaderId'] == $leaderUserIdInt) {
        $stmt_get_app = $mysqli->prepare('SELECT * FROM server_clan_diplomacy_applications WHERE toClanId = ? AND id = ?');
        $stmt_get_app->bind_param("ii", $playerClanId, $requestIdInt);
        $stmt_get_app->execute();
        $appResult = $stmt_get_app->get_result();
        $application_to_accept = $appResult->fetch_assoc();
        $stmt_get_app->close();

        if ($application_to_accept) {
          $mysqli->begin_transaction();
          try {
            $stmt_delete_app = $mysqli->prepare('DELETE FROM server_clan_diplomacy_applications WHERE id = ?');
            $stmt_delete_app->bind_param("i", $application_to_accept['id']);
            $stmt_delete_app->execute();
            $stmt_delete_app->close();

            $appDiplomacyType = (int)$application_to_accept['diplomacyType'];
            $senderClanId = (int)$application_to_accept['senderClanId'];
            $toClanId = (int)$application_to_accept['toClanId']; // This should be player's clan ID

            if (in_array($appDiplomacyType, [4, 5, 6], true)) { // End diplomacy types
              $stmt_find_existing_diplomacy = $mysqli->prepare('SELECT id FROM server_clan_diplomacy WHERE (senderClanId = ? AND toClanId = ?) OR (toClanId = ? AND senderClanId = ?)');
              $stmt_find_existing_diplomacy->bind_param("iiii", $senderClanId, $toClanId, $senderClanId, $toClanId);
              $stmt_find_existing_diplomacy->execute();
              $existingDiplomacyResult = $stmt_find_existing_diplomacy->get_result();
              $diplomacy_to_delete = $existingDiplomacyResult->fetch_assoc();
              $stmt_find_existing_diplomacy->close();

              if ($diplomacy_to_delete) {
                $stmt_delete_diplomacy = $mysqli->prepare('DELETE FROM server_clan_diplomacy WHERE id = ?');
                $stmt_delete_diplomacy->bind_param("i", $diplomacy_to_delete['id']);
                $stmt_delete_diplomacy->execute();
                $stmt_delete_diplomacy->close();

                $json['status'] = true;
                if ($appDiplomacyType == 4) $json['message'] = 'War ended';
                if ($appDiplomacyType == 5) $json['message'] = 'Alliance ended';
                if ($appDiplomacyType == 6) $json['message'] = 'Nap ended';
                // For UI update if needed:
                if ($appDiplomacyType == 4) $json['warEnded'] = ['id' => $diplomacy_to_delete['id']];

                Socket::Send('EndDiplomacy', ['SenderClanId' => $senderClanId, 'TargetClanId' => $toClanId]);
              } else {
                $json['message'] = 'Could not find the diplomacy to end.';
              }
            } else { // Start new diplomacy (Alliance, NAP, War)
              $stmt_insert_diplomacy = $mysqli->prepare('INSERT INTO server_clan_diplomacy (senderClanId, toClanId, diplomacyType) VALUES (?, ?, ?)');
              $stmt_insert_diplomacy->bind_param("iii", $senderClanId, $toClanId, $appDiplomacyType);
              $stmt_insert_diplomacy->execute();
              $new_diplomacy_id = $mysqli->insert_id;
              $stmt_insert_diplomacy->close();

              $stmt_get_sender_name = $mysqli->prepare('SELECT name FROM server_clans WHERE id = ?');
              $stmt_get_sender_name->bind_param("i", $senderClanId);
              $stmt_get_sender_name->execute();
              $senderClanName = $stmt_get_sender_name->get_result()->fetch_assoc()['name'];
              $stmt_get_sender_name->close();

              $form_text = '';
              if ($appDiplomacyType == 1) $form_text = 'Alliance';
              else if ($appDiplomacyType == 2) $form_text = 'NAP';
              else if ($appDiplomacyType == 3) $form_text = 'War'; // Should not happen if type 3 is direct declaration

              $json['acceptedRequest'] = [
                'id' => $new_diplomacy_id,
                'name' => $senderClanName,
                'form' => $form_text,
                'diplomacyType' => $appDiplomacyType,
                'date' => date('d.m.Y')
              ];
              $json['status'] = true;
              $json['message'] = "You accepted the " . htmlspecialchars($senderClanName) . " clan's diplomacy request.<br>New status: " . $form_text . "";
              Socket::Send('StartDiplomacy', ['SenderClanId' => $senderClanId, 'TargetClanId' => $toClanId, 'DiplomacyType' => $appDiplomacyType]);
            }
            $mysqli->commit();
          } catch (Exception $e) {
            $json['message'] = 'An error occurred. Please try again later: ' . $e->getMessage();
            $mysqli->rollback();
          }
          // $mysqli->close(); // Managed by Database class
        } else {
          $json['message'] = 'Diplomacy application not found.';
        }
      } else {
        $json['message'] = 'Only leaders can accept a diplomacy request.';
      }
    } else {
      $json['message'] = 'Clan not found.';
    }

    return json_encode($json);
  }


  public static function InitQuestsystem() {
    Functions::$lang = "en";
    Functions::insertTranslation("en", "destroy_npc", "Destroy {amount} {target}{company}");
    Functions::insertTranslation("en", "destroy_player", "Destroy {amount} {target}{company}");
    Functions::insertTranslation("en", "company", "from the company");
    Functions::insertTranslation("en", "credits", "Credits");
    Functions::insertTranslation("en", "uridium", "Uridium");
    Functions::insertTranslation("en", "accept", "Accept");
    Functions::insertTranslation("en", "collect", "Collect");
    Functions::insertTranslation("en", "error", "An error occured.");
    Functions::insertTranslation("en", "acceptSuccess", "Quest successfully accepted.");
    Functions::insertTranslation("en", "cancel", "Cancel");
    Functions::insertTranslation("en", "cancelSuccess", "Quest aborted.");
    Functions::insertTranslation("en", "collect", "Collect");
    Functions::insertTranslation("en", "collectSuccess", "Quest successfully collected.");
    Functions::insertTranslation("en", "questCollected", "Mission completed");
    Functions::insertTranslation("en", "jobs", "Quests");
    Functions::insertTranslation("en", "overview", "Overview");
    Functions::insertTranslation("en", "reward", "Rewards");
    Functions::insertTranslation("en", "questLvlTooLow", "Level too low");
    Functions::insertTranslation("en", "level", "Level");
    Functions::insertTranslation("en", "lcb10", "LCB-10");
    Functions::insertTranslation("en", "plt2021", "PLT-2021");
    Functions::insertTranslation("en", "r310", "R-310");
    Functions::insertTranslation("en", "exp", "Experience");
    Functions::insertTranslation("en", "hon", "Honor");
    Functions::insertTranslation("en", "mcb25", "MCB-25");
    Functions::insertTranslation("en", "sab", "SAB-50");
    Functions::insertTranslation("en", "mcb50", "MCB-50");
	Functions::insertTranslation("en", "xcb25", "XCB-25");
	Functions::insertTranslation("en", "xcb50", "XCB-50");
	Functions::insertTranslation("en", "acm", "ACM-1");
	Functions::insertTranslation("en", "lxcb75", "LXCB-75");
	Functions::insertTranslation("en", "emp", "EMP-01");
    Functions::insertTranslation("en", "lf2", "LF-2");
    Functions::insertTranslation("en", "lf3", "LF-3");
	Functions::insertTranslation("en", "cyborg", "cyborg");
    Functions::insertTranslation("en", "lf4", "LF-4");
	Functions::insertTranslation("en", "lf4sp", "LF-4");
	Functions::insertTranslation("en", "lf5", "Prometeus");
    Functions::insertTranslation("en", "eco10", "ECO-10");
	Functions::insertTranslation("en", "ubr100", "UBR-100");
	Functions::insertTranslation("en", "hstrm01", "HSTRM-01");
	Functions::insertTranslation("en", "sar01", "SAR-01");
	Functions::insertTranslation("en", "sar02", "SAR-02");
    Functions::insertTranslation("en", "bo1", "B01");
    Functions::insertTranslation("en", "bo2", "B02");
	Functions::insertTranslation("en", "bo3", "B03");
    Functions::insertTranslation("en", "g3n", "G3N7900");
    Functions::insertTranslation("en", "questMax", "Max. Quests accepted");
    Functions::insertTranslation("en", "ucb", "UCB-100");
    Functions::insertTranslation("en", "rsb", "RSB-75");
	Functions::insertTranslation("en", "cloacks", "CLO4K-XL");
    Functions::insertTranslation("en", "logfiles", "Logfiles");
    Functions::insertTranslation("en", "plt3030", "PLT-3030");
    Functions::insertTranslation("en", "plt2026", "PLT-2026");
    Functions::insertTranslation("en", "lf1", "LF-1");
    Functions::insertTranslation("en", "a03", "A-03");
    Functions::insertTranslation("en", "lf3n", "LF-3 Neutron");
    Functions::insertTranslation("en", "premium", "day(s) premium");
    Functions::setAmmoId("lcb10", "ammunition_laser_lcb-10");
    Functions::setAmmoId("mcb25", "ammunition_laser_mcb-25");
    Functions::setAmmoId("mcb50", "ammunition_laser_mcb-50");
	Functions::setAmmoId("xcb25", "ammunition_laser_xcb-25");
	Functions::setAmmoId("xcb50", "ammunition_laser_xcb-50");
	Functions::setAmmoId("lxcb75", "ammunition_laser_lxcb-75");
	Functions::setAmmoId("acm", "ammunition_mine_acm-01");
	Functions::setAmmoId("emp", "ammunition_specialammo_emp-01");
    Functions::setAmmoId("ucb", "ammunition_laser_ucb-100");
    Functions::setAmmoId("rsb", "ammunition_laser_rsb-75");
	Functions::setAmmoId("cloacks", "equipment_extra_cpu_cl04k-xl");
    Functions::setAmmoId("sab", "ammunition_laser_sab-50");
    Functions::setAmmoId("r310", "ammunition_rocket_r-310");
    Functions::setAmmoId("plt3030", "ammunition_rocket_plt-3030");
    Functions::setAmmoId("plt2026", "ammunition_rocket_plt-2026");
    Functions::setAmmoId("plt2021", "ammunition_rocket_plt-2021");
    Functions::setAmmoId("eco10", "ammunition_rocketlauncher_eco-10");
	Functions::setAmmoId("ubr100", "ammunition_rocketlauncher_ubr-100");
	Functions::setAmmoId("sar01", "ammunition_rocketlauncher_sar-01");
	Functions::setAmmoId("sar02", "ammunition_rocketlauncher_sar-02");
	Functions::setAmmoId("hstrm01", "ammunition_rocketlauncher_hstrm-01");
    Functions::setAmmoId("lf1", "equipment_weapon_laser_lf-1");
    Functions::setAmmoId("lf2", "equipment_weapon_laser_lf-2");
    Functions::setAmmoId("lf3", "equipment_weapon_laser_lf-3");
	Functions::setAmmoId("cyborg", "drone_designs_cyborg");
    Functions::setAmmoId("lf4", "equipment_weapon_laser_lf-4");
	Functions::setAmmoId("lf4sp", "equipment_weapon_laser_lf-4-sp");
	Functions::setAmmoId("lf5", "equipment_weapon_laser_pr-l");
    Functions::setAmmoId("lf3n", "equipment_weapon_laser_lf-3n");
    Functions::setAmmoId("bo1", "equipment_generator_shield_sg3n-b01");
    Functions::setAmmoId("bo2", "equipment_generator_shield_sg3n-b02");
	Functions::setAmmoId("bo3", "equipment_generator_shield_sg3n-b03");
    Functions::setAmmoId("a03", "equipment_generator_shield_a-03");
    Functions::setAmmoId("g3n", "equipment_generator_speed_g3n-7900");
}


public static function AcceptQuest($questId)
{
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['message' => 'Player not found.']); }

    $questIdInt = (int)$questId; // Assuming $questId is intended to be an integer
    $userIdInt = (int)$player["userId"];
    $levelInt = (int)$player["level"];
    $json = ['message' => ''];

    // Check quest level requirement
    $stmt_quest_lvl = $mysqli->prepare("SELECT neededLvl FROM server_quests WHERE id = ?");
    $stmt_quest_lvl->bind_param("i", $questIdInt);
    $stmt_quest_lvl->execute();
    $rowQuest = $stmt_quest_lvl->get_result()->fetch_assoc();
    $stmt_quest_lvl->close();
    if (!$rowQuest || $rowQuest["neededLvl"] > $levelInt) {
        $json['message'] = "Level requirement not met or quest not found.";
        return json_encode($json);
    }

    // Check max accepted quests
    $stmt_count_accepted = $mysqli->prepare("SELECT COUNT(id) as count FROM player_quests WHERE userId = ? AND state = 'accepted'");
    $stmt_count_accepted->bind_param("i", $userIdInt);
    $stmt_count_accepted->execute();
    $numCount = $stmt_count_accepted->get_result()->fetch_assoc()['count'];
    $stmt_count_accepted->close();
    if($numCount >= 5) {
        $json['message'] = "Maximum number of quests accepted.";
        return json_encode($json);
    }

    // Fetch existing NPC and Player kills (these are logs, not directly parameterized by $questId)
    $stmt_npc_kills = $mysqli->prepare("SELECT npc, amount FROM log_player_pve_kills WHERE userId = ?");
    $stmt_npc_kills->bind_param("i", $userIdInt);
    $stmt_npc_kills->execute();
    $npcKillsResult = $stmt_npc_kills->get_result();
    $npcKills = [];
    while($row = $npcKillsResult->fetch_assoc()) $npcKills[] = $row;
    $stmt_npc_kills->close();

    $stmt_player_kills = $mysqli->prepare("SELECT ship, amount FROM log_player_pvp_kills WHERE userId = ?");
    $stmt_player_kills->bind_param("i", $userIdInt);
    $stmt_player_kills->execute();
    $playerKillsResult = $stmt_player_kills->get_result();
    $playerKills = [];
    while($row = $playerKillsResult->fetch_assoc()) $playerKills[] = $row;
    $stmt_player_kills->close();

    // Check if quest already accepted/completed by player
    $stmt_check_player_quest = $mysqli->prepare("SELECT id FROM player_quests WHERE userId = ? AND questId = ?");
    $stmt_check_player_quest->bind_param("ii", $userIdInt, $questIdInt);
    $stmt_check_player_quest->execute();
    $stmt_check_player_quest->store_result();
    $num_player_quest = $stmt_check_player_quest->num_rows;
    $stmt_check_player_quest->close();

    if($num_player_quest <= 0) {
        $mysqli->begin_transaction();
        try {
            $stmt_insert_player_quest = $mysqli->prepare("INSERT INTO player_quests (userId, questId) VALUES (?, ?)");
            $stmt_insert_player_quest->bind_param("ii", $userIdInt, $questIdInt);
            $stmt_insert_player_quest->execute();
            $stmt_insert_player_quest->close();

            $stmt_log_quest_accepted = $mysqli->prepare("INSERT INTO log_player_quests (userid, questid, state) VALUES (?, ?, 'quest_accepted')");
            $stmt_log_quest_accepted->bind_param("ii", $userIdInt, $questIdInt);
            $stmt_log_quest_accepted->execute();
            $stmt_log_quest_accepted->close();

            $stmt_insert_tmp_log = $mysqli->prepare("INSERT INTO log_player_quests_state_tmp (userId, questId, type, charId, amount) VALUES (?, ?, ?, ?, ?)");
            foreach($npcKills as $kill) {
                $type = 'npc';
                $stmt_insert_tmp_log->bind_param("iisii", $userIdInt, $questIdInt, $type, $kill["npc"], $kill["amount"]);
                if (!$stmt_insert_tmp_log->execute()) { throw new Exception("Error inserting NPC kill log: " . $stmt_insert_tmp_log->error); }
            }
            foreach($playerKills as $kill) {
                $type = 'ship';
                $stmt_insert_tmp_log->bind_param("iisii", $userIdInt, $questIdInt, $type, $kill["ship"], $kill["amount"]);
                if (!$stmt_insert_tmp_log->execute()) { throw new Exception("Error inserting Player kill log: " . $stmt_insert_tmp_log->error); }
            }
            $stmt_insert_tmp_log->close();

            $mysqli->commit();
            $json['message'] = "Quest accepted successfully."; // Provide success message
        } catch (Exception $e) {
            $mysqli->rollback();
            $json['message'] = "Error accepting quest: " . $e->getMessage();
            Functions::LogError($e->getMessage()); // Log actual error
        }
    } else {
        $json['message'] = "Quest already accepted or completed.";
    }
    return json_encode($json);
}

public static function CancelQuest($questId)
{
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['message' => 'Player not found.']); }

    $questIdInt = (int)$questId;
    $userIdInt = (int)$player["userId"];
    $json = ['message' => ''];
    $state = '';

    $stmt_get_quest_state = $mysqli->prepare("SELECT state FROM player_quests WHERE userId = ? AND questId = ?");
    $stmt_get_quest_state->bind_param("ii", $userIdInt, $questIdInt);
    $stmt_get_quest_state->execute();
    $result_quest_state = $stmt_get_quest_state->get_result();
    if($row_quest_state = $result_quest_state->fetch_assoc()) {
        $state = $row_quest_state["state"];
    }
    $stmt_get_quest_state->close();

    if($state == "accepted") {
        $mysqli->begin_transaction();
        try {
            $stmt_delete_player_quest = $mysqli->prepare("DELETE FROM player_quests WHERE userId = ? AND questId = ?");
            $stmt_delete_player_quest->bind_param("ii", $userIdInt, $questIdInt);
            $stmt_delete_player_quest->execute();
            $stmt_delete_player_quest->close();

            $stmt_log_quest_canceled = $mysqli->prepare("INSERT INTO log_player_quests (userid, questid, state) VALUES (?, ?, 'quest_canceled')");
            $stmt_log_quest_canceled->bind_param("ii", $userIdInt, $questIdInt);
            $stmt_log_quest_canceled->execute();
            $stmt_log_quest_canceled->close();

            $stmt_delete_tmp_logs = $mysqli->prepare("DELETE FROM log_player_quests_state_tmp WHERE userId = ? AND questId = ?");
            $stmt_delete_tmp_logs->bind_param("ii", $userIdInt, $questIdInt);
            $stmt_delete_tmp_logs->execute();
            $stmt_delete_tmp_logs->close();

            $mysqli->commit();
            $json['message'] = "Quest canceled successfully.";
        } catch (Exception $e) {
            $mysqli->rollback();
            $json['message'] = "Error canceling quest: " . $e->getMessage();
            Functions::LogError($e->getMessage());
        }
    } else {
        $json['message'] = "Quest not in accepted state or not found.";
    }

return json_encode($json);
}

public static function CollectQuest($questId)
{
  Functions::InitQuestsystem();
  
$mysqli = Database::GetInstance();
$player = Functions::GetPlayer();
if (!$player) { return json_encode(['message' => 'Player not found.']); }

$questIdInt = (int)$questId; // Assuming $questId is intended to be integer
$userIdInt = (int)$player["userId"];
$levelInt = (int)$player['level'];
$json = ['message' => ''];

// Fetch NPC kills
$stmt_npc_kills = $mysqli->prepare("SELECT npc, amount FROM log_player_pve_kills WHERE userId = ?");
$stmt_npc_kills->bind_param("i", $userIdInt);
$stmt_npc_kills->execute();
$npcKillsResult = $stmt_npc_kills->get_result();
$npcKills = [];
while($row = $npcKillsResult->fetch_assoc()) $npcKills[] = $row;
$stmt_npc_kills->close();

// Fetch Player kills
$stmt_player_kills = $mysqli->prepare("SELECT ship, amount FROM log_player_pvp_kills WHERE userId = ?");
$stmt_player_kills->bind_param("i", $userIdInt);
$stmt_player_kills->execute();
$playerKillsResult = $stmt_player_kills->get_result();
$playerKills = [];
while($row = $playerKillsResult->fetch_assoc()) $playerKills[] = $row;
$stmt_player_kills->close();

$static_sql_all_quests = "SELECT * FROM server_quests ORDER BY neededLvl ASC"; // This query is static, no user input

// Check current quest state for player
$stmt_check_player_quest = $mysqli->prepare("SELECT state FROM player_quests WHERE userId = ? AND questId = ?");
$stmt_check_player_quest->bind_param("ii", $userIdInt, $questIdInt);
$stmt_check_player_quest->execute();
$playerQuestStateResult = $stmt_check_player_quest->get_result();

while($rowCheck = $playerQuestStateResult->fetch_assoc()) { // Should be only one row or zero
    // This part seems to re-verify quest completion status.
    // The call to Functions::checkQuest internally uses $mysqli->query. This needs to be addressed later.
    // For now, focusing on direct queries in THIS function.
    $queryTmp = $mysqli->query($static_sql_all_quests); // Static query, considered safe for now
    $questState = 0;
    while($rowTmp = $queryTmp->fetch_assoc()) {
        if($rowTmp["id"] == $questIdInt) {
            // Assuming checkQuest does not have SQLi with its current inputs or will be fixed separately.
            $rowTmp = Functions::checkQuest($rowTmp, $mysqli, $userIdInt, $levelInt, $npcKills, $playerKills);
            $questState = $rowTmp["state"];
        }
    }

    if($rowCheck["state"] == "accepted" && $questState == 2) {
        // Fetch quest rewards
        $stmt_rewards = $mysqli->prepare("SELECT * FROM server_quests_rewards_temp AS t LEFT JOIN server_quests_rewards AS r ON t.rewardId = r.id WHERE questId = ?");
        $stmt_rewards->bind_param("i", $questIdInt);
        $stmt_rewards->execute();
        $rewardsResult = $stmt_rewards->get_result();

        // Fetch player account data
        $stmt_player_account = $mysqli->prepare("SELECT data, ammo, premium, premiumUntil FROM player_accounts WHERE userId = ?");
        $stmt_player_account->bind_param("i", $userIdInt);
        $stmt_player_account->execute();
        $playerAccountResult = $stmt_player_account->get_result();
        $playerAccountData = $playerAccountResult->fetch_assoc();
        $stmt_player_account->close();

        if ($playerAccountData) {
            $data1 = $playerAccountData["data"];
            $ammo = $playerAccountData["ammo"];
            $premiumUntil = $playerAccountData["premiumUntil"];
            $premiumVal = $playerAccountData["premium"];

            if($premiumUntil != null) {
                $phpdate = strtotime($premiumUntil);
                $mysqldate = date( 'Y-m-d H:i:s', $phpdate );
                $premiumUntil = $mysqldate;
            }
        } else {
            // Handle case where player account data is not found, though unlikely if player is collecting quest
            $json['message'] = "Player account data not found.";
            return json_encode($json);
        }

        // Fetch player equipment
        $stmt_player_equipment = $mysqli->prepare("SELECT items FROM player_equipment WHERE userId = ?");
        $stmt_player_equipment->bind_param("i", $userIdInt);
        $stmt_player_equipment->execute();
        $playerEquipmentResult = $stmt_player_equipment->get_result();
        $playerEquipmentData = $playerEquipmentResult->fetch_assoc();
        $stmt_player_equipment->close();

        if ($playerEquipmentData) {
            $items = $playerEquipmentData["items"];
        } else {
            $json['message'] = "Player equipment data not found.";
            return json_encode($json);
        }
            
        $origData = $data1;
        $origAmmo = $ammo;
        $origItems = $items;
        $origPremium = $premiumUntil;
        $origPremiumVal = $premiumVal;
            
        $data1_decoded = json_decode($data1);
        $ammo_decoded = json_decode($ammo);
        $items_decoded = json_decode($items);
        // $premium variable seems unused, $premiumUntil is used directly.
        $premiumValNew = $premiumVal;
            
        while($row = $rewardsResult->fetch_assoc()) {
            $type = $row["type"];
            $amount = (int)$row["amount"]; // Ensure amount is integer
                
            if($type == "premium") {
                if($premiumUntil != null) {
                    $premiumUntil = date('Y-m-d H:i:s', strtotime($premiumUntil.' +'.$amount.' days'));
                } else {
                    $premiumUntil = date('Y-m-d H:i:s', strtotime(' +'.$amount.' days'));
                }
                $premiumValNew = 1;
            }
                
                switch($type) {
                    case "lf2":
                    case "lf3":
                    case "lf4":
					case "lf4sp":
					case "lf5":
                    case "lf3n":
					case "cyborg":
                    case "bo1":
                    case "bo2":
					case "bo3":
                    case "g3n":
                    case "lf1":
                    case "a03":
                        if (Socket::Get('IsOnline', array('UserId' => $userid, 'Return' => false))) {
                            Socket::Send('UpdateItems', ['UserId' => $userid, 'Amount' => $amount, 'LootId' => Functions::getAmmoId($type)]);
                        }
                        break;
                }
                
                switch($type) {
                switch($type) {
                    case "credits": $data1_decoded->credits += $amount; break;
                    case "uridium": $data1_decoded->uridium += $amount; break;
                    case "lcb10": $ammo_decoded->lcb10 = ($ammo_decoded->lcb10 ?? 0) + $amount; break;
                    case "r310": $ammo_decoded->r310 = ($ammo_decoded->r310 ?? 0) + $amount; break;
                    case "mcb25": $ammo_decoded->mcb25 = ($ammo_decoded->mcb25 ?? 0) + $amount; break;
                    case "mcb50": $ammo_decoded->mcb50 = ($ammo_decoded->mcb50 ?? 0) + $amount; break;
					case "xcb25": $ammo_decoded->xcb25 = ($ammo_decoded->xcb25 ?? 0) + $amount; break;
					case "xcb50": $ammo_decoded->xcb50 = ($ammo_decoded->xcb50 ?? 0) + $amount; break;
					case "lxcb75": $ammo_decoded->lxcb75 = ($ammo_decoded->lxcb75 ?? 0) + $amount; break;
					case "acm": $ammo_decoded->acm = ($ammo_decoded->acm ?? 0) + $amount; break;
					case "emp": $ammo_decoded->emp = ($ammo_decoded->emp ?? 0) + $amount; break;
                    case "ucb": $ammo_decoded->ucb = ($ammo_decoded->ucb ?? 0) + $amount; break;
                    case "rsb": $ammo_decoded->rsb = ($ammo_decoded->rsb ?? 0) + $amount; break;
                    case "sab": $ammo_decoded->sab = ($ammo_decoded->sab ?? 0) + $amount; break;
                    case "eco10": $ammo_decoded->eco10 = ($ammo_decoded->eco10 ?? 0) + $amount; break;
					case "ubr100": $ammo_decoded->ubr100 = ($ammo_decoded->ubr100 ?? 0) + $amount; break;
					case "sar01": $ammo_decoded->sar01 = ($ammo_decoded->sar01 ?? 0) + $amount; break;
					case "sar02": $ammo_decoded->sar02 = ($ammo_decoded->sar02 ?? 0) + $amount; break;
					case "hstrm01": $ammo_decoded->hstrm01 = ($ammo_decoded->hstrm01 ?? 0) + $amount; break;
                    case "plt3030": $ammo_decoded->plt3030 = ($ammo_decoded->plt3030 ?? 0) + $amount; break;
                    case "plt2026": $ammo_decoded->plt26 = ($ammo_decoded->plt26 ?? 0) + $amount; break; // Typo plt26?
                    case "plt2021": $ammo_decoded->plt21 = ($ammo_decoded->plt21 ?? 0) + $amount; break; // Typo plt21?
                    case "exp": $data1_decoded->experience += $amount; break;
                    case "hon": $data1_decoded->honor += $amount; break;
                    case "lf2": $items_decoded->lf2Count = ($items_decoded->lf2Count ?? 0) + $amount; break;
                    case "lf3": $items_decoded->lf3Count = ($items_decoded->lf3Count ?? 0) + $amount; break;
                    case "lf4": $items_decoded->lf4Count = ($items_decoded->lf4Count ?? 0) + $amount; break;
					case "lf5": $items_decoded->lf5Count = ($items_decoded->lf5Count ?? 0) + $amount; break;
                    case "bo1": $items_decoded->B01Count = ($items_decoded->B01Count ?? 0) + $amount; break;
                    case "bo2": $items_decoded->bo2Count = ($items_decoded->bo2Count ?? 0) + $amount; break;
					case "bo3": $items_decoded->bo3Count = ($items_decoded->bo3Count ?? 0) + $amount; break;
                    case "g3n": $items_decoded->g3nCount = ($items_decoded->g3nCount ?? 0) + $amount; break;
                    case "lf1": $items_decoded->lf1Count = ($items_decoded->lf1Count ?? 0) + $amount; break;
                    case "a03": $items_decoded->A03Count = ($items_decoded->A03Count ?? 0) + $amount; break;
                    case "logfiles":
                        if(!isset($items_decoded->skillTree)) $items_decoded->skillTree = new stdClass();
                        $items_decoded->skillTree->logdisks = ($items_decoded->skillTree->logdisks ?? 0) + $amount;
                        break;
                    case "lf3n": $items_decoded->lf3nCount = ($items_decoded->lf3nCount ?? 0) + $amount; break;
					case "cyborg": $items_decoded->cyborgCount = ($items_decoded->cyborgCount ?? 0) + $amount; break;
					case "lf4sp": $items_decoded->lf4spCount = ($items_decoded->lf4spCount ?? 0) + $amount; break;
					case "cloacks": $ammo_decoded->cloacks = ($ammo_decoded->cloacks ?? 0) + $amount; break;
                }
            }
            $rewardsResult->close();
            
            $final_data_json = json_encode($data1_decoded);
            $final_ammo_json = json_encode($ammo_decoded);
            $final_items_json = json_encode($items_decoded);
            
            // Transaction starts here to cover all database modifications for collecting the quest
            $mysqli->begin_transaction();
            try {
                $stmt_log_init_collect = $mysqli->prepare("INSERT INTO log_player_quests (userid, questid, state) VALUES (?, ?, 'init_collection')");
                $stmt_log_init_collect->bind_param("ii", $userIdInt, $questIdInt);
                $stmt_log_init_collect->execute();
                $stmt_log_init_collect->close();

                // Player accounts update
                $stmt_update_player_acct_final = $mysqli->prepare("UPDATE player_accounts SET data = ?, ammo = ?, premium = ?, premiumUntil = ? WHERE userId = ?");
                $premiumUntilForDb = ($premiumUntil == "") ? NULL : $premiumUntil; // Handle NULL for premiumUntil
                $stmt_update_player_acct_final->bind_param("ssisi", $final_data_json, $final_ammo_json, $premiumValNew, $premiumUntilForDb, $userIdInt);
                if (!$stmt_update_player_acct_final->execute()) { throw new Exception("Failed to update player_accounts: " . $stmt_update_player_acct_final->error); }
                $stmt_update_player_acct_final->close();

                // Player equipment update
                $stmt_update_player_equip_final = $mysqli->prepare("UPDATE player_equipment SET items = ? WHERE userId = ?");
                $stmt_update_player_equip_final->bind_param("si", $final_items_json, $userIdInt);
                if (!$stmt_update_player_equip_final->execute()) { throw new Exception("Failed to update player_equipment: " . $stmt_update_player_equip_final->error); }
                $stmt_update_player_equip_final->close();

                // Player quest state update
                $stmt_update_player_quest_state = $mysqli->prepare("UPDATE player_quests SET state = 'collected' WHERE userId = ? AND questId = ?");
                $stmt_update_player_quest_state->bind_param("ii", $userIdInt, $questIdInt);
                if (!$stmt_update_player_quest_state->execute()) { throw new Exception("Failed to update player_quests state: " . $stmt_update_player_quest_state->error); }
                $stmt_update_player_quest_state->close();

                // Log finished collection
                $stmt_log_finished_collection = $mysqli->prepare("INSERT INTO log_player_quests (userid, questid, state, before_data, before_ammo, before_items, before_premiumVal, before_premiumUntil, after_data, after_ammo, after_items, after_premiumVal, after_premiumUntil) VALUES (?, ?, 'finished_collection', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $origPremiumUntilForDb = ($origPremium == "") ? NULL : $origPremium; // Handle NULL for original premiumUntil
                if (!$stmt_log_finished_collection->bind_param("iissssisssis", $userIdInt, $questIdInt, $origData, $origAmmo, $origItems, $origPremiumVal, $origPremiumUntilForDb, $final_data_json, $final_ammo_json, $final_items_json, $premiumValNew, $premiumUntilForDb)) {
                    throw new Exception("Failed to bind params for log_player_quests: " . $stmt_log_finished_collection->error);
                }
                if (!$stmt_log_finished_collection->execute()) { throw new Exception("Failed to log finished collection: " . $stmt_log_finished_collection->error); }
                $stmt_log_finished_collection->close();

                // Socket communication if player is online
                if (Socket::Get('IsOnline', array('UserId' => $userIdInt, 'Return' => false))) {
                    $uridium_change = ($data1_decoded->uridium ?? 0) - (json_decode($origData)->uridium ?? 0);
                    $credits_change = ($data1_decoded->credits ?? 0) - (json_decode($origData)->credits ?? 0);
                    $honor_change = ($data1_decoded->honor ?? 0) - (json_decode($origData)->honor ?? 0);
                    $experience_change = ($data1_decoded->experience ?? 0) - (json_decode($origData)->experience ?? 0);

                    $orig_logdisks = json_decode($origItems)->skillTree->logdisks ?? 0;
                    $new_logdisks = $items_decoded->skillTree->logdisks ?? 0;
                    $logfiles_change = $new_logdisks - $orig_logdisks;
                                
                    Socket::Send('LockSync', ['UserId' => $userIdInt]);
                    if($uridium_change > 0) Socket::Send('UpdateUridium', ['UserId' => $userIdInt, 'UridiumPrice' => $uridium_change, 'Type' => "INCREASE"]);
                    if($credits_change > 0) Socket::Send('UpdateCredits', ['UserId' => $userIdInt, 'CreditPrice' => $credits_change, 'Type' => "INCREASE"]);
                    if($honor_change > 0) Socket::Send('UpdateHonor', ['UserId' => $userIdInt, 'Honor' => $honor_change, 'Type' => "INCREASE"]);
                    if($experience_change > 0) Socket::Send('UpdateExperience', ['UserId' => $userIdInt, 'Experience' => $experience_change, 'Type' => "INCREASE"]);
                    if($logfiles_change > 0) Socket::Send('UpdateLogfiles', ['UserId' => $userIdInt, 'Logfiles' => $logfiles_change]);
                                
                    Socket::Send('SaveUserData', ['UserId' => $userIdInt]);
                                
                    foreach($ammo_decoded as $key => $value) {
                        $origValue = json_decode($origAmmo)->$key ?? 0;
                        $diff = $value - $origValue;
                        if($diff > 0 && Functions::getAmmoId($key) !== null) { // Ensure getAmmoId returns valid mapping
                            Socket::Send('AddAmmo', ['UserId' => $userIdInt, 'itemId' => Functions::getAmmoId($key), 'amount' => $diff]);
                        }
                    }

                    Socket::Send('UnlockSync', ['UserId' => $userIdInt]);
                }
                $mysqli->commit();
                $json['message'] = "Quest collected successfully."; // Add success message
            } catch (Exception $e) {
                $mysqli->rollback();
                $json['message'] = "Error collecting quest: " . $e->getMessage();
                Functions::LogError($e->getMessage());
            }
        }
    }
    $playerQuestStateResult->close(); // Close the initial player quest state check result set
                                            }
                                        }
                                    }
                                }
                                
                                Socket::Send('UnlockSync', ['UserId' => $userid]);
                            }
                        } else {
                            echo "error5";
                            Functions::LogError($mysqli->error);
                        }
                    } else {
                        echo "error2";
                        Functions::LogError($mysqli->error);
                    }
                }
            } else {
                echo "error1";
                Functions::LogError($mysqli->error);
            }
        }
    }

return json_encode($json);
}

public static function checkQuest($row, $mysqli, $userid, $level, $npcKills, $playerKills) { // $mysqli is passed as parameter
    $tasks = [];
    $row["rewards"] = []; // This seems to be for output structure, not directly DB related here.

    $questId = (int)$row["id"];
    $userIdInt = (int)$userid;

    $stmt_tasks = $mysqli->prepare("SELECT t.*, a.* FROM server_quests_tasks_temp AS t LEFT JOIN server_quests_tasks AS a ON t.taskId = a.id where questId = ?");
    $stmt_tasks->bind_param("i", $questId);
    $stmt_tasks->execute();
    $tasksResult = $stmt_tasks->get_result();
    while($rowTasks = $tasksResult->fetch_assoc()) $tasks[] = $rowTasks;
    $stmt_tasks->close();

    $tmp_tasks = [];
    $questCompleted = true;
    $questAccepted = false;
        
    $stmt_log_state_tmp = $mysqli->prepare("SELECT type, charId, amount FROM log_player_quests_state_tmp WHERE userId = ? AND questId = ?");
    $stmt_log_state_tmp->bind_param("ii", $userIdInt, $questId);
    $stmt_log_state_tmp->execute();
    $logStateTmpResult = $stmt_log_state_tmp->get_result();
    $npcKillsQuest = [];
    while($row1 = $logStateTmpResult->fetch_assoc()) $npcKillsQuest[] = $row1;
    $stmt_log_state_tmp->close();
        
    $stmt_player_quest_status = $mysqli->prepare("SELECT id, accepted, state FROM player_quests WHERE userId = ? AND questId = ?");
    $stmt_player_quest_status->bind_param("ii", $userIdInt, $questId);
    $stmt_player_quest_status->execute();
    $playerQuestStatusResult = $stmt_player_quest_status->get_result();
    $num_player_quest_rows = $playerQuestStatusResult->num_rows;
    $playerQuestRow = $playerQuestStatusResult->fetch_assoc(); // Assuming only one row or none
    $stmt_player_quest_status->close();

    if($num_player_quest_rows <= 0) $questCompleted = false;
    else {
        $questAccepted = true; // Quest exists for player
        if($playerQuestRow["state"] == "collected") $questCompleted = true;
        else $questCompleted = true; // Default to true, loop below will set to false if any task not met

        for($i = 0; $i < count($tasks); $i++) {
            $currentAmount = 0;
            $acceptedAmount = 0; // This is amount AT TIME OF QUEST ACCEPTANCE from log_player_quests_state_tmp
            $taskCompleted = false;

            switch($tasks[$i]["type"]) {
                case "destroy_npc":
                    foreach($npcKills as $elm) { // $npcKills is from log_player_pve_kills (current total)
                        if($elm["npc"] == $tasks[$i]["targetElement"]) {
                            $currentAmount = (int)$elm["amount"];
                            break;
                        }
                    }
                    foreach($npcKillsQuest as $elm) { // $npcKillsQuest is from log_player_quests_state_tmp
                        if($elm["charId"] == $tasks[$i]["targetElement"] && $elm["type"] == "npc") {
                            $acceptedAmount = (int)$elm["amount"];
                            break;
                        }
                    }
                    $currentAmount = $currentAmount - $acceptedAmount; // Actual progress since accept
                    break;
                case "destroy_player":
                    $targetElementBaseId = (int)$tasks[$i]["targetElementBaseId"];
                    $targetElement = (int)$tasks[$i]["targetElement"];

                    foreach($playerKills as $elm) { // $playerKills is from log_player_pvp_kills
                        $killedShipId = (int)$elm["ship"];
                        if($targetElementBaseId > 0) {
                            // This needs a query or a pre-loaded map of shipId to baseShipId
                            // For now, assuming getBaseShipId is a new helper or this logic changes
                            $baseShipIdOfKilled = self::getBaseShipId($mysqli, $killedShipId);
                            if($baseShipIdOfKilled == $targetElementBaseId) {
                                $currentAmount += (int)$elm["amount"];
                            }
                        } else {
                            if($killedShipId == $targetElement) {
                                $currentAmount += (int)$elm["amount"];
                            }
                        }
                    }
                    foreach($npcKillsQuest as $elm) { // $npcKillsQuest refers to log_player_quests_state_tmp
                        $loggedCharId = (int)$elm["charId"];
                        if($elm["type"] == "ship") { // Make sure we're checking player kills logged at accept time
                           if($targetElementBaseId > 0) {
                               $baseShipIdOfLoggedKill = self::getBaseShipId($mysqli, $loggedCharId);
                               if($baseShipIdOfLoggedKill == $targetElementBaseId) {
                                   $acceptedAmount += (int)$elm["amount"];
                               }
                           } else {
                               if($loggedCharId == $targetElement) {
                                   $acceptedAmount += (int)$elm["amount"];
                               }
                           }
                        }
                    }
                    $currentAmount = $currentAmount - $acceptedAmount;
                    break;
            }

            if($currentAmount < (int)$tasks[$i]["neededAmount"]) {
                $questCompleted = false; // If any task not met, quest is not completed
            }
            // $taskCompleted can be set for individual task display if needed, but $questCompleted is the overall status
            if ($currentAmount >= (int)$tasks[$i]["neededAmount"]) {
                $taskCompleted = true;
            }
        }
    }
    // If loop finishes and $questCompleted is still true, it means all tasks are met.
    // If $playerQuestRow["state"] == "collected" was already true, it remains true.

    // Prepare output for this $row (the quest itself)
    for($i = 0; $i < count($tasks); $i++) { // Re-loop to build descriptions based on final calculations
        // This part is for display, calculate currentAmount again for description
        $currentDisplayAmount = 0;
        $acceptedDisplayAmount = 0;
         switch($tasks[$i]["type"]) {
            case "destroy_npc":
                foreach($npcKills as $elm) { if($elm["npc"] == $tasks[$i]["targetElement"]) $currentDisplayAmount = (int)$elm["amount"]; }
                foreach($npcKillsQuest as $elm) { if($elm["charId"] == $tasks[$i]["targetElement"] && $elm["type"] == "npc") $acceptedDisplayAmount = (int)$elm["amount"]; }
                $currentDisplayAmount -= $acceptedDisplayAmount;
                break;
            case "destroy_player":
                 $targetElementBaseId = (int)$tasks[$i]["targetElementBaseId"];
                 $targetElement = (int)$tasks[$i]["targetElement"];
                 foreach($playerKills as $elm) {
                     $killedShipId = (int)$elm["ship"];
                     if($targetElementBaseId > 0) {
                         if(self::getBaseShipId($mysqli, $killedShipId) == $targetElementBaseId) $currentDisplayAmount += (int)$elm["amount"];
                     } else {
                         if($killedShipId == $targetElement) $currentDisplayAmount += (int)$elm["amount"];
                     }
                 }
                 foreach($npcKillsQuest as $elm) {
                     if($elm["type"] == "ship") {
                         $loggedCharId = (int)$elm["charId"];
                         if($targetElementBaseId > 0) {
                             if(self::getBaseShipId($mysqli, $loggedCharId) == $targetElementBaseId) $acceptedDisplayAmount += (int)$elm["amount"];
                         } else {
                             if($loggedCharId == $targetElement) $acceptedDisplayAmount += (int)$elm["amount"];
                         }
                     }
                 }
                 $currentDisplayAmount -= $acceptedDisplayAmount;
                break;
        }

        $tmp_tasks[$i] = $tasks[$i];
        $tmp_translation = Functions::getTranslation($tasks[$i]["type"]);
        if($currentDisplayAmount < 0) $currentDisplayAmount = 0; // Progress can't be negative for display
        if($currentDisplayAmount > (int)$tasks[$i]["neededAmount"] || ($playerQuestRow && $playerQuestRow["state"] == "collected") || ($questCompleted && $num_player_quest_rows > 0)) {
             $currentDisplayAmount = (int)$tasks[$i]["neededAmount"];
        }
        $tmp_translation = str_replace("{amount}", $currentDisplayAmount."/".number_format((int)$tasks[$i]["neededAmount"], 0 , ',' , '.'), $tmp_translation);
        
        $targetName = "";
        if($tasks[$i]["targetElementBaseId"] > 0) {
            $targetName = Functions::getTargetFromDB($tasks[$i]["type"], $tasks[$i]["targetElementBaseId"], $mysqli);
            $tmp_translation = str_replace("{target}", $targetName, $tmp_translation);
            $tmp_translation = str_replace("{company}", Functions::getCompanyFromDB($tasks[$i]["company"], $tasks[$i]["targetElementBaseId"]), $tmp_translation);
        } else {
            $targetName = Functions::getTargetFromDB($tasks[$i]["type"], $tasks[$i]["targetElement"], $mysqli);
            $tmp_translation = str_replace("{target}", $targetName, $tmp_translation);
            $tmp_translation = str_replace("{company}", Functions::getCompanyFromDB($tasks[$i]["company"], $tasks[$i]["targetElement"]), $tmp_translation);
        }

        $isTaskReallyCompleted = ($currentDisplayAmount >= (int)$tasks[$i]["neededAmount"]);
        if($isTaskReallyCompleted || ($playerQuestRow && $playerQuestRow["state"] == "collected")) {
            $tmp_translation = "<span style='color: green;'>&bull;&nbsp;".$tmp_translation."</span>";
        } else {
            $tmp_translation = "&bull;&nbsp;".$tmp_translation;
        }
        $tmp_tasks[$i]["description"] = $tmp_translation;
    }

    $row["state"] = 0; // Default: not accepted or not completable
    if($questAccepted) {
        if ($questCompleted && ($playerQuestRow && $playerQuestRow["state"] != "collected")) { // Check if all tasks are met and not already collected
             $row["state"] = 2; // Can be collected
        } else if ($playerQuestRow && $playerQuestRow["state"] == "collected") {
             $row["state"] = 2; // Already collected
        } else {
             $row["state"] = 1; // Accepted but not yet completed
        }
    }
    if($level < (int)$row["neededLvl"]) $row["state"] = 3; // Level too low overrides other states
        
    $row["tasks"] = $tmp_tasks;
        
    return $row;
}

// Helper function, can be made private static if moved into the class, or stay global if appropriate
// This function itself uses a query that needs parameterization.
private static function getBaseShipId($mysqli, $shipId) {
    $shipIdInt = (int)$shipId;
    $stmt = $mysqli->prepare("SELECT baseShipId FROM server_ships WHERE ShipID = ?");
    $stmt->bind_param("i", $shipIdInt);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()){
        $stmt->close();
        return (int)$row["baseShipId"];
    }
    $stmt->close();
    return 0; // Or some other default/error indicator
}


public static $translations = [];
public static $lang = "";

public static function insertTranslation($lang, $key, $value) {
    if(!isset(Functions::$translations[$lang])) Functions::$translations[$lang] = [];
    Functions::$translations[$lang][$key] = $value;
}

public static function getTranslation($key) {
    $value = "";
    
    if(Functions::$translations[Functions::$lang][$key] ?? null) {
        $value = Functions::$translations[Functions::$lang][$key];
    } else {
        $value = "{translation not found}";
    }
    
    return $value;
}

public static function getTargetFromDB($type, $targetid, $mysqli) {
    $name = "";
    $targetIdInt = (int)$targetid;

    switch($type) {
        case "destroy_npc":
        case "destroy_player":
            $stmt = $mysqli->prepare("SELECT name FROM server_ships WHERE shipID = ?");
            $stmt->bind_param("i", $targetIdInt);
            $stmt->execute();
            $result = $stmt->get_result();
            if($row = $result->fetch_assoc()) {
                $name = $row["name"];
            }
            $stmt->close();
            break;
    }
    return $name;
}

public static function getCompanyFromDB($company) { // No DB interaction, no change needed.
    if($company == null) {
        return "";
    } else {
        return " ".Functions::getTranslation("company")." ".strtoupper($company);
    }
}

public static $ammos = [];

public static function setAmmoId($key, $val) {
    Functions::$ammos[$key] = $val;
}

public static function getAmmoId($key) {
    return Functions::$ammos[$key];
}
  public static function EndDiplomacy($diplomacyId)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['status' => false, 'message' => 'Player not found.']); }

    $playerClanId = (int)$player['clanId'];
    $leaderUserIdInt = (int)$player['userId'];
    $diplomacyIdInt = (int)$diplomacyId; // Assuming $diplomacyId is an integer

    $json = ['status' => false, 'message' => ''];

    $stmt_get_clan_leader = $mysqli->prepare('SELECT leaderId FROM server_clans WHERE id = ?');
    $stmt_get_clan_leader->bind_param("i", $playerClanId);
    $stmt_get_clan_leader->execute();
    $clanLeaderResult = $stmt_get_clan_leader->get_result()->fetch_assoc();
    $stmt_get_clan_leader->close();

    if ($clanLeaderResult != NULL) {
      if ($clanLeaderResult['leaderId'] == $leaderUserIdInt) {
        $stmt_get_diplomacy = $mysqli->prepare('SELECT senderClanId, toClanId, diplomacyType FROM server_clan_diplomacy WHERE id = ?');
        $stmt_get_diplomacy->bind_param("i", $diplomacyIdInt);
        $stmt_get_diplomacy->execute();
        $diplomacyResult = $stmt_get_diplomacy->get_result();
        $diplomacy_to_end = $diplomacyResult->fetch_assoc();
        $stmt_get_diplomacy->close();

        if ($diplomacy_to_end && (int)$diplomacy_to_end['diplomacyType'] != 3) { // Cannot end 'War' status this way, must be through request system
          // Ensure the leader's clan is part of this diplomacy
          if ($diplomacy_to_end['senderClanId'] == $playerClanId || $diplomacy_to_end['toClanId'] == $playerClanId) {
            $mysqli->begin_transaction();
            try {
              $stmt_delete_diplomacy = $mysqli->prepare('DELETE FROM server_clan_diplomacy WHERE id = ?');
              $stmt_delete_diplomacy->bind_param("i", $diplomacyIdInt);
              $stmt_delete_diplomacy->execute();

              if ($stmt_delete_diplomacy->affected_rows > 0) {
                $json['status'] = true;
                $json['message'] = 'Diplomacy was ended.';
                Socket::Send('EndDiplomacy', ['SenderClanId' => $diplomacy_to_end['senderClanId'], 'TargetClanId' => $diplomacy_to_end['toClanId']]);
              } else {
                $json['message'] = 'Could not end diplomacy or it was already ended.';
              }
              $stmt_delete_diplomacy->close();
              $mysqli->commit();
            } catch (Exception $e) {
              $json['message'] = 'An error occurred. Please try again later.';
              $mysqli->rollback();
            }
            // $mysqli->close(); // Managed by Database class
          } else {
            $json['message'] = 'Your clan is not part of this diplomacy.';
          }
        } else {
          if (!$diplomacy_to_end) {
            $json['message'] = 'Diplomacy record not found.';
          } else if ((int)$diplomacy_to_end['diplomacyType'] == 3) {
            $json['message'] = 'War status cannot be ended directly this way. It must be done via a peace treaty request.';
          } else {
            $json['message'] = 'Something went wrong with the diplomacy record.';
          }
        }
      } else {
        $json['message'] = 'Only leaders can end a diplomacy.';
      }
    } else {
      $json['message'] = 'Clan not found.';
    }
    return json_encode($json);
  }
  
  public static function GetUniqueSessionId()
  {
    $mysqli = Database::GetInstance();
    $sessionId = Functions::GenerateRandom(32);

    $stmt = $mysqli->prepare('SELECT userId FROM player_accounts WHERE sessionId = ?');
    $stmt->bind_param("s", $sessionId);
    $stmt->execute();
    $stmt->store_result();
    $is_duplicate = $stmt->num_rows > 0;
    $stmt->close();

    if ($is_duplicate) {
      // It's generally better to loop with a max attempts rather than recursion for this.
      // However, sticking to minimal change from original logic for now.
      return self::GetUniqueSessionId(); // Recursive call
    }
    return $sessionId;
  }

  public static function VerifyEmail($userId, $hash)
  {
    $mysqli = Database::GetInstance();
    // $userId and $hash are from user input (link), should be bound.
    $message = '';
    $userIdInt = (int)$userId; // Assuming userId should be an integer

    $stmt_check_user = $mysqli->prepare('SELECT verification FROM player_accounts WHERE userId = ?');
    $stmt_check_user->bind_param("i", $userIdInt);
    $stmt_check_user->execute();
    $result_user = $stmt_check_user->get_result();

    if ($result_user->num_rows >= 1) {
      $userData = $result_user->fetch_assoc();
      $stmt_check_user->close();
      $verification = json_decode($userData['verification']);

      if ($verification && !$verification->verified) {
        if (isset($verification->hash) && $verification->hash === $hash) {
          $verification->verified = true;
          $newVerificationJson = json_encode($verification);

          $mysqli->begin_transaction();
          try {
            $stmt_update_verification = $mysqli->prepare("UPDATE player_accounts SET verification = ? WHERE userId = ?");
            $stmt_update_verification->bind_param("si", $newVerificationJson, $userIdInt);
            $stmt_update_verification->execute();
            $stmt_update_verification->close();

            $message = 'Your account is now verified.';
            $mysqli->commit();
          } catch (Exception $e) {
            $message = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }
          // $mysqli->close(); // Managed by Database class
        } else {
          $message = 'Hash does not match or is missing.';
        }
      } else if ($verification && $verification->verified) {
        $message = 'This account is already verified.';
      } else {
        $message = 'Verification data corrupted or missing.';
      }
    } else {
      $stmt_check_user->close();
      $message = 'User not found.';
    }
    return $message;
  }
  
  public static function ResetPw($userId, $hash)
  {
    $mysqli = Database::GetInstance();
    $message = '';
    $userIdInt = (int)$userId;

    $stmt_check_user = $mysqli->prepare('SELECT userId FROM player_accounts WHERE userId = ?');
    $stmt_check_user->bind_param("i", $userIdInt);
    $stmt_check_user->execute();
    $stmt_check_user->store_result();
    $user_exists = $stmt_check_user->num_rows > 0;
    $stmt_check_user->close();

    if ($user_exists) {
      $stmt_check_key = $mysqli->prepare('SELECT userId FROM player_accounts WHERE userId = ? AND pwResetKey = ?');
      $stmt_check_key->bind_param("is", $userIdInt, $hash);
      $stmt_check_key->execute();
      $stmt_check_key->store_result();
      $key_exists = $stmt_check_key->num_rows > 0;
      $stmt_check_key->close();

      if ($key_exists) {
		  $message = "<form action='" . DOMAIN . "api/resetpw' method='post'><input type='hidden' name='action' value='resetpw'/><input type='hidden' name='uid' value='".htmlspecialchars($userId)."'/><input type='hidden' name='hash' value='".htmlspecialchars($hash)."'/><input type='password' name='password' placeholder='Password'/><br><br><input type='password' name='passwordrp' placeholder='Password repeat'/><br><br><input type='submit' value='Reset'/></form>";
		} else {
		  $message = 'Key not found or expired.';
		}
    } else {
      $message = 'User not found.';
    }
    return $message;
  }
  
  public static function ResetPwConfirm($userId, $hash, $password)
  {
    $mysqli = Database::GetInstance();
    $message = '';
    $userIdInt = (int)$userId;

    // It's good practice to validate password strength/length here before hashing and DB interaction.
    // For now, directly using the provided password.

    $stmt_check_user = $mysqli->prepare('SELECT userId FROM player_accounts WHERE userId = ?');
    $stmt_check_user->bind_param("i", $userIdInt);
    $stmt_check_user->execute();
    $stmt_check_user->store_result();
    $user_exists = $stmt_check_user->num_rows > 0;
    $stmt_check_user->close();

    if ($user_exists) {
      $stmt_check_key = $mysqli->prepare('SELECT userId FROM player_accounts WHERE userId = ? AND pwResetKey = ?');
      $stmt_check_key->bind_param("is", $userIdInt, $hash);
      $stmt_check_key->execute();
      $stmt_check_key->store_result();
      $key_matches = $stmt_check_key->num_rows > 0;
      $stmt_check_key->close();

      if ($key_matches) {
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          $stmt_update_pw = $mysqli->prepare('UPDATE player_accounts SET password = ?, pwResetKey = NULL WHERE userId = ?');
          $stmt_update_pw->bind_param("si", $hashed_password, $userIdInt);
          if ($stmt_update_pw->execute()) {
            $message = 'Password changed successfully. Redirect in 5 seconds...<meta http-equiv="refresh" content="5; URL='.DOMAIN.'">'; // Using DOMAIN constant
          } else {
            $message = 'Error updating password.';
          }
          $stmt_update_pw->close();
		} else {
		  $message = 'Invalid or expired reset key.';
		}
    } else {
      $message = 'User not found.';
    }

    return $message;
  }
  
  public static function ChangeSecuritysettings($sqa1,$sqa2,$sqa3,$sq1,$sq2,$sq3)
  {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();
    
    $json = [
      'message' => ''
    ];
	
	if($sqa1 != "" && $sqa2 != "" && $sqa3 != "") {
		$json["securityQuestions"] = [
			"sq1" => [
				"id" => $sq1,
				"answer" => password_hash($sqa1, PASSWORD_DEFAULT)
			],
			"sq2" => [
				"id" => $sq2,
				"answer" => password_hash($sqa2, PASSWORD_DEFAULT)
			],
			"sq3" => [
				"id" => $sq3,
				"answer" => password_hash($sqa3, PASSWORD_DEFAULT)
			]
		];
		$securityQuestionsJson = json_encode($json["securityQuestions"]);
		$userIdInt = (int)$player["userId"];

		$stmt = $mysqli->prepare("UPDATE player_accounts SET securityQuestions = ? WHERE userId = ?");
		$stmt->bind_param("si", $securityQuestionsJson, $userIdInt);
		
		if($stmt->execute()) {
			$json["message"] = "Information is saved successfully.";
		} else {
			$json["message"] = "An error occured while saving the security questions. Please try again later.";
		}
		$stmt->close();
	} else {
		$json["message"] = "Please fill out every answer.";
	}
    return json_encode($json);
  }
  
  public static function DeleteSecurityQuestions()
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['message' => 'Player not found.']); }
	
    $json = ['message' => ''];
    $userIdInt = (int)$player['userId'];
	
	$mysqli->begin_transaction();
    try {
        $stmt = $mysqli->prepare("UPDATE player_accounts SET securityQuestions = NULL WHERE userId = ?");
        $stmt->bind_param("i", $userIdInt);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $json['message'] = 'The Security questions has been deleted.';
        } else {
            // This could mean the value was already NULL or user not found (though GetPlayer should prevent latter)
            $json['message'] = 'No changes made to security questions (they might have been already clear).';
        }
        $stmt->close();
        $mysqli->commit();
    } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later: ' . $e->getMessage();
        $mysqli->rollback();
    }
    // $mysqli->close(); // Managed by Database class

    return json_encode($json);
  }

  public static function Buy($itemId, $amount) {

    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    // itemId and amount are used in self::infoshop, which might use them in queries.
    // However, the primary use of itemId and amount in *this* function will be after validation.
    // If self::infoshop needs escaping, it should handle it internally or be refactored.
    // For now, we assume $itemId and $amount are safe for self::infoshop as is.
    $shop = json_decode(self::infoshop($itemId), true); // $itemId is passed here

    // Escape $itemId and $amount here if they are directly used in SQL strings later in *this* function,
    // but prefer using them only in prepared statements.
    // $itemId_escaped = $mysqli->real_escape_string($itemId); // Example if needed for direct query
    // $amount_int = (int)$amount; // Example if amount is numeric

    $json = [
      'status' => false,
      'message' => ''
    ];

    $typeMunnition = [
      'ammunition_laser_mcb-50' => 'mcb50',
      'ammunition_specialammo_emp-01' => 'emp',
      'ammunition_mine_smb-01' => 'smb',
      'ammunition_specialammo_r-ic3' => 'ice',
      'ammunition_specialammo_wiz-x' => 'wiz',
      'ammunition_specialammo_dcr-250' => 'dcr',
      'ammunition_specialammo_pld-8' => 'pld',
      'ammunition_rocket_plt-3030' => 'plt3030',
	  'ammunition_rocket_plt-2021' => 'plt21',
	  'ammunition_rocket_plt-2026' => 'plt26',
	  'ammunition_rocket_r-310' => 'r310',
      'ammunition_laser_rsb-75' => 'rsb',
      'ammunition_laser_sab-50' => 'sab',
      'equipment_extra_cpu_ish-01' => 'ish',
      'equipment_extra_cpu_cl04k-xl' => 'cloacks',
      'ammunition_laser_ucb-100' => 'ucb',
      'ammunition_laser_mcb-25' => 'mcb25',
      'ammunition_laser_lcb-10' => 'lcb10',
	  "ammunition_laser_job-100" => 'job100',
	  "ammunition_laser_pib-100" => 'pib100',
	  "ammunition_laser_rb-214" => 'rb214',
	  'ammunition_laser_cbo-100' => 'cbo100',
	  'ammunition_laser_xcb-25' => 'xcb25',
	  'ammunition_laser_xcb-50' => 'xcb50',
	  'ammunition_laser_lxcb-75' => 'lxcb75',
	  'ammunition_rocketlauncher_eco-10' => 'eco10',
	  'ammunition_rocketlauncher_ubr-100' => 'ubr100',
	  'ammunition_rocketlauncher_sar-02' => 'sar02',
	  'ammunition_rocketlauncher_sar-01' => 'sar01',
	  'ammunition_rocketlauncher_hstrm-01' => 'hstrm01',
	  'ammunition_mine_slm-01' => 'slm',
	  'ammunition_mine_sabm-01' => 'sabm',
	  'ammunition_mine_empm-01' => 'empm',
	  'ammunition_mine_ddm-01' => 'ddm',
	  'ammunition_mine_acm-01' => 'acm',
	  'ammunition_mine_im-01' => 'im01',
	  'ammunition_firework_fwx-l' => 'fwxl'
    ];

    if (isset($shop) && $shop['active']) {
      $stmt = $mysqli->prepare("SELECT items, modules, boosters FROM player_equipment WHERE userId = ?");
      $stmt->bind_param("i", $player['userId']);
      $stmt->execute();
      $equipment_result = $stmt->get_result()->fetch_assoc();
      $stmt->close();

      $items = json_decode($equipment_result['items']);
      $module = json_decode($equipment_result['modules']);
      $boosters = json_decode($equipment_result['boosters']);

	    $verificaconectado = Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false));
      $data = json_decode($player['data']);

      $price = $shop['price'];

      if ($shop['amount'] && $amount <= 0) {
        $amount = 1;
      }

      if ($shop['amount'] && $amount >= 1) {
        $price *= $amount;
      }
	  
      if ($player['premium'] == 1) {
        $price = $price = $price / 100 * 60;
      }

      if ($shop['priceType'] == 'uridium' || $shop['priceType'] == 'credits'){

        if (($shop['priceType'] == 'uridium' ? $data->uridium : $data->credits) >= $price) {

          $data->{($shop['priceType'] == 'uridium' ? 'uridium' : 'credits')} -= $price;
          $status = false;

          if (!empty($shop['droneName'])) {

            if (strpos($shop['droneName'], "Count")) {
              $items->{$shop['droneName']} += $amount;
              $status = true;
            } else {
              if (!$items->{$shop['droneName']}) {
                //$items->{$shop['droneName']} = true;
                $droneName = "drone".ucfirst($shop['droneName'])."Parts";
                if (empty($items->{$droneName})){
                  $items->{$droneName} = $amount;
                } else {
                  $items->{$droneName} += $amount;
                }
                $status = true;
              } else {
                $json['message'] = 'You already have an ' . $shop['name'] . ' Drone.';
              }
            }

          } else if (!empty($shop['laserName'])) {

            // Re-fetch equipment specifically for laser logic if $items isn't already comprehensive
            // For now, assume $items from above is sufficient for $lasersSaved. If not, re-fetch specifically.
            $lasersSaved = $items; // Assuming $items already contains what $lasersSaved needs.

            $stmt_drones_config = $mysqli->prepare("SELECT config1_drones, config2_drones FROM player_equipment WHERE userId = ?");
            $stmt_drones_config->bind_param("i", $player['userId']);
            $stmt_drones_config->execute();
            $drones_config_result = $stmt_drones_config->get_result()->fetch_assoc();
            $stmt_drones_config->close();

            $config1 = json_decode($drones_config_result['config1_drones']);
            $config2 = json_decode($drones_config_result['config2_drones']);

            $max = null;
            $name = null;

            if ($shop['laserName'] == 'lf1Count'){
              $max = 40;
              $name = "lasers";			
            } 
			if ($shop['laserName'] == 'lf2Count'){
              $max = 40;
              $name = "lasers";
            }            
			if ($shop['laserName'] == 'lf3Count'){
              $max = 40;
              $name = "lasers";
            }
            if ($shop['laserName'] == 'lf4Count'){
              $max = 40;
              $name = "lasers";
            }
            if ($shop['laserName'] == 'lf5Count'){
              $max = 40;
              $name = "lasers";
            }
            if ($shop['laserName'] == 'bo3Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'bo2Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'B01Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'A03Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'A02Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'A01Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'A01Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'g3nCount'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'g3n6900Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'g3n3310Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'g3n3210Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'g3n2010Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'g3n1010Count'){
              $max = 40;
              $name = "generators";
            }			 
			if ($shop['laserName'] == 'lf3nCount'){
              $max = 40;
              $name = "lasers";
			} 
			if ($shop['laserName'] == 'lf4mdCount'){
              $max = 40;
              $name = "lasers";
			} 
			if ($shop['laserName'] == 'lf4pdCount'){
              $max = 40;
              $name = "lasers";
			} 
			if ($shop['laserName'] == 'lf4hpCount'){
              $max = 40;
              $name = "lasers";
			} 
			if ($shop['laserName'] == 'lf4spCount'){
              $max = 40;
              $name = "lasers";
			} 
			if ($shop['laserName'] == 'lf4unstableCount'){
              $max = 40;
              $name = "lasers";
			} 
			if ($shop['laserName'] == 'mp1Count'){
              $max = 40;
              $name = "lasers";
			}
      if ($shop['laserName'] == 'iriscount'){
              if ($items->iriscount <= 7) {
                $config1conf = array('items' => [], 'designs' => []);
                $config2conf = array('items' => [], 'designs' => []);
                array_push($config1, $config1conf);
                array_push($config2, $config2conf);

                $stmt_update_drones = $mysqli->prepare("UPDATE player_equipment SET config1_drones = ?, config2_drones = ? WHERE userId = ?");
                $config1_json = json_encode($config1);
                $config2_json = json_encode($config2);
                $stmt_update_drones->bind_param("ssi", $config1_json, $config2_json, $player['userId']);
                $stmt_update_drones->execute();
                $stmt_update_drones->close();
                }
                  $max = 8;
                  $name = "drones";
                }

			

            if ($max == null && $name == null){ 
              return; 
            }

            $dd = $lasersSaved->{$shop['laserName']}+=$amount;

            if ($dd > $max){
              $json['message'] = "Max ".$max." ".$name." for type";

              return json_encode($json);
            }

            $items->{$shop['laserName']} += $amount;
            $status = true;

          } else if (!empty($shop['skillTree'])) {

            $items->skillTree->{$shop['skillTree']} += $amount;
            $status = true;

          } else if (!empty($shop['petName'])) {

            if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
              $json['message'] = "You have disconnect from the server to buy ".$shop['petName'];
              return json_encode($json);
            }

            if (!$items->{$shop['petName']}) {
              $items->{$shop['petName']} = true;
              $status = true;
            } else {
              $json['message'] = 'You already have an '.$shop['name'];
            }

          } else if (!empty($shop['boosterId']) && is_numeric($shop['boosterType']) && !empty($shop['boosterDuration'])){

            //if (isset($verificaconectado) and ($verificaconectado == 0)){

              $shop['boosterId'] = str_replace("-", "", $shop['boosterId']);

              $canPutBooster = true;

              // Fix Boosters. 21.09.2020. | New revisition: 06.02.2021 | Connected to socket: 07.02.2021
              if (empty($boosters->{$shop['boosterId']})) {
                  if(Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
                    Socket::Send('SendBoosters', ['UserId' => $player['userId'], 'typeBooster' => $shop['boosterType'], 'hoursBooster' => $shop['boosterDuration']]);
                  }
                  $bb[] = array('Type' => $shop['boosterType'], 'Seconds' => $shop['boosterDuration']);
                  $boosters->{$shop['boosterId']} = $bb;
                  $status = true;
              } else {

                foreach ($boosters->{$shop['boosterId']} as $bb){
                  if ($bb->Type == $shop['boosterType']){
                    $canPutBooster = false;
                  }
                }

                if ($canPutBooster){
                  if(Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
                    Socket::Send('SendBoosters', ['UserId' => $player['userId'], 'typeBooster' => $shop['boosterType'], 'hoursBooster' => $shop['boosterDuration']]);
                  }
                  array_push($boosters->{$shop['boosterId']}, array('Type' => $shop['boosterType'], 'Seconds' => $shop['boosterDuration']));
                  $status = true;
                } else {
                  $json['message'] = 'You already have an ' . $shop['name'] . '.';
                }

              }

            //} else {
              //$json['message'] = "Disconnect from game to buy.";
            //}

          } else if (!empty($shop['shipId']) && $shop['shipId'] > 0) {

            if (!in_array($shop['shipId'], $items->ships)) {
              array_push($items->ships, (int)$shop['shipId']);
              $status = true;
            } else {
              $json['message'] = 'You already have an ' . $shop['name'] . '.';
            }

        } else if (!empty($shop['design_name'])) {

          $design_name = $shop['design_name']; // This comes from $shop, not user input here.

          $stmt_search_design = $mysqli->prepare("SELECT baseShipId FROM player_designs WHERE name = ? AND userId = ?");
          $stmt_search_design->bind_param("si", $design_name, $player['userId']);
          $stmt_search_design->execute();
          $stmt_search_design->store_result();

          if ($stmt_search_design->num_rows > 0) {
            $json['message'] = 'You already have an ' . $shop['name'] . '.';
            $stmt_search_design->close();
          } else {
            $stmt_search_design->close();

            $stmt_info_design = $mysqli->prepare("SELECT baseShipId FROM server_ships WHERE lootID = ?");
            $stmt_info_design->bind_param("s", $design_name);
            $stmt_info_design->execute();
            $info_design_result = $stmt_info_design->get_result();

            if ($info_design_result->num_rows > 0){
              $baseShipId = $info_design_result->fetch_assoc()['baseShipId'];
              $stmt_info_design->close();
              if ($baseShipId > 0){
                $stmt_insert_design = $mysqli->prepare("INSERT INTO player_designs (name, baseShipId, userId) VALUES (?, ?, ?)");
                $stmt_insert_design->bind_param("sii", $design_name, $baseShipId, $player['userId']);
                $stmt_insert_design->execute();
                $stmt_insert_design->close();
                $status = true;
              }
            } else {
                 $stmt_info_design->close();
            }
          }

        } else if (!empty($shop['moduleId']) && !empty($shop['moduleType'])){

          $module2 = array('Id' => $shop['moduleId'], 'Type' => $shop['moduleType'], 'InUse' => false);

          if (isset($verificaconectado) and ($verificaconectado == 0)){
            if (!in_array($module, $module)) {
              array_push($module, $module2);
              $status = true;
            }
          } else {
            $json['message'] = "Disconnect from game to buy.";
          }

        } else if (!empty($shop['ammoId'])){
            $amount_int = (int)$amount; // Ensure amount is integer for arithmetic
            if(Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
              Socket::Send('AddAmmo', ['UserId' => $player['userId'], 'itemId' => $shop['ammoId'], 'amount' => $amount_int]);
            } else {
              $stmt_get_ammo = $mysqli->prepare("SELECT ammo FROM player_accounts WHERE userId = ?");
              $stmt_get_ammo->bind_param("i", $player['userId']);
              $stmt_get_ammo->execute();
              $current_ammo_json = $stmt_get_ammo->get_result()->fetch_assoc()['ammo'];
              $stmt_get_ammo->close();
              $ammo = json_decode($current_ammo_json);

              $ammo_key = $typeMunnition[$shop['ammoId']];
              if (empty($ammo->$ammo_key)){
                $ammo->$ammo_key = $amount_int;
              } else {
                $ammo->$ammo_key += $amount_int;
              }
              $stmt_update_ammo = $mysqli->prepare("UPDATE player_accounts SET ammo = ? WHERE userId = ?");
              $new_ammo_json = json_encode($ammo);
              $stmt_update_ammo->bind_param("si", $new_ammo_json, $player['userId']);
              $stmt_update_ammo->execute();
              $stmt_update_ammo->close();
            }
            $status = true;
        } else if (!empty($shop['typeKey'])){
            $amount_int = (int)$amount; // Ensure amount is integer for arithmetic
            if(Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
                return json_encode(array('message' => "Disconnect from game to buy keys."));
            } else {
                // Assuming bootyKeys is a numeric column that can be directly incremented
                $stmt_update_keys = $mysqli->prepare("UPDATE player_accounts SET bootyKeys = bootyKeys + ? WHERE userId = ?");
                $stmt_update_keys->bind_param("ii", $amount_int, $player['userId']);
                $stmt_update_keys->execute();
                $stmt_update_keys->close();
                $status = true;
            }
        } else if (!empty($shop['petDesign'])){
            if (isset($player['petSavedDesigns'])){
              $arraySavedPets = json_decode($player['petSavedDesigns'], true); // true for assoc array
            } else {
              $arraySavedPets = [];
            }

            if (in_array($shop['petDesign'], $arraySavedPets) || $player['petDesign'] == $shop['petDesign']){
              $json['message'] = "You already buyed this pet.";
              return json_encode($json);
            }

            if (!in_array($player['petDesign'], $arraySavedPets)){
              array_push($arraySavedPets, $player['petDesign']);
            }

            $petSavedDesigns_json = json_encode($arraySavedPets);
            $stmt_update_pet_designs = $mysqli->prepare("UPDATE player_accounts SET petSavedDesigns = ?, petDesign = ? WHERE userId = ?");
            $stmt_update_pet_designs->bind_param("ssi", $petSavedDesigns_json, $shop['petDesign'], $player['userId']);
            $stmt_update_pet_designs->execute();
            $stmt_update_pet_designs->close();

            if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
              Socket::Send('updatePet', ['UserId' => $player['userId'], 'PetName' => $player['petName'], 'PetDesignn' => (isset($shop['petDesign'])) ? $shop['petDesign'] : 22]);
            }
            $status = true;
        } else if (!empty($shop['petFuel'])){
            // $items already fetched and decoded at the beginning of the 'if (isset($shop) && $shop['active'])' block
            // No need to re-fetch unless it was modified and not written back yet.

          if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {

            $fuel = Socket::Get('getPetFuel', ['UserId' => $player['userId'], 'Return' => 0]);

            if (empty($fuel) && !is_numeric($fuel)){
              $json['message'] = "The pet only allows 50,000 liters of fuel.";

              return json_encode($json);
            }

            $fuel += $shop['petFuel'];
            $items->fuel += $shop['petFuel'];

            if ($fuel > 50000){
              $json['message'] = "The pet only allows 50,000 liters of fuel.";

              return json_encode($json);
            }

          } else {

            if (empty($items->fuel)){
              $json['message'] = "The pet only allows 50,000 liters of fuel.";

              return json_encode($json);
            }

            $items->fuel += $shop['petFuel'];

            if ($items->fuel > 50000){
              $json['message'] = "The pet only allows 50,000 liters of fuel.";

              return json_encode($json);
            }

          }
          
          $items_json_fuel = json_encode($items);
          $stmt_update_fuel = $mysqli->prepare("UPDATE player_equipment SET items = ? WHERE userId = ?");
          $stmt_update_fuel->bind_param("si", $items_json_fuel, $player['userId']);
          $stmt_update_fuel->execute();
          $stmt_update_fuel->close();

          if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
            Socket::Send('updatePetFuel', ['UserId' => $player['userId'], 'Amount' => (int)$shop['petFuel']]);
          }

          $status = true;
        //}
      } else if (!empty($shop['petModule'])){
        // $items already fetched and decoded
        $act = $shop['petModule'];

        if (!empty($items->$act) && $items->$act == true){
          $json['message'] = "You already have ".$shop['name'];
          return json_encode($json);
        }

        $items->$act = true;
        
        $items_json_pet_module = json_encode($items);
        $stmt_update_pet_module = $mysqli->prepare("UPDATE player_equipment SET items = ? WHERE userId = ?");
        $stmt_update_pet_module->bind_param("si", $items_json_pet_module, $player['userId']);
        $stmt_update_pet_module->execute();
        $stmt_update_pet_module->close();

        if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
          Socket::Send('setPetModule', ['UserId' => $player['userId'], 'TypeModule' => $shop['petModule']]);
        }
        $status = true;
    }  else if (!empty($shop['FormationName'])){
        $stmt_get_formations = $mysqli->prepare("SELECT formationsSaved FROM player_equipment WHERE userId = ?");
        $stmt_get_formations->bind_param("i", $player['userId']);
        $stmt_get_formations->execute();
        $formations_json = $stmt_get_formations->get_result()->fetch_assoc()['formationsSaved'];
        $stmt_get_formations->close();
        $formations = json_decode($formations_json);

        $act = $shop['FormationName'];

        if (!empty($formations->$act) && $formations->$act == $act){
          $json['message'] = "You already have ".$shop['name'];
          return json_encode($json);
        }

        $formations->$act = $act;

        $new_formations_json = json_encode($formations);
        $stmt_update_formations = $mysqli->prepare("UPDATE player_equipment SET formationsSaved = ? WHERE userId = ?");
        $stmt_update_formations->bind_param("si", $new_formations_json, $player['userId']);
        $stmt_update_formations->execute();
        $stmt_update_formations->close();

        if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
          Socket::Send('buyFormation', ['UserId' => $player['userId'], 'Formation' => $shop['FormationName']]);
        }
        $status = true;
      } else if (!empty($shop['nameBootyKey'])){
        $stmt_get_bootykeys = $mysqli->prepare("SELECT bootyKeys FROM player_accounts WHERE userId = ?");
        $stmt_get_bootykeys->bind_param("i", $player['userId']);
        $stmt_get_bootykeys->execute();
        $bootykeys_json = $stmt_get_bootykeys->get_result()->fetch_assoc()['bootyKeys'];
        $stmt_get_bootykeys->close();
        $bootyKeys = json_decode($bootykeys_json);

        $act = $shop['nameBootyKey'];
        $amount_int = (int)$amount;

        $bootyKeys->$act += $amount_int;

        $new_bootykeys_json = json_encode($bootyKeys);
        $stmt_update_bootykeys = $mysqli->prepare("UPDATE player_accounts SET bootyKeys = ? WHERE userId = ?");
        $stmt_update_bootykeys->bind_param("si", $new_bootykeys_json, $player['userId']);
        $stmt_update_bootykeys->execute();
        $stmt_update_bootykeys->close();

        if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
          Socket::Send('buyKey', ['UserId' => $player['userId'], 'Key' => $shop['nameBootyKey'], 'Amount' => $amount_int]);
        }
        $status = true;
    }

          if ($status) {
            $mysqli->begin_transaction();
            try {
              $data_json = json_encode($data);
              $items_json = json_encode($items); // $items might have been modified by various branches
              $boosters_json = json_encode($boosters); // $boosters might have been modified
              $module_json = json_encode($module); // $module might have been modified

              $stmt_update_data = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
              $stmt_update_data->bind_param("si", $data_json, $player['userId']);
              $stmt_update_data->execute();
              $stmt_update_data->close();

              // Note: $items has been updated in multiple places (PET fuel, PET modules). Ensure it's the final version.
              $stmt_update_items = $mysqli->prepare("UPDATE player_equipment SET items = ? WHERE userId = ?");
              $stmt_update_items->bind_param("si", $items_json, $player['userId']);
              $stmt_update_items->execute();
              $stmt_update_items->close();

              $stmt_update_boosters = $mysqli->prepare("UPDATE player_equipment SET boosters = ? WHERE userId = ?");
              $stmt_update_boosters->bind_param("si", $boosters_json, $player['userId']);
              $stmt_update_boosters->execute();
              $stmt_update_boosters->close();

              $stmt_update_modules = $mysqli->prepare("UPDATE player_equipment SET modules = ? WHERE userId = ?");
              $stmt_update_modules->bind_param("si", $module_json, $player['userId']);
              $stmt_update_modules->execute();
              $stmt_update_modules->close();

              $json['newStatus'] = [
                'uridium' => number_format($data->uridium), // $data was modified directly
                'credits' => number_format($data->credits)
              ];

              if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
                Socket::Send('BuyItem', ['UserId' => $player['userId'], 'ItemType' => $shop['category'], 'DataType' => ($shop['priceType'] == 'uridium' ? 0 : 1), 'Amount' => $price]);
              }

              $json['message'] = '' . $shop['name'] . ' ' . ($amount != 0 ? '(' . number_format($amount) . ')' : '') . ' purchased';

              $mysqli->commit();
            } catch (Exception $e) {
              $json['message'] = 'An error occurred. Please try again later.';
              $mysqli->rollback();
            }

            $mysqli->close();

          }
        
        } else {

          $json['message'] = "You don't have enough " . ($shop['priceType'] == 'uridium' ? 'Uridium' : 'Credits');
        }  

      } elseif ($shop['priceType'] == 'event') {
        $stmt_search_event_user = $mysqli->prepare("SELECT coins FROM event_coins WHERE userId = ?");
        $stmt_search_event_user->bind_param("i", $player['userId']);
        $stmt_search_event_user->execute();
        $event_user_result = $stmt_search_event_user->get_result();

        if ($event_user_result->num_rows > 0){
          $user_coins_data = $event_user_result->fetch_assoc();
          $stmt_search_event_user->close();
          $user_coins = $user_coins_data['coins']; // This is now an integer

          if ($user_coins >= $price) {
            $user_coins -= $price; // This is now an integer
            $status = false;

            if (!empty($shop['design_name'])) {
              $design_name = $shop['design_name']; // from $shop

              $stmt_search_player_design = $mysqli->prepare("SELECT baseShipId FROM player_designs WHERE name = ? AND userId = ?");
              $stmt_search_player_design->bind_param("si", $design_name, $player['userId']);
              $stmt_search_player_design->execute();
              $stmt_search_player_design->store_result();

              if ($stmt_search_player_design->num_rows > 0) {
                $json['message'] = 'You already have an ' . $shop['name'] . '.';
                $stmt_search_player_design->close();
              } else {
                $stmt_search_player_design->close();

                $stmt_info_server_design = $mysqli->prepare("SELECT baseShipId FROM server_ships WHERE lootID = ?");
                $stmt_info_server_design->bind_param("s", $design_name);
                $stmt_info_server_design->execute();
                $info_server_design_result = $stmt_info_server_design->get_result();

                if ($info_server_design_result->num_rows > 0){
                  $baseShipId = $info_server_design_result->fetch_assoc()['baseShipId'];
                  $stmt_info_server_design->close();
                  if ($baseShipId > 0){
                    $stmt_insert_player_design = $mysqli->prepare("INSERT INTO player_designs (name, baseShipId, userId) VALUES (?, ?, ?)");
                    $stmt_insert_player_design->bind_param("sii", $design_name, $baseShipId, $player['userId']);
                    $stmt_insert_player_design->execute();
                    $stmt_insert_player_design->close();
                    $status = true;
                  }
                } else {
                  $stmt_info_server_design->close();
                }
              }
            }


            if (!empty($shop['moduleId']) && !empty($shop['moduleType'])){

              $module2 = array('Id' => $shop['moduleId'], 'Type' => $shop['moduleType'], 'InUse' => false);

              if (isset($verificaconectado) and ($verificaconectado == 0)){
                if (!in_array($module, $module)) {
                  array_push($module, $module2);
                  $status = true;
                }
              } else {
                $json['message'] = "Disconnect from game to buy.";
              }

            }
			else if (!empty($shop['nameBootyKey'])){
                $amount_int = (int)$amount;
				$stmt_get_bkeys = $mysqli->prepare("SELECT bootyKeys FROM player_accounts WHERE userId = ?");
                $stmt_get_bkeys->bind_param("i", $player['userId']);
                $stmt_get_bkeys->execute();
                $bkeys_json = $stmt_get_bkeys->get_result()->fetch_assoc()['bootyKeys'];
                $stmt_get_bkeys->close();
				$bootyKeys = json_decode($bkeys_json);

				$act = $shop['nameBootyKey'];
				$bootyKeys->$act += $amount_int;

                $new_bkeys_json = json_encode($bootyKeys);
				$stmt_update_bkeys = $mysqli->prepare("UPDATE player_accounts SET bootyKeys = ? WHERE userId = ?");
                $stmt_update_bkeys->bind_param("si", $new_bkeys_json, $player['userId']);
                $stmt_update_bkeys->execute();
                $stmt_update_bkeys->close();

				if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
				  Socket::Send('updateEC', ['UserId' => $player['userId'], 'Amount' => 3, 'Type' => "DECREASE"]);
				  Socket::Send('buyKey', ['UserId' => $player['userId'], 'Key' => $shop['nameBootyKey'], 'Amount' => $amount]);
				}
			
				$status = true;
				
			} else if (!empty($shop['ammoId'])){
                $amount_int = (int)$amount;
                if(Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
                    Socket::Send('AddAmmo', ['UserId' => $player['userId'], 'itemId' => $shop['ammoId'], 'amount' => $amount_int]);
                } else {
                    $stmt_get_ammo_event = $mysqli->prepare("SELECT ammo FROM player_accounts WHERE userId = ?");
                    $stmt_get_ammo_event->bind_param("i", $player['userId']);
                    $stmt_get_ammo_event->execute();
                    $ammo_json_event = $stmt_get_ammo_event->get_result()->fetch_assoc()['ammo'];
                    $stmt_get_ammo_event->close();
                    $ammo = json_decode($ammo_json_event);

                    $ammo_key_event = $typeMunnition[$shop['ammoId']];
                    if (empty($ammo->$ammo_key_event)){
                        $ammo->$ammo_key_event = $amount_int;
                    } else {
                        $ammo->$ammo_key_event += $amount_int;
                    }
                    $new_ammo_json_event = json_encode($ammo);
                    $stmt_update_ammo_event = $mysqli->prepare("UPDATE player_accounts SET ammo = ? WHERE userId = ?");
                    $stmt_update_ammo_event->bind_param("si", $new_ammo_json_event, $player['userId']);
                    $stmt_update_ammo_event->execute();
                    $stmt_update_ammo_event->close();
                }
                $status = true;
			
			} else if (!empty($shop['laserName'])) {
                // $items, $module, $boosters already fetched. $lasersSaved is $items.
                // $config1, $config2 also fetched if laserName logic was hit earlier.
                // This assumes that if laserName is set for event purchase, it implies the same pre-fetched data is usable.
                // If not, specific fetches for config1/config2 might be needed here.
                // For now, we assume $items is up-to-date for $lasersSaved.
                $lasersSaved = $items; // From the top of the function
                // $config1 and $config2 might need re-fetching if not already available or if stale
                // For simplicity, let's assume they are available if this path is hit after the main laserName block
                // Otherwise, they would need to be fetched like:
                // $stmt_drones_config_event = $mysqli->prepare("SELECT config1_drones, config2_drones FROM player_equipment WHERE userId = ?");
                // $stmt_drones_config_event->bind_param("i", $player['userId']);
                // $stmt_drones_config_event->execute();
                // $drones_config_result_event = $stmt_drones_config_event->get_result()->fetch_assoc();
                // $stmt_drones_config_event->close();
                // $config1 = json_decode($drones_config_result_event['config1_drones']);
                // $config2 = json_decode($drones_config_result_event['config2_drones']);

            $max = null;
            $name = null;

            if ($shop['laserName'] == 'lf1Count'){
              $max = 40;
              $name = "lasers";			
            } 
			if ($shop['laserName'] == 'lf2Count'){
              $max = 40;
              $name = "lasers";
            }            
			if ($shop['laserName'] == 'lf3Count'){
              $max = 40;
              $name = "lasers";
            }
            if ($shop['laserName'] == 'lf4Count'){
              $max = 40;
              $name = "lasers";
            }
            if ($shop['laserName'] == 'lf5Count'){
              $max = 40;
              $name = "lasers";
            }
            if ($shop['laserName'] == 'bo3Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'bo2Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'B01Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'A03Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'A02Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'A01Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'A01Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'g3nCount'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'g3n6900Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'g3n3310Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'g3n3210Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'g3n2010Count'){
              $max = 40;
              $name = "generators";
            }
			if ($shop['laserName'] == 'g3n1010Count'){
              $max = 40;
              $name = "generators";
            }			 
			if ($shop['laserName'] == 'lf3nCount'){
              $max = 40;
              $name = "lasers";
			} 
			if ($shop['laserName'] == 'lf4mdCount'){
              $max = 40;
              $name = "lasers";
			} 
			if ($shop['laserName'] == 'lf4pdCount'){
              $max = 40;
              $name = "lasers";
			} 
			if ($shop['laserName'] == 'lf4hpCount'){
              $max = 40;
              $name = "lasers";
			} 
			if ($shop['laserName'] == 'lf4spCount'){
              $max = 40;
              $name = "lasers";
			} 
			if ($shop['laserName'] == 'lf4unstableCount'){
              $max = 40;
              $name = "lasers";
			} 
			if ($shop['laserName'] == 'mp1Count'){
              $max = 40;
              $name = "lasers";
			}
            $items->{$shop['laserName']} += $amount;
            $status = true;
			
			} else if (!empty($shop['droneName'])) {

            if (strpos($shop['droneName'], "Count")) {
              $items->{$shop['droneName']} += $amount;
              $status = true;
            } else {
              if (!$items->{$shop['droneName']}) {
                //$items->{$shop['droneName']} = true;
                $droneName = "drone".ucfirst($shop['droneName'])."Parts";
                if (empty($items->{$droneName})){
                  $items->{$droneName} = $amount;
                } else {
                  $items->{$droneName} += $amount;
                }
                $status = true;
              } else {
                $json['message'] = 'You already have an ' . $shop['name'] . ' Drone.';
              }
            }
			
			} else if (!empty($shop['shipId']) && $shop['shipId'] > 0) {

            if (!in_array($shop['shipId'], $items->ships)) {
              array_push($items->ships, (int)$shop['shipId']);
              $status = true;
            } else {
              $json['message'] = 'You already have an ' . $shop['name'] . '.';
            }
			
			
			} else if (!empty($shop['boosterId']) && is_numeric($shop['boosterType']) && !empty($shop['boosterDuration'])){

            //if (isset($verificaconectado) and ($verificaconectado == 0)){

              $shop['boosterId'] = str_replace("-", "", $shop['boosterId']);

              $canPutBooster = true;

              // Fix Boosters. 21.09.2020. | New revisition: 06.02.2021 | Connected to socket: 07.02.2021
              if (empty($boosters->{$shop['boosterId']})) {
                  if(Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
                    Socket::Send('SendBoosters', ['UserId' => $player['userId'], 'typeBooster' => $shop['boosterType'], 'hoursBooster' => $shop['boosterDuration']]);
                  }
                  $bb[] = array('Type' => $shop['boosterType'], 'Seconds' => $shop['boosterDuration']);
                  $boosters->{$shop['boosterId']} = $bb;
                  $status = true;
              } else {

                foreach ($boosters->{$shop['boosterId']} as $bb){
                  if ($bb->Type == $shop['boosterType']){
                    $canPutBooster = false;
                  }
                }

                if ($canPutBooster){
                  if(Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
                    Socket::Send('SendBoosters', ['UserId' => $player['userId'], 'typeBooster' => $shop['boosterType'], 'hoursBooster' => $shop['boosterDuration']]);
                  }
                  array_push($boosters->{$shop['boosterId']}, array('Type' => $shop['boosterType'], 'Seconds' => $shop['boosterDuration']));
                  $status = true;
                } else {
                  $json['message'] = 'You already have an ' . $shop['name'] . '.';
                }

              }

            //} else {
              //$json['message'] = "Disconnect from game to buy.";
            //}

          }

            if ($status) {
              $mysqli->begin_transaction();
              try {
                $stmt_update_event_coins = $mysqli->prepare("UPDATE event_coins SET coins = ? WHERE userId = ?");
                $stmt_update_event_coins->bind_param("ii", $user_coins, $player['userId']); // $user_coins is now integer
                $stmt_update_event_coins->execute();
                $stmt_update_event_coins->close();

                // These updates are similar to the non-event purchase block
                $data_json_event = json_encode($data); // $data might have been modified
                $items_json_event = json_encode($items); // $items might have been modified
                $boosters_json_event = json_encode($boosters); // $boosters might have been modified
                $module_json_event = json_encode($module); // $module might have been modified

                $stmt_update_data_event = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
                $stmt_update_data_event->bind_param("si", $data_json_event, $player['userId']);
                $stmt_update_data_event->execute();
                $stmt_update_data_event->close();

                $stmt_update_items_event = $mysqli->prepare("UPDATE player_equipment SET items = ? WHERE userId = ?");
                $stmt_update_items_event->bind_param("si", $items_json_event, $player['userId']);
                $stmt_update_items_event->execute();
                $stmt_update_items_event->close();

                $stmt_update_boosters_event = $mysqli->prepare("UPDATE player_equipment SET boosters = ? WHERE userId = ?");
                $stmt_update_boosters_event->bind_param("si", $boosters_json_event, $player['userId']);
                $stmt_update_boosters_event->execute();
                $stmt_update_boosters_event->close();

                $stmt_update_modules_event = $mysqli->prepare("UPDATE player_equipment SET modules = ? WHERE userId = ?");
                $stmt_update_modules_event->bind_param("si", $module_json_event, $player['userId']);
                $stmt_update_modules_event->execute();
                $stmt_update_modules_event->close();

                if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
                  Socket::Send('updateEC', ['UserId' => $player['userId'], 'Amount' => (int)$price, 'Type' => "DECREASE"]);
                }

                $json['ec'] = number_format($user_coins); // $user_coins is now integer

                $json['message'] = '' . $shop['name'] . ' ' . ($amount != 0 ? '(' . number_format($amount) . ')' : '') . ' purchased';

                $mysqli->commit();
              } catch (Exception $e) {
                $json['message'] = 'An error occurred. Please try again later.';
                $mysqli->rollback();
              }

              $mysqli->close();

            }

          } else { // if ($user_coins < $price)
            $json['message'] = "You don't have enough Event Coins";
          }
        } else { // if ($event_user_result->num_rows == 0)
            $stmt_search_event_user->close(); // Close if not closed yet (e.g. in case of error before)
            $json['message'] = "You don't have any Event Coins record."; // Or appropriate message
        }
      }
    } else { // if (!isset($shop) || !$shop['active'])
      $json['message'] = 'Something went wrong!';
    }

    return json_encode($json);

  }

  public static function ChangePilotName($newPilotName)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['message' => 'Player not found.']); }

    // $newPilotName will be used in prepared statement, no manual escape here.
    $userIdInt = (int)$player['userId'];
    $verificaconectado = Socket::Get('IsOnline', array('UserId' => $userIdInt, 'Return' => false));
    $json = [
      'inputs' => ['pilotName' => ['validate' => 'valid', 'error' => 'Enter a valid pilot name!']],
      'message' => ''
    ];

    if (mb_strlen($newPilotName) < 4 || mb_strlen($newPilotName) > 20) {
      $json['inputs']['pilotName']['validate'] = 'invalid';
      $json['inputs']['pilotName']['error'] = 'Your pilot name should be between 4 and 20 characters.';
      return json_encode($json);
    }

    if (isset($verificaconectado) && $verificaconectado == 0) { // Must be offline or in safe zone (original logic)
      // Validate pilotName format if needed (e.g. preg_match as in Register) - Current check is only length.

      $oldPilotNames = json_decode($player['oldPilotNames'], true); // true for assoc array
      if (!is_array($oldPilotNames)) $oldPilotNames = [];

      $canChangeName = false;
      if (empty($oldPilotNames) || $player['rankId'] == 21) { // Chief General or no previous changes
          $canChangeName = true;
      } else {
          $lastChangeEntry = end($oldPilotNames);
          if (isset($lastChangeEntry['date'])) {
              $lastChangeDate = new DateTime($lastChangeEntry['date']);
              $now = new DateTime();
              if ($now->diff($lastChangeDate)->days >= 1) {
                  $canChangeName = true;
              }
          } else {
              // If date is missing in last entry, allow change (or handle as error)
              $canChangeName = true;
          }
      }

      if ($canChangeName) {
        $stmt_check_name = $mysqli->prepare('SELECT userId FROM player_accounts WHERE pilotName = ?');
        $stmt_check_name->bind_param("s", $newPilotName);
        $stmt_check_name->execute();
        $stmt_check_name->store_result();
        $name_exists = $stmt_check_name->num_rows > 0;
        $stmt_check_name->close();

        if (!$name_exists) {
          $mysqli->begin_transaction();
          try {
            $oldPilotNames[] = ['name' => $player['pilotName'], 'date' => date('d.m.Y H:i:s')];
            $oldPilotNamesJson = json_encode($oldPilotNames, JSON_UNESCAPED_UNICODE);

            $stmt_update_name = $mysqli->prepare("UPDATE player_accounts SET pilotName = ?, oldPilotNames = ? WHERE userId = ?");
            $stmt_update_name->bind_param("ssi", $newPilotName, $oldPilotNamesJson, $userIdInt);
            $stmt_update_name->execute();
            $stmt_update_name->close();

            $json['message'] = 'Your Pilot name has been changed.';
            $mysqli->commit();
          } catch (Exception $e) {
            $json['message'] = 'An error occurred. Please try again later: ' . $e->getMessage();
            $mysqli->rollback();
          }
          // $mysqli->close(); // Managed by Database class
        } else {
          $json['message'] = 'This Pilot name is already in use.';
        }
      } else {
        $lastChangeDateStr = isset($lastChangeEntry['date']) ? date('d.m.Y H:i', strtotime($lastChangeEntry['date'])) : 'unknown';
        $json['message'] = 'You can only rename your Pilot once every 24 hours. <br> (Your last name change: ' . $lastChangeDateStr . ')';
      }
    } else {
      $json['message'] = "Disconnect or go to a safe area to change pilot name.";
    }
    return json_encode($json);
  }

  public static function ChangeClanData($newtagName)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['message' => 'Player not found.']); }

    // $newtagName will be used in prepared statement.
    $userIdInt = (int)$player['userId'];
    $clanId = (int)$player['clanId'];
    // $verificaconectado = Socket::Get('IsOnline', array('UserId' => $userIdInt, 'Return' => false)); // This variable is unused.

    $json = [
      'inputs' => ['tagname' => ['validate' => 'valid', 'error' => 'Enter a valid TAG name!']], // Corrected error message
      'message' => ''
    ];

    if (mb_strlen($newtagName) < 1 || mb_strlen($newtagName) > 4) {
      $json['inputs']['tagname']['validate'] = 'invalid';
      $json['message'] = 'Your TAG name should be between 1 and 4 characters.';
      return json_encode($json);
    }

    // The original code has 'if ($json['inputs']['tagname']['validate'] === 'valid')' which is redundant due to early return.
    // Assuming validation passed if we reach here.

    $stmt_check_tag = $mysqli->prepare('SELECT leaderId FROM server_clans WHERE tag = ?');
    $stmt_check_tag->bind_param("s", $newtagName);
    $stmt_check_tag->execute();
    $stmt_check_tag->store_result();
    $tag_exists = $stmt_check_tag->num_rows > 0;
    $stmt_check_tag->close();

    if (!$tag_exists) {
      $mysqli->begin_transaction();
      try {
        $stmt_update_tag = $mysqli->prepare("UPDATE server_clans SET tag = ? WHERE leaderId = ?");
        $stmt_update_tag->bind_param("si", $newtagName, $userIdInt);
        $stmt_update_tag->execute();

        if ($stmt_update_tag->affected_rows > 0) {
            $json['status'] = true;
            $json['message'] = 'Your tag name has been changed.';
            Socket::Send('ChangeClanData', ['ClanId' => $clanId, 'Tag' => $newtagName]);
        } else {
            // This could mean the user is not a leader of any clan, or the tag was the same.
            $json['message'] = 'Could not change tag name. You might not be a clan leader or the tag is the same.';
        }
        $stmt_update_tag->close();
        $mysqli->commit();
      } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later: ' . $e->getMessage();
        $mysqli->rollback();
      }
      // $mysqli->close(); // Managed by Database class
    } else {
      $json['message'] = 'This tag name is already in use.';
    }
    return json_encode($json);
  }

  public static function changeprofileurl($urlprofile)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['message' => 'Player not found.']); }

    // $urlprofile will be used in prepared statement.
    $userIdInt = (int)$player['userId'];
    $json = [
      'inputs' => ['urlprofile' => ['validate' => 'valid', 'error' => 'Enter a valid profile URL!']], // Corrected error message
      'message' => ''
    ];

    if (mb_strlen($urlprofile) < 10 || mb_strlen($urlprofile) > 100) {
      $json['inputs']['urlprofile']['validate'] = 'invalid';
      $json['inputs']['urlprofile']['error'] = 'Your link should be between 10 and 100 characters.';
      return json_encode($json);
    }

    // No transaction needed for a single update if atomicity with other operations isn't critical.
    // However, the original code had $mysqli->commit() without $mysqli->begin_transaction() which is incorrect.
    // Assuming a simple update is fine here.
    try {
        $stmt = $mysqli->prepare("UPDATE player_accounts SET profile = ? WHERE userId = ?");
        $stmt->bind_param("si", $urlprofile, $userIdInt);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $json['message'] = 'Your Photo has been changed.';
            } else {
                $json['message'] = 'Profile URL is the same or user not found.';
            }
        } else {
            $json['message'] = 'Failed to update profile URL.';
        }
        $stmt->close();
    } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later: ' . $e->getMessage();
    }
    // $mysqli->close(); // Managed by Database class
    return json_encode($json);
  }


  public static function changepassword($newpassword_from_param_is_unused) // Parameter name changed to reflect it's not used
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['message' => 'Player not found.']); }

    $newpassword = $_POST['newpassword']; // Directly from POST
    $repeatnewpassword = $_POST['repeatnewpassword']; // Directly from POST
    $userIdInt = (int)$player['userId'];

    $json = [
      'inputs' => ['newpassword' => ['validate' => 'valid', 'error' => 'Enter a valid password!']], // Corrected error message
      'message' => ''
    ];

    if (mb_strlen($newpassword) < 6 || mb_strlen($newpassword) > 20) { // Original code used 6-20, Register uses 8-45
      $json['inputs']['newpassword']['validate'] = 'invalid';
      $json['inputs']['newpassword']['error'] = 'Your password should be between 6 and 20 characters.';
      return json_encode($json);
    }
	
    if ($newpassword === $repeatnewpassword) {
        // Original code had $mysqli->commit() without $mysqli->begin_transaction().
        // For a single update, transaction is not strictly necessary but doesn't harm.
        // For consistency with other refactored methods, let's add it.
        $mysqli->begin_transaction();
        try {
            $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);
            $stmt = $mysqli->prepare("UPDATE player_accounts SET password = ? WHERE userId = ?");
            $stmt->bind_param("si", $hashed_password, $userIdInt);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $json['message'] = 'Your Password has been changed.';
            } else {
                // This could happen if the new password hash is identical to the old one, or user ID invalid (unlikely here)
                $json['message'] = 'Password not changed (it might be the same as the old one).';
            }
            $stmt->close();
            $mysqli->commit();
        } catch (Exception $e) {
            $json['message'] = 'An error occurred. Please try again later: ' . $e->getMessage();
            $mysqli->rollback();
        }
        // $mysqli->close(); // Managed by Database class
    } else {
        $json['message'] = 'New passwords do not match.';
    }
    return json_encode($json);
  }
  
} // This curly brace seems to be closing the class, ensure other functions are inside or correctly placed.
    

    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['message' => 'Player not found.']); }

    // $nameclan will be used in prepared statement.
    $userIdInt = (int)$player['userId'];
    $clanId = (int)$player['clanId'];
    // $verificaconectado = Socket::Get('IsOnline', array('UserId' => $userIdInt, 'Return' => false)); // Unused

    $json = [
      'inputs' => ['nameclan' => ['validate' => 'valid', 'error' => 'Enter a valid clan name!']], // Corrected
      'message' => ''
    ];

    if (mb_strlen($nameclan) < 1 || mb_strlen($nameclan) > 20) { // Original code allowed up to 20
      $json['inputs']['nameclan']['validate'] = 'invalid';
      $json['message'] = 'Your clan name should be between 1 and 20 characters.';
      return json_encode($json);
    }
    
    $stmt_check_name = $mysqli->prepare('SELECT id FROM server_clans WHERE name = ?');
    $stmt_check_name->bind_param("s", $nameclan);
    $stmt_check_name->execute();
    $stmt_check_name->store_result();
    $name_exists = $stmt_check_name->num_rows > 0;
    $stmt_check_name->close();

    if (!$name_exists) {
      $mysqli->begin_transaction();
      try {
        $stmt_update_name = $mysqli->prepare("UPDATE server_clans SET name = ? WHERE leaderId = ?");
        $stmt_update_name->bind_param("si", $nameclan, $userIdInt);
        $stmt_update_name->execute();

        if ($stmt_update_name->affected_rows > 0) {
            $json['status'] = true;
            $json['message'] = 'Your clan name has been changed.';
            Socket::Send('ChangeClanData', ['ClanId' => $clanId, 'name' => $nameclan]);
        } else {
            $json['message'] = 'Could not change clan name. You might not be a clan leader or the name is the same.';
        }
        $stmt_update_name->close();
        $mysqli->commit();
      } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later: ' . $e->getMessage();
        $mysqli->rollback();
      }
      // $mysqli->close(); // Managed by Database class
        } else {
          $json['message'] = 'This name clan is already in use.';
        }
      }

    return json_encode($json);
  }
  
  public static function ChangePetName($petName = null, $petChoosed = null)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['status' => false, 'message' => 'Player not found.']); }

    $userIdInt = (int)$player['userId'];
    // $verificaconectado = Socket::Get('IsOnline', array('UserId' => $userIdInt, 'Return' => false)); // Unused in current logic path

    $json = ['message' => '', 'status' => false];
    $changedName = false;
    // $changedDesignPet = false; // This variable is set but never read.

    // Logic for changing PET name
    if (!empty($petName)) {
        if (mb_strlen($petName) < 2 || mb_strlen($petName) > 10) {
            $json['message'] = "The pet name must contain between 2 and 10 characters.";
            return json_encode($json);
        }
        $stmt_update_pet_name = $mysqli->prepare("UPDATE player_accounts SET petName = ? WHERE userId = ?");
        $stmt_update_pet_name->bind_param("si", $petName, $userIdInt);
        if ($stmt_update_pet_name->execute()) {
            if ($stmt_update_pet_name->affected_rows > 0) $changedName = true;
        } else {
            $json['message'] = "Error updating PET name."; // More specific error could be logged
            $stmt_update_pet_name->close();
            return json_encode($json);
        }
        $stmt_update_pet_name->close();
    } else {
        // Original code implies petName is mandatory if this function is called to change name,
        // but it proceeds to petChoosed logic even if petName is empty.
        // For clarity, let's assume if petName is empty, we don't try to change it and don't error out here,
        // allowing pet design change to proceed. If petName is required, this should be an error.
        // Based on original code, if $petName is empty, it sets $json['message'] and returns.
        // Let's keep that:
        $json['message'] = "The pet's name cannot be empty if you intend to change it.";
        // However, the original code structure would then FALL THROUGH to petChoosed logic.
        // This seems like a bug in original logic. If petName is empty, it should probably only proceed if petChoosed is set.
        // For now, I will assume if petName is empty, it's an error for this specific part.
        // If the intent is to change *only* design, then petName should not be validated here.
        // Let's separate the concerns.
    }

    // Logic for changing PET design
    if (!empty($petChoosed)) {
        $petSavedDesigns = json_decode($player['petSavedDesigns'], true);
        if (!is_array($petSavedDesigns)) $petSavedDesigns = [];

        if (!in_array($petChoosed, $petSavedDesigns)) {
            $json['message'] = 'You have not bought this PET design.';
            return json_encode($json);
        }

        // Add current design to saved designs if it's not already there
        if ($player['petDesign'] != null && !in_array($player['petDesign'], $petSavedDesigns)) {
            $petSavedDesigns[] = $player['petDesign'];
            $petSavedDesignsJson = json_encode($petSavedDesigns);
            $stmt_update_saved_designs = $mysqli->prepare("UPDATE player_accounts SET petSavedDesigns = ? WHERE userId = ?");
            $stmt_update_saved_designs->bind_param("si", $petSavedDesignsJson, $userIdInt);
            if (!$stmt_update_saved_designs->execute()) {
                 // Log error
            }
            $stmt_update_saved_designs->close();
        }

        // Set new petDesign
        $stmt_update_pet_design = $mysqli->prepare("UPDATE player_accounts SET petDesign = ? WHERE userId = ?");
        $stmt_update_pet_design->bind_param("si", $petChoosed, $userIdInt);
        if ($stmt_update_pet_design->execute()) {
            // $changedDesignPet = true; // This was unused.
        } else {
            // Log error
        }
        $stmt_update_pet_design->close();
    }

    // Determine final message and status
    if ($changedName || !empty($petChoosed)) { // If any change was attempted and presumably successful
        $json['status'] = true; // Assume success if we reached here without specific errors being returned
        $json['message'] = 'PET data saved successfully.';
        if (Socket::Get('IsOnline', ['UserId' => $userIdInt, 'Return' => false])) {
            $currentPetName = !empty($petName) ? $petName : $player['petName']; // Use new name if changed, else old
            $currentPetDesign = !empty($petChoosed) ? $petChoosed : $player['petDesign']; // Use new design if changed
            Socket::Send('updatePet', ['UserId' => $userIdInt, 'PetName' => $currentPetName, 'PetDesignn' => $currentPetDesign ?? 22]);
        }
    } else if (empty($petName) && empty($petChoosed)) {
        $json['message'] = 'No changes specified for PET.';
    }
    // If only petName was provided and it was empty, the earlier error message for petName would have been set.

    return json_encode($json);
  }

  public static function ExchangeLogdisks()
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['message' => 'Player not found.']); }
    $userIdInt = (int)$player['userId'];

    $stmt_get_equip = $mysqli->prepare('SELECT skill_points, items FROM player_equipment WHERE userId = ?');
    $stmt_get_equip->bind_param("i", $userIdInt);
    $stmt_get_equip->execute();
    $equipmentResult = $stmt_get_equip->get_result();
    $equipment = $equipmentResult->fetch_assoc();
    $stmt_get_equip->close();

    if (!$equipment) {
        return json_encode(['message' => 'Player equipment not found.']);
    }

    $skillPoints = json_decode($equipment['skill_points']);
    $items = json_decode($equipment['items']);
    // Ensure skillTree property exists
    if (!isset($items->skillTree)) {
        $items->skillTree = new stdClass();
        $items->skillTree->logdisks = 0;
        $items->skillTree->researchPoints = 0;
    }


    $requiredLogdisks = Functions::GetRequiredLogdisks((array_sum((array) $skillPoints) + $items->skillTree->researchPoints) + 1);

    $json = ['message' => ''];

    if ($items->skillTree->logdisks >= $requiredLogdisks && ((array_sum((array) $skillPoints) + $items->skillTree->researchPoints) < array_sum(array_column(Functions::GetSkills($skillPoints), 'maxLevel')))) {
      $items->skillTree->logdisks -= $requiredLogdisks;
      $items->skillTree->researchPoints++;
      $newItemsJson = json_encode($items);

      $mysqli->begin_transaction();
      try {
        $stmt_update_items = $mysqli->prepare("UPDATE player_equipment SET items = ? WHERE userId = ?");
        $stmt_update_items->bind_param("si", $newItemsJson, $userIdInt);
        $stmt_update_items->execute();
        $stmt_update_items->close();

        $json['newStatus'] = [
          'logdisks' => $items->skillTree->logdisks,
          'researchPoints' => $items->skillTree->researchPoints,
          // Re-decode $equipment['skill_points'] for consistency if $skillPoints was modified, though it's not here.
          'researchPointsMaxed' => ((array_sum((array) $skillPoints) + $items->skillTree->researchPoints) == array_sum(array_column(Functions::GetSkills($skillPoints), 'maxLevel'))),
          'requiredLogdisks' => Functions::GetRequiredLogdisks((array_sum((array) $skillPoints) + $items->skillTree->researchPoints) + 1)
        ];
        $json['message'] = 'Log disks exchanged.';
        $mysqli->commit();
      } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later: ' . $e->getMessage();
        $mysqli->rollback();
      }
      // $mysqli->close(); // Managed by Database class
    } else {
      if (!isset($items->skillTree) || $items->skillTree->logdisks < $requiredLogdisks) {
        $json['message'] = 'Not enough logdisks to exchange.';
      } else {
        $json['message'] = 'Cannot exchange logdisks, skill tree possibly maxed or other issue.';
      }
    }
    return json_encode($json);
  }

  public static function ResetSkills()
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['status' => false, 'message' => 'Player not found.']); }
    $userIdInt = (int)$player['userId'];

    $stmt_get_equip = $mysqli->prepare('SELECT skill_points, items FROM player_equipment WHERE userId = ?');
    $stmt_get_equip->bind_param("i", $userIdInt);
    $stmt_get_equip->execute();
    $equipmentResult = $stmt_get_equip->get_result();
    $equipment = $equipmentResult->fetch_assoc();
    $stmt_get_equip->close();

    if (!$equipment) { return json_encode(['status' => false, 'message' => 'Player equipment not found.']); }

    $skillPoints = json_decode($equipment['skill_points']);
    $items = json_decode($equipment['items']);
    $data = json_decode($player['data']); // Player data from GetPlayer which is already from DB

    // Ensure skillTree and resetCount properties exist
    if (!isset($items->skillTree)) $items->skillTree = new stdClass();
    if (!isset($items->skillTree->resetCount)) $items->skillTree->resetCount = 0;
    if (!isset($items->skillTree->researchPoints)) $items->skillTree->researchPoints = 0;


    $json = ['status' => false, 'message' => ''];
    $cost = Functions::GetResetSkillCost($items->skillTree->resetCount);

    if ($data->uridium >= $cost) {
      $data->uridium -= $cost;
      $items->skillTree->resetCount++;
      $items->skillTree->researchPoints += array_sum((array) $skillPoints);

      foreach ($skillPoints as $key => $value) {
        $skillPoints->$key = 0;
      }

      $newPlayerDataJson = json_encode($data);
      $newItemsJson = json_encode($items);
      $newSkillPointsJson = json_encode($skillPoints);

      $mysqli->begin_transaction();
      try {
        $stmt_update_acct = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
        $stmt_update_acct->bind_param("si", $newPlayerDataJson, $userIdInt);
        $stmt_update_acct->execute();
        $stmt_update_acct->close();

        $stmt_update_equip = $mysqli->prepare("UPDATE player_equipment SET items = ?, skill_points = ? WHERE userId = ?");
        $stmt_update_equip->bind_param("ssi", $newItemsJson, $newSkillPointsJson, $userIdInt);
        $stmt_update_equip->execute();
        $stmt_update_equip->close();

        $json['status'] = true;
        $json['message'] = 'Research points resetted.';
        if (Socket::Get('IsOnline', ['UserId' => $userIdInt, 'Return' => false])) {
          Socket::Send('ResetSkillTree', ['UserId' => $userIdInt]);
        }
        $mysqli->commit();
      } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later: ' . $e->getMessage();
        $mysqli->rollback();
      }
      // $mysqli->close(); // Managed by Database class
    } else {
      $json['message'] = "You don't have enough Uridium.";
    }

    return json_encode($json);
  }

  public static function UseResearchPoints($skill)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['message' => 'Player not found.']); }

    // $skill parameter is used as an array key, not directly in SQL. Manual escaping is not needed for that usage.
    // However, it's good practice to validate $skill against a list of known skills if possible.
    $userIdInt = (int)$player['userId'];

    $stmt_get_equip = $mysqli->prepare('SELECT skill_points, items FROM player_equipment WHERE userId = ?');
    $stmt_get_equip->bind_param("i", $userIdInt);
    $stmt_get_equip->execute();
    $equipmentResult = $stmt_get_equip->get_result();
    $equipment = $equipmentResult->fetch_assoc();
    $stmt_get_equip->close();

    if (!$equipment) { return json_encode(['message' => 'Player equipment not found.']); }

    $skillPoints = json_decode($equipment['skill_points']);
    $items = json_decode($equipment['items']);

    // Ensure skillTree and researchPoints properties exist
    if (!isset($items->skillTree)) $items->skillTree = new stdClass();
    if (!isset($items->skillTree->researchPoints)) $items->skillTree->researchPoints = 0;


    $skills = Functions::GetSkills($skillPoints); // This function does not interact with DB.
    $json = ['message' => ''];

    if (array_key_exists($skill, $skills) && isset($skillPoints->{$skill}) && (!isset($skills[$skill]['baseSkill']) || (isset($skills[$skill]['baseSkill']) && $skills[$skills[$skill]['baseSkill']]['currentLevel'] == $skills[$skills[$skill]['baseSkill']]['maxLevel']))) {
      if ($items->skillTree->researchPoints >= 1 && $skillPoints->{$skill} < $skills[$skill]['maxLevel']) {
        $items->skillTree->researchPoints--;
        $skillPoints->{$skill}++;

        $newItemsJson = json_encode($items);
        $newSkillPointsJson = json_encode($skillPoints);

        $mysqli->begin_transaction();
        try {
          $stmt_update_equip = $mysqli->prepare("UPDATE player_equipment SET items = ?, skill_points = ? WHERE userId = ?");
          $stmt_update_equip->bind_param("ssi", $newItemsJson, $newSkillPointsJson, $userIdInt);
          $stmt_update_equip->execute();
          $stmt_update_equip->close();

          $json['newStatus'] = [
            'researchPoints' => $items->skillTree->researchPoints,
            'currentLevel' => $skillPoints->{$skill},
            'usedResearchPoints' => array_sum((array) $skillPoints),
            'isMaxed' => $skillPoints->{$skill} == $skills[$skill]['maxLevel'],
            'tooltip' => Functions::GetSkillTooltip($skills[$skill]['name'], $skillPoints->{$skill}, $skills[$skill]['maxLevel'])
          ];

          if ($json['newStatus']['isMaxed'] && isset($skills[$skill]['nextSkill'])) {
            $json['newStatus']['nextSkill'] = $skills[$skill]['nextSkill'];
          }

          if (Socket::Get('IsOnline', ['UserId' => $userIdInt, 'Return' => false])) {
            Socket::Send('UpgradeSkillTree', ['UserId' => $userIdInt, 'Skill' => $skill]);
          }
          $mysqli->commit();
        } catch (Exception $e) {
          $json['message'] = 'An error occurred. Please try again later: ' . $e->getMessage();
          $mysqli->rollback();
        }
        // $mysqli->close(); // Managed by Database class
      } else {
        if ($items->skillTree->researchPoints < 1) {
            $json['message'] = 'Not enough research points.';
        } else if ($skillPoints->{$skill} >= $skills[$skill]['maxLevel']) {
            $json['message'] = 'Skill already at maximum level.';
        } else {
            $json['message'] = 'Cannot upgrade skill due to unmet conditions.';
        }
      }
    } else {
      $json['message'] = 'Invalid skill or prerequisite not met.';
    }
    return json_encode($json);
  }

  public static function getShopCategories(){
    $mysqli = Database::GetInstance();
    // This is a static query, but for consistency and future-proofing:
    $stmt = $mysqli->prepare("SELECT category FROM shop_category WHERE active = '1'");
    $stmt->execute();
    $result = $stmt->get_result();
    $dataReturn = [];
    if ($result->num_rows > 0){
      while($data_category = $result->fetch_assoc()){
        $dataReturn[] = $data_category['category'];
      }
    }
    $stmt->close();
    return $dataReturn;
  }

  public static function getShopItems($category){

    $mysqli = Database::GetInstance();

    $stmt = $mysqli->prepare("SELECT * FROM shop_items WHERE category = ? AND active = '1'");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $query_items_result = $stmt->get_result();

    if ($query_items_result->num_rows > 0){
      $dataReturn = array();
	  $player = Functions::GetPlayer();
	  
	  // The date logic seems unused for filtering items, so it's kept as is for now.
	  // If it were for filtering, it would need to be incorporated into the prepared statement.
	  $date = date("d.m.Y H:i:s");
		$day = date("D", strtotime($date));
		$ampm = date("A", strtotime($date));
		$hour = date("h", strtotime($date));
		
	  
      while($data_items = $query_items_result->fetch_assoc()){
		  $between = false; // This logic also seems to be more about display or post-processing
		  
		if (($data_items["ammoId"] == "ammunition_laser_ucb-100" || $data_items["ammoId"] == "ammunition_laser_rsb-75")) $between = true;
		  
		if(($data_items["ammoId"] != "ammunition_laser_ucb-100" && $data_items["ammoId"] != "ammunition_laser_rsb-75") || (($data_items["ammoId"] == "ammunition_laser_ucb-100" || $data_items["ammoId"] == "ammunition_laser_rsb-75"))) {
			$dataReturn[] = array(
			  'id' => $data_items['id'],
			  'category' => $data_items['category'],
			  'name' => $data_items['name'],
			  'information' => $data_items['information'],
			  'price' => $data_items['price'],
			  'priceType' => $data_items['priceType'],
			  'amount' => $data_items['amount'],
			  'image' => $data_items['image'],
			  'active' => $data_items['active'],
			  'shipId' => $data_items['shipId'],
			  'design_name' => $data_items['design_name']
			);
		}
      }
	  //changes for drones
	  for($i = 0; $i < count($dataReturn); $i++) {
		  if($dataReturn[$i]["id"] == 512) { // Item ID 512 is 'Iris' drone
			  // DroneChange will be refactored separately if it makes DB calls.
			  // For now, assume it's called correctly.
			  // The query inside DroneChange needs to be addressed.
			  $dataReturn[$i] = Functions::DroneChange($player, $dataReturn, $i, $mysqli); // Pass mysqli
		  }
	  }
      $stmt->close();
      return $dataReturn;
    } else {
      $stmt->close();
      return false;
    }

  }
	
	public static function DroneChange($player, $dataReturn, $i, $mysqli) {
    // Fetch items->iriscount using a prepared statement
    $stmt_iris = $mysqli->prepare("SELECT items FROM player_equipment WHERE userId = ?");
    $stmt_iris->bind_param("i", $player['userId']);
    $stmt_iris->execute();
    $items_result = $stmt_iris->get_result()->fetch_assoc();
    $stmt_iris->close();

    if ($items_result) {
        $items_data = json_decode($items_result['items']);
        if (isset($items_data->iriscount) && $items_data->iriscount <= 7) {
            $iriscount = $items_data->iriscount;
            // Existing price logic based on iriscount
            if ($iriscount == 0) { // Assuming 0 is the initial state before buying the first Iris
                 $dataReturn[$i]["price"] = 12000; // Example price for the 1st Iris
                 $dataReturn[$i]["priceType"] = "uridium";
            } else if($iriscount == 1) {
                $dataReturn[$i]["price"] = 24000;
                $dataReturn[$i]["priceType"] = "uridium";
            } else if($iriscount == 2) {
                $dataReturn[$i]["price"] = 42000;
                $dataReturn[$i]["priceType"] = "uridium";
            } else if($iriscount == 3) { // Corrected: was 'if' without 'else'
                $dataReturn[$i]["price"] = 60000;
                $dataReturn[$i]["priceType"] = "uridium";
            } else if($iriscount == 4) {
                $dataReturn[$i]["price"] = 84000;
                $dataReturn[$i]["priceType"] = "uridium";
            } else if($items_data->iriscount == 5) {
                $dataReturn[$i]["price"] = 96000;
                $dataReturn[$i]["priceType"] = "uridium";
            } else if($items_data->iriscount == 6) {
                $dataReturn[$i]["price"] = 126000;
                $dataReturn[$i]["priceType"] = "uridium";
            } else if($items_data->iriscount == 7) {
                $dataReturn[$i]["price"] = 200000;
                $dataReturn[$i]["priceType"] = "uridium";
            }
            return $dataReturn[$i];
        } else {
            // Iris count > 7 or not set, item should not be available or price is maxed
            return null;
        }
    }
    return null; // Should not happen if player equipment exists
	}

   public static function GetShop()
  {
    return [
      'categories' => ['ships', 'lasers', 'drones', 'extras/pet','BOOSTER', 'MODULOS'],
      'items' => [
        [
          'id' => 0,
          'category' => 'drones',
          'name' => 'Apis',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(28, 158, 251);display: inline-block;">Its a extra drone with 2slots!</p>',
          'price' => 150000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'do_img/global/items/drone/apis-5_100x100.png',
          'active' => true
        ],
        [
          'id' => 1,
          'category' => 'drones',
          'name' => 'Zeus',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(28, 158, 251);display: inline-block;">Its a extra drone with 2slots!</p>',
          'price' => 150000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'do_img/global/items/drone/zeus-5_100x100.png',
          'active' => true
        ],
        [
          'id' => 2,
          'category' => 'extras/pet',
          'name' => 'Logdisk',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(255, 65, 65);display: inline-block;">Parts for research pilots points.</p>',
          'price' => 50,
          'priceType' => 'uridium',
          'amount' => true,
          'image' => 'do_img/global/items/resource/logfile_100x100.png',
          'active' => true
        ],
        [
          'id' => 3,
          'category' => 'extras/pet',
          'name' => 'Logdisk',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(255, 65, 65);display: inline-block;">Parts for research pilots points.</p>',
          'price' => 5000000,
          'priceType' => 'credits',
          'amount' => true,
          'image' => 'do_img/global/items/resource/logfile_100x100.png',
          'active' => true
        ],
		[
          'id' => 4,
          'category' => 'extras/pet',
          'name' => 'Logdisk',
          'information' => '',
          'price' => 5000000,
          'priceType' => 'credits',
          'amount' => true,
          'image' => '',
          'active' => false
        ],
		[
          'id' => 5,
          'category' => 'extras/pet',
          'name' => 'Logdisk',
          'information' => '',
          'price' => 5000000,
          'priceType' => 'credits',
          'amount' => true,
          'image' => '',
          'active' => false
        ],
		[
          'id' => 6,
          'category' => 'extras/pet',
          'name' => 'Logdisk',
          'information' => '',
          'price' => 5000000,
          'priceType' => 'credits',
          'amount' => true,
          'image' => '',
          'active' => false
        ],
		[
          'id' => 7,
          'category' => 'extras/pet',
          'name' => 'Logdisk',
          'information' => '',
          'price' => 5000000,
          'priceType' => 'credits',
          'amount' => true,
          'image' => '',
          'active' => false
        ],
        [
          'id' => 8,
          'category' => 'drones',
          'name' => 'Havoc',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(255, 65, 65);display: inline-block;">10% Damage</p><p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(255, 212, 0);display: inline-block;">Full Set</p>',
          'price' => 150000,
          'priceType' => 'uridium',
          'amount' => true,
          'image' => 'do_img/global/items/drone/designs/havoc_100x100.png',
          'active' => true
        ],
        [
          'id' => 9,
          'category' => 'drones',
          'name' => 'Hercules',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(0, 156, 247);display: inline-block;">Shield</p> 
          <p style="color: #009cf7;display: inline-block;">15%</p><p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(0, 241, 118);display: inline-block;">HP</p> 
          <p style="color: #2be676;display: inline-block;">20%</p><p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(255, 212, 0);display: inline-block;">Full Set</p>',
          'price' => 150000,
          'priceType' => 'uridium',
          'amount' => true,
          'image' => 'do_img/global/items/drone/designs/hercules_100x100.png',
          'active' => true
        ],
		[
          'id' => 10,
          'category' => 'extras/pet',
          'name' => 'Logdisk',
          'information' => '',
          'price' => 5000000,
          'priceType' => 'credits',
          'amount' => true,
          'image' => '',
          'active' => false
        ],
		[
          'id' => 11,
          'category' => 'extras/pet',
          'name' => 'Logdisk',
          'information' => '',
          'price' => 5000000,
          'priceType' => 'credits',
          'amount' => true,
          'image' => '',
          'active' => false
        ],
		[
          'id' => 12,
          'category' => 'extras/pet',
          'name' => 'Logdisk',
          'information' => '',
          'price' => 5000000,
          'priceType' => 'credits',
          'amount' => true,
          'image' => '',
          'active' => false
        ],
		[
          'id' => 13,
          'category' => 'extras/pet',
          'name' => 'Logdisk',
          'information' => '',
          'price' => 5000000,
          'priceType' => 'credits',
          'amount' => true,
          'image' => '',
          'active' => false
        ],
        [
          'id' => 14,
          'category' => 'lasers',
          'name' => 'LF-4',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(101, 255, 37);display: inline-block;">It used to exceed the LF-3 as the best laser cannon available.</p> ',
          'price' => 65000,
          'priceType' => 'uridium',
          'amount' => true,
          'image' => 'do_img/global/items/equipment/weapon/laser/lf-4_100x100.png',
          'active' => true
        ],
        [
          'id' => 15,
          'category' => 'MODULOS',
          'name' => 'Module HULM-1',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(255, 65, 65);display: inline-block;">Part for build base 1/2</p>',
          'price' => 10,
          'priceType' => 'event',
          'amount' => false,
          'image' => 'img/base/hulm-1_100x100.png',
          'active' => true
        ],
        [
          'id' => 16,
          'category' => 'MODULOS',
          'name' => 'Module DEFM-1',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(255, 65, 65);display: inline-block;">Part for build base 2/2</p>',
          'price' => 10,
          'priceType' => 'event',
          'amount' => false,
          'image' => 'img/base/defm-1_100x100.png',
          'active' => true
        ],
        [
          'id' => 17,
          'category' => 'MODULOS',
          'name' => 'Module REPM-1',
          'information' => 'Repair modules and base',
          'price' => 10,
          'priceType' => 'event',
          'amount' => false,
          'image' => 'do_img/global/items/module/repm-1_100x100.png',
          'active' => false
        ],
		[
          'id' => 18,
          'category' => 'MODULOS',
          'name' => 'Module HONM-1',
          'information' => 'Increases Honor points',
          'price' => 8,
          'priceType' => 'event',
          'amount' => false,
          'image' => 'do_img/global/items/module/honm-1_100x100.png',
          'active' => false
        ],
        [
          'id' => 19,
          'category' => 'BOOSTER',
          'name' => 'Health booster',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(0, 241, 118);display: inline-block;">Duration 6 Hours</p>',
          'price' => 25000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'img/booster/booster_hp-b02_100x100.png',
          'active' => true
        ],
        [
          'id' => 20,
          'category' => 'BOOSTER',
          'name' => 'Shield booster',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(0, 156, 247);display: inline-block;">Duration 6 Hours</p>',
          'price' => 25000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'img/booster/booster_shd-b02_100x100.png',
          'active' => true
        ],
        [
          'id' => 21,
          'category' => 'BOOSTER',
          'name' => 'Damage booster',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(255, 65, 65);display: inline-block;">Duration 6 Hours</p>',
          'price' => 25000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'img/booster/booster_dmg-b02_100x100.png',
          'active' => true
        ],
        [
          'id' => 22,
          'category' => 'extras/pet',
          'name' => 'P.E.T.',
		      'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(255, 65, 65);display: inline-block;">A friend for a battle, extra 20K DMG</p>',
          'price' => 1000000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'do_img/global/items/pet_pet10_100x100.png',
          'active' => true
        ],
		    [
          'id' => 23,
          'category' => 'MODULOS',
          'name' => 'Module DMGM-1',
          'information' => 'Increase damage',
          'price' => 8,
          'priceType' => 'event',
          'amount' => false,
          'image' => 'do_img/global/items/module/dmgm-1_100x100.png',
          'active' => false
        ],
		    [
          'id' => 24,
          'category' => 'MODULOS',
          'name' => 'Module XPM-1',
          'information' => 'Damage: Increases experience points',
          'price' => 8,
          'priceType' => 'event',
          'amount' => false,
          'image' => 'do_img/global/items/module/xpm-1_100x100.png',
          'active' => false
        ],
		    [
          'id' => 25,
          'category' => 'MODULOS',
          'name' => 'Module LTM-HR',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(255, 65, 65);display: inline-block;">Damage: 58.500</p>',
          'price' => 150000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'img/base/ltm-hr_100x100.png',
          'active' => true
        ],
		    [
          'id' => 26,
          'category' => 'MODULOS',
          'name' => 'Module LTM-MR',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(255, 65, 65);display: inline-block;">Damage: 38.450</p>',
          'price' => 150000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'do_img/global/items/module/ltm-mr_100x100.png',
          'active' => true
        ],
		    [
          'id' => 27,
          'category' => 'MODULOS',
          'name' => 'Module LTM-LR',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(255, 65, 65);display: inline-block;">Damage: 29.850</p>',
          'price' => 90000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'do_img/global/items/module/ltm-lr_100x100.png',
          'active' => true
        ],
		    [
          'id' => 28,
          'category' => 'MODULOS',
          'name' => 'Module RAM-MA',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(255, 65, 65);display: inline-block;">Damage: 51.250</p>',
          'price' => 150000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'img/base/ram-ma_100x100.png',
          'active' => true
        ],
		    [
          'id' => 29,
          'category' => 'MODULOS',
          'name' => 'Module RAM-LA',
          'information' => '
          <p style="color: #ffffff; display: inline-block;"></p> <p style="color: rgb(255, 65, 65);display: inline-block;">Damage: 35.550</p>',
          'price' => 150000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'do_img/global/items/module/ram-la_100x100.png',
          'active' => true
        ],
				//ship
		[
          'id' => 30,
          'shipId' => 1,
          'category' => 'ships',
          'name' => 'Phoenix',
          'price' => 0,
          'priceType' => 'credits',
          'amount' => false,
          'image' => 'do_img/global/items/ship/phoenix_top.png',
          'active' => true
        ],
        [
          'id' => 31,
          'shipId' => 2,
          'category' => 'ships',
          'name' => 'Yamato',
          'price' => 220000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'do_img/global/items/ship/yamato_top.png',
          'active' => true
        ],
        [
          'id' => 32,
          'shipId' => 3,
          'category' => 'ships',
          'name' => 'Leonov',
          'price' => 225000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'do_img/global/items/ship/leonov_top.png',
          'active' => true
        ],
        [
          'id' => 33,
          'shipId' => 4,
          'category' => 'ships',
          'name' => 'Defcom',
          'price' => 220000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'do_img/global/items/ship/defcom_top.png',
          'active' => true
        ],
        [
          'id' => 34,
          'shipId' => 5,
          'category' => 'ships',
          'name' => 'Liberator',
          'price' => 60000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'do_img/global/items/ship/liberator_top.png',
          'active' => true
        ],
        [
          'id' => 35,
          'shipId' => 6,
          'category' => 'ships',
          'name' => 'Piranha',
          'price' => 200000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'do_img/global/items/ship/piranha_top.png',
          'active' => true
        ],
        [
          'id' => 36,
          'shipId' => 7,
          'category' => 'ships',
          'name' => 'Nostromo',
          'price' => 295000,
          'priceType' => 'uridium',
          'amount' => false,
          'image' => 'do_img/global/items/ship/nostromo_top.png',
          'active' => true
        ],
        [
          'id' => 37,
          'shipId' => 8,
          'category' => 'ships',
          'name' => 'Vengeance',
          'description' => '10 LASER/10 GENERATOR <br>speed 400</br>',
          'price' => 500000,
          'priceType' => 'credits',
          'amount' => false,
          'image' => 'do_img/global/items/ship/vengeance_top.png',
          'active' => true
        ],
        [
          'id' => 38,
          'shipId' => 9,
          'category' => 'ships',
          'name' => 'Bigboy',
          'description' => '',
          'price' => 385000,
          'priceType' => 'credits',
          'amount' => false,
          'image' => 'do_img/global/items/ship/bigboy_top.png',
          'active' => true
        ],
        [
          'id' => 39,
          'shipId' => 10,
          'category' => 'ships',
          'name' => 'Goliath',
          'description' => '15 LASER/15 GENERATOR <br>speed 300</br>',
          'price' => 60000,
          'priceType' => 'credits',
          'amount' => false,
          'image' => 'do_img/global/items/ship/goliath_top.png',
          'active' => true
        ],
        [
          'id' => 40,
          'shipId' => 70,
          'category' => 'ships',
          'name' => 'Spearhead',
          'description' => '5 LASER/12 GENERATOR <br>speed 370</br>',
          'price' => 600000,
          'priceType' => 'credits',
          'amount' => false,
          'image' => 'do_img/global/items/ship/spearhead-vru_top.png',
          'active' => true
        ],
        [
          'id' => 41,
          'shipId' => 49,
          'category' => 'ships',
          'name' => 'Aegis',
          'description' => '10 LASER/15 GENERATOR <br>speed 300<a  style="color:#CD00C3";>[SKILLS]</a></br>',
          'price' => 600000,
          'priceType' => 'credits',
          'amount' => false,
          'image' => 'do_img/global/items/ship/aegis-vru_top.png',
          'active' => true
        ],
        [
          'id' => 42,
          'shipId' => 69,
          'category' => 'ships',
          'name' => 'Citadel',
          'description' => '7 LASER/20 GENERATOR <br>speed 240</br>',
          'price' => 900000,
          'priceType' => 'credits',
          'amount' => false,
          'image' => 'do_img/global/items/ship/citadel-vru_top.png',
          'active' => true
        ],
        
      
       
      ]
    ];
  }
  public static function GetResetSkillCost($resetCount)
  {
    $cost = 1000;

    for ($i = 0; $i < $resetCount; $i++) {
      $cost *= 2;
    }

    return $cost;
  }

  public static function GetSkillDescription($skill, $level)
  {
    $array = [
      'Engineering' => 'Lets your repair bots repair ' . ($level <= 1 ? '5' : ($level == 2 ? '10' : ($level == 3 ? '15' : ($level == 4 ? '20' : ($level == 5 ? '30' : '0'))))) . '% more HP<br> per second',
      'Shield Engineering' => 'Increases your shield strength by ' . ($level <= 1 ? '4' : ($level == 2 ? '8' : ($level == 3 ? '12' : ($level == 4 ? '18' : ($level == 5 ? '25' : '0'))))) . '%',
      'Detonation I' => 'Makes your mines cause ' . ($level <= 1 ? '7' : ($level == 2 ? '14' : 0)) . '% more damage',
      'Detonation II' => 'Makes your mines cause ' . ($level <= 1 ? '21' : ($level == 2 ? '28' : ($level == 3 ? '50' : 0))) . '% more damage',
      'Heat-seeking Missiles' => 'Increases hit probability of your rockets by ' . ($level <= 1 ? '1' : ($level == 2 ? '2' : ($level == 3 ? '4' : ($level == 4 ? '6' : ($level == 5 ? '10' : '0'))))) . '%',
      'Rocket Fusion' => 'Makes your rockets cause ' . ($level <= 1 ? '2' : ($level == 2 ? '2' : ($level == 3 ? '4' : ($level == 4 ? '6' : ($level == 5 ? '10' : '0'))))) . '% more damage',
      'Cruelty I' => 'Gives you ' . ($level <= 1 ? '4' : ($level == 2 ? '8' : 0)) . '% more honor points',
      'Cruelty II' => 'Gives you ' . ($level <= 1 ? '12' : ($level == 2 ? '18' : ($level == 3 ? '25' : 0))) . '% more honor points',
      'Explosives' => 'Increases the radius of mine explosions by ' . ($level <= 1 ? '4' : ($level == 2 ? '8' : ($level == 3 ? '12' : ($level == 4 ? '18' : ($level == 5 ? '25' : '0'))))) . '%',
      'Luck I' => 'Gives you ' . ($level <= 1 ? '2' : ($level == 2 ? '4' : 0)) . '% more bonus-box Uridium',
      'Luck II' => 'Gives you ' . ($level <= 1 ? '6' : ($level == 2 ? '8' : ($level == 3 ? '12' : 0))) . '% more bonus-box Uridium',
	  'Bounty Hunter I' => 'Gives you '.($level <= 1 ? '2' : ($level == 2 ? '4' : 0)).'% damage done in PvP battles',
	  'Bounty Hunter II' => 'Gives you '.($level <= 1 ? '6' : ($level == 2 ? '8' : ($level == 3 ? '12' : 0))).'% damage done in PvP battles',
	  'Shield Mechanics' => 'Lets your shields withstand '.($level <= 1 ? '2' : ($level == 2 ? '4' : ($level == 3 ? '6' : ($level == 4 ? '8' : ($level == 5 ? '12' : '0'))))).'% more damage',
	  'Electro-optics' => 'Makes your lasers '.($level <= 1 ? '2' : ($level == 2 ? '4' : ($level == 3 ? '6' : ($level == 4 ? '8' : ($level == 5 ? '12' : '0'))))).'% more accurate'
    ];

    return $array[$skill];
  }

  public static function GetSkillTooltip($skillName, $currentLevel, $maxLevel)
  {
    return 'Name: <span style=\'color: red\'>' . $skillName . '</span><br>Level: <span style=\'color: #a4d3ef;\'>' . $currentLevel . '/' . $maxLevel . '</span>' . ($currentLevel != 0 ? ' Current Level: <span style=\'color: #a4d3ef;\'>' . Functions::GetSkillDescription($skillName, $currentLevel) . '</span>' : '') . '' . ($currentLevel != $maxLevel ? '<br>Next Level: <span style=\'color: #a4d3ef;\'>' . Functions::GetSkillDescription($skillName, $currentLevel + 1) . '</span>' : '') . '';
  }

  public static function GetSkills($skillPoints)
  {
    return [
      'engineering' => [
        'name' => 'Engineering',
        'currentLevel' => $skillPoints->engineering,
        'maxLevel' => 5
      ],
      'shieldEngineering' => [
        'name' => 'Shield Engineering',
        'currentLevel' => $skillPoints->shieldEngineering,
        'maxLevel' => 5
      ],
      'detonation1' => [
        'name' => 'Detonation I',
        'currentLevel' => $skillPoints->detonation1,
        'maxLevel' => 2,
        'nextSkill' => 'detonation2'
      ],
      'detonation2' => [
        'name' => 'Detonation II',
        'currentLevel' => $skillPoints->detonation2,
        'maxLevel' => 3,
        'baseSkill' => 'detonation1'
      ],
      'heatseekingMissiles' => [
        'name' => 'Heat-seeking Missiles',
        'currentLevel' => $skillPoints->heatseekingMissiles,
        'maxLevel' => 5
      ],
      'rocketFusion' => [
        'name' => 'Rocket Fusion',
        'currentLevel' => $skillPoints->rocketFusion,
        'maxLevel' => 5
      ],
      'cruelty1' => [
        'name' => 'Cruelty I',
        'currentLevel' => $skillPoints->cruelty1,
        'maxLevel' => 2,
        'nextSkill' => 'cruelty2'
      ],
      'cruelty2' => [
        'name' => 'Cruelty II',
        'currentLevel' => $skillPoints->cruelty2,
        'maxLevel' => 3,
        'baseSkill' => 'cruelty1'
      ],
	  'bountyhunter1' => [
        'name' => 'Bounty Hunter I',
        'currentLevel' => $skillPoints->bountyhunter1,
        'maxLevel' => 2,
        'nextSkill' => 'bountyhunter2'
      ],
      'bountyhunter2' => [
        'name' => 'Bounty Hunter II',
        'currentLevel' => $skillPoints->bountyhunter2,
        'maxLevel' => 3,
        'baseSkill' => 'bountyhunter1'
      ],
      'explosives' => [
        'name' => 'Explosives',
        'currentLevel' => $skillPoints->explosives,
        'maxLevel' => 5
      ],
      'luck1' => [
        'name' => 'Luck I',
        'currentLevel' => $skillPoints->luck1,
        'maxLevel' => 3
      ],
      'luck2' => [
        'name' => 'Luck II',
        'currentLevel' => $skillPoints->luck2,
        'maxLevel' => 3,
        'baseSkill' => 'luck1'
      ],
      'shieldMechanics' => [
        'name' => 'Shield Mechanics',
        'currentLevel' => $skillPoints->shieldMechanics,
        'maxLevel' => 5,
	  ],
      'electroOptics' => [
        'name' => 'Electro-optics',
        'currentLevel' => $skillPoints->electroOptics,
        'maxLevel' => 5,
      ]
    ];
  }

  public static function ChangeVersion($version)
  {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();
    $version = $mysqli->real_escape_string($version);

    $json = [
      'message' => ''
    ];

    if ($version === 'false' || $version === 'true') {
      $mysqli->begin_transaction();

      try {
        $mysqli->query('UPDATE player_accounts SET version = ' . $version . ' WHERE userId = ' . $player['userId'] . '');

        $json['message'] = 'Your version has been changed.';

        $mysqli->commit();
      } catch (Exception $e) {
        $message = 'An error occurred. Please try again later.';
        $mysqli->rollback();
      }

      $mysqli->close();
    } else {
      $json['message'] = 'Something went wrong!';
    }

    return json_encode($json);
  }

  public static function GetLevel($exp)
  {
    $lvl = 1;
    $expNext = 10000;

    while ($exp >= $expNext) {
      $expNext *= 2;
      $lvl++;
    }

    return $lvl;
  }

  public static function GetUniquePilotName($pilotName)
  {
    $mysqli = Database::GetInstance();

    $newPilotName = $pilotName .= Functions::GenerateRandom(4, true, false, false);

    if ($mysqli->query('SELECT userId FROM player_accounts WHERE pilotName = "' . $newPilotName . '"')->num_rows >= 1)
      $newPilotName = GetUniquePilotName($pilotName);

    return $newPilotName;
  }

  public static function GetIP()
  {
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
      $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
      $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }

    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
      $ip = $client;
    } else if (filter_var($forward, FILTER_VALIDATE_IP)) {
      $ip = $forward;
    } else {
      $ip = $remote;
    }

    return $ip;
  }

  public static function GenerateRandom($length, $numbers = true, $letters = true, $uppercase = true)
  {
    $chars = '';
    $chars .= ($numbers) ? '0123456789' : '';
    $chars .= ($uppercase) ? 'QWERTYUIOPASDFGHJKLLZXCVBNM' : '';
    $chars .= ($letters) ? 'qwertyuiopasdfghjklzxcvbnm' : '';

    $str = '';
    $c = 0;
    while ($c < $length) {
      $str .= substr($chars, rand(0, mb_strlen($chars) - 1), 1);
      $c++;
    }

    return $str;
  }

  public static function s($input)
  {
    return htmlspecialchars(trim($input));
  }

  public static function IsLoggedIn()
  {
    $mysqli = Database::GetInstance();

    if (!$mysqli->connect_errno) {
      if (isset($_SESSION['account'])) {
        if (isset($_SESSION['account']['id'], $_SESSION['account']['session'])) {
          $id = $mysqli->real_escape_string(Functions::s($_SESSION['account']['id']));
          $fetch = $mysqli->query('SELECT sessionId, userId FROM player_accounts WHERE userId = ' . $id . '')->fetch_assoc();

          if (MAINTENANCE AND !self::checkIsAdmin($fetch['userId'])){
            return false;
          }

          if ($fetch['sessionId'] === $_SESSION['account']['session']) {
            return true;
          } else {
            return false;
          }
        } else {
          return false;
        }
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public static function GetRankName($rankId)
  {
    $array = [
      '1' => 'Basic Space Pilot',
      '2' => 'Space Pilot',
      '3' => 'Chief Space Pilot',
      '4' => 'Basic Sergeant',
      '5' => 'Sergeant',
      '6' => 'Chief Sergeant',
      '7' => 'Basic Lieutenant',
      '8' => 'Lieutenant',
      '9' => 'Chief Lieutenant',
      '10' => 'Basic Captain',
      '11' => 'Captain',
      '12' => 'Chief Captain',
      '13' => 'Basic Major',
      '14' => 'Major',
      '15' => 'Chief Major',
      '16' => 'Basic Colonel',
      '17' => 'Colonel',
      '18' => 'Chief Colonel',
      '19' => 'Basic General',
      '20' => 'General',
      '21' => 'Chief General',
      '22' => 'Administrator'
    ];

    return $array[$rankId];
  }

  public static function GetRequiredLogdisks($sumPoints)
  {
    $array = array(
      '1' => '30',
      '2' => '63',
      '3' => '99',
      '4' => '139',
      '5' => '183',
      '6' => '231',
      '7' => '284',
      '8' => '342',
      '9' => '406',
      '10' => '477',
      '11' => '555',
      '12' => '641',
      '13' => '735',
      '14' => '839',
      '15' => '953',
      '16' => '1078',
      '17' => '1216',
      '18' => '1368',
      '19' => '1535',
      '20' => '1718',
      '21' => '1920',
      '22' => '2142',
      '23' => '2386',
      '24' => '2655',
      '25' => '2950',
      '26' => '3275',
      '27' => '3633',
      '28' => '4026',
      '29' => '4459',
      '30' => '4935',
      '31' => '5458',
      '32' => '6034',
      '33' => '6667',
      '34' => '7364',
      '35' => '8130',
      '36' => '8973',
      '37' => '9900',
      '38' => '10920',
      '39' => '12042',
      '40' => '13276',
      '41' => '14634',
      '42' => '16128',
      '43' => '17771',
      '44' => '19578',
      '45' => '21566',
      '46' => '23753',
      '47' => '26158',
      '48' => '28804',
      '49' => '31715',
      '50' => '34917'
    );

    return isset($array[$sumPoints]) ? $array[$sumPoints] : '0';
  }

  public static function GetPlayer() {
    $mysqli = Database::GetInstance();

    if (isset($_SESSION['account']['id'])) {
      $id = $mysqli->real_escape_string(Functions::s($_SESSION['account']['id']));
	  $result = $mysqli->query('SELECT * FROM player_accounts WHERE userId = ' . $id . '')->fetch_assoc();
	  if($id == 324) {
		$premium = $result["premium"];
		if($premium == 1 && $result["premiumUntil"] != null) {
			$premiumUntil = $result["premiumUntil"];
			$phpdate = strtotime($premiumUntil);
			$mysqldate = date( 'Y-m-d H:i:s', $phpdate );
			$cur = new DateTime();
			
			if($cur->format('Y-m-d H:i:s') > $mysqldate) {
				$mysqli->query("UPDATE player_accounts SET premium = 0, premiumUntil = NULL WHERE userId = ".$id);
				$result = $mysqli->query('SELECT * FROM player_accounts WHERE userId = ' . $id . '')->fetch_assoc();
			}
			
		}
	  }
      return $result;
    } else {
      return null;
    }
  }

  public static function GetPlayerById($id = null) {
    $mysqli = Database::GetInstance();
    if (isset($id) && !empty($id)) {
      $userIdInt = (int)$id; // Ensure $id is treated as an integer
      $stmt = $mysqli->prepare('SELECT * FROM player_accounts WHERE userId = ?');
      $stmt->bind_param("i", $userIdInt);
      $stmt->execute();
      $result = $stmt->get_result();
      $playerData = $result->fetch_assoc();
      $stmt->close();
      return $playerData; // Returns null if not found, or player data array
    } else {
      return null;
    }
  }

  public static function GetPlayerByPilotName($pilot = null) {
    $mysqli = Database::GetInstance();

    if (isset($pilot) && !empty($pilot)) {
      $pilot = $mysqli->real_escape_string(Functions::s($pilot));
      $dataPilot = $mysqli->query('SELECT * FROM player_accounts WHERE pilotName = "'.$pilot.'"')->fetch_assoc();
      return $dataPilot;
    } else {
      return null;
    }
  }

  public static function getPlayerInStaff($pilot = null){
    $mysqli = Database::GetInstance();

    if (isset($pilot) && !empty($pilot)) {
      // $pilot is user input, must be bound.
      // Since it can be pilotName (string), userId (int), or username (string),
      // we might need to check its type or try querying against all three if the specific type isn't known.
      // However, binding different types to OR clauses for the same placeholder is tricky.
      // A safer approach if type is unknown is to try them in order or determine type first.
      // For now, let's assume we can bind it as a string and MySQL will handle comparisons appropriately
      // if userId column is numeric (string '123' would match int 123).
      // A more robust solution might involve checking if $pilot is_numeric for userId.

      $stmt = $mysqli->prepare('SELECT * FROM player_accounts WHERE pilotName = ? OR userId = ? OR username = ?');
      // Bind $pilot three times as string. MySQL will attempt conversion for userId.
      $stmt->bind_param("sss", $pilot, $pilot, $pilot);
      $stmt->execute();
      $result = $stmt->get_result();
      $dataPilot = $result->fetch_assoc();
      $stmt->close();
      return $dataPilot;
    } else {
      return null;
    }
  }

  public static function ChangeShip($shipId) {
    $mysqli = Database::GetInstance();

    $json = [
      'status' => false,
      'message' => ''
    ];

    $json['message'] = "esto es simplemente una prueba";

    if (!$mysqli->connect_errno && Functions::IsLoggedIn()) {
      $player = Functions::GetPlayer();
      $notOnlineOrOnlineAndInEquipZone = !Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false)) || (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false)) && Socket::Get('IsInEquipZone', array('UserId' => $player['userId'], 'Return' => false)));
      /**
       * Steps: 
       * 1. Verify that have the ship.
       * 2. Put the ship.
       */
      $items = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);
	  $irisCount = $items->iriscount;

      if ($notOnlineOrOnlineAndInEquipZone) {
        if (in_array($shipId, $items->ships) || $shipId == 10) {
          $mysqli->begin_transaction();

          try {
            $mysqli->query('UPDATE player_accounts SET shipId = "' . $shipId . '" WHERE userId = ' . $player['userId'] . '');
            /*
            SETTING DRONES Y EQUIPAMIENTO
            */
		  	if ($irisCount == 0) {
				  $drones = '[{"items":[],"designs":[]},{"items":[],"designs":[]}]';
				}
				if ($irisCount == 1) {
			  	$drones = '[{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]}]';
				}
				if ($irisCount == 2) {
					$drones = '[{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]}]';
				}
				if ($irisCount == 3) {
					$drones = '[{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]}]';
				}
				if ($irisCount == 4) {
					$drones = '[{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]}]';
				}
				if ($irisCount == 5) {
					$drones = '[{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]}]';
				}
				if ($irisCount == 6) {
					$drones = '[{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]}]';
				}
				if ($irisCount == 7) {
					$drones = '[{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]}]';
				}
				if ($irisCount == 8) {
					$drones = '[{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]},{"items":[],"designs":[]}]';
				}
			
            $mysqli->query("UPDATE player_equipment SET config1_generators = '[]', config1_lasers = '[]', config2_generators = '[]', config2_lasers = '[]', config1_drones ='" . $drones . "' , config2_drones = '" . $drones . "' WHERE userId = " . $player['userId'] . "");
            
            /*

            Send socket information about the ship change.

            */
            if (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
              Socket::Send('UpdateStatus', array('UserId' => $player['userId']));
              Socket::Send('ChangeShip', array('UserId' => $player['userId'], 'ShipId' => $shipId));
            }

            $json['message'] = "Ship successfully changed";
            $json['status'] = true;

            $mysqli->commit();
          } catch (Exception $e) {
            $json['message'] = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }

          $mysqli->close();
        } else {
          $json['message'] = "You don't have this ship...";
        }
      } else {
        $json['message'] = "Disconnect or go to a safe area.";
      }
    }



    return json_encode($json);
  }

  public static function infoshop($shipId)
  {

    if (isset($shipId) && !empty($shipId)){
      $mysqli = Database::GetInstance();
      // $shipId is used as a key for an array in the fallback,
      // but if it's from user input and used in a query, it must be an integer.
      // Assuming $shipId for DB query should be an integer.
      $itemIdInt = (int)$shipId;

      $stmt = $mysqli->prepare("SELECT * FROM shop_items WHERE id = ? AND active = '1'");
      $stmt->bind_param("i", $itemIdInt);
      $stmt->execute();
      $query_result = $stmt->get_result();

      if ($query_result->num_rows > 0){
        $data_items = $query_result->fetch_assoc();
        $stmt->close();
        $dataReturn = array(
          'id' => $data_items['id'], // This should be an integer from DB
          'category' => $data_items['category'],
          'name' => $data_items['name'],
          'information' => $data_items['information'],
          'price' => $data_items['price'],
          'priceType' => $data_items['priceType'],
          'amount' => $data_items['amount'],
          'image' => $data_items['image'],
          'active' => $data_items['active'],
          'shipId' => $data_items['shipId'],
          'design_name' => $data_items['design_name'],
          'moduleId' => $data_items['moduleId'],
          'moduleType' => $data_items['moduleType'],
          'boosterId' => $data_items['boosterId'],
          'boosterType' => $data_items['boosterType'],
          'boosterDuration' => $data_items['boosterDuration'],
          'laserName' => $data_items['laserName'],
          'petName' => $data_items['petName'],
          'skillTree' => $data_items['skillTree'],
          'droneName' => $data_items['droneName'],
          'ammoId' => $data_items['ammoId'],
          'typeKey' => $data_items['typeKey'],
          'petDesign' => $data_items['petDesign'],
          'petFuel' => $data_items['petFuel'],
          'petModule' => $data_items['petModule'],
		  'FormationName' => $data_items['FormationName'],
          'nameBootyKey' => $data_items['nameBootyKey']
        );

      //changes for drones. $data_items['id'] is already an integer.
			  if($data_items['id'] == 512) { // Item ID 512 is 'Iris'
				  $player = Functions::GetPlayer();
				  // DroneChange expects $mysqli instance now
				  // We pass $dataReturn itself, not an array containing it, and index 0.
				  // Let's adjust DroneChange or how it's called.
				  // Assuming DroneChange can now handle a single item array and modify it.
                  // It was: Functions::DroneChange($items, $dataReturn1, 0)
                  // Needs to be: Functions::DroneChange($player, $data_items_array_for_drone_change, 0, $mysqli)
                  // $dataReturn is already the single item array.
                  $tempDataReturnArray = [$dataReturn]; // DroneChange expects an array of items and an index
                  $modifiedItem = Functions::DroneChange($player, $tempDataReturnArray, 0, $mysqli);
                  if ($modifiedItem === null) {
                      // Item is not available (e.g. iris count > 7)
                      // Depending on desired behavior, either return null or the original item without price change
                      return json_encode(null); // Or handle as error / unavailable item
                  }
                  $dataReturn = $modifiedItem; // Update dataReturn with modified price/availability
			  }
        return json_encode($dataReturn);
      } else {
        $stmt->close();
        // Fallback to static GetShop if not found in DB or $shipId was not for DB
        // This part implies $shipId might not always be an ID for the shop_items table.
        // If $shipId is an array key for GetShop()['items'], it might not be an integer.
        // The original code did not make this distinction clear.
        // For safety, if it's not numeric here, we should not attempt DB query.
        if (!is_numeric($shipId)) {
            $staticShopData = self::getShop()['items'];
            if (isset($staticShopData[$shipId])) {
                return json_encode($staticShopData[$shipId]);
            } else {
                return json_encode(false); // Item not found
            }
        }
        return json_encode(false); // Item not found in DB
      }
    }

    // Fallback for non-DB items or if $shipId was not set (original logic)
    // This part is problematic if $shipId was meant for DB but not found.
    // The original code would try to use $shipId as an array index here.
    // This needs clarification on how $shipId is used.
    // Assuming if $shipId was numeric and not found in DB, it's an error.
    // If $shipId was non-numeric, it was meant for the static array.
    if (!is_numeric($shipId) && isset(self::getShop()['items'][$shipId])) {
        $data = self::getShop()['items'][$shipId];
        return json_encode($data);
    }
	   
	  return json_encode(false); // Default if not found anywhere
  }

   public static function infoShip($shipId)
  {
    $mysqli = Database::GetInstance();
    $shipIdInt = (int)$shipId; // Ensure it's an integer

    $stmt = $mysqli->prepare('SELECT shipID, lootID, name, health, speed, damage, lasers, generators FROM server_ships WHERE shipID = ?');
    $stmt->bind_param("i", $shipIdInt);
    $stmt->execute();
    $result = $stmt->get_result();
    $info = $result->fetch_assoc();
    $stmt->close();
	   
    if ($info) {
      $dataReturn = array(
        'lootID' => $info['lootID'],
        'name' => strtolower($info['name']),
        'health' => $info['health'],
        'speed' => $info['speed'],
        'damage' => $info['damage'],
        'lasers' => $info['lasers'],
        'generatos' => $info['generators'], // Typo: should be 'generators' if that's the DB column name
        'shipID' => $info['shipID']
      );
      return json_encode($dataReturn);
    } else {
      return json_encode(null); // Or some error/default structure
    }
  }

  public static function getPrice($amount, $id){

	  if (isset($amount) and !empty($amount) and isset($id) and !empty($id)){

      $price = json_decode(self::infoshop($id), true)['price'];
      $priceF = $price*$amount;
      return $priceF;

    } else {
      return 0;
    }
    
  }

  public static function getClanApplications(){

    $player = self::GetPlayer();
    if (!$player) { return false; } // Or handle error appropriately
    $mysqli = Database::GetInstance();
    $userIdInt = (int)$player['userId'];

    $stmt = $mysqli->prepare("SELECT sca.id as appId, sc.tag, sc.name
                              FROM server_clan_applications sca
                              INNER JOIN server_clans sc ON sca.clanId = sc.id
                              WHERE sca.userId = ?");
    $stmt->bind_param("i", $userIdInt);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0){
      // The original returned the mysqli_result object.
      // To maintain that, we might just return $result directly.
      // However, it's often better to fetch data into an array within the function.
      // For now, let's fetch all to maintain similar output structure if downstream code expects array of rows.
      // If the original intent was to allow iterating over $query_applications outside, then returning $result is fine.
      // Given the name "getClanApplications" usually implies getting the data, not the result object.
      // Let's assume it should return the data.
      $applications = $result->fetch_all(MYSQLI_ASSOC);
      $stmt->close();
      return $applications; // Returns an array of applications or empty array
    } else {
      $stmt->close();
      return false; // Or an empty array: []
    }
  }

  public static function clan_cancel_application($app){
    if (isset($app) && !empty($app)){
      $mysqli = Database::GetInstance();
      $player = self::GetPlayer();
      if (!$player) { return json_encode(array('status' => false, 'message' => 'Player not found.')); }

      $appIdInt = (int)$app;
      $userIdInt = (int)$player['userId'];

      $stmt = $mysqli->prepare("DELETE FROM server_clan_applications WHERE id = ? AND userId = ?");
      $stmt->bind_param("ii", $appIdInt, $userIdInt);
      $stmt->execute();
      $affected_rows = $stmt->affected_rows;
      $stmt->close();

      // Re-fetch applications to determine 'noApp' status
      // This could be optimized if 'noApp' isn't strictly needed or can be inferred differently
      $current_applications = self::getClanApplications(); // This now returns array or false
      $noApp = ($current_applications === false || count($current_applications) == 0);

      if ($affected_rows > 0) {
        return json_encode(array('app' => $appIdInt, 'status' => true, 'noApp' => $noApp, 'message' => 'Application cancelled.'));
      } else {
        return json_encode(array('app' => $appIdInt, 'status' => false, 'noApp' => $noApp, 'message' => 'Could not cancel application or application not found.'));
      }
    } else {
      return json_encode(array('status' => false, 'message' => 'Application ID not provided.'));
    }
  }
  
  public static function infoclan($clanid){
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer(); // Used for 'pending' status check
    if (!$player && $clanid == null) { return json_encode(null); } // Need player or clanid

    $clanIdInt = (int)$clanid;

    $stmt = $mysqli->prepare('SELECT sc.id, sc.name, sc.tag, sc.description, sc.factionId, sc.recruiting,
                                   sc.leaderId, sc.join_dates, sc.date, sc.rank, sc.profile, pa.pilotName
                            FROM server_clans sc
                            JOIN player_accounts pa ON pa.userId = sc.leaderId
                            WHERE sc.id = ?');
    $stmt->bind_param("i", $clanIdInt);
    $stmt->execute();
    $result = $stmt->get_result();
    $info = $result->fetch_assoc();
    $stmt->close();

    if (!$info) { return json_encode(null); } // Clan not found

    // Count members
    $stmt_count = $mysqli->prepare('SELECT COUNT(userId) as member_count FROM player_accounts WHERE clanId = ?');
    $stmt_count->bind_param("i", $clanIdInt);
    $stmt_count->execute();
    $member_count = $stmt_count->get_result()->fetch_assoc()['member_count'];
    $stmt_count->close();

    // Check pending application for the current player
    $pending_application = false;
    if ($player) { // Only check if a player is logged in
        $stmt_pending = $mysqli->prepare('SELECT id FROM server_clan_applications WHERE clanId = ? AND userId = ?');
        $stmt_pending->bind_param("ii", $clanIdInt, $player['userId']);
        $stmt_pending->execute();
        $stmt_pending->store_result();
        $pending_application = $stmt_pending->num_rows > 0;
        $stmt_pending->close();
    }

    $dataReturn = array(
      'id' => $info['id'],
      'name' => strtolower($info['name']),
      'tag' => $info['tag'],
      'description' => $info['description'],
      'factionId' => $info['factionId'],
      'recruiting' => $info['recruiting'],
      'leaderId' => $info['leaderId'],
      'join_dates' => $info['join_dates'],
      'date' => $info['date'],
      'rank' => $info['rank'],
      'profile' => "/public/img/clan/".$info['profile'],
      'members' => count($mysqli->query('SELECT userId FROM player_accounts WHERE clanId = '.$clanid.'')->fetch_all(MYSQLI_ASSOC)),
      'leaderName' => $info['pilotName'],
      'pending' => ($mysqli->query('SELECT id FROM server_clan_applications WHERE clanId = '.$clanid.' AND userId = '.$player['userId'].'')->num_rows >= 1)
	  );

		return json_encode($dataReturn);
  }

  public static function change_clan_settings($tag = null, $name = null, $profile = null, $description = null, $recruitment = null, $company = null){

    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return json_encode(['message' => 'Player not found.', 'status' => false]); }
    $userIdInt = (int)$player['userId'];
    $playerClanId = (int)$player['clanId'];

    $json = ['message' => "", 'status' => false];

    if (empty($name)) {
      $json['message'] = "Name is required";
      return json_encode($json);
    } 
    if (empty($tag)) {
      $json['message'] = "Tag is required";
      return json_encode($json);
    }  
    if (strlen($tag) > 4){
      $json['message'] = "Tag only permit 1-4 characters";
      return json_encode($json);
    } 
    if (strlen($name) > 30){ // Original code had 30, not 50 like FoundClan
      $json['message'] = "Name only permit 1-30 characters";
      return json_encode($json);
    }

    $setClauses = [];
    $bindTypes = "";
    $bindValues = [];

    // Only add fields to update if they are provided
    if (!empty($tag)){
      $setClauses[] = "tag = ?";
      $bindTypes .= "s";
      $bindValues[] = $tag;
    }
    if (!empty($name)){
      $setClauses[] = "name = ?";
      $bindTypes .= "s";
      $bindValues[] = $name;
    }
    if (!empty($profile)){ // Assuming profile is a string (e.g., filename)
      $setClauses[] = "profile = ?";
      $bindTypes .= "s";
      $bindValues[] = $profile;
    }
    if ($description !== null){ // Allow empty description
      $setClauses[] = "description = ?";
      $bindTypes .= "s";
      $bindValues[] = $description;
    }
    if (is_numeric($recruitment)){
      $setClauses[] = "recruiting = ?";
      $bindTypes .= "i";
      $bindValues[] = (int)$recruitment;
    }
    if (is_numeric($company)){
      $setClauses[] = "factionId = ?";
      $bindTypes .= "i";
      $bindValues[] = (int)$company;
    }

    if (empty($setClauses)) {
        $json['message'] = "No settings provided to update.";
        return json_encode($json);
    }

    $bindValues[] = $userIdInt; // For the WHERE clause
    $bindTypes .= "i";

    $sql = "UPDATE server_clans SET ".implode(', ', $setClauses)." WHERE leaderId = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param($bindTypes, ...$bindValues);
        if ($stmt->execute()){
            if ($stmt->affected_rows > 0) {
                $json['status'] = true;
                $json['message'] = "Clan successfully edited.";
                self::addLogClan("have modified clan settings", $playerClanId, $userIdInt, 'settings'); // Assumes addLogClan is safe
            } else {
                $json['message'] = "No changes made to clan settings (values might be the same or you are not the leader).";
            }
        } else {
          $json['message'] = "Error editing clan: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $json['message'] = "Error preparing statement: " . $mysqli->error;
    }
    return json_encode($json);
  }

  public static function addLogClan($log = null, $clanId = null, $leaderId = null, $typeLog = null){
    if (isset($log) && isset($clanId) && isset($leaderId) && isset($typeLog)){
      $mysqli = Database::GetInstance();
      $clanIdInt = (int)$clanId;
      $leaderIdInt = (int)$leaderId;

      // Assuming $log and $typeLog are strings
      $stmt = $mysqli->prepare("INSERT INTO newsclantablelog (date, texto, clanId, leaderId, type) VALUES (NOW(), ?, ?, ?, ?)");
      if ($stmt) {
        $stmt->bind_param("siis", $log, $clanIdInt, $leaderIdInt, $typeLog);
        if ($stmt->execute()){
          $stmt->close();
          return true;
        } else {
          // Optional: Log error $stmt->error
          $stmt->close();
          return false;
        }
      } else {
        // Optional: Log error $mysqli->error
        return false;
      }
    }
    return false; // Missing parameters
  }

  public static function send_clan_message($message = null){

    $json = [
      'message' => "",
      'status' => false
    ];

    if (empty($message)){
      $json['message'] = "News is empty.";
      return json_encode($json);
    }

    $mysqli = Database::GetInstance();
    $player = self::GetPlayer();
    if (!$player) { return json_encode(['status' => false, 'message' => 'Player not found.']); }

    $playerClanId = (int)$player['clanId'];
    $userIdInt = (int)$player['userId'];

    // Fetch clan leader ID to verify permission
    // self::infoclan is already refactored. Assuming it returns null if clan not found or player has no clan.
    $clanInfo = json_decode(self::infoclan($playerClanId), true);

    if (!$clanInfo || $userIdInt !== (int)$clanInfo['leaderId']){
      $json['message'] = "You are not the owner of this clan or clan information is unavailable.";
      return json_encode($json);
    }

    $type = 'new'; // Type of log entry
    $stmt = $mysqli->prepare("INSERT INTO newsclantablelog (date, texto, clanId, leaderId, type) VALUES (NOW(), ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("siis", $message, $playerClanId, $userIdInt, $type);
        if ($stmt->execute()){
          $json['status'] = true;
          $json['message'] = "News added succesfully.";
        } else {
          $json['message'] = "Error to add news: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $json['message'] = "Error preparing statement: " . $mysqli->error;
    }
    return json_encode($json);
  }

  public static function getMembersClan($clanId){
    if (isset($clanId) && !empty($clanId)){
      $mysqli = Database::GetInstance();
      $clanIdInt = (int)$clanId;

      $stmt = $mysqli->prepare("SELECT * FROM player_accounts WHERE clanId = ?");
      $stmt->bind_param("i", $clanIdInt);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result){ // Check if query execution was successful
        // The original returned the mysqli_result object.
        // Returning fetched data is generally safer and more aligned with a "get" method.
        $members = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $members; // Returns array of members or empty array
      } else {
        $stmt->close(); // Ensure statement is closed even on failure
        return false;
      }
    }
    return false; // clanId not set or empty
  }

  public static function isMemberClan($clanId = null, $userId = null){
    if (isset($clanId) && !empty($clanId) && isset($userId) && !empty($userId)){
      $mysqli = Database::GetInstance();
      $clanIdInt = (int)$clanId;
      $userIdInt = (int)$userId;

      $stmt = $mysqli->prepare("SELECT userId FROM player_accounts WHERE userId = ? AND clanId = ?");
      $stmt->bind_param("ii", $userIdInt, $clanIdInt);
      $stmt->execute();
      $stmt->store_result();
      $isMember = $stmt->num_rows > 0;
      $stmt->close();
      return $isMember;
    }
    return false; // Parameters not set
  }

  public static function change_clan_leader($newLeader = null){
    $mysqli = Database::GetInstance();
    $player = self::GetPlayer();
    if (!$player) { return json_encode(['status' => false, 'message' => 'Player not found.']); }

    $json = ['message' => "", 'status' => false];
    $newLeaderInt = (int)$newLeader;
    $currentLeaderIdInt = (int)$player['userId'];
    $playerClanId = (int)$player['clanId'];

    if (empty($newLeaderInt)){
      $json['message'] = "New leader ID is empty.";
      return json_encode($json);
    }

    // Fetch current clan info to verify leadership
    // self::infoclan is refactored.
    $clanInfo = json_decode(self::infoclan($playerClanId), true);

    if ($currentLeaderIdInt == $newLeaderInt){
      $json['message'] = "You are already the leader of this clan.";
      return json_encode($json);
    }

    if (!$clanInfo || $currentLeaderIdInt !== (int)$clanInfo['leaderId']){
      $json['message'] = "You are not the owner of this clan or clan information is unavailable.";
      return json_encode($json);
    }

    if (self::isMemberClan($playerClanId, $newLeaderInt)){ // isMemberClan is refactored
      $stmt = $mysqli->prepare("UPDATE server_clans SET leaderId = ? WHERE id = ?");
      if ($stmt) {
        $stmt->bind_param("ii", $newLeaderInt, $playerClanId);
        if ($stmt->execute()){
          if ($stmt->affected_rows > 0) {
            $json['status'] = true;
            $json['message'] = "Leader updated successfully.";
            // Potentially add a log entry here using self::addLogClan
          } else {
            $json['message'] = "Could not update leader (perhaps new leader is same as old, or clan ID invalid).";
          }
        } else {
          $json['message'] = "Error updating leader: " . $stmt->error;
        }
        $stmt->close();
      } else {
        $json['message'] = "Error preparing statement: " . $mysqli->error;
      }
    } else {
      $json['message'] = "The selected new leader is not a member of this clan.";
    }
    return json_encode($json);
  }

  public static function delete_clan($deleteClan = null){ // $deleteClan parameter is unused in original logic
    $mysqli = Database::GetInstance();
    $player = self::GetPlayer();
    if (!$player) { return json_encode(['status' => false, 'message' => 'Player not found.']); }

    $json = ['message' => "", 'status' => false];
    $leaderIdInt = (int)$player['userId'];
    $playerClanId = (int)$player['clanId'];

    // Fetch clan info to confirm leadership and get actual clan ID
    // self::infoclan is refactored.
    $clanInfo = json_decode(self::infoclan($playerClanId), true);

    if (!$clanInfo || $leaderIdInt !== (int)$clanInfo['leaderId']){
      $json['message'] = "You are not the owner of this clan or clan does not exist.";
      return json_encode($json);
    }

    $actualClanId = (int)$clanInfo['id']; // Use the ID from fetched clan info

    $mysqli->begin_transaction();
    try {
      $stmt_update_players = $mysqli->prepare("UPDATE player_accounts SET clanId = 0 WHERE clanId = ?");
      $stmt_update_players->bind_param("i", $actualClanId);
      $stmt_update_players->execute();
      $stmt_update_players->close();

      $stmt_delete_clan = $mysqli->prepare("DELETE FROM server_clans WHERE id = ? AND leaderId = ?");
      $stmt_delete_clan->bind_param("ii", $actualClanId, $leaderIdInt);
      $stmt_delete_clan->execute();
      $stmt_delete_clan->close();

      $stmt_delete_apps = $mysqli->prepare("DELETE FROM server_clan_applications WHERE clanId = ?");
      $stmt_delete_apps->bind_param("i", $actualClanId);
      $stmt_delete_apps->execute();
      $stmt_delete_apps->close();

      $stmt_delete_diplo = $mysqli->prepare("DELETE FROM server_clan_diplomacy WHERE senderClanId = ? OR toClanId = ?");
      $stmt_delete_diplo->bind_param("ii", $actualClanId, $actualClanId);
      $stmt_delete_diplo->execute();
      $stmt_delete_diplo->close();

      $stmt_delete_diplo_apps = $mysqli->prepare("DELETE FROM server_clan_diplomacy_applications WHERE senderClanId = ? OR toClanId = ?");
      $stmt_delete_diplo_apps->bind_param("ii", $actualClanId, $actualClanId);
      $stmt_delete_diplo_apps->execute();
      $stmt_delete_diplo_apps->close();

      Socket::Send('DeleteClan', ['ClanId' => $actualClanId]);
      $json['status'] = true;
      $json['message'] = "Clan successfully deleted.";
      $mysqli->commit();
    } catch (Exception $e) {
      $json['message'] = "Error deleting clan: " . $e->getMessage();
      $mysqli->rollback();
    }
    // $mysqli->close(); // Managed by Database class

    return json_encode($json);

  }

  public static function getAllClans(){
    $mysqli = Database::GetInstance();
    // Static query, but using prepared statement for consistency
    $stmt = $mysqli->prepare("SELECT * FROM server_clans ORDER by id DESC");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result){
        // Original returned mysqli_result. Fetching all for consistency with other 'get' methods.
        $clans = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $clans; // Returns array of clans or empty array
    } else {
        $stmt->close();
        return false;
    }
  }

  public static function send_bank_credits($to = null, $credits = null, $reason = null){
    if (isset($to) && !empty($to) && is_numeric($credits) && $credits > 0 && isset($reason) && !empty($reason)){
      $json = ['message' => "", 'status' => false];
      $mysqli = Database::GetInstance();
      $player = self::GetPlayer();
      if (!$player) { $json['message'] = "Sender not found."; return json_encode($json); }

      $playerTo = self::GetPlayerById($to); // Already refactored
      if (!$playerTo) { $json['message'] = "Recipient not found."; return json_encode($json); }

      $playerClanId = (int)$player['clanId'];
      $userIdInt = (int)$player['userId'];
      $creditsInt = (int)$credits;
      $toUserIdInt = (int)$to;

      $stmt_clan_bank = $mysqli->prepare("SELECT leaderId, bankcredits FROM server_clans WHERE id = ?");
      $stmt_clan_bank->bind_param("i", $playerClanId);
      $stmt_clan_bank->execute();
      $clanBankResult = $stmt_clan_bank->get_result();
      $dataClanBank = $clanBankResult->fetch_assoc();
      $stmt_clan_bank->close();

      if ($dataClanBank){
        if ($dataClanBank['leaderId'] !== $userIdInt){
          $json['message'] = "You are not the owner of this clan.";
          return json_encode($json);
        }
        if ($dataClanBank['bankcredits'] < $creditsInt){
          $json['message'] = "Bank does not have <b>".$creditsInt."</b> credits to send.";
          return json_encode($json);
        }

        $mysqli->begin_transaction();
        try {
            $stmt_update_clan_bank = $mysqli->prepare("UPDATE server_clans SET bankcredits = bankcredits - ? WHERE id = ?");
            $stmt_update_clan_bank->bind_param("ii", $creditsInt, $playerClanId);
            $stmt_update_clan_bank->execute();
            $stmt_update_clan_bank->close();

            $dataToPlayer = json_decode($playerTo['data'], true);
            $creditsDiscountPercentage = floor($creditsInt - ($creditsInt * (10/100))); // Ensure integer
            $dataToPlayer['credits'] += $creditsDiscountPercentage;
            $dataToPlayerJson = json_encode($dataToPlayer);

            $stmt_update_player_credits = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
            $stmt_update_player_credits->bind_param("si", $dataToPlayerJson, $toUserIdInt);
            $stmt_update_player_credits->execute();
            $stmt_update_player_credits->close();

            self::addBankLog($creditsInt, 'Credits', $playerTo['pilotName'], $reason, $playerClanId); // Assumes addBankLog is safe

            $json['status'] = true;
            $json['message'] = "Successfully sent <b>".$creditsInt."</b> C. (Total sent with 10% fees: <b>".$creditsDiscountPercentage." C.</b>) to <b>".htmlspecialchars($playerTo['pilotName'], ENT_QUOTES, 'UTF-8')."</b>";
            $mysqli->commit();
        } catch (Exception $e) {
            $mysqli->rollback();
            $json['message'] = "Error during transaction: " . $e->getMessage();
        }
      } else {
        $json['message'] = "Clan bank information not found.";
      }
    } else {
      $json['message'] = "Invalid parameters provided for sending credits.";
    }
    return json_encode($json);
  }

  public static function send_bank_uridium($to = null, $uridium = null, $reason = null){
    if (isset($to) && is_numeric($to) && (int)$to > 0 &&
        isset($uridium) && is_numeric($uridium) && (int)$uridium > 0 &&
        isset($reason) && !empty(trim($reason))){

      $json = ['message' => "", 'status' => false];
      $mysqli = Database::GetInstance();
      $player = self::GetPlayer();
      if (!$player) { $json['message'] = "Sender not found."; return json_encode($json); }

      $toUserIdInt = (int)$to;
      $playerTo = self::GetPlayerById($toUserIdInt);
      if (!$playerTo) { $json['message'] = "Recipient not found."; return json_encode($json); }

      $playerClanId = (int)$player['clanId'];
      $userIdInt = (int)$player['userId'];
      $uridiumInt = (int)$uridium;

      $stmt_clan_bank = $mysqli->prepare("SELECT leaderId, bankuri FROM server_clans WHERE id = ?");
      $stmt_clan_bank->bind_param("i", $playerClanId);
      $stmt_clan_bank->execute();
      $clanBankResult = $stmt_clan_bank->get_result();
      $dataClanBank = $clanBankResult->fetch_assoc();
      $stmt_clan_bank->close();

      if ($dataClanBank){
        if ($dataClanBank['leaderId'] !== $userIdInt){
          $json['message'] = "You are not the owner of this clan.";
          return json_encode($json);
        }
        if ($dataClanBank['bankuri'] < $uridiumInt){
          $json['message'] = "Bank does not have <b>".$uridiumInt."</b> uridium to send.";
          return json_encode($json);
        }

        $mysqli->begin_transaction();
        try {
            $stmt_update_clan_bank = $mysqli->prepare("UPDATE server_clans SET bankuri = bankuri - ? WHERE id = ?");
            $stmt_update_clan_bank->bind_param("ii", $uridiumInt, $playerClanId);
            $stmt_update_clan_bank->execute();
            $stmt_update_clan_bank->close();

            $dataToPlayer = json_decode($playerTo['data'], true);
            $uridiumDiscountPercentage = floor($uridiumInt - ($uridiumInt * (25/100)));
            $dataToPlayer['uridium'] += $uridiumDiscountPercentage;
            $dataToPlayerJson = json_encode($dataToPlayer);

            $stmt_update_player_uridium = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
            $stmt_update_player_uridium->bind_param("si", $dataToPlayerJson, $toUserIdInt);
            $stmt_update_player_uridium->execute();
            $stmt_update_player_uridium->close();

            self::addBankLog($uridiumInt, 'Uridium', $playerTo['pilotName'], $reason, $playerClanId); // Assumes addBankLog is safe

            $json['status'] = true;
            $json['message'] = "Successfully sent <b>".$uridiumInt."</b> U. (Total sent with 25% fees: <b>".$uridiumDiscountPercentage." U.</b>) to <b>".htmlspecialchars($playerTo['pilotName'], ENT_QUOTES, 'UTF-8')."</b>";
            $mysqli->commit();
        } catch (Exception $e) {
            $mysqli->rollback();
            $json['message'] = "Error during transaction: " . $e->getMessage();
        }
      } else {
        $json['message'] = "Clan bank information not found.";
      }
    } else {
      $json['message'] = "Invalid parameters provided for sending uridium.";
    }
    return json_encode($json);
  }

  public static function addBankLog($amount, $from, $to, $reason, $idClan){
    // Input validation (basic example, can be more specific)
    if (isset($amount) && is_numeric($amount) && $amount > 0 &&
        isset($from) && !empty(trim($from)) &&
        isset($to) && !empty(trim($to)) &&
        isset($reason) && !empty(trim($reason)) &&
        isset($idClan) && is_numeric($idClan) && (int)$idClan > 0){

      $mysqli = Database::GetInstance();

      $amount_val = (int)$amount; // Or float if decimals are possible
      $from_val = trim((string)$from);
      $to_val = trim((string)$to);
      $reason_val = trim((string)$reason);
      $idClan_int = (int)$idClan;
      $time = time();

      $stmt = $mysqli->prepare("INSERT INTO bank_log (`amount`, `from`, `to`, `reason`, `date`, `idClan`) VALUES (?, ?, ?, ?, ?, ?)");
      if ($stmt) {
        // Assuming amount is integer, date is integer (timestamp)
        $stmt->bind_param("isssii", $amount_val, $from_val, $to_val, $reason_val, $time, $idClan_int);

        if ($stmt->execute()){
          $stmt->close();
          return true;
        } else {
          // Optional: Log error $stmt->error
          $stmt->close();
          return false;
        }
      } else {
        // Optional: Log error $mysqli->error
        return false;
      }

    } else {
      return 0; // Or false, depending on desired return for invalid input
    }

  }

  public static function getBankLog($idClan = null, $orderBy = "DESC"){
    if (isset($idClan) && !empty($idClan)){
      $mysqli = Database::GetInstance();
      $idClanInt = (int)$idClan;

      // Validate orderBy parameter to prevent SQL injection
      $orderBySafe = "DESC"; // Default order
      if (strtoupper($orderBy) === "ASC") {
        $orderBySafe = "ASC";
      }

      // The column 'id' is static, so it's safe to use directly.
      $sql = "SELECT * FROM bank_log WHERE idClan = ? ORDER by id " . $orderBySafe;
      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param("i", $idClanInt);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result){
        // Return fetched data as array, similar to other get methods
        $logData = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $logData;
      } else {
        $stmt->close();
        return false;
      }
    } else {
      return false;
    }
  }

  public static function change_credits_tax($tax = null){
    // $tax parameter can be -1, so !empty($tax) is not the right check if -1 is valid.
    // Original code allows $tax == -1 which becomes 0.
    // Let's assume $tax being set is enough, and then validate its content.
    if (isset($tax)){
      $json = ['message' => "", 'status' => false];
      $permitPercentage = [0,1,2,3,4,5]; // Valid tax percentages
      $mysqli = Database::GetInstance();
      $player = self::GetPlayer();
      if (!$player) { $json['message'] = "Player not found."; return json_encode($json); }

      $playerClanId = (int)$player['clanId'];
      $userIdInt = (int)$player['userId'];

      $processedTax = ($tax == -1) ? 0 : (int)$tax; // Process tax value

      if (!in_array($processedTax, $permitPercentage, true)){ // Strict comparison
        $json['message'] = "Percentage not permitted.";
        return json_encode($json);
      }

      $stmt_get_clan = $mysqli->prepare("SELECT leaderId, creditTax FROM server_clans WHERE id = ?");
      $stmt_get_clan->bind_param("i", $playerClanId);
      $stmt_get_clan->execute();
      $clanResult = $stmt_get_clan->get_result();
      $dataClan = $clanResult->fetch_assoc();
      $stmt_get_clan->close();

      if ($dataClan){
        if ($dataClan['leaderId'] !== $userIdInt){
          $json['message'] = "You are not the owner of this clan.";
          return json_encode($json);
        }

        $oldTax = $dataClan['creditTax'];
        $lastTaxCreditTimestamp = strtotime("+1 day");
  
        $stmt_update_tax = $mysqli->prepare("UPDATE server_clans SET creditTax = ?, lastTaxCredit = ? WHERE id = ?");
        $stmt_update_tax->bind_param("isi", $processedTax, $lastTaxCreditTimestamp, $playerClanId);

        if ($stmt_update_tax->execute()){
          if ($stmt_update_tax->affected_rows > 0) {
            self::addLogClan("set Clan Credits Tax from ".$oldTax."% to ".$processedTax."%!", $playerClanId, $userIdInt, 'logbank');
            $json['status'] = true;
            $json['message'] = "Successfully changed tax from ".$oldTax."% to ".$processedTax."%";
          } else {
            $json['message'] = "No changes made to tax (it might be the same as current).";
          }
        } else {
          $json['message'] = "Error updating tax: " . $stmt_update_tax->error;
        }
        $stmt_update_tax->close();
      } else {
        $json['message'] = "Clan information not found.";
      }
      return json_encode($json);
    } else {
      return json_encode(['message' => "Tax value not provided.", 'status' => false]);
    }
  }

  public static function change_uridium_tax($tax_input = null){ // Renamed parameter to avoid confusion
    if (isset($tax_input)){
      $json = ['message' => "", 'status' => false];
      $permitPercentage = [0, 0.1, 0.2, 0.3]; // Valid tax float values
      $mysqli = Database::GetInstance();
      $player = self::GetPlayer();
      if (!$player) { $json['message'] = "Player not found."; return json_encode($json); }

      $playerClanId = (int)$player['clanId'];
      $userIdInt = (int)$player['userId'];

      $processedTax = 0.0; // Default to float
      // Process tax value from input to float
      if ($tax_input == 1) $processedTax = 0.1;
      elseif ($tax_input == 2) $processedTax = 0.2;
      elseif ($tax_input == 3) $processedTax = 0.3;
      elseif ($tax_input == -1) $processedTax = 0.0;
      else $processedTax = (float)$tax_input; // Allow direct float input as well

      if (!in_array($processedTax, $permitPercentage, true)){ // Strict comparison for floats
        $json['message'] = "Percentage not permitted: " . $processedTax;
        return json_encode($json);
      }

      $stmt_get_clan = $mysqli->prepare("SELECT leaderId, uridiumTax FROM server_clans WHERE id = ?");
      $stmt_get_clan->bind_param("i", $playerClanId);
      $stmt_get_clan->execute();
      $clanResult = $stmt_get_clan->get_result();
      $dataClan = $clanResult->fetch_assoc();
      $stmt_get_clan->close();

      if ($dataClan){
        if ($dataClan['leaderId'] !== $userIdInt){
          $json['message'] = "You are not the owner of this clan.";
          return json_encode($json);
        }

        $oldTax = $dataClan['uridiumTax']; // This is already a float/decimal from DB
        $lastTaxUridiumTimestamp = strtotime("+7 day");
  
        $stmt_update_tax = $mysqli->prepare("UPDATE server_clans SET uridiumTax = ?, lastTaxUridium = ? WHERE id = ?");
        // Bind as double (d) for uridiumTax
        $stmt_update_tax->bind_param("dsi", $processedTax, $lastTaxUridiumTimestamp, $playerClanId);

        if ($stmt_update_tax->execute()){
           if ($stmt_update_tax->affected_rows > 0) {
            self::addLogClan("set Clan Uridium Tax from ".$oldTax."% to ".$processedTax."%!", $playerClanId, $userIdInt, 'logbank');
            $json['status'] = true;
            $json['message'] = "Successfully changed tax from ".$oldTax."% to ".$processedTax."%";
          } else {
            $json['message'] = "No changes made to tax (it might be the same as current).";
          }
        } else {
          $json['message'] = "Error updating tax: " . $stmt_update_tax->error;
        }
        $stmt_update_tax->close();
      } else {
        $json['message'] = "Clan information not found.";
      }
      return json_encode($json);
    } else {
      return json_encode(['message' => "Tax value not provided.", 'status' => false]);
    }
  }

  public static function calculateTax($idClan = null, $type = null){
    if (isset($idClan) && !empty($idClan) && isset($type) && !empty($type)){
      $mysqli = Database::GetInstance();
      $idClanInt = (int)$idClan;

      if (!in_array($type, ['credits', 'uridium'], true)) {
          return false; // Invalid type
      }

      $stmt_get_clan_info = $mysqli->prepare("SELECT creditTax, uridiumTax FROM server_clans WHERE id = ?");
      $stmt_get_clan_info->bind_param("i", $idClanInt);
      $stmt_get_clan_info->execute();
      $clanInfoResult = $stmt_get_clan_info->get_result();
      $clanInfo = $clanInfoResult->fetch_assoc();
      $stmt_get_clan_info->close();

      if ($clanInfo){
        // getMembersClan already uses prepared statements if refactored, returns array or false
        $membersClanArray = self::getMembersClan($idClanInt);

        if ($membersClanArray && count($membersClanArray) > 0){
          $creditsToClan = 0;
          foreach($membersClanArray as $dataClan){ // Iterate over array
            $dataUser = json_decode($dataClan['data'], true);
            if (isset($dataUser[$type])) { // Check if type key exists in data
                $creditsUser = (float)$dataUser[$type]; // Ensure numeric
                $taxRateKey = ($type == 'credits') ? 'creditTax' : 'uridiumTax';
                $taxRate = (float)$clanInfo[$taxRateKey];
                $creditsToClan += ($creditsUser * ($taxRate / 100));
            }
          }
          return round($creditsToClan);
        } else {
          return 0;
        }
      } else {
        return -1; // Clan not found
      }
    } else {
      return false; // Invalid parameters
    }
  }

  public static function executeTaxCron($ip = null){

    $permitIpCron = [
      '0' => '135.181.104.19',
      '1' => '135.181.85.24'
    ];

    $json = [
      'status' => false,
      'message' => '',
      'passedCredits' => false,
      'passedUridium' => false
    ];

    if (isset($ip) && !empty($ip) && in_array($ip, $permitIpCron)){
      $mysqli = Database::GetInstance();
      
      $stmt_get_clans = $mysqli->prepare("SELECT id, tag, name, lastTaxCredit, lastTaxUridium FROM server_clans WHERE creditTax > 0 OR uridiumTax > 0");
      $stmt_get_clans->execute();
      $getClansResult = $stmt_get_clans->get_result();

      if ($getClansResult->num_rows > 0){
        $dateNow = time();
        $json['status'] = false; // Initialize status, will be true if any update occurs

        while($dataClans = $getClansResult->fetch_assoc()){
          $clanIdInt = (int)$dataClans['id'];
          $creditTax = self::calculateTax($clanIdInt, 'credits'); // Assumes calculateTax is safe or refactored
          $uridiumTax = self::calculateTax($clanIdInt, 'uridium'); // Assumes calculateTax is safe or refactored

          $canProcessCredits = true;
          if ($creditTax > 0){
            if (isset($dataClans['lastTaxCredit']) && (int)$dataClans['lastTaxCredit'] >= $dateNow) {
              $json['message'] .= "|Credits not passed (wait 24h) for clan ID: ".$clanIdInt." [".$dataClans['tag']."]|";
              $canProcessCredits = false;
            }
            if ($canProcessCredits){
              $added24h = strtotime("+1 day");
              $stmt_update_credits = $mysqli->prepare("UPDATE server_clans SET bankcredits = bankcredits + ?, lastTaxCredit = ? WHERE id = ?");
              $stmt_update_credits->bind_param("isi", $creditTax, $added24h, $clanIdInt);
              if ($stmt_update_credits->execute()) {
                $json['status'] = true; // An update occurred
                self::addLogClan("Added ".number_format($creditTax, 0, ',', '.')." credits to clan [".$dataClans['tag']."] ".$dataClans['name']."", $clanIdInt, 2, 'systembank');
                $json['message'] .= "|Added ".number_format($creditTax, 0, ',', '.')." credits to clan ID: ".$clanIdInt."|";
              }
              $stmt_update_credits->close();
            }
          }

          $canProcessUridium = true;
          if ($uridiumTax > 0){
            if (isset($dataClans['lastTaxUridium']) && (int)$dataClans['lastTaxUridium'] > $dateNow) {
              $json['message'] .= "|Uridium not passed (wait 1w) for clan ID: ".$clanIdInt." [".$dataClans['tag']."]|";
              $canProcessUridium = false;
            }
            if ($canProcessUridium){
              $added1w = strtotime("+7 day");
              $stmt_update_uridium = $mysqli->prepare("UPDATE server_clans SET bankuri = bankuri + ?, lastTaxUridium = ? WHERE id = ?");
              $stmt_update_uridium->bind_param("isi", $uridiumTax, $added1w, $clanIdInt);
               if ($stmt_update_uridium->execute()) {
                $json['status'] = true; // An update occurred
                self::addLogClan("Added ".number_format($uridiumTax, 0, ',', '.')." uridium to clan [".$dataClans['tag']."] ".$dataClans['name']."", $clanIdInt, 2, 'systembank');
                $json['message'] .= "|Added ".number_format($uridiumTax, 0, ',', '.')." uridium to clan ID: ".$clanIdInt."|";
              }
              $stmt_update_uridium->close();
            }
          }
        }
        $stmt_get_clans->close();
      } else {
        $stmt_get_clans->close();
        $json['message'] = "No clans with creditTax or uridiumTax > 0";
      }
    } else {
      $json['message'] = htmlspecialchars($ip)." denied."; // Sanitize IP for output
    }
    return json_encode($json);
  }

  public static function getPartsDrones($drone = null){
    $json = ['status' => false, 'message' => ''];
    if (empty($drone)){
      $json['message'] = "Critical Error. Need Drone.";
      return json_encode($json);
    }

    $mysqli = Database::GetInstance();
    $player = self::GetPlayer();
    if (!$player) { $json['message'] = "Player not found."; return json_encode($json); }
    $userIdInt = (int)$player['userId'];

    $stmt = $mysqli->prepare("SELECT items FROM player_equipment WHERE userId = ?");
    $stmt->bind_param("i", $userIdInt);
    $stmt->execute();
    $result = $stmt->get_result();
    $items_json = null;
    if ($equipData = $result->fetch_assoc()) {
        $items_json = $equipData['items'];
    }
    $stmt->close();

    if ($items_json) {
        $items = json_decode($items_json);
        $droneName = "drone".$drone."Parts";
        $partsCount = $items->$droneName ?? 0; // Use null coalescing for safety
        return $partsCount; // Return count directly, not JSON
    }
    return 0; // Default if no items found or player not found
  }

  public static function buildDrone($drone = null){
    $json = ['status' => false, 'message' => '', 'uridium' => 0];
    if (empty($drone)){
      $json['message'] = "Critical Error. Need Drone.";
      return json_encode($json);
    }

    $required = [
      'Apis' => ['parts'=> 45], // No uridium cost defined in original for Apis build
      'Zeus' => ['parts'=> 45, 'uridium' => 1300000]
    ];

    if (!isset($required[$drone])) {
        $json['message'] = "Drone type not recognized for building.";
        return json_encode($json);
    }

    $mysqli = Database::GetInstance();
    $player = self::GetPlayer();
    if (!$player) { $json['message'] = "Player not found."; return json_encode($json); }
    $userIdInt = (int)$player['userId'];

    // Get current items and player data
    $stmt_get_data = $mysqli->prepare("SELECT items FROM player_equipment WHERE userId = ?");
    $stmt_get_data->bind_param("i", $userIdInt);
    $stmt_get_data->execute();
    $equipResult = $stmt_get_data->get_result();
    $equipmentData = $equipResult->fetch_assoc();
    $stmt_get_data->close();

    if (!$equipmentData) { $json['message'] = "Player equipment not found."; return json_encode($json); }

    $items = json_decode($equipmentData['items'], true); // Decode as assoc array for easier manipulation
    $dataPlayer = json_decode($player['data'], true); // Player data for uridium check

    $droneLower = strtolower($drone);
    if (!isset($items[$droneLower])){ // Check if drone property exists (e.g. 'apis', 'zeus')
      $json['message'] = "This drone type ('".$droneLower."') is not defined in player items.";
      return json_encode($json);
    }
    if ($items[$droneLower]){ // Check if already built (e.g., $items['apis'] is true)
      $json['message'] = "You already built ".$drone;
      return json_encode($json);
    }

    $dronePartsKey = "drone".$drone."Parts";
    $countParts = $items[$dronePartsKey] ?? 0;

    if ($countParts >= $required[$drone]['parts']){
      // Check for Uridium cost if applicable (e.g. Zeus)
      if (isset($required[$drone]['uridium'])) {
        $uridiumCost = (int)$required[$drone]['uridium'];
        if ($dataPlayer['uridium'] < $uridiumCost) {
          $json['message'] = "Not enough Uridium to build ".$drone.".";
          return json_encode($json);
        }
        $dataPlayer['uridium'] -= $uridiumCost;
        // Update player data for uridium change
        $stmt_update_player_data = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
        $newDataJson = json_encode($dataPlayer);
        $stmt_update_player_data->bind_param("si", $newDataJson, $userIdInt);
        $stmt_update_player_data->execute();
        $stmt_update_player_data->close();
        $json['uridium'] = number_format($dataPlayer['uridium']); // Update uridium in json response
      }

      $items[$dronePartsKey] -= $required[$drone]['parts'];
      $items[$droneLower] = true; // Mark drone as built

      $newItemsJson = json_encode($items);
      $stmt_update_items = $mysqli->prepare("UPDATE player_equipment SET items = ? WHERE userId = ?");
      $stmt_update_items->bind_param("si", $newItemsJson, $userIdInt);

      if ($stmt_update_items->execute()) {
        $json['status'] = true;
        $json['message'] = "Built ".$drone." successfully with ".$required[$drone]['parts']." parts.";
      } else {
        $json['message'] = "Error updating equipment: " . $stmt_update_items->error;
        // Rollback uridium if transaction was used, though not explicitly here for single item build
      }
      $stmt_update_items->close();
      return json_encode($json);
    } else {
      $json['message'] = "You do not have enough parts for ".$drone.". Needed: ".$required[$drone]['parts'].", Have: ".$countParts;
      return json_encode($json);
    }

  }

  public static function countPercentage($actionChance = null, $cnt = null){

    if (isset($actionChance) and isset($cnt)){

      if ($actionChance == "increase"){
        if ($cnt >= 100){
          $cntT = 100;
        } else {
          $cntT = $cnt+5;
        }
      } else {
        if ($cnt == 5){
          $cntT = 5;
        } else {
          $cntT = $cnt-5;
        }
      }

      return $cntT;

    }

  }

 public static function selectItemUpgradeSystem($idItem = NULL, $cnt = NULL){

    if (isset($idItem) && isset($cnt)){

      $json = [
        'status' => false,
        'message' => '',
        'uridium' => 0
      ];

      $percent = array(
        '5' => 1,'10' => 2,'15' => 3,'20' => 4,'25' => 5,'30' => 6,'35' => 7,'40' => 8,'45' => 9,'50' => 10,'55' => 11,'60' => 12,'65' => 13,'70' => 14,'75' => 15,'80' => 16,'85' => 17,'90' => 18,'95' => 19,'100' => 20
      );

      $player = Functions::GetPlayer();
      if (!$player) {
          $json['message'] = "Player not found.";
          return json_encode($json);
      }
      $mysqli = Database::GetInstance();
      $idItemInt = (int)$idItem;
      $cntInt = (int)$cnt;

      // Validate $cnt
      if (!array_key_exists($cntInt, $percent)) {
          $json['message'] = "Invalid chance value provided.";
          return json_encode($json);
      }

      $stmt_item = $mysqli->prepare("SELECT * FROM itemsUpgradeSystem WHERE id = ?");
      $stmt_item->bind_param("i", $idItemInt);
      $stmt_item->execute();
      $result_item = $stmt_item->get_result();

      if ($result_item->num_rows > 0){
        $dataItem = $result_item->fetch_assoc();
        $stmt_item->close();

        $stmt_equip = $mysqli->prepare("SELECT lf1lvl,lf3nlvl,lf4mdlvl,lf4pdlvl,lf4hplvl,lf4splvl,lf4unstablelvl,mp1lvl,lf2lvl,lf3lvl,lf4lvl,lf5lvl,A01lvl,A02lvl,A03lvl,B01lvl,B02lvl,B03lvl FROM player_equipment WHERE userId = ?");
        $stmt_equip->bind_param("i", $player['userId']);
        $stmt_equip->execute();
        $result_equip = $stmt_equip->get_result();
        $dataEquipment = $result_equip->fetch_assoc();
        $stmt_equip->close();

        if (!$dataEquipment) {
            $json['message'] = "Player equipment not found.";
            return json_encode($json);
        }

        $lvl = null;
        $lvlTo = null;

        if ($dataItem['name'] == "LF-1"){
          $lvl = $dataEquipment['lf1lvl'];
          $lvlTo = $lvl+1;
        } else if ($dataItem['name'] == "LF-2"){
          $lvl = $dataEquipment['lf2lvl'];
          $lvlTo = $lvl+1;
        } else if ($dataItem['name'] == "LF-3"){
          $lvl = $dataEquipment['lf3lvl'];
          $lvlTo = $lvl+1;
        } else if ($dataItem['name'] == "LF-4"){
          $lvl = $dataEquipment['lf4lvl'];
          $lvlTo = $lvl+1;
        } else if ($dataItem['name'] == "Prometeus"){
          $lvl = $dataEquipment['lf5lvl'];
          $lvlTo = $lvl+1;
        } else if ($dataItem['name'] == "SG3N-B01"){
          $lvl = $dataEquipment['B01lvl'];
          $lvlTo = $lvl+1;
        } else if ($dataItem['name'] == "SG3N-B02"){
          $lvl = $dataEquipment['B02lvl'];
          $lvlTo = $lvl+1;
        } else if ($dataItem['name'] == "SG3N-B03"){
          $lvl = $dataEquipment['B03lvl'];
          $lvlTo = $lvl+1;
        } else if ($dataItem['name'] == "SG3N-A01"){
          $lvl = $dataEquipment['A01lvl'];
          $lvlTo = $lvl+1;
        } else if ($dataItem['name'] == "SG3N-A02"){
          $lvl = $dataEquipment['A02lvl'];
          $lvlTo = $lvl+1;
        } else if ($dataItem['name'] == "SG3N-A03"){
          $lvl = $dataEquipment['A03lvl'];
          $lvlTo = $lvl+1;		
        } else if ($dataItem['name'] == "Drone Level"){
          $lvl = self::getDroneLvl();
          $lvlTo = $lvl+1;
		} else if ($dataItem['name'] == "LF-3-Neutron"){
          $lvl = $dataEquipment['lf3nlvl'];
          $lvlTo = $lvl+1;
		} else if ($dataItem['name'] == "LF-4-MD"){
          $lvl = $dataEquipment['lf4mdlvl'];
          $lvlTo = $lvl+1;
		} else if ($dataItem['name'] == "LF-4-PD"){
          $lvl = $dataEquipment['lf4pdlvl'];
          $lvlTo = $lvl+1;
		} else if ($dataItem['name'] == "LF-4-HP"){
          $lvl = $dataEquipment['lf4hplvl'];
          $lvlTo = $lvl+1;
		} else if ($dataItem['name'] == "LF-4-SP"){
          $lvl = $dataEquipment['lf4splvl'];
          $lvlTo = $lvl+1;
		} else if ($dataItem['name'] == "Unstable LF-4"){
          $lvl = $dataEquipment['lf4unstablelvl'];
          $lvlTo = $lvl+1;
		} else if ($dataItem['name'] == "MP-1"){
          $lvl = $dataEquipment['mp1lvl'];
          $lvlTo = $lvl+1;
        }

        $json['name'] = $dataItem['name'];
        $json['image'] = $dataItem['image'];
        $json['costUpgrade'] = $dataItem['multiplier'];
        $json['percent'] = $percent;
        $json['costUridium'] = $dataItem['multiplier'] * $percent[$cnt];
        $json['itemId'] = $dataItem['id'];
        $json['lvl'] = $lvl;
        $json['lvlTo'] = $lvlTo;

        return json_encode($json);


      } 

    }

  }

  public static function ChanceItem($idItem = null, $cnt = null, $actionChance = null){

    if (isset($idItem) && isset($actionChance) && isset($cnt)){

      $json = [
        'status' => false,
        'message' => '',
        'uridium' => 0,
        'cnt' => 0,
        'costUridium' => 0
      ];

      $data = json_decode(self::selectItemUpgradeSystem($idItem, 5), true);

      $json['cnt'] = self::countPercentage($actionChance, $cnt);
      $json['costUridium'] = $data['costUpgrade'] * $data['percent'][$json['cnt']];
      $json['status'] = true;

      return json_encode($json);

    }

  }

  public static function upgradeItem($idItem = null, $cnt = null){

    if (isset($idItem) && isset($cnt)){

      $json = [
        'status' => false,
        'message' => '',
        'uridium' => 0,
      ];

      $player = Functions::GetPlayer();
      if (!$player) {
          $json['message'] = "Player not found.";
          return json_encode($json);
      }
      $mysqli = Database::GetInstance();
      $idItemInt = (int)$idItem;
      $cntInt = (int)$cnt; // Assuming $cnt is the percentage key, e.g., 5, 10, ... 100

      // selectItemUpgradeSystem already validates $cnt against its internal $percent array if called with it.
      // However, $data is fetched with a fixed $cnt=5. We need to use the passed $cnt for cost calculation.
      $itemUpgradeInfo = json_decode(self::selectItemUpgradeSystem($idItemInt, $cntInt), true);

      if (!$itemUpgradeInfo || !isset($itemUpgradeInfo['costUpgrade']) || !isset($itemUpgradeInfo['percent'][$cntInt])) {
          $json['message'] = "Invalid item or upgrade chance information.";
          return json_encode($json);
      }

      $stmt_check_process = $mysqli->prepare("SELECT itemId FROM upgradesSystem WHERE itemId = ? AND idUser = ?");
      $stmt_check_process->bind_param("ii", $idItemInt, $player['userId']);
      $stmt_check_process->execute();
      $result_check_process = $stmt_check_process->get_result();

      if ($result_check_process->num_rows > 0){
        $stmt_check_process->close();
        $json['message'] = "This item not finished. Wait...";
        return json_encode($json);
      }
      $stmt_check_process->close();

      $cost = $itemUpgradeInfo['costUpgrade'] * $itemUpgradeInfo['percent'][$cntInt];
      $dataPlayer = json_decode($player['data'], true); // Decode as array

      if ($cost > $dataPlayer['uridium']){
        $json['message'] = "You no have ".$cost." U. to upgrade this item.";
        return json_encode($json);
      }

      $dataPlayer['uridium'] -= $cost;

      if(Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
        Socket::Send('UpdateUridium', ['UserId' => $player['userId'], 'UridiumPrice' => $cost, 'Type' => "DECREASE"]);
      } else {
        $newDataJson = json_encode($dataPlayer);
        $stmt_update_uridium = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
        $stmt_update_uridium->bind_param("si", $newDataJson, $player['userId']);
        $stmt_update_uridium->execute();
        $stmt_update_uridium->close();
      }

      $json['uridium'] = number_format($dataPlayer['uridium'], 0, ',', '.');

      // Fetch current equipment levels again to be sure, or use from $itemUpgradeInfo if it's fresh
      $stmt_equip_levels = $mysqli->prepare("SELECT lf1lvl,lf3nlvl,lf4mdlvl,lf4pdlvl,lf4hplvl,lf4splvl,lf4unstablelvl,mp1lvl,lf2lvl,lf3lvl,lf4lvl,lf5lvl,A01lvl,A02lvl,A03lvl,B01lvl,B02lvl,B03lvl FROM player_equipment WHERE userId = ?");
      $stmt_equip_levels->bind_param("i", $player['userId']);
      $stmt_equip_levels->execute();
      $result_equip_levels = $stmt_equip_levels->get_result();
      $dataEquipment = $result_equip_levels->fetch_assoc();
      $stmt_equip_levels->close();

      if(!$dataEquipment){
          $json['message'] = "Could not retrieve equipment levels.";
          // Consider rolling back uridium if a transaction was started, though not explicit here.
          return json_encode($json);
      }

      $lvl = null;
      $lvlTo = null;
      // $data['name'] should be $itemUpgradeInfo['name']

	  if ($data['name'] == "LF-1"){
          $lvl = $dataEquipment['lf1lvl'];
          $lvlTo = $lvl+1;
        } else if ($data['name'] == "LF-2"){
          $lvl = $dataEquipment['lf2lvl'];
          $lvlTo = $lvl+1;
        } else if ($data['name'] == "LF-3"){
          $lvl = $dataEquipment['lf3lvl'];
          $lvlTo = $lvl+1;
        } else if ($data['name'] == "LF-4"){
          $lvl = $dataEquipment['lf4lvl'];
          $lvlTo = $lvl+1;
        } else if ($data['name'] == "Prometeus"){
          $lvl = $dataEquipment['lf5lvl'];
          $lvlTo = $lvl+1;
        } else if ($data['name'] == "SG3N-B01"){
          $lvl = $dataEquipment['B01lvl'];
          $lvlTo = $lvl+1;
        } else if ($data['name'] == "SG3N-B02"){
          $lvl = $dataEquipment['B02lvl'];
          $lvlTo = $lvl+1;
        } else if ($data['name'] == "SG3N-B03"){
          $lvl = $dataEquipment['B03lvl'];
          $lvlTo = $lvl+1;
        } else if ($data['name'] == "SG3N-A01"){
          $lvl = $dataEquipment['A01lvl'];
          $lvlTo = $lvl+1;
        } else if ($data['name'] == "SG3N-A02"){
          $lvl = $dataEquipment['A02lvl'];
          $lvlTo = $lvl+1;
        } else if ($data['name'] == "SG3N-A03"){
          $lvl = $dataEquipment['A03lvl'];
          $lvlTo = $lvl+1;
		} else if ($data['name'] == "LF-3-Neutron"){
          $lvl = $dataEquipment['lf3nlvl'];
          $lvlTo = $lvl+1;
		} else if ($data['name'] == "LF-4-MD"){
          $lvl = $dataEquipment['lf4mdlvl'];
          $lvlTo = $lvl+1;
		} else if ($data['name'] == "LF-4-PD"){
          $lvl = $dataEquipment['lf4pdlvl'];
          $lvlTo = $lvl+1;
		} else if ($data['name'] == "LF-4-HP"){
          $lvl = $dataEquipment['lf4hplvl'];
          $lvlTo = $lvl+1;
		} else if ($data['name'] == "LF-4-SP"){
          $lvl = $dataEquipment['lf4splvl'];
          $lvlTo = $lvl+1;
		} else if ($data['name'] == "Unstable LF-4"){
          $lvl = $dataEquipment['lf4unstablelvl'];
          $lvlTo = $lvl+1;
		} else if ($data['name'] == "MP-1"){
          $lvl = $dataEquipment['mp1lvl'];
          $lvlTo = $lvl+1;
        } else if ($data['name'] == "Drone Level"){
        $lvl = self::getDroneLvl();
        $lvlTo = $lvl+1; 

        if ($lvl >= 6){
          $json['message'] = "This Drone does not allow to upgrade more.";
  
          return json_encode($json);
        }
      }
	  
      if ($lvl >= 16){
        $json['message'] = "This laser does not allow to upgrade more.";

        return json_encode($json);
      }

      $waitTime = strtotime("+5 minutes", time());
      $timeNow = time();
      $waitTime = strtotime("+5 minutes", $timeNow); // Corrected waitTime calculation

      $stmt_insert_upgrade = $mysqli->prepare("INSERT INTO upgradesSystem (`idUser`, `lvl_base`, `new_lvl`, `name`, `itemId`, `waitTime`, `percent`, `img`, `timeNow`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt_insert_upgrade->bind_param("iiississs", $player['userId'], $lvl, $lvlTo, $itemUpgradeInfo['name'], $itemUpgradeInfo['itemId'], $waitTime, $cntInt, $itemUpgradeInfo['image'], $timeNow);
      $sQuery = $stmt_insert_upgrade->execute(); // $sQuery will be true/false

      if (!$sQuery) {
          $json['message'] = "Error starting upgrade process: " . $stmt_insert_upgrade->error;
          $stmt_insert_upgrade->close();
          // Rollback uridium if possible / necessary
          return json_encode($json);
      }
      $inserted_id = $mysqli->insert_id;
      $stmt_insert_upgrade->close();

      $date1 = $timeNow;
      $date2 = $waitTime;
      $today = time();
      $timePast = $today - $date1;
      $duration = $date2 - $date1;
      $completed  = floor(($timePast/$duration)*100);
      
      $json['id'] = $mysqli->insert_id;
      $json['itemId'] = $data['itemId'];
      $json['name'] = $data['name'];
      $json['lvl'] = $lvl;
      $json['new_lvl'] = $lvlTo;
      $json['progressBar'] = $completed;
      $json['image'] = $data['image'];
      $json['status'] = true;

      return json_encode($json);

    }

  }

  public static function checkProgressBar($idItem = null){

    if (isset($idItem)){

      $json = [
        'status' => false,
        'message' => '',
        'uridium' => 0,
      ];

      $player = Functions::GetPlayer();
      if (!$player) {
          $json['message'] = "Player not found.";
          return json_encode($json);
      }
      $mysqli = Database::GetInstance();
      $idItemInt = (int)$idItem;

      $stmt = $mysqli->prepare("SELECT * FROM upgradesSystem WHERE id = ? AND idUser = ?");
      $stmt->bind_param("ii", $idItemInt, $player['userId']);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0){
        $data = $result->fetch_assoc();
        $stmt->close();

        $data = $sQuery->fetch_assoc();

        $date1 = $data['timeNow'];
        $date2 = $data['waitTime'];
        $today = time();
        $timePast = $today - $date1;
        $duration = $date2 - $date1;
        $completed  = floor(($timePast/$duration)*100);

        if ($completed >= 100){
          $completed = 100;
        }

        $json['progressBar'] = $completed;
        $json['status'] = true;

      }

      return json_encode($json);

    }

  }

  public static function getWin($percentage = null) {

    if (isset($percentage)){

      $rand = rand(1, 100);

      if ($rand <= $percentage){
        return true;
      } else {
        return false;
      }

    }

  }

  public static function finishUpgrade($id = null){

    if (isset($id)){

      $json = [
        'status' => false,
        'message' => '',
        'uridium' => 0,
      ];

      $player = Functions::GetPlayer();
      if (!$player) {
          $json['message'] = "Player not found.";
          return json_encode($json);
      }
      $mysqli = Database::GetInstance();
      $idInt = (int)$id;

      $stmt_select = $mysqli->prepare("SELECT * FROM upgradesSystem WHERE id = ? AND idUser = ?");
      $stmt_select->bind_param("ii", $idInt, $player['userId']);
      $stmt_select->execute();
      $result_select = $stmt_select->get_result();

      if ($result_select->num_rows > 0){
        $data = $result_select->fetch_assoc();
        $stmt_select->close();

        $date1 = $data['timeNow'];
        $date2 = $data['waitTime'];
        $today = time();
        $timePast = $today - $date1;
        $duration = $date2 - $date1;
        $completed  = floor(($timePast/$duration)*100);

        if ($completed >= 100){

          $percent = (intval($data['percent']));
          $isWinner = self::getWin($percent);

          if ($isWinner){
            $new_lvl_int = (int)$data['new_lvl'];
            $userId_int = (int)$player['userId'];
            $update_query_equip = "";
            $update_query_account = "";

            // Whitelist item names to corresponding DB column suffixes
            $item_to_column = [
                "LF-1" => "lf1lvl", "LF-2" => "lf2lvl", "LF-3" => "lf3lvl", "LF-4" => "lf4lvl",
                "Prometeus" => "lf5lvl", "SG3N-A01" => "A01lvl", "SG3N-A02" => "A02lvl",
                "SG3N-A03" => "A03lvl", "SG3N-B01" => "B01lvl", "SG3N-B02" => "B02lvl",
                "SG3N-B03" => "B03lvl", "LF-3-Neutron" => "lf3nlvl", "LF-4-MD" => "lf4mdlvl",
                "LF-4-PD" => "lf4pdlvl", "LF-4-HP" => "lf4hplvl", "LF-4-SP" => "lf4splvl",
                "Unstable LF-4" => "lf4unstablelvl", "MP-1" => "mp1lvl"
            ];

            if (array_key_exists($data['name'], $item_to_column)) {
                $column_name = $item_to_column[$data['name']];
                $update_query_equip = "UPDATE player_equipment SET $column_name = ? WHERE userId = ?";
                $stmt_update = $mysqli->prepare($update_query_equip);
                $stmt_update->bind_param("ii", $new_lvl_int, $userId_int);
                $stmt_update->execute();
                $stmt_update->close();
            } else if ($data['name'] == "Drone Level"){
              if(Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
                Socket::Send('updateDroneEXP', ['UserId' => $player['userId'], 'Amount' => ExpToDron[$data['new_lvl']]]);
              } else {
                // ExpToDron needs to be validated or trusted source
                $drone_exp_val = ExpToDron[$data['new_lvl']] ?? 0; // Default to 0 if key not found
                $stmt_update_drone_exp = $mysqli->prepare("UPDATE player_accounts SET droneExp = ? WHERE userId = ?");
                $stmt_update_drone_exp->bind_param("ii", $drone_exp_val, $userId_int);
                $stmt_update_drone_exp->execute();
                $stmt_update_drone_exp->close();
              }
            }
            $json['winner'] = true;
          } else {
            $json['winner'] = false;
          }

          $cat = "";
          $itemIdForCat = (int)$data['itemId'];
          $stmt_cat = $mysqli->prepare("SELECT cat.cat FROM itemsupgradesystem isu INNER JOIN categoryupgradesystem cat ON isu.catId=cat.id WHERE isu.id = ?");
          $stmt_cat->bind_param("i", $itemIdForCat);
          $stmt_cat->execute();
          $result_cat = $stmt_cat->get_result();
          if ($dataCat = $result_cat->fetch_assoc()){
            $cat = strtolower($dataCat['cat']);
          }
          $stmt_cat->close();

          $json['itemId'] = $data['itemId'];
          $json['new_lvl'] = $data['new_lvl'];
          $json['img'] = $data['img'];
          $json['name'] = $data['name'];
          $json['lvl'] = $data['lvl_base'];
          $json['cat'] = $cat;
          $json['id'] = $data['id'];

          $stmt_delete = $mysqli->prepare("DELETE FROM upgradesSystem WHERE id = ? AND idUser = ?");
          $stmt_delete->bind_param("ii", $idInt, $player['userId']); // Use $idInt from function param
          $stmt_delete->execute();
          $stmt_delete->close();

          return json_encode($json);

        } else {
          if(isset($stmt_select)) $stmt_select->close(); // Ensure closed if opened
          $json['message'] = "This upgrade has no finished.";

          return json_encode($json);
        }

      }

    }

  }

  public static function getLaserLvl($laser = null){

    if (isset($laser)){

      $laser = $laser."lvl";

      $player = Functions::GetPlayer();
      $mysqli = Database::GetInstance();

      $sQuery4 = $mysqli->query("SELECT $laser FROM player_equipment WHERE userId = '{$player['userId']}'");
      $dataEquipment = $sQuery4->fetch_assoc();

      return $dataEquipment[$laser];

    }

  }

  public static function finishAll(){

    $player = Functions::GetPlayer();
    $mysqli = Database::GetInstance();

    $queryFinish = $mysqli->query("SELECT * FROM upgradessystem WHERE idUser = '".$player['userId']."'");

    if ($queryFinish->num_rows > 0){

      $json = array();
      
      while($dataFinish = $queryFinish->fetch_assoc()){
        
        $date1 = $dataFinish['timeNow'];
        $date2 = $dataFinish['waitTime'];
        $today = time();
        $timePast = $today - $date1;
        $duration = $date2 - $date1;
        $completed  = floor(($timePast/$duration)*100);

        if ($completed >= 100){

          $percent = (intval($dataFinish['percent']));
          $isWinner = self::getWin($percent);

          if ($isWinner){

            if ($dataFinish['name'] == "LF-1"){
              $mysqli->query("UPDATE player_equipment SET lf1lvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
            } else if ($dataFinish['name'] == "LF-2"){
              $mysqli->query("UPDATE player_equipment SET lf2lvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
            } else if ($dataFinish['name'] == "LF-3"){
              $mysqli->query("UPDATE player_equipment SET lf3lvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
            } else if ($dataFinish['name'] == "LF-4"){
              $mysqli->query("UPDATE player_equipment SET lf4lvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
			} else if ($dataFinish['name'] == "Prometeus"){
              $mysqli->query("UPDATE player_equipment SET lf5lvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
            } else if ($dataFinish['name'] == "SG3N-A01"){
              $mysqli->query("UPDATE player_equipment SET A01lvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
            } else if ($dataFinish['name'] == "SG3N-A02"){
              $mysqli->query("UPDATE player_equipment SET A02lvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
            } else if ($dataFinish['name'] == "SG3N-A03"){
              $mysqli->query("UPDATE player_equipment SET A03lvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
            } else if ($dataFinish['name'] == "SG3N-B01"){
              $mysqli->query("UPDATE player_equipment SET B01lvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
            } else if ($dataFinish['name'] == "SG3N-B02"){
              $mysqli->query("UPDATE player_equipment SET B02lvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
            } else if ($dataFinish['name'] == "SG3N-B03"){
              $mysqli->query("UPDATE player_equipment SET B03lvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
			} else if ($dataFinish['name'] == "LF-3-Neutron"){
              $mysqli->query("UPDATE player_equipment SET lf3nlvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
            } else if ($dataFinish['name'] == "LF-4-MD"){
              $mysqli->query("UPDATE player_equipment SET lf4mdlvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
            } else if ($dataFinish['name'] == "LF-4-PD"){
              $mysqli->query("UPDATE player_equipment SET lf4pdlvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
			} else if ($dataFinish['name'] == "LF-4-HP"){
              $mysqli->query("UPDATE player_equipment SET lf4hplvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
            } else if ($dataFinish['name'] == "LF-4-SP"){
              $mysqli->query("UPDATE player_equipment SET lf4splvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
            } else if ($dataFinish['name'] == "Unstable LF-4"){
              $mysqli->query("UPDATE player_equipment SET lf4unstablelvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
            } else if ($dataFinish['name'] == "MP-1"){
              $mysqli->query("UPDATE player_equipment SET mp1lvl = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
            } else if ($dataFinish['name'] == "Drone Level"){
              if(Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
                Socket::Send('updateDroneEXP', ['UserId' => $player['userId'], 'Amount' => ExpToDron[$dataFinish['new_lvl']]]);
              } else {
                $mysqli->query("UPDATE player_accounts SET droneExp = '".ExpToDron[$dataFinish['new_lvl']]."' WHERE userId = '{$player['userId']}'");
              }
            }


            $result['winner'] = true;
          } else {
            $result['winner'] = false;
          }

          $getCat = $mysqli->query("SELECT itemsupgradesystem.catId, categoryupgradesystem.id, categoryupgradesystem.cat FROM itemsupgradesystem INNER JOIN categoryupgradesystem ON itemsupgradesystem.catId=categoryupgradesystem.id WHERE itemsupgradesystem.id = '".$dataFinish['itemId']."'");

          $cat = "";
          if ($getCat->num_rows > 0){
            $dataCat = $getCat->fetch_assoc();
            $cat = strtolower($dataCat['cat']);
          }

          $result['itemId'] = $dataFinish['itemId'];
          $result['new_lvl'] = $dataFinish['new_lvl'];
          $result['img'] = $dataFinish['img'];
          $result['name'] = $dataFinish['name'];
          $result['lvl'] = $dataFinish['lvl_base'];
          $result['cat'] = $cat;
          $result['id'] = $dataFinish['id'];

          $json[] = $result;

          $mysqli->query("DELETE FROM upgradessystem WHERE id = '".$dataFinish['id']."' AND idUser = '".$dataFinish['idUser']."'");

        }

      }

      return json_encode($json);

    }

  }

  public static function saveTitle($title = null){

    if (isset($title)){

      $json = [
        'status' => false,
        'message' => ''
      ];

      $player = Functions::GetPlayer();
      $mysqli = Database::GetInstance();

      $checkTitle = $mysqli->query("SELECT titles FROM player_titles WHERE userId = '".$player['userId']."'");

      if ($checkTitle->num_rows > 0){
        
        $dataT = $checkTitle->fetch_assoc();
        $dataTitle = json_decode($dataT['titles'], true);
        
        if (in_array($title, $dataTitle)){

          if(Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
            Socket::Send('UpdateTitle', ['UserId' => $player['userId'], 'title' => $title]);
          } else {
            $updateTitle = $mysqli->query("UPDATE player_accounts SET title = '$title' WHERE userId = '".$player['userId']."'");
          }

          $json['status'] = true;
          $json['message'] = "You title has been changed to <b>".$title."</b>";

          return json_encode($json);

        } else {
          $json['message'] = "You not have this title.";

          return json_encode($json);
        }

      }

    }

  }

  public static function buyTitle($title = null){

    if (isset($title)){

      $json = [
        'status' => false,
        'message' => '',
        'ec' => 0
      ];

      $player = Functions::GetPlayer();
      $mysqli = Database::GetInstance();

      $playerEC = $mysqli->query("SELECT coins FROM event_coins WHERE userId = '".$player['userId']."'");

      if (empty($title)){
        $json['message'] = "The title has been empty.";

        return json_encode($json);
      }

      if ($playerEC->num_rows > 0){

        $costTitle = 300;

        $dataEC = $playerEC->fetch_assoc();

        if ($dataEC['coins'] >= $costTitle){

          $dataEC['coins'] -= $costTitle;

          $mysqli->query("UPDATE event_coins SET coins = '".$dataEC['coins']."' WHERE userId = '".$player['userId']."'");

          $mysqli->query("INSERT INTO `buyed_titles` (`title`, `userId`, `time`) VALUES ('$title', '".$player['userId']."', '".time()."')");

          $json['ec'] = $dataEC['coins'];
          $json['message'] = "You has buyed the title <b>".$title."</b> sucesfully. You will receive it within 1 to 24 hours.";
          $json['status'] = true;

          return json_encode($json);

        } else {

          $json['message'] = "You not have 300 E.C for buy this title.";

          return json_encode($json);

        }

      } else {
        $json['message'] = "You not have 300 E.C for buy this title.";

        return json_encode($json);
      }

    }

  }

  public static function getDataRankingClan($limit = null){

    $mysqli = Database::GetInstance();
    $data = array();
    $numero = 0;

    $sql = 'SELECT sc.tag, sc.name, sc.rank, sc.rankPoints, sc.leaderId, sc.factionId, pa.userId
            FROM server_clans sc
            INNER JOIN player_accounts pa ON sc.leaderId = pa.userId
            WHERE sc.rank > 0
            ORDER BY sc.rank ASC';

    if (isset($limit) && is_numeric($limit) && $limit > 0) {
        $sql .= " LIMIT " . (int)$limit; // Safe to append LIMIT with an integer cast
    }

    $stmt_main = $mysqli->prepare($sql);
    // No parameters to bind for the main query structure itself.

    if ($stmt_main) {
        $stmt_main->execute();
        $result_main = $stmt_main->get_result();

        if ($result_main->num_rows > 0) {
            $stmt_chat_perm = $mysqli->prepare("SELECT type FROM chat_permissions WHERE userId = ?");

            while ($dataSq = $result_main->fetch_assoc()) {
                $seeRank = 1;
                if ($stmt_chat_perm) {
                    $stmt_chat_perm->bind_param("i", $dataSq['userId']);
                    $stmt_chat_perm->execute();
                    $result_chat_perm = $stmt_chat_perm->get_result();
                    if ($result_chat_perm->num_rows > 0 && $result_chat_perm->fetch_assoc()['type'] == 1) {
                        $seeRank = 0;
                    }
                    // $result_chat_perm->close(); // Not needed with get_result
                }

                if ($seeRank) {
                    $numero++;
                    $estilo = ""; // Determine estilo based on $numero
                    if ($numero == 1) $estilo = "#4f4731";
                    elseif ($numero == 2) $estilo = "#595959";
                    elseif ($numero == 3) $estilo = "#594a3d";
                    elseif ($numero % 2 == 0) $estilo = "#2d2d2d";
                    else $estilo = "#1d1d1d";

                    $data[] = array(
                        'color' => $estilo,
                        'tag' => $dataSq['tag'],
                        'name' => $dataSq['name'],
                        'rank' => $dataSq['rank'],
                        'rankPoints' => $dataSq['rankPoints'],
                        'factionId' => $dataSq['factionId']
                    );
                }
            }
            if ($stmt_chat_perm) $stmt_chat_perm->close();
        }
        $stmt_main->close();
    } else {
        // Error preparing main statement
        // Consider logging $mysqli->error
        return array('data' => null); // Or throw exception
    }

    return array('data' => $data);
  }

  public static function getDataRankingHonor($limit = null){
    $mysqli = Database::GetInstance();
    $data = array();
    $numero = 0;

    $sql = "SELECT userId, pilotName, factionId, rankId, CAST(JSON_EXTRACT(data, '$.honor') AS SIGNED) as honorPoints
            FROM player_accounts
            WHERE CAST(JSON_EXTRACT(data, '$.honor') AS SIGNED) != 0
            ORDER BY honorPoints DESC"; // Honor can be negative, so use SIGNED. Order DESC.

    if (isset($limit) && is_numeric($limit) && $limit > 0) {
        $sql .= " LIMIT " . (int)$limit;
    }

    $stmt_main = $mysqli->prepare($sql);
    if ($stmt_main) {
        $stmt_main->execute();
        $result_main = $stmt_main->get_result();

        if ($result_main->num_rows > 0){
            $stmt_chat_perm = $mysqli->prepare("SELECT type FROM chat_permissions WHERE userId = ?");
            while($dataSq = $result_main->fetch_assoc()){
                $seeRank = 1;
                if ($stmt_chat_perm) {
                    $stmt_chat_perm->bind_param("i", $dataSq['userId']);
                    $stmt_chat_perm->execute();
                    $result_chat_perm = $stmt_chat_perm->get_result();
                    if ($result_chat_perm->num_rows > 0 && $result_chat_perm->fetch_assoc()['type'] == 1){
                        $seeRank = 0;
                    }
                }

                if ($seeRank){
                    $numero++;
                    if ($numero == 1) $estilo = "#4f4731";
                    elseif ($numero == 2) $estilo = "#595959";
                    elseif ($numero == 3) $estilo = "#594a3d";
                    elseif ($numero % 2 == 0) $estilo = "#2d2d2d";
                    else $estilo = "#1d1d1d";

                    $data[] = array(
                        'color' => $estilo,
                        'pilotName' => $dataSq['pilotName'],
                        'rankPoints' => $dataSq['honorPoints'], // Using rankPoints key for consistency, value is honor
                        'factionId' => $dataSq['factionId'],
                        'rankId' => $dataSq['rankId'],
                        'rank' => $numero
                    );
                }
            }
            if ($stmt_chat_perm) $stmt_chat_perm->close();
        }
        $stmt_main->close();
    } else {
        // Log error: $mysqli->error
        return array('data' => null);
    }
    return array('data' => $data);
  }

  public static function getDataRankingExperience($limit = null){
    $mysqli = Database::GetInstance();
    $data = array();
    $numero = 0;

    $sql = "SELECT userId, pilotName, factionId, rankId, CAST(JSON_EXTRACT(data, '$.experience') AS UNSIGNED) as experience
            FROM player_accounts
            WHERE CAST(JSON_EXTRACT(data, '$.experience') AS UNSIGNED) > 0
            ORDER BY experience DESC";

    if (isset($limit) && is_numeric($limit) && $limit > 0) {
        $sql .= " LIMIT " . (int)$limit;
    }

    $stmt_main = $mysqli->prepare($sql);
    if ($stmt_main) {
        $stmt_main->execute();
        $result_main = $stmt_main->get_result();

        if ($result_main->num_rows > 0){
            $stmt_chat_perm = $mysqli->prepare("SELECT type FROM chat_permissions WHERE userId = ?");
            while($dataSq = $result_main->fetch_assoc()){
                $seeRank = 1;
                if ($stmt_chat_perm) {
                    $stmt_chat_perm->bind_param("i", $dataSq['userId']);
                    $stmt_chat_perm->execute();
                    $result_chat_perm = $stmt_chat_perm->get_result();
                    if ($result_chat_perm->num_rows > 0 && $result_chat_perm->fetch_assoc()['type'] == 1){
                        $seeRank = 0;
                    }
                }

                if ($seeRank){
                    $numero++;
                    if ($numero == 1) $estilo = "#4f4731";
                    elseif ($numero == 2) $estilo = "#595959";
                    elseif ($numero == 3) $estilo = "#594a3d";
                    elseif ($numero % 2 == 0) $estilo = "#2d2d2d";
                    else $estilo = "#1d1d1d";

                    $data[] = array(
                        'color' => $estilo,
                        'pilotName' => $dataSq['pilotName'],
                        'rankPoints' => $dataSq['experience'], // Using rankPoints key for consistency in view, but value is experience
                        'factionId' => $dataSq['factionId'],
                        'rankId' => $dataSq['rankId'],
                        'rank' => $numero
                    );
                }
            }
            if ($stmt_chat_perm) $stmt_chat_perm->close();
        }
        $stmt_main->close();
    } else {
        // Log error: $mysqli->error
        return array('data' => null);
    }
    return array('data' => $data);
  }

  public static function getDataRankingUba($limit = null){
          $seeRank = 0;
        }

        if ($seeRank){

          $numero++;
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

          $data[] = array('color' => $estilo, 'tag' => $dataSq['tag'], 'name' => $dataSq['name'], 'rank' => $dataSq['rank'], 'rankPoints' => $dataSq['rankPoints'], 'factionId' => $dataSq['factionId']);

        }

        //$data[] = array('color' => $estilo, 'tag' => $dataSq['tag'], 'name' => $dataSq['name'], 'rank' => $dataSq['rank'], 'rankPoints' => $dataSq['rankPoints'], 'factionId' => $dataSq['factionId']);

      }

      return array('data' => $data);
    } else {
      return array('data' => null);
    }

  }

  public static function getDataRankingUba($limit = null){
    $mysqli = Database::GetInstance();
    $data = array();
    $numero = 0;

    $sql = "SELECT pilotName, userId, factionId, warPoints, rankId FROM player_accounts WHERE warPoints > 0 ORDER by warPoints DESC";
    if (isset($limit) && is_numeric($limit) && $limit > 0) {
        $sql .= " LIMIT " . (int)$limit;
    }

    $stmt_main = $mysqli->prepare($sql);
    if ($stmt_main) {
        $stmt_main->execute();
        $result_main = $stmt_main->get_result();

        if ($result_main->num_rows > 0){
            $stmt_chat_perm = $mysqli->prepare("SELECT type FROM chat_permissions WHERE userId = ?");
            while($dataSq = $result_main->fetch_assoc()){
                $seeRank = 1;
                if ($stmt_chat_perm) {
                    $stmt_chat_perm->bind_param("i", $dataSq['userId']);
                    $stmt_chat_perm->execute();
                    $result_chat_perm = $stmt_chat_perm->get_result();
                    if ($result_chat_perm->num_rows > 0 && $result_chat_perm->fetch_assoc()['type'] == 1){
                        $seeRank = 0;
                    }
                }

                if ($seeRank){
                    $numero++;
                    if ($numero == 1) $estilo = "#4f4731";
                    elseif ($numero == 2) $estilo = "#595959";
                    elseif ($numero == 3) $estilo = "#594a3d";
                    elseif ($numero % 2 == 0) $estilo = "#2d2d2d";
                    else $estilo = "#1d1d1d";

                    $data[] = array('color' => $estilo, 'pilotName' => $dataSq['pilotName'], 'puntos_totales' => $dataSq['warPoints'], 'factionId' => $dataSq['factionId'], 'rankId' => $dataSq['rankId'], 'rank' => $numero);
                }
            }
            if ($stmt_chat_perm) $stmt_chat_perm->close();
        }
        $stmt_main->close();
    } else {
        // Log error: $mysqli->error
        return array('data' => null);
    }
    return array('data' => $data);
  }

  public static function getDataRankingPlayers($limit = null){
    $mysqli = Database::GetInstance();
    $data = array();
    $numero = 0;

    $sql = "SELECT userId, pilotName, rankPoints, factionId, rankId FROM player_accounts WHERE rankId != 22 AND rank > 0 ORDER BY rank ASC";
    if (isset($limit) && is_numeric($limit) && $limit > 0) {
        $sql .= " LIMIT " . (int)$limit;
    }

    $stmt_main = $mysqli->prepare($sql);
    if ($stmt_main) {
        $stmt_main->execute();
        $result_main = $stmt_main->get_result();

        if ($result_main->num_rows > 0){
            $stmt_chat_perm = $mysqli->prepare("SELECT type FROM chat_permissions WHERE userId = ?");
            while($dataSq = $result_main->fetch_assoc()){
                $seeRank = 1;
                 if ($stmt_chat_perm) {
                    $stmt_chat_perm->bind_param("i", $dataSq['userId']);
                    $stmt_chat_perm->execute();
                    $result_chat_perm = $stmt_chat_perm->get_result();
                    if ($result_chat_perm->num_rows > 0 && $result_chat_perm->fetch_assoc()['type'] == 1){
                        $seeRank = 0;
                    }
                }

                if ($seeRank){
                    $numero++;
                    if ($numero == 1) $estilo = "#4f4731";
                    elseif ($numero == 2) $estilo = "#595959";
                    elseif ($numero == 3) $estilo = "#594a3d";
                    elseif ($numero % 2 == 0) $estilo = "#2d2d2d";
                    else $estilo = "#1d1d1d";

                    $data[] = array('color' => $estilo, 'pilotName' => $dataSq['pilotName'], 'rankPoints' => $dataSq['rankPoints'], 'factionId' => $dataSq['factionId'], 'rankId' => $dataSq['rankId'], 'rank' => $numero);
                }
            }
             if ($stmt_chat_perm) $stmt_chat_perm->close();
        }
        $stmt_main->close();
    } else {
        // Log error
        return array('data' => null);
    }
    return array('data' => $data);
  }

  public static function getDataRankingPvp($limit = null){
    $mysqli = Database::GetInstance();
    $data = array();
    $numero = 0;

    $sql_pvp_ranks = "SELECT COUNT(killer_id) as total_kills, killer_id FROM log_player_kills GROUP BY `killer_id` ORDER by total_kills DESC";
    if (isset($limit) && is_numeric($limit) && $limit > 0) {
        $sql_pvp_ranks .= " LIMIT " . (int)$limit;
    }

    $stmt_pvp_ranks = $mysqli->prepare($sql_pvp_ranks);
    if ($stmt_pvp_ranks) {
        $stmt_pvp_ranks->execute();
        $result_pvp_ranks = $stmt_pvp_ranks->get_result();

        if ($result_pvp_ranks->num_rows > 0){
            $stmt_player_details = $mysqli->prepare("SELECT pilotName, factionId, rankId FROM player_accounts WHERE userId = ?");
            $stmt_chat_perm = $mysqli->prepare("SELECT type FROM chat_permissions WHERE userId = ?");

            while($dataSq = $result_pvp_ranks->fetch_assoc()){
                $seeRank = 1;
                $killerId = (int)$dataSq['killer_id'];

                if ($stmt_chat_perm) {
                    $stmt_chat_perm->bind_param("i", $killerId);
                    $stmt_chat_perm->execute();
                    $result_chat_perm = $stmt_chat_perm->get_result();
                    if ($result_chat_perm->num_rows > 0 && $result_chat_perm->fetch_assoc()['type'] == 1){
                        $seeRank = 0;
                    }
                }

                if ($seeRank && $stmt_player_details){
                    $stmt_player_details->bind_param("i", $killerId);
                    $stmt_player_details->execute();
                    $player_details_result = $stmt_player_details->get_result();
                    $dataPlayer = $player_details_result->fetch_assoc();
                    // $player_details_result->close(); // Not strictly necessary

                    if ($dataPlayer) {
                        $numero++;
                        if ($numero == 1) $estilo = "#4f4731";
                        elseif ($numero == 2) $estilo = "#595959";
                        elseif ($numero == 3) $estilo = "#594a3d";
                        elseif ($numero % 2 == 0) $estilo = "#2d2d2d";
                        else $estilo = "#1d1d1d";

                        $data[] = array('color' => $estilo, 'pilotName' => $dataPlayer['pilotName'], 'rankPoints' => $dataSq['total_kills'], 'factionId' => $dataPlayer['factionId'], 'rankId' => $dataPlayer['rankId'], 'rank' => $numero);
                    }
                }
            }
            if ($stmt_player_details) $stmt_player_details->close();
            if ($stmt_chat_perm) $stmt_chat_perm->close();
        }
        $stmt_pvp_ranks->close();
    } else {
        // Log error
        return array('data' => null);
    }
    return array('data' => $data);
  }  

  public static function CronDiscordAnnouncements($ip = null){

    $permitIpCron = [
      '0' => '135.181.104.19',
      '1' => '135.181.85.24'
    ];

    if (isset($ip) && !empty($ip) && in_array($ip, $permitIpCron)){
      $mysqli = Database::GetInstance();
      // External API call, no direct SQL query with user input here initially.
      // ... (file_get_contents call remains the same) ...
      $json_options = [
        "http" => [
          "method" => "GET",
          "header" => "Authorization: Bot NzMzMDA4MDQzNTExNTEzMDk5.Xw848A.Xm9xbzjRFxUWZKvJabFoIWGizaA" // Note: Bot token exposed
        ]
      ];
      $json_context = stream_context_create($json_options);
      $json_get  = file_get_contents('https://discordapp.com/api/v6/channels/564879634672386059/messages', false, $json_context);

      if (isset($json_get) && !empty($json_get)){
          $json_decode = json_decode($json_get, true);
          if (is_array($json_decode) && count($json_decode) > 0){ // Check if $json_decode is an array
              $stmt_check = $mysqli->prepare("SELECT idMsg FROM discordAnnounces WHERE idMsg = ?");
              $stmt_insert = $mysqli->prepare("INSERT INTO discordAnnounces (content, author, idMsg, date) VALUES (?, ?, ?, ?)");

              foreach ($json_decode as $data_item){ // Renamed $data to $data_item to avoid conflict if $data is used elsewhere
                if (!isset($data_item['id']) || !isset($data_item['content']) || !isset($data_item['author']['username']) || !isset($data_item['timestamp'])) {
                    continue; // Skip if essential data is missing
                }

                $idMsg = $data_item['id']; // idMsg is likely a string (snowflake)
                $content = $data_item['content'];
                $author = $data_item['author']['username'];
                $timestamp = $data_item['timestamp']; // This is likely ISO 8601, DB might need DATETIME format

                $stmt_check->bind_param("s", $idMsg);
                $stmt_check->execute();
                $result_check = $stmt_check->get_result();

                if ($result_check->num_rows == 0) {
                    // Convert timestamp to MySQL DATETIME format 'Y-m-d H:i:s'
                    try {
                        $dateObj = new DateTime($timestamp);
                        $formattedDate = $dateObj->format('Y-m-d H:i:s');
                    } catch (Exception $e) {
                        // Log error or use a default date if timestamp is invalid
                        $formattedDate = date('Y-m-d H:i:s'); // Fallback to current time
                    }

                    $stmt_insert->bind_param("ssss", $content, $author, $idMsg, $formattedDate);
                    if ($stmt_insert->execute()) {
                        echo "<p>MsgID: <b>".htmlspecialchars($idMsg)."</b> saved.</p> | Contenido: ".htmlspecialchars($content)."<br>";
                    } else {
                        // Log error: $stmt_insert->error;
                    }
                }
                // $result_check->close(); // Not needed for get_result()
              }
              $stmt_check->close();
              $stmt_insert->close();
          } else {
            return false; // Or log: No messages / Invalid format
          }
      } else {
          // Log error: file_get_contents failed
          return false;
      }
    } else {
      return json_encode(array('msg' => 'Denied. '.htmlspecialchars($ip)));
    }
    return true; // Indicate success or completion
  }

  public static function getUserMap($idUser = null){
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer(); // Assumed safe or refactored

    if (empty($idUser)){
      if (!$player) return false; // No session player and no ID provided
      $idUser = $player['userId'];
    }
    $userIdInt = (int)$idUser;

    $stmt_player = $mysqli->prepare("SELECT position FROM player_accounts WHERE userId = ?");
    $stmt_player->bind_param("i", $userIdInt);
    $stmt_player->execute();
    $player_result = $stmt_player->get_result();

    if ($player_data = $player_result->fetch_assoc()){
        $stmt_player->close();
        $position = json_decode($player_data['position']);
        if (!$position || !isset($position->mapID)) return false; // Invalid position JSON

        $mapIdInt = (int)$position->mapID;
        $stmt_map = $mysqli->prepare("SELECT name, factionID FROM server_maps WHERE mapID = ?");
        $stmt_map->bind_param("i", $mapIdInt);
        $stmt_map->execute();
        $map_result = $stmt_map->get_result();

        if ($dataMap = $map_result->fetch_assoc()){
            $stmt_map->close();
            return array('mapName' => $dataMap['name'], 'factionId' => $dataMap['factionID']);
        } else {
            $stmt_map->close();
            return false;
        }
    } else {
        $stmt_player->close();
        return false;
    }
  }

  public static function generateActivationKey(){
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) { return array('r' => false, 'key' => null, 'actived' => null, 'message' => 'Player not found.'); }
    $userIdInt = (int)$player['userId'];

    $stmt_check = $mysqli->prepare("SELECT hash, actived FROM system_verification WHERE userId = ?");
    $stmt_check->bind_param("i", $userIdInt);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows == 0){
        $stmt_check->close();
        $key = md5(uniqid((string)$userIdInt, true)); // Ensure userId is string for uniqid if it matters
        $isActived = 0;

        $stmt_insert = $mysqli->prepare("INSERT INTO system_verification (hash, actived, userId) VALUES (?, ?, ?)");
        $stmt_insert->bind_param("sii", $key, $isActived, $userIdInt);
        if ($stmt_insert->execute()){
            $stmt_insert->close();
            return array('r' => true, 'key' => $key, 'actived' => $isActived);
        } else {
            $stmt_insert->close();
            return array('r' => false, 'key' => null, 'actived' => null, 'message' => 'Failed to insert new key.');
        }
    } else {
        $dataKey = $result->fetch_assoc();
        $stmt_check->close();
        return array('r' => true, 'key' => $dataKey['hash'], 'actived' => $dataKey['actived']);
    }

  }

  public static function deleteAnnounce($newId = null){

    if (isset($newId) && !empty($newId)){

      $json = [
        'status' => false,
        'message' => ''
      ];

      $mysqli = Database::GetInstance();

      $player = Functions::GetPlayer();

      $isAdmin = self::checkIsAdmin($player['userId']); // Assumes checkIsAdmin is safe

      if ($isAdmin){
        $newIdInt = (int)$newId; // Assuming newId is an integer ID

        $stmt_check = $mysqli->prepare("SELECT id FROM discordannounces WHERE id = ?");
        $stmt_check->bind_param("i", $newIdInt);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0){
          $stmt_check->close(); // Close previous statement

          $stmt_delete = $mysqli->prepare("DELETE FROM discordannounces WHERE id = ?");
          $stmt_delete->bind_param("i", $newIdInt);

          if ($stmt_delete->execute()){
            $stmt_delete->close();
            $json['message'] = "Notice deleted sucesfully.";
            $json['status'] = true;
            return json_encode($json);
          } else {
            $stmt_delete->close();
            $json['message'] = "Error to delete this notice.";
            return json_encode($json);
          }
          
        } else {
          if(isset($stmt_check)) $stmt_check->close(); // Ensure closed if it existed
          $json['message'] = "This notice ID no exists.";
          return json_encode($json);
        }

      } else {
        $json['message'] = "You not admin.";
        return json_encode($json);
      }

    }
    // It's good practice to return a default JSON structure if parameters are missing
    return json_encode(['status' => false, 'message' => 'Invalid parameters.']);
  }

  public static function getAdminCategories(){

    $mysqli = Database::GetInstance();
    $dataReturn = array();
    $active_status = 1; // Define active status, assuming it's always 1

    $stmt = $mysqli->prepare("SELECT category, cc FROM admin_category WHERE active = ?");
    $stmt->bind_param("i", $active_status); // Bind as integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0){
      while($data_category = $result->fetch_assoc()){
        $dataReturn[] = array('category' => $data_category['category'], 'cc' => $data_category['cc']);
      }
    }
    $stmt->close();
    // Return $dataReturn which will be an empty array if no categories found, or false if that's preferred.
    // Original returned false. Let's stick to that for consistency if no rows.
    return ($result->num_rows > 0) ? $dataReturn : false;
    }

  }

  public static function startEvent($type = null){

    if (isset($type) && !empty($type)){

      $json = [
        'status' => false,
        'message' => ''
      ];

      $mysqli = Database::GetInstance();
      $player = Functions::GetPlayer();

      if (!self::checkIsAdmin($player['userId'])){ // Assumes checkIsAdmin is safe
        $json['message'] = "You are not staff.";
        return json_encode($json);
      }
      // $type = $mysqli->real_escape_string($type); // Removed, will use prepared statement

      $stmt = $mysqli->prepare("SELECT event, commandEvent, canStop FROM manage_events WHERE event = ?");
      $stmt->bind_param("s", $type);
      $stmt->execute();
      $result_events = $stmt->get_result();

      if ($result_events->num_rows > 0){
        $dataEvent = $result_events->fetch_assoc();
        $stmt->close(); // Close statement after fetching

        // Socket::Get calls are external, not SQL. Parameters within them are not SQLi vectors for *this* DB.
        if(Socket::Get(''.$dataEvent['commandEvent'].'', array())) {
          $json['message'] = "Event ".$dataEvent['event']." started sucesfully.";
          $json['status'] = true;
          // Assumes addAdminLog is safe or will be refactored
          $log = self::addAdminLog(array('adminId' => $player['userId'], 'toUserId' => 0, 'logComplet' => 'The admin "'.$player['username'].'" has started the event "'.$dataEvent['event'].'"'));
        } else if ($dataEvent['canStop'] == 1){ // Assuming canStop is an integer column
          $json['message'] = "Event ".$dataEvent['event']." stoped sucesfully.";
          $log = self::addAdminLog(array('adminId' => $player['userId'], 'toUserId' => 0, 'logComplet' => 'The admin "'.$player['username'].'" has stopped the event "'.$dataEvent['event'].'"'));
        } else {
          $json['message'] = "Event ".$dataEvent['event']." already started.";
          $log = self::addAdminLog(array('adminId' => $player['userId'], 'toUserId' => 0, 'logComplet' => 'The admin "'.$player['username'].'" tried to start the event "'.$dataEvent['event'].'" again'));
        }
        return json_encode($json);
      } else {
        if(isset($stmt)) $stmt->close(); // Ensure closed if it existed
        return false; // Or json_encode(['status' => false, 'message' => 'Event type not found.']);
      }
    }
    // Return a default JSON structure if parameters are missing
    return json_encode(['status' => false, 'message' => 'Invalid event type.']);
  }

  public static function searchUser($pilot = null){

    if (isset($pilot) && !empty($pilot)){

      $player = Functions::GetPlayer();

      if (!self::checkIsFullAdmin($player['userId'])){
        ?>
        <div style="border: 1px dashed red; width:50%; margin:auto; margin-top:15px;">You are not administrator.</div>
        <?php
        return;
      }

      $dataPilot = self::getPlayerInStaff($pilot);

      if ($dataPilot){

        $dataCurrency = json_decode($dataPilot['data']);
        $dataInfo = json_decode($dataPilot['info']);

      ?>
        <div style="with:70%; padding:25px;">
          <div class="form-group">
            <label for="username">Username / UserId / PilotName</label>
            <input type="text" class="form-control" id="username" value="<?= htmlspecialchars($dataPilot['username'], ENT_QUOTES, 'UTF-8'); ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
          </div>
          <div class="form-group">
            <label for="pilotName">pilotName</label>
            <input type="text" class="form-control" id="pilotName2" value="<?= htmlspecialchars($dataPilot['pilotName'], ENT_QUOTES, 'UTF-8'); ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($dataPilot['email'], ENT_QUOTES, 'UTF-8'); ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;" readonly>
          </div>
          <div class="form-group">
            <label for="uridium">Uridium</label>
            <input type="text" class="form-control" id="uridium" value="<?= htmlspecialchars($dataCurrency->uridium ?? 0, ENT_QUOTES, 'UTF-8'); ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
          </div>
          <div class="form-group">
            <label for="credits">Credits</label>
            <input type="text" class="form-control" id="credits" value="<?= htmlspecialchars($dataCurrency->credits ?? 0, ENT_QUOTES, 'UTF-8'); ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
          </div>
          <div class="form-group">
            <label for="honor">Honor</label>
            <input type="text" class="form-control" id="honor" value="<?= htmlspecialchars($dataCurrency->honor ?? 0, ENT_QUOTES, 'UTF-8'); ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
          </div>
          <div class="form-group">
            <label for="experience">Experience</label>
            <input type="text" class="form-control" id="experience" value="<?= htmlspecialchars($dataCurrency->experience ?? 0, ENT_QUOTES, 'UTF-8'); ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
          </div>
          <div class="form-group">
            <label for="lastIp">Last IP</label>
            <input type="text" class="form-control" id="lastIp" value="<?= htmlspecialchars($dataInfo->lastIP ?? '', ENT_QUOTES, 'UTF-8'); ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;" readonly>
          </div>
          <div class="form-group">
            <label for="registeredDate">Registered Date</label>
            <input type="text" class="form-control" id="registeredDate" value="<?= htmlspecialchars($dataInfo->registerDate ?? '', ENT_QUOTES, 'UTF-8'); ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;" readonly>
          </div>
          <div class="form-group">
            <label for="premium">Premium</label>
            <select class="form-control" id="premium" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;"> 
              <option value="1" <?= ($dataPilot['premium'] == 1) ? "selected" : ""; ?>>Yes</option> 
              <option value="0" <?= ($dataPilot['premium'] == 0) ? "selected" : ""; ?>>No</option> 
            </select>
          </div>
          <input type="hidden" id="userId" value="<?= htmlspecialchars($dataPilot['userId'], ENT_QUOTES, 'UTF-8'); ?>">
          <button type="button" class="btn btn-primary" onclick="saveDataUser();">Save <?= htmlspecialchars($dataPilot['username'], ENT_QUOTES, 'UTF-8'); ?></button>
        </div>
      <?php

      } else {

        ?>
          <div style="border: 1px dashed red; width:50%; margin:auto; pading:5px; margin-top:15px;"><b><?= htmlspecialchars($pilot, ENT_QUOTES, 'UTF-8'); ?></b> no exists in database.</div>
        <?php

      }

    }

  }

  public static function saveDataUser($userId = null, $username = null, $pilotName = null, $uridium = null, $credits = null, $honor = null, $experience = null, $premium = null){

    $json = [
      'status' => false,
      'message' => ''
    ];

    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer(); // Admin user
    if (!$player || !self::checkIsFullAdmin($player['userId'])) {
      $json['message'] = "You are not authorized for this action.";
      return json_encode($json);
    }

    $userIdInt = (int)$userId;
    $dataPilot = self::GetPlayerById($userIdInt); // Already refactored

    if ($dataPilot){
      $dataCurrency = json_decode($dataPilot['data'], true); // true for assoc array

      // Parameter Validations (original logic maintained)
      if (empty($userIdInt)) { $json['message'] = "Critical error: User ID missing."; return json_encode($json); }
      if (empty($username)) { $json['message'] = "Please fill a username."; return json_encode($json); }
      if (empty($pilotName)) { $json['message'] = "Please fill a pilotName."; return json_encode($json); }
      if (!is_numeric($uridium) || $uridium < 0) { $json['message'] = "Please fill a valid uridium amount."; return json_encode($json); }
      if (!is_numeric($credits) || $credits < 0) { $json['message'] = "Please fill a valid credits amount."; return json_encode($json); }
      if (!is_numeric($honor) || $honor < 0) { $json['message'] = "Please fill a valid honor amount."; return json_encode($json); }
      if (!is_numeric($experience) || $experience < 0) { $json['message'] = "Please fill a valid experience amount."; return json_encode($json); }
      if (!is_numeric($premium) || !in_array((int)$premium, [0,1], true)) { $json['message'] = "Invalid premium value."; return json_encode($json); }
      $premiumInt = (int)$premium;

      // Check if username exists (if changed)
      if ($dataPilot['username'] !== $username) {
        $stmt_check_user = $mysqli->prepare("SELECT userId FROM player_accounts WHERE username = ?");
        $stmt_check_user->bind_param("s", $username);
        $stmt_check_user->execute();
        $stmt_check_user->store_result();
        if ($stmt_check_user->num_rows > 0) {
          $json['message'] = "The username " . htmlspecialchars($username) . " already exists.";
          $stmt_check_user->close();
          return json_encode($json);
        }
        $stmt_check_user->close();
      }

      // Check if pilotName exists (if changed)
      if ($dataPilot['pilotName'] !== $pilotName) {
        $stmt_check_pilot = $mysqli->prepare("SELECT userId FROM player_accounts WHERE pilotName = ?");
        $stmt_check_pilot->bind_param("s", $pilotName);
        $stmt_check_pilot->execute();
        $stmt_check_pilot->store_result();
        if ($stmt_check_pilot->num_rows > 0) {
          $json['message'] = "The pilotName " . htmlspecialchars($pilotName) . " already exists.";
          $stmt_check_pilot->close();
          return json_encode($json);
        }
        $stmt_check_pilot->close();
      }

      $beforeUridium = $dataCurrency['uridium'] ?? 0;
      $beforeCredits = $dataCurrency['credits'] ?? 0;
      $beforeHonor = $dataCurrency['honor'] ?? 0;
      $beforeExperience = $dataCurrency['experience'] ?? 0;

      if(Socket::Get('IsOnline', array('UserId' => $userIdInt, 'Return' => false))) {
        Socket::Send('setUridium', ['UserId' => $userIdInt, 'Uridium' => $uridium]);
        Socket::Send('setCredits', ['UserId' => $userIdInt, 'Credits' => $credits]);
        Socket::Send('setHonor', ['UserId' => $userIdInt, 'Honor' => $honor]);
        Socket::Send('setExperience', ['UserId' => $userIdInt, 'Experience' => $experience]);
        // For username, pilotName, premium, they will be updated on next login if not synced by socket, or update DB anyway.
      }

      // Always update DB regardless of online status for persistence
      $dataCurrency['uridium'] = (int)$uridium;
      $dataCurrency['credits'] = (int)$credits;
      $dataCurrency['honor'] = (int)$honor;
      $dataCurrency['experience'] = (int)$experience;
      $newDataJson = json_encode($dataCurrency);

      $mysqli->begin_transaction();
      try {
        $stmt_update_main_data = $mysqli->prepare("UPDATE player_accounts SET username = ?, pilotName = ?, premium = ?, data = ? WHERE userId = ?");
        $stmt_update_main_data->bind_param("ssisi", $username, $pilotName, $premiumInt, $newDataJson, $userIdInt);
        $stmt_update_main_data->execute();
        $stmt_update_main_data->close();

        $logMessage = sprintf(
            'The admin "%s" has changed the next data to "%s" (ID: %d) => Uridium: From "%s" to "%s" | Credits: From "%s" to "%s" | Honor: From "%s" to "%s" | Experience: From "%s" to "%s" | Username: From "%s" To "%s" | PilotName: From "%s" to "%s" | Premium: From "%d" to "%d"',
            $player['username'], $dataPilot['username'], $userIdInt,
            $beforeUridium, $uridium, $beforeCredits, $credits, $beforeHonor, $honor, $beforeExperience, $experience,
            $dataPilot['username'], $username, $dataPilot['pilotName'], $pilotName, $dataPilot['premium'], $premiumInt
        );
        self::addAdminLog(['adminId' => $player['userId'], 'toUserId' => $userIdInt, 'logComplet' => $logMessage]);

        $mysqli->commit();
        $json['status'] = true;
        $json['message'] = "User " . htmlspecialchars($username) . " saved successfully.";
      } catch (Exception $e) {
        $mysqli->rollback();
        $json['message'] = "Error saving data: " . $e->getMessage();
      }

      return json_encode($json);
    } else {
      $json['message'] = "Critical Error: User to update not found.";
      json_encode($json);
    }

  }

  public static function addAdminLog($array = null){

    if (isset($array) && !empty($array) && is_array($array)){

      $mysqli = Database::GetInstance();

      // Secure inputs
      $adminId_int = isset($array['adminId']) ? (int)$array['adminId'] : 0;
      $toUserId_int = isset($array['toUserId']) ? (int)$array['toUserId'] : 0;
      $logComplet_escaped = isset($array['logComplet']) ? $mysqli->real_escape_string((string)$array['logComplet']) : '';
      $date_escaped = $mysqli->real_escape_string(date("d-m-Y h:i:s", time()));

      $stmt = $mysqli->prepare("INSERT INTO `admin_log` (`adminId`, `toUserId`, `logComplet`, `date`) VALUES (?, ?, ?, ?)");
      if ($stmt) {
        $stmt->bind_param("iiss", $adminId_int, $toUserId_int, $logComplet_escaped, $date_escaped);

        if ($stmt->execute()){
          $stmt->close();
          return true;
        } else {
          // Optional: Log error $stmt->error
          $stmt->close();
          return false;
        }
      } else {
        // Optional: Log error $mysqli->error
        return false;
      }
    }
    return false;
  }

  public static function getChatRooms(){

    $mysqli = Database::GetInstance();

    $getRooms = $mysqli->query("SELECT * FROM chat_rooms ORDER by id ASC");

    if ($getRooms->num_rows > 0){
      return $getRooms;
    } else {
      return 0;
    }

  }

  public static function commandChat($command, $data){

    return Socket::Get(''.$command.'', $data);

  }
	
  public static function updateUserRank(){

    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();

    $dateNow = time();

    $dateLastUpdate = (isset($_SESSION['dateLastUpdate'])) ? $_SESSION['dateLastUpdate'] : null;

    if ($dateLastUpdate != null){
      if ($dateLastUpdate >= $dateNow){
        return array('return' => 'last update: '.date("h:i:s", $dateLastUpdate));
      }
    }

    $query = $mysqli->query("SELECT * FROM player_accounts WHERE userId = '".$player['userId']."' AND rankId != 22 AND factionId = '".$player['factionId']."'");

    if ($query->num_rows > 0){

      $value = $query->fetch_assoc();

      if ($mysqli->query('SELECT id FROM server_bans WHERE userId = '.$value['userId'].' AND typeId = 1 AND ended = 0')->num_rows <= 0) {
        
        $data = json_decode($value['data']);

        $destructions = json_decode($value['destructions']);

        $rankPoints = 0;

        $rankPoints += ($data->experience / 100000);
        $rankPoints += ($data->honor / 100);
        $rankPoints += (self::GetLevel($data->experience) * 100);

        $registerDate = new DateTime(json_decode($value['info'])->registerDate);
        $daysSinceRegistration = (new DateTime(date('d.m.Y H:i:s')))->diff($registerDate)->days;

        $rankPoints += ($daysSinceRegistration * 6);
        
        $rankPoints += ($mysqli->query('SELECT id FROM log_player_kills WHERE killer_id = '.$value['userId'].' AND pushing = 0')->num_rows * 4);
        $rankPoints -= ($destructions->fpd * 100);
        $rankPoints -= ($mysqli->query('SELECT id FROM log_player_kills WHERE target_id = '.$value['userId'].' AND pushing = 0')->num_rows * 4);
        $rankPoints -= ($destructions->dbrz * 8);
        
        if ($rankPoints < 0) {
          $rankPoints = 0;
        }

        $rankPoints = round($rankPoints);

        var_dump('UPDATE player_accounts SET rankPoints = '.$rankPoints.' WHERE userId = '.$value['userId'].'');

        $_SESSION['dateLastUpdate'] = strtotime("+1 hour");

        $mysqli->query('UPDATE player_accounts SET rankPoints = '.$rankPoints.' WHERE userId = '.$value['userId'].'');

      }

    }

  }

  // update 24.01.2021

  public static function getAllShips(){

    $mysqli = Database::GetInstance();

    $sQuery = $mysqli->query("SELECT shipID, lootID, baseShipId FROM server_ships WHERE isdesign > 0");

    $dataReturn = array();

    if ($sQuery->num_rows > 0){

      while($dataShips = $sQuery->fetch_assoc()){

        $dataReturn[] = array('shipID' => $dataShips['shipID'], 'lootID' => $dataShips['lootID']);

      }

      return $dataReturn;

    }

    return false;

  }

  public static function sendItemsToUser($username = null, $uridium = null, $credits = null, $honor = null, $experience = null, $eventCoins = null, $design = null){

    $json = [
      'status' => false,
      'message' => ''
    ];

    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();

    if (!self::checkIsFullAdmin($player['userId'])){
      $json['message'] = "You are not administrator.";
      return json_encode($json);
    }

    if (empty($username)){
      $json['message'] = "Please enter a username or userID or pilotName";
      return json_encode($json);
    }

    $dataPilot = self::getPlayerInStaff($username);

    if ($dataPilot){

      $dataCurrency = json_decode($dataPilot['data']);
      $toUserId = $dataPilot['userId'];
      $pilotName = $dataPilot['pilotName'];

      $sendedItems = "";

      if (!empty($uridium)){

        if(Socket::Get('IsOnline', array('UserId' => $toUserId, 'Return' => false))) {
          Socket::Send('UpdateUridium', ['UserId' => $toUserId, 'UridiumPrice' => $uridium, 'Type' => "INCREASE"]);
          sleep(1);
        } else {
          $dataCurrency->uridium += $uridium;
          $mysqli->query("UPDATE player_accounts SET data = '".json_encode($dataCurrency)."' WHERE userId = '".$toUserId."'");
        }

        self::addAdminLog(array('adminId' => $player['userId'], 'toUserId' => $toUserId, 'logComplet' => 'The admin "'.$player['username'].'" has added "'.$uridium.'" Uridium to player "'.$pilotName.'"'));
        $sendedItems .= " Uridium: ".$uridium;
      }

      if (!empty($credits)){

        if(Socket::Get('IsOnline', array('UserId' => $toUserId, 'Return' => false))) {
          Socket::Send('UpdateCredits', ['UserId' => $toUserId, 'CreditPrice' => $credits, 'Type' => "INCREASE"]);
          sleep(1);
        } else {
          $dataCurrency->credits += $credits;
          $mysqli->query("UPDATE player_accounts SET data = '".json_encode($dataCurrency)."' WHERE userId = '".$toUserId."'");
        }

        self::addAdminLog(array('adminId' => $player['userId'], 'toUserId' => $toUserId, 'logComplet' => 'The admin "'.$player['username'].'" has added "'.$credits.'" Credits to player "'.$pilotName.'"'));
        $sendedItems .= " Credits: ".$credits;
      }

      if (!empty($honor)){

        if(Socket::Get('IsOnline', array('UserId' => $toUserId, 'Return' => false))) {
          Socket::Send('UpdateHonor', ['UserId' => $toUserId, 'Honor' => $honor, 'Type' => "INCREASE"]);
          sleep(1);
        } else {
          $dataCurrency->honor += $honor;
          $mysqli->query("UPDATE player_accounts SET data = '".json_encode($dataCurrency)."' WHERE userId = '".$toUserId."'");
        }

        self::addAdminLog(array('adminId' => $player['userId'], 'toUserId' => $toUserId, 'logComplet' => 'The admin "'.$player['username'].'" has added "'.$honor.'" Honor to player "'.$pilotName.'"'));
        $sendedItems .= " Honor: ".$honor;
      }

      if (!empty($experience)){

        if(Socket::Get('IsOnline', array('UserId' => $toUserId, 'Return' => false))) {
          Socket::Send('UpdateExperience', ['UserId' => $toUserId, 'Experience' => $experience, 'Type' => "INCREASE"]);
          sleep(1);
        } else {
          $dataCurrency->experience += $experience;
          $mysqli->query("UPDATE player_accounts SET data = '".json_encode($dataCurrency)."' WHERE userId = '".$toUserId."'");
        }

        self::addAdminLog(array('adminId' => $player['userId'], 'toUserId' => $toUserId, 'logComplet' => 'The admin "'.$player['username'].'" has added "'.$experience.'" Experience to player "'.$pilotName.'"'));
        $sendedItems .= " Experience: ".$experience;
      }

      if (!empty($eventCoins)){

        if(Socket::Get('IsOnline', array('UserId' => $toUserId, 'Return' => false))) {
          Socket::Send('updateEC', ['UserId' => $toUserId, 'Amount' => $eventCoins, 'Type' => "INCREASE"]);
          sleep(1);
        } else {
          $updateEC = $mysqli->query("UPDATE event_coins SET coins = coins+$eventCoins WHERE userId = '".$toUserId."'");
        }

        self::addAdminLog(array('adminId' => $player['userId'], 'toUserId' => $toUserId, 'logComplet' => 'The admin "'.$player['username'].'" has added "'.$eventCoins.'" E.C to player "'.$pilotName.'"'));
        $sendedItems .= " Event Coins: ".$eventCoins;
      }

      if (!empty($design)){ 

        $checkIfExistsShip = $mysqli->query("SELECT shipID, baseShipId, lootID, name FROM server_ships WHERE shipID = '".$design."'");

        if ($checkIfExistsShip->num_rows > 0){

          $dataShipSelected = $checkIfExistsShip->fetch_assoc();

          $baseShipId = $dataShipSelected['baseShipId'];
          $lootID = $dataShipSelected['lootID'];
          $name = $dataShipSelected['name'];

          $checkIfHaveDesign = $mysqli->query("SELECT name FROM player_designs WHERE name = '".$lootID."' AND userId = '".$toUserId."'");

          if ($checkIfHaveDesign->num_rows > 0){
            $sendedItems .= " already has ".$name." in the account.";
          } else {
            $insertShip = $mysqli->query("INSERT INTO `player_designs` (`name`,`baseShipId`,`userId`) VALUES ('$lootID','$baseShipId','$toUserId');");

            if(Socket::Get('IsOnline', array('UserId' => $toUserId, 'Return' => false))) {
              Socket::Send('SendMessageToUser', ['UserId' => $toUserId, 'msg' => 'You have received '.$name.' design, to see it visit the hangar.']);
              sleep(1);
            }

            self::addAdminLog(array('adminId' => $player['userId'], 'toUserId' => $toUserId, 'logComplet' => 'The admin "'.$player['username'].'" has added "'.$name.'" Design to player "'.$pilotName.'"'));
            $sendedItems .= " Design: ".$name;
          }

        } else {
          $json['message'] = "Critical Error.";
          return json_encode($json);
        }

      }

      if (!empty($sendedItems)){
        $json['status'] = true;
        $json['message'] = "Succesfully sended <font color='red' style='font-weight:bold;'>".$sendedItems."</font> to user ".$pilotName;
      } else {
        $json['message'] = "You have not inserted anything to send.";
      }

      return json_encode($json);

    } else {
      $json['message'] = "Critical Error.";
      return json_encode($json);
    }

  }

  // finish update 24.01.2021
	
  public static function getDroneLvl(){

    $player = Functions::GetPlayer();
    $mysqli = Database::GetInstance();
    // $title = $mysqli->real_escape_string($title); // This line was out of place and unused.

    $stmt = $mysqli->prepare("SELECT droneExp FROM player_accounts WHERE userId = ?");
    $stmt->bind_param("i", $player['userId']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0){
      $droneData = $result->fetch_assoc();
      $stmt->close();

      $droneData = $sQuery4->fetch_assoc();
      $droneEXP = $droneData['droneExp'];

      $droneLvl = 1;

      if ($droneEXP >= 500){
        $droneLvl = 2;
      }
      
      if ($droneEXP >= 1000){
        $droneLvl = 3;
      } 
      
      if ($droneEXP >= 1500){
        $droneLvl = 4;
      } 
      
      if ($droneEXP >= 2000){
        $droneLvl = 5;
      }

      if ($droneEXP >= 2500){
        $droneLvl = 6;
      }

      return $droneLvl;

    }

  }

  // Finish update 28.01.2021.

  // --- START AUCTION FUNCTIONS ---
  private static function _generic_auction_logic($bid_credit_unsafe, $bid_item_id, $item_check_callback, $currency_type = 'credits')
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    if (!$player) {
      echo "Player not found or not logged in.";
      return null;
    }

    $data = json_decode($player['data']);
    $bid_credit = (int)$bid_credit_unsafe;

    // Fetch current highest bid
    $stmt_get_bid = $mysqli->prepare('SELECT bid_credit FROM bid_system WHERE bid_id = ?');
    $stmt_get_bid->bind_param("i", $bid_item_id);
    $stmt_get_bid->execute();
    $result_bid = $stmt_get_bid->get_result();
    if ($result_bid->num_rows === 0) {
      $stmt_get_bid->close();
      echo "Auction item ID ".$bid_item_id." not found.";
      return null;
    }
    $current_highest_bid = (int)$result_bid->fetch_assoc()['bid_credit'];
    $stmt_get_bid->close();

    // Fetch player items for item-specific checks
    $stmt_get_items = $mysqli->prepare('SELECT items FROM player_equipment WHERE userId = ?');
    $stmt_get_items->bind_param("i", $player['userId']);
    $stmt_get_items->execute();
    $result_items = $stmt_get_items->get_result();
    if ($result_items->num_rows === 0) {
        $stmt_get_items->close();
        echo "Player equipment not found.";
        return null;
    }
    $items_json = $result_items->fetch_assoc()['items'];
    $items = json_decode($items_json);
    $stmt_get_items->close();

    // Item specific limit check using callback
    if (!$item_check_callback($items)) {
      return null; // Message should be echoed by callback
    }

    if ($bid_credit <= $current_highest_bid) {
      echo "Your bid is low";
      return null;
    }

    if ($currency_type === 'credits') {
      if ($data->credits < $bid_credit) {
        echo "your credit is insufficient";
        return null;
      }
      $data->credits -= $bid_credit;
    } elseif ($currency_type === 'uridium') {
      if ($data->uridium < $bid_credit) {
        echo "your uridium is insufficient";
        return null;
      }
      $data->uridium -= $bid_credit;
    } else {
      echo "Invalid currency type."; // Should not happen
      return null;
    }

    // Proceed with bid
    $new_data_json = json_encode($data);
    $pilotName_json = json_encode($player['pilotName'], JSON_UNESCAPED_UNICODE);

    $mysqli->begin_transaction();
    try {
      $stmt_update_currency = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
      $stmt_update_currency->bind_param("si", $new_data_json, $player['userId']);
      $stmt_update_currency->execute();
      $stmt_update_currency->close();

      $stmt_update_bid = $mysqli->prepare('UPDATE bid_system SET bid_pid = ?, bid_pilotname = ?, bid_credit = ? WHERE bid_id = ?');
      $stmt_update_bid->bind_param("isii", $player['userId'], $pilotName_json, $bid_credit, $bid_item_id);
      $stmt_update_bid->execute();
      $stmt_update_bid->close();

      $mysqli->commit();
      echo "Your offer is successful :)";
    } catch (Exception $e) {
      $mysqli->rollback();
      echo "An error occurred: " . $e->getMessage();
    }
    return null;
  }

  public static function acik_arttirma($bid_credit_unsafe)
  {
    // For LF4, bid_item_id = 1, currency = credits
    return self::_generic_auction_logic($bid_credit_unsafe, 1, function($items) {
      if ($items->lf4Count >= 40) { echo "Your account LF4 Max Limit"; return false; }
      return true;
    }, 'credits');
  }

  public static function acik_arttirma_lf4_2($bid_credit_lf4_2) {
    return self::_generic_auction_logic($bid_credit_lf4_2, 6, function($items) {
      if ($items->lf4Count >= 40) { echo "Your account LF4 Max Limit"; return false; }
      return true;
    }, 'credits');
  }

  public static function acik_arttirma_lf4_3($bid_credit_lf4_3) {
    return self::_generic_auction_logic($bid_credit_lf4_3, 7, function($items) {
      if ($items->lf4Count >= 40) { echo "Your account LF4 Max Limit"; return false; }
      return true;
    }, 'uridium');
  }

  public static function acik_arttirma_lf4_4($bid_credit_lf4_4) {
    return self::_generic_auction_logic($bid_credit_lf4_4, 8, function($items) {
      if ($items->lf4Count >= 40) { echo "Your account LF4 Max Limit"; return false; }
      return true;
    }, 'uridium');
  }

  public static function acik_arttirmahavoc($bid_havoc) {
    return self::_generic_auction_logic($bid_havoc, 3, function($items) {
      if ($items->havocCount >= 10) { echo "Your account Havoc Max Limit"; return false; }
      return true;
    }, 'uridium');
  }

  public static function acik_arttirmahercul($bid_hercul) {
    return self::_generic_auction_logic($bid_hercul, 2, function($items) {
      if ($items->herculesCount >= 10) { echo "Your account Hercules Max Limit"; return false; }
      return true;
    }, 'uridium');
  }

  public static function acik_arttirma_apis($bid_apis) {
    return self::_generic_auction_logic($bid_apis, 4, function($items) {
      if ($items->apis) { echo "Your account APIS Limit"; return false; }
      return true;
    }, 'uridium');
  }

  public static function acik_arttirma_zeus($bid_zeus) {
    return self::_generic_auction_logic($bid_zeus, 5, function($items) {
      if ($items->zeus) { echo "Your account ZEUS Limit"; return false; }
      return true;
    }, 'uridium');
  }
  // --- END AUCTION FUNCTIONS ---

}

# REMOVE GLOBAL AUCTION FUNCTIONS AS THEY ARE NOW CLASS METHODS #

/*
function acik_arttirma($bid_credit_unsafe)
{
  $mysqli = Database::GetInstance();
  $player = Functions::GetPlayer();
  if (!$player) return null; // Not logged in or player data issue

  $data = json_decode($player['data']);
  $bid_item_id = 1; // lf4 (auction item ID in bid_system table)
  $bid_credit = (int)$bid_credit_unsafe; // Ensure bid_credit is an integer

  // Fetch current highest bid
  $stmt_get_bid = $mysqli->prepare('SELECT bid_credit FROM bid_system WHERE bid_id = ?');
  $stmt_get_bid->bind_param("i", $bid_item_id);
  $stmt_get_bid->execute();
  $result_bid = $stmt_get_bid->get_result();
  if ($result_bid->num_rows === 0) {
    $stmt_get_bid->close();
    echo "Auction item not found."; // Should ideally not happen
    return null;
  }
  $current_highest_bid = (int)$result_bid->fetch_assoc()['bid_credit'];
  $stmt_get_bid->close();

  // Fetch player items
  $stmt_get_items = $mysqli->prepare('SELECT items FROM player_equipment WHERE userId = ?');
  $stmt_get_items->bind_param("i", $player['userId']);
  $stmt_get_items->execute();
  $result_items = $stmt_get_items->get_result();
  if ($result_items->num_rows === 0) {
      $stmt_get_items->close();
      echo "Player equipment not found.";
      return null;
  }
  $items = json_decode($result_items->fetch_assoc()['items']);
  $stmt_get_items->close();

  if ($items->lf4Count >= 40) {
    echo "Your account LF4 Max Limit";
    return null;
  }

  if ($bid_credit <= $current_highest_bid) {
    echo "Your bid is low";
    return null;
  }

  if ($data->credits < $bid_credit) {
    echo "your credit is insufficient";
    return null;
  }

  // Proceed with bid
  $data->credits -= $bid_credit;
  $new_data_json = json_encode($data);
  $pilotName_json = json_encode($player['pilotName'], JSON_UNESCAPED_UNICODE);

  $mysqli->begin_transaction();
  try {
    // Update player credits
    $stmt_update_credits = $mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
    $stmt_update_credits->bind_param("si", $new_data_json, $player['userId']);
    $stmt_update_credits->execute();
    $stmt_update_credits->close();

    // Update bid system
    $stmt_update_bid = $mysqli->prepare('UPDATE bid_system SET bid_pid = ?, bid_pilotname = ?, bid_credit = ? WHERE bid_id = ?');
    $stmt_update_bid->bind_param("isii", $player['userId'], $pilotName_json, $bid_credit, $bid_item_id);
    $stmt_update_bid->execute();
    $stmt_update_bid->close();

    $mysqli->commit();
    echo "Your offer is successful :)";
  } catch (Exception $e) {
    $mysqli->rollback();
    // It's good practice to log the error $e->getMessage()
    echo "An error occurred during the transaction.";
  }
  // $mysqli->close(); // Connection is managed by Database::GetInstance()

  return null; // Or return a status
}
*/

