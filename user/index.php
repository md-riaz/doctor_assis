<?php
$pageTitle = "Home";
require_once dirname(__DIR__) . '/includes/header.php';
checkLogin(); ?>
<div class="container">
  <div class="row">
    <!-- section title -->
    <div class="heading">
      <h1>Doctor Assistant</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="nav flex-column nav-pills me-3">
        <a class="nav-link active" data-bs-toggle="pill" href="#v-pills-reports" role="tab">Recent Reports</a>
        <a class="nav-link" data-bs-toggle="pill" href="#v-pills-schedules" role="tab">Schedules</a>
        <a class="nav-link" data-bs-toggle="pill" href="#v-pills-settings" role="tab">Settings</a>
        <a class="nav-link" href="javascript:logout()">Logout</a>
      </div>
    </div>
    <div class="col-md-9">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="v-pills-reports">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>First</th>
                  <th>Last</th>
                  <th>Handle</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th>2</th>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <th>3</th>
                  <td colspan="2">Larry the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
        <div class="tab-pane fade" id="v-pills-schedules">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>First</th>
                  <th>Last</th>
                  <th>Handle</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th>2</th>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <th>3</th>
                  <td colspan="2">Larry the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade" id="v-pills-settings">...
        </div>
      </div>
    </div>

  </div>
</div>
<?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>