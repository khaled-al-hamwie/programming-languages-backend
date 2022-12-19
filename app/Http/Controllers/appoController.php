<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
use Tokens;
use App\Models\User;
use App\Models\experts;
use App\Models\appo;
use App\Models\periods;

class appoController extends Controller
{
    public function booking(Request $request){
        $validateexpert = Validator::make($request->all(),
            [
                'user_id' => 'required',
                'expert_id' =>'required|email|unique:users,email',
                'date'=>'required',
                'start_time' =>'required'
            ]);
            $user = appointment::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'type'=>$request->type
            ]);
    }
    public function shwo_available_time(Request $request){
        $vailable=[];
        $available = periods::where('expert_id',$request->expert_id)->get();
        return response()->json(['available'=>$available]);
    }
    public function booking_appo(Request $request){
            $user_id = auth()->user()->user_id;
            $expert_id = $request->expert_id;
            $hour = $request->hour;
            periods::where("start",$hour)->update(["status"=> 0]);
            $appo = appo::create([
                'user_id'=>$user_id,
                'expert_id'=>$expert_id,
                'start'=>$hour
            ]);
            return response()->json(["successfully booking appointment"]);
    }
}
