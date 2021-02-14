<?php
$pageTitle = "Home";
require_once '../includes/header.php';
if (isset($_SESSION['login'])) {
    onAuthenticate();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $err = [];
    $requiredFields = ['ap_date','ap_time','disease','name', 'email', 'password', 'number', 'gender', 'age', 'occupation', 'address'];
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
        Redirect("../login/");
    }
}

?>
    <div class="container-fluid reg_bg" style="background-image:url('../assets/img/reg_bg.jpg');">
        <div class="row">
            <!-- Just an image -->
            <nav class="navbar navbar-light">
                <a class="navbar-brand mx-auto" href="/">
                    <div class="logo">doc.assistant</div>
                </a>
            </nav>
        </div>

        <div class="container mt-5 ">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Registration
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="row g-3">
                                    <div class="col mb-3">
                                        <label for="appointment" class="form-label">Select a date</label>
                                        <input name="ap_date" type="date" class="form-control" id="appointment" required
                                               min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                                    </div>
                                    <div class="col mb-3">
                                        <label for="time" class="form-label">Select time</label>
                                        <input name="ap_time" type="time" class="form-control" id="time" required
                                               min="09:00" max="19:00">
                                        <div class="form-text">Appointment time is between 09:00 AM to 07:00PM</div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="disease" class="form-label">About Disease</label>
                                    <textarea name="disease" id="disease" cols="30" rows="3" class="form-control" required></textarea>
                                </div>
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


                                <div class="row g-3">
                                    <div class="mb-3 col">
                                        <label for="gender" class="form-label d-block">Gender</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input  <?= isset($err['gender']) ? 'is-invalid' : '' ?> >"
                                                   type="radio"
                                                   name="gender" id="gender" value="1">
                                            <label class="form-check-label" for="gender">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input  <?= isset($err['gender']) ? 'is-invalid' : '' ?> >"
                                                   type="radio"
                                                   name="gender" id="gender2" value="0">
                                            <label class="form-check-label" for="gender2">FeMale</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="age" class="form-label">Age</label>
                                        <input type="number"
                                               class="form-control  <?= isset($err['age']) ? 'is-invalid' : '' ?> >"
                                               id="age"
                                               name="age" required>
                                        <div class="invalid-feedback"><?= $err['age']??"" ?></div>
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input type="text"
                                           class="form-control  <?= isset($err['occupation']) ? 'is-invalid' : '' ?> >"
                                           id="occupation" name="occupation" required>
                                    <div class="invalid-feedback"><?= $err['occupation']??"" ?></div>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text"
                                           class="form-control  <?= isset($err['address']) ? 'is-invalid' : '' ?> >"
                                           id="address"
                                           name="address" required>
                                    <div class="invalid-feedback"><?= $err['address']??"" ?></div>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" required>
                                    <label class="form-check-label" for="terms">I agrre to the terms &
                                        conditions</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Register & Set Appointment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once '../includes/footer.php'; ?>