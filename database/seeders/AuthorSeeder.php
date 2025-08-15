<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            [
                'name' => 'J.K. Rowling',
                'email' => 'jk.rowling@example.com',
            ],
            [
                'name' => 'George Orwell',
                'email' => 'george.orwell@example.com',
            ],
            [
                'name' => 'Jane Austen',
                'email' => 'jane.austen@example.com',
            ],
            [
                'name' => 'Stephen King',
                'email' => 'stephen.king@example.com',
            ],
            [
                'name' => 'Agatha Christie',
                'email' => 'agatha.christie@example.com',
            ],
            [
                'name' => 'Harper Lee',
                'email' => 'harper.lee@example.com',
            ],
            [
                'name' => 'F. Scott Fitzgerald',
                'email' => 'f.scott.fitzgerald@example.com',
            ],
            [
                'name' => 'Mark Twain',
                'email' => 'mark.twain@example.com',
            ],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}