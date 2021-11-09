<div class="card">
    <div class="card-header">
        <h3>Edit Your Intership Application</h3>
    </div>
    <div class="card-body">
        <div class="notification">
            <?= $notify; ?>
        </div>

        <div class="body-content">
            <form action="#" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
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
                <h5><strong>Your CV Info:</strong> <small>What Employer will see</small></h5>

                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Names </label>
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
                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Your University </label>
                            <input type="text" class="form-control" disabled value="<?= ucwords($curriculumInfo['university']); ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Attachment </label>
                            <input type="text" class="form-control" disabled value="<?= ucwords($curriculumInfo['attachment']); ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Your Major </label>
                            <input type="text" class="form-control" disabled value="<?= ucwords($curriculumInfo['major']); ?>">
                            <span class="error"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Your CV Description</label>
                            <textarea class="form-control" rows="5" disabled><?= ucwords($curriculumInfo['description']); ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Availability </label>
                            <input type="text" class="form-control" disabled value="<?= ucwords($curriculumInfo['availability']); ?>">
                            <span class="error"></span>
                        </div>
                    </div>
                </div>

                <hr />
                <h5><strong>About My Application:</strong> <small>Say something</small></h5>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Application Summary</label>
                            <textarea class="form-control" rows="3" disabled><?= $description; ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Reponse Given</label>
                            <textarea class="form-control" rows="3" disabled><?= $response; ?></textarea>
                        </div>
                    </div>
                </div>

                <hr />
            </form>
        </div>
    </div>
</div>