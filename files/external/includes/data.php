
<div class="top-bar" style="display:flex; align-items: center; justify-content: space-evenly">
<div  id="panelPrecios">

</div>






<div  id="panelPrecios">
<div class="uridium" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Event Coint" data-original-title="Event Coint">
<b>E.C</b> <span id="event-coin" class="user-fraktal" class="button"><?php

                        $search_event_coins = $mysqli->query("SELECT * FROM event_coins WHERE userId = " . $player['userId'] . ";");
                        if (mysqli_num_rows($search_event_coins) > 0) {
                          $current_coins = $search_event_coins->fetch_assoc();
                          echo number_format($current_coins['coins'], 0, ',', '.');
                        } else {
                          echo "0";
                        }
                        ?></span>
						
</div></div>
<style>
  .credits{
    margin-right: 10px;
  }

  #credit,
  #uridium,
  #experience,
  #honor,
  #event-coin{
    position:relative;
    left: 10px;
    color:#F1C232;
  }

</style>

<div  id="panelPrecios">
<div class="credits" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Credits" data-original-title="Credits">
<b>Credit:</b><span id="credit" class="user-credits" class="button"><?php echo number_format($data->credits, 0, ',', '.'); ?></span>
</div></div>

<div  id="panelPrecios">
<div class="credits" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Uridium" data-original-title="Uridium">
<b>Uridium:</b><span id="uridium" class="user-uridium" class="button"><?php echo number_format($data->uridium, 0, ',', '.'); ?></span>

</div></div>

<div  id="panelPrecios">
<div class="credits" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Experience" data-original-title="Experience">
<b>Experience:</b><span id="experience" class="user-experience" class="button"><?php echo number_format($data->experience, 0, ',', '.'); ?></span>
</div></div>

<div  id="panelPrecios">
<div class="credits" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Honor" data-original-title="Honor">
<b>Honor:</b><span id="honor" class="user-honor" class="button"><?php echo number_format($data->honor, 0, ',', '.'); ?></span>
</div></div>



</div>