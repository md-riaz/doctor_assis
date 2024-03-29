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
    <style>
        html, body {
            height: 100%;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

    </style>
    <main style="display: flex;align-items: center;padding-top: 40px;padding-bottom: 40px;background-color: #f5f5f5;height: 100%;">
        <div class="form-signin text-center">
            <form action="" method="post">
                <div class="logo mx-auto mb-3"><a href="/">doctor.assistant</a></div>
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="floatingInput"
                           placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword"
                           placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
            </form>
        </div>
    </main>


<?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>