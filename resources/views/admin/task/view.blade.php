@extends('admin.index')

@section('title-web', 'View Task')

@section('title-page', 'View Task')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">Task Details</div>
            <div class="card-body">
                <p>Task Name: {{ $task->name }}</p>
                <p>Subject: {{ $task->subject->name }}</p> <!-- Menggunakan relasi subject di model Task -->
                <p>Day: {{ $task->day->name }}</p> <!-- Menggunakan relasi day di model Task -->
                <p>Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d-m-Y') }}</p>
                <p>Description: {{ $task->desc }}</p>
                <p>Status: {{ ucfirst($task->status) }}</p>
                <a href="{{ route('admin.task.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
