@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb default-color">
                <li class="breadcrumb-item active" aria-current="page"><a href="/">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('products.index')}}">Оборудование</a></li>
                <li class="breadcrumb-item" aria-current="page">Выбор квоты</li>
            </ol>
        </nav>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($quotas as $quota)
                @if(isset($quota->QPublished))
                    <div class="col">
                        <div class="card text-center shadow-sm">
                            <div class="card-header py-3 text-white bg-secondary border-secondary">
                                <h4 class="my-0 fw-normal">{{$quota->Name}}</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{$quota->Buyer}}</p>
                                <hr>
                                @if(isset($quota->Text))
                                    <p class="card-text">{{$quota->Text}}</p>
                                @else
                                    <p class="card-text">---</p>
                                @endif
                                <hr>
                                <p class="card-text">Заполненость/ В разработке</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <a href="{{route('offers.create_buyer', ['id'=>$id, 'quota_id'=> $quota->id])}}" type="button" class="btn btn-sm btn-outline-secondary">
                                                Открыть
                                            </a>
                                        </li>
                                    </ul>
                                    <small class="text-muted">
                                        Срок реализации:
                                        <br>
                                        @if (isset($quota->QRealizationDate))
                                            {{$quota->QRealizationDate}}
                                        @else
                                            Неограничено
                                        @endif
                                        <hr>
                                        Дата публикации:
                                        <br>
                                        {{$quota->QPublishedDate}}
                                    </small>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection



