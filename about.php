<?php
$pageTitle = "About";
require_once __DIR__ . '/includes/header.php';
?>
    <div class="container-fluid">
        <div class="row">
            <!-- Just an image -->
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
                                <a class="nav-link " aria-current="page" href="<?= SITE_URL ?>">Home</a>
                            </li>
                            <li class="nav-item fw-bold ms-md-3 my-2">
                                <a class="nav-link active" href="<?= SITE_URL ?>/about.php">About</a>
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
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <section class="full-section" style="margin-top:200px">
                    <h2>Why do we use it?</h2>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page
                        when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                        distribution of letters, as opposed to using 'Content here, content here', making it look like
                        readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as
                        their default model text, and a search for 'lorem ipsum' will uncover many web sites still in
                        their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on
                        purpose (injected humour and the like).</p>
                </section>
            </div>
        </div>
    </div>
    <div class="container footer">
        <div class="row align-items-center">
            <div class="col-md-6 my-3">
                <p>Copyright @ <?= date('Y') ?>, <?= APP_NAME ?>. All rights reserved.</p>
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