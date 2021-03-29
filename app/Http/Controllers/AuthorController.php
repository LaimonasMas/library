<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Validator;

class AuthorController extends Controller
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
    // rusiavimas prasideda --------------
        // $authors = $request->sort ? Author::orderBy('surname', 'desc')->get() : Author::all();

        if ('name' == $request->sort) {
            $authors = Author::orderBy('name')->get();
        } else if ('surname' == $request->sort) {
            $authors = Author::orderBy('surname')->get();
        } else {
            $authors = Author::all();
        }

        // $authors = Author::all(); // $authors yra kolekcija
        // $authors = Author::orderBy('surname', 'desc')->get();
                                            // be desc rusius nuo a iki z
    // rusiavimas baigiasi ----------------                                          

        return view('author.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
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
                'author_name' => ['required', 'min:3', 'max:64'],
                //                                      tiek uzrasem migration, kad telpa 64 duombazej
                'author_surname' => ['required', 'min:3', 'max:64'],
            ],

            [
                'author_name.required' => 'The author name must be entered.',
                'author_surname.required' => 'The author surname must be entered.',  
                'author_surname.min' => 'The author surname must be at least 3 characters.'
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        Author::create($request);
        return redirect()->route('author.index')->with('success_message', 'The author was created. Nice job!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('author.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'author_name' => ['required', 'min:3', 'max:64'],
                //                                      tiek uzrasem migration, kad telpa 64 duombazej
                'author_surname' => ['required', 'min:3', 'max:64'],
            ],

            [
                'author_name.required' => 'The author name must be entered.',
                'author_surname.required' => 'The author surname must be entered.',
                'author_surname.min' => 'The author surname must be at least 3 characters.'
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $author->edit($request);
        return redirect()->route('author.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if ($author->authorBooks->count() !== 0) {
            return redirect()->route('author.index')->with('info_message', 'The author has books and cannot be deleted.');
        }
        $author->delete();
        return redirect()->route('author.index')->with('success_message', 'The author was deleted.');
    }
}
