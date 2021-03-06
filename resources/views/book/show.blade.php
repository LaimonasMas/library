@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Book: {{$book->title}}</div>

                <div class="card-body">
                    {{$book->about}}
                    {{-- {!!$book->about!!} cia labai pavojingas rasymas, bet viska graziai atvaizduoja   --}}
                    <div class="form-group">
                        <a class="btn btn-outline-secondary btn-sm" href="{{route('book.edit',[$book])}}">EDIT BOOK</a>
                        <a class="btn btn-outline-secondary btn-sm" href="{{route('author.edit',[$book->bookAuthor])}}">EDIT AUTHOR</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
