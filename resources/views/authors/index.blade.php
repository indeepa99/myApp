@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>👤 Authors Management</h4>
                    <a href="{{ route('authors.create') }}" class="btn btn-primary">Add New Author</a>
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

                    @if($authors->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Books Count</th>
                                        <th>Joined</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($authors as $author)
                                        <tr>
                                            <td>{{ $author->name }}</td>
                                            <td>{{ $author->email }}</td>
                                            <td>
                                                <span class="badge bg-primary">{{ $author->books_count }} books</span>
                                            </td>
                                            <td>{{ $author->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('authors.show', $author) }}" class="btn btn-sm btn-info">View</a>
                                                <a href="{{ route('authors.edit', $author) }}" class="btn btn-sm btn-warning">Edit</a>
                                                @if($author->books_count == 0)
                                                    <form action="{{ route('authors.destroy', $author) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this author?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-sm btn-secondary" disabled title="Cannot delete author with books">Delete</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $authors->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <h5>No authors found</h5>
                            <p class="text-muted">Start by adding your first author.</p>
                            <a href="{{ route('authors.create') }}" class="btn btn-primary">Add First Author</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
