<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function store(Request $request)
    {
        try {
            $input = $request->validate([
                'name' => ['required', 'string', 'min:5', 'max:45'],
                'pic' => ['file', 'image', 'dimensions:min_width=100,min_height=100'],
                'phone' => ['required', 'string', 'min:7', 'max:45', 'unique:experts'],
                'address' => ['required', 'string', 'min:5', 'max:45'],
                'openning_time' => ['required', 'string', 'max:245'],
            ]);
            Expert::create($input);
        } catch (\Illuminate\Validation\ValidationException $th) {
            return response()->json([
                'message' => $th->errors()
            ], 422);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => "done"
        ], 201);
    }


    public function show(int $id)
    {
        $expert = Expert::find($id);
        if (is_null($expert))
            return response()->json(['messsage' => "the id $id doesn't exist"], 404);
        return $expert;
    }

    public function update(Request $request, int $id)
    {
        $expert = Expert::where('expert_id', $id);
        if (!$expert->exists())
            return response()->json(['message' => "the id $id not found"], 404);
        try {
            $input = $request->validate([
                'name' => ['required', 'string', 'min:5', 'max:45'],
                'pic' => ['file', 'image', 'dimensions:min_width=100,min_height=100'],
                'phone' => ['required', 'string', 'min:7', 'max:45', Rule::unique('experts', 'phone')->ignore($expert->first()->expert_id, 'expert_id')],
                'address' => ['required', 'string', 'min:5', 'max:45'],
                'openning_time' => ['required', 'string', 'max:245'],
            ]);
            $expert->update($input);
        } catch (\Illuminate\Validation\ValidationException $th) {
            return response()->json([
                'message' => $th->errors()
            ], 422);
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
