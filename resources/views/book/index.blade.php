@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Books List</h2>
                    <div class="make-inline">
                        <form action="{{route('book.index')}}" method="get" class="make-inline">
                            <div class="form-group make-inline">
                                <label>Author: </label>
                                <select class="form-control" name="author_id">
                                    <option value="0" @if($filterBy==0) selected @endif>All Authors</option>
                                    @foreach ($authors as $author)
                                    <option value="{{$author->id}}" @if($filterBy==$author->id) selected @endif>
                                        {{$author->name}} {{$author->surname}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="form-check-label">Sort by title:</label>
                            <label class="form-check-label" for="sortASC">ASC</label>
                            <div class="form-group make-inline column">
                                <input type="radio" class="form-check-input" name="sort" value="asc" id="sortASC" @if($sortBy=='asc' ) checked @endif>
                            </div>
                            <label class="form-check-label" for="sortDESC">DESC</label>
                            <div class="form-group make-inline column">
                                <input type="radio" class="form-check-input" name="sort" value="desc" id="sortDESC" @if($sortBy=='desc' ) checked @endif>
                            </div>
                            <button type="submit" class="btn btn-outline-success btn-sm">Filter</button>
                        </form>

                        <a href="{{route('book.index')}}" class="btn btn-outline-secondary btn-sm">Clear filter</a>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($books as $book)
                        <li class="list-group-item list-line">
                            <div class="list-line__books">
                                <div class="list-line__books__title">
                                    {{$book->title}}
                                </div>
                                <div class="list-line__books__author">
                                    Author: {{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}
                                </div>
                                <div class="list-line__books__author">
                                    Publisher: {{$book->bookPublisher->title}}
                                </div>
                            </div>
                            <div class="list-line__buttons">
                                <a href="{{route('book.show',[$book])}}" class="btn btn-outline-success btn-sm">SHOW</a>
                                <a href="{{route('book.edit',[$book])}}" class="btn btn-outline-secondary btn-sm">EDIT</a>
                                <form method="POST" action="{{route('book.destroy', [$book])}}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm">DELETE</button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
