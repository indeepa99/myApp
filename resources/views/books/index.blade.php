@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>📚 Books Management</h4>
                    <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
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

                    <!-- Search and Filter Form -->
                    <form method="GET" action="{{ route('books.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="Search by title or author..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="published_year" class="form-control">
                                    <option value="">All Years</option>
                                    @foreach($publishedYears as $year)
                                        <option value="{{ $year }}" {{ request('published_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="genre" class="form-control">
                                    <option value="">All Genres</option>
                                    @foreach($genres as $genre)
                                        <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>{{ $genre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-outline-primary me-2">Search</button>
                                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">Clear</a>
                            </div>
                        </div>
                    </form>

                    @if($books->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Published Year</th>
                                        <th>Genre</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($books as $book)
                                        <tr>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->author->name }}</td>
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
                                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this book?')">
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
                            {{ $books->withQueryString()->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <h5>No books found</h5>
                            <p class="text-muted">Start by adding your first book to the library.</p>
                            <a href="{{ route('books.create') }}" class="btn btn-primary">Add First Book</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
