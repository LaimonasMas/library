@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">AUTORIAI</div>

                <div class="card-body">
                    @foreach ($authors as $key => $author)
                    <h3>{{$key+1}}. {{$author->name}} {{$author->surname}}</h3>
                    <div class="form-group">
                        <a href="{{route('author.edit',[$author])}}">
                            <button type="button" class="btn btn-outline-secondary btn-sm">EDIT</button>
                        </a>
                    </div>
                    <form method="POST" action="{{route('author.destroy', [$author])}}">
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
