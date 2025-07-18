<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

// الصفحة الرئيسية
Route::get('/', function () {
    return view('welcome');
});

// صفحات عامة محمية بـ auth و verified
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    })->name('dashboard');

    // بروفايل المستخدم
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes الخاصة بالـ admin فقط، باستعمال middleware role:admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('clients', ClientController::class);
    Route::resource('factures', FactureController::class);

    Route::resource('users', UserController::class);

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

// Routes الخاصة بالمستخدم العادي user فقط، باستعمال middleware role:user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    // تقدر تزيد هنا Routes أخرى خاصة بالمستخدم العادي
});

Route::get('/admin-test', function () {
    return 'أنت أدمن';
})->middleware(['auth', 'role:admin']);


require __DIR__.'/auth.php';
