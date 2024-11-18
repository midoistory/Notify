<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\Day;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::with('subject')->get();
        return view('admin.note.index', compact('notes'));
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('admin.note.create', compact('subjects'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'date' => 'required|date',
        'subject_id' => 'required|exists:subjects,id',
        'file' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        'desc' => 'nullable|string',
    ]);

    $noteData = [
        'name' => $request->name,
        'date' => $request->date,
        'subject_id' => $request->subject_id,
        'desc' => $request->desc,
    ];

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('uploads/notes', 'public');
        $noteData['file'] = $filePath;
    }

    Note::create($noteData);

    return redirect()->route('admin.note.index')->with('success', 'Note created successfully!');
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'date' => 'required|date',
        'subject_id' => 'required|exists:subjects,id',
        'file' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        'desc' => 'nullable|string',
    ]);

    $notes = Note::findOrFail($id);

    $noteData = [
        'name' => $request->name,
        'date' => $request->date,
        'subject_id' => $request->subject_id,
        'desc' => $request->desc,
    ];

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('uploads/notes', 'public');
        $noteData['file'] = $filePath;
    }

    $notes->update($noteData);

    return redirect()->route('admin.note.index')->with('success', 'Note updated successfully!');
}

public function show($id)
{
    $notes = Note::with('subject')->findOrFail($id);  // Perbaiki Note::findOrFail
    return view('admin.note.view', compact('notes'));
}

    public function destroy($id)
    {
        $notes = note::findOrFail($id);
        $notes->delete();

        return redirect()->route('admin.note.index')->with('success', 'Note deleted successfully!');
    }
}
