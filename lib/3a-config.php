<?php
// MUTE NOTICES
error_reporting(E_ALL & ~E_NOTICE);

// DATABASE SETTINGS
// ! CHANGE TO YOUR OWN !
define('DB_HOST', 'localhost');
define('DB_NAME', 'alicebob_game');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', 'emf123');

// AUTO PATH
define('PATH_LIB', __DIR__ . DIRECTORY_SEPARATOR);
?>