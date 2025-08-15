@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>📋 Edit Borrow Record</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('borrow-records.update', $borrowRecord) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="book_title" class="col-md-4 col-form-label text-md-end">{{ __('Book') }}</label>
                            <div class="col-md-6">
                                <input id="book_title" type="text" class="form-control" 
                                       value="{{ $borrowRecord->book->title }} - {{ $borrowRecord->book->author->name }}" readonly>
                                <small class="form-text text-muted">Book cannot be changed once borrow record is created.</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="borrower_name" class="col-md-4 col-form-label text-md-end">{{ __('Borrower Name') }}</label>
                            <div class="col-md-6">
                                <input id="borrower_name" type="text" class="form-control @error('borrower_name') is-invalid @enderror" 
                                       name="borrower_name" value="{{ old('borrower_name', $borrowRecord->borrower_name) }}" required autocomplete="name" autofocus>
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
                                       name="borrow_date" value="{{ old('borrow_date', $borrowRecord->borrow_date->format('Y-m-d')) }}" required>
                                @error('borrow_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="return_date" class="col-md-4 col-form-label text-md-end">{{ __('Return Date') }}</label>
                            <div class="col-md-6">
                                <input id="return_date" type="date" class="form-control @error('return_date') is-invalid @enderror" 
                                       name="return_date" value="{{ old('return_date', $borrowRecord->return_date ? $borrowRecord->return_date->format('Y-m-d') : '') }}">
                                @error('return_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="form-text text-muted">
                                    Leave empty if book is not yet returned.
                                </small>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Record') }}
                                </button>
                                <a href="{{ route('borrow-records.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                                <a href="{{ route('borrow-records.show', $borrowRecord) }}" class="btn btn-info ms-2">View</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
