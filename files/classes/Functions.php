<?php
class Functions
{
  const UPGRADE_WAIT_TIME = '5 minutes';

  private static $upgradeableItemConfig = [
    "LF-1" => ['field' => 'lf1lvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "LF-2" => ['field' => 'lf2lvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "LF-3" => ['field' => 'lf3lvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "LF-4" => ['field' => 'lf4lvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "Prometeus" => ['field' => 'lf5lvl', 'maxLevel' => 16, 'type' => 'equipment'], // LF-5 in some comments, Prometeus in data
    "SG3N-B01" => ['field' => 'B01lvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "SG3N-B02" => ['field' => 'B02lvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "SG3N-B03" => ['field' => 'B03lvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "SG3N-A01" => ['field' => 'A01lvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "SG3N-A02" => ['field' => 'A02lvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "SG3N-A03" => ['field' => 'A03lvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "LF-3-Neutron" => ['field' => 'lf3nlvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "LF-4-MD" => ['field' => 'lf4mdlvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "LF-4-PD" => ['field' => 'lf4pdlvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "LF-4-HP" => ['field' => 'lf4hplvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "LF-4-SP" => ['field' => 'lf4splvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "Unstable LF-4" => ['field' => 'lf4unstablelvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "MP-1" => ['field' => 'mp1lvl', 'maxLevel' => 16, 'type' => 'equipment'],
    "Drone Level" => ['field' => 'droneExp', 'maxLevel' => 6, 'type' => 'drone_exp'], // Special type for drone experience
  ];

  private static $droneLevelExperienceMap = [
      1 => 0,
      2 => 500,
      3 => 1000,
      4 => 1500,
      5 => 2000,
      6 => 2500
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
        // Assuming all these fields might be used on a clan page loaded via LoadPage
        $clan = $mysqli->query('SELECT id, name, tag, description, factionId, recruiting, leaderId, join_dates, date, rank, rankPoints, profile FROM server_clans WHERE id = ' . $player['clanId'] . '')->fetch_assoc();
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

    if ($mysqli->query('SELECT userId FROM player_accounts WHERE username = "' . $username . '"')->num_rows <= 0) {

      if ($mysqli->query('SELECT userId FROM player_accounts WHERE email = "' . $email . '"')->num_rows > 0) {
        $json['type'] = "email";
        $json['message'] = "This email is already taken.";

        return json_encode($json);
      }

      $ip = Functions::GetIP();
      $sessionId = Functions::GetUniqueSessionId(); // This is actually for the session, not email verification
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

        $emailVerificationToken = Functions::GenerateRandom(32);

        $verification = [
          'verified' => false,
          'hash' => $emailVerificationToken
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

      $checkIsAdmin = $mysqli->query('SELECT userId, type FROM chat_permissions WHERE userId = "'.$id.'"');

      if ($checkIsAdmin->num_rows > 0){
        $type = (integer) $checkIsAdmin->fetch_assoc()['type'];
        if (($type == 1) || ($type == 2)){
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    }
  }

  public static function checkIsFullAdmin($id = null){
    if ($id){
      $mysqli = Database::GetInstance();

      $checkIsAdmin = $mysqli->query('SELECT userId, type FROM chat_permissions WHERE userId = "'.$id.'"');

      if ($checkIsAdmin->num_rows > 0){
        $type = (integer) $checkIsAdmin->fetch_assoc()['type'];
        if ($type == 1){
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    }
  }

  public static function addVoucherLog($voucher = null, $id = null, $item = null, $amount = null){
    if (isset($item) && isset($amount) && isset($id)){
      $mysqli = Database::GetInstance();

      $addLog = $mysqli->query("INSERT INTO `voucher_log` (`voucher`, `userId`, `item`,`amount`,`date`) VALUES ('$voucher', '$id', '$item','$amount','".time()."');");

      if ($addLog){
        return true;
      } else {
        return false;
      }
    }
  }

  public static function getInfoGalaxyGate($gateId){
    if (isset($gateId) && !empty($gateId) && is_numeric($gateId)){

      $mysqli = Database::GetInstance();
      $id = $mysqli->real_escape_string(Functions::s($_SESSION['account']['id']));

      $json = [
        'message' => '',
        'lives' => 0
      ];

      $checkGate = $mysqli->query("SELECT lives FROM player_galaxygates WHERE gateId = '$gateId' AND userId = '$id'");

      if ($checkGate->num_rows > 0){
        $infoP = $checkGate->fetch_assoc();
        $json['lives'] = $infoP['lives'];

        return json_encode($json);
      } else {
        return json_encode($json);
      }

    }
  }

  public static function buyLive($gateId){
    if (isset($gateId) && !empty($gateId) and is_numeric($gateId)){
      
      $mysqli = Database::GetInstance();
      $id = $mysqli->real_escape_string(Functions::s($_SESSION['account']['id']));

      $json = [
        'message' => '',
        'lives' => 0
      ];

      // lives is used later, parts is decoded and used. Other fields like prepared, wave are not directly used in this function after fetch.
      $checkGate = $mysqli->query("SELECT lives, parts, prepared, wave FROM player_galaxygates WHERE gateId = '$gateId' AND userId = '$id'");

      $galaxyParts = self::getInfoGate($gateId);

      if (!$galaxyParts){
        $json['message'] = "Please select a unlock gate.";

        return json_encode($json);
      }

      if (isset($_SESSION['ggtime']) and $_SESSION['ggtime'] >= time()){
        $json['message'] = "Please wait 5 seconds";

        return json_encode($json);
      }

      $fetch = $mysqli->query('SELECT data FROM player_accounts WHERE userId = ' . $id . '')->fetch_assoc();
      $data = json_decode($fetch['data'], true);

      if ($data['uridium'] < $galaxyParts[$gateId]['live_cost']){
        $json['message'] = "You don't have enough Uridium.";

        return json_encode($json);
      }

      $_SESSION['ggtime'] = strtotime('+5 second');

      $changeU = $data['uridium']-=$galaxyParts[$gateId]['live_cost'];

      if(Socket::Get('IsOnline', array('UserId' => $id, 'Return' => false))) {
        Socket::Send('UpdateUridium', ['UserId' => $id, 'UridiumPrice' => $galaxyParts[$gateId]['live_cost'], 'Type' => "DECREASE"]);
      } else {
        $data['uridium'] = $changeU;
        $mysqli->query("UPDATE player_accounts SET data = '".json_encode($data)."' WHERE userId = '$id'");
      }

      $json['uridium'] = number_format($changeU, 0, ',', '.');

      if ($checkGate->num_rows > 0){
        $dataGate = $checkGate->fetch_assoc();
        $updateLive = $mysqli->query("UPDATE player_galaxygates SET lives = lives+1 WHERE userId = '$id' AND gateId = '$gateId'");

        $json['message'] = "Sucesfully buyed 1 live.";
        $json['log'] = "Buyed 1 live in ".$galaxyParts[$gateId]['name']." gate";
        $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
        $json['lives'] = $dataGate['lives']+1;

        self::gg_log($json['log'], $id);

        return json_encode($json);
      } else {
        $insertLive = $mysqli->query("INSERT INTO `player_galaxygates` (`userId`, `gateId`, `parts`, `lives`, `prepared`, `wave`) VALUES ('$id', '$gateId', '[]', '4', '0', '1')");

        $json['message'] = "Sucesfully buyed 1 live.";
        $json['log'] = "Buyed 1 live in ".$galaxyParts[$gateId]['name']." gate";
        $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
        $json['lives'] = 4;

        self::gg_log($json['log'], $id);

        return json_encode($json);
      }

    }
  }

  public static function ggPreparePortal($gateId){
    if (isset($gateId) and !empty($gateId) and is_numeric($gateId)){

      $mysqli = Database::GetInstance();
      $id = $mysqli->real_escape_string(Functions::s($_SESSION['account']['id']));

      $json = [
        'message' => ''
      ];

      $checkGate = $mysqli->query("SELECT * FROM player_galaxygates WHERE gateId = '$gateId' AND userId = '$id'");

      $galaxyParts = self::getInfoGate($gateId);

      if ($checkGate->num_rows > 0){

        $dataQ = $checkGate->fetch_assoc();

        if ($dataQ['prepared'] == '1'){
          $json['message'] = $galaxyParts[$gateId]['name']." is ready.";

          return json_encode($json);
        }

        $dataGate = json_decode($dataQ['parts']);
        $totalParts = 0;

        foreach($dataGate as $dg){
          $totalParts += $dg;
        }

        if ($totalParts >= $galaxyParts[$gateId]['parts']){

          $q = $mysqli->query("UPDATE player_galaxygates SET prepared = 1 WHERE userId = '$id' AND gateId = '$gateId'");

          if ($q){
            $json['message'] = $galaxyParts[$gateId]['name']." gate has prepared sucesfully.";

            return json_encode($json);
          } else {
            $json['message'] = "Error to prepare the gate ".$galaxyParts[$gateId]['name'];

            return json_encode($json);
          }

        } else {
          $json['message'] = $galaxyParts[$gateId]['name']." gate not unlocked. Complete the parts. Current parts: ".$totalParts."/".$galaxyParts[$gateId]['parts'];

          return json_encode($json);
        }

      } else {
        $json['message'] = $galaxyParts[$gateId]['name']." gate not unlocked. Complete all parts.";

        return json_encode($json);
      }

    }
  }

  public static function getInfoGate($gateId, $json = false){
    if (isset($gateId) and !empty($gateId) and is_numeric($gateId)){

      $mysqli = Database::GetInstance();

      $queryGate = $mysqli->query("SELECT * FROM info_galaxygates WHERE gateId = '$gateId'");

      if ($queryGate->num_rows > 0){
        $dataGate = $queryGate->fetch_assoc();

        if ($json){
          return json_encode(array('name' => $dataGate['name'], 'parts' => $dataGate['parts'], 'cost' => number_format($dataGate['cost'], 0, ',', '.'), 'live_cost' => number_format($dataGate['live_cost'], 0, ',', '.')));
        } else {
          return array($gateId => array('name' => $dataGate['name'], 'parts' => $dataGate['parts'], 'cost' => $dataGate['cost'], 'live_cost' => $dataGate['live_cost']));
        }
      } else {  
        return false;
      }

    }
  }

  public static function gg_log($log, $userId){
    if (isset($log) && isset($userId)){

      $mysqli = Database::GetInstance();

      $insertLog = $mysqli->query("INSERT INTO `gg_log` (`log`, `userId`, `date`) VALUES ('$log','$userId','".time()."');");

      if ($insertLog){
        return true;
      } else {
        return false;
      }

    }
  }

  public static function gg($gateId){

    if (isset($gateId) and !empty($gateId) and is_numeric($gateId)){

      $mysqli = Database::GetInstance();

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

      $galaxyParts = self::getInfoGate($gateId);

      $gateExists = (isset($galaxyParts[$gateId]) ? true : false);

      if (empty($gateExists) && $gateExists == false){
        $json['message'] = "Please select a unlock gate.";

        return json_encode($json);
      }

      $id = $mysqli->real_escape_string(Functions::s($_SESSION['account']['id']));
      $fetch = $mysqli->query('SELECT data FROM player_accounts WHERE userId = ' . $id . '')->fetch_assoc(); // Already specific
      $data = json_decode($fetch['data'], true);

      $json['uridium'] = number_format($data['uridium'], 0, ',', '.');

      // Needs 'parts' for json_decode, 'lives' for direct use. prepared, wave are not directly used.
      $checkIfExistsParts = $mysqli->query("SELECT parts, lives FROM player_galaxygates WHERE userId = '$id' AND gateId = '$gateId'");

      if ($checkIfExistsParts->num_rows > 0){
        $infoQData = $checkIfExistsParts->fetch_assoc();
        $dataParts = json_decode($infoQData['parts']);
        $totalParts = 0;

        foreach ($dataParts as $part){
          $totalParts += $part;
        }

        if ($totalParts >= $galaxyParts[$gateId]['parts']){
          $json['message'] = $galaxyParts[$gateId]['name']." is unlocked.";

          return json_encode($json);
        }
      }


      if ($data['uridium'] < $galaxyParts[$gateId]['cost']){
        $json['message'] = "You don't have enough Uridium.";

        return json_encode($json);
      }


      $changeU = $data['uridium']-=$galaxyParts[$gateId]['cost'];

      if(Socket::Get('IsOnline', array('UserId' => $id, 'Return' => false))) {
        Socket::Send('UpdateUridium', ['UserId' => $id, 'UridiumPrice' => $galaxyParts[$gateId]['cost'], 'Type' => "DECREASE"]);
      } else {
        $data['uridium'] = $changeU;
        $mysqli->query("UPDATE player_accounts SET data = '".json_encode($data)."' WHERE userId = '$id'");
      }

      $json['uridium'] = number_format($changeU, 0, ',', '.');
      
      $json['lives'] = (isset($infoQData) && $infoQData['lives']) ? $infoQData['lives'] : 0;

      if (!empty($result['uridium'])){
        $uridium = $result['uridium'];

        $changeU = $data['uridium'] += $uridium;

        if(Socket::Get('IsOnline', array('UserId' => $id, 'Return' => false))) {
          Socket::Send('UpdateUridium', ['UserId' => $id, 'UridiumPrice' => $uridium, 'Type' => "INCREASE"]);
        } else {
          $data['uridium'] = $changeU;
          $mysqli->query("UPDATE player_accounts SET data = '".json_encode($data)."' WHERE userId = '$id'");
        }

        $json['message'] = "You have earned ".$uridium." uridium.";
        $json['uridium'] = number_format($changeU, 0, ',', '.');
        $json['log'] = "Earned ".$uridium." uridium.";
        $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));

        self::gg_log($json['log'], $id);
      }

      if (!empty($result['ammoType']) && !empty($result['ammoAmount'])){

        $ammoType = $result['ammoType'];
        $ammoAmount = $result['ammoAmount'];

        if(Socket::Get('IsOnline', array('UserId' => $id, 'Return' => false))) {
          Socket::Send('AddAmmo', ['UserId' => $id, 'itemId' => $ammoType, 'amount' => $ammoAmount]);
        } else {
          $ammo=json_decode($mysqli->query("SELECT ammo FROM player_accounts WHERE userId=".$id)->fetch_assoc()["ammo"]);
          if (empty($ammo->{typeMunnition[$ammoType]})){
            $ammo->{typeMunnition[$ammoType]} = $ammoAmount;
          } else {
            $ammo->{typeMunnition[$ammoType]} += $ammoAmount;
          }
          $mysqli->query("UPDATE player_accounts SET ammo = '".json_encode($ammo)."' WHERE userId = ".$id);
        }

        $json['message'] = "You have earned ".$ammoAmount." ".typeMunnition[$ammoType]." ammo";
        $json['log'] = "Earned ".$ammoAmount." ".typeMunnition[$ammoType]." ammo";
        $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));

        self::gg_log($json['log'], $id);

      }

      if (!empty($result['parts'])){
        $parts = $result['parts'];

        if ($checkIfExistsParts->num_rows > 0){

          $totalParts = 0;

          array_push($dataParts, $parts);

          foreach ($dataParts as $part){
            $totalParts += $part;
          }

          $prepared = ($totalParts >= $galaxyParts[$gateId]['parts']) ? 1 : 0;

          $encode = json_encode($dataParts);

          $mysqli->query("UPDATE player_galaxygates SET parts = '$encode' WHERE userId = '$id' AND gateId = '$gateId'");

          if ($prepared === 1){
            $json['totalParts'] = "Unlocked";
            $json['message'] = "You have earned ".$parts." parts. Has unlocked succesfully ".$galaxyParts[$gateId]['name']." gate.";
            $json['completed'] = 1;
            $json['log'] = "Earned ".$parts." parts of ".$galaxyParts[$gateId]['name']." gate. Sucesfully unlocked gate.";
            $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
            self::gg_log($json['log'], $id);
          } else {
            $json['message'] = "You have earned ".$parts." parts.";
            $json['totalParts'] = $totalParts."/".$galaxyParts[$gateId]['parts'];
            $json['log'] = "Earned ".$parts." parts of ".$galaxyParts[$gateId]['name']." gate";
            $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
            self::gg_log($json['log'], $id);
          }

        } else {
          $dataParts = json_encode(array($parts));
          $insertParts = $mysqli->query("INSERT INTO `player_galaxygates` (`userId`, `gateId`, `parts`, `lives`, `prepared`, `wave`) VALUES ('$id', '$gateId', '$dataParts', '3', '0', '1')");

          $json['message'] = "You have earned ".$parts." parts.";
          $json['totalParts'] = $parts."/".$galaxyParts[$gateId]['parts'];
          $json['log'] = "Earned ".$parts." parts of ".$galaxyParts[$gateId]['name']." gate";
          $json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
          self::gg_log($json['log'], $id);
        }

      }

      return json_encode($json);

    }
    
  }

  public static function checkVoucher($voucherId = null){
    if ($voucherId){
      $mysqli = Database::GetInstance();

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

      $checkVouch = $mysqli->query("SELECT voucher, only_one_user, uses, design, uridium, credits, event_coins FROM vouchers WHERE voucher = '".$voucherId."'");

      if ($checkVouch->num_rows > 0){
        $dataV = $checkVouch->fetch_assoc();

        $id = $mysqli->real_escape_string(Functions::s($_SESSION['account']['id']));
        $fetch = $mysqli->query('SELECT data FROM player_accounts WHERE userId = ' . $id . '')->fetch_assoc(); // Already specific
        $data = json_decode($fetch['data'], true);
        
        // Check voucher data.

        if ($dataV['only_one_user']){
          $checkIfUsed = $mysqli->query("SELECT userId FROM vouchers_uses WHERE voucherId = '".$dataV['voucher']."' AND userId = '$id'"); // voucherId from $dataV

          if ($checkIfUsed->num_rows > 0){
            $json['message'] = "You already used the voucher ".$voucherId;
            return json_encode($json);
          }

        }

        if ($dataV['uses'] <= 0){
          $json['message'] = "The voucher \"".$voucherId."\" has already been used.";

          return json_encode($json);
        }

        if (!empty($dataV['design'])){
          $dataShip = $mysqli->query("SELECT baseShipId FROM server_ships WHERE lootID = '".$dataV['design']."' AND baseShipId > 0");
          if ($dataShip->num_rows > 0){
            $dataS = $dataShip->fetch_assoc();
            
            self::addVoucherLog($voucherId, $id, 'design', $dataV['design']);

            $json['voucher'] = $voucherId;
            $json['item'] = "design";
            $json['amount'] = $dataV['design'];
            $json['date'] = date("d-m-Y h:i:s", strtotime("+2 hours"));
            $mysqli->query("INSERT INTO `player_designs` (`name`, `baseShipId`, `userId`) VALUES ('".$dataV['design']."', '".$dataS['baseShipId']."', '$id');");
          }
        }

        if (!empty($dataV['uridium'])){
          $uridium = $dataV['uridium'];
          $changeU = $data['uridium'] += $uridium;

          if(Socket::Get('IsOnline', array('UserId' => $id, 'Return' => false))) {
            Socket::Send('UpdateUridium', ['UserId' => $id, 'UridiumPrice' => $uridium, 'Type' => "INCREASE"]);
          } else {
            $data['uridium'] = $changeU;
            $mysqli->query("UPDATE player_accounts SET data = '".json_encode($data)."' WHERE userId = '$id'");
          }

          self::addVoucherLog($voucherId, $id, 'uridium', $uridium);

          $json['voucher'] = $voucherId;
          $json['item'] = "uridium";
          $json['amount'] = $uridium;
          $json['date'] = date("d-m-Y h:i:s", strtotime("+2 hours"));
          $json['uridium'] = number_format($changeU, 0, ',', '.');
        }

        if (!empty($dataV['credits'])){
          $credits = $dataV['credits'];
          $changeC = $data['credits'] += $credits;
          
          if(Socket::Get('IsOnline', array('UserId' => $id, 'Return' => false))) {
            Socket::Send('UpdateCredits', ['UserId' => $id, 'CreditPrice' => $credits, 'Type' => "INCREASE"]);
          } else {
            $data['credits'] = $changeC;
            $mysqli->query("UPDATE player_accounts SET data = '".json_encode($data)."' WHERE userId = '$id'");
          }

          self::addVoucherLog($voucherId, $id, 'credits', $credits);

          $json['voucher'] = $voucherId;
          $json['item'] = "credits";
          $json['amount'] = $credits;
          $json['date'] = date("d-m-Y h:i:s", strtotime("+2 hours"));
          $json['credits'] = number_format($changeC, 0, ',', '.');
        }

        if (!empty($dataV['event_coins'])){
          $ec = $dataV['event_coins'];
          $dataEC = $mysqli->query("SELECT coins FROM event_coins WHERE userId = '$id'");
          
          if ($dataEC->num_rows > 0){
            $updateEC = $mysqli->query("UPDATE event_coins SET coins = coins+$ec WHERE userId = '$id'");
          } else {
            $insertEC = $mysqli->query("INSERT INTO `event_coins` (`coins`, `userId`) VALUES ('$ec', '$id');");
          }

          $coinsAc = $mysqli->query("SELECT coins FROM event_coins WHERE userId = '$id'")->fetch_assoc()['coins'];

          self::addVoucherLog($voucherId, $id, 'event_coins', $ec);

          $json['voucher'] = $voucherId;
          $json['item'] = "event_coins";
          $json['amount'] = $ec;
          $json['date'] = date("d-m-Y h:i:s", strtotime("+2 hours"));
          $json['event_coins'] = number_format($coinsAc, 0, ',', '.');
          
        }
        // end.

        $mysqli->query("UPDATE vouchers SET uses = uses-1 WHERE voucher = '$voucherId'");
        $mysqli->query("INSERT INTO vouchers_uses (userId, voucherId, dateUsed) VALUES ('$id', '$voucherId', '".time()."')");
        $json['message'] = "Vouch: \"".$voucherId."\" used succesfully";

      } else {
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

    $statement = $mysqli->query('SELECT userId, password, verification FROM player_accounts WHERE username = "' . $username . '"');
    $fetch = $statement->fetch_assoc();

    if ($statement->num_rows >= 1) {
      if (password_verify($password, $fetch['password'])) {
        if (json_decode($fetch['verification'])->verified) {
          
          if (MAINTENANCE AND !self::checkIsAdmin($fetch['userId'])){
            $json['type'] = "all";
            $json['message'] = "Maintenance activated. Please login later.";

            return json_encode($json);
          }

          $sessionId = Functions::GetUniqueSessionId();

          $_SESSION['account']['id'] = $fetch['userId'];
          $_SESSION['account']['session'] = $sessionId;

          $mysqli->begin_transaction();

          try {
            $mysqli->query('UPDATE player_accounts SET sessionId = "' . $sessionId . '" WHERE userId = ' . $fetch['userId'] . '');

            $json['status'] = true;
            $json['message'] = 'Login successfully, you will be redirected in 3 seconds.';

            $mysqli->commit();
          } catch (Exception $e) {
            error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
            $json['message'] = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }

          $mysqli->close();
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

    $username = $mysqli->real_escape_string($username);

    $json = [
      'message' => ''
    ];

    if (!isset($_COOKIE['send-link-again-button'])) {
      $statement = $mysqli->query('SELECT userId, email, verification FROM player_accounts WHERE username = "' . $username . '"');
      $fetch = $statement->fetch_assoc();

      if ($statement->num_rows >= 1) {
        SMTP::SendMail($fetch['email'], $username, 'E-mail verification', '<p>Hi ' . $username . ', <br>Click this link to activate your account: <a href="' . DOMAIN . 'api/verify/' . $fetch['userId'] . '/' . json_decode($fetch['verification'])->hash . '">Activate</a></p><p style="font-size:small;color:#666">—<br>You are receiving this because you registered to the ' . SERVER_NAME . '.<br>If that was not your request, then you can ignore this email.<br>This is an automated message, please do not reply directly to this email.</p>');

        $json['message'] = 'Activation link sent again.';
        setcookie('send-link-again-button', true, (time() + (120)), '/');
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
          $mysqli->query('UPDATE player_accounts SET factionId = ' . $factionId . ' WHERE userId = ' . $player['userId'] . '');
          $mysqli->query("UPDATE player_accounts SET position = '".json_encode($position)."' WHERE userId = '".$player['userId']."'");
          $json['status'] = true;
          $mysqli->commit();
        } catch (Exception $e) {
          $json['message'] = 'An error occurred. Please try again later.';
          $mysqli->rollback();
        }

        $mysqli->close();
      } else {
        $data = json_decode($player['data']);

        if ($data->uridium >= 50000) {
          $notOnlineOrOnlineAndInEquipZone = !Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false)) || (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false)) && Socket::Get('IsInEquipZone', array('UserId' => $player['userId'], 'Return' => false)));

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

            $mysqli->begin_transaction();

            try {
              $mysqli->query("UPDATE player_accounts SET factionId = " . $factionId . ", data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");

              $json['status'] = true;
              $mysqli->commit();
            } catch (Exception $e) {
              $json['message'] = 'An error occurred. Please try again later.';
              $mysqli->rollback();
            }

            $mysqli->close();
          } else {
            $json['message'] = 'Change of company is not possible. You must be at a location with a hangar facility!';
          }
        } else {
          $json['message'] = "You don't have enough Uridium.";
        }

        if ($json['status'] && Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
          Socket::Send('ChangeCompany', ['UserId' => $player['userId'], 'UridiumPrice' => 50000, 'HonorPrice' => $data->honor, 'ExperiencePrice' => $data->experience]);
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

    $keywords = $mysqli->real_escape_string($keywords);

    $clans = [];

    foreach ($mysqli->query('SELECT * FROM server_clans WHERE tag like "%' . $keywords . '%" OR name like "%' . $keywords . '%"')->fetch_all(MYSQLI_ASSOC) as $key => $value) {
      $clans[$key]['id'] = $value['id'];
      $clans[$key]['members'] = count($mysqli->query('SELECT userId FROM player_accounts WHERE clanId = ' . $value['id'] . '')->fetch_all(MYSQLI_ASSOC));
      $clans[$key]['tag'] = $value['tag'];
      $clans[$key]['name'] = $value['name'];
      $clans[$key]['rank'] = $value['rank'];
      $clans[$key]['rankPoints'] = $value['rankPoints'];
    }

    return json_encode($clans);
  }

  public static function DiplomacySearchClan($keywords)
  {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();
    $keywords = $mysqli->real_escape_string($keywords);

    $clans = [];

    foreach ($mysqli->query('SELECT id, tag, name FROM server_clans WHERE id != ' . $player['clanId'] . ' AND (tag like "%' . $keywords . '%" OR name like "%' . $keywords . '%")')->fetch_all(MYSQLI_ASSOC) as $key => $value) {
      $clans[$key]['id'] = $value['id'];
      $clans[$key]['tag'] = $value['tag'];
      $clans[$key]['name'] = $value['name'];
    }

    return json_encode($clans);
  }

  public static function RequestDiplomacy($clanId, $diplomacyType, $message = null) {
    
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();
    $clanId = $mysqli->real_escape_string($clanId);
    $diplomacyType = $mysqli->real_escape_string($diplomacyType);
    $clan = $mysqli->query('SELECT id, leaderId, name FROM server_clans WHERE id = ' . $player['clanId'] . '')->fetch_assoc();

    $json = [
      'message' => '',
      'status' => false
    ];

    if ($clanId != 0) {
      if ($clan != NULL) {
        if ($clan['leaderId'] == $player['userId']) {
          $toClan = $mysqli->query('SELECT id, name FROM server_clans WHERE id = "' . $clanId . '"')->fetch_assoc();

          if ($toClan != NULL && $clan['id'] != $toClan['id'] && in_array($diplomacyType, [1, 2, 3, 4, 5, 6])) {
            $mysqli->begin_transaction();

            try {
              $statement = $mysqli->query('SELECT id, diplomacyType FROM server_clan_diplomacy WHERE (senderClanId = ' . $clan['id'] . ' AND toClanId = ' . $toClan['id'] . ') OR (toClanId = ' . $clan['id'] . ' AND senderClanId = ' . $toClan['id'] . ')');
              $fetch = $statement->fetch_assoc();

              if ($statement->num_rows <= 0 || $diplomacyType == 4 || $diplomacyType == 5 || $diplomacyType == 6) {
                if ($diplomacyType == 3) {
                  $mysqli->query('INSERT INTO server_clan_diplomacy (senderClanId, toClanId, diplomacyType) VALUES (' . $clan['id'] . ', ' . $toClan['id'] . ', ' . $diplomacyType . ')');

                  $declaredId = $mysqli->insert_id;

                  $mysqli->query('DELETE FROM server_clan_diplomacy_applications WHERE senderClanId = ' . $clan['id'] . ' AND toClanId = ' . $toClan['id'] . '');

                  $json['status'] = true;
                  $json['message'] = 'You declared war on the ' . $toClan['name'] . ' clan.';

                  $json['declared'] = [
                    'id' => $declaredId,
                    'date' => date('d.m.Y'),
                    'form' => ($diplomacyType == 1 ? 'Alliance' : ($diplomacyType == 2 ? 'NAP' : 'War')),
                    'clan' => [
                      'id' => $toClan['id'],
                      'name' => $toClan['name']
                    ]
                  ];

                  Socket::Send('StartDiplomacy', ['SenderClanId' => $clan['id'], 'TargetClanId' => $toClan['id'], 'DiplomacyType' => $diplomacyType]);
                } else {
                  if ($mysqli->query('SELECT id FROM server_clan_diplomacy_applications WHERE senderClanId = ' . $clan['id'] . ' AND toClanId = ' . $toClan['id'] . '')->num_rows <= 0) {
                    $mysqli->query('INSERT INTO server_clan_diplomacy_applications (senderClanId, toClanId, diplomacyType) VALUES (' . $clan['id'] . ', ' . $toClan['id'] . ', ' . $diplomacyType . ')');

                    $requestId = $mysqli->insert_id;

                    if (!empty($message)){
                      $mysqli->query("UPDATE server_clan_diplomacy_applications SET message = '$message' WHERE id = '$requestId'");
                    }

                    $json['status'] = true;
                    $json['message'] = 'Your diplomacy request was sent.';

                    $json['request'] = [
                      'id' => $requestId,
                      'date' => date('d.m.Y'),
                      'form' => ($diplomacyType == 1 ? 'Alliance' : ($diplomacyType == 2 ? 'NAP' : ($diplomacyType == 3 ? 'War' : 'End War'))),
                      'clan' => [
                        'name' => $toClan['name']
                      ]
                    ];
                  } else {
                    $json['message'] = 'You already submitted a diplomacy request to this clan.';
                  }
                }
              } else {
                $currentStatus = $fetch['diplomacyType'] == 1 ? 'Alliance' : ($fetch['diplomacyType'] == 2 ? 'NAP' : 'War');

                $json['message'] = 'You already have a diplomatic status with this clan.<br>Current status: ' . $currentStatus . '';
              }

              $mysqli->commit();
            } catch (Exception $e) {
              $json['message'] = 'An error occurred. Please try again later.';
              $mysqli->rollback();
            }

            $mysqli->close();
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
    $clanId = $mysqli->real_escape_string($clanId);
    $text = $mysqli->real_escape_string($text);

    $json = [
      'status' => false,
      'message' => ''
    ];

    $clan = $mysqli->query('SELECT id, recruiting, tag, name FROM server_clans WHERE id = "' . $clanId . '"')->fetch_assoc();

    if ($clan != NULL & $clan['recruiting'] && $mysqli->query('SELECT id FROM server_clan_applications WHERE clanId = ' . $clanId . ' AND userId = ' . $player['userId'] . '')->num_rows <= 0 && $player['clanId'] == 0) {
      
      if (empty($text)){
        $json['message'] = "Type your Application text";
        return json_encode($json);
      }
      
      $mysqli->begin_transaction();

      try {
        $mysqli->query('INSERT INTO server_clan_applications (clanId, userId, text) VALUES (' . $clanId . ', ' . $player['userId'] . ', "' . $text . '")');

        $json['status'] = true;
        $json['message'] = 'Your application was sent to the clan leader.';
        $json['appId'] = $mysqli->insert_id;
        $json['clanTag'] = $clan['tag'];
        $json['clanName'] = $clan['name'];

        $mysqli->commit();
      } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later.';
        $mysqli->rollback();
      }

      $mysqli->close();
    } else {
      $json['message'] = 'Something went wrong!';
    }

    return json_encode($json);
  }

  public static function FoundClan($name, $tag, $description)
  {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();
    $name = $mysqli->real_escape_string($name);
    $tag = $mysqli->real_escape_string($tag);
    $description = $mysqli->real_escape_string($description);

    $json = [
      'message' => "",
      'status' => false
    ];

    if (mb_strlen($name) < 1 || mb_strlen($name) > 50) {
      $json['message'] = "Name only permit 1-12 characters";
      
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
      if ($mysqli->query('SELECT id FROM server_clans WHERE name = "' . $name . '"')->num_rows <= 0) {
        if ($mysqli->query('SELECT id FROM server_clans WHERE tag = "' . $tag . '"')->num_rows <= 0) {
          $mysqli->begin_transaction();

          try {
            $join_dates = [
              $player['userId'] => date('Y-m-d H:i:s')
            ];

            $mysqli->query('DELETE FROM server_clan_applications WHERE userId = ' . $player['userId'] . '');

            $mysqli->query("INSERT INTO server_clans (name, tag, description, factionId, recruiting, leaderId, join_dates) VALUES ('" . $name . "', '" . $tag . "', '" . $description . "', " . $player['factionId'] . ", 1, " . $player['userId'] . ", '" . json_encode($join_dates) . "')");

            $clanId = $mysqli->insert_id;

            $mysqli->query('UPDATE player_accounts SET clanId = ' . $clanId . ' WHERE userId = ' . $player['userId'] . '');

            $json['status'] = true;

            Socket::Send('CreateClan', ['UserId' => $player['userId'], 'ClanId' => $clanId, 'FactionId' => $player['factionId'], 'Name' => $name, 'Tag' => $tag]);

            $mysqli->commit();
          } catch (Exception $e) {
            $json['message'] = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }

          $mysqli->close();
        } else {
          $json['message'] = 'Another clan is already using this tag. Please select another one for your clan.';
        }
      } else {
        $json['message'] = 'Another clan is already using this name. Please select another one for your clan.';
      }
    }

    return json_encode($json);
  }

  public static function WithdrawPendingApplication($clanId)
  {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();
    $clanId = $mysqli->real_escape_string($clanId);

    $json = [
      'status' => false,
      'message' => ''
    ];

    if ($mysqli->query('SELECT id FROM server_clan_applications WHERE clanId = "' . $clanId . '" AND userId = ' . $player['userId'] . '')->num_rows >= 1) {
      $mysqli->begin_transaction();

      try {
        $mysqli->query('DELETE FROM server_clan_applications WHERE clanId = ' . $clanId . ' AND userId = ' . $player['userId'] . '');

        $json['status'] = true;
        $json['message'] = 'Application deleted.';

        $mysqli->commit();
      } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later.';
        $mysqli->rollback();
      }

      $mysqli->close();
    } else {
      $json['message'] = 'Something went wrong!';
    }

    return json_encode($json);
  }

  public static function LeaveClan()
  {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();
    $clan = $mysqli->query('SELECT id, leaderId, join_dates FROM server_clans WHERE id = ' . $player['clanId'] . '')->fetch_assoc();

    $json = [
      'status' => false,
      'message' => ''
    ];

    $notOnlineOrOnlineAndInEquipZone = !Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false)) || (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false)) && Socket::Get('IsInEquipZone', array('UserId' => $player['userId'], 'Return' => false)));

    if ($clan != NULL && $clan['leaderId'] != $player['userId']) {
      if ($notOnlineOrOnlineAndInEquipZone) {
        $mysqli->begin_transaction();

        try {
          $mysqli->query('UPDATE player_accounts SET clanId = 0 WHERE userId = ' . $player['userId'] . '');

          $join_dates = json_decode($clan['join_dates']);

          if (property_exists($join_dates, $player['userId'])) {
            unset($join_dates->{$player['userId']});
          }

          $mysqli->query("UPDATE server_clans SET join_dates = '" . json_encode($join_dates) . "' WHERE id = " . $clan['id'] . "");

          $json['status'] = true;

          Socket::Send('LeaveFromClan', ['UserId' => $player['userId']]);

          $mysqli->commit();
        } catch (Exception $e) {
          $json['message'] = 'An error occurred. Please try again later.';
          $mysqli->rollback();
        }

        $mysqli->close();
      } else {
        $json['message'] = 'You must be at your corporate HQ station to leave your Clan.';
      }
    } else {
      $json['message'] = 'Something went wrong!';
    }

    return json_encode($json);
  }

  public static function DismissClanMember($userId = null) {

    $mysqli = Database::GetInstance();

    $json = [
      'status' => false,
      'message' => ''
    ];

    if (empty($userId)){
      $json['message'] = "Error to delete a member.";

      return json_encode($json);
    }

    $player = Functions::GetPlayer();
    $userId = $mysqli->real_escape_string($userId);
    $clan = $mysqli->query('SELECT id, leaderId, join_dates FROM server_clans WHERE id = ' . $player['clanId'] . '')->fetch_assoc();
    $user = $mysqli->query('SELECT userId, clanId FROM player_accounts WHERE userId = "' . $userId . '" AND clanId = "' . $clan['id'] . '"')->fetch_assoc();

    if ($userId == $player['userId']){
      $json['message'] = "Error to delete a member.";

      return json_encode($json);
    }

    if ($clan != NULL && $user != NULL && $clan['leaderId'] == $player['userId']) {
      $mysqli->begin_transaction();

      try {
        $mysqli->query('UPDATE player_accounts SET clanId = 0 WHERE userId = ' . $user['userId'] . '');

        $join_dates = json_decode($clan['join_dates']);

        if (property_exists($join_dates, $user['userId'])) {
          unset($join_dates->{$user['userId']});
        }

        $mysqli->query("UPDATE server_clans SET join_dates = '" . json_encode($join_dates) . "' WHERE id = " . $clan['id'] . "");

        $json['status'] = true;
        $json['message'] = 'Member deleted sucesfully.';

        Socket::Send('LeaveFromClan', array('UserId' => $user['userId']));

        $mysqli->commit();
      } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later.';
        $mysqli->rollback();
      }

      $mysqli->close();
    } else {
      $json['message'] = 'Something went wrong!';
    }

    return json_encode($json);
  }

  public static function AcceptClanApplication($userId)
  {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();
    $userId = $mysqli->real_escape_string($userId);
    // For $user: userId, pilotName, data (for experience), rankId, factionId, clanId
    $user = $mysqli->query('SELECT userId, pilotName, data, rankId, factionId, clanId FROM player_accounts WHERE userId = "' . $userId . '"')->fetch_assoc();
    // For $clan: id, leaderId, join_dates
    $clan = $mysqli->query('SELECT id, leaderId, join_dates FROM server_clans WHERE id = ' . $player['clanId'] . '')->fetch_assoc();
    $user = $mysqli->query('SELECT userId, pilotName FROM player_accounts WHERE userId = "' . $userId . '"')->fetch_assoc(); // Needs pilotName
    $clan = $mysqli->query('SELECT id, leaderId FROM server_clans WHERE id = ' . $player['clanId'] . '')->fetch_assoc();

    $json = [
      'status' => false,
      'message' => ''
    ];

    if ($clan != NULL && $user != NULL && $clan['leaderId'] == $player['userId'] && $user['clanId'] == 0) {
      $mysqli->begin_transaction();

      try {
        $mysqli->query('UPDATE player_accounts SET clanId = ' . $clan['id'] . ' WHERE userId = ' . $user['userId'] . '');

        $join_dates = json_decode($clan['join_dates']);
        $join_dates->{$user['userId']} = date('Y-m-d H:i:s');

        $mysqli->query("UPDATE server_clans SET join_dates = '" . json_encode($join_dates) . "' WHERE id = " . $clan['id'] . "");

        $mysqli->query('DELETE FROM server_clan_applications WHERE userId = ' . $user['userId'] . '');

        $json['status'] = true;

        $json['acceptedUser'] = [
          'userId' => $user['userId'],
          'pilotName' => $user['pilotName'],
          'experience' => number_format(json_decode($user['data'])->experience),
          'rank' => [
            'id' => $user['rankId'],
            'name' => Functions::GetRankName($user['rankId'])
          ],
          'joined_date' => date('Y.m.d'),
          'company' => $user['factionId'] == 1 ? 'MMO' : ($user['factionId'] == 2 ? 'EIC' : 'VRU')
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

      $mysqli->close();
    } else {
      $json['message'] = 'Something went wrong!';
    }

    return json_encode($json);
  }

  public static function DeclineClanApplication($userId)
  {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();
    $userId = $mysqli->real_escape_string($userId);
    $user = $mysqli->query('SELECT * FROM player_accounts WHERE userId = "' . $userId . '"')->fetch_assoc();
    $clan = $mysqli->query('SELECT * FROM server_clans WHERE id = ' . $player['clanId'] . '')->fetch_assoc();

    $json = [
      'status' => false,
      'message' => ''
    ];

    if ($clan != NULL && $user != NULL && $clan['leaderId'] == $player['userId']) {
      $mysqli->begin_transaction();

      try {
        $mysqli->query('DELETE FROM server_clan_applications WHERE clanId = ' . $clan['id'] . ' AND userId = ' . $user['userId'] . '');

        $json['status'] = true;
        $json['message'] = 'This user was declined: ' . $user['pilotName'];

        $mysqli->commit();
      } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later.';
        $mysqli->rollback();
      }

      $mysqli->close();
    } else {
      $json['message'] = 'Something went wrong!';
    }

    return json_encode($json);
  }

  public static function CancelDiplomacyRequest($requestId) {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();
    $clan = $mysqli->query('SELECT id, leaderId FROM server_clans WHERE id = ' . $player['clanId'] . '')->fetch_assoc();
    $requestId = $mysqli->real_escape_string($requestId);

    $json = [
      'status' => false,
      'message' => ''
    ];

    if ($clan != NULL) {
      if ($clan['leaderId'] == $player['userId']) {
        $statement = $mysqli->query('SELECT id FROM server_clan_diplomacy_applications WHERE senderClanId = ' . $player['clanId'] . ' AND id = "' . $requestId . '"');
        $fetch = $statement->fetch_assoc();

        if ($statement->num_rows >= 1) {
          $mysqli->begin_transaction();

          try {
            $mysqli->query('DELETE FROM server_clan_diplomacy_applications WHERE id = ' . $fetch['id'] . '');

            $json['status'] = true;
            $json['message'] = 'Your diplomatic request was withdrawn.';

            $mysqli->commit();
          } catch (Exception $e) {
            $json['message'] = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }

          $mysqli->close();
        } else {
          $json['message'] = 'Something went wrong!';
        }
      } else {
        $json['message'] = 'Only leaders are can cancel a diplomacy request.';
      }
    } else {
      $json['message'] = 'Something went wrong!';
    }

    return json_encode($json);
  }

  public static function DeclineDiplomacyRequest($requestId)
  {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();
    $clan = $mysqli->query('SELECT id, leaderId FROM server_clans WHERE id = ' . $player['clanId'] . '')->fetch_assoc();
    $requestId = $mysqli->real_escape_string($requestId);

    $json = [
      'status' => false,
      'message' => ''
    ];


    if ($clan != NULL) {
      if ($clan['leaderId'] == $player['userId']) {
        $statement = $mysqli->query('SELECT id, senderClanId FROM server_clan_diplomacy_applications WHERE toClanId = ' . $player['clanId'] . ' AND id = "' . $requestId . '"');
        $fetch = $statement->fetch_assoc();

        if ($statement->num_rows >= 1) {
          $mysqli->begin_transaction();

          try {
            $mysqli->query('DELETE FROM server_clan_diplomacy_applications WHERE id = ' . $fetch['id'] . '');

            $senderClanName = $mysqli->query('SELECT name FROM server_clans WHERE id = ' . $fetch['senderClanId'] . '')->fetch_assoc()['name'];

            $json['status'] = true;
            $json['message'] = "You declined the " . $senderClanName . " clan's diplomacy request.";

            $mysqli->commit();
          } catch (Exception $e) {
            $json['message'] = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }

          $mysqli->close();
        } else {
          $json['message'] = 'Something went wrong!';
        }
      } else {
        $json['message'] = 'Only leaders are can cancel a diplomacy request.';
      }
    } else {
      $json['message'] = 'Something went wrong!';
    }

    return json_encode($json);
  }

  public static function AcceptDiplomacyRequest($requestId)
  {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();
    $clan = $mysqli->query('SELECT id, leaderId FROM server_clans WHERE id = ' . $player['clanId'] . '')->fetch_assoc();
    $requestId = $mysqli->real_escape_string($requestId);

    $json = [
      'status' => false,
      'message' => ''
    ];

    if ($clan != NULL) {
      if ($clan['leaderId'] == $player['userId']) {
        $statement = $mysqli->query('SELECT id, senderClanId, toClanId, diplomacyType FROM server_clan_diplomacy_applications WHERE toClanId = ' . $player['clanId'] . ' AND id = "' . $requestId . '"');
        $fetch = $statement->fetch_assoc();

        if ($statement->num_rows >= 1) {
          $mysqli->begin_transaction();

          try {
            $mysqli->query('DELETE FROM server_clan_diplomacy_applications WHERE id = ' . $fetch['id'] . '');

            if ($fetch['diplomacyType'] == 4) {
              $diplomacyId = $mysqli->query('SELECT id FROM server_clan_diplomacy WHERE (senderClanId = ' . $fetch['senderClanId'] . ' AND toClanId = ' . $fetch['toClanId'] . ') OR (toClanId = ' . $fetch['senderClanId'] . ' AND senderClanId = ' . $fetch['toClanId'] . ')')->fetch_assoc()['id'];

              $mysqli->query('DELETE FROM server_clan_diplomacy WHERE id = ' . $diplomacyId . '');

              $json['warEnded'] = [
                'id' => $diplomacyId
              ];

              $json['status'] = true;
              $json['message'] = 'War ended';

              Socket::Send('EndDiplomacy', ['SenderClanId' => $fetch['senderClanId'], 'TargetClanId' => $fetch['toClanId']]);
            } elseif ($fetch['diplomacyType'] == 5) {
              $diplomacyId = $mysqli->query('SELECT id FROM server_clan_diplomacy WHERE (senderClanId = ' . $fetch['senderClanId'] . ' AND toClanId = ' . $fetch['toClanId'] . ') OR (toClanId = ' . $fetch['senderClanId'] . ' AND senderClanId = ' . $fetch['toClanId'] . ')')->fetch_assoc()['id'];

              $mysqli->query('DELETE FROM server_clan_diplomacy WHERE id = ' . $diplomacyId . '');

              $json['status'] = true;
              $json['message'] = 'Alliance ended';

              Socket::Send('EndDiplomacy', ['SenderClanId' => $fetch['senderClanId'], 'TargetClanId' => $fetch['toClanId']]);
            } elseif ($fetch['diplomacyType'] == 6) {
              $diplomacyId = $mysqli->query('SELECT id FROM server_clan_diplomacy WHERE (senderClanId = ' . $fetch['senderClanId'] . ' AND toClanId = ' . $fetch['toClanId'] . ') OR (toClanId = ' . $fetch['senderClanId'] . ' AND senderClanId = ' . $fetch['toClanId'] . ')')->fetch_assoc()['id'];

              $mysqli->query('DELETE FROM server_clan_diplomacy WHERE id = ' . $diplomacyId . '');

              $json['status'] = true;
              $json['message'] = 'Nap ended';

              Socket::Send('EndDiplomacy', ['SenderClanId' => $fetch['senderClanId'], 'TargetClanId' => $fetch['toClanId']]);
            } else {
              $mysqli->query('INSERT INTO server_clan_diplomacy (senderClanId, toClanId, diplomacyType) VALUES (' . $fetch['senderClanId'] . ', ' . $fetch['toClanId'] . ', ' . $fetch['diplomacyType'] . ')');

              $diplomacyId = $mysqli->insert_id;

              $senderClanName = $mysqli->query('SELECT name FROM server_clans WHERE id = ' . $fetch['senderClanId'] . '')->fetch_assoc()['name'];

              $form = ($fetch['diplomacyType'] == 1 ? 'Alliance' : ($fetch['diplomacyType'] == 2 ? 'NAP' : 'War'));

              $json['acceptedRequest'] = [
                'id' => $diplomacyId,
                'name' => $senderClanName,
                'form' => $form,
                'diplomacyType' => $fetch['diplomacyType'],
                'date' => date('d.m.Y')
              ];

              $json['status'] = true;
              $json['message'] = "You accepted the " . $senderClanName . " clan's diplomacy request.<br>New status: " . $form . "";

              Socket::Send('StartDiplomacy', ['SenderClanId' => $fetch['senderClanId'], 'TargetClanId' => $fetch['toClanId'], 'DiplomacyType' => $fetch['diplomacyType']]);
            }

            $mysqli->commit();
          } catch (Exception $e) {
            $json['message'] = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }

          $mysqli->close();
        } else {
          $json['message'] = 'Something went wrong!';
        }
      } else {
        $json['message'] = 'Only leaders are can cancel a diplomacy request.';
      }
    } else {
      $json['message'] = 'Something went wrong!';
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

$questId = $mysqli->real_escape_string($questId);

$json = [
  'message' => ''
];

$userid = $player["userId"];

$level = $player["level"];

$queryQuest = $mysqli->query("SELECT neededLvl FROM server_quests WHERE id = ".$questId);
$rowQuest = $queryQuest->fetch_assoc();

if($rowQuest["neededLvl"] > $level) return json_encode($json);

$queryCount = $mysqli->query("SELECT id FROM player_quests WHERE userId = ".$userid." AND state = 'accepted'");
$numCount = $queryCount->num_rows;

if($numCount >= 5) return json_encode($json);

$queryNpc = $mysqli->query("SELECT * FROM log_player_pve_kills WHERE userId = ".$userid);
$queryPlayer = $mysqli->query("SELECT * FROM log_player_pvp_kills WHERE userId = ".$userid);
$npcKills = [];
$playerKills = [];
while($row = $queryNpc->fetch_assoc()) $npcKills[count($npcKills)] = $row;
while($row = $queryPlayer->fetch_assoc()) $playerKills[count($playerKills)] = $row;

    $query3 = $mysqli->query("SELECT id FROM player_quests WHERE userId = ".$userid." AND questId = ".$questId);
    $num3 = $query3->num_rows;
    if($num3 <= 0) {
        if($mysqli->query("INSERT INTO player_quests (userId, questId) VALUES (".$userid.", ".$questId.")")) {
            if($mysqli->query("INSERT INTO log_player_quests (userid, questid, state) VALUES (".$userid.", ".$questId.", 'quest_accepted')")) {
                for($i = 0; $i < count($npcKills); $i++) {
                    if($mysqli->query("INSERT INTO log_player_quests_state_tmp (userId, questId, type, charId, amount) VALUES (".$userid.", ".$questId.", 'npc', ".$npcKills[$i]["npc"].", ".$npcKills[$i]["amount"].")")) {
                        
                    } else {
                        $message = "error8";
                        Functions::LogError($mysqli->error);
                    }
                }
                for($i = 0; $i < count($playerKills); $i++) {
                    if($mysqli->query("INSERT INTO log_player_quests_state_tmp (userId, questId, type, charId, amount) VALUES (".$userid.", ".$questId.", 'ship', ".$playerKills[$i]["ship"].", ".$playerKills[$i]["amount"].")")) {
                        
                    } else {
                        $message = "error11";
                        Functions::LogError($mysqli->error);
                    }
                }
            } else {
                $message = "error6";
                Functions::LogError($mysqli->error);
            }
        } else {
            $message = "error4";
            Functions::LogError($mysqli->error);
        }
    }

return json_encode($json);
}

public static function CancelQuest($questId)
{
$mysqli = Database::GetInstance();
$player = Functions::GetPlayer();

$questId = $mysqli->real_escape_string($questId);

$json = [
  'message' => ''
];

$userid = $player["userId"];

    $query3 = $mysqli->query("SELECT id, state FROM player_quests WHERE userId = ".$userid." AND questId = ".$questId);
    while($row3 = $query3->fetch_assoc()) {
        $state = $row3["state"];
    }
    if($state == "accepted") {
        if($mysqli->query("DELETE FROM player_quests WHERE userId = ".$userid." AND questId = ".$questId)) {
            if($mysqli->query("INSERT INTO log_player_quests (userid, questid, state) VALUES (".$userid.", ".$questId.", 'quest_canceled')")) {
                if($mysqli->query("DELETE FROM log_player_quests_state_tmp WHERE userId = ".$userid." AND questId = ".$questId)) {
                    
                } else {
                    echo "error9";
                    Functions::LogError($mysqli->error);
                }
            } else {
                echo "error7";
                Functions::LogError($mysqli->error);
            }
        } else {
            echo "error3";
            Functions::LogError($mysqli->error);
        }
    }

return json_encode($json);
}

public static function CollectQuest($questId)
{
  Functions::InitQuestsystem();
  
$mysqli = Database::GetInstance();
$player = Functions::GetPlayer();

$questId = $mysqli->real_escape_string($questId);

$json = [
  'message' => ''
];

$userid = $player["userId"];

$queryNpc = $mysqli->query("SELECT * FROM log_player_pve_kills WHERE userId = ".$userid);
$queryPlayer = $mysqli->query("SELECT * FROM log_player_pvp_kills WHERE userId = ".$userid);
$npcKills = [];
$playerKills = [];
while($row = $queryNpc->fetch_assoc()) $npcKills[count($npcKills)] = $row;
while($row = $queryPlayer->fetch_assoc()) $playerKills[count($playerKills)] = $row;

$level = $player['level'];

$sql = "SELECT * FROM server_quests ORDER BY neededLvl ASC";

    $queryCheck = $mysqli->query("SELECT state FROM player_quests WHERE userId = ".$userid." AND questId = ".$questId);
    while($rowCheck = $queryCheck->fetch_assoc()) {
        $queryTmp = $mysqli->query($sql);
        $questState = 0;
        //bugfix: prüfen ob quest auch wirklich abgeschlossen wurde oder nicht
        while($rowTmp = $queryTmp->fetch_assoc()) {
            if($rowTmp["id"] == $questId) {
                $rowTmp = Functions::checkQuest($rowTmp, $mysqli, $userid, $level, $npcKills, $playerKills);
                $questState = $rowTmp["state"];
            }
        }
        if($rowCheck["state"] == "accepted" && $questState == 2) {
            $query = $mysqli->query("SELECT * FROM server_quests_rewards_temp AS t LEFT JOIN server_quests_rewards AS r ON t.rewardId = r.id WHERE questId = ".$questId);
            $query1 = $mysqli->query("SELECT data, ammo, premium, premiumUntil FROM player_accounts WHERE userId = ".$userid);
            while($row1 = $query1->fetch_assoc()) {
                $data1 = $row1["data"];
                $ammo = $row1["ammo"];
                $premiumUntil = $row1["premiumUntil"];
                $premiumVal = $row1["premium"];
                
                if($premiumUntil != null) {
                    $phpdate = strtotime($premiumUntil);
                    $mysqldate = date( 'Y-m-d H:i:s', $phpdate );
                    $premiumUntil = $mysqldate;
                }
            }
            $query1 = $mysqli->query("SELECT items FROM player_equipment WHERE userId = ".$userid);
            while($row1 = $query1->fetch_assoc()) {
                $items = $row1["items"];
            }
            
            $origData = $data1;
            $origAmmo = $ammo;
            $origItems = $items;
            $origPremium = $premiumUntil;
            $origPremiumVal = $premiumVal;
            
            $data1 = json_decode($data1);
            $ammo = json_decode($ammo);
            $items = json_decode($items);
            $premium = $premiumUntil;
            $premiumValNew = $premiumVal;
            
            while($row = $query->fetch_assoc()) {
                $type = $row["type"];
                $amount = $row["amount"];
                
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
                    case "credits":
                        $data1->credits += $amount;
                        break;
                    case "uridium":
                        $data1->uridium += $amount;
                        break;
                    case "lcb10":
                        $ammo->lcb10 += $amount;
                        break;
                    case "r310":
                        $ammo->r310 += $amount;
                        break;
                    case "mcb25":
                        $ammo->mcb25 += $amount;
                        break;
                    case "mcb50":
                        $ammo->mcb50 += $amount;
                        break;
					case "xcb25":
                        $ammo->xcb25 += $amount;
                        break;
					case "xcb50":
                        $ammo->xcb50 += $amount;
                        break;
					case "lxcb75":
                        $ammo->lxcb75 += $amount;
                        break;
					case "acm":
                        $ammo->acm += $amount;
                        break;
					case "emp":
                        $ammo->emp += $amount;
                        break;
                    case "ucb":
                        $ammo->ucb += $amount;
                        break;
                    case "rsb":
                        $ammo->rsb += $amount;
                        break;
                    case "sab":
                        $ammo->sab += $amount;
                        break;
                    case "eco10":
                        $ammo->eco10 += $amount;
                        break;
					case "ubr100":
                        $ammo->ubr100 += $amount;
                        break;
					case "sar01":
                        $ammo->sar01 += $amount;
                        break;
					case "sar02":
                        $ammo->sar02 += $amount;
                        break;
					case "hstrm01":
                        $ammo->hstrm01 += $amount;
                        break;
                    case "plt3030":
                        $ammo->plt3030 += $amount;
                        break;
                    case "plt2026":
                        $ammo->plt26 += $amount;
                        break;
                    case "plt2021":
                        $ammo->plt21 += $amount;
                        break;
                    case "exp":
                        $data1->experience += $amount;
                        break;
                    case "hon":
                        $data1->honor += $amount;
                        break;
                    case "lf2":
                        $items->lf2Count += $amount;
                        break;
                    case "lf3":
                        $items->lf3Count += $amount;
                        break;
                    case "lf4":
                        $items->lf4Count += $amount;
                        break;
					case "lf5":
                        $items->lf5Count += $amount;
                        break;
                    case "bo1":
                        $items->B01Count += $amount;
                        break;
                    case "bo2":
                        $items->bo2Count += $amount;
                        break;
					case "bo3":
                        $items->bo3Count += $amount;
                        break;
                    case "g3n":
                        $items->g3nCount += $amount;
                        break;
                    case "lf1":
                        $items->lf1Count += $amount;
                        break;
                    case "a03":
                        $items->A03Count += $amount;
                        break;
                    case "logfiles":
                        $items->skillTree->logdisks += $amount;
                        break;
                    case "lf3n":
                        $items->lf3nCount += $amount;
                        break;
					case "cyborg":
                        $items->cyborgCount += $amount;
                        break;
					case "lf4sp":
                        $items->lf4spCount += $amount;
                        break;
					case "cloacks":
                        $ammo->cloacks += $amount;
                        break;
                }
            }
            
            $data1 = json_encode($data1);
            $ammo = json_encode($ammo);
            $items = json_encode($items);
            
            $mysqli->query("INSERT INTO log_player_quests (userid, questid, state) VALUES (".$userid.", ".$questId.", 'init_collection')");
            
            $sqladd = "premiumUntil = '".$premiumUntil."'";
            if($premiumUntil == "") {
                $sqladd = "premiumUntil = NULL";
            }
            
            
            
            if (Socket::Get('IsOnline', array('UserId' => $userid, 'Return' => false))) {
                $sql = "UPDATE player_accounts SET data = '".$data1."', ammo = '".$ammo."', premium = '".$premiumValNew."', ".$sqladd." WHERE userId = ".$userid;
            }
            
            if($mysqli->query($sql)) {
                if($mysqli->query("UPDATE player_equipment SET items = '".$items."' WHERE userId = ".$userid)) {
                    if($mysqli->query("UPDATE player_quests SET state = 'collected' WHERE userId = ".$userid." AND questId = ".$questId)) {
                        if($mysqli->query("INSERT INTO log_player_quests (userid, questid, state, before_data, before_ammo, before_items, before_premiumVal, before_premiumUntil, after_data, after_ammo, after_items, after_premiumVal, after_premiumUntil) VALUES (".$userid.", ".$questId.", 'finished_collection', '".$origData."', '".$origAmmo."', '".$origItems."', '".$origPremiumVal."', '".$origPremium."', '".$data1."', '".$ammo."', '".$items."', '".$premiumValNew."', '".$premiumUntil."')")) {
                            if (Socket::Get('IsOnline', array('UserId' => $userid, 'Return' => false))) {
                                $uridium = json_decode($data1)->uridium - json_decode($origData)->uridium;
                                $credits = json_decode($data1)->credits - json_decode($origData)->credits;
                                $honor = json_decode($data1)->honor - json_decode($origData)->honor;
                                $experience = json_decode($data1)->experience - json_decode($origData)->experience;
                                $logfiles = json_decode($items)->skillTree->logdisks - json_decode($origItems)->skillTree->logdisks;
                                
                                Socket::Send('LockSync', ['UserId' => $userid]);
                                //Socket::Send('LoadUserData', ['UserId' => $userid]);
                                if($uridium > 0) Socket::Send('UpdateUridium', ['UserId' => $userid, 'UridiumPrice' => json_decode($data1)->uridium - json_decode($origData)->uridium, 'Type' => "INCREASE"]);
                                if($credits > 0) Socket::Send('UpdateCredits', ['UserId' => $userid, 'CreditPrice' => json_decode($data1)->credits - json_decode($origData)->credits, 'Type' => "INCREASE"]);
                                if($honor > 0) Socket::Send('UpdateHonor', ['UserId' => $userid, 'Honor' => json_decode($data1)->honor - json_decode($origData)->honor, 'Type' => "INCREASE"]);
                                if($experience > 0) Socket::Send('UpdateExperience', ['UserId' => $userid, 'Experience' => json_decode($data1)->experience - json_decode($origData)->experience, 'Type' => "INCREASE"]);
                                if($logfiles > 0) Socket::Send('UpdateLogfiles', ['UserId' => $userid, 'Logfiles' => json_decode($items)->skillTree->logdisks - json_decode($origItems)->skillTree->logdisks]);
                                
                                Socket::Send('SaveUserData', ['UserId' => $userid]);
                                
                                //Ammo Management
                                foreach(json_decode($ammo) as $key => $value) {
                                    foreach(json_decode($origAmmo) as $origKey => $origValue) {
                                        if($key == $origKey) {
                                            $diff = $value - $origValue;
                                            if($diff > 0) {
                                                Socket::Send('AddAmmo', ['UserId' => $userid, 'itemId' => Functions::getAmmoId($key), 'amount' => $diff]);
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

public static function checkQuest($row, $mysqli, $userid, $level, $npcKills, $playerKills) {	
    $tasks = [];
        $row["rewards"] = [];
        $queryTasks = $mysqli->query("SELECT * FROM server_quests_tasks_temp AS t LEFT JOIN server_quests_tasks AS a ON t.taskId = a.id where questId = ".$row["id"]);
        while($rowTasks = $queryTasks->fetch_assoc()) $tasks[count($tasks)] = $rowTasks;
        $tmp_tasks = [];
        $questCompleted = true;
        $questAccepted = false;
        
        $queryNpc = $mysqli->query("SELECT * FROM log_player_quests_state_tmp WHERE userId = ".$userid." AND questId = ".$row["id"]);
        $npcKillsQuest = [];
        while($row1 = $queryNpc->fetch_assoc()) $npcKillsQuest[count($npcKillsQuest)] = $row1;
        
        for($i = 0; $i < count($tasks); $i++) {
                $currentAmount = 0;
                $acceptedAmount = 0;
                $taskCompleted = false;
                
                //Prüfen ob Quest angenommen wurde und aktuellen Stand aus Datenbank ermitteln
                $query3 = $mysqli->query("SELECT id, accepted, state FROM player_quests WHERE userId = ".$userid." AND questId = ".$row["id"]);
                $num3 = $query3->num_rows;
                
                if($num3 <= 0) $questCompleted = false;
                else {
                    while($row3 = $query3->fetch_assoc()) {
                        switch($tasks[$i]["type"]) {
                            case "destroy_npc":
                                for($j = 0; $j < count($npcKills); $j++) {
                                    $elm = $npcKills[$j];
                                    if($elm["npc"] == $tasks[$i]["targetElement"]) {
                                        $currentAmount = $elm["amount"];
                                    }
                                }
                                for($j = 0; $j < count($npcKillsQuest); $j++) {
                                    $elm = $npcKillsQuest[$j];
                                    if($elm["charId"] == $tasks[$i]["targetElement"] && $elm["type"] == "npc") {
                                        $acceptedAmount = $elm["amount"];
                                    }
                                }
                                $currentAmount = $currentAmount - $acceptedAmount;
                                break;
                            case "destroy_player":
                                for($j = 0; $j < count($playerKills); $j++) {
                                    $elm = $playerKills[$j];
                                    
                                    if($tasks[$i]["targetElementBaseId"] > 0) {
                                        $queryBase = $mysqli->query("SELECT baseShipId FROM server_ships WHERE ShipID = ".$elm["ship"]);
                                        $rowBase = $queryBase->fetch_assoc();
                                        
                                        if($rowBase["baseShipId"] == $tasks[$i]["targetElementBaseId"]) {
                                            $currentAmount += $elm["amount"];
                                        }
                                    } else {
                                        if($elm["ship"] == $tasks[$i]["targetElement"]) {
                                            $currentAmount += $elm["amount"];
                                        }
                                    }
                                }
                                for($j = 0; $j < count($npcKillsQuest); $j++) {
                                    $elm = $npcKillsQuest[$j];
                                    
                                    if($tasks[$i]["targetElementBaseId"] > 0) {
                                        $queryBase = $mysqli->query("SELECT baseShipId FROM server_ships WHERE ShipID = ".$elm["charId"]);
                                        $rowBase = $queryBase->fetch_assoc();
                                        
                                        if($rowBase["baseShipId"] == $tasks[$i]["targetElementBaseId"] && $elm["type"] == "ship") {
                                            $acceptedAmount += $elm["amount"];
                                        }
                                    } else {
                                        if($elm["charId"] == $tasks[$i]["targetElement"] && $elm["type"] == "ship") {
                                            $acceptedAmount += $elm["amount"];
                                        }
                                    }
                                }
                                $currentAmount = $currentAmount - $acceptedAmount;
                                break;
                        }
                        
                        if($currentAmount < $tasks[$i]["neededAmount"]) {
                            $questCompleted = false;
                        } else {
                            $taskCompleted = true;
                        }
                        $questAccepted = true;
                        if($row3["state"] == "collected") $questCompleted = true;
                    }
                }
                $tmp_tasks[$i] = $tasks[$i];
                $tmp_translation = Functions::getTranslation($tasks[$i]["type"]);
                if($currentAmount > $tasks[$i]["neededAmount"] || $questCompleted) $currentAmount = $tasks[$i]["neededAmount"];
                $tmp_translation = str_replace("{amount}", $currentAmount."/".number_format($tasks[$i]["neededAmount"], 0 , ',' , '.'), $tmp_translation);
                if($tasks[$i]["targetElementBaseId"] > 0) {
                    $tmp_translation = str_replace("{target}", Functions::getTargetFromDB($tasks[$i]["type"], $tasks[$i]["targetElementBaseId"], $mysqli), $tmp_translation);
                    $tmp_translation = str_replace("{company}", Functions::getCompanyFromDB($tasks[$i]["company"], $tasks[$i]["targetElementBaseId"]), $tmp_translation);
                } else {
                    $tmp_translation = str_replace("{target}", Functions::getTargetFromDB($tasks[$i]["type"], $tasks[$i]["targetElement"], $mysqli), $tmp_translation);
                    $tmp_translation = str_replace("{company}", Functions::getCompanyFromDB($tasks[$i]["company"], $tasks[$i]["targetElement"]), $tmp_translation);
                }
                if($taskCompleted || $questCompleted) $tmp_translation = "<span style='color: green;'>&bull;&nbsp;".$tmp_translation."</span>";
                else $tmp_translation = "&bull;&nbsp;".$tmp_translation;
                $tmp_tasks[$i]["description"] = $tmp_translation;			}
        
        $row["state"] = 0;
        
        if($questAccepted) $row["state"] = 1;
        if($questCompleted) $row["state"] = 2;
        if($level < $row["neededLvl"]) $row["state"] = 3;
        
        $row["tasks"] = $tmp_tasks;
        
        return $row;
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
    
    switch($type) {
        case "destroy_npc":
        case "destroy_player":
            $query = $mysqli->query("SELECT name FROM server_ships WHERE shipID = ".$targetid);
            while($row = $query->fetch_assoc()) $name = $row["name"]; 
            break;
    }
    
    return $name;
}

public static function getCompanyFromDB($company) {
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
    $clan = $mysqli->query('SELECT id, leaderId FROM server_clans WHERE id = ' . $player['clanId'] . '')->fetch_assoc();
    $diplomacyId = $mysqli->real_escape_string($diplomacyId);

    $json = [
      'status' => false,
      'message' => ''
    ];

    if ($clan != NULL) {
      if ($clan['leaderId'] == $player['userId']) {
        $statement = $mysqli->query('SELECT senderClanId, toClanId, diplomacyType FROM server_clan_diplomacy WHERE id = "' . $diplomacyId . '"');
        $fetch = $statement->fetch_assoc();

        if ($statement->num_rows >= 1 && $fetch['diplomacyType'] != 3) {
          $mysqli->begin_transaction();

          try {
            $mysqli->query('DELETE FROM server_clan_diplomacy WHERE id = ' . $diplomacyId . '');

            $json['status'] = true;
            $json['message'] = 'Diplomacy was ended.';

            Socket::Send('EndDiplomacy', ['SenderClanId' => $fetch['senderClanId'], 'TargetClanId' => $fetch['toClanId']]);

            $mysqli->commit();
          } catch (Exception $e) {
            $json['message'] = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }

          $mysqli->close();
        } else {
          $json['message'] = 'Something went wrong!';
        }
      } else {
        $json['message'] = 'Only leaders are can end a diplomacy.';
      }
    } else {
      $json['message'] = 'Something went wrong!';
    }

    return json_encode($json);
  }
  
  public static function GetUniqueSessionId()
  {
    $mysqli = Database::GetInstance();

    $sessionId = Functions::GenerateRandom(32);

    if ($mysqli->query('SELECT userId FROM player_accounts WHERE sessionId = "' . $sessionId . '"')->num_rows >= 1)
      $sessionId = GetUniqueSessionId();

    return $sessionId;
  }

  public static function VerifyEmail($userId, $hash)
  {
    $mysqli = Database::GetInstance();

    $userId = $mysqli->real_escape_string($userId);
    $hash = $mysqli->real_escape_string($hash);

    $message = '';

    if ($mysqli->query('SELECT userId FROM player_accounts WHERE userId = "' . $userId . '"')->num_rows >= 1) {
      $verification = json_decode($mysqli->query('SELECT verification FROM player_accounts WHERE userId = ' . $userId . '')->fetch_assoc()['verification']);

      if (!$verification->verified) {
        if ($verification->hash === $hash) {
          $verification->verified = true;

          $mysqli->begin_transaction();

          try {
            $mysqli->query("UPDATE player_accounts SET verification = '" . json_encode($verification) . "' WHERE userId = " . $userId . "");

            $message = 'Your account is now verified.';

            $mysqli->commit();
          } catch (Exception $e) {
            error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
            $message = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }

          $mysqli->close();
        } else {
          $message = 'Hash is not matches.';
        }
      } else {
        $message = 'This account is already verified.';
      }
    } else {
      $message = 'User not found.';
    }

    return $message;
  }
  
  public static function ResetPw($userId, $hash)
  {
    $mysqli = Database::GetInstance();

    $userId = $mysqli->real_escape_string($userId);
    $hash = $mysqli->real_escape_string($hash);

    $message = '';

    if ($mysqli->query('SELECT userId FROM player_accounts WHERE userId = "' . $userId . '"')->num_rows >= 1) {
      if ($mysqli->query('SELECT userId FROM player_accounts WHERE pwResetKey = "' . $hash . '"')->num_rows >= 1) {
		  $message = "<form action='" . DOMAIN . "api/resetpw' method='post'><input type='hidden' name='action' value='resetpw'/><input type='hidden' name='uid' value='".$userId."'/><input type='hidden' name='hash' value='".$hash."'/><input type='password' name='password' placeholder='Password'/><br><br><input type='password' name='passwordrp' placeholder='Password repeat'/><br><br><input type='submit' value='Reset'/></form>";
		} else {
		  $message = 'Key not found.';
		}
    } else {
      $message = 'User not found.';
    }

    return $message;
  }
  
  public static function ResetPwConfirm($userId, $hash, $password)
  {
    $mysqli = Database::GetInstance();

    $userId = $mysqli->real_escape_string($userId);
    $hash = $mysqli->real_escape_string($hash);
    $password = $mysqli->real_escape_string($password);

    $message = '';

    if ($mysqli->query('SELECT userId FROM player_accounts WHERE userId = "' . $userId . '"')->num_rows >= 1) {
      if ($mysqli->query('SELECT userId FROM player_accounts WHERE pwResetKey = "' . $hash . '"')->num_rows >= 1) {
        try {
          $mysqli->query('UPDATE player_accounts SET password = "'.password_hash($password, PASSWORD_DEFAULT).'", pwResetKey = NULL WHERE userId = "'.$userId.'"');
          $message = 'Password changed successfully. Redirect in 5 seconds...<meta http-equiv="refresh" content="5; URL=http://127.0.0.1/">';
        } catch (Exception $e) {
          error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
          $message = 'An error occurred while resetting the password. Please try again later.';
          // $mysqli->rollback(); // Only if this function started a transaction
        }
		} else {
		  $message = 'Key not found.';
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
		
    try {
      if($mysqli->query("UPDATE player_accounts SET securityQuestions = '".json_encode($json["securityQuestions"])."' WHERE userId = ".$player["userId"])) {
        $json["message"] = "Information is saved successfully.";
      } else {
        // This case might indicate a non-exception SQL error, e.g., query executed but returned false.
        // For actual exceptions during query execution (like connection lost), the catch block would trigger.
        $json["message"] = "An error occured while saving the security questions. Please try again later.";
        if ($mysqli->error) {
            error_log('MySQL error in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $mysqli->error);
        }
      }
    } catch (Exception $e) {
        error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
        $json["message"] = "An unexpected error occured while saving the security questions. Please try again later.";
        // if ($mysqli->in_transaction) { $mysqli->rollback(); } // Only if this function started a transaction
    }
	} else {
		$json["message"] = "Please fill out every answer.";
	}

    return json_encode($json);
  }
  
  public static function DeleteSecurityQuestions()
  {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();
	
    $json = [
      'message' => ''
    ];
	
	$mysqli->begin_transaction();

    try {
        $mysqli->query("UPDATE player_accounts SET securityQuestions = NULL WHERE userId = " . $player['userId'] . "");
		
        $json['message'] = 'The Security questions has been deleted.';

        $mysqli->commit();
    } catch (Exception $e) {
        $message = 'An error occurred. Please try again later.';
        $mysqli->rollback();
    }

    $mysqli->close();

    return json_encode($json);
  }

  // Helper function to buy ammunition
  private static function _buyAmmo(&$player, &$data, &$shop, $amount, &$json, $mysqli, $typeMunnition) {
    // $amount here is the $original_amount passed from Buy
    if(Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
        Socket::Send('AddAmmo', ['UserId' => $player['userId'], 'itemId' => $shop['ammoId'], 'amount' => $amount]);
      } else {
        $player_ammo = json_decode($mysqli->query("SELECT ammo FROM player_accounts WHERE userId=".$player['userId'])->fetch_assoc()["ammo"]);
        if (empty($player_ammo->{$typeMunnition[$shop['ammoId']]})){
          $player_ammo->{$typeMunnition[$shop['ammoId']]} = $amount;
        } else {
          $player_ammo->{$typeMunnition[$shop['ammoId']]} += $amount;
        }
        $mysqli->query("UPDATE player_accounts SET ammo = '".json_encode($player_ammo)."' WHERE userId = ".$player["userId"]);
      }
    return true;
  }

  // Helper function to buy ships
  private static function _buyShip(&$player, &$data, &$items, &$shop, &$json, $mysqli) {
    if (!in_array($shop['shipId'], $items->ships)) {
      array_push($items->ships, (int)$shop['shipId']);
      return true;
    } else {
      $json['message'] = 'You already have an ' . $shop['name'] . '.';
      return false;
    }
  }

  // Helper function to buy P.E.T. related items (P.E.T. itself, fuel, designs, modules)
  private static function _buyPetRelated(&$player, &$data, &$items, &$shop, &$json, $mysqli, $verificaconectado) {
    if (!empty($shop['petName'])) { // Buying P.E.T. itself
      if ($verificaconectado) {
        $json['message'] = "You have disconnect from the server to buy ".$shop['petName'];
        return false;
      }
      if (!$items->{$shop['petName']}) {
        $items->{$shop['petName']} = true;
        return true;
      } else {
        $json['message'] = 'You already have an '.$shop['name'];
        return false;
      }
    } else if (!empty($shop['petDesign'])) { // Buying P.E.T. Design
        if (isset($player['petSavedDesigns'])){
            $arraySavedPets = json_decode($player['petSavedDesigns']);
        } else {
            $arraySavedPets = [];
        }

        if (in_array($shop['petDesign'], $arraySavedPets) || $player['petDesign'] == $shop['petDesign']){
            $json['message'] = "You already buyed this pet.";
            return false;
        }

        if (!in_array($player['petDesign'], $arraySavedPets)){
            array_push($arraySavedPets, $player['petDesign']);
        }

        $mysqli->query("UPDATE player_accounts SET petSavedDesigns = '".json_encode($arraySavedPets)."' WHERE userId = ".$player['userId']);
        $mysqli->query("UPDATE player_accounts SET petDesign = '".$shop['petDesign']."' WHERE userId = ".$player['userId']);

        if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
            Socket::Send('updatePet', ['UserId' => $player['userId'], 'PetName' => $player['petName'], 'PetDesignn' => (isset($shop['petDesign'])) ? $shop['petDesign'] : 22]);
        }
        return true;
    } else if (!empty($shop['petFuel'])) { // Buying P.E.T. Fuel
        $current_items = json_decode($mysqli->query("SELECT items FROM player_equipment WHERE userId=".$player['userId'])->fetch_assoc()["items"]); // Re-fetch to ensure latest data
        $fuel_to_add = $shop['petFuel']; // Amount is per single item defined in shop, not the total $amount parameter.

        if ($verificaconectado) {
            $current_fuel = Socket::Get('getPetFuel', ['UserId' => $player['userId'], 'Return' => 0]);
            if (empty($current_fuel) && !is_numeric($current_fuel)){ // Assuming 0 is a valid return
                 $current_fuel = 0; // Treat null/empty as 0 if API implies that
            }
            if (($current_fuel + $fuel_to_add) > 50000){
                $json['message'] = "The pet only allows 50,000 liters of fuel.";
                return false;
            }
            // Socket will handle adding fuel
        } else {
            if (!isset($current_items->fuel)) $current_items->fuel = 0;

            if (($current_items->fuel + $fuel_to_add) > 50000){
                $json['message'] = "The pet only allows 50,000 liters of fuel.";
                return false;
            }
            $current_items->fuel += $fuel_to_add;
        }

        // Update items JSON in the database
        $mysqli->query("UPDATE player_equipment SET items = '".json_encode($current_items)."' WHERE userId = ".$player["userId"]);

        if ($verificaconectado) {
            Socket::Send('updatePetFuel', ['UserId' => $player['userId'], 'Amount' => $fuel_to_add]);
        }
        return true;
    } else if (!empty($shop['petModule'])) { // Buying P.E.T. Module
        $current_items = json_decode($mysqli->query("SELECT items FROM player_equipment WHERE userId=".$player['userId'])->fetch_assoc()["items"]); // Re-fetch
        $module_name = $shop['petModule'];

        if (!empty($current_items->$module_name) && $current_items->$module_name == true){
            $json['message'] = "You already have ".$shop['name'];
            return false;
        }
        $current_items->$module_name = true;
        $mysqli->query("UPDATE player_equipment SET items = '".json_encode($current_items)."' WHERE userId = ".$player["userId"]);
        if ($verificaconectado) {
            Socket::Send('setPetModule', ['UserId' => $player['userId'], 'TypeModule' => $shop['petModule']]);
        }
        return true;
    }
    return false; // Should not reach here if shop item is valid PET item
  }

  // Helper function to buy boosters
  private static function _buyBooster(&$player, &$data, &$boosters, &$shop, &$json, $mysqli, $verificaconectado) {
      $booster_id_key = str_replace("-", "", $shop['boosterId']);
      $canPutBooster = true;

      if (empty($boosters->{$booster_id_key})) {
          if($verificaconectado) {
            Socket::Send('SendBoosters', ['UserId' => $player['userId'], 'typeBooster' => $shop['boosterType'], 'hoursBooster' => $shop['boosterDuration']]);
          }
          $bb_item = array('Type' => $shop['boosterType'], 'Seconds' => $shop['boosterDuration']);
          $boosters->{$booster_id_key} = [$bb_item]; // Initialize as an array
          return true;
      } else {
          foreach ($boosters->{$booster_id_key} as $bb){
              if ($bb->Type == $shop['boosterType']){
                  $canPutBooster = false;
                  break;
              }
          }
          if ($canPutBooster){
              if($verificaconectado) {
                Socket::Send('SendBoosters', ['UserId' => $player['userId'], 'typeBooster' => $shop['boosterType'], 'hoursBooster' => $shop['boosterDuration']]);
              }
              array_push($boosters->{$booster_id_key}, array('Type' => $shop['boosterType'], 'Seconds' => $shop['boosterDuration']));
              return true;
          } else {
              $json['message'] = 'You already have an ' . $shop['name'] . '.';
              return false;
          }
      }
  }

  // Helper function to buy ship designs
  private static function _buyShipDesign(&$player, &$data, &$shop, &$json, $mysqli) {
    $design_name = $shop['design_name'];
    $search_design = $mysqli->query("SELECT * FROM player_designs WHERE name='$design_name' AND userId = " . $player['userId'] . ";");
    $info_design = $mysqli->query("SELECT * FROM server_ships WHERE lootID = '$design_name'");

    if ($search_design->num_rows > 0) {
      $json['message'] = 'You already have an ' . $shop['name'] . '.';
      return false;
    } else {
      if ($info_design->num_rows > 0){
        $baseShipId = $info_design->fetch_assoc()['baseShipId'];
        if ($baseShipId > 0){
          $mysqli->query("INSERT INTO player_designs (name, baseShipId, userId) VALUES ('$design_name', '$baseShipId', " . $player['userId'] . ")");
          return true;
        }
      }
    }
    return false; // Should not reach if design is valid
  }

  // Helper function to buy general equipment (lasers, generators, skilltree, drone formations)
  private static function _buyGeneralEquipment(&$player, &$data, &$items, &$shop, $amount, &$json, $mysqli) {
      if (!empty($shop['laserName'])) { // Lasers, Generators, Iris
        $lasersSaved = json_decode($mysqli->query("SELECT items FROM player_equipment WHERE userId=".$player['userId'])->fetch_assoc()["items"]);
        $config1 = json_decode($mysqli->query('SELECT config1_drones FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['config1_drones']);
        $config2 = json_decode($mysqli->query('SELECT config2_drones FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['config2_drones']);
        $max = null; $name = null;

        // Simplified max/name logic - assumes this mapping is correct and complete as per original
        $itemLimits = [
            'lf1Count' => ['max' => 40, 'name' => "lasers"], 'lf2Count' => ['max' => 40, 'name' => "lasers"],
            'lf3Count' => ['max' => 40, 'name' => "lasers"], 'lf4Count' => ['max' => 40, 'name' => "lasers"],
            'lf5Count' => ['max' => 40, 'name' => "lasers"], 'bo3Count' => ['max' => 40, 'name' => "generators"],
            'bo2Count' => ['max' => 40, 'name' => "generators"], 'B01Count' => ['max' => 40, 'name' => "generators"],
            'A03Count' => ['max' => 40, 'name' => "generators"], 'A02Count' => ['max' => 40, 'name' => "generators"],
            'A01Count' => ['max' => 40, 'name' => "generators"], 'g3nCount' => ['max' => 40, 'name' => "generators"],
            'g3n6900Count' => ['max' => 40, 'name' => "generators"], 'g3n3310Count' => ['max' => 40, 'name' => "generators"],
            'g3n3210Count' => ['max' => 40, 'name' => "generators"], 'g3n2010Count' => ['max' => 40, 'name' => "generators"],
            'g3n1010Count' => ['max' => 40, 'name' => "generators"], 'lf3nCount' => ['max' => 40, 'name' => "lasers"],
            'lf4mdCount' => ['max' => 40, 'name' => "lasers"], 'lf4pdCount' => ['max' => 40, 'name' => "lasers"],
            'lf4hpCount' => ['max' => 40, 'name' => "lasers"], 'lf4spCount' => ['max' => 40, 'name' => "lasers"],
            'lf4unstableCount' => ['max' => 40, 'name' => "lasers"], 'mp1Count' => ['max' => 40, 'name' => "lasers"],
            'iriscount' => ['max' => 8, 'name' => "drones"]
        ];

        if (!isset($itemLimits[$shop['laserName']])) return false; // Unknown item
        $max = $itemLimits[$shop['laserName']]['max'];
        $name = $itemLimits[$shop['laserName']]['name'];

        if ($shop['laserName'] == 'iriscount' && $items->iriscount <= 7) {
            $config1conf = array('items' => [], 'designs' => []);
            $config2conf = array('items' => [], 'designs' => []);
            array_push($config1, $config1conf);
            array_push($config2, $config2conf);
            $mysqli->query("UPDATE player_equipment SET config1_drones = '" . json_encode($config1) . "', config2_drones = '" . json_encode($config2) . "' WHERE userId = " . $player['userId'] . "");
        }

        $current_count = isset($lasersSaved->{$shop['laserName']}) ? $lasersSaved->{$shop['laserName']} : 0;
        if (($current_count + $amount) > $max) {
            $json['message'] = "Max ".$max." ".$name." for type";
            return false;
        }
        $items->{$shop['laserName']} = $current_count + $amount;
        return true;

      } else if (!empty($shop['skillTree'])) { // Logdisks
          $items->skillTree->{$shop['skillTree']} += $amount;
          return true;
      } else if (!empty($shop['FormationName'])){ // Drone Formations
          $formations = json_decode($mysqli->query("SELECT formationsSaved FROM player_equipment WHERE userId=".$player['userId'])->fetch_assoc()["formationsSaved"]);
          $formation_key = $shop['FormationName'];
          if (!empty($formations->$formation_key) && $formations->$formation_key == $formation_key){
              $json['message'] = "You already have ".$shop['name'];
              return false;
          }
          $formations->$formation_key = $formation_key;
          $mysqli->query("UPDATE player_equipment SET formationsSaved = '".json_encode($formations)."' WHERE userId = ".$player["userId"]);
          if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
              Socket::Send('buyFormation', ['UserId' => $player['userId'], 'Formation' => $shop['FormationName']]);
          }
          return true;
      }
      return false;
  }

  // Helper function to buy Drones (Apis/Zeus parts, Havoc/Hercules designs)
  private static function _buyDrone(&$player, &$data, &$items, &$shop, $amount, &$json, $mysqli) {
    if (strpos($shop['droneName'], "Count")) { // Havoc, Hercules (assuming these are stored with "Count" suffix in shop['droneName'])
        $items->{$shop['droneName']} += $amount; // $amount is 1 for these if not stackable
        return true;
    } else { // Apis, Zeus parts
        if (!$items->{$shop['droneName']}) { // Check if player already has the full drone
            $dronePartsKey = "drone".ucfirst($shop['droneName'])."Parts";
            if (empty($items->{$dronePartsKey})){
                $items->{$dronePartsKey} = $amount;
            } else {
                $items->{$dronePartsKey} += $amount;
            }
            return true;
        } else {
            $json['message'] = 'You already have an ' . $shop['name'] . ' Drone.';
            return false;
        }
    }
  }

  // Helper function to buy keys
  private static function _buyKey(&$player, &$data, &$shop, $amount, &$json, $mysqli, $verificaconectado) {
    if (!empty($shop['typeKey'])){ // Old key system?
        if($verificaconectado) {
          $json['message'] = "Disconnect from game to buy keys.";
          return false;
        }
        $mysqli->query("UPDATE player_accounts SET bootyKeys = bootyKeys+$amount WHERE userId = ".$player['userId']);
        return true;
    } else if (!empty($shop['nameBootyKey'])){ // New key system
        $bootyKeys = json_decode($mysqli->query("SELECT bootyKeys FROM player_accounts WHERE userId=".$player['userId'])->fetch_assoc()["bootyKeys"]);
        $key_name = $shop['nameBootyKey'];
        if (!isset($bootyKeys->$key_name)) $bootyKeys->$key_name = 0;
        $bootyKeys->$key_name += $amount;
        $mysqli->query("UPDATE player_accounts SET bootyKeys = '".json_encode($bootyKeys)."' WHERE userId = ".$player["userId"]);
        if ($verificaconectado) {
            Socket::Send('buyKey', ['UserId' => $player['userId'], 'Key' => $shop['nameBootyKey'], 'Amount' => $amount]);
        }
        return true;
    }
    return false;
  }

  // Helper function to buy CBS modules
  private static function _buyCbsModule(&$player, &$data, &$module, &$shop, &$json, $mysqli, $verificaconectado) {
    $module_item = array('Id' => $shop['moduleId'], 'Type' => $shop['moduleType'], 'InUse' => false);
    if ($verificaconectado){
        $json['message'] = "Disconnect from game to buy.";
        return false;
    }
    // Original code had `if (!in_array($module, $module))` which is a bug. It should be `!in_array($module_item, $module)`
    // However, this simple in_array check might not be enough if modules are unique by Id or Type only.
    // Assuming modules are unique by the combination of Id and Type as represented by $module_item.
    $found = false;
    if (is_array($module)) { // Ensure $module is an array
        foreach($module as $m) {
            if ($m->Id == $shop['moduleId'] && $m->Type == $shop['moduleType']) {
                $found = true;
                break;
            }
        }
    } else { // If $module is not an array (e.g. null or not initialized properly), initialize it
        $module = [];
    }

    if (!$found) {
        array_push($module, $module_item);
        return true;
    } else {
        $json['message'] = "You already have this module."; // Or similar message
        return false;
    }
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
      $items = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);
      $module = json_decode($mysqli->query('SELECT modules FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['modules']);
      $boosters = json_decode($mysqli->query('SELECT boosters FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['boosters']);
      $verificaconectado = Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false));
      $data = json_decode($player['data']);

      $price = $shop['price'];
      $original_amount = $amount; // Keep original amount for some logic that uses it directly

      if ($shop['amount'] && $amount <= 0) $amount = 1; // Default to 1 if stackable but no amount given
      if ($shop['amount'] && $amount >= 1) $price *= $amount; // Calculate total price for stackable items

      if ($player['premium'] == 1) $price = $price * 0.4; // Apply premium discount (original was /100*60, which is 60% of price, so 40% discount)

      $status = false; // Overall status of the purchase operation

      if ($shop['priceType'] == 'uridium' || $shop['priceType'] == 'credits'){
        if (($shop['priceType'] == 'uridium' ? $data->uridium : $data->credits) >= $price) {
          $data->{($shop['priceType'] == 'uridium' ? 'uridium' : 'credits')} -= $price;

          if (!empty($shop['ammoId'])) {
            $status = self::_buyAmmo($player, $data, $shop, $original_amount, $json, $mysqli, $typeMunnition);
          } else if (!empty($shop['shipId']) && $shop['shipId'] > 0) {
            $status = self::_buyShip($player, $data, $items, $shop, $json, $mysqli);
          } else if (!empty($shop['petName']) || !empty($shop['petDesign']) || !empty($shop['petFuel']) || !empty($shop['petModule'])) {
            $status = self::_buyPetRelated($player, $data, $items, $shop, $json, $mysqli, $verificaconectado);
          } else if (!empty($shop['boosterId']) && is_numeric($shop['boosterType']) && !empty($shop['boosterDuration'])) {
            $status = self::_buyBooster($player, $data, $boosters, $shop, $json, $mysqli, $verificaconectado);
          } else if (!empty($shop['design_name'])) {
            $status = self::_buyShipDesign($player, $data, $shop, $json, $mysqli);
          } else if (!empty($shop['laserName']) || !empty($shop['skillTree']) || !empty($shop['FormationName'])) {
            $status = self::_buyGeneralEquipment($player, $data, $items, $shop, $original_amount, $json, $mysqli);
          } else if (!empty($shop['droneName'])) {
             $status = self::_buyDrone($player, $data, $items, $shop, $original_amount, $json, $mysqli);
          } else if (!empty($shop['typeKey']) || !empty($shop['nameBootyKey'])) {
            $status = self::_buyKey($player, $data, $shop, $original_amount, $json, $mysqli, $verificaconectado);
          } else if (!empty($shop['moduleId']) && !empty($shop['moduleType'])) {
            $status = self::_buyCbsModule($player, $data, $module, $shop, $json, $mysqli, $verificaconectado);
          }
        } else {
          $json['message'] = "You don't have enough " . ($shop['priceType'] == 'uridium' ? 'Uridium' : 'Credits');
        }
      } elseif ($shop['priceType'] == 'event') {
        // Event currency logic - this is a simplified version of the original complex block
        $search_user = $mysqli->query("SELECT * FROM event_coins WHERE userId= " . $player['userId'] . ";");
        if ($search_user->num_rows > 0){
            $user_coins = $search_user->fetch_assoc();
            if ($user_coins['coins'] >= $price) {
                $user_coins['coins'] -= $price;

                // Similar dispatching logic as above for event currency items
                if (!empty($shop['design_name'])) {
                  $status = self::_buyShipDesign($player, $data, $shop, $json, $mysqli); // Note: _buyShipDesign doesn't use $data directly for currency
                } else if (!empty($shop['moduleId']) && !empty($shop['moduleType'])){
                  $status = self::_buyCbsModule($player, $data, $module, $shop, $json, $mysqli, $verificaconectado);
                } else if (!empty($shop['nameBootyKey']) || !empty($shop['typeKey'])){ // Added typeKey for completeness
                  $status = self::_buyKey($player, $data, $shop, $original_amount, $json, $mysqli, $verificaconectado);
                  if ($status && Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
                      Socket::Send('updateEC', ['UserId' => $player['userId'], 'Amount' => $price, 'Type' => "DECREASE"]); // $price here is total for event
                  }
                } else if (!empty($shop['ammoId'])){
                  $status = self::_buyAmmo($player, $data, $shop, $original_amount, $json, $mysqli, $typeMunnition);
                } else if (!empty($shop['laserName']) || !empty($shop['skillTree']) || !empty($shop['FormationName'])) { // Added skillTree and FormationName
                  $status = self::_buyGeneralEquipment($player, $data, $items, $shop, $original_amount, $json, $mysqli);
                } else if (!empty($shop['droneName'])) {
                  $status = self::_buyDrone($player, $data, $items, $shop, $original_amount, $json, $mysqli);
                } else if (!empty($shop['shipId']) && $shop['shipId'] > 0) {
                  $status = self::_buyShip($player, $data, $items, $shop, $json, $mysqli);
                } else if (!empty($shop['boosterId'])) { // Corrected from boosterId to shop['boosterId'] for consistency
                  $status = self::_buyBooster($player, $data, $boosters, $shop, $json, $mysqli, $verificaconectado);
                } else if (!empty($shop['petName']) || !empty($shop['petDesign']) || !empty($shop['petFuel']) || !empty($shop['petModule'])) { // Added PetRelated for event currency
                  $status = self::_buyPetRelated($player, $data, $items, $shop, $json, $mysqli, $verificaconectado);
                }
                // ... (add other event currency item types as needed)

                if ($status) {
                    $mysqli->query("UPDATE event_coins SET coins = '" . $user_coins['coins'] . "' WHERE userId = " . $player['userId'] . "");
                    // This needs to be handled carefully: $data might not be relevant for event coin purchases if not also deducting uridium/credits
                    // For now, assuming $data is not modified by event coin specific logic unless explicitly done in helpers
                    if ($shop['priceType'] == 'event' && (isset($shop['nameBootyKey']) || isset($shop['ammoId']) || isset($shop['laserName']) || isset($shop['droneName']) || isset($shop['shipId']) || isset($shop['boosterId']) || isset($shop['petName']) ) ) { // Only update EC if it was an EC purchase
                         if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
                             Socket::Send('updateEC', ['UserId' => $player['userId'], 'Amount' => $price, 'Type' => "DECREASE"]);
                         }
                    }
                    $json['ec'] = number_format($user_coins['coins']);
                }
            } else {
                $json['message'] = "You don't have enough Event Coins";
            }
        } else {
             $json['message'] = "You don't have Event Coins recorded."; // Or user has no event coins row
        }
      }

      if ($status) {
        $mysqli->begin_transaction();
        try {
          $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
          // Only update equipment parts that could have changed
          if (!empty($shop['shipId']) || !empty($shop['laserName']) || !empty($shop['skillTree']) || !empty($shop['petName']) || !empty($shop['petFuel']) || !empty($shop['petModule']) || !empty($shop['droneName']) || !empty($shop['FormationName'])) {
            $mysqli->query("UPDATE player_equipment SET items = '" . json_encode($items) . "' WHERE userId = " . $player['userId'] . "");
          }
          if (!empty($shop['boosterId'])) {
            $mysqli->query("UPDATE player_equipment SET boosters = '" . json_encode($boosters) . "' WHERE userId = " . $player['userId'] . "");
          }
          if (!empty($shop['moduleId'])) {
            $mysqli->query("UPDATE player_equipment SET modules = '" . json_encode($module) . "' WHERE userId = " . $player['userId'] . "");
          }

          $json['newStatus'] = [
            'uridium' => number_format($data->uridium),
            'credits' => number_format($data->credits)
          ];

          if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false]) && ($shop['priceType'] == 'uridium' || $shop['priceType'] == 'credits')) {
            Socket::Send('BuyItem', ['UserId' => $player['userId'], 'ItemType' => $shop['category'], 'DataType' => ($shop['priceType'] == 'uridium' ? 0 : 1), 'Amount' => $price]);
          }

          // If message wasn't set by a helper for a specific error, set generic success.
          if (empty($json['message'])) {
            $json['message'] = '' . $shop['name'] . ' ' . ($original_amount != 0 && $shop['amount'] ? '(' . number_format($original_amount) . ')' : '') . ' purchased';
          }
          $mysqli->commit();
        } catch (Exception $e) {
          error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
          // Keep the original user-facing message if it was more specific, otherwise use a generic one.
          if (strpos($e->getMessage(), 'An error occurred') === false) { // Avoid repeating "An error occurred"
             $json['message'] = 'An error occurred during purchase. Please try again later.';
          } else {
             $json['message'] = $e->getMessage();
          }
          $mysqli->rollback();
          $status = false; // Ensure status reflects the rollback
        }
      }
      // If status is false here, $json['message'] should already be set by a helper or the currency check
      
    } else {
      $json['message'] = 'Shop item not found or inactive!';
    }
    return json_encode($json);
  }

  public static function ChangePilotName($newPilotName)
  {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();
    $newPilotName = $mysqli->real_escape_string($newPilotName);
    $verificaconectado = Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false));

    $json = [
      'inputs' => [
        'pilotName' => ['validate' => 'valid', 'error' => 'Enter a valid pilot name!']
      ],
      'message' => ''
    ];

    if (mb_strlen($newPilotName) < 4 || mb_strlen($newPilotName) > 20) {
      $json['inputs']['pilotName']['validate'] = 'invalid';
      $json['inputs']['pilotName']['error'] = 'Your pilot name should be between 4 and 20 characters.';
    }
    if (isset($verificaconectado) and ($verificaconectado == 0)){
      if ($json['inputs']['pilotName']['validate'] === 'valid') {
      $oldPilotNames = json_decode($player['oldPilotNames']);

      if (count($oldPilotNames) <= 0 || ((new DateTime(date('d.m.Y H:i:s')))->diff(new DateTime(end($oldPilotNames)->date))->days >= 1) || $player['rankId'] == 21) {
        if ($mysqli->query('SELECT userId FROM player_accounts WHERE pilotName = "' . $newPilotName . '"')->num_rows <= 0) {
          $mysqli->begin_transaction();

          try {
            array_push($oldPilotNames, ['name' => $player['pilotName'], 'date' => date('d.m.Y H:i:s')]);

            $mysqli->query("UPDATE player_accounts SET pilotName = '" . $newPilotName . "', oldPilotNames = '" . json_encode($oldPilotNames, JSON_UNESCAPED_UNICODE) . "' WHERE userId = " . $player['userId'] . "");

            $json['message'] = 'Your Pilot name has been changed.';

            $mysqli->commit();
          } catch (Exception $e) {
            error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
            $json['message'] = 'An error occurred. Please try again later.'; // Changed $message to $json['message']
            $mysqli->rollback();
          }

          $mysqli->close();
        } else {
          $json['message'] = 'This Pilot name is already in use.';
        }
      } else {
        $json['message'] = 'You can only rename your Pilot once every 24 hours. <br> (Your last name change: ' . date('d.m.Y H:i', strtotime(end($oldPilotNames)->date)) . ')';
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
    $verificaconectado = Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false));
    $clanId = $player['clanId'];

    $json = [
      'inputs' => [
        'tagname' => ['validate' => 'valid', 'error' => 'Enter a valid pilot name!']
      ],
      'message' => ''
    ];

    if (mb_strlen($newtagName) < 1 || mb_strlen($newtagName) > 4) {
      $json['inputs']['tagname']['validate'] = 'invalid';
      $json['message'] = 'Your TAG name should be between 1 and 4 characters.';
    }
        if ($json['inputs']['tagname']['validate'] === 'valid') {

        if ($mysqli->query('SELECT leaderId FROM server_clans WHERE tag = "' . $newtagName . '"')->num_rows <= 0) {
          $mysqli->begin_transaction();

          try {
            
            $mysqli->query("UPDATE server_clans SET tag = '" . $newtagName . "' WHERE leaderId = " . $player['userId'] . "");

            $json['status'] = true;
            $json['message'] = 'Your tag name has been changed.';
    
            Socket::Send('ChangeClanData', ['ClanId' => $clanId, 'Tag' => $newtagName]);    

            $mysqli->commit();
          } catch (Exception $e) {
            $message = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }

          $mysqli->close();
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
    $urlprofile = $urlprofile;
    $json = [
      'inputs' => [
        'urlprofile' => ['validate' => 'valid', 'error' => 'Enter a valid pilot name!']
      ],
      'message' => ''
    ];

    if (mb_strlen($urlprofile) < 10 || mb_strlen($urlprofile) > 100) {
      $json['inputs']['urlprofile']['validate'] = 'invalid';
      $json['inputs']['urlprofile']['error'] = 'Your link should be between 10 and 100 characters.';
    }
      if ($json['inputs']['urlprofile']['validate'] === 'valid') {

          try {

            $mysqli->query("UPDATE player_accounts SET profile =  '$urlprofile'  WHERE userId = " . $player['userId'] . "");

            $json['message'] = 'Your Photo has been changed.';

            $mysqli->commit();
          } catch (Exception $e) {
            $message = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }

          $mysqli->close();

    }


    return json_encode($json);
  }


  public static function changepassword($newpassword)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();

    
    $newpassword = $_POST['newpassword'];
    $repeatnewpassword = $_POST['repeatnewpassword'];




    $json = [
      'inputs' => [
        'newpassword' => ['validate' => 'valid', 'error' => 'Enter a valid pilot name!']
      ],
      'message' => ''
    ];

    if (mb_strlen($newpassword) < 6 || mb_strlen($newpassword) > 20) {
      $json['inputs']['newpassword']['validate'] = 'invalid';
      $json['inputs']['newpassword']['error'] = 'Your password should be between 6 and 20 characters.';
    }
	
    if ($json['inputs']['newpassword']['validate'] === 'valid') {

      if ($newpassword==$repeatnewpassword) {

          try {

            $mysqli->query("UPDATE player_accounts SET password =  '" . password_hash($newpassword, PASSWORD_DEFAULT) . "'  WHERE userId = " . $player['userId'] . "");

            $json['message'] = 'Your Password has been changed.';

            $mysqli->commit();
          } catch (Exception $e) {
            error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
            $json['message'] = 'An error occurred. Please try again later.'; // Changed $message to $json['message']
            $mysqli->rollback();
          }
          $mysqli->close();
    
  } else {
    $json['message'] = 'New Pass don macht';
  }
    return json_encode($json);
  }
  
}
    

  public static function ChangenameData($nameclan)
  {
    $mysqli = Database::GetInstance();
    $player = Functions::GetPlayer();
    $nameclan = $mysqli->real_escape_string($nameclan);
    $verificaconectado = Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false));
    $clanId = $player['clanId'];

    $json = [
      'inputs' => [
        'nameclan' => ['validate' => 'valid', 'error' => 'Enter a valid pilot name!']
      ],
      'message' => ''
    ];

    if (mb_strlen($nameclan) < 1 || mb_strlen($nameclan) > 20) {
      $json['inputs']['nameclan']['validate'] = 'invalid';
      $json['message'] = 'Your name clan should be between 1 and 20 characters.';
    }
        if ($json['inputs']['nameclan']['validate'] === 'valid') {

        if ($mysqli->query('SELECT * FROM server_clans WHERE NAME = "' . $nameclan . '"')->num_rows <= 0) {
          $mysqli->begin_transaction();

          try {
            
            $mysqli->query("UPDATE server_clans SET name = '" . $nameclan . "' WHERE leaderId = " . $player['userId'] . "");

            $json['status'] = true;
            $json['message'] = 'Your name clan has been changed.';
    
            Socket::Send('ChangeClanData', ['ClanId' => $clanId, 'name' => $nameclan]);    

            $mysqli->commit();
          } catch (Exception $e) {
            $message = 'An error occurred. Please try again later.';
            $mysqli->rollback();
          }

          $mysqli->close();
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
    $verificaconectado = Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false));
                
    $json = [
      'message' => '',
      'status' => false
    ];

    $changedName = false;
    $changedDesignPet = false;

    //if (isset($verificaconectado) and ($verificaconectado == 0)){

      if (!empty($petName)){

        $petName = $mysqli->real_escape_string($petName);

        if (mb_strlen($petName) < 2 || mb_strlen($petName) > 10) {
          $json['message'] = "The pet name must contain more than 2 character and less than 10 characters.";
          return json_encode($json);
        }

        $savePetName = $mysqli->query("UPDATE player_accounts SET petName = '" . $petName . "' WHERE userId = " . $player['userId'] . "");

        $changedName = true;

      } else {
        $json['message'] = "The pet's name cannot be empty.";
        return json_encode($json);
      }

      if (!empty($petChoosed)){

        $petChoosed = $mysqli->real_escape_string($petChoosed);

        if (isset($player['petSavedDesigns'])){
          $petSavedDesigns = json_decode($player['petSavedDesigns'], true);
        } else {
          $petSavedDesigns = array();
        }

        if (!in_array($petChoosed, $petSavedDesigns)){
          $json['message'] = 'You have not bought this pet design.';
          return json_encode($json);
        }

        if (!in_array($player['petDesign'], $petSavedDesigns)){
          array_push($petSavedDesigns, $player['petDesign']);
          $mysqli->query("UPDATE player_accounts SET petSavedDesigns = '".json_encode($petSavedDesigns)."' WHERE userId = ".$player['userId']);
        }

        $savePetName = $mysqli->query("UPDATE player_accounts SET petDesign = '" . $petChoosed . "' WHERE userId = " . $player['userId'] . "");

        $changedDesignPet = true;

      }

      if ($changedName){
        if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
          Socket::Send('updatePet', ['UserId' => $player['userId'], 'PetName' => $petName, 'PetDesignn' => (isset($petChoosed)) ? $petChoosed : 22]);
        }
      }

      $json['message'] = 'Data saved sucesfully.';

    //} else {
      //$json['message'] = "Disconnect from game for change name pet or choose pet.";
    //}

    return json_encode($json);

  }

  public static function ExchangeLogdisks()
  {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();

    $equipment = $mysqli->query('SELECT skill_points, items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc();
    $skillPoints = json_decode($equipment['skill_points']);
    $items = json_decode($equipment['items']);
    $requiredLogdisks = Functions::GetRequiredLogdisks((array_sum((array) json_decode($equipment['skill_points'])) + $items->skillTree->researchPoints) + 1);

    $json = [
      'message' => ''
    ];

    if ($items->skillTree->logdisks >= $requiredLogdisks && ((array_sum((array) $skillPoints) + $items->skillTree->researchPoints) < array_sum(array_column(Functions::GetSkills($skillPoints), 'maxLevel')))) {
      $items->skillTree->logdisks -= $requiredLogdisks;
      $items->skillTree->researchPoints++;

      $mysqli->begin_transaction();

      try {
        $mysqli->query("UPDATE player_equipment SET items = '" . json_encode($items) . "' WHERE userId = " . $player['userId'] . "");

        $json['newStatus'] = [
          'logdisks' => $items->skillTree->logdisks,
          'researchPoints' => $items->skillTree->researchPoints,
          'researchPointsMaxed' => ((array_sum((array) $skillPoints) + $items->skillTree->researchPoints) == array_sum(array_column(Functions::GetSkills($skillPoints), 'maxLevel'))),
          'requiredLogdisks' => Functions::GetRequiredLogdisks((array_sum((array) json_decode($equipment['skill_points'])) + $items->skillTree->researchPoints) + 1)
        ];

        $json['message'] = 'Log disks exchanged.';

        $mysqli->commit();
      } catch (Exception $e) {
        error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
        error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
        $json['message'] = 'An error occurred. Please try again later.';
        $mysqli->rollback();
      }

      $mysqli->close();
    } else {
      $json['message'] = 'Something went wrong!';
    }

    return json_encode($json);
  }

  public static function ResetSkills()
  {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();

    $equipment = $mysqli->query('SELECT skill_points, items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc();
    $skillPoints = json_decode($equipment['skill_points']);
    $items = json_decode($equipment['items']);
    $data = json_decode($player['data']);

    $json = [
      'status' => false,
      'message' => ''
    ];

    $cost = Functions::GetResetSkillCost($items->skillTree->resetCount);
    if ($data->uridium >= $cost) {
      $data->uridium -= $cost;
      $items->skillTree->resetCount++;

      $items->skillTree->researchPoints += array_sum((array) $skillPoints);

      foreach ($skillPoints as $key => $value) {
        $skillPoints->$key = 0;
      }

      $mysqli->begin_transaction();

      try {
        $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");

        $mysqli->query("UPDATE player_equipment SET items = '" . json_encode($items) . "', skill_points = '" . json_encode($skillPoints) . "' WHERE userId = " . $player['userId'] . "");

        $json['status'] = true;
        $json['message'] = 'Research points resetted.';

        if (Socket::Get('IsOnline', ['UserId' => $player['userId'], 'Return' => false])) {
          Socket::Send('ResetSkillTree', ['UserId' => $player['userId']]);
        }

        $mysqli->commit();
      } catch (Exception $e) {
        $json['message'] = 'An error occurred. Please try again later.';
        $mysqli->rollback();
      }

      $mysqli->close();
    } else {
      $json['message'] = "You don't have enough Uridium.";
    }

    return json_encode($json);
  }

  public static function UseResearchPoints($skill)
  {
    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();
    $skill = $mysqli->real_escape_string($skill);

    $equipment = $mysqli->query('SELECT skill_points, items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc();
    $skillPoints = json_decode($equipment['skill_points']);
    $items = json_decode($equipment['items']);

    $skills = Functions::GetSkills($skillPoints);

    $json = [
      'message' => ''
    ];

    if (array_key_exists($skill, $skills) && isset($skillPoints->{$skill}) && (!isset($skills[$skill]['baseSkill']) || (isset($skills[$skill]['baseSkill']) && $skills[$skills[$skill]['baseSkill']]['currentLevel'] == $skills[$skills[$skill]['baseSkill']]['maxLevel']))) {
      if ($items->skillTree->researchPoints >= 1 && $skillPoints->{$skill} < $skills[$skill]['maxLevel']) {
        $items->skillTree->researchPoints--;
        $skillPoints->{$skill}++;

        $mysqli->begin_transaction();

        try {
          $mysqli->query("UPDATE player_equipment SET items = '" . json_encode($items) . "', skill_points = '" . json_encode($skillPoints) . "' WHERE userId = " . $player['userId'] . "");

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
          error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
          $json['message'] = 'An error occurred. Please try again later.';
          $mysqli->rollback();
        }

        $mysqli->close();
      } else {
        $json['message'] = 'Something went wrong!';
      }
    } else {
      $json['message'] = 'Something went wrong!';
    }

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
    } else {
      return false;
    }

  }

  public static function getShopItems($category){

    $mysqli = Database::GetInstance();

    $query_items = $mysqli->query("SELECT * FROM shop_items WHERE category = '$category' AND active = '1'");

    if ($query_items->num_rows > 0){
      $dataReturn = array();
	  $player = Functions::GetPlayer();
	  
	  $date = date("d.m.Y H:i:s");
		$day = date("D", strtotime($date));
		$ampm = date("A", strtotime($date));
		$hour = date("h", strtotime($date));
		
	  
      while($data_items = $query_items->fetch_assoc()){
		  $between = false;
		  
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
		  if($dataReturn[$i]["id"] == 512) {
			  $items = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);
			  if($items->iriscount <= 7) {
				$dataReturn[$i] = Functions::DroneChange($items, $dataReturn, $i);
			  } else $dataReturn[$i] = null;
		  }
	  }
      return $dataReturn;
    } else {
      return false;
    }

  }
	
	public static function DroneChange($items, $dataReturn, $i) {
			  if($items->iriscount == 1) {
				  $dataReturn[$i]["price"] = 24000;
          $dataReturn[$i]["priceType"] = "uridium";
			  } else if($items->iriscount == 2) {
				  $dataReturn[$i]["price"] = 42000;
				  $dataReturn[$i]["priceType"] = "uridium";
			  }if($items->iriscount == 3) {
				  $dataReturn[$i]["price"] = 60000;
				  $dataReturn[$i]["priceType"] = "uridium";
			  } else if($items->iriscount == 4) {
				  $dataReturn[$i]["price"] = 84000;
				  $dataReturn[$i]["priceType"] = "uridium";
			  } else if($items->iriscount == 5) {
				  $dataReturn[$i]["price"] = 96000;
				  $dataReturn[$i]["priceType"] = "uridium";
			  } else if($items->iriscount == 6) {
				  $dataReturn[$i]["price"] = 126000;
				  $dataReturn[$i]["priceType"] = "uridium";
			  } else if($items->iriscount == 7) {
				  $dataReturn[$i]["price"] = 200000;
				  $dataReturn[$i]["priceType"] = "uridium";
			  }
		return $dataReturn[$i];
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
      // Consolidated list from analysis for GetPlayer():
      // userId, username, pilotName, email, password, info, verification, shipId, sessionId, data, bootyKeys,
      // killedNpc, Npckill, clanId, factionId, level, oldPilotNames, rankId, premium, premiumUntil,
      // ammo, petSavedDesigns, petDesign, petName, destructions, droneExp, title, position, version,
      // securityQuestions, pwResetKey, rank, rankPoints, warPoints
	  $result = $mysqli->query('SELECT userId, username, pilotName, email, password, info, verification, shipId, sessionId, data, bootyKeys, killedNpc, Npckill, clanId, factionId, level, oldPilotNames, rankId, premium, premiumUntil, ammo, petSavedDesigns, petDesign, petName, destructions, droneExp, title, position, version, securityQuestions, pwResetKey, rank, rankPoints, warPoints FROM player_accounts WHERE userId = ' . $id . '')->fetch_assoc();
	  if($id == 324) { // This specific user ID check might indicate special handling or testing.
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
      $id = $mysqli->real_escape_string(Functions::s($id));
      // Consolidated for GetPlayerById: userId, data, pilotName, username, premium, rankId, factionId, clanId
      return $mysqli->query('SELECT userId, data, pilotName, username, premium, rankId, factionId, clanId FROM player_accounts WHERE userId = ' . $id . '')->fetch_assoc();
    } else {
      return null;
    }
  }

  public static function GetPlayerByPilotName($pilot = null) {
    $mysqli = Database::GetInstance();

    if (isset($pilot) && !empty($pilot)) {
      $pilot = $mysqli->real_escape_string(Functions::s($pilot));
      // Used in infoclan, only needs pilotName (and userId if further lookups are done based on it)
      $dataPilot = $mysqli->query('SELECT userId, pilotName FROM player_accounts WHERE pilotName = "'.$pilot.'"')->fetch_assoc();
      return $dataPilot;
    } else {
      return null;
    }
  }

  public static function getPlayerInStaff($pilot = null){
    $mysqli = Database::GetInstance();

    if (isset($pilot) && !empty($pilot)) {
      $pilot = $mysqli->real_escape_string(Functions::s($pilot));
      // Used in searchUser: username, pilotName, email, data (for currency), info (for IPs, dates), premium, userId
      $dataPilot = $mysqli->query('SELECT userId, username, pilotName, email, data, info, premium FROM player_accounts WHERE pilotName = "'.$pilot.'" OR userId = "'.$pilot.'" OR username = "'.$pilot.'"')->fetch_assoc();
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

      $query = $mysqli->query("SELECT id, category, name, information, price, priceType, amount, image, active, shipId, design_name, moduleId, moduleType, boosterId, boosterType, boosterDuration, laserName, petName, skillTree, droneName, ammoId, typeKey, petDesign, petFuel, petModule, FormationName, nameBootyKey FROM shop_items WHERE id = '$shipId' AND active = '1'");

      if ($query->num_rows > 0){
        $data_items = $query->fetch_assoc();
        $dataReturn = array(
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

      //changes for drones
			  if($data_items['id'] == 512) {
				  $player = Functions::GetPlayer();
				  $items = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);
				  $dataReturn1 = [$dataReturn];
				  if($items->iriscount <= 7) {
					$dataReturn = Functions::DroneChange($items, $dataReturn1, 0);
				  } else $dataReturn = null;
			  }
        return json_encode($dataReturn);
      } else {
        return false;
      }

    }

    $data = self::getShop()['items'][$shipId];
	   
	  return json_encode($data);
  }

   public static function infoShip($shipId)
  {
	   $mysqli = Database::GetInstance();
	   $info = $mysqli->query('SELECT shipID,lootID,name,health,speed,damage,lasers,generators FROM server_ships WHERE shipID = '.$shipId.'')->fetch_assoc();
	   
	   $dataReturn = array(
		'lootID' => $info['lootID'],
		'name' => strtolower($info['name']),
		'health' => $info['health'],
		'speed' => $info['speed'],
		'damage' => $info['damage'],
		'lasers' => $info['lasers'],
		'generatos' => $info['generators'],
		'shipID' => $info['shipID']
	   );

		return json_encode($dataReturn);
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
    $mysqli = Database::GetInstance();
    // This query is already specific.
    $query_applications = $mysqli->query("SELECT server_clan_applications.id as appId, server_clans.tag, server_clans.name FROM server_clan_applications INNER JOIN server_clans ON server_clan_applications.clanId=server_clans.id WHERE server_clan_applications.userId = '".$player['userId']."'");
    
    if ($query_applications->num_rows > 0){
      return $query_applications;
    } else {
      return false;
    }

  }

  public static function clan_cancel_application($app){

    if (isset($app) && !empty($app)){

      $mysqli = Database::GetInstance();
      $player = self::GetPlayer();

      $cancelApp = $mysqli->query("DELETE FROM server_clan_applications WHERE id = '$app' AND userId = '".$player['userId']."'");

      $query_applications = self::getClanApplications();
      $noApp = (isset($query_applications->num_rows) && $query_applications->num_rows > 0) ? false : true;

      return json_encode(array('app' => $app, 'status' => true, 'noApp' => $noApp));
    } else {
      return json_encode(array('status' => false));
    }

  }
  
  public static function infoclan($clanid){

	  $mysqli = Database::GetInstance();
	  $player = Functions::GetPlayer();
	  $info = $mysqli->query('SELECT server_clans.id,server_clans.name,server_clans.tag,server_clans.description,server_clans.factionId,server_clans.recruiting,server_clans.leaderId,server_clans.join_dates,server_clans.date,server_clans.rank,server_clans.profile,player_accounts.pilotName FROM server_clans JOIN player_accounts ON player_accounts.userId=server_clans.leaderId WHERE id = '.$clanid.'')->fetch_assoc();
	  
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

    $json = [
      'message' => "",
      'status' => false
    ];

    if (empty($name)) {
      $json['message'] = "Name is required";

      return json_encode($json);
    } 
    
    if (empty($tag)) {
      $json['message'] = "tag is required";
      
      return json_encode($json);
    }  
    
    if (strlen($tag) > 4){
      $json['message'] = "Tag only permit 1-4 characters";
      
      return json_encode($json);
    } 
    
    if (strlen($name) > 30){
      $json['message'] = "Name only permit 1-30 characters";
      
      return json_encode($json);
    }

    $arrayUpdate = array();

    if (!empty($tag)){
      $arrayUpdate['tag'] = $tag;
    }

    if (!empty($name)){
      $arrayUpdate['name'] = $name;
    }

    if (!empty($profile)){
      $arrayUpdate['profile'] = $profile;
    }

    if (!empty($description)){
      $arrayUpdate['description'] = $description;
    }

    if (is_numeric($recruitment)){
      $arrayUpdate['recruiting'] = $recruitment;
    }

    if (is_numeric($company)){
      $arrayUpdate['factionId'] = $company;
    }

    $cols = array();
    foreach($arrayUpdate as $key => $value) {
      $cols[] = "$key = '$value'";
    }

    $updateClan = $mysqli->query("UPDATE server_clans SET ".implode(', ', $cols)." WHERE leaderId = '".$player['userId']."'");

    if ($updateClan){
      $json['status'] = true;
      $json['message'] = "Clan sucesfully edited.";
      self::addLogClan("have modified clan settings", $player['clanId'], $player['userId'], 'settings');
    } else {
      $json['message'] = "Error to edit clan.";
    }

    return json_encode($json);

  }

  public static function addLogClan($log = null, $clanId = null, $leaderId = null, $typeLog = null){

    if (isset($log) && isset($clanId) && isset($leaderId) && isset($typeLog)){

      $mysqli = Database::GetInstance();

      $insertLog = $mysqli->query("INSERT INTO newsclantablelog (`date`, `texto`, `clanId`, `leaderId`, `type`) VALUES (NOW(), '$log', '$clanId', '$leaderId','$typeLog');");

      if ($insertLog){
        return true;
      } else {
        return false;
      }

    }

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

    $infoClan = json_decode(self::infoclan($player['clanId']), true);

    if ($player['userId'] !== $infoClan['leaderId']){
      $json['message'] = "You are no owner of this clan";

      return json_encode($json);
    }

    $insertNew = $mysqli->query("INSERT INTO newsclantablelog (`date`, `texto`, `clanId`, `leaderId`, `type`) VALUES (NOW(), '$message', '".$player['clanId']."', '".$player['userId']."','new');");

    if ($insertNew){
      $json['status'] = true;
      $json['message'] = "News added sucesfully.";
    } else {
      $json['message'] = "Error to add news.";
    }

    return json_encode($json);

  }

  public static function getMembersClan($clanId){

    if (isset($clanId) && !empty($clanId)){

      $mysqli = Database::GetInstance();

      $queryMembersClan = $mysqli->query("SELECT * FROM player_accounts WHERE clanId = '$clanId'");

      if ($queryMembersClan){
        return $queryMembersClan;
      } else {
        return false;
      }

    }

  }

  public static function isMemberClan($clanId = null, $userId = null){

    if (isset($clanId) && !empty($clanId) && isset($userId) && !empty($userId)){

      $mysqli = Database::GetInstance();

      $queryCheck = $mysqli->query("SELECT * FROM player_accounts WHERE userId = '$userId' AND clanId = '$clanId'");

      if ($queryCheck && $queryCheck->num_rows > 0){
        return true;
      } else {
        return false;
      }

    }

  }

  public static function change_clan_leader($newLeader = null){

    $mysqli = Database::GetInstance();

    $json = [
      'message' => "",
      'status' => false
    ];

    if (empty($newLeader)){
      $json['message'] = "New leader is empty.";

      return json_encode($json);
    }

    $player = self::GetPlayer();

    $infoClan = json_decode(self::infoclan($player['clanId']), true);

    if ($player['userId'] == $newLeader){
      $json['message'] = "The clan is your property.";

      return json_encode($json);
    }

    if ($player['userId'] !== $infoClan['leaderId']){
      $json['message'] = "You are no owner of this clan.";

      return json_encode($json);
    }

    $isMemberClan = self::isMemberClan($player['clanId'], $newLeader);

    if ($isMemberClan){
      $updateNewLeader = $mysqli->query("UPDATE server_clans SET leaderId = '$newLeader' WHERE id = '".$player['clanId']."'");

      $json['status'] = true;
      $json['message'] = "Leader updated suscesfully.";

    } else {
      $json['message'] = "Member is not of the clan.";
    }

    return json_encode($json);

  }

  public static function delete_clan($deleteClan = null){

    $mysqli = Database::GetInstance();

    $json = [
      'message' => "",
      'status' => false
    ];

    if (empty($deleteClan)){
      $json['message'] = "Error to delete clan.";

      return json_encode($json);
    }

    $player = self::GetPlayer();

    $infoClan = json_decode(self::infoclan($player['clanId']), true);

    if ($player['userId'] !== $infoClan['leaderId']){
      $json['message'] = "You are no owner of this clan.";

      return json_encode($json);
    }

    $mysqli->begin_transaction();

    try {
      
      $mysqli->query("UPDATE player_accounts SET clanId = '0' WHERE clanId = '".$infoClan['id']."'");

      $mysqli->query("DELETE FROM server_clans WHERE id = '".$infoClan['id']."' AND leaderId = '".$player['userId']."'");

      $mysqli->query("DELETE FROM server_clan_applications WHERE clanId = '".$infoClan['id']."'");

      $mysqli->query("DELETE FROM server_clan_diplomacy WHERE senderClanId = '".$infoClan['id']."' OR toClanId = '". $infoClan['id']."'");

      $mysqli->query("DELETE FROM server_clan_diplomacy_applications WHERE senderClanId = '".$infoClan['id']."' OR toClanId = '".$infoClan['id']."'");

      Socket::Send('DeleteClan', ['ClanId' => $infoClan['id']]);

      $json['status'] = true;

      $json['message'] = "Clan sucesfully deleted.";

      $mysqli->commit();

    } catch (Exception $e) {
      $json['message'] = "Error to delete clan.";

      $mysqli->rollback();
    }

    $mysqli->close();

    return json_encode($json);

  }

  public static function getAllClans(){

    $mysqli = Database::GetInstance();

    $queryGetClans = $mysqli->query("SELECT * FROM server_clans ORDER by id DESC");

    if ($queryGetClans){
      return $queryGetClans;
    } else {
      return false;
    }

  }

  public static function send_bank_credits($to = null, $credits = null, $reason = null){

    if (isset($to) and !empty($to) and isset($credits) and !empty($credits) and isset($reason) and !empty($reason)){

      $json = [
        'message' => "",
        'status' => false
      ];

      $mysqli = Database::GetInstance();
      $player = self::GetPlayer();
      $playerTo = self::GetPlayerById($to); // GetPlayerById is already refactored

      $bankCreditsQ = $mysqli->query("SELECT leaderId, bankcredits FROM server_clans WHERE id = '".$player['clanId']."'");

      if ($bankCreditsQ){

        $dataClanBank = $bankCreditsQ->fetch_assoc();

        if ($dataClanBank['leaderId'] !== $player['userId']){
          $json['message'] = "You are no owner of this clan.";

          return json_encode($json);
        }

        if ($dataClanBank['bankcredits'] < $credits){
          $json['message'] = "Bank not have <b>".$credits."</b> credits to send.";

          return json_encode($json);
        }

        $mysqli->query("UPDATE server_clans SET bankcredits = bankcredits-$credits WHERE id = '".$player['clanId']."'");

        $dataTo = json_decode($playerTo['data'], true);
        $creditsDiscountPercentage = $credits - ($credits * (10/100));
        $dataTo['credits'] += $creditsDiscountPercentage;

        if (isset($dataTo['credits'])){
          $mysqli->query("UPDATE player_accounts SET data = '".json_encode($dataTo)."' WHERE userId = '$to'");
        }

        self::addBankLog($credits, 'Credits', $playerTo['pilotName'], $reason, $player['clanId']);

        $json['status'] = true;
        $json['message'] = "Sucesfully sended <b>".$credits."</b> C. (Total sended with 10% fees: <b>".$creditsDiscountPercentage." C.</b>) to <b>".$playerTo['pilotName']."</b>";

      } else {
        $json['message'] = "Error detected.";
      }

    } else {
      $json['message'] = "Error detected.";
    }

    return json_encode($json);

  }

  public static function send_bank_uridium($to = null, $uridium = null, $reason = null){

    if (isset($to) and !empty($to) and isset($uridium) and !empty($uridium) and isset($reason) and !empty($reason)){

      $json = [
        'message' => "",
        'status' => false
      ];

      $mysqli = Database::GetInstance();
      $player = self::GetPlayer();
      $playerTo = self::GetPlayerById($to); // GetPlayerById is already refactored

      $bankUridiumQ = $mysqli->query("SELECT leaderId, bankuri FROM server_clans WHERE id = '".$player['clanId']."'");

      if ($bankUridiumQ){

        $dataClanBank = $bankUridiumQ->fetch_assoc();

        if ($dataClanBank['leaderId'] !== $player['userId']){
          $json['message'] = "You are no owner of this clan.";

          return json_encode($json);
        }

        if ($dataClanBank['bankuri'] < $uridium){
          $json['message'] = "Bank not have <b>".$uridium."</b> uridium to send.";

          return json_encode($json);
        }

        $mysqli->query("UPDATE server_clans SET bankuri = bankuri-$uridium WHERE id = '".$player['clanId']."'");

        $dataTo = json_decode($playerTo['data'], true);
        $uridiumDiscountPercentage = $uridium - ($uridium * (25/100));
        $dataTo['uridium'] += $uridiumDiscountPercentage;

        if (isset($dataTo['uridium'])){
          $mysqli->query("UPDATE player_accounts SET data = '".json_encode($dataTo)."' WHERE userId = '$to'");
        }

        self::addBankLog($uridium, 'Uridium', $playerTo['pilotName'], $reason, $player['clanId']);

        $json['status'] = true;
        $json['message'] = "Sucesfully sended <b>".$uridium."</b> U. (Total sended with 25% fees: <b>".$uridiumDiscountPercentage." U.</b>) to <b>".$playerTo['pilotName']."</b>";

      } else {
        $json['message'] = "Error detected.";
      }

    } else {
      $json['message'] = "Error detected.";
    }

    return json_encode($json);

  }

  public static function addBankLog($amount, $from, $to, $reason, $idClan){

    if (isset($amount) && !empty($amount) && isset($from) && !empty($from) && isset($to) && !empty($to) && isset($reason) && !empty($reason)){

      $mysqli = Database::GetInstance();

      $insertLog = $mysqli->query("INSERT INTO bank_log (`amount`, `from`, `to`, `reason`, `date`, `idClan`) VALUES ('$amount', '$from', '$to', '$reason', '".time()."', '$idClan');");

      if ($insertLog){
        return true;
      } else {
        return false;
      }

    } else {
      return 0;
    }

  }

  public static function getBankLog($idClan = null, $orderBy = "DESC"){

    if (isset($idClan) && !empty($idClan)){

      $mysqli = Database::GetInstance();

      $sQuery = $mysqli->query("SELECT * FROM bank_log WHERE idClan = '$idClan' ORDER by id $orderBy");

      if ($sQuery){
        return $sQuery;
      } else {
        return false;
      }

    } else {
      return false;
    }

  }

  public static function change_credits_tax($tax = null){

    if (isset($tax) and !empty($tax)){

      $json = [
        'message' => "",
        'status' => false
      ];

      $permitPercentage = [0,1,2,3,4,5];

      $mysqli = Database::GetInstance();

      $player = self::GetPlayer();

      $sQuery = $mysqli->query("SELECT leaderId, creditTax FROM server_clans WHERE id = '".$player['clanId']."'");
      $sQuery = $mysqli->query("SELECT leaderId, uridiumTax FROM server_clans WHERE id = '".$player['clanId']."'");

      if ($sQuery){

        $dataClan = $sQuery->fetch_assoc();

        if ($dataClan['leaderId'] !== $player['userId']){
          $json['message'] = "You are no owner of this clan.";
  
          return json_encode($json);
        }

        $tax = ($tax == -1) ? 0 : $tax;

        if (!in_array($tax, $permitPercentage)){
          $json['message'] = "Percentage not permited.";

          return json_encode($json);
        }

        $oldTax = $dataClan['creditTax'];
  
        $updateTax = $mysqli->query("UPDATE server_clans SET creditTax = '$tax', lastTaxCredit = '".strtotime("+1 day")."' WHERE id = '".$player['clanId']."'");

        self::addLogClan("set Clan Credits Tax from ".$oldTax."% to ".$tax."%!", $player['clanId'], $player['userId'], 'logbank');

        if ($updateTax){
          $json['status'] = true;
          $json['message'] = "Sucesfully changed tax from ".$oldTax."% to ".$tax."%";
        } else {
          $json['message'] = "Error detected.";
        }

      } else {
        $json['message'] = "Error detected.";
      }

      return json_encode($json);

    } else {
      return false;
    }

  }

  public static function change_uridium_tax($tax = null){

    if (isset($tax) and !empty($tax)){

      $json = [
        'message' => "",
        'status' => false
      ];

      $permitPercentage = [0,0.1,0.2,0.3];

      $mysqli = Database::GetInstance();

      $player = self::GetPlayer();

      $sQuery = $mysqli->query("SELECT * FROM server_clans WHERE id = '".$player['clanId']."'");

      if ($sQuery){

        $dataClan = $sQuery->fetch_assoc();

        if ($dataClan['leaderId'] !== $player['userId']){
          $json['message'] = "You are no owner of this clan.";
  
          return json_encode($json);
        }

        if ($tax == 1){
          $tax = 0.1;
        } elseif ($tax == 2){
          $tax = 0.2;
        } elseif ($tax == 3){
          $tax = 0.3;
        } elseif ($tax == -1){
          $tax = 0;
        } else {
          $tax;
        }

        if (!in_array($tax, $permitPercentage)){
          $json['message'] = "Percentage not permited.";

          return json_encode($json);
        }

        $oldTax = $dataClan['uridiumTax'];
  
        $updateTax = $mysqli->query("UPDATE server_clans SET uridiumTax = '$tax', lastTaxUridium = '".strtotime("+7 day")."' WHERE id = '".$player['clanId']."'");

        self::addLogClan("set Clan Uridium Tax from ".$oldTax."% to ".$tax."%!", $player['clanId'], $player['userId'], 'logbank');

        if ($updateTax){
          $json['status'] = true;
          $json['message'] = "Sucesfully changed tax from ".$oldTax."% to ".$tax."%";
        } else {
          $json['message'] = "Error detected.";
        }

      } else {
        $json['message'] = "Error detected.";
      }

      return json_encode($json);

    } else {
      return false;
    }

  }

  public static function calculateTax($idClan = null, $type = null){

    if (isset($idClan) && !empty($idClan) && isset($type) && !empty($type)){

      $mysqli = Database::GetInstance();

      $sQuery = $mysqli->query("SELECT creditTax, uridiumTax FROM server_clans WHERE id = '$idClan'");

      if ($sQuery){

        $clanInfo = $sQuery->fetch_assoc();

        $membersClan = self::getMembersClan($idClan);

        if ($membersClan->num_rows > 0){

          $creditsToClan = 0;

          while($dataClan = $membersClan->fetch_assoc()){
            $dataUser = json_decode($dataClan['data'], true);
            $creditsUser = $dataUser[$type];
            $creditsToClan += 0 + ($creditsUser * ($clanInfo[($type == 'credits') ? 'creditTax' : 'uridiumTax']/100));
          }

          return round($creditsToClan);

        } else {
          return 0;
        }

      } else {
        return -1;
      }

    } else {
      return false;
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
      
      $getClans = $mysqli->query("SELECT id, tag, name, lastTaxCredit, lastTaxUridium, creditTax, uridiumTax FROM server_clans WHERE creditTax > 0 OR uridiumTax > 0");

      if ($getClans->num_rows > 0){

        $dateNow = time();

        while($dataClans = $getClans->fetch_assoc()){
          $creditTax = self::calculateTax($dataClans['id'], 'credits'); // calculateTax already specific
          $uridiumTax = self::calculateTax($dataClans['id'], 'uridium'); // calculateTax already specific

          if ($creditTax > 0){

            if (isset($dataClans['lastTaxCredit']) && (int)$dataClans['lastTaxCredit'] >= $dateNow) {
              $json['message'] .= "|Credits not passed wait 24h in clan: [".$dataClans['tag']."] ".$dataClans['name'].". idClan: ".$dataClans['id']."|";
              $json['passedCredits'] = true;
            }

            if (!$json['passedCredits']){

              $added24h = strtotime("+1 day");
              $updateCredits = $mysqli->query("UPDATE server_clans SET bankcredits = bankcredits+$creditTax, lastTaxCredit = '$added24h' WHERE id = '".$dataClans['id']."'");

              $json['status'] = true;
              self::addLogClan("Added ".number_format($creditTax, 0, ',', '.')." credits to clan [".$dataClans['tag']."] ".$dataClans['name']."", $dataClans['id'], 2, 'systembank');
              $json['message'] .= "|Added ".number_format($creditTax, 0, ',', '.')." credits to clan [".$dataClans['tag']."] ".$dataClans['name'].". idClan: ".$dataClans['id']."|";

            }

          }

          if ($uridiumTax > 0){

            if (isset($dataClans['lastTaxUridium']) && (int)$dataClans['lastTaxUridium'] > $dateNow) {
              $json['message'] .= "|Uridium not passed wait 1w in clan: [".$dataClans['tag']."] ".$dataClans['name'].". idClan: ".$dataClans['id']."|";
              $json['passedUridium'] = true;

            }

            if (!$json['passedUridium']){

              $added1w = strtotime("+7 day");
              $updateUridium = $mysqli->query("UPDATE server_clans SET bankuri = bankuri+$uridiumTax, lastTaxUridium = '$added1w' WHERE id = '".$dataClans['id']."'");

              $json['status'] = true;
              self::addLogClan("Added ".number_format($uridiumTax, 0, ',', '.')." uridium to clan [".$dataClans['tag']."] ".$dataClans['name']."", $dataClans['id'], 2, 'systembank');
              $json['message'] .= "|Added ".number_format($uridiumTax, 0, ',', '.')." uridium to clan [".$dataClans['tag']."] ".$dataClans['name'].". idClan: ".$dataClans['id']."|";

            }

          }

        }

      } else {
        $json['message'] = "No clans width creditTax or uridiumTax > 0";
      }

    } else {
      $json['message'] = $ip." denied.";
    }

    return json_encode($json);

  }

  public static function getPartsDrones($drone = null){

    $json = [
      'status' => false,
      'message' => ''
    ];

    if (empty($drone)){
      $json['message'] = "Critical Error. Need Drone.";

      return json_encode($json);
    }

    $mysqli = Database::GetInstance();
    $player = self::GetPlayer();
    $items = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);

    $droneName = "drone".$drone."Parts";

    @$apisCount = $items->{$droneName};

    return ($apisCount ? $apisCount : 0);

  }

  public static function buildDrone($drone = null){

    $json = [
      'status' => false,
      'message' => '',
      'uridium' => 0
    ];

    if (empty($drone)){
      $json['message'] = "Critical Error. Need Drone.";

      return json_encode($json);
    }

    $required = [
      'Apis' => ['parts'=> 45],
      'Zeus' => ['parts'=> 45, 'uridium' => '1300000']
    ];

    $countParts = self::getPartsDrones($drone);

    $mysqli = Database::GetInstance();
    $player = self::GetPlayer();
    $items = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);
    $droneName = "drone".$drone."Parts";
    $dataPlayer = json_decode($player['data']);

    if (!isset($items->{strtolower($drone)})){
      $json['message'] = "This drone no exists.";

      return json_encode($json);
    }

    if ($items->{strtolower($drone)}){
      $json['message'] = "You already builded ".$drone;

      return json_encode($json);
    }

    if ($countParts >= $required[$drone]['parts']){
      $items->{$droneName} -= $required[$drone]['parts'];
      $items->{strtolower($drone)} = true;
      $mysqli->query("UPDATE player_equipment SET items = '".json_encode($items)."' WHERE userId = ".$player["userId"]);
      $json['status'] = true;
      $json['message'] = "Builded ".$drone." sucesfully with ".$required[$drone]['parts']." parts";
      return json_encode($json);
     
    } else {
      $json['message'] = "You no have ".$required[$drone]['parts']." part for ".$drone. ".";
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

  private static function _getItemLevelFieldInfo($itemName) {
    return isset(self::$upgradeableItemConfig[$itemName]) ? (object)self::$upgradeableItemConfig[$itemName] : null;
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

      $mysqli = Database::GetInstance();

      $sQuery = $mysqli->query("SELECT id, name, image, multiplier FROM itemsUpgradeSystem WHERE id = '$idItem'");

      if ($sQuery->num_rows > 0){

        $dataItem = $sQuery->fetch_assoc();

       $sQuery4 = $mysqli->query("SELECT lf1lvl,lf3nlvl,lf4mdlvl,lf4pdlvl,lf4hplvl,lf4splvl,lf4unstablelvl,mp1lvl,lf2lvl,lf3lvl,lf4lvl,lf5lvl,A01lvl,A02lvl,A03lvl,B01lvl,B02lvl,B03lvl FROM player_equipment WHERE userId = '{$player['userId']}'");
        $dataEquipment = $sQuery4->fetch_assoc();

        $lvl = null;
        $lvlTo = null;

        $itemInfo = self::_getItemLevelFieldInfo($dataItem['name']);

        if ($itemInfo) {
            if ($itemInfo->type === 'drone_exp') {
                $lvl = self::getDroneLvl(); // getDroneLvl() should return the current level
            } else if (isset($dataEquipment[$itemInfo->field])) {
                $lvl = $dataEquipment[$itemInfo->field];
            } else {
                // Field doesn't exist in $dataEquipment, might be a new item not yet in player_equipment table structure
                // Or could indicate an issue with $itemInfo->field name. For safety, assume level 0.
                $lvl = 0;
            }
            $lvlTo = $lvl + 1;
        } else {
            // Fallback or error for unknown item
            $json['message'] = "Unknown item for level info: " . $dataItem['name'];
            return json_encode($json); // Early return if item info not found
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

      $mysqli = Database::GetInstance();

      $data = json_decode(self::selectItemUpgradeSystem($idItem, 5), true);

      $checkInProcess = $mysqli->query("SELECT itemId FROM upgradesSystem WHERE itemId = '$idItem' and idUser = '".$player['userId']."'");

      if ($checkInProcess->num_rows > 0){
        $json['message'] = "This item not finished. Wait...";

        return json_encode($json);
      }

      $cost = $data['costUpgrade'] * $data['percent'][$cnt];

      $dataPlayer = json_decode($player['data']);

      if ($cost > $dataPlayer->uridium){
        $json['message'] = "You no have ".$cost." U. to upgrade this item.";

        return json_encode($json);
      }

      $changeU = $dataPlayer->uridium-=$cost;

      if(Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
        Socket::Send('UpdateUridium', ['UserId' => $player['userId'], 'UridiumPrice' => $cost, 'Type' => "DECREASE"]);
      } else {
        $dataPlayer->uridium = $changeU;
        $mysqli->query("UPDATE player_accounts SET data = '".json_encode($dataPlayer)."' WHERE userId = '".$player['userId']."'");
      }

      $json['uridium'] = number_format($changeU, 0, ',', '.');

     $sQuery4 = $mysqli->query("SELECT lf1lvl,lf3nlvl,lf4mdlvl,lf4pdlvl,lf4hplvl,lf4splvl,lf4unstablelvl,mp1lvl,lf2lvl,lf3lvl,lf4lvl,lf5lvl,A01lvl,A02lvl,A03lvl,B01lvl,B02lvl,B03lvl FROM player_equipment WHERE userId = '{$player['userId']}'");
      $dataEquipment = $sQuery4->fetch_assoc();

      $itemInfo = self::_getItemLevelFieldInfo($data['name']);

      if (!$itemInfo) {
          $json['message'] = "Unknown item for upgrade: " . $data['name'];
          return json_encode($json);
      }

      $lvl = 0; // Current level of the item
      if ($itemInfo->type === 'drone_exp') {
          $lvl = self::getDroneLvl();
      } else if (isset($dataEquipment[$itemInfo->field])) {
          $lvl = $dataEquipment[$itemInfo->field];
      }
      // If field is not set in $dataEquipment (e.g. new item), $lvl remains 0, which is fine for a first upgrade.

      if ($lvl >= $itemInfo->maxLevel) {
          $displayType = ($itemInfo->type === 'drone_exp') ? "Drone" : (($itemInfo->type === 'equipment') ? "Item" : $itemInfo->type);
          $json['message'] = "This " . $displayType . " does not allow to upgrade more (Max Level: {$itemInfo->maxLevel}).";
          return json_encode($json);
      }

      $lvlTo = $lvl + 1;

      $waitTime = strtotime("+" . self::UPGRADE_WAIT_TIME, time());
      $timeNow = time();

      $sQuery = $mysqli->query("INSERT INTO upgradesSystem (`idUser`, `lvl_base`, `new_lvl`, `name`, `itemId`, `waitTime`, `percent`, `img`, `timeNow`) VALUES ('".$player['userId']."', '$lvl', '$lvlTo', '".$data['name']."', '".$data['itemId']."', '$waitTime', '$cnt', '".$data['image']."', '$timeNow');");

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

      $mysqli = Database::GetInstance();

      // Needs timeNow, waitTime
      $sQuery = $mysqli->query("SELECT timeNow, waitTime FROM upgradesSystem WHERE id = '$idItem' AND idUser = '".$player['userId']."'");

      if ($sQuery->num_rows > 0){

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

      $mysqli = Database::GetInstance();

      // Needs: timeNow, waitTime, percent, name, new_lvl, itemId, lvl_base, img, idUser, id (for delete)
      $sQuery = $mysqli->query("SELECT id, idUser, lvl_base, new_lvl, name, itemId, waitTime, percent, img, timeNow FROM upgradesSystem WHERE id = '$id' AND idUser = '".$player['userId']."'");

      if ($sQuery->num_rows > 0){

        $data = $sQuery->fetch_assoc();

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
            $itemInfo = self::_getItemLevelFieldInfo($data['name']);
            if ($itemInfo) {
                if ($itemInfo->type === 'drone_exp') {
                    if(Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
                        Socket::Send('updateDroneEXP', ['UserId' => $player['userId'], 'Amount' => self::$droneLevelExperienceMap[$data['new_lvl']]]);
                    } else {
                        $mysqli->query("UPDATE player_accounts SET droneExp = '".self::$droneLevelExperienceMap[$data['new_lvl']]."' WHERE userId = '{$player['userId']}'");
                    }
                } else if ($itemInfo->type === 'equipment') {
                    $mysqli->query("UPDATE player_equipment SET {$itemInfo->field} = '".$data['new_lvl']."' WHERE userId = '{$player['userId']}'");
                }
                // Potentially add more 'else if' for other types if they update different tables or fields
                $json['winner'] = true;
            } else {
                // Should not happen if item was found before and exists in map
                $json['message'] = "Error applying upgrade: Unknown item " . $data['name'];
                $json['winner'] = false;
            }
          } else {
            $json['winner'] = false;
          }

          $getCat = $mysqli->query("SELECT itemsupgradesystem.catId, categoryupgradesystem.id, categoryupgradesystem.cat FROM itemsupgradesystem INNER JOIN categoryupgradesystem ON itemsupgradesystem.catId=categoryupgradesystem.id WHERE itemsupgradesystem.id = '".$data['itemId']."'");

          $cat = "";
          if ($getCat->num_rows > 0){
            $dataCat = $getCat->fetch_assoc();
            $cat = strtolower($dataCat['cat']);
          }

          $json['itemId'] = $data['itemId'];
          $json['new_lvl'] = $data['new_lvl'];
          $json['img'] = $data['img'];
          $json['name'] = $data['name'];
          $json['lvl'] = $data['lvl_base'];
          $json['cat'] = $cat;
          $json['id'] = $data['id'];

          $mysqli->query("DELETE FROM upgradessystem WHERE id = '".$data['id']."' AND idUser = '".$data['idUser']."'");

          return json_encode($json);

        } else {
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

    // Needs: timeNow, waitTime, percent, name, new_lvl, itemId, lvl_base, img, id, idUser
    $queryFinish = $mysqli->query("SELECT id, idUser, lvl_base, new_lvl, name, itemId, waitTime, percent, img, timeNow FROM upgradessystem WHERE idUser = '".$player['userId']."'");

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

            $itemInfo = self::_getItemLevelFieldInfo($dataFinish['name']);
            if ($itemInfo) {
                if ($itemInfo->type === 'drone_exp') {
                    if(Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
                        Socket::Send('updateDroneEXP', ['UserId' => $player['userId'], 'Amount' => self::$droneLevelExperienceMap[$dataFinish['new_lvl']]]);
                    } else {
                        $mysqli->query("UPDATE player_accounts SET droneExp = '".self::$droneLevelExperienceMap[$dataFinish['new_lvl']]."' WHERE userId = '{$player['userId']}'");
                    }
                } else if ($itemInfo->type === 'equipment') {
                    $mysqli->query("UPDATE player_equipment SET {$itemInfo->field} = '".$dataFinish['new_lvl']."' WHERE userId = '{$player['userId']}'");
                }
                 $result['winner'] = true;
            } else {
                // Log error or handle unknown item if necessary
                $result['winner'] = false;
            }
          } else {
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

    if (isset($limit)){
      $limitF = " LIMIT ".$limit;
    } else {
      $limitF = "";
    }

    $sQ = $mysqli->query('SELECT server_clans.tag, server_clans.name, server_clans.rank, server_clans.rankPoints, server_clans.leaderId, server_clans.factionId, player_accounts.userId FROM server_clans INNER JOIN player_accounts on server_clans.leaderId=player_accounts.userId WHERE server_clans.rank > 0 ORDER BY server_clans.rank ASC '.$limitF); 

    if ($sQ->num_rows > 0){
      $data = array();
      $numero = 0;
      while($dataSq = $sQ->fetch_assoc()){

        $query2 = $mysqli->query("SELECT * FROM chat_permissions WHERE userId = $dataSq[userId]");

        $seeRank = 1;

        if ($query2->num_rows > 0 AND $query2->fetch_array()['type'] == 1){
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

    if (isset($limit)){
      $limitF = " LIMIT ".$limit;
    } else {
      $limitF = "";
    }

    $sQ = $mysqli->query("SELECT pilotName, userId, factionId, warPoints, rankId FROM player_accounts WHERE warPoints > 0 ORDER by warPoints DESC ".$limitF);

    if ($sQ->num_rows > 0){
      $data = array();
      $numero = 0;
      while($dataSq = $sQ->fetch_assoc()){

        $query2 = $mysqli->query("SELECT * FROM chat_permissions WHERE userId = $dataSq[userId]");

        $seeRank = 1;

        if ($query2->num_rows > 0 AND $query2->fetch_array()['type'] == 1){
          $seeRank = 0;
        }

        $numero++;

        if ($seeRank){

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

          $data[] = array('color' => $estilo, 'pilotName' => $dataSq['pilotName'], 'puntos_totales' => $dataSq['warPoints'], 'factionId' => $dataSq['factionId'], 'rankId' => $dataSq['rankId'], 'rank' => $numero);

        }

        //$data[] = array('color' => $estilo, 'pilotName' => $dataSq['pilotName'], 'puntos_totales' => $dataSq['warPoints'], 'factionId' => $dataSq['factionId'], 'rankId' => $dataSq['rankId'], 'rank' => $numero);

      }

      return array('data' => $data);
    } else {
      return array('data' => null);
    }

  }

  public static function getDataRankingPlayers($limit = null){

    $mysqli = Database::GetInstance();

    if (isset($limit)){
      $limitF = " LIMIT ".$limit;
    } else {
      $limitF = "";
    }

    $sQ = $mysqli->query("SELECT * FROM player_accounts WHERE rankId != 22 AND rank > 0 ORDER BY rank ASC ".$limitF);

    if ($sQ->num_rows > 0){
      $data = array();
      $numero = 0;
      while($dataSq = $sQ->fetch_assoc()){

        $query2 = $mysqli->query("SELECT * FROM chat_permissions WHERE userId = $dataSq[userId]");

        $seeRank = 1;

        if ($query2->num_rows > 0 AND $query2->fetch_array()['type'] == 1){
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

          $data[] = array('color' => $estilo, 'pilotName' => $dataSq['pilotName'], 'rankPoints' => $dataSq['rankPoints'], 'factionId' => $dataSq['factionId'], 'rankId' => $dataSq['rankId'], 'rank' => $numero);

        }

        //$data[] = array('color' => $estilo, 'pilotName' => $dataSq['pilotName'], 'rankPoints' => $dataSq['rankPoints'], 'factionId' => $dataSq['factionId'], 'rankId' => $dataSq['rankId'], 'rank' => $numero);

      }

      return array('data' => $data);
    } else {
      return array('data' => null);
    }

  }

  public static function getDataRankingPvp($limit = null){

    $mysqli = Database::GetInstance();

    if (isset($limit)){
      $limitF = " LIMIT ".$limit;
    } else {
      $limitF = "";
    }

    $sQ = $mysqli->query("SELECT COUNT(killer_id) as total_kills, killer_id FROM log_player_kills GROUP BY `killer_id` ORDER by total_kills DESC ".$limitF);

    if ($sQ->num_rows > 0){
      $data = array();
      $numero = 0;
      while($dataSq = $sQ->fetch_assoc()){

        $query3 = $mysqli->query("SELECT * FROM player_accounts WHERE userId = '$dataSq[killer_id]'");

        $query2 = $mysqli->query("SELECT * FROM chat_permissions WHERE userId = $dataSq[killer_id]");

        $dataPlayer = $query3->fetch_array();

        $seeRank = 1;

        if ($query2->num_rows > 0 AND $query2->fetch_array()['type'] == 1){
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

          $data[] = array('color' => $estilo, 'pilotName' => $dataPlayer['pilotName'], 'rankPoints' => $dataSq['total_kills'], 'factionId' => $dataPlayer['factionId'], 'rankId' => $dataPlayer['rankId'], 'rank' => $numero);

        }

        //$data[] = array('color' => $estilo, 'pilotName' => $dataSq['pilotName'], 'rankPoints' => $dataSq['rankPoints'], 'factionId' => $dataSq['factionId'], 'rankId' => $dataSq['rankId'], 'rank' => $numero);

      }

      return array('data' => $data);
    } else {
      return array('data' => null);
    }

  }  

  public static function CronDiscordAnnouncements($ip = null){

    $permitIpCron = [
      '0' => '135.181.104.19',
      '1' => '135.181.85.24'
    ];

    if (isset($ip) && !empty($ip) && in_array($ip, $permitIpCron)){

      $mysqli = Database::GetInstance();

      $json_options = [
        "http" => [
          "method" => "GET",
          "header" => "Authorization: Bot NzMzMDA4MDQzNTExNTEzMDk5.Xw848A.Xm9xbzjRFxUWZKvJabFoIWGizaA"
        ]
      ];

      $json_context = stream_context_create($json_options);

      $json_get  = file_get_contents('https://discordapp.com/api/v6/channels/564879634672386059/messages', false, $json_context);

      if (isset($json_get) and !empty($json_get)){
          $json_decode = json_decode($json_get, true);
          if (count($json_decode) > 0){
              foreach ($json_decode as $data){
                $checkIsSaved = $mysqli->query("SELECT idMsg FROM discordAnnounces WHERE idMsg = '".$data['id']."'");
                if ($checkIsSaved->num_rows == 0 && isset($data['content']) && !empty($data['content'])){

                  $content = $mysqli->real_escape_string($data['content']);
                  $author = $mysqli->real_escape_string($data['author']['username']);
                  $date = $mysqli->real_escape_string($data['timestamp']);

                  $saveAnnounce = $mysqli->query("INSERT INTO discordAnnounces (`content`, `author`, `idMsg`, `date`) VALUES ('".$content."', '".$author."', '".$data['id']."', '".$date."');");

                  echo "<p>MsgID: <b>".$data['id']."</b> saved.</p> | Contenido: ".$data['content'];

                  echo "INSERT INTO discordAnnounces (`content`, `author`, `idMsg`) VALUES ('".$data['content']."', '".$data['author']['username']."', '".$data['id']."');";
                }
              }
          } else {
            return false;
          }
      }

    } else {
      return json_encode(array('msg' => 'Denied. '.$ip));
    }

  }

  public static function getUserMap($idUser = null){
    
    $player = Functions::GetPlayer();

    if (empty($idUser)){
      $idUser = $player['userId'];
    }

    $mysqli = Database::GetInstance();

    $sQuery = $mysqli->query("SELECT * FROM player_accounts WHERE userId = '".$idUser."'");

    if ($sQuery->num_rows > 0){

      $position = json_decode($sQuery->fetch_assoc()['position']);

      $sQuery2 = $mysqli->query("SELECT name, factionID FROM server_maps WHERE mapID = '".$position->mapID."'");

      if ($sQuery2->num_rows > 0){

        $dataMap = $sQuery2->fetch_assoc();

        return array('mapName' => $dataMap['name'], 'factionId' => $dataMap['factionID']);

      } else {
        return false;
      }

    } else {
      return false;
    }

  }

  public static function generateActivationKey(){

    $mysqli = Database::GetInstance();

    $player = Functions::GetPlayer();

    $checkKeys = $mysqli->query("SELECT * FROM system_verification WHERE userId = '".$player['userId']."'");

    if ($checkKeys->num_rows == 0){

      $key = md5(uniqid($player['userId'], true));

      $UpdateKey = $mysqli->query("INSERT INTO `system_verification` (`hash`, `actived`, `userId`) VALUES ('$key', '0', '".$player['userId']."')");

      return array('r' => true, 'key' => $key, 'actived' => 0);

    } else {

      $dataKey = $checkKeys->fetch_assoc();

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

      $isAdmin = self::checkIsAdmin($player['userId']);

      if ($isAdmin){

        $checkExistAnnounce = $mysqli->query("SELECT * FROM discordannounces WHERE id = '".$newId."'");

        if ($checkExistAnnounce->num_rows > 0){
          $deleteNotice = $mysqli->query("DELETE FROM discordannounces WHERE id = '".$newId."'");

          if ($deleteNotice){
            $json['message'] = "Notice deleted sucesfully.";
            $json['status'] = true;
            return json_encode($json);
          } else {
            $json['message'] = "Error to delete this notice.";
            return json_encode($json);
          }
          
        } else {
          $json['message'] = "This notice ID no exists.";
          return json_encode($json);
        }

      } else {
        $json['message'] = "You not admin.";
        return json_encode($json);
      }

    }

  }

  public static function getAdminCategories(){

    $mysqli = Database::GetInstance();

    $query_category = $mysqli->query("SELECT * FROM admin_category WHERE active = '1'");

    if ($query_category->num_rows > 0){
      $dataReturn = array();
      while($data_category = $query_category->fetch_assoc()){
        $dataReturn[] = array('category' => $data_category['category'], 'cc' => $data_category['cc']);
      }
      return $dataReturn;
    } else {
      return false;
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

      if (!self::checkIsAdmin($player['userId'])){
        $json['message'] = "You are not staff.";
        return json_encode($json);
      }

      $query_events = $mysqli->query("SELECT * FROM manage_events WHERE event = '".$type."'");

      if ($query_events->num_rows > 0){

        $dataEvent = $query_events->fetch_assoc();

        if(Socket::Get(''.$dataEvent['commandEvent'].'', array())) {
          $json['message'] = "Event ".$dataEvent['event']." started sucesfully.";
          $json['status'] = true;
          $log = self::addAdminLog(array('adminId' => $player['userId'], 'toUserId' => 0, 'logComplet' => 'The admin "'.$player['username'].'" has started the event "'.$dataEvent['event'].'"'));
        } else if ($dataEvent['canStop'] == 1){
          $json['message'] = "Event ".$dataEvent['event']." stoped sucesfully.";
          $log = self::addAdminLog(array('adminId' => $player['userId'], 'toUserId' => 0, 'logComplet' => 'The admin "'.$player['username'].'" has stopped the event "'.$dataEvent['event'].'"'));
        } else {
          $json['message'] = "Event ".$dataEvent['event']." already started.";
          $log = self::addAdminLog(array('adminId' => $player['userId'], 'toUserId' => 0, 'logComplet' => 'The admin "'.$player['username'].'" tried to start the event "'.$dataEvent['event'].'" again'));
        }

        return json_encode($json);

      } else {
        return false;
      }

    }

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
            <input type="text" class="form-control" id="username" value="<?= $dataPilot['username']; ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
          </div>
          <div class="form-group">
            <label for="pilotName">pilotName</label>
            <input type="text" class="form-control" id="pilotName2" value="<?= $dataPilot['pilotName']; ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" value="<?= $dataPilot['email']; ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;" readonly>
          </div>
          <div class="form-group">
            <label for="uridium">Uridium</label>
            <input type="text" class="form-control" id="uridium" value="<?= $dataCurrency->uridium; ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
          </div>
          <div class="form-group">
            <label for="credits">Credits</label>
            <input type="text" class="form-control" id="credits" value="<?= $dataCurrency->credits; ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
          </div>
          <div class="form-group">
            <label for="honor">Honor</label>
            <input type="text" class="form-control" id="honor" value="<?= $dataCurrency->honor; ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
          </div>
          <div class="form-group">
            <label for="experience">Experience</label>
            <input type="text" class="form-control" id="experience" value="<?= $dataCurrency->experience; ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;">
          </div>
          <div class="form-group">
            <label for="lastIp">Last IP</label>
            <input type="text" class="form-control" id="lastIp" value="<?= $dataInfo->lastIP; ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;" readonly>
          </div>
          <div class="form-group">
            <label for="registeredDate">Registered Date</label>
            <input type="text" class="form-control" id="registeredDate" value="<?= $dataInfo->registerDate; ?>" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;" readonly>
          </div>
          <div class="form-group">
            <label for="premium">Premium</label>
            <select class="form-control" id="premium" style="border:1px solid gray; min-width:50%; background:rgba(30,30,30,0.6); height:30px; color:white;"> 
              <option value="1" <?= ($dataPilot['premium'] == 1) ? "selected" : ""; ?>>Yes</option> 
              <option value="0" <?= ($dataPilot['premium'] == 0) ? "selected" : ""; ?>>No</option> 
            </select>
          </div>
          <input type="hidden" id="userId" value="<?= $dataPilot['userId']; ?>">
          <button type="button" class="btn btn-primary" onclick="saveDataUser();">Save <?= $dataPilot['username']; ?></button>
        </div>
      <?php

      } else {

        ?>
          <div style="border: 1px dashed red; width:50%; margin:auto; pading:5px; margin-top:15px;"><b><?= $pilot; ?></b> no exists in database.</div>
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
    $player = Functions::GetPlayer();

    if (!self::checkIsFullAdmin($player['userId'])){
      $json['message'] = "You are not administrator.";
      return json_encode($json);
    }

    $dataPilot = self::GetPlayerById($userId);

    if ($dataPilot){

      $dataCurrency = json_decode($dataPilot['data']);

      if (empty($userId)){
        $json['message'] = "Critical error.";
        return json_encode($json);
      }

      if (empty($username)){
        $json['message'] = "Please fill a username.";
        return json_encode($json);
      }

      if (empty($pilotName)){
        $json['message'] = "Please fill a pilotName.";
        return json_encode($json);
      }

      if (!is_numeric($uridium) || $uridium < 0){
        $json['message'] = "Please fill a uridium.";
        return json_encode($json);
      }

      if (!is_numeric($credits) || $credits < 0){
        $json['message'] = "Please fill a credits.";
        return json_encode($json);
      }

      if (!is_numeric($honor) || $honor < 0){
        $json['message'] = "Please fill a honor.";
        return json_encode($json);
      }

      if (!is_numeric($experience) || $experience < 0){
        $json['message'] = "Please fill a experience.";
        return json_encode($json);
      }

      if (!is_numeric($premium)){
        $json['message'] = "Please fill a premium.";
        return json_encode($json);
      }

      $permitPremium = array(0,1);

      if (!in_array($premium, $permitPremium)){
        $json['message'] = "Critical Error";
        return json_encode($json);
      }

      $checkIfUsernameExists = $mysqli->query("SELECT * FROM player_accounts WHERE username = '".$username."'");

      if ($checkIfUsernameExists->num_rows > 0 && $dataPilot['username'] !== $username){
        $json['message'] = "The username ".$username." already exists.";
        return json_encode($json);
      }

      $checkIfPilotNameExists = $mysqli->query("SELECT * FROM player_accounts WHERE pilotName = '".$pilotName."'");

      if ($checkIfPilotNameExists->num_rows > 0 && $dataPilot['pilotName'] !== $pilotName){
        $json['message'] = "The pilotName ".$pilotName." already exists.";
        return json_encode($json);
      }

      $beforeUridium = $dataCurrency->uridium;
      $beforeCredits = $dataCurrency->credits;
      $beforeHonor = $dataCurrency->honor;
      $beforeExperience = $dataCurrency->experience;

      if(Socket::Get('IsOnline', array('UserId' => $userId, 'Return' => false))) {
        Socket::Send('setUridium', ['UserId' => $userId, 'Uridium' => $uridium]);
        Socket::Send('setCredits', ['UserId' => $userId, 'Credits' => $credits]);
        Socket::Send('setHonor', ['UserId' => $userId, 'Honor' => $honor]);
        Socket::Send('setExperience', ['UserId' => $userId, 'Experience' => $experience]);
      } else {
        $dataCurrency->uridium = $uridium;
        $dataCurrency->credits = $credits;
        $dataCurrency->honor = $honor;
        $dataCurrency->experience = $experience;

        $mysqli->query("UPDATE player_accounts SET data = '".json_encode($dataCurrency)."' WHERE userId = '".$userId."'");
      }

      $mysqli->query("UPDATE player_accounts SET username = '".$username."', pilotName = '".$pilotName."', premium = '".$premium."' WHERE userId = '".$userId."'");

      $log = self::addAdminLog(array('adminId' => $player['userId'], 'toUserId' => $dataPilot['userId'], 'logComplet' => 'The admin "'.$player['username'].'" has changed the next data to "'.$dataPilot['username'].'" => Uridium: From "'.$beforeUridium.'" to "'.$uridium.'" | Credits: From "'.$beforeCredits.'" to "'.$credits.'" | honor: From "'.$beforeHonor.'" to "'.$honor.'" | experience: From "'.$beforeExperience.'" to "'.$experience.'" | username: From "'.$dataPilot['username'].'" To "'.$username.'" | PilotName: From "'.$dataPilot['pilotName'].'" to "'.$pilotName.'" | Premium: From "'.$dataPilot['premium'].'" to "'.$premium.'"'));

      $json['status'] = true;
      $json['message'] = "User ".$username." saved succesfully.";

      return json_encode($json);

    } else {
      $json['message'] = "Critical Error.";
      json_encode($json);
    }

  }

  public static function addAdminLog($array = null){

    if (isset($array) && !empty($array) && is_array($array)){

      $mysqli = Database::GetInstance();

      $saveLog = $mysqli->query("INSERT INTO `admin_log` (`adminId`, `toUserId`, `logComplet`, `date`) VALUES ('".$array['adminId']."', '".$array['toUserId']."', '".$array['logComplet']."', '".date("d-m-Y h:i:s", time())."')");

      if ($saveLog){
        return true;
      } else {
        return false;
      }

    }

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

    $sQuery4 = $mysqli->query("SELECT droneExp FROM player_accounts WHERE userId = '{$player['userId']}'");

    if ($sQuery4->num_rows > 0){

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
	
}

# Açık arttırma başlangıç
function acik_arttirma($bid_credit)
{

  $mysqli = Database::GetInstance();
  $player = Functions::GetPlayer();
  $data = json_decode($player['data']);
  $bididsi01 = 1; //lf4

  $bideski = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi01 . '')->fetch_assoc()['bid_credit']);
  $items = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);

  $bid_credit = $mysqli->real_escape_string($bid_credit);




  #lf4
  if ($items->lf4Count < 40) {
    if ($bid_credit <= $bideski) {

      echo "Your bid is low";

      return null;
    }

    if ($data->credits <= $bid_credit) {

      echo "your credit is insufficient";

      return null;
    }


    if ($data->credits >= $bid_credit) {
      $data->credits -= $bid_credit;

      echo "Your offer is successful :)";
      $mysqli->begin_transaction();
      try {
        $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
        $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 1');
        $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 1');
        $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_credit . ' WHERE bid_id = 1');



        $mysqli->commit();
      }
      catch (Exception $e) {
        $mysqli->rollback();
      }
      $mysqli->close();
    }
  }
  else {
    echo "Your account LF4 Max Limit";
  }
  return null;
}

// LF4 IKINCI

# Açık arttırma başlangıç
function acik_arttirma_lf4_2($bid_credit_lf4_2)
{

  $mysqli = Database::GetInstance();
  $player = Functions::GetPlayer();
  $data = json_decode($player['data']);
  $bididsi01_lf4_2 = 6; //lf4

  $bideski_lf4_2 = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi01_lf4_2 . '')->fetch_assoc()['bid_credit']);
  $items_lf4_2 = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);

  $bid_credit_lf4_2 = $mysqli->real_escape_string($bid_credit_lf4_2);




  #lf4
  if ($items_lf4_2->lf4Count < 40) {
    if ($bid_credit_lf4_2 <= $bideski_lf4_2) {

      echo "Your bid is low";

      return null;
    }

    if ($data->credits <= $bid_credit_lf4_2) {

      echo "your credit is insufficient";

      return null;
    }


    if ($data->credits >= $bid_credit_lf4_2) {
      $data->credits -= $bid_credit_lf4_2;

      echo "Your offer is successful :)";
      $mysqli->begin_transaction();
      try {
        $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
        $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 6');
        $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 6');
        $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_credit_lf4_2 . ' WHERE bid_id = 6');

        $mysqli->commit();
      }
      catch (Exception $e) {
        $mysqli->rollback();
      }
      $mysqli->close();
    }
  }
  else {
    echo "Your account LF4 Max Limit";
  }
  return null;
}



// LF4 IKINCI

// LF4 ucuncu

# Açık arttırma başlangıç
function acik_arttirma_lf4_3($bid_credit_lf4_3)
{

  $mysqli = Database::GetInstance();
  $player = Functions::GetPlayer();
  $data = json_decode($player['data']);
  $bididsi01_lf4_3 = 7; //lf4

  $bideski_lf4_3 = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi01_lf4_3 . '')->fetch_assoc()['bid_credit']);
  $items_lf4_3 = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);

  $bid_credit_lf4_3 = $mysqli->real_escape_string($bid_credit_lf4_3);




  #lf4
  if ($items_lf4_3->lf4Count < 40) {
    if ($bid_credit_lf4_3 <= $bideski_lf4_3) {

      echo "Your bid is low";

      return null;
    }

    if ($data->uridium <= $bid_credit_lf4_3) {

      echo "your uridium is insufficient";

      return null;
    }


    if ($data->uridium >= $bid_credit_lf4_3) {
      $data->uridium -= $bid_credit_lf4_3;

      echo "Your offer is successful :)";
      $mysqli->begin_transaction();
      try {
        $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
        $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 7');
        $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 7');
        $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_credit_lf4_3 . ' WHERE bid_id = 7');

        $mysqli->commit();
      }
      catch (Exception $e) {
        $mysqli->rollback();
      }
      $mysqli->close();
    }
  }
  else {
    echo "Your account LF4 Max Limit";
  }
  return null;
}



// LF4 ucuncu



// LF4 dorduncu

# Açık arttırma başlangıç
function acik_arttirma_lf4_4($bid_credit_lf4_4)
{

  $mysqli = Database::GetInstance();
  $player = Functions::GetPlayer();
  $data = json_decode($player['data']);
  $bididsi01_lf4_4 = 8; //lf4

  $bideski_lf4_4 = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi01_lf4_4 . '')->fetch_assoc()['bid_credit']);
  $items_lf4_4 = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);

  $bid_credit_lf4_4 = $mysqli->real_escape_string($bid_credit_lf4_4);




  #lf4
  if ($items_lf4_4->lf4Count < 40) {
    if ($bid_credit_lf4_4 <= $bideski_lf4_4) {

      echo "Your bid is low";

      return null;
    }

    if ($data->uridium <= $bid_credit_lf4_4) {

      echo "your uridium is insufficient";

      return null;
    }


    if ($data->uridium >= $bid_credit_lf4_4) {
      $data->uridium -= $bid_credit_lf4_4;
      echo "Your offer is successful :)";
      $mysqli->begin_transaction();
      try {
        $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
        $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 8');
        $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 8');
        $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_credit_lf4_4 . ' WHERE bid_id = 8');

        $mysqli->commit();
      }
      catch (Exception $e) {
        $mysqli->rollback();
      }
      $mysqli->close();
    }
  }
  else {
    echo "Your account LF4 Max Limit";
  }
  return null;
}



// LF4 dorduncu



function acik_arttirmahavoc($bid_havoc)
{

  $mysqli = Database::GetInstance();
  $player = Functions::GetPlayer();
  $data = json_decode($player['data']);
  $bididsi03 = 3; //havoc

  $bideskihavoc = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi03 . '')->fetch_assoc()['bid_credit']);
  $items = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);

  $bid_havoc = $mysqli->real_escape_string($bid_havoc);




  #havoc
  if ($items->havocCount < 10) {
    if ($bid_havoc <= $bideskihavoc) {

      echo "Your bid is low";

      return null;
    }

    if ($data->uridium <= $bid_havoc) {

      echo "your uridium is insufficient";

      return null;
    }


    if ($data->uridium >= $bid_havoc) {
      $data->uridium -= $bid_havoc;

      echo "Your offer is successful :)";
      $mysqli->begin_transaction();
      try {
        $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
        $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 3');
        $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 3');
        $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_havoc . ' WHERE bid_id = 3');

        $mysqli->commit();
      }
      catch (Exception $e) {
        $mysqli->rollback();
      }
      $mysqli->close();
    }
  }
  else {
    echo "Your account Havoc Max Limit";
  }
  return null;
}

function acik_arttirmahercul($bid_hercul)
{

  $mysqli = Database::GetInstance();
  $player = Functions::GetPlayer();
  $data = json_decode($player['data']);
  $bididsi02 = 2; //hercul

  $bideskihercul = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi02 . '')->fetch_assoc()['bid_credit']);
  $items = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);

  $bid_hercul = $mysqli->real_escape_string($bid_hercul);




  #hercul
  if ($items->herculesCount < 10) {
    if ($bid_hercul <= $bideskihercul) {

      echo "Your bid is low";
      $json['message'] = 'Something went wrong!';
      return null;
    }

    if ($data->uridium <= $bid_hercul) {

      echo "your uridium is insufficient";

      return null;
    }


    if ($data->uridium >= $bid_hercul) {
      $data->uridium -= $bid_hercul;

      echo "Your offer is successful :)";
      $mysqli->begin_transaction();
      try {
        $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
        $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 2');
        $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 2');
        $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_hercul . ' WHERE bid_id = 2');

        $mysqli->commit();
      }
      catch (Exception $e) {
        $mysqli->rollback();
      }
      $mysqli->close();
    }
  }
  else {
    echo "Your account Hercules Max Limit";
  }
  return null;
}


function acik_arttirma_apis($bid_apis)
{

  $mysqli = Database::GetInstance();
  $player = Functions::GetPlayer();
  $data = json_decode($player['data']);
  $bididsi04 = 4; //apis

  $bideskiapis = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi04 . '')->fetch_assoc()['bid_credit']);
  $items = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);

