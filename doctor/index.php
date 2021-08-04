<?php
$pageTitle = "Home";
require_once dirname(__DIR__) . '/includes/header.php';
checkLogin();

?>

<?php require_once('includes/header.php') ?>

    <div class="container-fluid">
        <div class="row">
			<?php require_once('includes/navigation.php') ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3">
                    <h2>Today's Appointments</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm vertical-align-middle ws_nowrap">
                            <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Hospital</th>
                                <th>Appointment</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php
							$data = MySQLDataPagination("SELECT a.id, h.name AS hospital, a.symptom, a.gender, a.blood_group, IF(self, u.name, a.name) as patient, a.appoint_date FROM `appointment` as a JOIN user as u ON a.user_id = u.id JOIN hospital as h ON h.id = a.hospital_id WHERE a.status = 1 AND doc_id = $_SESSION[id] ORDER BY a.created_at DESC");

							if (!$data['content']) : ?>
                                <tr>
                                    <td colspan="10" class="text-center">No Data Available</td>
                                </tr>
							<?php else : ?>
								<?php foreach ($data['content'] as $item) : ?>
									<?php
									$app_date = strtotime($item['appoint_date']);
									?>
                                    <tr>
                                        <td><?= $item['patient'] ?></td>
                                        <td><?= $item['hospital'] ?></td>
                                        <td><?= date('d-M-Y', $app_date) ?></td>
                                        <td>
											View or report
                                        </td>
                                    </tr>
								<?php endforeach; ?>
							<?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>


<?php require_once dirname(__DIR__) . '/includes/footer.php';