<?php
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
	$request = $_POST['action'];

	if ($request === 'register') {
		if (isset($_POST['username'], $_POST['password'], $_POST['password_confirm'], $_POST['email'], $_POST['g-recaptcha-response'])) {
			echo Functions::Register(Functions::s($_POST['username']), Functions::s($_POST['password']), Functions::s($_POST['password_confirm']), Functions::s($_POST['email']), $_POST['g-recaptcha-response'], (isset($_POST['terms']) ? true : false));
		}
  	} else if ($request === 'login') {
		if (isset($_POST['username'], $_POST['password'])) {
			echo Functions::Login(Functions::s($_POST['username']), Functions::s($_POST['password']));
		}
	} else if ($request === 'recoverPassword') {
		if (isset($_POST['usr'])) {
			echo Functions::RecoverPassword(Functions::s($_POST['usr']));
		}
	} else if ($request === 'recover_change_password') {
		if (isset($_POST['newpassword'], $_POST['repeatnewpassword'])) {
			echo Functions::recoverchangepassword(Functions::s($_POST['newpassword']), Functions::s($_POST['repeatnewpassword']));
		}
	} else if ($request === 'company_select') {
		if (isset($_POST['factionId'])) {
			echo Functions::CompanySelect(Functions::s($_POST['factionId']));
		}
	} else if ($request === 'search_clan') {
		if (isset($_POST['keywords'])) {
			echo Functions::SearchClan(Functions::s($_POST['keywords']));
		}
	} else if ($request === 'send_clan_application') {
		if (isset($_POST['clanId'], $_POST['text'])) {
			echo Functions::SendClanApplication(Functions::s($_POST['clanId']), Functions::s($_POST['text']));
		}
	} else if ($request === 'withdraw_pending_application') {
		if (isset($_POST['clanId'])) {
			echo Functions::WithdrawPendingApplication(Functions::s($_POST['clanId']));
		}
	} else if ($request === 'found_clan') {
		if (isset($_POST['name'], $_POST['tag'], $_POST['description'])) {
			echo Functions::FoundClan(Functions::s($_POST['name']), Functions::s($_POST['tag']), Functions::s($_POST['description']));
		}
	} else if ($request === 'dismiss_clan_member') {
		echo Functions::DismissClanMember(Functions::s((isset($_POST['memberId'])) ? $_POST['memberId'] : "0"));
	} else if ($request === 'accept_clan_application') {
		if (isset($_POST['userId'])) {
			echo Functions::AcceptClanApplication(Functions::s($_POST['userId']));
		}
	} else if ($request === 'decline_clan_application') {
		if (isset($_POST['userId'])) {
			echo Functions::DeclineClanApplication(Functions::s($_POST['userId']));
		}
	} else if ($request === 'change_pilot_name') {
		if (isset($_POST['pilotName'])) {
			echo Functions::ChangePilotName(Functions::s($_POST['pilotName']));
		}
	} else if ($request === 'change_security_settings') {
		if (isset($_POST['sqa1']) && isset($_POST['sqa2']) && isset($_POST['sqa3']) && isset($_POST['securityQuestion1']) && isset($_POST['securityQuestion2']) && isset($_POST['securityQuestion3'])) {
			echo Functions::ChangeSecuritysettings(Functions::s($_POST['sqa1']),Functions::s($_POST['sqa2']),Functions::s($_POST['sqa3']),Functions::s($_POST['securityQuestion1']),Functions::s($_POST['securityQuestion2']),Functions::s($_POST['securityQuestion3']));
		}
	} else if ($request === 'change_pet_name') {
		echo Functions::ChangePetName(Functions::s($_POST['petName']), Functions::s((isset($_POST['petChoosed'])) ? $_POST['petChoosed'] : ""));
	} else if ($request === 'change_profile_url') {
		if (isset($_POST['urlprofile'])) {
			echo Functions::changeprofileurl(Functions::s($_POST['urlprofile']));
		}
	} else if ($request === 'change_password') {
		if (isset($_POST['newpassword'], $_POST['repeatnewpassword'])) {
			echo Functions::changepassword(Functions::s($_POST['newpassword']), Functions::s($_POST['repeatnewpassword']));
		}
	} else if ($request === 'change_version') {
		if (isset($_POST['version'])) {
			echo Functions::ChangeVersion(Functions::s($_POST['version']));
		}
	} else if ($request === 'send_link_again') {
		if (isset($_POST['username'])) {
			echo Functions::SendLinkAgain(Functions::s($_POST['username']));
		}
	} else if ($request === 'diplomacy_search_clan') {
		if (isset($_POST['keywords'])) {
			echo Functions::DiplomacySearchClan(Functions::s($_POST['keywords']));
		}
	} else if ($request === 'request_diplomacy') {
		if (isset($_POST['clanId'], $_POST['diplomacyType'])) {
			echo Functions::RequestDiplomacy(Functions::s($_POST['clanId']), Functions::s($_POST['diplomacyType']));
		}
	} else if ($request === 'cancel_diplomacy_request') {
		if (isset($_POST['requestId'])) {
			echo Functions::CancelDiplomacyRequest(Functions::s($_POST['requestId']));
		}
	} else if ($request === 'decline_diplomacy_request') {
		if (isset($_POST['requestId'])) {
			echo Functions::DeclineDiplomacyRequest(Functions::s($_POST['requestId']));
		}
	} else if ($request === 'accept_diplomacy_request') {
		if (isset($_POST['requestId'])) {
			echo Functions::AcceptDiplomacyRequest(Functions::s($_POST['requestId']));
		}
	} else if ($request === 'end_diplomacy') {
		if (isset($_POST['diplomacyId'])) {
			echo Functions::EndDiplomacy(Functions::s($_POST['diplomacyId']));
		}
	} else if ($request === 'getPositions') {
		if (isset($_POST['mapID'])) {
			echo Functions::getPositions(Functions::s($_POST['mapID']));
		}
	} else if ($request === 'request_base') {
		$nameBase = (isset($_POST['nameBase'])) ? $_POST['nameBase'] : "";
		$positionsAvailable = (isset($_POST['positionsAvailable'])) ? $_POST['positionsAvailable'] : "";
		echo Functions::RequestBase(Functions::s($nameBase), Functions::s($positionsAvailable));
	} else if ($request === 'end_war_request') {
		if (isset($_POST['clanId']) && isset($_POST['tyPe'])) {
			echo Functions::RequestDiplomacy(Functions::s($_POST['clanId']), Functions::s($_POST['tyPe']), Functions::s((isset($_POST['message'])) ? $_POST['message'] : ""));
		}
	} else if ($request === 'buy') {
		if (isset($_POST['itemId'], $_POST['amount'])) {
			echo Functions::Buy(Functions::s($_POST['itemId']), Functions::s($_POST['amount']));
		}
	} else if ($request === 'use_researchPoints') {
		if (isset($_POST['skill'])) {
			echo Functions::UseResearchPoints(Functions::s($_POST['skill']));
		}
	} else if ($request === 'exchange_logdisks') {
		echo Functions::ExchangeLogdisks();
	} else if ($request === 'reset_skills') {
		echo Functions::ResetSkills();
	} else if ($request === 'leave_clan') {
		echo Functions::LeaveClan();

	} else if ($request === 'change_ship') {
		if (isset($_POST['ship'])) {
			echo Functions::ChangeShip(Functions::s($_POST['ship']));
		}
	} else if ($request === 'info_ship') {
		if (isset($_POST['ship'])) {
			echo Functions::infoShip(Functions::s($_POST['ship']));
		}
	} else if ($request === 'info_clan') {
		if (isset($_POST['clanid'])) {
			echo Functions::infoclan($_POST['clanid']);
		}
	} else if ($request === 'info_shop') {
		if (isset($_POST['shop'])) {
			echo Functions::infoshop(Functions::s($_POST['shop']));
		}
	}else if ($request === 'getPrice') {
		if (isset($_POST['amount']) and isset($_POST['id'])) {
			echo Functions::getPrice(Functions::s($_POST['amount']), $_POST['id']);
		}
	}else if ($request === 'voucher') {
		if (isset($_POST['voucherId'])){
			echo Functions::checkVoucher(Functions::s($_POST['voucherId']));
		}
	}else if ($request === 'gg') {
		if (isset($_POST['gateId']) and !empty($_POST['gateId']) and is_numeric($_POST['gateId'])){
			echo Functions::gg(Functions::s($_POST['gateId']));
		}
	}else if ($request === 'ggPreparePortal') {
		if (isset($_POST['gateId']) and !empty($_POST['gateId']) and is_numeric($_POST['gateId'])){
			echo Functions::ggPreparePortal(Functions::s($_POST['gateId']));
		}
	}else if ($request === 'buyLive') {
		if (isset($_POST['gateId']) and !empty($_POST['gateId']) and is_numeric($_POST['gateId'])){
			echo Functions::buyLive(Functions::s($_POST['gateId']));
		}
	}else if ($request === 'getInfoGate') {
		if (isset($_POST['gateId']) and !empty($_POST['gateId']) and is_numeric($_POST['gateId'])){
			echo Functions::getInfoGate(Functions::s($_POST['gateId']), true);
		}
	}else if ($request === 'getLivesGate') {
		if (isset($_POST['gateId']) and !empty($_POST['gateId']) and is_numeric($_POST['gateId'])){
			echo Functions::getInfoGalaxyGate(Functions::s($_POST['gateId']));
		}
	}else if ($request === 'clan_cancel_application') {
		if (isset($_POST['app']) and !empty($_POST['app'])){
			echo Functions::clan_cancel_application(Functions::s($_POST['app']));
		}
	}
	else if ($request === 'change_clan_settings') {
		echo Functions::change_clan_settings(Functions::s($_POST['tag']), Functions::s($_POST['name']), Functions::s($_POST['profile']), Functions::s($_POST['description']), Functions::s($_POST['Recruitment']), Functions::s($_POST['Company']));
		} else if ($request === 'hide_completed_quests') {
		echo Functions::HideCompletedQuests(Functions::s($_POST['check']));
	} else if ($request === 'accept_quest') {
		if (isset($_POST['questId'])) {
			echo Functions::AcceptQuest(Functions::s($_POST['questId']));
		}
	} else if ($request === 'cancel_quest') {
		if (isset($_POST['questId'])) {
			echo Functions::CancelQuest(Functions::s($_POST['questId']));
		}
	} else if ($request === 'collect_quest') {
		if (isset($_POST['questId'])) {
			echo Functions::CollectQuest(Functions::s($_POST['questId']));
		}
	} else if ($request === 'send_clan_message') {
		echo Functions::send_clan_message(Functions::s($_POST['message']));
	} else if ($request === 'change_clan_leader') {
		echo Functions::change_clan_leader(Functions::s((isset($_POST['newLeaderId'])) ? $_POST['newLeaderId'] : "0"));
	} else if ($request === 'delete_clan') {
		echo Functions::delete_clan(Functions::s((isset($_POST['subAction'])) ? $_POST['subAction'] : "0"));
	} else if ($request === 'send_bank_credits') {
		if (isset($_POST['to']) and !empty($_POST['to']) and is_numeric($_POST['to']) and isset($_POST['credits']) and !empty($_POST['credits']) and is_numeric($_POST['credits']) and isset($_POST['reason']) and !empty($_POST['reason'])){
			echo Functions::send_bank_credits(Functions::s($_POST['to']), Functions::s($_POST['credits']), Functions::s($_POST['reason']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'send_bank_uridium') {
		if (isset($_POST['to']) and !empty($_POST['to']) and is_numeric($_POST['to']) and isset($_POST['uridium']) and !empty($_POST['uridium']) and is_numeric($_POST['uridium']) and isset($_POST['reason']) and !empty($_POST['reason'])){
			echo Functions::send_bank_uridium(Functions::s($_POST['to']), Functions::s($_POST['uridium']), Functions::s($_POST['reason']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'change_credits_tax') {
		if (isset($_POST['tax']) and !empty($_POST['tax'])){
			echo Functions::change_credits_tax(Functions::s($_POST['tax']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'change_uridium_tax') {
		if (isset($_POST['tax']) and !empty($_POST['tax'])){
			echo Functions::change_uridium_tax(Functions::s($_POST['tax']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'buildDrone') {
		if (isset($_POST['drone']) and !empty($_POST['drone'])){
			echo Functions::buildDrone(Functions::s($_POST['drone']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'selectItemUpgradeSystem') {
		if (isset($_POST['idItem']) and !empty($_POST['idItem']) and isset($_POST['dataChance']) and !empty($_POST['dataChance'])){
			echo Functions::selectItemUpgradeSystem(Functions::s($_POST['idItem']), Functions::s($_POST['dataChance']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'ChanceItem') {
		if (isset($_POST['idItem']) and !empty($_POST['idItem']) and isset($_POST['actionChance']) && !empty($_POST['actionChance']) && isset($_POST['dataChance']) && !empty($_POST['dataChance'])){
			echo Functions::ChanceItem(Functions::s($_POST['idItem']), Functions::s($_POST['dataChance']), Functions::s($_POST['actionChance']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'upgradeItem') {
		if (isset($_POST['idItem']) and !empty($_POST['idItem']) && isset($_POST['dataChance']) && !empty($_POST['dataChance'])){
			echo Functions::upgradeItem(Functions::s($_POST['idItem']), Functions::s($_POST['dataChance']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'checkProgressBar') {
		if (isset($_POST['idItem']) and !empty($_POST['idItem'])){
			echo Functions::checkProgressBar(Functions::s($_POST['idItem']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'finishUpgrade') {
		if (isset($_POST['idItem']) and !empty($_POST['idItem'])){
			echo Functions::finishUpgrade(Functions::s($_POST['idItem']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'saveTitle') {
		if (isset($_POST['title']) and !empty($_POST['title'])){
			echo Functions::saveTitle(Functions::s($_POST['title']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'buyTitle') {
		echo Functions::buyTitle(Functions::s($_POST['title']));
	} else if ($request === 'finishAll') {
		echo Functions::finishAll();
	} else if ($request === 'deleteAnnounce') {
		if (isset($_POST['newId']) and !empty($_POST['newId'])){
			echo Functions::deleteAnnounce(Functions::s($_POST['newId']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'startEvent') {
		if (isset($_POST['type']) and !empty($_POST['type'])){
			echo Functions::startEvent(Functions::s($_POST['type']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'searchUser') {
		if (isset($_POST['pilot']) and !empty($_POST['pilot'])){
			echo Functions::searchUser(Functions::s($_POST['pilot']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'searchINVI') {
		if (isset($_POST['pilot']) and !empty($_POST['pilot'])){
			echo Functions::searchINVI(Functions::s($_POST['pilot']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'saveDataUser') {
		echo Functions::saveDataUser(Functions::s($_POST['userId']), Functions::s($_POST['username']), Functions::s($_POST['pilotName']), Functions::s($_POST['uridium']), Functions::s($_POST['credits']), Functions::s($_POST['honor']), Functions::s($_POST['experience']), Functions::s($_POST['premium']));
	} else if ($request === 'sendItemsToUser') {
		echo Functions::sendItemsToUser(Functions::s($_POST['username']), Functions::s($_POST['uridium']), Functions::s($_POST['credits']), Functions::s($_POST['honor']), Functions::s($_POST['experience']), Functions::s($_POST['eventCoins']), Functions::s($_POST['design']));
	} else if ($request === 'refineVersionWeb') {
		if (isset($_POST['act']) and !empty($_POST['act'])){
			echo Functions::refineVersionWeb(Functions::s($_POST['act']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'upgradeVersionWeb') {
		if (isset($_POST['act']) and !empty($_POST['act']) && isset($_POST['ri']) && !empty($_POST['ri'])){
			echo Functions::upgradeVersionWeb(Functions::s($_POST['act']), Functions::s($_POST['ri']));
		} else {
			echo json_encode(array('message' => 'Error detected.', 'status' => false));
		}
	} else if ($request === 'installSecureAccount') {
		echo Functions::installSecureAccount();
	} else if ($request === 'verifyCodeSecureAccount') {
		if (isset($_POST['code']) and !empty($_POST['code'])){
			echo Functions::verifyCodeSecureAccount(Functions::s($_POST['code']));
		} else {
			echo json_encode(array('message' => 'Complete the form to continue.', 'status' => false));
		}
	} else if ($request === 'disableCodeSecureAccount') {
		if (isset($_POST['code']) and !empty($_POST['code'])){
			echo Functions::disableCodeSecureAccount(Functions::s($_POST['code']));
		} else {
			echo json_encode(array('message' => 'Complete the form to continue.', 'status' => false));
		}
	} else if ($request === 'checkQRCode') {
		if (isset($_POST['code']) and !empty($_POST['code'])){
			echo Functions::checkQRCode(Functions::s($_POST['code']));
		} else {
			echo json_encode(array('message' => 'Complete the form to continue.', 'status' => false));
		}
	} else if($request === "resetpw") {
		if (isset($_POST['uid']) and isset($_POST['hash']) and isset($_POST["password"]) and isset($_POST["passwordrp"])){
			if(!empty($_POST["password"]) and !empty($_POST["passwordrp"])) {
				if($_POST["password"] == $_POST["passwordrp"]) {
					echo Functions::ResetPwConfirm(Functions::s($_POST['uid']),Functions::s($_POST['hash']),Functions::s($_POST['password']));
				} else {
					echo "The passwords must be the same.".Functions::ResetPw(Functions::s($_POST["uid"]), Functions::s($_POST["hash"]));
				}
			} else {
				echo "Complete the form to continue.".Functions::ResetPw(Functions::s($_POST["uid"]), Functions::s($_POST["hash"]));
			}
		} else {
			echo "Complete the form to continue.";
		}
	} else {
	//require_once(EXTERNALS . 'error.php');
	http_response_code(403);
	die('Forbidden');
	return;
  }

} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($page[1])) {
	$request = $page[1];

	if ($request === 'verify') {
		if (isset($page[2], $page[3])) {
    	echo Functions::VerifyEmail(Functions::s($page[2]), Functions::s($page[3]));
		}
	} else if ($request === 'resetpw') {
		if (isset($page[2])) {
			echo Functions::ResetPw(Functions::s($page[2]), Functions::s($page[3]));
		}
	} else if ($request === 'logout') {
		Functions::Logout();
	} else if ($request === 'recover') {
		if (isset($page[2])){
			echo Functions::RecoverPwd(Functions::s($page[2]));
		}
	} else if ($request === 'getOnlines'){
		echo Socket::Get('OnlineCount', array('Return' => 0));
	} else if ($request === 'clan_cron'){
		echo Functions::executeTaxCron((isset($_SERVER['HTTP_CF_CONNECTING_IP'])) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR']);
	} else if ($request === 'discord_announce_cron'){
		echo Functions::CronDiscordAnnouncements((isset($_SERVER['HTTP_CF_CONNECTING_IP'])) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR']);
	} else if ($request === 'commandChat') {
		if (@$_GET['Key'] !== KeyToChat){
			http_response_code(403);
      		die('Forbidden');
		}
		echo Functions::commandChat($_GET['command'], ['UserId' => (isset($_GET['UserId'])) ? $_GET['UserId'] : 0, 'Key' => KeyToChat, 'Message' => (isset($_GET['Message'])) ? $_GET['Message'] : "", 'ShipId' => (isset($_GET['ShipId'])) ? $_GET['ShipId'] : 0, 'MapId' => (isset($_GET['MapId'])) ? $_GET['MapId'] : 0, 'Speed' => (isset($_GET['Speed'])) ? $_GET['Speed'] : 0, 'Damage' => (isset($_GET['Damage'])) ? $_GET['Damage'] : 0, 'Mod' => (isset($_GET['Mod'])) ? $_GET['Mod'] : "off", 'Seconds' => (isset($_GET['Seconds'])) ? $_GET['Seconds'] : 5, 'Reason' => (isset($_GET['Reason'])) ? $_GET['Reason'] : "", 'Hours' => (isset($_GET['Hours'])) ? $_GET['Hours'] : 0, 'TypeId' => (isset($_GET['TypeId'])) ? $_GET['TypeId'] : 0]);
	} else {
		//require_once(EXTERNALS . 'error.php');
		http_response_code(403);
      	die('Forbidden');
      	return;
	}

} else {
	//require_once(EXTERNALS . 'error.php');
	http_response_code(403);
	die('Forbidden');
	return;
}
?>
