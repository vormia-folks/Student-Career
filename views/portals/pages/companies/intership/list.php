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
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>