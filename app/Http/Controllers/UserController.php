<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    use HttpResponses;
    public function login(LoginRequest $request)
    {
        try {
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return $this->error(['error' => 'The provided credentials are incorrect'], 'Unauthorized Error', 401);
            }
            $user = User::where('email', $request->email)->first();
            return $this->success(['user' => $user, 'token' => $user->createToken("API TOKEN", ['role:customer'])->plainTextToken], 'User logged in Successfully');
        } catch (\Throwable $th) {
            return $this->error(['errors' => $th->getMessage()], "Server Error", 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => ['required', 'email', 'unique:users,email'],
                    'password' => ['required', 'min:8'],
                    'balance' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return $this->error(["errors" => $validateUser->errors()], "Validation Error", 422);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'balance' => $request->balance
            ]);
            return $this->success(['user' => $user, 'token' => $user->createToken("API TOKEN", ['role:customer'])->plainTextToken], 'User Created Successfully');
        } catch (\Throwable $th) {
            return $this->error(['errors' => $th->getMessage()], "Server Error", 500);
        }
    }

    public function logout(Request $request)
    {
        // dd(Auth()->user()->currentAccessToken()->token());
        // return Auth::user()->tokens()->where('id', $id)->delete();
        // return User::where('user_id', 2)->tokens();
        // dd(Auth()->user());
        Auth()->user()->tokens;
        return response()->json(['Success' => 'Logged out'], 200);
    }
}
