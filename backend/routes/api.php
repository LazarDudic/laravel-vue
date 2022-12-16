<?php
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Global\FileController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Admin\NewsAdminController;
use App\Http\Controllers\Api\Admin\PageAdminController;
use App\Http\Controllers\Api\Admin\RoleAdminController;
use App\Http\Controllers\Api\Admin\UserAdminController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Admin\CategoryAdminController;
use App\Http\Controllers\Api\Admin\LanguageAdminController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Admin\AppSettingsAdminController;
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

Route::middleware(['auth:api', IsAdmin::class])->group(function () {
    Route::prefix('files')->name('files.')->group(function () {
        Route::get('/list', [FileController::class, 'list'])->name('list');
        Route::get('/{id}', [FileController::class, 'findById'])->name('findById');
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

    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/datatable-pages/{langId?}', [PageAdminController::class, 'datatablePage'])->name("datatablePage");
        Route::get('/list', [PageAdminController::class, 'list'])->name("list");
        Route::get('/{id}', [PageAdminController::class, 'findById'])->name("findById");
        Route::post('/store', [PageAdminController::class, 'store'])->name("store");
        Route::post('/update/{id}', [PageAdminController::class, 'update'])->name("update");
        Route::post('/delete/{id}', [PageAdminController::class, 'delete'])->name("delete");
        Route::get('/{groupId}/{langId}', [PageAdminController::class, 'findByGroupIdAndLanguageId'])->name("findByGroupIdAndLanguageId");
    });

    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/list', [RoleAdminController::class, 'list'])->name("list");
        Route::get('/{id}', [RoleAdminController::class, 'findById'])->name("findById");
        Route::post('/store', [RoleAdminController::class, 'store'])->name("store");
        Route::post('/update/{id}', [RoleAdminController::class, 'update'])->name("update");
        Route::post('/delete/{id}', [RoleAdminController::class, 'delete'])->name("delete");
    });

    Route::prefix('global-settings')->name('global-settings.')->group(function () {
        Route::get('/list', [GlobalSettingsAdminController::class, 'list'])->name("list");
        Route::post('/update/{id}', [GlobalSettingsAdminController::class, 'update'])->name("update");
    });

    Route::prefix('app-settings')->name('app-settings.')->group(function () {
        Route::get('/get', [AppSettingsAdminController::class, 'get'])->name("get");
        Route::post('/update', [AppSettingsAdminController::class, 'update'])->name("update");
    });

    Route::prefix('languages')->name('languages.')->group(function () {
        Route::get('/list', [LanguageAdminController::class, 'list'])->name("list");
        Route::get('/{id}', [LanguageAdminController::class, 'findById'])->name("findById");
        Route::post('/store', [LanguageAdminController::class, 'store'])->name("store");
        Route::post('/update/{id}', [LanguageAdminController::class, 'update'])->name("update");
        Route::post('/delete/{id}', [LanguageAdminController::class, 'delete'])->name("delete");
    });
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/list/{langId?}', [CategoryAdminController::class, 'list'])->name("list");
        Route::get('/lang/{langId}/type/{type}/id/{id?}', [CategoryAdminController::class, 'allByLanguageIdAndType'])->name("allByLanguageIdAndType");
        Route::get('/type/{type}/lang/{langId?}', [CategoryAdminController::class, 'getByType'])->name("getByType");
        Route::get('/{id}', [CategoryAdminController::class, 'findById'])->name("findById");
        Route::get('/getChildren/{id}', [CategoryAdminController::class, 'getChildren'])->name("getChildren");
        Route::get('/{groupId}/{langId}', [CategoryAdminController::class, 'findByGroupIdAndLanguageId'])->name("findByGroupIdAndLanguageId");
        Route::post('/store', [CategoryAdminController::class, 'store'])->name("store");
        Route::post('/update/{id}', [CategoryAdminController::class, 'update'])->name("update");
        Route::post('/delete/{id}', [CategoryAdminController::class, 'delete'])->name("delete");
    });
    Route::prefix('news')->name('news.')->group(function () {
        Route::get('/datatable-news/{langId?}', [NewsAdminController::class, 'datatableNews'])->name("datatableNews");
        Route::get('/list', [NewsAdminController::class, 'list'])->name("list");
        Route::get('/{id}', [NewsAdminController::class, 'findById'])->name("findById");
        Route::post('/store', [NewsAdminController::class, 'store'])->name("store");
        Route::post('/update/{id}', [NewsAdminController::class, 'update'])->name("update");
        Route::post('/delete/{id}', [NewsAdminController::class, 'delete'])->name("delete");
        Route::get('/{groupId}/{langId}', [NewsAdminController::class, 'findByGroupIdAndLanguageId'])->name("findByGroupIdAndLanguageId");
    });
});

Route::prefix('global-settings')->name('settings.')->group(function () {
    Route::get('/{id}', [GlobalSettingsAdminController::class, 'findById'])->name("findById");
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'store']);
Route::post('/reset-password', [ResetPasswordController::class, 'store']);

