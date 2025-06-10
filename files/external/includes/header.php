<!DOCTYPE HTML>
<html class="no-js" lang="en">
<head>
<title><?= SERVERNAME; ?></title>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="StarOrbit is a Massive Multiplayer Online Roleplaying Space Game">
<meta name="keywords" content="Browser games, StarOrbit">
<meta name="robots" content="">
<meta http-equiv="Content-Language" content="en, us, tr">
<meta name="language" content="english, en, us">
<meta name="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="revisit-after" content="10 days">
<meta name="page-topic" content="Entertainment, Fun, Old School, PvP, PvE">

<script src="https://kit.fontawesome.com/4f90b43f8c.js" crossorigin="anonymous"></script>

<link type="text/css" rel="stylesheet" href="<?php echo DOMAIN; ?>css/custom/custom_index.css" />
<link rel="stylesheet" href="/css/w3.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="/js/hulloeffekt.js"></script> -->

<link rel="stylesheet" href="css/toastify.css" />
<script src="js/toastify.js"></script>

<style>
.top-bar .more-stats {
    float: left;
    margin: 0 10px;
    background: #2d2d2d;
    width: 70px;
    height: 47px;
    line-height: 50px;
    text-align: center;
}

.toastify {
  padding: 12px 20px;
  color: #ffffff;
  display: inline-block;
  box-shadow: 0 3px 6px -1px rgba(0, 0, 0, 0.12), 0 10px 36px -4px rgba(77, 96, 232, 0.3);
  background: -webkit-linear-gradient(315deg, #73a5ff, #5477f5);
  background: linear-gradient(135deg, #73a5ff, #5477f5);
  position: fixed;
  top: -150px;
  right: 15px;
  opacity: 0;
  transition: all 0.4s cubic-bezier(0.215, 0.61, 0.355, 1);
  border-radius: 2px;
  cursor: pointer;
}

.startbtn {
  color:green;
  font-size:22px;
}

.startbtn:hover {
  color:yellow;
  font-size:30px;
  border-top: solid 1px white;
}
</style>

<link href="/public/css/font-awesome.min.css" rel="stylesheet" type='text/css'>
<link href='/public/css/Open.Sans.css' rel='stylesheet' type='text/css'>
<link href='/public/css/animate.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/public/css/v3b/style-1.css?<?= rand(0,9999999); ?>" />
<link rel="stylesheet" href="/public/css/v3b/stars.css" />
<link rel="stylesheet" href="/public/css/v3b/style.css" />
<link rel="stylesheet" href="/public/css/v3b/sense.css" />
<link rel="stylesheet" href="/public/css/v3b/pages/1/index.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/public/css/perfect-scrollbar.min.css" />


<script>
snowStorm.snowColor = 'red';
snowStorm.flakesMaxActive = 96;
snowStorm.useTwinkleEffect = true;
</script>

</head>
<?php if (Functions::IsLoggedIn()) { ?>
<header id="header">
<div class="container-fluid">
<div class="row text-center">
<div class="logo">
<a title="StarOrbit" href="/home"><img src="/img/loginhome.png" width="330px" alt="StarOrbit" /></a>
</div>
<div class="buttons">
<?php if (self::checkIsAdmin($player['userId'])){ ?>
<a href="/adminServer" class="button"><i class="fa fa-wrench"></i></a>
<?php } ?>
<a href="<?= DISCORDINVITELINK; ?>" target="_blank" class="button" title="Discord Server">
<i class="fab fa-discord"></i></a>
<!---<a href="<?= FACEPAGE; ?>" target="_blank" class="button" title="Facebook Page">
<i class="fab fa-facebook-f"></i></a> -->
<a href="/settings" class="button" title="Settings"><i class="fa fa-cog"></i></a>
<a href="/Evoucher" class="button" title="Vouchers Code"><i class="fa fa-money "></i></a>
<a href="/BetaBugReport" class="button" title="Beta Bug Report System"><i class="fa fa-bug fg-red"></i></a>
<a href="/downloadclient" class="button" title="Download Client"><i class="fa fa-download"></i></a>
<a href="/api/logout" class="button logout" title="Logout"><i class="fa fa-sign-out"></i></a>
</div>
</div>
</div>
</header>
<div class="subheader">
<div class="container">
<div class="row">
<div class="buttons text-center">


<ul id="menu">
    <li>
        <a href="/"style="color:#00bbf9;">HOME</a>
    </li>
    <li>
        <a href="/"style="color:#00bbf9;">Upgrades</a>
        <ul>
            <li>
                <a href="UpgradeSystem"style="color:yellow">Upgrade</a>
            </li>
            <li>
                <a href="skill_tree"style="color:yellow">SkillTree</a>
            </li>
            <li>
                <a href="labor"style="color:yellow">Labor</a>
            </li>
            <li>
                <a href="Evoucher"style="color:yellow">Evoucher</a>
			</li>
            <li>
                <a href="Titles"style="color:yellow">Titles</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="/"style="color:#00bbf9;">SHIP</a>
        <ul>
            <li>
                <a href="ships"style="color:yellow">SHIP</a>
            </li>
            <li>
                <a href="equipment"style="color:yellow">HANGAR</a>
            </li>
        </ul>
    </li>
    <li>
	<a href="shop"style="color:#00bbf9;">SHOP</a>
        <ul>          
            </li>
        </ul>
    </li>
    <li>            
    <a href="donate"style="color:#00bbf9;">PREMIUM</a>
	<ul>          
            </li>
        </ul>
    </li>
    <li>     
	<a href="map"target="_blank"style="color:#39ff33;">START</a>
	</li>
    <li>
	<a href="/"style="color:yellow">Quests</a>
        <ul>
            <li>
                <a href="questsystem"style="color:yellow">Quests</a>
            </li>
            <li>
                <a href="E.C.Quest"style="color:yellow">E.C.Quest</a>
            </li>
        </ul>
    </li>
    <li>
	<a href="gg"style="color:#FF00FF">GalaxyGate</a>
    </li>
    <li>
	<a href="/"style="color:red;">Clan-TOP</a>
        <ul>
            <li>
                <a href="clan/join"style="color:yellow">Clan-Join</a>
            </li>
            <li>
                <a href="Toppilot"style="color:yellow">Pilot</a>
            </li>
            <li>
                <a href="TopSeason"style="color:yellow">Season</a>
            </li>
            <li>
                <a href="TopPvp"style="color:yellow">PvP</a>
			</li>
            <li>
                <a href="TopHonor"style="color:yellow">Honor</a>
			</li>
            <li>
                <a href="TopExperience"style="color:yellow">Expereince</a>          
    </li>
</ul> 

</div>
</div>

</div>
</div>
</div>
</div>
<?php } ?>