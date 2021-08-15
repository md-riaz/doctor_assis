<?php
require_once '../../config/functions.php';

$action = $_GET['action']??null;
$id = $_GET['id']??null;

if ($action === 'enable' && $id) {
	$update = $enableUser($id);

	$update ? setAlert('success', 'User successfully enabled') : setAlert('warning', 'Invalid ID');
}


if ($action === 'disable' && $id) {
	$update = $disableUser($id);

	$update ? setAlert('success', 'User successfully disabled') : setAlert('warning', 'Invalid ID');
}


goback();