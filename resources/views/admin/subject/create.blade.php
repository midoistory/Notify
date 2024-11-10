@extends('admin.index')

@section('title-web', 'Create Subject')

@section('title-page', 'Create New Subject')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">Create New Subject</div>
            <div class="card-body">
                <form action="{{ route('subject.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea name="desc" class="form-control" id="desc" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('admin.subject.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
