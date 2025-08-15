@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>📚 Book Details</h4>
                    <div>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="mb-3">{{ $book->title }}</h2>
                            
                            <table class="table">
                                <tr>
                                    <th width="150">Author:</th>
                                    <td><a href="{{ route('authors.show', $book->author) }}">{{ $book->author->name }}</a></td>
                                </tr>
                                <tr>
                                    <th>Published Year:</th>
                                    <td>{{ $book->published_year }}</td>
                                </tr>
                                <tr>
                                    <th>Genre:</th>
                                    <td>{{ $book->genre }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($book->isCurrentlyBorrowed())
                                            <span class="badge bg-warning fs-6">Currently Borrowed</span>
                                            @if($book->currentBorrowRecord())
                                                <br><small class="text-muted">
                                                    Borrowed by: {{ $book->currentBorrowRecord()->borrower_name }}<br>
                                                    Since: {{ $book->currentBorrowRecord()->borrow_date->format('M d, Y') }}
                                                </small>
                                            @endif
                                        @else
                                            <span class="badge bg-success fs-6">Available</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Added:</th>
                                    <td>{{ $book->created_at->format('M d, Y \a\t g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated:</th>
                                    <td>{{ $book->updated_at->format('M d, Y \a\t g:i A') }}</td>
                                </tr>
                            </table>

                            @if(!$book->isCurrentlyBorrowed())
                                <div class="mt-3">
                                    <a href="{{ route('borrow-records.create', ['book_id' => $book->id]) }}" class="btn btn-primary">
                                        📖 Borrow This Book
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($book->borrowRecords->count() > 0)
                        <hr>
                        <h5>📋 Borrowing History</h5>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Borrower</th>
                                        <th>Borrow Date</th>
                                        <th>Return Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($book->borrowRecords()->orderBy('created_at', 'desc')->get() as $record)
                                        <tr>
                                            <td>{{ $record->borrower_name }}</td>
                                            <td>{{ $record->borrow_date->format('M d, Y') }}</td>
                                            <td>
                                                {{ $record->return_date ? $record->return_date->format('M d, Y') : 'Not returned' }}
                                            </td>
                                            <td>
                                                @if($record->return_date)
                                                    <span class="badge bg-success">Returned</span>
                                                @else
                                                    <span class="badge bg-warning">Active</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
