<?php require_once(INCLUDES . 'header.php'); ?>
<script src="https://kit.fontawesome.com/4f90b43f8c.js" crossorigin="anonymous" type="text/javascript"></script>
<link rel="stylesheet" href="/css/auction.css" />
<?php require_once(INCLUDES . 'data.php'); ?>

<?php
$winlf4 = ($mysqli->query('SELECT bid_pilotname FROM bid_system WHERE bid_id = 1')->fetch_assoc()['bid_pilotname']);
$winlf4_lf4_2 = ($mysqli->query('SELECT bid_pilotname FROM bid_system WHERE bid_id = 6')->fetch_assoc()['bid_pilotname']);
$winlf4_lf4_3 = ($mysqli->query('SELECT bid_pilotname FROM bid_system WHERE bid_id = 7')->fetch_assoc()['bid_pilotname']);
$winlf4_lf4_4 = ($mysqli->query('SELECT bid_pilotname FROM bid_system WHERE bid_id = 8')->fetch_assoc()['bid_pilotname']);
$winhercul = ($mysqli->query('SELECT bid_pilotname FROM bid_system WHERE bid_id = 2')->fetch_assoc()['bid_pilotname']);
$winhavoc = ($mysqli->query('SELECT bid_pilotname FROM bid_system WHERE bid_id = 3')->fetch_assoc()['bid_pilotname']);
$winapis = ($mysqli->query('SELECT bid_pilotname FROM bid_system WHERE bid_id = 4')->fetch_assoc()['bid_pilotname']);
$winzeus = ($mysqli->query('SELECT bid_pilotname FROM bid_system WHERE bid_id = 5')->fetch_assoc()['bid_pilotname']);

$winlf4_bid = ($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = 1')->fetch_assoc()['bid_credit']);
$winlf4_lf4_2_bid = ($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = 6')->fetch_assoc()['bid_credit']);
$winlf4_lf4_3_bid = ($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = 7')->fetch_assoc()['bid_credit']);
$winlf4_lf4_4_bid = ($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = 8')->fetch_assoc()['bid_credit']);
$winhercul_bid = ($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = 2')->fetch_assoc()['bid_credit']);
$winhavoc_bid = ($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = 3')->fetch_assoc()['bid_credit']);
$winapis_bid = ($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = 4')->fetch_assoc()['bid_credit']);
$winzeus_bid = ($mysqli->query('SELECT bid_credit FROM bid_system WHERE bid_id = 5')->fetch_assoc()['bid_credit']);
?>

<center>
               
				
				<br>
					<b style="color:#11d44f;"><?php echo "Weapon LF4"?>
				 <br>
							
					Highest Bid: <b style="color:gold;"><?php echo $winlf4; ?></b>
					<br>
					Highest Offer: <a style="color:gold;"><?php echo $winlf4_bid; ?></a>
				
                    <form id="acik_arttirma" method="post">   
								
						
                        
						<div style="background-color: transparent;" class="card-action">
                            <div class="row">
								<input type="submit" value="Bidding" class="buy button modal-trigger">
                            </div>
                        </div>
						
                    
								<?php if(isset($_POST['bid_credit'])){
								$bid_credit = $_POST['bid_credit']; 
								acik_arttirma($bid_credit);
								} ?>
                    
					</form>
					</div>
				</center>
            </div>

<?php require_once(INCLUDES . 'data.php'); ?>
           <?php $mysqli = Database::GetInstance();?>

   

<?php if( $player['rankId'] != 22) { ?>

<div id="main">
 <div class="container">
 <div class="row">
 <div class="row" style="color: white;"> <div class="col s12">
 <div class="card white-text center padding-15" style="overflow: hidden; max-height: 70%; background-color: #00141a; box-shadow: inset 0px 0px 25px 1px #004e66; text-align: left; padding: 15px;position: absolute; width: 80%; top: 28%; left: 50%; transform: translate(-50%, 0%);">
 <b>No refunds if other pilots switch to your offer.</b> <br>
 <b>The auction is hourly, renewed per hour.</b> <br>
 <div style="position: absolute; top: 5px; right: 5px;">
 <a class="buy button_edit1" style="background-color: darkred;" href="./auction1/?mode=1hour" name="1hour">Hourly auction</a>
 <a class="buy button_edit1" href="./auction1/?mode=24hour" name="24hour">Daily auction</a> </div>
 <b style="display: block; width: 100%; text-align: right; color: white;" id="countdown">
 </b> <hr> <div style="max-height: 86%; overflow-x: hidden; overflow-y: auto;">
 <table style="width: 100%; font-size: 12px; height: 30px; color: white; font-weight: normal;"><tbody><tr>


<td><img src="/do_img/global/items/equipment/weapon/laser/lf-4_63x63.png" style="width: 30px; height: auto;">
</td><td>Weapon LF4 (1 Units)</td><td>Highest Offer: <a style="color:gold;">
<?php echo $winlf4_bid; ?></a><form id="acik_arttirma" method="post">Highest Bid: <b style="color:gold;">
<?php echo $winlf4; ?></b><br> <div class="row"><div class="col-sm-3" style="height: 30px;">
<div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">Credit Offer:</div></div><div class="col-sm-5" style="height: 30px;">
<div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">
<input style="color:black;" placeholder="500" min="0" max="999999999" step="500" type="number" class="form-control" name="bid_credit" id="bid_credit" required="">
</div></div><div class="col-sm-4" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">
<input bid_id = 1 type="submit" value="Bidding"style="color:black; class="buy button modal-trigger"></div></div></div></form></td></tr><tr>
























<?php } ?>