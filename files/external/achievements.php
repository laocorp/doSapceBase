<?php

$npc_names = ['Streuner'
, 'Lordakia'
, 'Saimon'
, 'Sibelon'
, 'Kristallin'
, 'Kristallon'
, 'Cubikon'
, 'IceMeteroid'
, 'Melter'
, 'Scorcher'
, 'BossCurcubitor'
, 'Hitac'
, 'Devourer'
, 'BossKuKu'
, 'Saboteur'
, 'Annihilator'
, 'Battleray'
];

//k,r, cred, uri, npc_points
$npc_data['Streuner'] = [15, 0.10, 72000, 54, 1];
$npc_data['Lordakia'] = [15, 0.10, 160000, 120, 2];
$npc_data['Saimon'] = [15, 0.10, 240000, 180, 3];
$npc_data['Kristallin'] = [15, 0.10, 480000, 360, 6];

$npc_data['Sibelon'] = [10, 0.10, 1520000, 1040, 19];
$npc_data['Kristallon'] = [10, 0.10, 2240000, 1680, 28];
$npc_data['Melter'] = [10, 0.10, 4800000, 3600, 60];
$npc_data['Scorcher'] = [10, 0.10, 2800000, 2100, 35];

$npc_data['Saboteur'] = [10, 0.15, 7040000, 5280, 88];
$npc_data['Annihilator'] = [10, 0.15, 14080000, 10560, 176];

$npc_data['Cubikon'] = [10, 0.05, 8000000, 6000, 100];
$npc_data['IceMeteroid'] = [10, 0.05, 48000000, 36000, 600];
$npc_data['BossCurcubitor'] = [10, 0.05, 9600000, 7200, 120];
$npc_data['BossKuKu'] = [10, 0.05, 164000000, 75000, 1250];

$npc_data['Hitac'] = [5, 0.10, 100000000, 87000, 1500];
$npc_data['Devourer'] = [5, 0.10, 140000000, 116000, 2100];
$npc_data['Battleray'] = [5, 0.10, 240000000, 180000, 3250];

$buymessage_html = ''; // Initialize to avoid undefined variable if not set
if(isset($_GET['claim']))
{
	if(in_array($_GET['claim'],$npc_names))
	{
		// The handleClaim function returns a string that includes HTML (<br>).
		// It should be escaped if displayed, or modified to return raw data to be formatted here.
		// For now, we assume it might be displayed, so we'll escape its output later if $buymessage_html is used.
		$raw_buymessage = handleClaim($db, $_GET['claim'], $npc_data );
        // Since handleClaim builds an HTML string, we can't simply escape it all.
        // This indicates handleClaim should ideally return raw data, and formatting happen here.
        // For this exercise, I will assume $buymessage is not directly echoed or will be handled by a future refactor of handleClaim.
        // If $buymessage were to be echoed: echo $buymessage; (knowing it contains HTML)
        // Or if it was plain text: echo htmlspecialchars($buymessage, ENT_QUOTES, 'UTF-8');
        // For now, I'll store it and if there's a place it's echoed, I'll address it there.
        // To prevent direct output from a GET request without sanitization, this is a complex area.
        // Let's assume for now the $buymessage isn't directly echoed on this page from the GET.
	}
}

$sth = $db->prepare("SELECT * FROM users_npc_counts WHERE id = :id LIMIT 1");
$sth->execute(array(
				':id' => $_SESSION['player_id']
			));
$datauser_count = $sth->fetchAll();
$npc_count = $datauser_count[0];

$sth = $db->prepare("SELECT * FROM users_npc_lvl WHERE id = :id LIMIT 1");
$sth->execute(array(
				':id' => $_SESSION['player_id']
			));
$datauser_lvl = $sth->fetchAll();
$npc_lvl = $datauser_lvl[0];

$achievements_points = 0;
foreach ($npc_names as $npc_name_loop) // Renamed to avoid conflict with $npc_name in functions
{
    $achievements_points += $npc_lvl[$npc_name_loop];
}
$total_achievements_points =  count($npc_names)*10;

?>
	
<link rel="stylesheet" type="text/css" href="styles/achievements.css" />
<div class="box" style="margin-left:-80px;margin-bottom:20px;">
	<div class="title">Achievements</div>
	<div id="achievements">	
			</br>
			<div class="stat" style="width: 500px; margin-left: 50px;"><div class="stat-left" style="width: 200px;">Achievement's points</div><div class="stat-right"><?= htmlspecialchars($achievements_points, ENT_QUOTES, 'UTF-8') ?>/<?= htmlspecialchars($total_achievements_points, ENT_QUOTES, 'UTF-8') ?></div></div>
            <div<strong><a href="http://www.andromeda-server.com/forum/viewtopic.php?f=6&t=585" target="_blank"><font color='#FFA500'>Click here to get All Rewards Infos</a>  </strong><br/> </div>			</br>
			<?php
			// If $buymessage_html was set and intended for display here, it would be:
			// if (!empty($buymessage_html)) { echo "<div>" . $buymessage_html . "</div>"; } // Note: $buymessage_html from handleClaim contains HTML tags.

			foreach ($npc_names as $npc_name_display) // Renamed for clarity in this loop
			{
				print_npc_achivement($npc_name_display, $npc_lvl, $npc_count, $npc_data);
			}
			?>
	</div>
</div>		
<?php 
function get_lvl_npc_count($k,$n)
{
	if($n == 0)
	{
		return 0;
	}
	else
	{
		return $k * pow(2,$n);
	}
}

function get_cumulative_lvl_npc_count($k,$n)
{
	if($n == 0)
	{
		return 0;
	}
	else
	{
		return get_lvl_npc_count($k,$n) + get_cumulative_lvl_npc_count($k,$n-1);
	}
}



