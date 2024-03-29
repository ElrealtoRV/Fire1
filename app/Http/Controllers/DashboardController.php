<?php

namespace App\Http\Controllers;
use App\Models\RegularList;
use App\Models\EmployeeList;
use App\Http\Livewire\TodoList;
use App\Models\User;
use App\Models\Task;
use App\Models\Position;
use App\Models\FireList;
use Illuminate\Http\Request;


use Carbon\Carbon;

class DashboardController extends Controller
{
    public $userId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash




    public function index()
    {

        $time = Carbon::now()->format('H');
        $operations = 0;

         
        $regularusers = RegularList::count();
        $regular = RegularList::all();
        $userCounts = User::count();
        $users = User::all();
        $tasks = Task::all();
        $fires = FireList::count();
        $affiliations = User::all();
        $positions = Position::all();

        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
   
        $userCounts = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->count();
        

        return view('dashboard', [
            'time' => $time,
            'operations' => $operations,
            'regularusers' => $regularusers,
            'userCounts' => $userCounts,
            'users' => $users,
            'positions' => $positions,
            'regular' => $regular,
            'tasks' => $tasks,
            'fires' => $fires,
            'affiliations' => $affiliations,

        ]);
    }

    
     
}
