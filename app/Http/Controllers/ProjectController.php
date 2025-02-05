<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use Auth;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function store(StoreProjectRequest $request){
        $validated = $request->validated();
        $project = Auth::user()->projects()->create($validated);
        return new ProjectResource($project);
    }

    public function update(UpdateProjectRequest $request, Project $project){
        $validated = $request->validated();
        $project->update($validated);
        return new ProjectResource($project);
    }
}
