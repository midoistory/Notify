@extends('admin.index')

@section('title-web', 'Task')

@section('title-page', 'Task')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <a href="{{ route('admin.task.create') }}" class="btn btn-primary btn-sm align-items-center">
                    <i class="fa-solid fa-plus me-2"></i>
                    <span>Create Task</span>
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Task Name</th>
                            <th>Subject</th>
                            <th>Day</th>
                            <th>Deadline</th>
                            <th>File</th> <!-- Added File column header -->
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->subject->name }}</td> <!-- Assuming 'subject' is a relationship in Task model -->
                                <td>{{ $task->day->name }}</td> <!-- Assuming 'day' is a relationship in Task model -->
                                <td>{{ \Carbon\Carbon::parse($task->deadline)->format('d-m-Y') }}</td>
                                <td>
                                    @if ($task->file)
                                        <a href="{{ asset('storage/' . $task->file) }}" target="_blank">View File</a>
                                    @else
                                        No file
                                    @endif
                                </td> <!-- Added File column content -->
                                <td>{{ ucfirst($task->status) }}</td>
                                <td>
                                    <a href="{{ route('task.show', $task->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.task.edit', $task->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('task.destroy', $task->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm ('Are you sure?')">
                                            <i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
