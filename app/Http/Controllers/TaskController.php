<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Company;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TaskRequest $request)
    {
        $request->validated();
        try {
            if (User::findOrFail($request->user_id) && Company::findOrFail($request->company_id)) {
                if (Task::where('user_id', $request->user_id)->count() >= 5) return response(['message' => 'This user has many pending tasks.']);
                $task = Task::create($request->all());
                return new TaskResource($task);
            }
        } catch (\Throwable $th) {
            return response(['message' => 'Failed on create task.'], Response::HTTP_NOT_FOUND);
        }
    }
}
