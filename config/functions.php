<?php
require_once __DIR__ . '/db.php';
session_start();
// MySQL Connection
$con = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("DB Error Occurred . $con->connect_error");

// default timezone
date_default_timezone_set("Asia/Dhaka");
// timestamp format
$timestamp = date("Y-m-d H:i:s");
$gender = [0 => "female", 1 => "male"];
$group = [0 => "patient", 1 => "admin", 2 => "compounder"];
// get data from sql query
function GetData($sql)
{
  global $con;
  $query = mysqli_query($con, $sql);
  $result = [];
  while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $result[] = $row;
  }

  return (count($result) < 1 ? false : $result);
}

// go back utility function
function goback()
{
  header('location:' . $_SERVER['HTTP_REFERER']);
  exit;
}

// alert function
function setAlert($type, $msg)
{

  $_SESSION['alert'] = [
    "<div id='removeAlert' class='alert alert-$type' role='alert'><strong>" . ucwords($type) . "!</strong> $msg</div>"
  ];
}

function alerts()
{
  if (isset($_SESSION['alert'])) {
    foreach ($_SESSION['alert'] as $alert) {
      echo $alert;
    }
    unset($_SESSION['alert']);
  }
}

// register user 
function register($name, $email, $password, $number, $gender, $age, $occupation, $address)
{
  global $con, $timestamp;
  $password = password_hash($password, PASSWORD_DEFAULT);
  $sql = "INSERT INTO patient (name, email, password, age, gender, occupation, address, number, created_at) 
          VALUES ('$name', '$email','$password','$age','$gender','$occupation','$address','$number', '$timestamp')";

  $reg = $con->query($sql);

  return $reg ? true : false;
}