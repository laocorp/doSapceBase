<?php 
require_once('../files/config.php');
$mysqli = Database::GetInstance();

$mysqli->begin_transaction();


try {

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && Functions::IsLoggedIn()) {
		$player = Functions::GetPlayer();
		$player = $mysqli->query("SELECT * FROM player_accounts WHERE userId = {$player['userId']}")->fetch_assoc();
		$equipment = $mysqli->query("SELECT * FROM player_equipment WHERE userId = {$player['userId']}")->fetch_assoc();
		$currentShip = $mysqli->query("SELECT * FROM server_ships WHERE shipID = {$player['shipId']}")->fetch_assoc();
		$notOnlineOrOnlineAndInEquipZone = !Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false)) || (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false)) && Socket::Get('IsInEquipZone', array('UserId' => $player['userId'], 'Return' => false)));
		
		$lf4unstableCount = json_decode($equipment['items'])->lf4unstableCount;
		$lf4spCount = json_decode($equipment['items'])->lf4spCount;
		$lf4hpCount = json_decode($equipment['items'])->lf4hpCount;
		$lf4pdCount = json_decode($equipment['items'])->lf4pdCount;
		$lf4mdCount = json_decode($equipment['items'])->lf4mdCount;
		$lf3nCount = json_decode($equipment['items'])->lf3nCount;
		$mp1Count = json_decode($equipment['items'])->mp1Count;
		$lf5Count = json_decode($equipment['items'])->lf5Count;
		$lf4Count = json_decode($equipment['items'])->lf4Count;
		$lf3Count = json_decode($equipment['items'])->lf3Count;
		$lf2Count = json_decode($equipment['items'])->lf2Count;
		$lf1Count = json_decode($equipment['items'])->lf1Count;

        $lf4unstablelvl = $equipment['lf4unstablelvl'];
		$lf4splvl = $equipment['lf4splvl'];
		$lf4hplvl = $equipment['lf4hplvl'];
		$lf4pdlvl = $equipment['lf4pdlvl'];
		$lf4mdlvl = $equipment['lf4mdlvl'];
		$lf3nlvl = $equipment['lf3nlvl'];
		$mp1lvl = $equipment['mp1lvl'];
		$lf5lvl = $equipment['lf5lvl'];
		$lf4lvl = $equipment['lf4lvl'];
		$lf3lvl = $equipment['lf3lvl'];
		$lf2lvl = $equipment['lf2lvl'];
		$lf1lvl = $equipment['lf1lvl'];
		

		$bo3Count = json_decode($equipment['items'])->bo3Count;
		$bo2Count = json_decode($equipment['items'])->bo2Count;
		$B01Count = json_decode($equipment['items'])->B01Count;
		$A03Count = json_decode($equipment['items'])->A03Count;
		$A02Count = json_decode($equipment['items'])->A02Count;
		$A01Count = json_decode($equipment['items'])->A01Count;
		
		$B03Shield = $equipment['B03lvl'];
		$B02Shield = $equipment['B02lvl'];
		$B01Shield = $equipment['B01lvl'];
		$A03Shield = $equipment['A03lvl'];
		$A02Shield = $equipment['A02lvl'];
		$A01Shield = $equipment['A01lvl'];

		$G3N1010 = json_decode($equipment['items'])->g3n1010Count;
		$G3N2010 = json_decode($equipment['items'])->g3n2010Count;
		$G3N3210= json_decode($equipment['items'])->g3n3210Count;
		$G3N3310 = json_decode($equipment['items'])->g3n3310Count;
		$G3N6900 = json_decode($equipment['items'])->g3n6900Count;
		$G3N7900 = json_decode($equipment['items'])->g3nCount;
		
		$spartanCount = json_decode($equipment['items'])->spartanCount;
		$cyborgCount = json_decode($equipment['items'])->cyborgCount;
		$havocCount = json_decode($equipment['items'])->havocCount;
		$herculesCount = json_decode($equipment['items'])->herculesCount;
		$apis = json_decode($equipment['items'])->apis;
		$zeus = json_decode($equipment['items'])->zeus;
		$irisCount = json_decode($equipment['items'])->iriscount;
		

		$items = [];
		
		$drones = [];
		$flax = [];
		
		
	
		$G3N_1010 = [];
		$G3N_2010 = [];
		$G3N_3210 = [];
		$G3N_3310 = [];
		$G3N_6900 = [];
		$G3N_7900 = [];
		
		
		$lf4unstables = [];
		$lf4sps = [];
		$lf4hps = [];
		$lf4pds = [];
		$lf4mds = [];
		$lf3ns = [];
		$mp1s = [];
		$lf5s = [];
		$lf4s = [];
		$lf3s = [];
		$lf2s = [];
		$lf1s = [];	
		$bo3s = [];
		$bo2s = [];
		$bo1s = [];
		$a03s = [];
		$a02s = [];
		$a01s = [];
		
		$havocs = [];
		$herculess = [];
		$spartans = [];
		$cyborgs = [];
		
		//$iris = 8;
		CreateDrone(2, 0, $irisCount); //iris
		if ($apis) { CreateDrone(3, 8, 1); } //Apis
		if ($zeus) { CreateDrone(4, $apis ? 9 : 8, 1); }//Zeus
 

		
		CreateItem(1, 100, $G3N7900,0); //g3n
		CreateItem(5, 120, $havocCount,0); //havoc
		CreateItem(6, 130, $herculesCount,0); //hercules
			
		CreateItem(8, 140, $lf4Count,$lf4lvl); //lf-4
		CreateItem(7, 0, $lf3Count,$lf3lvl); //lf-3
		CreateItem(9, 180, $lf2Count,$lf2lvl); //lf-2
		CreateItem(10, 220, $lf1Count,$lf1lvl); //lf-1
		CreateItem(11, 260, $lf5Count,$lf5lvl); //lf-5
		CreateItem(12, 300, $A01Count,$A01Shield); //Shield 01
		CreateItem(13, 340, $A02Count,$A02Shield); //Shield 02
		CreateItem(14, 380, $A03Count,$A03Shield); //Shield 03
		CreateItem(15, 420, $B01Count,$B01Shield); //Shield b01
		CreateItem(0, 40, $bo2Count,$B02Shield); //Shield b02
		CreateItem(16, 460, $bo3Count,$B03Shield); //Shield b03
		CreateItem(19, 500, $G3N1010,0); //G3N-1010
		CreateItem(20, 520, $G3N2010,0); //G3N-2010
		CreateItem(21, 540, $G3N3210,0); //G3N-3210
		CreateItem(22, 560, $G3N3310,0); //G3N-3310
		CreateItem(23, 580, $G3N6900,0); //G3N-6900
		CreateItem(24, 620, $lf4unstableCount,$lf4unstablelvl); //lf-4unstable
		CreateItem(25, 660, $lf4spCount,$lf4splvl); //lf-4sp
		CreateItem(26, 700, $lf4hpCount,$lf4hplvl); //lf-4hp
		CreateItem(27, 740, $lf4pdCount,$lf4pdlvl); //lf-4pd
		CreateItem(28, 780, $lf4mdCount,$lf4mdlvl); //lf-4md
		CreateItem(29, 820, $lf3nCount,$lf3nlvl); //lf-3n
		CreateItem(30, 860, $mp1Count,$mp1lvl); //mp-1
		CreateItem(31, 900, $cyborgCount,0); //cyborg
		CreateItem(32, 600, $spartanCount,0); //spartan
		
		$error = [
			0 => "You can't sell your stuff!",
			1 => "You can't sell your ship!",
			2 => "You can't sell your drones!",
			3 => "Equipping isn't possible. You must be at a location with a hangar facility!",
			4 => 'Something went wrong.',
			5 => 'You cannot change spaceships until the 5 second cool-down has been completed.'
		];

		if (!empty($_POST)) {
			if ($_POST['action'] == 'init') {
				if (!empty($_POST['params'])) {
					$decoded = base64_decode($_POST['params']);
					$json_array = json_decode($decoded, true);

					if ($json_array['nr'] == 1) {
						$json = '{
							"isError": 0,
							"data": {
							"ret": {
								"filters": {
								"weapons": [
									0,
									1,
									2
								],
								"generators": [
									3,
									4,
									5
								],
								"extras": [
									6,
									7,
									8,
									9,
									10,
									11
								],
								"ammunition":[
									12,
									13,
									14
								],
								"resources":[
									15
								],
								"drone_related": [
									16,
									17
								],
								"modules":[
									18
								],
								"pet_related":[
									19,
									20
								]
								},
								"hangars": [
								{
									"hangarID": "' . $player['userId'] . '",
									"name": "",
									"hangar_is_active": true,
									"hangar_is_selected": true,
									"general": {
									"ship": {
										"L": ' . $currentShip['id'] . ',
										"SM": "' . GetCurrentShipLootId() . '",
										"M": [
										' . GetDesignsLootIds() . '
										]
									},
									"drones": ' . json_encode($drones) . '
									},
									"config": {
									"1": {
										"ship": {
										"EQ": {
											"lasers": '.$equipment['config1_lasers'].',
											"rocketlauncher": '.$equipment['config1_rocketlauncher'].',
											"generators": '.$equipment['config1_generators'].',
											"cpus": '.$equipment['config1_cpus'].',
											"extras": [

											]
										}
										},
										"drones": {
										'.GetConfigDrones(1).'
										}
									},
									"2": {
										"ship": {
										"EQ": {
											"lasers": '.$equipment['config2_lasers'].',
											"rocketlauncher": '.$equipment['config2_rocketlauncher'].',
											"generators": '.$equipment['config2_generators'].',
											"cpus": '.$equipment['config2_cpus'].',
											"extras": [

											]
										}
										},
										"drones": {
										'.GetConfigDrones(2).'
										}
									}
									}
								}
								],
								"items": ' . json_encode($items) . ',
								"itemInfo": [
									{
										"L": 0,
										"name": "SG3N-BO2",
										"T": 4,
										"C": "generator",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 1,
										"name": "G3N-7900",
										"T": 3,
										"C": "generator",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 2,
										"name": "Iris",
										"T": 24,
										"C": "drone",
										"repair": 500,
										"currency": "uridium",
										"levels": [
										' . GetDroneLevelsInformation() . '
										]
									},
									{
										"L": 3,
										"name": "Apis",
										"T": 24,
										"C": "drone",
										"repair": 500,
										"currency": "uridium",
										"levels": [
										' . GetDroneLevelsInformation() . '
										]
									},
									{
										"L": 4,
										"name": "Zeus",
										"T": 24,
										"C": "drone",
										"repair": 500,
										"currency": "uridium",
										"levels": [
										' . GetDroneLevelsInformation() . '
										]
									},
									{
										"L": 5,
										"name": "Havoc",
										"T": 16,
										"C": "ship",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 6,
										"name": "Hercules",
										"T": 16,
										"C": "ship",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 7,
										"name": "LF-3",
										"T": 0,
										"C": "laser",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 8,
										"name": "LF-4",
										"T": 0,
										"C": "laser",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 9,
										"name": "LF-2",
										"T": 0,
										"C": "laser",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 10,
										"name": "LF-1",
										"T": 0,
										"C": "laser",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 11,
										"name": "Prometeus",
										"T": 0,
										"C": "laser",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 12,
										"name": "SG3N-A01A",
										"T": 4,
										"C": "generator",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 13,
										"name": "SG3N-A02A",
										"T": 4,
										"C": "generator",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 14,
										"name": "SG3N-A03A",
										"T": 4,
										"C": "generator",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 15,
										"name": "SG3N-B01",
										"T": 4,
										"C": "generator",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 16,
										"name": "SG3N-B03",
										"T": 4,
										"C": "generator",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 17,
										"name": "Flax",
										"T": 24,
										"C": "drone",
										"repair": 500,
										"currency": "uridium",
										"levels": [
										' . GetDroneLevelsInformation() . '
										]
									},
									{
										"L": 18,
										"name": "Spartan",
										"T": 24,
										"C": "drone",
										"repair": 500,
										"currency": "uridium",
										"levels": [
										' . GetDroneLevelsInformation() . '
										]
									},
									{
										"L": 19,
										"name": "G3N-1010",
										"T": 3,
										"C": "generator",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},	
									{
										"L": 20,
										"name": "G3N-2010",
										"T": 3,
										"C": "generator",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 21,
										"name": "G3N-3210",
										"T": 3,
										"C": "generator",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 22,
										"name": "G3N-3310",
										"T": 3,
										"C": "generator",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
										{
										"L": 23,
										"name": "G3N-6900",
										"T": 3,
										"C": "generator",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 24,
										"name": "Unstable LF-4",
										"T": 0,
										"C": "laser",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 25,
										"name": "LF-4-SP",
										"T": 0,
										"C": "laser",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 26,
										"name": "LF-4-HP",
										"T": 0,
										"C": "laser",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 27,
										"name": "LF-4-PD",
										"T": 0,
										"C": "laser",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 28,
										"name": "LF-4-MD",
										"T": 0,
										"C": "laser",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 29,
										"name": "LF-3-Neutron",
										"T": 0,
										"C": "laser",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 30,
										"name": "MP-1",
										"T": 0,
										"C": "laser",
										"levels": [
											' . GetCurrentItemLevelsInformation() . '
										]
									},
									{
										"L": 31,
										"name": "cyborg",
										"T": 16,
										"C": "drone",
										"repair": 500,
										"currency": "uridium",
										"levels": [
										' . GetDroneLevelsInformation() . '
										]									
									},
									{
										"L": 32,
										"name": "spartan",
										"T": 16,
										"C": "drone",
										"repair": 500,
										"currency": "uridium",
										"levels": [
										' . GetDroneLevelsInformation() . '
										]
									},
									' . GetAllShipInformations() . '
								],
								"userInfo": {
								"factionRelated": "mmo"
								}
							},
							"money": {
								"uridium": "0",
								"credits": "0"
							},
							"map": {
								"types": [
								"Weapon_LaserType",
								"Weapon_HellstormLauncherType",
								"Weapon_WeaponType",
								"Generator_EngineType",
								"Generator_ShieldType",
								"Generator_GeneratorType",
								"Extra_BoosterType",
								"Extra_Cpu_CPUType",
								"Extra_ModuleType",
								"Extra_RobotType",
								"Extra_UpgradeType",
								"Extra_ExtraType",
								"Weapon_Ammo_LaserType",
								"Weapon_Ammo_RocketType",
								"Weapon_Ammo_AmmunitionType",
								"Resource_OreType",
								"Drone_Design_DroneDesignType",
								"Drone_Formation_DroneFormationType",
								"Module_StationModuleType",
								"Pet_PetGearType",
								"Pet_AIProtocolType",
								"Ship_ShipType",
								"Item_ItemType"
								],
								"lootIds": [
								"equipment_generator_shield_sg3n-b02",
								"equipment_generator_speed_g3n-7900",
								"drone_iris",
								"drone_apis",
								"drone_zeus",
								"drone_designs_havoc",
								"drone_designs_hercules",
								"equipment_weapon_laser_lf-3",
								"equipment_weapon_laser_lf-4",
								"equipment_weapon_laser_lf-2",
								"equipment_weapon_laser_lf-1",
								"equipment_weapon_laser_pr-l",
								"equipment_generator_shield_sg3n-a01",
								"equipment_generator_shield_sg3n-a02",
								"equipment_generator_shield_sg3n-a03",
								"equipment_generator_shield_sg3n-b01",
								"equipment_generator_shield_sg3n-b03",
								"drone_flax",
								"drone_designs_reaper-blue",
								"equipment_generator_speed_g3n-1010",
								"equipment_generator_speed_g3n-2010",
								"equipment_generator_speed_g3n-3210",
								"equipment_generator_speed_g3n-3310",
								"equipment_generator_speed_g3n-6900",
								"equipment_weapon_laser_lf-4-unstable",
								"equipment_weapon_laser_lf-4-sp",
								"equipment_weapon_laser_lf-4-hp",
								"equipment_weapon_laser_lf-4-pd",
								"equipment_weapon_laser_lf-4-md",
								"equipment_weapon_laser_lf-3-n",
								"equipment_weapon_laser_mp-1",
								"drone_designs_cyborg",								
								
								"drone_designs_spartan",
								"drone_designs_spartan",
								"drone_designs_spartan",
								"drone_designs_spartan",
								"drone_designs_spartan",
								"drone_designs_spartan",
								"drone_designs_spartan",
								"drone_designs_spartan",
								"drone_designs_spartan",
								"drone_designs_spartan",
								"drone_designs_spartan",
								"drone_designs_spartan",
								"drone_designs_spartan",
								"drone_designs_spartan",
								"drone_designs_spartan",																															
								' . GetAllShipLootIds() . '
								]
							}
							}
						}';
 
 
 
						$json = preg_replace('/(\v|\s)+/', '', $json);
						echo base64_encode($json);
					}
				}
			} else if ($_POST['action'] == 'sell') {
				SendError($error[0]);
			} else if ($_POST['action'] == 'sellShip') {
				SendError($error[1]);
			} else if ($_POST['action'] == 'sellDrone') {
				SendError($error[2]);
			} else if ($_POST['action'] == 'changeShipModel') {
				$decoded = base64_decode($_POST['params']);
				$json_array = json_decode($decoded, true);

				switch ($json_array['lootId']) {
					case 'ship_aegis-mmo':
					case 'ship_aegis-eic':
					case 'ship_aegis-vru':
						$json_array['lootId'] = 'ship_aegis';
						break;
					case 'ship_citadel-mmo':
					case 'ship_citadel-eic':
					case 'ship_citadel-vru':
						$json_array['lootId'] = 'ship_citadel';
						break;
					case 'ship_spearhead-mmo':
					case 'ship_spearhead-eic':
					case 'ship_spearhead-vru':
						$json_array['lootId'] = 'ship_spearhead';
						break;
				}

				$ship = $mysqli->query('SELECT * FROM server_ships WHERE lootID = "' . $json_array['lootId'] . '"')->fetch_assoc();

				if ($ship['baseShipId'] == $currentShip['baseShipId']) {
					if ($notOnlineOrOnlineAndInEquipZone) {
						if (!Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false)) || (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false)) && Socket::Get('AvailableToChangeShip', array('UserId' => $player['userId'], 'Return' => false)))) {
							$mysqli->query('UPDATE player_accounts SET shipId = ' . $ship['shipID'] . ' WHERE userID = ' . $player['userId'] . '');

							echo base64_encode('{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}');

							if (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
								Socket::Send('UpdateStatus', array('UserId' => $player['userId']));
								Socket::Send('ChangeShip', array('UserId' => $player['userId'], 'ShipId' => $ship['shipID']));
							}
						} else {
							SendError($error[5]);
						}
					} else {
						SendError($error[3]);
					}
				} else {
					SendError($error[4]);
				}
			} else if ($_POST['action'] == 'clearConfig') {
				if ($notOnlineOrOnlineAndInEquipZone) {
					$decoded = base64_decode($_POST['params']);
					$json_array = json_decode($decoded, true);

					$drones = '[{"items":[],"designs":[]},{"items":[],"designs":[]}]';
					$mysqli->query("UPDATE player_equipment SET config" . $json_array['configID'] . "_lasers = '[]', config" . $json_array['configID'] . "_generators = '[]', config" . $json_array['configID'] . "_drones = '" . $drones . "' WHERE userId = " . $player['userId'] . "");
					$mysqli->query("UPDATE player_equipment SET config1_drones = '". $drones . "', config2_drones = '". $drones . "' WHERE userId = " . $player['userId'] . "");

					if (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
						Socket::Send('UpdateStatus', array('UserId' => $player['userId']));
					}

					echo base64_encode('{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}');
				} else {
					SendError($error[3]);
				}
			} else if ($_POST['action'] == "droneEquip") {
				if ($notOnlineOrOnlineAndInEquipZone) {
					$data = '{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}';
					$decoded = base64_decode($_POST['params']);
					$json_array = json_decode($decoded, true);

					$toType = 'config' . $json_array['to']['configId'] . '_drones';
					$array = json_decode($mysqli->query('SELECT ' . $toType . ' FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()[$toType]);
					$max_item = 2;

					if (count($array[0]->items) >= $max_item || count($array[count($array) - 1]->items) >= $max_item) {
						for ($i = 0; $i <= count($array) - 1; $i++) {
							if (isset($json_array['from']['droneItems'][$i])) {
								if (count($json_array['from']['droneItems']["$i"]) == $max_item) {
									$array[$i]->items[0] = $json_array['from']['droneItems']["$i"][0];
									$array[$i]->items[1] = $json_array['from']['droneItems']["$i"][1];
								} else if (count($json_array['from']['droneItems']["$i"]) == 1) {
									if (in_array($json_array['from']['droneItems']["$i"][0], $havocs) || in_array($json_array['from']['droneItems']["$i"][0], $herculess) || in_array($json_array['from']['droneItems']["$i"][0], $cyborgs)|| in_array($json_array['from']['droneItems']["$i"][0], $spartans)) {
										$array[$i]->designs[0] = $json_array['from']['droneItems']["$i"][0];
									} else {
										$array[$i]->items[(isset($array[$i]->items[0]) ? 1 : 0)] = $json_array['from']['droneItems']["$i"][0];
									}
								}
							}
						}
					} else {
						foreach ($json_array['from']['droneItems'] as $key => $item) {
							foreach ($item as $slots) {
								if (in_array($slots, $havocs) || in_array($slots, $herculess) || in_array($slots, $cyborgs) || in_array($slots, $spartans)) {
									$i = 0;
									if ($i < 1) {
										$array[$key]->designs[] = $slots;
										$i++;
									}
								} else {
									$i = 0;
									if ($i < $max_item) {
										$array[$key]->items[] = $slots;
										$i++;
									}
								}
							}
						}
					}

					$array = array_values($array);
					$json = json_encode($array, JSON_UNESCAPED_UNICODE);
					$mysqli->query("UPDATE player_equipment SET " . $toType . " = '" . $json . "' WHERE userId = " . $player['userId'] . "");

					echo base64_encode($data);

					if (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
						Socket::Send('UpdateStatus', array('UserId' => $player['userId']));
					}
				} else {
					SendError($error[3]);
				}
			} else if ($_POST['action'] == 'move') {
				if ($notOnlineOrOnlineAndInEquipZone) {
					$ret = '';
					$data = '{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}';
					$decoded = base64_decode($_POST['params']);
					$json_array = json_decode($decoded, true);
					$itemsCount = array_keys($json_array['from']['items']);
					$last_key = end($itemsCount);
					if ($json_array['from']['target'] == 'inventory' && $json_array['to']['target'] == 'inventory') {
						foreach ($json_array['from']['items'] as $key => $item) {
							$ret .= '"' . $item . '"' . ($key != $last_key ? "," : "");
							$data = '{"isError":0,"data":{"ret":[' . $ret . '],"money":{"uridium":"0","credits":"0"}}}';
						}
					}

					if ($json_array['from']['target'] == 'ship' && $json_array['to']['target'] == 'inventory') {
						$toType = 'config' . $json_array['to']['configId'] . '_' . $json_array['from']['slotset'] . '';
						$array = json_decode($mysqli->query('SELECT ' . $toType . ' FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()[$toType]);

						foreach ($json_array['from']['items'] as $key => $item) {
							$index = array_search($item, $array);
							if (in_array($item, $array)) {
								unset($array[$index]);
							}
						}

						$array = array_values($array);
						$json = json_encode($array, JSON_UNESCAPED_UNICODE);
						$mysqli->query("UPDATE player_equipment SET " . $toType . " = '" . $json . "' WHERE userId = " . $player['userId'] . "");
						$data = '{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}';
					}

					if ($json_array['from']['target'] == 'inventory' && $json_array['to']['target'] == 'ship' && substr($json_array['to']['slotset'], 0, -1) != null) {

						$toType = 'config' . $json_array['to']['configId'] . '_' . $json_array['to']['slotset'] . '';
						$array = json_decode($mysqli->query('SELECT ' . $toType . ' FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()[$toType]);
						$i = count($array);
						$max_item = $currentShip[$json_array['to']['slotset']];

						foreach ($json_array['from']['items'] as $key => $item) {
							if ($i == $max_item) {
								$ret .= '"' . $item . '"' . ($key != $last_key ? "," : "");
								$data = '{"isError":0,"data":{"ret":[' . $ret . '],"money":{"uridium":"0","credits":"0"}}}';
							}

							if ($i < $max_item) {
								if (($json_array['to']['slotset'] == 'lasers' && (in_array($item, $lf3s) || in_array($item, $lf4s) || in_array($item, $lf4sps) || in_array($item, $lf4unstables) || in_array($item, $lf4hps) || in_array($item, $lf4pds) || in_array($item, $lf4mds) || in_array($item, $mp1s) || in_array($item, $lf3ns) || in_array($item, $lf2s)|| in_array($item, $lf1s)|| in_array($item, $lf5s))) ||
									$json_array['to']['slotset'] == 'generators' && (in_array($item, $bo2s) || in_array($item, $bo3s) || in_array($item, $bo1s) || in_array($item, $a03s) || in_array($item, $a02s) || in_array($item, $a01s) || in_array($item, $G3N_6900) || in_array($item, $G3N_3310) || in_array($item, $G3N_3210) || in_array($item, $G3N_2010) || in_array($item, $G3N_7900))
								) {
									array_push($array, $item);
								}

								$data = '{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}';
								$i++;
							}
						}

						$array = array_values($array);
						$json = json_encode($array);
						$mysqli->query("UPDATE player_equipment SET " . $toType . " = '" . $json . "' WHERE userId = " . $player['userId'] . "");
					}

					if ($json_array['from']['target'] == 'drone' && $json_array['to']['target'] == 'inventory') {
						$toType = 'config' . $json_array['to']['configId'] . '_drones';
						$array = json_decode($mysqli->query('SELECT ' . $toType . ' FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()[$toType]);

						foreach ($json_array['from']['items'] as $key => $item) {
							if (in_array($item, $havocs) || in_array($item, $herculess) || in_array($item, $cyborgs) || in_array($item, $spartans)) {
								$index = array_search($item, $array[$json_array['from']['droneId']]->designs);
								if (in_array($item, $array[$json_array['from']['droneId']]->designs)) {
									array_splice($array[$json_array['from']['droneId']]->designs, $index, 1);
								}
							} else {
								$index = array_search($item, $array[$json_array['from']['droneId']]->items);
								if (in_array($item, $array[$json_array['from']['droneId']]->items)) {
									array_splice($array[$json_array['from']['droneId']]->items, $index, 1);
								}
							}
						}

						$array = array_values($array);
						$json = json_encode($array, JSON_UNESCAPED_UNICODE);
						$mysqli->query("UPDATE player_equipment SET " . $toType . " = '" . $json . "' WHERE userId = " . $player['userId'] . "");
						$data = '{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}';
					}

					if ($json_array['from']['target'] == 'inventory' && $json_array['to']['target'] == 'drone' && substr($json_array['to']['slotset'], 0, -1) != null) {

						$toType = 'config' . $json_array['to']['configId'] . '_drones';

						$array = json_decode($mysqli->query('SELECT ' . $toType . ' FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()[$toType]);
						$i = count($array[$json_array['to']['droneId']]->items);

						$i2 = count($array[$json_array['to']['droneId']]->designs);

						$max_item = 2;

						$max_drone_designs = 1;

						foreach ($json_array['from']['items'] as $key => $item) {
							if (in_array($item, $havocs) || in_array($item, $herculess) || in_array($item, $cyborgs) || in_array($item, $spartans)) {
								if ($i2 == $max_item) {
									$ret .= '"' . $item . '"' . ($key != $last_key ? "," : "");
									$data = '{"isError":0,"data":{"ret":[' . $ret . '],"money":{"uridium":"0","credits":"0"}}}';
								}
								if ($i2 < $max_drone_designs) {

									switch ($json_array['to']['configId']) {
										case 1:
											$config1_drones = json_decode($equipment['config1_drones']);

											$count_sameHavoc = 0;

											foreach ($config1_drones as $drone1) {
												$havocInformation = $drone1->designs;

												if (in_array($item, $havocInformation)) {
													$count_sameHavoc++;
												}
											}

											if ($count_sameHavoc >= 1) {
												$ret .= '"' . $item . '"' . ($key != $last_key ? "," : "");
												$data = '{"isError":0,"data":{"ret":[' . $ret . '],"money":{"uridium":"0","credits":"0"}}}';
											} else {
												array_push($array[$json_array['to']['droneId']]->designs, $item);
												$data = '{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}';
												$i2++;
											}
											break;
										case 2:
											$config2_drones = json_decode($equipment['config2_drones']);

											$count_sameHavoc = 0;

											foreach ($config2_drones as $drone1) {
												$havocInformation = $drone1->designs;

												if (in_array($item, $havocInformation)) {
													$count_sameHavoc++;
												}
											}

											if ($count_sameHavoc >= 1) {
												$ret .= '"' . $item . '"' . ($key != $last_key ? "," : "");
												$data = '{"isError":0,"data":{"ret":[' . $ret . '],"money":{"uridium":"0","credits":"0"}}}';
											} else {
												array_push($array[$json_array['to']['droneId']]->designs, $item);
												$data = '{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}';
												$i2++;
											}
											break;
									}
								}
							} else {
								if ($i == $max_item) {
									$ret .= '"' . $item . '"' . ($key != $last_key ? "," : "");
									$data = '{"isError":0,"data":{"ret":[' . $ret . '],"money":{"uridium":"0","credits":"0"}}}';
								}

								if ($i < $max_item) {
									array_push($array[$json_array['to']['droneId']]->items, $item);
									$data = '{"isError":0,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}}}';
									$i++;
								}
							}
						}

						$array = array_values($array);
						$json = json_encode($array, JSON_UNESCAPED_UNICODE);
						$mysqli->query("UPDATE player_equipment SET " . $toType . " = '" . $json . "' WHERE userId = " . $player['userId'] . "");
					}

					echo base64_encode($data);

					if (Socket::Get('IsOnline', array('UserId' => $player['userId'], 'Return' => false))) {
						Socket::Send('UpdateStatus', array('UserId' => $player['userId']));
					}
				} else {
					SendError($error[3]);
				}
			} else {
				SendError($error[3]);
			}
		} else {
			SendError($error[3]);
		}
	} else {
		require(EXTERNALS . 'error.php');
	}

	$mysqli->commit();
} catch (Exception $e) {
	$json['message'] = 'An error occurred. Please try again later.';
	$mysqli->rollback();
}

$mysqli->close();

function SendError($errorMessage)
{
	echo base64_encode('{"isError":1,"data":{"ret":1,"money":{"uridium":"0","credits":"0"}},"error":{"message":"' . $errorMessage . '"}}');
}

function GetCurrentItemLevelsInformation()
{
	return '
	{
		"selling": {
		"credits": 0
		},
		"cdn": {
		"30x30": "ea805e03b2d3fa173b723f1f846bc900",
		"63x63": "768dea8b4af9ee7381b707cc63f3ac00",
		"100x100": "6f332bdc590ad65c8095d1c303cebf00"
		}
	}';
}

function GetDroneLevelsInformation($amount = 8)
{
	$json = '';
	for ($i = 0; $i <= $amount; $i++) {
		$json .= '{
							  "slotsets": {
								"default": {
								  "T": [
									0,
									4,
									11,
									9,
									7,
									8,
									10
								  ],
								  "Q": 2
								},
								"design": {
								  "T": [
										16
								  ],
								  "Q": 1
								}
							  },
							  "selling": {
								"credits": 0
							  },
							  "cdn": {
								"30x30": "40860d1594e9b6841ccfa87963f8d800",
								"63x63": "0cd363e0f68297796aeb1a1dc8725500",
								"100x100": "915c51fde19ca5d0c4878221ae305f00",
								"top": "b6aae2912b6e0eb1b49d50ab5caef400"
							  }
							}' . ($i != $amount ? "," : "");
	}
	return $json;
}

function CreateItem($item_id, $fromId, $amount, $lvl)
{
	global $items, $drones, $bo2s, $G3N_7900, $lf3s, $lf4s, $lf4unstables, $lf4sps, $lf4hps, $lf4mds, $lf4pds, $mp1s, $lf3ns, $havocs, $herculess, $lf2s, $lf1s, $lf5s, $a01s, $a02s, $a03s, $bo1s, $bo3s, $G3N_1010, $G3N_2010, $G3N_3210, $G3N_3310, $G3N_6900, $cyborgs, $spartans;

	if($lvl == 0){ $lvl = 0;}
	if($amount == 0)
	{
		return;
	}
	else
	{
		if ($item_id >= 0 || $item_id >= 99 || $item_id == 99) {
			$amount = $fromId + $amount;
		} else {
			$amount = count($items) + $amount;
		}

		for($i = $fromId; $i < $amount; $i++) {

			$item = array("I" => $i, "LV" => $lvl, "L" => $item_id, "S" => $i);
			array_push($items, $item);

			switch ($item_id) {
				case 0:
					$bo2s[] = $i;
					break;
				case 1:
					$G3N_7900[] = $i;
					break;
				case 5:
					$havocs[] = $i;
					break;
				case 6:
					$herculess[] = $i;
					break;
				case 7:
					$lf3s[] = $i;
					break;
				case 8:
					$lf4s[] = $i;
					break;
				case 9:
					$lf2s[] = $i;
					break;
				case 10:
					$lf1s[] = $i;
					break;
				case 11:
					$lf5s[] = $i;
					break;
				case 12:
					$a01s[] = $i;
					break;
				case 13:
					$a02s[] = $i;
					break;
				case 14:
					$a03s[] = $i;
					break;
				case 15:
					$bo1s[] = $i;
					break;
				case 16:
					$bo3s[] = $i;
					break;
				case 19:
					$G3N_1010[] = $i;
					break;
				case 20:
					$G3N_2010[] = $i;
					break;
				case 21:
					$G3N_3210[] = $i;
					break;
				case 22:
					$G3N_3310[] = $i;
					break;
				case 23:
					$G3N_6900[] = $i;
					break;
				case 24:
					$lf4unstables[] = $i;
					break;
				case 25:
					$lf4sps[] = $i;
					break;
				case 26:
					$lf4hps[] = $i;
					break;
				case 27:
					$lf4pds[] = $i;
					break;
				case 28:
					$lf4mds[] = $i;
					break;
				case 29:
					$lf3ns[] = $i;
					break;
				case 30:
					$mp1s[] = $i;
					break;
				case 31:
					$cyborgs[] = $i;
					break;			
				case 32:
					$spartans[] = $i;
					break;
			}
		}
	}
}


		
		
function CreateDrone($item_id, $fromId, $amount)
{
  global $drones, $droneExp;

  $amount = count($drones) + $amount;
  for($i = $fromId; $i < $amount; $i++) {

	  $droneLevel=0;
	  if ($droneExp >= 500)

		$droneLevel = 1;
		if ($droneExp >= 1000)
			$droneLevel = 2;
		if ($droneExp >= 1500)
			$droneLevel = 3;
		if ($droneExp >= 2000)
			$droneLevel = 4;
		if ($droneExp >= 2500)
			$droneLevel = 5;

		$needExp=500;

		if($droneExp>=500)
			$needExp=1000;
			if($droneExp>=1000)
			$needExp=1500;
			if($droneExp>=1500)
			$needExp=2000;
			if($droneExp>=2000)
			$needExp=2500;
			if($droneExp>=2500)
			$needExp=0;
			
	$exp= $droneExp.'/'.($needExp);

	$drone = ["I" => $i, "L" => $item_id, "LV" => $droneLevel, "HP" => $droneLevel+1,
		"EF" => $exp, "SP" => 15625, "DE" => "", "DL" => null, "SL" => 0, "repair" => 500, "currency" => "uridium"];

	array_push($drones, $drone);
  }
}


function GetDesignsLootIds()
{
	global $mysqli, $equipment, $currentShip;
	$ships = [$mysqli->query('SELECT lootID FROM server_ships WHERE shipID = ' . $currentShip['baseShipId'] . '')->fetch_assoc()['lootID']];
	$currentDesigns = [];
	$player = Functions::GetPlayer();
	$designs = $mysqli->query("SELECT * FROM player_designs WHERE userId = {$player['userId']} AND baseShipId = '".$currentShip['baseShipId']."'");
	$vecDesign = [];
	while ($row = $designs->fetch_assoc()) {
		array_push($vecDesign, $row['name']);
	}
	$ships = array_merge($ships, $vecDesign, $currentDesigns);
	$designs = json_decode($equipment['items'])->designs;
	if (property_exists($designs, $currentShip['baseShipId'])) {
		foreach ($designs->{$currentShip['baseShipId']} as $ship) {
			$lootId = $mysqli->query('SELECT lootID FROM server_ships WHERE shipID = ' . $ship . '')->fetch_assoc()['lootID'];
			array_push($ships, $lootId);
		}
	}
	return str_replace(str_split('[]'), '', json_encode($ships));
}

function GetConfigDrones($configId)
{
	global $mysqli, $apis, $zeus, $player;

	$drones = '';
	$target = 'config' . $configId . '_drones';
	$array = json_decode($mysqli->query('SELECT ' . $target . ' FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc()[$target]);
	if (!$apis) array_pop($array);
	if (!$zeus) array_pop($array);

	foreach ($array as $key => $item) {
		$drones .= '"' . $key . '": {
											"EQ": {
												"default": ' . json_encode($item->items) . ',
												"design": ' . json_encode($item->designs) . '
											}
										}' . ($key != count($array) - 1 ? "," : "");
	}

	return $drones;
}

function GetCurrentShipLootId()
{
	global $mysqli, $player;

	$lootId = $mysqli->query('SELECT lootID FROM server_ships WHERE shipID = ' . $player['shipId'] . '')->fetch_assoc()['lootID'];

	if ($lootId == 'ship_aegis' || $lootId == 'ship_citadel' || $lootId == 'ship_spearhead') {
		$lootId .= '-';
		$lootId .= $player['factionId'] == 1 ? 'mmo' : ($player['factionId'] == 2 ? 'eic' : 'vru');
	}

	return $lootId;
}

function GetAllShipInformations()
{
	global $mysqli;

	$ships = '';

	$array = $mysqli->query('SELECT id, shipID FROM server_ships')->fetch_all(MYSQLI_ASSOC);
	foreach ($array as $key => $ship) {
		$ships .= GetShipInformation($ship['id'], $ship['shipID']) . ($key != count($array) - 1 ? ',' : '');
	}

	return $ships;
}

function GetAllShipLootIds()
{
	global $mysqli;

	$lootIds = '';

	$array = $mysqli->query('SELECT lootID FROM server_ships')->fetch_all(MYSQLI_ASSOC);
	foreach ($array as $key => $ship) {
		$lootIds .= '"' . $ship['lootID'] . '"' . ($key != count($array) - 1 ? ',' : '');
	}

	return $lootIds;
}

function GetShipInformation($itemId, $shipId) {
	global $mysqli;

	$informations = $mysqli->query('SELECT * FROM server_ships WHERE shipID = '.$shipId.'')->fetch_assoc();

	return json_encode([
		'L' => $itemId,
		'name' => $informations['name'],
		'T' => 22,
		'C' => 'ship',
		'levels' => [
			[
				'slotsets' => [
					'lasers' => [
						'T' => [0],
						'Q' => $informations['lasers']
					],
					'generators' => [
						'T' => [3, 4],
						'Q' => $informations['generators']
					],
					'heavy_guns' => [
						'T' => [1],
						'Q' => 1
					],
					'extras' => [
						'T' => [6, 7, 8, 10, 11],
						'Q' => 3
					]
				]
			],
			[
				'selling' => [
					'credits' => 0
				]
			],
			[
				'cdn' => [
					'63x63' => 'c6c8a09a4749af691b6a9947cf2c6900',
					'100x100' => '5fcdb83e69b401d92cc1ae6abb172300',
					'top' => ''
				]
			]
		]
	]);
}
?>