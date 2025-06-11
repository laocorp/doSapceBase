<?php if (isset($player['userId'])){ ?>
<div class="footer" style="padding-bottom:15px;">
<div class="details">
<?= SERVERNAME; ?> | <a href="<?= DISCORDINVITELINK; ?>" target="_blank" style="color: #31a631;">Discord</a> | <a>ID:</a> <?= $player['userId']; ?>
<p style="color:#00bd4c;font-weight:bold;"><?= Socket::Get('timeOnline', array('Return' => "")); ?></p> </div>
</div>
<?php } ?>
<script>
$('[data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: $(this).data("placement"),
    html: $(this).data("html")
});
</script>
</div>
<div id="snackbar"></div>
<script type="text/javascript" src="<?php echo DOMAIN; ?>js/jquery-3.4.1.min.js"></script>
<?php if (Functions::IsLoggedIn() && isset($page[0]) && $page[0] === 'skill_tree') { ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
<?php } ?>
<!--<script type="text/javascript" src="<?php echo DOMAIN; ?>js/main.js"></script>-->

<script type="text/javascript">

  function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  function setCookie(cname, cvalue, seconds) {
    var d = new Date();
    d.setSeconds(d.getSeconds() + seconds);
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

  function toast2(message){
    var x = document.getElementById("snackbar");
    x.className = "show";
    x.innerHTML = message;
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  }

  function toast(message){

    var toast = Toastify({
      text: message,
      duration: 5000,
      close: true,
      stopOnFocus: true,
      backgroundColor: "#2d2d2d",
      offset: { x: 20, y: 140 }
    });

    toast.showToast();
  }

</script>

<style>
/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}

#snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
}

#snackbar.show {
  visibility: visible; 
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
</style>

<?php if (!Functions::IsLoggedIn() && isset($page[0]) && $page[0] === 'index3') { ?>

<script type="text/javascript">
  $('#modal #agree').click(function() {
    $('#register input[name=agreement]').prop('checked', false);
  });

  function gcap(){
    var checkbox = document.getElementById('r-terms');

    if (checkbox.checked === true){
      document.getElementById('gcap').style.display = 'block';
    } else {
      document.getElementById('gcap').style.display = 'none';
    }
  }

  $('#register-form').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    if ($('#register')) {
      $.ajax({
        type: 'POST',
        url: '<?php echo DOMAIN; ?>api/',
        data: form.serialize() + '&action=register',
        success: function(response) {
          console.log(response);
          var json = jQuery.parseJSON(response);


          if (json.gcccc){
            grecaptcha.reset();
          }

          $( "#r-username" ).removeClass( "bgcdw_errors" );
          $( "#rr-username" ).remove();

          $( "#r-password" ).removeClass( "bgcdw_errors" );
          $( "#rr-password" ).remove();

          $( "#r-password_confirm" ).removeClass( "bgcdw_errors" );
          $( "#rr-repassword" ).remove();

          $( "#r-email" ).removeClass( "bgcdw_errors" );
          $( "#rr-email" ).remove();

          document.getElementById("resultAll").style.display = "none";

          if (json.type == "username"){
            $( "#r-username" ).addClass( "bgcdw_errors" );
            $( ".bgc_signup_form_username" ).append( $( '<div id="rr-username" for="r-username" generated="false" class="bgcdw_errors"><ul data-error="bgc.error.username_notGiven"><li>'+json.message+'</li></ul></div>' ) );
          }

          if (json.type == "password"){
            $( "#r-password" ).addClass( "bgcdw_errors" );
            $( ".bgc_signup_form_password" ).append( $( '<div id="rr-password" for="r-password" generated="false" class="bgcdw_errors"><ul data-error="bgc.error.username_notGiven"><li>'+json.message+'</li></ul></div>' ) );
          }

          if (json.type == "confirm_password"){
            $( "#r-password_confirm" ).addClass( "bgcdw_errors" );
            $( ".bgc_signup_form_repassword" ).append( $( '<div id="rr-repassword" for="r-password_confirm" generated="false" class="bgcdw_errors"><ul data-error="bgc.error.username_notGiven"><li>'+json.message+'</li></ul></div>' ) );
          }

          if (json.type == "email"){
            $( "#r-email" ).addClass( "bgcdw_errors" );
            $( ".bgc_signup_form_email" ).append( $( '<div id="rr-email" for="r-email" generated="false" class="bgcdw_errors"><ul data-error="bgc.error.username_notGiven"><li>'+json.message+'</li></ul></div>' ) );
          }

          if (json.type == "resultAll"){
            document.getElementById("resultAll").style.display = "block";
            document.getElementById("resultAll").innerHTML = json.message;
          }

          if (json.redirect == true){
            setTimeout(() => {
              location.href='/'
            }, 3000);
          }
        }
      });
    } 
  });

  $('#login-form').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      type: 'POST',
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=login',
      success: function(response) {
        var json = jQuery.parseJSON(response);

        $( "#loginnick" ).removeClass( "bgcdw_errors" );
        $( "#loginpass" ).removeClass( "bgcdw_errors" );
        $( "#user" ).remove();
        $( "#pw" ).remove();

        if (json.type == "username"){
          $( "#loginnick" ).addClass( "bgcdw_errors" );
          $( ".bgcdw_login_form_username" ).append( $( '<div id="user" for="loginnick" generated="false" class="bgcdw_errors"><ul data-error="bgc.error.username_notGiven"><li>'+json.message+'</li></ul></div>' ) );
        }

        if (json.type == "password"){
          $( "#loginpass" ).addClass( "bgcdw_errors" );
          $( ".bgcdw_login_form_password" ).append( $( '<div id="pw" for="loginpassword" generated="false" class="bgcdw_errors"><ul data-error="bgc.error.username_notGiven"><li>'+json.message+'</li></ul></div>' ) );
        }

        if (json.type == "all"){
          $( "#loginpass" ).addClass( "bgcdw_errors" );
          $( "#loginnick" ).addClass( "bgcdw_errors" );
          $( ".bgcdw_login_form_password" ).append( $( '<div id="pw" for="loginpassword" generated="false" class="bgcdw_errors"><ul data-error="bgc.error.username_notGiven"><li>'+json.message+'</li></ul></div>' ) );
          $( ".bgcdw_login_form_username" ).append( $( '<div id="user" for="loginnick" generated="false" class="bgcdw_errors"><ul data-error="bgc.error.username_notGiven"><li>'+json.message+'</li></ul></div>' ) );
        }

        if (json.status){
          document.getElementById("loginsubmit").innerHTML = "LOGGED";
          document.getElementById("loginsubmit").style = "background: green;color: white;font-size: 15px !important;font-weight: 600;line-height: 10px;";
        }

        if (json.status){
          setTimeout(() => {
            location.reload();
          }, 3000);
        }

      }
    });
  });

  $('body').on('click', '#send-link-again', function() {
    $.ajax({
      type: 'POST',
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'send_link_again', username: $('#l-username').val() },
      success: function(response) {
        var json = jQuery.parseJSON(response);

        if (json.message != '') {
          toast(json.message);
        }
      }
    });
  });
</script>
<?php } ?>

<?php if (Functions::IsLoggedIn() && isset($page[0]) && $page[0] === 'company_select' && (isset($player) && $player['factionId'] == 0)) { ?>
<script type="text/javascript">
  function selectFaction(factionId){
    $.ajax({
      type: 'POST',
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'company_select', factionId: factionId },
      success: function(response) {
        var json = jQuery.parseJSON(response);

        if (json.status) {
          location.reload();
        } else if (json.message != '') {
          toast(json.message);
        }
      }
    });
  }
