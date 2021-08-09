<?php
require_once __DIR__ . '/includes/header.php';
if (!isset($_SESSION['login'])) {
	$_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
	Redirect('/login/');
}

if (!empty($_GET['doc_id'])) {
	$doc = $con->query("SELECT d.id, d.short_qualification, d.about, d.facebook, d.linkedin, d.specialist, d.experience, d.qualification, d.membership, d.department_id, u.id as user_id, u.name, u.email, u.phone, dp.name as dep_name FROM `doctor` as d JOIN user as u ON d.user_id = u.id JOIN department as dp ON dp.id = d.department_id WHERE u.status != 0 AND d.id = $_GET[doc_id]")->fetch_assoc();
} else {
	Redirect("/");
}

$hospitals = GetData("select * from hospital where status = '1'");


if (!empty($_POST)) {
	$requiredFields = ['self', 'ap_date', 'ap_time', 'symptom', 'hospital_id', 'gender', 'address', 'doc_id'];
	$validated = true;

	if (isset($_POST['self']) && !empty($_POST['self'])) {
		$requiredFields[] = 'name';
	}

	foreach ($requiredFields as $field) {
		if (!isset($_POST[$field]) || $_POST[$field] == "") {
			$validated = false;
			setAlert('error', 'Fill the required fields');
			break;
		}
	}

	if ($validated && setAppointment()) {
		setAlert('success', 'Appointment has been set successfully');
		onAuthenticate();
	}
}


?>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-md navbar-light position-fixed">
                <div class="container">
                    <a class="navbar-brand" href="<?= SITE_URL ?>">
                        <div class="logo"><?= LOGO ?></div>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item fw-bold my-2">
                                <a class="nav-link" aria-current="page" href="<?= SITE_URL ?>">Home</a>
                            </li>
                            <li class="nav-item fw-bold ms-md-3 my-2">
                                <a class="nav-link" href="<?= SITE_URL ?>/about.php">About</a>
                            </li>
                            <li class="nav-item fw-bold ms-md-3 my-2">
                                <a class="nav-link" href="<?= SITE_URL ?>/contact.php">Contact</a>
                            </li>
							<?php if (!empty($_SESSION['login'])): ?>
                                <li class="nav-item ms-md-3">
                                    <a class="nav-link btn bg-warning bg-gradient text-dark px-4 my-2"
                                       href="<?= onAuthenticate(true) ?>">
                                        <i class="fas fa-tachometer-alt"></i>
                                        Dashboard
                                    </a>
                                </li>
							<?php else: ?>
                                <li class="nav-item ms-md-3">
                                    <a class="nav-link btn bg-primary bg-gradient text-white px-4 my-2"
                                       href="<?= SITE_URL ?>/login/">
                                        <i class="fas fa-sign-in-alt"></i> Login
                                    </a>
                                </li>
                                <li class="nav-item ms-md-3">
                                    <a class="nav-link btn bg-warning bg-gradient text-dark px-4 my-2"
                                       href="<?= SITE_URL ?>/registration/">
                                        <i class="fas fa-user-check"></i>
                                        Register
                                    </a>
                                </li>
							<?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="full-section bg-white">
        <div class="container">
            <div class="row justify-content-center align-items-center mb-5" style="margin-top: 200px;">
                <h1 class="text-uppercase text-primary text-center mb-4">Make an Appointment to <?= $doc['name'] ?></h1>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post">
                                <input type="hidden" value="<?= $doc['id'] ?>" name="doc_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Appointment For</label> <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="self"
                                                       id="inlineRadio1" value="1" checked>
                                                <label class="form-check-label" for="inlineRadio1">Self</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="self"
                                                       id="inlineRadio2" value="0">
                                                <label class="form-check-label" for="inlineRadio2">Other</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="otherName" style="display: none">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input name="name" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="appointment" class="form-label">Select a date</label>
                                            <input name="ap_date" type="date" class="form-control" id="appointment"
                                                   required
                                                   min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="time" class="form-label">Select time</label>
                                            <input name="ap_time" type="time" class="form-control" id="time" required
                                                   min="09:00" max="19:00">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="disease" class="form-label">Tell us about your symptoms</label>
                                            <textarea name="symptom" id="disease" cols="30" rows="3"
                                                      class="form-control"
                                                      required></textarea>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="gender" class="form-label d-block">Gender</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="gender" id="gender" value="1" required>
                                                <label class="form-check-label" for="gender">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="gender" id="gender2" value="0">
                                                <label class="form-check-label" for="gender2">FeMale</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Blood Group</label>
                                            <input name="blood_group" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input name="address" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Set Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container footer">
        <div class="row align-items-center">
            <div class="col-md-6 my-3">
                <p class="mb-0">Copyright @ <?= date('Y') ?>, <?= APP_NAME ?>. All rights reserved.</p>
            </div>
            <div class="col-md-6 my-3">
                <ul class="list-unstyled d-flex justify-content-md-end list-unstyled m-0">
                    <li class="me-3"><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms &amp; Conditions</a></li>
                </ul>
            </div>
        </div>
    </div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>