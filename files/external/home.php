<?php require_once(INCLUDES . 'header.php'); ?>
<script src="https://kit.fontawesome.com/4f90b43f8c.js" crossorigin="anonymous" type="text/javascript"></script>
<!-- <script src="/js/snowstorm.js"></script><script>snowStorm.snowColor = 'red';snowStorm.flakesMaxActive = 96;snowStorm.useTwinkleEffect = true;</script> -->

<?php require_once(INCLUDES . 'data.php'); ?>

<style>
.top-bar .online {
    float: left;
    margin: 0 10px;
    background: transparent;
    width: 70px;
    height: 47px;
    line-height: 47px;
    text-align: center;
}
</style>

<div class="page index">
<div class="index-container">
<div class="user">
<div class="avatar" style="background:url('<?php echo htmlspecialchars($player['profile'], ENT_QUOTES, 'UTF-8'); ?>') #2d2d2d; background-size: 100% 100%;"></div>
<div class="infos">
<div class="username"><?php echo htmlspecialchars($player['pilotName'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="company">
<a href="/clan/company"><i class="fa fa-retweet"></i></a>
<img src="/img/companies/logo_<?php echo ($player['factionId'] == 1 ? 'mmo' : ($player['factionId'] == 2 ? 'eic' : 'vru')); ?>.png"> </div>
<label for="clan">Clan:</label> <?php
              if ($player['clanId'] == 0) {
                echo 'Free Agent';
              } else {
                $clanName = "Error fetching clan name"; // Default
                // Prepared statement for clan name is good (already in original)
                $stmt_clan_name_home = $mysqli->prepare('SELECT name FROM server_clans WHERE id = ?');
                $stmt_clan_name_home->bind_param("i", $player['clanId']);
                $stmt_clan_name_home->execute();
                $clan_name_result_home = $stmt_clan_name_home->get_result();
                if ($clan_data_home = $clan_name_result_home->fetch_assoc()) {
                  $clanName = $clan_data_home['name'];
                }
                $stmt_clan_name_home->close();
                echo htmlspecialchars($clanName, ENT_QUOTES, 'UTF-8'); // Already escaped, good.
              }
            ?><br />
<label for="map">Level:</label> <?= ($player['level'] ? "<font color='#cbcbcb'>".htmlspecialchars($player['level'], ENT_QUOTES, 'UTF-8')."</font>" : ""); // Escaped level just in case, though numeric is usually fine. ?><br/>
<label for="map">ID:</label> <?php echo htmlspecialchars($player['userId'], ENT_QUOTES, 'UTF-8'); // Numeric, but escaped for consistency ?><br />
<label for="rank">Rank:</label> <img src="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>img/ranks/rank_<?php echo htmlspecialchars($player['rankId'], ENT_QUOTES, 'UTF-8'); ?>.png"> <?php echo htmlspecialchars(Functions::GetRankName($player['rankId']), ENT_QUOTES, 'UTF-8'); ?> <br>
<label for="map">Map:</label> <?= htmlspecialchars(Functions::getUserMap()['mapName'], ENT_QUOTES, 'UTF-8'); ?> <?php if(Functions::getUserMap()['factionId'] > 0){ ?><img src="/img/companies/logo_<?php echo (Functions::getUserMap()['factionId'] == 1 ? 'mmo' : (Functions::getUserMap()['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png" data-toggle="tooltip" data-placement="right" data-html="true" title="" data-original-title="This Map is Owned by <img src='/img/companies/logo_<?php echo (Functions::getUserMap()['factionId'] == 1 ? 'mmo' : (Functions::getUserMap()['factionId'] == 2 ? 'eic' : 'vru')); ?>.png'> "><?php } ?><br />
<?php
	if($player["premiumUntil"] != null) {
		$premiumUntil = $player["premiumUntil"];
		$phpdate = strtotime($premiumUntil);
		$mysqldate = date( 'Y-m-d H:i', $phpdate );
	} else {
		$mysqldate = "forever";
	}
?>
<label for="premium" >Premium:</label> <?php echo ($player['premium'] == 1 ? '<i class="fas fa-check"></i>' : '<i class="fa fa-times"></i>'); ?> <?php if($player['premium'] == 1) { ?><font size="1">(until: <?php echo htmlspecialchars($mysqldate, ENT_QUOTES, 'UTF-8'); ?>)</font><?php } ?></div>
<div class="line"></div>
<div class="ranking">
<div style="width:100%; height:40px;">
<div style="float:left; display:inline;"><h2>Ranking</h2></div>
<div style="float:right; display:inline;">
<input type="submit" class="buttonRanking" id="buttonPlayers" onclick="changeRanking('players');" value="Players" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px; border:1px solid #004a7f;"> <input type="submit" class="buttonRanking" id="buttonClans" onclick="changeRanking('Clans');" value="Clans" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;"> <input type="submit" class="buttonRanking" id="buttonUba" onclick="changeRanking('Uba');" value="UBA" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;"> <input type="submit" class="buttonRanking" id="buttonPvp" onclick="changeRanking('Pvp');" value="Kills" style="border:1px solid gray; background:rgba(30,30,30,0.6); height:30px;"> 
</div>
</div>

<div id="ranking_player" class="rankings">
<?php
$dataRankingPlayers = Functions::getDataRankingPlayers(11);
if (isset($dataRankingPlayers['data']) and !empty($dataRankingPlayers['data'])){
foreach ($dataRankingPlayers['data'] as $data){
?>
<div style="background:<?= htmlspecialchars($data['color'], ENT_QUOTES, 'UTF-8'); ?> ">
<b class="place"><?= htmlspecialchars($data['rank'], ENT_QUOTES, 'UTF-8'); ?></b>
<span class="name"><?php echo htmlspecialchars($data['pilotName'], ENT_QUOTES, 'UTF-8'); ?></span>
<img src="/img/companies/logo_<?php echo ($data['factionId'] == 1 ? 'mmo' : ($data['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png" style='width: 16px;height: 16px;'> &nbsp;
<img src="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>img/ranks/rank_<?php echo htmlspecialchars($data['rankId'], ENT_QUOTES, 'UTF-8'); ?>.png">
<span class="rankpoints"><?php echo htmlspecialchars(number_format($data['rankPoints'], 0, ',', '.'), ENT_QUOTES, 'UTF-8'); ?></span>
</div>
<?php } } else { ?>
<div style="border:1px solid #732a2a; padding:5px; margin:auto; text-align:center;">No data in ranking players.</div>
<?php } ?>
</div>

<div id="ranking_clans" class="rankings" style="display:none;">
<?php
$dataRankingClan = Functions::getDataRankingClan(11);
if (isset($dataRankingClan['data']) and !empty($dataRankingClan['data'])){
foreach ($dataRankingClan['data'] as $data){
?>
<div style="background:<?= htmlspecialchars($data['color'], ENT_QUOTES, 'UTF-8'); ?> ">
<b class="place"><?= htmlspecialchars($data['rank'], ENT_QUOTES, 'UTF-8'); ?></b>
<span class="name">[<?php echo htmlspecialchars($data['tag'], ENT_QUOTES, 'UTF-8'); ?>] <?php echo htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8'); ?></span>
<img src="/img/companies/logo_<?php echo ($data['factionId'] == 1 ? 'mmo' : ($data['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png" style='width: 16px;height: 16px;'> &nbsp;
<span class="rankpoints"><?php echo htmlspecialchars(number_format($data['rankPoints'], 0, ',', '.'), ENT_QUOTES, 'UTF-8'); ?></span>
</div>
<?php } } else { ?>
<div style="border:1px solid #732a2a; padding:5px; margin:auto; text-align:center;">No data in ranking clans.</div>
<?php } ?>
</div>

<div id="ranking_uba" class="rankings" style="display:none;">
<?php
$dataRankingUba = Functions::getDataRankingUba(11);
if (isset($dataRankingUba['data']) and !empty($dataRankingUba['data'])){
foreach ($dataRankingUba['data'] as $data){
?>
<div style="background:<?= htmlspecialchars($data['color'], ENT_QUOTES, 'UTF-8'); ?> ">
<b class="place"><?= htmlspecialchars($data['rank'], ENT_QUOTES, 'UTF-8'); ?></b>
<span class="name"><?php echo htmlspecialchars($data['pilotName'], ENT_QUOTES, 'UTF-8'); ?></span>
<img src="/img/companies/logo_<?php echo ($data['factionId'] == 1 ? 'mmo' : ($data['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png" style='width: 16px;height: 16px;'> &nbsp;
<img src="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>img/ranks/rank_<?php echo htmlspecialchars($data['rankId'], ENT_QUOTES, 'UTF-8'); ?>.png">
<span class="rankpoints"><?php echo htmlspecialchars(number_format($data['puntos_totales'], 0, ',', '.'), ENT_QUOTES, 'UTF-8'); ?></span>
</div>
<?php } } else { ?>
<div style="border:1px solid #732a2a; padding:5px; margin:auto; text-align:center;">No data in ranking uba.</div>
<?php } ?>
</div>

<div id="ranking_pvp" class="rankings" style="display:none;">
<?php
$dataRankingPvp = Functions::getDataRankingPvp(11);
if (isset($dataRankingPvp['data']) and !empty($dataRankingPvp['data'])){
foreach ($dataRankingPvp['data'] as $data){
?>
<div style="background:<?= htmlspecialchars($data['color'], ENT_QUOTES, 'UTF-8'); ?> ">
<b class="place"><?= htmlspecialchars($data['rank'], ENT_QUOTES, 'UTF-8'); ?></b>
<span class="name"><?php echo htmlspecialchars($data['pilotName'], ENT_QUOTES, 'UTF-8'); ?></span>
<img src="/img/companies/logo_<?php echo ($data['factionId'] == 1 ? 'mmo' : ($data['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png" style='width: 16px;height: 16px;'> &nbsp;
<img src="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>img/ranks/rank_<?php echo htmlspecialchars($data['rankId'], ENT_QUOTES, 'UTF-8'); ?>.png">
<span class="rankpoints"><?php echo htmlspecialchars(number_format($data['rankPoints'], 0, ',', '.'), ENT_QUOTES, 'UTF-8'); ?></span>
</div>
<?php } } else { ?>
<div style="border:1px solid #732a2a; padding:5px; margin:auto; text-align:center;">No data in ranking pvp players.</div>
<?php } ?>
</div>

<div style="border: 1px solid gray;margin-top:5px" id="MyPos"> 
<b class="place"><?php echo htmlspecialchars($player['rank'], ENT_QUOTES, 'UTF-8'); ?></b>
<span class="name"><?php echo htmlspecialchars($player['pilotName'], ENT_QUOTES, 'UTF-8'); ?></span>
<img src="/img/companies/logo_<?php echo ($player['factionId'] == 1 ? 'mmo' : ($player['factionId'] == 2 ? 'eic' : 'vru')); ?>_mini.png" style='width: 16px;height: 16px;'> &nbsp;
<img src="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>img/ranks/rank_<?php echo htmlspecialchars($player['rankId'], ENT_QUOTES, 'UTF-8'); ?>.png">
<span class="rankpoints"><?php echo htmlspecialchars(number_format($player['rankPoints']), ENT_QUOTES, 'UTF-8'); // Added number_format and htmlspecialchars ?></span>

</div>

</div>

</div>


<div class="logs">
<center><div id="homeNewsContent">
<link rel="stylesheet" type="text/css" href="/css/be-news.css" media="screen">
    <style>
        
.be-position-content1{
    position:absolute;
    left:20px;
    top:125px;
    width:260px;
    height:195px;
    overflow:hidden;
}
.be-position-footer{
    position:absolute;
    left:30px;
    top:330px;
    width:260px;
    height:30px;
    overflow:hidden;
}
.be-position-center{
    position:absolute;
    left:60px;
    top:300px;
    width:200px;
    height:30px;
    overflow:hidden;
}
.be-position-half_headline_inline{
    position:absolute;
    left:20px;
    top:145px;
    width:260px;
    height:20px;
    overflow:hidden;
}
.be-position-default_button{
    position:absolute;
    left:30px;
    top:330px;
    width:260px;
    height:30px;
    overflow:hidden;
}
.be-position-higher_button{
    position:absolute;
    left:30px;
    top:306px;
    width:260px;
    height:30px;
    overflow:hidden;
}
.be-position-default_footer{
    position:absolute;
    left:15px;
    top:334px;
    width:273px;
    height:24px;
    overflow:hidden;
}
.be-position-half_headline{
    position:absolute;
    left:15px;
    top:185px;
    width:273px;
    height:20px;
    overflow:hidden;
}
.be-position-half_maintext_with_footer{
    position:absolute;
    left:15px;
    top:185px;
    width:273px;
    height:110px;
    overflow:hidden;
}
.be-position-half_maintext{
    position:absolute;
    left:15px;
    top:165px;
    width:273px;
    height:160px;
    overflow:hidden;
}
.be-position-half_maintext_with_headline{
    position:absolute;
    left:15px;
    top:205px;
    width:273px;
    overflow:hidden;
}
.be-position-full_size{
    position:absolute;
    left:0px;
    top:0px;
    width:303px;
    height:361px;
    overflow:hidden;
}
        .news-button-left{
            background-image: url('https://darkorbit-22.bpsecure.com/do_img/global/internalStart/breaking_news_button_left_25x50.png?__cv=0a76211a8f089bc45cbfd85995753b00');
            left:3%;
        }
        .news-button-right{
            background-image: url('https://darkorbit-22.bpsecure.com/do_img/global/internalStart/breaking_news_button_right_25x50.png?__cv=8b04ea90bd49a052e539ca5df3dd4900');
            right:3%;
        }

        .news-button{
            position: absolute;
            z-index: 3;
            top: 190px;
            cursor: pointer;
            background-repeat: no-repeat;
            background-position: -25px center;
            width: 25px;
            height: 50px;
        }

        .news-button:hover {
            background-position: -50px center;
        }
        .news-button:active {
            background-position: -75px center;
        }

        .news-base-container{
            padding-left:8px;
            padding-top:7px;
            overflow: hidden;
        }
        .news-base-layout{

        }

        .news-base-pagination{
            width:100%;
            padding-top:7px;
            min-height: 24px;
            text-align: center;

        }

        .news-base-pagination-dot{
            background-color: black;
            border-color: #517999;
            border-style: solid;
            border-width: 1px;
            min-width:8px;
            min-height: 8px;
            border-radius: 5px;
            display: inline-block;
            vertical-align: middle;
            outline: none;
        }
        .news-base-pagination-inner-dot{
            background-color: #517999;
            border-style: none;
            min-width: 6px;
            min-height: 6px;
            border-radius: 3px;
            display: block;
            margin: 1px;
            outline: none;
        }

        .news-controll-base{
            /*transition: max-height 1000ms ease,opacity 1s ease, height 1000ms ease;*/
            transition: opacity 1500ms ease;
            max-height: 381px;
            height: 381px;
            opacity: 1;
        }

        .news-controll-hide{
            opacity: 0;
            max-height: 0px;
            height 0px;
        }
        .news-controll-show{
            opacity: 1;
        }

        .news-countdown{
            width: 303px;
            height: 25px;
            text-align: center;
            margin-left: 9px;
            position: absolute;
            top: 366px;
        }
    </style>
    <script type="application/javascript">
        var beCurrent = 1;
        var beTotal = 0;
        var newsTimer = null;
        var delayedTimer = null;
        var reloadInitiated = false;

        function startTimer(){
            newsTimer = window.setInterval(beNext, 5000);
        }

        function switchToRegularTimer(){
            clearInterval(delayedTimer);
            delayedTimer = null;
            startTimer();
        }

        function startDelayedTimer(){
            stopTimer();
            if (delayedTimer != null){
                clearInterval(delayedTimer);
                delayedTimer = null;
            }
            delayedTimer = window.setInterval(switchToRegularTimer, 5000);
        }


        function stopTimer(){
            clearInterval(newsTimer);
        }

        function beNext(){
            beHide(beCurrent);
            beCurrent++;
            if (beCurrent > beTotal){
                beCurrent = 1;
            }
            beShow(beCurrent);
        }

        function bePrev(){
            beHide(beCurrent);
            beCurrent--;
            if (beCurrent < 1){
                beCurrent = beTotal;
            }
            beShow(beCurrent);
        }

        function beSwitchTo(nr){
            beHide(beCurrent);
            beCurrent = nr;
            beShow(nr);
        }

        function beShow(nr){
            if (jQuery('#be_news_' + nr)) {
                jQuery('#be_news_' + nr).removeClass('news-controll-hide');
                jQuery('#be_pag_dot_' + nr).show();
            } else {
                console.error('show - element not exists ','be_news_' + nr);
            }
        }
        function beHide(nr){
            if (jQuery('#be_news_' + nr)) {
                jQuery('#be_news_' + nr).addClass('news-controll-hide');
                jQuery('#be_pag_dot_' + nr).hide();
            } else {
                console.error('hide - element not exists ','be_news_' + nr);
            }
        }
		startTimer();
    </script>
    <div name="be-pagination" class="news-base-pagination">
	<?php 
	$notice_count_for_pagination = 0;
	$stmt_news_pagination = $mysqli->prepare("SELECT id FROM server_news ORDER by id DESC"); // Only need ID for counting
	$stmt_news_pagination->execute();
	$news_pagination_result = $stmt_news_pagination->get_result();
	if ($news_pagination_result->num_rows > 0){
		while($data_pagination = $news_pagination_result->fetch_assoc()){
			$notice_count_for_pagination++;
	?>
		<script>beTotal = <?= htmlspecialchars($notice_count_for_pagination, ENT_QUOTES, 'UTF-8'); ?>;</script> <?php // Escaped JS output ?>
		<a class="news-base-pagination-dot" href="javascript:beSwitchTo(<?= htmlspecialchars($notice_count_for_pagination, ENT_QUOTES, 'UTF-8'); ?>);startDelayedTimer();"> <?php // Escaped JS output ?>
			<span style="<?php if ($notice_count_for_pagination != 1){ ?>display: none;<?php }?>" class="news-base-pagination-inner-dot" id="be_pag_dot_<?= htmlspecialchars($notice_count_for_pagination, ENT_QUOTES, 'UTF-8'); ?>"></span> <?php // Escaped id attribute ?>
		</a>
		
	<?php } } $stmt_news_pagination->close(); ?>
    </div>
    
    <div class="news-button news-button-left" onclick="startDelayedTimer();bePrev()"></div>
    <div class="news-button news-button-right" onclick="startDelayedTimer();beNext()"></div>
    <div class="news-base-container">  
	
		<?php 
		$notice_content_index = 0;
		// Prepared statement for news content (already in original, good)
		$stmt_news_content = $mysqli->prepare("SELECT image, urlNotice, nameButton, title, news FROM server_news ORDER by id DESC");
		$stmt_news_content->execute();
		$news_content_result = $stmt_news_content->get_result();
		if ($news_content_result->num_rows > 0){
			while($data_content = $news_content_result->fetch_assoc()){
				$notice_content_index++;
		?>
			<div id="be_news_<?= htmlspecialchars($notice_content_index, ENT_QUOTES, 'UTF-8'); ?>" onclick="startDelayedTimer()" class="news-base-layout news-controll-base <?php if ($notice_content_index != 1){ ?>news-controll-hide<?php }?>" style=""> <?php // Escaped id attribute ?>
			
			<div id="apoc_refresh_feb2021" class="breaking-news-layer" style="background-image: url(<?= htmlspecialchars($data_content['image'], ENT_QUOTES, 'UTF-8'); ?>);width:303px;height:381px;position: relative;background-repeat: no-repeat;background-color: transparent"> <?php // urlNotice is already escaped by Functions::s in original, image needs it here ?>
			<?php if (!empty($data_content['urlNotice'])) { ?><div onclick="<?= htmlspecialchars($data_content['urlNotice'], ENT_QUOTES, 'UTF-8'); ?>" class="be-position-center be-style-defaultButton"><?php if (!empty($data_content['nameButton'])) { echo htmlspecialchars($data_content['nameButton'], ENT_QUOTES, 'UTF-8'); } ?></div><?php } ?><div class="be-position-half_headline be-style-bold_full_content"><?= htmlspecialchars($data_content['title'], ENT_QUOTES, 'UTF-8'); ?></div><div class="be-position-half_maintext_with_headline be-style-default"><?= nl2br(htmlspecialchars($data_content['news'], ENT_QUOTES, 'UTF-8')); ?></div>
					
			</div>
		
			</div>
			
		<?php } } $stmt_news_content->close(); ?></center>
        
		

    </div>

</div>

<div class="text ps-container"><label for="bootkeys" style="color:#fff; display: inline-block;">
            <span style="color:#11d44f;">Green Keys: <?php echo htmlspecialchars($bootyKeys->greenKeys, ENT_QUOTES, 'UTF-8');?></span>
            <span style="color:red;">Red Keys: <?php echo htmlspecialchars($bootyKeys->redKeys, ENT_QUOTES, 'UTF-8');?></span>
            <span style="color:blue;">Blue Keys: <?php echo htmlspecialchars($bootyKeys->blueKeys, ENT_QUOTES, 'UTF-8');?></span>
            <span style="color:silver;">Silver Keys: <?php echo htmlspecialchars($bootyKeys->silverKeys, ENT_QUOTES, 'UTF-8');?></span>
            <span style="color:gold;">Gold Keys: <?php echo htmlspecialchars($bootyKeys->goldKeys, ENT_QUOTES, 'UTF-8');?></span>
			<span style="color: #d029d6 ">E.C Keys: <?php echo htmlspecialchars($bootyKeys->ecKeys, ENT_QUOTES, 'UTF-8');?></span> <br />
<label for="online" data-toggle="tooltip" data-placement="bottom" data-html="true">
        <b style="color:silver">Players Online</b> <span class="user-user" class="button" style="color:#11d44f;"> <?php echo htmlspecialchars(Socket::Get('OnlineCount', array('Return' => 0)), ENT_QUOTES, 'UTF-8'); ?> <i style="color:silver;" class="fa fa-user"></i><br/>
		




</div>

</div>


<div class="logs styleUpdate" style="width:100%; height:100%; border:none; margin-top:25px; margin-bottom:25px; padding:0px; background-color:transparent">
<!--
<div class="text ps-container" style="overflow-y: hidden; padding:0px; margin:0px; width:100%; height:100%; border-left:solid 1px #004a7f; border-right:solid 1px #004a7f; border-bottom:solid 1px #004a7f; border-top:solid 1px #004a7f;">
<iframe width="100%" height="100%" src="/video/galaxy.mp4" controls="false" frameborder="0" allowfullscreen></iframe>
</div>
-->

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

    if (value == "players"){
        document.getElementById("ranking_player").style.display = "inline";
        document.getElementById("MyPos").style.display = "block";
        document.getElementById("buttonPlayers").style = "border:1px solid gray; background:rgba(30,30,30,0.6); height:30px; border:1px solid #004a7f;";
    } else if (value == "Clans"){
        document.getElementById("ranking_clans").style.display = "inline";
        document.getElementById("MyPos").style.display = "none";
        document.getElementById("buttonClans").style = "border:1px solid gray; background:rgba(30,30,30,0.6); height:30px; border:1px solid #004a7f;";
    } else if (value == "Uba"){
        document.getElementById("ranking_uba").style.display = "inline";
        document.getElementById("MyPos").style.display = "none";
        document.getElementById("buttonUba").style = "border:1px solid gray; background:rgba(30,30,30,0.6); height:30px; border:1px solid #004a7f;";
    } else if (value == "Pvp"){
        document.getElementById("ranking_pvp").style.display = "inline";
        document.getElementById("MyPos").style.display = "none";
        document.getElementById("buttonPvp").style = "border:1px solid gray; background:rgba(30,30,30,0.6); height:30px; border:1px solid #004a7f;";
    }

}
function deleteAnnounce(id){
    if (id == null){ return; }

    $.ajax({
        type: 'POST',
        url: '<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>api/', // Escaped DOMAIN
        data: 'newId='+id+'&action=deleteAnnounce',
        success: function(response) {
          var json = jQuery.parseJSON(response);

          if (json.status == true){
            document.getElementById('notice_'+id).remove();
          }

          if (json.message != ""){
              toast(json.message);
          }

        }
    });

}
</script>

<!-- <?php if (!isset($_SESSION['msgRead']) and empty($_SESSION['msgRead'])){ ?>
 <div id="id03" class="w3-modal" style="height: 30%; display: block;"> <div class="w3-modal-content modal_modification" style="height: 96% !important;"> <div class="w3-container"><span onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-display-topright">×</span> <div class="center"> <img src="" width="0%"> <div style="text-align:center;"> <p style="font-weight: bold;color: gold;font-size: 25px;padding-bottom: 12px;">Voucher Code</p> <p style="font-weight: bold;color: gold; font-size: 15px;padding-bottom: 15px;">SpaceBase</p> <center><a class="btn green darken-4 col s12" style="width: 400px !important;bold;color: gold;height: 80px !important;">30.000 U.<center>100. E.C </center></a></center></div><a class="btn green darken-4 col s12" style="width: 400px !important;height: 80px !important;"> </a></div><a class="btn green darken-4 col s12" style="width: 400px !important;height: 80px !important;"> </a></div><a class="btn green darken-4 col s12" style="width: 400px !important;height: 80px !important;"> </a></div></div>
<?php
 }
$_SESSION['msgRead'] = true;
?> -->

<script> 
var deadline = new Date("November 16, 2022 19:00:00").getTime(); 
var x = setInterval(function() { 
var now = new Date().getTime(); 
var t = deadline - now; 
var days = Math.floor(t / (1000 * 60 * 60 * 24)); 
var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60)); 
var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60)); 
var seconds = Math.floor((t % (1000 * 60)) / 1000); 
document.getElementById("demo").innerHTML = days + "Day(s) "
+ hours + "Hour(s) " + minutes + "Minute(s) " + seconds + "Second(s) "; 
    if (t < 0) { 
        clearInterval(x); 
        document.getElementById("demo").innerHTML = "This sale has ended."; 
    } 
}, 1000); 
</script>

<?php require_once(INCLUDES . 'footer.php'); ?>
