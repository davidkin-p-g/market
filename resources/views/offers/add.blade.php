@extends('layouts.app')
<style>

    body{margin-top:20px;}

    .chat-online {
        color: #34ce57
    }

    .chat-offline {
        color: #e4606d
    }

    .chat-messages {
        display: flex;
        flex-direction: column;
        max-height: 800px;
        overflow-y: scroll
    }

    .chat-message-left,
    .chat-message-right {
        display: flex;
        flex-shrink: 0
    }

    .chat-message-left {
        margin-right: auto
    }

    .chat-message-right {
        flex-direction: row-reverse;
        margin-left: auto
    }
    .py-3 {
        padding-top: 1rem!important;
        padding-bottom: 1rem!important;
    }
    .px-4 {
        padding-right: 1.5rem!important;
        padding-left: 1.5rem!important;
    }
    .flex-grow-0 {
        flex-grow: 0!important;
    }
    .border-top {
        border-top: 1px solid #dee2e6!important;
    }
</style>
@section('content')
    <div class="container py-3">
        <div class="row row-cols-1 row-cols-md-2 mb-3 text-center">
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Запрошено по квоте</h4>
                        <h4 class="my-0 fw-normal">Покупатель - {{$quota->Buyer}}</h4>
                        <h4 class="my-0 fw-normal" >Квота - {{$quota->Name}}</h4>
                        <h4 class="my-0 fw-normal">Дата реализации - {{$quota->QRealizationDate}}</h4>
                    </div>
                    <div class="card-body">


                            <h5>Оборудование - {{$item->ItemName}}</h5>
                            <h5>Категория - {{$item->quotas_item_categoties_name->first()->Categories}}</h5>
                            <h5>Примерная стоимость - {{$item->ItemCost}} р.</h5>
                            <h5>Необходимое количество - {{$item->ItemCount}} шт.</h5>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Предлагается продавцом</h4>
                        <h4 class="my-0 fw-normal">Продавец - {{$product->SellerName}}</h4>
                    </div>
                    <div class="card-body">


                            <h5>Оборудование - {{$product->ProdName}}</h5>
                            <h5>Категория - {{$product->products_categoties_name->first()->Categories}}</h5>
                            <h5>Примерная стоимость - {{$product->ProdCost}} р.</h5>
                            <h5>Необходимое количество - {{$product->ProdCount}} шт.</h5>

                    </div>
                </div>
            </div>
        </div>
        <div class="container py-3">
            <div class="row row-cols-1 row-cols-md-2 mb-3 text-left">
                <div class="col">
                    @if($user = auth()->user()->Roles == 'Покупатель')
                        <div>
                            <h3>Предлагает поставщик</h3>
                            <br>
                            @if(isset($offer))
                            <label for="">Количество оборудования</label>
                            <input type="text" class="form-control" name="OfferSellerCount" placeholder="Ничего не предложено" value="{{$offer->OfferSellerCount}}" readonly>

                            <label for="">Стоимость оборудования</label>
                            <input class="form-control" type="text" name="OfferSellerCost" placeholder="Ничего не предложено" value="{{$offer->OfferSellerCost}}" readonly>
                            <br>
                            @else
                                <label for="">Количество оборудования</label>
                                <input type="text" class="form-control" name="OfferSellerCount" placeholder="Ничего не предложено" value="" readonly>

                                <label for="">Стоимость оборудования</label>
                                <input class="form-control" type="text" name="OfferSellerCost" placeholder="Ничего не предложено" value="" readonly>
                                <br>
                            @endif
                        </div>
                    @endif
                    @if($user = auth()->user()->Roles == 'Поставщик')
                        <div>
                            <h3>Предложить покупателю</h3>
                            <br>
                        </div>
                        @if(isset($offer))
                            <form class="form-horizontal" action="{{route('offers.update', ['offer_id' => $offer->id])}}" method="post">
                                {{ csrf_field() }}

                                <label for="">Количество оборудования</label>
                                <input type="text" class="form-control" name="OfferSellerCount" placeholder="Количество оборудования" value="{{$offer->OfferSellerCount}}" required>

                                <label for="">Стоимость оборудования</label>
                                <input class="form-control" type="text" name="OfferSellerCost" placeholder="Стоимость оборудования" value="{{$offer->OfferSellerCost}}" required>

                                @if($offer->OfferBuyerCount == $offer->OfferSellerCount && $offer->OfferBuyerCost == $offer->OfferSellerCost)
                                    @if($offer->SellerPublished == 1)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="SellerPublished" checked >
                                        <label class="form-check-label">
                                            Согласовано
                                        </label>
                                    </div>
                                @else
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="SellerPublished"  >
                                        <label class="form-check-label">
                                            Согласовано
                                        </label>
                                    </div>
                                @endif
                                @endif
                                <br>
                                <input class="btn btn-primary" type="submit" value="Предложить">

                            </form>
                            @else
                                <form class="form-horizontal" action="{{route('offers.store', ['item' => $item, 'product' => $product])}}" method="post">
                                    {{ csrf_field() }}

                                    <label for="">Количество оборудования</label>
                                    <input type="text" class="form-control" name="OfferSellerCount" placeholder="Количество оборудования" value="" required>

                                    <label for="">Стоимость оборудования</label>
                                    <input class="form-control" type="text" name="OfferSellerCost" placeholder="Стоимость оборудования" value="" required>
                                    <br>
                                    <input class="btn btn-primary" type="submit" value="Предложить">

                                </form>
                            @endif
                    @endif

                </div>

                <div class="col">
                    @if($user = auth()->user()->Roles == 'Покупатель')
                        <div>
                            <h3>Предложить поставщику</h3>
                            <br>
                            @if(isset($offer))
                            <form class="form-horizontal" action="{{route('offers.update', ['offer_id' => $offer->id])}}" method="post">
                                {{ csrf_field() }}

                                <label for="">Количество оборудования</label>
                                <input type="text" class="form-control" name="OfferBuyerCount" placeholder="Количество оборудования" value="{{$offer->OfferBuyerCount}}" required>

                                <label for="">Стоимость оборудования</label>
                                <input class="form-control" type="text" name="OfferBuyerCost" placeholder="Стоимость оборудования" value="{{$offer->OfferBuyerCost}}" required>
                                @if($offer->OfferBuyerCount == $offer->OfferSellerCount && $offer->OfferBuyerCost == $offer->OfferSellerCost)
                                    @if($offer->BuyerPublished == 1)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="BuyerPublished" checked >
                                            <label class="form-check-label">
                                                Согласовано
                                            </label>
                                        </div>
                                    @else
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="BuyerPublished"  >
                                            <label class="form-check-label">
                                                Согласовано
                                            </label>
                                        </div>
                                    @endif
                                @endif

                                <br>
                                <input class="btn btn-primary" type="submit" value="Предложить">

                            </form>
                            @else
                                <form class="form-horizontal" action="{{route('offers.store', ['item' => $item, 'product' => $product])}}" method="post">
                                    {{ csrf_field() }}

                                    <label for="">Количество оборудования</label>
                                    <input type="text" class="form-control" name="OfferBuyerCount" placeholder="Количество оборудования" value="" required>

                                    <label for="">Стоимость оборудования</label>
                                    <input class="form-control" type="text" name="OfferBuyerCost" placeholder="Стоимость оборудования" value="" required>
                                    <br>
                                    <input class="btn btn-primary" type="submit" value="Предложить">

                                </form>
                            @endif

                        </div>
                    @endif
                    @if($user = auth()->user()->Roles == 'Поставщик')
                        <div>
                            <h3>Предлагает покупатель</h3>
                            <br>
                            @if(isset($offer))
                            <label for="">Количество оборудования</label>
                            <input type="text" class="form-control" name="OfferSellerCount" placeholder="Ничего не предложено" value="{{$offer->OfferBuyerCount}}" readonly>

                            <label for="">Стоимость оборудования</label>
                            <input class="form-control" type="text" name="OfferSellerCost" placeholder="Ничего не предложено" value="{{$offer->OfferBuyerCost}}" readonly>
                            @else
                                <label for="">Количество оборудования</label>
                                <input type="text" class="form-control" name="OfferSellerCount" placeholder="Ничего не предложено" value="" readonly>

                                <label for="">Стоимость оборудования</label>
                                <input class="form-control" type="text" name="OfferSellerCost" placeholder="Ничего не предложено" value="" readonly>
                            @endif
                                <br>
                            <br>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>


