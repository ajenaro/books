<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        return Book::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Book
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $book = new Book;

        $book->title = $request->input('title');
        $book->save();

        return $book;
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return Book
     */
    public function show(Book $book)
    {
        return $book;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Book $book
     * @return Book
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $book->title = $request->input('title');
        $book->save();

        return $book;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->noContent();
    }
}
