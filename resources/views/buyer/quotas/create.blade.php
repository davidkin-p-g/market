@extends('layouts.app')

@section('content')

    <div class="container">

        <hr />

        <form class="form-horizontal" action="{{route('quotas.store')}}" method="post">
            {{ csrf_field() }}

            <input type="text" class="form-control" name="Buyer"  value="{{$user = auth()->user()->name}}" readonly>
            <label for="">Наименование</label>
            <input type="text" class="form-control" name="Name" placeholder="Название Квоты" value="" required>

            <label for="">Текст</label>
            <input class="form-control" type="text" name="Text" placeholder="Описание квоты" value="">


            <hr />

            <input class="btn btn-primary" type="submit" value="Сохранить">

        </form>
    </div>

@endsection
