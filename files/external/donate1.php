
<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/css/donate.css" />

<?php require_once(INCLUDES . 'data.php'); ?>
<title><?= SERVERNAME; ?> - Donation</title>
<div class="page styleUpdate lab">
<div class="lab-container">
<div class="loader">
<div class="content">
<i class="fa fa-cog fa-spin"></i><br>
Loading
</div>
</div>
<div class="menu">
</div>
<div class="drones" style="display: block;"><br>
<div style="width:100%; height:4%; border: 1px">
<h3>DONATE SHOP</h3><br>
</div>
<br>
<div class="ranking">
<div style="width:100%; height:40px;">
<input type="submit" class="buttonRanking" id="buttonPlayers" onclick="changeRanking('PACK1');" value="Packs" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px; border:1px solid green;"> <input type="submit" class="buttonRanking" id="buttonClans" onclick="changeRanking('PACK2');" value="Uridium" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;"> <input type="submit" class="buttonRanking" id="buttonUba" onclick="changeRanking('PACK3');" value="EventCoins" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;"> <input type="submit" class="buttonRanking" id="buttonPlayers" onclick="changeRanking('PACK4');" value="Designs" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;"> <input type="submit" class="buttonRanking" id="buttonPlayers" onclick="changeRanking('PACK5');" value="Boosters" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;"> <input type="submit" class="buttonRanking" id="buttonPlayers" onclick="changeRanking('PACK6');" value="Titles" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;">
</div>
</div>

<div id="PACK1" class="rankings">



<div style="border:1px dashed green; padding:15px; margin:auto; text-align:center; overflow-y:scroll; height: 310px;">

<tr>
    <td><img src="/do_img/global/items/equipment/weapon/laser/pr-l_30x30.png" width="25px"> 
	<img src="/do_img/global/items/equipment/generator/shield/sg3n-b03_30x30.png" width="25px"> 
	<img src="/do_img/global/items/equipment/generator/speed/g3n-7900_30x30.png" width="25px"> 
	<strong style="color:yellow;"> Pack Initiate  </strong>
	<em> ( 40 Prometheus, 40 Bo3 shield and 20 G3n speed) + Premium + Special Title Bronze (Veteran SpaceHunter)</em></td>    
	<td><strong style="color:green;"> 15.00€ </strong></td>  
    <td><a href="/paypal.php?p=1&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr>
<br><br>
<tr>    
	<td><img src="/do_img/global/items/equipment/weapon/laser/pr-l_30x30.png" width="25px"> 
	<img src="/do_img/global/items/equipment/generator/shield/sg3n-b03_30x30.png" width="25px"> 
	<img src="/do_img/global/items/equipment/generator/speed/g3n-7900_30x30.png" width="25px"> 
	<strong style="color:gold;"> Pack Initiate Pro  </strong>
	<em> ( 40 Prometheus lvl 16, 40 Bo3 lvl 16 shield and 20 G3n speed) + Premium + Special Title Silver (Professional Hunter)</em></td>    
	<td><strong style="color:green;"> 25.00€ </strong></td>    
	<td><a href="/paypal.php?p=2&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr>
<br><br>
<tr>    
	<td> <img src="/do_img/global/items/ship/sentinel/design/sentinel-neikos_100x100.png" width="25px"> 
	<img src="/do_img/global/items/ship/cyborg/design/cyborg-inferno_100x100.png" width="25px" >  
	<img src="/do_img/global/items/razer_100x100.png" width="25px" >
	<strong style="color:orange;"> Pack Farmers </strong> 
	<em>(Design: Sentinel-Neikos</em> + <em>Cyborg-Inferno</em> + <em>Goliath-Razer) + Premium </td>    
	<td><strong style="color:green;"> 22.00€ </strong></td>    
	<td><a href="/paypal.php?p=3&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr>
