@extends('layouts.app')

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
@endsection

