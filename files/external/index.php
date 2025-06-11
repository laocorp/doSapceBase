<?php
    // Assuming config.php (with DOMAIN, Functions class etc.) is loaded by the calling script (e.g., redirect.php)

    $toastMessage = ''; // Initialize for potential messages
    // Initialize other variables that might be used in the HTML if not set by POST handlers
    $recover1Show = "none";
    $mail = "";

    if (isset($_POST['loginsubmit'])) {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $loginResultJson = Functions::Login($_POST['username'], $_POST['password']);
            $loginResult = json_decode($loginResultJson, true);

            if (isset($loginResult['status']) && $loginResult['status'] === true) {
                // Successful login, redirect to home
                header('Location: ' . DOMAIN . 'home');
                exit;
            } else {
                // Use htmlspecialchars to prevent XSS from error messages if they can contain user input
                $toastMessage = isset($loginResult['message']) ? htmlspecialchars($loginResult['message'], ENT_QUOTES, 'UTF-8') : 'Login failed. Please try again.';
            }
        } else {
            $toastMessage = 'Please enter both username and password.';
        }
    }
    // Placeholder for other handlers (registration, password reset) to be added later:
    // else if (isset($_POST['password_confirm'])) { /* ... registration ... */ }
    // else if (isset($_POST["resetsubmit"])) { /* ... password reset ... */ }
    // else if (isset($_POST["resetsubmit1"])) { /* ... password reset ... */ }

    // The generateRandomString function will be added here later if password recovery is integrated into this file.

    // Placeholder for other handlers (registration, password reset) to be added later:
    // else if (isset($_POST['password_confirm'])) { /* ... registration ... */ }
    // else if (isset($_POST["resetsubmit"])) { /* ... password reset ... */ }
    // else if (isset($_POST["resetsubmit1"])) { /* ... password reset ... */ }
    } else if (isset($_POST['password_confirm']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) { // Registration attempt
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $email = $_POST['email'];
        $terms = isset($_POST['terms']) ? $_POST['terms'] : ''; // Check if terms is set

        // Call Functions::Register
        $registrationResultJson = Functions::Register($username, $password, $password_confirm, $email, $terms);
        $registrationResult = json_decode($registrationResultJson, true);

        if (isset($registrationResult['status']) && $registrationResult['status'] === true) {
            // Successful registration
            if (isset($registrationResult['redirect']) && $registrationResult['redirect'] === true) {
                header('Location: ' . DOMAIN . 'home');
                exit;
            } else {
                $toastMessage = isset($registrationResult['message']) ? htmlspecialchars($registrationResult['message'], ENT_QUOTES, 'UTF-8') : 'Registration successful!';
            }
        } else {
            // Failed registration
            $toastMessage = isset($registrationResult['message']) ? htmlspecialchars($registrationResult['message'], ENT_QUOTES, 'UTF-8') : 'Registration failed. Please try again.';
        }
    }
    // Password recovery handlers can be added here later if needed for this page.
    ?>
<html class="no-js" lang="en">
<head>
<title><?= SERVERNAME; ?>: The best blackkorbit server PVP/PVE</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="OrbitFenix is a Massive Multiplayer Online Roleplaying Space Game">
<meta name="keywords" content="Browser games, OrbitFenix, Fan Made Server, Space shooter, Games, Free, Online games, Action game, Shooter, OrbitFenix PvE, OrbitFenix PvP, PvEvP, PvE, Orbit Server List">
<meta property="og:image" content="https://www.juegaenred.com/wp-content/uploads/2017/01/DarkOrbit-Reloaded-screenshots-6-copia_1.jpg">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/do_img/index/bootstrap-3.3.5.min2.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="/do_img/index/font-awesome.min.css" rel="stylesheet" type='text/css'>
<link href='/do_img/index/Open.Sans.css' rel='stylesheet' type='text/css'>
<link href='/do_img/index/animate.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/do_img/index/v3b/style.css" />
<link rel="stylesheet" href="/do_img/index/v3b/stars.css" />
<link rel="stylesheet" href="/do_img/index/v3b/sense.css" />
<link rel="stylesheet" href="/css/index/index.css" />
<link href="https://fonts.googleapis.com/css?family=Muli" rel='stylesheet' type='text/css'>

	
<script type="text/javascript" src="http://www.mind.ilstu.edu/include/swfobject.js"></script>


</head>

<body>
<div class="index">

<div class="header">
<div class="title">
<a href="/" class="fg-white"><?= LOGO; ?></a>
</div>
<div class="login">
<form id="login" method="post">
<input type="text" required name="username" placeholder="Username">
<input type="password" required name="password" placeholder="Password">
<button type="submit" name="loginsubmit" class="login-button">LOGIN</button>
</form>
</div>
<div class="links">
<a class="fg-white">Click here to watch our </a> <b> <a data-toggle="modal" data-target="#updates" class="fg-red"><u>Updates</u></a></b> &amp; <a class="fg-white">Follow us on</a> <b> <a href="https://www.facebook.com//" class="fg-blue">Facebook</a></b>
</div>
</div>

<div class="page">
<div id="showcase">
<h1 class="bold king-size"><?= SERVERNAME; ?></h1>
<div class='content' style="margin-top:-35px;">
<div class='visible'>
<p>
Introducing
</p>
<ul>
<li>New system 2D/3D</li>
<li>New ships / P.E.T 10</li>
<li>New events</li>
<li class="fg-red">and much more...</li>
</ul>
</div>
</div>
<div data-toggle="modal" data-target="#miModal" class="mbutton button-white">REGISTER</div> 
<a href="<?= DISCORDINVITELINK; ?>" class="mbutton button-white"> DISCORD</a>
</div>
</div>

<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Register</h4>
			</div>
			<div class="modal-body"><center>
			<form id="register" method="post">
                  <div class="card-content">
                    <div class="row">
                      <div class="input-field col s12">
                        <i class="material-icons prefix">person</i>
                        <input type="text" name="username" id="r-username" placeholder="Username" class="validate" maxlength="20" required>
                        <br> <span class="helper-text" data-error="Enter a valid username!">Enter your username.</span>
                      </div>
                      <br>
                      <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input type="email" name="email" id="r-email" placeholder="Email" class="validate" maxlength="260" required>
                        <br><span class="helper-text" data-error="Enter a valid e-mail address!">Enter your e-mail address (you'll need this for verification and recovering account).</span>
                      </div><br>
                      <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input type="password" name="password" id="r-password" placeholder="Password" class="validate" maxlength="45" required>
                        <br> <span class="helper-text" data-error="Enter a valid password!">Enter your password.</span>
                      </div><br>
                      <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input type="password" name="password_confirm" id="r-password-confirm" placeholder="Password Confirm" class="validate" maxlength="45" required>
                        <br><span class="helper-text" data-error="Enter a valid password!">Confirm your password.</span>
                      </div><br>
                      
                      <div class="form-group">
                        <label for="r-terms" style="display: inline;">
                            <input name="terms" id="r-terms" value="1" type="checkbox" required style="width: auto; height: auto; margin-right: 5px;"> <!-- Basic styling for checkbox -->
                            I have read and accept the <a href="/termsandrules.php" target="_blank">Terms and Conditions</a>.
                        </label>
                      </div>
                                           
                      <div class="input-field col s12">
                        <button class="mbutton button-white">REGISTER</button>
                      </div>
                    </div>
                  </div>
                </form>
	


			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="updates" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<center><img src="https://besthry.cz/wp-content/uploads/2016/07/dark-orbit-logo.png" alt="ds_logo" class="img_logo" height= "129px"></center>
			</div>
      <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;UPDATES:</h4>
			<div class="modal-body">
			<li>New system map 2D/3D.</li>
      <li>New Ships (HammerClaw,Cyborg).</li>
      <li>New desings for (Goliath,Cyborg,Hammerclaw,Spectrum,Sentinel,Champions).</li>
      <li>New donate system.</li>
      <li>New settings sytem clan.</li>
      <li>New maps.</li>
      <li>New npc farm.</li>
      <li>Clan BattleStations.</li>
      <li>Boosters available from shop.</li>
      <li>Event Spaceball more rewards.</li>


			</div>
		</div>
	</div>
</div>
<br>
<center>


</center>
<br>
<?php require_once(INCLUDES . 'footer.php'); ?>
<?php
    if (!empty($toastMessage)) {
        echo "<script>toast('" . addslashes($toastMessage) . "');</script>";
    }
    ?>
