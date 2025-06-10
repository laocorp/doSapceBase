<?php require_once(INCLUDES . 'header.php'); ?>
<?php
	$userid = $player["userId"];
	
	Functions::$ammos = [];
	Functions::$translations = [];
	Functions::InitQuestsystem();
	
	$quests = [];
	
	$company = $player['factionId'];
	if($company == 1) $company = "mmo";
	else if($company == 2) $company = "eic";
	else if($company == 3) $company = "vru";
	$level = $player['level'];
	
	$sql = "SELECT * FROM server_quests ORDER BY neededLvl ASC";
	
	$queryNpc = $mysqli->query("SELECT * FROM log_player_pve_kills WHERE userId = ".$userid);
	$queryPlayer = $mysqli->query("SELECT * FROM log_player_pvp_kills WHERE userId = ".$userid);
	$npcKills = [];
	$playerKills = [];
	$npcKillsQuest = [];
	while($row = $queryNpc->fetch_assoc()) $npcKills[count($npcKills)] = $row;
	while($row = $queryPlayer->fetch_assoc()) $playerKills[count($playerKills)] = $row;
	
	$query4 = $mysqli->query("SELECT COUNT(id) AS c FROM player_quests WHERE userId = ".$userid." AND state = 'accepted'");
	while($row4 = $query4->fetch_assoc()) $questCount = $row4["c"];
	
	$query = $mysqli->query("SELECT * FROM server_quests ORDER BY neededLvl ASC");
	while($row = $query->fetch_assoc()) {
		if(($row["onlyAdmin"] == 1 && self::checkIsAdmin($player['userId'])) || $row["onlyAdmin"] == 0) {
			$row = Functions::checkQuest($row, $mysqli, $userid, $level, $npcKills, $playerKills);
			
			if($row["description"] == null) $row["description"] = "";
			
			$query2 = $mysqli->query("SELECT * FROM server_quests_rewards_temp AS t LEFT JOIN server_quests_rewards AS r ON t.rewardId = r.id WHERE questId = ".$row["id"]);
			while($row2 = $query2->fetch_assoc()) {
				$rewardId = count($row["rewards"]);
				$row["rewards"][$rewardId] = [];
				$row["rewards"][$rewardId]["key"] = $row2["type"];
				$row["rewards"][$rewardId]["translation"] = Functions::getTranslation($row2["type"]);
				$row["rewards"][$rewardId]["amount"] = number_format($row2["amount"], 0 , ',' , '.');
			}
			//Prüfen ob quest bereits angenommen wurde oder nicht
			$query3 = $mysqli->query("SELECT id, state FROM player_quests WHERE userId = ".$userid." AND questId = ".$row["id"]);
			$num3 = $query3->num_rows;
			if($num3 <= 0) {
				//Quest wurde noch nicht angenommen
				if($level >= $row["neededLvl"]) {
					if($questCount <= 4) {
						$row["buttons"] = "<form method='post'>".
							"<button type='submit' name='accept' data-quest='".$row["id"]."' class='questBtn'>".Functions::getTranslation("accept")."</button>".
						"</form>";
					} else {
						$row["buttons"] = "<p>".Functions::getTranslation("questMax")."</p>";
					}
				} else {
					$row["buttons"] = "<p>".Functions::getTranslation("questLvlTooLow")."</p>";
				}
			} else {
				if($row["state"] == 1) {
					//Quest angenommen, aber noch nicht abgeschlossen
					$row["buttons"] = "<form method='post'>".
						"<button type='submit' name='cancel' data-quest='".$row["id"]."' class='questBtn'>".Functions::getTranslation("cancel")."</button>".
					"</form>";
				} else {
					while($row3 = $query3->fetch_assoc()) {
						if($row3["state"] == "accepted") {
							$row["buttons"] = "<form method='post'>".
								"<button type='submit' name='collect' data-quest='".$row["id"]."' class='questBtn'>".Functions::getTranslation("collect")."</button>".
							"</form>";
						} else {
							$row["buttons"] = "<p>".Functions::getTranslation("questCollected")."</p>";
							$row["questCollected"] = true;
						}
					}
				}
			}
			$row["buttons"] = "<div style='width: 100%; height: 100%; position: relative;'><div style='position: absolute; bottom: 3px; right: 10px; width: 100%;'>".$row["buttons"]."</div></div>";
			//print_r($row);
			$quests[count($quests)] = $row;
			
		} else if($row["onlyAdmin"] == 1 && !self::checkIsAdmin($player['userId'])) {
			$row = null;
		}
	}
	
	$data = json_decode(Functions::GetPlayer()["data"]);
