<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookTransaction;
use App\Models\Book;
use App\Models\BookRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BookTransactionController extends Controller
{
    public function issuedBooks()
    {
    $bookTransactions = BookTransaction::get();
    $data = [];

    foreach ($bookTransactions as $bookTransaction) {
        $book = $bookTransaction->book;
        $bookRequest = BookRequest::where('book_id', $bookTransaction->book_id)->first();

        if ($book) {
            $data[] = [
                'id' => $bookTransaction->id,
                'book_id' => $bookRequest->book_id,
                'user_id' => $bookTransaction->user_id,
                'title' => $book->title,
                'borrowed_at' => $bookTransaction->borrowed_at,
                'due_date' => $bookRequest ? $bookRequest->due_date : null,
                'returned_at' => $bookTransaction->returned_at
            ];
        }
    }

    return view('admin.issuedBooks', ['booktransactions' => $data]);
    }

    public function returnedBooks()
    {
        $bookTransactions = BookTransaction::get();
        $data = [];

        foreach ($bookTransactions as $bookTransaction) {
            $book = $bookTransaction->book;
            $bookRequest = BookRequest::where('book_id', $bookTransaction->book_id)->first();

            if ($book) {
                $data[] = [
                    'user_id' => $bookTransaction->user_id,
                    'title' => $book->title,
                    'borrowed_at' => $bookTransaction->borrowed_at,
                    'due_date' => $bookRequest ? $bookRequest->due_date : null,
                    'returned_at' => $bookTransaction->returned_at
                ];
            }
        }

        return view('admin.returnedBooks', ['booktransactions' => $data]);
    }

    public function returnBook(BookTransaction $booktransaction)
    {
        $booktransaction->returned_at = Carbon::now();
        $booktransaction->save();

        $book = Book::find($booktransaction->book_id);

   
        if ($book) {
            $book->update(['availability' => true]);
        }

        return redirect()->back()->with('success', 'Book Successfully Returned');
    }

    public function issuedBooksUser()
    {
        $userId = Auth::id(); 

        $bookTransactions = BookTransaction::where('user_id', $userId)->get();
        $data = [];

        foreach ($bookTransactions as $bookTransaction) {
            $book = $bookTransaction->book;
            $bookRequest = BookRequest::where('book_id', $bookTransaction->book_id)->first();
    
            if ($book) {
                $data[] = [
                    'title' => $book->title,
                    'borrowed_at' => $bookTransaction->borrowed_at,
                    'due_date' => $bookRequest ? $bookRequest->due_date : null,
                    'returned_at' => $bookTransaction->returned_at
                ];
            }
        }
    
        return view('student.issuedBooks', ['booktransactions' => $data]);

    }

    public function returnedBooksUser()
    {
        $userId = Auth::id(); 

        $bookTransactions = BookTransaction::where('user_id', $userId)->get();
        $data = [];

        foreach ($bookTransactions as $bookTransaction) {
            $book = $bookTransaction->book;
            $bookRequest = BookRequest::where('book_id', $bookTransaction->book_id)->first();

            if ($book) {
                $data[] = [
                    'title' => $book->title,
                    'borrowed_at' => $bookTransaction->borrowed_at,
                    'due_date' => $bookRequest ? $bookRequest->due_date : null,
                    'returned_at' => $bookTransaction->returned_at
                ];
            }
        }

        return view('student.returnedBooks', ['booktransactions' => $data]);

    }

}
