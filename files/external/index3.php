<!DOCTYPE html><!---- <script src="/js/snowstorm.js"></script><script>snowStorm.snowColor = '#99ccff';snowStorm.flakesMaxActive = 96;snowStorm.useTwinkleEffect = true;</script> --->
<html lang="es-ES" xml:lang="es-ES">
    <head itemscope itemtype="http://schema.org/WebSite">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
        <meta charset="UTF-8" />
        
                
        <meta itemprop="keywords" name="keywords" content="" />
        <meta itemprop="audience" content="PlayAction" />
        <meta itemprop="creator" content="Bigpoint" />
        <meta itemprop="publisher" content="Bigpoint" />
        
                
        <title><?= SERVERNAME; ?> | <?= DESC; ?></title>
        
        <!-- OpenGraph metadata general tags  -->
        <meta property="og:type" content="website" />
        <meta itemprop="name" property="og:title" content="" />
        <meta itemprop="description" property="og:description" name="description" content="" />
        
        <meta property="og:locale:alternate" content="cs_CZ" />
        <meta property="og:locale:alternate" content="de_DE" />
        <meta property="og:locale:alternate" content="el_GR" />
        <meta property="og:locale:alternate" content="en_GB" />
        <meta property="og:locale" content="es_ES" />
        <meta property="og:locale:alternate" content="fr_FR" />
        <meta property="og:locale:alternate" content="hu_HU" />
        <meta property="og:locale:alternate" content="it_IT" />
        <meta property="og:locale:alternate" content="ja_JP" />
        <meta property="og:locale:alternate" content="nl_NL" />
        <meta property="og:locale:alternate" content="pl_PL" />
        <meta property="og:locale:alternate" content="pt_BR" />
        <meta property="og:locale:alternate" content="pt_PT" />
        <meta property="og:locale:alternate" content="ro_RO" />
        <meta property="og:locale:alternate" content="ru_RU" />
        <meta property="og:locale:alternate" content="sk_SK" />
        <meta property="og:locale:alternate" content="tr_TR" />
        <meta property="og:url" content="<?= DOMAIN; ?>" />
        <meta property="fb:app_id" content="" />
                
        <!-- Article OpenGraph tags-->
                        
        <!-- TwitterCard metadata general tags  -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@">
        <meta name="twitter:creator" content="@">
        <meta name="twitter:title" content="" />
        <meta name="twitter:description" content="" />      

        
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        
        <link rel="canonical" href="<?= DOMAIN; ?>" itemprop="url" />
              
        <link rel="stylesheet" type="text/css" href="./css/index3/index.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript" src="/js/login.js"></script>
        <script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>
        <script> window.$ = window.jQuery = $ || jQuery || jquery || $_jq; </script>
                
        <link rel="stylesheet" href="./css/index3/foot.css">
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Exo:400,700" />
        <link rel="stylesheet" href="./css/index3/mission.css" />
		
		<link rel="stylesheet" href="css/toastify.css" />
<script src="js/toastify.js"></script>
        
    <meta name="robots" content="noindex,nofollow">

    </head>
    <body class="">
    <div id="bodyContainer">

    <div id="content">
    <div class="container">
        <div id="bpLogo">
            <img id="PartnerCobrandLogo" src="" />        </div>

        <form id="bgc_sasform_config">
    <input type="hidden" name="placeholder"     value="login, signupshort" />
    <input type="hidden" name="hidelabels"      value="login, signupshort" />
    <input type="hidden" name="errors-login"    value="inline" />
    <input type="hidden" name="errors-signup"   value="inline" />
    <input type="hidden" name="errors-facebook" value="inline" />
</form>
<script>
function toast(message){

    var toast = Toastify({
      text: message,
      duration: 5000,
      close: true,
      stopOnFocus: true,
      backgroundColor: "#2d2d2d",
      offset: { x: 20, y: 140 }
    });

    toast.showToast();
  }
</script>

<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$recover1Show = "none";
$mail = "";

