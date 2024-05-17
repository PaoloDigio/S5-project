<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'epicode_s5-project');
define('DB_USER', 'root');
define('DB_PASS', '');

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});
?>
