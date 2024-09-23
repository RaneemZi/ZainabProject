<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $user = User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'age' => (int) $request->age,
        ]);

        $token = $user->createToken("API TOKEN")->plainTextToken;

        $success = [
            'id' => $user->id,
            'user_name' => $user->user_name,
            'age' => (int) $user->age,
            'email' => $user->email,
            'token' => $token,
        ];

        return $this->sendResponse($success, 'User sing up successfully');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['user_name' => $request->user_name, 'password' => $request->password])) {
            $user = Auth::user();

            $token = $user->createToken("API TOKEN")->plainTextToken;

            $success = [
                'id' => $user->id,
                'user_name' => $user->user_name,
                'token' => $token,
            ];
            return $this->sendResponse($success, 'User logged in successfully');
        } else {
            return $this->sendError('Please check user_name or password', ['error' => 'Unauthorized']);
        }
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->sendResponse(null, 'User logged out successfully');
    }
}
