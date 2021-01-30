<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

    if ($query) {
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $result[] = $row;
        }
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
function register()
{
    global $con, $timestamp;
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO patient (name, email, password, age, gender, occupation, address, number, created_at) 
          VALUES ('$_POST[name]', '$_POST[email]','$_POST[password]','$_POST[age]','$_POST[gender]','$_POST[occupation]','$_POST[address]','$_POST[number]', '$timestamp')";

    $reg = $con->query($sql);

    return $reg ? true : false;
}

//user login
function userLogin()
{
    global $con, $group;
    $sql = "SELECT * FROM patient WHERE email = '$_POST[email]'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_array();

        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['group_id'] = 0;
            $_SESSION['access'] = $group[$_SESSION['group_id']];

            return true;
        } else {
            setAlert('danger', 'Wrong password');
        }
    } else {
        setAlert('danger', 'No user found with this email.');
    }

    return false;
}

//admin login
function adminLogin()
{
    global $con, $group;
    $sql = "SELECT * FROM user WHERE email = '$_POST[email]'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_array();

        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['group_id'] = $user['group_id'];
            $_SESSION['access'] = $group[$_SESSION['group_id']];

            return true;
        } else {
            setAlert('danger', 'Wrong password');
        }
    } else {
        setAlert('danger', 'No user found with this email.');
    }

    return false;
}

// logout 
function logout()
{
    session_unset();
    session_destroy();
    Redirect(" ../login/");
}

function checkLogin()
{
    if (!isset($_SESSION['login'])) {
        logout();
        die();
    }
}

if (isset($_POST['logout'])) {
    logout();
    Redirect("../login/");
}
// redirect user to another page.. must be in double quote ""
function Redirect($path)
{
    header("location: $path");
}