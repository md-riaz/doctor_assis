<?php
$pageTitle = "Dashboard";
require_once dirname(__DIR__) . '/includes/header.php';
checkLogin();
$data = $getSingleData("SELECT  DAYNAME(appoint_date) as day , COUNT(id) as total FROM `appointment` WHERE appoint_date > DATE_SUB('$timestamp', INTERVAL 1 WEEK)  GROUP BY DAYNAME(appoint_date)");

?>
<?php require_once('includes/header.php') ?>

<div class="container-fluid">
    <div class="row">
		<?php require_once('includes/navigation.php') ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>
            <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

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
                labels: [<?= json_encode($data['day']) ?>],
                datasets: [{
                    data: [<?= json_encode($data['total']) ?>],
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