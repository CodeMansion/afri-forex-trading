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

Route::post('/register',['as' =>'register.store','uses'=>'HomeController@store']);

Route::group(['middleware'=>['auth']], function(){
    Route::get('/dashboard', ["as"=>"dashboard", "uses"=>"HomeController@index"]);
    // Route::get('/', function () {return view('auth.login');});

    //-- AUTHENTICATION MANAGEMENT --//
    Route::group(['prefix' => 'authentication'], function () {
        //-- ROLES AND PERMISSION --//
        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', ["as"=>"roleIndex", "uses"=>"RoleController@index"]);
        });
    });

    //---- DISPUTES MANAGEMENT ----//
    Route::group(['prefix' => 'disputes'], function () {
    });

    //----- PLATFORM MANAGEMENT ----//
    Route::group(['prefix' => 'platforms'], function () {
    });

    //----- USERS MANAGEMENT ----//
    Route::group(['prefix' => 'users'], function () {
    });

    //---- BULK MESSAGING MANAGEMENT ----//
    Route::group(['prefix' => 'messaging'], function () {
    });

    //---- ACTIVITY LOGS ---//
    Route::group(['prefix' => 'logs'], function () {
    });

    //---- TRANSACTIONS MANAGEMENT -----//
    Route::group(['prefix' => 'transactions'], function () {
    });

    //---- SYSTEM SETTINGS MANAGEMENT ---//
    Route::group(['prefix' => 'authentication'], function () {
    });
});

Auth::routes();
Route::get('/registration', ["as"=>"register", "uses"=>"HomeController@registerIndex"]);
Route::get('/registration/{id?}', ["as"=>"register.ref", "uses"=>"HomeController@ref"]);
Route::get('/logout', function () {
    auth()->logout();
    return redirect('/login');
});
