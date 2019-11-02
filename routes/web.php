<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'as' => 'index',
    'uses' => 'Landing\MainController@index'
]);

Route::get('/login', [
    'as' => 'login',
    'uses' => 'Otentikasi\AuthController@index'
]);

Route::get('/signin', [
    'as' => 'signin',
    'uses' => 'Otentikasi\AuthController@signin'
]);

Route::group(['prefix' => 'otentikasi', 'as' => 'otentikasi.'], function () {
    Route::post('login', [
        'as' => 'login',
        'uses' => 'Otentikasi\AuthController@verifyUser'
    ]);

    Route::post('signin', [
        'as' => 'signin.post',
        'uses' => 'Otentikasi\AuthController@createDonatur'
    ]);

    Route::get('logout', [
        'as' => 'logout',
        'uses' => 'Otentikasi\AuthController@logoutUser'
    ]);
});

Route::group(['prefix' => 'error', 'as' => 'error.'], function () {
    Route::get('forbidden', [
        'as' => 'forbidden',
        'uses' => 'Otentikasi\ErrorController@forbiddenError'
    ]);
});

/**
 * Admin (Backend)
 */

Route::group(['middleware' => 'checksession', 'prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('/', [
        'as' => 'index',
        'uses' => 'Admin\DashboardController@index'
    ]);
});

Route::group(['middleware' => 'checksession', 'prefix' => 'label', 'as' => 'label.'], function () {

    Route::get('/', [
        'as' => 'index',
        'uses' => 'Admin\LabelController@index'
    ]);

    Route::get('/dtLabel', [
        'uses' => 'Admin\LabelController@dataTableLabel'
    ]);

    Route::post('/create', [
        'as' => 'create',
        'uses' => 'Admin\LabelController@createLabel'
    ]);

    Route::put('/edit', [
        'as' => 'edit',
        'uses' => 'Admin\LabelController@editLabel'
    ]);

    Route::delete('/delete', [
        'as' => 'delete',
        'uses' => 'Admin\LabelController@deleteLabel'
    ]);
});

Route::group(['middleware' => 'checksession', 'prefix' => 'donasi', 'as' => 'donasi.'], function () {

    Route::get('/', [
        'as' => 'index',
        'uses' => 'Admin\DonasiController@index'
    ]);

    Route::get('/dtDonasi', [
        'uses' => 'Admin\DonasiController@dataTableDonasi'
    ]);

    Route::post('/create', [
        'as' => 'create',
        'uses' => 'Admin\DonasiController@createDonasi'
    ]);

    Route::put('/edit', [
        'as' => 'edit',
        'uses' => 'Admin\DonasiController@editDonasi'
    ]);

    Route::delete('/delete', [
        'as' => 'delete',
        'uses' => 'Admin\DonasiController@deleteDonasi'
    ]);
});

Route::group(['middleware' => 'checksession', 'prefix' => 'payment', 'as' => 'payment.'], function () {

    Route::get('/', [
        'as' => 'index',
        'uses' => 'Admin\PaymentController@index'
    ]);

    Route::get('/edit/form', [
        'as' => 'edit.form',
        'uses' => 'Admin\PaymentController@editForm'
    ]);

    Route::get('/dtPayment', [
        'uses' => 'Admin\PaymentController@dataTablePayment'
    ]);

    Route::post('/create', [
        'as' => 'create',
        'uses' => 'Admin\PaymentController@createPayment'
    ]);

    Route::put('/edit', [
        'as' => 'edit',
        'uses' => 'Admin\PaymentController@editPayment'
    ]);

    Route::put('/edit/upload', [
        'as' => 'edit.upload',
        'uses' => 'Admin\PaymentController@uploadLogoBank'
    ]);

    Route::delete('/delete', [
        'as' => 'delete',
        'uses' => 'Admin\PaymentController@deletePayment'
    ]);
});

Route::group(['middleware' => 'checksession', 'prefix' => 'feed', 'as' => 'feed.'], function () {

    Route::get('/', [
        'as' => 'index',
        'uses' => 'Admin\FeedController@index'
    ]);

    Route::get('/dtFeed', [
        'uses' => 'Admin\FeedController@dataTableFeed'
    ]);

    Route::post('/create', [
        'as' => 'create',
        'uses' => 'Admin\FeedController@createFeed'
    ]);

    Route::delete('/delete', [
        'as' => 'delete',
        'uses' => 'Admin\FeedController@deleteFeed'
    ]);

    Route::get('/form', [
        'as' => 'form',
        'uses' => 'Admin\FeedController@formFeed'
    ]);

    Route::put('/edit', [
        'as' => 'edit',
        'uses' => 'Admin\FeedController@editFeed'
    ]);

    Route::post('/form/upload', [
        'as' => 'form.upload',
        'uses' => 'Admin\FeedController@uploadGambarFeed'
    ]);

    Route::delete('/form/img/delete', [
        'as' => 'form.img.delete',
        'uses' => 'Admin\FeedController@deleteGambarFeed'
    ]);

    Route::put('/form/img/thumbnail', [
        'as' => 'form.img.thumbnail',
        'uses' => 'Admin\FeedController@setThumbnailFeed'
    ]);

});

