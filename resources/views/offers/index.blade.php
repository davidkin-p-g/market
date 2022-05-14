@extends('layouts.app')

@section('content')

    <div class="container">
        <hr>
        <table class="table table-striped">
            <thead>
            <th>#</th>
            <th>Квота</th>
            <th>Пользователь</th>
            <th>Категория</th>
            <th>Оборудование</th>
            <th>Срок реализации</th>
            <th>Предполагаемая цена</th>
            <th>Предложеная цена</th>
            <th>Имеющееся количество</th>
            <th>Предложеное количество</th>
            <th>Согласовано</th>
            <th>Действия</th>
            </thead>
            <tbody>
            @forelse ($offers as $offer)
                <tr>
                <td>Покупатель</td>
                <td rowspan="2">{{$offer->QuotasName}}</td>
                <td>{{$offer->Buyer}}</td>
                <td>{{$offer->ItemCategories}}</td>
                <td>{{$offer->ItemName}}</td>
                @if(isset($offer->QRealizationDate))
                    <td rowspan="2">{{$offer->QRealizationDate}}</td>
                @else
                    <td rowspan="2">Неограничено</td>
                @endif
                <td>{{$offer->ItemCost}} руб.</td>
                @if($offer->OfferBuyerCost)
                <td>{{$offer->OfferBuyerCost}} руб.</td>
                @else
                    <td>---</td>
                @endif
                <td>{{$offer->ItemCount}} шт.</td>
                @if($offer->OfferBuyerCount)
                    <td>{{$offer->OfferBuyerCount}} шт.</td>
                @else
                    <td>---</td>
                @endif
                @if(isset($offer->PublishedDate))
                        <td rowspan="2">{{$offer->PublishedDate}}</td>
                @else
                    @if($offer->BuyerPublished)
                            <td>Да</td>
                    @else
                        <td>Нет</td>
                    @endif
                @endif
                <td rowspan="2">
                    @if(isset($offer->PublishedDate))
                        <a><i class="fa fa-edit" aria-hidden="true"></i></a>
                        <a href="{{route('offers.edit', ['offer_id'=> $offer->id])}}"><i class="fa fa-eye" aria-hidden="true">Посмотреть документы</i></a>
                    @else
                        <a href="{{route('offers.edit', ['offer_id'=> $offer->id])}}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        <a href="{{route('offers.edit', ['offer_id'=> $offer->id])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    @endif
                </td>

                </tr>
                <tr>
                <td>Поставщик</td>
                <td>{{$offer->SellerName}}</td>
                <td>{{$offer->ProdCategories}}</td>
                <td>{{$offer->ProdName}}</td>
                <td>{{$offer->ProdCost}} руб.</td>
                @if($offer->OfferSellerCost)
                    <td>{{$offer->OfferSellerCost}} руб.</td>
                @else
                    <td>---</td>
                @endif
                <td>{{$offer->ProdCount}} шт.</td>
                @if($offer->OfferSellerCount)
                    <td>{{$offer->OfferSellerCount}} шт.</td>
                @else
                    <td>---</td>
                @endif
                @if(isset($offer->PublishedDate))
                    <td></td>
                @else
                    @if($offer->SellerPublished)
                        <td>Да</td>
                    @else
                        <td>Нет</td>
                    @endif
                @endif
                <td></td>
                </tr>
            @empty
                <tr>
                        <td colspan="11" class="text-center"><h2>Нет предложений</h2></td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection

