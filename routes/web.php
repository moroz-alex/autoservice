<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin'], function () {
//    Route::group(['namespace' => 'Main'], function () {
//        Route::get('/', 'IndexController')->name('admin.main.index');
//    });

    Route::group(['namespace' => 'Task', 'prefix' => 'tasks'], function () {
        Route::get('/', 'IndexController')->name('admin.tasks.index');
        Route::get('/create', 'CreateController')->name('admin.tasks.create');
        Route::post('/', 'StoreController')->name('admin.tasks.store');
        Route::get('/{task}', 'ShowController')->name('admin.tasks.show');
        Route::get('/{task}/edit', 'EditController')->name('admin.tasks.edit');
        Route::patch('/{task}', 'UpdateController')->name('admin.tasks.update');
        Route::delete('/{task}', 'DestroyController')->name('admin.tasks.destroy');
    });

    Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
        Route::get('/', 'IndexController')->name('admin.categories.index');
        Route::get('/create', 'CreateController')->name('admin.categories.create');
        Route::post('/', 'StoreController')->name('admin.categories.store');
        Route::get('/{category}', 'ShowController')->name('admin.categories.show');
        Route::get('/{category}/edit', 'EditController')->name('admin.categories.edit');
        Route::patch('/{category}', 'UpdateController')->name('admin.categories.update');
        Route::delete('/{category}', 'DestroyController')->name('admin.categories.destroy');
    });

    Route::group(['namespace' => 'Master', 'prefix' => 'masters'], function () {
        Route::get('/', 'IndexController')->name('admin.masters.index');
        Route::get('/create', 'CreateController')->name('admin.masters.create');
        Route::post('/', 'StoreController')->name('admin.masters.store');
        Route::get('/{master}', 'ShowController')->name('admin.masters.show');
        Route::get('/{master}/edit', 'EditController')->name('admin.masters.edit');
        Route::patch('/{master}', 'UpdateController')->name('admin.masters.update');
        Route::delete('/{master}', 'DestroyController')->name('admin.masters.destroy');
    });

    Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
        Route::get('/', 'IndexController')->name('admin.users.index');
        Route::get('/create', 'CreateController')->name('admin.users.create');
        Route::post('/', 'StoreController')->name('admin.users.store');
        Route::get('/{user}', 'ShowController')->name('admin.users.show');
        Route::get('/{user}/edit', 'EditController')->name('admin.users.edit');
        Route::patch('/{user}', 'UpdateController')->name('admin.users.update');
        Route::delete('/{user}', 'DestroyController')->name('admin.users.destroy');

        Route::group(['namespace' => 'Car', 'prefix' => '{user}/cars'], function () {
            Route::get('/', 'IndexController')->name('admin.users.cars.index');
            Route::get('/create', 'CreateController')->name('admin.users.cars.create');
            Route::post('/', 'StoreController')->name('admin.users.cars.store');
            Route::get('/{car}', 'ShowController')->name('admin.users.cars.show');
            Route::get('/{car}/edit', 'EditController')->name('admin.users.cars.edit');
            Route::patch('/{car}', 'UpdateController')->name('admin.users.cars.update');
            Route::delete('/{car}', 'DestroyController')->name('admin.users.cars.destroy');
        });
    });

    Route::group(['namespace' => 'Brand', 'prefix' => 'brands'], function () {
        Route::get('/', 'IndexController')->name('admin.brands.index');
        Route::get('/{brand}', 'ShowController')->name('admin.brands.show');
    });

    Route::group(['namespace' => 'CarModel', 'prefix' => 'models'], function () {
        Route::post('/', 'StoreController')->name('admin.models.store');
    });

    Route::group(['namespace' => 'Settings', 'prefix' => 'settings'], function () {
        Route::get('/', 'EditController')->name('admin.settings.edit');
        Route::patch('/', 'UpdateController')->name('admin.settings.update');
    });

    Route::group(['namespace' => 'Order', 'prefix' => 'orders'], function () {
        Route::get('/', 'IndexController')->name('admin.orders.index');
        Route::get('/create', 'CreateController')->name('admin.orders.create');
        Route::post('/', 'StoreController')->name('admin.orders.store');
        Route::get('/{order}', 'ShowController')->name('admin.orders.show');
        Route::get('/{order}/edit', 'EditController')->name('admin.orders.edit');
        Route::patch('/{order}', 'UpdateController')->name('admin.orders.update');
        Route::delete('/{order}', 'DestroyController')->name('admin.orders.destroy');
        Route::get('/{order}/print', 'PrintController')->name('admin.orders.print');

        Route::group(['namespace' => 'Part', 'prefix' => '{order}/parts'], function () {
            Route::get('/edit', 'EditController')->name('admin.orders.parts.edit');
            Route::patch('/', 'UpdateController')->name('admin.orders.parts.update');
        });

        Route::group(['namespace' => 'Car', 'prefix' => '{order}/car'], function () {
            Route::get('/edit', 'EditController')->name('admin.orders.car.edit');
            Route::patch('/', 'UpdateController')->name('admin.orders.car.update');
        });

        Route::group(['namespace' => 'Task', 'prefix' => '{order}/tasks'], function () {
            Route::get('/edit', 'EditController')->name('admin.orders.tasks.edit');
            Route::patch('/', 'UpdateController')->name('admin.orders.tasks.update');
        });

        Route::group(['namespace' => 'Note', 'prefix' => '{order}/note'], function () {
            Route::patch('/', 'UpdateController')->name('admin.orders.note.update');
        });

        Route::group(['namespace' => 'State', 'prefix' => '{order}/state'], function () {
            Route::patch('/', 'UpdateController')->name('admin.orders.state.update');
        });

        Route::group(['namespace' => 'Payment', 'prefix' => '{order}/payment'], function () {
            Route::patch('/', 'UpdateController')->name('admin.orders.payment.update');
        });
    });

    Route::group(['namespace' => 'Schedule', 'prefix' => 'schedules'], function () {
        Route::get('/', 'IndexController')->name('admin.schedules.index');
        Route::get('/create/{order}', 'CreateController')->name('admin.schedules.create');
        Route::post('/', 'StoreController')->name('admin.schedules.store');
        Route::get('/edit/{order}', 'EditController')->name('admin.schedules.edit');
        Route::patch('/{order}', 'UpdateController')->name('admin.schedules.update');
    });
});

