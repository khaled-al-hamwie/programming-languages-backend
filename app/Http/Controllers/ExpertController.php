<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpertRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\ExpertResource;
use App\Models\Expert;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ExpertController extends Controller
{
    use HttpResponses;

    public function index(Request $request)
    {
        $name = $request->query("name");
        if (!is_null($name))
            return $this->success(['expert' => Expert::where('name', 'regexp', "$name")->get()], 'success');
        return $this->success(['expert' => Expert::all()], 'success');
    }

    public function store(ExpertRequest $request)
    {
        $newImageName = 'default.png';
        if (!is_null($request->pic)) {
            $newImageName = time() . '-' . str_replace([' ', '/', '\\', '"', '\'', '.'], '', $request->name) . '.' . $request->pic->extension();
            $request->pic->move(public_path('images'), $newImageName);
        }
        try {
            $expert = Expert::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'pic' => 'images/' . $newImageName,
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
                return $this->error(['errors' => 'The provided credentials are incorrect'], 'Validation Error', 422);
            }
            return $this->success(['expert' => $expert, 'token' => $expert->createToken("API TOKEN", ['role:driver'])->plainTextToken], 'User logged in Successfully');
        } catch (\Throwable $th) {
            return $this->error(['errors' => $th->getMessage()], "Server Error", 500);
        }
    }

    public function logout()
    {
        if (!is_null(Auth::user()->user_id)) {
            return $this->error(['errors' => 'you are not authorize to access this route'], "Unauthorize Error", 401);
        }
        Auth::user()->tokens()->delete();
        return $this->success(['value' => 'you have loged out successfully'], 'Log out done');
    }

    public function show(int $id)
    {
        $expert = Expert::find($id);
        if (is_null($expert))
            return $this->error(['errors' => "the id $id not found"], 'Not Found Error', 404);
        return $this->success(['expert' => ExpertResource::collection(Expert::where('expert_id', $id)->get())], 'ok');
    }

    public function update(ExpertRequest $request)
    {
        if (!is_null(Auth::user()->user_id)) {
            return $this->error(['errors' => 'you are not authorize to access this route'], "Unauthorize Error", 401);
        }
        $id = Auth::user()->expert_id;
        $expert = Expert::where('expert_id', $id)->first();
        if (!$expert->exists())
            return $this->error(['errors' => "the id $id not found"], 'Not Found Error', 404);
        try {
            $newImageName = substr($expert->pic, 7, strlen($expert->pic));
            if (!is_null($request->pic)) {
                $newImageName = time() . '-' . str_replace([' ', '/', '\\', '"', '\'', '.'], '', $expert->name) . '.' . $request->pic->extension();
                $request->pic->move(public_path('images'), $newImageName);
            }
            $expert->update([...$request->except('pic'), 'pic' => 'images/' . $newImageName]);
        } catch (\Throwable $th) {
            return $this->error(['errors' => $th->getMessage()], 'Error While Updating', 400);
        }

        return $this->success(['expert' => $expert], "the Expert with $id has been updated");
    }

    public function destroy()
    {
        if (!is_null(Auth::user()->user_id)) {
            return $this->error(['errors' => 'you are not authorize to access this route'], "Unauthorize Error", 401);
        }
        $id = Auth::user()->expert_id;

        $expert = Expert::where('expert_id', $id);
        if (!$expert->exists())
            return $this->error(['errors' => "the id $id not found"], 'Not Found Error', 404);
        $expert->delete();
        Auth::user()->tokens()->delete();
        return $this->success(['expert' => $expert->first()], 'Deleting an Expert');
    }
}