</script>
<?php } ?>

<?php if (Functions::IsLoggedIn() && isset($page[0]) && $page[0] === 'skill_tree') { ?>
<script type="text/javascript">
  $('#exchangeLogdisks').click(function() {
    var button = $(this);

    if (!button.is(':disabled')) {
      $.ajax({
        type: 'POST',
        url: '<?php echo DOMAIN; ?>api/',
        data: { action: 'exchange_logdisks' },
        success: function(response) {
          var json = jQuery.parseJSON(response);

          if (json.newStatus) {
            $('#logdisks').text(json.newStatus.logdisks);
            $('#requiredLogdisks').text(json.newStatus.requiredLogdisks);
            $('#researchPoints').text(json.newStatus.researchPoints);

            if (json.newStatus.logdisks < json.newStatus.requiredLogdisks || json.newStatus.researchPointsMaxed) {
              button.attr('disabled', true);
            }

            $('.skill').children().removeClass('noCursor');
          }

          if (json.message != '') {
            toast(json.message);
          }
        }
      });
    }
  });

  $('#resetSkills').click(function() {
    var button = $(this);

    if (button.is(':visible')) {
      $.ajax({
        type: 'POST',
        url: '<?php echo DOMAIN; ?>api/',
        data: { action: 'reset_skills' },
        success: function(response) {
          var json = jQuery.parseJSON(response);

          if (json.status) {
            location.reload();
          } else if (json.message != '') {
            toast(json.message);
          }
        }
      });
    }
  });

  $('.skill').click(function() {
    if (parseInt($('#researchPoints').text()) >= 1 && parseInt($(this).find('.currentLevel').text()) != parseInt($(this).find('.maxLevel').text()) && !$(this).children().hasClass('skill_effect_inactive')) {
      var skill = $(this).attr('id');

      $.ajax({
        type: 'POST',
        url: '<?php echo DOMAIN; ?>api/',
        data: { action: 'use_researchPoints', skill: skill },
        success: function(response) {
          var json = jQuery.parseJSON(response);

          if (json.newStatus) {
            $('#'+ skill +'').find('.currentLevel').text(json.newStatus.currentLevel);
            $('#'+ skill +'').attr('data-tooltip', json.newStatus.tooltip);
            $('.tooltipped').tooltip({ html: true });

            $('#researchPoints').text(json.newStatus.researchPoints);
            $('#usedResearchPoints').text(json.newStatus.usedResearchPoints);

            if (json.newStatus.isMaxed) {
              $('#'+ skill +'').find('.skillPoints').removeClass('skilltree_font_fail_skillPoints').addClass('skilltree_font_ismax');

              if (json.newStatus.nextSkill) {
                $('#'+ json.newStatus.nextSkill +'').children().removeClass('skill_effect_inactive').addClass('skill_effect');
              }
            }

            if (json.newStatus.researchPoints <= 0) {
              $('.skill').children().addClass('noCursor');
            }

            if (!$('.modal-trigger').is(':visible')) {
              $('.modal-trigger').css({display: 'inline-block'});
            }
          }

          if (json.message != '') {
            toast(json.message);
          }
        }
      });
    }
  });
</script>
<?php } ?>

<?php if (Functions::IsLoggedIn() && isset($page[0]) && $page[0] === 'shop') { ?>
<script type="text/javascript">
  var currentItemId = -1;
  var currentItemName = "%item_name%";
  var currentItemPrice = "%item_price%";

  $('.comprarshop').click(function() {
	  var itemId = document.getElementsByClassName('comprarshop')[0].id;
	  
      var amountInput = document.getElementsByClassName('priceAmount')[0].value;
      var amount = amountInput ? amountInput: 0;

      $.ajax({
        url: '<?php echo DOMAIN; ?>api/',
        data: { action: 'buy', itemId: itemId, amount: amount },
        type: 'POST',
        success:function(response) {
          var json = jQuery.parseJSON(response);

          if (json.newStatus) {
            document.getElementsByClassName('user-uridium')[0].innerHTML = json.newStatus.uridium;
            document.getElementsByClassName('user-credits')[0].innerHTML = json.newStatus.credits;
          }

          if (json.ec){
            document.getElementsByClassName('user-fraktal')[0].innerHTML = json.ec;
          }

          if (json.message != '') {
            toast(json.message);
          }
        }
      });

  });

</script>
<script type="text/javascript">
  $('.info_ship').click(function() {
    var ship = $(this).attr('id');

    $.ajax({
      type: 'POST',
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'info_ship', ship: ship },
      success: function(response) {
        var json = jQuery.parseJSON(response);

        if (json.name) {
		  document.getElementById('shipPreviewImage').src = "<?php echo DOMAIN; ?>do_img/global/items/ship/"+json.name+"_top.png";
          $('.ship-name').html(json.name);
		  $('.ship-hp').html(json.health);
		  $('.ship-lasers').html(json.lasers);
		  $('.ship-generators').html(json.generatos);
		  $('.ship-damage').html(json.damage);
		  $('.ship-speed').html(json.speed);
		  $('.useNave').attr("id", json.shipID);
        } else if (json.message != '') {
          toast(json.message);
        }
      }
    });
  });
</script>
<script type="text/javascript">
  $('.itmstyleUpdateCredits').click(function() {
    var shop = $(this).attr('id');
    document.getElementsByClassName('item-infos')[0].style.display = "none";

    $.ajax({
      type: 'POST',
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'info_shop', shop: shop },
      success: function(response) {

        var json = jQuery.parseJSON(response);
		
        var priceType;
        if (json.priceType == 'uridium'){
          priceType = "U";
        } else if (json.priceType == 'event') {
          priceType = "E.C";
        } else {
          priceType = "C";
        }

        if (json.name){
          document.getElementsByClassName('item-infos')[0].style.display = "block";
          document.getElementById('imageShop').src = "<?php echo DOMAIN; ?>"+json.image;
          $('#name').html(json.name);
          $('#info').html(json.information);
          document.getElementById('price').setAttribute("value", json.price);
          $('#priceType').html(priceType);
          document.getElementsByClassName('priceAmount')[0].setAttribute("id", json.id);
          document.getElementsByClassName('comprarshop')[0].setAttribute("id", json.id);
          if (json.amount == true){
            $('.quantity-container').show();
          } else {
            document.getElementsByClassName('priceAmount')[0].value = 1;
            $('.quantity-container').hide();
          }
        }
      }
    });
  });
</script>
<script>
function getPrice(amount, id){
	$.ajax({
      type: 'POST',
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'getPrice', amount: amount, id:id },
      success: function(response) {
		  if (response){
			  document.getElementById("price").setAttribute("value", response);
		  }
	  }
	});
}
</script>

<?php } ?>

<?php if (Functions::IsLoggedIn() && isset($page[1]) && $page[1] === 'join') { ?>
<script type="text/javascript">

  function viewUserApplications(id, clan_tag, clan_name, members, position) {
	  $("#user-applications").css("display", "block");
	}

  function cancelApplication(app){

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: 'app='+app+'&action=clan_cancel_application',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);

        if (json.status){
          document.getElementById('application_'+json.app).style.display = "none";
        }

        if (json.noApp){
          document.getElementById('noApp').style.display = 'block';
        }

      }
    });

	}

</script>

