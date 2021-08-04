<?php
require_once '../../config/functions.php';

$action = $_GET['action']??null;
$id = $_GET['id']??null;

if ($action === 'enable' && $id) {
	$update = $cancelAppointment($id);

	$update ? setAlert('success', 'Appointment cancelled') : setAlert('warning', 'Invalid ID');
}