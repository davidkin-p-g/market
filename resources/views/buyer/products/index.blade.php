@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Категории</h5>
                <div class="alert alert-info" role="alert">
                    <a href="{{route('buyerproducts.index')}}"
                       role="button" aria-pressed="true"> Все</a>
                </div>

                @include('buyer.products.categories', ['categories' => $categ])
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Товары</h5>
                @if(isset($Categories))
                    <h6 class="card-title">{{$Categories->Categories}}</h6>
                @endif
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
                            <tr>
                                <td>{{$product->ProdName}}</td>
                                <td>{{$product->products_categoties_name->first()->Categories}}</td>
                                <td>{{$product->ProdCost}}</td>
                                <td>{{$product->ProdCount}}</td>
                                <td>
                                   121212
                                </td>
                                <td>
                                    действия
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
