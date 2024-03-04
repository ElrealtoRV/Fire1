<?php

namespace App\Http\Controllers;
use App\Models\RegularList;
use App\Models\EmployeeList;
use App\Http\Livewire\TodoList;
use App\Models\User;
use App\Models\Task;
use App\Models\FireList;
use Illuminate\Http\Request;


use Carbon\Carbon;

class DashboardController extends Controller
{
    public $userId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash


    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        Task::create(['task' => $request->task]);

        return redirect('/tasks')->with('success', 'Task added successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/tasks')->with('success', 'Task deleted successfully!');
    }
    public function index()
    {

        $time = Carbon::now()->format('H');
        $operations = 0;

         
        $regularusers = RegularList::count();
        $regular = RegularList::all();
        $employeeCount = EmployeeList::count();
        $employees = EmployeeList::all();
        $tasks = Task::all();
        $fires = FireList::count();

        
   

        return view('dashboard', [
            'time' => $time,
            'operations' => $operations,
            'regularusers' => $regularusers,
            'employeeCounts' => $employeeCount,
            'employees' => $employees,
            'regular' => $regular,
            'tasks' => $tasks,
            'fires' => $fires,

        ]);
    }

    
     
}
