<?php
require_once '../../config/functions.php';

$action = $_GET['action']??null;
$id = $_GET['id']??null;

if ($action === 'add') {
	$result = $addReport();

	$result ? setAlert('success', 'Report added successfully') : setAlert('warning', 'Something went wrong');
}


onAuthenticate();