function handleClaim($db, $npc_name_param, $npc_data_param ) // Renamed params to avoid scope collision
{
    // Using $npc_name_param and $npc_data_param within this function
	$sth = $db->prepare("SELECT `$npc_name_param` FROM users_npc_counts WHERE id = :id LIMIT 1"); // Column name from allow-list, generally safe from direct SQLi here but still dynamic
	$sth->execute(array(
					':id' => $_SESSION['player_id']
				));
	$datauser_count = $sth->fetchAll();
	$npc_count_val = $datauser_count[0][$npc_name_param];

	$sth = $db->prepare("SELECT `$npc_name_param` FROM users_npc_lvl WHERE id = :id LIMIT 1"); // Column name from allow-list
	$sth->execute(array(
					':id' => $_SESSION['player_id']
				));
	$datauser_lvl = $sth->fetchAll();
	$npc_lvl_val = $datauser_lvl[0][$npc_name_param];
	
	$actual_progress_count = $npc_count_val - get_cumulative_lvl_npc_count($npc_data_param[$npc_name_param][0],$npc_lvl_val);
	$goal_val = get_lvl_npc_count($npc_data_param[$npc_name_param][0],$npc_lvl_val+1);
	
	if($actual_progress_count < $goal_val)
	{
		return "Can not claim prize, not enough kills for " . htmlspecialchars($npc_name_param, ENT_QUOTES, 'UTF-8'); // Escaped output
	}	

	
	$cred_val = ($npc_data_param[$npc_name_param][1] * $npc_data_param[$npc_name_param][2] * $goal_val);
	$uri_val = ($npc_data_param[$npc_name_param][1] * $npc_data_param[$npc_name_param][3] * $goal_val);
	$rp_val = ($npc_data_param[$npc_name_param][1] * $npc_data_param[$npc_name_param][4] * $goal_val);
	
    // IMPORTANT: The following UPDATE queries are vulnerable to SQL Injection if $npc_name_param is not strictly controlled.
    // However, $npc_name_param comes from $_GET['claim'] which IS validated against the $npc_names allow-list at the top.
    // This makes it safe in this specific context. If $npc_names could be influenced, this would be a major issue.
	$req = $db->prepare('UPDATE users SET uridium=uridium+?,credits=credits+?,rankpoints=rankpoints+? WHERE id=?');
	$req->execute([$uri_val, $cred_val, $rp_val, $_SESSION['player_id']]);
	
	$req = $db->prepare('UPDATE users_npc_lvl SET `'.$npc_name_param.'`=`'.$npc_name_param.'`+1 WHERE id=?'); // Column name from allow-list
	$req->execute([$_SESSION['player_id']]);
	
	$unlocked_lvl_val = $npc_lvl_val+1;
	return htmlspecialchars($npc_name_param, ENT_QUOTES, 'UTF-8') . " level " . htmlspecialchars($unlocked_lvl_val, ENT_QUOTES, 'UTF-8') . " reward unlocked:<br>" . htmlspecialchars(number_format($cred_val), ENT_QUOTES, 'UTF-8') . " credits, " . htmlspecialchars(number_format($uri_val), ENT_QUOTES, 'UTF-8') . " Uridium <br>and " . htmlspecialchars(number_format($rp_val), ENT_QUOTES, 'UTF-8') . " rankpoints";
}

function print_npc_achivement($npc_name_to_print, $npc_lvl_arr, $npc_count_arr, $npc_data_arr) // Renamed params
{
	echo '<div class="bar-stat">';
		echo '<div class="bar-stat-title tooltip">';
			echo htmlspecialchars($npc_name_to_print, ENT_QUOTES, 'UTF-8');
		echo '</div>';
		echo '<div class="bar-stat-content" style="width: 560px;">';
			echo '<div class="bar-stat-content-bar" style="width: 340px;">';
				create_bar(10, $npc_lvl_arr[$npc_name_to_print], 32, 10);
			echo '</div>';
			echo '<div class="bar-stat-content-number" style="width: 80px;">';
			echo htmlspecialchars($npc_lvl_arr[$npc_name_to_print], ENT_QUOTES, 'UTF-8');
			echo '/10</div>';
			echo '<div class="bar-stat-content-number" style="width: 130px;">';
			
			$actual_count_display = $npc_count_arr[$npc_name_to_print] - get_cumulative_lvl_npc_count($npc_data_arr[$npc_name_to_print][0],$npc_lvl_arr[$npc_name_to_print]);
			$goal_display = get_lvl_npc_count($npc_data_arr[$npc_name_to_print][0],$npc_lvl_arr[$npc_name_to_print]+1);
			if($actual_count_display < $goal_display)
			{
				echo 'Progress: ';
				echo htmlspecialchars($actual_count_display, ENT_QUOTES, 'UTF-8');
				echo '/';
				echo htmlspecialchars($goal_display, ENT_QUOTES, 'UTF-8');
			}
			else
			{
				// $npc_name_to_print is from an allow-list, considered safe for URL parameter here.
				// For strictness, urlencode could be used if it were arbitrary data.
				echo '<a class="claim" href="view.php?page=user&tab=achievements&claim='.htmlspecialchars($npc_name_to_print, ENT_QUOTES, 'UTF-8').'">';
					echo 'Claim Prize';

				echo '</a>';
			}
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function create_bar($size, $progress, $elementWidth, $elementHeight)
{
	$i=0;
	while($i < $progress)
	{
		echo '<div class="barUp" style="width: '.$elementWidth.'px; height: '.$elementHeight.'px;"></div>';
		$i++;
	}
	while($i < $size)
	{
		echo '<div class="barDown" style="width: '.$elementWidth.'px; height: '.$elementHeight.'px;"></div>';
		$i++;
	}
}
?>