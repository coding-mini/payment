@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row text-center">
            @foreach($books as $book)
                <div class="col-3" style="margin-bottom: 50px">
                    <img src="{{ $book->poster }}" alt="" width="200" height="300" class="img-thumbnail">
                    <h3 style="font-size: 16px;margin-top: 20px"> {{ $book->name }} </h3>
                    <a href="{{ url('buy/'.$book->id) }}" class="btn btn-danger">购买</a>
                </div>
            @endforeach
        </div>
    </div>
@stop