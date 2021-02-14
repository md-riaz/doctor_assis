<?php
$pageTitle = "Home";
require_once dirname(__DIR__) . '/includes/header.php';
checkLogin();

// if appointment form submitted
if (isset($_POST['self_apply'])) {
    $requiredFields = ['ap_date', 'ap_time', 'disease'];
    $validated = true;

    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $validated = false;
            setAlert('error', 'Fill the required fields');
        }
    }

    if ($validated && setSelfAppointment()) {
        setAlert('success', 'Appointment has been set successfully');
    } else {
        setAlert('error', 'Something went wrong');
    }

} elseif (isset($_POST['other_apply'])) {

    $requiredFields = ['name', 'number', 'age', 'gender', 'occupation', 'address', 'ap_date', 'ap_time', 'disease'];
    $validated = true;

    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || $_POST[$field] == "") {
            $validated = false;
            setAlert('error', 'Fill the required fields');
        }
    }

    if ($validated && setOtherAppointment()) {
        setAlert('success', 'Appointment has been set successfully');
    } else {
        setAlert('error', 'Something went wrong');
    }
}

// user image upload
if (isset($_FILES['user_img'])) {
    $check = getimagesize($_FILES['user_img']['tmp_name']);
    if ($check) {
        $save_path = "../assets/img/users/{$_SESSION['id']}.png";
        if (!move_uploaded_file($_FILES["user_img"]["tmp_name"], $save_path)) {
            setAlert('error', 'Image upload failed');
        } else {
            setAlert('success', 'Image uploaded successfully');
        }
    } else {
        setAlert('error', 'Selected file is not a valid image.');
    }
}

$thumbnail = file_exists("../assets/img/users/{$_SESSION['id']}.png") ? SITE_URL . "/assets/img/users/{$_SESSION['id']}.png" : SITE_URL . "/assets/img/users/user.png";

?>

<div class="container">
    <div class="row">
        <!-- Just an image -->
        <nav class="navbar navbar-light">
            <a class="navbar-brand mx-auto" href="<?= SITE_URL ?>/user">
                <div class="logo">doc.assistant</div>
            </a>
            <div class="d-flex align-items-center">
                <h5 class="mb-0 me-2">Name</h5>
                <img src="<?= $thumbnail ?>" width="40" height="40" alt="user_img"
                     class="img-fluid rounded-circle img-thumbnail">
            </div>
        </nav>
    </div>
</div>
<div class="container shadow-sm mt-5">
    <div class="row">
        <div class="col-md-3 py-2 border-end">
            <div class="nav flex-column nav-pills">
                <a class="nav-link border border-primary my-1" data-bs-toggle="pill" href="#v-pills-schedules"
                   role="tab">Schedules</a>
                <a class="nav-link border border-primary my-1" data-bs-toggle="pill" href="#v-pills-reports"
                   role="tab">Recent
                    Reports</a>
                <a class="nav-link border border-primary my-1" data-bs-toggle="pill" href="#v-pills-settings"
                   role="tab">Settings</a>
                <a class="nav-link border border-primary my-1" href="javascript:logout()">Logout</a>
            </div>
        </div>
        <div class="col-md-9 my-2">
            <div class="tab-content">
                <div class="tab-pane fade" id="v-pills-schedules">
                    <div class="card text-dark mb-3">
                        <div class="card-header">
                            <div class="float-start btn">All Appointments</div>
                            <div class="float-end">
                                <button data-bs-toggle="modal" data-bs-target="#ajaxModal"
                                        data-href="../modals/setAppointment.php" class="btn btn-primary">
                                    <i class="far fa-calendar-check me-2"></i> Make an appointment
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Appointment Date</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                        <th>Created at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $data = GetData("SELECT * FROM appointment WHERE uid = {$_SESSION['id']} ORDER BY id DESC");

                                    if (!$data) :
                                        ?>
                                        <tr>
                                            <td colspan="10" class="text-center">No Data Available</td>
                                        </tr>
                                    <?php else : ?>
                                        <?php foreach ($data as $item) : ?>
                                            <?php
                                            $app_date = strtotime($item['date'] . $item['time']);
                                            $status = $app_date < time() ? "<i class='far fa-times-circle text-danger'></i>" : "<i class='fas fa-check-circle text-success'></i>";
                                            ?>
                                            <tr>
                                                <td><?= $item['id'] ?></td>
                                                <td><?= date("d-M-Y, g:i a", $app_date) ?></td>
                                                <td><?= $status ?></td>
                                                <td><?= $item['disease'] ?></td>
                                                <td><?= date('d-M-Y', strtotime($item['created_at'])) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
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
                            $data = GetData("SELECT * FROM report WHERE uid = {$_SESSION['id']} ORDER BY id DESC");
                            if (!$data) :
                                ?>
                                <tr>
                                    <td colspan="10" class="text-center">No Data Available</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($data as $item) : ?>
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
                <div class="tab-pane fade" id="v-pills-settings">
                    <?php
                    $user = getPatientByUserId($_SESSION['id']);
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card mx-auto" style="width: 18rem;">
                            <div class="card-img-top change-img">
                                <label for="user_img" style="background-image: url(<?= $thumbnail ?>)">
                                    <i class="fas fa-pen"></i>
                                    <input type="file" name="user_img" id="user_img">
                                </label>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $user['name'] ?></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>Age:</b> <?= $user['age'] ?> years</li>
                                <li class="list-group-item"><b>Gender:</b> <?= $gender[$user['gender']] ?></li>
                                <li class="list-group-item"><b>Phone:</b> <?= $user['number'] ?></li>
                                <li class="list-group-item"><b>Occupation:</b> <?= $user['occupation'] ?></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
<script>
    $(function () {
        $('#user_img').on('change', function () {
            $(this).closest("form").submit();
        })

    });
</script>
