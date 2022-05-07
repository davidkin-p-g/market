@extends('layouts.app')

@section('content')

    <div class="container">

        <hr />

        <form class="form-horizontal" action="{{route('quotas.update', ['quota'=>$quotas->id]) }}" method="post">
            {{ method_field('put') }}
            {{ csrf_field() }}
            <input type="text" class="form-control" name="Buyer"  value="{{$user = auth()->user()->name}}" readonly>
            <label for="">Наименование</label>
            <input type="text" class="form-control" name="Name" placeholder="Название Квоты" value="{{$quotas->Name}}" required>

            <label for="">Текст</label>
            <input class="form-control" type="text" name="Text" placeholder="Описание квоты" value="{{$quotas->Text}}">


            <hr />
{{--            <label for="">че нить из итема</label>--}}
{{--            <input class="form-control" type="text" name="" placeholder="Описание квоты" value="{{$items}}">--}}
            <input class="btn btn-primary" type="submit" value="Сохранить">

        </form>
    </div>

@endsection
