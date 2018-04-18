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


Route::get('/', function () {return redirect()->route('login');});
Route::group(['middleware'=>['auth']], function(){
    Route::get('/dashboard', ["as"=>"dashboard", "uses"=>"HomeController@index"]);
    Route::get('/select_package',["as" => "package", "uses"  => "HomeController@package"]);
    Route::post('/subscribe',["as" => "subscribe", "uses"  => "SubscriptionController@store"]);

    //-- AUTHENTICATION MANAGEMENT --//
    Route::group(['prefix' => 'authentication'], function () {
        //-- ROLES AND PERMISSION --//
        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', ["as"=>"roleIndex", "uses"=>"RoleController@index"]);
        });
    });

    //---- DISPUTES MANAGEMENT ----//
    Route::group(['prefix' => 'disputes'], function () {
        Route::get('/',["as"=>"disputeIndex", "uses"=>"DisputeController@index"]);
        Route::get('/user-disputes',["as"=>"userDisputeIndex", "uses"=>"DisputeController@userIndex"]);
        Route::get('/view/{slug?}',["as"=>"viewDispute", "uses"=>"DisputeController@show"]);
        Route::post('/create-dispute', ["as"=>"disputeAdd", "uses"=>"DisputeController@store"]);
        Route::post('/get-dispute', ["as"=>"getDispute", "uses"=>"DisputeController@getDisputes"]);
    });

    //----- PLATFORM MANAGEMENT ----//
    Route::group(['prefix' => 'platforms'], function () {
        Route::get('/', ["as"=>"platforms.index", "uses"=>"PlatformController@index"]);
        Route::post('/store',["as"=>"platforms.add",'uses'=> 'PlatformController@store']);
        Route::post('/update',["as"=>"platforms.update",'uses'=> 'PlatformController@update']);
        Route::get('/delete/{id?}',["as"=>"platforms.delete",'uses'=> 'PlatformController@destroy']);
        Route::post('/get-details', ["as"=>"platforms.editInfo", "uses"=>"PlatformController@getEditInfo"]);
        Route::get('/activate/{id?}', ["as"=>"platforms.activate", "uses"=>"PlatformController@activate"]);
    });
    
    //----- PACKAGE MANAGEMENT ----//
    Route::group(['prefix' => 'packages'], function () {
        Route::get('/', ["as"=>"packages.index", "uses"=>"PackageController@index"]);
        Route::post('/store',["as"=>"packages.add",'uses'=> 'PackageController@store']);
        Route::post('/update',["as"=>"packages.update",'uses'=> 'PackageController@update']);
        Route::get('/delete/{id?}',["as"=>"packages.delete",'uses'=> 'PackageController@destroy']);
        Route::post('/get-details', ["as"=>"packages.editInfo", "uses"=>"PackageController@getEditInfo"]);
    });
    
    //----- PACKAGETYPE MANAGEMENT ----//
    Route::group(['prefix' => 'packagetypes'], function () {
        Route::get('/', ["as"=>"packagetypes.index", "uses"=>"PackageTypeController@index"]);
        Route::post('/store',["as"=>"packagetypes.add",'uses'=> 'PackageTypeController@store']);
        Route::post('/update',["as"=>"packagetypes.update",'uses'=> 'PackageTypeController@update']);
        Route::get('/delete/{id?}',["as"=>"packagetypes.delete",'uses'=> 'PackageTypeController@destroy']);
        Route::post('/get-details', ["as"=>"packagetypes.editInfo", "uses"=>"PackageTypeController@getEditInfo"]);
    });

    //----- USERS MANAGEMENT ----//
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', ["as"=>"users.index", "uses"=>"UserController@index"]);
        Route::post('/store',["as"=>"users.add",'uses'=> 'UserController@store']);
        Route::post('/update',["as"=>"users.update",'uses'=> 'UserController@update']);
        Route::get('/delete/{id?}',["as"=>"users.delete",'uses'=> 'UserController@destroy']);
        Route::post('/get-details', ["as"=>"users.editInfo", "uses"=>"UserController@getEditInfo"]);
        Route::get('/activate', ["as"=>"users.activate", "uses"=>"UserController@activate"]);
    });

    //---- BULK MESSAGING MANAGEMENT ----//
    Route::group(['prefix' => 'messaging'], function () {
        Route::get('/', ["as"=>"msgIndex", "uses"=>"MessageController@index"]);
        Route::post('/send-mail', ["as"=>"msgSend", "uses"=>"MessageController@store"]);
    });

    //---- ACTIVITY LOGS ---//
    Route::group(['prefix' => 'logs'], function () {
    });

    //---- TRANSACTIONS MANAGEMENT -----//
    Route::group(['prefix' => 'transactions'], function () {
    });

    //---- SYSTEM SETTINGS MANAGEMENT ---//
    Route::group(['prefix' => 'settings'], function () {
        Route::group(['prefix' => 'mail'], function () {
            Route::get('/', ["as"=>"mailIndex", "uses"=>"SystemSettingsController@mailIndex"]);
            Route::post('/update-settings', ["as"=>"mailUpdate", "uses"=>"SystemSettingsController@store"]);
        });
    });
});


$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('login');

Route::get('/registration', ["as"=>"register", "uses"=>"HomeController@registerIndex"]);
Route::get('/registration/{id?}', ["as"=>"register.ref", "uses"=>"HomeController@ref"]);
Route::post('/register',['as' =>'register.store','uses'=>'HomeController@store']);

Route::get('/logout', function () {
    auth()->logout();
    return redirect('/login');
});
