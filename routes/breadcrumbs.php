<?php

// Home
Breadcrumbs::for('dashboard.index', function ($trail) {
    $trail->push('Home', route('dashboard.index'));
});

/**
 * Pengguna
 */
// Home > Pengguna
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('dashboard.index');
    $trail->push('Pengguna', route('users.index'));
});

// Home > Pengguna > Admin
Breadcrumbs::for('users.admin.index', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Daftar Admin', route('users.admin.index'));
});

// Home > Pengguna > Admin > Edit
Breadcrumbs::for('users.admin.edit', function ($trail) {
    $trail->parent('users.admin.index');
    $trail->push('Edit', route('users.admin.edit'));
});

// Home > Pengguna > Donatur
Breadcrumbs::for('users.donatur.index', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Daftar Donatur', route('users.donatur.index'));
});

// Home > Pengguna > Donatur > Edit
Breadcrumbs::for('users.donatur.edit', function ($trail) {
    $trail->parent('users.donatur.index');
    $trail->push('Edit', route('users.donatur.edit'));
});

// Home > Pengguna > Super Admin
Breadcrumbs::for('users.root.index', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Daftar Super Admin', route('users.root.index'));
});

// Home > Pengguna > Super Admin > Edit
Breadcrumbs::for('users.root.edit', function ($trail) {
    $trail->parent('users.root.index');
    $trail->push('Edit', route('users.root.edit'));
});

// Home > Pengguna > Profile
Breadcrumbs::for('users.profile.index', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Ubah Profile', route('users.profile.index'));
});

// Home > Pengguna > Daftar Request
Breadcrumbs::for('users.reqfeed.index', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Daftar Request', route('users.reqfeed.index'));
});

// Home > Pengguna > login
Breadcrumbs::for('users.login.index', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Daftar Log Pengguna Login', route('users.login.index'));
});

// Home > Pengguna > login
Breadcrumbs::for('users.logout.index', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Daftar Log Pengguna Logout', route('users.logout.index'));
});

/**
 * Konten
 */
// Home > Konten
Breadcrumbs::for('konten.index', function ($trail) {
    $trail->parent('dashboard.index');
    $trail->push('Konten', route('konten.index'));
});

// Home > Konten > Sub
Breadcrumbs::for('konten.sub', function ($trail) {
    $trail->parent('konten.index');
    $trail->push('Sub', route('konten.sub'));
});

// Home > Konten > Edit
Breadcrumbs::for('konten.sub.edit', function ($trail) {
    $trail->parent('konten.index');
    $trail->push('Edit Sub Konten', route('konten.sub.edit'));
});

/**
 * Label
 */
// Home > Label
Breadcrumbs::for('label.index', function ($trail) {
    $trail->parent('dashboard.index');
    $trail->push('Label', route('label.index'));
});

/**
 * Feed
 */
// Home > Feed
Breadcrumbs::for('feed.index', function ($trail) {
    $trail->parent('dashboard.index');
    $trail->push('Feed', route('feed.index'));
});

// Home > Feed > Edit
Breadcrumbs::for('feed.form', function ($trail) {
    $trail->parent('feed.index');
    $trail->push('Edit', route('feed.form'));
});

/**
 * Donasi
 */
// Home > Donasi
Breadcrumbs::for('donasi.index', function ($trail) {
    $trail->parent('dashboard.index');
    $trail->push('Donasi', route('donasi.index'));
});


/**
 * Payment
 */
// Home > Jenis Pembayaran
Breadcrumbs::for('payment.index', function ($trail) {
    $trail->parent('dashboard.index');
    $trail->push('Jenis Pembayaran', route('payment.index'));
});

// Home > Jenis Pembayaran > Edit
Breadcrumbs::for('payment.edit.form', function ($trail) {
    $trail->parent('payment.index');
    $trail->push('Edit', route('payment.edit.form'));
});

/**
 * Transaksi
 */
// Home > Transaksi
Breadcrumbs::for('transaksi.index', function ($trail) {
    $trail->parent('dashboard.index');
    $trail->push('Transaksi', route('transaksi.index'));
});

// Home > Transaksi > Top Up
Breadcrumbs::for('transaksi.topup.index', function ($trail) {
    $trail->parent('transaksi.index');
    $trail->push('Top Up', route('transaksi.topup.index'));
});

// Home > Transaksi > Donasi
Breadcrumbs::for('transaksi.donasi.index', function ($trail) {
    $trail->parent('transaksi.index');
    $trail->push('Donasi', route('transaksi.donasi.index'));
});

// Home > Transaksi > Penarikan Dana
Breadcrumbs::for('transaksi.tarik.index', function ($trail) {
    $trail->parent('transaksi.index');
    $trail->push('Penarikan Dana', route('transaksi.tarik.index'));
});

// Home > Transaksi > Top Up > Detail
Breadcrumbs::for('transaksi.topup.detail', function ($trail) {
    $trail->parent('transaksi.topup.index');
    $trail->push('Detail', route('transaksi.topup.detail'));
});

// Home > Transaksi > Donasi > Detail
Breadcrumbs::for('transaksi.donasi.detail', function ($trail) {
    $trail->parent('transaksi.donasi.index');
    $trail->push('Detail', route('transaksi.donasi.detail'));
});

// Home > Transaksi > Penarikan Dana > Detail
Breadcrumbs::for('transaksi.tarik.detail', function ($trail) {
    $trail->parent('transaksi.tarik.index');
    $trail->push('Detail', route('transaksi.tarik.detail'));
});

// Home > Transaksi > Kebutuhan
Breadcrumbs::for('transaksi.kebutuhan.index', function ($trail) {
    $trail->parent('transaksi.index');
    $trail->push('Kebutuhan', route('transaksi.kebutuhan.index'));
});

// Home > Transaksi > Kebutuhan > Detail
Breadcrumbs::for('transaksi.kebutuhan.detail', function ($trail) {
    $trail->parent('transaksi.kebutuhan.index');
    $trail->push('Detail', route('transaksi.kebutuhan.detail'));
});

