<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\InvestmentSettingsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController as UserAuthController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\InvestmentSettingsStore;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('frontend.home', [
        'settings' => InvestmentSettingsStore::get(),
    ]);
})->name('home');

Route::get('/gallery', function () {
    return view('frontend.gallery', [
        'settings' => InvestmentSettingsStore::get(),
    ]);
})->name('gallery');

Route::get('/photo', function () {
    return redirect()->route('gallery');
})->name('photo');
Route::get('/payment-gateway', function () {
    return redirect()->route('investment.apply');
})->name('payment.gateway');
Route::get('/membership', function () {
    return view('frontend.membership', [
        'settings' => InvestmentSettingsStore::get(),
    ]);
})->name('membership');

/*
|--------------------------------------------------------------------------
| Investment Routes
|--------------------------------------------------------------------------
*/

Route::get('/investment', [InvestmentController::class, 'show'])->name('investment');
Route::get('/investment/apply', [InvestmentController::class, 'apply'])->name('investment.apply');
Route::post('/investment/checkout', [InvestmentController::class, 'checkout'])->name('investment.checkout');
Route::get('/investment/payment', [InvestmentController::class, 'payment'])->name('investment.payment');
Route::post('/investment/payment', [InvestmentController::class, 'completePayment'])->name('investment.payment.complete');
Route::get('/investment/success', [InvestmentController::class, 'success'])->name('investment.success');
Route::get('/investment/receipt.pdf', [InvestmentController::class, 'receiptPdf'])->name('investment.receipt.pdf');

/*
|--------------------------------------------------------------------------
| User Authentication
|--------------------------------------------------------------------------
*/

Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [UserAuthController::class, 'register'])->name('register.submit');

Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| User Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('auth.dashboard');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/investment', [InvestmentSettingsController::class, 'edit'])->name('admin.investment.edit');
Route::put('/admin/investment', [InvestmentSettingsController::class, 'update'])->name('admin.investment.update');
Route::delete('/admin/investment/image', [InvestmentSettingsController::class, 'destroyImage'])->name('admin.investment.image.destroy');

/*
|--------------------------------------------------------------------------
| Admin Products
|--------------------------------------------------------------------------
*/

Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
