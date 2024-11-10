@extends('admin.index')

@section('title-web', 'View Subject')

@section('title-page', 'View Subject')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">Subject Details</div>
            <div class="card-body">
                <p>Name: {{ $subject->name }}</p>
                <p>Description: {{ $subject->desc }}</p>
                <p>Created At: {{ $subject->created_at->format('d-m-Y') }}</p>
                <a href="{{ route('admin.subject.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
