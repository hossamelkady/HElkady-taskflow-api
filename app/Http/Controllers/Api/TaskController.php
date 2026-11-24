<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Task::query()->latest()->paginate(15));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:160',
            'description' => 'nullable|string|max:5000',
            'status' => 'sometimes|in:open,in_progress,done',
            'due_date' => 'nullable|date'
        ]);

        $record = Task::create($data);
        return response()->json(['data' => $record], 201);
    }

    public function show(Task $task): JsonResponse
    {
        return response()->json(['data' => $task]);
    }

    public function update(Request $request, Task $task): JsonResponse
    {
        $data = $request->validate(['title' => 'sometimes|string|max:160', 'description' => 'nullable|string|max:5000', 'status' => 'sometimes|in:open,in_progress,done', 'due_date' => 'nullable|date']);
        $task->update($data);
        return response()->json(['data' => $task->refresh()]);
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json([], 204);
    }
}
