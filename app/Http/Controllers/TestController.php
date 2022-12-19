<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\experts;
use App\Models\profile;

class TestController extends Controller
{
    public function test1()
    {
        return response()->json(["hello i am user"]);
    }
    public function test2()
    {
        return response()->json(["hello i am expert"]);
    }

    public function pay(Request $request,int $price){
       Auth()->user()->balance-=$price;
       Auth()->expert()->balance+=$price;
    }
}
