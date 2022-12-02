<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpertRequest;
use App\Models\Expert;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return Expert::find(1)->experiences[0]->name;
        // return Expert::find(1);
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
            Expert::create($request->validated());
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
