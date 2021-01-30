<?php
$pageTitle = "Home";
require_once dirname(__DIR__) . '/includes/header.php';
checkLogin(); ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Just an image -->
            <nav class="navbar navbar-light">
                <a class="navbar-brand mx-auto" href="/">
                    <div class="logo">doc.assistant</div>
                </a>
            </nav>
        </div>
    </div>
    <div class="container shadow-sm mt-5">
        <div class="row">
            <div class="col-md-3 border-end">
                <div class="nav flex-column nav-pills">
                    <a class="nav-link active" data-bs-toggle="pill" href="#v-pills-reports" role="tab">Recent
                        Reports</a>
                    <a class="nav-link" data-bs-toggle="pill" href="#v-pills-schedules" role="tab">Schedules</a>
                    <a class="nav-link" data-bs-toggle="pill" href="#v-pills-settings" role="tab">Settings</a>
                    <a class="nav-link" href="javascript:logout()">Logout</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="v-pills-reports">
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
                                $data = GetData("SELECT * FROM reports WHERE pid = {$_SESSION['id']} ORDER BY id DESC");
                                if (!$data):
                                    ?>
                                    <tr>
                                        <td colspan="10" class="text-center">No Data Available</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($data as $item): ?>
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

                    </div>
                    <div class="tab-pane fade" id="v-pills-schedules">
                        <div class="card text-dark mb-3">
                            <div class="card-header">
                                <div class="float-start btn">All Appointments</div>
                                <div class="float-end"><button data-bs-toggle="modal" data-bs-target="#ajaxModal" data-href="../modals/setAppointment.php" class="btn btn-primary"><i class="far fa-calendar-check"></i> Set an appointment</button></div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Appointed Date</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $data = GetData("SELECT * FROM appointment WHERE pid = {$_SESSION['id']} ORDER BY id DESC");
                                        if (!$data):
                                            ?>
                                            <tr>
                                                <td colspan="10" class="text-center">No Data Available</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($data as $item): ?>
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
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="v-pills-settings">...
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>