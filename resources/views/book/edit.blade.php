@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">KNYGOS</div>

                <div class="card-body">
                    <form method="POST" action="{{route('book.update',[$book])}}">
                        <div class="form-group">
                            <label>Title: </label>
                            <input type="text" class="form-control" name="book_title" value="{{$book->title}}">
                            <small class="form-text text-muted">Knygos pavadinimas</small>
                        </div>
                        <div class="form-group">
                            <label>ISBN: </label>
                            <input type="text" class="form-control" name="book_isbn" value="{{$book->isbn}}">
                            <small class="form-text text-muted">Knygos ISBN numeris</small>
                        </div>
                        <div class="form-group">
                            <label>Pages: </label>
                            <input type="text" class="form-control" name="book_pages" value="{{$book->pages}}">
                            <small class="form-text text-muted">Knygos puslapių skaičius</small>
                        </div>
                        <div class="form-group">
                        <label>About: </label>
                        <textarea class="form-control" id="summernote" name="book_about">{{$book->about}}</textarea>
                        <small class="form-text text-muted">Knygos aprašymas</small>
                        </div>
                        <div class="form-group">
                        <select class="form-control" name="author_id">
                            @foreach ($authors as $author)
                            <option value="{{$author->id}}" @if($author->id == $book->author_id) selected @endif>
                                {{$author->name}} {{$author->surname}}
                            </option>
                            @endforeach
                        </select>
                        </div>
                        @csrf
                        <button class="btn btn-outline-secondary btn-sm" type="submit">EDIT</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
   $('#summernote').summernote();
 });
</script>
@endsection
