<?php require_once(INCLUDES . 'header.php');

$player = Functions::GetPlayer();
?>
<link rel="stylesheet" href="/public/css/bank.css">

<?php require_once(INCLUDES . 'data.php'); ?>

<script>
      
      // used to shuffle an array
      function shuffle(array) {
		  var currentIndex = array.length, temporaryValue, randomIndex;
		  
		  // While there remain elements to shuffle...
		  while (0 !== currentIndex) {
			  
			  // Pick a remaining element...
			  randomIndex = Math.floor(Math.random() * currentIndex);
			  currentIndex -= 1;
			  
			  // And swap it with the current element.
			  temporaryValue = array[currentIndex];
			  array[currentIndex] = array[randomIndex];
			  array[randomIndex] = temporaryValue;
		  }
		  
		  return array;
      }
      
      
      
      var messages = [
		  {type:'announce', message:'Welcome on <b><font color="#ff00f0">Pink</font><font color="#00a5a5">Galaxy</font></b>!'},
		  		  			
	  ];
      
      // enable bootstrap tooltips
      $(document).ready(function(){
      
		  //we shuffle the messages array so the user don't always see the same messages
		  shuffle(messages);
		  
		  $('[data-toggle="tooltip"]').tooltip();
		  
		  $(messages).each(function( index ) {
			  switch(messages[index].type) {
				  case 'tip':
					$('.tips').append('<div class="tip"><b>TIP</b>'  + messages[index].message + '</div>');
				  break;
				  case 'announce':
					$('.tips').append('<div class="tip"><b class="fg-red">ANNOUNCE</b> ' + messages[index].message + '</div>');
				  break;
				  case 'info':
					$('.tips').append('<div class="tip"><b class="fg-yellow">INFO</b> ' + messages[index].message + '</div>');
				  break;
				  case 'clan':
					$('.tips').append('<div class="tip"><b class="fg-green">CLAN</b> ' + messages[index].message + '</div>');
				  break;
				  case 'gg':
					$('.tips').append('<div class="tip"><b class="fg-orange">GALAXYGATE</b> ' + messages[index].message + '</div>');
				  break;
			  }
		  });
		  
		  $('.tips').html('<marquee>' + $('.tips').html() + '</marquee>');
      });
   </script>
