<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalBooks = \App\Models\Book::count();
        $totalAuthors = \App\Models\Author::count();
        $activeBorrows = \App\Models\BorrowRecord::whereNull('return_date')->count();
        $overdueBorrows = \App\Models\BorrowRecord::whereNull('return_date')
                                                 ->where('borrow_date', '<', now()->subDays(14)->toDateString())
                                                 ->count();
        
        return view('home', compact('totalBooks', 'totalAuthors', 'activeBorrows', 'overdueBorrows'));
    }
}
