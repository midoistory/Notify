@extends('admin.index')

@section('title-web', 'Create Task')

@section('title-page', 'Create New Task')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">Create New Task</div>
            <div class="card-body">
                <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Task Name</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                        @if($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Subject</label>
                        <select name="subject_id" class="form-control" id="subject" required>
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('subject'))
                            <div class="text-danger">{{ $errors->first('subject') }}</div>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="day_id" class="form-label">Day</label>
                        <select name="day_id" class="form-control" id="day" required>
                            <option value="">Select Day</option>
                            @foreach($days as $day)
                                <option value="{{ $day->id }}">{{ $day->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('day'))
                            <div class="text-danger">{{ $errors->first('day') }}</div>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="date" name="deadline" class="form-control" id="deadline" required>
                        @if($errors->has('deadline'))
                            <div class="text-danger">{{ $errors->first('deadline') }}</div>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" name="file" class="form-control" id="file">
                        @if($errors->has('file'))
                            <div class="text-danger">{{ $errors->first('file') }}</div>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea name="desc" class="form-control" id="desc" rows="3"></textarea>
                        @if($errors->has('desc'))
                            <div class="text-danger">{{ $errors->first('desc') }}</div>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control" id="status" required>
                            <option value="notstated">Not Started</option>
                            <option value="inprogess">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                        @if($errors->has('status'))
                            <div class="text-danger">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('admin.task.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
