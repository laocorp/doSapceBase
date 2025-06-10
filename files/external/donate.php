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
    border: 1px solid #6f6969;
    text-align: left;
    padding: 8px;
    background-color: #181818;
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
<p style="color:#F1C232 ">Donations are manually verified, rewards are given after verification,please be patient !
With these donations you contribute to the maintenance of the server. Thank you.
 Contact discord Admin: Predator#0007
<a href="https://discord.gg/TY6mX3nJV9"target="_blank"style="color:#39ff33;"><img src="/do_img/dis.png" width="64" height="64"></a></p>
</center>
<table>
  <tr>
    <td><strong style="color:#F1C232;">PACK</th>
    <td><strong style="color:#F1C232;">PRICE</th>
	<td><strong style="color:#F1C232;">BUY</th>
	</tr>
   <tr>
    <td><img src="/do_img/global/items/ship/cyborg_100x100.png" width="50px"> <strong style="color:#9DC208;">Cyborg ships. <strong style="color:#9DC208;"> </em></td>
	<td><strong style="color:#9DC208;">5.99€</td>
    <td><a href="/paypal.php?p=1&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
  <tr>
    <td><img src="/do_img/item_laserpackxl_big.png" width="50px"> <strong style="color:#9DC208;"> 20 LF-4<br>20 BO3 Shield<br>5.000.000 Uridium<br>10 Level LF4 <br>10 Level B03 Shield <br>1 Week Premium
  </em></td>
	<td><strong style="color:#9DC208;">15.00€</td>
    <td><a href="/paypal.php?p=2&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
  <tr>
    <td><img src="/do_img/item_laserpackxl_big.png" width="50px"> <strong style="color:#9DC208;"> 40 LF-4<br>40 BO3 Shield<br>10.000.000 Uridium<br>16 Level LF4 <br>16 Level B03 Shield <br>2 Week Premium
  </em></td>
	<td><strong style="color:#9DC208;">30.00€</td>
    <td><a href="/paypal.php?p=3&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
   <tr>
    <td><img src="/do_img/global/items/premium.png"  width="50px">  <strong style="color:#9DC208;"> 2 Weeks premium  <strong style="color:#9DC208;"> </em></td>
	<td><strong style="color:#9DC208;">4.99€</td>
    <td><a href="/paypal.php?p=4&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
   <tr>
    <td><img src="/do_img/global/items/premium.png"  width="50px">  <strong style="color:#9DC208;"> 1 month premium  <strong style="color:#9DC208;"> </em></td>
	<td><strong style="color:#9DC208;">8.99€</td>
    <td><a href="/paypal.php?p=5&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
   <tr>   
    <td><img src="/do_img/global/items/eventcoins.png" width="50px"> <strong style="color:#9DC208;">  2000 E.C </td>
    <td><strong style="color:#9DC208;">3.99€</td>
    <td><a href="/paypal.php?p=6&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/eventcoins.png" width="50px"> <strong style="color:#9DC208;">  4500 E.C </td>
    <td><strong style="color:#9DC208;">6.99€</td>
    <td><a href="/paypal.php?p=7&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/eventcoins.png" width="50px"> <strong style="color:#9DC208;">  15000 E.C </td>
    <td><strong style="color:#9DC208;">14.99€</td>
    <td><a href="/paypal.php?p=8&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/eventcoins.png" width="50px"> <strong style="color:#9DC208;">  30000 E.C </td>
    <td><strong style="color:#9DC208;">24.99€</td>
    <td><a href="/paypal.php?p=9&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
  <tr>
    <td><img src="/do_img/global/items/eventcoins.png" width="50px"> <strong style="color:#9DC208;">  75000 E.C </td>
    <td><strong style="color:#9DC208;">40.99€</td>
    <td><a href="/paypal.php?p=10&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/uri1_big.png" width="50px">  <strong style="color:#9DC208;"> 500000 uridium </em></td>
	<td><strong style="color:#9DC208;">5.99€</td>
    <td><a href="/paypal.php?p=11&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/uri1_big.png" width="50px"> <strong style="color:#9DC208;"> 1500000 uridium </em></td>
	<td><strong style="color:#9DC208;">8.99€</td>
    <td><a href="/paypal.php?p=12&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
  </tr>
  <tr>
    <td><img src="/do_img/global/items/uri1_big.png" width="50px">  <strong style="color:#9DC208;"> 3000000 uridium </em></td>
	<td><strong style="color:#9DC208;">11.99€</td>
    <td><a href="/paypal.php?p=13&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
  <tr>
    <td><img src="/do_img/global/items/uri1_big.png" width="50px"> <strong style="color:#9DC208;"> 5000000 uridium </em></td>
	<td><strong style="color:#9DC208;">15.99€</td>
    <td><a href="/paypal.php?p=14&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
  <tr>
    <td><img src="/do_img/global/items/uri1_big.png" width="50px"> <strong style="color:#9DC208;"> 10000000 uridium </em></td>
	<td><strong style="color:#9DC208;">19.99€</td>
    <td><a href="/paypal.php?p=15&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
  <tr>
    <td><img src="/do_img/global/items/resource/gold-key_100x100.png" width="50px">  <strong style="color:#9DC208;"> 1 Gold Key.Contents:The system gives it randomly=
