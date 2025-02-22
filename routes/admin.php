<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CompanyDetailController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\StoryController;

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'admin/', 'middleware' => ['auth', 'is_admin']], function(){
  
    Route::get('/dashboard', [HomeController::class, 'adminHome'])->name('admin.dashboard');
    //profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('profile/{id}', [AdminController::class, 'adminProfileUpdate']);
    Route::post('changepassword', [AdminController::class, 'changeAdminPassword']);
    Route::put('image/{id}', [AdminController::class, 'adminImageUpload']);
    //profile end

    Route::get('/new-admin', [AdminController::class, 'getAdmin'])->name('alladmin');
    Route::post('/new-admin', [AdminController::class, 'adminStore']);
    Route::get('/new-admin/{id}/edit', [AdminController::class, 'adminEdit']);
    Route::post('/new-admin-update', [AdminController::class, 'adminUpdate']);
    Route::get('/new-admin/{id}', [AdminController::class, 'adminDelete']);
    
    Route::get('/agent', [AgentController::class, 'index'])->name('admin.agent');
    Route::post('/agent', [AgentController::class, 'store']);
    Route::get('/agent/{id}/edit', [AgentController::class, 'edit']);
    Route::post('/agent-update', [AgentController::class, 'update']);
    Route::get('/agent/{id}', [AgentController::class, 'delete']);

    Route::get('/country', [CountryController::class, 'index'])->name('admin.country');
    Route::post('/country', [CountryController::class, 'store']);
    Route::get('/country/{id}/edit', [CountryController::class, 'edit']);
    Route::post('/country-update', [CountryController::class, 'update']);
    Route::get('/country/{id}', [CountryController::class, 'delete']);

    // company information
    Route::get('/profile', [CompanyDetailController::class, 'index'])->name('admin.companyDetail');
    Route::post('/profile-detail', [CompanyDetailController::class, 'update'])->name('admin.companyDetails');

    
    // Category crud
    Route::get('/category', [CategoryController::class, 'getCategory'])->name('allcategory');
    Route::post('/category', [CategoryController::class, 'categoryStore']);
    Route::get('/category/{id}/edit', [CategoryController::class, 'categoryEdit']);
    Route::post('/category-update', [CategoryController::class, 'categoryUpdate']);
    Route::get('/category/{id}', [CategoryController::class, 'categoryDelete']);
    Route::post('/category-status', [CategoryController::class, 'toggleStatus']);
    Route::post('/update-serial', [CategoryController::class, 'updateSerial'])->name('update.serial');
    

    // Product crud
    Route::get('/product', [BookController::class, 'getProduct'])->name('allproduct');
    Route::get('/upload-product', [BookController::class, 'uploadProduct'])->name('upload.product');
    Route::post('/product', [BookController::class, 'productStore']);
    Route::get('/product/{id}/edit', [BookController::class, 'productEdit']);
    Route::post('/product-update', [BookController::class, 'productUpdate']);
    Route::get('/product/{id}', [BookController::class, 'productDelete']);
    Route::get('/export-template', [BookController::class, 'exportTemplate'])->name('export.template');
    Route::get('/products/{product}/reviews', [BookController::class, 'productReviews'])->name('product.reviews.show');
    
    Route::get('/product-details/{id}', [BookController::class, 'showProductDetails'])->name('product.show.admin');

    
    Route::post('/toggle-featured', [BookController::class, 'toggleFeatured'])->name('toggleFeatured');
    Route::post('/toggle-recent', [BookController::class, 'toggleRecent'])->name('toggle-recent');
    Route::post('/toggle-popular', [BookController::class, 'togglePopular'])->name('togglePopular');
    Route::post('/toggle-trending', [BookController::class, 'toggleTrending'])->name('toggleTrending');
    Route::post('/toggle-status', [BookController::class, 'toggleStatus'])->name('toggleStatus');
    Route::get('/check-product-code', [BookController::class, 'checkProductCode'])->name('check.product.code');

    // stories
    Route::get('/stories', [StoryController::class, 'getStory'])->name('allstories');
    Route::get('/upload-stories', [StoryController::class, 'uploadStory'])->name('upload.stories');
    Route::post('/stories', [StoryController::class, 'storyStore']);
    Route::get('/stories/{id}/edit', [StoryController::class, 'storyEdit']);
    Route::post('/stories-update', [StoryController::class, 'storyUpdate']);
    Route::get('/stories/{id}', [StoryController::class, 'storyDelete']);


    
});
  