if(isset($_POST["resetsubmit"])) {
	$mail = $mysqli->real_escape_string($_POST["resetmail"]);
	if($mail != "") {
		$query = $mysqli->query("SELECT userId, username, securityQuestions, email FROM player_accounts WHERE email = '".$mail."' OR username = '".$mail."'");
		$num = $query->num_rows;
		
		if($num > 0) {
			$key = generateRandomString(50);
			$userId = $query->fetch_assoc();
			if($userId["securityQuestions"] != null) {
				$recover1Show = "block";
			} else {
				$mysqli->query("UPDATE player_accounts SET pwResetKey = '".$key."' WHERE userId = ".$userId["userId"]);
				SMTP::SendMail($userId["email"], $userId["username"], 'E-mail verification password reset', '<p>Hello ' . $userId["username"] . ', <br><br>click this link to reset the password of your account: <a href="' . DOMAIN . 'api/resetpw/' . $userId["userId"] . '/' . $key . '">Reset</a><br><br>You are receiving this because you registered to the ' . SERVER_NAME . '.<br>If that was not your request, then you can ignore this email.<br>This is an automated message, please do not reply directly to this email.<br><br>Best regards, <br><br><img style="width: 300px;" src="https://api.ipfsbrowser.com/ipfs/get.php?hash=QmXd1qdgFfEUfgLJSK6RttE8SrnpNQheLPVSuVJHinYgxx"/></p>');
				
				echo "<script>toast('You have received an mail with further instructions.');</script>";
			}
		}
	}
} else if(isset($_POST["resetsubmit1"])) {
	$mail = $mysqli->real_escape_string($_POST["resetmail"]);
	$securityQuestion1 = $mysqli->real_escape_string($_POST["securityQuestion1"]);
	$securityQuestion2 = $mysqli->real_escape_string($_POST["securityQuestion2"]);
	$securityQuestion3 = $mysqli->real_escape_string($_POST["securityQuestion3"]);
	$sqa1 = $mysqli->real_escape_string($_POST["sqa1"]);
	$sqa2 = $mysqli->real_escape_string($_POST["sqa2"]);
	$sqa3 = $mysqli->real_escape_string($_POST["sqa3"]);
	
	if($mail != "" && $sqa1 != "" && $sqa2 != "" && $sqa3 != "") {
		$query = $mysqli->query("SELECT userId, username, securityQuestions FROM player_accounts WHERE email = '".$mail."' OR username = '".$mail."'");
		$fetch = $query->fetch_assoc();
		$loadSecurityQuestions = json_decode($fetch["securityQuestions"]);
		
		$valid = true;
		if(!password_verify($sqa1, $loadSecurityQuestions->sq1->answer)) $valid = false;
		if(!password_verify($sqa2, $loadSecurityQuestions->sq2->answer)) $valid = false;
		if(!password_verify($sqa3, $loadSecurityQuestions->sq3->answer)) $valid = false;
		if($securityQuestion1 != $loadSecurityQuestions->sq1->id) $valid = false;
		if($securityQuestion2 != $loadSecurityQuestions->sq2->id) $valid = false;
		if($securityQuestion3 != $loadSecurityQuestions->sq3->id) $valid = false;
		
		$query = $mysqli->query("SELECT userId, username, securityQuestions, email FROM player_accounts WHERE email = '".$mail."' OR username = '".$mail."'");
		$num = $query->num_rows;
		
		if($num > 0 && $valid) {
			$key = generateRandomString(50);
			$userId = $query->fetch_assoc();
			$mysqli->query("UPDATE player_accounts SET pwResetKey = '".$key."' WHERE userId = ".$userId["userId"]);
			
			echo "<meta http-equiv='refresh' content='0; URL=". DOMAIN . "api/resetpw/" . $userId["userId"] . "/" . $key . "'>";
		} else {
			echo "<script>toast('Security question answers are not correct.');</script>";
		}
	}
}
?>

<div id="reg" data-analyticscategory="registration">
    <div id="logo">
    </div>
