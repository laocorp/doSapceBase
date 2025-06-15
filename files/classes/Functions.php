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

    if ($mysqli->query('SELECT userId FROM player_accounts WHERE username = "' . $username . '"')->num_rows <= 0) {

      if ($mysqli->query('SELECT userId FROM player_accounts WHERE email = "' . $email . '"')->num_rows > 0) {
        $json['type'] = "email";
        $json['message'] = "This email is already taken.";

        return json_encode($json);
      }

      $ip = Functions::GetIP();
      $sessionId = Functions::GetUniqueSessionId();
      $pilotName = $username;

      if ($mysqli->query('SELECT userId FROM player_accounts WHERE pilotName = "' . $pilotName . '"')->num_rows >= 1) {
        $pilotName = Functions::GetUniquePilotName($pilotName);
      }

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

        $mysqli->query("INSERT INTO player_accounts (sessionId, username, pilotName, email, password, info, verification, shipId) VALUES ('" . $sessionId . "', '" . $username . "', '" . $pilotName . "', '" . $email . "',  '" . password_hash($password, PASSWORD_DEFAULT) . "', '" . json_encode($info) . "', '" . json_encode($verification) . "', '1')");

        $userId = $mysqli->insert_id;

        $mysqli->query('INSERT INTO player_equipment (userId) VALUES (' . $userId . ')');
        $mysqli->query('INSERT INTO player_settings (userId) VALUES (' . $userId . ')');
        $mysqli->query('INSERT INTO player_titles (userID) VALUES (' . $userId . ')');
        $mysqli->query('INSERT INTO player_skilltree (userID) VALUES (' . $userId . ')');
        $mysqli->query('INSERT INTO event_coins (userID, coins) VALUES (' . $userId . ', ' . 100 . ')');

        SMTP::SendMail($email, $username, 'E-mail verification', '<p>Hi ' . $username . ', <br>Click this link to activate your account: <a href="' . DOMAIN . 'api/verify/' . $userId . '/' . $verification['hash'] . '">Activate</a></p><p style="font-size:small;color:#666">—<br>You are receiving this because you registered to the ' . SERVER_NAME . '.<br>If that was not your request, then you can ignore this email.<br>This is an automated message, please do not reply directly to this email.</p>');
  
        $_SESSION['account']['id'] = $userId;
        $_SESSION['account']['session'] = $sessionId; 

        try {
          $mysqli->query('UPDATE player_accounts SET sessionId = "' . $sessionId . '" WHERE userId = ' . $userId . '');
          $mysqli->commit();
        } catch (Exception $e) {
          error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
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
        error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
        $json['type'] = "resultAll";
        $json['message'] = 'An error occurred. Please try again later.';
        $mysqli->rollback();

        return json_encode($json);
      }
    } else {
      $json['type'] = "username";
      $json['message'] = 'This username is already taken.';

      return json_encode($json);
    }
  }

  public static function checkIsAdmin($id = null){
    if ($id){
      $mysqli = Database::GetInstance();
      $checkIsAdmin = $mysqli->query('SELECT userId, type FROM chat_permissions WHERE userId = "'.$id.'"');
      if ($checkIsAdmin->num_rows > 0){
        $type = (integer) $checkIsAdmin->fetch_assoc()['type'];
        return ($type == 1 || $type == 2);
      }
    }
    return false;
  }

  public static function checkIsFullAdmin($id = null){
    if ($id){
      $mysqli = Database::GetInstance();
      $checkIsAdmin = $mysqli->query('SELECT userId, type FROM chat_permissions WHERE userId = "'.$id.'"');
      if ($checkIsAdmin->num_rows > 0){
        $type = (integer) $checkIsAdmin->fetch_assoc()['type'];
        return ($type == 1);
      }
    }
    return false;
  }

  public static function addVoucherLog($voucher = null, $id = null, $item = null, $amount = null){
    if (isset($item) && isset($amount) && isset($id)){
      $mysqli = Database::GetInstance();
      return (bool)$mysqli->query("INSERT INTO `voucher_log` (`voucher`, `userId`, `item`,`amount`,`date`) VALUES ('$voucher', '$id', '$item','$amount','".time()."');");
    }
    return false;
  }

  public static function getInfoGalaxyGate($gateId){
    if (isset($gateId) && !empty($gateId) && is_numeric($gateId)){
      $mysqli = Database::GetInstance();
      $id = $mysqli->real_escape_string(Functions::s($_SESSION['account']['id']));
      $json = ['message' => '', 'lives' => 0];
      $checkGate = $mysqli->query("SELECT * FROM player_galaxygates WHERE gateId = '$gateId' AND userId = '$id'");
      if ($checkGate->num_rows > 0){
        $infoP = $checkGate->fetch_assoc();
        $json['lives'] = $infoP['lives'];
      }
      return json_encode($json);
    }
    return json_encode(['message' => '', 'lives' => 0]);
  }

  private static function getInfoGateDetails($gateId) {
    $mysqli = Database::GetInstance();
    $queryGate = $mysqli->query("SELECT * FROM info_galaxygates WHERE gateId = '$gateId'");
    if ($queryGate->num_rows > 0) {
        return $queryGate->fetch_assoc();
    }
    return null;
  }

  public static function buyLive($gateId){
    if (isset($gateId) && !empty($gateId) and is_numeric($gateId)){
      $mysqli = Database::GetInstance();
      $id = $mysqli->real_escape_string(Functions::s($_SESSION['account']['id']));
      $json = ['message' => '', 'lives' => 0];

      $gateProperties = self::getInfoGateDetails($gateId);

      if (!$gateProperties || !isset($gateProperties['live_cost']) || !isset($gateProperties['name'])){
        $json['message'] = "Please select a valid unlock gate or gate information is incomplete.";
        return json_encode($json);
      }
      if (isset($_SESSION['ggtime']) and $_SESSION['ggtime'] >= time()){
        $json['message'] = "Please wait 5 seconds";
        return json_encode($json);
      }

      $playerAccount = $mysqli->query('SELECT data FROM player_accounts WHERE userId = ' . $id . '')->fetch_assoc();
      $data = json_decode($playerAccount['data'], true);

      if ($data['uridium'] < $gateProperties['live_cost']){
        $json['message'] = "You don't have enough Uridium.";
        return json_encode($json);
      }

      $_SESSION['ggtime'] = strtotime('+5 second');
      $data['uridium'] -= $gateProperties['live_cost'];

      if(Socket::Get('IsOnline', array('UserId' => $id, 'Return' => false))) {
        Socket::Send('UpdateUridium', ['UserId' => $id, 'UridiumPrice' => $gateProperties['live_cost'], 'Type' => "DECREASE"]);
      } else {
        $mysqli->query("UPDATE player_accounts SET data = '".json_encode($data)."' WHERE userId = '$id'");
      }
      $json['uridium'] = number_format($data['uridium'], 0, ',', '.');

      $checkGate = $mysqli->query("SELECT * FROM player_galaxygates WHERE gateId = '$gateId' AND userId = '$id'");
      if ($checkGate->num_rows > 0){
        $dataGate = $checkGate->fetch_assoc();
        $mysqli->query("UPDATE player_galaxygates SET lives = lives+1 WHERE userId = '$id' AND gateId = '$gateId'");
        $json['lives'] = $dataGate['lives']+1;
      } else {
        $mysqli->query("INSERT INTO `player_galaxygates` (`userId`, `gateId`, `parts`, `lives`, `prepared`, `wave`) VALUES ('$id', '$gateId', '[]', '4', '0', '1')");
        $json['lives'] = 4;
      }
      $json['message'] = "Sucesfully buyed 1 live.";
      $json['log'] = "Buyed 1 live in ".$gateProperties['name']." gate";
      $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
      self::gg_log($json['log'], $id);
      return json_encode($json);
    }
     return json_encode(['message' => 'Error with gateId.', 'lives' => 0]);
  }

  public static function ggPreparePortal($gateId){
    if (isset($gateId) and !empty($gateId) and is_numeric($gateId)){
      $mysqli = Database::GetInstance();
      $id = $mysqli->real_escape_string(Functions::s($_SESSION['account']['id']));
      $json = ['message' => ''];
      $checkGate = $mysqli->query("SELECT * FROM player_galaxygates WHERE gateId = '$gateId' AND userId = '$id'");
      $gateProperties = self::getInfoGateDetails($gateId);

      if (!$gateProperties || !isset($gateProperties['name']) || !isset($gateProperties['parts'])) {
          $json['message'] = "Invalid gate selected or gate properties missing.";
          return json_encode($json);
      }

      if ($checkGate->num_rows > 0){
        $dataQ = $checkGate->fetch_assoc();
        if ($dataQ['prepared'] == '1'){
          $json['message'] = $gateProperties['name']." is ready.";
          return json_encode($json);
        }
        $dataGate = json_decode($dataQ['parts']);
        $totalParts = 0;
        if (is_array($dataGate)) {
            foreach($dataGate as $dg){
              $totalParts += $dg;
            }
        }
        if ($totalParts >= $gateProperties['parts']){
          $q = $mysqli->query("UPDATE player_galaxygates SET prepared = 1 WHERE userId = '$id' AND gateId = '$gateId'");
          if ($q){
            $json['message'] = $gateProperties['name']." gate has prepared sucesfully.";
          } else {
            $json['message'] = "Error to prepare the gate ".$gateProperties['name'];
          }
        } else {
          $json['message'] = $gateProperties['name']." gate not unlocked. Complete the parts. Current parts: ".$totalParts."/".$gateProperties['parts'];
        }
      } else {
        $json['message'] = $gateProperties['name']." gate not unlocked. Complete all parts.";
      }
      return json_encode($json);
    }
    return json_encode(['message' => 'Invalid gateId for preparing portal.']);
  }

  public static function getInfoGate($gateId, $json_format = false){
    if (isset($gateId) and !empty($gateId) and is_numeric($gateId)){
      $mysqli = Database::GetInstance();
      $queryGate = $mysqli->query("SELECT * FROM info_galaxygates WHERE gateId = '$gateId'");
      if ($queryGate->num_rows > 0){
        $dataGate = $queryGate->fetch_assoc();
        if ($json_format){
          return json_encode(array('name' => $dataGate['name'], 'parts' => $dataGate['parts'], 'cost' => number_format($dataGate['cost'], 0, ',', '.'), 'live_cost' => number_format($dataGate['live_cost'], 0, ',', '.')));
        } else {
          return array($gateId => array('name' => $dataGate['name'], 'parts' => $dataGate['parts'], 'cost' => $dataGate['cost'], 'live_cost' => $dataGate['live_cost']));
        }
      }
    }
    return false;
  }

  public static function gg_log($log, $userId){
    if (isset($log) && isset($userId)){
      $mysqli = Database::GetInstance();
      return (bool)$mysqli->query("INSERT INTO `gg_log` (`log`, `userId`, `date`) VALUES ('$log','$userId','".time()."');");
    }
    return false;
  }

  public static function gg($gateId){
    if (isset($gateId) and !empty($gateId) and is_numeric($gateId)){
      $mysqli = Database::GetInstance();
      $num = rand(1,38);

      // $num: 1-5 => Grant 1 part
      if ($num >= 1 && $num <= 5){
        $result = array('uridium' => '', 'parts' => 1, 'ammoType' => '', 'ammoAmount' => '');
      // $num: 6-10 => Grant 10 ammunition_rocketlauncher_ubr-100
      } elseif ($num >= 6 && $num <= 10){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_rocketlauncher_ubr-100', 'ammoAmount' => '10');
      // $num: 11-15 => Grant 215 ammunition_laser_mcb-50
      } elseif ($num >= 11 && $num <= 15){
        $result = array('uridium' => '', 'parts' => 0, 'ammoType' => 'ammunition_laser_mcb-50', 'ammoAmount' => '215');
      // $num: 16-17 => Grant 150 ammunition_laser_ucb-100
      } elseif ($num >= 16 && $num <= 17){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_ucb-100', 'ammoAmount' => '150');
      // $num: 18-19 => Grant 45 ammunition_rocket_plt-2021
      } elseif ($num >= 18 && $num <= 19){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_rocket_plt-2021', 'ammoAmount' => '45');
	  // $num: 20-21 => Grant 3 parts
      } elseif ($num >= 20 && $num <= 21){
        $result = array('uridium' => '0', 'parts' => 3, 'ammoType' => 'ammunition_rocket_plt-2021', 'ammoAmount' => '');
	  // $num: 22-23 => Grant 325 ammunition_laser_mcb-25
      } elseif ($num >= 22 && $num <= 23){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_mcb-25', 'ammoAmount' => '325');
	  // $num: 24-25 => Grant 15 ammunition_rocketlauncher_ubr-100
      } elseif ($num >= 24 && $num <= 25){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_rocketlauncher_ubr-100', 'ammoAmount' => '15');
	  // $num: 26-27 => Grant 250 ammunition_laser_sab-50
      } elseif ($num >= 26 && $num <= 27){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_sab-50', 'ammoAmount' => '250');
	  // $num: 28-29 => Grant 40 ammunition_rocketlauncher_eco-10
      } elseif ($num >= 28 && $num <= 29){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_rocketlauncher_eco-10', 'ammoAmount' => '40');
	  // $num: 30-31 => Grant 350 ammunition_laser_ucb-100
      } elseif ($num >= 30 && $num <= 31){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_ucb-100', 'ammoAmount' => '350');
	  // $num: 32-33 => Grant 35 ammunition_rocket_plt-3030
      } elseif ($num >= 32 && $num <= 33){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_rocket_plt-3030', 'ammoAmount' => '35');
	  // $num: 34-35 => Grant 175 ammunition_laser_mcb-50
      } elseif ($num >= 34 && $num <= 35){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_mcb-50', 'ammoAmount' => '175');
	  // $num: 36-37 => Grant 230 ammunition_laser_mcb-25
      } elseif ($num >= 36 && $num <= 37){
        $result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_mcb-25', 'ammoAmount' => '230');
      // $num: 38 (else part) => Grant 2 parts
      } else { // This covers $num == 38
        $result = array('uridium' => '0', 'parts' => 2, 'ammoType' => '', 'ammoAmount' => '');
      }

      $json = ['message' => "", 'lives' => 0];
      $gateProperties = self::getInfoGateDetails($gateId);

      if (!$gateProperties || !isset($gateProperties['cost']) || !isset($gateProperties['parts']) || !isset($gateProperties['name'])) {
          $json['message'] = "Please select a valid unlock gate or gate information is incomplete.";
          return json_encode($json);
      }

      $id = $mysqli->real_escape_string(Functions::s($_SESSION['account']['id']));
      $playerAccount = $mysqli->query('SELECT data, ammo FROM player_accounts WHERE userId = ' . $id . '')->fetch_assoc();
      $data = json_decode($playerAccount['data'], true);
      $ammo_json = isset($playerAccount['ammo']) ? json_decode($playerAccount['ammo']) : new stdClass();


      $json['uridium'] = number_format($data['uridium'], 0, ',', '.');
      $checkIfExistsParts = $mysqli->query("SELECT * FROM player_galaxygates WHERE userId = '$id' AND gateId = '$gateId'");

      if ($checkIfExistsParts->num_rows > 0){
        $infoQData = $checkIfExistsParts->fetch_assoc();
        $dataParts = json_decode($infoQData['parts']);
        $totalParts = 0;
        if(is_array($dataParts)) { foreach ($dataParts as $part) $totalParts += $part; }
        if ($totalParts >= $gateProperties['parts']){
          $json['message'] = $gateProperties['name']." is unlocked.";
          return json_encode($json);
        }
      }

      if ($data['uridium'] < $gateProperties['cost']){
        $json['message'] = "You don't have enough Uridium.";
        return json_encode($json);
      }

      $data['uridium'] -= $gateProperties['cost'];
      $accountDataChanged = true;

      if(Socket::Get('IsOnline', array('UserId' => $id, 'Return' => false))) {
        Socket::Send('UpdateUridium', ['UserId' => $id, 'UridiumPrice' => $gateProperties['cost'], 'Type' => "DECREASE"]);
      }
      
      $json['uridium'] = number_format($data['uridium'], 0, ',', '.');
      $json['lives'] = (isset($infoQData) && isset($infoQData['lives'])) ? $infoQData['lives'] : 0;

      if (!empty($result['uridium'])){
        $uridium_reward = intval($result['uridium']);
        if($uridium_reward > 0) {
            $data['uridium'] += $uridium_reward;
            $accountDataChanged = true;
            if(Socket::Get('IsOnline', array('UserId' => $id, 'Return' => false))) {
              Socket::Send('UpdateUridium', ['UserId' => $id, 'UridiumPrice' => $uridium_reward, 'Type' => "INCREASE"]);
            }
            $json['message'] = "You have earned ".$uridium_reward." uridium.";
            $json['uridium'] = number_format($data['uridium'], 0, ',', '.');
            $json['log'] = "Earned ".$uridium_reward." uridium.";
            $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
            self::gg_log($json['log'], $id);
        }
      }

      if (!empty($result['ammoType']) && !empty($result['ammoAmount'])){
        $ammoType = $result['ammoType'];
        $ammoAmount = intval($result['ammoAmount']);
        if(Socket::Get('IsOnline', array('UserId' => $id, 'Return' => false))) {
          Socket::Send('AddAmmo', ['UserId' => $id, 'itemId' => $ammoType, 'amount' => $ammoAmount]);
        } else {
          if (empty($ammo_json->{$typeMunnition[$ammoType]})) $ammo_json->{$typeMunnition[$ammoType]} = 0;
          $ammo_json->{$typeMunnition[$ammoType]} += $ammoAmount;
          $mysqli->query("UPDATE player_accounts SET ammo = '".json_encode($ammo_json)."' WHERE userId = ".$id);
        }
        $json['message'] = "You have earned ".$ammoAmount." ".($typeMunnition[$ammoType] ?? $ammoType)." ammo";
        $json['log'] = "Earned ".$ammoAmount." ".($typeMunnition[$ammoType] ?? $ammoType)." ammo";
        $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
        self::gg_log($json['log'], $id);
      }

      if (!empty($result['parts'])){
        $parts = intval($result['parts']);
        if ($checkIfExistsParts->num_rows > 0){
          array_push($dataParts, $parts);
          $newTotalParts = $totalParts + $parts;
          $prepared = ($newTotalParts >= $gateProperties['parts']) ? 1 : 0;
          $encode = json_encode($dataParts);
          $mysqli->query("UPDATE player_galaxygates SET parts = '$encode', prepared = '$prepared' WHERE userId = '$id' AND gateId = '$gateId'");
          if ($prepared === 1){
            $json['totalParts'] = "Unlocked";
            $json['message'] = "You have earned ".$parts." parts. Has unlocked succesfully ".$gateProperties['name']." gate.";
            $json['completed'] = 1;
            $json['log'] = "Earned ".$parts." parts of ".$gateProperties['name']." gate. Sucesfully unlocked gate.";
          } else {
            $json['message'] = "You have earned ".$parts." parts.";
            $json['totalParts'] = $newTotalParts."/".$gateProperties['parts'];
            $json['log'] = "Earned ".$parts." parts of ".$gateProperties['name']." gate";
          }
        } else {
          $dataPartsArray = array($parts);
          $encode = json_encode($dataPartsArray);
          $prepared = (count($dataPartsArray) >= $gateProperties['parts']) ? 1 : 0;
          $mysqli->query("INSERT INTO `player_galaxygates` (`userId`, `gateId`, `parts`, `lives`, `prepared`, `wave`) VALUES ('$id', '$gateId', '$encode', '3', '$prepared', '1')");
          $json['message'] = "You have earned ".$parts." parts.";
          $json['totalParts'] = $parts."/".$gateProperties['parts'];
          $json['log'] = "Earned ".$parts." parts of ".$gateProperties['name']." gate";
        }
        $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
        self::gg_log($json['log'], $id);
      }
      
      if($accountDataChanged && !Socket::Get('IsOnline', array('UserId' => $id, 'Return' => false))) {
          $mysqli->query("UPDATE player_accounts SET data = '".json_encode($data)."' WHERE userId = '$id'");
      }

      return json_encode($json);
    }
    return json_encode(['message' => 'Invalid gateId.']);
  }
  
  public static function Buy($itemId, $amount) {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();

    $itemId = $mysqli->real_escape_string($itemId);
    $amount = $mysqli->real_escape_string($amount);
    $shop = json_decode(self::infoshop($itemId), true);

    $json = ['status' => false, 'message' => ''];

    $typeMunnition = [
      'ammunition_laser_mcb-50' => 'mcb50', 'ammunition_specialammo_emp-01' => 'emp',
      'ammunition_mine_smb-01' => 'smb', 'ammunition_specialammo_r-ic3' => 'ice',
      'ammunition_specialammo_wiz-x' => 'wiz', 'ammunition_specialammo_dcr-250' => 'dcr',
      'ammunition_specialammo_pld-8' => 'pld', 'ammunition_rocket_plt-3030' => 'plt3030',
      'ammunition_rocket_plt-2021' => 'plt21', 'ammunition_rocket_plt-2026' => 'plt26',
      'ammunition_rocket_r-310' => 'r310', 'ammunition_laser_rsb-75' => 'rsb',
      'ammunition_laser_sab-50' => 'sab', 'equipment_extra_cpu_ish-01' => 'ish',
      'equipment_extra_cpu_cl04k-xl' => 'cloacks', 'ammunition_laser_ucb-100' => 'ucb',
      'ammunition_laser_mcb-25' => 'mcb25', 'ammunition_laser_lcb-10' => 'lcb10',
      "ammunition_laser_job-100" => 'job100', "ammunition_laser_pib-100" => 'pib100',
      "ammunition_laser_rb-214" => 'rb214', 'ammunition_laser_cbo-100' => 'cbo100',
      'ammunition_laser_xcb-25' => 'xcb25', 'ammunition_laser_xcb-50' => 'xcb50',
      'ammunition_laser_lxcb-75' => 'lxcb75', 'ammunition_rocketlauncher_eco-10' => 'eco10',
      'ammunition_rocketlauncher_ubr-100' => 'ubr100', 'ammunition_rocketlauncher_sar-02' => 'sar02',
      'ammunition_rocketlauncher_sar-01' => 'sar01', 'ammunition_rocketlauncher_hstrm-01' => 'hstrm01',
      'ammunition_mine_slm-01' => 'slm', 'ammunition_mine_sabm-01' => 'sabm',
      'ammunition_mine_empm-01' => 'empm', 'ammunition_mine_ddm-01' => 'ddm',
      'ammunition_mine_acm-01' => 'acm', 'ammunition_mine_im-01' => 'im01',
      'ammunition_firework_fwx-l' => 'fwxl'
    ];

    if (isset($shop) && $shop['active']) {
      $equipmentQueryResult = $mysqli->query('SELECT items, modules, boosters, formationsSaved, config1_drones, config2_drones FROM player_equipment WHERE userId = ' . $player['userId'])->fetch_assoc();
      $items = json_decode($equipmentQueryResult['items']);
      $module = json_decode($equipmentQueryResult['modules']);
      $boosters = json_decode($equipmentQueryResult['boosters']);
      $formations = isset($equipmentQueryResult['formationsSaved']) ? json_decode($equipmentQueryResult['formationsSaved']) : new stdClass();
      $config1_drones = isset($equipmentQueryResult['config1_drones']) ? json_decode($equipmentQueryResult['config1_drones']) : [];
      $config2_drones = isset($equipmentQueryResult['config2_drones']) ? json_decode($equipmentQueryResult['config2_drones']) : [];

      $verificaconectado = Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false));

      $data = json_decode($player['data']);
      $ammo = isset($player['ammo']) ? json_decode($player['ammo']) : null;

      $price = $shop['price'];
      if ($shop['amount'] && $amount <= 0) $amount = 1;
      if ($shop['amount'] && $amount >= 1) $price *= $amount;
      if ($player['premium'] == 1) $price = $price / 100 * 60;

      $accountDataChanged = false;
      $equipmentDataChanged = false;
      $ammoDataChanged = false;
      $otherAccountColumnsChanged = false;

      if ($shop['priceType'] == 'uridium' || $shop['priceType'] == 'credits'){
        if (($shop['priceType'] == 'uridium' ? $data->uridium : $data->credits) >= $price) {
          $data->{($shop['priceType'] == 'uridium' ? 'uridium' : 'credits')} -= $price;
          $accountDataChanged = true;
          $status = false;

          if (!empty($shop['droneName'])) {
            if (strpos($shop['droneName'], "Count")) {
              $items->{$shop['droneName']} = (isset($items->{$shop['droneName']}) ? $items->{$shop['droneName']} : 0) + $amount;
            } else {
              if (!isset($items->{$shop['droneName']}) || !$items->{$shop['droneName']}) {
                $dronePartName = "drone".ucfirst($shop['droneName'])."Parts";
                $items->{$dronePartName} = (isset($items->{$dronePartName}) ? $items->{$dronePartName} : 0) + $amount;
              } else { $json['message'] = 'You already have an ' . $shop['name'] . ' Drone.'; $status = false; }
            }
            if($status !== false) { $status = true; $equipmentDataChanged = true;}
          } else if (!empty($shop['laserName'])) {
            $max = null; $name = null;
             if ($shop['laserName'] == 'lf1Count'){ $max = 40; $name = "lasers"; }
             else if ($shop['laserName'] == 'lf2Count'){ $max = 40; $name = "lasers"; }
             else if ($shop['laserName'] == 'lf3Count'){ $max = 40; $name = "lasers"; }
             else if ($shop['laserName'] == 'lf4Count'){ $max = 40; $name = "lasers"; }
             else if ($shop['laserName'] == 'lf5Count'){ $max = 40; $name = "lasers"; }
             else if ($shop['laserName'] == 'bo3Count'){ $max = 40; $name = "generators"; }
             else if ($shop['laserName'] == 'bo2Count'){ $max = 40; $name = "generators"; }
             else if ($shop['laserName'] == 'B01Count'){ $max = 40; $name = "generators"; }
             else if ($shop['laserName'] == 'A03Count'){ $max = 40; $name = "generators"; }
             else if ($shop['laserName'] == 'A02Count'){ $max = 40; $name = "generators"; }
             else if ($shop['laserName'] == 'A01Count'){ $max = 40; $name = "generators"; }
             else if ($shop['laserName'] == 'g3nCount'){ $max = 40; $name = "generators"; }
             else if ($shop['laserName'] == 'g3n6900Count'){ $max = 40; $name = "generators"; }
             else if ($shop['laserName'] == 'g3n3310Count'){ $max = 40; $name = "generators"; }
             else if ($shop['laserName'] == 'g3n3210Count'){ $max = 40; $name = "generators"; }
             else if ($shop['laserName'] == 'g3n2010Count'){ $max = 40; $name = "generators"; }
             else if ($shop['laserName'] == 'g3n1010Count'){ $max = 40; $name = "generators"; }
             else if ($shop['laserName'] == 'lf3nCount'){ $max = 40; $name = "lasers"; }
             else if ($shop['laserName'] == 'lf4mdCount'){ $max = 40; $name = "lasers"; }
             else if ($shop['laserName'] == 'lf4pdCount'){ $max = 40; $name = "lasers"; }
             else if ($shop['laserName'] == 'lf4hpCount'){ $max = 40; $name = "lasers"; }
             else if ($shop['laserName'] == 'lf4spCount'){ $max = 40; $name = "lasers"; }
             else if ($shop['laserName'] == 'lf4unstableCount'){ $max = 40; $name = "lasers"; }
             else if ($shop['laserName'] == 'mp1Count'){ $max = 40; $name = "lasers"; }
             else if ($shop['laserName'] == 'iriscount'){
                if ($items->iriscount < 8) {
                    if (!is_array($config1_drones)) $config1_drones = [];
                    if (!is_array($config2_drones)) $config2_drones = [];
                    array_push($config1_drones, ['items' => [], 'designs' => []]);
                    array_push($config2_drones, ['items' => [], 'designs' => []]);
                    $equipmentDataChanged = true;
                }
                $max = 8; $name = "drones";
            }

            if ($max === null && $name === null && $shop['laserName'] !== 'iriscount') { $status = false;  }
            else {
                $current_item_count = isset($items->{$shop['laserName']}) ? $items->{$shop['laserName']} : 0;
                $dd = $current_item_count + $amount;
                if ($dd > $max){ $json['message'] = "Max ".$max." ".$name." for type"; $status = false; }
                else { $items->{$shop['laserName']} = $dd; $status = true; $equipmentDataChanged = true; }
            }
          } else if (!empty($shop['skillTree'])) {
            $items->skillTree->{$shop['skillTree']} = (isset($items->skillTree->{$shop['skillTree']}) ? $items->skillTree->{$shop['skillTree']} : 0) + $amount; $status = true; $equipmentDataChanged = true;
          } else if (!empty($shop['petName'])) {
            if ($verificaconectado) { $json['message'] = "You have disconnect from the server to buy ".$shop['petName']; $status = false;}
            else if (!isset($items->{$shop['petName']}) || !$items->{$shop['petName']}) { $items->{$shop['petName']} = true; $status = true; $equipmentDataChanged = true;}
            else { $json['message'] = 'You already have an '.$shop['name']; $status = false; }
          } else if (!empty($shop['boosterId']) && is_numeric($shop['boosterType']) && !empty($shop['boosterDuration'])){
            $shop['boosterId'] = str_replace("-", "", $shop['boosterId']); $canPutBooster = true;
            if (empty($boosters->{$shop['boosterId']})) {
                if($verificaconectado) Socket::Send('SendBoosters', ['UserId' => $player['userId'], 'typeBooster' => $shop['boosterType'], 'hoursBooster' => $shop['boosterDuration']]);
                $boosters->{$shop['boosterId']} = [['Type' => $shop['boosterType'], 'Seconds' => $shop['boosterDuration']]]; $status = true; $equipmentDataChanged = true;
            } else {
              foreach ($boosters->{$shop['boosterId']} as $bb_item){ if ($bb_item->Type == $shop['boosterType']){ $canPutBooster = false; break; } }
              if ($canPutBooster){
                if($verificaconectado) Socket::Send('SendBoosters', ['UserId' => $player['userId'], 'typeBooster' => $shop['boosterType'], 'hoursBooster' => $shop['boosterDuration']]);
                array_push($boosters->{$shop['boosterId']}, array('Type' => $shop['boosterType'], 'Seconds' => $shop['boosterDuration'])); $status = true; $equipmentDataChanged = true;
              } else { $json['message'] = 'You already have an ' . $shop['name'] . '.'; $status = false;}
            }
          } else if (!empty($shop['shipId']) && $shop['shipId'] > 0) {
            if (!in_array($shop['shipId'], $items->ships)) { array_push($items->ships, (int)$shop['shipId']); $status = true; $equipmentDataChanged = true;}
            else { $json['message'] = 'You already have an ' . $shop['name'] . '.'; $status = false; }
          } else if (!empty($shop['design_name'])) {
            $design_name = $shop['design_name'];
            $search_design = $mysqli->query("SELECT * FROM player_designs WHERE name='$design_name' AND userId = " . $player['userId'] . ";");
            $info_design_query = $mysqli->query("SELECT baseShipId FROM server_ships WHERE lootID = '$design_name'");
            if ($search_design->num_rows > 0) { $json['message'] = 'You already have an ' . $shop['name'] . '.'; $status = false; }
            else { if ($info_design_query->num_rows > 0){ $info_design = $info_design_query->fetch_assoc(); $baseShipId = $info_design['baseShipId']; if ($baseShipId > 0){ $mysqli->query("INSERT INTO player_designs (name, baseShipId, userId) VALUES ('$design_name', '$baseShipId', " . $player['userId'] . ")"); $status = true; } } else { $status = false; } }
          } else if (!empty($shop['moduleId']) && !empty($shop['moduleType'])){
            $module2_obj = (object)['Id' => $shop['moduleId'], 'Type' => $shop['moduleType'], 'InUse' => false];
            if (!$verificaconectado){ if (!in_array($module2_obj, (array)$module, false)) { array_push($module, $module2_obj); $status = true; $equipmentDataChanged = true;} }
            else { $json['message'] = "Disconnect from game to buy."; $status = false; }
          } else if (!empty($shop['ammoId'])){
            if($verificaconectado) { Socket::Send('AddAmmo', ['UserId' => $player['userId'], 'itemId' => $shop['ammoId'], 'amount' => $amount]); }
            else {
              if ($ammo === null) {
                $ammo_data = $mysqli->query("SELECT ammo FROM player_accounts WHERE userId=".$player['userId'])->fetch_assoc();
                $ammo = $ammo_data ? json_decode($ammo_data["ammo"]) : new stdClass();
              }
              if ($ammo === null) $ammo = new stdClass();
              if (empty($ammo->{$typeMunnition[$shop['ammoId']]})) $ammo->{$typeMunnition[$shop['ammoId']]} = 0;
              $ammo->{$typeMunnition[$shop['ammoId']]} += $amount; $ammoDataChanged = true;
            } $status = true;
          } else if (!empty($shop['typeKey'])){
            if($verificaconectado) { return json_encode(array('message' => "Disconnect from game to buy keys.")); }
            else {
                $playerFromDbForKeys = $mysqli->query('SELECT bootyKeys FROM player_accounts WHERE userId = ' . $player['userId'])->fetch_assoc();
                $currentBootyKeys = $playerFromDbForKeys ? json_decode($playerFromDbForKeys['bootyKeys'], true) : [];
                if(!is_array($currentBootyKeys)) $currentBootyKeys = [];
                $currentBootyKeys[$shop['typeKey']] = (isset($currentBootyKeys[$shop['typeKey']]) ? $currentBootyKeys[$shop['typeKey']] : 0) + $amount;
                $player['bootyKeys'] = json_encode($currentBootyKeys);
                $otherAccountColumnsChanged = true;
                $status = true;
            }
          } else if (!empty($shop['petDesign'])){
            $currentPetSavedDesigns = isset($data->petSavedDesigns) ? json_decode($data->petSavedDesigns, true) : [];
            if (in_array($shop['petDesign'], $currentPetSavedDesigns) || (isset($data->petDesign) && $data->petDesign == $shop['petDesign'])){ $json['message'] = "You already buyed this pet."; return json_encode($json); }
            if (isset($data->petDesign) && !in_array($data->petDesign, $currentPetSavedDesigns)) array_push($currentPetSavedDesigns, $data->petDesign);
            $data->petSavedDesigns = json_encode($currentPetSavedDesigns);
            $data->petDesign = $shop['petDesign'];
            if ($verificaconectado) Socket::Send('updatePet', ['UserId' => $player['userId'], 'PetName' => (isset($data->petName) ? $data->petName : 'P.E.T'), 'PetDesignn' => $data->petDesign]);
            $status = true; $accountDataChanged = true;
          } else if (!empty($shop['petFuel'])){
            if ($verificaconectado) {
              $fuel = Socket::Get('getPetFuel', ['UserId' => $player['userId'], 'Return' => 0]);
              if (empty($fuel) && !is_numeric($fuel)){ $json['message'] = "The pet only allows 50,000 liters of fuel."; return json_encode($json); }
              $fuel += $shop['petFuel']; $items->fuel = (isset($items->fuel) ? $items->fuel : 0) + $shop['petFuel'];
              if ($fuel > 50000){ $json['message'] = "The pet only allows 50,000 liters of fuel."; return json_encode($json); }
            } else {
              if (empty($items->fuel)) $items->fuel = 0; $items->fuel += $shop['petFuel'];
              if ($items->fuel > 50000){ $json['message'] = "The pet only allows 50,000 liters of fuel."; return json_encode($json); }
            }
            if ($verificaconectado) Socket::Send('updatePetFuel', ['UserId' => $player['userId'], 'Amount' => $shop['petFuel']]);
            $status = true; $equipmentDataChanged = true;
          } else if (!empty($shop['petModule'])){
            $act = $shop['petModule'];
            if (!empty($items->$act) && $items->$act == true){ $json['message'] = "You already have ".$shop['name']; return json_encode($json); }
            $items->$act = true;
            if ($verificaconectado) Socket::Send('setPetModule', ['UserId' => $player['userId'], 'TypeModule' => $shop['petModule']]);
            $status = true; $equipmentDataChanged = true;
          }  else if (!empty($shop['FormationName'])){
            $act = $shop['FormationName'];
            if (!empty($formations->$act) && $formations->$act == $act){ $json['message'] = "You already have ".$shop['name']; return json_encode($json); }
            $formations->$act = $act;
            if ($verificaconectado) Socket::Send('buyFormation', ['UserId' => $player['userId'], 'Formation' => $shop['FormationName']]);
            $status = true; $equipmentDataChanged = true;
          } else if (!empty($shop['nameBootyKey'])){
            if (!isset($data->bootyKeys) || !is_object($data->bootyKeys)) $data->bootyKeys = new stdClass();
            $act = $shop['nameBootyKey'];
            if (!isset($data->bootyKeys->$act)) $data->bootyKeys->$act = 0;
            $data->bootyKeys->$act += $amount;
            if ($verificaconectado) Socket::Send('buyKey', ['UserId' => $player['userId'], 'Key' => $shop['nameBootyKey'], 'Amount' => $amount]);
            $status = true; $accountDataChanged = true;
          }

          if ($status) {
            $mysqli->begin_transaction();
            try {
              $playerAccountUpdateSet = [];
              if ($accountDataChanged) $playerAccountUpdateSet[] = "data = '" . $mysqli->real_escape_string(json_encode($data)) . "'";
              if ($ammoDataChanged && !$verificaconectado) $playerAccountUpdateSet[] = "ammo = '" . $mysqli->real_escape_string(json_encode($ammo)) . "'";
              if ($otherAccountColumnsChanged && isset($player['bootyKeys'])) $playerAccountUpdateSet[] = "bootyKeys = '" . $mysqli->real_escape_string($player['bootyKeys']) . "'";

              if(!empty($playerAccountUpdateSet)){
                  $mysqli->query("UPDATE player_accounts SET " . implode(", ", $playerAccountUpdateSet) . " WHERE userId = " . $player['userId']);
              }

              if ($equipmentDataChanged) {
                  $equipmentUpdates = [
                    "items = '" . $mysqli->real_escape_string(json_encode($items)) . "'",
                    "modules = '" . $mysqli->real_escape_string(json_encode($module)) . "'",
                    "boosters = '" . $mysqli->real_escape_string(json_encode($boosters)) . "'",
                    "formationsSaved = '" . $mysqli->real_escape_string(json_encode($formations)) . "'"
                  ];
                  if(isset($config1_drones) && isset($shop['laserName']) && $shop['laserName'] == 'iriscount') $equipmentUpdates[] = "config1_drones = '" . $mysqli->real_escape_string(json_encode($config1_drones)) . "'";
                  if(isset($config2_drones) && isset($shop['laserName']) && $shop['laserName'] == 'iriscount') $equipmentUpdates[] = "config2_drones = '" . $mysqli->real_escape_string(json_encode($config2_drones)) . "'";
                  $mysqli->query("UPDATE player_equipment SET " . implode(', ', $equipmentUpdates) . " WHERE userId = " . $player['userId']);
              }

              $json['newStatus'] = ['uridium' => number_format($data->uridium), 'credits' => number_format($data->credits)];
              if ($verificaconectado) Socket::Send('BuyItem', ['UserId' => $player['userId'], 'ItemType' => $shop['category'], 'DataType' => ($shop['priceType'] == 'uridium' ? 0 : 1), 'Amount' => $price]);
              $json['message'] = '' . htmlspecialchars($shop['name']) . ' ' . ($amount != 0 ? '(' . number_format($amount) . ')' : '') . ' purchased';
              $mysqli->commit();
            } catch (Exception $e) {
              $json['message'] = 'An error occurred. Please try again later.'; $mysqli->rollback();
            }
          }
        } else {
          $json['message'] = "You don't have enough " . ($shop['priceType'] == 'uridium' ? 'Uridium' : 'Credits');
        }  
      } elseif ($shop['priceType'] == 'event') {
        $search_user = $mysqli->query("SELECT coins FROM event_coins WHERE userId= " . $player['userId'] . ";");
        if ($search_user->num_rows > 0){
          $user_coins_data = $search_user->fetch_assoc();
          $user_coins = $user_coins_data['coins'];

          if ($user_coins >= $price) {
            $user_coins -= $price; $status = false;
            $accountDataChanged_event = false; $equipmentDataChanged_event = false; $ammoDataChanged_event = false;

            if (!empty($shop['design_name'])) {
              $design_name = $shop['design_name'];
              $search_design = $mysqli->query("SELECT name FROM player_designs WHERE name='$design_name' AND userId = " . $player['userId'] . ";");
              if ($search_design->num_rows > 0) { $json['message'] = 'You already have an ' . htmlspecialchars($shop['name']) . '.'; }
              else {
                $info_design_query = $mysqli->query("SELECT baseShipId FROM server_ships WHERE lootID = '$design_name'");
                if ($info_design_query->num_rows > 0){ $info_design = $info_design_query->fetch_assoc(); $baseShipId = $info_design['baseShipId'];
                    if ($baseShipId > 0){ $mysqli->query("INSERT INTO player_designs (name, baseShipId, userId) VALUES ('$design_name', '$baseShipId', " . $player['userId'] . ")"); $status = true; } }
              }
            } else if (!empty($shop['moduleId']) && !empty($shop['moduleType'])){
              $module2_obj = (object)['Id' => $shop['moduleId'], 'Type' => $shop['moduleType'], 'InUse' => false];
              if (!$verificaconectado){ if (!in_array($module2_obj, (array)$module, false)) { array_push($module, $module2_obj); $status = true; $equipmentDataChanged_event = true;} }
              else { $json['message'] = "Disconnect from game to buy."; }
            } else if (!empty($shop['nameBootyKey'])){
                if (!isset($data->bootyKeys) || !is_object($data->bootyKeys)) $data->bootyKeys = new stdClass();
                $act = $shop['nameBootyKey'];
                if (!isset($data->bootyKeys->$act)) $data->bootyKeys->$act = 0;
                $data->bootyKeys->$act += $amount;
                $accountDataChanged_event = true;
                if ($verificaconectado) {
                  Socket::Send('buyKey', ['UserId' => $player['userId'], 'Key' => $shop['nameBootyKey'], 'Amount' => $amount]);
                }
                $status = true;
            } else if (!empty($shop['ammoId'])){
              if($verificaconectado) { Socket::Send('AddAmmo', ['UserId' => $player['userId'], 'itemId' => $shop['ammoId'], 'amount' => $amount]); }
              else {
                if ($ammo === null) {
                    $ammo_data_event = $mysqli->query("SELECT ammo FROM player_accounts WHERE userId=".$player['userId'])->fetch_assoc();
                    $ammo = $ammo_data_event ? json_decode($ammo_data_event["ammo"]) : new stdClass();
                }
                if ($ammo === null) $ammo = new stdClass();
                if (empty($ammo->{$typeMunnition[$shop['ammoId']]})) $ammo->{$typeMunnition[$shop['ammoId']]} = 0;
                $ammo->{$typeMunnition[$shop['ammoId']]} += $amount; $ammoDataChanged_event = true;
              } $status = true;
            } else if (!empty($shop['laserName'])) {
                $current_item_count_event = isset($items->{$shop['laserName']}) ? $items->{$shop['laserName']} : 0;
                $dd_event = $current_item_count_event + $amount;
                $items->{$shop['laserName']} = $dd_event;
                $status = true; $equipmentDataChanged_event = true;
            } else if (!empty($shop['droneName'])) {
                if (strpos($shop['droneName'], "Count")) { $items->{$shop['droneName']} = (isset($items->{$shop['droneName']}) ? $items->{$shop['droneName']} : 0) + $amount; }
                else { $dronePartName = "drone".ucfirst($shop['droneName'])."Parts"; $items->{$dronePartName} = (isset($items->{$dronePartName}) ? $items->{$dronePartName} : 0) + $amount; }
                $status = true; $equipmentDataChanged_event = true;
            } else if (!empty($shop['shipId']) && $shop['shipId'] > 0) {
                if (!in_array($shop['shipId'], $items->ships)) { array_push($items->ships, (int)$shop['shipId']); $status = true; $equipmentDataChanged_event = true;}
                else { $json['message'] = 'You already have an ' . htmlspecialchars($shop['name']) . '.'; }
            } else if (!empty($shop['boosterId']) && is_numeric($shop['boosterType']) && !empty($shop['boosterDuration'])){
                $shop['boosterId'] = str_replace("-", "", $shop['boosterId']); $canPutBooster = true;
                if (empty($boosters->{$shop['boosterId']})) { $boosters->{$shop['boosterId']} = [['Type' => $shop['boosterType'], 'Seconds' => $shop['boosterDuration']]];}
                else { foreach ($boosters->{$shop['boosterId']} as $bb_item_loop){ if ($bb_item_loop->Type == $shop['boosterType']){ $canPutBooster = false; break; } } if ($canPutBooster) array_push($boosters->{$shop['boosterId']}, array('Type' => $shop['boosterType'], 'Seconds' => $shop['boosterDuration'])); else {$json['message'] = 'You already have an ' . htmlspecialchars($shop['name']) . '.'; $status = false;} }
                if($canPutBooster && $status !== false) { $status = true; $equipmentDataChanged_event = true; if($verificaconectado) Socket::Send('SendBoosters', ['UserId' => $player['userId'], 'typeBooster' => $shop['boosterType'], 'hoursBooster' => $shop['boosterDuration']]); }
            }

            if ($status) {
              $mysqli->begin_transaction();
              try {
                $mysqli->query("UPDATE event_coins SET coins = '" . $user_coins . "' WHERE userId = " . $player['userId'] . "");

                if($accountDataChanged_event) {
                    $playerAccountUpdateParts_event = ["data = '" . $mysqli->real_escape_string(json_encode($data)) . "'"];
                     if ($ammoDataChanged_event && !$verificaconectado) {
                        $playerAccountUpdateParts_event[] = "ammo = '" . $mysqli->real_escape_string(json_encode($ammo)) . "'";
                    }
                    $mysqli->query("UPDATE player_accounts SET " . implode(", ", $playerAccountUpdateParts_event) . " WHERE userId = " . $player['userId']);
                }

                if($equipmentDataChanged_event) {
                    $equipmentUpdates_event = [
                        "items = '" . $mysqli->real_escape_string(json_encode($items)) . "'",
                        "modules = '" . $mysqli->real_escape_string(json_encode($module)) . "'",
                        "boosters = '" . $mysqli->real_escape_string(json_encode($boosters)) . "'"
                    ];
                     if (isset($formations)) {
                        $equipmentUpdates_event[] = "formationsSaved = '" . $mysqli->real_escape_string(json_encode($formations)) . "'";
                    }
                    $mysqli->query("UPDATE player_equipment SET " . implode(', ', $equipmentUpdates_event) . " WHERE userId = " . $player['userId']);
                }

                if ($verificaconectado) Socket::Send('updateEC', ['UserId' => $player['userId'], 'Amount' => $price, 'Type' => "DECREASE"]);
                $json['ec'] = number_format($user_coins);
                $json['message'] = '' . htmlspecialchars($shop['name']) . ' ' . ($amount != 0 ? '(' . number_format($amount) . ')' : '') . ' purchased';
                $mysqli->commit();
              } catch (Exception $e) {
                $json['message'] = 'An error occurred. Please try again later.'; $mysqli->rollback();
              }
            }
          } else { $json['message'] = "You don't have enough Event Coins"; }
        }
      }
    } else { $json['message'] = 'Something went wrong!'; }
    return json_encode($json);
  }

  public static function ChangePilotName($newPilotName)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $newPilotName = $mysqli->real_escape_string($newPilotName);
    $verificaconectado = Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false));
    $json = [
      'inputs' => ['pilotName' => ['validate' => 'valid', 'error' => 'Enter a valid pilot name!']],
      'message' => ''
    ];
    if (mb_strlen($newPilotName) < 4 || mb_strlen($newPilotName) > 20) {
      $json['inputs']['pilotName']['validate'] = 'invalid';
      $json['inputs']['pilotName']['error'] = 'Your pilot name should be between 4 and 20 characters.';
    }
    if (isset($verificaconectado) && $verificaconectado == 0){
      if ($json['inputs']['pilotName']['validate'] === 'valid') {
        $oldPilotNames = json_decode($player['oldPilotNames'], true);
        if (empty($oldPilotNames) || !is_array($oldPilotNames)) $oldPilotNames = [];
        $canChange = true;
        if (!empty($oldPilotNames)) {
            $lastChange = end($oldPilotNames);
            if (isset($lastChange['date'])) {
                 $lastChangeTime = strtotime($lastChange['date']);
                 if ($lastChangeTime && (time() - $lastChangeTime) < (24 * 60 * 60)) {
                     if($player['rankId'] != 21) {
                        $json['message'] = 'You can only rename your Pilot once every 24 hours. <br> (Your last name change: ' . date('d.m.Y H:i', $lastChangeTime) . ')';
                        $canChange = false;
                     }
                 }
            }
        }

        if ($canChange) {
          if ($mysqli->query('SELECT userId FROM player_accounts WHERE pilotName = "' . $newPilotName . '"')->num_rows <= 0) {
            $mysqli->begin_transaction();
            try {
              array_push($oldPilotNames, ['name' => $player['pilotName'], 'date' => date('d.m.Y H:i:s')]);
              $mysqli->query("UPDATE player_accounts SET pilotName = '" . $newPilotName . "', oldPilotNames = '" . $mysqli->real_escape_string(json_encode($oldPilotNames)) . "' WHERE userId = " . $player['userId']);
              $json['message'] = 'Your Pilot name has been changed.';
              $mysqli->commit();
            } catch (Exception $e) {
              error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
              $json['message'] = 'An error occurred. Please try again later.';
              $mysqli->rollback();
            }
          } else {
            $json['message'] = 'This Pilot name is already in use.';
          }
        }
      }
    } else {
      $json['message'] = "Disconnect or go to a safe area.";
    }
    return json_encode($json);
  }

  public static function ChangeClanData($newtagName)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $newtagName = $mysqli->real_escape_string($newtagName);
    $clanId = $player['clanId'];
    $json = [
      'inputs' => ['tagname' => ['validate' => 'valid', 'error' => 'Enter a valid tag name!']],
      'message' => ''
    ];
    if (mb_strlen($newtagName) < 1 || mb_strlen($newtagName) > 4) {
      $json['inputs']['tagname']['validate'] = 'invalid';
      $json['message'] = 'Your TAG name should be between 1 and 4 characters.';
    }
    if ($json['inputs']['tagname']['validate'] === 'valid') {
      if ($mysqli->query('SELECT leaderId FROM server_clans WHERE tag = "' . $newtagName . '" AND id != ' . $clanId)->num_rows <= 0) {
        $mysqli->begin_transaction();
        try {
          $mysqli->query("UPDATE server_clans SET tag = '" . $newtagName . "' WHERE id = " . $clanId . " AND leaderId = " . $player['userId']);
          if ($mysqli->affected_rows > 0) {
            $json['status'] = true;
            $json['message'] = 'Your tag name has been changed.';
            Socket::Send('ChangeClanData', ['ClanId' => $clanId, 'Tag' => $newtagName]);    
          } else {
            $json['message'] = 'Could not change tag or you are not the leader.';
          }
          $mysqli->commit();
        } catch (Exception $e) {
          $json['message'] = 'An error occurred. Please try again later.';
          $mysqli->rollback();
        }
      } else {
        $json['message'] = 'This tag name is already in use.';
      }
    }
    return json_encode($json);
  }

  public static function changeprofileurl($urlprofile)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $json = [
      'inputs' => ['urlprofile' => ['validate' => 'valid', 'error' => 'Enter a valid URL!']],
      'message' => ''
    ];
    if (mb_strlen($urlprofile) < 10 || mb_strlen($urlprofile) > 100) {
      $json['inputs']['urlprofile']['validate'] = 'invalid';
      $json['inputs']['urlprofile']['error'] = 'Your link should be between 10 and 100 characters.';
    }
    if ($json['inputs']['urlprofile']['validate'] === 'valid') {
        $mysqli->begin_transaction();
        try {
            $mysqli->query("UPDATE player_accounts SET profile =  '" . $mysqli->real_escape_string($urlprofile) . "'  WHERE userId = " . $player['userId']);
            $json['message'] = 'Your Photo has been changed.';
            $mysqli->commit();
        } catch (Exception $e) {
            $json['message'] = 'An error occurred. Please try again later.';
            $mysqli->rollback();
        }
    }
    return json_encode($json);
  }

  public static function changepassword($newpassword_post, $repeatnewpassword_post)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $json = [
      'inputs' => ['newpassword' => ['validate' => 'valid', 'error' => 'Enter a valid password!']],
      'message' => ''
    ];
    if (mb_strlen($newpassword_post) < 6 || mb_strlen($newpassword_post) > 20) {
      $json['inputs']['newpassword']['validate'] = 'invalid';
      $json['inputs']['newpassword']['error'] = 'Your password should be between 6 and 20 characters.';
    }
    if ($json['inputs']['newpassword']['validate'] === 'valid') {
      if ($newpassword_post == $repeatnewpassword_post) {
          $mysqli->begin_transaction();
          try {
            $mysqli->query("UPDATE player_accounts SET password =  '" . password_hash($newpassword_post, PASSWORD_DEFAULT) . "'  WHERE userId = " . $player['userId']);
            $json['message'] = 'Your Password has been changed.';
            $mysqli->commit();
          } catch (Exception $e) {
            error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
            $json['message'] = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }
      } else {
        $json['message'] = 'New Passwords do not match.';
      }
    }
    return json_encode($json);
  }

  public static function ChangenameData($nameclan)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $nameclan = $mysqli->real_escape_string($nameclan);
    $clanId = $player['clanId'];
    $json = [
      'inputs' => ['nameclan' => ['validate' => 'valid', 'error' => 'Enter a valid clan name!']],
      'message' => ''
    ];
    if (mb_strlen($nameclan) < 1 || mb_strlen($nameclan) > 20) {
      $json['inputs']['nameclan']['validate'] = 'invalid';
      $json['message'] = 'Your name clan should be between 1 and 20 characters.';
    }
    if ($json['inputs']['nameclan']['validate'] === 'valid') {
      if ($mysqli->query('SELECT * FROM server_clans WHERE NAME = "' . $nameclan . '" AND id != ' . $clanId)->num_rows <= 0) {
        $mysqli->begin_transaction();
        try {
          $mysqli->query("UPDATE server_clans SET name = '" . $nameclan . "' WHERE id = " . $clanId . " AND leaderId = " . $player['userId']);
          if($mysqli->affected_rows > 0){
            $json['status'] = true;
            $json['message'] = 'Your clan name has been changed.';
            Socket::Send('ChangeClanData', ['ClanId' => $clanId, 'name' => $nameclan]);    
          } else {
            $json['message'] = 'Could not change clan name or you are not the leader.';
          }
          $mysqli->commit();
        } catch (Exception $e) {
          $json['message'] = 'An error occurred. Please try again later.';
          $mysqli->rollback();
        }
      } else {
        $json['message'] = 'This clan name is already in use.';
      }
    }
    return json_encode($json);
  }
  
  public static function ChangePetName($petName = null, $petChoosed = null)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $data = json_decode($player['data'], true);
    $json = ['message' => '', 'status' => false];
    $accountDataChanged = false;

    if (!empty($petName)){
        $petName = $mysqli->real_escape_string($petName);
        if (mb_strlen($petName) < 2 || mb_strlen($petName) > 10) {
          $json['message'] = "The pet name must contain more than 2 character and less than 10 characters.";
          return json_encode($json);
        }
        $data['petName'] = $petName;
        $accountDataChanged = true;
    } else {
        $json['message'] = "The pet's name cannot be empty.";
        return json_encode($json);
    }

    if (!empty($petChoosed)){
        $petChoosed = $mysqli->real_escape_string($petChoosed);
        $petSavedDesigns = isset($data['petSavedDesigns']) ? json_decode($data['petSavedDesigns'], true) : array();
        if (!is_array($petSavedDesigns)) $petSavedDesigns = [];

        if (!in_array($petChoosed, $petSavedDesigns)){
          $json['message'] = 'You have not bought this pet design.';
          return json_encode($json);
        }
        if (isset($data['petDesign']) && $data['petDesign'] != $petChoosed && !in_array($data['petDesign'], $petSavedDesigns)){
          array_push($petSavedDesigns, $data['petDesign']);
        }
        $data['petSavedDesigns'] = json_encode($petSavedDesigns);
        $data['petDesign'] = $petChoosed;
        $accountDataChanged = true;
    }

    if ($accountDataChanged){
        $mysqli->query("UPDATE player_accounts SET data = '".$mysqli->real_escape_string(json_encode($data))."' WHERE userId = " . $player['userId']);
        if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
          Socket::Send('updatePet', ['UserId' => $player['userId'], 'PetName' => $data['petName'], 'PetDesignn' => (isset($data['petDesign'])) ? $data['petDesign'] : 22]);
        }
    }
    $json['message'] = 'Data saved succesfully.';
    $json['status'] = true;
    return json_encode($json);
  }

  public static function ExchangeLogdisks()
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $equipmentQuery = $mysqli->query('SELECT skill_points, items FROM player_equipment WHERE userId = ' . $player['userId']);
    if(!$equipmentQuery) { return json_encode(['message' => 'Database error.']); }
    $equipment = $equipmentQuery->fetch_assoc();
    $skillPoints = json_decode($equipment['skill_points']);
    $items = json_decode($equipment['items']);
    $requiredLogdisks = Functions::GetRequiredLogdisks((array_sum((array) $skillPoints) + $items->skillTree->researchPoints) + 1);
    $json = ['message' => ''];

    if ($items->skillTree->logdisks >= $requiredLogdisks && ((array_sum((array) $skillPoints) + $items->skillTree->researchPoints) < array_sum(array_column(Functions::GetSkills($skillPoints), 'maxLevel')))) {
      $items->skillTree->logdisks -= $requiredLogdisks;
      $items->skillTree->researchPoints++;
      $mysqli->begin_transaction();
      try {
        $mysqli->query("UPDATE player_equipment SET items = '" . $mysqli->real_escape_string(json_encode($items)) . "' WHERE userId = " . $player['userId'] . "");
        $json['newStatus'] = [
          'logdisks' => $items->skillTree->logdisks,
          'researchPoints' => $items->skillTree->researchPoints,
          'researchPointsMaxed' => ((array_sum((array) $skillPoints) + $items->skillTree->researchPoints) == array_sum(array_column(Functions::GetSkills($skillPoints), 'maxLevel'))),
          'requiredLogdisks' => Functions::GetRequiredLogdisks((array_sum((array) $skillPoints) + $items->skillTree->researchPoints) + 1)
        ];
        $json['message'] = 'Log disks exchanged.';
        $mysqli->commit();
      } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later.'; $mysqli->rollback();
      }
    } else { $json['message'] = 'Something went wrong!'; }
    return json_encode($json);
  }

  public static function ResetSkills()
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $equipmentQuery = $mysqli->query('SELECT skill_points, items FROM player_equipment WHERE userId = ' . $player['userId']);
    if(!$equipmentQuery) { return json_encode(['status' => false, 'message' => 'Database error.']);}
    $equipment = $equipmentQuery->fetch_assoc();

    $skillPoints = json_decode($equipment['skill_points']);
    $items = json_decode($equipment['items']);
    $data = json_decode($player['data']);
    $json = ['status' => false, 'message' => ''];
    $cost = Functions::GetResetSkillCost($items->skillTree->resetCount);

    if ($data->uridium >= $cost) {
      $data->uridium -= $cost;
      $items->skillTree->resetCount++;
      $items->skillTree->researchPoints += array_sum((array) $skillPoints);
      foreach ($skillPoints as $key => $value) { $skillPoints->$key = 0; }
      $mysqli->begin_transaction();
      try {
        $mysqli->query("UPDATE player_accounts SET data = '" . $mysqli->real_escape_string(json_encode($data)) . "' WHERE userId = " . $player['userId'] . "");
        $mysqli->query("UPDATE player_equipment SET items = '" . $mysqli->real_escape_string(json_encode($items)) . "', skill_points = '" . $mysqli->real_escape_string(json_encode($skillPoints)) . "' WHERE userId = " . $player['userId'] . "");
        $json['status'] = true;
        $json['message'] = 'Research points resetted.';
        if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
          Socket::Send('ResetSkillTree', ['UserId' => $player['userId']]);
        }
        $mysqli->commit();
      } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later.'; $mysqli->rollback();
      }
    } else { $json['message'] = "You don't have enough Uridium."; }
    return json_encode($json);
  }

  public static function UseResearchPoints($skill)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $skill = $mysqli->real_escape_string($skill);
    $equipmentQuery = $mysqli->query('SELECT skill_points, items FROM player_equipment WHERE userId = ' . $player['userId'] . '');
    if(!$equipmentQuery) { return json_encode(['message' => 'Database error.']);}
    $equipment = $equipmentQuery->fetch_assoc();
    $skillPoints = json_decode($equipment['skill_points']);
    $items = json_decode($equipment['items']);
    $skills = Functions::GetSkills($skillPoints);
    $json = ['message' => ''];

    if (array_key_exists($skill, $skills) && isset($skillPoints->{$skill}) && (!isset($skills[$skill]['baseSkill']) || (isset($skills[$skill]['baseSkill']) && $skills[$skills[$skill]['baseSkill']]['currentLevel'] == $skills[$skills[$skill]['baseSkill']]['maxLevel']))) {
      if ($items->skillTree->researchPoints >= 1 && $skillPoints->{$skill} < $skills[$skill]['maxLevel']) {
        $items->skillTree->researchPoints--;
        $skillPoints->{$skill}++;
        $mysqli->begin_transaction();
        try {
          $mysqli->query("UPDATE player_equipment SET items = '" . $mysqli->real_escape_string(json_encode($items)) . "', skill_points = '" . $mysqli->real_escape_string(json_encode($skillPoints)) . "' WHERE userId = " . $player['userId'] . "");
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
          if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
            Socket::Send('UpgradeSkillTree', ['UserId' => $player['userId'], 'Skill' => $skill]);
          }
          $mysqli->commit();
        } catch (Exception $e) {
          $json['message'] = 'An error occurred. Please try again later.'; $mysqli->rollback();
        }
      } else { $json['message'] = 'Something went wrong!'; }
    } else { $json['message'] = 'Something went wrong!'; }
    return json_encode($json);
  }

  public static function getShopCategories(){
    $mysqli = Database::GetInstance();
    $query_category = $mysqli->query("SELECT * FROM shop_category WHERE active = '1'");
    if ($query_category->num_rows > 0){
      $dataReturn = array();
      while($data_category = $query_category->fetch_assoc()){
        $dataReturn[] = $data_category['category'];
      }
      return $dataReturn;
    }
    return false;
  }

  public static function getShopItems($category){
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $query_items = $mysqli->query("SELECT * FROM shop_items WHERE category = '$category' AND active = '1'");

    if ($query_items->num_rows > 0){
      $dataReturn = array();
      while($data_items = $query_items->fetch_assoc()){
		  $dataReturn[] = array(
			  'id' => $data_items['id'], 'category' => $data_items['category'],
			  'name' => $data_items['name'], 'information' => $data_items['information'],
			  'price' => $data_items['price'], 'priceType' => $data_items['priceType'],
			  'amount' => $data_items['amount'], 'image' => $data_items['image'],
			  'active' => $data_items['active'], 'shipId' => $data_items['shipId'],
			  'design_name' => $data_items['design_name']
			);
      }
	  for($i = 0; $i < count($dataReturn); $i++) {
		  if($dataReturn[$i]["id"] == 512) {
            $player_equipment_for_drone_change_query = $mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId']);
            if($player_equipment_for_drone_change_query){
                $player_equipment_for_drone_change = $player_equipment_for_drone_change_query->fetch_assoc();
                $items_for_drone_change = json_decode($player_equipment_for_drone_change['items']);
                if(isset($items_for_drone_change->iriscount) && $items_for_drone_change->iriscount <= 7) {
                    $dataReturn[$i] = Functions::DroneChange($items_for_drone_change, $dataReturn, $i);
                } else { $dataReturn[$i] = null; }
            } else {$dataReturn[$i] = null;}
		  }
	  }
      return array_values(array_filter($dataReturn));
    }
    return false;
  }
	
	public static function DroneChange($items_param, $dataReturn, $i) {
        if(!isset($items_param->iriscount)) $items_param->iriscount = 0;

        if($items_param->iriscount == 0) {
            $dataReturn[$i]["price"] = 15000;
            $dataReturn[$i]["priceType"] = "uridium";
        } else if($items_param->iriscount == 1) {
            $dataReturn[$i]["price"] = 24000;
            $dataReturn[$i]["priceType"] = "uridium";
        } else if($items_param->iriscount == 2) {
            $dataReturn[$i]["price"] = 42000;
            $dataReturn[$i]["priceType"] = "uridium";
        } else if($items_param->iriscount == 3) {
            $dataReturn[$i]["price"] = 60000;
            $dataReturn[$i]["priceType"] = "uridium";
        } else if($items_param->iriscount == 4) {
            $dataReturn[$i]["price"] = 84000;
            $dataReturn[$i]["priceType"] = "uridium";
        } else if($items_param->iriscount == 5) {
            $dataReturn[$i]["price"] = 96000;
            $dataReturn[$i]["priceType"] = "uridium";
        } else if($items_param->iriscount == 6) {
            $dataReturn[$i]["price"] = 126000;
            $dataReturn[$i]["priceType"] = "uridium";
        } else if($items_param->iriscount == 7) {
            $dataReturn[$i]["price"] = 200000;
            $dataReturn[$i]["priceType"] = "uridium";
        }
		return $dataReturn[$i];
	}

   public static function GetShop()
  {
    return [
      'categories' => ['ships', 'lasers', 'drones', 'extras/pet','BOOSTER', 'MODULOS'],
      'items' => [ /* ... Static item definitions ... */ ]
    ];
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

  public static function getUpgradeableItemConfig()
  {
    return self::$upgradeableItemConfig;
  }

  public static function generateCsrfToken()
  {
    if (session_status() == PHP_SESSION_NONE) {
    }
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $token;
    return $token;
  }

  public static function validateCsrfToken($token)
  {
    if (empty($_SESSION['csrf_token']) || empty($token)) {
      return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
  }

  public static function acik_arttirma($bid_credit, $csrf_token)
  {
    if (!self::validateCsrfToken($csrf_token)) {
        return json_encode(['status' => false, 'message' => 'Invalid or missing CSRF token. Please refresh the page and try again.']);
    }
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $data = json_decode($player['data']);
    $bididsi01 = 1; //lf4
    $bideski = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi01 . '')->fetch_assoc()['bid_credit']);
    $items_query_result = $mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '');
    $items_data = $items_query_result->fetch_assoc();
    $items = json_decode($items_data['items']);
    $bid_credit = $mysqli->real_escape_string($bid_credit);

    if ($items->lf4Count < 40) {
      if ($bid_credit <= $bideski) {
        return json_encode(['status' => false, 'message' => 'Your bid is low']);
      }
      if ($data->credits < $bid_credit) {
        return json_encode(['status' => false, 'message' => 'Your credit is insufficient']);
      }
      if ($data->credits >= $bid_credit) {
        $data->credits -= $bid_credit;
        $mysqli->begin_transaction();
        try {
          $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
          $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 1');
          $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 1');
          $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_credit . ' WHERE bid_id = 1');
          $mysqli->commit();
          return json_encode(['status' => true, 'message' => 'Your offer is successful :)']);
        }
        catch (Exception $e) {
          error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
          $mysqli->rollback();
          return json_encode(['status' => false, 'message' => 'An error occurred during the transaction.']);
        }
      }
    } else {
      return json_encode(['status' => false, 'message' => 'Your account LF4 Max Limit']);
    }
    return json_encode(['status' => false, 'message' => 'An unexpected error occurred.']);
  }

  public static function acik_arttirma_lf4_2($bid_credit_lf4_2, $csrf_token)
  {
    if (!self::validateCsrfToken($csrf_token)) {
        return json_encode(['status' => false, 'message' => 'Invalid or missing CSRF token. Please refresh the page and try again.']);
    }
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $data = json_decode($player['data']);
    $bididsi01_lf4_2 = 6;
    $bideski_lf4_2 = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi01_lf4_2 . '')->fetch_assoc()['bid_credit']);
    $items_lf4_2_query_result = $mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '');
    $items_lf4_2_data = $items_lf4_2_query_result->fetch_assoc();
    $items_lf4_2 = json_decode($items_lf4_2_data['items']);
    $bid_credit_lf4_2 = $mysqli->real_escape_string($bid_credit_lf4_2);

    if ($items_lf4_2->lf4Count < 40) {
      if ($bid_credit_lf4_2 <= $bideski_lf4_2) {
        return json_encode(['status' => false, 'message' => 'Your bid is low']);
      }
      if ($data->credits < $bid_credit_lf4_2) {
        return json_encode(['status' => false, 'message' => 'Your credit is insufficient']);
      }
      if ($data->credits >= $bid_credit_lf4_2) {
        $data->credits -= $bid_credit_lf4_2;
        $mysqli->begin_transaction();
        try {
          $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
          $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 6');
          $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 6');
          $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_credit_lf4_2 . ' WHERE bid_id = 6');
          $mysqli->commit();
          return json_encode(['status' => true, 'message' => 'Your offer is successful :)']);
        }
        catch (Exception $e) {
          error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
          $mysqli->rollback();
          return json_encode(['status' => false, 'message' => 'An error occurred during the transaction.']);
        }
      }
    } else {
      return json_encode(['status' => false, 'message' => 'Your account LF4 Max Limit']);
    }
    return json_encode(['status' => false, 'message' => 'An unexpected error occurred.']);
  }

  public static function acik_arttirma_lf4_3($bid_credit_lf4_3, $csrf_token)
  {
    if (!self::validateCsrfToken($csrf_token)) {
        return json_encode(['status' => false, 'message' => 'Invalid or missing CSRF token. Please refresh the page and try again.']);
    }
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $data = json_decode($player['data']);
    $bididsi01_lf4_3 = 7;
    $bideski_lf4_3 = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi01_lf4_3 . '')->fetch_assoc()['bid_credit']);
    $items_lf4_3_query_result = $mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '');
    $items_lf4_3_data = $items_lf4_3_query_result->fetch_assoc();
    $items_lf4_3 = json_decode($items_lf4_3_data['items']);
    $bid_credit_lf4_3 = $mysqli->real_escape_string($bid_credit_lf4_3);

    if ($items_lf4_3->lf4Count < 40) {
      if ($bid_credit_lf4_3 <= $bideski_lf4_3) {
        return json_encode(['status' => false, 'message' => 'Your bid is low']);
      }
      if ($data->uridium < $bid_credit_lf4_3) {
        return json_encode(['status' => false, 'message' => 'Your uridium is insufficient']);
      }
      if ($data->uridium >= $bid_credit_lf4_3) {
        $data->uridium -= $bid_credit_lf4_3;
        $mysqli->begin_transaction();
        try {
          $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
          $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 7');
          $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 7');
          $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_credit_lf4_3 . ' WHERE bid_id = 7');
          $mysqli->commit();
          return json_encode(['status' => true, 'message' => 'Your offer is successful :)']);
        }
        catch (Exception $e) {
          error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
          $mysqli->rollback();
          return json_encode(['status' => false, 'message' => 'An error occurred during the transaction.']);
        }
      }
    } else {
      return json_encode(['status' => false, 'message' => 'Your account LF4 Max Limit']);
    }
    return json_encode(['status' => false, 'message' => 'An unexpected error occurred.']);
  }

  public static function acik_arttirma_lf4_4($bid_credit_lf4_4, $csrf_token)
  {
    if (!self::validateCsrfToken($csrf_token)) {
        return json_encode(['status' => false, 'message' => 'Invalid or missing CSRF token. Please refresh the page and try again.']);
    }
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $data = json_decode($player['data']);
    $bididsi01_lf4_4 = 8;
    $bideski_lf4_4 = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi01_lf4_4 . '')->fetch_assoc()['bid_credit']);
    $items_lf4_4_query_result = $mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '');
    $items_lf4_4_data = $items_lf4_4_query_result->fetch_assoc();
    $items_lf4_4 = json_decode($items_lf4_4_data['items']);
    $bid_credit_lf4_4 = $mysqli->real_escape_string($bid_credit_lf4_4);

    if ($items_lf4_4->lf4Count < 40) {
      if ($bid_credit_lf4_4 <= $bideski_lf4_4) {
        return json_encode(['status' => false, 'message' => 'Your bid is low']);
      }
      if ($data->uridium < $bid_credit_lf4_4) {
        return json_encode(['status' => false, 'message' => 'Your uridium is insufficient']);
      }
      if ($data->uridium >= $bid_credit_lf4_4) {
        $data->uridium -= $bid_credit_lf4_4;
        $mysqli->begin_transaction();
        try {
          $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
          $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 8');
          $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 8');
          $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_credit_lf4_4 . ' WHERE bid_id = 8');
          $mysqli->commit();
          return json_encode(['status' => true, 'message' => 'Your offer is successful :)']);
        }
        catch (Exception $e) {
          error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
          $mysqli->rollback();
          return json_encode(['status' => false, 'message' => 'An error occurred during the transaction.']);
        }
      }
    } else {
      return json_encode(['status' => false, 'message' => 'Your account LF4 Max Limit']);
    }
    return json_encode(['status' => false, 'message' => 'An unexpected error occurred.']);
  }

  public static function acik_arttirmahavoc($bid_havoc, $csrf_token)
  {
    if (!self::validateCsrfToken($csrf_token)) {
        return json_encode(['status' => false, 'message' => 'Invalid or missing CSRF token. Please refresh the page and try again.']);
    }
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $data = json_decode($player['data']);
    $bididsi03 = 3;
    $bideskihavoc = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi03 . '')->fetch_assoc()['bid_credit']);
    $items_query_result = $mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '');
    $items_data = $items_query_result->fetch_assoc();
    $items = json_decode($items_data['items']);
    $bid_havoc = $mysqli->real_escape_string($bid_havoc);

    if ($items->havocCount < 10) {
      if ($bid_havoc <= $bideskihavoc) {
        return json_encode(['status' => false, 'message' => 'Your bid is low']);
      }
      if ($data->uridium < $bid_havoc) {
        return json_encode(['status' => false, 'message' => 'Your uridium is insufficient']);
      }
      if ($data->uridium >= $bid_havoc) {
        $data->uridium -= $bid_havoc;
        $mysqli->begin_transaction();
        try {
          $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
          $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 3');
          $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 3');
          $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_havoc . ' WHERE bid_id = 3');
          $mysqli->commit();
          return json_encode(['status' => true, 'message' => 'Your offer is successful :)']);
        }
        catch (Exception $e) {
          error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
          $mysqli->rollback();
          return json_encode(['status' => false, 'message' => 'An error occurred during the transaction.']);
        }
      }
    } else {
      return json_encode(['status' => false, 'message' => 'Your account Havoc Max Limit']);
    }
    return json_encode(['status' => false, 'message' => 'An unexpected error occurred.']);
  }

  public static function acik_arttirmahercul($bid_hercul, $csrf_token)
  {
    if (!self::validateCsrfToken($csrf_token)) {
        return json_encode(['status' => false, 'message' => 'Invalid or missing CSRF token. Please refresh the page and try again.']);
    }
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $data = json_decode($player['data']);
    $bididsi02 = 2;
    $bideskihercul = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi02 . '')->fetch_assoc()['bid_credit']);
    $items_query_result = $mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '');
    $items_data = $items_query_result->fetch_assoc();
    $items = json_decode($items_data['items']);
    $bid_hercul = $mysqli->real_escape_string($bid_hercul);

    if ($items->herculesCount < 10) {
      if ($bid_hercul <= $bideskihercul) {
        return json_encode(['status' => false, 'message' => 'Your bid is low']);
      }
      if ($data->uridium < $bid_hercul) {
        return json_encode(['status' => false, 'message' => 'Your uridium is insufficient']);
      }
      if ($data->uridium >= $bid_hercul) {
        $data->uridium -= $bid_hercul;
        $mysqli->begin_transaction();
        try {
          $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
          $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 2');
          $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 2');
          $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_hercul . ' WHERE bid_id = 2');
          $mysqli->commit();
          return json_encode(['status' => true, 'message' => 'Your offer is successful :)']);
        }
        catch (Exception $e) {
          error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
          $mysqli->rollback();
          return json_encode(['status' => false, 'message' => 'An error occurred during the transaction.']);
        }
      }
    } else {
      return json_encode(['status' => false, 'message' => 'Your account Hercules Max Limit']);
    }
    return json_encode(['status' => false, 'message' => 'An unexpected error occurred.']);
  }

  public static function acik_arttirma_apis($bid_apis, $csrf_token)
  {
    if (!self::validateCsrfToken($csrf_token)) {
        return json_encode(['status' => false, 'message' => 'Invalid or missing CSRF token. Please refresh the page and try again.']);
    }
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $data = json_decode($player['data']);
    $bididsi04 = 4;
    $bideskiapis = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi04 . '')->fetch_assoc()['bid_credit']);
    $items_query_result = $mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '');
    $items_data = $items_query_result->fetch_assoc();
    $items = json_decode($items_data['items']);
    $bid_apis = $mysqli->real_escape_string($bid_apis);

    if (!$items->apis) {
      if ($bid_apis <= $bideskiapis) {
        return json_encode(['status' => false, 'message' => 'Your bid is low']);
      }
      if ($data->uridium < $bid_apis) {
        return json_encode(['status' => false, 'message' => 'Your uridium is insufficient']);
      }
      if ($data->uridium >= $bid_apis) {
        $data->uridium -= $bid_apis;
        $mysqli->begin_transaction();
        try {
          $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
          $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 4');
          $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 4');
          $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_apis . ' WHERE bid_id = 4');
          $mysqli->commit();
          return json_encode(['status' => true, 'message' => 'Your offer is successful :)']);
        }
        catch (Exception $e) {
          error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
          $mysqli->rollback();
          return json_encode(['status' => false, 'message' => 'An error occurred during the transaction.']);
        }
      }
    } else {
      return json_encode(['status' => false, 'message' => 'Your account APIS Limit']);
    }
    return json_encode(['status' => false, 'message' => 'An unexpected error occurred.']);
  }

  public static function acik_arttirma_zeus($bid_zeus, $csrf_token)
  {
    if (!self::validateCsrfToken($csrf_token)) {
        return json_encode(['status' => false, 'message' => 'Invalid or missing CSRF token. Please refresh the page and try again.']);
    }
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $data = json_decode($player['data']);
    $bididsi05 = 5;
    $bideskizeus = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi05 . '')->fetch_assoc()['bid_credit']);
    $items_query_result = $mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '');
    $items_data = $items_query_result->fetch_assoc();
    $items = json_decode($items_data['items']);
    $bid_zeus = $mysqli->real_escape_string($bid_zeus);

    if (!$items->zeus) {
      if ($bid_zeus <= $bideskizeus) {
        return json_encode(['status' => false, 'message' => 'Your bid is low']);
      }
      if ($data->uridium < $bid_zeus) {
        return json_encode(['status' => false, 'message' => 'Your uridium is insufficient']);
      }
      if ($data->uridium >= $bid_zeus) {
        $data->uridium -= $bid_zeus;
        $mysqli->begin_transaction();
        try {
          $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
          $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 5');
          $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 5');
          $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_zeus . ' WHERE bid_id = 5');
          $mysqli->commit();
          return json_encode(['status' => true, 'message' => 'Your offer is successful :)']);
        }
        catch (Exception $e) {
          error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
          $mysqli->rollback();
          return json_encode(['status' => false, 'message' => 'An error occurred during the transaction.']);
        }
      }
    } else {
      return json_encode(['status' => false, 'message' => 'Your account ZEUS Limit']);
    }
    return json_encode(['status' => false, 'message' => 'An unexpected error occurred.']);
  }
}
?>

[end of files/classes/Functions.php]
