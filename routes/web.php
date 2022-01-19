<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ACL\{
    PermissionController,
    PermissionRoleController,
    RoleController
};
use App\Http\Controllers\Admin\{
    DashboardController,
    DestinyController,
    GuestController,
    SettingController,
    UserController
};

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/home', [DashboardController::class, 'index'])->name('admin.index');

    Route::get('/admin/settings', [SettingController::class, 'index']);

    /**
     * Users
     */

    Route::get('/admin/users/employees', [UserController::class, 'employee'])->name('users.employee');

    Route::get('/admin/users/createEmployee', [UserController::class, 'createEmployee'])->name('users.createEmployee');

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
    Route::any('/admin/guests/search', [GuestController::class, 'search'])->name('guests.search');
    Route::get('/admin/guests/create', [GuestController::class, 'create'])->name('guests.create');
    Route::put('/admin/guests/{id}', [GuestController::class, 'update'])->name('guests.update');
    Route::get('/admin/guests/edit/{id}', [GuestController::class, 'edit'])->name('guests.edit');
    Route::delete('/admin/guests/{id}', [GuestController::class, 'destroy'])->name('guests.destroy');
    Route::get('/admin/guests/{id}', [GuestController::class, 'show'])->name('guests.show');
    Route::post('/admin/guests', [GuestController::class, 'store'])->name('guests.store');
    Route::get('/admin/guests', [GuestController::class, 'index'])->name('guests.index');
    Route::get('/admin/guests/history', [GuestController::class, 'history'])->name('guests.history');

    /**
     * Destinies
     */
    Route::any('/admin/destinies/search', [DestinyController::class, 'search'])->name('destinies.search');
    Route::get('/admin/destinies/create', [DestinyController::class, 'create'])->name('destinies.create');
    Route::put('/admin/destinies/{id}', [DestinyController::class, 'update'])->name('destinies.update');
    Route::get('/admin/destinies/edit/{id}', [DestinyController::class, 'edit'])->name('destinies.edit');
    Route::delete('/admin/destinies/{id}', [DestinyController::class, 'destroy'])->name('destinies.destroy');
    Route::get('/admin/destinies/{id}', [DestinyController::class, 'show'])->name('destinies.show');
    Route::post('/admin/destinies', [DestinyController::class, 'store'])->name('destinies.store');
    Route::get('/admin/destinies', [DestinyController::class, 'index'])->name('destinies.index');


});

Route::get('test-acl', function () {
    // dd(auth()->user()->permissions());
        // $today = date_create(date('Y-m-d'));
        // $yesterday = date_sub($today, date_interval_create_from_date_string("1 days"));

        // echo var_dump($today);
        // echo var_dump($yesterday);
});

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
