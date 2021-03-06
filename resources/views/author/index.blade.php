@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Authors List</h2>
                    <a class="a-padding-right" href="{{route('author.index', ['sort' => 'name'])}}">Sort by name</a>
                    <a class="a-padding-right" href="{{route('author.index', ['sort' => 'surname'])}}">Sort by surname</a>
                    <a class="a-padding-right" href="{{route('author.index')}}">Default</a>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($authors as $author)
                        <li class="list-group-item list-line">
                            <div class="list-line__books">
                                <div class="list-line__books__title">
                                <img src="{{$author->portret}}"> {{$author->name}} {{$author->surname}}</div>
                            </div>
                            <div class="list-line__buttons">
                                <a href="{{route('author.edit',[$author])}}" class="btn btn-outline-secondary btn-sm">EDIT</a>
                                <form method="POST" action="{{route('author.destroy', [$author])}}">
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
