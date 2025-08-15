@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Library Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h5 class="card-title">Total Books</h5>
                                    <h2 class="card-text">{{ $totalBooks }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-success">
                                <div class="card-body">
                                    <h5 class="card-title">Total Authors</h5>
                                    <h2 class="card-text">{{ $totalAuthors }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-warning">
                                <div class="card-body">
                                    <h5 class="card-title">Active Borrows</h5>
                                    <h2 class="card-text">{{ $activeBorrows }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-danger">
                                <div class="card-body">
                                    <h5 class="card-title">Overdue Books</h5>
                                    <h2 class="card-text">{{ $overdueBorrows }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">📚 Manage Books</h5>
                                    <p class="card-text">Add, edit, and view all books in the library collection.</p>
                                    <a href="{{ route('books.index') }}" class="btn btn-primary">View Books</a>
                                    <a href="{{ route('books.create') }}" class="btn btn-outline-primary">Add Book</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">👤 Manage Authors</h5>
                                    <p class="card-text">Add and manage author information.</p>
                                    <a href="{{ route('authors.index') }}" class="btn btn-success">View Authors</a>
                                    <a href="{{ route('authors.create') }}" class="btn btn-outline-success">Add Author</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">📋 Borrow Records</h5>
                                    <p class="card-text">Track book borrowing and returns.</p>
                                    <a href="{{ route('borrow-records.index') }}" class="btn btn-warning">View Records</a>
                                    <a href="{{ route('borrow-records.create') }}" class="btn btn-outline-warning">New Borrow</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection