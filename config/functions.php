<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


require_once __DIR__ . '/config.php';
session_start();
// MySQL Connection
$con = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("DB Error Occurred . $con->connect_error");

// get data from sql query
function GetData($sql)
{
	global $con;
	$query = $con->query($sql);
	$result = [];
	if ($query) {
		while ($row = $query->fetch_assoc()) {
			$result[] = $row;
		}
	}

	return (count($result) < 1 ? false : $result);
}

// get single data
$getSingleData = static function ($sql) use ($con) {
	return $con->query($sql)->fetch_assoc();
};

// go back utility function
function goback()
{
	header('location:' . $_SERVER['HTTP_REFERER']);
	exit;
}

// alert function
function setAlert($type, $msg)
{
	$type = $type === 'error' ? 'danger' : $type;
	$_SESSION['alert'] = [
		"<div id='removeAlert' class='alert alert-$type' role='alert'><strong>" . ucwords($type) . "!</strong> $msg</div>"
	];
}

function getAlerts()
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
	$default_gid = 0;

	$con->query("INSERT INTO user (name, email, phone, password, group_id, created_at) VALUES ('$_POST[name]','$_POST[email]','$_POST[phone]','$_POST[password]', '$default_gid', '$timestamp')");

	return $con->affected_rows > 0;
}

// register doctor
function register_doctor()
{
	global $con, $timestamp;
	$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$doc_id = 2;

	try {
		$con->begin_transaction();

		$con->query("INSERT INTO user (name, email, phone, password, group_id, status, created_at) VALUES ('$_POST[name]','$_POST[email]','$_POST[phone]','$_POST[password]', '$doc_id', '0', '$timestamp')");

		$last_uid = $con->insert_id;

		$con->query("INSERT INTO doctor (user_id, short_qualification, about, department_id, created_at) 
          VALUES ('$last_uid','$_POST[short_qualification]', '$_POST[about]', '$_POST[department_id]', '$timestamp')");

		$con->commit();

		return true;
	} catch (Exception $e) {
		$con->rollback();

		return false;
	}
}

//user login
function Login()
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

			return true;
		}
		setAlert('danger', 'Wrong password');
	} else {
		setAlert('danger', 'No user found with this email.');
	}

	return false;
}

// go to somewhere on authenticate
function onAuthenticate($url = false)
{
	if ($url) {
		if ($_SESSION['group_id'] == 1) {
			return SITE_URL . "/admin/";
		}

		if ($_SESSION['group_id'] == 2) {
			return SITE_URL . "/doctor/";
		}

		if ($_SESSION['group_id'] == 0) {
			return SITE_URL . "/user/";
		}
	}

	if (!empty($_SESSION['redirect'])) {
		$url = $_SESSION['redirect'];
		unset($_SESSION['redirect']);
		header("location: " . $url);
		exit;
	}

	if ($_SESSION['group_id'] == 1) {
		Redirect("/admin/");
	} elseif ($_SESSION['group_id'] == 2) {
		Redirect("/doctor/");
	} else {
		Redirect("/user/");
	}

	return false;
}

// logout 
function logout()
{
	$_SESSION = [];
	session_unset();
	session_destroy();
	Redirect("/login/");
}

function checkLogin()
{
	if (!isset($_SESSION['login'])) {
		logout();
		die();
	}
}

// redirect user to another page.. must be in double quote ""
function Redirect(string $path)
{
	header("location: " . SITE_URL . $path);
	exit;
}

// get user by id
function getUserById(int $id)
{
	global $con;
	$rows = $con->query("SELECT * FROM user WHERE id = $id");

	if ($rows->num_rows > 0) {
		return $rows->fetch_all();
	}

	return false;
}

// other people appointment
function setAppointment()
{
	global $con, $timestamp;
	$date = date("Y-m-d H:i:s", strtotime($_POST['ap_date'] . $_POST['ap_time']));
	$name = !empty($_POST['name']) ? $_POST['name'] : null;
	$con->query("INSERT INTO `appointment`(`doc_id`, `user_id`, `hospital_id`, `name`, `self`, `symptom`, `gender`, `blood_group`, `address`, `appoint_date`, `created_at`) VALUES ('$_POST[doc_id]', '$_SESSION[id]', '$_POST[hospital_id]', '$name', '$_POST[self]', '$_POST[symptom]', '$_POST[gender]', '$_POST[blood_group]', '$_POST[address]', '$date', '$timestamp')");

	return $con->affected_rows > 0;

}


