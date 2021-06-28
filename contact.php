<?php
$pageTitle = "Contact";
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
                                <a class="nav-link " href="<?= SITE_URL ?>/about.php">About</a>
                            </li>
                            <li class="nav-item fw-bold ms-md-3 my-2">
                                <a class="nav-link active" href="<?= SITE_URL ?>/contact.php">Contact</a>
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
        <div class="row full-section">
            <div class="col-md-8 mx-auto" style="margin-top: 200px;">
                <h1 class="text-uppercase text-primary text-center mb-4">Contact Admin</h1>
                <form>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1"
                               placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                  required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
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