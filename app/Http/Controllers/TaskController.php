<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Subject;
use App\Models\Day;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('subject', 'day')->get();
        return view('admin.task.index', compact('tasks'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $days = Day::all();
        return view('admin.task.create', compact('subjects', 'days'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'day_id' => 'required|exists:days,id',
            'deadline' => 'required|date',
            'desc' => 'nullable|string',
            'status' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        $taskData = [
            'name' => $request->name,
            'subject_id' => $request->subject_id,
            'day_id' => $request->day_id,
            'deadline' => $request->deadline,
            'desc' => $request->desc,
            'status' => $request->status,
        ];

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads/tasks', 'public');
            $taskData['file'] = $filePath;
        }

        Task::create($taskData);

        return redirect()->route('admin.task.index')->with('success', 'Task created successfully!');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $subjects = Subject::all();
        $days = Day::all();
        return view('admin.task.edit', compact('task', 'subjects', 'days'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'day_id' => 'required|exists:days,id',
            'deadline' => 'required|date',
            'desc' => 'nullable|string',
            'status' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        $task = Task::findOrFail($id);

        $taskData = [
            'name' => $request->name,
            'subject_id' => $request->subject_id,
            'day_id' => $request->day_id,
            'deadline' => $request->deadline,
            'desc' => $request->desc,
            'status' => $request->status,
        ];

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads/tasks', 'public');
            $taskData['file'] = $filePath;
        }

        $task->update($taskData);

        return redirect()->route('admin.task.index')->with('success', 'Task updated successfully!');
    }

    public function show($id)
    {
        $task = Task::with('subject', 'day')->findOrFail($id);
        return view('admin.task.view', compact('task'));
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.task.index')->with('success', 'Task deleted successfully!');
    }
}
