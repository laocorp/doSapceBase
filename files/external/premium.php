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
<div class="page shop">
<div class="shop-container styleUpdate" style="border: 0px; border-bottom: 3px solid #ffc300 !important;">
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
    background-color: #15d0d4;
}
.h2, h2 {
    font-size: 30px;
    background-color: #15ed5a;
}

tr:nth-child(even) {
  background-color: #114acf;
}
</style>
</head>
<body>
<center>
<h2>PREMIUM SHOP</h2>
<p style="color:#9dc208 ">Donations are manually verified, rewards are given after verification,please be patient !
With these donations you contribute to the maintenance of the server. Thank you. Contact discord Admin: 
<a href="https://discord.gg/"><img src="/do_img/discrd.png" width="64" height="64"></a></p>
</center>
<table>
  <tr>
    <th>PACK</th>
    <th>PRICE</th>
	<th>BUY</th>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/uridium.png" width="50px"> 6500000 Uridium + Premium</td>
    <td>10.00€	</td>
    <td><a href="/paypal.php?p=1&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/uridium.png" width="50px"> <img src="https://cdn.iconscout.com/icon/free/png-64/offer-tag-label-sign-sticker-coupon-shop-shopping-12929.png"> 13000000 Uridium + Premium</td>
    <td>20.00€</td>
    <td><a href="/paypal.php?p=2&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
    <tr>
    <td><img src="/do_img/global/items/uridium.png" width="50px"> <img src="https://cdn.iconscout.com/icon/free/png-64/offer-tag-label-sign-sticker-coupon-shop-shopping-12929.png"> 27000000 Uridium + Premium</td>
    <td>30.00€</td>
    <td><a href="/paypal.php?p=3&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/eventcoins.png" width="50px">  500 E.C + Premium </td>
    <td>7.00€</td>
    <td><a href="/paypal.php?p=4&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
  
    <tr>
    <td><img src="/do_img/global/items/eventcoins.png" width="50px"> <img src="https://cdn.iconscout.com/icon/free/png-64/offer-tag-label-sign-sticker-coupon-shop-shopping-12929.png">  1500 E.C + Premium </td>
    <td>15.00€</td>
    <td><a href="/paypal.php?p=5&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/ship/solace/design/solace-asimov_100x100.png" width="50px"><strong style="color:green;"> RARE 1 </strong>Solace-Asimov + Premium  <em>(10% shield + 15% hp + 5% honor) </em>	</td>
    <td>10.00€</td>
    <td><a href="/paypal.php?p=6&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/ship/sentinel/design/sentinel-neikos_100x100.png" width="50px"> <strong style="color:green;"> RARE 2 </strong>Sentinel-Neikos <em>(15% Shield + 15% EXP) + Premium  </em>	</td>
    <td>10.00€</td>
    <td><a href="/paypal.php?p=7&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/ship/cyborg/design/cyborg-tyrannos_100x100.png" width="50px"> <strong style="color:orange;"> VERY RARE 1 </strong> Cyborg-Tyrannos <em>(10% damage + 10% shield) + Premium </em></td>
    <td>10.00€</td>
    <td><a href="/paypal.php?p=8&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
    <tr>
    <td><img src="/do_img/global/items/ship/cyborg/design/cyborg-inferno_100x100.png" width="50px"> <strong style="color:orange;"> VERY RARE 2 </strong> Cyborg-Inferno <em>(10% damage + 10% shield) + Premium </em></td>
   <td>10.00€</td>
    <td><a href="/paypal.php?p=9&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
    <tr>
    <td><img src="/do_img/global/items/ship/sentinel/design/sentinel-tyrannos_100x100.png" width="50px"> <strong style="color:purple;"> LEGENDARY 1 </strong> Sentinel-Tyrannos <em>(20% shield 5% Exp + 10% ) + Premium </em></td>
    <td>12.00€</td>
    <td><a href="/paypal.php?p=10&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
    <tr>
    <td><img src="do_img/global/items/ship/g-surgeon/design/g-surgeon_100x100.png" width="50px"> <strong style="color:purple;"> LEGENDARY 2 </strong> Surgeon <em>(5% shield + 5% hp ) + Premium </em></td>
	<td>15.00€</td>
    <td><a href="/paypal.php?p=11&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/ship/vengeance/design/lightning_top.png" width="50px"> <strong style="color:purple;"> LEGENDARY 3 </strong> Vengeance-Lightning <em>(17% damage + 20% shield + 17% hp + 20% honor + 20% exp) </em></td>
	<td>10.00€</td>
    <td><a href="/paypal.php?p=12&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/ship/vengeance/design/lightning_top.png" width="50px"> <strong style="color:purple;"> LEGENDARY 4 </strong> Vengeance-Lightning <em>(17% damage + 20% shield + 17% hp + 20% honor + 20% exp) + 2100000 Uridium + Premium </em></td>
	<td>25.00€</td>
    <td><a href="/paypal.php?p=13&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
  <tr>
    <td><img src="img/season/3.png" width="50px"><strong style="color:gold;"> EXCLUSIVE </strong> Pack Season Summer <em> (Solace-Contagion</em> + <em>title: "Summer Killer!" </em>+ <em>2100000 U. + 500 E.C.) + Premium </em></td>
	<td>25.00€</td>
    <td><a href="/paypal.php?p=14&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
	</tr>
  <tr>
    <td><img src="do_img/global/items/drone/designs/Spartan_drone.jpg" width="50px"><strong style="color:gold;"> EXCLUSIVE </strong> Pack Spartan_drone(20%DMG+35%HP+15%SHD Full Set (10x)</em></td>
	<td>20.00€</td>
    <td><a href="/paypal.php?p=15&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
  <tr>
    <td><img src="do_img/global/items/package.png" width="50px"> <strong style="color:purple;"> 15 LF-4 + 15+SG3N-BO2 </em></td>
	<td>15.00€</td>
    <td><a href="/paypal.php?p=16&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
  <tr>
    <td><img src="do_img/global/items/package.png" width="50px"> <strong style="color:purple;"> 32 LF-4 + 32+SG3N-BO2 </em></td>
	<td>25.00€</td>
    <td><a href="/paypal.php?p=17&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/ship/goliath/design/bastion_top.png" width="50px"> <strong style="color:purple;"> BASTION </strong> <em>(20% damage + 20% shield + 20% honor + 20% EXP + 20% HP) + Premium </em></td>
	<td>20.00€</td>
    <td><a href="/paypal.php?p=18&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/ship/goliath/design/enforcer_top.png" width="50px"> <strong style="color:purple;"> ENFORCER </strong> <em>(20% damage + 20% shield + 20% honor + 20% EXP + 20% HP) + Premium </em></td>
	<td>20.00€</td>
    <td><a href="/paypal.php?p=19&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
  <tr>
    <td> <img src="/do_img/global/items/ship/sentinel/design/sentinel-neikos_100x100.png" width="50px"> <img src="/do_img/global/items/ship/cyborg/design/cyborg-inferno_100x100.png" width="50px" style="margin-right: 1em;">  <img src="/do_img/global/items/razer_100x100.png" width="50px" style="margin-right: 1em;"><strong style="color:orange;"> VERY RARE 1 </strong> Pack Farmers <em>(Design: Sentinel-Neikos</em> + <em>Cyborg-Inferno</em> + <em>Goliath-Razer) + Premium </td>
    <td>25.00€</td>
    <td><a href="/paypal.php?p=22&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/2000.png"></a></td>
  </tr>
   <tr>
   
  </tr>
</table>

</body>
</html>

</div>
</div>
<?php require_once(INCLUDES . 'footer.php'); ?>
