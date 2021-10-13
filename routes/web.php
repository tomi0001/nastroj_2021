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

Auth::routes();
Route::get('/loginDr', [App\Http\Controllers\HomeController::class, 'loginDr'])->name('doctorlogin');
Route::get('/register', [App\Http\Controllers\HomeController::class, 'register'])->name('register');
Route::post('/registerSubmit', [App\Http\Controllers\HomeController::class, 'registerSubmit'])->name('registerSubmit');
Route::get('/loginUser', [App\Http\Controllers\HomeController::class, 'loginUser'])->name('userlogin');

//Route::middleware(['webe'],function(){
            Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('main');
            Route::get('/users/{year?}/{month?}/{day?}/{action?}', [App\Http\Controllers\Main\Main::class, 'index'])->name('users.main')->middleware('auth')->middleware('can:users');

            Route::get('/doctor', [App\Http\Controllers\HomeController::class, 'index2'])->name('doctor.main')->middleware('auth')->middleware('can:doctor');
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
