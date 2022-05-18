@extends('layouts.app')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb default-color">
                <li class="breadcrumb-item active" aria-current="page"><a href="/">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('quotas.index')}}">Квоты</a></li>
                <li class="breadcrumb-item" aria-current="page"> Просмотр Квоты</li>
            </ol>
        </nav>
        <h4>{{$quotas->Name}}</h4>
        <br>
        <h5>Описание:</h5>
        <h5>{{$quotas->Text}}</h5>
        <h5>{{$quotas->QRealizationDate}}</h5>
        <br>
        <hr />
        <h4 class="mb-3">Номенклатура</h4>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($items as $item)
                <div class="col">
                        <div class="card text-center shadow-sm">
                            <div class="card-header py-3 text-white bg-secondary border-secondary">
                                <h4 class="my-0 fw-normal">{{$item->ItemName}}</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{$item->Categories}}</p>
                                <hr>
                                <p class="card-text">Стоимость:{{$item->ItemCost}}руб./ Колличество: {{$item->ItemCount}} шт. </p>
                                <hr>
                                <p class="card-text">Заполненость/ В разработке</p>
                                <hr>
                                @if(isset($item->ItemText))
                                    <p class="card-text">{{$item->ItemText}}</p>
                                @else
                                    <p class="card-text">---</p>
                                @endif
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <ul class="list-group list-group-flush">
                                        <ul class="list-group list-group-flush">
                                            @if ($user = auth()->user()->Roles == 'Поставщик')
                                                <li class="list-group-item">
                                                    <a href="{{route('offers.create_seller', ['id' =>$item->id, 'IdCategories' => $item->IdCategories])}}" type="button" class="btn btn-sm btn-outline-secondary">
                                                        Предложить
                                                    </a>
                                                </li>
                                            @endif
                                            <li class="list-group-item">
                                                <a href="{{route('offers.item', ['item_id'=> $item->id])}}" type="button" class="btn btn-sm btn-outline-secondary">
                                                    Предложениия
                                                    <span class="badge bg-secondary rounded-pill">{{$item->offers_count}}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>

@endsection
