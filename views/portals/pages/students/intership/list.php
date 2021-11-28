<div class="card">
    <div class="card-header">
        <h3>Interships Opportunities</h3>
    </div>
    <div class="card-body">

        <div class="action-area">
            <div class="notification">
                <?= $notify; ?>
            </div>

            <div class="body-content">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Company</th>
                            <th scope="col">Type</th>
                            <th scope="col">Major</th>
                            <th scope="col">Availability</th>
                            <th scope="col">University</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- if interships is not null then loop else tr td no results was found -->
                        <?php if ($interships != null) { ?>
                            <?php foreach ($interships as $intership) { ?>
                                <tr>
                                    <th scope="row"><?= $intership['id']; ?></th>
                                    <td><?= $intership['company']; ?></td>
                                    <td><?= $intership['type']; ?></td>
                                    <td><?= $intership['major']; ?></td>
                                    <td><?= $intership['availability']; ?></td>
                                    <td><?= $intership['university']; ?></td>
                                    <td><?= $intership['status']; ?></td>
                                    <td>
                                        <!-- Apply action button -->
                                        <?php $apply_url = "$base_url/portal/student/intership/apply?id=" . $intership['id']; ?>
                                        <a href="<?= $apply_url; ?>" class="btn btn-primary">
                                            <i class="fa fa-check"></i>
                                            Apply
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="7">No results found</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>