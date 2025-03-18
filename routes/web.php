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
Route::get('/', "HomeController@index")->name('index');
Route::middleware('user')->group(function () {
    Route::get('/dang-xuat', "AuthController@logout")->name('logout');
    Route::GET('/doi-mat-khau/{id?}', "UserController@editPassword")->name('users.edit_password')->middleware('can_update_password');
    Route::PATCH('/doi-mat-khau/{id?}', "UserController@updatePassword")->name('users.update_password')->middleware('can_update_password');
    Route::middleware('active-user')->group(function () {
        Route::get('/quan-ly', "HomeController@dashboard")->name('dashboard');
        Route::name('users.')->prefix('users')->group(function () {
            Route::get('/search', 'UserController@search')->name('search');
            Route::get('/info', 'UserController@info')->name('info');
            Route::patch('/{id}/update-status', 'UserController@updateStatus')->name('update_status');
        });
        Route::resource('users', 'UserController');
        Route::resource('categories', 'CategoryController');
        Route::name('categories.')->prefix('categories')->group(function () {
            Route::patch('/{id}/update-status', 'CategoryController@updateStatus')->name('update_status');
        });
        Route::resource('products', 'ProductController');
        Route::resource('customers', 'CustomerController');
        Route::resource('shareholders', 'ShareholderController');
        Route::resource('capitals', 'CapitalHistoryController');
        Route::resource('invoice-types', 'InvoiceTypeController');
        Route::resource('invoices', 'InvoiceController');
        Route::resource('pawn-receipts', 'PawnReceiptController');
        Route::resource('fund-histories', 'FundHistoryController');
        Route::name('pawn-receipts.')->prefix('pawn-receipts')->group(function () {
            Route::get('/{pawn_receipt}/pay-interest', 'PawnReceiptController@payInterest')->name('pay-interest');
            Route::post('/{pawn_receipt}/pay-interest', 'PawnReceiptController@payInterestHandle')->name('pay-interest-handle');
            Route::get('/{pawn_receipt}/pay-loan', 'PawnReceiptController@payLoan')->name('pay-loan');
            Route::post('/{pawn_receipt}/pay-loan', 'PawnReceiptController@payLoanHandle')->name('pay-loan-handle');
        });
    });

});
Route::middleware('guest')->group(function () {
    Route::get('/dang-nhap', 'AuthController@login')->name('login');
    Route::post('/dang-nhap', 'AuthController@signIn')->name('sign_in');
    Route::get('/dang-ky', 'AuthController@register')->name('register');
    Route::post('/dang-ky', 'AuthController@signUp')->name('sign_up');
    Route::get('/quen-mat-khau', 'AuthController@forgotPassword')->name('forgot_password');
});


