@extends('layouts.app')

@section('content')
<div class="container">
    @include('errors')
    <form action="{{route('factory')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="count"><h3>Введите количество записей для посева в базу данных</h3></label>
            <input  name="count" type="text" class="form-control" id="count">
        </div>

        <button type="submit" class="btn btn-primary">Сгенерировать</button>
        <button onclick="location.href='{{route('refresh')}}'" type="button" class="btn btn-success ml-5 ">Удалить все записи</button>
    </form>
    <hr>
    <div class="mt-5">
        <div id="app" ></div>
    </div>
</div>
@endsection
