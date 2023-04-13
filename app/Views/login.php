<!doctype html>
<html lang="en">

<head>
    <base href="<?=base_url()?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="assets/admin/css/easion.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="assets/admin/js/chart-js-config.js"></script>
    <title>GCE-WD - Login</title>
</head>

<body>
    <div class="form-screen">
        <a href="" class="easion-logo"><i class="fas fa-sun"></i> <span>GCE-WD</span></a>
        <div class="card account-dialog">
            <div class="card-header bg-primary text-white"> Please sign in </div>
            <div class="card-body">
                <form action="login" method="post" id="form-login-user">
                    <?= view('messages/message') ?>
                    <div class="form-group">
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label id="rememberMe" class="custom-control-label" for="customCheck1">Remember me</label>
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="wrapper">
                        <canvas id="canvas" width="200" height="70"></canvas>
                    <div id="reload-button" class="mb-3"> change </div>
                    </div>
                    <input
                        class="form-control"
                        type="text"
                        id="user-input"
                        placeholder="Enter the text in the image"
                    />
                    </div>
                    <div class="account-dialog-actions">
                        <button id="submit-button" type="submit" class="btn btn-primary">Sign in</button>
                        <a class="account-dialog-link" href="signup.html">Create a new account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="assets/admin/js/easion.js"></script>
    <script src="assets/admin/js/capcha.js"></script>
    <script src="assets/admin/css/capcha.css"></script>
    <script>
        $(function () {

        if (localStorage.chkbox && localStorage.chkbox != '') {
            $('#customCheck1').attr('checked', 'checked');
            $('#exampleInputEmail1').val(localStorage.username);
            $('#exampleInputPassword1').val(localStorage.pass);
        } else {
            $('#customCheck1').removeAttr('checked');
            $('#exampleInputEmail1').val('');
            $('#exampleInputPassword1').val('');
        }

        $('#customCheck1').click(function () {

            if ($('#customCheck1').is(':checked')) {
                // save username and password
                localStorage.username = $('#exampleInputEmail1').val();
                localStorage.pass = $('#exampleInputPassword1').val();
                localStorage.chkbox = $('#customCheck1').val();
            } else {
                localStorage.username = '';
                localStorage.pass = '';
                localStorage.chkbox = '';
            }
        });
        });
    </script>
</body>

</html>