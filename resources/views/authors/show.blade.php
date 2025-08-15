@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>👤 Author Details</h4>
                    <div>
                        <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="mb-3">{{ $author->name }}</h2>
                            
                            <table class="table">
                                <tr>
                                    <th width="150">Email:</th>
                                    <td>{{ $author->email }}</td>
                                </tr>
                                <tr>
                                    <th>Total Books:</th>
                                    <td><span class="badge bg-primary fs-6">{{ $author->books->count() }} books</span></td>
                                </tr>
                                <tr>
                                    <th>Added:</th>
                                    <td>{{ $author->created_at->format('M d, Y \a\t g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated:</th>
                                    <td>{{ $author->updated_at->format('M d, Y \a\t g:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($author->books->count() > 0)
                        <hr>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>📚 Books by {{ $author->name }}</h5>
                            <a href="{{ route('books.create', ['author_id' => $author->id]) }}" class="btn btn-primary btn-sm">Add New Book</a>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Published Year</th>
                                        <th>Genre</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($author->books()->orderBy('title')->get() as $book)
                                        <tr>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->published_year }}</td>
                                            <td>{{ $book->genre }}</td>
                                            <td>
                                                @if($book->isCurrentlyBorrowed())
                                                    <span class="badge bg-warning">Borrowed</span>
                                                @else
                                                    <span class="badge bg-success">Available</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info">View</a>
                                                <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <hr>
                        <div class="text-center py-4">
                            <h5>No books yet</h5>
                            <p class="text-muted">This author doesn't have any books in the library yet.</p>
                            <a href="{{ route('books.create', ['author_id' => $author->id]) }}" class="btn btn-primary">Add First Book</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
