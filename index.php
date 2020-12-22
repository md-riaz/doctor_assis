<?php 
$pageTitle = "Home";
require_once __DIR__.'/includes/header.php';
?>
<div class="container">
  <div class="row">
    <!-- section title -->
    <div class="heading">
      <h1>Doctor Assistant</h1>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="table-responsive">
        <table class="table">
          <thead>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="main_list d-flex align-items-center">
                  <div class="icon"><i class="fas fa-user-plus"></i></div>
                  <div class="listText">
                    <h6>New Patient record</h6>
                    <p>Creates a new record and saves itto the patient database.</p>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>

        </table>
      </div>
    </div>
  </div>
</div>
<?php require_once __DIR__.'/includes/footer.php'; ?>