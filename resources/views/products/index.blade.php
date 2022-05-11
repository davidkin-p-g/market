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

                    @include('products.categories', ['categories' => $categ, 'Role' => $user = auth()->user()->Roles ])
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Оборудование </h5>
                    @if(isset($Categor))
                        <h6 class="card-title">{{$Categor->Categories}}</h6>
                    @endif
                    <hr />
                    <table class="table table-striped">
                        <thead>
                        <th>Наименование</th>
                        <th>Категория</th>
                        <th>Стоимость</th>
                        <th>Колличество</th>
                        <th>Дата публикации</th>
                        <th>Действие</th>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->ProdName}}</td>
                                    <td>{{$product->products_categoties_name->first()->Categories}}</td>
                                    <td>{{$product->ProdCost}}</td>
                                    <td>{{$product->ProdCount}}</td>
                                    <td>
                                        @if (isset($product->ProdPublishedDate))
                                            {{$product->ProdPublishedDate}}
                                        @else
                                            Неопубликовано
                                        @endif
                                    </td>
                                    <td>
                                        @if($user = auth()->user()->Roles == 'Поставщик')
                                            <form onsubmit="if(confirm('Удалить?')){return true} else {return false}" action="{{route('products.destroy', ['IdCategories'=>$product->IdCategories, 'product_id'=>$product->id])}}" method="post">
                                                {{ csrf_field() }}
                                                <a href="{{route('products.createedit', ['IdCategories'=>$product->IdCategories, 'product_id'=>$product->id])}}"><i class="fa fa-edit"></i></a>
                                                <button type="submit" class="btn"><i class="fa fa-trash"></i></button>
                                            </form>
                                        @endif
                                            @if($user = auth()->user()->Roles == 'Покупатель')
                                            <a href="{{route('products.show', ['IdCategories'=>1])}}"><i class="fa fa-eye"></i></a>
                                        @endif
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <hr />

                </div>
            </div>
        </div>
    </div>
@endsection
