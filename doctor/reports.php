<?php
$pageTitle = "Reports";
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
                            <form action="" method="get">
								<?php
								$From = $_GET['from']??date("Y-m-d");
								$To = $_GET['to']??date("Y-m-d");
								$hid = $_GET['hospital_id']??null;

								$search = '';
								if (!empty($_GET['hospital_id'])) {
									$search .= " AND a.hospital_id = $_GET[hospital_id] ";
								}

								if (!empty($_GET['patient'])) {
									$search .= " AND (a.name LIKE '%$_GET[patient]%' OR u.name LIKE '%$_GET[patient]%') ";
								}

								$sql = "SELECT r.id, r.title, r.created_at, a.id as appoint_id, IF(a.self, u.name, a.name) as patient FROM `report` as r JOIN appointment as a ON a.id = r.appoint_id JOIN user as u ON a.user_id = u.id JOIN hospital as h ON h.id = a.hospital_id WHERE r.doc_id = (SELECT id FROM doctor WHERE user_id = $_SESSION[id] LIMIT 1) AND DATE(r.created_at) BETWEEN '$From' AND '$To' $search ORDER BY r.created_at DESC";

								$data = MySQLDataPagination($sql);

								?>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="from" class="form-label">From</label>
                                            <input id="from" type="date" class="form-control" name="from"
                                                   value="<?= $From ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="to" class="form-label">To</label>
                                            <input id="to" type="date" class="form-control" name="to"
                                                   value="<?= $To ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
												<?php $hospitals = GetData("select * from hospital where status = '1'"); ?>
                                                <div class="mb-3">
                                                    <label class="form-label">Hospital</label>
                                                    <select class="form-select select2 required" name="hospital_id"
                                                            style="width:100%" aria-label="Hospital">
                                                        <option selected value="">Select One</option>
														<?php foreach ($hospitals as $h) : ?>
                                                            <option <?= $hid === $h['id'] ? 'selected' : '' ?>
                                                                    value="<?= $h['id'] ?>"><?= $h['name'] ?>
                                                                , <?= $h['district'] ?></option>
														<?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Patient</label>
                                                    <input type="text" name="patient" class="form-control"
                                                           placeholder="Patient Name" value="<?= @$_GET['patient'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary w-100" type="submit"
                                                style="margin-top:28px">
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="pt-3 pb-2 mb-3">
                    <h2>Reports</h2>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm vertical-align-middle ws_nowrap">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Patient</th>
                                        <th>Appointment</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php

									if (!$data['content']) : ?>
                                        <tr>
                                            <td colspan="10" class="text-center">No Data Available</td>
                                        </tr>
									<?php else : ?>
										<?php foreach ($data['content'] as $item) : ?>
                                            <tr>
                                                <td><?= $item['title'] ?></td>
                                                <td><?= $item['patient'] ?></td>
                                                <td>
                                                    <a href="javascript:" class="fw-bold" data-bs-target="#ajaxModal" data-bs-toggle="modal"
                                                            data-href="../modals/appointment_view.php?id=<?= $item['appoint_id'] ?>">
														<?= '#' . $item['appoint_id'] ?>
                                                    </a>
                                                </td>
                                                <td><?= date('d-M-Y h:i a', strtotime($item['created_at'])) ?></td>
                                                <td>
                                                    <a href="<?= SITE_URL ?>/doctor/report_view.php?id=<?= $item['id'] ?>"
                                                       class="text-primary">
                                                        <span data-feather="eye"></span> View
                                                    </a>
                                                    <a href="<?= SITE_URL ?>/doctor/report_edit.php?id=<?= $item['id'] ?>"
                                                       class="text-primary ms-3">
                                                        <span data-feather="edit"></span> Edit
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