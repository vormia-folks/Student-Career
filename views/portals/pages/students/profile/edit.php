<div class="card">
    <div class="card-header">
        <h3>Student Personal Profile</h3>
    </div>
    <div class="card-body">
        <div class="notification">
            <?= $notify; ?>
        </div>

        <div class="body-content">
            <form action="<?= $base_url; ?>/portal/student/profile/update" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">First Name <i class="fas fa-asterisk"></i></label>
                            <input type="text" class="form-control" name="first_name" required value="<?= $user_details->student_first_name; ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Last Name <i class="fas fa-asterisk"></i></label>
                            <input type="text" class="form-control" name="last_name" required value="<?= $user_details->student_last_name; ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Student Email <i class="fas fa-asterisk"></i></label>
                            <input type="email" class="form-control" name="email" required value="<?= $user_details->student_email; ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label"> Phone number <small>Eg. (07xxxxxxx)</small> </label>
                            <?php $phone_number = ($user_details->student_phone_number) ? '0' . $user_details->student_phone_number : ''; ?>
                            <input type="number" class="form-control" name="phone_number" value="<?= $phone_number; ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Personal Email </label>
                            <input type="email" class="form-control" name="personal_email" value="<?= $user_details->student_personal_email; ?>">
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
                            <input type="password" class="form-control" name="password">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label"> Confirm New Password <i class="fas fa-asterisk"></i></label>
                            <input type="password" class="form-control" name="confirm_password">
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