Route::group(['middleware' => 'checksession', 'prefix' => 'konten', 'as' => 'konten.'], function () {
    Route::post('/ajaxCekSubKonten', [
        'uses' => 'Admin\KontenController@ajaxCekSubKonten'
    ]);

    Route::get('/', [
        'as' => 'index',
        'uses' => 'Admin\KontenController@index'
    ]);

    Route::get('/dtKonten', [
        'uses' => 'Admin\KontenController@dataTableKonten'
    ]);

    Route::post('/create', [
        'as' => 'create',
        'uses' => 'Admin\KontenController@createKonten'
    ]);

    Route::put('/edit', [
        'as' => 'edit',
        'uses' => 'Admin\KontenController@editKonten'
    ]);

    Route::delete('/delete', [
        'as' => 'delete',
        'uses' => 'Admin\KontenController@deleteKonten'
    ]);

    Route::get('/sub', [
        'as' => 'sub',
        'uses' => 'Admin\KontenController@viewSubKonten'
    ]);

    Route::post('/dtSubKonten', [
        'uses' => 'Admin\KontenController@dataTableSubKonten'
    ]);

    Route::post('/sub/create', [
        'as' => 'sub.create',
        'uses' => 'Admin\KontenController@createSubKonten'
    ]);

    Route::delete('/sub/delete', [
        'as' => 'sub.delete',
        'uses' => 'Admin\KontenController@deleteSubKonten'
    ]);

    Route::get('/sub/edit', [
        'as' => 'sub.edit',
        'uses' => 'Admin\KontenController@editSubKonten'
    ]);

    Route::post('/sub/update', [
        'as' => 'sub.update',
        'uses' => 'Admin\KontenController@updateSubKonten'
    ]);

    Route::post('/sub/upload', [
        'as' => 'sub.upload',
        'uses' => 'Admin\KontenController@uploadGambarSubKonten'
    ]);

    Route::delete('/sub/img/delete', [
        'as' => 'sub.img.delete',
        'uses' => 'Admin\KontenController@deleteGambarSubKonten'
    ]);

    Route::put('/sub/img/thumbnail', [
        'as' => 'sub.img.thumbnail',
        'uses' => 'Admin\KontenController@setThumbnailSubKonten'
    ]);

});

Route::group(['middleware' => 'checksession', 'prefix' => 'users', 'as' => 'users.'], function () {

    Route::get('/', [
        'as' => 'index',
        'uses' => 'Admin\UsersController@index'
    ]);

    Route::put('/rule/update', [
        'as' => 'rule.update',
        'uses' => 'Admin\UsersController@ruleUpdate'
    ]);

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Admin\UsersController@profileIndex'
        ]);
        Route::put('/edit/upload', [
            'as' => 'edit.upload',
            'uses' => 'Admin\UsersController@uploadUsersProfile'
        ]);
        Route::put('/edit/post', [
            'as' => 'edit.post',
            'uses' => 'Admin\UsersController@editUsersProfile'
        ]);
        Route::get('/edit/password', [
            'as' => 'edit.password',
            'uses' => 'Admin\UsersController@editPassword'
        ]);
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Admin\UsersController@adminIndex'
        ]);

        Route::get('/edit', [
            'as' => 'edit',
            'uses' => 'Admin\UsersController@adminViewEdit'
        ]);

        Route::get('/dtQueryAdmin', [
            'uses' => 'Admin\UsersController@dataTableQueryAdmin'
        ]);

        Route::put('/edit/upload', [
            'as' => 'edit.upload',
            'uses' => 'Admin\UsersController@uploadUsersAdmin'
        ]);

        Route::put('/edit/post', [
            'as' => 'edit.post',
            'uses' => 'Admin\UsersController@editUsersAdmin'
        ]);

        Route::post('/create/post', [
            'as' => 'create.post',
            'uses' => 'Admin\UsersController@createUsersAdmin'
        ]);

        Route::delete('/delete', [
            'as' => 'delete',
            'uses' => 'Admin\UsersController@deleteUsersAdmin'
        ]);
    });

    Route::group(['prefix' => 'root', 'as' => 'root.'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Admin\UsersController@rootIndex'
        ]);

        Route::get('/edit', [
            'as' => 'edit',
            'uses' => 'Admin\UsersController@rootViewEdit'
        ]);

        Route::get('/dtQueryRoot', [
            'uses' => 'Admin\UsersController@dataTableQueryRoot'
        ]);

        Route::put('/edit/upload', [
            'as' => 'edit.upload',
            'uses' => 'Admin\UsersController@uploadUsersRoot'
        ]);

        Route::put('/edit/post', [
            'as' => 'edit.post',
            'uses' => 'Admin\UsersController@editUsersRoot'
        ]);

        Route::post('/create/post', [
            'as' => 'create.post',
            'uses' => 'Admin\UsersController@createUsersRoot'
        ]);

        Route::delete('/delete', [
            'as' => 'delete',
            'uses' => 'Admin\UsersController@deleteUsersRoot'
        ]);
    });

    Route::group(['prefix' => 'donatur', 'as' => 'donatur.'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Admin\UsersController@donaturIndex'
        ]);

        Route::get('/edit', [
            'as' => 'edit',
            'uses' => 'Admin\UsersController@donaturViewEdit'
        ]);

        Route::get('/dtQueryDonatur', [
            'uses' => 'Admin\UsersController@dataTableQueryDonatur'
        ]);

        /**
         * Proses data
         */
        Route::put('/edit/upload', [
            'as' => 'edit.upload',
            'uses' => 'Admin\UsersController@uploadUsersDonatur'
        ]);

        Route::put('/edit/post', [
            'as' => 'edit.post',
            'uses' => 'Admin\UsersController@editUsersDonatur'
        ]);

        Route::post('/create/post', [
            'as' => 'create.post',
            'uses' => 'Admin\UsersController@createUsersDonatur'
        ]);

        Route::delete('/delete', [
            'as' => 'delete',
            'uses' => 'Admin\UsersController@deleteUsersDonatur'
        ]);
    });

});

