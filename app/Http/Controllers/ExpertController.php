<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpertRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->query("name");
        if (!is_null($name))
            return Expert::where('name', 'regexp', "$name")->get();
        return Expert::all();
    }
    /*
    [
        {
            'day':'sat'
            'hours':[{start:9,end:14},{start:16,end:}]
        },
        {
            'day':'sun'
            'hours':{start:6,end:}
        },
        {
            'day':'fri'
            'hours':
        }
    ]

    */

    public function store(ExpertRequest $request)
    {
        try {
            // $input = $request->validate();
            // Expert::create($request->validated());
            $expert = Expert::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'pic' => $request->pic,
                'phone' => $request->phone,
                'address' => $request->address,
                'openning_time' => $request->openning_time,
                'balance' => $request->balance
            ]);
            return response()->json([
                'message' => "done",
                'token' => $expert->createToken("API TOKEN", ['role:driver'])->plainTextToken
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 400);
        }
    }
    public function login(LoginRequest $request)
    {
        try {
            $expert = Expert::where('email', $request->email)->first();
            if (!$expert || !Hash::check($request->password, $expert->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }


            return response()->json([
                'message' => 'User logged in Successfully',
                'token' => $expert->createToken("API TOKEN", ['role:driver'])->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function show(int $id)
    {
        $expert = Expert::find($id);
        if (is_null($expert))
            return response()->json(['messsage' => "the id $id doesn't exist"], 404);
        $expert->experiences;
        return $expert;
    }

    public function update(ExpertRequest $request, int $id)
    {
        $expert = Expert::where('expert_id', $id);
        if (!$expert->exists())
            return response()->json(['message' => "the id $id not found"], 404);
        try {
            $expert->update($request->validated());
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 400);
        }

        return response()->json(['message' => 'done']);
    }

    public function destroy(int $id)
    {
        $expert = Expert::where('expert_id', $id);
        if (!$expert->exists())
            return response()->json(['message' => "the id $id not found"], 404);
        $expert->delete();
    }
}