<script>
		Tools.Text.setResource('bank_error_generic', 'An error has occured');
		Tools.Text.setResource('send_error_nobankcode', 'Thats not a valid bank-code!');
		Tools.Text.setResource('send_error_noreceiver', 'No receiver found!');
		Tools.Text.setResource('send_error_amount_not_send', 'No receiver found!');
		Tools.Text.setResource('send_success', 'Money successfully send');
		Tools.Text.setResource('send_error', 'Money could not be send');
		Tools.Text.setResource('placeholder_nocontacts', 'No contacts yet');
		Tools.Text.setResource('placeholder_notransactions', 'No transactions yet');
		
						Tools.Text.setResource('payment_item_name_premium_2_weeks', '2 Weeks premium');
				Tools.Text.setResource('payment_item_description_premium_2_weeks', 'Upgrade your account for two weeks to a premium-account and take advangate of these incredible perks:<br></br> - Free PET repairs!</br> - Free ship repairs anywhere!</br> - 50% shorter rocket reload time!</br> - 100% more cargo space!</br> - 5-second logout!</br> - 100% more efficent repair robots!</br> - Premium slotbar!</br> - Pro action slotbar!</br> - 5% uridium discount on galaxygate generator spins!</br> - Twice the chance to get the second and third PET!</br> - Discord premium role!</br> - Discord premium chat rooms!</br> - Personal premium support with the developer to fix any techincal problems!</br> - Automatic resource refining!</br> - No fees when sending money to other pilots! (Receiver dont need to be premium)</br> - Weekly premium casedrops! (Every friday at 18:00)');
								Tools.Text.setResource('payment_item_name_premium_1_month', '1 Month premium');
				Tools.Text.setResource('payment_item_description_premium_1_month', 'Upgrade your account for one month to a premium-account and take advangate of these incredible perks:<br></br> - Free PET repairs!</br> - Free ship repairs anywhere!</br> - 50% shorter rocket reload time!</br> - 100% more cargo space!</br> - 5-second logout!</br> - 100% more efficent repair robots!</br> - Premium slotbar!</br> - Pro action slotbar!</br> - 5% uridium discount on galaxygate generator spins!</br> - Twice the chance to get the second and third PET!</br> - Discord premium role!</br> - Discord premium chat rooms!</br> - Personal premium support with the developer to fix any techincal problems!</br> - Automatic resource refining!</br> - No fees when sending money to other pilots! (Receiver dont need to be premium)</br> - Weekly premium casedrops! (Every friday at 18:00)');
								Tools.Text.setResource('payment_item_name_premium_1_year', '1 Year premium');
				Tools.Text.setResource('payment_item_description_premium_1_year', 'Upgrade your account for a whole year to a premium-account and take advangate of these incredible perks:<br></br> - Free PET repairs!</br> - Free ship repairs anywhere!</br> - 50% shorter rocket reload time!</br> - 100% more cargo space!</br> - 5-second logout!</br> - 100% more efficent repair robots!</br> - Premium slotbar!</br> - Pro action slotbar!</br> - 5% uridium discount on galaxygate generator spins!</br> - Twice the chance to get the second and third PET!</br> - Discord premium role!</br> - Discord premium chat rooms!</br> - Personal premium support with the developer to fix any techincal problems!</br> - Automatic resource refining!</br> - No fees when sending money to other pilots! (Receiver dont need to be premium)</br> - Weekly premium casedrops! (Every friday at 18:00)');
								Tools.Text.setResource('payment_item_name_parallax-key', 'Parallax-key');
				Tools.Text.setResource('payment_item_description_parallax-key', 'Key to open a parallax-case<br><br>Important: You can only earn the parallax container!');
								Tools.Text.setResource('payment_item_name_parallax2-key', 'Parallax2-Key');
				Tools.Text.setResource('payment_item_description_parallax2-key', 'Key to open a parallax2-case<br><br>Important: You can only earn the parallax2 container!');
								Tools.Text.setResource('payment_item_name_goldi-key', 'Goldi-key');
				Tools.Text.setResource('payment_item_description_goldi-key', 'Key to open a goldi-case');
								Tools.Text.setResource('payment_item_name_goldi-case', 'Goldi-case');
				Tools.Text.setResource('payment_item_description_goldi-case', 'Requires the ship: Goliath<br>Requires the key: Goldi-key<br><br>Contains one of those items:</br> <div class="caseItemBlue">Goliath sapphire</div></br> <div class="caseItemBlue">Goliath jade</div></br> <div class="caseItemBlue">Goliath amber</div></br> <div class="caseItemPurple">Goliath crimson</div></br> <div class="caseItemPink">Goliath exalted</div></br> <div class="caseItemPink">Goliath veteran</div></br> <div class="caseItemRed">Goliath enforcer</div></br> <div class="caseItemYellow">Goliath bastion</div></br> <div class="caseItemYellow">Goliath centaur</div></br> <div class="caseItemYellow">Goliath saturn</div>');
								Tools.Text.setResource('payment_item_name_goldi-set', 'Goldi-set');
				Tools.Text.setResource('payment_item_description_goldi-set', 'Contains one goldi-key & goldi-case');
								Tools.Text.setResource('payment_item_name_solace-key', 'Solace-key');
				Tools.Text.setResource('payment_item_description_solace-key', 'Key to open a solace-case');
								Tools.Text.setResource('payment_item_name_solace-case', 'Solace-case');
				Tools.Text.setResource('payment_item_description_solace-case', 'Requires the ship: Goliath<br>Requires the key: Solace-key<br><br>Contains one of those items:</br> <div class="caseItemBlue">Solace blaze</div></br> <div class="caseItemBlue">Solace ocean</div></br> <div class="caseItemBlue">Solace poison</div></br> <div class="caseItemPurple">Solace frost</div></br> <div class="caseItemPurple">Solace inferno</div></br> <div class="caseItemYellow">Solace borealis</div></br> <div class="caseItemYellow">Solace argon</div>');
								Tools.Text.setResource('payment_item_name_solace-set', 'Solace-set');
				Tools.Text.setResource('payment_item_description_solace-set', 'Contains one solace-key & solace-case');
								Tools.Text.setResource('payment_item_name_diminisher-key', 'Diminisher-key');
				Tools.Text.setResource('payment_item_description_diminisher-key', 'Key to open a diminisher-case');
								Tools.Text.setResource('payment_item_name_diminisher-case', 'Diminisher-case');
				Tools.Text.setResource('payment_item_description_diminisher-case', 'Requires the ship: Goliath<br>Requires the key: Diminisher-key<br><br>Contains one of those items:</br> <div class="caseItemBlue">Diminisher argon</div></br> <div class="caseItemBlue">Diminisher lava</div></br> <div class="caseItemPurple">Diminisher inferno</div></br> <div class="caseItemPurple">Diminisher frost</div></br> <div class="caseItemYellow">Diminisher expo16</div></br> <div class="caseItemYellow">Diminisher legend</div>');
								Tools.Text.setResource('payment_item_name_diminisher-set', 'Diminisher-set');
				Tools.Text.setResource('payment_item_description_diminisher-set', 'Contains one diminisher-key & diminisher-case');
								Tools.Text.setResource('payment_item_name_sentinel-key', 'Sentinel-key');
				Tools.Text.setResource('payment_item_description_sentinel-key', 'Key to open a sentinel-case');
								Tools.Text.setResource('payment_item_name_sentinel-case', 'Sentinel-case');
				Tools.Text.setResource('payment_item_description_sentinel-case', 'Requires the ship: Goliath<br>Requires the key: Sentinel-key<br><br>Contains one of those items:</br> <div class="caseItemBlue">Sentinel argon</div></br> <div class="caseItemPurple">Sentinel lava</div></br> <div class="caseItemPink">Sentinel arctic</div></br> <div class="caseItemPink">Sentinel inferno</div></br> <div class="caseItemRed">Sentinel expo16</div></br> <div class="caseItemYellow">Sentinel legend</div>');
								Tools.Text.setResource('payment_item_name_sentinel-set', 'Sentinel-set');
				Tools.Text.setResource('payment_item_description_sentinel-set', 'Contains one sentinel-key & sentinel-case');
								Tools.Text.setResource('payment_item_name_spectrum-key', 'Spectrum-key');
				Tools.Text.setResource('payment_item_description_spectrum-key', 'Key to open a spectrum-case');
								Tools.Text.setResource('payment_item_name_spectrum-case', 'Spectrum-case');
				Tools.Text.setResource('payment_item_description_spectrum-case', 'Requires the ship: Goliath<br>Requires the key: Spectrum-key<br><br>Contains one of those items:</br> <div class="caseItemBlue">Spectrum sandstorm</div></br> <div class="caseItemBlue">Spectrum poison</div></br> <div class="caseItemBlue">Spectrum ocean</div></br> <div class="caseItemBlue">Spectrum blaze</div></br> <div class="caseItemPurple">Spectrum lava</div></br> <div class="caseItemRed">Spectrum inferno</div></br> <div class="caseItemRed">Spectrum arctic</div></br> <div class="caseItemYellow">Spectrum legend</div>');
								Tools.Text.setResource('payment_item_name_spectrum-set', 'Spectrum-set');
				Tools.Text.setResource('payment_item_description_spectrum-set', 'Contains one spectrum-key & spectrum-case');
								Tools.Text.setResource('payment_item_name_venom-key', 'Venom-key');
				Tools.Text.setResource('payment_item_description_venom-key', 'Key to open a venom-case');
								Tools.Text.setResource('payment_item_name_venom-case', 'Venom-case');
				Tools.Text.setResource('payment_item_description_venom-case', 'Requires the ship: Goliath<br>Requires the key: Venom-key<br><br>Contains one of those items:</br> <div class="caseItemBlue">Venom blaze</div></br> <div class="caseItemBlue">Venom ocean</div></br> <div class="caseItemBlue">Venom poison</div></br> <div class="caseItemPurple">Venom borealis</div></br> <div class="caseItemPurple">Venom argon</div></br> <div class="caseItemYellow">Venom arctic</div></br> <div class="caseItemYellow">Venom inferno</div>');
								Tools.Text.setResource('payment_item_name_venom-set', 'Venom-set');
				Tools.Text.setResource('payment_item_description_venom-set', 'Contains one venom-key & venom-case');
								Tools.Text.setResource('payment_item_name_obsidian-key', 'Obsidian-key');
				Tools.Text.setResource('payment_item_description_obsidian-key', 'Key to open a obsidian-case');
								Tools.Text.setResource('payment_item_name_obsidian-case', 'Obsidian-case');
				Tools.Text.setResource('payment_item_description_obsidian-case', 'Requires the key: obsidian-key<br><br>Contains one of those items:</br> <div class="caseItemBlue">15x Green booty-key</div></br> <div class="caseItemBlue">600x PLT-3030-P</div></br> <div class="caseItemBlue">10000x UCB-100</div></br> <div class="caseItemPurple">5000x RSB-75</div></br> <div class="caseItemPurple">600x UBR-100</div></br> <div class="caseItemPink">24h Hitpoints-booster</div></br> <div class="caseItemPink">24h Schield-booster</div></br> <div class="caseItemPink">24h Damage-booster</div></br> <div class="caseItemRed">Sentinel contagion</div> (requires goliath)</br> <div class="caseItemRed">Solace contagion</div> (requires goliath)</br> <div class="caseItemYellow">Diminisher epion</div> (requires goliath)</br> <div class="caseItemYellow">Diminisher osiris</div> (requires goliath)</br> <div class="caseItemYellow">Diminisher smite</div> (requires goliath)</br> <div class="caseItemYellow">6 months premium</div>');
								Tools.Text.setResource('payment_item_name_obsidian-set', 'Obsidian-set');
				Tools.Text.setResource('payment_item_description_obsidian-set', 'Contains one obsidian-key & obsidian-case');
								Tools.Text.setResource('payment_item_name_nova-key', 'Nova-key');
				Tools.Text.setResource('payment_item_description_nova-key', 'Key to open a nova-case');
								Tools.Text.setResource('payment_item_name_nova-case', 'Nova-case');
				Tools.Text.setResource('payment_item_description_nova-case', 'Requires the key: nova-key<br><br>Contains one of those items:</br> <div class="caseItemBlue">15x Green booty-key</div></br> <div class="caseItemBlue">600x PLT-3030-N</div></br> <div class="caseItemBlue">10000x UCB-100</div></br> <div class="caseItemPurple">5000x RSB-75</div></br> <div class="caseItemPurple">600x HSTRM-01</div></br> <div class="caseItemPink">24h Hitpoints-booster</div></br> <div class="caseItemPink">24h Schield-booster</div></br> <div class="caseItemPink">24h Damage-booster</div></br> <div class="caseItemRed">Spectrum ace</div> (requires goliath)</br> <div class="caseItemRed">Spectrum argon</div> (requires goliath)</br> <div class="caseItemYellow">Sentinel neikos</div> (requires goliath)</br> <div class="caseItemYellow">Sentinel harbinger</div> (requires goliath)</br> <div class="caseItemYellow">Sentinel carbonite</div> (requires goliath)</br> <div class="caseItemYellow">6 months premium</div>');
								Tools.Text.setResource('payment_item_name_nova-set', 'Nova-set');
				Tools.Text.setResource('payment_item_description_nova-set', 'Contains one nova-key & nova-case');
								Tools.Text.setResource('payment_item_name_crypto-key', 'Crypto-key');
				Tools.Text.setResource('payment_item_description_crypto-key', 'Key to open a crypto-case');
								Tools.Text.setResource('payment_item_name_crypto-case', 'Crypto-case');
				Tools.Text.setResource('payment_item_description_crypto-case', 'Requires the key: crypto-key<br><br>Contains one of those items:</br> <div class="caseItemBlue">15x Green booty-key</div></br> <div class="caseItemBlue">30x Poison-burst</div></br> <div class="caseItemBlue">10000x UCB-100</div></br> <div class="caseItemPurple">5000x RSB-75</div></br> <div class="caseItemPurple">600x CBR-100</div></br> <div class="caseItemPink">24h Hitpoints-booster</div></br> <div class="caseItemPink">24h Schield-booster</div></br> <div class="caseItemPink">24h Damage-booster</div></br> <div class="caseItemRed">Solace tyrannos</div> (requires goliath)</br> <div class="caseItemRed">Solace nobilis</div> (requires goliath)</br> <div class="caseItemYellow">Solace carbonite</div> (requires goliath)</br> <div class="caseItemYellow">Sentinel arios</div> (requires goliath)</br> <div class="caseItemYellow">Sentinel nobilis</div> (requires goliath)</br> <div class="caseItemYellow">6 months premium</div>');
								Tools.Text.setResource('payment_item_name_crypto-set', 'Crypto-set');
				Tools.Text.setResource('payment_item_description_crypto-set', 'Contains one crypto-key & crypto-case');
								Tools.Text.setResource('payment_item_name_rainbow-key', 'Rainbow-key');
				Tools.Text.setResource('payment_item_description_rainbow-key', 'Key to open a rainbow-case');
								Tools.Text.setResource('payment_item_name_rainbow-case', 'Rainbow-case');
				Tools.Text.setResource('payment_item_description_rainbow-case', 'Requires the ship: Aegis<br>Requires the key: Rainbow-key<br><br>Contains one of those items:</br> <div class="caseItemPink">Aegis Veteran-Red</div></br> <div class="caseItemPink">Aegis Veteran-Orange</div></br> <div class="caseItemPink">Aegis Veteran-Gold</div></br> <div class="caseItemPink">Aegis Veteran-Lightgreen</div></br> <div class="caseItemPink">Aegis Veteran-Green I</div></br> <div class="caseItemPink">Aegis Veteran-Green II</div></br> <div class="caseItemPink">Aegis Veteran-Green III</div></br> <div class="caseItemPink">Aegis Veteran-Cyan</div></br> <div class="caseItemPink">Aegis Veteran-Lightblue</div></br> <div class="caseItemPink">Aegis Veteran-Blue</div></br> <div class="caseItemPink">Aegis Veteran-Darkpurple</div></br> <div class="caseItemPink">Aegis Veteran-Purple</div></br> <div class="caseItemPink">Aegis Veteran-Pink I</div></br> <div class="caseItemPink">Aegis Veteran-Pink II</div></br> <div class="caseItemYellow">Aegis Veteran-Black</div>');
								Tools.Text.setResource('payment_item_name_rainbow-set', 'Rainbow-set');
				Tools.Text.setResource('payment_item_description_rainbow-set', 'Contains one rainbow-key & rainbow-case');
								Tools.Text.setResource('payment_item_name_optic-key', 'Optic-key');
				Tools.Text.setResource('payment_item_description_optic-key', 'Key to open a optic-case');
								Tools.Text.setResource('payment_item_name_optic-case', 'Optic-case');
				Tools.Text.setResource('payment_item_description_optic-case', 'Requires the key: optic-key<br><br>Contains one of those items:</br> <div class="caseItemBlue">Lens B215-1020</div></br> <div class="caseItemBlue">Lens B215-1040</div></br> <div class="caseItemBlue">Lens B215-1060</div></br> <div class="caseItemBlue">Lens B215-1080</div></br> <div class="caseItemBlue">Lens B215-1100</div></br> <div class="caseItemBlue">Lens B215-1120</div></br> <div class="caseItemBlue">Lens B215-1140</div></br> <div class="caseItemBlue">Lens B215-1160</div></br> <div class="caseItemBlue">Lens B215-1180</div></br> <div class="caseItemBlue">Lens B215-1200</div></br> <div class="caseItemBlue">Lens B215-1220</div></br> <div class="caseItemBlue">Lens B215-1240</div></br> <div class="caseItemBlue">Lens B215-1260</div></br> <div class="caseItemBlue">Lens B215-1280</div></br> <div class="caseItemBlue">Lens B215-1300</div></br> <div class="caseItemRed">Lens R930-R50</div>');
								Tools.Text.setResource('payment_item_name_optic-set', 'Optic-set');
				Tools.Text.setResource('payment_item_description_optic-set', 'Contains one optic-key & optic-case');
								Tools.Text.setResource('payment_item_name_optic2-key', 'Optic2-key');
				Tools.Text.setResource('payment_item_description_optic2-key', 'Key to open a optic2-case');
								Tools.Text.setResource('payment_item_name_optic2-case', 'Optic2-case');
				Tools.Text.setResource('payment_item_description_optic2-case', 'Requires the key: optic2-key<br><br>Contains one of those items:</br> <div class="caseItemBlue">Lens BR15-O39</div></br> <div class="caseItemBlue">Lens BR15-O40</div></br> <div class="caseItemBlue">Lens BR15-O41</div></br> <div class="caseItemBlue">Lens BR15-O42</div></br> <div class="caseItemBlue">Lens BR15-O43</div></br> <div class="caseItemBlue">Lens BR15-O44</div></br> <div class="caseItemBlue">Lens BR15-O45</div></br> <div class="caseItemBlue">Lens BR15-O46</div></br> <div class="caseItemBlue">Lens BR15-O47</div></br> <div class="caseItemBlue">Lens BR15-O48</div></br> <div class="caseItemBlue">Lens BR15-O49</div></br> <div class="caseItemBlue">Lens BR15-O50</div></br> <div class="caseItemBlue">Lens BR15-O51</div>');
								Tools.Text.setResource('payment_item_name_optic2-set', 'Optic2-set');
				Tools.Text.setResource('payment_item_description_optic2-set', 'Contains one optic2-key & optic2-case');
								Tools.Text.setResource('payment_item_name_opticoldi-key', 'Optic "oldschool"-key');
				Tools.Text.setResource('payment_item_description_opticoldi-key', 'Key to open a Optic "oldschool"-case');
								Tools.Text.setResource('payment_item_name_opticoldi-case', 'Optic "oldschool"-case');
				Tools.Text.setResource('payment_item_description_opticoldi-case', 'Requires the key: Optic "oldschool"-key<br><br>Contains one of those items:</br> <div class="caseItemPurple">Lens OS7-RE1</div></br> <div class="caseItemPurple">Lens OS7-RE2</div></br> <div class="caseItemPink">Lens OS7-RE3</div></br> <div class="caseItemPink">Lens OS7-RE5</div></br> <div class="caseItemYellow">Lens OS7-RE4</div></br> <div class="caseItemYellow">Lens OS7-RE6</div></br> <div class="caseItemYellow">Lens OS7-RB</div>');
								Tools.Text.setResource('payment_item_name_opticoldi-set', 'Optic "oldschool"-set');
				Tools.Text.setResource('payment_item_description_opticoldi-set', 'Contains one optic "oldschool"-key & optic "oldschool"-case');
								Tools.Text.setResource('payment_item_name_basedefend_damage_perk', 'Basedefend Damageperk');
				Tools.Text.setResource('payment_item_description_basedefend_damage_perk', 'The alien waves are overwhelming and you need a damage boost for the BaseDefend event?</br> For 2.99 EUR only you create a damage booster on one of the bases, which increases the damage of all players in the boost-area by 40%!</br></br> Overlapping areas of multiple boosters multiply the boost!</br> </br> You can purchase up to 3 boosters per base');
								Tools.Text.setResource('payment_item_name_basedefend_turret_repair', 'Basedefend repair-service');
				Tools.Text.setResource('payment_item_description_basedefend_turret_repair', 'The base turrets have already taken a beating and some got already destroyed?</br> Then its time: for only 0.99 EUR you can purchase the "Basedefend repair-service" and completely repair one random, destroyed base turret!</br> </br> You can repair up to 32 base-turrets (Boosters cannot be repaired)');
								Tools.Text.setResource('payment_item_name_neongoli-key', 'NeonGoli-key');
				Tools.Text.setResource('payment_item_description_neongoli-key', 'Key to open a NeonGoli-case');
								Tools.Text.setResource('payment_item_name_neongoli-case', 'NeonGoli-case');
				Tools.Text.setResource('payment_item_description_neongoli-case', 'Requires the ship: Goliath<br>Requires the key: NeonGoli-key<br><br>Contains one of those items:</br> <div class="caseItemPurple">Goliath Neon-blue</div></br> <div class="caseItemPurple">Goliath Neon-cyan</div></br> <div class="caseItemPurple">Goliath Neon-green</div></br> <div class="caseItemPurple">Goliath Neon-lightblue</div></br> <div class="caseItemPurple">Goliath Neon-lightgreen</div></br> <div class="caseItemPurple">Goliath Neon-orange</div></br> <div class="caseItemPurple">Goliath Neon-pink</div></br> <div class="caseItemPurple">Goliath Neon-purple</div></br> <div class="caseItemPurple">Goliath Neon-yellow</div></br> <div class="caseItemPurple">Goliath Neon-red</div></br> <div class="caseItemPink">Goliath Neon-blue (Glow)</div></br> <div class="caseItemPink">Goliath Neon-cyan (Glow)</div></br> <div class="caseItemPink">Goliath Neon-green (Glow)</div></br> <div class="caseItemPink">Goliath Neon-lightblue (Glow)</div></br> <div class="caseItemPink">Goliath Neon-lightgreen (Glow)</div></br> <div class="caseItemPink">Goliath Neon-orange (Glow)</div></br> <div class="caseItemPink">Goliath Neon-pink (Glow)</div></br> <div class="caseItemPink">Goliath Neon-purple (Glow)</div></br> <div class="caseItemPink">Goliath Neon-yellow (Glow)</div></br> <div class="caseItemPink">Goliath Neon-red (Glow)</div></br> <div class="caseItemRed">Goliath Neon-rainbow</div></br> <div class="caseItemRed">Goliath Neon-Ice&Fire</div></br> <div class="caseItemYellow">Goliath Neon-rainbow (Glow)</div></br> <div class="caseItemYellow">Goliath Neon-Ice&Fire (Glow)</div>');
								Tools.Text.setResource('payment_item_name_neongoli-set', 'NeonGoli-set');
				Tools.Text.setResource('payment_item_description_neongoli-set', 'Contains one NeonGoli-key & NeonGoli-case');
								Tools.Text.setResource('payment_category_premium', 'Premium');
								Tools.Text.setResource('payment_category_caseAkey', 'Case & Keys');
								Tools.Text.setResource('payment_category_basedefend', 'BaseDefend');
						
		Tools.Text.setResource('transaction_details_transactioncode', 'Transactioncode');
		Tools.Text.setResource('transaction_details_message', 'Message');
		Tools.Text.setResource('transaction_details_details', 'Details');
		Tools.Text.setResource('transaction_details_sum', 'Sum');
		Tools.Text.setResource('shop_list_add', 'Add');
		Tools.Text.setResource('shop_list_discount', 'Save %DISCOUNT%%!');
		Tools.Text.setResource('shop_list_blackfridaydeal', 'Blackfriday deal!');
		Tools.Text.setResource('shop_list_blackweekdeal', 'Blackweek deal!');
		Tools.Text.setResource('shop_continue_checkout', 'Go to checkout');
		Tools.Text.setResource('shop_wait_seconds', 'Please wait %TIME% second(s)');
		Tools.Text.setResource('shop_shoppingcart_full', 'Your shoppingcart is full!');
		Tools.Text.setResource('shop_checkout', 'Pay now');
		Tools.Text.setResource('shop_checkout_success', 'Thank you for your purchase!');
		Tools.Text.setResource('shop_checkout_error_no_money', 'You dont have enough money');
		Tools.Text.setResource('shop_checkout_error_item_not_available', 'At least one item in your order is no longer available');
		Tools.Text.setResource('shop_checkout_error_item_not_available_in_amount', 'At least one item in your order is in this quantity no longer available');
		Tools.Text.setResource('payment_method_paypal_deposit_feesfree_label', 'Free of fees at %REQUIREMENT% EUR!');
		Tools.Text.setResource('payment_method_paypal_deposit_gift_label', 'At %REQUIREMENT% EUR we gift you %PERCENTAGE%% more balance!');
		Tools.Text.setResource('payment_method_paypal_deposit_gift_receive_label', 'You get %GIFT% EUR for free!');
		
		Tools.Text.setResource('payment_method_pinkcard_code_type_in_code', 'Please enter a valid 40-digit code first.');
		Tools.Text.setResource('payment_method_pinkcard_code_already_typed_in', 'You are already using this code.');
		Tools.Text.setResource('payment_method_pinkcard_code_checking', 'This code is beeing checked...');
		Tools.Text.setResource('payment_method_pinkcard_code_not_existing', 'This code does not exist.');
		Tools.Text.setResource('payment_method_pinkcard_code_banned', 'This code is locked.');
		Tools.Text.setResource('payment_method_pinkcard_code_used_up', 'This code is already used up.');
		Tools.Text.setResource('payment_method_pinkcard_code_cooldown', 'Please wait a few seconds before using new codes.');
		Tools.Text.setResource('payment_method_pinkcard_code_available', 'This code has %AMOUNT% EUR available.');
		Tools.Text.setResource('payment_method_pinkcard_code_placeholder', 'Enter a 40-digit code');
		Tools.Text.setResource('payment_method_pinkcard_code_result_not_existing', 'Code %CODE% does not exist.');
		Tools.Text.setResource('payment_method_pinkcard_code_result_banned', 'Code %CODE% is locked.');
		Tools.Text.setResource('payment_method_pinkcard_code_result_used_up', 'Code %CODE% is already used up.');
		Tools.Text.setResource('payment_method_pinkcard_code_result_used', 'Code %CODE% used and %AMOUNT% EUR received!');
		Tools.Text.setResource('payment_method_pinkcard_code_result_total', '%USEDCODES% of %ALLCODES% codes used successfully!');
		Tools.Text.setResource('payment_method_pinkcard_error_no_code', 'Please add at least one valid code.');
		Tools.Text.setResource('payment_method_pinkcard_error_max_title', 'Maximum 5 codes');
		Tools.Text.setResource('payment_method_pinkcard_error_max_text', 'You can only use up to 5 codes at once.');
		Tools.Text.setResource('payment_method_pinkcard_total', 'Total: %AMOUNT% EUR');
	</script>


