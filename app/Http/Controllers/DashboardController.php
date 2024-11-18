<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Subject;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $subjectCount = Subject::count();
        $taskCount = Task::count();
        $noteCount = Note::count();

        return view('admin.dashboard', compact('subjectCount', 'taskCount', 'noteCount'));
    }
}
