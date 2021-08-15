<?php require_once dirname(__DIR__) . '/config/functions.php';

$id = $_GET['id']??null;
$sql = "SELECT h.name AS hospital, a.symptom, a.gender, a.blood_group, IF(self, u.name, a.name) as name, u.email, u.phone, a.appoint_date FROM `appointment` as a JOIN user as u ON a.user_id = u.id JOIN hospital as h ON h.id = a.hospital_id WHERE a.id = $id";

$data = $getSingleData($sql);

if (!$data) die('Invalid ID');

?>

<div class="modal-header">
    <h5 class="modal-title">Appointment</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<style>
    .appointment_data p {
        color: #5b6e88;
    }
</style>
<div class="modal-body">
    <div class="appointment_data">
        <b>Name :</b>
        <p class="mb-2"><?= $data['name'] ?></p>
        <b>E-mail :</b>
        <p class="mb-2"><?= $data['email'] ?></p>
        <b>Contact No :</b>
        <p class="mb-2"><?= $data['phone'] ?></p>
        <b>Booking Time:</b>
        <p class="mb-2"><?= date('Y-m-d h:i a', strtotime($data['appoint_date'])) ?></p>
        <b>Gender :</b>
        <p class="mb-2"><?= $gender[$data['gender']] ?></p>
        <b>Blood Group :</b>
        <p class="mb-2"><?= $data['blood_group'] ?></p>
        <b>Disease :</b>
        <p class="mb-2"><?= $data['symptom'] ?></p>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary float-start" data-bs-dismiss="modal">Close</button>
</div>
