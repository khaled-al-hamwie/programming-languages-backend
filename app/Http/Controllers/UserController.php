<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use HttpResponses;
    public function login(LoginRequest $request)
    {
        try {
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return $this->error(['errors' => 'The provided credentials are incorrect'], 'Validation Error', 422);
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
            return $this->success(['user' => $user, 'token' => $user->createToken("API TOKEN", ['role:customer'])->plainTextToken], 'User Created Successfully', 201);
        } catch (\Throwable $th) {
            return $this->error(['errors' => $th->getMessage()], "Server Error", 500);
        }
    }

    public function logout()
    {
        if (!is_null(Auth::user()->user_id)) {
            Auth::user()->tokens()->delete();
            return $this->success(['value' => 'you have loged out successfully'], 'Log out done');
        } else {
            return $this->error(['error' => 'you are not authorize'], 'Authorization error', 401);
        }
    }
}
