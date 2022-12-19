<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
class usera extends Controller
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

          if(!Auth::attempt($request->only(['email','password']))){
            return response()->json([
                'status'=>false,
                'message'=>'Email & Password does not match with our record.',
            ],401);
          }

          $user = User::where('email',$request->email)->first();

          return response()->json([
            'status'=>true,
            'message'=>'User logged in Successfully',
            'token'=>$user->createToken("API TOKEN",['role:customer'])->plainTextToken
        ],200);

    }catch(\Throwable $th){
        return response()->json([
            'status'=>false,
            'message'=>$th->getMessage()
        ],500);
    }
}
public function createuser(Request $request){
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
      
      $user = User::create([
          'name'=>$request->name,
          'email'=>$request->email,
          'password'=>Hash::make($request->password),
          'balance'=>$request->balance
      ]);

      return response()->json([
          'status'=>true,
          'message'=>'User Created Successfully',
          'token'=>$user->createToken("API TOKEN",['role:customer'])->plainTextToken
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
    Auth('sanctum')->user()->currentAccessToken() ()->delete();
    return response()->json(['Success' => 'Logged out'], 200);
}
public function logout2(Request $request) {
    if ($request->user()) { 
        $request->user()->currentAccessToken()->delete();    }
   
    return response()->json(['message' => 'Вы вышли из системы'], 200);
}
}
