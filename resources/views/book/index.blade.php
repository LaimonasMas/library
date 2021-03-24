@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">KNYGOS</div>

                <div class="card-body">
                    @foreach ($books as $key => $book)
                    <h3>{{$book->title}}</h3>
                    <h4>{{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}</h4>                    
                    <div class="form-group">
                    <a href="{{route('book.edit',[$book])}}">
                        <button type="button" class="btn btn-outline-secondary btn-sm">EDIT</button>
                    </a>
                    </div>             
                    <form method="POST" action="{{route('book.destroy', [$book])}}">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm" type="submit">DELETE</button>
                    </form>             
                    <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
