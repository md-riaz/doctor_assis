<?php
require_once '../../config/functions.php';

$action = $_GET['action']??null;
$id = $_GET['id']??null;

if ($action === 'add') {
	$result = $addReport();

	$result ? setAlert('success', 'Report added successfully') : setAlert('warning', 'Something went wrong');
	header('location: ' . SITE_URL . '/doctor/report.php');
}

if ($action === 'update') {
	if (!$id) {
		die('Invalid ID');
	}

	$result = $updateReport($id);

	$result ? setAlert('success', 'Report updated successfully') : setAlert('warning', 'Something went wrong');

}


goback();