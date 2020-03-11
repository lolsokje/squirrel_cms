<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SquirrelTV Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div id="wrapper">
        @include('partials.admin-sidebar')

        <div id="app">
            @yield('content')
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </div>
</body>
</html>
