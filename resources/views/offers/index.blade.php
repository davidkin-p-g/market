@extends('layouts.app')
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb default-color">
                <li class="breadcrumb-item active" aria-current="page"><a href="/">Главная</a></li>
                <li class="breadcrumb-item" aria-current="page">Предложения</li>
            </ol>
        </nav>

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-notpub-tab" data-bs-toggle="tab" data-bs-target="#nav-notpub" type="button" role="tab" aria-controls="nav-notpub" aria-selected="true">Несогласованые</button>
                <button class="nav-link" id="nav-pub-tab" data-bs-toggle="tab" data-bs-target="#nav-pub" type="button" role="tab" aria-controls="nav-pub" aria-selected="false">Согласованые</button>
                <button class="nav-link" id="nav-hist-tab" data-bs-toggle="tab" data-bs-target="#nav-hist" type="button" role="tab" aria-controls="nav-hist" aria-selected="false">История</button>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane" id="nav-pub" role="tabpanel" aria-labelledby="nav-pub-tab">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3">
                    @foreach($offers as $offer)
                        @if(isset($offer->PublishedDate))
                            <div class="col">
                                <div class="card text-center shadow-sm ">
                                    <div class="card-header py-3 text-white bg-secondary border-secondary">
                                        <h4 class="my-0 fw-normal">{{$offer->QuotasName}}</h4>
                                    </div>
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 gx-lg-0">
                                        <div class="card text-center shadow-sm">
                                            <div class="card-header py-3 text-white bg-secondary border-secondary">
                                                <h4 class="my-0 fw-normal">{{$offer->Buyer}}</h4>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">Категория: {{$offer->ItemCategories}}</p>
                                                <hr>
                                                <p class="card-text">Оборудование: {{$offer->ItemName}}</p>
                                                <hr>
                                                <p class="card-text">
                                                    Цена: {{$offer->ItemCost}} руб. /
                                                    @if($offer->OfferBuyerCost)
                                                        {{$offer->OfferBuyerCost}} руб.
                                                    @else
                                                        ---
                                                    @endif
                                                </p>
                                                <hr>
                                                <p class="card-text">
                                                    Колличество: {{$offer->ItemCount}} шт. /
                                                    @if($offer->OfferBuyerCount)
                                                        {{$offer->OfferBuyerCount}} шт.
                                                    @else
                                                        ---
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="card text-center shadow-sm ">
                                            <div class="card-header py-3 text-white bg-secondary border-secondary">
                                                <h4 class="my-0 fw-normal">{{$offer->SellerName}}</h4>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">Категория: {{$offer->ProdCategories}}</p>
                                                <hr>
                                                <p class="card-text">Оборудование: {{$offer->ProdName}}</p>
                                                <hr>
                                                <p class="card-text">
                                                    Цена: {{$offer->ProdCost}} руб. /
                                                    @if($offer->OfferSellerCost)
                                                        {{$offer->OfferSellerCost}} руб.
                                                    @else
                                                        ---
                                                    @endif
                                                </p>
                                                <hr>
                                                <p class="card-text">
                                                    Колличество: {{$offer->ProdCount}} шт. /
                                                    @if($offer->OfferSellerCount)
                                                        {{$offer->OfferSellerCount}} шт.
                                                    @else
                                                        ---
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-flex justify-content-around align-items-center">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <a href="{{route('offers.dogovor', ['offer_id'=> $offer->id])}}" type="button" class="btn btn-sm btn-outline-secondary">
                                                    Договор
                                                </a>
                                            </li>
                                        </ul>
                                        <small class="text-muted ">
                                            Срок реализации:
                                            <br>
                                            @if(isset($offer->QRealizationDate))
                                                {{$offer->QRealizationDate}}
                                            @else
                                                Неограничено
                                            @endif
                                            <hr>
                                            Дата согласования:
                                            <br>
                                            {{$offer->PublishedDate}}
                                        </small>

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade fade show active" id="nav-notpub" role="tabpanel" aria-labelledby="nav-notpub-tab">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3">
                    @foreach($offers as $offer)
                        @if(!isset($offer->PublishedDate))
                            <div class="col">
                                <div class="card text-center shadow-sm ">
                                    <div class="card-header py-3 text-white bg-secondary border-secondary">
                                        <h4 class="my-0 fw-normal">{{$offer->QuotasName}}</h4>
                                    </div>
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 gx-lg-0">
                                        <div class="card text-center shadow-sm">
                                            <div class="card-header py-3 text-white bg-secondary border-secondary">
                                                <h4 class="my-0 fw-normal">{{$offer->Buyer}}</h4>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">Категория: {{$offer->ItemCategories}}</p>
                                                <hr>
                                                <p class="card-text">Оборудование: {{$offer->ItemName}}</p>
                                                <hr>
                                                <p class="card-text">
                                                    Цена: {{$offer->ItemCost}} руб. /
                                                    @if($offer->OfferBuyerCost)
                                                        {{$offer->OfferBuyerCost}} руб.
                                                    @else
                                                        ---
                                                    @endif
                                                </p>
                                                <hr>
                                                <p class="card-text">
                                                    Колличество: {{$offer->ItemCount}} шт. /
                                                    @if($offer->OfferBuyerCount)
                                                        {{$offer->OfferBuyerCount}} шт.
                                                    @else
                                                        ---
                                                    @endif
                                                </p>
                                                <hr>
                                                <p>
                                                @if($offer->BuyerPublished)
                                                    Согласовано
                                                @else
                                                    Несогласовано
                                                @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="card text-center shadow-sm ">
                                            <div class="card-header py-3 text-white bg-secondary border-secondary">
                                                <h4 class="my-0 fw-normal">{{$offer->SellerName}}</h4>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">Категория: {{$offer->ProdCategories}}</p>
                                                <hr>
                                                <p class="card-text">Оборудование: {{$offer->ProdName}}</p>
                                                <hr>
                                                <p class="card-text">
                                                    Цена: {{$offer->ProdCost}} руб. /
                                                    @if($offer->OfferSellerCost)
                                                        {{$offer->OfferSellerCost}} руб.
                                                    @else
                                                        ---
                                                    @endif
                                                </p>
                                                <hr>
                                                <p class="card-text">
                                                    Колличество: {{$offer->ProdCount}} шт. /
                                                    @if($offer->OfferSellerCount)
                                                        {{$offer->OfferSellerCount}} шт.
                                                    @else
                                                        ---
                                                    @endif
                                                </p>
                                                <hr>
                                                <p>
                                                    @if($offer->SellerPublished)
                                                        Согласовано
                                                    @else
                                                        Несогласовано
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-flex justify-content-around align-items-center">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <a href="{{route('offers.edit', ['offer_id'=> $offer->id])}}" type="button" class="btn btn-sm btn-outline-secondary">
                                                    Изменить
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <form onsubmit="if(confirm('Удалить?')){return true} else {return false}" action="{{route('offers.destroy', ['offer_id'=> $offer->id]) }}" method="post">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                        Удалить
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                        <small class="text-muted ">
                                            Срок реализации:
                                            <br>
                                            @if(isset($offer->QRealizationDate))
                                                {{$offer->QRealizationDate}}
                                            @else
                                                Неограничено
                                            @endif
                                        </small>

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="nav-hist" role="tabpanel" aria-labelledby="nav-hist-tab">
                В разработке
            </div>
        </div>
    </div>

@endsection

