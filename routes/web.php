<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\PasswordCreationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Mail\ContactedMessage;
use App\Models\Category;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController;

Route::get('/', function () {
    return Inertia::render('Index/Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('/index');
    })->name('dashboard');
});

Route::post('/contact', [ContactController::class, 'submit']);

/* Route::get('/test', function(){
    return new ContactedMessage('test@test.com', 'Margarida Teste');
}); */

//EMAIL VERIFICATION

Route::get('/email/verify', function () {
    return Inertia::render('Auth/VerifyEmail');
})->middleware(['auth', 'throttle:6,1'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/myaccount');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/admin/password/reset', [AdminController::class, 'showResetForm'])
    ->name('admin.password.reset');
Route::post('/admin/password/reset', [AdminController::class, 'sendResetLink'])
    ->name('admin.password.email');

Route::get('/password/create/{user}', [PasswordCreationController::class, 'create'])
    ->name('password.create')
    ->middleware('signed');

Route::post('/password/update/{user}', [PasswordCreationController::class, 'update'])
    ->name('password.update');
    
Route::get('/admin/password/reset', [AdminController::class, 'showResetForm'])
->name('admin.password.reset');
Route::post('/admin/password/reset', [AdminController::class, 'sendResetLink'])
->name('admin.password.email');

Route::post('/password/update/{user}', [PasswordCreationController::class, 'update'])
    ->name('password.update');

Route::get('/myaccount', [MyAccountController::class, 'index'])->middleware('auth');

Route::get('/index', [IndexController::class, 'index']);
Route::get('/products/{product}', [IndexController::class, 'show']);

Route::get('/category/{category}/products', [ProductController::class, 'index2'])->name('category.products');

Route::get('/categories', function () {
    $categories = Category::all(); 

    return response()->json($categories);
});

//CRUD BRANDS
Route::get('/brand/index', [BrandController::class, 'index'])->name('brand.index')->middleware('auth');
Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create')->middleware('auth');
Route::post('/brand', [BrandController::class, 'store'])->middleware('auth');
Route::get('/brand/edit/{brand}', [BrandController::class, 'edit'])->name('brand.edit')->middleware('auth');
Route::put('/brand/update/{brand}', [BrandController::class, 'update'])->name('brand.update')->middleware('auth');
Route::delete('/brand/delete/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy')->middleware('auth');
Route::get('/brand/{brand}', [BrandController::class, 'show'])->name('brand.show')->middleware('auth');

//CRUD CATEGORIES
Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index')->middleware('auth');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create')->middleware('auth');
Route::post('/category', [CategoryController::class, 'store'])->middleware('auth');
Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit')->middleware('auth');
Route::put('/category/update/{category}', [CategoryController::class, 'update'])->name('category.update')->middleware('auth');
Route::delete('/category/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware('auth');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show')->middleware('auth');

//CRUD PRODUCTS
Route::get('/product/index', [ProductController::class, 'index'])->name('product.index')->middleware('auth');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create')->middleware('auth');
Route::post('/product', [ProductController::class, 'store'])->middleware('auth');
Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit')->middleware('auth');
Route::put('/product/update/{product}', [ProductController::class, 'update'])->name('product.update')->middleware('auth');
Route::delete('/product/delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy')->middleware('auth');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show')->middleware('auth');


Route::post('/upload', [ImageController::class, 'upload'])->name('upload');

//CRUD USERS
Route::get('/user/index', [UserController::class, 'index'])->name('user.index')->middleware('auth');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware('auth');
Route::post('/user', [UserController::class, 'store'])->middleware('auth');
Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');
Route::put('/user/update/{user}', [UserController::class, 'update'])->name('user.update')->middleware('auth');
Route::delete('/user/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('auth');
Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show')->middleware('auth');