<div class="page bank">
<div class="bank-container styleUpdate">
<div class="loader" style="display: none;">
<div class="content">
<i class="fa fa-cog fa-spin"></i><br>
Loading
</div>
</div>
<div class="navigation">
<div data-tab="overview" class="tab active">Overview</div>
<div data-tab="activity" class="tab">Activity</div>
<div data-tab="shop" class="tab">Shop</div>
<div data-tab="send" class="tab">Send money</div>
<div data-tab="deposit" class="tab">Deposit money</div>
<div data-tab="withdraw" class="tab">Withdraw money</div>
<div data-tab="arcade" class="tab">Game-library</div>
</div>
<div class="body">
<div data-tabBody="overview" class="overview" style="display: show">
<div class="balanceOverview">
<div class="balanceBox">
<div class="title">Balance</div>
<div class="balance ">0,00 EUR</div>
<div class="balanceAction">Deposit money</div>
</div>
<div class="bankCodeBox">
<div class="title">Your bank-code</div>
<div class="code">
<input class="bankCode" value="9290-5992-6488-9708" readonly></input>
<i class="bankCodeInfo fas fa-info" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="This is your bank-code. With this bank-code you can receive money"></i>
</div>
</div>
<div class="donation_bankCodeBox">
<div class="title">Developer bank-code</div>
<div class="code">
<input class="bankCode" value="1021-9103-9106-8935" readonly></input>
<i class="bankCodeInfo donation fas fa-info" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="With this bank-code you can send money to the developer of PinkGalaxy"></i>
<i class="donation_sendButton donation fas fa-arrow-right"></i>
</div>
</div>
</div>
<div class="activity">
<div class="sectionTitle">Send again</div>
<div class="lastSend" style="display: hidden"></div>
<div class="sectionTitle">Last activitys</div>
<div class="lastActivity" style="display: hidden"></div>
</div>
</div>
<div data-tabBody="activity" class="activity" style="display: none;">
<div class="activitySection"></div>
</div>
<div data-tabBody="shop" class="shop" style="display: none;">
<div class="shopContainer">
<div class="shopList">
<div class="tabs noselect">
<div class="tabButtonsContainer"></div>
</div>
<div class="itemContainer">
<div class="itemArrowContainer noselect">
<div class="arrow left"><i class="fas fa-arrow-left"></i></div>
</div>
<div class="itemList noselect" style="display: show;">
<div class="scrollList">
<div class="itemListHorizontal"></div>
<div class="itemListHorizontal"></div>
</div>
</div>
<div class="itemDetails" style="display: none;">
<div class="detailsContainer">
<div class="imageContainer noselect">
<div class="imageBox">
<img class="image" src=""></img>
</div>
<div class="backBox">
<div class="backButton">Back</div>
</div>
</div>
<div class="infosContainer">
<div class="priceinfosContainer">
<div class="itemName">-</div>
<div class="itemCategory">-</div>
<div class="itemPrice">0.00 EUR</div>
<div class="addItem noselect">Add to shoppingcart</div>
</div>
<div class="descriptionContainer"></div>
</div>
</div>
</div>
<div class="itemArrowContainer noselect">
<div class="arrow right"><i class="fas fa-arrow-right"></i></div>
</div>
</div>
</div>
<div class="shoppingCart">
<div class="shoppingCartLabel noselect"><i class="fas fa-shopping-cart"></i> Shoppingcart</div>
<div class="shoppingCartList">
<div class="scrollList noselect">
<div class="itemgrid" data-gridId="1">
<div class="item empty"></div>
<div class="item empty"></div>
<div class="item empty"></div>
<div class="item empty"></div>
<div class="item empty"></div>
</div>
</div>
<div class="totalPrice">
<div class="totalLabel">total:</div>
<div class="price">0,00 EUR</div>
</div>
<div class="checkoutButton noselect disabled">Go to checkout <i class="fas fa-chevron-right"></i></div>
</div>
<div class="shoppingCartArrows">
<div class="arrow left noselect"><i class="fas fa-arrow-left"></i></div>
<div class="gridNumber noselect">1</div>
<div class="arrow right noselect"><i class="fas fa-arrow-right"></i></div>
</div>
</div>
</div>
</div>
<div data-tabBody="send" class="send" style="display: none;">
<div class="sendBox">
<div class="sectionTitle">Send money</div>
<div class="sendInput">
<input placeholder="Bankcode" maxlength="19"></input>
</div>
<div class="messageBox" style="display: none;">
</div>
<div class="sendButton">
<button><i class="fas fa-search"></i> Continue</button>
</div>
<div class="contacts">
</div>
</div>
</div>
<div data-tabBody="sendPart2" class="sendPart2" style="display: none;">
<div class="sendPart2Container">
<div class="inputBox">
<div class="contact">
<div class="contactPicture">
<img class="image" src="/do_img/global/pilotSheet/avatar/avatar.png"></img>
</div>
<div class="contactName">
</div>
</div>
<div class="amountBox">
<input value="0,00"></input>
<div class="currency">EUR</div>
</div>
<div class="messageBox">
<textarea placeholder="Add message" maxlength="148"></textarea>
</div>
</div>
<div class="continueButton">
<button>Send money now</button>
</div>
<div class="cancelButton">
<button>Cancel</button>
</div>
</div>
</div>
<div data-tabBody="deposit" class="deposit" style="display: none;">
<div class="depositMethodBox noselect">
<div data-depositTab="paypal" class="method active">
<div class="iconBox">
<div class="icon">
<img class="image" src="/do_img/global/payment/methods/paypal.png"></img>
</div>
</div>
<div class="name">
PayPal </div>
</div>
<div data-depositTab="pinkcard" class="method">
<div class="iconBox">
<div class="icon">
<img class="image" src="/do_img/global/payment/methods/pinkcard.png"></img>
</div>
</div>
<div class="name">
PinkCard </div>
</div>
<div data-depositTab="bank" class="method disabled">
<div class="iconBox">
<div class="icon">
<img class="image" src="/do_img/global/payment/methods/bank.png"></img>
</div>
</div>
<div class="name">
Bank </div>
</div>
<div class="method disabled" title="">
<div class="iconBox">
<div class="icon">
<img class="image" src="/do_img/global/payment/methods/paysafecard.png"></img>
</div>
</div>
<div class="name">
PaySafeCard </div>
</div>
<div class="method disabled">
<div class="iconBox">
<div class="icon">
<img class="image" src="/do_img/global/payment/methods/bitcoin.png"></img>
</div>
</div>
<div class="name">
BitCoin </div>
</div>
</div>
<div data-depositTabBody="paypal" class="depositContainerPayPal">
<div class="inputBox">
<div class="paypalheader">PayPal-deposit</div>
<div class="feesBox">
<div class="feesInfo" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="&lt;b&gt;These fees are charged by PayPal&lt;/b&gt;&lt;br&gt;&lt;br&gt;PinkGalaxy has decided to let buyers pay the fees: If the buyer pays the fees, this is a very small amount for any individual. But if PinkGalaxy pays the fees for hundreds of transactions, it will be a huge sum!&lt;br&gt;&lt;br&gt;If you deposit at least 100 EUR PinkGalaxy will pays any fees as a thank you!"><i class="fas fa-info"></i></div>
<div class="feesLabel"><b>PayPal</b>-fees</div>
<table>
<tr>
<td>Variable fees:</td>
<td>0,00 %</td>
</tr>
<tr>
<td>Fee per transaction:</td>
<td>0,00 EUR</td>
</tr>
</table>
<div class="totalPriceLabel">Gross price</div>
<div class="totalPrice">0,00 EUR</div>
</div>
<div class="amountBox">
<input value="0,00"></input>
 <div class="currency">EUR</div>