<h1>
            <span></span>
    </h1>
            <div id="bgc_signup_short_container" class="bgc_signup_container bgc">
    <div class="bgc_signup_container_form">
        <form method="post" id="register-form" name="login-form" autocomplete="off">
            <fieldset class="bgc_signup_form_signup"><div class="bgc_input_text bgc_signup_form_username">
                    <label for="bgc_signup_form_username">Username</label>
                    <input maxlength="20" minlength="4" name="username" id="r-username" type="text"></div>
                <div class="bgc_input_password bgc_signup_form_password">
                    <label for="bgc_signup_form_password">Password</label>
                    <input maxlength="45" minlength="4" name="password" id="r-password" type="password"></div>
                <div class="bgc_input_password bgc_signup_form_repassword">
                    <label for="bgc_signup_form_password">Confirm Password</label>
                    <input maxlength="45" minlength="4" name="password_confirm" id="r-password_confirm" type="password"></div>
                <div class="bgc_input_email bgc_signup_form_email">
                    <label for="bgc_signup_form_email">Email</label>
                    <input maxlength="260" name="email" id="r-email" type="email"></div>

                <div id="gccc"><div class="g-recaptcha" style="padding-bottom: 15px;" data-sitekey="6LdTDnsiAAAAAEaMLYcov70JZ_-8aS3ZNsqFt0ZE"></div></div>
                
            </fieldset>

            <fieldset class="bgc_signup_form_legal"><div class="bgc_input_checkbox bgc_signup_form_termsAndConditions">
                    <input name="terms" id="r-terms" value="1" type="checkbox" placeholder="" style="
    margin-bottom: 50px;
    width: 25px;
    height: 25px;
    margin-top: 30px;
"><label id="label_termsAndConditions" for="bgc_signup_form_termsAndConditions">
                        <a class="link_tac" target="_blank" href="./termsandrules.php">Read and accept the terms.</a>
                    </label>
                </div>

            <div id="resultAll" style="border: 1px dashed red; width:100%; margin-top:10px; padding:5px; text-align:center; display:none;"></div>
                
            </fieldset><fieldset class="bgc_signup_form_buttons"><button class="bgc_button bgc_signup_form_back" type="button" onclick="window.location='/lp/main';return false;" >Volver</button><button class="bgc_button bgc_signup_form_register" type="submit" >Register</button></fieldset></form>
    </div>
</div>
<script language="javascript">if(window.BpEventStream && window.jQuery) (function() {window.jQuery(".bgcdw_remindpassword").click(function() { window.BpEventStream.track("account_forgotpassword_click"); });window.jQuery(".bgc_signup_form_register").click(function() { var e=[]; window.jQuery("div.bgcdw_errors ul").each(function(_,i){e.push(window.jQuery(i).attr("data-error"));}); if (!e || e.join("")=="") return; window.BpEventStream.track("account_signup_error", {"error":e.join(",")}); });function isVisible(elm) { if (!elm.is(":visible")) return false; var w=window.jQuery(window); if (elm.offset().top < w.scrollTop()) return false; if (elm.offset().top > w.scrollTop()+w.height()) return false; return true; }window.setTimeout(function() { if (isVisible(window.jQuery(".bgcdw_login_container"))) { window.BpEventStream.track("account_login_visible"); } else { window.setTimeout(arguments.callee, 500); } }, 100);window.setTimeout(function() { if (isVisible(window.jQuery(".bgc_signup_container"))) { window.BpEventStream.track("account_signup_visible"); } else { window.setTimeout(arguments.callee, 500); } }, 100);})()</script>        <div class="bgc_fbConnect_container_link bgc">
    
</div>
    </div>

<div id="login" data-analyticscategory="login">
    <div class="bgcdw_login_container bgc">

    <div class="bgcdw_login_container_form">
        <form id="login-form" name="login-form" method="post">
            <fieldset class="bgcdw_login_form_login"><div class="bgcdw_input_text bgcdw_login_form_username">
                    <label for="loginnick">Username</label>
                    <input id="loginnick" name="username" type="text" maxlength="20"></div>
                <div class="bgcdw_input_password bgcdw_login_form_password">
                    <label for="loginpass">Password</label>
                    <input id="loginpass" name="password" type="password" maxlength="45"></div>
            </fieldset>
            <div class="bgcdw_login_container_remindpassword">
                <a class="bgcdw_remindpassword" style="cursor:pointer;" onclick="javascript:pwRecovery();">Recover password</a>
            </div>
            <fieldset class="bgcdw_login_form_buttons"><button name="loginsubmit" id="loginsubmit" class="bgcdw_button bgcdw_login_form_login" type="submit" >Login</button></fieldset>
			<fieldset class="bgcdw_login_form_buttons" style="display:none;" id="autoLogin"><button id="autoLoginSubmit" class="bgcdw_button bgcdw_login_form_login" OnClick="return false;">Auto Login</button></fieldset>
			</form>
    </div>
</div>
    <div class="bgc_fbConnect_container_link bgc">
    
