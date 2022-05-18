@extends('layouts.app')

@section('content')

    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb default-color">
                <li class="breadcrumb-item active" aria-current="page"><a href="/">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('quotas.index')}}">Квоты</a></li>
                <li class="breadcrumb-item" aria-current="page">Создание квоты</li>
            </ol>
        </nav>

        <div class="row justify-content-md-center">
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Квота</h4>
                <form class="form-horizontal" action="{{route('quotas.store')}}" method="post">
                    {{ csrf_field() }}
                    <input  name="BuyerId"  value="{{$user = auth()->user()->id}}" hidden>
                    <input  name="Buyer"  value="{{$user = auth()->user()->name}}" hidden>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="Name" class="form-label">Наименование</label>
                            <input type="text" class="form-control" name="Name" placeholder="Название Квоты" value="" required>

                            <label for="Text">Описание</label>
                            <textarea class="form-control" name="Text" placeholder="Описание квоты" rows="3"></textarea>

                            <label for="QRealizationDate">Срок реализации</label>
                            <input type="date" class="form-control" name="QRealizationDate" placeholder="Срок реализации" value="">
                            <br>
                            <input class="btn btn-primary" type="submit" value="Сохранить">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
