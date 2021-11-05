<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Error! <?= $site_title; ?></title>
    <!-- Favicon Load -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link type="text/css" rel="stylesheet" href="<?= $asset_url; ?>/students/css/error.css" />


    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    <meta name="robots" content="noindex, follow">
</head>

<body>
    <div id="notfound">
        <div class="notfound">

            <!-- Main Page -->
            <div class="notfound-404">
                <h1>STOP</h1>
            </div>
            <h2>Oops! Permission denied</h2>
            <p>You are not allowed to open the page you are looking for. If this is an error try to login again.
                <a class="home-link" href="<?= $base_url; ?>">Return to homepage</a>
            </p>
            <div class="container">
                <di class="row">
                    <div class="col-md-6 offset-md-3">
                        <a href="<?= $base_url; ?>/login" class="btn btn-danger btn-sm w-100">
                            Login Again
                        </a>
                    </div>
                </di>
            </div> <!-- End Main Page -->

        </div>
    </div>

</body>

</html>