</div>
</div>

        <!--<p id="claim">
            <span>Start your adventure ...</span>
        </p>-->
                </div>
</div>

<script>
	function pwRecovery() {
		$("#recover").show();
		
		$("#close").unbind("tap click");
		$("#close").bind("tap click", function() {
			$("#recover").hide();
		});
	}
</script>

<style>
	#recover input, #recover1 input {
		border: none;
		border-radius: 2px;
		box-sizing: border-box;
		display: block;
		font-size: 1em;
		height: 27px;
		line-height: 27px;
		margin: 0 1px 0 0;
		padding: 0 8px;
		width: 180px;
	}
	
	#recover .bgcdw_button.bgcdw_login_form_login,#recover1 .bgcdw_button.bgcdw_login_form_login {
		background: #ffc923;
		color: #000;
		font-size: 15px !important;
		font-weight: 600;
		line-height: 10px;
	}

	#recover .bgcdw_button.bgcdw_login_form_login,#recover1 .bgcdw_button.bgcdw_login_form_login {
		padding: 0 20px;
	}
	#recover .bgcdw_button.bgcdw_login_form_login, #recover .bgc_fbConnect, #recover .rendar_bgc_fbConnect,#recover1 .bgcdw_button.bgcdw_login_form_login, #recover1 .bgc_fbConnect, #recover1 .rendar_bgc_fbConnect {
		cursor: pointer;
		text-align: center;
		width: auto;
	}
	
	#recover input, #recover button, #recover .bgc_fbConnect, #recover .rendar_bgc_fbConnect,#recover1 input, #recover1 button, #recover1 .bgc_fbConnect, #recover1 .rendar_bgc_fbConnect {
		border: none;
		border-radius: 2px;
		box-sizing: border-box;
		display: block;
		font-size: 1em;
		height: 27px;
		line-height: 27px;
		margin: 0 1px 0 0;
		padding: 0 8px;
		width: 180px;
	}
	
	.tmp {
		border: none;
	}
</style>

<div id="recover1" style="display: <?php echo $recover1Show; ?>;">
					<div style='width: 100%; height: 100%; position: absolute; top: 0px; left: 0px; background-color: rgba(0,0,0,0.5); z-index: 99;'>
						<div style='padding: 30px; text-align: center; color: white; position: relative; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 40%; height: 60%; border: 2px solid #fff1c5; background: linear-gradient(to bottom, rgba(31, 31, 31, 0.94) 0%, rgba(0, 0, 0, 0.97) 100% );'>
							<h2>Passwordreset</h2>
							<br><br><br><br>
							<p>Here you can reset your password. Please provide the security question answers here, to verify that the account belongs to you.</p>
							<br><br>
							<br><br>
							<div class="bgcdw_login_container bgc no-labels tmp">
								<div class="bgcdw_login_container_form">
									<form id="reset1-form" name="reset1-form" method="post">
										<fieldset class="bgcdw_login_form_login">
											<div class="bgcdw_input_text bgcdw_login_form_username" style="text-align: left !important;">
												<table style="width: 100%; font-size: 12px;">
													<tr><td><b>Security question 1:</b></td></tr>
													<tr><td><select name="securityQuestion1" class="select">
														<option value="sq1">What was your childhood nickname?</option>
														<option value="sq2">Where were you when you had your first kiss?</option>
														<option value="sq3">In what city or town was your first job?</option>
														<option value="sq4">Where were you when you first heard about 9/11?</option>
														<option value="sq5">What school did you attend for sixth grade?</option>
													</select></td></tr>
													<tr><td><input class="white-text" type="text" style="text-align:center" name="sqa1" id="sqa1" value="" maxlength="100" autocomplete="off"></td></tr>
													<!-- security question 2 -->
													<tr><td><b>Security question 2:</b></td></tr>
													<tr><td><select name="securityQuestion2" class="select">
														<option value="sq1">In what city did you meet your spouse/significant other?</option>
														<option value="sq2">What is the name of your favorite childhood friend?</option>
														<option value="sq3">What street did you live on in third grade?</option>
														<option value="sq4">What is your oldest cousin\s first and last name?</option>
														<option value="sq5">What was the name of your first stuffed animal?</option>
													</select></td></tr>
													<tr><td><input class="white-text" type="text" style="text-align:center" name="sqa2" id="sqa2" value="" maxlength="100" autocomplete="off"></td></tr>
													<!-- security question 3 -->
													<tr><td><b>Security question 3:</b></td></tr>
													<tr><td><select name="securityQuestion3" class="select">
														<option value="sq1">What is your maternal grandmother\s maiden name?</option>
														<option value="sq2">In what city does your nearest sibling live?</option>
														<option value="sq3">What is the first name of the boy or girl that you first kissed?</option>
														<option value="sq4">What was the last name of your third grade teacher?</option>
														<option value="sq5">What is the name of a college you applied to but didn\t attend?</option>
													</select></td></tr>
													<tr><td><input class="white-text" type="text" style="text-align:center" name="sqa3" id="sqa3" value="" maxlength="100" autocomplete="off"></td></tr>
												</table>
												<input id="resetmail" name="resetmail" type="hidden" value="<?php echo $mail; ?>"/>
												<fieldset class="bgcdw_login_form_buttons">
													<button name="resetsubmit1" id="resetsubmit1" style="float: right;" class="bgcdw_button bgcdw_login_form_login" type="submit">Reset</button>
												</fieldset>
											</div>
										</fieldset>
									</form> 
								</div>
							</div>
							<button name="close1" id="close1" style="position: absolute; bottom: 10px; right: 10px;" class="bgcdw_button bgcdw_login_form_login">Close</button>
						</div>
					</div>
				</div>
				<script>
					$("#close1").unbind("tap click");
					$("#close1").bind("tap click", function() {
						$("#recover1").hide();
					});
				</script>

