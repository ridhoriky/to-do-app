<?php

use App\Models\User;
use App\Mail\TestMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\TasksController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
    return view('welcome');
});

Route::get('/tasks', [TasksController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/tasks/create', [TasksController::class, 'create'])->middleware(['auth', 'verified']);
Route::post('/tasks', [TasksController::class, 'store'])->middleware(['auth', 'verified']);
Route::get('/tasks/{task}', [TasksController::class, 'show'])->middleware(['auth', 'verified']);
Route::get('/tasks/{task}/edit', [TasksController::class, 'edit'])->middleware(['auth', 'verified']);
Route::put('/tasks/{task}', [TasksController::class, 'update'])->middleware(['auth', 'verified']);
Route::delete('/tasks/{task}', [TasksController::class, 'destroy'])->middleware(['auth', 'verified']);

Route::get('/register',[AuthController::class, 'registerForm'])->middleware('guest');
Route::post('/register',[AuthController::class, 'register']);
Route::get('/login',[AuthController::class, 'loginForm'])->name ('login')-> middleware('guest');
Route::post('/login',[AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout']);

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified']);

Route::get('/test_mail', function () {
    $name = 'Test';
    $age = 10;

    Mail::to('test@test.com')->send(new TestMail ($name, $age));
    return 'email sent';
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