// Create pagination
function MySQLDataPagination($mysqlQuery)
{
	global $con;

	//SET LIMIT
	if (empty($_SESSION['viewLimit'])) {
		$_SESSION['viewLimit'] = PAGINATION_LIMIT;
	}
	$limit = $_SESSION['viewLimit'];

	$page_num = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 0;
	if ($page_num == 0) $page_num = 1;

	//SET Starting
	$start = (isset($page_num) ? mysqli_real_escape_string($con, ($page_num - 1) * $limit) : 0);

	$content = GetData($mysqlQuery . " LIMIT $start, $limit");

	//Start Pagination
	$params = $_GET;
	unset($params['page']);
	$params['page'] = '';

	$cUrl = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '?' . http_build_query($params);

	$totalCount = $con->query($mysqlQuery)->num_rows;
	$totalPage = ceil($totalCount / $limit);

	$pHTML = "<nav>";
	$pHTML .= "<ul class='pagination'>";

	$pHTML .= "<li class='page-item " . ($page_num == 1 ? 'disabled' : '') . "'>";
	$pHTML .= "<a class='page-link' href='" . $cUrl . ($page_num > 1 ? ($page_num - 1) : '#') . "'>Previous</a>";
	$pHTML .= "</li>";

	$pHTML .= "<li class='page-item " . ($page_num == 1 ? 'active' : '') . "'>";
	$pHTML .= "<a class='page-link' href='" . $cUrl . "1'>1</a>";
	$pHTML .= "</li>";

	$pHTML .= ($page_num > 4 ? "<li class='page-item disabled'><a class='page-link'>...</a></li>" : "");
	$startLoop = ($page_num > 4 ? ($page_num - 2) : 2);
	$endLoop = ($page_num < ($totalPage - 3) ? ($page_num + 2) : ($totalPage - 1));
	for ($i = $startLoop; $i <= $endLoop; $i++) {
		$pHTML .= "<li class='page-item " . ($i == $page_num ? 'active' : '') . "'>";
		$pHTML .= "<a class='page-link' href='{$cUrl}{$i}'>{$i}</a>";
		$pHTML .= "</li>";
	}
	$pHTML .= ($page_num < ($totalPage - 3) ? "<li class='page-item disabled'><a class='page-link'>...</a></li>" : "");
	$pHTML .= ($totalPage > 1 ? "<li class='page-item " . ($i == $page_num ? "active" : "") . "'><a class='page-link' href={$cUrl}{$totalPage}>$totalPage</a></li>" : "");
	$pHTML .= "<li class='page-item " . ($page_num == $totalPage ? 'disabled' : '') . "'>";
	$pHTML .= "<a class='page-link' href='" . $cUrl . ($page_num < $totalPage ? ($page_num + 1) : '#') . "'>Next</a>";
	$pHTML .= "</li>";

	$pHTML .= "</ul>";
	$pHTML .= "</nav>";

	$info = "Showing " . ((($page_num - 1) * $_SESSION['viewLimit']) + 1) . " to " . (($page_num * $_SESSION['viewLimit']) > $totalCount ? $totalCount : ($page_num * $_SESSION['viewLimit'])) . " of {$totalCount}";

	//Start Paginate Info

	if ($_SESSION['viewLimit'] === 'all') {
		$pHTML = '';
		$info = "Showing " . $totalCount;
	}

	return ["content" => $content, "pagination" => $pHTML, "info" => $info];
}

// enable doctor
$enableDoctor = static function ($id) use ($con) {
	$q = $con->query("UPDATE doctor SET status = '1' WHERE id = '$id' AND status = '0'");

	return $con->affected_rows > 0;
};
// disable doctor
$disableDoctor = static function ($id) use ($con) {
	$q = $con->query("UPDATE doctor SET status = '0' WHERE id = '$id' AND status = '1'");

	return $con->affected_rows > 0;
};

$cancelAppointment = static function ($id) use ($con) {
	$time = date("Y-m-d H:i:s", strtotime('- 1 day'));
	$con->query("UPDATE appointment SET status = '0' WHERE id = '$id' AND status = '1' AND appoint_date > $time AND user_id = $_SESSION[id]");

	return $con->affected_rows > 0;
};


