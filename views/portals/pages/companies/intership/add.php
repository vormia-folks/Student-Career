<div class="card">
    <div class="card-header">
        <h3>Add Intership</h3>
    </div>
    <div class="card-body">
        <div class="notification">
            <?= $notify; ?>
        </div>

        <div class="body-content">
            <form action="<?= $base_url; ?>/portal/company/intership/save" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
                <!-- create input organization hidden -->
                <input type="hidden" name="organization" value="<?= $organization; ?>">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Type Of Intership <i class="fas fa-asterisk"></i></label>
                            <select class="form-select" aria-label="Default select example" name="attachment">
                                <?php if (is_null($attachments)) : ?>
                                    <option>No Option</option>
                                <?php else : ?>
                                    <?php foreach ($attachments as $attachment) : ?>
                                        <option value="<?= $attachment['option_id']; ?>"><?= $attachment['option_title']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Availability <i class="fas fa-asterisk"></i></label>
                            <select class="form-select" aria-label="Default select example" name="availability">
                                <!-- do same for availability -->
                                <?php if (is_null($availabilities)) : ?>
                                    <option>No Option</option>
                                <?php else : ?>
                                    <?php foreach ($availabilities as $availability) : ?>
                                        <option value="<?= $availability['option_id']; ?>"><?= $availability['option_title']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Major <i class="fas fa-asterisk"></i></label>
                            <select class="form-select" aria-label="Default select example" name="major">
                                <?php if (is_null($majors)) : ?>
                                    <option>No Option</option>
                                <?php else : ?>
                                    <?php foreach ($majors as $major) : ?>
                                        <option value="<?= $major['option_id']; ?>"><?= $major['option_title']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Paid <i class="fas fa-asterisk"></i></label>
                            <select class="form-select" aria-label="Default select example" name="paid">
                                <option value="paid">Paid Intern</option>
                                <option value="none-paid">None Pay Intern</option>
                            </select>
                            <span class="error"></span>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Targeted University <i class="fas fa-asterisk"></i></label>
                            <select class="form-select" aria-label="Default select example" name="university">
                                <option value="0">--- Any ---</option>
                                <?php if (is_null($universities)) : ?>
                                    <option>None Found</option>
                                <?php else : ?>
                                    <?php foreach ($universities as $university) : ?>
                                        <option value="<?= $university['university_id']; ?>"><?= $university['university_name']; ?></option>
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
                            <label class="form-label">About The Internship <i class="fas fa-asterisk"></i></label>
                            <textarea class="form-control" rows="10" name="description"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="row float-end">
                    <div class="col-md-12 col-sm-12">
                        <button type="submit" class="btn btn-lg btn-primary w-100">
                            Save <i class="fas fa-check"></i>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>