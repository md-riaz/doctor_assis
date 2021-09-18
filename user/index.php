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
                <div class="d-flex justify-content-between">
                    <h2>Recent Appointments</h2>
                    <div class="">
                        <a href="/" class="btn btn-sm btn-primary">Make an appointment</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm vertical-align-middle ws_nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Appointment Date</th>
                            <th>Status</th>
                            <th>Reason</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php
						$data = MySQLDataPagination("SELECT * FROM appointment WHERE user_id = $_SESSION[id] ORDER BY id DESC");
						if (!$data['content']) :
							?>
                            <tr>
                                <td colspan="10" class="text-center">No Data Available</td>
                            </tr>
						<?php else : ?>
							<?php foreach ($data['content'] as $item) : ?>
								<?php
								$app_date = strtotime($item['appoint_date']);
								$status = $app_date < time() || !$item['status'] ? "<i class='far fa-times-circle text-danger'></i>" : "<i class='fas fa-check-circle text-success'></i>";
								$hasReport = $getSingleData("SELECT COUNT(id) as found FROM `report` WHERE appoint_id = $item[id]");
								if ($hasReport['found']) {
									$status = "<i class='fas fa-check-circle text-success'></i>";
								}
								?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= date("d-M-Y, g:i a", $app_date) ?></td>
                                    <td><?= $status ?></td>
                                    <td><?= $item['symptom'] ?></td>
                                    <td><?= date('d-M-Y', strtotime($item['created_at'])) ?></td>
                                    <td>
										<?php if ($app_date > strtotime('- 1 day') && $item['status'] == '1'): ?>
                                            <a href="<?= SITE_URL ?>/user/post/appointment_post.php?action=cancel&id=<?= $item['id'] ?>"
                                               data-confirm="Are you sure you want to cancel the appointment ?"
                                               class="btn btn-sm btn-danger"><span
                                                        data-feather="trash"></span> Cancel</a>
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


<?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
<script>    // Graphs
    let ctx = document.getElementById('myChart');
    // eslint-disable-next-line no-unused-vars
    if (ctx) {
        let myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    'Sunday',
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday'
                ],
                datasets: [{
                    data: [
                        15339,
                        21345,
                        18483,
                        24003,
                        23489,
                        24092,
                        12034
                    ],
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    borderWidth: 4,
                    pointBackgroundColor: '#007bff'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                },
                legend: {
                    display: false
                }
            }
        })
    }</script>
