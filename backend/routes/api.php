<?php
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\HasAdminPrivileges;
use App\Http\Controllers\Api\Global\FileController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Admin\RoleAdminController;
use App\Http\Controllers\Api\Admin\UserAdminController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Admin\PermissionAdminController;
use App\Http\Controllers\Api\Admin\GlobalSettingsAdminController;
use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/auth-user', function (Request $request) {
    return UserResource::make($request->user());
});

Route::middleware(['auth:api', HasAdminPrivileges::class])->group(function () {
    Route::prefix('files')->name('files.')->group(function () {
        Route::get('/list', [FileController::class, 'list'])->name('list');
        Route::post('/store', [FileController::class, 'store'])->name('store');
        Route::post('/update/{id}', [FileController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [FileController::class, 'delete'])->name('delete');
    });
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/datatable-users', [UserAdminController::class, 'datatableUsers'])->name("datatableUsers");
        Route::post('/store', [UserAdminController::class, 'store'])->name("store");
        Route::post('/update/{id}', [UserAdminController::class, 'update'])->name("update");
        Route::post('/delete/{id}', [UserAdminController::class, 'delete'])->name("delete");
        Route::get('/{id}', [UserAdminController::class, 'findById'])->name("findById");
    });
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/list', [RoleAdminController::class, 'list'])->name("list");
        Route::get('/{id}', [RoleAdminController::class, 'findById'])->name("findById");
        Route::post('/store', [RoleAdminController::class, 'store'])->name("store");
        Route::post('/update/{id}', [RoleAdminController::class, 'update'])->name("update");
        Route::post('/delete/{id}', [RoleAdminController::class, 'delete'])->name("delete");
    });
    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/list', [PermissionAdminController::class, 'list'])->name("list");
        Route::get('/{id}', [PermissionAdminController::class, 'findById'])->name("findById");
        Route::post('/store', [PermissionAdminController::class, 'store'])->name("store");
        Route::post('/update/{id}', [PermissionAdminController::class, 'update'])->name("update");
        Route::post('/delete/{id}', [PermissionAdminController::class, 'delete'])->name("delete");
    });
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::post('/update', [GlobalSettingsAdminController::class, 'update'])->name("update");
    });
});

Route::prefix('settings')->name('settings.')->group(function () {
    Route::get('/get', [GlobalSettingsAdminController::class, 'get'])->name("get");
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'store']);
Route::post('/reset-password', [ResetPasswordController::class, 'store']);

