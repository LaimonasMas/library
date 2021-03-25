@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Books list</div>

                <div class="card-body">
                    @foreach ($books as $key => $book)
                    <li class="list-group-item list-line">
                        <div>
                            <h5>{{$book->title}}</h5>
                            {{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}
                        </div>
<div class="list-line__buttons">
                        <div class="form-group">
                            <a class="btn btn-outline-secondary btn-sm" href="{{route('book.edit',[$book])}}">EDIT</a>
                        </div>
                        <form method="POST" action="{{route('book.destroy', [$book])}}">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm" type="submit">DELETE</button>
                        </form>
                        <div class="list-line__buttons">
                        </li>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
