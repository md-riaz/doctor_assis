<?php
$pageTitle = "Home";
require_once dirname(__DIR__) . '/includes/header.php';


if (isset($_SESSION['login'])) {
	onAuthenticate();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$email = $password = "";
	$err = [];
	$requiredFields = ['email', 'password'];
	$validated = true;
	foreach ($requiredFields as $field) {
		if (isset($_POST[$field]) && $_POST[$field] <> "") {
			$_POST[$field] = mysqli_real_escape_string($con, $_POST[$field]);
		} else {
			$validated = false;
			$err[$field] = ucwords($field) . " is empty";
		}
	}

	if ($validated && Login()) {
		onAuthenticate();
	}
}
?>
    <div class="container-fluid ">
        <div class="row">
            <!-- Just an image -->
            <nav class="navbar navbar-light">
                <a class="navbar-brand mx-auto" href="/">
                    <div class="logo">doctor.smart</div>
                </a>
            </nav>
        </div>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Login
                        </div>
                        <div class="card-body">
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email"
                                           class="form-control <?= isset($err['email']) ? 'is-invalid' : '' ?>"
                                           id="email"
                                           name="email" required>
                                    <div class="invalid-feedback"><?= $err['email']??"" ?></div>
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password"
                                           class="form-control <?= isset($err['password']) ? 'is-invalid' : '' ?>"
                                           id="password" name="password" required>
                                    <div class="invalid-feedback"><?= $err['password']??"" ?></div>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>