<script type="text/javascript">
function viewModal(id){
	document.getElementById('infos-send-button').setAttribute('class', 'btn btn-primary btn-lg');
	$('#send_clan_application textarea[name=text]').val('').attr('placeholder', 'A short text to explain why you want to join this clan...').attr('disabled', false);

  $("#infos").css("display", "block");
  $("#infos-leader").html('Load... <i class="fa fa-spin fa-cog"></i>');
  $("#infos-created").html('Load... <i class="fa fa-spin fa-cog"></i>');
  $("#infos-send-button").html('Please wait...');
  $("#infos-send-button").addClass('disabled');
  $("#infos-send-button").addClass('btn-default');
  $("#infos-description").html('Load...');
	
	$.ajax({
	  type: 'POST',
	  url: '<?php echo DOMAIN; ?>api/',
	  data: { action: 'info_clan', clanid: id },
	  success: function(response) {
      var json = JSON.parse(response);
      
      if (json) {

        $('#infos-send-button').html('Send');
        $('#infos-name').html(json.name);
        $('#infos-leader').html(json.leaderName);
        $('#infos-members').html(json.members);
        $('#infos-position').html(json.rank);
        $('#infos-created').html(json.date);
        document.getElementById('infos-avatar').setAttribute('src', json.profile);
        $('#infos-description').html(json.description);
        
        if (json.pending == true) {
          document.getElementById('infos-send-button').setAttribute('class', 'btn btn-primary btn-lg btn-danger');
          document.getElementById('infos-send-button').disabled = true;
          $('#infos-send-button').html('Pending...');
        } else {
          document.getElementById('infos-send-button').disabled = false;
          document.getElementById('infos-send-button').setAttribute('class', 'btn btn-primary btn-lg');
        }
        
        if (json.recruiting == 0) {
          document.getElementById('infos-send-button').setAttribute('class', 'btn btn-primary btn-lg btn-danger');
          document.getElementById('infos-send-button').disabled = true;
          $('#infos-send-button').html('No recruiting');
        }
        
        document.getElementById('infos-clanId').value = id;
      }
	  },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
      if (textStatus == 'error'){
        message(false, 'Multiple requests detected, try it in a few seconds.');
      }
    }
	});
	
}
</script>
<script type="text/javascript">
function message(error, message){
  $("#infos").css("display", "block");
  $('#infos-loader').css('display', 'block');
  if(error == false){
    $('#infos-loader').html('<div style="margin-top:120px;"></div> \
      <center> \
        <i style="font-size:64px;" class="fa fa-times fg-red"></i><br/> \
        <span style="font-size:32px;">' + message + '</span><br/> \
        <a class="btn btn-primary" onclick="$(\'#infos-loader\').css(\'display\', \'none\'); $(\'#infos\').css(\'display\', \'none\'); current_view_id=0;">Ok</a> \
      </center>');
  } else {
    $('#infos-loader').html('<div style="margin-top:130px;"></div> \
      <center> \
        <i style="font-size:64px;" class="fa fa-check fg-green"></i><br/> \
        <span style="font-size:32px;">' + message + '</span><br/> \
        <a class="btn btn-primary" onclick="$(\'#infos-loader\').css(\'display\', \'none\'); $(\'#infos\').css(\'display\', \'none\'); current_view_id=0;">Ok</a> \
      </center>');
  }	
}
</script>
<script type="text/javascript">
  $('#send_clan_application').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=send_clan_application',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);

        if (json.status) {
          $('#send_clan_application textarea[name=text]').val('').attr('placeholder', 'Your application to this Clan is pending.').attr('disabled', true);
          $('#send_clan_application button').addClass('disabled');
        }

        if (json.appId && json.clanTag && json.clanName){

          if(document.getElementById('noApp')){
            document.getElementById('noApp').style.display = "none";
          }

          $('#applicationsSend').append('<div id="application_'+json.appId+'">\
            - <b>['+json.clanTag+']</b> '+json.clanName+'<a onclick="cancelApplication('+json.appId+');" style="float:right; margin-right:5px; cursor:pointer;">Abort</a>\
          </div>');

        }

        if (json.message !== ""){
            if (json.status){
              message(true, json.message);
            } else {
              message(false, json.message);
            }
        }

      }
    });
  });
</script>
<script type="text/javascript">
  <?php if (isset($array) && is_array($array) && count($array) >= 1) { ?>

  var currentWpClanName = '%clan_name%';
  var currentWpClanId = 0;

  $('.withdraw-pending').click(function() {
    var clanId = $(this).data('clan-id');

    if (currentWpClanId != clanId) {
      var name = $(this).data('clan-name');

      $('#modal p').text($('#modal p').text().replace(currentWpClanName, name));

      currentWpClanId = clanId;
      currentWpClanName = name;
    }
  });

  $('#withdraw').click(function() {
    if (currentWpClanId != 0) {
      var table = $('#open-clan-applications');

      $.ajax({
        type: 'POST',
        url: '<?php echo DOMAIN; ?>api/',
        data: { action: 'withdraw_pending_application', clanId: currentWpClanId },
        success: function(response) {
          var json = jQuery.parseJSON(response);

          if (json.status) {
            if (table.find('tbody tr').length <= 1) {
              table.prev().remove();
              table.remove();
            } else {
              table.find('#pending-application-'+ currentWpClanId +'').remove();
            }
          }

          if (json.message != '') {
            toast(json.message);
          }
        }
      });
    }
  });

  <?php } ?>

  $('input[name=search_clan]').on('keyup keypress keydown click', function() {
    var value = $(this).val();

    if (value != '') {
      $.ajax({
        url: '<?php echo DOMAIN; ?>api/',
        data: { action: 'search_clan', keywords: value },
        type: 'POST',
        success:function(response) {
          $('#clan-list tbody').html('');

          var json = jQuery.parseJSON(response);
          for (var index in json) {
            $('#clan-list tbody').append('
              <tr>
                <td><a href="<?php echo DOMAIN; ?>clan/clan-details/'+json[index].id+'">['+ json[index].tag +'] '+json[index].name+'</a></td>
                <td>'+ json[index].members +'</td>
                <td>'+ json[index].rank +'</td>
                <td>'+ json[index].rankPoints +'</td>
              </tr>');
          }
        }
      });
    }
  });
</script>
<?php } ?>

<?php if (Functions::IsLoggedIn() && isset($page[1], $clan) && $page[1] === 'diplomacy' && $clan !== NULL) { ?>
<script type="text/javascript">

function message(error, message){
  $("#infos").css("display", "block");
  $('#infos-loader').css('display', 'block');
  if(error == false){
    $('#infos-loader').html('<div style="margin-top:25px;"></div> \
      <center> \
        <i style="font-size:64px;" class="fa fa-times fg-red"></i><br/> \
        <span style="font-size:16px;">' + message + '</span><br/> \
        <a class="btn btn-primary" onclick="$(\'#infos-loader\').css(\'display\', \'none\'); $(\'#infos\').css(\'display\', \'none\'); current_view_id=0;">Ok</a> \
      </center>');
  } else {
    $('#infos-loader').html('<div style="margin-top:25px;"></div> \
      <center> \
        <i style="font-size:64px;" class="fa fa-check fg-green"></i><br/> \
        <span style="font-size:16px;">' + message + '</span><br/> \
        <a class="btn btn-primary" onclick="$(\'#infos-loader\').css(\'display\', \'none\'); $(\'#infos\').css(\'display\', \'none\'); current_view_id=0;">Ok</a> \
      </center>');
  }	
}

function clanMessage(error, message){
  $("#clan-message").css("display", "block");
  $('#infosClanMessage').css('display', 'block');
  if(error == false){
    $('#infosClanMessage').html('<div style="margin-top:-6px;"></div> \
      <center> \
        <i style="font-size:64px;" class="fa fa-times fg-red"></i><br/> \
        <span style="font-size:16px;">' + message + '</span><br/> \
      </center>');
  } else {
    $('#infosClanMessage').html('<div style="margin-top:-6px;"></div> \
      <center> \
        <i style="font-size:64px;" class="fa fa-check fg-green"></i><br/> \
        <span style="font-size:16px;">' + message + '</span><br/> \
      </center>');
  }	
}

$('input[name=keywords]').on('keyup keypress keydown click', function() {
  var value = $(this).val();

  if (value != '') {
    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'diplomacy_search_clan', keywords: value },
      type: 'POST',
      success:function(response) {
        $('#dropdown3').html('');
        $('#dropdown3').css({display: 'block', opacity: 1});

        var json = jQuery.parseJSON(response);
        for (var index in json) {
          $('#dropdown3').append('
            <li>
              <a href="javascript:void(0)" data-clan-id="'+ json[index].id +'">['+ json[index].tag +'] '+ json[index].name +'</a>
            </li>');
        }
      }
    });
  } else {
    $('#dropdown3').css({display: 'none', opacity: 0});
    $('input[name=keywords]').val('');
    $('input[name=clanId]').val(0);
  }
});

