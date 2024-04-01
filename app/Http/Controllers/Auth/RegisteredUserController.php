<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RegularList;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        
        $request->validate([
            'first_name'    => 'required',
            'middle_name'   => 'nullable',
            'last_name'     => 'required',
            'age'           => 'required',
            'bdate'         => 'required',
            'contnum'       => 'required|digits:11',
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:' . RegularList::class],
            'idnum'         => 'required|digits:9',
            'affiliation'   => 'required',
            'dept'          => 'nullable',
            'office'        => 'nullable',
            'password'      => ['required', 'confirmed', 'min:6', Rules\Password::defaults()],
        ]);
    
        $regularuser = RegularList::create([
            'first_name'    => $request->first_name,
            'middle_name'   => $request->middle_name,
            'last_name'     => $request->last_name,
            'age'           => $request->age,
            'bdate'         => $request->bdate,
            'contnum'       => $request->contnum,
            'email'         => $request->email,
            'idnum'         => $request->idnum,
            'affiliation'   => $request->affiliation,
            'office'        => $request->office,
            'dept'          => $request->dept,
            'password'      => Hash::make($request->password),
            
        ]);
    
        $token = $regularuser->createToken('myapptoken')->plainTextToken;
    
        // Return a response with user data and token
        return response()->json([
            'regularuser' => $regularuser,
            'token'       => $token
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        
        // Attempt to authenticate the user
        if (Auth::guard('regularuser')->attempt($request->only('email', 'password'))) {
            // Authentication successful
            $user  = Auth::guard('regularuser')->user();
            $token = $user->createToken('myapptoken')->plainTextToken;

            return response()->json([
                'user'  => $user,
                'token' => $token
            ]);
        }

        // Authentication failed
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        // Get the authenticated user instance
        $user = auth()->user();

        // Check if the user instance is an instance of RegularList
        if ($user instanceof RegularList) {
            // Revoke all tokens associated with the authenticated user
            $user->tokens()->delete();
        }

        // Perform any additional logout logic you might have

        return response()->json([
            'message' => 'Logged out successfully.'
        ]);
    }
}
