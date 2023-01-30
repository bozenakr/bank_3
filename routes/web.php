<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController as C;

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

Route::prefix('admin/customers')->name('customers-')->group(function () {
    Route::get('/', [C::class, 'index'])->name('index');

    Route::get('/create', [C::class, 'create'])->name('create');
    Route::post('/create', [C::class, 'store'])->name('store');

    Route::get('/edit/{customer}', [C::class, 'edit'])->name('edit');
    Route::put('/edit/{customer}', [C::class, 'update'])->name('update');

    Route::get('/deposit/{customer}', [C::class, 'showDeposit'])->name('show-deposit');
    Route::put('/deposit/{customer}', [C::class, 'deposit'])->name('deposit');

    Route::get('/withdraw/{customer}', [C::class, 'showWithdraw'])->name('show-withdraw');
    Route::put('/withdraw/{customer}', [C::class, 'withdraw'])->name('withdraw');

    Route::delete('/delete/{customer}', [C::class, 'destroy'])->name('delete');
    // Route::get('/login', [C::class, 'showLogin'])->name('show-login');
});

//disable register kai yra seeder su false
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');