<?php

use App\Models\FireList;
use App\Models\LocationList;
use App\Models\TypeList;
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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/fire-extinguisher', function(){
    $fires = FireList::all(); // Retrieve all users from the database
    return response()->json($fires); // Return users as JSON
});
Route::get('/fire-location', function(){
    $locations = LocationList::all(); // Retrieve all users from the database
    return response()->json($locations); // Return users as JSON
});
Route::post('/fire-location', function(){
    return LocationList::create([
            'description' => 'ITS 105s',
    ]);
});
Route::get('/fire-types', function(){
    $types = TypeList::all(); // Retrieve all users from the database
    return response()->json($types); // Return users as JSON
});

Route::get('/products', function(){
    return 'products';
});