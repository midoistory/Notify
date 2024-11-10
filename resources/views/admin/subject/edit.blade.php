@extends('admin.index')

@section('title-web', 'Edit Subject')

@section('title-page', 'Edit Subject')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">Edit Subject</div>
            <div class="card-body">
                <form action="{{ route('subject.update', $subject->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $subject->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea name="desc" class="form-control" id="desc" rows="3">{{ $subject->desc }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.subject.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
