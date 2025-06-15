<?php
require_once(INCLUDES . 'header.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$csrf_token = '';
// Generate CSRF token if user is logged in
if (isset($player) && !empty($player['userId'])) {
    // Ensure Functions class is available. If you have an autoloader, this might not be strictly necessary.
    // require_once(ROOT . 'files/classes/Functions.php');
    $_SESSION['csrf_token'] = Functions::generateCsrfToken();
    $csrf_token = $_SESSION['csrf_token'];
}

// Prepare a variable to hold auction messages
$auction_messages = [];

// Process auction bids if a form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($csrf_token)) {
    $submitted_token = $_POST['csrf_token'] ?? '';

    if (!Functions::validateCsrfToken($submitted_token)) {
        $auction_messages[] = ['type' => 'error', 'text' => 'Invalid CSRF token. Please try again.'];
    } else {
        if (isset($_POST['submit_bid_credit'])) {
            $bid_value = $_POST['bid_credit'];
            $responseJson = Functions::acik_arttirma($bid_value, $submitted_token);
            $response = json_decode($responseJson, true);
            $auction_messages['acik_arttirma'] = ['type' => (isset($response['status']) && $response['status'] ? 'success' : 'error'), 'text' => $response['message'] ?? 'An error occurred.'];
        } elseif (isset($_POST['submit_bid_credit_lf4_2'])) { // LF4 Slot 2 - commented out
            $bid_value = $_POST['bid_credit_lf4_2'];
            $responseJson = Functions::acik_arttirma_lf4_2($bid_value, $submitted_token);
            $response = json_decode($responseJson, true);
            $auction_messages['acik_arttirma_lf4_2'] = ['type' => (isset($response['status']) && $response['status'] ? 'success' : 'error'), 'text' => $response['message'] ?? 'An error occurred.'];
        } elseif (isset($_POST['submit_bid_credit_lf4_3'])) { // LF4 Uri
            $bid_value = $_POST['bid_credit_lf4_3'];
            $responseJson = Functions::acik_arttirma_lf4_3($bid_value, $submitted_token);
            $response = json_decode($responseJson, true);
            $auction_messages['acik_arttirma_lf4_3'] = ['type' => (isset($response['status']) && $response['status'] ? 'success' : 'error'), 'text' => $response['message'] ?? 'An error occurred.'];
        } elseif (isset($_POST['submit_bid_credit_lf4_4'])) { // LF4 Slot 4 - commented out
            $bid_value = $_POST['bid_credit_lf4_4'];
            $responseJson = Functions::acik_arttirma_lf4_4($bid_value, $submitted_token);
            $response = json_decode($responseJson, true);
            $auction_messages['acik_arttirma_lf4_4'] = ['type' => (isset($response['status']) && $response['status'] ? 'success' : 'error'), 'text' => $response['message'] ?? 'An error occurred.'];
        } elseif (isset($_POST['submit_bid_hercul'])) {
            $bid_value = $_POST['bid_hercul'];
            $responseJson = Functions::acik_arttirmahercul($bid_value, $submitted_token);
            $response = json_decode($responseJson, true);
            $auction_messages['acik_arttirmahercul'] = ['type' => (isset($response['status']) && $response['status'] ? 'success' : 'error'), 'text' => $response['message'] ?? 'An error occurred.'];
        } elseif (isset($_POST['submit_bid_havoc'])) {
            $bid_value = $_POST['bid_havoc'];
            $responseJson = Functions::acik_arttirmahavoc($bid_value, $submitted_token);
            $response = json_decode($responseJson, true);
            $auction_messages['acik_arttirmahavoc'] = ['type' => (isset($response['status']) && $response['status'] ? 'success' : 'error'), 'text' => $response['message'] ?? 'An error occurred.'];
        } elseif (isset($_POST['submit_bid_apis'])) {
            $bid_value = $_POST['bid_apis'];
            $responseJson = Functions::acik_arttirma_apis($bid_value, $submitted_token);
            $response = json_decode($responseJson, true);
            $auction_messages['acik_arttirma_apis'] = ['type' => (isset($response['status']) && $response['status'] ? 'success' : 'error'), 'text' => $response['message'] ?? 'An error occurred.'];
        } elseif (isset($_POST['submit_bid_zeus'])) {
            $bid_value = $_POST['bid_zeus'];
            $responseJson = Functions::acik_arttirma_zeus($bid_value, $submitted_token);
            $response = json_decode($responseJson, true);
            $auction_messages['acik_arttirma_zeus'] = ['type' => (isset($response['status']) && $response['status'] ? 'success' : 'error'), 'text' => $response['message'] ?? 'An error occurred.'];
        }
    }
}
?>
<script src="https://kit.fontawesome.com/4f90b43f8c.js" crossorigin="anonymous" type="text/javascript"></script>
<link rel="stylesheet" href="/css/auction.css" />
<?php require_once(INCLUDES . 'data.php'); ?>

