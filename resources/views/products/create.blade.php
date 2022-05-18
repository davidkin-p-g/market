@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Категории</h5>
                <div class="alert alert-info" role="alert">
                    <a href="{{route('products.index')}}"
                       role="button" aria-pressed="true"> Все</a>
                </div>
                @include('products.categories', ['categories' => $categ,'Role' => $user = auth()->user()->Roles])
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Оборудование </h5>
                <h6 class="card-title">{{$Categor->Categories}} </h6>
                <hr />
                    <table class="table table-striped">
                        <thead>
                        <th>Наименование оборудования</th>
                        <th>Категория</th>
                        <th>Стоимость оборудования</th>
                        <th>Колличество оборудования</th>
                        <th>Дата публикации</th>
                        <th class="text-right">Действие</th>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            @if($product->id == $product_id)

                                <tr>
                                    <td>
                                        <form action="{{route('products.update', ['IdCategories'=>$Categor->id, 'product_id'=>$product->id])}}" method="post">
                                            {{ csrf_field() }}
                                            <input type="text" class="form-control" name="ProdName" placeholder="Название оборудования" value="{{$product->ProdName}}" required>
{{--                                            <input type="text" class="form-control" name="IdCategories" placeholder="Категория" value="{{$product->IdCategories}}" >--}}
                                            <div class="form-group">
                                                <select class="form-control" name="IdCategories">
                                                    @foreach($categories as $category)
                                                        @if ($category->id == $product->IdCategories)
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
                                            <input type="text" class="form-control" name="ProdCost" placeholder="Стоимость оборудования" value="{{$product->ProdCost}}" required >
                                            <input type="text" class="form-control" name="ProdCount" placeholder="Количество оборудования" value="{{$product->ProdCount}}" required >
                                            @if (isset($product->ProdPublished))
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="ProdPublished" checked >
                                                    <label class="form-check-label">
                                                        Опубликовать
                                                    </label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="ProdPublished"  >
                                                    <label class="form-check-label">
                                                        Опубликовать
                                                    </label>
                                                </div>
                                            @endif
                                            <br>
                                            <input class="btn btn-primary" type="submit" value="Сохранить">
                                        </form>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{$product->ProdName}}</td>
                                    <td>{{$product->Categories}}</td>
                                    <td>{{$product->ProdCost}}</td>
                                    <td>{{$product->ProdCount}}</td>
                                    <td>
                                        @if (isset($product->ProdPublished))
                                            {{$product->ProdPublishedDate}}
                                        @else
                                            <div class="form-check">
                                                    Неопубликовано
                                        @endif
                                    </td>
                                    <td>
                                        <form onsubmit="if(confirm('Удалить?')){return true} else {return false}" action="{{route('products.destroy', ['IdCategories'=>$Categor->id, 'product_id'=>$product->id])}}" method="post">
                                            {{ csrf_field() }}
                                            <a href="{{route('products.createedit', ['IdCategories'=>$Categor->id, 'product_id'=>$product->id])}}"><i class="fa fa-edit"></i></a>
                                            <button type="submit" class="btn"><i class="fa fa-trash"></i></button>
                                            <a href="{{route('offers.product', ['product_id'=>$product->id])}}" >[{{$product->offers_count}}]</a>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <hr />
                    <form class="form-horizontal" action="{{route('products.store',['IdCategories' => $Categor->id]) }}" method="post">
                        {{ csrf_field() }}
                        <label for="">Наименование</label>
                        <input type="text" class="form-control" name="ProdName" placeholder="Название оборудования" value=""  required>

                        <label for="">Стоимость</label>
                        <input class="form-control" type="text" name="ProdCost" placeholder="Стоимость оборудования" value="" required>

                        <label for="">Колличество</label>
                        <input class="form-control" type="text" name="ProdCount" placeholder="Цена оборудования" value="" required>

                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ProdPublished"  >
                            <label class="form-check-label">
                                Опубликовать
                            </label>
                        </div>

                        <input class="form-control" type="text" name="SellerId" value="{{$user = auth()->user()->id}}" hidden>
                        <input type="text" class="form-control" name="IdCategories"  value="{{$Categor->id}}" hidden>
                        <input class="form-control" type="text" name="ProdPublishedDate" value="" hidden>
                        <input class="form-control" type="text" name="SellerName" value="{{$user = auth()->user()->name}}" hidden>
                        <hr />

                        <input class="btn btn-primary" type="submit" value="Добавить">

                    </form>
            </div>
        </div>
    </div>
</div>

@endsection
