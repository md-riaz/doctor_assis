<?php
$pageTitle = "Report";
require_once dirname(__DIR__) . '/includes/header.php';
checkLogin();

$id = $_GET['id']??null;

if (!$id) {
	die('Invalid ID');
}

$sql = "SELECT r.appoint_id, r.doc_id, d.short_qualification, doc.name as doctor, dept.name as dept_name, h.name AS hospital, u.email, u.phone, r.prescription, a.gender, a.blood_group, IF(self, u.name, a.name) as name, a.appoint_date FROM report as r JOIN appointment as a ON a.id = r.appoint_id JOIN user as u ON a.user_id = u.id JOIN hospital as h ON h.id = a.hospital_id JOIN doctor as d ON d.id = a.doc_id JOIN user as doc ON doc.id = d.user_id JOIN department AS dept ON dept.id = d.department_id WHERE r.id = $id";

$data = $getSingleData($sql);

$chamberTime = GetData("SELECT h.name as hospital, ca.time_from, ca.time_to FROM `chamber_availability` as ca JOIN hospital as h ON h.id = ca.hospital_id WHERE ca.doc_id = $data[doc_id]");

?>


<div id="print_view" class="p-4 bg-white mx-auto" style="max-width: 800px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="<?= SITE_URL ?>" class="logo mx-auto">doctor.assistant</a>
            </div>
        </div>
        <div class="row border my-3" style="border-color: #d0dfff !important;-webkit-print-color-adjust: exact;">
            <div class="col-md-6 col-print-6 my-3">
                <p class="mb-0"><?= $data['dept_name'] ?></p>
                <h4><?= $data['doctor'] ?></h4>
                <div><?= $data['short_qualification'] ?></div>
                <div><b>Phone: </b> <?= $data['phone'] ?></div>
            </div>
            <div class="col-md-6 col-print-6 my-3 border-start ps-4">
				<?php if (!empty($chamberTime)) { ?>
                    <p class="mb-0">Available to:</p>
					<?php foreach ($chamberTime as $time) { ?>
                        <span class="fw-bold"><?= $time['hospital'] ?></span>
                        <span><?= date('h:i a', strtotime($time['time_from'])) ?>  - <?= date('h:i a', strtotime($time['time_to'])) ?></span>
					<?php } ?>
				<?php } ?>
            </div>
        </div>
        <div class="row mb-3 py-3" style="background-color:#d0dfff;-webkit-print-color-adjust: exact;">
            <div class="col-md-3 col-print-3"><b>Patient Name : </b><?= $data['name'] ?></div>
            <div class="col-md-3 col-print-3"><b>Gender : </b><?= $gender[$data['gender']] ?></div>
            <div class="col-md-3 col-print-3"><b>Blood Group : </b><?= $data['blood_group'] ?></div>
            <div class="col-md-3 col-print-3"><b>Appointment Id : </b><?= $data['appoint_id'] ?></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 border p-2" style="border-color: #d0dfff !important;-webkit-print-color-adjust: exact;">
				<?= htmlspecialchars_decode($data['prescription']) ?>
            </div>
        </div>
        <div class="row pt-4 pb-3" style="background-color:#d0dfff;-webkit-print-color-adjust: exact;">
            <div class="col-md-6 col-print-6">
				<?= (strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false ? 'http' : 'https') . '://' . $_SERVER['SERVER_NAME'] ?>
            </div>
            <div class="col-md-6 col-print-6 text-center">
                <div class="fw-bold mt-2" style="border-top: 2px dashed">Signature</div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <a href="javascript:print()" class="btn btn-primary"><span data-feather="print"></span> Print</a>
        </div>
    </div>
</div>