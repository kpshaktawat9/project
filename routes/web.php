<?php

use App\Http\Controllers\customControler;
use App\Http\Controllers\LikeController;
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

/* Route::get('/', function () {
   return view('welcome');
});  */

Route::get('dashboard', [customControler::class, 'dashboard'])->name('dashboard'); 
Route::get('/', [customControler::class, 'dashboard']); 
Route::get('login', [customControler::class, 'index'])->name('login');
Route::post('custom-login', [customControler::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [customControler::class, 'registration'])->name('register-user');
Route::post('custom-registration', [customControler::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [customControler::class, 'signOut'])->name('signout');

Route::group(['prefix' => 'post' ],function(){
Route::get('/posts', [customControler::class, 'show_post'])->name('posts');
Route::get('/create', [customControler::class, 'create_post'])->name('create.post');
Route::post('/save', [customControler::class, 'save_post'])->name('save-post');
Route::post('/update', [customControler::class, 'update_post'])->name('update-post');
Route::get('/view/{id}', [customControler::class, 'view_post']);
Route::get('/edit/{id}', [customControler::class, 'edit_post']);
Route::get('/delete/{id}', [customControler::class, 'delete_post']);
Route::post('/like', [customControler::class, 'like_post'])->name('like');
Route::get('/like', [LikeController::class, 'show'])->name('top.posts');
Route::post('/toplike', [LikeController::class, 'top'])->name('liked');
});