<div id="recover" style="display: none;">
	<div style='width: 100%; height: 100%; position: absolute; top: 0px; left: 0px; background-color: rgba(0,0,0,0.5); z-index: 99;'>
		<div style='padding: 30px; text-align: center; color: white; position: relative; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 40%; height: 60%; border: 2px solid #fff1c5; background: linear-gradient(to bottom, rgba(31, 31, 31, 0.94) 0%, rgba(0, 0, 0, 0.97) 100% );'>
			<h2>Passwordreset</h2>
			<br><br><br><br>
			<p>Here you can reset your password. Please provide your mail address or username with that you have registered on our site. An confirmation mail will be send to the mail of the account. Please click at the link in this mail to change the password.</p>
			<br><br>
			<br><br>
			<div class="bgcdw_login_container bgc no-labels tmp">
				<div class="bgcdw_login_container_form">
					<form id="reset-form" name="reset-form" method="post">
						<fieldset class="bgcdw_login_form_login">
							<div class="bgcdw_input_text bgcdw_login_form_username">
								<label for="resetmail" style="display: none;">Mail address or username</label>
								<input id="resetmail" name="resetmail" type="text" maxlength="100"/>
							</div>
						</fieldset>
						<fieldset class="bgcdw_login_form_buttons">
							<button name="resetsubmit" id="resetsubmit" style="float: right;" class="bgcdw_button bgcdw_login_form_login" type="submit">Reset</button>
						</fieldset>
					</form> 
				</div>
			</div>
			<button name="close" id="close" style="position: absolute; bottom: 10px; right: 10px;" class="bgcdw_button bgcdw_login_form_login">Close</button>
		</div>
	</div>
</div>

    <div id="footer">
    <div class="container">

<?php

$playersOnline = Socket::Get('OnlineCount', array('Return' => "-"));

if ($playersOnline == "-"){
    $statusServer = "<font color=red>Offline</font>";
    $playersOnline = 0;
} else {
    $statusServer = "<font color=green>Online</font>";
}

?>
        
    <!--gl footer-->
<div id="gl_footer">
&copy; <?= SERVERNAME; ?>
&nbsp;·&nbsp;
Server status: <b><?= $statusServer; ?></b>
&nbsp;·&nbsp;
</div>


<div style="text-align:center;">
&nbsp;·&nbsp;
<a class="gl_footer_element_link" id="gl_footer_element_link_terms" href="./termsandrules.php" target="_blank">Terms and conditions</a>&nbsp;·&nbsp;
<!--&nbsp;·&nbsp;
<a class="gl_footer_element_link" id="gl_footer_element_link_forum" style="cursor:pointer;" onclick="javascript:alert('In developing.');" target="_blank">Board</a>--></div>
    
</div>
</div>

</div>

<?php require_once(INCLUDES . 'footer.php'); ?>

</body>
</html>