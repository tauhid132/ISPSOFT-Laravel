<?php

use App\Events\MessageSent;
use App\Events\ChatMessageEvent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


//Admin Login Routes
Route::middleware('guest')->domain('admin.' . env('APP_URL'))->group(function(){
    Route::get('/',[App\Http\Controllers\AdminController::class, 'viewAdminLoginPage']);
    Route::get('login',[App\Http\Controllers\AdminController::class, 'viewAdminLoginPage'])->name('login');
    Route::post('login',[App\Http\Controllers\AdminController::class, 'adminLoginValidate']);
});

//Admin Routes after Auth
Route::middleware('isauth')->domain('admin.' . env('APP_URL'))->group(function(){
    Route::get('logout',[App\Http\Controllers\AdminController::class, 'logout'])->name('logout');
    Route::get('dashboard',[App\Http\Controllers\AdminController::class, 'viewDashboard'])->name('viewAdminDashboard');
    Route::get('my-profile',[App\Http\Controllers\AdminController::class, 'viewMyProfile'])->name('viewMyProfileAdmin');
    Route::post('my-profile/change-profile-info',[App\Http\Controllers\AdminController::class, 'changeProfileInfo'])->name('changeProfileInfoAdmin');
    Route::post('my-profile/change-password',[App\Http\Controllers\AdminController::class, 'changePassword'])->name('changePasswordAdmin');
    Route::post('my-profile/change-profile-picture',[App\Http\Controllers\AdminController::class, 'changeProfilePicture'])->name('changeProfilePictureAdmin');
    Route::post('dashboard/add-edit-note',[App\Http\Controllers\AdminController::class, 'addEditNote'])->name('addEditNote');
    Route::post('dashboard/fetch-note',[App\Http\Controllers\AdminController::class, 'fetchNote'])->name('fetchNote');
    Route::post('dashboard/delete-note',[App\Http\Controllers\AdminController::class, 'deleteNote'])->name('deleteNote');
    
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
        Route::post('delete-left-user',[App\Http\Controllers\UserController::class, 'deleteLeftUser'])->name('deleteLeftUser');
        
        
        Route::prefix('reseller')->group(function(){
            Route::get('resellers',[App\Http\Controllers\ResellerController::class, 'viewResellers'])->name('viewResellers');
            Route::post('resellers/get-resellers',[App\Http\Controllers\ResellerController::class, 'getResellers'])->name('getResellers');
            Route::get('add-new-reseller',[App\Http\Controllers\ResellerController::class, 'viewAddNewReseller'])->name('addNewReseller');
            Route::post('add-new-reseller',[App\Http\Controllers\ResellerController::class, 'addNewReseller']);
            Route::post('delete-reseller',[App\Http\Controllers\ResellerController::class, 'deleteReseller'])->name('deleteReseller');
            Route::get('edit-reseller/{id}',[App\Http\Controllers\ResellerController::class, 'viewEditReseller'])->name('editReseller');
            Route::post('edit-reseller/{id}',[App\Http\Controllers\ResellerController::class, 'editReseller']);
            Route::get('view-reseller/{id}',[App\Http\Controllers\ResellerController::class, 'viewReseller'])->name('viewReseller');
            Route::get('reseller-users/{reseller_id}',[App\Http\Controllers\ResellerController::class, 'viewResellerUsers'])->name('viewResellerUsers');
            Route::get('reseller-users/{reseller_id}/get-users',[App\Http\Controllers\ResellerController::class, 'getResellerUsers'])->name('getResellerUsers');
            Route::post('reseller-users/{reseller_id}/add-edit-user',[App\Http\Controllers\ResellerController::class, 'addEditResellerUser'])->name('addEditResellerUser');
            Route::post('fetch-reseller-user',[App\Http\Controllers\ResellerController::class, 'fetchResellerUser'])->name('fetchResellerUser');
            Route::post('delete-reseller-user',[App\Http\Controllers\ResellerController::class, 'deleteResellerUser'])->name('deleteResellerUser');

            Route::post('block-reseller-user',[App\Http\Controllers\ResellerController::class, 'blockResellerUser'])->name('blockResellerUser');
            Route::post('unblock-reseller-user',[App\Http\Controllers\ResellerController::class, 'unblockResellerUser'])->name('unblockResellerUser');
            Route::get('sync',[App\Http\Controllers\ResellerController::class, 'syncMikrotik'])->name('sync');
            
        });
    });

    //Tickets Module Route
    Route::prefix('ticketing')->group(function(){
        Route::get('tickets',[App\Http\Controllers\TicketController::class, 'viewAllTickets'])->name('viewAllTickets');
        Route::post('tickets/get-tickets',[App\Http\Controllers\TicketController::class, 'getTickets'])->name('getTickets');
        Route::post('tickets/add-update-ticket',[App\Http\Controllers\TicketController::class, 'addUpdateTicket'])->name('addUpdateTicket');
        Route::post('tickets/fetch-ticket-single',[App\Http\Controllers\TicketController::class, 'fetchTicketSingle'])->name('fetchTicketSingle');
        Route::post('tickets/delete-ticket-single',[App\Http\Controllers\TicketController::class, 'deleteTicketSingle'])->name('deleteTicketSingle');
        Route::get('tickets/track-ticket/{id}',[App\Http\Controllers\TicketController::class, 'trackTicket'])->name('trackTicket');
        Route::get('tickets/track-ticket/{id}/start-processing',[App\Http\Controllers\TicketController::class, 'startProcessingTicket'])->name('startProcessingTicket');
        Route::get('tickets/track-ticket/{id}/close-ticket',[App\Http\Controllers\TicketController::class, 'closeTicket'])->name('closeTicket');
        Route::post('tickets/track-ticket/{id}/assign-executives',[App\Http\Controllers\TicketController::class, 'assignExecutive'])->name('assignExecutive');
        Route::post('tickets/track-ticket/{ticket_id}/add-comment',[App\Http\Controllers\TicketController::class, 'addCommentTicket'])->name('addCommentTicket');
        Route::get('tickets/track-ticket/{ticket_id}/delete-comment/{comment_id}',[App\Http\Controllers\TicketController::class, 'deleteCommentTicket'])->name('deleteCommentTicket');
        Route::get('tickets/create-ticket',[App\Http\Controllers\TicketController::class, 'viewCreateTicket'])->name('createTicket');
        Route::post('tickets/create-ticket',[App\Http\Controllers\TicketController::class, 'createTicket']);
    });


    //Accounts Module Routes
    Route::prefix('accounts')->group(function(){
        Route::get('monthly-bill',[App\Http\Controllers\MonthlyBillController::class, 'viewMonthlyBill'])->name('viewMonthlyBill');
        Route::post('get-monthly-bills',[App\Http\Controllers\MonthlyBillController::class, 'getMonthlyBills'])->name('getMonthlyBills');
        Route::post('get-billing-data',[App\Http\Controllers\MonthlyBillController::class, 'getBillingData'])->name('getBillingData');
        Route::post('fetch-single-bill',[App\Http\Controllers\MonthlyBillController::class, 'fetchSingleBill'])->name('fetchSingleBill');
        Route::post('update-bill',[App\Http\Controllers\MonthlyBillController::class, 'updateBill'])->name('updateBill');
        Route::post('pay-bill',[App\Http\Controllers\MonthlyBillController::class, 'payBill'])->name('payBill');
        Route::post('send-reminder-sms-single',[App\Http\Controllers\MonthlyBillController::class, 'sendSingleReminderSms'])->name('sendSingleReminderSms');
        Route::post('fetch-bill-history-single',[App\Http\Controllers\MonthlyBillController::class, 'fetchBillHistorySingle'])->name('fetchBillHistorySingle');
        Route::post('add-comment',[App\Http\Controllers\MonthlyBillController::class, 'addComment'])->name('addComment');
        Route::post('change-expiry-date',[App\Http\Controllers\MonthlyBillController::class, 'changeExpiryDate'])->name('changeExpiryDate');
        Route::post('delete-bill-single',[App\Http\Controllers\MonthlyBillController::class, 'deleteBillSingle'])->name('deleteBillSingle');
        Route::get('download-money-receipt/{invoice_id}',[App\Http\Controllers\MonthlyBillController::class, 'downloadMoneyReceipt'])->name('downloadMoneyReceipt');
        Route::get('download-bill-statement/{user_id}',[App\Http\Controllers\MonthlyBillController::class, 'downloadBillStatement'])->name('downloadBillStatement');

        Route::post('set-billing-settings',[App\Http\Controllers\MonthlyBillController::class, 'setBillingSettings'])->name('setBillingSettings');
        
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
        
        Route::get('monthly-upstream-downstream-bills',[App\Http\Controllers\MonthlyUpstreamDownstreamBillController::class, 'viewMonthlyUpstreamDownstreamBill'])->name('viewMonthlyUpstreamDownstreamBill');
        Route::post('monthly-upstream-downstream-bills/get-monthly-upstream-downstream-bills',[App\Http\Controllers\MonthlyUpstreamDownstreamBillController::class, 'getMonthlyUpstreamDownstreamBills'])->name('getMonthlyUpstreamDownstreamBills');
        Route::post('fetch-monthly-upstream-downstream-bill-single',[App\Http\Controllers\MonthlyUpstreamDownstreamBillController::class, 'fetchMonthlyUpstreamDownstreamBillSingle'])->name('fetchMonthlyUpstreamDownstreamBillSingle');
        Route::post('update-upstream-bill',[App\Http\Controllers\MonthlyUpstreamDownstreamBillController::class, 'updateUpstreamBill'])->name('updateUpstreamBill');
        Route::post('pay-upstream-bill',[App\Http\Controllers\MonthlyUpstreamDownstreamBillController::class, 'payUpstreamBill'])->name('payUpstreamBill');
        Route::post('delete-upstream-bill',[App\Http\Controllers\MonthlyUpstreamDownstreamBillController::class, 'deleteUpstreamBill'])->name('deleteUpstreamBill');
        
        Route::get('other-invoices',[App\Http\Controllers\OtherInvoiceController::class, 'viewOtherInvoices'])->name('viewOtherInvoices');
        Route::post('other-invoices/get-other-invoices',[App\Http\Controllers\OtherInvoiceController::class, 'getOtherInvoices'])->name('getOtherInvoices');
        Route::post('other-invoices/fetch-user-data',[App\Http\Controllers\OtherInvoiceController::class, 'fetchUserData'])->name('fetchUserData');
        Route::post('other-invoices/add-edit-other-invoice',[App\Http\Controllers\OtherInvoiceController::class, 'addEditOtherInvoice'])->name('addEditOtherInvoice');
        Route::post('other-invoices/fetch-other-invoice',[App\Http\Controllers\OtherInvoiceController::class, 'fetchOtherInvoice'])->name('fetchOtherInvoice');
        Route::post('other-invoices/pay-other-invoice',[App\Http\Controllers\OtherInvoiceController::class, 'payOtherInvoice'])->name('payOtherInvoice');
        Route::post('other-invoices/delete-other-invoice',[App\Http\Controllers\OtherInvoiceController::class, 'deleteOtherInvoice'])->name('deleteOtherInvoice');
        
        Route::get('monthly-income-statement',[App\Http\Controllers\AccountsController::class, 'viewMonthlyIncomeStatement'])->name('viewMonthlyIncomeStatement');
        Route::post('monthly-income-statement/update-bkash-withdraw',[App\Http\Controllers\AccountsController::class, 'updateBkashWithdraw'])->name('updateBkashWithdraw');

        Route::get('pass-comment',[App\Http\Controllers\AccountsController::class, 'passComment'])->name('passComment');
        Route::get('last-month-unpaid',[App\Http\Controllers\AccountsController::class, 'last_month_unpaid'])->name('last_month_unpaid');

    });

    //SMS Module Routes
    Route::prefix('sms')->group(function(){
        Route::get('bill-reminder',[App\Http\Controllers\SMSController::class, 'viewReminderSms'])->name('viewReminderSms');
        Route::get('check-balance',[App\Http\Controllers\SMSController::class, 'checkSmsBalance'])->name('checkSmsBalance');
        Route::post('bill-reminder/fetch-users',[App\Http\Controllers\SMSController::class, 'fetchReminderSmsUsers'])->name('fetchReminderSmsUsers');
        Route::post('bill-reminder/send-sms',[App\Http\Controllers\SMSController::class, 'sendReminderSms'])->name('sendReminderSms');
        
        Route::get('single-sms',[App\Http\Controllers\SMSController::class, 'viewSingleSmsSender'])->name('viewSingleSmsSender');
        Route::post('single-sms/send-single-sms',[App\Http\Controllers\SMSController::class, 'sendSingleSms'])->name('sendSingleSms');
        
        Route::get('sms-templates',[App\Http\Controllers\SmsTemplateController::class, 'viewSmsTemplates'])->name('viewSmsTemplates');
        Route::get('sms-templates/get-sms-templates',[App\Http\Controllers\SmsTemplateController::class, 'getSmsTemplates'])->name('getSmsTemplates');
        Route::post('sms-templates/add-edit-template',[App\Http\Controllers\SmsTemplateController::class, 'addEditTemplate'])->name('addEditTemplate');
        Route::post('sms-templates/fetch-template',[App\Http\Controllers\SmsTemplateController::class, 'fetchTemplate'])->name('fetchTemplate');
        Route::post('sms-templates/delete-template',[App\Http\Controllers\SmsTemplateController::class, 'deleteTemplate'])->name('deleteTemplate');

        Route::get('group-sms',[App\Http\Controllers\SMSController::class, 'viewGroupSms'])->name('viewGroupSms');
        Route::post('group-sms/fetch-users',[App\Http\Controllers\SMSController::class, 'fetchGroupSmsUsers'])->name('fetchGroupSmsUsers');
        Route::post('group-sms/send-sms',[App\Http\Controllers\SMSController::class, 'sendGroupSms'])->name('sendGroupSms');
    });
    //SMS Module Routes
    Route::prefix('reports')->group(function(){
        Route::get('monthly-report',[App\Http\Controllers\ReportController::class, 'viewMonthlyReport'])->name('viewMonthlyReport');
       
    });

    //Settings Module Routes
    Route::prefix('settings')->group(function(){
        Route::get('admins',[App\Http\Controllers\AdminController::class, 'viewAdmins'])->name('viewAdmins');
        Route::get('admins/get-admins',[App\Http\Controllers\AdminController::class, 'getAdmins'])->name('getAdmins');
        Route::post('admins/add-new-admin',[App\Http\Controllers\AdminController::class, 'addNewAdmin'])->name('addNewAdmin');
        Route::post('admins/delete-admin',[App\Http\Controllers\AdminController::class, 'deleteAdmin'])->name('deleteAdmin');
        Route::post('admins/change-password',[App\Http\Controllers\AdminController::class, 'changeAdminPassword'])->name('changeAdminPassword');
        
        Route::get('manual-generator',[App\Http\Controllers\SettingsController::class, 'viewManualGenerator'])->name('viewManualGenerator');
        Route::post('manual-generator/generate-monthly-bill-invoices',[App\Http\Controllers\SettingsController::class, 'generateMonthlyBillInvoices'])->name('generateMonthlyBillInvoices');
        Route::post('manual-generator/generate-monthly-salary',[App\Http\Controllers\SettingsController::class, 'generateMonthlySalary'])->name('generateMonthlySalary');
        Route::post('manual-generator/generate-upstream-downstream-bills',[App\Http\Controllers\SettingsController::class, 'generateMonthlyUpstreamDownstreamBills'])->name('generateMonthlyUpstreamDownstreamBills');
        Route::get('manual-generator/billing-sheet-pdf',[App\Http\Controllers\SettingsController::class, 'generateBillingSheetPdf'])->name('generateBillingSheet');
        Route::get('manual-generator/monthly-invoices-pdf',[App\Http\Controllers\SettingsController::class, 'monthlyInvoicesPdf'])->name('monthlyInvoicesPdf');
        
        Route::get('system-logs',[App\Http\Controllers\SystemLogController::class, 'viewSystemLogs'])->name('viewSystemLogs');
        Route::get('system-logs/get-system-logs',[App\Http\Controllers\SystemLogController::class, 'getSystemLogs'])->name('getSystemLogs');
    });
    

    //Inventory Module Routes
    Route::prefix('inventory')->group(function(){
        Route::get('product-categories',[App\Http\Controllers\ProductCategoryController::class, 'viewProductCategories'])->name('viewProductCategories');
        Route::get('product-categories/get-product-categories',[App\Http\Controllers\ProductCategoryController::class, 'getProductCategories'])->name('getProductCategories');
        Route::post('product-categories/add-edit-product-category',[App\Http\Controllers\ProductCategoryController::class, 'addEditProductCategory'])->name('addEditProductCategory');
        Route::post('product-categories/fetch-product-category',[App\Http\Controllers\ProductCategoryController::class, 'fetchProductCategory'])->name('fetchProductCategory');
        Route::post('product-categories/delete-product-category',[App\Http\Controllers\ProductCategoryController::class, 'deleteProductCategory'])->name('deleteProductCategory');
        Route::post('product-categories/add-stock',[App\Http\Controllers\ProductCategoryController::class, 'addProductStock'])->name('addProductStock');
        Route::post('product-categories/remove-stock',[App\Http\Controllers\ProductCategoryController::class, 'removeProductStock'])->name('removeProductStock');
        Route::get('product-categories/view-stock-history/{product_id}',[App\Http\Controllers\ProductCategoryController::class, 'viewProductStockHistory'])->name('viewProductStockHistory');
        Route::post('product-categories/view-stock-history/get-stock-history/',[App\Http\Controllers\ProductCategoryController::class, 'getProductStockHistory'])->name('getProductStockHistory');

        Route::get('products',[App\Http\Controllers\ProductController::class, 'viewProducts'])->name('viewProducts');
        Route::get('products/get-products',[App\Http\Controllers\ProductController::class, 'getProducts'])->name('getProducts');
        Route::post('products/add-edit-product',[App\Http\Controllers\ProductController::class, 'addEditProduct'])->name('addEditProduct');
        Route::post('products/fetch-product',[App\Http\Controllers\ProductController::class, 'fetchProduct'])->name('fetchProduct');
        Route::post('products/delete-product',[App\Http\Controllers\ProductController::class, 'deleteProduct'])->name('deleteProduct');
        
        Route::get('packages',[App\Http\Controllers\PackageController::class, 'viewPackages'])->name('viewPackages');
        Route::get('packages/get-packages',[App\Http\Controllers\PackageController::class, 'getPackages'])->name('getPackages');
        Route::post('packages/add-edit-package',[App\Http\Controllers\PackageController::class, 'addEditPackage'])->name('addEditPackage');
        Route::post('packages/fetch-package',[App\Http\Controllers\PackageController::class, 'fetchPackage'])->name('fetchPackage');
        Route::post('packages/delete-package',[App\Http\Controllers\PackageController::class, 'deletePackage'])->name('deletePackage');
    });

    
    //Vendor Module Routes
    Route::prefix('vendors')->group(function(){
        Route::get('up-downstreams',[App\Http\Controllers\UpstreamDownstreamController::class, 'viewUpDownstreams'])->name('viewUpDownstreams');
        Route::get('up-downstreams/get-up-downstreams',[App\Http\Controllers\UpstreamDownstreamController::class, 'getUpDownstreams'])->name('getUpDownstreams');
        Route::post('up-downstreams/add-new-up-downstreams',[App\Http\Controllers\UpstreamDownstreamController::class, 'addNewUpDownstream'])->name('addNewUpDownstream');
        Route::post('up-downstreams/fetch-up-downstream',[App\Http\Controllers\UpstreamDownstreamController::class, 'fetchUpDownstream'])->name('fetchUpDownstream');
        Route::post('up-downstreams/delete-up-downstream',[App\Http\Controllers\UpstreamDownstreamController::class, 'deleteUpDownstream'])->name('deleteUpDownstream');
        
        Route::get('products-vendors',[App\Http\Controllers\ProductsVendorController::class, 'viewProductVendors'])->name('viewProductVendors');
        Route::get('products-vendors/get-products-vendors',[App\Http\Controllers\ProductsVendorController::class, 'getProductsVendors'])->name('getProductsVendors');
        Route::post('products-vendors/fetch-vendor',[App\Http\Controllers\ProductsVendorController::class, 'fetchVendor'])->name('fetchVendor');
        Route::post('products-vendors/add-edit-products-vendor',[App\Http\Controllers\ProductsVendorController::class, 'addEditProductsVendor'])->name('addEditProductsVendor');
        Route::post('products-vendors/delete-products-vendor',[App\Http\Controllers\ProductsVendorController::class, 'deleteProductsVendor'])->name('deleteProductsVendor');
    });


    //HRM Module Routes
    Route::prefix('hrm')->group(function(){
        Route::get('employees',[App\Http\Controllers\EmployeeController::class, 'viewEmployees'])->name('viewEmployees');
        Route::get('employees/get-employees',[App\Http\Controllers\EmployeeController::class, 'getEmployees'])->name('getEmployees');
        Route::get('employees/add-new-employee',[App\Http\Controllers\EmployeeController::class, 'viewAddNewEmployee'])->name('addNewEmployee');
        Route::post('employees/add-new-employee',[App\Http\Controllers\EmployeeController::class, 'addNewEmployee']);
        Route::post('employees/delete-employee',[App\Http\Controllers\EmployeeController::class, 'deleteEmployee'])->name('deleteEmployee');
        Route::get('employees/edit-employee/{id}',[App\Http\Controllers\EmployeeController::class, 'viewEditEmployee'])->name('editEmployee');
        Route::post('employees/edit-employee/{id}',[App\Http\Controllers\EmployeeController::class, 'editEmployee']);
        Route::get('employees/view-employee/{id}',[App\Http\Controllers\EmployeeController::class, 'viewEmployee'])->name('viewEmployee');
    });


    //Sales & Marketing Module Routes
    Route::prefix('sales-and-marketing')->group(function(){
        Route::get('new-connection-queries',[App\Http\Controllers\NewConnectionQueryController::class, 'viewNewConnectionQueries'])->name('viewNewConnectionQueries');
        Route::get('new-connection-queries/get-new-connection-queries',[App\Http\Controllers\NewConnectionQueryController::class, 'getNewConnectionQueries'])->name('getNewConnectionQueries');
        Route::post('new-connection-queries/add-edit-new-connection-queries',[App\Http\Controllers\NewConnectionQueryController::class, 'addEditNewConnectionQuery'])->name('addEditNewConnectionQuery'); 
        Route::post('new-connection-queries/fetch-new-connection-queries',[App\Http\Controllers\NewConnectionQueryController::class, 'fetchNewConnectionQuery'])->name('fetchNewConnectionQuery');
        Route::post('new-connection-queries/delete-new-connection-queries',[App\Http\Controllers\NewConnectionQueryController::class, 'deleteNewConnectionQuery'])->name('deleteNewConnectionQuery');
        
        Route::get('d2c-marketing',[App\Http\Controllers\D2CMarketingController::class, 'viewD2CMarketing'])->name('viewD2CMarketing');
        Route::get('d2c-marketing/get-d2c-marketing',[App\Http\Controllers\D2CMarketingController::class, 'getD2CMarketing'])->name('getD2CMarketing');
        Route::post('d2c-marketing/add-edit-d2c-marketing',[App\Http\Controllers\D2CMarketingController::class, 'addEditD2CMarketing'])->name('addEditD2CMarketing'); 
        Route::post('d2c-marketing/fetch-d2c-marketing',[App\Http\Controllers\D2CMarketingController::class, 'fetchD2CMarketing'])->name('fetchD2CMarketing');
        Route::post('d2c-marketing/delete-d2c-marketing',[App\Http\Controllers\D2CMarketingController::class, 'deleteD2CMarketing'])->name('deleteD2CMarketing');
    });

    Route::prefix('mikrotik-api')->group(function(){
        Route::get('mikrotiks',[App\Http\Controllers\MikrotikController::class, 'viewMikrotiks'])->name('viewMikrotiks');
        Route::get('mikrotiks/get-mikrotiks',[App\Http\Controllers\MikrotikController::class, 'getMikrotiks'])->name('getMikrotiks');
        Route::post('mikrotiks/add-edit-mikrotik',[App\Http\Controllers\MikrotikController::class, 'addEditMikrotik'])->name('addEditMikrotik'); 
        Route::post('mikrotiks/fetch-mikrotik',[App\Http\Controllers\MikrotikController::class, 'fetchMikrotik'])->name('fetchMikrotik');
        Route::post('mikrotiks/delete-mikrotik',[App\Http\Controllers\MikrotikController::class, 'deleteMikrotik'])->name('deleteMikrotik');

        Route::get('api-users',[App\Http\Controllers\MikrotikController::class, 'viewApiUsers'])->name('viewApiUsers');
        Route::get('api-users/get-api-users',[App\Http\Controllers\MikrotikController::class, 'getApiUsers'])->name('getApiUsers');
        Route::post('api-users/block-user',[App\Http\Controllers\MikrotikController::class, 'blockUser'])->name('blockUser');
        Route::post('api-users/unblock-user',[App\Http\Controllers\MikrotikController::class, 'unblockUser'])->name('unblockUser');
       

        Route::get('connect',[App\Http\Controllers\MikrotikController::class, 'autoExpireUsers']);
        Route::get('users',[App\Http\Controllers\MikrotikController::class, 'users']);
        
        
    });
});


