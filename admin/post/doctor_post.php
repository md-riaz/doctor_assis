<?php
require_once '../../config/functions.php';

$action = $_GET['action']??null;
$id = $_GET['id']??null;

if ($action === 'enable' && $id) {
	$update = $enableDoctor($id);

	$update ? setAlert('success', 'Doctor successfully approved') : setAlert('warning', 'Invalid ID');
}


if ($action === 'disable' && $id) {
	$update = $disableDoctor($id);

	$update ? setAlert('success', 'Doctor successfully disabled') : setAlert('warning', 'Invalid ID');
}


goback();