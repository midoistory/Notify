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
        'subject_id' => 'required',
        'day_id' => 'required',
        'deadline' => 'required|date',
        'desc' => 'nullable|string',
        'file' => 'nullable|mimes:jpg,jpeg,png,gif,pdf|max:2048',
    ]);

    $filePath = null;
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('public/uploads/tasks', $fileName);
    }

    Task::create([
        'name' => $request->name,
        'subject_id' => $request->subject_id,
        'day_id' => $request->day_id,
        'deadline' => $request->deadline,
        'desc' => $request->desc,
        'file' => $fileName ?? null,
        'status' => 'pending',
    ]);

    return redirect()->route('admin.task.index')->with('success', 'Task created successfully.');
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
        'subject_id' => 'required',
        'day_id' => 'required',
        'deadline' => 'required|date',
        'desc' => 'nullable|string',
        'file' => 'nullable|mimes:jpg,jpeg,png,gif,pdf|max:2048',
    ]);

    $task = Task::findOrFail($id);

    // Cek apakah ada file baru
    if ($request->hasFile('file')) {
        // Hapus file lama jika ada
        if ($task->file && \Storage::exists('public/uploads/tasks/' . $task->file)) {
            \Storage::delete('public/uploads/tasks/' . $task->file);
        }

        // Simpan file baru
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/uploads/tasks', $fileName);
        $task->file = $fileName;
    }

    // Update data task
    $task->update([
        'name' => $request->name,
        'subject_id' => $request->subject_id,
        'day_id' => $request->day_id,
        'deadline' => $request->deadline,
        'desc' => $request->desc,
        'status' => $request->status ?? $task->status,
    ]);

    return redirect()->route('admin.task.index')->with('success', 'Task updated successfully.');
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
