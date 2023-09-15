<?php

use App\Events\MessageSent;
use App\Events\ChatMessageEvent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
Route::get('bkash/pay', [App\Http\Controllers\UserController::class, 'viewBkash']);
Route::post('bkash/get-token', [App\Http\Controllers\BkashController::class, 'getToken'])->name('bkash-get-token');
    Route::post('bkash/create-payment', [App\Http\Controllers\BkashController::class, 'createPayment'])->name('bkash-create-payment');
    Route::post('bkash/execute-payment', [App\Http\Controllers\BkashController::class, 'executePayment'])->name('bkash-execute-payment');
    Route::get('bkash/query-payment', [App\Http\Controllers\BkashController::class, 'queryPayment'])->name('bkash-query-payment');
    Route::post('bkash/success', [App\Http\Controllers\BkashController::class, 'bkashSuccess'])->name('bkash-success');
    Route::get('mik/connect', [App\Http\Controllers\MikrotikApiController::class, 'connect']);


Route::middleware('guest')->domain('admin.' . env('APP_URL'))->group(function(){
    Route::get('/',[App\Http\Controllers\AdminAuthController::class, 'viewAdminLoginPage']);
    Route::get('login',[App\Http\Controllers\AdminAuthController::class, 'viewAdminLoginPage'])->name('login');
    Route::post('login',[App\Http\Controllers\AdminAuthController::class, 'adminLoginValidate']);
    

});
Route::middleware('isauth')->domain('admin.' . env('APP_URL'))->group(function(){
    Route::get('logout',[App\Http\Controllers\AdminAuthController::class, 'logout'])->name('logout');
    Route::get('dashboard',[App\Http\Controllers\AdminController::class, 'viewDashboard'])->name('viewAdminDashboard');
    Route::get('my-profile',[App\Http\Controllers\AdminAuthController::class, 'viewMyProfile'])->name('viewMyProfileAdmin');
    Route::post('my-profile/change-profile-info',[App\Http\Controllers\AdminAuthController::class, 'changeProfileInfo'])->name('changeProfileInfoAdmin');
    Route::post('my-profile/change-password',[App\Http\Controllers\AdminAuthController::class, 'changePassword'])->name('changePasswordAdmin');
    Route::post('my-profile/change-profile-picture',[App\Http\Controllers\AdminAuthController::class, 'changeProfilePicture'])->name('changeProfilePictureAdmin');
    
    //CRM Module Routes
    Route::prefix('crm')->group(function(){
        Route::get('view-users',[App\Http\Controllers\UserController::class, 'viewUsersPage'])->name('viewUsersPage');
        Route::post('view-users/get-users',[App\Http\Controllers\UserController::class, 'getUsersAll'])->name('getUsersAll');
        Route::get('add-new-user',[App\Http\Controllers\UserController::class, 'viewAddNewUserPage'])->name('viewAddNewUserPage');
        Route::post('add-new-user',[App\Http\Controllers\UserController::class, 'addNewUser']);
        Route::get('edit-user/{id}',[App\Http\Controllers\UserController::class, 'viewEditUser'])->name('editUser');
        Route::post('edit-user/{id}',[App\Http\Controllers\UserController::class, 'editUserAction']);
        Route::get('view-user/{id}',[App\Http\Controllers\UserController::class, 'viewViewUser'])->name('viewUser');
        Route::get('left-users',[App\Http\Controllers\UserController::class, 'viewLeftUsers'])->name('viewLeftUsers');
        Route::post('getLeftUsers',[App\Http\Controllers\UserController::class, 'getLeftUsers'])->name('getLeftUsers');
        Route::post('add-to-left-user',[App\Http\Controllers\UserController::class, 'addToLeftUser'])->name('addToLeftUser');
        Route::post('generate-bill',[App\Http\Controllers\UserController::class, 'generateBill'])->name('generateBill');
        Route::get('generate-invoice/{id}',[App\Http\Controllers\UserController::class, 'generateInvoice'])->name('generateInvoice');
        Route::post('fetch-single-left-user',[App\Http\Controllers\UserController::class, 'fetchSingleLeftUser'])->name('fetchSingleLeftUser');
        Route::post('update-left-user',[App\Http\Controllers\UserController::class, 'updateLeftUser'])->name('updateLeftUser');

        Route::get('test',[App\Http\Controllers\UserController::class, 'testsms'])->name('updateLeftUser');
        Route::prefix('reseller')->group(function(){
            Route::get('resellers',[App\Http\Controllers\ResellerController::class, 'viewResellers'])->name('viewResellers');
            Route::post('resellers/get-resellers',[App\Http\Controllers\ResellerController::class, 'getResellers'])->name('getResellers');
            Route::get('add-new-reseller',[App\Http\Controllers\ResellerController::class, 'viewAddNewReseller'])->name('addNewReseller');
            Route::post('add-new-reseller',[App\Http\Controllers\ResellerController::class, 'addNewReseller']);
            Route::post('delete-reseller',[App\Http\Controllers\ResellerController::class, 'deleteReseller'])->name('deleteReseller');
            Route::get('edit-reseller/{id}',[App\Http\Controllers\ResellerController::class, 'viewEditReseller'])->name('editReseller');
            Route::post('edit-reseller/{id}',[App\Http\Controllers\ResellerController::class, 'editReseller']);
            Route::get('view-reseller/{id}',[App\Http\Controllers\ResellerController::class, 'viewReseller'])->name('viewReseller');
           
    
        });


    });
    Route::prefix('tickets')->group(function(){
        Route::get('all-tickets',[App\Http\Controllers\TicketController::class, 'viewAllTickets'])->name('viewAllTickets');
        Route::post('get-tickets',[App\Http\Controllers\TicketController::class, 'getTickets'])->name('getTickets');
        Route::post('add-update-ticket',[App\Http\Controllers\TicketController::class, 'addUpdateTicket'])->name('addUpdateTicket');
        Route::post('fetch-ticket-single',[App\Http\Controllers\TicketController::class, 'fetchTicketSingle'])->name('fetchTicketSingle');
        Route::post('delete-ticket-single',[App\Http\Controllers\TicketController::class, 'deleteTicketSingle'])->name('deleteTicketSingle');
        Route::get('track-ticket/{id}',[App\Http\Controllers\TicketController::class, 'trackTicket'])->name('trackTicket');
       

    });
    Route::prefix('accounts')->group(function(){
        Route::get('monthly-bill',[App\Http\Controllers\MonthlyBillController::class, 'viewMonthlyBill'])->name('viewMonthlyBill');
        Route::post('get-monthly-bills',[App\Http\Controllers\MonthlyBillController::class, 'getMonthlyBills'])->name('getMonthlyBills');
        Route::post('fetch-single-bill',[App\Http\Controllers\MonthlyBillController::class, 'fetchSingleBill'])->name('fetchSingleBill');
        Route::post('update-bill',[App\Http\Controllers\MonthlyBillController::class, 'updateBill'])->name('updateBill');
        Route::post('pay-bill',[App\Http\Controllers\MonthlyBillController::class, 'payBill'])->name('payBill');
        Route::post('send-reminder-sms-single',[App\Http\Controllers\MonthlyBillController::class, 'sendSingleReminderSms'])->name('sendSingleReminderSms');
        Route::post('fetch-bill-history-single',[App\Http\Controllers\MonthlyBillController::class, 'fetchBillHistorySingle'])->name('fetchBillHistorySingle');
        Route::post('add-comment',[App\Http\Controllers\MonthlyBillController::class, 'addComment'])->name('addComment');
        Route::post('delete-bill-single',[App\Http\Controllers\MonthlyBillController::class, 'deleteBillSingle'])->name('deleteBillSingle');

        Route::get('monthly-expenses',[App\Http\Controllers\MonthlyExpenseController::class, 'viewMonthlyExpenses'])->name('viewMonthlyExpenses');
        Route::post('get-monthly-expenses',[App\Http\Controllers\MonthlyExpenseController::class, 'getMonthlyExpenses'])->name('getMonthlyExpenses');
        Route::post('add-update-expense',[App\Http\Controllers\MonthlyExpenseController::class, 'addUpdateExpense'])->name('addUpdateExpense');
        Route::post('fetch-expense-single',[App\Http\Controllers\MonthlyExpenseController::class, 'fetchExpenseSingle'])->name('fetchExpenseSingle');
        Route::post('delete-expense-single',[App\Http\Controllers\MonthlyExpenseController::class, 'deleteExpenseSingle'])->name('deleteExpenseSingle');

        Route::get('monthly-salary',[App\Http\Controllers\MonthlySalaryController::class, 'viewMonthlySalary'])->name('viewMonthlySalary');
        Route::post('get-monthly-salaries',[App\Http\Controllers\MonthlySalaryController::class, 'getMonthlySalaries'])->name('getMonthlySalaries');
        Route::post('fetch-salary-single',[App\Http\Controllers\MonthlySalaryController::class, 'fetchSalarySingle'])->name('fetchSalarySingle');
        Route::post('update-salary',[App\Http\Controllers\MonthlySalaryController::class, 'updateSalary'])->name('updateSalary');
        Route::post('pay-salary',[App\Http\Controllers\MonthlySalaryController::class, 'paySalary'])->name('paySalary');
        Route::post('delete-salary',[App\Http\Controllers\MonthlySalaryController::class, 'deleteSalary'])->name('deleteSalary');

        Route::get('monthly-upstream-bills',[App\Http\Controllers\MonthlyUpstreamBillController::class, 'viewMonthlyUpstreamBill'])->name('viewMonthlyUpstreamBill');
        Route::post('get-monthly-upstream-bills',[App\Http\Controllers\MonthlyUpstreamBillController::class, 'getMonthlyUpstreamBills'])->name('getMonthlyUpstreamBills');
        Route::post('fetch-monthly-upstream-bill-single',[App\Http\Controllers\MonthlyUpstreamBillController::class, 'fetchMonthlyUpstreamBillSingle'])->name('fetchMonthlyUpstreamBillSingle');
        Route::post('update-upstream-bill',[App\Http\Controllers\MonthlyUpstreamBillController::class, 'updateUpstreamBill'])->name('updateUpstreamBill');
        Route::post('pay-upstream-bill',[App\Http\Controllers\MonthlyUpstreamBillController::class, 'payUpstreamBill'])->name('payUpstreamBill');
        Route::post('delete-upstream-bill',[App\Http\Controllers\MonthlyUpstreamBillController::class, 'deleteUpstreamBill'])->name('deleteUpstreamBill');

        Route::get('monthly-downstream-bills',[App\Http\Controllers\MonthlyDownstreamBillController::class, 'viewMonthlyDownstreamBill'])->name('viewMonthlyDownstreamBill');
        Route::post('get-monthly-downstream-bills',[App\Http\Controllers\MonthlyDownstreamBillController::class, 'getMonthlyDownstreamBills'])->name('getMonthlyDownstreamBills');
        Route::post('fetch-monthly-downstream-bill-single',[App\Http\Controllers\MonthlyDownstreamBillController::class, 'fetchMonthlyDownstreamBillSingle'])->name('fetchMonthlyDownstreamBillSingle');
        Route::post('update-downstream-bill',[App\Http\Controllers\MonthlyDownstreamBillController::class, 'updateDownstreamBill'])->name('updateDownstreamBill');
        Route::post('pay-downstream-bill',[App\Http\Controllers\MonthlyDownstreamBillController::class, 'payDownstreamBill'])->name('payDownstreamBill');
        Route::post('delete-downstream-bill',[App\Http\Controllers\MonthlyDownstreamBillController::class, 'deleteDownstreamBill'])->name('deleteDownstreamBill');


        Route::get('monthly-service-charges',[App\Http\Controllers\ServiceChargeController::class, 'viewServiceCharges'])->name('viewServiceCharges');
        Route::post('get-service-charges',[App\Http\Controllers\ServiceChargeController::class, 'getServiceCharges'])->name('getServiceCharges');
        Route::post('fetch-user-data',[App\Http\Controllers\ServiceChargeController::class, 'fetchUserData'])->name('fetchUserData');
        Route::post('add-update-service-charge',[App\Http\Controllers\ServiceChargeController::class, 'addUpdateServiceCharge'])->name('addUpdateServiceCharge');
        Route::post('fetch-service-charge-single',[App\Http\Controllers\ServiceChargeController::class, 'fetchServiceChargeSingle'])->name('fetchServiceChargeSingle');
        Route::post('pay-service-charge',[App\Http\Controllers\ServiceChargeController::class, 'payServiceCharge'])->name('payServiceCharge');
        Route::post('delete-service-charge',[App\Http\Controllers\ServiceChargeController::class, 'deleteServiceCharge'])->name('deleteServiceCharge');

        Route::get('monthly-income-statement',[App\Http\Controllers\AccountsController::class, 'viewMonthlyIncomeStatement'])->name('viewMonthlyIncomeStatement');
    });
    Route::prefix('sms')->group(function(){
        Route::get('bill-reminder',[App\Http\Controllers\SMSController::class, 'viewReminderSms'])->name('viewReminderSms');
        Route::get('check-balance',[App\Http\Controllers\SMSController::class, 'checkSmsBalance'])->name('checkSmsBalance');
        Route::post('bill-reminder/fetch-users',[App\Http\Controllers\SMSController::class, 'fetchReminderSmsUsers'])->name('fetchReminderSmsUsers');
        Route::post('bill-reminder/send-sms',[App\Http\Controllers\SMSController::class, 'sendReminderSms'])->name('sendReminderSms');
       
       

    });
    Route::prefix('settings')->group(function(){
        Route::get('generate-monthly-bill',[App\Http\Controllers\MonthlyBillController::class, 'generateMonthlyBill'])->name('generateMonthlyBill');
        
        

    });
    
    
});