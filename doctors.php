<?php
$pageTitle = "Select a doctor";
require_once __DIR__ . '/includes/header.php';
$docs = [];
if (!empty($_GET['dep_id'])) {
	$docs = GetData("SELECT d.*, u.id as user_id, u.name, u.email, u.phone, dp.name as dep_name FROM `doctor` as d JOIN user as u ON d.user_id = u.id JOIN department as dp ON dp.id = d.department_id WHERE u.status != 0 AND  d.department_id = $_GET[dep_id]");
}
?>
    <div class="container-fluid ">
        <div class="row">
            <nav class="navbar navbar-expand-md navbar-light">
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
    <div class="container full-section">
        <div class="row justify-content-center align-items-center" style="margin-top: 200px;">
			<?php if (empty($docs)): ?>
                <h1 class="text-uppercase text-primary text-center mb-4">No doctor added in this section</h1>
			<?php else: ?>
                <h1 class="text-uppercase text-primary text-center mb-4">Select Your Doctor</h1>
				<?php foreach ($docs as $doc) : ?>
                    <div class="col-lg-6">
                        <a class="text-decoration-none" href="<?= SITE_URL ?>/doctor_profile.php?id=<?= $doc['id'] ?>">
                            <div class="card mb-3 mx-auto" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-lg-3">
                                        <img src="<?= SITE_URL ?>/assets/img/users/<?= $doc['user_id'] ?>.png" alt=""
                                             loading="lazy" class="img-fluid  rounded-start"
                                             style="object-fit: cover; padding:5px;border: 1px solid #eee;">
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="card-body">
                                            <h5 class="title"><?= $doc['name'] ?></h5>
                                            <p class="card-text mb-0 line-clamp-2"
                                               style="height: 48px;"><?= $doc['short_qualification'] ?></p>
                                            <div class="btn btn-primary">
                                                View Profile <i class="fas fa-long-arrow-alt-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
				<?php endforeach; ?>
			<?php endif; ?>
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