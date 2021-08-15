<?php
$pageTitle = "Doctor Requests";
require_once dirname(__DIR__) . '/includes/header.php';
checkLogin();
require_once('includes/header.php') ?>

    <div class="container-fluid">
        <div class="row">
			<?php require_once('includes/navigation.php') ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3">
                    <h2>All Users</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm vertical-align-middle ws_nowrap">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Starting Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php
							$data = MySQLDataPagination("SELECT id, name, email, phone, status, created_at FROM `user` WHERE group_id = 0 ORDER BY status DESC");
							if (!$data['content']) : ?>
                                <tr>
                                    <td colspan="10" class="text-center">No Data Available</td>
                                </tr>
							<?php else : ?>
								<?php foreach ($data['content'] as $item) : ?>
                                    <tr class="<?= !$item['status'] ? 'text-muted' : '' ?>">
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['phone'] ?></td>
                                        <td><?= $item['email'] ?></td>
                                        <td><?= date("Y-m-d h:i a", strtotime($item['created_at'])) ?></td>
                                        <td>
											<?php if ($item['status']): ?>
                                                <a href="<?= SITE_URL ?>/admin/post/user_post.php?action=disable&id=<?= $item['id'] ?>"
                                                   data-confirm="Are you sure you want to disable this user ?"
                                                   class="btn btn-sm btn-danger">
                                                    <span data-feather="trash"></span> Disable
                                                </a>
											<?php else: ?>
                                                <a href="<?= SITE_URL ?>/admin/post/user_post.php?action=enable&id=<?= $item['id'] ?>"
                                                   data-confirm="Are you sure you want to enable this user ?"
                                                   class="btn btn-sm btn-success">
                                                    <span data-feather="check"></span> Enable
                                                </a>
											<?php endif; ?>
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