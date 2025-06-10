<?php require_once(INCLUDES . 'header.php');
$shop = Functions::GetShop(); $player = Functions::GetPlayer(); ?>
<link rel="stylesheet" href="/public/css/premiun2.css">
<style>
.toast {
    border-radius: 2px;
    top: -35px;
    float: right;
    width: auto;
    margin-top: -100px;
    position: relative;
    max-width: 25%;
    height: auto;
    min-height: 88px;
    line-height: 1.5em;
    background-color: #323232;
    padding: 10px 25px;
    font-size: 2.1rem;
    font-weight: 500;
    color: #fff;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    cursor: default;
}
</style>
<?php require_once(INCLUDES . 'data.php'); ?>
<title><?= SERVERNAME; ?> - Donations</title>
<div class="page shop">
<div class="shop-container styleUpdate">
<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
    border: 1px solid #211f1f;
    text-align: left;
    padding: 8px;
    background-color: linen;
}
.h2, h2 {
    font-size: 30px;
    background-color: beige;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
<center>
&nbsp;&nbsp <h2>PREMIUM SHOP</h2>
</center>
<p style="color:green">&nbsp;&nbsp Donations are manually verified, rewards are given after verification. It may take some time. Contact Discord: <strong></strong>
<br> 
<br> 
<strong>&nbsp;&nbsp Premium benefits:</strong> 
<br> 
   &nbsp;&nbsp;&nbsp * Disconect 5 seconds, free repair portal and situ.
<br> 
   &nbsp;&nbsp;&nbsp * No advertising.
<br> 
   &nbsp;&nbsp;&nbsp * Discount 50% uridium and e.c from shop.
<br> 
   &nbsp;&nbsp;&nbsp * Title donator permanent.
<br> 
   &nbsp;&nbsp;&nbsp * More speed rockets and premium bar.
<br> 
&nbsp;&nbsp;&nbsp * Discord rank.
<br> 
<br> 
&nbsp;&nbsp <strong>The premium duration only for a season!</strong> 
</p>
<table>
  <tr>
    <th>PACK</th>
    <th>PRICE</th>
	<th>BUY</th>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/uridium.png" width="50px"> 10.000.000 Uridium + Premium</td>
    <td>10.00€	</td>
    <td>		   <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="10.000.000 Uridium + Premium (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="10.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form> </td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/uridium.png" width="50px"> <img src="https://cdn.iconscout.com/icon/free/png-64/offer-tag-label-sign-sticker-coupon-shop-shopping-12929.png"> 25.000.000 Uridium + Premium</td>
    <td>20.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="25.000.000 Uridium + Premium (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="20.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
    <tr>
    <td><img src="/do_img/global/items/uridium.png" width="50px"> <img src="https://cdn.iconscout.com/icon/free/png-64/offer-tag-label-sign-sticker-coupon-shop-shopping-12929.png"> 40.000.000 Uridium + Premium</td>
    <td>30.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="40.000.000 Uridium + Premium (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="30.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/eventcoins.png" width="50px">  500 E.C + Premium </td>
    <td>7.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="500 E.C + Premium (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="7.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
  
    <tr>
    <td><img src="/do_img/global/items/eventcoins.png" width="50px"> <img src="https://cdn.iconscout.com/icon/free/png-64/offer-tag-label-sign-sticker-coupon-shop-shopping-12929.png">  1500 E.C + Premium </td>
    <td>15.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="1500 E.C + Premium (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="15.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/ship/solace/design/solace-asimov_100x100.png" width="50px"><strong style="color:green;"> RARE 1 </strong>Solace-Asimov + Premium  <em>(10% shield + 15% hp + 5% honor) </em>	</td>
    <td>7.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="RARE 1 (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="9.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/ship/sentinel/design/sentinel-neikos_100x100.png" width="50px"> <strong style="color:green;"> RARE 2 </strong>Sentinel-Neikos <em>(15% Shield + 15% EXP) + Premium  </em>	</td>
    <td>7.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="RARE 2  (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="9.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/ship/cyborg/design/cyborg-tyrannos_100x100.png" width="50px"> <strong style="color:orange;"> VERY RARE 1 </strong> Cyborg-Tyrannos <em>(10% damage + 10% shield) + Premium </em></td>
    <td>7.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="VERY RARE 1 (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="9.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
    <tr>
    <td><img src="/do_img/global/items/ship/cyborg/design/cyborg-inferno_100x100.png" width="50px"> <strong style="color:orange;"> VERY RARE 2 </strong> Cyborg-Inferno <em>(10% damage + 10% shield) + Premium </em></td>
   <td>7.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="VERY RARE 2 (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="7.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
    <tr>
    <td><img src="/do_img/global/items/ship/g-champion/design/g-champion-tyrannos_100x100.png" width="50px"> <strong style="color:purple;"> LEGENDARY 1 </strong> Champion-Tyrannos <em>(15% damage + 25% honor) + Premium </em></td>
    <td>12.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="LEGENDARY 1 (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="12.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
    <tr>
    <td><img src="/do_img/global/items/razer_100x100.png" width="50px"> <strong style="color:purple;"> LEGENDARY 2 </strong> Goliath-Razer <em>(15% damage + 15% shield + 20% hp + 20% honor) + Premium </em></td>
	<td>15.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="LEGENDARY 2 (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="15.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
  <!---<tr>
    <td><img src="/do_img/global/items/ship/vengeance/design/lightning_top.png" width="50px"> <strong style="color:purple;"> LEGENDARY 3 </strong> Vengeance-Lightning <em>(20% damage + 20% shield + 20% hp + 20% honor) </em></td>
	<td>10.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="LEGENDARY 3 (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="10.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/ship/vengeance/design/lightning_top.png" width="50px"> <strong style="color:purple;"> LEGENDARY 4 </strong> Vengeance-Lightning <em>(20% damage + 20% shield + 20% hp + 20% honor) + 25.000.000 Uridium + Premium </em></td>
	<td>25.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="LEGENDARY 4 (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="25.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>---->
  <tr>
    <td><img src="/do_img/global/items/ship/retiarus/design/retiarus-arios_top.png" width="50px"> <strong style="color:purple;"> REITARUS </strong> ARIOS <em>(20% damage + 20% shield + 20% honor + 25% EXP) + Premium </em></td>
	<td>20.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="REITARUS-ARIOS (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="20.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/ship/goliath/design/bastion_top.png" width="50px"> <strong style="color:purple;"> BASTION </strong> <em>(20% damage + 20% shield + 20% honor + 20% EXP + 20% HP) + Premium </em></td>
	<td>20.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="BASTION + Premium (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="20.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/ship/goliath/design/enforcer_top.png" width="50px"> <strong style="color:purple;"> ENFORCER </strong> <em>(20% damage + 20% shield + 20% honor + 20% EXP + 20% HP) + Premium </em></td>
	<td>20.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="ENFORCER + Premium (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="20.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/ship/cyborg/design/cyborg-argon_top.png" width="50px"> <strong style="color:purple;"> CYBORG ARGON </strong> <em>(20% damage + 20% shield + 20% honor + 20% EXP + 20% HP) + Premium </em></td>
	<td>20.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="CYBORG ARGON + Premium (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="20.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
    <tr>
    <td><img src="/img/season/plagueseason.png" width="50px"> <img src="/do_img/global/items/ship/solace/design/solace-contagion_top.png" width="50px"> <img src="do_img/global/items/titles.png" width="50px"> <strong style="color:red;"> EXCLUSIVE </strong> Pack Plague <em> (Solace-Contagion (10%HP,15%SHD,15%DMG,25%HON,25%EXP)</em> + <em>title: "Infected Boss" (Green)" </em>+ <em>50.000.000 U. + 500 E.C.) + Premium + Double Booster 1month. </em></td>
    <td>25.00€ </td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="Pack Plague Season (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="25.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
    <tr>
    <td> <img src="/do_img/global/items/ship/sentinel/design/sentinel-neikos_100x100.png" width="50px"> <img src="/do_img/global/items/ship/cyborg/design/cyborg-inferno_100x100.png" width="50px" style="margin-right: 1em;">  <img src="/do_img/global/items/razer_100x100.png" width="50px" style="margin-right: 1em;"><strong style="color:orange;"> VERY RARE 1 </strong> Pack Farmers <em>(Design: Sentinel-Neikos</em> + <em>Cyborg-Inferno</em> + <em>Goliath-Razer) + Premium </td>
    <td>22.00€ </td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="VERY RARE 1  (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="22.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>
   <tr>
    <td><img src="/img/donate/booster_dmg-b02.png" width="50px"> <img src="/img/donate/booster_hp-b02.png" width="50px" style="margin-right: 1em;"> <img src="/img/donate/booster_shd-b02.png" width="50px" style="margin-right: 1em;"> <strong style="color:orange;"> VERY RARE 2 </strong> Pack Booster <em>(Double Booster: DMG + HP + SHD 30 Days</em>) </em></td>
    <td>15.00€</td>
    <td> <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
		   <input type="hidden" name="business" value="alexfrunza91@gmail.com"> 
		   <input type="hidden" name="cmd" value="_donations"> 
		   <input type="hidden" name="item_name" value="VERY RARE 2 (ID: <?php echo $player['userId']; ?> )"> 
		   <input type="hidden" name="amount" value="15.00"> 
		   <input type="hidden" name="custom" value=""> 
		   <input type="hidden" name="currency_code" value="EUR"> 
		   <input type="image" name="submit" border="0" src="https://i.imgur.com/wvBPBtC.png" alt="PayPal - The safer, easier way to pay online"> 
		   <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"> 
		   </form></td>
  </tr>

  
</table>

</body>
</html>

</div>
</div>
<?php require_once(INCLUDES . 'footer.php'); ?>
