@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add new Book</div>
                <div class="card-body">

                    <form method="POST" action="{{route('book.store')}}">
                        <div class="form-group">
                            <label>Title: </label>
                            <input type="text" class="form-control" name="book_title" value="{{old('book_title')}}">
                            <small class="form-text text-muted">Please enter book title</small>
                        </div>
                        <div class="form-group">
                            <label>ISBN: </label>
                            <input type="text" class="form-control" name="book_isbn" value="{{old('book_isbn')}}">
                            <small class="form-text text-muted">Please enter ISBN number</small>
                        </div>
                        <div class="form-group">
                            <label>Pages: </label>
                            <input type="text" class="form-control" name="book_pages" value="{{old('book_pages')}}">
                            <small class="form-text text-muted">Please enter number of pages</small>
                        </div>

                        <div class="form-group">
                            <label>About: </label>
                            <textarea class="form-control" id="summernote" name="book_about">{{old('book_about')}}</textarea>
                            <small class="form-text text-muted">Please enter book description</small>
                        </div>
                        <div class="form-group">
                            <label>Author: </label>
                            <select class="form-control" name="author_id">
                                @foreach ($authors as $author)
                                <option value="{{$author->id}}">{{$author->name}} {{$author->surname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Publisher </label>
                            <select class="form-control" name="publisher_id">
                                @foreach ($publishers as $publisher)
                                <option value="{{$publisher->id}}">{{$publisher->title}} </option>
                                @endforeach
                            </select>
                        </div>
                        @csrf
                        <button class="btn btn-outline-success btn-sm" type="submit">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        $('#summernote').summernote();
    });

</script>
@endsection