<?php
// Helper function to fetch auction data to avoid repetition
function getAuctionData($mysqli, $bid_id) {
    $pilotname = '';
    $credit = 0;

    $stmt_name = $mysqli->prepare('SELECT bid_pilotname FROM bid_system WHERE bid_id = ?');
    $stmt_name->bind_param("i", $bid_id);
    $stmt_name->execute();
    $result_name = $stmt_name->get_result();
    if ($row_name = $result_name->fetch_assoc()) {
        $pilotname = $row_name['bid_pilotname'];
    }
    $stmt_name->close();

    $stmt_credit = $mysqli->prepare('SELECT bid_credit FROM bid_system WHERE bid_id = ?');
    $stmt_credit->bind_param("i", $bid_id);
    $stmt_credit->execute();
    $result_credit = $stmt_credit->get_result();
    if ($row_credit = $result_credit->fetch_assoc()) {
        $credit = $row_credit['bid_credit'];
    }
    $stmt_credit->close();

    return ['pilotname' => $pilotname, 'credit' => $credit];
}

$auction_data = [];
$auction_item_ids = [1, 6, 7, 8, 2, 3, 4, 5]; // LF4, LF4_SLOT2, LF4_SLOT3, LF4_SLOT4, HERCUL, HAVOC, APIS, ZEUS

foreach ($auction_item_ids as $id) {
    $auction_data[$id] = getAuctionData($mysqli, $id);
}

$winlf4 = $auction_data[1]['pilotname'];
$winlf4_lf4_2 = $auction_data[6]['pilotname']; // Note: ID 6 for LF4 Slot 2 based on original queries
$winlf4_lf4_3 = $auction_data[7]['pilotname']; // Note: ID 7 for LF4 Slot 3
$winlf4_lf4_4 = $auction_data[8]['pilotname']; // Note: ID 8 for LF4 Slot 4
$winhercul = $auction_data[2]['pilotname'];
$winhavoc = $auction_data[3]['pilotname'];
$winapis = $auction_data[4]['pilotname'];
$winzeus = $auction_data[5]['pilotname'];

$winlf4_bid = $auction_data[1]['credit'];
$winlf4_lf4_2_bid = $auction_data[6]['credit'];
$winlf4_lf4_3_bid = $auction_data[7]['credit'];
$winlf4_lf4_4_bid = $auction_data[8]['credit'];
$winhercul_bid = $auction_data[2]['credit'];
$winhavoc_bid = $auction_data[3]['credit'];
$winapis_bid = $auction_data[4]['credit'];
$winzeus_bid = $auction_data[5]['credit'];
?>

