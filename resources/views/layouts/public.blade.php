<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Mgt System</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
   <style>
    body {
        background-color: #f3f3f3;
       background-image: url('{{ asset('assets/images/textile.png') }}');

        background-repeat: repeat;
        background-size: auto;
        font-family: 'Nunito', sans-serif;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-card {
        background: #fff;
        border-radius: 1rem;
        padding: 3rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 450px;
    }

    .auth-logo img {
        height: 50px;
    }

    .auth-title {
        font-weight: 700;
        font-size: 2rem;
        text-align: center;
        margin-bottom: 1rem;
    }

    .form-control {
        padding-left: 2.5rem;
    }

    .form-control-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }

    .btn-primary {
        border-radius: 30px;
        padding: 0.75rem;
    }

    .text-gray-600 {
        color: #6c757d !important;
    }

    .auth-footer {
        margin-top: 2rem;
        text-align: center;
    }

    .auth-footer a {
        color: #007bff;
        text-decoration: none;
        font-weight: 600;
    }

    .position-relative {
        position: relative;
    }
</style> 

</head>

<body>

  @yield('content')


    <script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('assets/vendors/apexcharts/apexcharts.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard.js')}}"></script>

    <script src="{{asset('assets/js/main.js')}}"></script>
</body>

</html>