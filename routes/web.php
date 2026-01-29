<?php

// use App\Http\Controllers\admin\AdminController;
// use App\Http\Controllers\Backend\Orm\OrmController;
// use App\Http\Controllers\Backend\Profile\ProfileController;
// use App\Http\Controllers\Backend\Category\CategoryController;

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\admin\AdminController;
// use App\Http\Controllers\Backend\Orm\OrmController;
// use App\Http\Controllers\Backend\Profile\ProfileController;
// use App\Http\Controllers\Backend\Category\CategoryController;
// use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// })->middleware('admin')->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified','admin'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

// });


// Route::prefix('admin/')->name('admin.')->group(function(){
//      Route::get('home', [AdminController::class, 'index'])->name('home');
//     Route::get('about', [AdminController::class, 'about'])->name('about');
//     Route::get('contact', [AdminController::class, 'contact'])->name('contact');

// });

// Route::get('/orm', [OrmController::class, 'index']);    
//  Route::get('/orm', [UserController::class, 'index']);  





// Route::middleware(['auth'])->name('dashboard.')->prefix('dashboard')->group(function () {
//     // ** Profile
//     Route::get('/profile-update', [ProfileController::class, 'index'])
//         ->name('profile.index');
//     Route::post('/profile-update', [ProfileController::class, 'store'])
//         ->name('profile.store');  
//     Route::post('/password-update', [ProfileController::class, 'password'])
//         ->name('password.update'); 
//     Route::post('/image-update', [ProfileController::class, 'imageUpdate'])
//         ->name('image.update');  
    
//     // ** CATEGORY
//     Route::get('/category-index', [CategoryController::class, 'index'])
//         ->name('category-index');
//     Route::post('/category-index', [CategoryController::class, 'store'])
//         ->name('category-store');
// });






// require __DIR__.'/auth.php';
  



use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Backend\Orm\OrmController;
use App\Http\Controllers\Backend\Profile\ProfileController;
use App\Http\Controllers\Backend\Category\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Product\ProductImageController;
Route::get('/', function () {
    return view('welcome');
})->middleware('admin')->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin/')->name('admin.')->group(function() {
    Route::get('home', [AdminController::class, 'index'])->name('home');
    Route::get('about', [AdminController::class, 'about'])->name('about');
    Route::get('contact', [AdminController::class, 'contact'])->name('contact');
});

// Keep only this ORM route
Route::get('/orm', [OrmController::class, 'index']);

Route::middleware(['auth'])->name('dashboard.')->prefix('dashboard')->group(function () {
    // ** Profile
    Route::get('/profile-update', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile-update', [ProfileController::class, 'store'])->name('profile.store');  
    Route::post('/password-update', [ProfileController::class, 'password'])->name('password.update'); 
    Route::post('/image-update', [ProfileController::class, 'imageUpdate'])->name('image.update');  
    
    // ** Category
    // Route::get('/category-index', [CategoryController::class, 'index'])
    // ->name('dashboard.category-index');
    Route::get('/category-index', [CategoryController::class, 'index'])
        ->name('category-index');
    Route::post('/category-index', [CategoryController::class, 'store'])
        ->name('category.store');  
        
        Route::get('/category-show', [CategoryController::class, 'show'])
        ->name('category.show');

             Route::get('/category-edit/{id}', [CategoryController::class, 'edit'])
        ->name('category.edit');

           Route::put('/category-update/{id}', [CategoryController::class, 'update'])
        ->name('category.update');

        
             Route::get('/category-delete/{id}', [CategoryController::class, 'delete'])
        ->name('category.delete');




        // PRODUCT


         Route::get('/product-index', [ProductController::class, 'product'])
        ->name('product.index');

        Route::post('/product-create', [ProductController::class, 'productCreate'])
        ->name('product.create');

         Route::get('/product-show', [ProductController::class, 'productShow'])
        ->name('product.show');

        Route::get('/product-edit/{id}', [ProductController::class, 'productEdit'])
        ->name('product.edit');

         Route::put('/product-update/{id}', [ProductController::class, 'productUpdate'])
        ->name('product.update');

        Route::get('/product-delete/{id}', [ProductController::class, 'productDelete'])
        ->name('product.delete');

         Route::get('/product-image', [ProductController::class, 'productImage'])
        ->name('product.image');

        Route::post('/product-image', [ProductController::class, 'productImagesStore'])
    ->name('product.image.store');

        Route::get('/product-imageShow', [ProductController::class, 'productImageShow'])->name('product.image.show'); 

      Route::get('/product-image-edit/{id}', [ProductController::class, 'productImageEdit'])->name('product.image.edit');

    Route::get('/product-image-delete/{id}', [ProductController::class, 'productImageDelete'])->name('product.image.delete');
    
    


          
});

require __DIR__.'/auth.php';


