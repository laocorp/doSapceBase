<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/css/referals.css" />

<?php require_once(INCLUDES . 'data.php'); ?>
<title><?= htmlspecialchars(SERVERNAME, ENT_QUOTES, 'UTF-8'); ?> - Referals</title>
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
<div class="drones" style="display: block;">
<div style="width:100%; height:7%; border: 1px dashed #e30914; margin-bottom:15px;">
<h4>Hello <b><?= htmlspecialchars($player['pilotName'], ENT_QUOTES, 'UTF-8'); ?></b>, you win for invite players!</h4>
</div>
<br>
<div class="ranking">
<div style="width:100%; height:40px;">
<input type="submit" class="buttonRanking" id="buttonPlayers" onclick="changeRanking('5USERS');" value="5USERS" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px; border:1px solid green;"> <input type="submit" class="buttonRanking" id="buttonClans" onclick="changeRanking('10USERS');" value="10USERS" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;"> <input type="submit" class="buttonRanking" id="buttonUba" onclick="changeRanking('15USERS');" value="15USERS" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;"> <input type="submit" class="buttonRanking" id="buttonPlayers" onclick="changeRanking('20USERS');" value="20USERS" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;"> <input type="submit" class="buttonRanking" id="buttonPlayers" onclick="changeRanking('30USERS');" value="30USERS" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;">
</div>
</div>

<div id="5USERS" class="rankings">



<div style="border:1px dashed green; padding:15px; margin:auto; text-align:center;">

<td><img src="do_img/global/items/uridium.png" width="35px"> <img src="do_img/global/items/ammunition/laser/ucb-100_30x30.png" width="30px"> <img src="do_img/global/items/titles.png" width="30px">&nbsp;&nbsp 1.000.000 Uridium + 100.000 UCB-100 + Title permanent: Begginer Colaborator (Blue)</td><br>
<td><img src="do_img/global/items/eventcoins.png" width="35px">&nbsp;&nbsp 50 Event Coins</td>
</div>


</div>

<div id="10USERS" class="rankings" style="display:none;">


<div style="border:1px dashed green; padding:15px; margin:auto; text-align:center;">

<td><img src="do_img/global/items/uridium.png" width="35px"> <img src="do_img/global/items/ammunition/laser/ucb-100_30x30.png" width="30px"> <img src="do_img/global/items/titles.png" width="30px">&nbsp;&nbsp 2.000.000 Uridium + 200.000 UCB-100 + Title permanent: Newbie Colaborator (Blue)</td><br>
<td><img src="do_img/global/items/eventcoins.png" width="35px">&nbsp;&nbsp 100 Event Coins</td>
</div>

</div>

<div id="15USERS" class="rankings" style="display:none;">


<div style="border:1px dashed green; padding:15px; margin:auto; text-align:center;">

<td><img src="do_img/global/items/uridium.png" width="35px"> <img src="do_img/global/items/ammunition/laser/ucb-100_30x30.png" width="30px"> <img src="do_img/global/items/titles.png" width="30px">&nbsp;&nbsp 3.000.000 Uridium + 300.000 UCB-100 + Title permanent: Comander Colaborator (Blue)</td><br>
<td><img src="img/donate/dmg-b01_63x63.png" width="35px"> <img src="img/donate/shd-b01_63x63.png" width="35px"> <img src="img/donate/hp-b01_63x63.png" width="35px" > <img src="img/donate/rep-b01_63x63.png" width="35px" > <img src="img/donate/hon-b01_63x63.png" width="35px" >&nbsp;&nbsp 48h All Bossters!</td><br>
<td><img src="do_img/global/items/eventcoins.png" width="35px">&nbsp;&nbsp 150 Event Coins</td>

</div>

</div>

<div id="20USERS" class="rankings" style="display:none;">


<div style="border:1px dashed green; padding:15px; margin:auto; text-align:center;">

<td><img src="do_img/global/items/uridium.png" width="35px"> <img src="do_img/global/items/ammunition/laser/ucb-100_30x30.png" width="30px"> <img src="do_img/global/items/titles.png" width="30px">&nbsp;&nbsp 5.000.000 Uridium + 500.000 UCB-100 + Title permanent: Boss Colaborator (Green)</td><br>
<td><img src="img/donate/dmg-b01_63x63.png" width="35px"> <img src="img/donate/shd-b01_63x63.png" width="35px"> <img src="img/donate/hp-b01_63x63.png" width="35px" > <img src="img/donate/rep-b01_63x63.png" width="35px" > <img src="img/donate/hon-b01_63x63.png" width="35px" >&nbsp;&nbsp 3 days All Bossters!</td><br>
<td><img src="do_img/global/items/ship/solace/design/solace-asimov_100x100.png" width="50px"><strong style="color:green;"> RARE </strong>Solace-Asimov + Premium  <em>(10% shield + 15% hp + 5% honor) </em>	</td><br>
<td><img src="do_img/global/items/eventcoins.png" width="35px">&nbsp;&nbsp 200 Event Coins</td>

</div>

</div>


<div id="30USERS" class="rankings" style="display:none;">


<div style="border:1px dashed green; padding:15px; margin:auto; text-align:center;">

<td><img src="do_img/global/items/uridium.png" width="35px"> <img src="do_img/global/items/ammunition/laser/ucb-100_30x30.png" width="30px"> <img src="do_img/global/items/titles.png" width="30px">&nbsp;&nbsp 8.000.000 Uridium + 1.000.000 UCB-100 + Title permanent: General Colaborator (Red)</td><br>
<td><img src="img/donate/dmg-b01_63x63.png" width="35px"> <img src="img/donate/shd-b01_63x63.png" width="35px"> <img src="img/donate/hp-b01_63x63.png" width="35px" > <img src="img/donate/rep-b01_63x63.png" width="35px" > <img src="img/donate/hon-b01_63x63.png" width="35px" >&nbsp;&nbsp 7 days All Bossters!</td><br>
<td><img src="do_img/global/items/ship/solace/design/solace-asimov_100x100.png" width="50px"><strong style="color:green;"> RARE </strong>Solace-Asimov + Premium  <em>(10% shield + 15% hp + 5% honor) </em>	</td><br>
<td><img src="do_img/global/items/ship/g-champion/design/g-champion-tyrannos_100x100.png" width="50px"> <strong style="color:purple;"> LEGENDARY </strong> Champion-Tyrannos <em>(15% damage + 25% honor) + Premium </em></td><br>
<td><img src="do_img/global/items/eventcoins.png" width="35px">&nbsp;&nbsp 300 Event Coins</td>


</div>

</div>


<div style="font-weight: bold; color:red; padding-top:15px;">When you complete the referrals, contact discord to me: starorbit#8582 <font color='white'># <b></b></font></div>
<div style="font-weight: bold; color:red; padding-top:15px;">Discord Page: <font color='white'><a href="https://discord.gg/TY6mX3nJV9">!CLICK HERE!</a> <b></b></font></div>
<div id="message" style="text-align:center; border: 1px dashed green; padding:15px; margin:auto; width:50%; margin-top:15px; display:none;"></div>
</div>
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

    if (value == "5USERS"){
        document.getElementById("5USERS").style.display = "inline";

    } else if (value == "10USERS"){
        document.getElementById("10USERS").style.display = "inline";

    } else if (value == "15USERS"){
        document.getElementById("15USERS").style.display = "inline";

    } else if (value == "20USERS"){
        document.getElementById("20USERS").style.display = "inline";

    } else if (value == "30USERS"){
        document.getElementById("30USERS").style.display = "inline";

    }

}
</script>
<?php require_once(INCLUDES . 'footer.php'); ?>