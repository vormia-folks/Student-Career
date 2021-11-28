<div class="card">
    <div class="card-header">
        <h3>My Applications</h3>
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
                            <th scope="col">Approved</th>
                            <th scope="col">Viewed</th>
                            <th scope="col">status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- if interships is not null then loop else tr td no results was found -->
                        <?php if ($applications != null) { ?>
                            <?php foreach ($applications as $application) { ?>
                                <tr>
                                    <th scope="row"><?= $application['id']; ?></th>
                                    <td><?= $application['company']; ?></td>
                                    <td><?= $application['approved']; ?></td>
                                    <td><?= $application['viewed']; ?></td>
                                    <td><?= $application['status']; ?></td>
                                    <td>
                                        <!-- check if $application['status'] == 1 if true show edit button else disable edit button -->
                                        <?php if ($application['show'] == 0) { ?>
                                            <?php $edit_url = "$base_url/portal/student/application/edit?inputID=" . $application['id']; ?>
                                            <a href="<?= $edit_url; ?>" class="btn btn-primary">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>
                                        <?php } else { ?>
                                            <?php $view_url = "$base_url/portal/student/application/view?inputID=" . $application['id']; ?>
                                            <a href="<?= $view_url; ?>" class="btn btn-info">
                                                <i class="fas fa-external-link-alt"></i>
                                                <!-- icon fa link -->
                                                View
                                            </a>
                                        <?php } ?>
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