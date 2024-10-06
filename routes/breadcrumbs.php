<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Trang quản trị
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Trang quản trị', route('admin.dashboard'));
});

// Người dùng
Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Người dùng', route('admin.users.index'));
});

Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.users.index');
    $trail->push('Thêm mới', route('admin.users.create'));
});

Breadcrumbs::for('admin.users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('Chỉnh sửa', route('admin.users.edit', $user));
});

Breadcrumbs::for('admin.users.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('Chi tiết', route('admin.users.show', $user));
});

// Danh mục
Breadcrumbs::for('admin.categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Danh mục', route('admin.categories.index'));
});

Breadcrumbs::for('admin.categories.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.categories.index');
    $trail->push('Thêm mới', route('admin.categories.create'));
});

Breadcrumbs::for('admin.categories.edit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('admin.categories.index');
    $trail->push('Chỉnh sửa', route('admin.categories.edit', $category));
});

Breadcrumbs::for('admin.trash.listcate', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.categories.index');
    $trail->push('Thùng rác', route('admin.trash.listcate'));
});
 
// Topping
Breadcrumbs::for('admin.toppings.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Topping', route('admin.toppings.index'));
});

Breadcrumbs::for('admin.toppings.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.toppings.index');
    $trail->push('Thêm mới', route('admin.toppings.create'));
});

Breadcrumbs::for('admin.toppings.edit', function (BreadcrumbTrail $trail, $topping) {
    $trail->parent('admin.toppings.index');
    $trail->push('Chỉnh sửa', route('admin.toppings.edit', $topping));
});

Breadcrumbs::for('admin.trash-topping', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.toppings.index');
    $trail->push('Thùng rác', route('admin.trash-topping'));
});