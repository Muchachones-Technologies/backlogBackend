<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) : JsonResponse
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->string('password')),
            ]);
            event(new Registered($user));
            Auth::login($user);
            
            $token = $user->createToken('api-token');
            $data = [
                'message' => 'User registered successfully',
                'user' => $user,
                'token' => $token->plainTextToken,
                'status' => 'success'
            ];
            return response()->json($data, 201);
        } catch (Exception $e) {
            $data = [
                'message' => $e->getMessage(),
                'status' => 'failed'
            ];
            return response()->json($data, 500);
        }
    }
}
//5|KKP9zMqridGOXEHfZuIfEkpUPrSYErWw8fDHIatBcad031ab
