<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::get('/register', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('positions')->name('positions.')->group(function () {
        Route::get('/', App\Livewire\Positions\Index::class)->name('index');
        Route::get('create', App\Livewire\Positions\EditAdd::class)->name('create');
        Route::get('edit/{id}', App\Livewire\Positions\EditAdd::class)->name('edit');
    });

    Route::prefix('diseases')->name('diseases.')->group(function () {
        Route::get('/', App\Livewire\Diseases\Index::class)->name('index');
        Route::get('create', App\Livewire\Diseases\EditAdd::class)->name('create');
        Route::get('edit/{id}', App\Livewire\Diseases\EditAdd::class)->name('edit');
    });

    Route::prefix('farms')->name('farms.')->group(function () {
        Route::get('/', App\Livewire\Farms\Index::class)->name('index');
        Route::get('create', App\Livewire\Farms\EditAdd::class)->name('create');
        Route::get('edit/{id}', App\Livewire\Farms\EditAdd::class)->name('edit');
    });

    Route::prefix('varieties')->name('varieties.')->group(function () {
        Route::get('/', App\Livewire\Varieties\Index::class)->name('index');
        Route::get('create', App\Livewire\Varieties\EditAdd::class)->name('create');
        Route::get('edit/{id}', App\Livewire\Varieties\EditAdd::class)->name('edit');
    });

    Route::prefix('lots')->name('lots.')->group(function () {
        Route::get('/', App\Livewire\Lots\Index::class)->name('index');
        Route::get('create', App\Livewire\Lots\EditAdd::class)->name('create');
        Route::get('edit/{id}', App\Livewire\Lots\EditAdd::class)->name('edit');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', App\Livewire\Users\Index::class)->name('index');
        Route::get('create', App\Livewire\Users\EditAdd::class)->name('create');
        Route::get('edit/{id}', App\Livewire\Users\EditAdd::class)->name('edit');
    });

    Route::prefix('registers')->name('registers.')->group(function () {
        Route::get('/', App\Livewire\Registers\Index::class)->name('index');
        Route::get('create', App\Livewire\Registers\EditAdd::class)->name('create');
        Route::get('edit/{id}', App\Livewire\Registers\EditAdd::class)->name('edit');
    });

    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', App\Livewire\Roles\Index::class)->name('index');
        Route::get('create', App\Livewire\Roles\EditAdd::class)->name('create');
        Route::get('edit/{id}', App\Livewire\Roles\EditAdd::class)->name('edit');
    });
});

//RUN chown -R sail:sail /var/www/html/storage && chmod -R 775 /var/www/html/storage
