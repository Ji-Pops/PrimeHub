<?php

use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminContactsController;
use App\Http\Controllers\AdminMaintenanceController;
use App\Http\Controllers\TenantMaintenanceController;
use App\Http\Controllers\PersonnelMaintenanceController;

use App\Http\Controllers\PasswordController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Route for showing login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
//Route for login fnction
Route::post('/login', [LoginController::class, 'login']);
//Route for logout function
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Route for dashboard directory based on users user_type
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/tenant/dashboard', [DashboardController::class, 'index'])->name('tenant.dashboard');
    Route::get('/personnel/dashboard', [DashboardController::class, 'index'])->name('personnel.dashboard');
});

//Route for showing change password form admin
Route::get('admin/change-password', [PasswordController::class, 'change_Password'])->name('admin.change-password');
//Route for change password
Route::post('admin/changePassword/{id}', [PasswordController::class, 'changePassword'])->name('admin.changePassword');

//Route for showing change password form tenant
Route::get('tenant/change-password', [PasswordController::class, 'change_TenantPassword'])->name('tenant.change-password');
//Route for change password
Route::post('tenant/changePassword/{id}', [PasswordController::class, 'changeTenantPassword'])->name('tenant.changePassword');

Route::get('admin/search-tenants', [AdminContactsController::class, 'searchTenant'])->name('admin.search-tenants');


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Contacts

//Admin Sidebar
//Route for sidebar Contact => Admin
Route::get('admin/admin', [AdminContactsController::class, 'admin'])->name('admin.admin');

//Route for sidebar Contact => Tenant
Route::get('admin/tenant', [AdminContactsController::class, 'tenants'])->name('admin.tenant');

//Route for showing Add Admin Form Page
Route::get('admin/add-admin', [AdminContactsController::class, 'add_Admin'])->name('admin.add-admin');

//Route for processing Add Admin - Insertion to table "contacts"
Route::post('admin/addAdmin', [AdminContactsController::class, 'addAdmin'])->name('admin.addAdmin');

//Route for showing Update Admin Form Page
Route::get('admin/update-admin/{id}', [AdminContactsController::class, 'update_Admin'])->name('admin.update-admin');

//Route for processing Update Admin - updating to table "contacts"
Route::post('admin/updateAdmin/{id}', [AdminContactsController::class, 'updateAdmin'])->name('admin.updateAdmin');

//Route for showing User Registration Form Page
Route::get('admin/user-registration/{id}', [AdminContactsController::class, 'admin_Registration'])->name('admin.user-registration');

//Route for showing Add Tenant Form Page
Route::get('admin/add-tenant', [AdminContactsController::class, 'add_Tenant'])->name('admin.add-tenant');

//Route for processing Add Tenant - Insertion to table "contacts"
Route::post('admin/addTenant', [AdminContactsController::class, 'addTenant'])->name('admin.addTenant');

//Route for showing Update Tenant Form Page
Route::get('admin/update-tenant/{id}', [AdminContactsController::class, 'update_Tenant'])->name('admin.update-tenant');

//Route for processing Update Tenant - updating to table "contacts"
Route::post('admin/updateTenant/{id}', [AdminContactsController::class, 'updateTenant'])->name('admin.updateTenant');

//Route for processing Delete Tenant - deleting to table "contacts"
Route::post('admin/deleteAdmin/{id}', [AdminContactsController::class, 'deleteAdmin'])->name('admin.deleteAdmin');






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Utilities
//Route for sidebar Utilities => Maintenance
Route::get('admin/maintenance-task', [AdminMaintenanceController::class, 'maintenanceTask'])->name('admin.maintenance-task');

//Route for showing Maintenance View
Route::get('admin/maintenance-view/{id}', [AdminMaintenanceController::class, 'maintenanceView'])->name('admin.maintenance-view');

Route::get('admin/maintenance-assignment/{id}', [AdminMaintenanceController::class, 'maintenanceAssignment'])->name('admin.maintenance-assignment');

Route::post('admin/maintenanceAssignmentProcess', [AdminMaintenanceController::class, 'maintenanceAssignmentProcess'])->name('admin.maintenanceAssignmentProcess');

Route::post('admin/closeRequest/{maintenance}', [AdminMaintenanceController::class, 'closeRequest'])->name('admin.closeRequest');








////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 //User Registration
 Route::get('admin/admin-registration/{id}', [AdminContactsController::class, 'admin_Registration'])->name('admin.admin-registration');

 Route::post('/admin.registerAdmin', [AdminContactsController::class, 'registerAdmin'])->name('admin.registerAdmin');







////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Unit Manangement
Route::get('admin/unit-management', [UnitController::class, 'unit_Management'])->name('admin.unit-management');

Route::post('admin/addUnit', [UnitController::class, 'addUnit'])->name('admin.addUnit');

Route::delete('admin/deleteUnit/{unit}', [UnitController::class, 'deleteUnit'])->name('admin.deleteUnit');







////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Tenant Sidebar
//Route for sidebar Contact => Request Maintenance
Route::get('tenant/request-maintenance', [TenantMaintenanceController::class, 'request'])->name('tenant.request-maintenance');

Route::post('/tenant/requestProcess', [TenantMaintenanceController::class, 'requestProcess'])->name('tenant.requestProcess');

//Route for sidebar Contact => View Maintenance
Route::get('tenant/view-maintenance', [TenantMaintenanceController::class, 'view'])->name('tenant.view-maintenance');

Route::get('tenant/track-maintenance/{id}', [TenantMaintenanceController::class, 'track'])->name('tenant.track-maintenance');

Route::post('tenant/feedback/{id}', [TenantMaintenanceController::class, 'feedback'])->name('tenant.feedback');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Personnel Sidebar
//Route for sidebar Contact => Request Maintenance

//Route for sidebar Contact => View Maintenance
Route::get('personnel/task-view', [PersonnelMaintenanceController::class, 'taskView'])->name('personnel.task-view');

Route::get('personnel/assess-maintenance/{id}', [PersonnelMaintenanceController::class, 'taskMaintenance'])->name('personnel.assess-maintenance');

Route::post('personnel/acceptTask/{id}', [PersonnelMaintenanceController::class, 'acceptTask'])->name('personnel.acceptTask');

Route::get('personnel/complete-maintenance/{id}', [PersonnelMaintenanceController::class, 'complete_Task'])->name('personnel.complete-maintenance');

Route::post('personnel/completeTask/{id}', [PersonnelMaintenanceController::class, 'completeTask'])->name('personnel.completeTask');
