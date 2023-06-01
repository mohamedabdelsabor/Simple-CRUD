<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Middleware;
use  App\Http\Controllers\PostController;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


//use controller here
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->Middleware('auth');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->Middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->Middleware('auth');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->Middleware('auth');



Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->Middleware('auth');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->Middleware('auth');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->Middleware('auth');
Route::get('/hello', function () {
});
Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();

    $user = User::where('github_id', $githubUser->id)->first();

    if ($user) {
        $user->update([
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    } else {
        $user = User::create([
            'name' => $githubUser->getNickName(),
            'email' => $githubUser->email,
            'github_id' => $githubUser->id,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    }

    Auth::login($user);

    return redirect('/');
});