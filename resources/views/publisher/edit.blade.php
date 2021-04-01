@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit publisher</div>

                <div class="card-body">
                    <form method="POST" action="{{route('publisher.update',[$publisher->id])}}">
                        <div class="form-group">
                            <label>Name: </label>
                            <input type="text" class="form-control" name="publisher_name" value="{{old('publisher_name',$publisher->name)}}">
                            <small class="form-text text-muted">Please enter publisher name</small>
                        </div>
                        <div class="form-group">
                            <label>Surname: </label>
                            <input type="text" class="form-control" name="publisher_surname" value="{{old('publisher_surname',$publisher->surname)}}">
                            <small class="form-text text-muted">Please enter publisher surname</small>
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
