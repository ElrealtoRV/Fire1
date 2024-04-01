<?php

use App\Models\FireList;
use App\Models\LocationList;
use App\Models\TypeList;
use App\Models\User;
use App\Http\Livewire\User\UserForm;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginUserController;
use App\Models\RegularList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/user', function(){
    $users = User::all(); 
    return response()->json($users);
});

Route::get('/regularregister', function(){
    $regularuser = RegularList::all(); // Retrieve all fire extinguishers from the database
    return response()->json($regularuser); // Return fire extinguishers as JSON
});
Route::post('/regularregister', [RegisteredUserController::class, 'store'])->name('api.regularregister');



// Define routes for regular user
Route::middleware('auth:regularuser')->group(function () {
    // Retrieve information about the authenticated regular user
    Route::get('/regularuser', function (Request $request) {
        return $request->user();
    });

    // Retrieve all fire extinguishers
    Route::get('/fire-extinguisher', function () {
        $fires = FireList::all(); // Retrieve all fire extinguishers from the database
        return response()->json($fires); // Return fire extinguishers as JSON
    });

    // Create a new fire extinguisher
    Route::post('/fire-extinguisher', function (Request $request) {
        // Validate the request data
        $request->validate([
            'type'              => 'required',
            'firename'          => 'required',
            'serial_number'     => 'required|digits:7',
            'location'          => 'required',
            'installation_date' => 'required|date_format:Y-m-d',
            'expiration_date'   => 'required|date_format:Y-m-d',
            'description'       => 'nullable',
            'status'            => 'nullable',
        ]);

        // Create a new fire extinguisher using Eloquent model
        $fire = FireList::create([
            'type'              => $request->input('type'),
            'firename'          => $request->input('firename'),
            'serial_number'     => $request->input('serial_number'),
            'location'          => $request->input('location'),
            'installation_date' => $request->input('installation_date'),
            'expiration_date'   => $request->input('expiration_date'),
            'description'       => $request->input('description'),
            'status'            => $request->input('status'),
        ]);

        // Return the created fire extinguisher as JSON
        return response()->json($fire);
    });

    // Retrieve all fire locations
    Route::get('/fire-location', function(){
        $locations = LocationList::all(); // Retrieve all fire locations from the database
        return response()->json($locations); // Return fire locations as JSON
    });
    
    // Create a new fire location
    Route::post('/fire-location', function(Request $request){
        // Validate the request data
        $request->validate([
            'description' => 'required|string',
        ]);
    
        // Create a new location using Eloquent model
        $location = LocationList::create([
            'description' => $request->input('description'),
        ]);
    
        // Return the created location as JSON
        return response()->json($location);
    });
    
    // Retrieve all fire types
    Route::get('/fire-types', function(){
        $types = TypeList::all(); // Retrieve all fire types from the database
        return response()->json($types); // Return fire types as JSON
    });

    // Create a new fire type
    Route::post('/fire-types', function(Request $request){
        // Validate the request data
        $request->validate([
            'description' => 'required|string',
        ]);
    
        // Create a new type using Eloquent model
        $type = TypeList::create([
            'description' => $request->input('description'),
        ]);
    
        // Return the created type as JSON
        return response()->json($type);
    });

    Route::post('/logout', [RegisteredUserController::class, 'logout']);
});