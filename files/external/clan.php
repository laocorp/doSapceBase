<?php require_once(INCLUDES . 'header.php'); ?>
<?php require_once(INCLUDES . 'data.php'); ?>
<div id="main">
  <div class="container">
    <div class="row">
      <?php
      // Default page
      $page_to_include = 'join.php'; // Default to join page

      if (isset($player['clanId']) && $player['clanId'] > 0) {
        $page_to_include = 'informations.php'; // Default to clan info if player is in a clan
      }

      if (isset($page[1])) {
        $allowed_pages = ['join', 'found', 'informations', 'members', 'diplomacy', 'company_select_clan']; // Added 'company_select_clan' as a guess, might need adjustment
        $requested_page_name = $page[1];

        if (in_array($requested_page_name, $allowed_pages, true)) {
          if (isset($player['clanId']) && $player['clanId'] > 0) { // Player is in a clan
            if ($requested_page_name === 'join' || $requested_page_name === 'found') {
              $page_to_include = 'informations.php'; // If in clan, cannot join/found, redirect to info
            } else {
              $page_to_include = $requested_page_name . '.php';
            }
          } else { // Player is NOT in a clan
            if ($requested_page_name === 'informations' || $requested_page_name === 'members' || $requested_page_name === 'diplomacy') {
              $page_to_include = 'join.php'; // If not in clan, cannot view these pages, redirect to join
            } else {
              $page_to_include = $requested_page_name . '.php';
            }
          }
        }
        // If $requested_page_name is not in $allowed_pages, $page_to_include remains the default determined by clan status.
      }

      $page_path = INCLUDES . 'clan/' . $page_to_include;

      if (!file_exists($page_path)) {
        http_response_code(404); // Changed to 404 for "Not Found"
	echo "<div style='color:red; text-align:center; padding:15px;'>Page not found. (Error CL01)</div>"; // Static message, no XSS
	// Optionally log this event for security review: error_log("Attempt to access non-existent clan page: " . $page_path);
      } else {
        require_once($page_path);
      }
      ?>
    </div>
  </div>
</div>

<?php require_once(INCLUDES . 'footer.php'); ?>