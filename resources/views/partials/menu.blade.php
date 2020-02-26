<div id="nav">
    <div class="container">
        <div id="left">
            <ul>
                @auth
                    <li class="list-item">{{ ucfirst($user->display_name) }}</li>
                    @can('edit articles')
                        <li class="list-item"><a href="#">Articles</a></li>
                    @endcan
                    @can('manage')
                        <li class="list-item"><a href="#">Manage</a></li>
                    @endcan
                @endauth
                <li class="list-item"><a href="#">All Articles</a></li>
            </ul>
        </div>

        <div id="right">
            <ul>
                @auth
                    <li class="list-item"><a href="{{ route('logout') }}">Logout</a></li>
                @endauth
            </ul>
        </div>
    </div>
</div>
