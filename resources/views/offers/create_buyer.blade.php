@extends('layouts.app')

@section('content')

    <div class="container">

        <hr />
            <h5>Квота</h5>
            <label for="">Наименование</label>
            <h4>{{$quota->Name}}</h4>
            <h4>{{$quota->Text}}</h4>
            <h4>{{$quota->QRealizationDate}}</h4>
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
                            <td>{{$item->quotas_item_categoties_name->first()->Categories}}</td>
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
                                <a href="{{route('offers.add_buyer', ['id'=> $id,'dop_id'=> $item->id ])}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
            <hr />
    </div>

@endsection
