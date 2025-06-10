<?php
ini_set("display_errors", false);
include '../files/config.php';

$db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);

if ($db->connect_errno){
    die('Error al conectar con el servidor mysql. Tipo de error: '.$db->connect_error);
}

function GenerateRandom($length, $numbers = true, $letters = true, $uppercase = true){
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

function checkIsAdmin($id = null){
  if ($id){
    $checkIsAdmin = $db->query('SELECT userId, type FROM chat_permissions WHERE userId = "'.$id.'"');
    $type = (integer) $checkIsAdmin->fetch_assoc()['type'];
    if (($type == 1) || ($type == 2)){
      return true;
    } else {
      return false;
    }
  }
}

if (isset($_POST['login'])){
  
  $username = $db->real_escape_string($_POST['username']);
  $password = $db->real_escape_string($_POST['password']);

  $json = [
    'status' => false,
    'message' => '',
    'toastAction' => ''
  ];

  $statement = $db->query('SELECT userId, password, verification FROM player_accounts WHERE username = "' . $username . '"');
  $fetch = $statement->fetch_assoc();

  if ($statement->num_rows >= 1) {
    if (password_verify($password, $fetch['password'])) {
      if (json_decode($fetch['verification'])->verified) {
        
        if (MAINTENANCE AND !self::checkIsAdmin($fetch['userId'])){
          $json['message'] = "Maintenance activated. Please login later.";

          return json_encode($json);
        }

        $sessionId = Functions::GenerateRandom(32);

        $_SESSION['account']['id'] = $fetch['userId'];
        $_SESSION['account']['session'] = $sessionId;

        $db->begin_transaction();

        try {
          $db->query('UPDATE player_accounts SET sessionId = "' . $sessionId . '" WHERE userId = ' . $fetch['userId'] . '');

          $json['status'] = true;
          $json['message'] = 'Login successfully, you will be redirected in 3 seconds.';

          $db->commit();
        } catch (Exception $e) {
          $json['message'] = 'An error occurred. Please try again later.';
          $db->rollback();
        }

        $db->close();
      } else {
        if (!isset($_COOKIE['send-link-again-button'])) {
          $json['toastAction'] = '<button id="send-link-again" class="btn-flat waves-effect waves-light toast-action">Send link again</button>';
        }

        $json['message'] = 'This account is not verified, please verify it from your e-mail address.';
      }
    } else {
      $json['message'] = 'Wrong password.';
    }
  } else {
    $json['message'] = 'No account with this username/password combination was found.';
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login | <?= PHRASELOGO[0].PHRASELOGO[1]; ?></title>
    <link rel="stylesheet" href="css/master.css">
  </head>
  <body>
    <div class="login-box">
      <img src="img/logo.png" class="avatar" alt="Avatar Image">
      <h1>Login Here</h1>
      <?php if (isset($_POST['login'])){ ?>
      <div style="border: 1px solid red; margin-bottom:5px; padding:5px;"><?= $json['message']; ?></div>
      <?php if ($json['status']){ ?>
        <script>setTimeout(function(){ location.href='/'; }, 3000);</script>
      <?php } ?>
      <?php } ?>
      <form method="post">
        <label for="username">Username</label>
        <input type="text" placeholder="Enter Username" name="username">
        <label for="password">Password</label>
        <input type="password" placeholder="Enter Password" name="password">
        <input type="submit" value="Log In" name="login">
        <a href="/">Don't have An account?</a>
      </form>
    </div>
  </body>
</html>