@if(isset($offer))
    <main class="content">
        <div class="container p-0">
            <h1 class="h3 mb-3">Чат</h1>
            <div class="card">
                <div class="row g-0">
                    <div class="col-12 col-lg-7 col-xl-12">
                        <div class="position-relative">
                            <div class="chat-messages p-4">
                                @forelse($chats as $chat)
                                    @if($user = auth()->user()->id == $chat->UserId)
                                    <div class="chat-message-right pb-4">
                                        <div>
                                            <div class="text-muted small text-nowrap mt-2">{{$chat->name}}</div>
                                            <div class="text-muted small text-nowrap mt-2">{{$chat->created_at}}</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1"></div>
                                            {{$chat->ChatText}}
                                        </div>
                                    </div>
                                    @else
                                        <div class="chat-message-left pb-4">
                                            <div>
                                                <div class="text-muted small text-nowrap mt-2">{{$chat->name}}</div>
                                                <div class="text-muted small text-nowrap mt-2">{{$chat->created_at}}</div>
                                            </div>
                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                <div class="font-weight-bold mb-1"></div>
                                                {{$chat->ChatText}}
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <h3 class="text-center">Нет сообщений</h3>
                                @endforelse
                            </div>
                        </div>
                        <div class="flex-grow-0 py-3 px-4 border-top">
                            <form class="input-group" action="{{route('offers.storechat', ['offer_id' => $offer->id])}}" method="post">
                                {{ csrf_field() }}

                                <input type="text" class="form-control" name="ChatText" placeholder="Ввести сообщение">
                                <input class="btn btn-primary" type="submit" value="Отправить">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endif
@endsection

