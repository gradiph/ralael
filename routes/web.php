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

/*------------
 * Home
 *------------
 */
Auth::routes(['verify' => true]);
Route::get('', 'HomeController@index');
Route::get('item/{item?}', 'HomeController@item')->name('item');
Route::get('cart', 'HomeController@cart')->name('cart');
Route::post('cart', 'HomeController@cartPost');
Route::middleware('auth')->group(function () {
    Route::get('checkout', 'HomeController@checkout')->name('checkout');
    Route::post('checkout', 'HomeController@checkoutPost');
    Route::get('password/change', 'HomeController@passwordChange')->name('password.change');
    Route::post('password/change', 'HomeController@passwordChangePost');
});

/*------------
 * Transactions
 *------------
 */
Route::middleware('auth')->group(function () {
    Route::prefix('transactions')->name('transactions.')->group(function () {
        Route::get('list', 'TransactionController@dataList')->name('list');
    });
    Route::resource('transactions', 'TransactionController', ['only' => ['index', 'show']]);
});

/*------------
 * Payments
 *------------
 */
Route::middleware('auth')->group(function () {
    Route::resource('payments', 'PaymentController', ['only' => ['create', 'store']]);
});

/*------------
 * Admin
 *------------
 */
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    /*------------
     * Auth
     *------------
     */
    Route::namespace('Auth')->group(function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
        Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
        Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
    });

    Route::middleware('auth:admin')->group(function () {
        /*------------
         * Home
         *------------
         */
        Route::get('', 'HomeController@index')->name('home');
        Route::get('password/change', 'HomeController@passwordChange')->name('password.change');
        Route::post('password/change', 'HomeController@passwordChangePost');

        /*------------
         * Transactions
         *------------
         */
        Route::prefix('transactions')->name('transactions.')->group(function () {
            Route::get('list', 'TransactionController@dataList')->name('list');
        });
        Route::resource('transactions', 'TransactionController');

        /*------------
         * Payments
         *------------
         */
        Route::prefix('payments')->name('payments.')->group(function () {
            Route::get('list', 'PaymentController@dataList')->name('list');
        });
        Route::resource('payments', 'PaymentController');

        /*------------
         * Master
         *------------
         */
        Route::namespace('Master')->prefix('master')->name('master.')->group(function () {
            /*------------
             * Admins
             *------------
             */
            Route::prefix('admins')->name('admins.')->group(function () {
                Route::get('list', 'AdminController@dataList')->name('list');
            });
            Route::resource('admins', 'AdminController');

            /*------------
             * Categories
             *------------
             */
            Route::prefix('categories')->name('categories.')->group(function () {
                Route::get('list', 'CategoryController@dataList')->name('list');
            });
            Route::resource('categories', 'CategoryController');

            /*------------
             * Statuses
             *------------
             */
            Route::prefix('statuses')->name('statuses.')->group(function () {
                Route::get('list', 'StatusController@dataList')->name('list');
            });
            Route::resource('statuses', 'StatusController');

            /*------------
             * Tags
             *------------
             */
            Route::prefix('tags')->name('tags.')->group(function () {
                Route::get('list', 'TagController@dataList')->name('list');
            });
            Route::resource('tags', 'TagController');

            /*------------
             * Users
             *------------
             */
            Route::prefix('users')->name('users.')->group(function () {
                Route::get('list', 'UserController@dataList')->name('list');
            });
            Route::resource('users', 'UserController');
        });
    });
});
