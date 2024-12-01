@extends('admin.index')

@section('title-web', 'View Note')

@section('title-page', 'View Note')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">Note Details</div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $notes->name }}</p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($notes->date)->format('d-m-Y') }}</p>
                <p><strong>Subject:</strong> {{ $notes->subject->name ?? 'N/A' }}</p>
                <p><strong>Description:</strong> {{ $notes->desc }}</p>
                <p><strong>File:</strong>
                    @if ($notes->file)
                        <a href="{{ Storage::url($notes->file) }}" target="_blank">View File</a>
                    @else
                        No file uploaded.
                    @endif
                </p>
                <p><strong>Created At:</strong> {{ $notes->created_at->format('d-m-Y') }}</p>
                <a href="{{ route('admin.note.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
