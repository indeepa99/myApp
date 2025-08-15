@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>📋 Create New Borrow Record</h4>
                </div>

                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('borrow-records.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label for="book_id" class="col-md-4 col-form-label text-md-end">{{ __('Book') }}</label>
                            <div class="col-md-6">
                                <select id="book_id" class="form-control @error('book_id') is-invalid @enderror" name="book_id" required>
                                    <option value="">Select a Book</option>
                                    @foreach($availableBooks as $book)
                                        <option value="{{ $book->id }}" {{ old('book_id', request('book_id')) == $book->id ? 'selected' : '' }}>
                                            {{ $book->title }} - {{ $book->author->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('book_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="form-text text-muted">
                                    Only available books are shown. Books currently borrowed are not listed.
                                </small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="borrower_name" class="col-md-4 col-form-label text-md-end">{{ __('Borrower Name') }}</label>
                            <div class="col-md-6">
                                <input id="borrower_name" type="text" class="form-control @error('borrower_name') is-invalid @enderror" 
                                       name="borrower_name" value="{{ old('borrower_name') }}" required autocomplete="name" autofocus>
                                @error('borrower_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="borrow_date" class="col-md-4 col-form-label text-md-end">{{ __('Borrow Date') }}</label>
                            <div class="col-md-6">
                                <input id="borrow_date" type="date" class="form-control @error('borrow_date') is-invalid @enderror" 
                                       name="borrow_date" value="{{ old('borrow_date', date('Y-m-d')) }}" required>
                                @error('borrow_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Borrow Record') }}
                                </button>
                                <a href="{{ route('borrow-records.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>

                    @if($availableBooks->count() == 0)
                        <div class="alert alert-warning mt-3">
                            <strong>No books available for borrowing.</strong><br>
                            All books are currently borrowed or there are no books in the library yet. 
                            <a href="{{ route('books.create') }}" class="alert-link">Add a new book</a> or wait for books to be returned.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
