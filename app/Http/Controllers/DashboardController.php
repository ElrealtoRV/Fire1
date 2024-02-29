<?php

namespace App\Http\Controllers;
use App\Models\UserList;
use App\Models\EmployeeList;
use App\Http\Livewire\TodoList;
use App\Models\User;
use App\Models\Task;
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

         
        $users = UserList::count();
        $userlist = EmployeeList::all();
        $employeeCount = EmployeeList::count();
        $tasks = Task::all();

        
   

        return view('dashboard', [
            'time' => $time,
            'operations' => $operations,
            'users' => $users,
            'employeeCounts' => $employeeCount,
            'userlist' => $userlist,
            'tasks' => $tasks,

        ]);
    }

    
     
}
