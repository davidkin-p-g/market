@extends('layouts.app')

@section('content')

    <div class="container">
        <hr />
            <h4>{{$quotas->Name}}</h4>
            <h5>{{$quotas->Text}}</h5>
            <h5>{{$quotas->QRealizationDate}}</h5>
            <br>
            <hr />
            <table class="table table-striped">
                <thead>
                <th>Категория</th>
                <th>Наименование</th>
                <th>Стоимость</th>
                <th>Колличество</th>
                <th>Описание</th>
                <th>Действие</th>
                </thead>
                <tbody>
                @foreach ($items as $item)
                        <tr>
                            <td>{{$item->Categories}}</td>
                            <td>{{$item->ItemName}}</td>
                            <td>{{$item->ItemCost}}</td>
                            <td>{{$item->ItemCount}}</td>
                            <td>
                                @if(isset($item->ItemText))
                                    {{$item->ItemText}}
                                @else
                                    ---
                                @endif
                            </td>
                            <td>
{{--                                <a href="{{route('quotas.showitem', ['quota_id' => 1, 'item_id' => 1])}}"><i class="fa fa-eye"></i></a>--}}
                                <a href="{{route('offers.create_seller', ['id' =>$item->id, 'IdCategories' => $item->IdCategories])}}"><i class="fa fa-plus"></i></a>
                                <a href="{{route('offers.item', ['item_id'=> $item->id])}}" >[{{$item->offers_count}}]</a>
                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
            <hr />
    </div>

@endsection
