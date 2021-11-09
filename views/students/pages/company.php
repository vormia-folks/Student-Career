<!-- Sigup / Register -->
<section class="register">
    <div class="container">
        <div class="row">
            <div class="col align-self-center">
                <div class="register-tabs">
                    <div class="tabs-header">
                        <h2>Welcome!</h2>
                        <h4>Get Started by registering to our portal</h4>
                    </div>

                    <div class="tabs-area">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Employer Registration</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="register-form">
                                    <form class="" action="<?= $base_url; ?>/signup/company" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Notification -->
                                                <?= $notify; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Enter Company Email <i class="fas fa-asterisk"></i></label>
                                                    <input type="email" class="form-control" name="email" value="<?= $form_value->email; ?>">
                                                    <span class="error"><?= $form_error->email; ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label"> Phone number <small>Eg. (07xxxxxxx)</small> </label>
                                                    <input type="text" class="form-control" name="mobile" value="<?= $form_value->mobile; ?>">
                                                    <span class="error"><?= $form_error->mobile; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Enter Password <i class="fas fa-asterisk"></i></label>
                                                    <input type="password" class="form-control" name="password">
                                                    <span class="error"><?= $form_error->password; ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label"> Confirm Password <i class="fas fa-asterisk"></i></label>
                                                    <input type="password" class="form-control" name="confirm_password">
                                                    <span class="error"><?= $form_error->confirm_password; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Submit -->
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-lg btn-success text-center  w-100">
                                                    Confirm Registration <i class="fas fa-check"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>