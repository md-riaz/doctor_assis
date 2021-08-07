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
                    <h2>Search Filter</h2>
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="from" class="form-label">From</label>
                                            <input id="from" type="date" class="form-control" name="from"
                                                   value="<?= date('Y-m-d') ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="to" class="form-label">To</label>
                                            <input id="to" type="date" class="form-control" name="to"
                                                   value="<?= date('Y-m-d') ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
										<?php $hospitals = GetData("select * from hospital where status = '1'"); ?>
                                        <div class="mb-3">
                                            <label class="form-label">Hospital</label>
                                            <select class="form-select select2 required" name="hospital_id"
                                                    style="width:100%" required aria-label="Hospital">
                                                <option selected value="">Select One</option>
												<?php foreach ($hospitals as $h) : ?>
                                                    <option value="<?= $h['id'] ?>"><?= $h['name'] ?>
                                                        , <?= $h['district'] ?></option>
												<?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary w-100" type="submit" style="margin-top:28px">
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="pt-3 pb-2 mb-3">
                    <h2>Appointments</h2>
                    <div class="card">
                        <div class="card-body">
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
                                                <td><?= date('d-M-Y H:i a', $app_date) ?></td>
                                                <td>
                                                    <a href="<?= SITE_URL ?>/doctor/appointment_view.php?id=<?= $item['id'] ?>"
                                                       class="text-primary">
                                                        <span data-feather="eye"></span> View
                                                    </a>
                                                </td>
                                            </tr>
										<?php endforeach; ?>
									<?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>


<?php require_once dirname(__DIR__) . '/includes/footer.php';