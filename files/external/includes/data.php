
<div class="top-bar" style="display:flex; align-items: center; justify-content: space-evenly">
<div  id="panelPrecios">

</div>






<div  id="panelPrecios">
<div class="uridium" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Event Coint" data-original-title="Event Coint">
<b>E.C</b> <span id="event-coin" class="user-fraktal" class="button"><?php
                        $event_coins_display = "0";
                        if (isset($player['userId'])) {
                            $stmt_event_coins = $mysqli->prepare("SELECT coins FROM event_coins WHERE userId = ?");
                            $stmt_event_coins->bind_param("i", $player['userId']);
                            $stmt_event_coins->execute();
                            $event_coins_result = $stmt_event_coins->get_result();
                            if ($current_coins_data = $event_coins_result->fetch_assoc()) {
                                $event_coins_display = number_format($current_coins_data['coins'], 0, ',', '.');
                            }
                            $stmt_event_coins->close();
                        }
                        echo $event_coins_display;
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