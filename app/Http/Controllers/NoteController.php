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

    $filePath = null;
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('public/uploads/notes', $fileName);
        $filePath = str_replace('public/', 'storage/', $filePath); // Mengubah path agar sesuai dengan URL akses
    }

    Note::create([
        'name' => $request->name,
        'date' => $request->date,
        'subject_id' => $request->subject_id,
        'desc' => $request->desc,
        'file' => $filePath,
    ]);

    return redirect()->route('admin.note.index')->with('success', 'Note created successfully!');
}

public function edit($id)
{
    $notes = Note::findOrFail($id);
    $subjects = Subject::all();
    return view('admin.note.edit', compact('notes', 'subjects'));
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

    $note = Note::findOrFail($id);

    // Handle file upload jika ada file baru
    if ($request->hasFile('file')) {
        // Hapus file lama jika ada
        if ($note->file && \Storage::exists('public/uploads/notes/' . $note->file)) {
            \Storage::delete('public/uploads/notes/' . $note->file);
        }

        // Upload file baru
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('public/uploads/notes', $fileName);
        $note->file = str_replace('public/', 'storage/', $filePath);
    }

    // Update data note
    $note->update([
        'name' => $request->name,
        'date' => $request->date,
        'subject_id' => $request->subject_id,
        'desc' => $request->desc,
    ]);

    $note->save();

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
