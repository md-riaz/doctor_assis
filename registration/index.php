<?php
$pageTitle = "Home";
require_once '../includes/header.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $err = [];
  $requiredFields = ['name', 'email', 'password', 'number', 'gender', 'age', 'occupation', 'address'];
  $validated = true;
  foreach ($requiredFields as $field) {
    if (isset($_POST[$field]) && $_POST[$field] <> "") {
      $_POST[$field] = mysqli_real_escape_string($con, $_POST[$field]);
    } else {
      $validated = false;
      $err[$field] = ucwords($field) . " is empty";
    }
  }

  if ($validated && register()) {
    setAlert('success', 'You have successfully registered');
    redirect('../login/');
  } else {
    setAlert('danger', 'Something went wrong. Please try again');
  }
}

?>

<div class="container">
  <div class="row">
    <!-- section title -->
    <div class="heading">
      <h1>Doctor Assistant</h1>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
      <div class="card">
        <div class="card-header">
          Registration
        </div>
        <div class="card-body">
          <form method="post" action="">
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control <?= isset($err['name']) ? 'is-invalid' : '' ?> >" id="name"
                name="name" required>
              <div class="invalid-feedback"><?= $err['name'] ?? "" ?></div>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control  <?= isset($err['email']) ? 'is-invalid' : '' ?> >" id="email"
                name="email" required>
              <div class="invalid-feedback"><?= $err['email'] ?? ""  ?></div>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control  <?= isset($err['password']) ? 'is-invalid' : '' ?> >"
                id="password" name="password" required>
              <div class="invalid-feedback"><?= $err['password'] ?? ""  ?></div>
            </div>

            <div class="mb-3">
              <label for="number" class="form-label">Phone Number</label>
              <input type="text" class="form-control  <?= isset($err['number']) ? 'is-invalid' : '' ?> >" id="number"
                name="number" required>
              <div class="invalid-feedback"><?= $err['number'] ?? ""  ?></div>

            </div>
            <div class="mb-3">
              <label for="gender" class="form-label d-block">Gender</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input  <?= isset($err['gender']) ? 'is-invalid' : '' ?> >" type="radio"
                  name="gender" id="gender" value="1">
                <label class="form-check-label" for="gender">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input  <?= isset($err['gender']) ? 'is-invalid' : '' ?> >" type="radio"
                  name="gender" id="gender2" value="0">
                <label class="form-check-label" for="gender2">FeMale</label>
              </div>
            </div>
            <div class="mb-3">
              <label for="age" class="form-label">Age</label>
              <input type="number" class="form-control  <?= isset($err['age']) ? 'is-invalid' : '' ?> >" id="age"
                name="age" required>
              <div class="invalid-feedback"><?= $err['age'] ?? ""  ?></div>
            </div>

            <div class="mb-3">
              <label for="occupation" class="form-label">Occupation</label>
              <input type="text" class="form-control  <?= isset($err['occupation']) ? 'is-invalid' : '' ?> >"
                id="occupation" name="occupation" required>
              <div class="invalid-feedback"><?= $err['occupation'] ?? ""  ?></div>
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control  <?= isset($err['address']) ? 'is-invalid' : '' ?> >" id="address"
                name="address" required>
              <div class="invalid-feedback"><?= $err['address'] ?? ""  ?></div>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="terms" required>
              <label class="form-check-label" for="terms">I agrre to the terms & conditions</label>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once '../includes/footer.php'; ?>