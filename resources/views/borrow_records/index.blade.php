@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>📋 Borrow Records Management</h4>
                    <a href="{{ route('borrow-records.create') }}" class="btn btn-primary">New Borrow Record</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($borrowRecords->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Book Title</th>
                                        <th>Author</th>
                                        <th>Borrower Name</th>
                                        <th>Borrow Date</th>
                                        <th>Return Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($borrowRecords as $record)
                                        <tr>
                                            <td>
                                                <a href="{{ route('books.show', $record->book) }}">{{ $record->book->title }}</a>
                                            </td>
                                            <td>{{ $record->book->author->name }}</td>
                                            <td>{{ $record->borrower_name }}</td>
                                            <td>{{ $record->borrow_date->format('M d, Y') }}</td>
                                            <td>
                                                {{ $record->return_date ? $record->return_date->format('M d, Y') : 'Not returned' }}
                                            </td>
                                            <td>
                                                @if($record->return_date)
                                                    <span class="badge bg-success">Returned</span>
                                                @else
                                                    @if($record->isOverdue())
                                                        <span class="badge bg-danger">Overdue</span>
                                                    @else
                                                        <span class="badge bg-warning">Active</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('borrow-records.show', $record) }}" class="btn btn-sm btn-info">View</a>
                                                <a href="{{ route('borrow-records.edit', $record) }}" class="btn btn-sm btn-warning">Edit</a>
                                                @if(!$record->return_date)
                                                    <form action="{{ route('borrow-records.return', $record) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Mark this book as returned?')">Return</button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('borrow-records.destroy', $record) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $borrowRecords->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <h5>No borrow records found</h5>
                            <p class="text-muted">Start by creating your first borrow record.</p>
                            <a href="{{ route('borrow-records.create') }}" class="btn btn-primary">Create First Record</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
