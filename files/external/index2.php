<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xml:lang="es"><head>
<title><?= SERVERNAME; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
<meta http-equiv="Expires" content="0">
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="Content-Language" content="es">
<meta name="language" content="es">
<meta name="ROBOTS" content="ALL">
<meta name="description" content="<?= SERVERNAME; ?> is a Massive Multiplayer Online Roleplaying Space Game">
<meta name="keywords" content="Browser games, OrbitFenix, Fan Made Server, Space shooter, Games, Free, Online games, Action game, Shooter, OrbitFenix PvE, OrbitFenix PvP, PvEvP, PvE, Orbit Server List">
<meta name="abstract" content="VendettaWow, WoW, World of Warcraft">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:site_name" content="<?= DOMAIN; ?>">
<meta property="og:description" content="<?= SERVERNAME; ?> is a Massive Multiplayer Online Roleplaying Space Game">
<meta property="og:image" content="https://www.juegaenred.com/wp-content/uploads/2017/01/DarkOrbit-Reloaded-screenshots-6-copia_1.jpg">
<meta property="og:image:width" content="200">
<meta property="og:image:height" content="200">
<link rel="stylesheet" type="text/css" href="https://www.vendettawow.com/styles/global_11.css">
<link rel="stylesheet" type="text/css" href="https://www.vendettawow.com/styles/jqModal.css">
<link rel="stylesheet" type="text/css" href="https://www.vendettawow.com/styles/index.css">
<link rel="stylesheet" type="text/css" href="https://www.vendettawow.com/styles/ui-themes/vader/jquery-ui.min.css">

<script type="text/javascript" src="https://www.vendettawow.com/lib/javascript/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="https://www.vendettawow.com/lib/javascript/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://www.vendettawow.com/lib/javascript/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="https://www.vendettawow.com/lib/javascript/jquery.json-2.2.min.js"></script>
<script type="text/javascript" src="https://www.vendettawow.com/lib/javascript/jquery.autoresize.min.js"></script>
<script type="text/javascript" src="https://www.vendettawow.com/lib/javascript/jqModal.js"></script>


<body><div id="overUpdate" style="left: 0px;top: 0px;z-index: 150;opacity: 0.9;width: 100%;height: 100%;position: fixed;background-color: #000;display:none;">
  <div id="updatePj" style="margin:auto;padding: 10px;width: 300px;top: 45%;left: 42%;color: #CE7C00;border: 1px solid #5C350C;background-color: #000000;text-align:center;position: fixed;"></div>
</div>
                
<!--<script src="https://cdn.jsdelivr.net/npm/@widgetbot/crate@3" async defer>
  new Crate({
  server: '750806110184669213',
  channel: '750806820754423858',
  color: '#8e110f',
  glyph: ['http://arix.dev.vendettawow.com/images/rrss/discord-gold.png','68%'],
  notifications: true,
  })
</script>-->
<div class="full-web-content">
<center>

<div id="bg-web"> </div>
<div id="main">
                            
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#5e290e">
<meta property="og:site_name" content="Vendetta">
<meta property="og:description" content="Disfruta ya de la mejor experiencia custom del mundo.">
<meta property="og:image" content="/images/template/logo-v-min.png">
<link rel="stylesheet" href="/css/index/login.css">
<script type="text/javascript" src="https://www.vendettawow.com/lib/javascript/ajax/index.js"></script>
<script src='https://www.google.com/recaptcha/api.js' async></script>

<div class="main_login">

<script>

