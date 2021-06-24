<?php
$pageTitle = "Home";
require_once __DIR__ . '/includes/header.php';
$docs = [];
if (!empty($_GET['dep_id'])) {
	$docs = GetData("SELECT * FROM `doctor` JOIN user ON doctor.user_id = user.id WHERE doctor.department_id = $_GET[dep_id]");
}
?>
    <div class="container-fluid login_bg">
        <div class="row">
            <!-- Just an image -->
            <nav class="navbar navbar-light">
                <a class="navbar-brand mx-auto" href="/">
                    <div class="logo">doctor.smart</div>
                </a>
            </nav>
        </div>

        <div class="container mt-5">
            <div class="row justify-content-center align-items-center">
				<?php foreach ($docs as $doc) : ?>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <a class="text-decoration-none" href="">
                                    <div class="d-flex">
                                        <div class="userimg">
                                            <img
                                                    src="<?= SITE_URL ?>/assets/img/users/<?= $doc['user_id'] ?>.png"
                                                    alt="" loading="lazy" class="img-fluid" width="100" style="width: 100px;height: 100px;object-fit: cover;">
                                        </div>
                                        <div class="usercontents">
                                            <h4><?= $doc['name'] ?></h4>
                                            <h6><?= $doc['short_qualification'] ?></h6>
                                            <p><?= $doc['about'] ?></p>
                                            <span>View Now <i class="fas fa-long-arrow-alt-right"></i></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
    </div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>