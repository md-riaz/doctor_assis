<?php
$pageTitle = "Create Report";
require_once dirname(__DIR__) . '/includes/header.php';
checkLogin();
$id = $_GET['id']??null;
$sql = "SELECT doc.name as doctor, h.name AS hospital, a.symptom, a.gender, a.blood_group, IF(self, u.name, a.name) as name, u.email, u.phone, a.appoint_date FROM `appointment` as a JOIN user as u ON a.user_id = u.id JOIN hospital as h ON h.id = a.hospital_id JOIN doctor as d ON d.id = a.doc_id JOIN user as doc ON doc.id = d.user_id WHERE a.id = $id";

$data = $getSingleData($sql);

if (!$data) die('Invalid ID');
?>

<?php require_once('includes/header.php') ?>

    <div class="container-fluid">
        <div class="row">
			<?php require_once('includes/navigation.php') ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3">
                    <div class="card">
                        <div class="card-header">
                            Create Report
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-3"><b>Patient Name : </b><?= $data['name'] ?></div>
                                <div class="col-md-3"><b>Gender : </b><?= $gender[$data['gender']] ?></div>
                                <div class="col-md-3"><b>Blood Group : </b><?= $data['blood_group'] ?></div>
                                <div class="col-md-3"><b>Appointment Id : </b><?= $id ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Hospital</label>
                                        <input type="text" class="form-control" value="<?= $data['hospital'] ?>"
                                               disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Doctor</label>
                                        <input type="text" class="form-control" value="<?= $data['doctor'] ?>"
                                               disabled>
                                    </div>
                                </div>
                            </div>
                            <form action="" method="get">

                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>


<?php require_once dirname(__DIR__) . '/includes/footer.php';