function setCookie(slang) {
    var d = new Date();
    d.setTime(d.getTime() + (30*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = "clang" + "=" + slang + ";" + expires + ";path=/";
    location.reload();
}

// Open the Modal
function openGallery(n) {
  document.getElementById('myModal').style.display = "block";
  showSlides(n);
}

// Close the Modal
function closeGallery() {
  document.getElementById('myModal').style.display = "none";
}

function showSlides(n) {
  var slide = document.getElementById("mySlides");
  var slide_img = document.getElementById("img-slide");
  slide_img.src = "login_data/images/gallery/"+n;
  slide.style.display = "block";
}

</script>
<div id="myModal" class="_modal">
  <span class="close cursor" onclick="closeGallery()">×</span>
  <div class="_modal-content">
    <div id="mySlides">
      <img id="img-slide" style="width:100%">
    </div>
  </div>
</div>
<div class="content" id="c-top">
  <div class="login-top-container">
  <div class="logo"><img src='https://vignette.wikia.nocookie.net/logopedia/images/e/e9/Logodarkorbit.png/revision/latest/scale-to-width-down/340?cb=20120727030847'></div>
    <div class="login-top-buttons">
      <div class="login-login">
       <a href="#_login" id="_login_b">Login</a>
      </div>
     <div class="login-register">
       <a href="#_register" id="_login_b">Register</a>
     </div>
    </div>
    <div class="login-top-content">
      <div class="login-top-title" data-text="¡Vive una experiencia única!">
        LIVE A UNIQUE EXPERIENCE
      </div>
      <div class="login-top-desc">
        <?= SERVERNAME; ?> is a Public, Bug- and Lagfree Private Server! 24/7 Online! With Multiple Instances and High Performance Servers we are Different and unique.</br>
        <?= SERVERNAME; ?> gets updated Daily with Bug-fixes, Features and Performance improvements to give you the best game-experience that you all want!
      </div>
    </div>

  </div>

<div id="_login" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="close_login">
        <a href="#" class="closebtn">×</a>
      </div>
      <div class="container_login">
        <form id="login-form" name="login-form" method="post">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" style="text-align: right;">
                  <tbody><tr>
                      <td colspan="1"><h1>Username</h1></td>
                      <td colspan="1" id="td2"><input type="text" name="username" id="loginnick" maxlength="256" class="input" style="margin-left:5px;width:150px;height: 18px;"></td>
                  </tr>
                  <tr>
                      <td colspan="1"><h1>Password</h1></td>
                      <td colspan="1" id="td2"><input type="password" name="password" id="loginpass" class="input" style="margin-left:5px;width:150px;height: 18px;"></td>
                  </tr>
              </tbody></table>
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tbody><tr>
                      <td rowspan="1"><h1>Recordarme</h1></td>
                      <td rowspan="1"><input type="checkbox" name="loginremember" id="loginremember" value="1" checked="checked"><label for="loginremember"></label></td>
                      <td rowspan="2" id="delog"><input type="submit" name="loginsubmit" id="loginsubmit" style="margin-top: -5px;cursor:pointer;"><h3>Login</h3></td>
                  </tr>
                  <tr>

                  </tr>
              </tbody></table>
              <div style="border:1px solid red; border-radius: 5px; display:none; padding: 2px;" id="login:message"></div>
          </form>
      </div>
    </div>
  </div>
</div>

<div id="_register" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="close_login">
        <a href="#" class="closebtn">×</a>
      </div>
      <div class="container_register">
        <div class="register-title">Account Register</div>
        <div style="padding:30px;">
          <?php
          if (MAINTENANCE){
            ?>
              <div style="width:100%; height:85%; padding: 5px;">
                <div style="border:1px solid red; border-radius: 5px; padding: 5px; font-size: 15px;">Maintenance activated. Please register later.</div>
              </div>
            <?php
          } else {
          ?>
          <form id="register-form" name="login-form" method="post">
            <table width="70%" border="0" cellpadding="0" cellspacing="0" style="text-align: right;">
                    <tbody><tr>
                        <td colspan="1"><h1>Username</h1></td>
                        <td colspan="1" id="td2"><input type="text" name="username" id="r-username" maxlength="256" class="input" style="margin-left:5px;width:150px;height: 18px;" required></td>
                    </tr>
                    <tr>
                        <td colspan="1"><h1>Email</h1></td>
                        <td colspan="1" id="td2"><input type="email" name="email" id="r-email" class="input" style="margin-left:5px;width:150px;height: 18px;" required></td>
                    </tr>
                    <tr>
                        <td colspan="1"><h1>Password</h1></td>
                        <td colspan="1" id="td2"><input type="password" name="password" id="r-password" class="input" style="margin-left:5px;width:150px;height: 18px;" required></td>
                    </tr>
                    <tr>
                        <td colspan="1"><h1>Confirm Password</h1></td>
                        <td colspan="1" id="td2"><input type="password" name="password_confirm" id="r-password_confirm" class="input" style="margin-left:5px;width:150px;height: 18px;" required></td>
                    </tr>
                </tbody>
            </table>
            <div style="padding-bottom: 15px;"><input type="checkbox" name="terms" id="r-terms" value="1" onclick="gcap();">I have read and accept the registration <a href="/termsandrules.php" target="_blank">terms and conditions</a></div>
            <div class="input-field col s12" id="gcap" style="display:none;">
            <div id="gccc"><div class="g-recaptcha" style="padding-bottom: 15px;" data-sitekey="6LdTDnsiAAAAAEaMLYcov70JZ_-8aS3ZNsqFt0ZE"></div></div>
            <input type="submit" name="loginsubmit" id="loginsubmit" style="cursor:pointer;"><h3>REGISTER</h3>
            <div style="border:1px solid red; border-radius: 5px; padding: 2px; display:none;" id="register:message"></div>
          </form>
          <?php } ?>
          </div>
      </div>
    </div>
  </div>
</div>

</center>

<?php require_once(INCLUDES . 'footer.php'); ?>