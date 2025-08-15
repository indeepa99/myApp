<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'book_id',
        'borrower_name',
        'borrow_date',
        'return_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'date',
    ];

    /**
     * Get the book that owns the borrow record.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Check if the book is overdue.
     */
    public function isOverdue()
    {
        return $this->return_date === null && $this->borrow_date->addWeeks(2) < now();
    }
}