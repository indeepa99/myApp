<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author_id',
        'published_year',
        'genre',
    ];

    /**
     * Get the author that owns the book.
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the borrow records for the book.
     */
    public function borrowRecords()
    {
        return $this->hasMany(BorrowRecord::class);
    }

    /**
     * Check if the book is currently borrowed.
     */
    public function isCurrentlyBorrowed()
    {
        return $this->borrowRecords()->whereNull('return_date')->exists();
    }

    /**
     * Get the current borrower if book is borrowed.
     */
    public function currentBorrowRecord()
    {
        return $this->borrowRecords()->whereNull('return_date')->first();
    }
}