<?php
// http://www.drfazalnaser.com/
// https://www.drhasnatzaman.com/

$pageTitle = "Profile";
require_once dirname(__DIR__) . '/includes/header.php';
checkLogin();


if (!empty($_POST)) {
	if ($updateProfile()) {
		setAlert('success', 'Profile updated successfully');
	} else {
		setAlert('error', 'Something went wrong');
	}
}

// user image upload
if (isset($_FILES['user_img']['tmp_name']) && !empty(trim($_FILES['user_img']['tmp_name']))) {
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
				$doctor = $getSingleData("SELECT d.id AS doc_id, u.name, u.email, u.phone, d.* FROM user as u JOIN doctor AS d ON d.user_id = u.id WHERE u.id = $_SESSION[id]");
				$departments = GetData("select id, name from department where status = '1'");
				$hospitals = GetData("select * from hospital where status = '1'");
				$available = GetData("SELECT * FROM chamber_availability WHERE doc_id = $doctor[doc_id] ORDER BY id LIMIT 3");

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
                                               value="<?= $doctor['phone'] ?>" required>
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
                                        <input type="text" name="linkedin" class="form-control" id="linkedin"
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
                                               value="<?= $doctor['short_qualification'] ?>" required
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

                    <div class="accordion accordion-flush mt-4" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#chemberCollapse">
                                    Chamber Availability
                                </button>
                            </h2>
                            <div id="chemberCollapse" class="accordion-collapse collapse show"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Hospital</label>
                                                <select class="form-select select2 required" name="hospital_id[]"
                                                        style="width:100%" required aria-label="Hospital">
                                                    <option value="">Select One</option>
													<?php foreach ($hospitals as $h) : ?>
                                                        <option <?= @$available[0]['hospital_id'] === $h['id'] ? 'selected' : '' ?>
                                                                value="<?= $h['id'] ?>"><?= $h['name'] ?>
                                                            , <?= $h['district'] ?></option>
													<?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="" class="form-label">From</label>
                                                <input type="time" class="form-control" name="from[]" required value="<?= @$available[0]['time_from'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="" class="form-label">To</label>
                                                <input type="time" class="form-control" name="to[]" required value="<?= @$available[0]['time_to'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Hospital</label>
                                                <select class="form-select select2" name="hospital_id[]"
                                                        style="width:100%" aria-label="Hospital">
                                                    <option selected value="">Select One</option>
													<?php foreach ($hospitals as $h) : ?>
                                                        <option <?= @$available[1]['hospital_id'] === $h['id'] ? 'selected' : '' ?> value="<?= $h['id'] ?>"><?= $h['name'] ?>
                                                            , <?= $h['district'] ?></option>
													<?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="" class="form-label">From</label>
                                                <input type="time" class="form-control" name="from[]" value="<?= @$available[1]['time_to'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="" class="form-label">To</label>
                                                <input type="time" class="form-control" name="to[]" value="<?= @$available[1]['time_to'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Hospital</label>
                                                <select class="form-select select2" name="hospital_id[]"
                                                        style="width:100%" aria-label="Hospital">
                                                    <option selected value="">Select One</option>
													<?php foreach ($hospitals as $h) : ?>
                                                        <option <?= @$available[2]['hospital_id'] === $h['id'] ? 'selected' : '' ?> value="<?= $h['id'] ?>"><?= $h['name'] ?>
                                                            , <?= $h['district'] ?></option>
													<?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="" class="form-label">From</label>
                                                <input type="time" class="form-control" name="from[]" value="<?= @$available[2]['time_to'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="" class="form-label">To</label>
                                                <input type="time" class="form-control" name="to[]" value="<?= @$available[2]['time_to'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#aboutCollapse">
                                    About
                                </button>
                            </h2>
                            <div id="aboutCollapse" class="accordion-collapse collapse"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                    <textarea class="form-control editor" name="about" cols="30"
                                              rows="10"><?= $doctor['about'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#specialistCollapse">
                                    Specialist
                                </button>
                            </h2>
                            <div id="specialistCollapse" class="accordion-collapse collapse"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                    <textarea class="form-control editor" name="specialist" cols="30"
                                              rows="10"><?= $doctor['specialist'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#experienceCollapse">
                                    Experience
                                </button>
                            </h2>
                            <div id="experienceCollapse" class="accordion-collapse collapse"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                    <textarea class="form-control editor" name="experience" cols="30"
                                              rows="10"><?= $doctor['experience'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#qualificationCollapse">
                                    Qualification
                                </button>
                            </h2>
                            <div id="qualificationCollapse" class="accordion-collapse collapse"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                    <textarea class="form-control editor" name="qualification" cols="30"
                                              rows="10"><?= $doctor['qualification'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#membershipCollapse">
                                    Memberships
                                </button>
                            </h2>
                            <div id="membershipCollapse" class="accordion-collapse collapse"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                    <textarea class="form-control editor" name="membership" cols="30"
                                              rows="10"><?= $doctor['membership'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-8 text-center">
                            <button type="submit" value="update_profile" class="btn btn-primary w-25">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>


<?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>

<script>
    tinymce.init({
        selector: 'textarea.editor',
        branding: false,
        plugins: 'link code advlist lists table autosave anchor autolink preview print wordcount searchreplace template',
        toolbar: 'styleselect formatting forecolor backcolor align| link numlist bullist table | template searchreplace preview print code removeformat',
        table_default_attributes: {
            border: '1'
        },
        table_cell_advtab: true,
        menubar: false
    });
</script>