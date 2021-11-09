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
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Student Registration</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="register-form">
                                    <form class="" action="<?= $base_url; ?>/signup/student" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Notification -->
                                                <?= $notify; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Enter First Name <i class="fas fa-asterisk"></i></label>
                                                    <input type="text" class="form-control" name="first_name" value="<?= $form_value->first_name; ?>">
                                                    <span class="error"><?= $form_error->first_name; ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Enter Last Name <i class="fas fa-asterisk"></i></label>
                                                    <input type="text" class="form-control" name="last_name" value="<?= $form_value->last_name; ?>">
                                                    <span class="error"><?= $form_error->last_name; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Enter Student Email <i class="fas fa-asterisk"></i></label>
                                                    <input type="email" class="form-control" name="email" value="<?= $form_value->email; ?>">
                                                    <span class="error"><?= $form_error->email; ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label"> Phone number <small>Eg. (07xxxxxxx)</small> </label>
                                                    <input type="text" class="form-control" name="phone_number" value="<?= $form_value->phone_number; ?>">
                                                    <span class="error"><?= $form_error->phone_number; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Enter Password <i class="fas fa-asterisk"></i></label>
                                                    <input type="password" class="form-control" name="password" value="">
                                                    <span class="error"><?= $form_error->password; ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label"> Confirm Password <i class="fas fa-asterisk"></i></label>
                                                    <input type="password" class="form-control" name="confirm_password" value="">
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