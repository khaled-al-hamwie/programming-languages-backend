<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpertRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Expert;
use App\Traits\HttpResponses;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ExpertController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->query("name");
        if (!is_null($name))
            return $this->success(Expert::where('name', 'regexp', "$name")->get(), 'success');
        return $this->success(Expert::all(), 'success');
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
            return $this->success(['expert' => $expert, 'token' => $expert->createToken("API TOKEN", ['role:driver'])->plainTextToken], 'Expert has been created', 201);
        } catch (\Throwable $th) {
            return $this->error(['errors' => $th->getMessage()], 'Creating account Error', 400);
        }
    }
    public function login(LoginRequest $request)
    {
        try {
            $expert = Expert::where('email', $request->email)->first();
            if (!$expert || !Hash::check($request->password, $expert->password)) {
                // throw ValidationException::withMessages([
                //     'email' => ['The provided credentials are incorrect.'],
                // ]);
                return $this->error(['error' => 'The provided credentials are incorrect'], 'Validation Error', 422);
            }
            return $this->success(['expert' => $expert, 'token' => $expert->createToken("API TOKEN", ['role:driver'])->plainTextToken], 'User logged in Successfully');
        } catch (\Throwable $th) {
            return $this->error(['errors' => $th->getMessage()], "Server Error", 500);
        }
    }
    public function logout()
    {
        Auth::user()->tokens()->delete();
        return $this->success(['value' => 'you have loged out successfully', 'Log out done']);
    }
    public function show(int $id)
    {
        $expert = Expert::find($id);
        if (is_null($expert))
            return response()->json(['messsage' => "the id $id doesn't exist"], 404);
        $expert->experiences;
        return $expert;
    }

    public function update(ExpertRequest $request)
    {
        // return "hi";
        $id = Auth::user()->expert_id;
        $expert = Expert::where('expert_id', $id);
        if (!$expert->exists())
            return $this->error(['value' => "the id $id not found"], 'Not Found Error', 404);
        try {
            $expert->update($request->validated());
        } catch (\Throwable $th) {
            return $this->error(['errors' => $th->getMessage()], 'Error While Updating', 400);
        }

        // return response()->json(['message' => 'done']);
        return $this->success(['expert' => $expert], "the Expert with $id has been updated");
    }

    public function destroy()
    {
        // return  Auth::user()->expert_id;
        $id = Auth::user()->expert_id;

        $expert = Expert::where('expert_id', $id);
        if (!$expert->exists())
            return $this->error(['value' => "the id $id not found"], 'Not Found Error', 404);
        Auth::user()->tokens()->delete();
        $expert->delete();
        return $this->success(['value' => 'done'], 'Deleting an Expert');
    }
}
