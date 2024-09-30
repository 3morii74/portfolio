<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = ProjectResource::collection(Project::with('skills:id,name')->paginate(20));

        return Inertia::render('Projects/Index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skills = Skill::select('id', 'name')->get();
        return Inertia::render('Projects/Create', [
            'skills' => $skills
        ]);
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
            'name' => ['required', 'min:3'],
            'skill_id' => ['required', 'array'],
            'skill_id.*' => ['exists:skills,id'],
        ]);

        DB::transaction(function () use ($validated, $request) {
            $image = Image::make($request->file('image'))
                ->resize(300, 200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('jpg');

            $imagePath = 'skills/' . uniqid() . '.jpg';
            Storage::put($imagePath, (string) $image);

            $project = Project::create([
                'name' => $validated['name'],
                'image' => $imagePath,
                'project_url' => $request->project_url
            ]);

            $project->skills()->attach($validated['skill_id']);
        });

        return Redirect::route('projects.index')->with('message', 'Project created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $skills = Skill::select('id', 'name')->get();
        return Inertia::render('Projects/Edit', [
            'project' => $project,
            'skills' => $skills
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'skill_id' => ['required', 'array'],
            'skill_id.*' => ['exists:skills,id'],
        ]);

        DB::transaction(function () use ($validated, $request, $project) {
            $imagePath = $project->image;

            if ($request->hasFile('image')) {
                Storage::delete($imagePath);

                $image = Image::make($request->file('image'))
                    ->resize(300, 200, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode('jpg');

                $imagePath = 'skills/' . uniqid() . '.jpg';
                Storage::put($imagePath, (string) $image);
            }

            $project->update([
                'name' => $validated['name'],
                'project_url' => $request->project_url,
                'image' => $imagePath
            ]);

            $project->skills()->sync($validated['skill_id']);
        });

        return Redirect::route('projects.index')->with('message', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        DB::transaction(function () use ($project) {
            Storage::delete($project->image);
            $project->delete();
        });

        return Redirect::back()->with('message', 'Project deleted successfully.');
    }
}
