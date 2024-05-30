<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookRequest;
use App\Models\BookTransaction;
use Illuminate\Support\Carbon;
use App\Models\Book;


class BookRequestController extends Controller
{
    public function bookRequests()
    {
        $bookrequests = BookRequest::all();
        $bookrequests = BookRequest::orderBy('due_date', 'asc')->get();
        return view('admin.bookRequests', ['bookrequests' => $bookrequests]);
    }

    public function requestMake(Request $request, $book)
    {
        return view('books.requestMake', ['book' => $book]);
    }

    public function requestSend(Request $request, $book)
    {
       
        $bookRequest = new BookRequest();
        $bookRequest->user_id = auth()->user()->id;
        $bookRequest->book_id = $book;
        $bookRequest->due_date = $request->due_date;
        $bookRequest->save();
        return back()->with('success','Your request has been sent to the admin.');

    }

    public function deleteRequest(bookRequest $bookrequest)
    {
        $bookrequest->delete();
        return redirect(route('admin.bookRequests'))->with('success','Request Successfully Declined');
    }

    public function acceptRequest($bookRequestId)
    {
        $bookRequest = BookRequest::find($bookRequestId);
        $bookTransaction =new BookTransaction();
        $bookTransaction->user_id = $bookRequest->user_id;
        $bookTransaction->book_id = $bookRequest->book_id;
        $bookTransaction->borrowed_at = Carbon::now();
        $bookTransaction->returned_at = null;
        $bookTransaction->save();
        
        $bookRequest->status = "finished";
        $bookRequest->update();
        
        $book = Book::find($bookRequest->book_id);
        if ($book) {
            $book->availability = false;
            $book->save();
        }
        return redirect(route('admin.bookRequests'))->with('succes', 'Request Succesfully Accepted');


    }
}

