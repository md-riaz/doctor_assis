<?php date_default_timezone_set("Asia/Dhaka"); ?>
<div class="modal-header">
    <h5 class="modal-title">Make an Appointment</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="pill" href="#self"
            >For yourslef</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#others"
            >For other</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="self">
            <div class="row">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="appointment" class="form-label">Select a date</label>
                        <input name="ap_date" type="date" class="form-control" id="appointment" required
                               min="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Select time</label>
                        <input name="ap_time" type="time" class="form-control" id="time" required
                               value="<?= date("H:i") ?>" min="09:00" max="19:00">
                    </div>

                    <div class="mb-3">
                        <label for="disease" class="form-label">About Disease</label>
                        <textarea name="disease" id="disease" cols="30" rows="3" class="form-control" required></textarea>
                    </div>

                    <div class="float-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="self_apply" class="btn btn-primary">Set</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="others">
            <div class="row">
                <form action="" method="post">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" id="name" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="number" class="form-label">Number</label>
                            <input name="number" type="text" class="form-control" id="number" required>
                        </div>
                    </div>

                    <div class="row g-3">

                        <div class="mb-3 col">
                            <label for="age" class="form-label">Age</label>
                            <input type="number"
                                   class="form-control"
                                   id="age"
                                   name="age" required>
                        </div>

                        <div class="mb-3 col">
                            <label for="gender" class="form-label d-block">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                       type="radio"
                                       name="gender" id="gender" value="1">
                                <label class="form-check-label" for="gender">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                       type="radio"
                                       name="gender" id="gender2" value="0">
                                <label class="form-check-label" for="gender2">FeMale</label>
                            </div>
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="occupation" class="form-label">Occupation</label>
                        <input name="occupation" type="text" class="form-control" id="occupation" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input name="address" type="text" class="form-control" id="address" required>
                    </div>

                    <div class="mb-3">
                        <label for="appointment" class="form-label">Select a date</label>
                        <input name="ap_date" type="date" class="form-control" id="appointment" required
                               value="<?= date('Y-m-d') ?>"
                               min="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Select time</label>
                        <input name="ap_time" type="time" class="form-control" id="time" required>
                    </div>

                    <div class="mb-3">
                        <label for="disease" class="form-label">About Disease</label>
                        <textarea name="disease" id="disease" cols="30" rows="3" class="form-control" required></textarea>
                    </div>

                    <div class="float-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="other_apply" class="btn btn-primary">Set</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
