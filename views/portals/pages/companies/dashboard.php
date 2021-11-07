<div class="card">
    <div class="card-header">
        <h3>Company Profile</h3>
    </div>
    <div class="card-body">
        <div class="notification">
            <?= $notify; ?>
        </div>

        <div class="body-content">
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">First Name <i class="fas fa-asterisk"></i></label>
                            <input type="text" class="form-control" name="student_first_name" required>
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Last Name <i class="fas fa-asterisk"></i></label>
                            <input type="text" class="form-control" name="student_last_name" required>
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Student Email <i class="fas fa-asterisk"></i></label>
                            <input type="email" class="form-control" name="student_email" required>
                            <span class="error"></span>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label"> Phone number <small>Eg. (07xxxxxxx)</small> </label>
                            <input type="number" class="form-control" name="student_phone_number" required>
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Personal Email </label>
                            <input type="email" class="form-control" name="student_personal_email" required>
                            <span class="error"></span>
                        </div>
                    </div>
                </div>

                <hr />

                <h5><strong>Update Password:</strong></h5>

                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">New Password <i class="fas fa-asterisk"></i></label>
                            <input type="password" class="form-control" name="student_password" required>
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label"> Confirm New Password <i class="fas fa-asterisk"></i></label>
                            <input type="password" class="form-control" name="confrm_student_password" required>
                            <span class="error"></span>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="row float-end">
                    <div class="col-md-12 col-sm-12">
                        <button type="submit" class="btn btn-lg btn-success w-100">
                            Update <i class="fas fa-check"></i>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>