</div>
</div>
<div class="continueButton">
<button>Deposit money</button>
</div>
</div>
<div data-depositTabBody="pinkcard" class="depositContainerPinkCard" style="display: none">
<div class="inputBox">
<div class="pinkcardheader">PinkCard-deposit</div>
<div class="info">Deposit money in your PinkGalaxy account via PinkCard's!<br>You can find PinkCard-Resellers here:</div>
<div class="cardBox"></div>
<div class="totalBox"></div>
</div>
<div class="continueButton">
<button>Use PinkCard(s)</button>
</div>
</div>
</div>
<div data-tabBody="arcade" class="arcade" style="display: none;">
<div class="games">
<div class="arcade-game" data-game-id="diamonddeals">
<div class="control">
<div class="playButton">PLAY NOW</div>
</div>
<div class="game-image" style="background-image: -webkit-image-set(url('/do_img/global/payment/items/arcade/games/diamonddeals/1.png') 1x, url(/do_img/global/payment/items/arcade/games/diamonddeals/2.png) 2x);"></div>
<div class="name">Diamond-Deals</div>
</div>
<div class="arcade-game" data-game-id="christmasdeals">
<div class="control">
<div class="playButton">PLAY NOW</div>
</div>
<div class="game-image" style="background-image: -webkit-image-set(url('/do_img/global/payment/items/arcade/games/christmasdeals/1.png') 1x, url(/do_img/global/payment/items/arcade/games/christmasdeals/2.png) 2x);"></div>
<div class="name">Christmas-Deals</div>
</div>
<div class="arcade-game" data-game-id="roulette">
<div class="control">
<div class="playButton">PLAY NOW</div>
</div>
<div class="game-image" style="background-image: -webkit-image-set(url('/do_img/global/payment/items/arcade/games/roulette/1.png') 1x, url(/do_img/global/payment/items/arcade/games/roulette/2.png) 2x);"></div>
<div class="name">Roulette</div>
</div>
<div class="arcade-game" data-game-id="roulette-dark">
<div class="control">
<div class="playButton">PLAY NOW</div>
</div>
<div class="game-image" style="background-image: -webkit-image-set(url('/do_img/global/payment/items/arcade/games/roulette-dark/1.png') 1x, url(/do_img/global/payment/items/arcade/games/roulette-dark/2.png) 2x);"></div>
<div class="name">Dark Roulette</div>
</div>
<div class="arcade-game" data-game-id="blackjack">
<div class="control">
<div class="playButton">PLAY NOW</div>
</div>
<div class="game-image" style="background-image: -webkit-image-set(url('/do_img/global/payment/items/arcade/games/blackjack/1.png') 1x, url(/do_img/global/payment/items/arcade/games/blackjack/2.png) 2x);"></div>
<div class="name">Blackjack</div>
</div>
</div>
</div>
</div>
</div>
</div>

</body>
</html>