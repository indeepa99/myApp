<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'author_name' => 'J.K. Rowling',
                'published_year' => 1997,
                'genre' => 'Fantasy',
            ],
            [
                'title' => 'Harry Potter and the Chamber of Secrets',
                'author_name' => 'J.K. Rowling',
                'published_year' => 1998,
                'genre' => 'Fantasy',
            ],
            [
                'title' => '1984',
                'author_name' => 'George Orwell',
                'published_year' => 1949,
                'genre' => 'Dystopian Fiction',
            ],
            [
                'title' => 'Animal Farm',
                'author_name' => 'George Orwell',
                'published_year' => 1945,
                'genre' => 'Political Satire',
            ],
            [
                'title' => 'Pride and Prejudice',
                'author_name' => 'Jane Austen',
                'published_year' => 1813,
                'genre' => 'Romance',
            ],
            [
                'title' => 'Emma',
                'author_name' => 'Jane Austen',
                'published_year' => 1815,
                'genre' => 'Romance',
            ],
            [
                'title' => 'The Shining',
                'author_name' => 'Stephen King',
                'published_year' => 1977,
                'genre' => 'Horror',
            ],
            [
                'title' => 'It',
                'author_name' => 'Stephen King',
                'published_year' => 1986,
                'genre' => 'Horror',
            ],
            [
                'title' => 'Murder on the Orient Express',
                'author_name' => 'Agatha Christie',
                'published_year' => 1934,
                'genre' => 'Mystery',
            ],
            [
                'title' => 'The Murder of Roger Ackroyd',
                'author_name' => 'Agatha Christie',
                'published_year' => 1926,
                'genre' => 'Mystery',
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author_name' => 'Harper Lee',
                'published_year' => 1960,
                'genre' => 'Fiction',
            ],
            [
                'title' => 'The Great Gatsby',
                'author_name' => 'F. Scott Fitzgerald',
                'published_year' => 1925,
                'genre' => 'Fiction',
            ],
            [
                'title' => 'The Adventures of Tom Sawyer',
                'author_name' => 'Mark Twain',
                'published_year' => 1876,
                'genre' => 'Adventure',
            ],
            [
                'title' => 'Adventures of Huckleberry Finn',
                'author_name' => 'Mark Twain',
                'published_year' => 1884,
                'genre' => 'Adventure',
            ],
        ];

        foreach ($books as $bookData) {
            $author = Author::where('name', $bookData['author_name'])->first();
            
            if ($author) {
                Book::create([
                    'title' => $bookData['title'],
                    'author_id' => $author->id,
                    'published_year' => $bookData['published_year'],
                    'genre' => $bookData['genre'],
                ]);
            }
        }
    }
}