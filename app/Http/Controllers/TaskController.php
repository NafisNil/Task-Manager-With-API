<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Spatie\QueryBuilder\QueryBuilder;
use Auth;
class TaskController extends Controller
{
    //
    public function index(Request $request){
        $task = QueryBuilder::for(Task::class)
        ->allowedFilters('is_done')
        ->defaultSort('title')
        ->allowedSorts(['title', 'created_at', 'id'])
        ->paginate();
        return new TaskCollection($task);
    }

    public function show(Request $request, Task $task){
        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $request){
        $validated = $request->validated();
        $task = Auth::user()->tasks()->create($validated);
        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task){
        $validated = $request->validated();
        $task->update($validated);
        return new TaskResource($task);
    }

    public function destroy(Request $request, Task $task){
        $task->delete();
        return response()->noContent();
    }
}
