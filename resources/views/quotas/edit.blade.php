@extends('layouts.app')

@section('content')

    <div class="container">

        <hr />

        <form class="form-horizontal" action="{{route('quotas.update', ['quota_id'=>$quotas->id]) }}" method="post">
            {{ method_field('put') }}
            {{ csrf_field() }}
            <h5>Квота</h5>
            <label for="">Наименование</label>
            <input type="text" class="form-control" name="Name" placeholder="Название Квоты" value="{{$quotas->Name}}" required>

            <label for="">Описание</label>
            <input class="form-control" type="text" name="Text" placeholder="Описание квоты" value="{{$quotas->Text}}">

            <label for="">Срок реализации</label>
            <input type="date" class="form-control" name="QRealizationDate" placeholder="Срок реализации" value="{{$quotas->QRealizationDate}}" >
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

            <hr />
        </form>
            @if(isset($items))
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
                @endif
            @foreach ($items as $item)
                @if(isset($item_id) && $item->id == $item_id)
                    <tr>
                        <td colspan="6" class="text-center">
                            <form action="{{route('quotas.updateitem', ['item_id'=>$item->id, 'quota_id'=>$quotas->id]) }}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <select class="form-control" name="IdCategories">
                                        @foreach($categories as $category)
                                            @if ($category->id == $item->IdCategories)
                                                <option value="{{$category->id}}" selected >
                                                    {{$category->Categories}}
                                                </option>
                                            @else
                                                <option value="{{$category->id}}" >
                                                {{$category->Categories}}
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" class="form-control" name="ItemName" placeholder="Название оборудования" value="{{$item->ItemName}}" required >
                                <input type="text" class="form-control" name="ItemCost" placeholder="Стоимость оборудования" value="{{$item->ItemCost}}" required >
                                <input type="text" class="form-control" name="ItemCount" placeholder="Количество оборудования" value="{{$item->ItemCount}}"  required>
                                <input type="text" class="form-control" name="ItemText" placeholder="Описание оборудования" value="{{$item->ItemText}}"  >
                                <input class="btn btn-primary" type="submit" value="Сохранить">
                            </form>
                        </td>
                    </tr>
                @else
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
                        <form onsubmit="if(confirm('Удалить?')){return true} else {return false}" action="{{route('quotas.destroyitem', ['item_id'=>$item->id, 'quota_id'=>$item->QuotasId])}}" method="post">
                            {{ csrf_field() }}
                            <a href="{{route('quotas.edititem', ['item_id'=>$item->id,'quota_id'=>$item->QuotasId])}}"><i class="fa fa-edit"></i></a>
                            <button type="submit" class="btn"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach
                </tbody>
            </table>
            <hr />
        <form class="form-horizontal" action="{{route('quotas.additem')}}" method="post">
            {{ csrf_field() }}

            <label for="">Категория</label>
            <div class="form-group">
                <select class="form-control" name="IdCategories" >
                    @foreach($categories as $category)
                            <option value="{{$category->id}}" >
                            {{$category->Categories}}
                    @endforeach
                </select>
            </div>

            <label for="">Наименование</label>
            <input type="text" class="form-control" name="ItemName" placeholder="Название оборудования" value="" required>

            <label for="">Стоимость</label>
            <input class="form-control" type="text" name="ItemCost" placeholder="Стоимость оборудования" value="" required>

            <label for="">Колличество</label>
            <input class="form-control" type="text" name="ItemCount" placeholder="Цена оборудования" value="" required>

            <label for="">Описание</label>
            <input class="form-control" type="text" name="ItemText" placeholder="Описание оборудования" value="">

            <input type="text" class="form-control" name="QuotasId"  value="{{$quotas->id}}" hidden>
            <br>
            <input class="btn btn-primary" type="submit" value="Добавить">

        </form>
    </div>

@endsection
