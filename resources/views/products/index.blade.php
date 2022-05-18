@extends('layouts.app')
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb default-color">
                <li class="breadcrumb-item active" aria-current="page"><a href="/">Главная</a></li>
                <li class="breadcrumb-item" aria-current="page">Оборудование</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-sm-3">
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

            <div class="col-sm-9">
                <div class="card">
                    <h5 class="card-title">Категории</h5>
                    @if($user = auth()->user()->Roles == 'Покупатель')
                        @if(isset($Categories))
                            <h6 class="card-title">{{$Categories->Categories}}</h6>
                        @endif
                    @endif
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        @forelse($products as $product)
                            <div class="col">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header py-3 text-white bg-secondary border-secondary">
                                        <h4 class="my-0 fw-normal">{{$product->ProdName}}</h4>
                                    </div>

                                    <div class="card-body">
                                        <p class="card-text">{{$product->Categories}}</p>
                                        <hr>
                                        @if(isset($product->ProdText))
                                            <p class="card-text">{{$product->ProdText}}</p>
                                        @else
                                            <p class="card-text">---</p>
                                        @endif
                                        <hr>
                                        <p class="card-text">Стоимость:{{$product->ProdCost}}руб./ Количество: {{$product->ProdCount}} шт. </p>
                                        <hr>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <ul class="list-group list-group-flush">
                                                @if($user = auth()->user()->Roles == 'Покупатель')
                                                    @if(isset($Categories))
                                                        <li class="list-group-item">
                                                            <a href="{{route('offers.create_buyer', ['id'=>$product->id, 'IdCategories'=>$Categories->id])}}" type="button" class="btn btn-sm btn-outline-secondary">
                                                                Предложить
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li class="list-group-item">
                                                            <a href="{{route('offers.create_buyer', ['id'=>$product->id])}}" type="button" class="btn btn-sm btn-outline-secondary">
                                                                Предложить
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li class="list-group-item">
                                                        <a href="{{route('offers.product', ['product_id'=>$product->id])}}" type="button" class="btn btn-sm btn-outline-secondary">
                                                            Предложениия
                                                            <span class="badge bg-secondary rounded-pill">{{$product->offers_count}}</span>
                                                        </a>
                                                    </li>
                                                @endif

                                                @if($user = auth()->user()->Roles == 'Поставщик')
                                                        @if(isset($id))
                                                            <li class="list-group-item">
                                                                <a href="{{route('offers.add_buyer', ['id'=> $id,'dop_id'=> $product->id ])}}" type="button" class="btn btn-sm btn-outline-secondary">
                                                                    Предложить
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li class="list-group-item">
                                                                <form onsubmit="if(confirm('Удалить?')){return true} else {return false}" action="{{route('products.destroy', ['IdCategories'=>$product->IdCategories, 'product_id'=>$product->id])}}" method="post">
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                                        Удалить
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <a href="{{route('products.createedit', ['IdCategories'=>$product->IdCategories, 'product_id'=>$product->id])}}" type="button" class="btn btn-sm btn-outline-secondary">
                                                                    Изменить
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li class="list-group-item">
                                                            <a href="{{route('offers.product', ['product_id'=>$product->id])}}" type="button" class="btn btn-sm btn-outline-secondary">
                                                                Предложениия
                                                                <span class="badge bg-secondary rounded-pill">{{$product->offers_count}}</span>
                                                            </a>
                                                        </li>
                                                    @endif
                                            </ul>
                                            <small class="text-muted">
                                                Дата публикации:
                                                <br>
                                                @if (isset($product->ProdPublishedDate))
                                                    {{$product->ProdPublishedDate}}
                                                @else
                                                    Неопубликовано
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <h1>Нет предложений</h1>
                            @endforelse
                        </div>
                    </div>
                </div>
        </div>
    </div>
{{--------------------------------------------------------------------------------------------------------}}
{{--        <div class="row">--}}
{{--        <div class="col-sm-2">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <h5 class="card-title">Категории</h5>--}}
{{--                    <div class="alert alert-info" role="alert">--}}
{{--                        <a href="{{route('products.index')}}"--}}
{{--                           role="button" aria-pressed="true"> Все</a>--}}
{{--                    </div>--}}