Route::middleware('guest')->domain('selfcare.' . env('APP_URL'))->group(function(){
    //Auth Routes
    Route::get('/',[App\Http\Controllers\SelfcareController::class, 'viewUserLogin']);
    Route::get('login',[App\Http\Controllers\SelfcareController::class, 'viewUserLogin'])->name('userLogin');
    Route::post('login',[App\Http\Controllers\SelfcareController::class, 'validateUserLogin']);
    

    Route::get('dashboard',[App\Http\Controllers\SelfcareController::class, 'viewSelfcareDashboard'])->name('viewSelfcareDashboard');
    //QuickPay Routes
    Route::get('quick-pay', [App\Http\Controllers\QuickPayController::class, 'viewQuickPay'])->name('viewQuickPay');
    Route::post('quick-pay', [App\Http\Controllers\QuickPayController::class, 'quickPay']);
    Route::post('quick-pay/pay', [App\Http\Controllers\QuickPayController::class, 'quickPayPayment'])->name('quickPayPayment');
    Route::get('quick-pay/payment-success', [App\Http\Controllers\QuickPayController::class, 'viewQuickPayPaymentSuccess'])->name('viewQuickPayPaymentSuccess');
    Route::get('quick-pay/payment-success/download-receipt/{invoice_id}', [App\Http\Controllers\QuickPayController::class, 'downloadPaymentReceipt'])->name('downloadPaymentReceipt');
    Route::get('/bkash/payment', [App\Http\Controllers\BkashTokenizePaymentController::class,'index']);
    Route::get('/bkash/create-payment', [App\Http\Controllers\BkashTokenizePaymentController::class,'createPayment'])->name('bkash-create-payment');
    Route::get('/bkash/callback', [App\Http\Controllers\BkashTokenizePaymentController::class,'callBack'])->name('bkash-callBack');
    Route::get('/bkash/search/{trxID}', [App\Http\Controllers\BkashTokenizePaymentController::class,'searchTnx'])->name('bkash-serach');
    Route::get('/bkash/refund', [App\Http\Controllers\BkashTokenizePaymentController::class,'refund'])->name('bkash-refund');
    Route::get('/bkash/refund/status', [App\Http\Controllers\BkashTokenizePaymentController::class,'refundStatus'])->name('bkash-refund-status');

    Route::get('/receipt/{invoice_id}',[App\Http\Controllers\MonthlyBillController::class, 'downloadMoneyReceipt']);






    Route::prefix('reseller')->group(function(){
        Route::get('/',[App\Http\Controllers\ResellerController::class, 'viewLogin']);
        Route::get('login',[App\Http\Controllers\ResellerController::class, 'viewLogin'])->name('resellerLogin');
        Route::post('login',[App\Http\Controllers\ResellerController::class, 'login']);
        Route::get('logout',[App\Http\Controllers\ResellerController::class, 'logout'])->name('logout');
       
        Route::get('/dashboard',[App\Http\Controllers\ResellerController::class, 'viewResellerDashboard'])->name('viewResellerDashboard');
        Route::get('/my-users',[App\Http\Controllers\ResellerController::class, 'viewMyUsers'])->name('viewMyUsers');
        Route::get('/my-users/get-users/{reseller_id}',[App\Http\Controllers\ResellerController::class, 'getMyUsers'])->name('getMyUsers');

        Route::post('block-reseller-user',[App\Http\Controllers\ResellerController::class, 'blockResellerUser'])->name('blockResellerUserByReseller');
        Route::post('unblock-reseller-user',[App\Http\Controllers\ResellerController::class, 'unblockResellerUser'])->name('unblockResellerUserByReseller');
        Route::post('change-reseller-user-password',[App\Http\Controllers\ResellerController::class, 'changeResellerUserPassword'])->name('changeResellerUserPassword');
        
    });
});