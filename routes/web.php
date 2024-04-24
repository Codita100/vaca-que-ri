<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\CampaignController;
use App\Http\Controllers\Backend\AdminRoleController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\MailController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Frontend\FacebookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\ProductCatalogueController;
use App\Http\Controllers\Backend\CodesController;
use App\Http\Controllers\Backend\PointsController;
use App\Http\Controllers\Backend\ExportController;
use App\Http\Controllers\Frontend\MyAccountController;
use App\Http\Controllers\Frontend\TransactionsController;
use App\Http\Controllers\Frontend\AccumulateController;
use App\Http\Controllers\Frontend\ConsumeController;
use App\Http\Controllers\Backend\PageController;

Auth::routes();
//https://github.com/lcmaquino/googleoauth2
Route::get('/', [HomeController::class, 'index'])->name('participation.index');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.user');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/age', [AuthController::class, 'age'])->name('age');
Route::get('/age/submit', [AuthController::class, 'ageRescrition'])->name('age.submit');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/verify/{token}', [AuthController::class, 'verify']);

Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email.post');
Route::get('/reset-page/{token}', [AuthController::class, 'resetPasswordPage']);
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('update.password');

//Facebook, Google Auth
Route::get('/redirect/{driver}', [FacebookController::class, 'redirectToProvider'])->name('socialite.redirect');
Route::get('{driver}/callback', [FacebookController::class, 'handleProviderCallback'])->name('socialite.callback');
Route::get('/page/{url}', [PageController::class, 'displayPage'])->name('displayStaticPage');

