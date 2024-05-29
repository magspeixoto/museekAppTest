<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController;
use Illuminate\Support\Facades\Cache;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    $cacheKey = 'categories.all';
    $cacheDuration = 60; // Cache for 60 minutes

    $categories = Cache::remember($cacheKey, $cacheDuration, function () {
        return Category::all();
    });

    return Inertia::render('Index/Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')        
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

//EMAIL VERIFICATION
Route::get('/email/verify', function () {
    return Inertia::render('Auth/VerifyEmail');
})->middleware(['auth', 'throttle:6,1'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {  
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Registration Route
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
    $enableViews = config('fortify.views', true);

    // Password Reset...
    if (Features::enabled(Features::resetPasswords())) {
        if ($enableViews) {
            Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware(['guest:' . config('fortify.guard')])
                ->name('password.request');

            Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware(['guest:' . config('fortify.guard')])
                ->name('password.reset');
        }

        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
            ->middleware(['guest:' . config('fortify.guard')])
            ->name('password.email');

        Route::post('/reset-password', [NewPasswordController::class, 'store'])
            ->middleware(['guest:' . config('fortify.guard')])
            ->name('password.update');
    }
});

Route::get('/manage', [ManageController::class, 'index'])->middleware('auth');

Route::get('/', [IndexController::class, 'index']);
Route::get('/products/{product}', [IndexController::class, 'show']);

Route::get('/category/{category}/products', [ProductController::class, 'index2'])->name('category.products');

// PAGE ROUTES 

Route::group(['middleware' => 'check.permission:manage brands', 'auth'], function () {
    //CRUD BRANDS
    Route::get('/manage/brand', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/manage/brand/create', [BrandController::class, 'create'])->name('brand.create');
    Route::get('/manage/brand/edit/{brand}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::get('/manage/brand/{brand}', [BrandController::class, 'show'])->name('brand.show'); 
});

Route::group(['middleware' => 'check.permission:manage categories', 'auth'], function () {    
    //CRUD CATEGORIES
    Route::get('/manage/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/manage/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/manage/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::get('/manage/category/{category}', [CategoryController::class, 'show'])->name('category.show');
});

Route::group(['middleware' => 'check.permission:manage products', 'auth'], function () {      
    //CRUD PRODUCTS
    Route::get('/manage/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/manage/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/manage/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('/manage/product/{product}', [ProductController::class, 'show'])->name('product.show');
});

Route::group(['middleware' => 'check.permission:manage users', 'auth'], function () {
    //CRUD USERS
    Route::get('/manage/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/manage/user/create', [UserController::class, 'create'])->name('user.create');    
    Route::get('/manage/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/manage/user/{user}', [UserController::class, 'show'])->name('user.show');

});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/my-account', [UserProfileController::class, 'show'])->name('profile.show');
});

//API ROUTES

Route::group(['middleware' => 'check.permission:manage brands', 'auth'], function () {
    //CRUD BRANDS
    Route::post('/brand', [BrandController::class, 'store'])->middleware('auth');   
    Route::put('/brand/update/{brand}', [BrandController::class, 'update'])->name('brand.update');
    Route::delete('/brand/delete/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');    
});

Route::group(['middleware' => 'check.permission:manage categories', 'auth'], function () {    
    //CRUD CATEGORIES
    Route::post('/category', [CategoryController::class, 'store'])->middleware('auth');    
    Route::put('/category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');    
});

Route::group(['middleware' => 'check.permission:manage products', 'auth'], function () {       
    // CRUD PRODUCTS
    Route::post('/product', [ProductController::class, 'store'])->middleware('auth');    
    Route::put('/product/update/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');    
    Route::post('/product/upload-image/{product}', [ProductController::class, 'uploadImage'])->name('product.uploadImage');
});

Route::post('/upload', [ImageController::class, 'upload'])->name('upload');

Route::group(['middleware' => 'check.permission:manage users', 'auth'], function () {
    //CRUD USERS
    Route::put('/user/update/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});