?>
<?php require_once(INCLUDES . 'data.php'); ?>

<div class="page quest">
<div class="ships styleUpdate" style="width:872px;height:525px; margin:0 auto;">
<div id="equipment_container" style="background-color: #1D1D1D; width: 100%; height: 100%; color:rgb(14 165 233);">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
	.listItem {
		width: 100%;
		height: 10%;
		border: 1px solid green;
		padding: 2px;
		background-color: #1d1d1d;
		cursor: pointer;
		margin-top: 2px;
		margin-bottom: 2px;
	}
	.listItem:hover {
		border: 1px solid white;
	}
	.listItemIcn {
		border-right: 1px solid gray;
	}
	.questBtn {
		padding: 5px;
		background-color: rgb(30 58 138);
		border: 1px dotted blue;
		color: yellow;
		min-width: 70%;
	}
	.questBtn:hover {
		background-color: rgb(30 58 138);
	}
	.highlight {
		border: 1px solid yellow;
	}
	.highlight:hover {
		border: 1px solid orange;
	}
</style>
<div id="questWindow" style="height: 100%; user-select: none; background-image: url('./do_img/global/quest/screen_1.jpg'); background-position: center center; background-size: 145% 145%;">
	<div style="width: 100%; height: 100%; background-color: rgba(29,29,29,0.95);">
		<div id="leftPart" style="float: left; width: 35%; height: 100%; padding: 5px;">
			<b><?php echo Functions::getTranslation("jobs"); ?></b><div style="width: 70%; float: right; text-align: right;"></div>
			<script>
				var checked = <?php echo $player["showCompletedQuests"]; ?>;
				
				if(checked == 0) $("#hideCompletedQuests").attr("checked", "checked");
				
				$("#hideCompletedQuests").change(function() {
					var checked = $(this).is(':checked');
					
					$.ajax({
					  type: 'POST',
					  url: '<?php echo DOMAIN; ?>api/',
					  data: { action: 'hide_completed_quests', check: checked },
					  success: function(response) {
						location.reload();
					  }
					});
				});
			</script>
			<div id="tv" style="width: 100%; height: 30%; border: 6px solid black;">
				<div style="width: 100%; height: 100%; background-image: url('./do_img/global/companies/<?php echo $company; ?>.png'); background-position: center center; background-size: 140% 160%; box-shadow: inset 0 0 10px #000000;"></div>
			</div>
			<div id="list" style="width: 100%; height: 65%; border: 1px dotted black; padding: 2px; overflow-x: hidden; overflow-y: auto;">
				<?php
					for($i = 0; $i < count($quests); $i++) {
						$state = "";
						$add = "";
						if($quests[$i]["state"] == 0) $state = "question";
						if($quests[$i]["state"] == 1) $state = "clock";
						if($quests[$i]["state"] == 2) $state = "check";
						if($quests[$i]["state"] == 3) $state = "lock";
						if($quests[$i]["neededLvl"] > 0) $add = Functions::getTranslation("level").": ".$quests[$i]["neededLvl"];
						else $add = "&nbsp;";
						echo '<div class="listItem" data-id="'.$quests[$i]["id"].'"><table style="width: 100%; font-size: 10px; line-height: 10px;"><tr><td rowspan="2" style="width: 20%; text-align: center; font-size: 16px;"><i class="fa fa-'.$state.'"></i></td><td><b>'.$quests[$i]["title"].'</b></td></tr><tr><td style="text-align: right;">'.$add.'</td></tr></table></div>';
					}
				?>
			</div>
			<script>
				$(".listItem").click(function() {
					var id = $(this).attr("data-id");
					loadQuest(id);
				});
			</script>
		</div>
		<div id="rightPart" style="float: right; width: 65%; height: 100%; padding: 5px; overflow: auto;">
			<b><?php echo Functions::getTranslation("overview"); ?></b>
			<div id="topRightPart" style="width: 100%; height: 25%; border: 1px solid black; padding: 5px; box-shadow: inset 0 0 10px #000000; overflow-x: hidden; overflow-y: auto; font-size: 10px;">
				
			</div>
			<div id="middleRightPart" style="width: 100%; height: 33%; margin-top: 2%; border: 1px solid black; padding: 5px; box-shadow: inset 0 0 10px #000000; overflow-x: hidden; overflow-y: auto; font-size: 10px;">
				
			</div>
			<b><?php echo Functions::getTranslation("reward"); ?></b>
			<div style="width: 100%; height: 30%;">
				<div id="bottomRightPart" style="float: left; width: 70%; font-size: 10px; height: 100%; border: 1px solid black; padding: 5px; box-shadow: inset 0 0 10px #000000; overflow-x: hidden; overflow-y: auto;">
				
				</div>
				<div id="bottomRightPart2" style="float: right; width: 30%; height: 100%; text-align: right; font-weight: bold; font-size: 15px;">
				
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var quests = <?php echo json_encode($quests); ?>;
	
	if(localStorage.getItem("questId") === null) {
		localStorage.setItem("questId", 1);
	}
	
	jQuery.fn.scrollTo = function(elem, speed) { 
		$(this).animate({
			scrollTop:  $(this).scrollTop() - $(this).offset().top + $(elem).offset().top - 2
		}, speed == undefined ? 1000 : speed); 
		return this; 
	};
	
	function loadQuest(id, sp = null) {
		localStorage.setItem("questId", id);
		$(".listItem").removeClass("highlight");
		$(".listItem[data-id='"+id+"']").addClass("highlight");
		if(sp) {
			$("#list").scrollTo(".listItem[data-id='"+id+"']", 500);
		}
		for(var i = 0; i < quests.length; i++) {
			if(quests[i]["id"] == id) {
				$("#topRightPart").html("<b>"+quests[i]["title"]+"</b><br>"+quests[i]["description"]);
				var tasks = quests[i]["tasks"];
				$("#middleRightPart").empty();
				for(var j = 0; j < tasks.length; j++) {
					$("#middleRightPart").append(tasks[j]["description"]+"<br>");
				}
				var rewards = quests[i]["rewards"];
				$("#bottomRightPart").empty();
				for(var j = 0; j < rewards.length; j++) {
					$("#bottomRightPart").append("&bull;&nbsp;"+rewards[j]["amount"]+"&nbsp;"+rewards[j]["translation"]+"<br>");
				}
				$("#bottomRightPart2").html(quests[i]["buttons"]);
			}
		}
		
		$(".questBtn").unbind("click tap");
		$(".questBtn").on("click tap", function(e) {
			e.preventDefault();
			var name = $(this).attr("name");
			var questId = $(this).attr("data-quest");
			
			$(this).attr("disabled", true);
			$(this).css("cursor", "not-allowed");
			
			if(name == "accept") {
				$.ajax({
				  url: '<?php echo DOMAIN; ?>api/',
				  data: { action: 'accept_quest', questId: questId },
				  type: 'POST',
				  success:function(response) {
					var json = jQuery.parseJSON(response);

					if (json.message != '') {
						toast(json.message);
						$(this).attr("disabled", false);
						$(this).css("cursor", "pointer");
					} else {
						location.reload();
					}
				  }
				});
			} else if(name == "cancel") {
				$.ajax({
				  url: '<?php echo DOMAIN; ?>api/',
				  data: { action: 'cancel_quest', questId: questId },
				  type: 'POST',
				  success:function(response) {
					var json = jQuery.parseJSON(response);

					if (json.message != '') {
						toast(json.message);
						$(this).attr("disabled", false);
						$(this).css("cursor", "pointer");
					} else {
						location.reload();
					}
				  }
				});
			} else if(name == "collect") {
				$.ajax({
				  url: '<?php echo DOMAIN; ?>api/',
				  data: { action: 'collect_quest', questId: questId },
				  type: 'POST',
				  success:function(response) {
					var json = jQuery.parseJSON(response);

					if (json.message != '') {
						toast(json.message);
						$(this).attr("disabled", false);
						$(this).css("cursor", "pointer");
					} else {
						location.reload();
					}
				  }
				});
			}
		});
	}
	
	loadQuest(localStorage.getItem("questId"), true);
</script>
</div>
</div>
</div>

</div>

<?php require_once(INCLUDES . 'footer.php'); ?>
