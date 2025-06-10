<?php
require_once('config.php');

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

Functions::LoadPage($action);

ob_end_flush();
?>
