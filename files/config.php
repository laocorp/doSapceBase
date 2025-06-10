<?php
define('ROOT', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

ini_set('log_errors', 1);
ini_set('error_log', ROOT . 'error_logs' . DIRECTORY_SEPARATOR . 'php_error.log');
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

$sessions_path = ROOT . 'sessions';
//ini_set('session.save_path', $sessions_path);

if (!file_exists($sessions_path)) {
  mkdir($sessions_path);
}

if (session_status() === PHP_SESSION_NONE) {
  session_start();
  setcookie(session_name(), session_id(), [
    'expires' => 0,
    'path' => '/',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
  ]);
}

define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_DATABASE', 'pve');
define('MYSQL_PORT', '3306');
define('SystemActiveVerification', false); // true: activado | false: desactivado.

define('DOMAIN', 'http://127.0.0.1/');
define('PHRASELOGO', array('0' => 'Star', '1' => 'Orbit'));
define('LOGO', '<b class="logo_pink">'.PHRASELOGO[0].'</b><b class="logo_normal">'.PHRASELOGO[1].'</b>');
define('SERVERNAME', PHRASELOGO[0].PHRASELOGO[1]);
define('DESC', 'Join to fight!');
define('DISCORDINVITELINK', 'https://discord.gg/TY6mX3nJV9');
define('MAINTENANCE', false); // true: activado | false: desactivado.
define('PUBLIC_KEY', '6LcK1SkaAAAAAKzZHhwVKVBHQArETbyL-YfTPH0k');
define('PRIVATE_KEY', '6LcK1SkaAAAAAOorbQjSH5U1C1zOtoV_HqcqM2qG');
define('KeyToChat', 'aaaaaaaaaaaaaaaaaaaaaaaaaa23bbbbbbbbbbbbbcc3');
define('FACEPAGE', 'http://');

define('CLASSES', ROOT . 'classes' . DIRECTORY_SEPARATOR);
define('EXTERNALS', ROOT . 'external' . DIRECTORY_SEPARATOR);
define('INCLUDES', EXTERNALS . 'includes' . DIRECTORY_SEPARATOR);
define('CRONJOBS', EXTERNALS . 'cronjobs' . DIRECTORY_SEPARATOR);
// Nivel de drones.
define('ExpToDron', array(
  '1' => 0,
  '2' => 500,
  '3' => 1000,
  '4' => 1500,
  '5' => 2000,
  '6' => 2500
));

require_once(CLASSES . 'SMTP.php');
require_once(CLASSES . 'Functions.php');
require_once(CLASSES . 'Database.php');
require_once(CLASSES . 'Socket.php');

// Tipo de munición.
define('typeMunnition', array(
  'ammunition_laser_mcb-50' => 'mcb50',
  'ammunition_specialammo_emp-01' => 'emp',
  'ammunition_mine_smb-01' => 'smb',
  'ammunition_specialammo_r-ic3' => 'ice',
  'ammunition_specialammo_wiz-x' => 'wiz',
  'ammunition_specialammo_dcr-250' => 'dcr',
  'ammunition_specialammo_pld-8' => 'pld',
  'ammunition_rocket_plt-3030' => 'plt3030',
  'ammunition_laser_rsb-75' => 'rsb',
  'ammunition_laser_sab-50' => 'sab',
  'equipment_extra_cpu_ish-01' => 'ish',
  'equipment_extra_cpu_cl04k-xl' => 'cloacks',
  'ammunition_laser_ucb-100' => 'ucb',
  'ammunition_laser_mcb-25' => 'mcb25',
  'ammunition_rocket_r-310' => 'r310',
  'ammunition_rocket_plt-2026' => 'plt26',
  'ammunition_rocket_plt-2021' => 'plt21',
  'ammunition_laser_lcb-10' => 'lcb10',
  'ammunition_laser_cbo-100' => 'cbo100',
  'ammunition_laser_pib-100' => 'pib100',
  'ammunition_laser_job-100' => 'job100',
  "ammunition_laser_rb-214" => 'rb214',
  'ammunition_laser_mcb-100' => 'mcb100',
  'ammunition_laser_mcb-250' => 'mcb250',
  'ammunition_laser_mcb-500' => 'mcb500',
  'ammunition_firework_fwx-l' => 'fwxl',
  'ammunition_mine_acm-01' => 'acm',
  'ammunition_mine_empm-01' => 'empm',
  'ammunition_mine_sabm-01' => 'sabm',
  'ammunition_rocketlauncher_eco-10' => 'eco',
  'ammunition_rocketlauncher_ubr-100' => 'ubr',
  'ammunition_rocketlauncher_sar-02' => 'sar2',
));



Functions::ObStart();
?>