$('#diplomacy-request').submit(function(e) {
  e.preventDefault();

  var form = $(this);

  $.ajax({
    url: '<?php echo DOMAIN; ?>api/',
    data: form.serialize() + '&action=request_diplomacy',
    type: 'POST',
    success:function(response) {
      var json = jQuery.parseJSON(response);

      if (json.message != '') {
        if (json.status){
          clanMessage(true, json.message);
        } else {
          clanMessage(false, json.message);
        }
      }

    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
      if (textStatus == 'error'){
        clanMessage(false, 'Multiple requests detected.');
      }
    }
  });
});

$('body').on('click', '.cancel-request', function() {
  var requestId = $(this).data('diplomacy-id');

  $.ajax({
    type: 'POST',
    url: '<?php echo DOMAIN; ?>api/',
    data: { action: 'cancel_diplomacy_request', requestId: requestId },
    success: function(response) {
      console.log(response);
      var json = jQuery.parseJSON(response);

      if (json.message != '') {
        if (json.status){
          clanMessage(true, json.message);
        } else {
          clanMessage(false, json.message);
        }
      }
    }
  });
});

$('body').on('click', '.end-diplomacy', function() {
  var diplomacyId = $(this).data('diplomacy-id');

  $.ajax({
    type: 'POST',
    url: '<?php echo DOMAIN; ?>api/',
    data: { action: 'end_diplomacy', diplomacyId: diplomacyId },
    success: function(response) {
      var json = jQuery.parseJSON(response);

      if (json.status) {
        $('#diplomacy-'+ diplomacyId +'').remove();
      }

      if (json.message != '') {
        toast(json.message);
      }
    }
  });
});

$('body').on('click', '#dropdown3 li a', function() {
  $('#dropdown3').css({display: 'none', opacity: 0});
  $('input[name=keywords]').val($(this).text());
  $('input[name=clanId]').val($(this).data('clan-id'));
});

function denied_request_diplomacy(id) {
    $.ajax({
      type: 'POST',
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'decline_diplomacy_request', requestId: id },
      success: function(response) {
        var json = jQuery.parseJSON(response);

        if (json.message != '') {
          if (json.status){
            clanMessage(true, json.message);
          } else {
            clanMessage(false, json.message);
          }
        }

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        if (textStatus == 'error'){
          clanMessage(false, 'Multiple requests detected.');
        }
      }
    });
};

function accept_request_diplomacy(id) {
    $.ajax({
      type: 'POST',
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'accept_diplomacy_request', requestId: id },
      success: function(response) {
        var json = jQuery.parseJSON(response);

        if (json.message != '') {
          if (json.status){
            clanMessage(true, json.message);
          } else {
            clanMessage(false, json.message);
          }
        }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        if (textStatus == 'error'){
          clanMessage(false, 'Multiple requests detected.');
        }
      }
    });
};

$('#formAbotDiplomacy').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      type: 'POST',
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=end_war_request',
      success: function(response) {
        console.log(response);
        var json = jQuery.parseJSON(response);

        if (json.message != '') {
          if (json.status){
            message(true, json.message);
          } else {
            message(false, json.message);
          }
        }

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        if (textStatus == 'error'){
          message(false, 'Multiple requests detected.');
        }
      }
    });
});

function end_diplomacy(clanId){
    $.ajax({
      type: 'POST',
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'end_war_request', clanId: clanId },
      success: function(response) {
        var json = jQuery.parseJSON(response);

        if (json.request) {
          $('#open_applications_button').css({display: 'inline-block'});

          $('#pending-requests tbody').append('
            <tr id="pending-request-'+ json.request.id +'">
              <td>'+ json.request.date +'</td>
              <td>'+ json.request.clan.name +'</td>
              <td>'+ json.request.form +'</td>
              <td>Waiting...</td>
              <td><button data-request-id="'+ json.request.id +'" class="cancel-request btn grey darken-1 waves-effect waves-light col s12">CANCEL</button></td>
            </tr>');
        }

        if (json.message != '') {
          toast(json.message);
        }
      }
    });
};










</script>
<?php } ?>

<?php if (Functions::IsLoggedIn() && isset($page[1], $clan) && $page[1] === 'baseClan' && $clan !== NULL) { ?>
<script type="text/javascript">

$('#base-request').submit(function(e) {
  e.preventDefault();

  var form = $(this);

  $.ajax({
    url: '<?php echo DOMAIN; ?>api/',
    data: form.serialize() + '&action=request_base',
    type: 'POST',
    success:function(response) {
      console.log(response);
      var json = jQuery.parseJSON(response);

      if (json.message != '') {
        if (json.status){
          toast(json.message);
        } else {
          toast(json.message);
        }
      }

    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
      if (textStatus == 'error'){
        tiast('Multiple requests detected.');
      }
    }
  });
});

</script>
<?php } ?>


<?php if (Functions::IsLoggedIn() && isset($page[0]) && ($page[0] === 'settings' || $page[0] == 'newPassword')) { ?>
<script type="text/javascript">

$('#change_pet_name').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=change_pet_name',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);

        for (var input in json.inputs) {
          $('#change_pet_name input[name='+input+'] + label + span').attr('data-error', json.inputs[input].error);
          $('#change_pet_name input[name='+input+']').removeClass('valid invalid');
          $('#change_pet_name input[name='+input+']').addClass(json.inputs[input].validate);
        }

        if (json.message != '') {
          toast(json.message);
        }
      }
    });
  });

  $('#change_password').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=change_password',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);

        for (var input in json.inputs) {
          $('#change_password input[name='+input+'] + label + span').attr('data-error', json.inputs[input].error);
          $('#change_password input[name='+input+']').removeClass('valid invalid');
          $('#change_password input[name='+input+']').addClass(json.inputs[input].validate);
        }

        if (json.message != '') {
          toast(json.message);
        }
      }
    });
  });

  $('#recover_change_password').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=recover_change_password',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);

        if (json.message != '') {
          toast(json.message);
        }

        if (json.status){
          setTimeout(() => {
            location.reload();
          }, 3000);
        }

      }
    });
  });

  $('#change_profile_url').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=change_profile_url',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);

        for (var input in json.inputs) {
          $('#change_profile_url input[name='+input+'] + label + span').attr('data-error', json.inputs[input].error);
          $('#change_profile_url input[name='+input+']').removeClass('valid invalid');
          $('#change_profile_url input[name='+input+']').addClass(json.inputs[input].validate);
        }

        if (json.message != '') {
          toast(json.message);
        }
      }
    });
  });

  $('#change_pilot_name').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=change_pilot_name',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);

        for (var input in json.inputs) {
          $('#change_pilot_name input[name='+input+'] + label + span').attr('data-error', json.inputs[input].error);
          $('#change_pilot_name input[name='+input+']').removeClass('valid invalid');
          $('#change_pilot_name input[name='+input+']').addClass(json.inputs[input].validate);
        }

        if (json.message != '') {
          toast(json.message);
        }
      }
    });
  });
  



  $('input[name=version]').change(function() {
    var version = $(this).prop('checked');
    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'change_version', version: version },
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);

        if (json.message != '') {
          toast(json.message);
        }
      }
    });
  });
