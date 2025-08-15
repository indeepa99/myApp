<?php

namespace App\Http\Controllers;

use App\Models\BorrowRecord;
use App\Models\Book;
use Illuminate\Http\Request;

class BorrowRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrowRecords = BorrowRecord::with(['book', 'book.author'])
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(10);
        return view('borrow_records.index', compact('borrowRecords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only show books that are not currently borrowed
        $availableBooks = Book::with('author')
                             ->whereDoesntHave('borrowRecords', function ($query) {
                                 $query->whereNull('return_date');
                             })
                             ->orderBy('title')
                             ->get();
        
        return view('borrow_records.create', compact('availableBooks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrower_name' => 'required|string|max:255',
            'borrow_date' => 'required|date',
        ]);

        // Check if book is already borrowed
        $isAlreadyBorrowed = BorrowRecord::where('book_id', $request->book_id)
                                        ->whereNull('return_date')
                                        ->exists();

        if ($isAlreadyBorrowed) {
            return redirect()->back()
                             ->with('error', 'This book is already borrowed.')
                             ->withInput();
        }

        BorrowRecord::create($request->all());

        return redirect()->route('borrow-records.index')
                         ->with('success', 'Book borrowed successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BorrowRecord $borrowRecord)
    {
        $borrowRecord->load(['book', 'book.author']);
        return view('borrow_records.show', compact('borrowRecord'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BorrowRecord $borrowRecord)
    {
        return view('borrow_records.edit', compact('borrowRecord'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BorrowRecord $borrowRecord)
    {
        $request->validate([
            'borrower_name' => 'required|string|max:255',
            'borrow_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:borrow_date',
        ]);

        $borrowRecord->update($request->all());

        return redirect()->route('borrow-records.index')
                         ->with('success', 'Borrow record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BorrowRecord $borrowRecord)
    {
        $borrowRecord->delete();

        return redirect()->route('borrow-records.index')
                         ->with('success', 'Borrow record deleted successfully.');
    }

    /**
     * Mark a book as returned.
     */
    public function return(BorrowRecord $borrowRecord)
    {
        $borrowRecord->update(['return_date' => now()->toDateString()]);

        return redirect()->route('borrow-records.index')
                         ->with('success', 'Book returned successfully.');
    }
}