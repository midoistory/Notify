<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $subjectCount = Subject::count();

        return view('admin.dashboard', compact('subjectCount'));
    }
}