</script>
<?php } ?>

<?php if (Functions::IsLoggedIn() && isset($page[1]) && $page[1] === 'join') { ?>
<script type="text/javascript">
  $('#found_clan').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=found_clan',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);

        if (json.status) {
          location.reload();
        } else if (json.message != '') {
          toast(json.message);
        }

      }
    });
  });
</script>
<?php } ?>

<?php if (Functions::IsLoggedIn() && isset($page[1]) && $page[1] === 'company') { ?>
<script type="text/javascript">
  var currentFactionCode = "";
  var currentFactionName = "%faction_name%";

  $('.company').click(function() {
    var factionCode = $(this).data('faction-id');

    document.getElementById('modal').style.display = 'block';

    if (currentFactionCode != factionCode) {
      var factionName = $(this).data('faction-name');

      $('#modal h6').text($('#modal h6').text().replace(currentFactionName, factionName));

      currentFactionCode = factionCode;
      currentFactionName = factionName;
    }
  });

  $('#confirm-company-change').click(function() {
    if (currentFactionCode != "") {
      $.ajax({
        type: 'POST',
        url: '<?php echo DOMAIN; ?>api/',
        data: { action: 'company_select', factionId: currentFactionCode },
        success: function(response) {
          var json = jQuery.parseJSON(response);

          if (json.status) {
            location.reload();
          } else if (json.message != '') {
            toast(json.message);
          }
        }
      });
    }
  });
</script>
<?php } ?>

<?php if (Functions::IsLoggedIn() && isset($page[1], $clan) && $page[1] === 'informations' && $clan !== NULL) { ?>

<script type="text/javascript">
  $('#formNewMessageClan').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=send_clan_message',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);
        
        if (json.message !== ""){
          if (json.status){
            messageNews(true, json.message);
          } else {
            messageNews(false, json.message);
          }
        }

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        if (textStatus == 'error'){
          messageNews(false, 'Multiple requests detected.');
        }
      }
    });
  });
</script>

<script type="text/javascript">
function viewModalinfoedit(id){
	document.getElementById('clan-edit-infos').setAttribute('style', 'display:block;');
}
</script>

<script type="text/javascript">
function message(error, message){
  $("#clan-edit-infos").css("display", "block");
  $('#infos-loader').css('display', 'block');
  if(error == false){
    $('#infos-loader').html('<div style="margin-top:120px;"></div> \
      <center> \
        <i style="font-size:64px;" class="fa fa-times fg-red"></i><br/> \
        <span style="font-size:32px;">' + message + '</span><br/> \
        <a class="btn btn-primary" onclick="$(\'#infos-loader\').css(\'display\', \'none\'); $(\'#infos\').css(\'display\', \'none\'); current_view_id=0;">Ok</a> \
      </center>');
  } else {
    $('#infos-loader').html('<div style="margin-top:130px;"></div> \
      <center> \
        <i style="font-size:64px;" class="fa fa-check fg-green"></i><br/> \
        <span style="font-size:32px;">' + message + '</span><br/> \
        <a class="btn btn-primary" onclick="$(\'#infos-loader\').css(\'display\', \'none\'); $(\'#infos\').css(\'display\', \'none\'); current_view_id=0;">Ok</a> \
      </center>');
  }	
}

function messageNews(error, message){
  $("#clan-add-news").css("display", "block");
  $('#infos-loader-clan').css('display', 'block');
  if(error == false){
    $('#infos-loader-clan').html('<div style="margin-top:30px;"></div> \
      <center> \
        <i style="font-size:64px;" class="fa fa-times fg-red"></i><br/> \
        <span style="font-size:32px;">' + message + '</span><br/> \
        <a class="btn btn-primary" onclick="$(\'#infos-loader-clan\').css(\'display\', \'none\'); $(\'#infos\').css(\'display\', \'none\'); current_view_id=0;">Ok</a> \
      </center>');
  } else {
    $('#infos-loader-clan').html('<div style="margin-top:30px;"></div> \
      <center> \
        <i style="font-size:64px;" class="fa fa-check fg-green"></i><br/> \
        <span style="font-size:32px;">' + message + '</span><br/> \
        <a class="btn btn-primary" onclick="$(\'#infos-loader-clan\').css(\'display\', \'none\'); $(\'#infos\').css(\'display\', \'none\'); current_view_id=0;">Ok</a> \
      </center>');
  }	
}
</script>

<script type="text/javascript">
  $('#change_clan_settings').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=change_clan_settings',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);
        
        if (json.message !== ""){
          if (json.status){
            message(true, json.message);
          } else {
            message(false, json.message);
          }
        }

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        if (textStatus == 'error'){
          message(false, 'Multiple requests detected.');
        }
      }
    });
  });
</script>

  <script type="text/javascript">
  $('#change_tag_name').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=change_tag_name',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);

        for (var input in json.inputs) {
          $('#change_tag_name input[name='+input+'] + label + span').attr('data-error', json.inputs[input].error);
          $('#change_tag_name input[name='+input+']').removeClass('valid invalid');
          $('#change_tag_name input[name='+input+']').addClass(json.inputs[input].validate);
        }

        if (json.message != '') {
          toast(json.message);
        }
      }
    });
  });

  $('#change_name_clan').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=change_name_clan',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);

        for (var input in json.inputs) {
          $('#change_name_clan input[name='+input+'] + label + span').attr('data-error', json.inputs[input].error);
          $('#change_name_clan input[name='+input+']').removeClass('valid invalid');
          $('#change_name_clan input[name='+input+']').addClass(json.inputs[input].validate);
        }

        if (json.message != '') {
          toast(json.message);
        }
      }
    });
  });

  </script>
  <?php } ?>

  <?php if (Functions::IsLoggedIn() && isset($page[1], $clan) && $page[1] === 'bank' && $clan !== NULL) { ?>

<script type="text/javascript">

  function bankMessage(error, message){
    $("#bank-message").css("display", "block");
    $('#infosBankMessage').css('display', 'block');
    if(error == false){
      $('#infosBankMessage').html('<div style="margin-top:-6px;"></div> \
        <center> \
          <i style="font-size:64px;" class="fa fa-times fg-red"></i><br/> \
          <span style="font-size:16px;">' + message + '</span><br/> \
        </center>');
    } else {
      $('#infosBankMessage').html('<div style="margin-top:-6px;"></div> \
        <center> \
          <i style="font-size:64px;" class="fa fa-check fg-green"></i><br/> \
          <span style="font-size:16px;">' + message + '</span><br/> \
        </center>');
    }	
  }

  $('#formSendCredits').submit(function(e) {
    e.preventDefault();

    var form = $(this);
    $('.creditssend-window').css('display', 'none');

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=send_bank_credits',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);
        
        if (json.message !== ""){
          if (json.status){
            bankMessage(true, json.message);
          } else {
            bankMessage(false, json.message);
          }
        }

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        if (textStatus == 'error'){
          bankMessage(false, 'Multiple requests detected.');
        }
      }
    });
  });

  $('#formSendUridium').submit(function(e) {
    e.preventDefault();

    var form = $(this);
    $('.uridiumsend-window').css('display', 'none');

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=send_bank_uridium',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);
        
        if (json.message !== ""){
          if (json.status){
            bankMessage(true, json.message);
          } else {
            bankMessage(false, json.message);
          }
        }

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        if (textStatus == 'error'){
          bankMessage(false, 'Multiple requests detected.');
        }
      }
    });
  });

  $('#formCreditsTax').submit(function(e) {
    e.preventDefault();

    var form = $(this);
    $('.creditstax-window').css('display', 'none');

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=change_credits_tax',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);
        
        if (json.message !== ""){
          if (json.status){
            bankMessage(true, json.message);
          } else {
            bankMessage(false, json.message);
          }
        }

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        if (textStatus == 'error'){
          bankMessage(false, 'Multiple requests detected.');
        }
      }
    });
  });

  $('#formUridiumTax').submit(function(e) {
    e.preventDefault();

    var form = $(this);
    $('.uridiumtax-window').css('display', 'none');

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=change_uridium_tax',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);
        
        if (json.message !== ""){
          if (json.status){
            bankMessage(true, json.message);
          } else {
            bankMessage(false, json.message);
          }
        }

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        if (textStatus == 'error'){
          bankMessage(false, 'Multiple requests detected.');
        }
      }
    });
  });
