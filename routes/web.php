<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, AdminController, ShopController};

Route::get('/',[ShopController::class,'index'])->name('home');
Route::get('/login',[AuthController::class,'loginForm'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.submit');
Route::get('/register',[AuthController::class,'registerForm'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('register.submit');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::get('/admin/login',[AdminController::class,'loginForm'])->name('admin.login');
Route::post('/admin/login',[AdminController::class,'login'])->middleware('throttle:5,1')->name('admin.login.submit');
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',[AdminController::class,'dashboard'])->name('dashboard');
    Route::post('/logout',[AdminController::class,'logout'])->name('logout');
    Route::resource('products',\App\Http\Controllers\AdminProductController::class)->except('show');
    Route::get('/orders',[\App\Http\Controllers\AdminOrderController::class,'index'])->name('orders.index');
    Route::get('/orders/{order}',[\App\Http\Controllers\AdminOrderController::class,'show'])->name('orders.show');
    Route::patch('/orders/{order}',[\App\Http\Controllers\AdminOrderController::class,'update'])->name('orders.update');
    Route::get('/reports',[\App\Http\Controllers\AdminReportController::class,'index'])->name('reports.index');
});

Route::post('/cart/add/{product}',[ShopController::class,'add'])->name('cart.add');
Route::get('/cart',[ShopController::class,'cart'])->name('cart');
Route::post('/cart/remove/{product}',[ShopController::class,'remove'])->name('cart.remove');
Route::get('/checkout',[ShopController::class,'checkout'])->name('checkout');
Route::post('/checkout',[ShopController::class,'place'])->name('checkout.place');
Route::get('/order/selesai',[ShopController::class,'done'])->name('order.done');