Route::group(['middleware' => 'checksession', 'prefix' => 'transaksi', 'as' => 'transaksi.'], function () {

    Route::get('/', [
        'as' => 'index',
        'uses' => 'Admin\TransaksiController@index'
    ]);

    Route::group(['middleware' => 'checksession', 'prefix' => 'topup', 'as' => 'topup.'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Admin\TransaksiController@topupIndex'
        ]);

        Route::get('/detail', [
            'as' => 'detail',
            'uses' => 'Admin\TransaksiController@topupDetail'
        ]);

        Route::get('/dtTopup', [
            'uses' => 'Admin\TransaksiController@dataTableTopup'
        ]);

        Route::put('/update', [
            'as' => 'update',
            'uses' => 'Admin\TransaksiController@updateTopup'
        ]);

    });

    Route::group(['middleware' => 'checksession', 'prefix' => 'tarik', 'as' => 'tarik.'], function () {

        Route::get('/', [
            'as' => 'index',
            'uses' => 'Admin\TransaksiController@tarikIndex'
        ]);

        Route::get('/detail', [
            'as' => 'detail',
            'uses' => 'Admin\TransaksiController@tarikDetail'
        ]);

        Route::get('/dtTarik', [
            'uses' => 'Admin\TransaksiController@dataTableTarik'
        ]);

        Route::put('/update', [
            'as' => 'update',
            'uses' => 'Admin\TransaksiController@updateTarik'
        ]);

    });

    Route::group(['middleware' => 'checksession', 'prefix' => 'donasi', 'as' => 'donasi.'], function () {

        Route::get('/', [
            'as' => 'index',
            'uses' => 'Admin\TransaksiController@donasiIndex'
        ]);

        Route::get('/dtDonasi', [
            'uses' => 'Admin\TransaksiController@dataTableDonasi'
        ]);

        Route::put('/update', [
            'as' => 'update',
            'uses' => 'Admin\TransaksiController@updateDonasi'
        ]);

    });

    Route::group(['middleware' => 'checksession', 'prefix' => 'kebutuhan', 'as' => 'kebutuhan.'], function () {

        Route::get('/', [
            'as' => 'index',
            'uses' => 'Admin\TransaksiController@kebutuhanIndex'
        ]);

        Route::get('/detail', [
            'as' => 'detail',
            'uses' => 'Admin\TransaksiController@kebutuhanDetail'
        ]);


        Route::get('/dtKebutuhan', [
            'uses' => 'Admin\TransaksiController@dataTableKebutuhan'
        ]);

        Route::put('/update', [
            'as' => 'update',
            'uses' => 'Admin\TransaksiController@updateKebutuhan'
        ]);

    });

});

/**
 * Landing (Frontend)
 */