</script>

<?php } ?>

<?php if (Functions::IsLoggedIn() && isset($page[1], $clan) && $page[1] === 'members' && $clan !== NULL) { ?>

  <script type='text/javascript'>

  function messageDeleteMember(error, message){
    $("#member-delete").css("display", "block");
    $('#infos-loader-clan2').css('display', 'block');
    if(error == false){
      $('#infos-loader-clan2').html('<div style="margin-top:-8px;"></div> \
        <center> \
          <i style="font-size:64px;" class="fa fa-times fg-red"></i><br/> \
          <span style="font-size:32px;">' + message + '</span><br/> \
          <a class="btn btn-primary" onclick="$(\'#infos-loader-clan2\').css(\'display\', \'none\'); $(\'#infos\').css(\'display\', \'none\'); current_view_id=0;">Ok</a> \
        </center>');
    } else {
      $('#infos-loader-clan2').html('<div style="margin-top:-8px;"></div> \
        <center> \
          <i style="font-size:64px;" class="fa fa-check fg-green"></i><br/> \
          <span style="font-size:32px;">' + message + '</span><br/> \
          <a class="btn btn-primary" onclick="$(\'#infos-loader-clan2\').css(\'display\', \'none\'); $(\'#infos\').css(\'display\', \'none\'); current_view_id=0;">Ok</a> \
        </center>');
    }	
  }

  function messageDeleteClan(error, message){
    $("#clan-delete").css("display", "block");
    $('#infos-loader-clan').css('display', 'block');
    if(error == false){
      $('#infos-loader-clan').html('<div style="margin-top:-8px;"></div> \
        <center> \
          <i style="font-size:64px;" class="fa fa-times fg-red"></i><br/> \
          <span style="font-size:32px;">' + message + '</span><br/> \
          <a class="btn btn-primary" onclick="$(\'#infos-loader-clan\').css(\'display\', \'none\'); $(\'#infos\').css(\'display\', \'none\'); current_view_id=0;">Ok</a> \
        </center>');
    } else {
      $('#infos-loader-clan').html('<div style="margin-top:-8px;"></div> \
        <center> \
          <i style="font-size:64px;" class="fa fa-check fg-green"></i><br/> \
          <span style="font-size:32px;">' + message + '</span><br/> \
          <a class="btn btn-primary" onclick="$(\'#infos-loader-clan\').css(\'display\', \'none\'); $(\'#infos\').css(\'display\', \'none\'); current_view_id=0;">Ok</a> \
        </center>');
    }	
  }

  function message(error, message){
    $("#clan-resign").css("display", "block");
    $('#infos-loader').css('display', 'block');
    if(error == false){
      $('#infos-loader').html('<div style="margin-top:-8px;"></div> \
        <center> \
          <i style="font-size:64px;" class="fa fa-times fg-red"></i><br/> \
          <span style="font-size:32px;">' + message + '</span><br/> \
          <a class="btn btn-primary" onclick="$(\'#infos-loader\').css(\'display\', \'none\'); $(\'#infos\').css(\'display\', \'none\'); current_view_id=0;">Ok</a> \
        </center>');
    } else {
      $('#infos-loader').html('<div style="margin-top:-8px;"></div> \
        <center> \
          <i style="font-size:64px;" class="fa fa-check fg-green"></i><br/> \
          <span style="font-size:32px;">' + message + '</span><br/> \
          <a class="btn btn-primary" onclick="$(\'#infos-loader\').css(\'display\', \'none\'); $(\'#infos\').css(\'display\', \'none\'); current_view_id=0;">Ok</a> \
        </center>');
    }	
  }

  $('#formNewLeaderClan').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=change_clan_leader',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);
        
        if (json.message !== ""){
          if (json.status){
            message(true, json.message);
          } else {
            message(false, json.message);
          }
        }

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        if (textStatus == 'error'){
          message(false, 'Multiple requests detected.');
        }
      }
    });
  });

  $('#formDeleteClan').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=delete_clan',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);
        
        if (json.message !== ""){
          if (json.status){
            messageDeleteClan(true, json.message);
          } else {
            messageDeleteClan(false, json.message);
          }
        }

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        if (textStatus == 'error'){
          messageDeleteClan(false, 'Multiple requests detected.');
        }
      }
    });
  });

  $('#formDeleteMember').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: form.serialize() + '&action=dismiss_clan_member',
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);
        
        if (json.message !== ""){
          if (json.status){
            messageDeleteMember(true, json.message);
          } else {
            messageDeleteMember(false, json.message);
          }
        }

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        if (textStatus == 'error'){
          messageDeleteMember(false, 'Multiple requests detected.');
        }
      }
    });
  });
  
  function deleteMemberClan(id) {
    if (id != 0) {
        $.ajax({
          type: 'POST',
          url: '<?php echo DOMAIN; ?>api/',
          data: { action: 'decline_clan_application', userId: id },
          success: function(response) {
            var json = jQuery.parseJSON(response);

            if (json.status) {
        document.getElementById('application-user-'+id).innerHTML = "<div style=\"text-align: center\">Application denied.</div>";
            }

            if (json.message) {
              toast(json.message);
            }
          }
        });
      }
    }
  
  function aceptMemberClan(id){
    if (id != 0) {
        $.ajax({
          type: 'POST',
          url: '<?php echo DOMAIN; ?>api/',
          data: { action: 'accept_clan_application', userId: id },
          success: function(response) {
            var json = jQuery.parseJSON(response);

            if (json.status) {
        document.getElementById('application-user-'+id).innerHTML = "<div style=\"text-align: center\">Application accepted.</div>";
            }

            if (json.message) {
              toast(json.message);
            }
          }
        });
      }
    }
  </script>
   
<?php if ($clan['leaderId'] == $player['userId']) { ?>

  <script type='text/javascript'>
  $('#confirm-delete-clan').click(function() {
    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'delete_clan' },
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);

        if (json.status) {
          location.reload();
        } else if (json.message != '') {
          toast(json.message);
        }
      }
    });
  });
