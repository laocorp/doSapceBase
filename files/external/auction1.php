<?php require_once(INCLUDES . 'header.php'); ?>
<script src="https://kit.fontawesome.com/4f90b43f8c.js" crossorigin="anonymous" type="text/javascript"></script>
<link rel="stylesheet" href="/css/auction.css" />
<?php require_once(INCLUDES . 'data.php'); ?>

<?php
// Helper function to fetch auction data to avoid repetition (similar to auction.php)
function getAuctionData_auction1($mysqli, $bid_id) {
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

$auction_data_a1 = [];
// IDs used in this file for fetching (based on original queries)
$auction_item_ids_a1 = [1, 2, 3, 4, 5, 6, 7, 8];

foreach ($auction_item_ids_a1 as $id) {
    $auction_data_a1[$id] = getAuctionData_auction1($mysqli, $id);
}

// Assigning to variables as used in the HTML structure below
$winlf4 = $auction_data_a1[1]['pilotname'];
// $winlf4_lf4_2, $winlf4_lf4_3, $winlf4_lf4_4 are not used in the immediate visible part of the HTML in auction1.php
// but their bids are, so we fetch them.
$winhercul = $auction_data_a1[2]['pilotname'];
$winhavoc = $auction_data_a1[3]['pilotname'];
$winapis = $auction_data_a1[4]['pilotname'];
$winzeus = $auction_data_a1[5]['pilotname'];

$winlf4_bid = $auction_data_a1[1]['credit'];
$winlf4_lf4_2_bid = $auction_data_a1[6]['credit']; // For LF4 Slot 2
$winlf4_lf4_3_bid = $auction_data_a1[7]['credit']; // For LF4 Slot 3 (Uri)
$winlf4_lf4_4_bid = $auction_data_a1[8]['credit']; // For LF4 Slot 4 (Uri)
$winhercul_bid = $auction_data_a1[2]['credit'];
$winhavoc_bid = $auction_data_a1[3]['credit'];
$winapis_bid = $auction_data_a1[4]['credit'];
$winzeus_bid = $auction_data_a1[5]['credit'];
?>

<center>
               
				
				<br>
					<b style="color:#11d44f;"><?php echo "Weapon LF4";?>
				 <br>
							
					Highest Bid: <b style="color:gold;"><?php echo htmlspecialchars($winlf4, ENT_QUOTES, 'UTF-8'); ?></b>
					<br>
					Highest Offer: <a style="color:gold;"><?php echo htmlspecialchars($winlf4_bid, ENT_QUOTES, 'UTF-8'); ?></a>
				
                    <form id="acik_arttirma" method="post">   
								
						
                        
						<div style="background-color: transparent;" class="card-action">
                            <div class="row">
								<input type="submit" value="Bidding" class="buy button modal-trigger">
                            </div>
                        </div>
						
                    
								<?php if(isset($_POST['bid_credit'])){
								$bid_credit = $_POST['bid_credit']; 
								Functions::acik_arttirma($bid_credit); // Updated to call Functions method
								} ?>
                    
					</form>
					</div>
				</center>
            </div>

<?php require_once(INCLUDES . 'data.php'); ?>
           <?php $mysqli = Database::GetInstance();?>

   

<?php if( $player['rankId'] != 22) { ?>

<div id="main"> <div class="container"> <div class="row"> <div class="row" style="color: white;"> <div class="col s12"> <div class="card white-text center padding-15" style="overflow: hidden; max-height: 70%; background-color: #00141a; box-shadow: inset 0px 0px 25px 1px #004e66; text-align: left; padding: 15px;position: absolute; width: 80%; top: 28%; left: 50%; transform: translate(-50%, 0%);"> <b>No refunds if other pilots switch to your offer.</b> <br> <b>The auction is hourly, renewed per hour.</b> <br> <div style="position: absolute; top: 5px; right: 5px;"><a class="buy button_edit1" style="background-color: darkred;" href="./auction1/?mode=1hour" name="1hour">Hourly auction</a><a class="buy button_edit1" href="./auction1/?mode=24hour" name="24hour">Daily auction</a> </div> <b style="display: block; width: 100%; text-align: right; color: white;" id="countdown"> </b> <hr> <div style="max-height: 86%; overflow-x: hidden; overflow-y: auto;"> <table style="width: 100%; font-size: 12px; height: 30px; color: white; font-weight: normal;"><tbody><tr><td><img src="/do_img/global/items/equipment/weapon/laser/lf-4_63x63.png" style="width: 30px; height: auto;"></td><td>Weapon LF4 (1 Units)</td><td>Highest Offer: <a style="color:gold;"><?php echo htmlspecialchars($winlf4_bid, ENT_QUOTES, 'UTF-8'); ?></a><form id="acik_arttirma" method="post">Highest Bid: <b style="color:gold;"><?php echo htmlspecialchars($winlf4, ENT_QUOTES, 'UTF-8'); ?></b><br> <div class="row"><div class="col-sm-3" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">Credit Offer:</div></div><div class="col-sm-5" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input style="color:black;" placeholder="500" min="0" max="999999999" step="500" type="number" class="form-control" name="bid_credit" id="bid_credit" required=""></div></div><div class="col-sm-4" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input bid_id = 1 type="submit" value="Bidding"style="color:black;" class="buy button modal-trigger"></div></div></div></form></td></tr><tr><td><img src="https://www.ancient-orbit.de///do_img/global/items/ammunition/rocket/plt-3030.gif" style="width: 30px; height: auto;"></td><td>PLT-3030 (150 Units)</td><td>Highest Offer: <a style="color:#957c0a;"> </a></td><td><form id="acik_arttirma" method="post"> <div class="row"><div class="col-sm-3" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">Credit Offer:</div></div><div class="col-sm-5" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input style="color:black;" placeholder="500" min="0" max="9999" step="500" type="number" class="form-control" name="bid_credit" id="bid_credit146" required=""></div></div><div class="col-sm-4" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input data-id="146" type="button" value="Give Offer" class="buy button_edit"></div></div></div></form></td></tr><tr><td><img src="https://www.ancient-orbit.de///do_img/global/items/ammunition/rocketlauncher/hstrm-01.gif" style="width: 30px; height: auto;"></td><td>HSTRM-01 (200 Units)</td><td>Highest Offer: <a style="color:#957c0a;"> </a></td><td><form id="acik_arttirma" method="post"> <div class="row"><div class="col-sm-3" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">Credit Offer:</div></div><div class="col-sm-5" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input style="color:black;" placeholder="500" min="0" max="9999" step="500" type="number" class="form-control" name="bid_credit" id="bid_credit3101" required=""></div></div><div class="col-sm-4" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input data-id="3101" type="button" value="Give Offer" class="buy button_edit"></div></div></div></form></td></tr><tr><td><img src="https://www.ancient-orbit.de///do_img/global/items/ammunition/rocketlauncher/sar-02.gif" style="width: 30px; height: auto;"></td><td>SAR-02 (200 Units)</td><td>Highest Offer: <a style="color:#957c0a;"> </a></td><td><form id="acik_arttirma" method="post"> <div class="row"><div class="col-sm-3" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">Credit Offer:</div></div><div class="col-sm-5" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input style="color:black;" placeholder="500" min="0" max="9999" step="500" type="number" class="form-control" name="bid_credit" id="bid_credit3102" required=""></div></div><div class="col-sm-4" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input data-id="3102" type="button" value="Give Offer" class="buy button_edit"></div></div></div></form></td></tr><tr><td><img src="https://www.ancient-orbit.de///do_img/global/items/ammunition/laser/mcb-50.gif" style="width: 30px; height: auto;"></td><td>MCB-50 (2000 Units)</td><td>Highest Offer: <a style="color:#957c0a;"> </a></td><td><form id="acik_arttirma" method="post"> <div class="row"><div class="col-sm-3" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">Credit Offer:</div></div><div class="col-sm-5" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input style="color:black;" placeholder="500" min="0" max="9999" step="500" type="number" class="form-control" name="bid_credit" id="bid_credit142" required=""></div></div><div class="col-sm-4" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input data-id="142" type="button" value="Give Offer" class="buy button_edit"></div></div></div></form></td></tr><tr><td><img src="https://www.ancient-orbit.de///do_img/global/items/equipment/extra/cpu/cl04k-xl.gif" style="width: 30px; height: auto;"></td><td>CLO4K-XL (10 Units)</td><td>Highest Offer: <a style="color:#957c0a;"> </a></td><td><form id="acik_arttirma" method="post"> <div class="row"><div class="col-sm-3" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">Credit Offer:</div></div><div class="col-sm-5" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input style="color:black;" placeholder="500" min="0" max="9999" step="500" type="number" class="form-control" name="bid_credit" id="bid_credit154" required=""></div></div><div class="col-sm-4" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input data-id="154" type="button" value="Give Offer" class="buy button_edit"></div></div></div></form></td></tr><tr><td><img src="https://www.ancient-orbit.de///do_img/global/items/ammunition/laser/mcb-25.gif" style="width: 30px; height: auto;"></td><td>MCB-25 (2000 Units)</td><td>Highest Offer: <a style="color:#957c0a;"> </a></td><td><form id="acik_arttirma" method="post"> <div class="row"><div class="col-sm-3" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">Credit Offer:</div></div><div class="col-sm-5" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input style="color:black;" placeholder="500" min="0" max="9999" step="500" type="number" class="form-control" name="bid_credit" id="bid_credit141" required=""></div></div><div class="col-sm-4" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input data-id="141" type="button" value="Give Offer" class="buy button_edit"></div></div></div></form></td></tr><tr><td><img src="https://www.ancient-orbit.de///do_img/global/items/resource/logfile_100x100.png" style="width: 30px; height: auto;"></td><td>Logdisk (20 Units)</td><td>Highest Offer: <a style="color:#957c0a;"> </a></td><td><form id="acik_arttirma" method="post"> <div class="row"><div class="col-sm-3" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">Credit Offer:</div></div><div class="col-sm-5" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input style="color:black;" placeholder="500" min="0" max="9999" step="500" type="number" class="form-control" name="bid_credit" id="bid_credit4" required=""></div></div><div class="col-sm-4" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input data-id="4" type="button" value="Give Offer" class="buy button_edit"></div></div></div></form></td></tr><tr><td><img src="https://www.ancient-orbit.de///do_img/global/items/equipment/extra/cpu/ish-01.gif" style="width: 30px; height: auto;"></td><td>ISH-01 (5 Units)</td><td>Highest Offer: <a style="color:#957c0a;"> </a></td><td><form id="acik_arttirma" method="post"> <div class="row"><div class="col-sm-3" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">Credit Offer:</div></div><div class="col-sm-5" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input style="color:black;" placeholder="500" min="0" max="9999" step="500" type="number" class="form-control" name="bid_credit" id="bid_credit151" required=""></div></div><div class="col-sm-4" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input data-id="151" type="button" value="Give Offer" class="buy button_edit"></div></div></div></form></td></tr><tr><td><img src="https://www.ancient-orbit.de///do_img/global/items/equipment/extra/cpu/smb-01.gif" style="width: 30px; height: auto;"></td><td>SMB-01 (5 Units)</td><td>Highest Offer: <a style="color:#957c0a;"> </a></td><td><form id="acik_arttirma" method="post"> <div class="row"><div class="col-sm-3" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">Credit Offer:</div></div><div class="col-sm-5" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input style="color:black;" placeholder="500" min="0" max="9999" step="500" type="number" class="form-control" name="bid_credit" id="bid_credit152" required=""></div></div><div class="col-sm-4" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input data-id="152" type="button" value="Give Offer" class="buy button_edit"></div></div></div></form></td></tr><tr><td><img src="https://www.ancient-orbit.de///do_img/global/items/ammunition/specialammo/emp-01.gif" style="width: 30px; height: auto;"></td><td>EMP-01 (5 Units)</td><td>Highest Offer: <a style="color:#957c0a;"> </a></td><td><form id="acik_arttirma" method="post"> <div class="row"><div class="col-sm-3" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">Credit Offer:</div></div><div class="col-sm-5" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input style="color:black;" placeholder="500" min="0" max="9999" step="500" type="number" class="form-control" name="bid_credit" id="bid_credit153" required=""></div></div><div class="col-sm-4" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input data-id="153" type="button" value="Give Offer" class="buy button_edit"></div></div></div></form></td></tr><tr><td><img src="https://www.ancient-orbit.de///do_img/global/items/ammunition/laser/sab-50.gif" style="width: 30px; height: auto;"></td><td>SAB-50 (2500 Units)</td><td>Highest Offer: <a style="color:#957c0a;"> </a></td><td><form id="acik_arttirma" method="post"> <div class="row"><div class="col-sm-3" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">Credit Offer:</div></div><div class="col-sm-5" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input style="color:black;" placeholder="500" min="0" max="9999" step="500" type="number" class="form-control" name="bid_credit" id="bid_credit143" required=""></div></div><div class="col-sm-4" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input data-id="143" type="button" value="Give Offer" class="buy button_edit"></div></div></div></form></td></tr><tr><td><img src="https://www.ancient-orbit.de///do_img/global/items/equipment/weapon/laser/lf-2.gif" style="width: 30px; height: auto;"></td><td>LF-2</td><td>Highest Offer: <a style="color:#957c0a;">-</a></td><td><form id="acik_arttirma" method="post"> <div class="row"><div class="col-sm-3" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">Credit Offer:</div></div><div class="col-sm-5" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input style="color:black;" placeholder="500" min="0" max="9999" step="500" type="number" class="form-control" name="bid_credit" id="bid_credit553" required=""></div></div><div class="col-sm-4" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input data-id="553" type="button" value="Give Offer" class="buy button_edit"></div></div></div></form></td></tr><tr><td><img src="https://www.ancient-orbit.de///do_img/global/items/equipment/generator/shield/sg3n-b01.gif" style="width: 30px; height: auto;"></td><td>SG3N-B01</td><td>Highest Offer: <a style="color:#957c0a;">-</a></td><td><form id="acik_arttirma" method="post"> <div class="row"><div class="col-sm-3" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);">Credit Offer:</div></div><div class="col-sm-5" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input style="color:black;" placeholder="500" min="0" max="9999" step="500" type="number" class="form-control" name="bid_credit" id="bid_credit253" required=""></div></div><div class="col-sm-4" style="height: 30px;"><div style="position: relative; top: 50%; left: 0px; transform: translate(0px, -50%);"><input data-id="253" type="button" value="Give Offer" class="buy button_edit"></div></div></div></form></td></tr> </tbody></table> </div> </div> </div> </div><script>var mode = "1hour"; updateWCTime(); function updateWCTime() { function pad(num) { return num > 9 ? num : '0'+num; } var now = new Date(), kickoff = Date.parse("2023-12-26 23:59:00"), diff = kickoff - now, days = Math.floor( diff / (1000*60*60*24) ), hours = Math.floor( diff / (1000*60*60) ), mins = Math.floor( diff / (1000*60) ), secs = Math.floor( diff / 1000 ), dd = days, hh = hours - days * 24, mm = mins - hours * 60, ss = secs - mins * 60; if(mode == "1hour") { document.getElementById("countdown") .innerHTML = pad(mm) + ':' + pad(ss) ; } else if(mode == "24hour") { document.getElementById("countdown") .innerHTML = pad(hh) + ':' + pad(mm) + ':' + pad(ss) ; } if(mm < 1) { $("#countdown").css("color", "red"); } else { $("#countdown").css("color", "white"); } if(diff < 0) { location.reload(); } } var tmp = setInterval('updateWCTime()', 1000 ); $(".button_edit").click(function(e) { e.preventDefault(); var btn = $(this); $(this).attr("disabled", true); $(this).css("cursor", "not-allowed"); var bidid = $(this).attr("data-id"); var bidamount = $("#bid_credit"+bidid).val(); $.ajax({ type: 'POST', url: 'https://www.ancient-orbit.de/api/', data: { action: 'placeBid', bidid: bidid, bidamount: bidamount }, success: function(response) { var json = jQuery.parseJSON(response); toast(json.message); $(btn).attr("disabled", false); $(btn).css("cursor", "pointer"); } }); });</script><div class="footer" style="padding-bottom:15px;"><div class="details">AncientOrbit | <a href="/termsandrules.php">Terms</a> | <a href="https://discord.gg/xeEKnNPu8j" target="_blank" style="color: #7688C0;">Discord</a> | <a>ID:</a> 347 | Rendered in 0 second(s)<p style="color:#00bd4c;font-weight:bold;">Gameserver is Online since 0 Day(s) 11 Hour(s) and 32 Minute(s)</p> </div></div><script>$('[data-toggle="tooltip"]').tooltip({ animated: 'fade', placement: $(this).data("placement"), html: $(this).data("html") });</script></div><div id="snackbar"></div><script type="text/javascript" src="https://www.ancient-orbit.de/js/jquery-3.4.1.min.js"></script><script type="text/javascript"> function getCookie(cname) { var name = cname + "="; var ca = document.cookie.split(';'); for(var i = 0; i < ca.length; i++) { var c = ca[i]; while (c.charAt(0) == ' ') { c = c.substring(1); } if (c.indexOf(name) == 0) { return c.substring(name.length, c.length); } } return ""; } function setCookie(cname, cvalue, seconds) { var d = new Date(); d.setSeconds(d.getSeconds() + seconds); var expires = "expires="+d.toUTCString(); document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/"; } function toast2(message){ var x = document.getElementById("snackbar"); x.className = "show"; x.innerHTML = message; setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000); } function toast(message){ var toast = Toastify({ text: message, duration: 5000, close: true, stopOnFocus: true, backgroundColor: "#2d2d2d", offset: { x: 20, y: 140 } }); toast.showToast(); }</script><style>/* width */ ::-webkit-scrollbar { width: 10px; } /* Track */ ::-webkit-scrollbar-track { background: #f1f1f1; } /* Handle */ ::-webkit-scrollbar-thumb { background: #888; } /* Handle on hover */ ::-webkit-scrollbar-thumb:hover { background: #555; } #snackbar { visibility: hidden; min-width: 250px; margin-left: -125px; background-color: #333; color: #fff; text-align: center; border-radius: 2px; padding: 16px; position: fixed; z-index: 1; left: 50%; bottom: 30px; } #snackbar.show { visibility: visible; -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s; animation: fadein 0.5s, fadeout 0.5s 2.5s; } @-webkit-keyframes fadein { from {bottom: 0; opacity: 0;} to {bottom: 30px; opacity: 1;} } @keyframes fadein { from {bottom: 0; opacity: 0;} to {bottom: 30px; opacity: 1;} } @-webkit-keyframes fadeout { from {bottom: 30px; opacity: 1;} to {bottom: 0; opacity: 0;} } @keyframes fadeout { from {bottom: 30px; opacity: 1;} to {bottom: 0; opacity: 0;} }</style> </div></div>



<?php } ?>
 
 
 
 
 
 