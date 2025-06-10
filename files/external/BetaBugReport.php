<?php require_once(INCLUDES . 'header.php'); ?>

<?php
		$hoy = date("Y-m-d H:i:s"); 
       if(isset($_POST['bugTitle']) && isset($_POST['bugMsg']) )
        {
		if (empty($_POST['bugTitle'])){
			$msg = "Enter all the required data title";
		}
		elseif (empty($_POST['bugMsg'])){
			$msg = "Enter all the required data message";
		} else 	{		
		$bugTitle = $mysqli->real_escape_string($_POST['bugTitle']);
		$bugMsg = $mysqli->real_escape_string($_POST['bugMsg']);
		
		
		$mysqli->query("insert  into bugreport(`title`,`message`,`usersid`,`fecha`) values ('$bugTitle','$bugMsg','$player[userId]','$hoy');");
		$msg = "Has been sent successfully";
		}
        }
        
    
?>


<link rel="stylesheet" href="/css/messages.css">
<div class="page warnMessage">
<div class="warnmessage-container styleUpdate">
<div class="text warnmessage-text">
<center>
<small>
All Reports will be Checked! If the Bug, you reported, already exists it will be Ignored. (you also wont get any reward for it).
<br>If Something breaks on your Account than you can Write me in Discord!
<br>
Descripe the Bug as mutch as you can! You only get Reward if we could fix it with your Description! Write every Step you done to get the Bug!
<br>
<b>PLEASE REPORT ONLY ONE BUG PER REPORT!</b>
</small>
</center>
</div>
</div>
</div>
 
<div class="page messages styleUpdate ps-container" data-ps-id="0d03f07f-4736-ec38-d9ac-8874522b7369">
<div class="messages-container">
<div class="popup">
<div class="popup-container">
<p class="popup-text"></p>
</div>
</div>
<div class="top">
<h3>Bugreport</h3>
</div>
<div class="vmessage">
<div class="top">
<form method="POST">
<i class="fas fa-pencil-alt"></i>
<input type="text" name="bugTitle" placeholder="Title...">
</div>
<textarea class="message" name="bugMsg"></textarea>
<div class="action">
<button type="submit" class="btn btn-lg btn-success">Send</button>
</div>
</form><?php
if (isset($msg) and !empty($msg)){
?>
<center><div style="border:1px solid red; padding:10px;"><?= $msg; ?></div></center>
<?php
}
?>
</div>
</div>
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>