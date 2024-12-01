@extends('admin.index')

@section('title-web', 'View Task')

@section('title-page', 'View Task')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">Task Details</div>
            <div class="card-body">
                <p><strong>Task Name:</strong> {{ $task->name }}</p>
                <p><strong>Subject</strong> {{ $task->subject->name }}</p>
                <p><strong>Day</strong> {{ $task->day->name }}</p>
                <p><strong>Deadline</strong> {{ \Carbon\Carbon::parse($task->deadline)->format('d-m-Y') }}</p>
                <p><strong>Description</strong> {{ $task->desc }}</p>
                <p><strong>Status</strong> {{ ucfirst($task->status) }}</p>
                <p><strong>File:</strong>
                    @if ($task->file)
                        <a href="{{ Storage::url($task->file) }}" target="_blank">View File</a>
                    @else
                        No file uploaded.
                    @endif
                </p>
                </p>
                <br><br>
                <a href="{{ route('admin.task.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
