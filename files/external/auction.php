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
				<img src="<?php echo DOMAIN; ?>/do_img/global/items/equipment/weapon/laser/lf-4_63x63.png">
				<br>
					<b style="color:#11d44f;"><?php echo "Weapon LF4"?>
				 <br>
							
					Highest Bid: <b style="color:gold;"><?php echo $winlf4; ?></b>
					<br>
					Highest Offer: <a style="color:gold;"><?php echo $winlf4_bid; ?></a>
				
                    <form id="acik_arttirma" method="post">   
								
                        Credit Offer:<input style="color:black;" placeholder="50000" min="100000" max="9999999999" step="50000" type="number" class="form-control" name="bid_credit" id="bid_credit" required>
						
                        
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
            <!--- --->
           <!-- <div class="col s12">
			
            <div class="card white-text center padding-15" style="background-color: #00141a; box-shadow: inset 0px 0px 25px 1px #004e66;">
             <img src="<?php echo DOMAIN; ?>/do_img/global/items/equipment/weapon/laser/lf-4_63x63.png">
             <br>
                 <?php echo "Weapon LF4 SLOT2"?>
              <br>
                         
                 Highest Bid: <b style="color:#957c0a;"><?php echo $winlf4_lf4_2; ?></b>
				 <br>
					Highest Offer: <a style="color:#957c0a;"><?php echo $winlf4_lf4_2_bid; ?></a>
             
                 <form id="acik_arttirma" method="post">   
                             
                     Credit Offer:<input style="color:white" type="number" name="bid_credit_lf4_2" id="bid_credit_lf4_2" required>
                     
                     
                     <div style="background-color: transparent;" class="card-action">
                         <div class="row">
                             <input type="submit" value="Give Offer LF4 SLOT2" class="buy button modal-trigger">
                         </div>
                     </div>
                     
                 
                             <?php if(isset($_POST['bid_credit_lf4_2'])){
                             $bid_credit_lf4_2 = $_POST['bid_credit_lf4_2']; 
                             acik_arttirma_lf4_2($bid_credit_lf4_2);
                             } ?>
                 
                 </form>
                 
             </div>
         </div> -->

         <!--- --->

           <!--- --->
           <div class="col s12">
			<center>
            <div class="logs styleUpdate" style="background-color:#1d1d1d99; height:400x; width:780px; margin:auto; ">
             <img src="<?php echo DOMAIN; ?>/do_img/global/items/equipment/weapon/laser/lf-4_63x63.png">
             <br>
                 <?php echo "Weapon LF4 Uri"?>
              <br>
                         
                 Highest Bid: <b style="color:gold;"><?php echo $winlf4_lf4_3; ?></b>
				 <br>
					Highest Offer: <a style="color:gold;"><?php echo $winlf4_lf4_3_bid; ?></a>
             
                 <form id="acik_arttirma" method="post">   
                             
                     Uridium Offer:<input style="color:black;" placeholder="500" min="0" max="9999999999" step="500" type="number" class="form-control" name="bid_credit_lf4_3" id="bid_credit_lf4_3" required>
                     
                     
                     <div style="background-color: transparent;" class="card-action">
                         <div class="row">
                             <input type="submit" value="Bidding" class="buy button modal-trigger">
                         </div>
                     </div>
                     
                 
                             <?php if(isset($_POST['bid_credit_lf4_3'])){
                             $bid_credit_lf4_3 = $_POST['bid_credit_lf4_3']; 
                             acik_arttirma_lf4_3($bid_credit_lf4_3);
                             } ?>
                 
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
                         
                 Highest Bid: <b style="color:#957c0a;"><?php echo $winlf4_lf4_4; ?></b>
				  <br>
					Highest Offer: <a style="color:#957c0a;"><?php echo $winlf4_lf4_4_bid; ?></a>
				 
             
                 <form id="acik_arttirma" method="post">   
                             
                     Uridium Offer:<input style="color:white" type="number" name="bid_credit_lf4_4" id="bid_credit_lf4_4" required>
                     
                     
                     <div style="background-color: transparent;" class="card-action">
                         <div class="row">
                             <input type="submit" value="Give Offer LF4 SLOT4" class="buy button modal-trigger">
                         </div>
                     </div>
                     
                 
                             <?php if(isset($_POST['bid_credit_lf4_4'])){
                             $bid_credit_lf4_4 = $_POST['bid_credit_lf4_4']; 
                             acik_arttirma_lf4_4($bid_credit_lf4_4);
                             } ?>
                 
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
				<img src="<?php echo DOMAIN; ?>/do_img/global/items/drone/designs/hercules_63x63.png">
				<br>
				<?php echo "Droid Desings Hercules"?>
				<br>
						Highest Bid: <b style="color:gold;"><?php echo $winhercul; ?></b>
						 <br>
					Highest Offer: <a style="color:gold;"><?php echo $winhercul_bid; ?></a>
                    <form id="acik_arttirmahercul" method="post">                     
                        Uridium Offer:<input style="color:black;" placeholder="500" min="0" max="9999999999" step="500" type="number" class="form-control" name="bid_hercul" id="bid_hercul" required>
                        <div style="background-color: transparent;" class="card-action">
                            <div class="row">
							<input type="submit" value="Bidding" class="buy button modal-trigger">
                             </div>
                            </div>
						
							<?php if(isset($_POST['bid_hercul'])){
							$bid_hercul = $_POST['bid_hercul']; 
							acik_arttirmahercul($bid_hercul);
							} ?>
                    
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
				<img src="<?php echo DOMAIN; ?>/do_img/global/items/drone/designs/havoc_63x63.png">
				<br>
				<?php echo "Droid Desings Havoc"?>
				<br>
					Highest Bid: <b style="color:gold;"><?php echo $winhavoc; ?></b>
					<br>
					Highest Offer: <a style="color:gold;"><?php echo $winhavoc_bid; ?></a>
					
                    <form id="acik_arttirmahavoc" method="post">                     
                        Uridium Offer<input style="color:black;" placeholder="500" min="0" max="9999999999" step="500" type="number" class="form-control" name="bid_havoc" id="bid_havoc" required>
                        
						 <div style="background-color: transparent;" class="card-action">
                            <div class="row">
							<input type="submit" value="Bidding" class="buy button modal-trigger">
                             </div>
                            </div>
						
							<?php if(isset($_POST['bid_havoc'])){
							$bid_havoc = $_POST['bid_havoc']; 
							acik_arttirmahavoc($bid_havoc);
							} ?>
                    
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
           <?php $mysqli = Database::GetInstance();?>
            <div class="col s12">
			<center>
               <div class="logs styleUpdate" style="background-color:#1d1d1d99; height:400x; width:780px; margin:auto; ">
					<img src="<?php echo DOMAIN; ?>/do_img/global/items/drone/apis-5_63x63.png">
				<br>
					<?php echo "APIS DROID"?>
				 <br>
							
					Highest Bid: <b style="color:gold;"><?php echo $winapis; ?></b>
					<br>
					Highest Offer: <a style="color:gold;"><?php echo $winapis_bid; ?></a>
				
                    <form id="acik_arttirma_apis" method="post">   
								
                         Uridium Offer<input style="color:black;" placeholder="500" min="0" max="9999999999" step="500" type="number" class="form-control" name="bid_apis" id="bid_apis" required>
						
                        
						<div style="background-color: transparent;" class="card-action">
                            <div class="row">
								<input type="submit" value="Bidding" class="buy button modal-trigger">
                            </div>
                        </div>
						
                    
								<?php if(isset($_POST['bid_apis'])){
								$bid_apis = $_POST['bid_apis']; 
								acik_arttirma_apis($bid_apis);
								} ?>
                    
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
           <?php $mysqli = Database::GetInstance();?>
            <div class="col s12">
			<center>
               <div class="logs styleUpdate" style="background-color:#1d1d1d99; height:400x; width:780px; margin:auto; ">
					<img src="<?php echo DOMAIN; ?>/do_img/global/items/drone/zeus-5_63x63.png">
				<br>
					<?php echo "ZEUS DROID"?>
				 <br>
							
					Highest Bid: <b style="color:gold;"><?php echo $winzeus; ?></b>
					<br>
					Highest Offer: <a style="color:gold;"><?php echo $winzeus_bid; ?></a>
				
                    <form id="acik_arttirma_zeus" method="post">   
								
                        Uridium Offer<input style="color:black;" placeholder="500" min="0" max="9999999999" step="500" type="number" class="form-control" name="bid_zeus" id="bid_zeus" required>
						
                        
						<div style="background-color: transparent;" class="card-action">
                            <div class="row">
								<input type="submit" value="Bidding" class="buy button modal-trigger">
                            </div>
                        </div>
						
                    
								<?php if(isset($_POST['bid_zeus'])){
								$bid_zeus = $_POST['bid_zeus']; 
								acik_arttirma_zeus($bid_zeus);
								} ?>
                    
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
 
 
 
 
 
 