<?php
$pageTitle = "Home";
require_once __DIR__ . '/includes/header.php';
?>
    <div class="container-fluid">
        <div class="row">
            <!-- Just an image -->
            <nav class="navbar navbar-light position-fixed">
                <div class="container">
                    <a class="navbar-brand" href="<?= SITE_URL ?>">
                        <div class="logo">doc.assistant</div>
                    </a>
                </div>
            </nav>
            <div class="hero_section" style="background-image: url('assets/img/bg.png')">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1 class="text-uppercase text-primary">Easy & innovative way to set an appointment
                                today</h1>
                            <div class="d-grid gap-2 d-md-block mt-4">
                                <a href="<?= SITE_URL ?>/login/" class="btn btn-outline-primary px-4 me-md-3">Login</a>
                                <a href="<?= SITE_URL ?>/registration/" class="btn btn-primary px-4">Make an
                                    Appointment</a>
                            </div>
                        </div>
                        <div class="col-md-6 d-none d-md-block">
                            <div class="text-center">
                                <img width="200" src="../assets/img/doc.png" alt="doc" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="video_section bg-primary">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <a href="https://www.youtube.com/watch?v=G4hGBS5lxVw" class="video_thumb mx-auto"
                               style="background-image: url(<?= SITE_URL . '/assets/img/video_bg.jpg' ?>)">
                                <div class="play_icon">
                                    <i class="far fa-play-circle"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col text-center text-white">
                            <h2 class="title_decor">Watch Our Video</h2>
                            <p>If you are unsure to trust us, please watch the video and decide yourself.</p>
                        </div>
                    </div>
                </div>
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
                    <li class="me-3"><a href="#">Privac Policy</a></li>
                    <li><a href="#">Terms &amp; Conditions</a></li>
                </ul>
            </div>
        </div>
    </div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>