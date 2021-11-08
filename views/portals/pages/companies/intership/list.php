<div class="card">
    <div class="card-header">
        <h3>Company Interships</h3>
    </div>
    <div class="card-body">

        <div class="action-area">
            <div class="row float-end">
                <div class="col-md-12">
                    <a href="<?= $base_url; ?>/portal/company/intership/add" class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                        Add Intership
                    </a>
                </div>
            </div>
            <div class="notification">
                <?= $notify; ?>
            </div>

            <div class="body-content">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
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
                                    <td><?= $intership['type']; ?></td>
                                    <td><?= $intership['major']; ?></td>
                                    <td><?= $intership['availability']; ?></td>
                                    <td><?= $intership['university']; ?></td>
                                    <td><?= $intership['status']; ?></td>
                                    <td>
                                        <a href="<?= $base_url; ?>/portal/company/intership/edit/<?= $intership['id']; ?>" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <?php $delete_url = "$base_url/portal/company/intership/delete?id=" . $intership['id']; ?>
                                        <a onclick="confirmAction('<?= $delete_url; ?>');" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
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