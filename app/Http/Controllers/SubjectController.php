<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subject.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subject.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'desc'=> 'required|string',
        ]);

        Subject::create([
            'name'=> $request->name,
            'desc'=> $request->desc,
        ]);

        return redirect()->route('admin.subject.index')->with('success', 'Subject created successfully!');
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('admin.subject.edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'desc'=> 'required|string',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update([
            'name'=> $request->name,
            'desc'=> $request->desc,
        ]);

        return redirect()->route('admin.subject.index')->with('success', 'Subject edit successfully!');
    }

    public function show($id)
    {
        $subject = Subject::findOrFail($id);
        return view('admin.subject.view', compact('subject'));
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('admin.subject.index')->with('success', 'Subject deleted successfully!');
    }
}
