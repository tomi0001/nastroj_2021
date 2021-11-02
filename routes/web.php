<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/h', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/loginDr', [App\Http\Controllers\HomeController::class, 'loginDr'])->name('doctorlogin');
Route::get('/register', [App\Http\Controllers\HomeController::class, 'register'])->name('register');
Route::post('/registerSubmit', [App\Http\Controllers\RegisterController::class, 'registerSubmit'])->name('registerSubmits');
Route::get('/loginUser', [App\Http\Controllers\HomeController::class, 'loginUser'])->name('userlogin');
Auth::routes();



Route::get('/users.addMood', [App\Http\Controllers\Mood\MoodController::class, 'addTestMood'])->name('users.addMood')
                    ->middleware('auth')->middleware('can:users');


//Route::middleware(['webe'],function(){
            Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('main');
            
            
         //   Route::get('/users/{year?}/{month?}/{day?}/{action?}', [App\Http\Controllers\Main\MainController::class, 'index'])->name('users.main')
         //           ->where("year","[0-9]")->middleware('auth')->middleware('can:users');
            Route::get('/users/{year?}/{month?}/{day?}/{action?}', [App\Http\Controllers\Main\MainController::class, 'index'])->name('users.main')
                    ->where("year","[0-9]?[0-9]?[0-9]?[0-9]$")
                    ->where("month","^(1[0-2]|[1-9])$")->where("day","^(3[01]|[12][0-9]|[1-9])$")->middleware('auth')->middleware('can:users');
            
            Route::get('/users.drugsAdd', [App\Http\Controllers\Product\ProductController::class, 'add'])->name('users.drugsAdd')
                    ->middleware('auth')->middleware('can:users');
            
            Route::get('/users.moodAdd',  [App\Http\Controllers\Mood\MoodController::class, 'add'])->name('users.moodAdd')
                    ->middleware('auth')->middleware('can:users');
            Route::get('/users.sleepAdd', [App\Http\Controllers\Sleep\SleepController::class, 'add'])->name('users.sleepAdd')
                    ->middleware('auth')->middleware('can:users');
            //Route::get('/users/mo2odAdd', [App\Http\Controllers\Mood\MoodController::class, 'add'])->name('users.moodAdd')->middleware('auth')->middleware('can:users');
            
            
            Route::get('/users.actionDayAdd', [App\Http\Controllers\Action\ActionController::class, 'add'])->name('users.actionDaypAdd')
                    ->middleware('auth')->middleware('can:users');
                    
                    
            
            
            Route::get('/users4/{year?}/{month?}/{day?}/{action?}', [App\Http\Controllers\Search\SearchController::class, 'index2'])->name('users.search')
                    ->middleware('auth')->middleware('can:users');
            
            Route::get('/users2/{year?}/{month?}/{day?}/{action?}', [App\Http\Controllers\User\UserController::class, 'index4'])->name('users.setting')
                    ->middleware('auth')->middleware('can:users');
            
            
            Route::get('/doctor', [App\Http\Controllers\HomeController::class, 'index2'])->name('doctor.main')->middleware('auth')->middleware('can:doctor');
            Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout')->middleware('auth');
            //Route::get('/', [App\Http\Controllers\HomeController::class, 'index2'])->name('home')->middleware('web');
  //      });

/*
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
})
 * ;
 */