Goliath+Cyborg Desings.
These contents are available. </em></td>
	<td><strong style="color:#9DC208;">5.99€</td>
    <td><a href="/paypal.php?p=16&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
  <tr>
    <td><img src="/do_img/global/items/resource/gold-key_100x100.png" width="50px">  <strong style="color:#9DC208;"> 10 Gold Key.Contents:The system gives it randomly=
Goliath+Cyborg Desings.
These contents are available. </em></td>
	<td><strong style="color:#9DC208;">40.99€</td>
    <td><a href="/paypal.php?p=17&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
  <tr>
    <td><img src="/do_img/global/items/resource/booty-key-blue_100x100.png" width="50px">  <strong style="color:#9DC208;"> 100 Blue Key </em></td>
	<td><strong style="color:#9DC208;">10.99€</td>
    <td><a href="/paypal.php?p=18&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
  <tr>
    <td><img src="/do_img/global/items/resource/booty-key-blue_100x100.png" width="50px"> <strong style="color:#9DC208;"> 250 Blue Key </em></td>
	<td><strong style="color:#9DC208;">16.99€</td>
    <td><a href="/paypal.php?p=19&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
  <tr>
    <td><img src="/do_img/global/items/resource/booty-key-blacklight-decoder_100x100.png" width="50px"> <strong style="color:#9DC208;"> 10 E.C Key </em></td>
	<td><strong style="color:#9DC208;">7.99€</td>
    <td><a href="/paypal.php?p=20&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
  <tr>
    <td><img src="/do_img/global/items/resource/booty-key-blacklight-decoder_100x100.png" width="50px"> <strong style="color:#9DC208;"> 25 E.C Key </em></td>
	<td><strong style="color:#9DC208;">17.99€</td>
    <td><a href="/paypal.php?p=21&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
  <tr>
    <td><img src="/do_img/item_laserpackxl_big.png" width="50px"> <strong style="color:#9DC208;"> 20 Prometheusz<br>20 BO3 Shield<br>5.000.000 Uridium<br>10 Level Prometheusz <br>10 Level B03 Shield <br>2 Week Premium
  </em></td>
	<td><strong style="color:#9DC208;">25.00€</td>
    <td><a href="/paypal.php?p=22&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
	</tr>
  <tr>
    <td><img src="/do_img/item_laserpackxl_big.png" width="50px"> <strong style="color:#9DC208;"> 40 Prometheusz<br>40 BO3 Shield<br>10.000.000 Uridium<br>16 Level Prometheusz <br>16 Level B03 Shield <br>1 Month Premium<br>5000 E.C
  </em></td>
	<td><strong style="color:#9DC208;">50.00€</td>
    <td><a href="/paypal.php?p=23&i=<?= $player['userId']; ?>" target="_blank"><img src="/do_img/buy-now-green.png"></a></td>
    </tr>
  <tr>

    
    
    
 
 
  
   
  </tr>
</table>

</body>
</html>

</div>
</div>
<?php require_once(INCLUDES . 'footer.php'); ?>
