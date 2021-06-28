<?php
$pageTitle = "Home";
require_once '../includes/header.php';
if (isset($_SESSION['login'])) {
	onAuthenticate();
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	// user register
	if (isset($_POST['user'])) {
		$err = [];
		$requiredFields = ['name', 'number', 'email', 'password'];
		$validated = true;
		foreach ($requiredFields as $field) {
			if (isset($_POST[$field]) && $_POST[$field] <> "") {
				$_POST[$field] = mysqli_real_escape_string($con, $_POST[$field]);
			} else {
				$validated = false;
				$err[$field] = ucwords($field) . " is empty";
			}
		}

		if (!$validated || !register()) {
			setAlert('danger', 'Something went wrong. Please try again');
		} else {
			setAlert('success', 'Registration was successful. Now Login');
		}
	} else if (isset($_POST['doctor'])) {

		$err = [];
		$requiredFields = ['name', 'number', 'department_id', 'short_qualification', 'about', 'email', 'password'];
		$validated = true;
		foreach ($requiredFields as $field) {
			if (isset($_POST[$field]) && $_POST[$field] <> "") {
				$_POST[$field] = mysqli_real_escape_string($con, $_POST[$field]);
			} else {
				$validated = false;
				$err[$field] = ucwords($field) . " is empty";
			}
		}

		if (!$validated || !register_doctor()) {
			setAlert('danger', 'Something went wrong. Please try again');
		} else {
			setAlert('success', 'Registration was successful. But you need to activate your account. Now Contact Admin for your account activation.');
		}
	}
	Redirect("/login");

}
$departments = GetData("select * from department where status = '1'");

?>
    <div class="container-fluid ">
        <div class="row">
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="container">
                    <a class="navbar-brand" href="<?= SITE_URL ?>">
                        <div class="logo">doctor.assistant</div>
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
							<?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

        <div class="container mt-5 ">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-6">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#user" type="button"
                                    role="tab">User Registration
                            </button>
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#doctor" type="button"
                                    role="tab">Doctor Registration
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="user" role="tabpanel">
                            <div class="card p-5">
                                <form method="post" action="">
                                    <div class="row g-3">
                                        <div class="mb-3 col">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text"
                                                   class="form-control <?= isset($err['name']) ? 'is-invalid' : '' ?> >"
                                                   id="name"
                                                   name="name" required>
                                            <div class="invalid-feedback"><?= $err['name']??"" ?></div>
                                        </div>
                                        <div class="mb-3 col">
                                            <label for="number" class="form-label">Phone Number</label>
                                            <input type="text"
                                                   class="form-control  <?= isset($err['number']) ? 'is-invalid' : '' ?> >"
                                                   id="number"
                                                   name="number" required>
                                            <div class="invalid-feedback"><?= $err['number']??"" ?></div>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="mb-3 col">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="email"
                                                   class="form-control  <?= isset($err['email']) ? 'is-invalid' : '' ?> >"
                                                   id="email"
                                                   name="email" required>
                                            <div class="invalid-feedback"><?= $err['email']??"" ?></div>
                                        </div>
                                        <div class="mb-3 col">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password"
                                                   class="form-control  <?= isset($err['password']) ? 'is-invalid' : '' ?> >"
                                                   id="password" name="password" required>
                                            <div class="invalid-feedback"><?= $err['password']??"" ?></div>
                                        </div>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="terms" required>
                                        <label class="form-check-label" for="terms">I agree to the terms &
                                            conditions</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="user">Register</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="doctor" role="tabpanel">
                            <div class="card p-5">
                                <form method="post" action="">
                                    <div class="row g-3">
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text"
                                                   class="form-control <?= isset($err['name']) ? 'is-invalid' : '' ?> >"
                                                   id="name"
                                                   name="name" required>
                                            <div class="invalid-feedback"><?= $err['name']??"" ?></div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="number" class="form-label">Phone Number</label>
                                            <input type="text"
                                                   class="form-control  <?= isset($err['number']) ? 'is-invalid' : '' ?> >"
                                                   id="number"
                                                   name="number" required>
                                            <div class="invalid-feedback"><?= $err['number']??"" ?></div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="mb-3 col-md-6">
                                            <label for="department_id" class="form-label"> Choose your medical
                                                department</label>
                                            <select class="form-select select2" name="department_id" id="department_id"
                                                    style="width:100%">
                                                <option selected>Select One</option>
												<?php foreach ($departments as $department) : ?>
                                                    <option value="<?= $department['id'] ?>"><?= $department['name'] ?></option>
												<?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"><?= $err['department_id']??"" ?></div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="short_qualification" class="form-label">Short
                                                Qualification</label>
                                            <input type="text"
                                                   class="form-control <?= isset($err['short_qualification']) ? 'is-invalid' : '' ?> >"
                                                   id="short_qualification"
                                                   name="short_qualification" required>
                                            <div class="invalid-feedback"><?= $err['short_qualification']??"" ?></div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="mb-3 col">
                                            <label for="about" class="form-label">Tell us something about
                                                yourself</label>
                                            <textarea
                                                    class="form-control <?= isset($err['about']) ? 'is-invalid' : '' ?> >"
                                                    id="about"
                                                    name="about" required></textarea>
                                            <div class="invalid-feedback"><?= $err['about']??"" ?></div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="email"
                                                   class="form-control  <?= isset($err['email']) ? 'is-invalid' : '' ?> >"
                                                   id="email"
                                                   name="email" required>
                                            <div class="invalid-feedback"><?= $err['email']??"" ?></div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password"
                                                   class="form-control  <?= isset($err['password']) ? 'is-invalid' : '' ?> >"
                                                   id="password" name="password" required>
                                            <div class="invalid-feedback"><?= $err['password']??"" ?></div>
                                        </div>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="terms" required>
                                        <label class="form-check-label" for="terms">I agree to the terms &
                                            conditions</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="doctor">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php require_once '../includes/footer.php'; ?>