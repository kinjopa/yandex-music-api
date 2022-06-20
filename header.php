<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="asset/style/owl.carousel.min.css">
    <link rel="stylesheet" href="asset/style/header.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="asset/style/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="asset/style/style.css">
    <link rel="stylesheet" href="../asset/style/style.css">
    <link rel="stylesheet" href="asset/style/main.css">
    <link rel="stylesheet" type="text/css" href="asset/style/util.css">
    <link rel="stylesheet" type="text/css" href="asset/style/main.css">
    <link rel="stylesheet" type="text/css" href="asset/style/login.css">
    <link rel="stylesheet" type="text/css" href="asset/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="asset/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="asset/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="asset/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="asset/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="asset/style/albom.css">
    <link rel="stylesheet" href="asset/style/normalize.css">
    <title>Музыка</title>
</head>
<body>
<div>
    <div class="header-blue">
        <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search">
            <div class="container"><a class="navbar-brand" href="index.php">FREE MUSIC</a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span
                            class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse"
                     id="navcol-1">
                    <form class="form-inline mr-auto" target="_self">
                        <div class="form-group"><label for="search-field"><i class="fa fa-search"></i></label><input
                                    class="form-control search-field" type="search" name="search" id="search-field">
                        </div>
                    </form>
                    <?php if (!empty($_SESSION['logged_user'])) { ?>
                        <span class="navbar-text"> <a href="vendor/logout.php" class="login">выход</a></span>
                    <?php } else { ?>
                    <span class="navbar-text"> <a href="login.php" class="login">Вход</a></span>
                    <a class="btn btn-light action-button" role="button" href="signup.php">Регистрация</a></div>
                <?php } ?>
            </div>
        </nav>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
