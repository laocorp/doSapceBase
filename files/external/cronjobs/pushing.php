<?php
require_once __DIR__ . '/../../bootstrap.php'; // Assuming bootstrap.php sets up necessary constants and autoloader

$mysqli = Database::GetInstance();
$mysqli->begin_transaction();
$pushers = [];

try {
    // Prepare statements outside the loops
    $stmt_get_kills = $mysqli->prepare('SELECT id, killer_id, target_id FROM log_player_kills WHERE pushing != 1');
    $stmt_get_player = $mysqli->prepare('SELECT userId, info, data, pilotName FROM player_accounts WHERE userId = ?');
    $stmt_update_player_data = $mysqli->prepare('UPDATE player_accounts SET data = ? WHERE userId = ?');
    $stmt_update_log_pushing = $mysqli->prepare('UPDATE log_player_kills SET pushing = 1 WHERE id = ?');
    $stmt_count_bans = $mysqli->prepare('SELECT COUNT(id) as ban_count FROM server_bans WHERE userId = ? AND reason = "Pushing" AND typeId = 1 AND ended = 1');
    $stmt_insert_ban = $mysqli->prepare('INSERT INTO server_bans (userId, modId, reason, typeId, end_date) VALUES (?, 1, "Pushing", 1, ?)');

    $stmt_get_kills->execute();
    $result_kills = $stmt_get_kills->get_result();

    while ($value = $result_kills->fetch_assoc()) {
        $killer_id = (int)$value['killer_id'];
        $target_id = (int)$value['target_id'];

        // Get killer details
        $stmt_get_player->bind_param("i", $killer_id);
        $stmt_get_player->execute();
        $killer_result = $stmt_get_player->get_result();
        $killer = $killer_result->fetch_assoc();
        // $killer_result->close(); // Not strictly necessary with get_result if fetched fully

        // Get target details
        $stmt_get_player->bind_param("i", $target_id);
        $stmt_get_player->execute();
        $target_result = $stmt_get_player->get_result();
        $target = $target_result->fetch_assoc();
        // $target_result->close();

        if (!$killer || !$target) {
            // echo "Killer or target not found for log ID: " . $value['id'] . "<br>";
            continue;
        }

        $killerInfo = json_decode($killer['info'], true);
        $targetInfo = json_decode($target['info'], true);

        if (($killerInfo['registerIP'] ?? null) === ($targetInfo['registerIP'] ?? null) && $killerInfo['registerIP'] !== null) {
            if (!in_array($killer['userId'], $pushers)) {
                $pushers[] = $killer['userId'];
            }

            $killerData = json_decode($killer['data'], true);

            $killerData['experience'] = ($killerData['experience'] ?? 0) - 51200;
            $killerData['honor'] = ($killerData['honor'] ?? 0) - 512;
            $killerData['uridium'] = ($killerData['uridium'] ?? 0) - 512; // Assuming uridium can be negative if this is a penalty

            $newKillerDataJson = json_encode($killerData);
            $stmt_update_player_data->bind_param("si", $newKillerDataJson, $killer['userId']);
            $stmt_update_player_data->execute();

            $stmt_update_log_pushing->bind_param("i", $value['id']);
            $stmt_update_log_pushing->execute();
        }
    }
    $stmt_get_kills->close();

    foreach ($pushers as $pusherId) {
        $pusherIdInt = (int)$pusherId;

        // Fetch pilotName for echo (can reuse $stmt_get_player or a more specific one)
        $stmt_get_player->bind_param("i", $pusherIdInt);
        $stmt_get_player->execute();
        $pusher_account_result = $stmt_get_player->get_result();
        $pusher_account = $pusher_account_result->fetch_assoc();
        // $pusher_account_result->close();

        if (!$pusher_account) continue;


        $current = new DateTime();
        $daysToAdd = 3; // Default ban duration

        $stmt_count_bans->bind_param("i", $pusherIdInt);
        $stmt_count_bans->execute();
        $ban_count_result = $stmt_count_bans->get_result()->fetch_assoc();
        $previous_ban_count = $ban_count_result['ban_count'] ?? 0;

        if ($previous_ban_count == 1) $daysToAdd = 7;
        elseif ($previous_ban_count == 2) $daysToAdd = 14;
        elseif ($previous_ban_count == 3) $daysToAdd = 30;
        elseif ($previous_ban_count == 4) $daysToAdd = 60;
        elseif ($previous_ban_count == 5) $daysToAdd = 90;
        elseif ($previous_ban_count == 6) $daysToAdd = 360;
        elseif ($previous_ban_count >= 7) $daysToAdd = 9999; // Essentially permanent

        $current->add(new DateInterval("P{$daysToAdd}D"));
        $newTime = $current->format('Y-m-d H:i:s');

        $stmt_insert_ban->bind_param("is", $pusherIdInt, $newTime);
        $stmt_insert_ban->execute();

        Socket::Send('KickPlayer', ['UserId' => $pusherIdInt, 'Reason' => 'You are banned, reason: Pushing']);
        echo htmlspecialchars($pusher_account['pilotName']) . ' - '.$daysToAdd.' days<br>';
    }

    // Close all prepared statements
    $stmt_get_player->close();
    $stmt_update_player_data->close();
    $stmt_update_log_pushing->close();
    $stmt_count_bans->close();
    $stmt_insert_ban->close();

    $mysqli->commit();
    // echo "Pushing cronjob completed successfully.<br>";
} catch (Exception $e) {
    $mysqli->rollback();
    // echo "Error in pushing cronjob: " . $e->getMessage() . "<br>";
    // Log error to a file or error tracking system for production
}

// $mysqli->close(); // Connection managed by Database::GetInstance()
?>
