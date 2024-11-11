@extends('admin.index')

@section('title-web', 'Edit Task')

@section('title-page', 'Edit Task')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">Edit Task</div>
            <div class="card-body">
                <form action="{{ route('task.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Task Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $task->name }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Subject</label>
                        <select name="subject_id" class="form-control" id="subject" required>
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ $task->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="day_id" class="form-label">Day</label>
                        <select name="day_id" class="form-control" id="day" required>
                            <option value="">Select Day</option>
                            @foreach($days as $day)
                                <option value="{{ $day->id }}" {{ $task->day_id == $day->id ? 'selected' : '' }}>{{ $day->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="date" name="deadline" class="form-control" id="deadline" value="{{ $task->deadline }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" name="file" class="form-control" id="file">
                        @if ($task->file)
                            <small>Current file: <a href="{{ asset('storage/' . $task->file) }}" target="_blank">{{ $task->file }}</a></small>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea name="desc" class="form-control" id="desc" rows="3">{{ $task->desc }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control" id="status" required>
                            <option value="notstarted" {{ $task->status == 'notstarted' ? 'selected' : '' }}>Not Started</option>
                            <option value="inprorgess" {{ $task->status == 'inprogress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.task.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
