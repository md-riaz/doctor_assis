<?php
$pageTitle = "Home";
require_once __DIR__ . '/includes/header.php';
$doc = [];
if (!empty($_GET['id'])) {
	$doc = $con->query("SELECT d.id, d.short_qualification, d.about, d.facebook, d.linkedin, d.specialist, d.experience, d.qualification, d.membership, u.id as user_id, u.name, u.email, u.phone, dp.name as dep_name FROM `doctor` as d JOIN user as u ON d.user_id = u.id JOIN department as dp ON dp.id = d.department_id WHERE u.status != 0 AND d.id = $_GET[id]")->fetch_assoc();

	$chamberTime = GetData("SELECT h.name as hospital, ca.time_from, ca.time_to FROM `chamber_availability` as ca JOIN hospital as h ON h.id = ca.hospital_id WHERE ca.doc_id = $_GET[id]");

} else {
	die('Invalid Doctor');
}
?>
    <div class="container-fluid">
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
    <section class="py-5 hero_overlay position-relative"
             style="background: rgba(4, 93, 233, 0.95) url('<?= SITE_URL ?>/assets/img/herobg.jpg') no-repeat center/cover;">
        <div class="container mt-5">
			<?php if (isset($doc)) : ?>
                <div class="row justify-content-center align-items-center position-relative text-white">
                    <div class="col-md-12">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <img src="<?= SITE_URL ?>/assets/img/users/<?= $doc['user_id'] ?>.png" alt=""
                                     loading="lazy"
                                     class="img-fluid  rounded-start"
                                     style="object-fit: cover; padding:5px;border: 1px solid #eee;">
                            </div>
                            <div class="col-md-8">
                                <h2 class="title display-2"><?= $doc['name'] ?></h2>
                                <h5 class="mb-4"><?= $doc['short_qualification'] ?></h5>
                                <p><?= $doc['about'] ?></p>
								<?php
								if (!empty($chamberTime)) { ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-white">
                                            <thead>
                                            <tr class="text-center bg-gradient">
                                                <th colspan="3">Available To</th>
                                            </tr>
                                            </thead>
                                            <tbody>
											<?php foreach ($chamberTime as $time) { ?>
                                                <tr>
                                                    <td><?= $time['hospital'] ?></td>
                                                    <td><?= date('H:i a', strtotime($time['time_from'])) ?>
                                                        - <?= date('H:i a', strtotime($time['time_to'])) ?></td>
                                                </tr>
											<?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
								<?php } ?>
                                <a href="<?= SITE_URL ?>/setAppointment.php?doc_id=<?= $_GET['id'] ?>"
                                   class="btn btn-warning">Appoint Now</a>
                                <div class="d-block mt-3">
                                    <a href="<?= $doc['facebook'] ?>" class="ms-2 fa-2x"><i
                                                class="fab fa-facebook-square"></i></a>
                                    <a href="<?= $doc['linkedin'] ?>" class="ms-2 fa-2x"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			<?php endif; ?>
        </div>
    </section>
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <h2 class="text-uppercase text-center mb-5">about <?= $doc['name'] ?></h2>
                <div class="col-md-6">
					<?= $doc['specialist'] ?>
                </div>
                <div class="col-md-6">
					<?= $doc['experience'] ?>
                </div>
            </div>
        </div>
    </section>
<?php if (isset($doc['qualification'])) : ?>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <h2 class="text-uppercase text-center mb-5">Career</h2>
                <div class="col-md-12">
					<?= $doc['qualification'] ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (isset($doc['membership'])) : ?>
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <h2 class="text-uppercase text-center mb-5">Professional Membership</h2>
                <div class="col-md-12">
					<?= $doc['membership'] ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
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