<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Book::with('author');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('author', function ($authorQuery) use ($searchTerm) {
                      $authorQuery->where('name', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // Filter by published year
        if ($request->has('published_year') && $request->published_year != '') {
            $query->where('published_year', $request->published_year);
        }

        // Filter by genre
        if ($request->has('genre') && $request->genre != '') {
            $query->where('genre', 'like', '%' . $request->genre . '%');
        }

        $books = $query->paginate(10);
        
        // Get distinct years and genres for filter dropdowns
        $publishedYears = Book::distinct()->orderBy('published_year', 'desc')->pluck('published_year');
        $genres = Book::distinct()->orderBy('genre')->pluck('genre');

        return view('books.index', compact('books', 'publishedYears', 'genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::orderBy('name')->get();
        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'published_year' => 'required|integer|min:1000|max:' . date('Y'),
            'genre' => 'required|string|max:255',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')
                         ->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book->load('author', 'borrowRecords');
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::orderBy('name')->get();
        return view('books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'published_year' => 'required|integer|min:1000|max:' . date('Y'),
            'genre' => 'required|string|max:255',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')
                         ->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
                         ->with('success', 'Book deleted successfully.');
    }
}