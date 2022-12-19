<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\experts;
class experta extends Controller
{
    public function login(Request $request)
{
    try{
        $validateUser = Validator::make($request->all(),
          [
            'email'=>'required|email',
            'password'=>'required'
          ]);

          if($validateUser->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'validation error',
                'error'=>$validateUser->error()
            ],401);
          }
          $expert = experts::where('email',$request->email)->first();

          if (!$expert || !Hash::check($request->password, $expert->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }


          return response()->json([
            'status'=>true,
            'message'=>'User logged in Successfully',
            'token'=>$expert->createToken("API TOKEN",['role:driver'])->plainTextToken
        ],200);

    }catch(\Throwable $th){
        return response()->json([
            'status'=>false,
            'message'=>$th->getMessage()
        ],500);}
}

public function create(Request $request){
  try{
      $validateUser = Validator::make($request->all(),
      [
          'name' => 'required',
          'email' =>'required|email|unique:users,email',
          'password'=>'required',
          'balance'=>'required'
      ]);

      if($validateUser->fails()){
          return response()->json([
              'status'=>false,
              'message'=>'validation erroe',
              'errors'=>$validateUser->errors()
          ],401);
      }
      
      $user = experts::create([
          'name'=>$request->name,
          'email'=>$request->email,
          'password'=>Hash::make($request->password),
          'balance'=>$request->balance
      ]);

      return response()->json([
          'status'=>true,
          'message'=>'User Created Successfully',
          'token'=>$user->createToken("API TOKEN",['role:driver'])->plainTextToken
      ],200);
  }catch(\Throwable $th){
      return response()->json([
          'status'=>false,
          'message'=>$th->getMessage()
      ],500);
  }
  
}

public function logout()
{
    Auth()->user()->tokens()->delete();
    return response()->json(['Success' => 'Logged out'], 200);
}

}
