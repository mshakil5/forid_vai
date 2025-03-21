<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
  
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

// cache clear
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
 });
//  cache clear
  
// Route::get('/', function () {
//     return view('welcome');
// });
  
Auth::routes();
Route::get('/', [FrontendController::class, 'index'])->name('homepage');
Route::get('/about-us', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');

Route::get('/stories', [FrontendController::class, 'stories'])->name('stories');
Route::get('/poetries', [FrontendController::class, 'poetries'])->name('poetries');
Route::get('/essay', [FrontendController::class, 'essay'])->name('essay');
Route::get('/research', [FrontendController::class, 'research'])->name('research');
Route::get('/book', [FrontendController::class, 'book'])->name('book');
Route::get('/book-details', [FrontendController::class, 'book'])->name('book.show');

Route::post('/contact', [FrontendController::class, 'contactMessageStore'])->name('contact.store');


Route::get('/essay/{slug}', [FrontendController::class, 'showessay'])->name('essay.show');
Route::get('/story/{slug}', [FrontendController::class, 'showStory'])->name('story.show');
Route::get('/research/{slug}', [FrontendController::class, 'showResearch'])->name('research.show');
Route::get('/poetries/{slug}', [FrontendController::class, 'showPoetries'])->name('poetries.show');
  
/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'user/', 'middleware' => ['auth', 'is_user']], function(){
  
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
  

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'manager/', 'middleware' => ['auth', 'is_manager']], function(){
  
    Route::get('/dashboard', [HomeController::class, 'managerHome'])->name('manager.dashboard');
});
 