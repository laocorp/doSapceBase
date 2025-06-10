<?php require_once(INCLUDES . 'header.php'); ?>
<script src="https://kit.fontawesome.com/4f90b43f8c.js" crossorigin="anonymous" type="text/javascript"></script>
<link rel="stylesheet" href="/css/quest.css" />
<?php require_once(INCLUDES . 'data.php'); ?>




<div class="logs styleUpdate" style="background-color:#1d1d1d99; width:800px; margin:auto; position:relative; left: 0px">
<h2 style="text-align:center; margin-left: 190px; color: dodgerblue; margin-bottom: 25px"></h2>
<div class="text ps-container">


<style>
#image {
	
	width: 85px;
	height: 50px;
	position: relative;
	left: 195px;
	top: 30px;
}

#image:hover {
	
}

#requiredKills {
	border: solid 1px #004a7f;
	width: 150px;
    position: relative;
    top: -35px;
    left: 490px;
	text-align: center;
	height: 37px;
	color:green;
	
}

#totalKilled {
	border: solid 1px #004a7f;
}

#description {
	border: solid 1px #004a7f;
	width: 300px;
    height: 100px;
    position: relative;
    left: 120px;
	overflow: auto;
	top: 40px;
	color: #0CFC29;
}

#rewards {
	border: solid 1px #004a7f;
	width: 190px;
    height: 170px;
    position: relative;
    left: 470px;
    top: -80px;
	color:lightgray;
}

#required {
	position: relative;
	top: 0px;
	left: 185px;
	color: yellow;
}

#target {
	position:relative;
	left: -120px;
	top: 15px;
	color: #0CFC29;
}

#desc {
	position: relative;
	top: 35px;
	left: -120px;
	color: red;
}

#reward {
	position:relative;
	top: -61px;
	left: 185px;
	color: red;
}

#items {
	font-size: 14px;
	margin-top: 12px;
	color: #33d7ff;
}




<!--Ship KELL-->
#ship85 , #ship23 , #ship34 , #ship36 , #ship44,
#ship71 , #ship24 , #ship37 , #ship75 , #ship25,
#ship38 , #ship73 , #ship31 , #ship43 , #ship72,
#ship26 , #ship39 , #ship74 , #ship46 , #ship47,
#ship76 , #ship27 , #ship40 , #ship77 , #ship28,
#ship41 , #ship78 , #ship29 , #ship42 , #ship79,
#ship35 , #ship45 , #ship80 , #ship81 , #ship107,
#ship105 , #ship99 , #ship118 , #ship116 , #ship103,
#ship84 , #ship33 , #ship83 , #ship11 , #ship126,
#ship127 , #ship122 , #ship124 , #ship119 , #ship123,
#ship82 , #ship97 , #ship96 , #ship95 , #ship90,
#ship91 , #ship92 , #ship93 , #ship94 , #ship21,
#ship32 , #ship114 , #ship111 , #ship113 , #ship112,
#ship115 , #ship216 , #ship215 , #ship214 , #ship213 ,
#ship6040 , #ship6039 , #ship6038 , #ship6037 , #ship6036,
#ship6035 , #ship6034 , #ship6033 , #ship6032 , #ship6031,
#ship6030 , #ship6029 , #ship6028 , #ship6027 , #ship6026,
#ship6025 , #ship6024 , #ship6023 , #ship6022 , #ship6021,
#ship6020 , #ship6019 , #ship6018 , #ship6017 , #ship6016,
#ship6015 , #ship6014 , #ship6013 , #ship6012 , #ship6011,
#ship6010 , #shi6009 , #ship6008 , #ship6007 , #ship6006,
#ship6005 , #ship6004 , #ship6003 , #ship6002 , #ship6001,
#ship6000  {
	color: red;
}


