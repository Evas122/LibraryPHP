<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $usertype=Auth()->user()->role;
            $books = Book::all();

            if($usertype=='student')
            {
                return view('books.userIndex',['books'=> $books]);
            }
            else if($usertype=='admin')
            {
                return view('books.adminIndex',['books'=> $books]);
            }
            else
            {
                return redirect()->back();
            }

        }
    }

    public function createBook()
    {
        return view('books.createBook');
    }

    public function addBook(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'required',
        ]);

        $newBook = Book::create($data);
        return redirect(route('books.index'))->with('success','Book Added Succesfully');
    }

    public function editBook(Book $book)
    {
        return view('books.editBook', ['book' => $book]);
    }

    public function updateBook(Book $book, Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'required',
        ]);

        $book->update($data);

        return redirect(route('books.index'))->with('success','Book Updated Succesffuly');
    }

    public function deleteBook(Book $book)
    {
        $book->delete();
        return redirect(route('books.index'))->with('success','Book Deleted Succesffuly');
    }

}
