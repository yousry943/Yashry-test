<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/', function () {
    return view('welcome');
});


Route::get('cart','CartController@index');
Route::get('bill/usd','BillController@GetBillByUsd');
Route::get('bill/egp','BillController@GetBillByEgp');


Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('/user/resend/verify/{id}', 'Auth\RegisterController@reverifyUser');


Route::get('home/user/logout', function () {
    Auth()->guard('web')->logout();
    return redirect('/login');
});


//Admin Routes
Route::get('/admin/login', 'admin_auth@index');
Route::post('/admin/login', 'admin_auth@loginpost')->name('admin.login.submit');

Route::get('/admin/forget/password','admin_auth@forgetpassword');
Route::get('/admin/reset/password/{token}','admin_auth@resetpassword');
Route::post('/admin/reset/password/{token}','admin_auth@postresetpassword');
Route::post('/admin/forget/password','admin_auth@postforgetpassword');


Config::set('auth.defines','admin');
Route::get('admin/logout', function () {
    Auth()->guard('admin')->logout();
    return redirect('/admin/login');
});






Route::group(['prefix' => LaravelLocalization::setLocale().'/','middleware'=>'auth:web'],function(){

Route::get('/home', 'HomeController@index')->name('home');
//company
Route::get('/company', 'userController\CompanyController@index')->name('company');


Route::get('test','userController\test@index');


 });









///Admin Route
    Route::group(['prefix' => LaravelLocalization::setLocale().'/admin','middleware'=>'admin:admin'],function(){


     Route::get('','AdminController\AdminController@index')->name('admin.dashboard');

     Route::get('users','AdminController\AdminController@getAllUsers');
     Route::get('users/{id}/delete','AdminController\AdminController@deleteUser');


// for user managers routes
     Route::resource('user/manager','AdminController\UserManagerController');
     Route::get('user/manager/{id}/delete','AdminController\UserManagerController@destroy');



     // for managers routes
          Route::resource('manager','AdminController\managerController');
          Route::get('manager/{id}/delete','AdminController\managerController@destroy');




// for role  routes
     Route::resource('role','AdminController\roleController');
     Route::get('role/{id}/delete','AdminController\roleController@destroy');


     // for user  role routes
          Route::resource('user/role','AdminController\UserRoleController');
          Route::get('user/role/{id}/delete','AdminController\UserRoleController@destroy');



// for permission routes
     Route::resource('permission','AdminController\permissionController');
     Route::get('permission/{id}/delete','AdminController\permissionController@destroy');


 });
