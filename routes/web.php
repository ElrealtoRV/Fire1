<?php

use App\Http\Livewire\User\UserList;
use App\Http\Livewire\Employee\Employee;
use App\Http\Livewire\TodoList\TodoList;
use App\Http\Livewire\Type\Type;
use App\Http\Livewire\Location\Location;
use App\Http\Livewire\AddTaskModal\AddTaskModal;
use App\Http\Livewire\FireExtinguisher\FireExtinguisher;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Authentication\RoleList;
use App\Http\Livewire\Authentication\PermissionList;
use App\Http\Livewire\Position\PositionList;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('user', UserList::class);
    Route::get('role', RoleList::class);
    Route::get('permission', PermissionList::class);
    Route::view('setting', 'setting')->name('setting');
    Route::get('user-list', UserList::class)->name('users.list');
    Route::get('employee-list', Employee::class)->name('employee.list');
    Route::get('positions', PositionList::class);
    Route::get('todo', TodoList::class);
    Route::get('add-task-modal', AddTaskModal::class);
    Route::get('fire-extinguisher', FireExtinguisher::class);
    Route::get('type', Type::class);
    Route::get('location', Location::class);


    

});

require __DIR__.'/auth.php';
