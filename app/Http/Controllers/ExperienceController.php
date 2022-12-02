<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceRequest;
use App\Models\Experience;

class ExperienceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ExperienceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExperienceRequest $request)
    {
        try {
            Experience::create($request->validated());
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()]);
        }
        return response()->json(['message' => 'sucssess'], 201);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $experience = Experience::find($id);
        if (is_null($experience))
            return response()->json(['messsage' => "the id $id doesn't exist"], 404);
        return $experience;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ExperienceRequest  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExperienceRequest $request, int $id)
    {
        $experience = Experience::find($id);
        if (is_null($experience))
            return response()->json(['messsage' => "the id $id doesn't exist"], 404);
        try {
            $experience->update($request->validated());
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()]);
        }
        return response()->json(['message' => 'sucssess']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $experience = Experience::find($id);
        if (is_null($experience))
            return response()->json(['messsage' => "the id $id doesn't exist"], 404);
        try {
            $experience->delete();
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()]);
        }
        return response()->json(['message' => 'sucssess']);
    }
}