</script>
  <?php } else { ?>
  <script type='text/javascript'>
  $('#confirm-leave-clan').click(function() {
    $.ajax({
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'leave_clan' },
      type: 'POST',
      success:function(response) {
        var json = jQuery.parseJSON(response);

        if (json.status) {
          location.reload();
        } else if (json.message != '') {
          toast(json.message);
        }
      }
    });
  });

  <?php } ?>
</script>

<?php } ?>


<?php if (Functions::IsLoggedIn() && isset($page[0]) && $page[0] === 'equipment') { ?>
  <script type="text/javascript" src="<?php echo DOMAIN; ?>js/darkorbit/jquery.flashembed.js"></script>
  <script type='text/javascript'>
      function onFailFlashembed() {
        var html = '';

        html += '<div id="flashFail">';
        html += '<div class="flashFailHead">Get the Adobe Flash Player</div>';
        html += '<div class="flashFailHeadText">';
        html += 'In order to play <?php echo SERVER_NAME; ?>, you need the latest version of Flash Player. Just install it to start playing!';
        html += '<div class="flashFailHeadLink">';
        html += 'Download the Flash Player here for free: <a href=\"http://www.adobe.com/go/getflashplayer\" style=\"text-decoration: underline; color:#A0A0A0;\">Download Flash Player<\/a>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        jQuery('#equipment_container').html(html);
      }

      function expressInstallCallback(info) {
        onFailFlashembed();
      }

      jQuery(document).ready(
          function(){
              flashembed("equipment_container", {
                "onFail": onFailFlashembed,
                "src": "<?php echo DOMAIN; ?>swf_global/inventory/inventory.swf?<?= rand(0,999999); ?>",
                "version": [10,0],
                "expressInstall": "<?php echo DOMAIN; ?>swf_global/expressInstall.swf",
                "onFail": function(){ onFailFlashembed(); },
                "width": 770,
                "height": 395,
                "id": "inventory",
                "wmode": "transparent"
              },
              {"": "<?php echo DOMAIN; ?>",
              "nosid": "1",
              "navPoint": "2",
              "eventItemEnabled": "",
              "supporturl": "",
              "serverdesc": "",
              "server_code": "1",
              "jackpot": "0 EUR",
              "uridium_highlighted": "",
              "lang": "en",
              "sid": "<?php echo $player['sessionId']; ?>",
              "locale_hash": "",
              "dynamicHost": "<?php echo $_SERVER['SERVER_NAME']; ?>",
              "menu_layout_config_hash": "",
              "assets_config_hash": "",
              "items_config_hash": "",
              "useDeviceFonts": "0"});
          }
      );
  </script>
<?php } ?>
<?php if (Functions::IsLoggedIn() && $page[0] === 'ships') { ?>
<script type="text/javascript">
  $('.useNave').click(function() {
    var ship = $(this).attr('id');

    $.ajax({
      type: 'POST',
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'change_ship', ship: ship },
      success: function(response) {
        var json = jQuery.parseJSON(response);

        if (json.status) {
          $(location).attr('href', "/equipment");
        } else if (json.message != '') {
          toast(json.message);
        }
      }
    });
  });
</script>
<script type="text/javascript">
  $('.info_ship').click(function() {
    var ship = $(this).attr('id');

    $.ajax({
      type: 'POST',
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'info_ship', ship: ship },
      success: function(response) {
        var json = jQuery.parseJSON(response);

        if (json.name) {
		  document.getElementById('shipPreviewImage').src = "<?php echo DOMAIN; ?>do_img/global/items/ship/"+json.name+"_top.png";
          $('.ship-name').html(json.name);
		  $('.ship-hp').html(json.health);
		  $('.ship-lasers').html(json.lasers);
		  $('.ship-generators').html(json.generatos);
		  $('.ship-damage').html(json.damage);
		  $('.ship-speed').html(json.speed);
		  $('.useNave').attr("id", json.shipID);
        } else if (json.message != '') {
          toast(json.message);
        }
      }
    });
  });
</script>

<?php } ?>

<?php if (Functions::IsLoggedIn() && $page[0] === 'labor') { ?>

<script type="text/javascript">

function buildDroneMessage(error, message){
  $("#buildDrone-message").css("display", "block");
  $('.loader').css('display', 'block');
  if(error == false){
    $('.content').html('<div style="margin-top:-6px;"></div> \
      <center> \
        <i style="font-size:64px;" class="fa fa-exclamation-triangle fg-red"></i><br/> \
        <span style="font-size:20px;">' + message + '</span><br/> \
        <br><a class="btn btn-default" onclick="$(\'.loader\').css(\'display\',\'none\')">OK</a> \
      </center>');
  } else {
    $('.content').html('<div style="margin-top:-6px;"></div> \
      <center> \
        <i style="font-size:64px;" class="fa fa-check fg-green"></i><br/> \
        <span style="font-size:20px;">' + message + '</span><br/> \
        <br><a class="btn btn-default" onclick="$(\'.loader\').css(\'display\',\'none\')">OK</a> \
      </center>');
  }	
}

$('.buildDrone').click(function() {

  $.ajax({
    type: 'POST',
    url: '<?php echo DOMAIN; ?>api/',
    data: { action: 'buildDrone', drone: $(this).data('drone') },
    success: function(response) {
      var json = jQuery.parseJSON(response);

      if (json.message !== ""){
        if (json.status){
          buildDroneMessage(true, json.message);
        } else {
          buildDroneMessage(false, json.message);
        }
      }

      if (json.uridium){
        document.getElementsByClassName('user-uridium')[0].innerHTML = json.uridium;
      }

    }

  });

});

</script>

<?php } ?>

