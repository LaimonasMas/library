@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">AUTORIUS</div>

                <div class="card-body">
                    <form method="POST" action="{{route('author.update',[$author->id])}}">
                        <div class="form-group">
                            <label>Name: </label>
                            <input type="text" class="form-control" name="author_name" value="{{$author->name}}">
                            <small class="form-text text-muted">Autoriaus vardas</small>
                        </div>
                        <div class="form-group">
                            <label>Surname: </label>
                            <input type="text" class="form-control" name="author_surname" value="{{$author->surname}}">
                            <small class="form-text text-muted">Autoriaus pavardė</small>
                        </div>
                        @csrf
                        <button class="btn btn-outline-secondary btn-sm" type="submit">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
