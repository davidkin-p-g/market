@extends('layouts.app')

@section('content')

    <div class="container">
        <hr />

        <form class="form-horizontal" action="{{route('category.store')}}" method="post">
            {{ csrf_field() }}

            <label for="">Статус</label>
            <select class="form-control" name="Published">
                    <option value="0">Не опубликовано</option>
                    <option value="1">Опубликовано</option>
            </select>

            <label for="">Категория</label>
            <input type="text" class="form-control" name="Categories" placeholder="Категория" value="" required>

            <label for="">Родительская категория</label>
            <select class="form-control" name="IdParent">
                <option value="0">-- без родительской категории --</option>
                @include('admin.category.categories', ['categories' => $categories])
            </select>

            <hr />

            <input class="btn btn-primary" type="submit" value="Сохранить">

        </form>
    </div>

@endsection
