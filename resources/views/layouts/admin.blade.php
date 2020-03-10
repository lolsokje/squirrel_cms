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
    <div class="sidebar">
        <div id="user-details">
            <img src="{{ Auth::user()->profile_image }}" alt="">
            <p id="display_name">{{ Auth::user()->display_name }}</p>
        </div>
        <ul>
            <li class="nav-item">
                <a href="{{ route('articles.index') }}">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="nav-item-text">
                        Articles
                    </span>
                    <i class="fa fa-caret-right"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users') }}">
                    <i class="fa fa-users"></i>
                    <span class="nav-item-text">
                        Users
                    </span>
                    <i class="fa fa-caret-right"></i>
                </a>
            </li>
        </ul>
    </div>

    @yield('content')
</body>
</html>
