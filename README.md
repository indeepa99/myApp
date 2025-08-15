# 📚 Library Book Management System

A comprehensive web application built with Laravel for managing a library's book collection, authors, and borrowing records. This system allows library staff to efficiently track books, manage author information, and monitor borrowing activities.

## 🚀 Features Implemented

### ✅ 1. Book Management
- **Complete CRUD Operations**: Create, Read, Update, and Delete books
- **Book Information**: Title, Author, Published Year, Genre
- **Pagination**: Easy navigation through large book collections
- **Status Tracking**: See if books are available or currently borrowed
- **Borrowing History**: View complete borrowing history for each book

### ✅ 2. Author Management
- **Author CRUD Operations**: Full management of author information
- **Author Details**: Name and unique email address
- **Book Count**: See how many books each author has in the library
- **Author Profile**: View all books by a specific author
- **Smart Deletion**: Prevents deletion of authors who have books in the system

### ✅ 3. Search and Filter Functionality
- **Book Search**: Search by book title or author name
- **Year Filter**: Filter books by publication year
- **Genre Filter**: Filter books by genre
- **Combined Filters**: Use multiple filters simultaneously
- **Real-time Results**: Instant search and filter results

### ✅ 4. Borrow Records System (Bonus Feature)
- **Borrowing Tracking**: Complete borrowing record management
- **Borrower Information**: Track who borrowed which book and when
- **Return Dates**: Monitor book returns and overdue items
- **Availability Check**: Automatic prevention of double-borrowing
- **Overdue Detection**: Visual indicators for overdue books
- **Return Processing**: Easy book return functionality

### ✅ 5. Additional Features
- **Dashboard Analytics**: Overview of library statistics
- **User Authentication**: Secure login system
- **Responsive Design**: Bootstrap-based mobile-friendly interface
- **Data Validation**: Comprehensive form validation
- **Error Handling**: User-friendly error messages
- **Database Relationships**: Proper foreign key constraints
- **Sample Data**: Pre-loaded with popular books and authors

## 🛠️ Technical Implementation

### Database Design
- **Authors Table**: id, name, email (unique), timestamps
- **Books Table**: id, title, author_id (FK), published_year, genre, timestamps
- **Borrow Records Table**: id, book_id (FK), borrower_name, borrow_date, return_date, timestamps
- **Proper Relationships**: Foreign key constraints with cascade delete

### Laravel Best Practices
- **Resource Controllers**: RESTful controller design
- **Eloquent Models**: Proper model relationships and methods
- **Form Requests**: Validation handled in dedicated request classes
- **Blade Templates**: Reusable and well-structured views
- **Route Organization**: Grouped and protected routes
- **Database Migrations**: Version-controlled database schema
- **Seeders**: Sample data for testing and demonstration

## 📋 Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL or SQLite database

### Installation Steps

1. **Clone/Download the Project**
   ```bash
   git clone https://github.com/indeepa99/myApp.git
   cd myApp
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install Node Dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   # Copy environment file
   cp .env.example .env
   
   # Generate application key
   php artisan key:generate
   ```

5. **Database Configuration**
   - Update `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=weekendlaravelapp20252
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run Migrations and Seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Build Frontend Assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

8. **Start the Development Server**
   ```bash
   php artisan serve
   ```

9. **Access the Application**
   - Open your browser and go to: `http://localhost:8000`
   - Register a new account or login with existing credentials

## 🎯 Usage Guide

### Getting Started
1. **Register/Login**: Create an account or login to access the system
2. **Dashboard**: View library statistics and quick action buttons
3. **Add Authors**: Start by adding authors to the system
4. **Add Books**: Add books and assign them to authors
5. **Manage Borrowing**: Track book borrowing and returns

### Managing Books
- **Add New Book**: Click "Add New Book" and fill in the details
- **Search Books**: Use the search bar to find books by title or author
- **Filter Books**: Use dropdown filters for year and genre
- **Edit Book**: Click "Edit" on any book to modify its information
- **View Details**: Click "View" to see complete book information

### Managing Authors
- **Add Author**: Add new authors with name and email
- **View Author Profile**: See all books by a specific author
- **Edit Author**: Update author information
- **Delete Author**: Remove authors (only if they have no books)

### Borrowing System
- **Borrow Book**: Select available books and create borrow records
- **Return Book**: Mark books as returned when they come back
- **Track Overdue**: Monitor books that are past their due date
- **View History**: See complete borrowing history for any book



## 🔧 Development Commands

```bash
# Start development server
php artisan serve

# Watch for file changes (frontend)
npm run dev

# Run database migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed

# Clear application cache
php artisan cache:clear

# Generate new controller
php artisan make:controller ControllerName --resource

# Generate new model
php artisan make:model ModelName

# Generate new migration
php artisan make:migration migration_name
```

## 📁 Project Structure

```
myApp/
├── app/
│   ├── Http/Controllers/
│   │   ├── BookController.php
│   │   ├── AuthorController.php
│   │   └── BorrowRecordController.php
│   └── Models/
│       ├── Book.php
│       ├── Author.php
│       └── BorrowRecord.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── books/
│       ├── authors/
│       └── borrow_records/
├── routes/
│   └── web.php
└── public/
```

## 🎨 Screenshots & Demo

The application includes:
- **Modern Dashboard**: Statistics cards and quick action buttons
- **Responsive Tables**: Sortable and paginated data displays
- **Intuitive Forms**: Clean, validated forms for data entry
- **Search Interface**: Real-time search and filtering
- **Status Indicators**: Visual badges for book availability and overdue items


## 🚀 Future Enhancements

Potential improvements for future versions:
- **Advanced Reporting**: Generate PDF reports
- **Email Notifications**: Overdue book reminders
- **Barcode Support**: Barcode scanning for books
- **Member Management**: Full patron management system
- **Fine Calculation**: Automatic fine calculation for overdue books
- **Reservation System**: Book reservation functionality

## Developer Information
- **Developer:** Indeepa
- **Maintainer:** Indeepa
- **Support:** indeepalakshaka@gmail.com