<!--Ship KELL-->
#ship85 , #ship23 , #ship34 , #ship36 , #ship44,
#ship71 , #ship24 , #ship37 , #ship75 , #ship25,
#ship38 , #ship73 , #ship31 , #ship43 , #ship72,
#ship26 , #ship39 , #ship74 , #ship46 , #ship47,
#ship76 , #ship27 , #ship40 , #ship77 , #ship28,
#ship41 , #ship78 , #ship29 , #ship42 , #ship79,
#ship35 , #ship45 , #ship80 , #ship81 , #ship107,
#ship105 , #ship99 , #ship118 , #ship116 , #ship103,
#ship84 , #ship33 , #ship83 , #ship11 , #ship126,
#ship127 , #ship122 , #ship124 , #ship119 , #ship123,
#ship82 , #ship97 , #ship96 , #ship95 , #ship90,
#ship91 , #ship92 , #ship93 , #ship94 , #ship21,
#ship32 , #ship114 , #ship111 , #ship113 , #ship112,
#ship115 , #ship216 , #ship215 , #ship214 , #ship213 ,
#ship6040 , #ship6039 , #ship6038 , #ship6037 , #ship6036,
#ship6035 , #ship6034 , #ship6033 , #ship6032 , #ship6031,
#ship6030 , #ship6029 , #ship6028 , #ship6027 , #ship6026,
#ship6025 , #ship6024 , #ship6023 , #ship6022 , #ship6021,
#ship6020 , #ship6019 , #ship6018 , #ship6017 , #ship6016,
#ship6015 , #ship6014 , #ship6013 , #ship6012 , #ship6011,
#ship6010 , #shi6009 , #ship6008 , #ship6007 , #ship6006,
#ship6005 , #ship6004 , #ship6003 , #ship6002 , #ship6001,
#ship6000  {
	color: red;
}

<!--Finished KELL-->


</style>


