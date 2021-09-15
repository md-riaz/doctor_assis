<?php
$pageTitle = "Create Report";
require_once dirname(__DIR__) . '/includes/header.php';
checkLogin();

$id = $_GET['aid']??null;

if (!$id) die('Invalid ID');

$sql = "SELECT doc.name as doctor, d.id as doc_id, h.name AS hospital, a.symptom, a.gender, a.blood_group, IF(self, u.name, a.name) as name, u.email, u.phone, a.appoint_date FROM `appointment` as a JOIN user as u ON a.user_id = u.id JOIN hospital as h ON h.id = a.hospital_id JOIN doctor as d ON d.id = a.doc_id JOIN user as doc ON doc.id = d.user_id WHERE a.id = $id";

$data = $getSingleData($sql);

if (!$data) die('Invalid ID');

?>

<?php require_once('includes/header.php') ?>

<div class="container-fluid">
    <div class="row">
		<?php require_once('includes/navigation.php') ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="pt-3 pb-2 mb-3">
                <div class="card">
                    <div class="card-header">
                        Create Report
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3"><b>Patient Name : </b><?= $data['name'] ?></div>
                            <div class="col-md-3"><b>Gender : </b><?= $gender[$data['gender']] ?></div>
                            <div class="col-md-3"><b>Blood Group : </b><?= $data['blood_group'] ?></div>
                            <div class="col-md-3"><b>Appointment Id : </b><?= $id ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Hospital</label>
                                    <input type="text" class="form-control" value="<?= $data['hospital'] ?>"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Doctor</label>
                                    <input type="text" class="form-control" value="<?= $data['doctor'] ?>"
                                           disabled>
                                </div>
                            </div>
                        </div>
                        <form action="post/report_post.php?action=add" method="post">
                            <input type="hidden" name="appointment_id" value="<?= $id ?>">
                            <input type="hidden" name="doc_id" value="<?= $data['doc_id'] ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label fw-bold">Title</label>
                                        <input type="text" name="title" class="form-control" required
                                               value="<?= "{$data['name']}'s Report" ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label fw-bold">Prescription Details</label>
                                        <textarea class="form-control editor" name="prescription" cols="30"
                                                  rows="20"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" value="update_profile" class="btn btn-primary w-25">Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>


<?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>

<script>
    tinymce.init({
        selector: 'textarea.editor',
        branding: false,
        plugins: 'link code advlist lists table autosave anchor autolink preview print wordcount searchreplace template',
        toolbar: 'styleselect formatting forecolor backcolor align| link numlist bullist table | template searchreplace preview print code removeformat',
        table_default_attributes: {
            border: '1'
        },
        table_cell_advtab: true,
        menubar: false,
        visual: false,
        forced_root_block: '',
        entity_encoding: "raw",
        extended_valid_elements: "em[class|name|id]",
        apply_source_formatting: false,                //added option
        verify_html: false,
        templates: [
            {
                title: "Report Template",
                description: "This is the report template for an report",
                url: "<?= SITE_URL . '/assets/report.html' ?>"
            }
        ]
    });
</script>
