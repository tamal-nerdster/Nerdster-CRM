<?php

use App\Http\Controllers\{ChangePasswordController,UserManagement};
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\{SessionsController,CustomerController,SiteController,SuppliersController,ProductController,QuoteController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard',[HomeController::class,'dashboard'])->name('dashboard');
	Route::get('billing', function () {return view('billing');})->name('billing');
	Route::get('profile', function () {return view('profile');})->name('profile');
	Route::get('user-management',[UserManagement::class,'all_users'])->name('user-management');
	Route::get('tables', function () {return view('tables');})->name('tables');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::post('/change/password',[InfoUserController::class,'change_password']);
    Route::get('/login', function () {return view('dashboard');})->name('sign-up');

    Route::group(['middleware' => 'isAdmin'], function () {
        //Users
    	Route::post('/user/store',[InfoUserController::class,'store_user']);
    	Route::get('/user/{id}/edit',[InfoUserController::class,'edit_user']);
    	Route::post('/user/update',[InfoUserController::class,'update_user']);
    	Route::get('/delete/user/{id}',[InfoUserController::class,'delete_user']);
        Route::get('/get/user/details/{id}',[InfoUserController::class,'user_details']);

        //supplier
        Route::get('/supplier',[SuppliersController::class,'supplier']);
        Route::post('/supplier/store',[SuppliersController::class,'store']);
        Route::get('/supplier/{id}/edit',[SuppliersController::class,'edit_supplier']);
        Route::post('/supplier/update',[SuppliersController::class,'update_supplier']);
        Route::get('/delete/supplier/{id}',[SuppliersController::class,'delete_supplier']);

        //products
        Route::get('/products',[ProductController::class,'products']);
        Route::post('/product/store',[ProductController::class,'store']);
        Route::get('/product/{id}/edit',[ProductController::class,'edit_product']);
        Route::post('/product/update',[ProductController::class,'update_product']);
        Route::get('/delete/product/{id}',[ProductController::class,'delete_product']);

    });
    //Customers
    Route::get('/customers',[CustomerController::class,'customers']);
    Route::post('/customer/store',[CustomerController::class,'store']);
    Route::get('/delete/customer/{id}',[CustomerController::class,'delete']);
    Route::get('/customer/{id}/edit',[CustomerController::class,'edit']);
    Route::post('/customer/update',[CustomerController::class,'update']);

    //sites
    Route::get('/sites',[SiteController::class,'sites']);
    Route::post('/site/store',[SiteController::class,'store']);
    Route::get('/delete/site/{id}',[SiteController::class,'delete']);
    Route::get('/site/{id}/edit',[SiteController::class,'edit']);
    Route::post('/site/update',[SiteController::class,'update']);

    //Quotes
    Route::get('/quotes',[QuoteController::class,'quotes']);
    Route::post('/quote/store',[QuoteController::class,'store']);
    Route::get('/quote/{id}/edit',[QuoteController::class,'edit_quote']);
    Route::post('/quote/update',[QuoteController::class,'update_quote']);
    Route::get('/delete/quote/{id}',[QuoteController::class,'delete_quote']);

});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');