<?php
$pageTitle = "Home";
require_once __DIR__ . '/includes/header.php';
$departments = GetData("select * from department where status = '1'");

?>
    <div class="container-fluid">
        <div class="row">
            <!-- Just an image -->
            <nav class="navbar navbar-expand-md navbar-light position-fixed">
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
                                <a class="nav-link active" aria-current="page" href="<?= SITE_URL ?>">Home</a>
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
    <div class="hero_section py-5" style="background-image: url('<?= SITE_URL . '/assets/img/bg.png' ?>')">
        <div class="container">
            <div class="row align-items-center text-center my-5">
                <div class="col-md-10 mx-auto">
                    <h1 class="text-uppercase text-primary">Please Select a Specialist Area</h1>
                    <div class="row mt-4">
						<?php foreach ($departments as $department): ?>
                            <div class="col-6 col-lg-4 col-xl-3">
                                <a href="<?= SITE_URL . '/doctors.php?dep_id=' . $department['id'] ?>"
                                   class="card-text text-decoration-none d-block">
                                    <div class="card mx-auto m-2 shadow" style="height: 150px;width: 200px;">
                                        <div class="card-body align-items-center card-body d-flex flex-column justify-content-center">
                                            <img src="<?= SITE_URL . '/assets/img/department/' . $department['id'] . '.svg' ?>"
                                                 alt="<?= $department['name'] ?>" class="img-fluid"
                                                 width="60">
                                            <p class="mt-2"><?= $department['name'] ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
						<?php endforeach; ?>
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