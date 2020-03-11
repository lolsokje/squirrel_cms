<div class="sidebar">
    <ul id="sidebar-header">
        <li class="nav-item">
            <a href="{{ route('index') }}">
            <i class="fa fa-long-arrow-left"></i>
                <span class="nav-item-text">
                    Back
                </span>
            </a>
        </li>
    </ul>
    <div id="user-details">
        <img src="{{ Auth::user()->profile_image }}" alt="">
        <p id="display_name">{{ Auth::user()->display_name }}</p>
    </div>
    <ul>
        <li class="nav-item {{ Request::route()->getName() === 'admin.index' ? 'active' : '' }}">
            <a href="{{ route('admin.index') }}">
                <i class="fa fa-home"></i>
                <span class="nav-item-text">
                    Admin index
                </span>
            </a>
        </li>
        <li class="nav-item {{ Request::route()->getName() === 'articles.index' ? 'active' : '' }}">
            <a href="{{ route('articles.index') }}">
                <i class="fa fa-newspaper-o"></i>
                <span class="nav-item-text">
                    Articles
                </span>
            </a>
        </li>
        <li class="nav-item sub-item {{ Request::route()->getName() === 'articles.create' ? 'active' : '' }}">
            <a href="{{ route('articles.create') }}">
                <i class="fa fa-plus-square"></i>
                <span class="nav-item-text">
                    New
                </span>
            </a>
        </li>
        @can('manage')
            <li class="nav-item {{ Request::route()->getName() === 'admin.users' ? 'active' : '' }}">
                <a href="{{ route('admin.users') }}">
                    <i class="fa fa-users"></i>
                    <span class="nav-item-text">
                        Users
                    </span>
                </a>
            </li>
        @endcan
    </ul>
</div>
