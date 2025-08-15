@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>📋 Borrow Record Details</h4>
                    <div>
                        <a href="{{ route('borrow-records.edit', $borrowRecord) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('borrow-records.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="mb-3">{{ $borrowRecord->book->title }}</h3>
                            
                            <table class="table">
                                <tr>
                                    <th width="200">Book:</th>
                                    <td>
                                        <a href="{{ route('books.show', $borrowRecord->book) }}">{{ $borrowRecord->book->title }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Author:</th>
                                    <td>
                                        <a href="{{ route('authors.show', $borrowRecord->book->author) }}">{{ $borrowRecord->book->author->name }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Borrower Name:</th>
                                    <td>{{ $borrowRecord->borrower_name }}</td>
                                </tr>
                                <tr>
                                    <th>Borrow Date:</th>
                                    <td>{{ $borrowRecord->borrow_date->format('M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Return Date:</th>
                                    <td>
                                        @if($borrowRecord->return_date)
                                            {{ $borrowRecord->return_date->format('M d, Y') }}
                                        @else
                                            <span class="text-muted">Not returned yet</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($borrowRecord->return_date)
                                            <span class="badge bg-success fs-6">Returned</span>
                                        @else
                                            @if($borrowRecord->isOverdue())
                                                <span class="badge bg-danger fs-6">Overdue</span>
                                                <br><small class="text-danger">
                                                    Book was due {{ $borrowRecord->borrow_date->addWeeks(2)->format('M d, Y') }}
                                                </small>
                                            @else
                                                <span class="badge bg-warning fs-6">Active</span>
                                                <br><small class="text-muted">
                                                    Due date: {{ $borrowRecord->borrow_date->addWeeks(2)->format('M d, Y') }}
                                                </small>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Duration:</th>
                                    <td>
                                        @if($borrowRecord->return_date)
                                            {{ $borrowRecord->borrow_date->diffInDays($borrowRecord->return_date) }} days
                                        @else
                                            {{ $borrowRecord->borrow_date->diffInDays(now()) }} days (ongoing)
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Record Created:</th>
                                    <td>{{ $borrowRecord->created_at->format('M d, Y \a\t g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated:</th>
                                    <td>{{ $borrowRecord->updated_at->format('M d, Y \a\t g:i A') }}</td>
                                </tr>
                            </table>

                            @if(!$borrowRecord->return_date)
                                <div class="mt-3">
                                    <form action="{{ route('borrow-records.return', $borrowRecord) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success" onclick="return confirm('Mark this book as returned today?')">
                                            📖 Mark as Returned
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
