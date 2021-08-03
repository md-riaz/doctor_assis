<?php
$pageTitle = "Doctor Requests";
require_once dirname(__DIR__) . '/includes/header.php';
checkLogin();
?>

<?php require_once('includes/header.php') ?>

    <div class="container-fluid">
        <div class="row">
			<?php require_once('includes/navigation.php') ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3">
                    <h2>Requests</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm vertical-align-middle ws_nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Department</th>
                                <th>Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php
							$data = MySQLDataPagination("SELECT d.id,u.name, u.email,u.phone, d.short_qualification, d.about, department.name as department, d.created_at FROM `user` as u JOIN doctor as d on d.user_id = u.id JOIN department ON department.id = d.department_id WHERE d.status = '0'");
							if (!$data['content']) : ?>
                                <tr>
                                    <td colspan="10" class="text-center">No Data Available</td>
                                </tr>
							<?php else : ?>
								<?php foreach ($data['content'] as $item) : ?>
                                    <tr>
                                        <td><?= $item['id'] ?></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['phone'] ?></td>
                                        <td><?= $item['department'] ?></td>
                                        <td><?= date('d-M-Y', strtotime($item['created_at'])) ?></td>
                                        <td>
                                            <a href="<?= SITE_URL ?>/admin/post/doctor_post.php?action=enable&id=<?= $item['id'] ?>" data-confirm="Are you sure you want to accept this request ?"
                                               class="btn btn-sm btn-primary"><span
                                                        data-feather="user-plus"></span> Enable</a>
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