<?php if (Functions::IsLoggedIn() && $page[0] === 'UpgradeSystem') { ?>

<script type="text/javascript">

function selectTab(id){
  var d = document.getElementsByClassName("upgradeableItemsContainer");
  for (i = 0; i < d.length; i++) { d[i].style.display = "none"; }
  document.getElementById(id).style.display = "block";
}

function selectItem(idItem){
  if (idItem !== ""){

    var dataChance = $('#chanceInfo').data('chance');

    $.ajax({
    type: 'POST',
    url: '<?php echo DOMAIN; ?>api/',
    data: { action: 'selectItemUpgradeSystem', idItem: idItem, dataChance: dataChance },
    success: function(response) {

      var json = jQuery.parseJSON(response);

      if (json.image != ""){
        document.getElementById("itemPreviewImage").src = json.image;
      }

      if (json.name != ""){
        document.getElementById("itemPreviewName").innerHTML = json.name;
      }

      if (json.costUridium != ""){
        document.getElementById("costsInfo").innerHTML = json.costUridium+" U.";
      }

      if (json.lvl != "" && json.lvlTo != ""){
        document.getElementById("itemPreviewUpgradeTo").innerHTML = "Lvl: "+json.lvl+" → "+json.lvlTo;
      }

      document.getElementsByClassName("decreaseButton")[0].setAttribute( "onClick", "Chance("+idItem+",  \"decrease\");" );
      document.getElementsByClassName("increaseButton")[0].setAttribute( "onClick", "Chance("+idItem+",  \"increase\");" );
      document.getElementById("upgradeButton").setAttribute( "onClick", "upgrade("+idItem+");" );

      }

    });
  }
}

function Chance(idItem, actionChance){

  if (idItem !== "" && actionChance !== ""){

    var dataChance = $('#chanceInfo').data('chance');

    $.ajax({
    type: 'POST',
    url: '<?php echo DOMAIN; ?>api/',
    data: { action: 'ChanceItem', idItem: idItem, actionChance: actionChance, dataChance: dataChance },
    success: function(response) {

      var json = jQuery.parseJSON(response);

      if (json.status){

        if (json.cnt !== ""){
          $('#chanceInfo').data('chance', json.cnt);
          document.getElementById("chanceInfo").innerHTML = json.cnt+" %";
          document.getElementById("itemPreviewUpgradeChance").value = json.cnt+" %";
        }

        if (json.costUridium != ""){
          document.getElementById("costsInfo").innerHTML = json.costUridium+" U.";
        }

      } else {
        toast("Select a item.");
      }

      }

    });

  }
}

function upgrade(idItem){

  var dataChance = $('#chanceInfo').data('chance');

  if (idItem !== ""){

    $.ajax({
    type: 'POST',
    url: '<?php echo DOMAIN; ?>api/',
    data: { action: 'upgradeItem', idItem: idItem, dataChance: dataChance },
    success: function(response) {

      var json = jQuery.parseJSON(response);

      if (json.status){
        document.getElementById("ItemT_"+idItem).remove();
        var myimg = document.getElementById('upgradingItems');
        var div = '<div class="item fadeInLeft animated" id="UitemId_'+json.id+'" onclick="finish('+json.id+');"><div class="img"><img src="'+json.image+'"></div><div class="name">'+json.name+'</div><div class="lvlToUpgrade">'+json.lvl+' → '+json.new_lvl+'</div><div class="progress2" id="PitemId_'+json.id+'" data-id="'+json.id+'"><progress max="100" value="'+json.progressBar+'"></progress></div></div>';
        myimg.insertAdjacentHTML("afterend", div);

        if (json.uridium!= ""){
          document.getElementsByClassName("user-uridium")[0].innerHTML = json.uridium;
        }

      } else {
        if (json.message != ""){
          toast(json.message);
        } else {
          toast("Select a item.");
        }
      }

    }

    });

  }

}

function finish(id){

  if (id != ""){

    $.ajax({
      type: 'POST',
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'finishUpgrade', idItem: id },
      success: function(response) {
        var json = jQuery.parseJSON(response);
        var lvl = 0;
        
        if (json.lvl != ""){
          lvl = json.lvl;
        }
       
        if (json.message != ""){
          toast(json.message);

          return;
        }

        if (json.winner == true){
          document.getElementById("UitemId_"+id).classList.remove("finished");
          document.getElementById("UitemId_"+id).classList.add("success");

          $("#UitemId_"+id).fadeOut( "slow", function() {
            $(this).remove();
          });

          if (json.new_lvl != ""){
            lvl = json.new_lvl;
          }

        } else {
          document.getElementById("UitemId_"+id).classList.remove("finished");
          document.getElementById("UitemId_"+id).classList.remove("fadeInLeft");
          document.getElementById("UitemId_"+id).classList.add("failed");
          
          $("#UitemId_"+id).fadeOut( "slow", function() {
            $(this).remove();
          });

        }

        if (json.itemId != ""){
          var myimg = document.getElementById(''+json.cat+'');
          var div = '<div class="item" id="ItemT_'+json.itemId+'" onclick="selectItem('+json.itemId+');"><div class="img"><img src="'+json.img+'"></div><div class="name">'+json.name+'</div><div class="level" id="level_'+json.itemId+'">Level '+lvl+'</div></div>';
          $('#'+json.cat).append(div);
        }

      }

    });

  }

}

function getProgressBar(id){

  if (id != ""){

    var progressBar;

    $.ajax({
      type: 'POST',
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'checkProgressBar', idItem: id },
      success: function(response) {
        var json = jQuery.parseJSON(response);

        if (json.progressBar){
          progressBar = json.progressBar;
        } else {
          progressBar = 0;
        }

        if (progressBar >= 100){
          document.getElementById("UitemId_"+id).classList.add("finished");
        }

        document.getElementById("PitemId_"+id).innerHTML = '<progress max="100" value="'+progressBar+'"></progress>';
      }
  });

  }
}

function finishAll(){
  $.ajax({
      type: 'POST',
      url: '<?php echo DOMAIN; ?>api/',
      data: { action: 'finishAll' },
      success: function(response) {
        var json = JSON.parse(response);

        for (i=0; i < json.length; i++){

          var lvl = 0;

          if (json[i].lvl != ""){
            lvl = json[i].lvl;
          }

          if (json[i].winner == true){
            document.getElementById("UitemId_"+json[i].id).classList.remove("finished");
            document.getElementById("UitemId_"+json[i].id).classList.add("success");

            $("#UitemId_"+json[i].id).fadeOut( "slow", function() {
              $(this).remove();
            });

            if (json[i].new_lvl != ""){
              lvl = json[i].new_lvl;
            }

          } else {
            document.getElementById("UitemId_"+json[i].id).classList.remove("finished");
            document.getElementById("UitemId_"+json[i].id).classList.remove("fadeInLeft");
            document.getElementById("UitemId_"+json[i].id).classList.add("failed");
            
            $("#UitemId_"+json[i].id).fadeOut( "slow", function() {
              $(this).remove();
            });

          }

          if (json[i].itemId != ""){
            var myimg = document.getElementById(''+json[i].cat+'');
            var div = '<div class="item" id="ItemT_'+json[i].itemId+'" onclick="selectItem('+json[i].itemId+');"><div class="img"><img src="'+json[i].img+'"></div><div class="name">'+json[i].name+'</div><div class="level" id="level_'+json[i].itemId+'">Level '+lvl+'</div></div>';
            $('#'+json[i].cat).append(div);
          }

        }

      }
  });
}

function checkProgressUpgrades(){
  var d = document.getElementsByClassName("progress2");
  for (i = 0; i < d.length; i++) { 
    var id = d[i].getAttribute('data-id');
    getProgressBar(id);
  }
}

function onLoad(){
  setInterval(() => {
    checkProgressUpgrades();
  }, 5000);
}

window.onload = onLoad;

</script>

<?php } ?>

<?php if (Functions::IsLoggedIn() && isset($page[0]) && $page[0] === 'Titles') { ?>
<script type="text/javascript">

function saveTitle(){

  $.ajax({
    type: 'POST',
    url: '<?php echo DOMAIN; ?>api/',
    data: { action: 'saveTitle', title: $('#title').val() },
    success: function(response) {
      var json = jQuery.parseJSON(response);

      if (json.message != ""){
        document.getElementById("message").style.display = "block";
        document.getElementById("message").innerHTML = json.message;
      }

      if (json.status){
        document.getElementById("message").style = "text-align:center; border: 1px dashed green; padding:15px; margin:auto; width:50%; margin-top:15px;";
      } else {
        document.getElementById("message").style = "text-align:center; border: 1px dashed red; padding:15px; margin:auto; width:50%; margin-top:15px;";
      }     

    }

  });

};

function buyTitle(){

$.ajax({
  type: 'POST',
  url: '<?php echo DOMAIN; ?>api/',
  data: { action: 'buyTitle', title: $('#title_name').val() },
  success: function(response) {
    console.log(response);
    var json = jQuery.parseJSON(response);
    console.log(json);

    if (json.message != ""){
      document.getElementById("messageB").style.display = "block";
      document.getElementById("messageB").innerHTML = json.message;
    }

    if (json.ec != ""){
      document.getElementsByClassName("user-fraktal")[0].innerHTML = json.ec;
    }

    if (json.status){
      document.getElementById("messageB").style = "text-align:center; border: 1px dashed green; padding:15px; margin:auto; width:50%; margin-top:15px;";
    } else {
      document.getElementById("messageB").style = "text-align:center; border: 1px dashed red; padding:15px; margin:auto; width:50%; margin-top:15px;";
    }

  }

});

};
</script>

<?php } ?>


</body>
</html>



[end of files/external/includes/footer.php]
