<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
class AuthController extends Controller
{
    public function createuser(Request $request){
        try{
            $validateUser = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' =>'required|email|unique:users,email',
                'password'=>'required',
                'type' =>'required'
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
                'type'=>$request->type
            ]);

            return response()->json([
                'status'=>true,
                'message'=>'User Created Successfully',
                'token'=>$user->createToken("API TOKEN")->plainTextToken
            ],200);

        }catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage()
            ],500);
        }
        
    }

    public function loginuser(Request $request){
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
                'token'=>$user->createToken("API TOKEN")->plainTextToken
            ],200);

        }catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage()
            ],500);
        }

    }

    public function logoutuser()
    {
        Auth()->user()->tokens()->delete();
        
        return response()->json(['Success' => 'Logged out'], 200);
    }

   // test //

  /*
  
    public function registertest(Request $request, User $user)
   {
       return $user->saveUser($request)->generateAndSaveApiAuthToken();
   }
    public function logintest(Request $request)
   {
       $credentials = [
           'email' => $request->email,
           'password' => $request->password,
       ];

       if (Auth::guard('api')->attempt($credentials)) {
           $user = Auth::guard('api')
                       ->user()
                       ->generateAndSaveApiAuthToken();

           return $user;
       }

       return response()->json(['message' => 'Error.....'], 401);
   }*/

}
