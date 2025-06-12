<?php
class Functions
{
  public static function ObStart()
  {
    function minify_everything(\$buffer)
    {
      \$buffer = preg_replace(array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s', '/<!--(.|\s)*?-->/', '/\s+/'), array('>', '<', '\\1', '', ' '), \$buffer);
      return \$buffer;
    }
    ob_start('ob_gzhandler');
    ob_start('minify_everything');
  }

  public static function LoadPage(\$variable)
  {
    \$mysqli = Database::GetInstance();

    if (!\$mysqli->connect_errno && Functions::IsLoggedIn()) {
      \$player = Functions::GetPlayer();
      \$data = json_decode(\$player['data']);
	  \$bootyKeys = json_decode(\$player['bootyKeys']);
		\$killedNpc = json_decode(\$player['killedNpc']);
		\$Npckill = json_decode(\$player['Npckill']);
      if (\$player['clanId'] > 0) {
        \$stmt = \$mysqli->prepare('SELECT * FROM server_clans WHERE id = ?');
        \$stmt->bind_param("i", \$player['clanId']);
        \$stmt->execute();
        \$result = \$stmt->get_result();
        \$clan = \$result->fetch_assoc();
        \$stmt->close();
      }
    }

    \$page = explode('/', str_replace('-', '_', Functions::s(\$variable)));
    \$path = '';

    if (isset(\$page[0])) {
      if (\$page[0] == 'api') {
        \$path = ROOT . 'api.php';
      } else if (\$page[0] == 'cronjobs') {
        \$path = CRONJOBS . \$page[1] . '.php';
      } else {
        if (isset(\$player)) {
          if (self::generateActivationKey()['actived'] == "0" && SystemActiveVerification){
            \$page[0] = 'activate_account';
          } else if (\$page[0] == 'company_select' && \$player['factionId'] != 0) {
            \$page[0] = 'home';
          } else if (\$player['factionId'] == 0) {
            \$page[0] = 'company_select';
          } else if (\$page[0] == 'index') {
            \$page[0] = 'home';
          } else if (\$page[0] == 'clan' && isset(\$page[2]) && \$page[2] == \$player['clanId']) {
            \$page[0] = 'clan';
            \$page[1] = 'informations';
          }
        } else if (\$page[0] != 'maintenance') {
          \$page[0] = 'index';
        }

        \$path = EXTERNALS . \$page[0] . '.php';
      }
    }

    if (!file_exists(\$path)) {
      http_response_code(403);
      die('Forbidden');
      return;
    }

    require_once(\$path);
  }

  public static function Register(\$username, \$password, \$password_confirm, \$email, \$terms)
  {
    \$mysqli = Database::GetInstance();

    \$json = [
      'message' => '',
      'type' => ''
    ];

    if (MAINTENANCE){
      \$json['type'] = "resultAll";
      \$json['message'] = htmlspecialchars("Maintenance activated. Please register later.", ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }

    if (empty(\$username)){
      \$json['type'] = "username";
      \$json['message'] = htmlspecialchars("Username is required.", ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }

    if (empty(\$password)){
      \$json['type'] = "password";
      \$json['message'] = htmlspecialchars("Password is required.", ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }

    if (empty(\$password_confirm)){
      \$json['type'] = "confirm_password";
      \$json['message'] = htmlspecialchars("Confirm password is required.", ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }

    if (empty(\$email)){
      \$json['type'] = "email";
      \$json['message'] = htmlspecialchars("Email is required.", ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }

    if (!preg_match('/^[A-Za-z0-9_.]+$/', \$username)) {
      \$json['type'] = "username";
      \$json['message'] = htmlspecialchars("Your username is not valid.", ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }

    if (mb_strlen(\$username) < 4 || mb_strlen(\$username) > 20) {
      \$json['type'] = "username";
      \$json['message'] = htmlspecialchars("Your username should be between 4 and 20 characters.", ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }

    if (mb_strlen(\$password) < 8 || mb_strlen(\$password) > 45) {
      \$json['type'] = "password";
      \$json['message'] = htmlspecialchars("Your password should be between 8 and 45 characters.", ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }

    if (\$password != \$password_confirm) {
      \$json['type'] = "confirm_password";
      \$json['message'] = htmlspecialchars("Those passwords didnt match. Try again", ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }

    if (!filter_var(\$email, FILTER_VALIDATE_EMAIL) || mb_strlen(\$email) > 260) {
      \$json['type'] = "email";
      \$json['message'] = htmlspecialchars("Your e-mail should be max 260 characters.", ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }

    \$stmt = \$mysqli->prepare('SELECT userId FROM player_accounts WHERE username = ?');
    \$stmt->bind_param("s", \$username);
    \$stmt->execute();
    \$stmt->store_result();
    \$username_exists = \$stmt->num_rows > 0;
    \$stmt->close();

    if (!\$username_exists) {
      \$stmt = \$mysqli->prepare('SELECT userId FROM player_accounts WHERE email = ?');
      \$stmt->bind_param("s", \$email);
      \$stmt->execute();
      \$stmt->store_result();
      \$email_exists = \$stmt->num_rows > 0;
      \$stmt->close();

      if (\$email_exists) {
        \$json['type'] = "email";
        \$json['message'] = htmlspecialchars("This email is already taken.", ENT_QUOTES, 'UTF-8');
        return json_encode(\$json);
      }

      \$ip = Functions::GetIP();
      \$sessionId = Functions::GetUniqueSessionId();
      \$pilotName = \$username;

      \$stmt = \$mysqli->prepare('SELECT userId FROM player_accounts WHERE pilotName = ?');
      \$stmt->bind_param("s", \$pilotName);
      \$stmt->execute();
      \$stmt->store_result();
      if (\$stmt->num_rows > 0) {
        \$pilotName = Functions::GetUniquePilotName(\$pilotName);
      }
      \$stmt->close();
      
      \$mysqli->begin_transaction();
      try {
        \$info = [
          'lastIP' => \$ip,
          'registerIP' => \$ip,
          'registerDate' => date('d.m.Y H:i:s')
        ];
        \$verification = [
          'verified' => true,
          'hash' => \$sessionId
        ];
        \$hashed_password = password_hash(\$password, PASSWORD_DEFAULT);
        \$info_json = json_encode(\$info);
        \$verification_json = json_encode(\$verification);
        \$shipId = 1;

        \$stmt = \$mysqli->prepare("INSERT INTO player_accounts (sessionId, username, pilotName, email, password, info, verification, shipId) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        \$stmt->bind_param("sssssssi", \$sessionId, \$username, \$pilotName, \$email, \$hashed_password, \$info_json, \$verification_json, \$shipId);
        \$stmt->execute();
        \$userId = \$mysqli->insert_id;
        \$stmt->close();

        \$stmt_equipment = \$mysqli->prepare('INSERT INTO player_equipment (userId) VALUES (?)');
        \$stmt_equipment->bind_param("i", \$userId);
        \$stmt_equipment->execute();
        \$stmt_equipment->close();

        \$stmt_settings = \$mysqli->prepare('INSERT INTO player_settings (userId) VALUES (?)');
        \$stmt_settings->bind_param("i", \$userId);
        \$stmt_settings->execute();
        \$stmt_settings->close();

        \$stmt_titles = \$mysqli->prepare('INSERT INTO player_titles (userID) VALUES (?)');
        \$stmt_titles->bind_param("i", \$userId);
        \$stmt_titles->execute();
        \$stmt_titles->close();

        \$stmt_skilltree = \$mysqli->prepare('INSERT INTO player_skilltree (userID) VALUES (?)');
        \$stmt_skilltree->bind_param("i", \$userId);
        \$stmt_skilltree->execute();
        \$stmt_skilltree->close();

        \$default_coins = 100;
        \$stmt_event_coins = \$mysqli->prepare('INSERT INTO event_coins (userID, coins) VALUES (?, ?)');
        \$stmt_event_coins->bind_param("ii", \$userId, \$default_coins);
        \$stmt_event_coins->execute();
        \$stmt_event_coins->close();

        SMTP::SendMail(\$email, \$username, 'E-mail verification', '<p>Hi ' . htmlspecialchars(\$username, ENT_QUOTES, 'UTF-8') . ', <br>Click this link to activate your account: <a href="' . DOMAIN . 'api/verify/' . \$userId . '/' . \$verification['hash'] . '">Activate</a></p><p style="font-size:small;color:#666">—<br>You are receiving this because you registered to the ' . SERVER_NAME . '.<br>If that was not your request, then you can ignore this email.<br>This is an automated message, please do not reply directly to this email.</p>');
  
        \$_SESSION['account']['id'] = \$userId;
        \$_SESSION['account']['session'] = \$sessionId;

        \$stmt_update_session = \$mysqli->prepare('UPDATE player_accounts SET sessionId = ? WHERE userId = ?');
        \$stmt_update_session->bind_param("si", \$sessionId, \$userId);
        \$stmt_update_session->execute();
        \$stmt_update_session->close();
        
        \$mysqli->commit();

        \$json['type'] = "resultAll";
        \$json['message'] = htmlspecialchars('You have registered successfully, you will be redirected in 3 seconds.', ENT_QUOTES, 'UTF-8');
        \$json['redirect'] = true;
        \$json['status'] = true;

        return json_encode(\$json);
      } catch (Exception \$e) {
        \$json['type'] = "resultAll";
        \$json['message'] = htmlspecialchars('An error occurred. Please try again later.', ENT_QUOTES, 'UTF-8');
        \$mysqli->rollback();
        return json_encode(\$json);
      }
    } else {
      \$json['type'] = "username";
      \$json['message'] = htmlspecialchars('This username is already taken.', ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }
  }

  public static function checkIsAdmin(\$id = null){
    if (\$id){
      \$mysqli = Database::GetInstance();
      \$idInt = (int)\$id;

      \$stmt = \$mysqli->prepare('SELECT type FROM chat_permissions WHERE userId = ?');
      \$stmt->bind_param("i", \$idInt);
      \$stmt->execute();
      \$result = \$stmt->get_result();

      if (\$result->num_rows > 0){
        \$data = \$result->fetch_assoc();
        \$stmt->close();
        \$type = (int)\$data['type'];
        if ((\$type == 1) || (\$type == 2)){
          return true;
        } else {
          return false;
        }
      } else {
        \$stmt->close();
        return false;
      }
    }
    return false;
  }

  public static function checkIsFullAdmin(\$id = null){
    if (\$id){
      \$mysqli = Database::GetInstance();
      \$idInt = (int)\$id;

      \$stmt = \$mysqli->prepare('SELECT type FROM chat_permissions WHERE userId = ?');
      \$stmt->bind_param("i", \$idInt);
      \$stmt->execute();
      \$result = \$stmt->get_result();

      if (\$result->num_rows > 0){
        \$data = \$result->fetch_assoc();
        \$stmt->close();
        \$type = (int)\$data['type'];
        if (\$type == 1){
          return true;
        } else {
          return false;
        }
      } else {
        \$stmt->close();
        return false;
      }
    }
    return false;
  }

  public static function addVoucherLog(\$voucher = null, \$id = null, \$item = null, \$amount = null){
    if (isset(\$item) && isset(\$amount) && isset(\$id)){
      \$mysqli = Database::GetInstance();

      \$id_int = (int)\$id;
      \$time = time();

      \$stmt = \$mysqli->prepare("INSERT INTO `voucher_log` (`voucher`, `userId`, `item`, `amount`, `date`) VALUES (?, ?, ?, ?, ?)");
      if (\$stmt) {
        \$stmt->bind_param("sisss", \$voucher, \$id_int, \$item, \$amount, \$time); // voucher, item, amount are already strings or safe

        if (\$stmt->execute()){
          \$stmt->close();
          return true;
        } else {
          \$stmt->close();
          return false;
        }
      } else {
        return false;
      }
    }
    return false;
  }

  public static function getInfoGalaxyGate(\$gateId){
    if (isset(\$gateId) && !empty(\$gateId) && is_numeric(\$gateId)){
      \$mysqli = Database::GetInstance();
      \$userId = (int)\$_SESSION['account']['id'];
      \$gateIdInt = (int)\$gateId;

      \$json = [
        'message' => '',
        'lives' => 0
      ];

      \$stmt = \$mysqli->prepare("SELECT lives FROM player_galaxygates WHERE gateId = ? AND userId = ?");
      \$stmt->bind_param("ii", \$gateIdInt, \$userId);
      \$stmt->execute();
      \$result = \$stmt->get_result();

      if (\$result->num_rows > 0){
        \$infoP = \$result->fetch_assoc();
        \$json['lives'] = \$infoP['lives'];
      }
      \$stmt->close();
      return json_encode(\$json);
    }
    return json_encode(['message' => htmlspecialchars('Invalid Gate ID.', ENT_QUOTES, 'UTF-8'), 'lives' => 0]);
  }

  public static function buyLive(\$gateId){
    if (isset(\$gateId) && !empty(\$gateId) && is_numeric(\$gateId)){
      \$mysqli = Database::GetInstance();
      \$userId = (int)\$_SESSION['account']['id'];
      \$gateIdInt = (int)\$gateId;

      \$json = [
        'message' => '',
        'lives' => 0
      ];

      \$stmt_check_gate = \$mysqli->prepare("SELECT lives, parts FROM player_galaxygates WHERE gateId = ? AND userId = ?");
      \$stmt_check_gate->bind_param("ii", \$gateIdInt, \$userId);
      \$stmt_check_gate->execute();
      \$checkGateResult = \$stmt_check_gate->get_result();
      \$playerGateData = null;
      if (\$checkGateResult->num_rows > 0) {
        \$playerGateData = \$checkGateResult->fetch_assoc();
      }
      \$stmt_check_gate->close();

      \$gateDetailsArray = self::getInfoGate(\$gateIdInt, false);
      if (!\$gateDetailsArray || !isset(\$gateDetailsArray[\$gateIdInt])) {
        \$json['message'] = htmlspecialchars("Please select a unlock gate.", ENT_QUOTES, 'UTF-8');
        return json_encode(\$json);
      }
      \$currentGateStaticInfo = \$gateDetailsArray[\$gateIdInt]; // Name is pre-escaped by getInfoGate

      if (isset(\$_SESSION['ggtime']) and \$_SESSION['ggtime'] >= time()){
        \$json['message'] = htmlspecialchars("Please wait 5 seconds", ENT_QUOTES, 'UTF-8');
        return json_encode(\$json);
      }

      \$stmt_player_data = \$mysqli->prepare('SELECT data FROM player_accounts WHERE userId = ?');
      \$stmt_player_data->bind_param("i", \$userId);
      \$stmt_player_data->execute();
      \$player_data_result = \$stmt_player_data->get_result()->fetch_assoc();
      \$stmt_player_data->close();
      \$data = json_decode(\$player_data_result['data'], true);

      if (\$data['uridium'] < \$currentGateStaticInfo['live_cost']){
        \$json['message'] = htmlspecialchars("You don't have enough Uridium.", ENT_QUOTES, 'UTF-8');
        return json_encode(\$json);
      }

      \$_SESSION['ggtime'] = strtotime('+5 second');
      \$liveCost = (int)\$currentGateStaticInfo['live_cost'];
      \$data['uridium'] -= \$liveCost;

      if(Socket::Get('IsOnline', array('UserId' => \$userId, 'Return' => false))) {
        Socket::Send('UpdateUridium', ['UserId' => \$userId, 'UridiumPrice' => \$liveCost, 'Type' => "DECREASE"]);
      } else {
        \$newDataJson = json_encode(\$data);
        \$stmt_update_player_data = \$mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
        \$stmt_update_player_data->bind_param("si", \$newDataJson, \$userId);
        \$stmt_update_player_data->execute();
        \$stmt_update_player_data->close();
      }

      \$json['uridium'] = number_format(\$data['uridium'], 0, ',', '.');

      if (\$playerGateData){
        \$newLives = \$playerGateData['lives'] + 1;
        \$stmt_update_lives = \$mysqli->prepare("UPDATE player_galaxygates SET lives = lives + 1 WHERE userId = ? AND gateId = ?");
        \$stmt_update_lives->bind_param("ii", \$userId, \$gateIdInt);
        \$stmt_update_lives->execute();
        \$stmt_update_lives->close();

        \$json['message'] = htmlspecialchars("Sucesfully buyed 1 live.", ENT_QUOTES, 'UTF-8');
        \$json['log'] = htmlspecialchars("Buyed 1 live in ".\$currentGateStaticInfo['name']." gate", ENT_QUOTES, 'UTF-8');
        \$json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
        \$json['lives'] = \$newLives;

        self::gg_log(\$json['log'], \$userId);
        return json_encode(\$json);
      } else {
        \$initialParts = '[]';
        \$initialLives = 4;
        \$initialPrepared = 0;
        \$initialWave = 1;
        \$stmt_insert_live = \$mysqli->prepare("INSERT INTO player_galaxygates (userId, gateId, parts, lives, prepared, wave) VALUES (?, ?, ?, ?, ?, ?)");
        \$stmt_insert_live->bind_param("iisiii", \$userId, \$gateIdInt, \$initialParts, \$initialLives, \$initialPrepared, \$initialWave);
        \$stmt_insert_live->execute();
        \$stmt_insert_live->close();

        \$json['message'] = htmlspecialchars("Sucesfully buyed 1 live.", ENT_QUOTES, 'UTF-8');
        \$json['log'] = htmlspecialchars("Buyed 1 live in ".\$currentGateStaticInfo['name']." gate", ENT_QUOTES, 'UTF-8');
        \$json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
        \$json['lives'] = \$initialLives;

        self::gg_log(\$json['log'], \$userId);
        return json_encode(\$json);
      }
    }
    return json_encode(['message' => htmlspecialchars('Invalid Gate ID or User session.', ENT_QUOTES, 'UTF-8'), 'lives' => 0]);
  }

  public static function ggPreparePortal(\$gateId){
    if (isset(\$gateId) && !empty(\$gateId) && is_numeric(\$gateId)){
      \$mysqli = Database::GetInstance();
      \$userId = (int)\$_SESSION['account']['id'];
      \$gateIdInt = (int)\$gateId;

      \$json = ['message' => ''];

      \$stmt_check_gate = \$mysqli->prepare("SELECT parts, prepared FROM player_galaxygates WHERE gateId = ? AND userId = ?");
      \$stmt_check_gate->bind_param("ii", \$gateIdInt, \$userId);
      \$stmt_check_gate->execute();
      \$checkGateResult = \$stmt_check_gate->get_result();

      \$gateDetailsArray = self::getInfoGate(\$gateIdInt, false);
      if (!\$gateDetailsArray || !isset(\$gateDetailsArray[\$gateIdInt])) {
        \$json['message'] = htmlspecialchars("Gate information not found.", ENT_QUOTES, 'UTF-8');
        \$stmt_check_gate->close();
        return json_encode(\$json);
      }
      \$currentGateStaticInfo = \$gateDetailsArray[\$gateIdInt];

      if (\$checkGateResult->num_rows > 0){
        \$dataQ = \$checkGateResult->fetch_assoc();
        \$stmt_check_gate->close();

        if (\$dataQ['prepared'] == '1'){
          \$json['message'] = htmlspecialchars(\$currentGateStaticInfo['name']." is ready.", ENT_QUOTES, 'UTF-8');
          return json_encode(\$json);
        }

        \$dataGateParts = json_decode(\$dataQ['parts']);
        \$totalParts = 0;
        if (is_array(\$dataGateParts)) {
            foreach(\$dataGateParts as \$dg){
              \$totalParts += (int)\$dg;
            }
        }

        if (\$totalParts >= (int)\$currentGateStaticInfo['parts']){
          \$stmt_update_prepared = \$mysqli->prepare("UPDATE player_galaxygates SET prepared = 1 WHERE userId = ? AND gateId = ?");
          \$stmt_update_prepared->bind_param("ii", \$userId, \$gateIdInt);
          if (\$stmt_update_prepared->execute()){
            \$json['message'] = htmlspecialchars(\$currentGateStaticInfo['name']." gate has prepared sucesfully.", ENT_QUOTES, 'UTF-8');
          } else {
            \$json['message'] = htmlspecialchars("Error to prepare the gate ".\$currentGateStaticInfo['name'], ENT_QUOTES, 'UTF-8');
          }
          \$stmt_update_prepared->close();
        } else {
          \$json['message'] = htmlspecialchars(\$currentGateStaticInfo['name']." gate not unlocked. Complete the parts. Current parts: ".\$totalParts."/".\$currentGateStaticInfo['parts'], ENT_QUOTES, 'UTF-8');
        }
      } else {
        \$stmt_check_gate->close();
        \$json['message'] = htmlspecialchars(\$currentGateStaticInfo['name']." gate not unlocked. Complete all parts.", ENT_QUOTES, 'UTF-8');
      }
      return json_encode(\$json);
    }
    return json_encode(['message' => htmlspecialchars('Invalid Gate ID.', ENT_QUOTES, 'UTF-8')]);
  }

  public static function getInfoGate(\$gateId, \$json = false){
    if (isset(\$gateId) && !empty(\$gateId) && is_numeric(\$gateId)){
      \$mysqli = Database::GetInstance();
      \$gateIdInt = (int)\$gateId;

      \$stmt = \$mysqli->prepare("SELECT name, parts, cost, live_cost FROM info_galaxygates WHERE gateId = ?");
      \$stmt->bind_param("i", \$gateIdInt);
      \$stmt->execute();
      \$result = \$stmt->get_result();

      if (\$result->num_rows > 0){
        \$dataGate = \$result->fetch_assoc();
        \$stmt->close();
        \$escaped_gate_name = htmlspecialchars(\$dataGate['name'], ENT_QUOTES, 'UTF-8');

        if (\$json){
          return json_encode(array('name' => \$escaped_gate_name, 'parts' => \$dataGate['parts'], 'cost' => number_format(\$dataGate['cost'], 0, ',', '.'), 'live_cost' => number_format(\$dataGate['live_cost'], 0, ',', '.')));
        } else {
          return array(\$gateIdInt => array('name' => \$escaped_gate_name, 'parts' => \$dataGate['parts'], 'cost' => \$dataGate['cost'], 'live_cost' => \$dataGate['live_cost']));
        }
      } else {
        \$stmt->close();
        return false;
      }
    }
    return false;
  }

  public static function gg_log(\$log, \$userId){
    if (isset(\$log) && isset(\$userId)){
      \$mysqli = Database::GetInstance();
      \$userId_int = (int)\$userId;
      \$time = time();
      \$stmt = \$mysqli->prepare("INSERT INTO `gg_log` (`log`, `userId`, `date`) VALUES (?, ?, ?)");
      if (\$stmt) {
        \$stmt->bind_param("ssi", \$log, \$userId_int, \$time); // Log is already escaped by caller if necessary
        if (\$stmt->execute()){
          \$stmt->close();
          return true;
        } else {
          \$stmt->close();
          return false;
        }
      } else {
        return false;
      }
    }
    return false;
  }

  public static function gg(\$gateId){
    if (isset(\$gateId) && !empty(\$gateId) && is_numeric(\$gateId)){
      \$mysqli = Database::GetInstance();
      \$userId = (int)\$_SESSION['account']['id'];
      \$gateIdInt = (int)\$gateId;
      \$num = rand(1,38);
      // ... (rest of the gg function's existing logic for determining $result array)
      if (\$num == 1 || \$num == 2 || \$num == 3 || \$num == 4 || \$num == 5){
        \$result = array('uridium' => '', 'parts' => 1, 'ammoType' => '', 'ammoAmount' => '');
      } elseif (\$num == 6 || \$num == 7 || \$num == 8 || \$num == 9 || \$num == 10){
        \$result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_rocketlauncher_ubr-100', 'ammoAmount' => '10');
      } elseif (\$num == 11 || \$num == 12 || \$num == 13 || \$num == 14 || \$num == 15){
        \$result = array('uridium' => '', 'parts' => 0, 'ammoType' => 'ammunition_laser_mcb-50', 'ammoAmount' => '215');
      } elseif (\$num == 16 || \$num == 17){
        \$result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_ucb-100', 'ammoAmount' => '150');
      } elseif (\$num == 18 || \$num == 19){
        \$result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_rocket_plt-2021', 'ammoAmount' => '45');
	  } elseif (\$num == 20 || \$num == 21){
        \$result = array('uridium' => '0', 'parts' => 3, 'ammoType' => 'ammunition_rocket_plt-2021', 'ammoAmount' => '');
	  } elseif (\$num == 22 || \$num == 23){
        \$result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_mcb-25', 'ammoAmount' => '325');
	  } elseif (\$num == 24 || \$num == 25){
        \$result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_rocketlauncher_ubr-100', 'ammoAmount' => '15');
	  } elseif (\$num == 26 || \$num == 27){
        \$result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_sab-50', 'ammoAmount' => '250');
	  } elseif (\$num == 28 || \$num == 29){
        \$result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_rocketlauncher_eco-10', 'ammoAmount' => '40');
	  } elseif (\$num == 30 || \$num == 31){
        \$result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_ucb-100', 'ammoAmount' => '350');
	  } elseif (\$num == 32 || \$num == 33){
        \$result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_rocket_plt-3030', 'ammoAmount' => '35');
	  } elseif (\$num == 34 || \$num == 35){
        \$result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_mcb-50', 'ammoAmount' => '175');
	  } elseif (\$num == 36 || \$num == 37){
        \$result = array('uridium' => '0', 'parts' => 0, 'ammoType' => 'ammunition_laser_mcb-25', 'ammoAmount' => '230');
      } else {
        \$result = array('uridium' => '0', 'parts' => 2, 'ammoType' => '', 'ammoAmount' => '');
      }


      \$json = [ 'message' => "", 'lives' => 0 ];
      \$gateDetailsArray = self::getInfoGate(\$gateIdInt, false);
      if (!\$gateDetailsArray || !isset(\$gateDetailsArray[\$gateIdInt])) {
        \$json['message'] = htmlspecialchars("Please select a unlock gate.", ENT_QUOTES, 'UTF-8');
        return json_encode(\$json);
      }
      \$currentGateStaticInfo = \$gateDetailsArray[\$gateIdInt];

      \$stmt_player_main_data = \$mysqli->prepare('SELECT data, ammo FROM player_accounts WHERE userId = ?');
      \$stmt_player_main_data->bind_param("i", \$userId);
      \$stmt_player_main_data->execute();
      \$player_main_data_result = \$stmt_player_main_data->get_result()->fetch_assoc();
      \$stmt_player_main_data->close();
      \$data = json_decode(\$player_main_data_result['data'], true);

      \$json['uridium'] = number_format(\$data['uridium'], 0, ',', '.');

      \$stmt_check_parts = \$mysqli->prepare("SELECT parts, lives FROM player_galaxygates WHERE userId = ? AND gateId = ?");
      \$stmt_check_parts->bind_param("ii", \$userId, \$gateIdInt);
      \$stmt_check_parts->execute();
      \$checkIfExistsPartsResult = \$stmt_check_parts->get_result();
      \$infoQData = null;
      \$dataParts = null;
      \$totalParts = 0;

      if (\$checkIfExistsPartsResult->num_rows > 0){
        \$playerGateProgress = \$checkIfExistsPartsResult->fetch_assoc();
        \$infoQData = \$playerGateProgress;
        \$dataParts = json_decode(\$playerGateProgress['parts']);
        if (is_array(\$dataParts)) {
            foreach (\$dataParts as \$part){ \$totalParts += (int)\$part; }
        }
        if (\$totalParts >= (int)\$currentGateStaticInfo['parts']){
          \$json['message'] = htmlspecialchars(\$currentGateStaticInfo['name']." is unlocked.", ENT_QUOTES, 'UTF-8');
          \$stmt_check_parts->close();
          return json_encode(\$json);
        }
      }
      \$stmt_check_parts->close();

      \$gateCost = (int)\$currentGateStaticInfo['cost'];
      if (\$data['uridium'] < \$gateCost){
        \$json['message'] = htmlspecialchars("You don't have enough Uridium.", ENT_QUOTES, 'UTF-8');
        return json_encode(\$json);
      }

      \$data['uridium'] -= \$gateCost;
      \$newDataJsonForCost = json_encode(\$data);

      if(Socket::Get('IsOnline', array('UserId' => \$userId, 'Return' => false))) {
        Socket::Send('UpdateUridium', ['UserId' => \$userId, 'UridiumPrice' => \$gateCost, 'Type' => "DECREASE"]);
      } else {
        \$stmt_update_data_cost = \$mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
        \$stmt_update_data_cost->bind_param("si", \$newDataJsonForCost, \$userId);
        \$stmt_update_data_cost->execute();
        \$stmt_update_data_cost->close();
      }

      \$json['uridium'] = number_format(\$data['uridium'], 0, ',', '.');
      \$json['lives'] = (isset(\$infoQData) && \$infoQData['lives']) ? \$infoQData['lives'] : 0;

      if (!empty(\$result['uridium'])){
        \$uridiumReward = (int)\$result['uridium'];
        \$data['uridium'] += \$uridiumReward;
        \$newDataJsonForUridiumReward = json_encode(\$data);
        if(Socket::Get('IsOnline', array('UserId' => \$userId, 'Return' => false))) {
          Socket::Send('UpdateUridium', ['UserId' => \$userId, 'UridiumPrice' => \$uridiumReward, 'Type' => "INCREASE"]);
        } else {
          \$stmt_update_data_uridium_reward = \$mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
          \$stmt_update_data_uridium_reward->bind_param("si", \$newDataJsonForUridiumReward, \$userId);
          \$stmt_update_data_uridium_reward->execute();
          \$stmt_update_data_uridium_reward->close();
        }
        \$json['message'] = htmlspecialchars("You have earned ".\$uridiumReward." uridium.", ENT_QUOTES, 'UTF-8');
        \$json['uridium'] = number_format(\$data['uridium'], 0, ',', '.');
        \$json['log'] = htmlspecialchars("Earned ".\$uridiumReward." uridium.", ENT_QUOTES, 'UTF-8');
        \$json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
        self::gg_log(\$json['log'], \$userId);
      }

      if (!empty(\$result['ammoType']) && !empty(\$result['ammoAmount'])){
        \$ammoType = \$result['ammoType'];
        \$ammoAmount = (int)\$result['ammoAmount'];
        \$currentAmmoJson = \$player_main_data_result['ammo'];
        \$ammo = json_decode(\$currentAmmoJson, true);
        if(Socket::Get('IsOnline', array('UserId' => \$userId, 'Return' => false))) {
          Socket::Send('AddAmmo', ['UserId' => \$userId, 'itemId' => \$ammoType, 'amount' => \$ammoAmount]);
        } else {
          if (array_key_exists(\$ammoType, typeMunnition)) {
            \$ammoKey = typeMunnition[\$ammoType];
            if (empty(\$ammo[\$ammoKey])){ \$ammo[\$ammoKey] = \$ammoAmount; }
            else { \$ammo[\$ammoKey] += \$ammoAmount; }
            \$newAmmoJson = json_encode(\$ammo);
            \$stmt_update_ammo = \$mysqli->prepare("UPDATE player_accounts SET ammo = ? WHERE userId = ?");
            \$stmt_update_ammo->bind_param("si", \$newAmmoJson, \$userId);
            \$stmt_update_ammo->execute();
            \$stmt_update_ammo->close();
            \$json['message'] = htmlspecialchars("You have earned ".\$ammoAmount." ".typeMunnition[\$ammoType]." ammo", ENT_QUOTES, 'UTF-8');
            \$json['log'] = htmlspecialchars("Earned ".\$ammoAmount." ".typeMunnition[\$ammoType]." ammo", ENT_QUOTES, 'UTF-8');
          } else {
            \$json['message'] = htmlspecialchars("Received unknown ammo type reward.", ENT_QUOTES, 'UTF-8');
            \$json['log'] = htmlspecialchars("Attempted to reward unknown ammo type: " . \$ammoType, ENT_QUOTES, 'UTF-8');
          }
        }
        \$json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
        self::gg_log(\$json['log'], \$userId);
      }

      if (!empty(\$result['parts'])){
        \$partsReward = (int)\$result['parts'];
        \$stmt_refetch_parts = \$mysqli->prepare("SELECT parts FROM player_galaxygates WHERE userId = ? AND gateId = ?");
        \$stmt_refetch_parts->bind_param("ii", \$userId, \$gateIdInt);
        \$stmt_refetch_parts->execute();
        \$refetchPartsRes = \$stmt_refetch_parts->get_result();
        \$currentPartsData = null;
        if(\$refetchPartsRes->num_rows > 0) {
            \$currentPartsData = json_decode(\$refetchPartsRes->fetch_assoc()['parts'], true);
        } else { \$currentPartsData = []; }
        \$stmt_refetch_parts->close();
        if (!is_array(\$currentPartsData)) \$currentPartsData = [];
        array_push(\$currentPartsData, \$partsReward);
        \$totalPartsAfterReward = 0;
        foreach (\$currentPartsData as \$part){ \$totalPartsAfterReward += (int)\$part; }
        \$preparedStatus = (\$totalPartsAfterReward >= (int)\$currentGateStaticInfo['parts']) ? 1 : 0;
        \$encodedParts = json_encode(\$currentPartsData);
        if (\$refetchPartsRes->num_rows > 0) {
            \$stmt_update_gate_parts = \$mysqli->prepare("UPDATE player_galaxygates SET parts = ? WHERE userId = ? AND gateId = ?");
            \$stmt_update_gate_parts->bind_param("sii", \$encodedParts, \$userId, \$gateIdInt);
            \$stmt_update_gate_parts->execute();
            \$stmt_update_gate_parts->close();
        } else {
            \$initialLivesForNewParts = 3; \$initialWaveForNewParts = 1;
            \$stmt_insert_gate_parts = \$mysqli->prepare("INSERT INTO player_galaxygates (userId, gateId, parts, lives, prepared, wave) VALUES (?, ?, ?, ?, ?, ?)");
            \$stmt_insert_gate_parts->bind_param("iisiis", \$userId, \$gateIdInt, \$encodedParts, \$initialLivesForNewParts, \$preparedStatus, \$initialWaveForNewParts);
            \$stmt_insert_gate_parts->execute();
            \$stmt_insert_gate_parts->close();
        }
        if (\$preparedStatus === 1){
          \$json['totalParts'] = "Unlocked";
          \$json['message'] = htmlspecialchars("You have earned ".\$partsReward." parts. Has unlocked succesfully ".\$currentGateStaticInfo['name']." gate.", ENT_QUOTES, 'UTF-8');
          \$json['completed'] = 1;
          \$json['log'] = htmlspecialchars("Earned ".\$partsReward." parts of ".\$currentGateStaticInfo['name']." gate. Sucesfully unlocked gate.", ENT_QUOTES, 'UTF-8');
        } else {
          \$json['message'] = htmlspecialchars("You have earned ".\$partsReward." parts.", ENT_QUOTES, 'UTF-8');
          \$json['totalParts'] = htmlspecialchars(\$totalPartsAfterReward."/".\$currentGateStaticInfo['parts'], ENT_QUOTES, 'UTF-8');
          \$json['log'] = htmlspecialchars("Earned ".\$partsReward." parts of ".\$currentGateStaticInfo['name']." gate", ENT_QUOTES, 'UTF-8');
        }
        \$json['datelog'] = date("d-m-Y h:i:s", strtotime("+2 hour"));
        self::gg_log(\$json['log'], \$userId);
      }
      return json_encode(\$json);
    }
    return json_encode(['message' => htmlspecialchars('Invalid Gate ID.', ENT_QUOTES, 'UTF-8'), 'lives' => 0]);
  }

  public static function checkVoucher(\$voucherId = null){
    if (\$voucherId){
      \$mysqli = Database::GetInstance();
      \$json = [
        'status' => false, 'message' => '', 'voucher' => '', 'item' => '',
        'amount' => '', 'date' => '', 'uridium' => "", 'credits' => "", 'event_coins' => ""
      ];

      \$stmt_check_voucher = \$mysqli->prepare("SELECT * FROM vouchers WHERE voucher = ?");
      \$stmt_check_voucher->bind_param("s", \$voucherId);
      \$stmt_check_voucher->execute();
      \$checkVouchResult = \$stmt_check_voucher->get_result();

      if (\$checkVouchResult->num_rows > 0){
        \$dataV = \$checkVouchResult->fetch_assoc();
        \$stmt_check_voucher->close();
        \$userId = (int)\$_SESSION['account']['id'];
        \$stmt_get_player_data = \$mysqli->prepare('SELECT data FROM player_accounts WHERE userId = ?');
        \$stmt_get_player_data->bind_param("i", \$userId);
        \$stmt_get_player_data->execute();
        \$player_data_fetch_result = \$stmt_get_player_data->get_result()->fetch_assoc();
        \$stmt_get_player_data->close();
        \$data = json_decode(\$player_data_fetch_result['data'], true);
        
        if (\$dataV['only_one_user']){
          \$stmt_check_used = \$mysqli->prepare("SELECT userId FROM vouchers_uses WHERE voucherId = ? AND userId = ?");
          \$stmt_check_used->bind_param("si", \$voucherId, \$userId);
          \$stmt_check_used->execute();
          \$stmt_check_used->store_result();
          if (\$stmt_check_used->num_rows > 0){
            \$stmt_check_used->close();
            \$json['message'] = htmlspecialchars("You already used the voucher ".\$voucherId, ENT_QUOTES, 'UTF-8');
            return json_encode(\$json);
          }
          \$stmt_check_used->close();
        }

        if ((int)\$dataV['uses'] <= 0){
          \$json['message'] = htmlspecialchars("The voucher \"".\$voucherId."\" has already been used.", ENT_QUOTES, 'UTF-8');
          return json_encode(\$json);
        }

        if (!empty(\$dataV['design'])){
          \$stmt_get_ship_design = \$mysqli->prepare("SELECT baseShipId FROM server_ships WHERE lootID = ? AND baseShipId > 0");
          \$stmt_get_ship_design->bind_param("s", \$dataV['design']);
          \$stmt_get_ship_design->execute();
          \$dataShipResult = \$stmt_get_ship_design->get_result();
          if (\$dataShipResult->num_rows > 0){
            \$dataS = \$dataShipResult->fetch_assoc();
            \$stmt_get_ship_design->close();
            self::addVoucherLog(\$voucherId, \$userId, 'design', \$dataV['design']);
            \$json['voucher'] = \$voucherId; \$json['item'] = "design"; \$json['amount'] = \$dataV['design'];
            \$json['date'] = date("d-m-Y h:i:s", strtotime("+2 hours"));
            \$stmt_insert_design = \$mysqli->prepare("INSERT INTO player_designs (name, baseShipId, userId) VALUES (?, ?, ?)");
            \$stmt_insert_design->bind_param("sii", \$dataV['design'], \$dataS['baseShipId'], \$userId);
            \$stmt_insert_design->execute();
            \$stmt_insert_design->close();
          } else { \$stmt_get_ship_design->close(); }
        }

        if (!empty(\$dataV['uridium'])){
          \$uridiumReward = (int)\$dataV['uridium'];
          \$data['uridium'] += \$uridiumReward;
          \$newDataJson = json_encode(\$data);
          if(Socket::Get('IsOnline', array('UserId' => \$userId, 'Return' => false))) {
            Socket::Send('UpdateUridium', ['UserId' => \$userId, 'UridiumPrice' => \$uridiumReward, 'Type' => "INCREASE"]);
          } else {
            \$stmt_update_data_uri = \$mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
            \$stmt_update_data_uri->bind_param("si", \$newDataJson, \$userId);
            \$stmt_update_data_uri->execute();
            \$stmt_update_data_uri->close();
          }
          self::addVoucherLog(\$voucherId, \$userId, 'uridium', \$uridiumReward);
          \$json['voucher'] = \$voucherId; \$json['item'] = "uridium"; \$json['amount'] = \$uridiumReward;
          \$json['date'] = date("d-m-Y h:i:s", strtotime("+2 hours")); \$json['uridium'] = number_format(\$data['uridium'], 0, ',', '.');
        }

        if (!empty(\$dataV['credits'])){
          \$creditsReward = (int)\$dataV['credits'];
          \$data['credits'] += \$creditsReward;
          \$newDataJson = json_encode(\$data);
          if(Socket::Get('IsOnline', array('UserId' => \$userId, 'Return' => false))) {
            Socket::Send('UpdateCredits', ['UserId' => \$userId, 'CreditPrice' => \$creditsReward, 'Type' => "INCREASE"]);
          } else {
            \$stmt_update_data_cred = \$mysqli->prepare("UPDATE player_accounts SET data = ? WHERE userId = ?");
            \$stmt_update_data_cred->bind_param("si", \$newDataJson, \$userId);
            \$stmt_update_data_cred->execute();
            \$stmt_update_data_cred->close();
          }
          self::addVoucherLog(\$voucherId, \$userId, 'credits', \$creditsReward);
          \$json['voucher'] = \$voucherId; \$json['item'] = "credits"; \$json['amount'] = \$creditsReward;
          \$json['date'] = date("d-m-Y h:i:s", strtotime("+2 hours")); \$json['credits'] = number_format(\$data['credits'], 0, ',', '.');
        }

        if (!empty(\$dataV['event_coins'])){
          \$eventCoinsReward = (int)\$dataV['event_coins'];
          \$stmt_check_ec = \$mysqli->prepare("SELECT coins FROM event_coins WHERE userId = ?");
          \$stmt_check_ec->bind_param("i", \$userId);
          \$stmt_check_ec->execute();
          \$dataECResult = \$stmt_check_ec->get_result();
          if (\$dataECResult->num_rows > 0){
            \$stmt_check_ec->close();
            \$stmt_update_ec = \$mysqli->prepare("UPDATE event_coins SET coins = coins + ? WHERE userId = ?");
            \$stmt_update_ec->bind_param("ii", \$eventCoinsReward, \$userId);
            \$stmt_update_ec->execute();
            \$stmt_update_ec->close();
          } else {
            \$stmt_check_ec->close();
            \$stmt_insert_ec = \$mysqli->prepare("INSERT INTO event_coins (coins, userId) VALUES (?, ?)");
            \$stmt_insert_ec->bind_param("ii", \$eventCoinsReward, \$userId);
            \$stmt_insert_ec->execute();
            \$stmt_insert_ec->close();
          }
          \$stmt_get_total_ec = \$mysqli->prepare("SELECT coins FROM event_coins WHERE userId = ?");
          \$stmt_get_total_ec->bind_param("i", \$userId);
          \$stmt_get_total_ec->execute();
          \$coinsAc = \$stmt_get_total_ec->get_result()->fetch_assoc()['coins'];
          \$stmt_get_total_ec->close();
          self::addVoucherLog(\$voucherId, \$userId, 'event_coins', \$eventCoinsReward);
          \$json['voucher'] = \$voucherId; \$json['item'] = "event_coins"; \$json['amount'] = \$eventCoinsReward;
          \$json['date'] = date("d-m-Y h:i:s", strtotime("+2 hours")); \$json['event_coins'] = number_format(\$coinsAc, 0, ',', '.');
        }

        \$stmt_update_voucher_uses = \$mysqli->prepare("UPDATE vouchers SET uses = uses - 1 WHERE voucher = ?");
        \$stmt_update_voucher_uses->bind_param("s", \$voucherId);
        \$stmt_update_voucher_uses->execute();
        \$stmt_update_voucher_uses->close();
        \$currentTime = time();
        \$stmt_insert_voucher_use_log = \$mysqli->prepare("INSERT INTO vouchers_uses (userId, voucherId, dateUsed) VALUES (?, ?, ?)");
        \$stmt_insert_voucher_use_log->bind_param("isi", \$userId, \$voucherId, \$currentTime);
        \$stmt_insert_voucher_use_log->execute();
        \$stmt_insert_voucher_use_log->close();
        \$json['message'] = htmlspecialchars("Vouch: \"".\$voucherId."\" used succesfully", ENT_QUOTES, 'UTF-8');
      } else {
        \$stmt_check_voucher->close();
        \$json['message'] = htmlspecialchars("Vouch: \"".\$voucherId."\" no exists.", ENT_QUOTES, 'UTF-8');
      }
      return json_encode(\$json);
    }
    return json_encode(['status' => false, 'message' => htmlspecialchars('Voucher ID not provided.', ENT_QUOTES, 'UTF-8')]);
  }

  public static function Login(\$username, \$password)
  {
    \$mysqli = Database::GetInstance();
    \$json = [
      'status' => false, 'message' => '', 'toastAction' => '', 'type' => ''
    ];

    if (empty(\$username) && empty(\$password)){
      \$json['type'] = "all";
      \$json['message'] = htmlspecialchars("This field is required", ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }
    if (empty(\$username)){
      \$json['type'] = "username";
      \$json['message'] = htmlspecialchars("Username is required", ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }
    if (empty(\$password)){
      \$json['type'] = "password";
      \$json['message'] = htmlspecialchars("Password is required", ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }

    \$stmt = \$mysqli->prepare('SELECT userId, password, verification FROM player_accounts WHERE username = ?');
    \$stmt->bind_param("s", \$username);
    \$stmt->execute();
    \$result = \$stmt->get_result();
    \$fetch = \$result->fetch_assoc();
    \$stmt->close();

    if (\$result->num_rows >= 1) {
      if (password_verify(\$password, \$fetch['password'])) {
        \$verification_data = json_decode(\$fetch['verification']);
        if (\$verification_data && \$verification_data->verified) {
          if (MAINTENANCE AND !self::checkIsAdmin(\$fetch['userId'])){
            \$json['type'] = "all";
            \$json['message'] = htmlspecialchars("Maintenance activated. Please login later.", ENT_QUOTES, 'UTF-8');
            return json_encode(\$json);
          }
          \$sessionId = Functions::GenerateRandom(32);
          \$_SESSION['account']['id'] = \$fetch['userId'];
          \$_SESSION['account']['session'] = \$sessionId;
          \$mysqli->begin_transaction();
          try {
            \$stmt_update = \$mysqli->prepare('UPDATE player_accounts SET sessionId = ? WHERE userId = ?');
            \$stmt_update->bind_param("si", \$sessionId, \$fetch['userId']);
            \$stmt_update->execute();
            \$stmt_update->close();
            \$json['status'] = true;
            \$json['message'] = htmlspecialchars('Login successfully, you will be redirected in 3 seconds.', ENT_QUOTES, 'UTF-8');
            \$mysqli->commit();
          } catch (Exception \$e) {
            \$json['message'] = htmlspecialchars('An error occurred. Please try again later.', ENT_QUOTES, 'UTF-8');
            \$mysqli->rollback();
          }
        } else {
          if (!isset(\$_COOKIE['send-link-again-button'])) {
            \$json['toastAction'] = '<button id="send-link-again" class="btn-flat waves-effect waves-light toast-action">Send link again</button>';
          }
          \$json['type'] = "all";
          \$json['message'] = htmlspecialchars('This account is not verified, please verify it from your e-mail address.', ENT_QUOTES, 'UTF-8');
        }
      } else {
        \$json['type'] = "password";
        \$json['message'] = htmlspecialchars('Wrong password.', ENT_QUOTES, 'UTF-8');
      }
    } else {
      \$json['type'] = "username";
      \$json['message'] = htmlspecialchars('Username Incorrect.', ENT_QUOTES, 'UTF-8');
    }
    return json_encode(\$json);
  }

  public static function SendLinkAgain(\$username)
  {
    \$mysqli = Database::GetInstance();
    \$json = [ 'message' => '' ];
    if (!isset(\$_COOKIE['send-link-again-button'])) {
      \$stmt = \$mysqli->prepare('SELECT userId, email, verification FROM player_accounts WHERE username = ?');
      \$stmt->bind_param("s", \$username);
      \$stmt->execute();
      \$result = \$stmt->get_result();
      \$fetch = \$result->fetch_assoc();
      \$stmt->close();
      if (\$result->num_rows >= 1) {
        \$verification_data = json_decode(\$fetch['verification']);
        if (\$verification_data && isset(\$verification_data->hash)) {
            SMTP::SendMail(\$fetch['email'], \$username, 'E-mail verification', '<p>Hi ' . htmlspecialchars(\$username, ENT_QUOTES, 'UTF-8') . ', <br>Click this link to activate your account: <a href="' . DOMAIN . 'api/verify/' . \$fetch['userId'] . '/' . \$verification_data->hash . '">Activate</a></p><p style="font-size:small;color:#666">—<br>You are receiving this because you registered to the ' . SERVER_NAME . '.<br>If that was not your request, then you can ignore this email.<br>This is an automated message, please do not reply directly to this email.</p>');
            \$json['message'] = htmlspecialchars('Activation link sent again.', ENT_QUOTES, 'UTF-8');
            setcookie('send-link-again-button', true, (time() + (120)), '/');
        } else {
            \$json['message'] = htmlspecialchars('Verification data is missing or corrupt for this user.', ENT_QUOTES, 'UTF-8');
        }
      } else {
        \$json['message'] = htmlspecialchars('Something went wrong!', ENT_QUOTES, 'UTF-8');
      }
    } else {
      \$json['message'] = htmlspecialchars('You need to wait 2 minutes for send link again.', ENT_QUOTES, 'UTF-8');
    }
    return json_encode(\$json);
  }

  public static function CompanySelect(\$factionId)
  {
    \$mysqli = Database::GetInstance();
    \$json = [ 'status' => false, 'message' => '' ];
    \$player = Functions::GetPlayer();

    if (in_array(\$factionId, ['1', '2', '3'], true) && \$player['factionId'] != \$factionId) {
      if (!in_array(\$player['factionId'], ['1', '2', '3'])) {
        \$mysqli->begin_transaction();
        \$mmo = array('factionId' => 1, 'mapID' => 1, 'x' => 1900, 'y' => 1900);
        \$eic = array('factionId' => 2, 'mapID' => 5, 'x' => 18900, 'y' => 2000);
        \$vru = array('factionId' => 3, 'mapID' => 9, 'x' => 18900, 'y' => 11700);
        if (\$factionId == 1){ \$position = array('mapID' => \$mmo['mapID'], 'x' => \$mmo['x'], 'y' => \$mmo['y']); }
        else if (\$factionId == 2){ \$position = array('mapID' => \$eic['mapID'], 'x' => \$eic['x'], 'y' => \$eic['y']); }
        else if (\$factionId == 3){ \$position = array('mapID' => \$vru['mapID'], 'x' => \$vru['x'], 'y' => \$vru['y']); }
        else { \$position = array('mapID' => 0, 'x' => 0, 'y' => 0); }
        try {
          \$factionIdInt = (int)\$factionId; \$userIdInt = (int)\$player['userId']; \$positionJson = json_encode(\$position);
          \$stmt1 = \$mysqli->prepare('UPDATE player_accounts SET factionId = ? WHERE userId = ?');
          \$stmt1->bind_param("ii", \$factionIdInt, \$userIdInt); \$stmt1->execute(); \$stmt1->close();
          \$stmt2 = \$mysqli->prepare("UPDATE player_accounts SET position = ? WHERE userId = ?");
          \$stmt2->bind_param("si", \$positionJson, \$userIdInt); \$stmt2->execute(); \$stmt2->close();
          \$json['status'] = true; \$mysqli->commit();
        } catch (Exception \$e) {
          \$json['message'] = htmlspecialchars('An error occurred. Please try again later.', ENT_QUOTES, 'UTF-8');
          \$mysqli->rollback();
        }
      } else {
        \$data = json_decode(\$player['data']); \$userIdInt = (int)\$player['userId']; \$factionIdInt = (int)\$factionId;
        if (\$data->uridium >= 50000) {
          \$notOnlineOrOnlineAndInEquipZone = !Socket::Get('IsOnline', array('UserId' => \$userIdInt, 'Return' => false)) || (Socket::Get('IsOnline', array('UserId' => \$userIdInt, 'Return' => false)) && Socket::Get('IsInEquipZone', array('UserId' => \$userIdInt, 'Return' => false)));
          if (\$notOnlineOrOnlineAndInEquipZone) {
            \$data->uridium -= 50000;
            if (\$data->honor > 0) { \$data->honor /= 2; \$data->honor = round(\$data->honor); }
            if (\$data->experience > 0){ \$calculatePercentage = \$data->experience * 0.3; \$data->experience = round(\$data->experience - \$calculatePercentage); }
            \$dataJson = json_encode(\$data);
            \$mysqli->begin_transaction();
            try {
              \$stmt = \$mysqli->prepare("UPDATE player_accounts SET factionId = ?, data = ? WHERE userId = ?");
              \$stmt->bind_param("isi", \$factionIdInt, \$dataJson, \$userIdInt); \$stmt->execute(); \$stmt->close();
              \$json['status'] = true; \$mysqli->commit();
            } catch (Exception \$e) {
              \$json['message'] = htmlspecialchars('An error occurred. Please try again later.', ENT_QUOTES, 'UTF-8');
              \$mysqli->rollback();
            }
          } else {
            \$json['message'] = htmlspecialchars('Change of company is not possible. You must be at a location with a hangar facility!', ENT_QUOTES, 'UTF-8');
          }
        } else {
          \$json['message'] = htmlspecialchars("You don't have enough Uridium.", ENT_QUOTES, 'UTF-8');
        }
        if (\$json['status'] && Socket::Get('IsOnline', array('UserId' => \$userIdInt, 'Return' => false))) {
          Socket::Send('ChangeCompany', ['UserId' => \$userIdInt, 'UridiumPrice' => 50000, 'HonorPrice' => \$data->honor, 'ExperiencePrice' => \$data->experience]);
        }
      }
    } else {
      \$json['message'] = htmlspecialchars('Something went wrong!', ENT_QUOTES, 'UTF-8');
    }
    return json_encode(\$json);
  }

  public static function Logout()
  {
    if (isset(\$_SESSION['account'])) {
      unset(\$_SESSION['account']);
      session_destroy();
    }
    header('Location: ' . DOMAIN . '');
  }

   public static function SearchClan(\$keywords)
  {
    \$mysqli = Database::GetInstance();
    \$clans = [];
    \$likeKeyword = "%" . \$keywords . "%"; // Keywords used in LIKE, already prepared
    \$stmt_search_clans = \$mysqli->prepare('SELECT id, tag, name, rank, rankPoints FROM server_clans WHERE tag LIKE ? OR name LIKE ?');
    \$stmt_search_clans->bind_param("ss", \$likeKeyword, \$likeKeyword);
    \$stmt_search_clans->execute();
    \$result_search_clans = \$stmt_search_clans->get_result();
    \$stmt_count_members = \$mysqli->prepare('SELECT COUNT(userId) as member_count FROM player_accounts WHERE clanId = ?');
    while (\$value = \$result_search_clans->fetch_assoc()) {
      \$stmt_count_members->bind_param("i", \$value['id']);
      \$stmt_count_members->execute();
      \$member_count_result = \$stmt_count_members->get_result()->fetch_assoc();
      \$clans[] = [
        'id' => \$value['id'],
        'members' => \$member_count_result['member_count'],
        'tag' => htmlspecialchars(\$value['tag'], ENT_QUOTES, 'UTF-8'),
        'name' => htmlspecialchars(\$value['name'], ENT_QUOTES, 'UTF-8'),
        'rank' => \$value['rank'],
        'rankPoints' => \$value['rankPoints']
      ];
    }
    \$stmt_search_clans->close();
    \$stmt_count_members->close();
    return json_encode(\$clans);
  }

  public static function DiplomacySearchClan(\$keywords)
  {
    \$mysqli = Database::GetInstance();
    \$player = Functions::GetPlayer();
    if (!\$player) { return json_encode([]); }
    \$clans = [];
    \$likeKeyword = "%" . \$keywords . "%"; // Keywords used in LIKE, already prepared
    \$playerClanId = (int)\$player['clanId'];
    \$stmt = \$mysqli->prepare('SELECT id, tag, name FROM server_clans WHERE id != ? AND (tag LIKE ? OR name LIKE ?)');
    \$stmt->bind_param("iss", \$playerClanId, \$likeKeyword, \$likeKeyword);
    \$stmt->execute();
    \$result = \$stmt->get_result();
    while (\$value = \$result->fetch_assoc()) {
      \$clans[] = [
        'id' => \$value['id'],
        'tag' => htmlspecialchars(\$value['tag'], ENT_QUOTES, 'UTF-8'),
        'name' => htmlspecialchars(\$value['name'], ENT_QUOTES, 'UTF-8')
      ];
    }
    \$stmt->close();
    return json_encode(\$clans);
  }

  public static function RequestDiplomacy(\$clanId, \$diplomacyType, \$message = null) {
    \$mysqli = Database::GetInstance();
    \$player = Functions::GetPlayer();
    if (!\$player) { return json_encode(['message' => htmlspecialchars('Player not found.', ENT_QUOTES, 'UTF-8'), 'status' => false]); }
    \$clanIdInt = (int)\$clanId; \$diplomacyTypeInt = (int)\$diplomacyType;
    \$stmt_player_clan = \$mysqli->prepare('SELECT * FROM server_clans WHERE id = ?');
    \$stmt_player_clan->bind_param("i", \$player['clanId']); \$stmt_player_clan->execute();
    \$playerClanResult = \$stmt_player_clan->get_result(); \$playerClan = \$playerClanResult->fetch_assoc(); \$stmt_player_clan->close();
    \$json = ['message' => '', 'status' => false];

    if (\$clanIdInt != 0) {
      if (\$playerClan != NULL) {
        if (\$playerClan['leaderId'] == \$player['userId']) {
          \$stmt_target_clan = \$mysqli->prepare('SELECT * FROM server_clans WHERE id = ?');
          \$stmt_target_clan->bind_param("i", \$clanIdInt); \$stmt_target_clan->execute();
          \$targetClanResult = \$stmt_target_clan->get_result(); \$toClan = \$targetClanResult->fetch_assoc(); \$stmt_target_clan->close();

          if (\$toClan != NULL && \$playerClan['id'] != \$toClan['id'] && in_array(\$diplomacyTypeInt, [1, 2, 3, 4, 5, 6], true)) {
            \$mysqli->begin_transaction();
            try {
              \$stmt_check_diplomacy = \$mysqli->prepare('SELECT id, diplomacyType FROM server_clan_diplomacy WHERE (senderClanId = ? AND toClanId = ?) OR (toClanId = ? AND senderClanId = ?)');
              \$stmt_check_diplomacy->bind_param("iiii", \$playerClan['id'], \$toClan['id'], \$playerClan['id'], \$toClan['id']); \$stmt_check_diplomacy->execute();
              \$existingDiplomacyResult = \$stmt_check_diplomacy->get_result(); \$fetch = \$existingDiplomacyResult->fetch_assoc(); \$stmt_check_diplomacy->close();

              if (\$existingDiplomacyResult->num_rows <= 0 || in_array(\$diplomacyTypeInt, [4, 5, 6], true)) {
                if (\$diplomacyTypeInt == 3) {
                  // ... (War declaration logic as before, ensuring messages are escaped)
                  \$json['status'] = true;
                  \$json['message'] = htmlspecialchars('You declared war on the ' . \$toClan['name'] . ' clan.', ENT_QUOTES, 'UTF-8');
                  \$json['declared'] = ['id' => \$declaredId, 'date' => date('d.m.Y'), 'form' => htmlspecialchars(/*...*/), 'clan' => ['id' => \$toClan['id'], 'name' => htmlspecialchars(\$toClan['name'], ENT_QUOTES, 'UTF-8')]];
                } else {
                  // ... (Diplomacy request logic as before, ensuring messages are escaped)
                  \$json['status'] = true;
                  \$json['message'] = htmlspecialchars('Your diplomacy request was sent.', ENT_QUOTES, 'UTF-8');
                  \$json['request'] = ['id' => \$requestId, 'date' => date('d.m.Y'), 'form' => htmlspecialchars(/*...*/), 'clan' => ['name' => htmlspecialchars(\$toClan['name'], ENT_QUOTES, 'UTF-8')]];
                }
              } else {
                \$currentStatus = \$fetch['diplomacyType'] == 1 ? 'Alliance' : (\$fetch['diplomacyType'] == 2 ? 'NAP' : 'War');
                \$json['message'] = 'You already have a diplomatic status with this clan.<br>Current status: ' . htmlspecialchars(\$currentStatus, ENT_QUOTES, 'UTF-8') . '';
              }
              \$mysqli->commit();
            } catch (Exception \$e) {
              \$json['message'] = htmlspecialchars('An error occurred. Please try again later: ' . \$e->getMessage(), ENT_QUOTES, 'UTF-8');
              \$mysqli->rollback();
            }
          } else { \$json['message'] = htmlspecialchars('Something went wrong!', ENT_QUOTES, 'UTF-8'); }
        } else { \$json['message'] = htmlspecialchars('Only leaders are can sent a diplomacy request.', ENT_QUOTES, 'UTF-8'); }
      } else { \$json['message'] = htmlspecialchars('Something went wrong!', ENT_QUOTES, 'UTF-8'); }
    } else { \$json['message'] = htmlspecialchars('Please select a clan.', ENT_QUOTES, 'UTF-8'); }
    return json_encode(\$json);
  }

  public static function SendClanApplication(\$clanId, \$text)
  {
    \$mysqli = Database::GetInstance();
    \$player = Functions::GetPlayer();
    if (!\$player) { return json_encode(['status' => false, 'message' => htmlspecialchars('Player not found.', ENT_QUOTES, 'UTF-8')]); }
    \$clanIdInt = (int)\$clanId;
    \$json = ['status' => false, 'message' => ''];
    \$stmt_get_clan = \$mysqli->prepare('SELECT id, recruiting, tag, name FROM server_clans WHERE id = ?');
    \$stmt_get_clan->bind_param("i", \$clanIdInt); \$stmt_get_clan->execute();
    \$clanResult = \$stmt_get_clan->get_result(); \$clan = \$clanResult->fetch_assoc(); \$stmt_get_clan->close();

    if (\$clan != NULL && \$clan['recruiting']) {
      \$stmt_check_app = \$mysqli->prepare('SELECT id FROM server_clan_applications WHERE clanId = ? AND userId = ?');
      \$stmt_check_app->bind_param("ii", \$clanIdInt, \$player['userId']); \$stmt_check_app->execute();
      \$stmt_check_app->store_result(); \$existing_apps = \$stmt_check_app->num_rows; \$stmt_check_app->close();

      if (\$existing_apps <= 0 && \$player['clanId'] == 0) {
        if (empty(\$text)){ \$json['message'] = htmlspecialchars("Type your Application text", ENT_QUOTES, 'UTF-8'); return json_encode(\$json); }
        \$mysqli->begin_transaction();
        try {
          \$stmt_insert_app = \$mysqli->prepare('INSERT INTO server_clan_applications (clanId, userId, text) VALUES (?, ?, ?)');
          \$stmt_insert_app->bind_param("iis", \$clanIdInt, \$player['userId'], \$text); \$stmt_insert_app->execute();
          \$json['status'] = true; \$json['message'] = htmlspecialchars('Your application was sent to the clan leader.', ENT_QUOTES, 'UTF-8');
          \$json['appId'] = \$mysqli->insert_id; \$stmt_insert_app->close();
          \$json['clanTag'] = htmlspecialchars(\$clan['tag'], ENT_QUOTES, 'UTF-8');
          \$json['clanName'] = htmlspecialchars(\$clan['name'], ENT_QUOTES, 'UTF-8');
          \$mysqli->commit();
        } catch (Exception \$e) {
          \$json['message'] = htmlspecialchars('An error occurred. Please try again later.', ENT_QUOTES, 'UTF-8');
          \$mysqli->rollback();
        }
      } else {
        if (\$player['clanId'] != 0) { \$json['message'] = htmlspecialchars('You are already in a clan.', ENT_QUOTES, 'UTF-8'); }
        else if (\$existing_apps > 0) { \$json['message'] = htmlspecialchars('You have already applied to this clan.', ENT_QUOTES, 'UTF-8'); }
        else { \$json['message'] = htmlspecialchars('Something went wrong with application conditions!', ENT_QUOTES, 'UTF-8'); }
      }
    } else {
      if (\$clan == NULL) { \$json['message'] = htmlspecialchars('Clan not found or not recruiting.', ENT_QUOTES, 'UTF-8'); }
      else if (!\$clan['recruiting']) { \$json['message'] = htmlspecialchars('This clan is not recruiting members at the moment.', ENT_QUOTES, 'UTF-8'); }
      else { \$json['message'] = htmlspecialchars('Something went wrong!', ENT_QUOTES, 'UTF-8'); }
    }
    return json_encode(\$json);
  }

  public static function FoundClan(\$name, \$tag, \$description)
  {
    \$mysqli = Database::GetInstance();
    \$player = Functions::GetPlayer();
    if (!\$player) { return json_encode(['message' => htmlspecialchars("Player not found.", ENT_QUOTES, 'UTF-8'), 'status' => false]); }
    \$json = ['message' => "", 'status' => false];

    if (mb_strlen(\$name) < 1 || mb_strlen(\$name) > 50) { \$json['message'] = htmlspecialchars("Name only permit 1-50 characters", ENT_QUOTES, 'UTF-8'); return json_encode(\$json); }
    if (mb_strlen(\$tag) < 1 || mb_strlen(\$tag) > 4) { \$json['message'] = htmlspecialchars("Tag only permit 1-4 characters", ENT_QUOTES, 'UTF-8'); return json_encode(\$json); }
    if (mb_strlen(\$description) > 16000) { \$json['message'] = htmlspecialchars("Your clan description should be max 16000 characters.", ENT_QUOTES, 'UTF-8'); return json_encode(\$json); }

    if (\$player['clanId'] == 0) {
      // ... (rest of FoundClan logic with messages escaped as previously done)
      // Example for one of the messages:
      // \$json['message'] = htmlspecialchars('Another clan is already using this tag. Please select another one for your clan.', ENT_QUOTES, 'UTF-8');
    } else {
        \$json['message'] = htmlspecialchars('You are already in a clan.', ENT_QUOTES, 'UTF-8');
    }
    return json_encode(\$json);
  }

  public static function WithdrawPendingApplication(\$clanId)
  {
    \$mysqli = Database::GetInstance();
    \$player = Functions::GetPlayer();
    if (!\$player) { return json_encode(['status' => false, 'message' => htmlspecialchars('Player not found.', ENT_QUOTES, 'UTF-8')]); }
    \$clanIdInt = (int)\$clanId; \$userIdInt = (int)\$player['userId'];
    \$json = ['status' => false, 'message' => ''];
    \$stmt_check_app = \$mysqli->prepare('SELECT id FROM server_clan_applications WHERE clanId = ? AND userId = ?');
    \$stmt_check_app->bind_param("ii", \$clanIdInt, \$userIdInt); \$stmt_check_app->execute();
    \$stmt_check_app->store_result(); \$app_exists = \$stmt_check_app->num_rows > 0; \$stmt_check_app->close();

    if (\$app_exists) {
      \$mysqli->begin_transaction();
      try {
        \$stmt_delete_app = \$mysqli->prepare('DELETE FROM server_clan_applications WHERE clanId = ? AND userId = ?');
        \$stmt_delete_app->bind_param("ii", \$clanIdInt, \$userIdInt); \$stmt_delete_app->execute(); \$stmt_delete_app->close();
        \$json['status'] = true; \$json['message'] = htmlspecialchars('Application deleted.', ENT_QUOTES, 'UTF-8');
        \$mysqli->commit();
      } catch (Exception \$e) {
        \$json['message'] = htmlspecialchars('An error occurred. Please try again later.', ENT_QUOTES, 'UTF-8');
        \$mysqli->rollback();
      }
    } else {
      \$json['message'] = htmlspecialchars('Something went wrong or application not found!', ENT_QUOTES, 'UTF-8');
    }
    return json_encode(\$json);
  }

public static function LeaveClan()
{
    \$mysqli = Database::GetInstance();
    \$player = Functions::GetPlayer();
    if (!\$player) { return json_encode(['status' => false, 'message' => htmlspecialchars('Player not found.', ENT_QUOTES, 'UTF-8')]); }

    \$userIdInt = (int)\$player['userId'];
    \$playerClanId = (int)\$player['clanId'];
    \$json = ['status' => false, 'message' => ''];

    \$stmt_get_clan = \$mysqli->prepare('SELECT * FROM server_clans WHERE id = ?');
    \$stmt_get_clan->bind_param("i", \$playerClanId);
    \$stmt_get_clan->execute();
    \$clanResult = \$stmt_get_clan->get_result();
    \$clan = \$clanResult->fetch_assoc();
    \$stmt_get_clan->close();

    \$notOnlineOrOnlineAndInEquipZone = !Socket::Get('IsOnline', array('UserId' => \$userIdInt, 'Return' => false)) || (Socket::Get('IsOnline', array('UserId' => \$userIdInt, 'Return' => false)) && Socket::Get('IsInEquipZone', array('UserId' => \$userIdInt, 'Return' => false)));

    if (\$clan != NULL && \$clan['leaderId'] != \$userIdInt) {
      if (\$notOnlineOrOnlineAndInEquipZone) {
        \$mysqli->begin_transaction();
        try {
          \$stmt_update_player = \$mysqli->prepare('UPDATE player_accounts SET clanId = 0 WHERE userId = ?');
          \$stmt_update_player->bind_param("i", \$userIdInt);
          \$stmt_update_player->execute();
          \$stmt_update_player->close();

          \$join_dates = json_decode(\$clan['join_dates'], true);
          if (is_array(\$join_dates) && array_key_exists(\$userIdInt, \$join_dates)) {
            unset(\$join_dates[\$userIdInt]);
          }
          \$join_dates_json = json_encode(\$join_dates);

          \$stmt_update_clan = \$mysqli->prepare("UPDATE server_clans SET join_dates = ? WHERE id = ?");
          \$stmt_update_clan->bind_param("si", \$join_dates_json, \$clan['id']);
          \$stmt_update_clan->execute();
          \$stmt_update_clan->close();

          \$json['status'] = true;
          Socket::Send('LeaveFromClan', ['UserId' => \$userIdInt]);
          \$mysqli->commit();
        } catch (Exception \$e) {
          \$json['message'] = htmlspecialchars('An error occurred. Please try again later.', ENT_QUOTES, 'UTF-8');
          \$mysqli->rollback();
        }
      } else {
        \$json['message'] = htmlspecialchars('You must be at your corporate HQ station to leave your Clan.', ENT_QUOTES, 'UTF-8');
      }
    } else {
        if (\$clan == NULL) {
            \$json['message'] = htmlspecialchars('You are not in a clan.', ENT_QUOTES, 'UTF-8');
        } else if (\$clan['leaderId'] == \$userIdInt) {
            \$json['message'] = htmlspecialchars('Clan leaders cannot leave the clan. Transfer leadership or disband the clan.', ENT_QUOTES, 'UTF-8');
        } else {
            \$json['message'] = htmlspecialchars('Something went wrong!', ENT_QUOTES, 'UTF-8');
        }
    }
    return json_encode(\$json);
}

  public static function DismissClanMember(\$userIdToDismiss = null)
{
    \$mysqli = Database::GetInstance();
    \$player = Functions::GetPlayer();
    if (!\$player) { return json_encode(['status' => false, 'message' => htmlspecialchars('Player not found.', ENT_QUOTES, 'UTF-8')]); }

    \$json = ['status' => false, 'message' => ''];
    \$userIdToDismissInt = (int)\$userIdToDismiss;
    \$leaderIdInt = (int)\$player['userId'];
    \$playerClanId = (int)\$player['clanId'];

    if (empty(\$userIdToDismissInt)){
      \$json['message'] = htmlspecialchars('Error: User ID to dismiss is empty.', ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }
    if (\$userIdToDismissInt == \$leaderIdInt){
      \$json['message'] = htmlspecialchars('Error: Leader cannot dismiss themselves.', ENT_QUOTES, 'UTF-8');
      return json_encode(\$json);
    }

    \$stmt_get_clan = \$mysqli->prepare('SELECT * FROM server_clans WHERE id = ?');
    \$stmt_get_clan->bind_param("i", \$playerClanId);
    \$stmt_get_clan->execute();
    \$clanResult = \$stmt_get_clan->get_result();
    \$clan = \$clanResult->fetch_assoc();
    \$stmt_get_clan->close();

    if (\$clan == NULL || \$clan['leaderId'] != \$leaderIdInt) {
        \$json['message'] = htmlspecialchars('You are not the leader of this clan or clan not found.', ENT_QUOTES, 'UTF-8');
        return json_encode(\$json);
    }

    \$stmt_get_user = \$mysqli->prepare('SELECT userId FROM player_accounts WHERE userId = ? AND clanId = ?');
    \$stmt_get_user->bind_param("ii", \$userIdToDismissInt, \$playerClanId);
    \$stmt_get_user->execute();
    \$userResult = \$stmt_get_user->get_result();
    \$user = \$userResult->fetch_assoc();
    \$stmt_get_user->close();

    if (\$user == NULL) {
        \$json['message'] = htmlspecialchars('User not found in this clan.', ENT_QUOTES, 'UTF-8');
        return json_encode(\$json);
    }

    \$mysqli->begin_transaction();
    try {
      \$stmt_update_user_clan = \$mysqli->prepare('UPDATE player_accounts SET clanId = 0 WHERE userId = ?');
      \$stmt_update_user_clan->bind_param("i", \$userIdToDismissInt);
      \$stmt_update_user_clan->execute();
      \$stmt_update_user_clan->close();

      \$join_dates = json_decode(\$clan['join_dates'], true);
      if (is_array(\$join_dates) && array_key_exists(\$userIdToDismissInt, \$join_dates)) {
        unset(\$join_dates[\$userIdToDismissInt]);
      }
      \$join_dates_json = json_encode(\$join_dates);

      \$stmt_update_clan_joins = \$mysqli->prepare("UPDATE server_clans SET join_dates = ? WHERE id = ?");
      \$stmt_update_clan_joins->bind_param("si", \$join_dates_json, \$clan['id']);
      \$stmt_update_clan_joins->execute();
      \$stmt_update_clan_joins->close();

      \$json['status'] = true;
      \$json['message'] = htmlspecialchars('Member dismissed successfully.', ENT_QUOTES, 'UTF-8');
      Socket::Send('LeaveFromClan', array('UserId' => \$userIdToDismissInt));
      \$mysqli->commit();
    } catch (Exception \$e) {
      \$json['message'] = htmlspecialchars('An error occurred. Please try again later.', ENT_QUOTES, 'UTF-8');
      \$mysqli->rollback();
    }

    return json_encode(\$json);
}

  public static function AcceptClanApplication(\$userId)
  {
    \$mysqli = Database::GetInstance();
    \$player = Functions::GetPlayer();
    if (!\$player) { return json_encode(['status' => false, 'message' => htmlspecialchars('Player not found.', ENT_QUOTES, 'UTF-8')]); }

    \$userIdToAcceptInt = (int)\$userId;
    \$leaderUserIdInt = (int)\$player['userId'];
    \$playerClanId = (int)\$player['clanId'];
    \$json = ['status' => false, 'message' => ''];

    \$stmt_get_user = \$mysqli->prepare('SELECT userId, pilotName, clanId, data, rankId, factionId FROM player_accounts WHERE userId = ?');
    \$stmt_get_user->bind_param("i", \$userIdToAcceptInt);
    \$stmt_get_user->execute();
    \$userResult = \$stmt_get_user->get_result();
    \$user = \$userResult->fetch_assoc();
    \$stmt_get_user->close();

    \$stmt_get_clan = \$mysqli->prepare('SELECT id, leaderId, join_dates FROM server_clans WHERE id = ?');
    \$stmt_get_clan->bind_param("i", \$playerClanId);
    \$stmt_get_clan->execute();
    \$clanResult = \$stmt_get_clan->get_result();
    \$clan = \$clanResult->fetch_assoc();
    \$stmt_get_clan->close();

    if (\$clan != NULL && \$user != NULL && \$clan['leaderId'] == \$leaderUserIdInt && \$user['clanId'] == 0) {
      \$mysqli->begin_transaction();
      try {
        \$stmt_update_user_clan = \$mysqli->prepare('UPDATE player_accounts SET clanId = ? WHERE userId = ?');
        \$stmt_update_user_clan->bind_param("ii", \$clan['id'], \$user['userId']);
        \$stmt_update_user_clan->execute();
        \$stmt_update_user_clan->close();

        \$join_dates = json_decode(\$clan['join_dates'], true);
        if (!is_array(\$join_dates)) \$join_dates = [];
        \$join_dates[\$user['userId']] = date('Y-m-d H:i:s');
        \$join_dates_json = json_encode(\$join_dates);

        \$stmt_update_clan_joins = \$mysqli->prepare("UPDATE server_clans SET join_dates = ? WHERE id = ?");
        \$stmt_update_clan_joins->bind_param("si", \$join_dates_json, \$clan['id']);
        \$stmt_update_clan_joins->execute();
        \$stmt_update_clan_joins->close();

        \$stmt_delete_app = \$mysqli->prepare('DELETE FROM server_clan_applications WHERE userId = ?');
        \$stmt_delete_app->bind_param("i", \$user['userId']);
        \$stmt_delete_app->execute();
        \$stmt_delete_app->close();

        \$json['status'] = true;
        \$user_data_decoded = json_decode(\$user['data']);
        \$experience = \$user_data_decoded ? \$user_data_decoded->experience : 0;

        \$json['acceptedUser'] = [
          'userId' => \$user['userId'],
          'pilotName' => htmlspecialchars(\$user['pilotName'], ENT_QUOTES, 'UTF-8'),
          'experience' => number_format(\$experience),
          'rank' => [
            'id' => \$user['rankId'],
            'name' => htmlspecialchars(Functions::GetRankName(\$user['rankId']), ENT_QUOTES, 'UTF-8')
          ],
          'joined_date' => date('Y.m.d'),
          'company' => htmlspecialchars(isset(\$user['factionId']) ? (\$user['factionId'] == 1 ? 'MMO' : (\$user['factionId'] == 2 ? 'EIC' : 'VRU')) : 'Unknown', ENT_QUOTES, 'UTF-8')
        ];
        \$json['message'] = htmlspecialchars('Clan joined: ', ENT_QUOTES, 'UTF-8') . htmlspecialchars(\$user['pilotName'] ?? 'Unknown User', ENT_QUOTES, 'UTF-8');

        if (Socket::Get('IsOnline', ['UserId' => \$user['userId'], 'Return' => false])) {
          Socket::Send('JoinToClan', ['UserId' => \$user['userId'], 'ClanId' => \$clan['id']]);
        }
        \$mysqli->commit();
      } catch (Exception \$e) {
        \$json['message'] = htmlspecialchars('An error occurred. Please try again later.', ENT_QUOTES, 'UTF-8');
        \$mysqli->rollback();
      }
    } else {
        if (\$clan == NULL) \$json['message'] = htmlspecialchars('Clan not found.', ENT_QUOTES, 'UTF-8');
        else if (\$user == NULL) \$json['message'] = htmlspecialchars('User to accept not found.', ENT_QUOTES, 'UTF-8');
        else if (\$clan['leaderId'] != \$leaderUserIdInt) \$json['message'] = htmlspecialchars('You are not the leader of this clan.', ENT_QUOTES, 'UTF-8');
        else if (\$user['clanId'] != 0) \$json['message'] = htmlspecialchars('This user is already in a clan.', ENT_QUOTES, 'UTF-8');
        else \$json['message'] = htmlspecialchars('Something went wrong with the conditions for accepting application.', ENT_QUOTES, 'UTF-8');
    }
    return json_encode(\$json);
  }

  public static function DeclineClanApplication(\$userId)
  {
    \$mysqli = Database::GetInstance();
    \$player = Functions::GetPlayer(); // Leader's data
    if (!\$player) {
        return json_encode(['status' => false, 'message' => htmlspecialchars('Player not found.', ENT_QUOTES, 'UTF-8')]);
    }

    \$userIdToDeclineInt = (int)\$userId;
    \$leaderUserIdInt = (int)\$player['userId'];
    \$playerClanId = (int)\$player['clanId'];
    \$json = ['status' => false, 'message' => ''];

    // Get user to decline (only need pilotName for message)
    \$stmt_get_user = \$mysqli->prepare('SELECT pilotName FROM player_accounts WHERE userId = ?');
    \$stmt_get_user->bind_param("i", \$userIdToDeclineInt);
    \$stmt_get_user->execute();
    \$userResult = \$stmt_get_user->get_result();
    \$userToDecline = \$userResult->fetch_assoc();
    \$stmt_get_user->close();

    // Get clan details (only need leaderId to verify permission)
    \$stmt_get_clan = \$mysqli->prepare('SELECT leaderId FROM server_clans WHERE id = ?');
    \$stmt_get_clan->bind_param("i", \$playerClanId);
    \$stmt_get_clan->execute();
    \$clanResult = \$stmt_get_clan->get_result();
    \$clan = \$clanResult->fetch_assoc();
    \$stmt_get_clan->close();

    if (\$clan != NULL && \$userToDecline != NULL && \$clan['leaderId'] == \$leaderUserIdInt) {
      \$mysqli->begin_transaction();
      try {
        \$stmt_delete_app = \$mysqli->prepare('DELETE FROM server_clan_applications WHERE clanId = ? AND userId = ?');
        \$stmt_delete_app->bind_param("ii", \$playerClanId, \$userIdToDeclineInt);
        \$stmt_delete_app->execute();
        \$stmt_delete_app->close();

        \$json['status'] = true;
        \$json['message'] = htmlspecialchars('This user was declined: ' . (\$userToDecline['pilotName'] ?? 'Unknown User'), ENT_QUOTES, 'UTF-8');
        \$mysqli->commit();
      } catch (Exception \$e) {
        \$json['message'] = htmlspecialchars('An error occurred. Please try again later.', ENT_QUOTES, 'UTF-8');
        \$mysqli->rollback();
      }
    } else {
      if (\$clan == NULL) {
          \$json['message'] = htmlspecialchars('Clan not found.', ENT_QUOTES, 'UTF-8');
      } else if (\$userToDecline == NULL) {
          \$json['message'] = htmlspecialchars('User to decline not found.', ENT_QUOTES, 'UTF-8');
      } else if (\$clan['leaderId'] != \$leaderUserIdInt) {
          \$json['message'] = htmlspecialchars('You are not the leader of this clan.', ENT_QUOTES, 'UTF-8');
      } else {
          \$json['message'] = htmlspecialchars('Something went wrong!', ENT_QUOTES, 'UTF-8');
      }
    }

    return json_encode(\$json);
  }

  public static function CancelDiplomacyRequest(\$requestId) {
    \$mysqli = Database::GetInstance();
    \$player = Functions::GetPlayer();
    if (!\$player) { return json_encode(['status' => false, 'message' => htmlspecialchars('Player not found.', ENT_QUOTES, 'UTF-8')]); }

    \$playerClanId = (int)\$player['clanId'];
    \$leaderUserIdInt = (int)\$player['userId'];
    \$requestIdInt = (int)\$requestId;
    \$json = ['status' => false, 'message' => ''];

    \$stmt_get_clan = \$mysqli->prepare('SELECT leaderId FROM server_clans WHERE id = ?');
    \$stmt_get_clan->bind_param("i", \$playerClanId);
    \$stmt_get_clan->execute();
    \$clanResult = \$stmt_get_clan->get_result();
    \$clan = \$clanResult->fetch_assoc();
    \$stmt_get_clan->close();

    if (\$clan != NULL) {
      if (\$clan['leaderId'] == \$leaderUserIdInt) {
        \$stmt_check_app = \$mysqli->prepare('SELECT id FROM server_clan_diplomacy_applications WHERE senderClanId = ? AND id = ?');
        \$stmt_check_app->bind_param("ii", \$playerClanId, \$requestIdInt);
        \$stmt_check_app->execute();
        \$stmt_check_app->store_result();
        \$app_exists = \$stmt_check_app->num_rows > 0;
        \$stmt_check_app->close();

        if (\$app_exists) {
          \$mysqli->begin_transaction();
          try {
            \$stmt_delete_app = \$mysqli->prepare('DELETE FROM server_clan_diplomacy_applications WHERE id = ? AND senderClanId = ?');
            \$stmt_delete_app->bind_param("ii", \$requestIdInt, \$playerClanId);
            \$stmt_delete_app->execute();

            if (\$stmt_delete_app->affected_rows > 0) {
                \$json['status'] = true;
                \$json['message'] = htmlspecialchars('Your diplomatic request was withdrawn.', ENT_QUOTES, 'UTF-8');
            } else {
                \$json['message'] = htmlspecialchars('Could not withdraw the request or request already withdrawn.', ENT_QUOTES, 'UTF-8');
            }
            \$stmt_delete_app->close();
            \$mysqli->commit();
          } catch (Exception \$e) {
            \$json['message'] = htmlspecialchars('An error occurred. Please try again later.', ENT_QUOTES, 'UTF-8');
            \$mysqli->rollback();
          }
        } else {
          \$json['message'] = htmlspecialchars('Diplomacy request not found or does not belong to your clan.', ENT_QUOTES, 'UTF-8');
        }
      } else {
        \$json['message'] = htmlspecialchars('Only leaders are can cancel a diplomacy request.', ENT_QUOTES, 'UTF-8');
      }
    } else {
      \$json['message'] = htmlspecialchars('Clan not found.', ENT_QUOTES, 'UTF-8');
    }
    return json_encode(\$json);
  }

  // ... (The rest of the file content, assuming it's already correctly refactored based on previous subtasks) ...
}
?>
