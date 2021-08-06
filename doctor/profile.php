<?php
$pageTitle = "Home";
require_once dirname(__DIR__) . '/includes/header.php';
checkLogin();

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

<?php require_once('includes/header.php') ?>

    <div class="container-fluid">
        <div class="row">
			<?php require_once('includes/navigation.php') ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3">
					<?php
					$doctor = $getSingleData("SELECT u.name, u.email, u.phone, d.* FROM user as u JOIN doctor AS d ON d.user_id = u.id WHERE u.id = $_SESSION[id]");
					$departments = GetData("select id, name from department where status = '1'");
					$hospitals = GetData("select * from hospital where status = '1'");
					?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card mx-auto">
                            <div class="card-img-top change-img mt-3">
                                <label for="user_img" style="background-image: url(<?= $thumbnail ?>)">
                                    <i class="fas fa-pen"></i>
                                    <input type="file" name="user_img" id="user_img">
                                </label>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center"><?= $doctor['name'] ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted text-center"><?= $doctor['email'] ?></h6>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="number" name="phone" class="form-control" id="phone"
                                                   value="<?= $doctor['phone'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="facebook" class="form-label">Facebook</label>
                                            <input type="text" name="facebook" class="form-control" id="facebook"
                                                   placeholder="Profile Link"
                                                   value="<?= $doctor['facebook'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="linkedin" class="form-label">Linkedin</label>
                                            <input type="number" name="linkedin" class="form-control" id="linkedin"
                                                   value="<?= $doctor['linkedin'] ?>" placeholder="Profile Link">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="short_qualification" class="form-label">Short
                                                Qualification</label>
                                            <input type="text" name="short_qualification" class="form-control"
                                                   value="<?= $doctor['short_qualification'] ?>"
                                                   id="short_qualification">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Department</label>
                                            <select class="form-select select2 required" name="department_id"
                                                    style="width:100%" required aria-label="Department">
                                                <option selected value="">Select One</option>
												<?php foreach ($departments as $d) : ?>
                                                    <option <?= $doctor['department_id'] === $d['id'] ? 'selected' : '' ?>
                                                            value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
												<?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">Time From</div>
                                    <div class="col-md-4">Time To</div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>


<?php require_once dirname(__DIR__) . '/includes/footer.php';