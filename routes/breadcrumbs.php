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

Breadcrumbs::for('articles.edit', function ($trail, $article) {
    $trail->parent('articles');
    $trail->push("{$article->title}", route('articles.edit', $article));
});

Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', route('admin.users'));
});

Breadcrumbs::for('users.show', function ($trail, $user) {
    $trail->parent('users');
    $trail->push($user->display_name, route('admin.users.edit', $user));
});

Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles', route('admin.roles'));
});

Breadcrumbs::for('roles.show', function ($trail, $role) {
    $trail->parent('roles');
    $trail->push($role->name, route('admin.role.edit', $role));
});

Breadcrumbs::for('roles.create', function ($trail) {
    $trail->parent('roles');
    $trail->push('New role', route('admin.roles.create'));
});

Breadcrumbs::for('categories', function ($trail) {
    $trail->parent('home');
    $trail->push('Categories', route('admin.categories'));
});

Breadcrumbs::for('categories.edit', function ($trail, $category) {
    $trail->parent('categories');
    $trail->push($category->name, route('admin.categories.edit', $category->name));
});

Breadcrumbs::for('categories.create', function ($trail) {
    $trail->parent('categories');
    $trail->push('New category', route('admin.categories.create'));
});
