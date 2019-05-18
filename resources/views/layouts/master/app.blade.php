<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ICTCRED') }} | Journal System</title>
    <link rel="shortcut icon" href="{{asset('public/Logo.png')}}">

    <!-- Scripts -->
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{asset('public/dashboard/styles/shards-dashboards.1.3.1.min.css')}}" rel="stylesheet"  type="text/css">
    <link href="{{asset('public/dashboard/styles/extras.1.3.1.min.css')}}" rel="stylesheet" type="text/css">

</head>
<body class="h-100">

        <main class="main-content col">
            @yield('content')
        </main>


     <script src="{{asset('public/dashboard/scripts/extras.1.3.1.min.js')}}"></script>
    <script src="{{asset('public/dashboard/scripts/shards-dashboards.1.3.1.min.js')}}"></script>

</body>
</html>
