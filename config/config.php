<?php
const DB_HOSTNAME = 'localhost';
const DB_USERNAME = 'doctor_assistant';
const DB_PASSWORD = 'doctor_assistant';
const DB_DATABASE = 'doctor_assistant';

const SITE_URL = '//doc.dev.alpha.net.bd';
const APP_NAME = 'Doctor Assistant';
define("APP_VER", mt_rand());
const LOGO = 'doctor.assistant';
const PAGINATION_LIMIT = 5;


// default timezone
date_default_timezone_set("Asia/Dhaka");
// timestamp format
$timestamp = date("Y-m-d H:i:s");

$gender = [0 => "female", 1 => "male"];
$group = [0 => "user", 1 => "admin", 2 => "doctor"];
