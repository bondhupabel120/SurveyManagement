<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home | Pharmacy Survey</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/frontend/img/sitelogo.png') }}" type="image/x-icon" />

    <!--=== Bootstrap 4 ===-->
    <link rel="stylesheet" href="{{ asset('assets/common/bootstrap/css/bootstrap.min.css') }}">

</head>

<body>

    <section>
        <div class="container">
            <div class="text-center text-custom">
                <h3 class="text-primary">Pharmacy Survey</h3>
                <a href="{{ route('user.login') }}" class="btn btn-success">Login Now</a>
            </div>
        </div>
    </section>

    <style>
        .text-custom {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%)
        }

    </style>

</body>

</html>
