<?php
$pageTitle = "Home";
require_once __DIR__ . '/includes/header.php';

if (!empty($_GET['id'])) {
	$docs = GetData("SELECT * FROM `doctor` JOIN user ON doctor.user_id = user.id WHERE doctor.department_id = $_GET[id]");
}
echo '<pre>';
print_r($docs);
echo '</pre>';
exit;
?>