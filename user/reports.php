<?php
$pageTitle = "Home";
require_once dirname(__DIR__) . '/includes/header.php';
checkLogin();

?>

<?php require_once('includes/header.php') ?>

    <div class="container-fluid">
        <div class="row">
			<?php require_once('includes/navigation.php') ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3">
                    <h2>Recent Reports</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm vertical-align-middle ws_nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Doctor</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php
							$data = MySQLDataPagination("SELECT r.id, r.title, u.name as doctor, r.created_at FROM report as r JOIN user as u ON r.user_id = u.id WHERE r.user_id = $_SESSION[id] ORDER BY r.id DESC");

							if (!$data['content']) : ?>
                                <tr>
                                    <td colspan="10" class="text-center">No Data Available</td>
                                </tr>
							<?php else : ?>
								<?php foreach ($data['content'] as $item) : ?>
                                    <tr>
                                        <td><?= $item['id'] ?></td>
                                        <td><?= $item['title'] ?></td>
                                        <td><?= $item['doctor'] ?></td>
                                        <td><?= date('d-M-Y', strtotime($item['created_at'])) ?></td>
                                        <td>
                                            <a href="<?= SITE_URL ?>/user/report_view.php?id=<?= $item['id'] ?>" class="text-primary">
                                                <span data-feather="eye"></span> View
                                            </a>
                                        </td>
                                    </tr>
								<?php endforeach; ?>
							<?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>


<?php require_once dirname(__DIR__) . '/includes/footer.php';