Route::group(['prefix' => 'landing', 'as' => 'landing.'], function () {

    Route::get('/', [
        'as' => 'index',
        'uses' => 'Landing\MainController@index'
    ]);

    Route::post('/ajax/getStepPayment', [
        'as' => 'ajax.getStepPayment',
        'uses' => 'Landing\MainController@ajaxGetStepPayment'
    ]);

    Route::post('/ajaxAppendDaftarDonasiUang', [
        'as' => 'ajaxAppendDaftarDonasiUang',
        'uses' => 'Landing\MainController@ajaxAppendDaftarDonasiUang'
    ]);

    Route::post('/ajaxAppendDaftarDonasiKebutuhan', [
        'as' => 'ajaxAppendDaftarDonasiKebutuhan',
        'uses' => 'Landing\MainController@ajaxAppendDaftarDonasiKebutuhan'
    ]);

    Route::post('/ajaxAppendFeed', [
        'as' => 'ajaxAppendFeed',
        'uses' => 'Landing\MainController@ajaxAppendFeed'
    ]);

    Route::post('/kebutuhan/post', [
        'as' => 'kebutuhan.post',
        'uses' => 'Landing\MainController@createDonasiKebutuhan'
    ]);

    Route::get('/feed', [
        'as' => 'feed',
        'uses' => 'Landing\MainController@feed'
    ]);

    Route::post('/donasi/auto', [
        'as' => 'donasi.auto',
        'uses' => 'Landing\MainController@autoDonasiUang'
    ])->middleware('checksession');

    Route::post('/donasi/uang', [
        'as' => 'donasi.uang',
        'uses' => 'Landing\MainController@donasiUang'
    ])->middleware('checksession');

    Route::get('/rule', [
        'as' => 'rule',
        'uses' => 'Landing\MainController@rule'
    ])->middleware('checksession');

    Route::get('/coba', [
        'as' => 'coba',
        'uses' => 'Landing\MainController@coba'
    ]);

});

Route::group(['middleware' => 'checksession', 'prefix' => 'dompet', 'as' => 'dompet.'], function () {

    Route::get('/', [
        'as' => 'index',
        'uses' => 'Landing\DompetController@index'
    ]);

    Route::post('/ajax/getNamaBank', [
        'as' => 'ajax.getNamaBank',
        'uses' => 'Landing\DompetController@ajaxGetNamaBank'
    ]);

    Route::post('/ajax/getStepPayment', [
        'as' => 'ajax.getStepPayment',
        'uses' => 'Landing\DompetController@ajaxGetStepPayment'
    ]);

    Route::post('/ajaxAppendTransaksi', [
        'as' => 'ajaxAppendTransaksi',
        'uses' => 'Landing\DompetController@ajaxAppendTransaksi'
    ]);

    Route::post('/ajaxAppendKebutuhan', [
        'as' => 'ajaxAppendKebutuhan',
        'uses' => 'Landing\DompetController@ajaxAppendKebutuhan'
    ]);

    Route::group(['middleware' => 'checksession', 'prefix' => 'topup', 'as' => 'topup.'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Landing\DompetController@topUpIndex'
        ]);

        Route::post('/edit', [
            'as' => 'edit',
            'uses' => 'Landing\DompetController@topUpEdit'
        ]);
    });

    Route::group(['middleware' => 'checksession', 'prefix' => 'transaksi', 'as' => 'transaksi.'], function () {

        Route::get('/', [
            'as' => 'index',
            'uses' => 'Landing\DompetController@transaksiIndex'
        ]);

        Route::get('/detail', [
            'as' => 'detail',
            'uses' => 'Landing\DompetController@transaksiDetail'
        ]);

        Route::get('/dtTransaksi', [
            'uses' => 'Landing\DompetController@dataTableTransaksi'
        ]);
    });

    Route::group(['middleware' => 'checksession', 'prefix' => 'penarikan', 'as' => 'penarikan.'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Landing\DompetController@penarikanIndex'
        ]);

        Route::post('/create', [
            'as' => 'create',
            'uses' => 'Landing\DompetController@createPenarikan'
        ]);
    });

    Route::group(['middleware' => 'checksession', 'prefix' => 'kebutuhan', 'as' => 'kebutuhan.'], function () {

        Route::get('/', [
            'as' => 'index',
            'uses' => 'Landing\DompetController@kebutuhanIndex'
        ]);

    });

});

Route::group(['prefix' => 'f', 'as' => 'frontend.'], function () {
    Route::group(['prefix' => 'konten', 'as' => 'konten.'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Landing\KontenController@index'
        ]);
    });

    Route::group(['middleware' => 'checksession', 'prefix' => 'profile', 'as' => 'profile.'], function () {

        Route::get('/', [
            'as' => 'index',
            'uses' => 'Landing\ProfileController@index'
        ]);

        Route::put('/edit/upload', [
            'as' => 'edit.upload',
            'uses' => 'Landing\ProfileController@uploadUsersProfile'
        ]);

        Route::put('/edit/post', [
            'as' => 'edit.post',
            'uses' => 'Landing\ProfileController@editUsersProfile'
        ]);

    });
});
