<?php require_once(INCLUDES . 'header.php');
$mysqli = Database::GetInstance();
?>

<div id="main">
    <div class="container">
        <div class="row">
            <?php
            if (isset($_POST['code'])) {
                $event_code = $_POST['code']; // Store in a variable
                $userId = $player['userId']; // Assuming $player is already defined and contains userId

                $stmt_active_event = $mysqli->prepare("SELECT * FROM event WHERE active = 1 AND event_code = ?");
                $stmt_active_event->bind_param("s", $event_code);
                $stmt_active_event->execute();
                $result_active_event = $stmt_active_event->get_result();

                if ($result_active_event->num_rows > 0) {
                    $stmt_active_event->close();

                    $stmt_participation = $mysqli->prepare("SELECT * FROM event_participation WHERE userId = ? AND event_code = ?");
                    $stmt_participation->bind_param("is", $userId, $event_code);
                    $stmt_participation->execute();
                    $result_participation = $stmt_participation->get_result();

                    if ($result_participation->num_rows > 0) {
                        $stmt_participation->close(); ?>
                        <div class="card white-text grey darken-4 padding-15">
                            <h3> <strong>Hey! The prize has already been claimed ;)</strong> <br> With ❤ StarOrbit Team.</h3>
                        </div>
                        <?php
                    } else {
                        $stmt_participation->close();

                        $stmt_event_coins = $mysqli->prepare("SELECT coins FROM event_coins WHERE userId = ?");
                        $stmt_event_coins->bind_param("i", $userId);
                        $stmt_event_coins->execute();
                        $result_event_coins = $stmt_event_coins->get_result();

                        if ($result_event_coins->num_rows > 0) {
                            $current_coins_data = $result_event_coins->fetch_assoc();
                            $stmt_event_coins->close();
                            $new_coins = (int)$current_coins_data['coins'] + 1;

                            $stmt_update_coins = $mysqli->prepare("UPDATE event_coins SET coins = ? WHERE userId = ?");
                            $stmt_update_coins->bind_param("ii", $new_coins, $userId);
                            $stmt_update_coins->execute();
                            $stmt_update_coins->close();

                            $stmt_insert_participation = $mysqli->prepare("INSERT INTO event_participation (userId, event_code) VALUES (?, ?)");
                            $stmt_insert_participation->bind_param("is", $userId, $event_code);
                            $stmt_insert_participation->execute();
                            $stmt_insert_participation->close();
                        ?>
                            <div class="card white-text grey darken-4 padding-15">
                                <h3> <strong>+1 Event coin in your account :)</strong> <br> With ❤ StarOrbit Team.</h3>
                            </div>
                        <?php
                        } else {
                            $stmt_event_coins->close();
                            $initial_coins = 1;
                            $stmt_insert_coins = $mysqli->prepare("INSERT INTO event_coins (coins, userId) VALUES (?, ?)");
                            $stmt_insert_coins->bind_param("ii", $initial_coins, $userId);
                            $stmt_insert_coins->execute();
                            $stmt_insert_coins->close();

                            $stmt_insert_participation2 = $mysqli->prepare("INSERT INTO event_participation (userId, event_code) VALUES (?, ?)");
                            $stmt_insert_participation2->bind_param("is", $userId, $event_code);
                            $stmt_insert_participation2->execute();
                            $stmt_insert_participation2->close();
                        ?>
                            <div class="card white-text grey darken-4 padding-15">
                                <h3> <strong>+1 Event coin in your account :)</strong> <br> With ❤ StarOrbit Team.</h3>
                            </div>
                    <?php
                        }
                    }
                } else { ?>
                    <div class="card white-text grey darken-4 padding-15">
                        <h4>Not implemented yet.</h4>
                    </div>
                <?php

                }
            } else { ?>
                <div class="card white-text grey darken-4 padding-15">
                    <h4>Not implemented yet.</h4>
                </div>
            <?php
            }

            ?>

        </div>
    </div>
</div>

<?php require_once(INCLUDES . 'footer.php'); ?>
<?php require_once(INCLUDES . 'footer2.php'); ?>