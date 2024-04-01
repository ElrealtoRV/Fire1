<?php

use App\Http\Livewire\User\UserList;
use App\Http\Livewire\ActivityLog\ActivityLog;
use App\Http\Livewire\RegularUser\RegularUserList;
use App\Http\Livewire\Employee\Employee;
use App\Http\Livewire\Type\Type;
use App\Http\Livewire\Setting\Setting;
use App\Http\Livewire\Location\Location;
use App\Http\Livewire\Inspection\Inspection;
use App\Http\Livewire\Request\RequestList;
use App\Http\Livewire\AddRequest\AddRequest;
use App\Http\Livewire\AddTaskModal\AddTaskModal;
use App\Http\Livewire\FireExtinguisher\FireExtinguisher;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Authentication\RoleList;
use App\Http\Livewire\Authentication\PermissionList;
use App\Http\Livewire\Position\PositionList;
use App\Http\Livewire\Affiliation\AffiliationList;
use App\Http\Livewire\Office\OfficeList;
use App\Http\Livewire\Record\RecordList;
use App\Http\Livewire\Map\BuildingList;
use App\Http\Livewire\Map\Cas\CasFloor;
use App\Http\Livewire\Map\Cas\GroundFloor;
use App\Http\Livewire\Department\DepartmentList;
use App\Http\Livewire\Task\TaskManager;


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
    Route::get('user', UserList::class);
    Route::get('role', RoleList::class);
    Route::get('permission', PermissionList::class);
    Route::view('setting', 'setting')->name('setting');
    Route::get('activity-log', ActivityLog::class);
});
Route::group(['middleware' => ['role:admin|Head']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('regular-user-list', RegularUserList::class);
    Route::get('positions', PositionList::class);
    Route::get('affiliation',AffiliationList::class);
    Route::get('office',OfficeList::class);
    Route::get('department',DepartmentList::class);
    Route::get('type', Type::class);
    Route::get('location', Location::class);
    Route::get('inspection', Inspection::class);
    Route::get('fire-extinguisher', FireExtinguisher::class);
    // Route::get('fire-form', Cas::class);
    Route::get('setting', setting::class);
    Route::get('record', RecordList::class);
    Route::get('map', BuildingList::class);
    Route::get('/cas-floor', CasFloor::class)->name('cas.floor');
    Route::get('/ground-floor', GroundFloor::class)->name('ground.floor');





});

Route::group(['middleware' => ['role:Head']], function () {
    Route::get('request', RequestList::class);
    Route::get('add-request', AddRequest::class);
    Route::get('/tasks', TaskManager::class)->name('tasks.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
require __DIR__.'/auth.php';
