<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

// Route::get('/', [UserController::class, 'firstPage']);

// Route::get('/talk_list_page', function () {
//     return view('user.talk_list_page');
// })->middleware(['auth', 'verified'])->name('user.talk_list_page');

Route::get('/talk_list_page', [UserController::class, 'talk_list_page']);
Route::get('/home', [UserController::class, 'home']);
Route::get('/add_friend_page', [UserController::class, 'add_friend_page']);
Route::get('/profile_setting_page', [UserController::class, 'profile_setting_page']);
Route::post('/profile_edit', [UserController::class, 'profile_edit']);
Route::post('/profile_update', [UserController::class, 'profile_update']);
Route::post('/search_friend', [UserController::class, 'search_friend']);
Route::post('/add_friend', [UserController::class, 'add_friend']);
Route::get('/create_group_page', [UserController::class, 'create_group_page']);
Route::post('/create_group', [UserController::class, 'create_group']);
Route::post('/select_group_friend', [UserController::class, 'select_group_friend']);
Route::get('/success', [UserController::class, 'success']);
Route::get('/cancel_group_create_user/{id}', [UserController::class, 'cancel_group_create_user']);

Route::get('/talk_room/{id}', [MessageController::class, 'talk_room']);
Route::post('/post_message', [MessageController::class, 'post_message']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



