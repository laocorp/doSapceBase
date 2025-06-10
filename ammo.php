<?php
ini_set("display_errors", true);
include 'files/config.php';

$tableToUpdate = "player_accounts"; // Tabla a updatear.

$db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);

if ($db->connect_errno){
    die('Error al conectar con el servidor mysql. Tipo de error: '.$db->connect_error);
}

$ammo = $db->query("SELECT * FROM $tableToUpdate");

if ($ammo){

    while($ammoItems = $ammo->fetch_assoc()){

        $itemsData = json_decode($ammoItems['ammo']);
        $lcb10 = false;
		$mcb25 = false;
		$mcb50 = false;
		$ucb = false;
		$rsb = false;
		$sab = false;


        if ($itemsData->lcb10 > 0){
            $lcb10 = $itemsData->lcb10;
            $itemsData->lcb10 = 99999999;
            $lcb10 = true;
            echo "<p>[idUser: ".$ammoItems['userId']."] lcb10 changed from <b>".($lcb10 ? $lcb10 : 0)."</b> to <b>".($itemsData->lcb10 ? $itemsData->lcb10 : 0)."</b></p>";
        }
		
		if ($itemsData->mcb25 > 0){
            $mcb25 = $itemsData->mcb25;
            $itemsData->mcb25 = 99999999;
            $mcb25 = true;
            echo "<p>[idUser: ".$ammoItems['userId']."] mcb25 changed from <b>".($mcb25 ? $mcb25 : 0)."</b> to <b>".($itemsData->mcb25 ? $itemsData->mcb25 : 0)."</b></p>";
        }
		
		if ($itemsData->mcb50 > 0){
            $mcb50 = $itemsData->mcb50;
            $itemsData->mcb50 = 99999999;
            $mcb50 = true;
            echo "<p>[idUser: ".$ammoItems['userId']."] mcb50 changed from <b>".($mcb50 ? $mcb50 : 0)."</b> to <b>".($itemsData->mcb50 ? $itemsData->mcb50 : 0)."</b></p>";
        }
		
		if ($itemsData->ucb > 0){
            $ucb = $itemsData->ucb;
            $itemsData->ucb = 99999999;
            $ucb = true;
            echo "<p>[idUser: ".$ammoItems['userId']."] ucb changed from <b>".($ucb ? $ucb : 0)."</b> to <b>".($itemsData->ucb ? $itemsData->ucb : 0)."</b></p>";
        }
		
		if ($itemsData->rsb > 0){
            $rsb = $itemsData->rsb;
            $itemsData->rsb = 99999999;
            $rsb = true;
            echo "<p>[idUser: ".$ammoItems['userId']."] rsb changed from <b>".($rsb ? $rsb : 0)."</b> to <b>".($itemsData->rsb ? $itemsData->rsb : 0)."</b></p>";
        }
		
		if ($itemsData->sab > 0){
            $sab = $itemsData->sab;
            $itemsData->sab = 99999999;
            $sab = true;
            echo "<p>[idUser: ".$ammoItems['userId']."] sab changed from <b>".($sab ? $sab : 0)."</b> to <b>".($itemsData->sab ? $itemsData->sab : 0)."</b></p>";
        }




        if ($lcb10 || $mcb25 || $mcb50 || $ucb || $rsb || $sab){
            // Updateamos la base de datos.
            $q = "UPDATE $tableToUpdate SET ammo = '".json_encode($itemsData)."' WHERE userId = '".$ammoItems['userId']."'";
            echo "<p><b>[idUser: ".$ammoItems['userId']."] Query: ".$q."</b></p>";
            $db->query($q);
        } else {
            echo "<p>[idUser: ".$ammoItems['userId']."] Nada que updatear.</p>";
        }

    }

}

?>