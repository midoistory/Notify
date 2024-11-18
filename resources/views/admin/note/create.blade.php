@extends('admin.index')

@section('title-web', 'Create Notes')

@section('title-page', 'Create New Notes')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">Create New Notes</div>
            <div class="card-body">
                <form action="{{ route('note.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Notes Name</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                        @if ($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Subject</label>
                        <select name="subject_id" class="form-control" id="subject_id" required>
                            <option value="">Select Subject</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('subject_id'))
                            <div class="text-danger">{{ $errors->first('subject_id') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" id="date" required>
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" name="file" class="form-control" id="file">
                        @if ($errors->has('file'))
                            <div class="text-danger">{{ $errors->first('file') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea name="desc" class="form-control" id="desc" rows="3"></textarea>
                        @if ($errors->has('desc'))
                            <div class="text-danger">{{ $errors->first('desc') }}</div>
                        @endif
                    </div>


                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('admin.note.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
