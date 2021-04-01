<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Validator;

class PublisherController extends Controller
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

        if ('title' == $request->sort) {
            $publishers = Publisher::orderBy('title')->get();
        } else {
            $publishers = Publisher::all();
        }

        // $publishers = Publisher::all(); // $publishers yra kolekcija


    // rusiavimas baigiasi ----------------                                          

        return view('publisher.index', ['publishers' => $publishers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publisher.create');
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
                'publisher_title' => ['required', 'min:3', 'max:64'],
                //                                      tiek uzrasem migration, kad telpa 64 duombazej

            ],

            [
                'publisher_title.required' => 'The publisher title must be entered.',

            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        Publisher::new()->refreshAndSave($request);
        return redirect()->route('publisher.index')->with('success_message', 'The publisher was created. Nice job!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(publisher $publisher)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function edit(publisher $publisher)
    {
        return view('publisher.edit', ['publisher' => $publisher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, publisher $publisher)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'publisher_title' => ['required', 'min:3', 'max:64'],
                //                                      tiek uzrasem migration, kad telpa 64 duombazej

            ],

            [
                'publisher_title.required' => 'The publisher title must be entered.',

            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $publisher->edit($request);
        return redirect()->route('publisher.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(publisher $publisher)
    {
        if ($publisher->publisherBooks->count() !== 0) {
            return redirect()->route('publisher.index')->with('info_message', 'The publisher has books and cannot be deleted.');
        }
        $publisher->delete();
        return redirect()->route('publisher.index')->with('success_message', 'The publisher was deleted.');
    }
}
