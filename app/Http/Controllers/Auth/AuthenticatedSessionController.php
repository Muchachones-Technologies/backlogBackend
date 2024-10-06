<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request) : JsonResponse
    {
        try{
            $request->authenticate();

            $user = $request->user();
            $user->tokens()->delete();
            $token = $user->createToken('api-token');
            $response = [
                'message'=> 'User logged in successfully',
                'status' => 'success',
                'user' => $user,
                'token' => $token->plainTextToken,
            ];
            return response()->json($response, 201);
        }catch(Exception $e){
            $response = [
                'message'=> $e->getMessage(),
                'status' => 'failed'
            ];
            return response()->json($response, 500);
        }
       
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
