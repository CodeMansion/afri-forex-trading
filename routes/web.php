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
	Route::get('/service-subscribe', ["as"=>"packageSub", "uses"=>"HomeController@packageSubIndex"]);
	Route::post('confirm_payment',['as' => 'payment.store-d' ,'uses' => 'SubscriptionController@Confirm_Payment']);
	Route::post('/get-daily-signal-info', ["as"=>"getDailySignalInfo", "uses"=>"HomeController@getDailySignalInfo"]);
	Route::post('/get-investment-info', ["as"=>"getInvestmentInfo", "uses"=>"HomeController@getInvestmentInfo"]);
	Route::post('/get-investment-payment-info', ["as"=>"getInvestmentPaymentInfo", "uses"=>"HomeController@getInvestmentPaymentInfo"]);
	Route::post('/get-package-type', ["as"=> "getPackageType", "uses"=>"HomeController@getPackageType"]);
	Route::post('/get-referrer-info', ["as"=>"getReferrerInfo", "uses"=>"HomeController@getReferrerInfo"]);
    Route::get('/select_package',["as" => "package", "uses"  => "HomeController@package"]);
	Route::post('/process-payment/{type?}',["as" => "processPayment", "uses"  => "SubscriptionController@processPayment"]);
	Route::post('/pay-with-wallet',["as" => "PayWithWallet", "uses"  => "SubscriptionController@PayWithWallet"]);
	Route::post('get-package-types', ["as"=>"getPackageTypes", "uses"=>"HomeController@getPackageTypes"]);
	
	//--- ADMIN NOTIFICATIONS ---//
	Route::get('/dashboard-notify',["as"=>"dashboardNotify", "uses"=>"HomeController@indexNotify"]);
	Route::get('/notifications',["as"=>"notifications", "uses"=>"HomeController@notifications"]);
	Route::get('/load-dispute', ["as"=>"loadDispute", "uses"=>"HomeController@loadDispute"]);
	Route::get('/load-activity-logs', ["as"=>"loadActivityLogs", "uses"=>"HomeController@loadActivityLogs"]);
	Route::get('/load-transactions', ["as"=>"loadTransactions", "uses"=>"HomeController@loadTransactions"]);
	Route::get('/load-support', ["as"=>"loadSupport", "uses"=>"HomeController@loadSupport"]);
	Route::get('/load-chart', ["as"=>"loadChart", "uses"=>"HomeController@loadChart"]);
	Route::get('/load-new-members', ["as"=>"loadMembers", "uses"=>"HomeController@loadMembers"]);
	Route::get('/load-members-earnings', ["as"=>"loadEarnings", "uses"=>"HomeController@loadEarnings"]);
	Route::get('/withdrawal-requests', ["as"=>"loadWithdrawals", "uses"=>"HomeController@loadWithdrawals"]);
	Route::get('/mark-as-read/{id?}/{type?}', ["as"=>"MarkAsRead", "uses"=>"HomeController@MarkNotification"]);

	//---WITHDRAWALS ----//
	Route::post('/request-withdrawal', ["as"=>"makeWithdrawal", "uses"=>"WithdrawalController@store"]);
	Route::get('/withdrawals', ["as"=>"WithdrawalIndex", "uses"=>"WithdrawalController@index"]);
	Route::post('/withdrawal-details', ["as"=>"WithdrawalDetails", "uses"=>"WithdrawalController@show"]);
	Route::post('/approve-withdrawal', ["as"=>"ApproveWithdrawal", "uses"=>"WithdrawalController@approve"]);
	Route::post('/decline-withdrawal', ["as"=>"DeclineWithdrawal", "uses"=>"WithdrawalController@decline"]);
	Route::post('/complete-withdrawal', ["as"=>"CompleteWithdrawal", "uses"=>"WithdrawalController@completed"]);
	
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
        Route::get('/view/{slug?}',["as"=>"viewDispute", "uses"=>"DisputeController@show"]);
        Route::post('/create-dispute', ["as"=>"disputeAdd", "uses"=>"DisputeController@store"]);
		Route::post('/get-dispute', ["as"=>"getDispute", "uses"=>"DisputeController@getDisputes"]);
		Route::post('/reply-dispute', ["as"=>"replyDispute", "uses"=>"DisputeController@ReplyDispute"]);
		Route::post('/resolved-dispute', ["as"=>"resolveDispute", "uses"=>"DisputeController@ResolveDispute"]);
	});

	//---- TESTIMONY MANAGEMENT ----//
    Route::group(['prefix' => 'testimonies'], function () {
        Route::get('/',["as"=> "testimonies.index", "uses"=>"TestimonyController@index"]);
		Route::post('/store', ["as" => "testimonies.add", 'uses' => 'TestimonyController@store']);
		Route::get('/show/{id?}', ["as" => "testimonies.show", "uses" => "TestimonyController@show"]);
		Route::post('/update', ["as" => "testimonies.update", 'uses' => 'TestimonyController@update']);
		Route::get('/delete/{id?}', ["as" => "testimonies.delete", 'uses' => 'TestimonyController@destroy']);
		Route::post('/get-details', ["as" => "testimonies.editInfo", "uses" => "TestimonyController@getEditInfo"]);
		Route::get('/approve/{id?}', ["as" => "testimonies.approve", "uses" => "TestimonyController@approve"]);
		Route::get('/decline/{id?}', ["as" => "testimonies.decline", "uses" => "TestimonyController@decline"]);
	});
	
	// ----- EARNINGS MANAGEMENT ------//
	Route::group(['prefix' => 'earnings'], function () {
		Route::get('/',["as"=>"earningsIndex", "uses"=>"EarningController@index"]);
	});

    //-	--- REFERRER MANAGEMENT ----//	
	Route::group(['prefix' => 'referrals'], function () {		
		Route::get('/', ["as"=>"referrals.index", "uses"=>"ReferralController@index"]);		
		Route::post('/store',["as"=>"referrals.add",'uses'=> 'ReferralController@store']);		
		Route::get('/show/{id?}', ["as"=>"referrals.show", "uses"=>"ReferralController@show"]);		
		Route::post('/update',["as"=>"referrals.update",'uses'=> 'ReferralController@update']);		
		Route::get('/delete/{id?}',["as"=>"referrals.delete",'uses'=> 'ReferralController@destroy']);		
	});
	
	//-	--- INVESTMENT MANAGEMENT ----//	
	Route::group(['prefix' => 'investments'], function () {		
		Route::get('/', ["as"=>"investments.index", "uses"=>"InvestmentController@index"]);
		Route::post('/store',["as"=>"investments.add",'uses'=> 'InvestmentController@store']);		
		Route::get('/show/{id?}', ["as"=>"investments.show", "uses"=>"InvestmentController@show"]);		
		Route::post('/update',["as"=>"investments.update",'uses'=> 'InvestmentController@update']);		
		Route::get('/delete/{id?}',["as"=>"investments.delete",'uses'=> 'InvestmentController@destroy']);		
	});
	
	//-	---- PLATFORM MANAGEMENT ----//	
	Route::group(['prefix' => 'platforms'], function () {		
		Route::get('/', ["as"=>"platforms.index", "uses"=>"PlatformController@index"]);		
		Route::post('/store',["as"=>"platforms.add",'uses'=> 'PlatformController@store']);		
		Route::get('/show/{id?}', ["as"=>"platforms.show", "uses"=>"PlatformController@show"]);		
		Route::post('/update',["as"=>"platforms.update",'uses'=> 'PlatformController@update']);		
		Route::get('/delete/{id?}',["as"=>"platforms.delete",'uses'=> 'PlatformController@destroy']);		
		Route::post('/get-details', ["as"=>"platforms.editInfo", "uses"=>"PlatformController@getEditInfo"]);		
		Route::get('/activate/{id?}', ["as"=>"platforms.activate", "uses"=>"PlatformController@activate"]);		
	});	
	
	//-	---- PACKAGE MANAGEMENT ----//	
	Route::group(['prefix' => 'packages'], function () {		
		Route::get('/', ["as"=>"packages.index", "uses"=>"PackageController@index"]);		
		Route::post('/store',["as"=>"packages.add",'uses'=> 'PackageController@store']);		
		Route::post('/update',["as"=>"packages.update",'uses'=> 'PackageController@update']);		
		Route::get('/delete/{id?}',["as"=>"packages.delete",'uses'=> 'PackageController@destroy']);		
		Route::post('/get-details', ["as"=>"packages.editInfo", "uses"=>"PackageController@getEditInfo"]);		
	});	
	
	//-	---- PACKAGETYPE MANAGEMENT ----//	
	Route::group(['prefix' => 'packagetypes'], function () {		
		Route::get('/', ["as"=>"packagetypes.index", "uses"=>"PackageTypeController@index"]);		
		Route::post('/store',["as"=>"packagetypes.add",'uses'=> 'PackageTypeController@store']);		
		Route::post('/update',["as"=>"packagetypes.update",'uses'=> 'PackageTypeController@update']);		
		Route::get('/delete/{id?}',["as"=>"packagetypes.delete",'uses'=> 'PackageTypeController@destroy']);		
		Route::post('/get-details', ["as"=>"packagetypes.editInfo", "uses"=>"PackageTypeController@getEditInfo"]);
	});	
	
	//-	---- MEMBERS MANAGEMENT ----//	
	Route::group(['prefix' => 'members'], function () {		
		Route::get('/', ["as"=>"membersIndex", "uses"=>"UserController@index"]);		
		Route::post('/store',["as"=>"users.add",'uses'=> 'UserController@store']);		
		Route::get('/show/{slug?}', ["as"=>"showMember", "uses"=>"UserController@show"]);		
		Route::post('/update',["as"=>"users.update",'uses'=> 'UserController@update']);		
		Route::get('/delete/{id?}',["as"=>"users.delete",'uses'=> 'UserController@destroy']);		
		Route::post('/get-details', ["as"=>"users.editInfo", "uses"=>"UserController@getEditInfo"]);
		Route::post('/get-user-fund-details', ["as" => "users.FundInfo", "uses" => "UserController@getUserDetails"]);
		Route::post('/share-fund', ["as" => "users.sharefund", "uses" => "UserController@ShareFund"]);
		Route::post('/activate-member-account', ["as"=>"activateMemberAccount", "uses"=>"UserController@activate"]);
		Route::post('/reset-password', ["as"=>"resetPassword", "uses"=>"UserController@resetPassword"]);	
		Route::post('/create-administrator', ["as"=>"CreateNewAdmin", "uses"=>"UserController@AddNewAdministrator"]);
		Route::post('/delete-member', ["as"=>"DeleteMember", "uses"=>"UserController@DeleteMember"]);
		Route::post('/confirm-password', ["as"=>"ConfirmPassword", "uses"=>"UserController@ConfirmPassword"]);
		Route::post('/refund-wallet', ["as"=>"RefundWallet", "uses"=>"UserController@RefundWallet"]);
		Route::post('/update-account', ["as"=>"UpdateAccount", "uses"=>"UserController@UpdateAccount"]);
	});	
	
	//-	---- TRANSACTION CATEGORY MANAGEMENT ----//	
	Route::group(['prefix' => 'transactioncategories'], function () {		
		Route::get('/', ["as"=>"transactioncategories.index", "uses"=>"TransactionCategoryController@index"]);		
		Route::post('/store',["as"=>"transactioncategories.add",'uses'=> 'TransactionCategoryController@store']);		
		Route::get('/show/{id?}', ["as"=>"transactioncategories.show", "uses"=>"TransactionCategoryController@show"]);		
		Route::post('/update',["as"=>"transactioncategories.update",'uses'=> 'TransactionCategoryController@update']);		
		Route::get('/delete/{id?}',["as"=>"transactioncategories.delete",'uses'=> 'TransactionCategoryController@destroy']);		
		Route::post('/get-details', ["as"=>"transactioncategories.editInfo", "uses"=>"TransactionCategoryController@getEditInfo"]);		
		Route::get('/activate/{id?}', ["as"=>"transactioncategories.activate", "uses"=>"TransactionCategoryController@activate"]);		
	});	
	
	//-	---- SUBSCRIPTION MANAGEMENT ----//	
	Route::group(['prefix' => 'subscriptions'], function () {		
		Route::get('/', ["as"=>"subscriptions.index", "uses"=>"SubscriptionController@index"]);	
		Route::get('/select-package/{id?}', ["as"=>"SelectPackage", "uses"=>"SubscriptionController@show"]);	
		Route::get('/select-package-types/{id?}', ["as"=>"SelectPackageType", "uses"=>"SubscriptionController@showPackageTypes"]);
		Route::post('/store',["as" => "subscriptions.add", "uses"  => "SubscriptionController@store"]);	
		Route::get('/view-payment/{package?}/{type?}/{platform?}', ["as"=>"ViewPayment", "uses"=>"SubscriptionController@ViewPayment"]);
	});	

    //---- BULK MESSAGING MANAGEMENT ----//
    Route::group(['prefix' => 'messaging'], function () {
        Route::get('/', ["as"=>"msgIndex", "uses"=>"MessageController@index"]);
        Route::post('/send-mail', ["as"=>"msgSend", "uses"=>"MessageController@store"]);
    });

    //-	--- ACTIVITY LOGS ---//	
	Route::group(['prefix' => 'logs'], function () {		
		Route::get('/', ["as"=>"activity.index", "uses"=>"ActivityLogController@index"]);		
	});	

	//-	--- DOWNLINE MANAGEMENT ---//	
	Route::group(['prefix' => 'downlines'], function () {		
		Route::get('/', ["as"=>"downlines.index", "uses"=>"UserDownlineController@index"]);		
	});
	
	//-	--- TRANSACTIONS MANAGEMENT -----//	
	Route::group(['prefix' => 'transactions'], function () {
		Route::get('/', ["as"=>"transactions.index", "uses"=>"PaymentTransactionController@index"]);
		Route::get('/delete/{id?}',["as"=>"transactions.delete",'uses'=> 'PaymentTransactionController@destroy']);
    });	
    
    //---- SYSTEM SETTINGS MANAGEMENT ---//
    Route::group(['prefix' => 'settings'], function () {
        Route::group(['prefix' => 'mail'], function () {
            Route::get('/', ["as"=>"mailIndex", "uses"=>"SystemSettingsController@mailIndex"]);
            Route::post('/update-settings', ["as"=>"mailUpdate", "uses"=>"SystemSettingsController@store"]);
		});
		
		Route::group(['prefix' => 'general-settings'], function () {
            Route::get('/', ["as"=>"generalSettingIndex", "uses"=>"SystemSettingsController@generalSettingsIndex"]);
            Route::post('/update-general-settings', ["as"=>"generalSettingUpdate", "uses"=>"SystemSettingsController@storeGeneralSettings"]);
        });
    });
});

$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('login');

Route::get('/registration', ["as"=>"register", "uses"=>"HomeController@registerIndex"]);
Route::get('/registration/{id?}', ["as"=>"register.ref", "uses"=>"HomeController@ref"]);
Route::post('/register',['as' =>'register.store','uses'=>'HomeController@store']);
Route::get('member-account-activation/{slug?}/confirmation={check?}', ['as'=>'confirmRegistration', 'uses'=>'HomeController@activateAccount']);
Route::post('/forget-password', ['as' => 'forget_password', 'uses' => 'HomeController@forget_password']);
Route::post('/reset/verify/{id?}',['as' => 'reset.store' ,'uses' => 'HomeController@reset_confirm']);
Route::post('/reset/change',['as' => 'reset.password' ,'uses' => 'HomeController@change_oldpassword']);

Route::get('/logout', function () {	
	auth()->logout();	
	\Session::flash('success', 'Your have successfully logged out. Have a nice time!');
	return redirect('/login');	
});
