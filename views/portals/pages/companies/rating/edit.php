<div class="card">
    <div class="card-header">
        <h3>Rate Intership Performance</h3>
    </div>
    <div class="card-body">
        <div class="notification">
            <?= $notify; ?>
        </div>

        <div class="body-content">
            <form action="#" id="core" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
                <script>
                    function submitForm(action) {
                        document.getElementById('core').action = action;
                        document.getElementById('core').submit();
                    }
                </script>

                <h5><strong>Intership Info:</strong></h5>

                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Skills </label>
                            <input type="text" class="form-control" disabled value="<?= $internshipInfo['type']; ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Availability </label>
                            <input type="text" class="form-control" disabled value="<?= $internshipInfo['availability']; ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Major </label>
                            <input type="text" class="form-control" disabled value="<?= $internshipInfo['major']; ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Intern Type </label>
                            <input type="text" class="form-control" disabled value="<?= ucwords($internshipInfo['paid']); ?>">
                            <span class="error"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">About The Internship</label>
                            <textarea class="form-control" rows="5" disabled><?= ucwords($internshipInfo['description']); ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Targeted University </label>
                            <input type="text" class="form-control" disabled value="<?= ucwords($internshipInfo['university']); ?>">
                            <span class="error"></span>
                        </div>
                    </div>
                </div>

                <hr />
                <h5><strong>CV Info:</strong> <small>filled by student</small></h5>

                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Student Names </label>
                            <input type="text" class="form-control" disabled value="<?= $studentInfo['first_name']; ?> <?= $studentInfo['last_name']; ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Student Email </label>
                            <input type="text" class="form-control" disabled value="<?= $studentInfo['email']; ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Personal Email </label>
                            <input type="text" class="form-control" disabled value="<?= $studentInfo['personal_email']; ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Mobile Number </label>
                            <input type="text" class="form-control" disabled value="<?= ucwords($studentInfo['paid']); ?>">
                            <span class="error"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Student University </label>
                            <input type="text" class="form-control" disabled value="<?= ucwords($curriculumInfo['university']); ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Attachment </label>
                            <input type="text" class="form-control" disabled value="<?= ucwords($curriculumInfo['attachment']); ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Your Major </label>
                            <input type="text" class="form-control" disabled value="<?= ucwords($curriculumInfo['major']); ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Availability </label>
                            <input type="text" class="form-control" disabled value="<?= ucwords($curriculumInfo['availability']); ?>">
                            <span class="error"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">CV Description</label>
                            <textarea class="form-control" rows="4" disabled><?= ucwords($curriculumInfo['description']); ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Application Summary</label>
                            <textarea class="form-control" rows="4" disabled><?= $description; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Response <small>(optional)</small></label>
                            <textarea class="form-control" rows="4" disabled><?= $response; ?></textarea>
                            <span class="error"><?= $form_error->response; ?></span>
                        </div>
                    </div>
                </div>

                <hr />
                <h5><strong>Enter Student Score:</strong></h5>
                <!-- create input application id hidden -->
                <input type="hidden" name="application" value="<?= $application_id; ?>">
                <?= $response_message; ?>
                <div class="row">

                    <div class="col-md-4 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Student Score <i class="fas fa-asterisk"></i> <small>(Min score : 0 Max score = 10)</small></label>
                            <!-- Check if $student_rating == null, if is null set 0 , use ternarry -->
                            <?php $student_rating = $student_rating == null ? 0 : $student_rating; ?>
                            <input type="number" min="0" max="10" class="form-control" name="score" value="<?= $student_rating; ?>">
                            <span class="error"><?= $form_error->score; ?></span>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <?php $approve_url = "$base_url/portal/company/rating/rate"; ?>
                        <button type="submit" style="margin-top: 5%;" onclick="submitForm('<?= $approve_url ?>')" class="btn btn-lg btn-success w-100">
                            Submit Score <i class="fas fa-check"></i>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>