<?php if( $player['rankId'] != 22) { ?>
<div id="main">
    <div class="container">
        <div class="row">
            <?php require_once(INCLUDES . 'data.php'); ?>
           <?php $mysqli = Database::GetInstance();?>
		    
        <div class="row">
         <center>
            <div class="col s12">
			
               <div class="logs styleUpdate" style="background-color:#1d1d1d99; height:400x; width:780px; margin:auto; ">
			   <b style="color:red">No refunds if other pilots switch to your offer.</b>
			   <br>
			   <b style="color:red">The auction is hourly, renewed per hour.</b>
			   <br>
			   <b style="color:red">it works but buy it at the closed convenience shop</b>
                </div>
			
<div class="col-12 col-sm-5 card card-colorless tooltip" data-tooltip-position="left" data-tooltip-content="Time Refresh" style="display:flex;"> <a class="btn btn-info border border-primary text-center p-2" data-toggle="collapse" aria-expanded="true"> <i class="fal fa-clock"></i> <h5><span id="gg-uridium"><div class="timer" id="timer" data-time="1664822402">00:07:15</div></span></h5> </a> </div>			
<script>
(function(e){var t=0;var n=1;var r=1e3;jQuery.autocountdown=function(){e(".countdown2").countdown2();t=setInterval("$('.countdown2').countdown2();",r)};jQuery.fn.countdown2=function(r){var s={refresh:1,interval:1e3,cdClass:"countdown2",granularity:4,label:["w ","d ",":",":",""],units:[604800,86400,3600,60,1]};if(r&&r.label){e.extend(s.label,r.label);delete r.label}
if(r&&r.units){e.extend(s.units,r.units);delete r.units}
e.extend(s,r);var o=function(e,t){e=String(e);t=parseInt(t)||2;while(e.length<t)e="0"+e;if(e<1)e="00";return e};var u=function(e){var t=s.label;var n=s.units;var r=s.granularity;output="";for(i=1;i<=n.length;i++){value=n[i];if(e>=value){var u=o(Math.floor(e/value),2);u=u>0?u:"00";output+=u+t[i];e%=value;r--}else if(value==1)output+="00";if(r==0)break}
if(output.length<3)output="00:"+output;return output?output:"00:00"};return this.each(function(){secs=e(this).attr("secs");e(this).html(u(secs));secs--;if(secs<1){e(this).attr("secs","...");clearInterval(t);if(n)window.location.href=window.location.href}else e(this).attr("secs",secs)})};e.autocountdown()})(jQuery)
</script>
				
				
            </div>
			</center>
        </div>

            <div class="col s12">
			<center>
               <div class="logs styleUpdate" style="background-color:#1d1d1d99; height:400x; width:780px; margin:auto; ">
				<img src="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>/do_img/global/items/equipment/weapon/laser/lf-4_63x63.png">
				<br>
					<b style="color:#11d44f;"><?php echo "Weapon LF4";?>
				 <br>
							
					Highest Bid: <b style="color:gold;"><?php echo htmlspecialchars($winlf4, ENT_QUOTES, 'UTF-8'); ?></b>
					<br>
					Highest Offer: <a style="color:gold;"><?php echo htmlspecialchars($winlf4_bid, ENT_QUOTES, 'UTF-8'); ?></a>
				
                    <form id="acik_arttirma_form" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
                        Credit Offer:<input style="color:black;" placeholder="50000" min="100000" max="9999999999" step="50000" type="number" class="form-control" name="bid_credit" id="bid_credit" required>
						
                        
						<div style="background-color: transparent;" class="card-action">
                            <div class="row">
								<input type="submit" name="submit_bid_credit" value="Bidding" class="buy button modal-trigger">
                            </div>
                        </div>
						
                    
								<?php
								if (isset($auction_messages['acik_arttirma'])) {
								    $msg = $auction_messages['acik_arttirma'];
								    echo "<p style='color: " . ($msg['type'] == 'success' ? 'green' : 'red') . ";'>" . htmlspecialchars($msg['text']) . "</p>";
								}
								?>
                    
					</form>
					
                </div>
				</center>
            </div>
            <!--- --->
           <!-- <div class="col s12">
			
            <div class="card white-text center padding-15" style="background-color: #00141a; box-shadow: inset 0px 0px 25px 1px #004e66;">
             <img src="<?php echo DOMAIN; ?>/do_img/global/items/equipment/weapon/laser/lf-4_63x63.png">
             <br>
                 <?php echo "Weapon LF4 SLOT2"?>
              <br>
                         
                 Highest Bid: <b style="color:#957c0a;"><?php echo htmlspecialchars($winlf4_lf4_2, ENT_QUOTES, 'UTF-8'); ?></b>
				 <br>
					Highest Offer: <a style="color:#957c0a;"><?php echo htmlspecialchars($winlf4_lf4_2_bid, ENT_QUOTES, 'UTF-8'); ?></a>
             
                 <form id="acik_arttirma_lf4_2_form" method="post">
                     <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
                     Credit Offer:<input style="color:white" type="number" name="bid_credit_lf4_2" id="bid_credit_lf4_2" required>
                     
                     
                     <div style="background-color: transparent;" class="card-action">
                         <div class="row">
                             <input type="submit" name="submit_bid_credit_lf4_2" value="Give Offer LF4 SLOT2" class="buy button modal-trigger">
                         </div>
                     </div>
                     
                 
                             <?php
                             /*if (isset($auction_messages['acik_arttirma_lf4_2'])) {
                                 $msg = $auction_messages['acik_arttirma_lf4_2'];
                                 echo "<p style='color: " . ($msg['type'] == 'success' ? 'green' : 'red') . ";'>" . htmlspecialchars($msg['text']) . "</p>";
                             }*/
                             ?>
                 
                 </form>
                 
             </div>
         </div> -->

         <!--- --->

           <!--- --->
           <div class="col s12">
			<center>
            <div class="logs styleUpdate" style="background-color:#1d1d1d99; height:400x; width:780px; margin:auto; ">
             <img src="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>/do_img/global/items/equipment/weapon/laser/lf-4_63x63.png">
             <br>
                 <?php echo "Weapon LF4 Uri";?>
              <br>
                         
                 Highest Bid: <b style="color:gold;"><?php echo htmlspecialchars($winlf4_lf4_3, ENT_QUOTES, 'UTF-8'); ?></b>
				 <br>
					Highest Offer: <a style="color:gold;"><?php echo htmlspecialchars($winlf4_lf4_3_bid, ENT_QUOTES, 'UTF-8'); ?></a>
             
                 <form id="acik_arttirma_lf4_3_form" method="post">
                     <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
                     Uridium Offer:<input style="color:black;" placeholder="500" min="0" max="9999999999" step="500" type="number" class="form-control" name="bid_credit_lf4_3" id="bid_credit_lf4_3" required>
                     
                     
                     <div style="background-color: transparent;" class="card-action">
                         <div class="row">
                             <input type="submit" name="submit_bid_credit_lf4_3" value="Bidding" class="buy button modal-trigger">
                         </div>
                     </div>
                     
                 
                             <?php
                             if (isset($auction_messages['acik_arttirma_lf4_3'])) {
                                 $msg = $auction_messages['acik_arttirma_lf4_3'];
                                 echo "<p style='color: " . ($msg['type'] == 'success' ? 'green' : 'red') . ";'>" . htmlspecialchars($msg['text']) . "</p>";
                             }
                             ?>
                 
                 </form>
                 
             </div>
			 </center>
         </div>

         <!--- --->


           <!--- --->
           <!--<div class="col s12">
			
            <div class="card white-text center padding-15" style="background-color: #00141a; box-shadow: inset 0px 0px 25px 1px #004e66;">
             <img src="<?php echo DOMAIN; ?>/do_img/global/items/equipment/weapon/laser/lf-4_63x63.png">
             <br>
                 <?php echo "Weapon LF4 SLOT4"?>
              <br>
                         
                 Highest Bid: <b style="color:#957c0a;"><?php echo htmlspecialchars($winlf4_lf4_4, ENT_QUOTES, 'UTF-8'); ?></b>
				  <br>
					Highest Offer: <a style="color:#957c0a;"><?php echo htmlspecialchars($winlf4_lf4_4_bid, ENT_QUOTES, 'UTF-8'); ?></a>
				 
             
                 <form id="acik_arttirma_lf4_4_form" method="post">
                     <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
                     Uridium Offer:<input style="color:white" type="number" name="bid_credit_lf4_4" id="bid_credit_lf4_4" required>
                     
                     
                     <div style="background-color: transparent;" class="card-action">
                         <div class="row">
                             <input type="submit" name="submit_bid_credit_lf4_4" value="Give Offer LF4 SLOT4" class="buy button modal-trigger">
                         </div>
                     </div>
                     
                 
                             <?php
                             /*if (isset($auction_messages['acik_arttirma_lf4_4'])) {
                                 $msg = $auction_messages['acik_arttirma_lf4_4'];
                                 echo "<p style='color: " . ($msg['type'] == 'success' ? 'green' : 'red') . ";'>" . htmlspecialchars($msg['text']) . "</p>";
                             }*/
                             ?>
                 
                 </form>
                 
             </div>
         </div> -->

         <!--- --->



        </div>
    </div>
	
	<!-- asd -->
	
	 <div class="container">
        <div class="row">
            <div class="col s12">
			<center>
                <div class="logs styleUpdate" style="background-color:#1d1d1d99; height:400x; width:780px; margin:auto; ">
				<img src="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>/do_img/global/items/drone/designs/hercules_63x63.png">
				<br>
				<?php echo "Droid Desings Hercules";?>
				<br>
						Highest Bid: <b style="color:gold;"><?php echo htmlspecialchars($winhercul, ENT_QUOTES, 'UTF-8'); ?></b>
						 <br>
					Highest Offer: <a style="color:gold;"><?php echo htmlspecialchars($winhercul_bid, ENT_QUOTES, 'UTF-8'); ?></a>
                    <form id="acik_arttirmahercul_form" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
                        Uridium Offer:<input style="color:black;" placeholder="500" min="0" max="9999999999" step="500" type="number" class="form-control" name="bid_hercul" id="bid_hercul" required>
                        <div style="background-color: transparent;" class="card-action">
                            <div class="row">
							<input type="submit" name="submit_bid_hercul" value="Bidding" class="buy button modal-trigger">
                             </div>
                            </div>
						
							<?php
							if (isset($auction_messages['acik_arttirmahercul'])) {
							    $msg = $auction_messages['acik_arttirmahercul'];
							    echo "<p style='color: " . ($msg['type'] == 'success' ? 'green' : 'red') . ";'>" . htmlspecialchars($msg['text']) . "</p>";
							}
							?>
                    
					</form>

                </div>
            </div>
        </div>
		</center>
    </div>
				
				
			<!-- havoc -->
			<div class="container">
        <div class="row">
            <div class="col s12">
			<center>
                <div class="logs styleUpdate" style="background-color:#1d1d1d99; height:400x; width:780px; margin:auto; ">
				<img src="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>/do_img/global/items/drone/designs/havoc_63x63.png">
				<br>
				<?php echo "Droid Desings Havoc";?>
				<br>
					Highest Bid: <b style="color:gold;"><?php echo htmlspecialchars($winhavoc, ENT_QUOTES, 'UTF-8'); ?></b>
					<br>
					Highest Offer: <a style="color:gold;"><?php echo htmlspecialchars($winhavoc_bid, ENT_QUOTES, 'UTF-8'); ?></a>
					
                    <form id="acik_arttirmahavoc_form" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
                        Uridium Offer<input style="color:black;" placeholder="500" min="0" max="9999999999" step="500" type="number" class="form-control" name="bid_havoc" id="bid_havoc" required>
                        
						 <div style="background-color: transparent;" class="card-action">
                            <div class="row">
							<input type="submit" name="submit_bid_havoc" value="Bidding" class="buy button modal-trigger">
                             </div>
                            </div>
						
							<?php
							if (isset($auction_messages['acik_arttirmahavoc'])) {
							    $msg = $auction_messages['acik_arttirmahavoc'];
							    echo "<p style='color: " . ($msg['type'] == 'success' ? 'green' : 'red') . ";'>" . htmlspecialchars($msg['text']) . "</p>";
							}
							?>
                    
					</form>

                </div>
            </div>
        </div>
		</center>
    </div>
	
	<!-- APIS -->
	
    <div class="container">
        <div class="row">
            <?php require_once(INCLUDES . 'data.php'); ?>
           <?php $mysqli = Database::GetInstance(); // Already instantiated, this is fine. ?>
            <div class="col s12">
			<center>
               <div class="logs styleUpdate" style="background-color:#1d1d1d99; height:400x; width:780px; margin:auto; ">
					<img src="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>/do_img/global/items/drone/apis-5_63x63.png">
				<br>
					<?php echo "APIS DROID";?>
				 <br>
							
					Highest Bid: <b style="color:gold;"><?php echo htmlspecialchars($winapis, ENT_QUOTES, 'UTF-8'); ?></b>
					<br>
					Highest Offer: <a style="color:gold;"><?php echo htmlspecialchars($winapis_bid, ENT_QUOTES, 'UTF-8'); ?></a>
				
                    <form id="acik_arttirma_apis_form" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
                         Uridium Offer<input style="color:black;" placeholder="500" min="0" max="9999999999" step="500" type="number" class="form-control" name="bid_apis" id="bid_apis" required>
						
                        
						<div style="background-color: transparent;" class="card-action">
                            <div class="row">
								<input type="submit" name="submit_bid_apis" value="Bidding" class="buy button modal-trigger">
                            </div>
                        </div>
						
                    
								<?php
								if (isset($auction_messages['acik_arttirma_apis'])) {
								    $msg = $auction_messages['acik_arttirma_apis'];
								    echo "<p style='color: " . ($msg['type'] == 'success' ? 'green' : 'red') . ";'>" . htmlspecialchars($msg['text']) . "</p>";
								}
								?>
                    
					</form>
					
                </div>
            </div>
        </div>
		</center>
    </div>
	
	
	<!-- Zeus -->
	<div class="container">
        <div class="row">
            <?php require_once(INCLUDES . 'data.php'); ?>
           <?php $mysqli = Database::GetInstance(); // Already instantiated, this is fine. ?>
            <div class="col s12">
			<center>
               <div class="logs styleUpdate" style="background-color:#1d1d1d99; height:400x; width:780px; margin:auto; ">
					<img src="<?php echo htmlspecialchars(DOMAIN, ENT_QUOTES, 'UTF-8'); ?>/do_img/global/items/drone/zeus-5_63x63.png">
				<br>
					<?php echo "ZEUS DROID";?>
				 <br>
							
					Highest Bid: <b style="color:gold;"><?php echo htmlspecialchars($winzeus, ENT_QUOTES, 'UTF-8'); ?></b>
					<br>
					Highest Offer: <a style="color:gold;"><?php echo htmlspecialchars($winzeus_bid, ENT_QUOTES, 'UTF-8'); ?></a>
				
                    <form id="acik_arttirma_zeus_form" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
                        Uridium Offer<input style="color:black;" placeholder="500" min="0" max="9999999999" step="500" type="number" class="form-control" name="bid_zeus" id="bid_zeus" required>
						
                        
						<div style="background-color: transparent;" class="card-action">
                            <div class="row">
								<input type="submit" name="submit_bid_zeus" value="Bidding" class="buy button modal-trigger">
                            </div>
                        </div>
						
                    
								<?php
								if (isset($auction_messages['acik_arttirma_zeus'])) {
								    $msg = $auction_messages['acik_arttirma_zeus'];
								    echo "<p style='color: " . ($msg['type'] == 'success' ? 'green' : 'red') . ";'>" . htmlspecialchars($msg['text']) . "</p>";
								}
								?>
                    
					</form>
					
                </div>
            </div>
        </div>
		</center>
    </div>
	
	
					
					 <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
	
</div>
<?php } ?>
 
 
 
 
 
 