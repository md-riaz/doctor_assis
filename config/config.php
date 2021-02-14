<?php
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'doctor');
define('DB_PASSWORD', 'doc@786');
define('DB_DATABASE', 'assist_doc');

define('SITE_URL', 'http://doc.dev.alpha.net.bd');
define('APP_NAME', 'Doctor Assistant');
// default timezone
date_default_timezone_set("Asia/Dhaka");
// timestamp format
$timestamp = date("Y-m-d H:i:s");
$gender = [0 => "female", 1 => "male"];
$group = [0 => "patient", 1 => "admin", 2 => "compounder"];
?>