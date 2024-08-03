<?php

namespace App\Http\Controllers;

use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch only necessary columns to save memory
        $skills = SkillResource::collection(Skill::select('id', 'name', 'image')->get());
        return Inertia::render('Skills/Index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Skills/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'image'],
            'name' => ['required', 'min:3']
        ]);

        DB::transaction(function () use ($validated, $request) {
            $image = Image::make($request->file('image'))
                ->resize(100, 75, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('png', 5);  // Save as PNG to preserve transparency

            $imagePath = 'skills/' . uniqid() . '.png';
            Storage::put($imagePath, (string) $image);

            Skill::create([
                'name' => $validated['name'],
                'image' => $imagePath
            ]);
        });

        return Redirect::route('skills.index')->with('message', 'Skill created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        return Inertia::render('Skills/Edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3']
        ]);

        DB::transaction(function () use ($validated, $request, $skill) {
            $imagePath = $skill->image;

            if ($request->hasFile('image')) {
                Storage::delete($imagePath);

                $image = Image::make($request->file('image'))
                    ->resize(100, 75, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode('png', 5);  // Save as PNG to preserve transparency

                $imagePath = 'skills/' . uniqid() . '.png';
                Storage::put($imagePath, (string) $image);
            }

            $skill->update([
                'name' => $validated['name'],
                'image' => $imagePath
            ]);
        });

        return Redirect::route('skills.index')->with('message', 'Skill updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        DB::transaction(function () use ($skill) {
            Storage::delete($skill->image);
            $skill->delete();
        });

        return Redirect::back()->with('message', 'Skill deleted successfully.');
    }
}
