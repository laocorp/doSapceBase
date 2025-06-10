<body id="backgroundImg" style="background:url('../public/img/companyChoose/neutral_wallpaper.jpg') no-repeat black;">
<script src="/public/js/jquery-2.1.3.min.js"></script>
<style>
.company {
	width:210px; 
	cursor:pointer; 
	vertical-align: top; 
	height:400px; 
	margin-right:20px; 
	display:inline-block; 
	border:1px solid gray;
	background-size: cover;
    transition: opacity .4s ease-in-out; 
    opacity:0.6;
}
.btn, .btn-large, .btn-small {
    text-decoration: none;
    color: #fff;
    background-color: #26a69a;
    text-align: center;
    letter-spacing: .5px;
    -webkit-transition: background-color .2s ease-out;
    transition: background-color .2s ease-out;
    cursor: pointer;
}
.company:hover{
	opacity:1 !important;
}

.eic {
	background:url('../public/img/companyChoose/bg_character_eic.jpg');
	background-size: contain;
	background-repeat: no-repeat;
	opacity:0.6 !important;
}

.vru {
	background:url('../public/img/companyChoose/bg_character_vru.jpg');
	background-size: contain;
	background-repeat: no-repeat;
	opacity:0.6 !important;
}

.mmo {
	background:url('../public/img/companyChoose/bg_character_mmo.jpg');
	background-size: contain;
	background-repeat: no-repeat;
	opacity:0.6 !important;
}

.warningbox .warningtext {
    text-align: center;
    color: rgb(255, 255, 255);
}
.warningbox {
    border: 1px solid rgba(255,255,255,0.5);
    background-color: rgba(255,255,255,0.4);
    width: 500px;
    height: 125px;
    margin: 0 auto;
    margin-top: 20px;
    border-radius: 1px;
}
</style>
<title><?= SERVERNAME; ?> - Change Company</title>

<div class="warningbox"><div class="warningtext">Cause you are Changing your Company you need to pay an Change-Fee of <b>50.000 U.</b> so your Current Company lets you go.<br>You also will Lose:<br><br><b>- 50% of all Honor<br>- 30% of all Experience</b></div></div>
<center>
<div style="width:700px; margin-top:60px; text-align:center; padding-bottom:150px;">
<?php if ($player['factionId'] != 1) { ?>
<div data-faction-name="Mars Mining Operations" data-faction-id="1" id="mmo" href="#modal" class="company mmo modal-trigger"></div>
<?php } ?>
<?php if ($player['factionId'] != 2) { ?>
<div data-faction-name="Earth Industries Corporation" data-faction-id="2" href="#modal" class="company eic modal-trigger" ></div>
<?php } ?>
<?php if ($player['factionId'] != 3) { ?>

<div data-faction-name="Venus Resources Unlimited" data-faction-id="3" id="vru" href="#modal" class="company vru modal-trigger"></div>
<?php } ?>
</div>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 20%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
</center>

<div id="modal" class="modal grey darken-4 white-text">
  <div class="modal-content">
    <h4>Do you really want to switch companies?</h4>
    <h6>%faction_name%</h6>
 
   <p>In order for your company to let you go peacefully, you have to pay 50,000 Uridium. Since you're switching to a rival company, the new company will only recognize half of your current honor points - negative honor points will remain the same.</p>
   <a id="confirm-company-change" class="modal-close waves-effect waves-light btn grey darken-3">OK</a>
   <a class="modal-close waves-effect waves-light btn grey darken-2" onclick="document.getElementById('modal').style.display = 'none';">Close</a>

  </div>

</div>

<?php require_once(INCLUDES . 'footer.php'); ?>