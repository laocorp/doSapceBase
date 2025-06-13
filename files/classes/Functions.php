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
        $clan = $mysqli->query('SELECT * FROM server_clans WHERE id = ' . $player['clanId'] . '')->fetch_assoc();
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

      if ($mysqli->query('SELECT * FROM player_accounts WHERE email = "' . $email . '"')->num_rows > 0) {
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

          $mysqli->commit(); // Commit inner transaction
        } catch (Exception $e) {
          // error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
          $json['message'] = 'An error login occurred. Please try again later.';
          $mysqli->rollback(); // Rollback inner transaction
          // Do not return here, let outer catch handle it if necessary or commit outer.
        }

        $json['type'] = "resultAll";
        $json['message'] = 'You have registered successfully, you will be redirected in 3 seconds.';
        $json['redirect'] = true;
        $json['status'] = true;

        $mysqli->commit(); // Commit outer transaction

        return json_encode($json);
      } catch (Exception $e) {
        // error_log('Exception in ' . __METHOD__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
        $json['type'] = "resultAll";
        $json['message'] = 'An error occurred. Please try again later.';
        $mysqli->rollback(); // Rollback outer transaction

        return json_encode($json);
      }

      // $mysqli->close(); // Should not be closed here if GetInstance() returns a persistent connection
    } else {
      $json['type'] = "username";
      $json['message'] = 'This username is already taken.';

      return json_encode($json);
    }
  }

  // ... [ALL OTHER METHODS OF Functions class from ObStart up to and including getUpgradeableItemConfig()] ...
  // ... [This includes checkIsAdmin, checkIsFullAdmin, addVoucherLog, ... getDroneLvl()] ...
  // The last method from Block A is getUpgradeableItemConfig()
  public static function getUpgradeableItemConfig()
  {
    return self::$upgradeableItemConfig;
  }

  // Now, Block C: The rest of the Functions class methods and its closing brace
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
} // THIS IS THE SINGLE, CORRECT CLOSING BRACE FOR THE Functions CLASS

// Now, Block B: All global auction functions
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
        error_log('Exception in ' . __FUNCTION__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
        $mysqli->rollback();
      }
      // $mysqli->close(); // Should not be closed here
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
        error_log('Exception in ' . __FUNCTION__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
        $mysqli->rollback();
      }
      // $mysqli->close(); // Should not be closed here
    }
  }
  else {
    echo "Your account LF4 Max Limit";
  }
  return null;
}

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
        error_log('Exception in ' . __FUNCTION__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
        $mysqli->rollback();
      }
      // $mysqli->close(); // Should not be closed here
    }
  }
  else {
    echo "Your account LF4 Max Limit";
  }
  return null;
}

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
        error_log('Exception in ' . __FUNCTION__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
        $mysqli->rollback();
      }
      // $mysqli->close(); // Should not be closed here
    }
  }
  else {
    echo "Your account LF4 Max Limit";
  }
  return null;
}

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
        error_log('Exception in ' . __FUNCTION__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
        $mysqli->rollback();
      }
      // $mysqli->close(); // Should not be closed here
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
      // $json['message'] = 'Something went wrong!'; // This variable is not defined in this scope
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
        error_log('Exception in ' . __FUNCTION__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
        $mysqli->rollback();
      }
      // $mysqli->close(); // Should not be closed here
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
        error_log('Exception in ' . __FUNCTION__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
        $mysqli->rollback();
      }
      // $mysqli->close(); // Should not be closed here
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
        error_log('Exception in ' . __FUNCTION__ . ' on line ' . __LINE__ . ': ' . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
        $mysqli->rollback();
      }
      // $mysqli->close(); // Should not be closed here
    }
  }
  else {
    echo "Your account ZEUS Limit";
  }
  return null;
}