<!--********************************************************************************************************************************************************************************-->
<!--	..::{Streuner}::..		-->
<button class="menu">Streuner</button>
<div id="PACK34" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/streuner.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship84" style=""><?php echo number_format($killedNpc->ship84, 0, ',', '.'); ?></a> / 300</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission1">Kill 300 Streuner(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items" style="margin-bottom:4px">50 E.C.
	</div>
	<?php if ($killedNpc->ship84 >= 300) { ?>
		<style>
		#ship84 {
			color: green;
		}
		#mission1 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	..::{ Boss Streuner }::..		-->
<button class="menu">Boss Streuner</button>
<div id="PACK35" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/B-Streuner.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship23" style=""><?php echo number_format($killedNpc->ship23, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission2">Kill 200 Boss Streuner(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 65 E.C
	</div>
	<?php if ($killedNpc->ship23 >= 200) { ?>
		<style>
		#ship23 {
			color: green;
		}
		#mission2 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	..::{Lordakia}::..		-->
<button class="menu">Lordakia</button>
<div id="PACK5" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/lordakia.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship71" style=""><?php echo number_format($killedNpc->ship71, 0, ',', '.'); ?></a> / 300</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission3">Kill 300 Lordakia(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 60 E.C
	</div>
	<?php if ($killedNpc->ship71 >= 300) { ?>
		<style>
		#ship71 {
			color: green;
		}
		#mission3 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	..::{Saimon}::..		-->
<button class="menu">Saimon</button>
<div id="PACK8" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/saimon.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship75" style=""><?php echo number_format($killedNpc->ship75, 0, ',', '.'); ?></a> / 150</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission4">Kill 150 Saimon(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 65 E.C
	</div>
	<?php if ($killedNpc->ship75 >= 150) { ?>
		<style>
		#ship75 {
			color: green;
		}
		#mission4 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	..::{Mordon}::..		-->
<button class="menu">Mordon</button>
<div id="PACK11" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/mordon.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship73" style=""><?php echo number_format($killedNpc->ship73, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission5">Kill 200 Mordon(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 75 E.C
	</div>
	<?php if ($killedNpc->ship73 >= 200) { ?>
		<style>
		#ship73 {
			color: green;
		}
		#mission5 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	..::{Devolarium}::..		-->
<button class="menu">Devolarium</button>
<div id="PACK14" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/devolarium.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship72" style=""><?php echo number_format($killedNpc->ship72, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission6">Kill 200 Devolarium(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 100 E.C
	</div>
	<?php if ($killedNpc->ship72 >= 200) { ?>
		<style>
		#ship72 {
			color: green;
		}
		#mission6 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	..::{Sibelon}::..		-->
<button class="menu">Sibelon</button>
<div id="PACK17" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/sibelon.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship74" style=""><?php echo number_format($killedNpc->ship74, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission7">Kill 200 Sibelon(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 125 E.C
	</div>
	<?php if ($killedNpc->ship74 >= 200) { ?>
		<style>
		#ship74 {
			color: green;
		}
		#mission7 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	..::{Sibelonit}::..		-->
<button class="menu">Sibelonit</button>
<div id="PACK20" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/sibelonit.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship76" style=""><?php echo number_format($killedNpc->ship76, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission8">Kill 200 Sibelonit(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 100 E.C
	</div>
	<?php if ($killedNpc->ship76 >= 200) { ?>
		<style>
		#ship76 {
			color: green;
		}
		#mission8 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	-=[ Lordakium ]=-	-->
<button class="menu">Lordakium</button>
<div id="PACK23" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/lordakium.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship77" style=""><?php echo number_format($killedNpc->ship77, 0, ',', '.'); ?></a> / 150</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission9">Kill 150 Lordakium(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 150 E.C
	</div>
	<?php if ($killedNpc->ship77 >= 150) { ?>
		<style>
		#ship77 {
			color: green;
		}
		#mission9 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	-=[ Kristallin ]=-	-->
<button class="menu">Kristallin</button>
<div id="PACK26" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/kristallin.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship78" style=""><?php echo number_format($killedNpc->ship78, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission10">Kill 200 Kristallin(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 120 E.C
	</div>
	<?php if ($killedNpc->ship78 >= 200) { ?>
		<style>
		#ship78 {
			color: green;
		}
		#mission10 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	-=[ Kristallon ]=-	-->
<button class="menu">Kristallon</button>
<div id="PACK29" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/kristallon.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship79" style=""><?php echo number_format($killedNpc->ship79, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission11">Kill 200 Kristallon(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 180 E.C
	</div>
	<?php if ($killedNpc->ship79 >= 200) { ?>
		<style>
		#ship79 {
			color: green;
		}
		#mission11 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	..::{ StreuneR}::..	-->
<button class="menu">StreuneR</button>
<div id="PACK1" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/StreuneR8.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship85" style=""><?php echo number_format($killedNpc->ship85, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission12">Kill 200 StreuneR(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 100 E.C
	</div>
	<?php if ($killedNpc->ship85 >= 200) { ?>
		<style>
		#ship85 {
			color: green;
		}
		#mission12 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	..::{Cubikon}::..	-->
<button class="menu">Cubikon</button>
<div id="PACK32" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/cubikon.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship80" style=""><?php echo number_format($killedNpc->ship80, 0, ',', '.'); ?></a> / 50</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission13">Kill 50 Cubikon(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 500 E.C
	</div>
	<?php if ($killedNpc->ship80 >= 50) { ?>
		<style>
		#ship80 {
			color: green;
		}
		#mission13 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	-=[ Protegit]=-	-->
<button class="menu">Protegit</button>
<div id="PACK33" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/protegit.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship81" style=""><?php echo number_format($killedNpc->ship81, 0, ',', '.'); ?></a> / 300</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission14">Kill 300 Protegit(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 150 E.C
	</div>
	<?php if ($killedNpc->ship81 >= 300) { ?>
		<style>
		#ship81 {
			color: green;
		}
		#mission14 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	[ Uber-Streuner ]	-->
<button class="menu">Uber-Streuner</button>
<div id="PACK3" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/U-Streuner.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship36" style=""><?php echo number_format($killedNpc->ship36, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission15">Kill 200 Uber-Streuner(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 100 E.C
	</div>
	<?php if ($killedNpc->ship36 >= 200) { ?>
		<style>
		#ship36 {
			color: green;
		}
		#mission15 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	..::( Boss Lordakia )::..	-->
<button class="menu">Boss Lordakia</button>
<div id="PACK6" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/B-Lordakia.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship24" style=""><?php echo number_format($killedNpc->ship24, 0, ',', '.'); ?></a> / 300</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission16">Kill 300 Boss Lordakia(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 100 E.C
	</div>
	<?php if ($killedNpc->ship24 >= 300) { ?>
		<style>
		#ship24 {
			color: green;
		}
		#mission16 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	[ Uber-Lordakia ]	-->
<button class="menu">Uber-Lordakia</button>
<div id="PACK7" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/U-Lordakia.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship37" style=""><?php echo number_format($killedNpc->ship37, 0, ',', '.'); ?></a> / 250</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission17">Kill 250 Uber-Lordakia(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 150 E.C
	</div>
	<?php if ($killedNpc->ship37 >= 250) { ?>
		<style>
		#ship37 {
			color: green;
		}
		#mission17 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	-=[ Boss StreuneR ]=-	-->
<button class="menu">Boss StreuneR</button>
<div id="PACK2" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/B-StreuneR8.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship34" style=""><?php echo number_format($killedNpc->ship34, 0, ',', '.'); ?></a> / 300</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission18">Kill 300 Boss StreuneR(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 120 E.C
	</div>
	<?php if ($killedNpc->ship34 >= 300) { ?>
		<style>
		#ship34 {
			color: green;
		}
		#mission18 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	-=[ Boss Saimon ]=-	-->
<button class="menu">Boss Saimon</button>
<div id="PACK9" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/B-Saimon.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship25" style=""><?php echo number_format($killedNpc->ship25, 0, ',', '.'); ?></a> / 250</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission19">Kill 250 Boss Saimon(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 100 E.C
	</div>
	<?php if ($killedNpc->ship25 >= 250) { ?>
		<style>
		#ship25 {
			color: green;
		}
		#mission19 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************-->


<!--	[ Uber-Saimon ]	-->
<button class="menu">Uber-Saimon</button>
<div id="PACK10" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/U-saimon.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship38" style=""><?php echo number_format($killedNpc->ship38, 0, ',', '.'); ?></a> / 280</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission20">Kill 280 Uber-Saimon(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 150 E.C
	</div>
	<?php if ($killedNpc->ship38 >= 280) { ?>
		<style>
		#ship38 {
			color: green;
		}
		#mission20 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	-=[ Boss Mordon]=-	-->
<button class="menu">Boss Mordon</button>
<div id="PACK12" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/B-Mordon.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship31" style=""><?php echo number_format($killedNpc->ship31, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission21">Kill 200 Boss Mordon(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 150 E.C
	</div>
	<?php if ($killedNpc->ship31 >= 200) { ?>
		<style>
		#ship31 {
			color: green;
		}
		#mission21 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	[ Uber-Mordon ]	-->
<button class="menu">Uber-Mordon</button>
<div id="PACK13" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/U-Mordon.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship43" style=""><?php echo number_format($killedNpc->ship43, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission22">Kill 200 Uber-Mordon(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 200 E.C
	</div>
	<?php if ($killedNpc->ship43 >= 200) { ?>
		<style>
		#ship43 {
			color: green;
		}
		#mission22 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	-=[ Boss Devolarium ]=-	-->
<button class="menu">Boss Devolarium</button>
<div id="PACK15" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/B-Devolarium.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship26" style=""><?php echo number_format($killedNpc->ship26, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission23">Kill 200 Boss Devolarium(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 200 E.C
	</div>
	<?php if ($killedNpc->ship26 >= 200) { ?>
		<style>
		#ship26 {
			color: green;
		}
		#mission23 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	[ Uber-Devolarium ]	-->
<button class="menu">Uber-Devolarium</button>
<div id="PACK16" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/U-Devolarium.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship39" style=""><?php echo number_format($killedNpc->ship39, 0, ',', '.'); ?></a> / 150</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission24">Kill 150 Uber-Devolarium(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 300 E.C
	</div>
	<?php if ($killedNpc->ship39 >= 150) { ?>
		<style>
		#ship39 {
			color: green;
		}
		#mission24 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	-=[ Boss-Sibelon ]=-	-->
<button class="menu">Boss-Sibelon</button>
<div id="PACK18" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/B-Sibelon.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship46" style=""><?php echo number_format($killedNpc->ship46, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission25">Kill 200 Boss-Sibelon(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 250 E.C
	</div>
	<?php if ($killedNpc->ship46 >= 200) { ?>
		<style>
		#ship46 {
			color: green;
		}
		#mission25 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	[ Uber Sibelon ]	-->
<button class="menu">Uber Sibelon</button>
<div id="PACK19" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/U-sibelon.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship47" style=""><?php echo number_format($killedNpc->ship47, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission26">Kill 200 Uber Sibelon(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 450 E.C
	</div>
	<?php if ($killedNpc->ship47 >= 200) { ?>
		<style>
		#ship47 {
			color: green;
		}
		#mission26 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	..::( Boss Sibelonit )::..	-->
<button class="menu">Boss Sibelonit</button>
<div id="PACK21" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/B-Sibelonit.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship27" style=""><?php echo number_format($killedNpc->ship27, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission27">Kill 200 Boss Sibelonit(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 150 E.C
	</div>
	<?php if ($killedNpc->ship27 >= 200) { ?>
		<style>
		#ship27 {
			color: green;
		}
		#mission27 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	[ Uber-Sibelonit ]	-->
<button class="menu">Uber-Sibelonit</button>
<div id="PACK22" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/U-sibelonit.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship40" style=""><?php echo number_format($killedNpc->ship40, 0, ',', '.'); ?></a> / 300</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission28">Kill 300 Uber-Sibelonit(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 300 E.C
	</div>
	<?php if ($killedNpc->ship40 >= 300) { ?>
		<style>
		#ship40 {
			color: green;
		}
		#mission28 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	..::( Boss Lordakium )::..	-->
<button class="menu">Boss Lordakium</button>
<div id="PACK24" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/B-Lordakium.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship28" style=""><?php echo number_format($killedNpc->ship28, 0, ',', '.'); ?></a> / 150</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission29">Kill 150 Boss Lordakium(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 300 E.C
	</div>
	<?php if ($killedNpc->ship28 >= 150) { ?>
		<style>
		#ship28 {
			color: green;
		}
		#mission29 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	[ Uber-Lordakium ]	-->
<button class="menu">Uber-Lordakium</button>
<div id="PACK25" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/U-lordakium.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship41" style=""><?php echo number_format($killedNpc->ship41, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission30">Kill 200 Uber-Lordakium(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 500 E.C
	</div>
	<?php if ($killedNpc->ship41 >= 200) { ?>
		<style>
		#ship41 {
			color: green;
		}
		#mission30 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	..::{ Boss Kristallin }::..	-->
<button class="menu">Boss Kristallin</button>
<div id="PACK27" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/B-Kristallin.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship29" style=""><?php echo number_format($killedNpc->ship29, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission31">Kill 200 Boss Kristallin(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 300 E.C
	</div>
	<?php if ($killedNpc->ship29 >= 200) { ?>
		<style>
		#ship29 {
			color: green;
		}
		#mission31 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	[ Uber Kristallin ]	-->
<button class="menu">Uber Kristallin</button>
<div id="PACK28" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/U-Kristallin.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship42" style=""><?php echo number_format($killedNpc->ship42, 0, ',', '.'); ?></a> / 150</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission32">Kill 150 Uber Kristallin(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 450 E.C
	</div>
	<?php if ($killedNpc->ship42 >= 150) { ?>
		<style>
		#ship42 {
			color: green;
		}
		#mission32 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	..::{ Boss Kristallon }::..	-->
<button class="menu">Boss Kristallon</button>
<div id="PACK30" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/B-Kristallon.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship35" style=""><?php echo number_format($killedNpc->ship35, 0, ',', '.'); ?></a> / 150</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission33">Kill 150 Boss Kristallon(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 450 E.C
	</div>
	<?php if ($killedNpc->ship35 >= 150) { ?>
		<style>
		#ship35 {
			color: green;
		}
		#mission33 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	[ Uber-Kristallon ]	-->
<button class="menu">Uber-Kristallon</button>
<div id="PACK31" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/U-Kristallon.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship45" style=""><?php echo number_format($killedNpc->ship45, 0, ',', '.'); ?></a> / 150</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission34">Kill 150 Uber-Kristallon(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 650 E.C
	</div>
	<?php if ($killedNpc->ship45 >= 150) { ?>
		<style>
		#ship45 {
			color: green;
		}
		#mission34 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	[ Uber-StreuneR ]	-->
<button class="menu">Uber-StreuneR</button>
<div id="PACK4" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/U-StreuneR8.gif" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship44" style=""><?php echo number_format($killedNpc->ship44, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission35">Kill 200 Uber-StreuneR(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 250 E.C
	</div>
	<?php if ($killedNpc->ship44 >= 200) { ?>
		<style>
		#ship44 {
			color: green;
		}
		#mission35 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	Impulse II	-->
<button class="menu">Impulse II</button>
<div id="PACK36" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/purpose.png" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship213" style=""><?php echo number_format($killedNpc->ship213, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission36">Kill 200 Impulse II(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 1000 E.C
	</div>
	<?php if ($killedNpc->ship213 >= 200) { ?>
		<style>
		#ship213 {
			color: green;
		}
		#mission36 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	Attend XI	-->
<button class="menu">Attend XI</button>
<div id="PACK37" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/Attend.png" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship214" style=""><?php echo number_format($killedNpc->ship214, 0, ',', '.'); ?></a> / 200</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission37">Kill 200 Attend XI(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 1000 E.C
	</div>
	<?php if ($killedNpc->ship214 >= 200) { ?>
		<style>
		#ship214 {
			color: green;
		}
		#mission37 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	Invoke XVI	-->
<button class="menu">Invoke XVI</button>
<div id="PACK38" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/invoke.png" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship215" style=""><?php echo number_format($killedNpc->ship215, 0, ',', '.'); ?></a> / 165</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission38">Kill 165 Invoke XVI(s).</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 2000 EC
	</div>
	<?php if ($killedNpc->ship215 >= 165) { ?>
		<style>
		#ship215 {
			color: green;
		}
		#mission38 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>
<!--********************************************************************************************************************************************************************************--


<!--	Mindfire Behemoth	-->
<button class="menu">Mindfire Behemoth</button>
<div id="PACK39" class="npmissioner"	style="display:none;">
	<div style="padding:15px;  text-align:center;">
	<!--TARGET-->
	<a id="target">Target:</a>
	<div id="image">
	<img  style="pointer-events: none;"src="/do_img/global/items/npc/behemot.png" height="80px">
	</div>
	<!--AMOUNT OF KILL-->
	<a id="required">Required Kill:
	<div id="requiredKills">
	<a id="ship216" style=""><?php echo number_format($killedNpc ->ship216, 0, ',', '.'); ?></a> / 100</p>
	</div>
	<!--DESCRIPTION-->
	<a id="desc">Description:</a>
	<div id="description">
	<p id="mission39">Kill 100 Mindfire Behemoth(s).on BL map(s)</p>
	</div>
	<!--REWARD-->
	<a id="reward">Reward:</a>
	<div id="rewards">
	<p id="items">• 5000 E.C
	</div>
	
	
	<?php if ($killedNpc ->ship216 >= 100) { ?>
		<style>
		#ship216 {
			color: green;
		}
		#mission39 {
			text-decoration:line-through;
			text-decoration-color: red;
		}
		</style>
	</div>
	<?php } ?>
	</div>	
</div>




<script>
var acc = document.getElementsByClassName("menu");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>
<?php require_once(INCLUDES . 'footer.php'); ?>