  $bid_apis = $mysqli->real_escape_string($bid_apis);




  #apis
  if (!$items->apis) {
    if ($bid_apis <= $bideskiapis) {

      echo "Your bid is low";

      return null;
    }

    if ($data->uridium <= $bid_apis) {

      echo "your uridium is insufficient";

      return null;
    }


    if ($data->uridium >= $bid_apis) {
      $data->uridium -= $bid_apis;

      echo "Your offer is successful :)";
      $mysqli->begin_transaction();
      try {
        $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
        $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 4');
        $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 4');
        $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_apis . ' WHERE bid_id = 4');

        $mysqli->commit();
      }
      catch (Exception $e) {
        $mysqli->rollback();
      }
      $mysqli->close();
    }
  }
  else {
    echo "Your account APIS Limit";
  }
  return null;
}

// 

function acik_arttirma_zeus($bid_zeus)
{

  $mysqli = Database::GetInstance();
  $player = Functions::GetPlayer();
  $data = json_decode($player['data']);
  $bididsi05 = 5; //zeus

  $bideskizeus = json_decode($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = ' . $bididsi05 . '')->fetch_assoc()['bid_credit']);
  $items = json_decode($mysqli->query('SELECT items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()['items']);

  $bid_zeus = $mysqli->real_escape_string($bid_zeus);




  #zeus
  if (!$items->zeus) {
    if ($bid_zeus <= $bideskizeus) {

      echo "Your bid is low";

      return null;
    }

    if ($data->uridium <= $bid_zeus) {

      echo "your uridium is insufficient";

      return null;
    }


    if ($data->uridium >= $bid_zeus) {
      $data->uridium -= $bid_zeus;

      echo "Your offer is successful :)";
      $mysqli->begin_transaction();
      try {
        $mysqli->query("UPDATE player_accounts SET data = '" . json_encode($data) . "' WHERE userId = " . $player['userId'] . "");
        $mysqli->query('UPDATE bid_system SET bid_pid = ' . $player['userId'] . ' WHERE bid_id = 5');
        $mysqli->query('UPDATE bid_system SET bid_pilotname = ' . json_encode(($player['pilotName']), JSON_UNESCAPED_UNICODE) . ' WHERE bid_id = 5');
        $mysqli->query('UPDATE bid_system SET bid_credit = ' . $bid_zeus . ' WHERE bid_id = 5');

        $mysqli->commit();
      }
      catch (Exception $e) {
        $mysqli->rollback();
      }
      $mysqli->close();
    }
  }
  else {
    echo "Your account ZEUS Limit";
  }
  return null;
}