{{--                    @include('products.categories', ['categories' => $categ, 'Role' => $user = auth()->user()->Roles ])--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <h5 class="card-title">Оборудование </h5>--}}
{{--                    @if(isset($Categories))--}}
{{--                        <h6 class="card-title">{{$Categories->Categories}}</h6>--}}
{{--                    @endif--}}
{{--                    <hr />--}}
{{--                    <table class="table table-striped">--}}
{{--                        <thead>--}}
{{--                        @if($user = auth()->user()->Roles == 'Продавец')--}}
{{--                        <th>Поставщик</th>--}}
{{--                        @endif--}}
{{--                        <th>Наименование</th>--}}
{{--                        <th>Категория</th>--}}
{{--                        <th>Стоимость</th>--}}
{{--                        <th>Количество</th>--}}
{{--                        <th>Дата публикации</th>--}}
{{--                        <th>Действие</th>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach ($products as $product)--}}
{{--                                <tr>--}}
{{--                                    <td>{{$product->ProdName}}</td>--}}
{{--                                    <td>{{$product->Categories}}</td>--}}
{{--                                    <td>{{$product->ProdCost}}</td>--}}
{{--                                    <td>{{$product->ProdCount}}</td>--}}
{{--                                    <td>--}}
{{--                                        @if (isset($product->ProdPublishedDate))--}}
{{--                                            {{$product->ProdPublishedDate}}--}}
{{--                                        @else--}}
{{--                                            Неопубликовано--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        @if($user = auth()->user()->Roles == 'Поставщик')--}}
{{--                                            @if(isset($id))--}}
{{--                                                <a href="{{route('offers.add_buyer', ['id'=> $id,'dop_id'=> $product->id ])}}"><i class="fa fa-plus" aria-hidden="true"></i></a>--}}
{{--                                            @else--}}
{{--                                            <form onsubmit="if(confirm('Удалить?')){return true} else {return false}" action="{{route('products.destroy', ['IdCategories'=>$product->IdCategories, 'product_id'=>$product->id])}}" method="post">--}}
{{--                                                {{ csrf_field() }}--}}
{{--                                                <a href="{{route('products.createedit', ['IdCategories'=>$product->IdCategories, 'product_id'=>$product->id])}}"><i class="fa fa-edit"></i></a>--}}
{{--                                                <button type="submit" class="btn"><i class="fa fa-trash"></i></button>--}}
{{--                                                <a href="{{route('offers.product', ['product_id'=>$product->id])}}" >[{{$product->offers_count}}]</a>--}}
{{--                                            </form>--}}
{{--                                            @endif--}}
{{--                                        @endif--}}
{{--                                        @if($user = auth()->user()->Roles == 'Покупатель')--}}
{{--                                            @if(isset($Categories))--}}
{{--                                                <a href="{{route('products.index')}}"><i class="fa fa-eye"></i></a>--}}
{{--                                                <a href="{{route('offers.create_buyer', ['id'=>$product->id, 'IdCategories'=>$Categories->id])}}"><i class="fa fa-plus" aria-hidden="true"></i></a>--}}
{{--                                            @else--}}
{{--                                                <a href="{{route('products.show', ['IdCategories'=>null,'product_id'=>$product->id])}}"><i class="fa fa-eye"></i></a>--}}
{{--                                                <a href="{{route('offers.create_buyer', ['id'=>$product->id])}}"><i class="fa fa-plus" aria-hidden="true"></i></a>--}}
{{--                                            @endif--}}
{{--                                                <a href="{{route('offers.product', ['product_id'=>$product->id])}}" >[{{$product->offers_count}}]</a>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                    <hr />--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    </div>--}}
@endsection
