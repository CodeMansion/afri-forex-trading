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



Route::get('/', function () {
	return redirect()->route('login');
});

Route::group(['middleware'=>['auth']], function(){	
	Route::get('/dashboard', ["as"=>"dashboard", "uses"=>"HomeController@index"]);	
	Route::get('/select_package',["as" => "package", "uses"  => "HomeController@package"]);	
	
	//-	- AUTHENTICATION MANAGEMENT --//	
	Route::group(['prefix' => 'authentication'], function () {		
		//-		- ROLES AND PERMISSION --//		
		Route::group(['prefix' => 'roles'], function () {			
			Route::get('/', ["as"=>"roleIndex", "uses"=>"RoleController@index",'middleware'=>'platform-reg']);			
		});		
	});	
	
	//-	--- DISPUTES MANAGEMENT ----//	
	Route::group(['prefix' => 'disputes'], function () {		
	});	
	
	//-	--- REFERRER MANAGEMENT ----//	
	Route::group(['prefix' => 'referrals'], function () {		
		Route::get('/', ["as"=>"referrals.index", "uses"=>"ReferralController@index",'middleware'=>'platform-reg']);		
		Route::post('/store',["as"=>"referrals.add",'uses'=> 'ReferralController@store']);		
		Route::get('/show/{id?}', ["as"=>"referrals.show", "uses"=>"ReferralController@show"]);		
		Route::post('/update',["as"=>"referrals.update",'uses'=> 'ReferralController@update']);		
		Route::get('/delete/{id?}',["as"=>"referrals.delete",'uses'=> 'ReferralController@destroy']);		
	});	
	
	//-	---- PLATFORM MANAGEMENT ----//	
	Route::group(['prefix' => 'platforms'], function () {		
		Route::get('/', ["as"=>"platforms.index", "uses"=>"PlatformController@index",'middleware'=>'platform-reg']);		
		Route::post('/store',["as"=>"platforms.add",'uses'=> 'PlatformController@store']);		
		Route::get('/show/{id?}', ["as"=>"platforms.show", "uses"=>"PlatformController@show"]);		
		Route::post('/update',["as"=>"platforms.update",'uses'=> 'PlatformController@update']);		
		Route::get('/delete/{id?}',["as"=>"platforms.delete",'uses'=> 'PlatformController@destroy']);		
		Route::post('/get-details', ["as"=>"platforms.editInfo", "uses"=>"PlatformController@getEditInfo"]);		
		Route::get('/activate/{id?}', ["as"=>"platforms.activate", "uses"=>"PlatformController@activate"]);		
	});	
	
	//-	---- PACKAGE MANAGEMENT ----//	
	Route::group(['prefix' => 'packages'], function () {		
		Route::get('/', ["as"=>"packages.index", "uses"=>"PackageController@index",'middleware'=>'platform-reg']);		
		Route::post('/store',["as"=>"packages.add",'uses'=> 'PackageController@store']);		
		Route::post('/update',["as"=>"packages.update",'uses'=> 'PackageController@update']);		
		Route::get('/delete/{id?}',["as"=>"packages.delete",'uses'=> 'PackageController@destroy']);		
		Route::post('/get-details', ["as"=>"packages.editInfo", "uses"=>"PackageController@getEditInfo"]);		
	});	
	
	//-	---- PACKAGETYPE MANAGEMENT ----//	
	Route::group(['prefix' => 'packagetypes'], function () {		
		Route::get('/', ["as"=>"packagetypes.index", "uses"=>"PackageTypeController@index",'middleware'=>'platform-reg']);		
		Route::post('/store',["as"=>"packagetypes.add",'uses'=> 'PackageTypeController@store']);		
		Route::post('/update',["as"=>"packagetypes.update",'uses'=> 'PackageTypeController@update']);		
		Route::get('/delete/{id?}',["as"=>"packagetypes.delete",'uses'=> 'PackageTypeController@destroy']);		
		Route::post('/get-details', ["as"=>"packagetypes.editInfo", "uses"=>"PackageTypeController@getEditInfo"]);
	});	
	
	//-	---- USERS MANAGEMENT ----//	
	Route::group(['prefix' => 'users'], function () {		
		Route::get('/', ["as"=>"users.index", "uses"=>"UserController@index",'middleware'=>'platform-reg']);		
		Route::post('/store',["as"=>"users.add",'uses'=> 'UserController@store']);		
		Route::get('/show/{id?}', ["as"=>"users.show", "uses"=>"UserController@show"]);		
		Route::post('/update',["as"=>"users.update",'uses'=> 'UserController@update']);		
		Route::get('/delete/{id?}',["as"=>"users.delete",'uses'=> 'UserController@destroy']);		
		Route::post('/get-details', ["as"=>"users.editInfo", "uses"=>"UserController@getEditInfo"]);		
		Route::get('/activate/{id?}', ["as"=>"users.activate", "uses"=>"UserController@activate"]);		
	});	
	
	//-	---- TRANSACTION CATEGORY MANAGEMENT ----//	
	Route::group(['prefix' => 'transactioncategories'], function () {		
		Route::get('/', ["as"=>"transactioncategories.index", "uses"=>"TransactionCategoryController@index",'middleware'=>'platform-reg']);		
		Route::post('/store',["as"=>"transactioncategories.add",'uses'=> 'TransactionCategoryController@store']);		
		Route::get('/show/{id?}', ["as"=>"transactioncategories.show", "uses"=>"TransactionCategoryController@show"]);		
		Route::post('/update',["as"=>"transactioncategories.update",'uses'=> 'TransactionCategoryController@update']);		
		Route::get('/delete/{id?}',["as"=>"transactioncategories.delete",'uses'=> 'TransactionCategoryController@destroy']);		
		Route::post('/get-details', ["as"=>"transactioncategories.editInfo", "uses"=>"TransactionCategoryController@getEditInfo"]);		
		Route::get('/activate/{id?}', ["as"=>"transactioncategories.activate", "uses"=>"TransactionCategoryController@activate"]);		
	});	
	
	//-	---- SUBSCRIPTION MANAGEMENT ----//	
	Route::group(['prefix' => 'subscriptions'], function () {		
		Route::get('/', ["as"=>"subscriptions.index", "uses"=>"SubscriptionController@index",'middleware'=>'platform-reg']);		
		Route::post('/store',["as" => "subscriptions.add", "uses"  => "SubscriptionController@store"]);	
	});	
	
	//-	--- BULK MESSAGING MANAGEMENT ----//	
	Route::group(['prefix' => 'messaging'], function () {	
		Route::get('/', ["as"=>"messaging.index", "uses"=>"MessageController@index",'middleware'=>'platform-reg']);	
	});	
	
	//-	--- ACTIVITY LOGS ---//	
	Route::group(['prefix' => 'logs'], function () {		
		Route::get('/', ["as"=>"activity.index", "uses"=>"ActivityLogController@index",'middleware'=>'platform-reg']);		
	});	
	
	//-	--- TRANSACTIONS MANAGEMENT -----//	
	Route::group(['prefix' => 'transactions'], function () {
		Route::get('/', ["as"=>"transactions.index", "uses"=>"PaymentTransactionController@index",'middleware'=>'platform-reg']);
	});	
	
	//-	--- SYSTEM SETTINGS MANAGEMENT ---//	
	Route::group(['prefix' => 'authentication'], function () {		
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

