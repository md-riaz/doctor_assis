<?php
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'smart_doctor');
define('DB_PASSWORD', 'smart_doctor@123');
define('DB_DATABASE', 'smart_doctor');

define('SITE_URL', '//doc.dev.alpha.net.bd');
define('APP_NAME', 'Doctor Smart');
define('PAGINATION_LIMIT', 5);
// default timezone
date_default_timezone_set("Asia/Dhaka");
// timestamp format
$timestamp = date("Y-m-d H:i:s");

$gender = [0 => "female", 1 => "male"];
$group = [0 => "user", 1 => "admin", 2 => "doctor"];

?>