Route::middleware(['auth'])->group(function () {

    Route::group([], function () {

        Route::group(['prefix' => '/my-account'], function () {
            Route::get('/', [MyAccountController::class, 'index'])->name('account.index');
            Route::get('/address', [MyAccountController::class, 'indexAddress'])->name('address.index');
            Route::post('/address', [MyAccountController::class, 'storeAddress'])->name('address.store');

        });

        Route::group(['prefix' => '/my-transactions'], function () {
            Route::get('/', [TransactionsController::class, 'index'])->name('transactions.index');
        });

        Route::group(['prefix' => '/accumulate-points'], function () {
            Route::get('/', [AccumulateController::class, 'index'])->name('accumulate.index');
            Route::post('/', [AccumulateController::class, 'store'])->name('accumulate.store');
        });

        Route::group(['prefix' => '/consume-points'], function () {
            Route::get('/', [ConsumeController::class, 'index'])->name('consume.index');
            Route::get('/{id}', [ConsumeController::class, 'store'])->name('consume.store');
        });

//        Route::get('/participation-information', [PageController::class, 'participationIndex'])->name('participation.index');


    });

    Route::group(['prefix' => '/backend', 'middleware' => ['role:super_admin|admin']], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('backend.index');

        //Users
        Route::group(['prefix' => '/users', 'middleware' => ['permission:users']], function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/get-all-users', [UserController::class, 'getAllUsers']);
            Route::get('/impersonate/{id}', [UserController::class, 'impersonate'])->name('users.impersonate');
            Route::get('/all-about/{id}', [UserController::class, 'allAbout'])->name('users.all.about');
        });

        Route::group(['prefix' => '/products', 'middleware' => ['permission:products']], function () {
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::get('/create', [ProductController::class, 'create'])->name('product.create');
            Route::post('/store', [ProductController::class, 'store'])->name('product.store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
            Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        });

        Route::group(['prefix' => '/catalogue', 'middleware' => ['permission:catalogue']], function () {
            Route::get('/', [ProductCatalogueController::class, 'index'])->name('products.catalogue.index');
            Route::get('/get-all-catalog-products', [ProductCatalogueController::class, 'getAllCatalogueProducts']);
            Route::get('/create', [ProductCatalogueController::class, 'create'])->name('product.catalogue.create');
            Route::post('/store', [ProductCatalogueController::class, 'store'])->name('product.catalogue.store');
            Route::get('/edit/{id}', [ProductCatalogueController::class, 'edit'])->name('product.catalogue.edit');
            Route::post('/update/{id}', [ProductCatalogueController::class, 'update'])->name('product.catalogue.update');
            Route::get('/delete/{id}', [ProductCatalogueController::class, 'delete'])->name('product.catalogue.delete');
        });

        Route::group(['prefix' => '/orders', 'middleware' => ['permission:orders']], function () {
            Route::get('/', [OrderController::class, 'index'])->name('order.index');
            Route::get('/get-all-orders', [OrderController::class, 'getAllOrders']);
            Route::get('/edit/{token}', [OrderController::class, 'edit'])->name('order.edit');
            Route::post('/update/{token}', [OrderController::class, 'update'])->name('order.update');
            Route::get('/delete/{id}', [OrderController::class, 'delete'])->name('order.delete');
        });

        Route::group(['prefix' => '/codes', 'middleware' => ['permission:codes']], function () {
            Route::get('/download-excel-codes', [CodesController::class, 'downloadModelCodes'])->name('download.excel.codes');
            Route::post('/import', [CodesController::class, 'import'])->name('codes.import');
            Route::get('/', [CodesController::class, 'index'])->name('codes.index');
            Route::get('/get-all-codes', [CodesController::class, 'getCodes']);
            Route::get('/delete/{id}', [CodesController::class, 'delete'])->name('codes.delete');
        });


        Route::group(['prefix' => '/points', 'middleware' => ['permission:points']], function () {
            Route::get('/', [PointsController::class, 'index'])->name('points.index');
            Route::get('/get-all-transactions', [PointsController::class, 'getAllTransactions'])->name('backend.points.get-all-transactions');
//            Route::get('/delete/{id}', [PointsController::class, 'delete'])->name('codes.delete');
        });


        Route::group(['prefix' => '/email', 'middleware' => ['permission:email']], function () {
            Route::get('/', [MailController::class, 'index'])->name('email.index');
            Route::get('/add', [MailController::class, 'create'])->name('email.create');
            Route::post('/store', [MailController::class, 'store'])->name('email.store');
            Route::get('/edit/{id}', [MailController::class, 'edit'])->name('email.edit');
            Route::post('/update/{id}', [MailController::class, 'update'])->name('email.update');
        });

        //Exporturi
        Route::group(['prefix' => '/exports', 'middleware' => ['permission:exports']], function () {
        });

        Route::group(['prefix' => '/pages', 'middleware' => ['permission:pages']], function () {
            Route::get('/', [PageController::class, 'index'])->name('pages.index');
            Route::get('/create', [PageController::class, 'create'])->name('pages.create');
            Route::get('/edit/{id}', [PageController::class, 'edit'])->name('pages.edit');
            Route::post('/store', [PageController::class, 'store'])->name('pages.store');
            Route::post('/update/{id}', [PageController::class, 'update'])->name('pages.update');
            Route::get('/delete/{id}', [PageController::class, 'destroy'])->name('pages.destroy');
        });

        Route::group(['prefix' => '/reports', 'middleware' => ['permission:export']], function () {
            Route::get('/', [ExportController::class, 'index'])->name('export');
            Route::get('/export-points', [ExportController::class, 'exportPoints'])->name('export.points');
            Route::get('/export-orders', [ExportController::class, 'exportOrders'])->name('export.orders');

        });


        // All permissions on super_admin role
        Route::get('/assign-all-permissions-to-super-admin', [PermissionController::class, 'assignAllPermissionsToSuperAdmin']);

        //Roles and Permissions
        Route::middleware(['auth', 'role:super_admin'])->name('admin.')->prefix('admin')->group(function () {
            Route::resource('/roles', RoleController::class);
            Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
            Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');

            Route::resource('/permissions', PermissionController::class);
            Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
            Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');
            Route::get('/users', [AdminRoleController::class, 'index'])->name('users.index');
            Route::get('/users/{user}', [AdminRoleController::class, 'show'])->name('users.show');
            Route::delete('/users/{user}', [AdminRoleController::class, 'destroy'])->name('users.destroy');

            Route::post('/users/{user}/roles', [AdminRoleController::class, 'assignRole'])->name('users.roles');
            Route::delete('/users/{user}/roles/{role}', [AdminRoleController::class, 'removeRole'])->name('users.roles.remove');
            Route::post('/users/{user}/permissions', [AdminRoleController::class, 'givePermission'])->name('users.permissions');

            Route::delete('/users/{user}/permissions/{permission}', [AdminRoleController::class, 'revokePermission'])->name('users.permissions.revoke');
        });
    });
});

