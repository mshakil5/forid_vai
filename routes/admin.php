<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CompanyDetailController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\PoetryController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\EssayController;
use App\Http\Controllers\Admin\ResearchController;

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
    

    // book crud
    Route::get('/book', [BookController::class, 'getProduct'])->name('allproduct');
    Route::post('/book', [BookController::class, 'productStore']);
    Route::get('/book/{id}/edit', [BookController::class, 'productEdit']);
    Route::post('/book-update', [BookController::class, 'productUpdate']);
    Route::get('/book/{id}', [BookController::class, 'productDelete']);
    

    
    // Route::post('/toggle-featured', [BookController::class, 'toggleFeatured'])->name('toggleFeatured');
    // Route::post('/toggle-recent', [BookController::class, 'toggleRecent'])->name('toggle-recent');
    // Route::post('/toggle-popular', [BookController::class, 'togglePopular'])->name('togglePopular');
    // Route::post('/toggle-trending', [BookController::class, 'toggleTrending'])->name('toggleTrending');
    Route::post('/book-toggle-status', [BookController::class, 'toggleStatus'])->name('booktoggleStatus');

    // stories
    Route::get('/stories', [StoryController::class, 'getStory'])->name('allstories');
    Route::post('/stories', [StoryController::class, 'storyStore']);
    Route::get('/stories/{id}/edit', [StoryController::class, 'storyEdit']);
    Route::post('/stories-update', [StoryController::class, 'storyUpdate']);
    Route::get('/stories/{id}', [StoryController::class, 'storyDelete']);
    Route::post('/stories-toggle-status', [StoryController::class, 'toggleStatus'])->name('storiestoggleStatus');

    
    // poetries
    Route::get('/poetries', [PoetryController::class, 'getPoetry'])->name('allpoetries');
    Route::post('/poetries', [PoetryController::class, 'poetriesStore']);
    Route::get('/poetries/{id}/edit', [PoetryController::class, 'poetriesEdit']);
    Route::post('/poetries-update', [PoetryController::class, 'poetriesUpdate']);
    Route::get('/poetries/{id}', [PoetryController::class, 'poetriesDelete']);
    Route::post('/poetries-toggle-status', [PoetryController::class, 'toggleStatus'])->name('poetriestoggleStatus');


    // essay
    Route::get('/essay', [EssayController::class, 'getEssay'])->name('allessay');
    Route::post('/essay', [EssayController::class, 'essayStore']);
    Route::get('/essay/{id}/edit', [EssayController::class, 'essayEdit']);
    Route::post('/essay-update', [EssayController::class, 'essayUpdate']);
    Route::get('/essay/{id}', [EssayController::class, 'essayDelete']);
    Route::post('/essay-toggle-status', [EssayController::class, 'toggleStatus'])->name('essaytoggleStatus');



    // research
    Route::get('/research', [ResearchController::class, 'getResearch'])->name('allresearch');
    Route::post('/research', [ResearchController::class, 'researchStore']);
    Route::get('/research/{id}/edit', [ResearchController::class, 'researchEdit']);
    Route::post('/research-update', [ResearchController::class, 'researchUpdate']);
    Route::get('/research/{id}', [ResearchController::class, 'researchDelete']);
    Route::post('/research-toggle-status', [ResearchController::class, 'toggleStatus'])->name('researchtoggleStatus');

    
});
  