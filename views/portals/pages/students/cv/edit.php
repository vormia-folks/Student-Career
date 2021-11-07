<div class="card">
    <div class="card-header">
        <h3>Student Personal CV</h3>
    </div>
    <div class="card-body">
        <div class="notification">
            <?= $notify; ?>
        </div>

        <div class="body-content">
            <form action="<?= $base_url; ?>/portal/student/cv/update" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
                <!-- hidden input to store curriculums id -->
                <input type="hidden" name="id" value="<?= $curriculumInfo['id']; ?>">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Name </label>
                            <input type="text" class="form-control" disabled value="<?= $studentInfo['student_name'] ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Email </label>
                            <input type="text" class="form-control" disabled value="<?= $studentInfo['student_email'] ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">University </label>
                            <input type="email" class="form-control" disabled value="<?= $studentInfo['university_name'] ?>">
                            <span class="error"></span>
                        </div>
                    </div>

                </div>

                <hr />

                <h5><strong>Your CV Info:</strong></h5>

                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Type Of Attachment <i class="fas fa-asterisk"></i></label>
                            <select class="form-select" aria-label="Default select example" name="attachment">
                                <?php if (is_null($attachments)) : ?>
                                    <option>No Option</option>
                                <?php else : ?>
                                    <?php foreach ($attachments as $attachment) : ?>
                                        <!-- check if option_id = $curriculumInfo['attachment] if is match the set option as selected -->
                                        <option value="<?= $attachment['option_id']; ?>" <?= ($attachment['option_id'] == $curriculumInfo['attachment']) ? 'selected' : ''; ?>><?= $attachment['option_title']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Your Availability <i class="fas fa-asterisk"></i></label>
                            <select class="form-select" aria-label="Default select example" name="availability">
                                <!-- do same for availability -->
                                <?php if (is_null($availabilities)) : ?>
                                    <option>No Option</option>
                                <?php else : ?>
                                    <?php foreach ($availabilities as $availability) : ?>
                                        <option value="<?= $availability['option_id']; ?>" <?= ($availability['option_id'] == $curriculumInfo['availability']) ? 'selected' : ''; ?>><?= $availability['option_title']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Your Major <i class="fas fa-asterisk"></i></label>
                            <select class="form-select" aria-label="Default select example" name="major">
                                <?php if (is_null($majors)) : ?>
                                    <option>No Option</option>
                                <?php else : ?>
                                    <?php foreach ($majors as $major) : ?>
                                        <option value="<?= $major['option_id']; ?>" <?= ($major['option_id'] == $curriculumInfo['major']) ? 'selected' : ''; ?>><?= $major['option_title']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="error"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">About Your Self <i class="fas fa-asterisk"></i></label>
                            <textarea class="form-control" rows="5" name="about"><?= $curriculumInfo['about'] ?></textarea>
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