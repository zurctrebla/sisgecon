<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ACL\{
    PermissionController,
    PermissionRoleController,
    RoleController
};
use App\Http\Controllers\Admin\{
    DashboardController,
    SectorController,
    GuestController,
    SettingController,
    UserController,
    PointController
};

Route::middleware(['auth'])->group(function () {

    /**
     * Dasboard
     */
    Route::get('/admin/home', [DashboardController::class, 'index'])->name('admin.index');
    Route::get('/admin/settings', [SettingController::class, 'index']);

    /**
     * Users
     */
    Route::get('/admin/users/employees', [UserController::class, 'employee'])->name('users.employee');
    Route::get('/admin/users/createEmployee', [UserController::class, 'createEmployee'])->name('users.createEmployee');

    Route::put('/admin/users/updateEmployee/{id}', [UserController::class, 'updateEmployee'])->name('users.updateEmployee'); /** */

    Route::get('/admin/users/editEmployee/{id}', [UserController::class, 'editEmployee'])->name('users.editEmployee');
    Route::post('/admin/users/storeEmployee', [UserController::class, 'storeEmployee'])->name('users.storeEmployee');
    Route::get('/admin/users/register/{id}', [UserController::class, 'register'])->name('users.register');
    Route::get('/admin/users/historySheet/{id}', [UserController::class, 'history'])->name('users.history');

    // Route::any('/admin/users/profile', [UserController::class, 'profile'])->name('users.profile');

    Route::any('/admin/users/search', [UserController::class, 'search'])->name('users.search');
    Route::any('/admin/users/profile', [UserController::class, 'profile'])->name('users.profile');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('users.create');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/admin/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');

    /**
     * Permissions
     */
    Route::any('/admin/permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
    Route::get('/admin/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::put('/admin/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::get('/admin/permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::delete('/admin/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::get('/admin/permissions/{id}', [PermissionController::class, 'show'])->name('permissions.show');
    Route::post('/admin/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/admin/permissions', [PermissionController::class, 'index'])->name('permissions.index');

    /**
     * Roles
     */
    Route::any('/admin/roles/search', [RoleController::class, 'search'])->name('roles.search');
    Route::get('/admin/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::put('/admin/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/admin/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::delete('/admin/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/admin/roles/{id}', [RoleController::class, 'show'])->name('roles.show');
    Route::post('/admin/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/admin/roles', [RoleController::class, 'index'])->name('roles.index');

    /**
     * Permission x Role
     */
    Route::get('/admin/roles/{id}/permission/{idPermission}/detach', [PermissionRoleController::class, 'detachPermissionRole'])->name('roles.permission.detach');   /**ok */
    Route::post('/admin/roles/{id}/permissions', [PermissionRoleController::class, 'attachPermissionsRole'])->name('roles.permissions.attach');                      /**ok */
    Route::any('/admin/roles/{id}/permissions/create', [PermissionRoleController::class, 'permissionsAvailable'])->name('roles.permissions.available');             /**ok */

    // Route::put('/admin/roles/{id}/permissions/{id}', [PermissionRoleController::class, 'update'])->name('permissions.update');
    // Route::get('/admin/roles/{id}/permissions/edit/{id}', [PermissionRoleController::class, 'edit'])->name('permissions.edit');
    // Route::delete('/admin/roles/{id}/permissions/{id}', [PermissionRoleController::class, 'destroy'])->name('permissions.destroy');
    // Route::get('/admin/roles/{id}/permissions/{id}', [PermissionRoleController::class, 'show'])->name('permissions.show');
    Route::get('/admin/roles/{id}/permissions', [PermissionRoleController::class, 'permissions'])->name('roles.permissions');
    // Route::get('/admin/roles/{id}/permissions', [PermissionRoleController::class, 'index'])->name('permissions.index');

    /**
     * Guests
     */
    Route::get('/admin/guests/pdf/{id}', [GuestController::class, 'pdf'])->name('guests.pdf');


    Route::get('/admin/guests/test/{id}', [GuestController::class, 'test'])->name('guests.test');

    // Route::put('/admin/points/test/{id}', [PointController::class, 'test'])->name('points.test');



    Route::get('/admin/guests/register/{id}', [GuestController::class, 'register'])->name('guests.register');
    Route::get('/admin/guests/historySheet/{id}', [GuestController::class, 'history'])->name('guests.history');

    Route::any('/admin/guests/search', [GuestController::class, 'search'])->name('guests.search');
    Route::get('/admin/guests/create', [GuestController::class, 'create'])->name('guests.create');
    Route::put('/admin/guests/{id}', [GuestController::class, 'update'])->name('guests.update');
    Route::get('/admin/guests/edit/{id}', [GuestController::class, 'edit'])->name('guests.edit');
    Route::delete('/admin/guests/{id}', [GuestController::class, 'destroy'])->name('guests.destroy');
    Route::get('/admin/guests/{id}', [GuestController::class, 'show'])->name('guests.show');
    Route::post('/admin/guests', [GuestController::class, 'store'])->name('guests.store');
    Route::get('/admin/guests', [GuestController::class, 'index'])->name('guests.index');

    /**
     * Points
     */
    Route::put('/admin/points/{id}', [PointController::class, 'update'])->name('points.update');

    /**
     * Sectors
     */
    Route::any('/admin/sectors/search', [SectorController::class, 'search'])->name('sectors.search');
    Route::get('/admin/sectors/create', [SectorController::class, 'create'])->name('sectors.create');
    Route::put('/admin/sectors/{id}', [SectorController::class, 'update'])->name('sectors.update');
    Route::get('/admin/sectors/edit/{id}', [SectorController::class, 'edit'])->name('sectors.edit');
    Route::delete('/admin/sectors/{id}', [SectorController::class, 'destroy'])->name('sectors.destroy');
    Route::get('/admin/sectors/{id}', [SectorController::class, 'show'])->name('sectors.show');
    Route::post('/admin/sectors', [SectorController::class, 'store'])->name('sectors.store');
    Route::get('/admin/sectors', [SectorController::class, 'index'])->name('sectors.index');


});

// Route::get('test-acl', function () {
//     // dd(auth()->user()->permissions());
//         $today = date_create(date('Y-m-d'));
//         $yesterday = date_sub($today, date_interval_create_from_date_string("1 days"));

//         echo var_dump($today);
//         echo var_dump($yesterday);
// });

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
