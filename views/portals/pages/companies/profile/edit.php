<div class="card">
    <div class="card-header">
        <h3>Company Profile</h3>
    </div>
    <div class="card-body">
        <div class="notification">
            <?= $notify; ?>
        </div>

        <div class="body-content">
            <form action="<?= $base_url; ?>/portal/company/profile/update" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Organization Name </label>
                            <input type="text" class="form-control" disabled value="<?= $organization_details->organization_name; ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Organization Website </label>
                            <input type="text" class="form-control" disabled value="<?= $organization_details->organization_website; ?>">
                            <span class="error"></span>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Student Email <i class="fas fa-asterisk"></i></label>
                            <input type="email" class="form-control" name="email" required value="<?= $user_details->company_email; ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label"> Phone number <small>Eg. (07xxxxxxx)</small> </label>
                            <?php $phone_number = ($user_details->company_mobile) ? '0' . $user_details->company_mobile : ''; ?>
                            <input type="number" class="form-control" name="mobile" value="<?= $phone_number; ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">New Password <i class="fas fa-asterisk"></i></label>
                            <input type="password" class="form-control" name="password">
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