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
            @if (isset($quotas->QPublished))
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="QPublished" checked >
                <label class="form-check-label">
                    Опубликовать
                </label>
            </div>
            @else
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="QPublished"  >
                    <label class="form-check-label">
                        Опубликовать
                    </label>
                </div>
            @endif
            <br>
            <input class="btn btn-primary" type="submit" value="Сохранить">
        </form>
            <hr />
            <label for="">че нить из итема</label>
            <hr />
            @if($items != '[]')
            <table class="table table-striped">
                <thead>
                <th>Наименование оборудования</th>
                <th>Стоимость оборудования</th>
                <th>Колличество оборудования</th>
                <th class="text-right">Действие</th>
                </thead>
                <tbody>
                @endif
            @foreach ($items as $item)
                        <tr>
                            <td>{{$item->ItemName}}</td>
                            <td>{{$item->ItemCost}}</td>
                            <td>{{$item->ItemCount}}</td>
                            <td>

                                <form onsubmit="if(confirm('Удалить?')){return true} else {return false}" action="{{route('quotas.destroyitem', ['item_id'=>$item->id, 'quotas_id'=>$quotas->id])}}" method="post">
{{--                                    {{ method_field('delete') }}--}}
                                    {{ csrf_field() }}
                                    <a href="{{route('quotas.edititem', ['item_id'=>$item->id, 'quotas_id'=>$quotas->id])}}"><i class="fa fa-edit"></i></a>
                                    <button type="submit" class="btn"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
            @endforeach
                </tbody>
            </table>
            <hr />
        <form class="form-horizontal" action="{{route('quotas.additem')}}" method="post">
            {{ csrf_field() }}
            <label for="">Наименование</label>
            <input type="text" class="form-control" name="ItemName" placeholder="Название оборудования" value="" >

            <label for="">Стоимость</label>
            <input class="form-control" type="text" name="ItemCost" placeholder="Стоимость оборудования" value="">

            <label for="">Колличество</label>
            <input class="form-control" type="text" name="ItemCount" placeholder="Цена оборудования" value="">

            <input type="text" class="form-control" name="quotasId"  value="{{$quotas->id}}" hidden>
            <hr />

            <input class="btn btn-primary" type="submit" value="Добавить">

        </form>
    </div>

@endsection
