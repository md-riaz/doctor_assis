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
          <div class="header_left w-50">
            <h1 class="text-uppercase text-primary">Easy & innovative way to set an appointment
              today</h1>
            <div class="d-grid gap-2 d-md-block mt-4">
              <a href="<?= SITE_URL ?>/login/" class="btn btn-outline-primary px-4 me-3">Login</a>
              <a href="<?= SITE_URL ?>/registration/" class="btn btn-primary px-4">Register</a>
            </div>
          </div>
          <div class="header_right w-50 text-center">
            <img width="200" src="../assets/img/doc.png" alt="doc" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>