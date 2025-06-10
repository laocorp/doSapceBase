<body id="backgroundImg" style="background:url('../public/img/companyChoose/neutral_wallpaper.jpg') no-repeat black;">
<link rel="stylesheet" href="/public/css/bootstrap-3.3.5.min2.css">
<link href="/public/css/font-awesome.min.css" rel="stylesheet" type='text/css'>
<link href='/public/css/Open.Sans.css' rel='stylesheet' type='text/css'>
<link href='/public/css/animate.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/public/css/v3b/style-1.css" />
<link rel="stylesheet" href="/public/css/v3b/stars.css" />
<link rel="stylesheet" href="/public/css/v3b/sense.css" />
<link rel="stylesheet" href="/public/css/perfect-scrollbar.min.css" />
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
</style>
<script type="text/javascript">

var user_faction_id = 0;

function select(div, facId) {
	
	if(facId == 1){
		$('#backgroundImg').css('background-image', 'url(../public/img/companyChoose/mmo_wallpaper.jpg)');
	} else if(facId == 2){
		$('#backgroundImg').css('background-image', 'url(../public/img/companyChoose/eic_wallpaper.jpg)');
	} else if(facId == 3){
		$('#backgroundImg').css('background-image', 'url(../public/img/companyChoose/vru_wallpaper.jpg)');
	} else {
		
	}
	
	$("#mmo").css("background-position", "-0 0");
	$("#mmo").css("background-size", "cover");
	$("#mmo").css("border", "1px solid gray");
	$("#mmo").css("opacity", "0.6");
	$("#mmo").html("");
	$("#eic").css("background-position", "-0 0");
	$("#eic").css("background-size", "cover");
	$("#eic").css("border", "1px solid gray");
	$("#eic").css("opacity", "0.6");
	$("#eic").html("");
	$("#vru").css("background-position", "-0 0");
	$("#vru").css("background-size", "cover");
	$("#vru").css("border", "1px solid gray");
	$("#vru").css("opacity", "0.6");
	$("#vru").html("");


	$(div).css("background-position", "-50px 0");
	$(div).css("background-size", "150%");
	$(div).css("border", "2px solid lightgreen");
	$(div).css("opacity", "1");

	var faction = $(div).data('faction');

	$(div).html('<button style="margin-top:410px; width:100px; height:35px; line-height:20px; font-size:20px;" class="btn btn-outline btn-success" onclick="selectFaction('+faction+');">Confirm</button>')

}
</script>
<header id="header" style="background:rgba(17,17,17,0);">
<div class="text-center">
<div class="logo">
<b class="logo_pink"><?= PHRASELOGO[0]; ?></b><b class="logo_normal"><?= PHRASELOGO[1]; ?></b>
</div>
<div class="logo_small">
<b class="logo_small">We Fix what Others have Destroyed</b>
</div>
</div>
</header>
<center>
<div style="width:700px; margin-top:60px; text-align:center; padding-bottom:150px;">
<div data-faction="1" id="mmo" onclick="select(this, 1);" class="company mmo"></div>
<div data-faction="2" id="eic" onclick="select(this, 2);" class="company eic"></div>
<div data-faction="3" id="vru" onclick="select(this, 3);" class="company vru"></div>
</div>
</center>

<?php require_once(INCLUDES . 'footer.php'); ?>