@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>📚 Edit Book: {{ $book->title }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('books.update', $book) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" 
                                       name="title" value="{{ old('title', $book->title) }}" required autocomplete="title" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="author_id" class="col-md-4 col-form-label text-md-end">{{ __('Author') }}</label>
                            <div class="col-md-6">
                                <select id="author_id" class="form-control @error('author_id') is-invalid @enderror" name="author_id" required>
                                    <option value="">Select an Author</option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                                            {{ $author->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('author_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="published_year" class="col-md-4 col-form-label text-md-end">{{ __('Published Year') }}</label>
                            <div class="col-md-6">
                                <input id="published_year" type="number" class="form-control @error('published_year') is-invalid @enderror" 
                                       name="published_year" value="{{ old('published_year', $book->published_year) }}" required min="1000" max="{{ date('Y') }}">
                                @error('published_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="genre" class="col-md-4 col-form-label text-md-end">{{ __('Genre') }}</label>
                            <div class="col-md-6">
                                <input id="genre" type="text" class="form-control @error('genre') is-invalid @enderror" 
                                       name="genre" value="{{ old('genre', $book->genre) }}" required>
                                @error('genre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Book') }}
                                </button>
                                <a href="{{ route('books.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                                <a href="{{ route('books.show', $book) }}" class="btn btn-info ms-2">View</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
