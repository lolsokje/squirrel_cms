<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('admin.index'));
});

Breadcrumbs::for('articles', function ($trail) {
    $trail->parent('home');
    $trail->push('Articles', route('articles.index'));
});

Breadcrumbs::for('articles.new', function ($trail) {
    $trail->parent('articles');
    $trail->push('New article', route('articles.create'));
});

Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', route('admin.users'));
});

Breadcrumbs::for('users.show', function ($trail, $user) {
    $trail->parent('users');
    $trail->push($user->display_name, route('admin.users.edit', $user));
});
