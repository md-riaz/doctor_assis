<?php
$pageTitle = "Home";
require_once dirname(__DIR__) . '/includes/header.php';
checkLogin();

$thumbnail = SITE_URL . "/assets/img/users/user.png";

?>
    <div class="container">
        <div class="row">
            <!-- Just an image -->
            <nav class="navbar navbar-light">
                <a class="navbar-brand mx-auto" href="<?= SITE_URL ?>">
                    <div class="logo"><?= LOGO ?></div>
                </a>
                <div class="dropdown">
                    <div class="d-flex align-items-center " data-bs-toggle="dropdown" aria-expanded="false">
                        <h5 class="mb-0 me-2"><?= $_SESSION['name'] ?></h5>
                        <img src="<?= $thumbnail ?>" width="40" height="40" alt="user_img"
                             class="img-fluid rounded-circle img-thumbnail">
                    </div>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="<?= SITE_URL ?>/logout">Logout</a></li>
                    </ul>

                </div>
            </nav>
        </div>
    </div>
    <div class="container shadow-sm mt-5">
        <div class="row" id="dashboard">
            <div class="col-md-12 py-2 border-end">
                <div class="nav flex-column nav-pills">
                    <a class="nav-link border border-primary my-1" data-bs-toggle="pill" href="#requests"
                       role="tab">Requests</a>
                    <a class="nav-link border border-primary my-1" data-bs-toggle="pill" href="#v-pills-reports"
                       role="tab">Recent
                        Reports</a>
                    <a class="nav-link border border-primary my-1" href="<?= SITE_URL ?>/logout">Logout</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="tab-content">
                    <div class="tab-pane fade" id="requests">
                        <div class="card text-dark mb-3">
                            <div class="card-header">
                                <div class="float-start btn">Doctor Requests</div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered ws_nowrap">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Short Qualification</th>
                                            <th>Department</th>
                                            <th>Requested</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
										<?php
										$data = MySQLDataPagination("SELECT d.id,u.name, u.email,u.phone, d.short_qualification, d.about, department.name as department, d.created_at FROM `user` as u JOIN doctor as d on d.user_id = u.id JOIN department ON department.id = d.department_id WHERE d.status = '0'");

										if (!$data['content']) :
											?>
                                            <tr>
                                                <td colspan="10" class="text-center">No Data Available</td>
                                            </tr>
										<?php else : ?>
											<?php foreach ($data['content'] as $item) : ?>
                                                <tr>
                                                    <td><?= $item['id'] ?></td>
                                                    <td><?= $item['name'] ?></td>
                                                    <td><?= $item['phone'] ?></td>
                                                    <td><?= $item['short_qualification'] ?></td>
                                                    <td><?= $item['department'] ?></td>
                                                    <td><?= date('d-M-Y', strtotime($item['created_at'])) ?></td>
                                                    <td><a href="/">Accept</a></td>
                                                </tr>
											<?php endforeach; ?>
										<?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-6"><?= $data['info'] ?></div>
                                    <div class="col-md-6">
                                        <div class="float-end"><?= $data['pagination'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="v-pills-reports">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Prescription</th>
                                    <th>Disease_data</th>
                                    <th>Created at</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php
								$data = MySQLDataPagination("SELECT * FROM report ORDER BY id DESC");
								if (!$data['content']) :
									?>
                                    <tr>
                                        <td colspan="10" class="text-center">No Data Available</td>
                                    </tr>
								<?php else : ?>
									<?php foreach ($data['content'] as $item) : ?>
                                        <tr>
                                            <td><?= $data['id'] ?></td>
                                            <td><?= $data['prescription'] ?></td>
                                            <td><?= $data['disease_data'] ?></td>
                                            <td><?= date('d-M-Y', strtotime($data['created_at'])) ?></td>
                                        </tr>
									<?php endforeach; ?>
								<?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-6"><?= $data['info'] ?></div>
                            <div class="col-md-6">
                                <div class="float-end"><?= $data['pagination'] ?></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

<?php require_once dirname(__DIR__) . '/includes/footer.php';