@extends('admin.index')

@section('title-web', 'Edit Note')

@section('title-page', 'Edit Note')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">Edit Note</div>
            <div class="card-body">
                <form action="{{ route('note.update', $notes->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Input Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            id="name"
                            value="{{ $notes->name }}"
                            required
                        >
                    </div>

                    <!-- Input Date -->
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input
                            type="date"
                            name="date"
                            class="form-control"
                            id="date"
                            value="{{ $notes->date }}"
                            required
                        >
                    </div>

                    <!-- Select Subject -->
                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Subject</label>
                        <select name="subject_id" id="subject_id" class="form-control" required>
                            <option value="" disabled>Select Subject</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ $subject->id == $notes->subject_id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Input File -->
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File (Optional)</label>
                        <input
                            type="file"
                            name="file"
                            class="form-control"
                            id="file"
                        >
                        @if ($notes->file)
                            <small>Current file: <a href="{{ asset('storage/' . $notes->file) }}" target="_blank">View File</a></small>
                        @endif
                    </div>

                    <!-- Textarea Description -->
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea
                            name="desc"
                            class="form-control"
                            id="desc"
                            rows="3"
                        >{{ $notes->desc }}</textarea>
                    </div>

                    <!-- Buttons -->
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.note.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
