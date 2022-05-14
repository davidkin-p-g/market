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
                    @if(isset($Categories))
                        <h6 class="card-title">{{$Categories->Categories}}</h6>
                    @endif
                    <hr />
                    <table class="table table-striped">
                        <thead>
                        @if($user = auth()->user()->Roles == 'Продавец')
                        <th>Поставщик</th>
                        @endif
                        <th>Наименование</th>
                        <th>Категория</th>
                        <th>Стоимость</th>
                        <th>Количество</th>
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
                                            @if(isset($id))
                                                <a href="{{route('offers.add_buyer', ['id'=> $id,'dop_id'=> $product->id ])}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            @else
                                            <form onsubmit="if(confirm('Удалить?')){return true} else {return false}" action="{{route('products.destroy', ['IdCategories'=>$product->IdCategories, 'product_id'=>$product->id])}}" method="post">
                                                {{ csrf_field() }}
                                                <a href="{{route('products.createedit', ['IdCategories'=>$product->IdCategories, 'product_id'=>$product->id])}}"><i class="fa fa-edit"></i></a>
                                                <button type="submit" class="btn"><i class="fa fa-trash"></i></button>
                                            </form>
                                            @endif
                                        @endif
                                        @if($user = auth()->user()->Roles == 'Покупатель')
                                            @if(isset($Categories))
                                                <a href="{{route('products.index')}}"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('offers.create_buyer', ['id'=>$product->id, 'IdCategories'=>$Categories->id])}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            @else
{{--                                                <a href="{{route('products.show', ['IdCategories'=>null,'product_id'=>$product->id])}}"><i class="fa fa-eye"></i></a>--}}
                                                <a href="{{route('offers.create_buyer', ['id'=>$product->id])}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            @endif
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
