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

// Thuộc tính
Breadcrumbs::for('admin.attributes.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Thuộc tính', route('admin.attributes.index'));
});

Breadcrumbs::for('admin.attributes.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.attributes.index');
    $trail->push('Thêm mới', route('admin.attributes.create'));
});

Breadcrumbs::for('admin.attributes.edit', function (BreadcrumbTrail $trail, $attribute) {
    $trail->parent('admin.attributes.index');
    $trail->push('Chỉnh sửa', route('admin.attributes.edit', $attribute));
});

Breadcrumbs::for('admin.trash-attributes', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.attributes.index');
    $trail->push('Thùng rác', route('admin.trash-attributes'));
});
// Banner
Breadcrumbs::for('admin.banners.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Banner', route('admin.banners.index'));
});

Breadcrumbs::for('admin.banners.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.banners.index');
    $trail->push('Thêm mới', route('admin.banners.create'));
});

Breadcrumbs::for('admin.banners.edit', function (BreadcrumbTrail $trail, $banner) {
    $trail->parent('admin.banners.index');
    $trail->push('Chỉnh sửa', route('admin.banners.edit', $banner));
});

Breadcrumbs::for('admin.trash.listBanner', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.banners.index');
    $trail->push('Thùng rác', route('admin.trash.listBanner'));
});

// Membership
Breadcrumbs::for('admin.memberships.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Điểm thành viên', route('admin.memberships.index'));
});

Breadcrumbs::for('admin.memberships.edit', function (BreadcrumbTrail $trail, $membership) {
    $trail->parent('admin.memberships.index');
    $trail->push('Chi tiết', route('admin.memberships.edit', $membership));
});