<br><br>
<tr>    
	<td> <img src="/img/season/unionseason.png" width="25px"> <img src="/do_img/global/items/ship/cyborg/design/cyborg-smite_top.png" width="25px"> 
	<img src="do_img/global/items/titles.png" width="25px"> 
	<strong style="color:gold;"> Pack Union Season </strong>
	<em> (Cyborg-Smite (20%HP,20%SHD,20%DMG,30%HON,30%EXP)</em> + <em>title: "Star Killer" (Blue)" </em>+ <em>50.000.000 U. + 1000 E.C.) + Premium + Double Booster (BO1+BO2 HP SHD DMG) 1month. </em></td>    
	<td><strong style="color:green;"> 28.00€ </strong></td>    
	<td><a href="/paypal.php?p=4&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr>

</div>


</div>

<div id="PACK2" class="rankings" style="display:none;">


<div style="border:1px dashed green; padding:15px; margin:auto; text-align:center; overflow-y:scroll; height: 310px;">

<tr>    
	<td><img src="/do_img/global/items/uridium.png" width="25px"> 10.000.000 Uridium + Premium</td>    
	<td><strong style="color:green;"> 7.00€ </strong></td>    
	<td><a href="/paypal.php?p=5&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr>
<br><br>
<tr>    
	<td><img src="/do_img/global/items/uridium.png" width="25px"> 30.000.000 Uridium + Premium</td>    
	<td><strong style="color:green;"> 15.00€ </strong></td>    
	<td><a href="/paypal.php?p=6&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr>
<br><br>
<tr>    
	<td><img src="/do_img/global/items/uridium.png" width="25px"> 70.000.000 Uridium + Premium</td>    
	<td><strong style="color:green;"> 25.00€ </strong></td>    
	<td><a href="/paypal.php?p=7&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr>
<br><br>
<tr>    
<td><img src="/do_img/global/items/uridium.png" width="25px"> 200.000.000 Uridium + Premium</td>    
<td><strong style="color:green;"> 40.00€ </strong></td>    
<td><a href="/paypal.php?p=8&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr>

</div>

</div>

<div id="PACK3" class="rankings" style="display:none;">


<div style="border:1px dashed green; padding:15px; margin:auto; text-align:center; overflow-y:scroll; height: 310px;">

<tr>    
<td><img src="/do_img/global/items/eventcoins.png" width="25px">  1000 EventCoins + Premium </td>    
<td><strong style="color:green;"> 7.00€ </strong></td>    
<td><a href="/paypal.php?p=9&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr> 
<br><br>
<tr>    
<td><img src="/do_img/global/items/eventcoins.png" width="25px"> 2000 EventCoins + Premium </td>
<td><strong style="color:green;">10.00€ </strong></td>    
<td><a href="/paypal.php?p=10&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr>
<br><br>
<tr>    
<td><img src="/do_img/global/items/eventcoins.png" width="25px"> 5000 EventCoins + Premium </td>    
<td><strong style="color:green;">20.00€ </strong></td>    
<td><a href="/paypal.php?p=11&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr>
<br><br>
<tr>    
<td><img src="/do_img/global/items/eventcoins.png" width="25px"> 15000 EventCoins + Premium </td>    
<td><strong style="color:green;">35.00€ </strong></td>    
<td><a href="/paypal.php?p=12&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr>

</div>

</div>

<div id="PACK4" class="rankings" style="display:none;">


<div style="border:1px dashed green; padding:15px; margin:auto; text-align:center; overflow-y:scroll; height: 310px;">

<tr>    
	<td><img src="/do_img/global/items/ship/solace/design/solace-asimov_100x100.png" width="25px"><strong style="color:green;"> Solace-Asimov </strong> <em>(10% shield + 15% hp + 5% honor)  + Premium  </em>	</td>    
	<td><strong style="color:green;">9.00€ </strong></td>    
	<td><a href="/paypal.php?p=13&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr> 
<br><br>
<tr>    
	<td><img src="/do_img/global/items/ship/sentinel/design/sentinel-neikos_100x100.png" width="25px"> <strong style="color:green;"> Sentinel-Neikos </strong> <em>(15% Shield + 15% EXP) + Premium  </em>	</td>
	<td><strong style="color:green;">9.00€ </strong></td>    
	<td><a href="/paypal.php?p=14&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>  
</tr> 
<br> <br>
<tr>    
	<td><img src="/do_img/global/items/ship/cyborg/design/cyborg-tyrannos_100x100.png" width="25px"> <strong style="color:green;"> Cyborg-Tyrannos </strong>  <em>(10% damage + 10% shield) + Premium </em></td>    
	<td><strong style="color:green;">9.00€ </strong></td>    
	<td><a href="/paypal.php?p=15&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr> 
<br><br>   
<tr>    
	<td><img src="/do_img/global/items/ship/cyborg/design/cyborg-inferno_100x100.png" width="25px"> <strong style="color:orange;"> Cyborg-Inferno </strong> <em>(10% damage + 10% shield) + Premium </em></td>    
	<td><strong style="color:green;">10.00€ </strong></td>    
	<td><a href="/paypal.php?p=16&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td> 
</tr> 
<br> <br>  
<tr>    
	<td><img src="/do_img/global/items/ship/g-champion/design/g-champion-tyrannos_100x100.png" width="25px"> <strong style="color:gold;"> Champion-Tyrannos </strong> <em>(15% damage + 25% honor) + Premium </em></td>    
	<td><strong style="color:green;">15.00€ </strong></td>    
	<td><a href="/paypal.php?p=17&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td> 
</tr> 
<br>  <br> 
<tr>    
	<td><img src="/do_img/global/items/razer_100x100.png" width="25px"> <strong style="color:gold;"> Goliath-Razer </strong> <em>(15% damage + 15% shield + 20% hp + 20% honor) + Premium </em></td>    
	<td><strong style="color:green;">15.00€ </strong></td>    
	<td><a href="/paypal.php?p=18&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td> 
</tr> 
<br><br> 
<tr>    
	<td><img src="/do_img/global/items/ship/retiarus/design/retiarus-arios_top.png" width="25px"> <strong style="color:red;"> Retiarus-Arios </strong>  <em>(20% damage + 20% shield + 20% honor + 25% EXP) + Premium </em></td>
	<td><strong style="color:green;">20.00€ </strong></td>
	<td><a href="/paypal.php?p=19&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td> 
</tr> 
<br><br> 
<tr>    
	<td><img src="/do_img/global/items/ship/goliath/design/bastion_top.png" width="25px"> <strong style="color:gren;"> Bastion-Premium </strong> <em>(20% damage + 20% shield + 20% honor + 20% EXP + 20% HP) + Premium </em></td>    
	<td><strong style="color:green;">20.00€ </strong></td>    
	<td><a href="/paypal.php?p=20&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr> 
<br> <br>
<tr>    
	<td><img src="/do_img/global/items/ship/goliath/design/enforcer_top.png" width="25px"> <strong style="color:green;"> Enforcer-Premium </strong> <em>(20% damage + 20% shield + 20% honor + 20% EXP + 20% HP) + Premium </em></td>
	<td><strong style="color:green;">20.00€ </strong></td>    
	<td><a href="/paypal.php?p=21&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr>
<br>  <br>
<tr>    
	<td><img src="/do_img/global/items/ship/cyborg/design/cyborg-argon_top.png" width="25px"> <strong style="color:red;"> Cyborg-Argon </strong> <em>(20% damage + 20% shield + 20% honor + 20% EXP + 20% HP) + Premium </em></td>    
	<td><strong style="color:green;">20.00€ </strong></td>    
	<td><a href="/paypal.php?p=22&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>
</tr>
<br><br>
<tr>    
	<td><img src="/do_img/global/items/ship/solace/design/solace-contagion_top.png" width="25px"> <strong style="color:gold;"> Solace-Contagion </strong> <em>(15% damage + 15% shield + 10% HP + 25% honor + 25% EXP) + Premium </em></td>    
	<td><strong style="color:green;">15.00€ </strong></td>    
	<td><a href="/paypal.php?p=23&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td> 
</tr>
<br><br>
<tr>    
	<td><img src="/do_img/global/items/ship/cyborg/design/cyborg-smite_top.png" width="25px"> <strong style="color:gold;"> Cyborg-Smite </strong> <em>(20% damage + 20% shield + 20% HP + 30% honor + 30% EXP) + Premium </em></td>    
	<td><strong style="color:green;">20.00€ </strong></td>    
	<td><a href="/paypal.php?p=24&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td> 
</tr>
<br><br>
<tr>    
<td><img src="/do_img/global/items/ship/goliath/design/orion_top.png" width="25px"> <strong style="color:gold;"> Goliath-Orion </strong> <em>(25% damage + 25% shield + 25% HP + 30% honor ) + Premium </em></td>    
<td><strong style="color:green;">20.00€ </strong></td>    
<td><a href="/paypal.php?p=25&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>  
</tr>


</div>

</div>
<div id="PACK5" class="rankings" style="display:none;"><div style="border:1px dashed green; padding:15px; margin:auto; text-align:center; overflow-y:scroll; height: 310px;">

<tr>    
	<td><img src="/img/donate/booster_dmg-b01_100x100.png" width="25px">
	<img src="/img/donate/booster_dmg-b02_100x100.png" width="25px"> 
	<img src="/img/donate/booster_hp-b01_100x100.png" width="25px"> 
	<img src="/img/donate/booster_hp-b02_100x100.png" width="25px"> 
	<img src="/img/donate/booster_shd-b01_100x100.png" width="25px"> 
	<img src="/img/donate/booster_shd-b02_100x100.png" width="25px">
	<strong style="color:orange;"> Pack Booster PVP </strong><em>(Double Booster BO1 + BO2: DMG=30% + HP=30% + SHD=30% 30 Days</em>) </em></td>    
	<td><strong style="color:green;"> 10.00€ </strong></td>    
	<td><a href="/paypal.php?p=26&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>  
</tr>
<br><br>
<tr>    
	<td><img src="/img/donate/booster_hon-b01_100x100.png" width="25px">
	<img src="/img/donate/booster_hon-b02_100x100.png" width="25px"> 
	<img src="/img/donate/booster_xp-b01_100x100.png" width="25px"> 
	<img src="/img/donate/booster_xp-b02_100x100.png" width="25px"> 
	<img src="/img/donate/booster_hon-b02_100x100.png" width="25px"> 
	<img src="/img/donate/booster_xp-b02_100x100.png" width="25px">
	<strong style="color:orange;"> Pack Booster PVE </strong><em>(Double Booster BO1 + BO2 + 50%Booster: EXP=80% + HON=80% 30 Days</em>) </em></td>    
	<td><strong style="color:green;"> 12.00€ </strong></td>    
	<td><a href="/paypal.php?p=27&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>  
</tr>
<br><br>
<tr>    
	<td><img src="/img/donate/booster_hon-b01_100x100.png" width="25px">
	<img src="/img/donate/booster_hon-b02_100x100.png" width="25px"> 
	<img src="/img/donate/booster_xp-b01_100x100.png" width="25px"> 
	<img src="/img/donate/booster_xp-b02_100x100.png" width="25px"> 
	<img src="/img/donate/booster_hon-b02_100x100.png" width="25px"> 
	<img src="/img/donate/booster_xp-b02_100x100.png" width="25px"> 
	<img src="/img/donate/booster_hon-b01_100x100.png" width="25px">
	<img src="/img/donate/booster_hon-b02_100x100.png" width="25px"> 
	<img src="/img/donate/booster_xp-b01_100x100.png" width="25px"> 
	<img src="/img/donate/booster_xp-b02_100x100.png" width="25px"> 
	<img src="/img/donate/booster_hon-b02_100x100.png" width="25px"> 
	<img src="/img/donate/booster_xp-b02_100x100.png" width="25px">	
	<img src="/img/donate/booster_rep-b01_100x100.png" width="25px"> 
	<img src="/img/donate/booster_rep-b02_100x100.png" width="25px"> 
	<br> <strong style="color:orange;"> Pack Booster Professional </strong><em>(All booster for 30 days DMG=30% SHD=30% HP=30% REP=15% EXP=80% HON=80%</em>) + Premium + Special title blue (General Of Orbit) </em></td>    
	<td><strong style="color:green;"> 20.00€ </strong></td>    
	<td><a href="/paypal.php?p=28&i=<?= $player['userId']; ?>" target="_blank"><img src="https://i.imgur.com/wvBPBtC.png"></a></td>  
</tr>
 </div>
 </div>
 <div id="PACK6" class="rankings" style="display:none;"><div style="border:1px dashed green; padding:15px; margin:auto; text-align:center; overflow-y:scroll; height: 310px;">
 
 </div>
 </div>

<br><br>&nbsp;&nbsp Donations are manually verified, rewards are given after verification. It may take some time. Contact Discord: <strong>Chronos#8619</strong><br> <br> <strong>&nbsp;&nbsp Premium benefits:</strong> <br>    &nbsp;&nbsp;&nbsp * Disconect 5 seconds, free repair portal and situ.<br>    &nbsp;&nbsp;&nbsp * No advertising.<br>    &nbsp;&nbsp;&nbsp * Discount 50% uridium and e.c from shop.<br>    &nbsp;&nbsp;&nbsp * Title donator permanent.<br>    &nbsp;&nbsp;&nbsp * More speed rockets and premium bar.<br> &nbsp;&nbsp;&nbsp * Discord rank.<br> &nbsp;&nbsp;&nbsp * Special Title Donator.<br> &nbsp;&nbsp <strong>The premium duration only for a season!</strong> 
</div>
</div>
</div>

<script>
function changeRanking(value){
    var rankings = document.getElementsByClassName("rankings");
    var buttonRankings = document.getElementsByClassName("buttonRanking");

    for (i=0; i < rankings.length; i++){
        rankings[i].style.display = "none";
    }

    for (i=0; i < buttonRankings.length; i++){
        buttonRankings[i].style = "border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;";
    }

    if (value == "PACK1"){
        document.getElementById("PACK1").style.display = "inline";
        document.getElementById("buttonPlayers").style = "border:1px solid gray; background:rgba(30,30,30,0.6); height:30px; border:1px solid green;";
    } else if (value == "PACK2"){
        document.getElementById("PACK2").style.display = "inline";
        document.getElementById("buttonClans").style = "border:1px solid gray; background:rgba(30,30,30,0.6); height:30px; border:1px solid green;";
    } else if (value == "PACK3"){
        document.getElementById("PACK3").style.display = "inline";
        document.getElementById("buttonUba").style = "border:1px solid gray; background:rgba(30,30,30,0.6); height:30px; border:1px solid green;";
    } else if (value == "PACK4"){
        document.getElementById("PACK4").style.display = "inline";
        document.getElementById("buttonUba").style = "border:1px solid gray; background:rgba(30,30,30,0.6); height:30px; border:1px solid green;";
    } else if (value == "PACK5"){        document.getElementById("PACK5").style.display = "inline";        document.getElementById("buttonUba").style = "border:1px solid gray; background:rgba(30,30,30,0.6); height:30px; border:1px solid green;";    } else if (value == "PACK6"){        document.getElementById("PACK6").style.display = "inline";        document.getElementById("buttonUba").style = "border:1px solid gray; background:rgba(30,30,30,0.6); height:30px; border:1px solid green;";    }	

}
</script>
<?php require_once(INCLUDES . 'footer.php'); ?>