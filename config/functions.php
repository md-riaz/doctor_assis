<?php
require_once __DIR__ . '/db.php';
session_start();
// MySQL Connection
$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("DB Error Occurred . $con->connect_error");

// default timezone
date_default_timezone_set("Asia/Dhaka");
// timestamp format
$timestamp = date("Y-m-d H:i:s");

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

// show error message
function ShowError($text)
{
    global $msg;
    $msg = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Error!</h4>' . $text . '</div>';
}

// show success message
function ShowSuccess($text)
{
    global $msg;
    $msg = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>' . $text . '</div>';
}


// go back utility function
function goback()
{
    header('location:' . $_SERVER['HTTP_REFERER']);
    exit;
}