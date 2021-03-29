<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Validator;


class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $authors = Author::all();

        //FILTRAVIMAS
        if ($request->author_id) {
            $books = Book::where('author_id', $request->author_id)->get();
            $filterBy = $request->author_id;
        }
        else {
            $books = Book::all();
        }

        //RUSIAVIMAS
        if ($request->sort && 'asc' == $request->sort) {
            $books = $books->sortBy('title');
            $sortBy = 'asc';
        }
        elseif ($request->sort && 'desc' == $request->sort) {
            $books = $books->sortByDesc('title');
            $sortBy = 'desc';
        }
        
        return view('book.index', [
            'books' => $books,
            'authors' => $authors,
            'filterBy' => $filterBy ?? 0,
            'sortBy' => $sortBy ?? ''
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        return view('book.create', ['authors' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'book_title' => ['required', 'min:1', 'max:64'],
                'book_isbn' => ['required', 'min:10', 'max:13'],
                'book_pages' => ['required', 'integer', 'min:1', 'max:10000'],
                'book_about' => ['required', 'min:1', 'max:200'],
            ],

            [
                'book_title.required' => 'The book title must be entered.',
                'book_isbn.required' => 'The ISBN number must be entered.',
                'book_pages.required' => 'The number of pages must be entered.',
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $book = new Book;
        $book->title = $request->book_title;
        $book->isbn = $request->book_isbn;
        $book->pages = $request->book_pages;
        $book->about = $request->book_about;
        $book->author_id = $request->author_id;
        $book->save();
        return redirect()->route('book.index')->with('success_message', 'Book was created. Nice job!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('book.edit', ['book' => $book, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'book_title' => ['required', 'min:1', 'max:64'],
                'book_isbn' => ['required', 'min:10', 'max:13'],
                'book_pages' => ['required', 'integer', 'min:1', 'max:10000'],
                'book_about' => ['required', 'min:1', 'max:200']
            ],

            [
                'book_title.required' => 'The book title must be entered.',
                'book_isbn.required' => 'The ISBN number must be entered.',
                'book_pages.required' => 'The number of pages must be entered.'
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $book->title = $request->book_title;
        $book->isbn = $request->book_isbn;
        $book->pages = $request->book_pages;
        $book->about = $request->book_about;
        $book->author_id = $request->author_id;
        $book->save();
        return redirect()->route('book.index')->with('success_message', 'Book was edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index')->with('success_message', 'Book was deleted.');
    }
}