Route::group(['namespace' => 'App\Http\Controllers\User', 'prefix' => 'user'], function () {
//    Route::get('/create', 'CreateController')->name('user.create');
//    Route::post('/', 'StoreController')->name('user.store');
    Route::get('/{user}', 'ShowController')->name('user.show');
    Route::get('/{user}/edit', 'EditController')->name('user.edit');
    Route::patch('/{user}', 'UpdateController')->name('user.update');

    Route::group(['namespace' => 'Car', 'prefix' => '{user}/cars'], function () {
        Route::get('/', 'IndexController')->name('user.cars.index');
        Route::get('/create', 'CreateController')->name('user.cars.create');
        Route::post('/', 'StoreController')->name('user.cars.store');
        Route::get('/{car}', 'ShowController')->name('user.cars.show');
        Route::get('/{car}/edit', 'EditController')->name('user.cars.edit');
        Route::patch('/{car}', 'UpdateController')->name('user.cars.update');
        Route::delete('/{car}', 'DestroyController')->name('user.cars.destroy');
    });

    Route::group(['namespace' => 'Order', 'prefix' => '{user}/orders'], function () {
        Route::get('/', 'IndexController')->name('user.orders.index');
        Route::get('/create', 'CreateController')->name('user.orders.create');
        Route::post('/', 'StoreController')->name('user.orders.store');
        Route::get('/{order}', 'ShowController')->name('user.orders.show');
        Route::get('/{order}/edit', 'EditController')->name('user.orders.edit');
        Route::patch('/{order}', 'UpdateController')->name('user.orders.update');
        Route::get('/{order}/cancel', 'CancelController')->name('user.orders.cancel');
    });

    Route::group(['namespace' => 'Schedule', 'prefix' => '{user}/schedules'], function () {
        Route::get('/create/{order}', 'CreateController')->name('user.schedules.create');
        Route::post('/', 'StoreController')->name('user.schedules.store');
        Route::get('/edit/{order}', 'EditController')->name('user.schedules.edit');
        Route::patch('/{order}', 'UpdateController')->name('user.schedules.update');
    });

});

Auth::routes();

