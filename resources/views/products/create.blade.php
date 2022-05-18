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
                    @include('products.categories', ['categories' => $categ,'Role' => $user = auth()->user()->Roles])
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

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-pub-tab" data-bs-toggle="tab" data-bs-target="#nav-pub" type="button" role="tab" aria-controls="nav-pub" aria-selected="true">Опубликованные</button>
                            <button class="nav-link" id="nav-notpub-tab" data-bs-toggle="tab" data-bs-target="#nav-notpub" type="button" role="tab" aria-controls="nav-notpub" aria-selected="false">Неопубликованные</button>
                            <button class="nav-link" id="nav-add-tab" data-bs-toggle="tab" data-bs-target="#nav-add" type="button" role="tab" aria-controls="nav-add" aria-selected="false">Добавить</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-pub" role="tabpanel" aria-labelledby="nav-pub-tab">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                @forelse($products as $product)
                                    @if(isset($product->ProdPublished))
                                    @if($product->id == $product_id)
                                        <form action="{{route('products.update', ['IdCategories'=>$Categor->id, 'product_id'=>$product->id])}}" method="post">
                                            {{ csrf_field() }}
                                            <div class="col">
                                                <div class="card text-center shadow-sm">
                                                    <div class="card-header py-3 text-white bg-secondary border-secondary">
                                                        <h4 class="my-0 fw-normal">
                                                            Название
                                                            <input type="text" class="form-control" name="ProdName" placeholder="Название оборудования" value="{{$product->ProdName}}" required>
                                                        </h4>
                                                    </div>

                                                    <div class="card-body">
                                                        <p class="card-text">
                                                            Категория
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
                                                        </p>
                                                        <hr>
                                                        <p class="card-text">
                                                            Стоимость, руб.:
                                                            <input type="text" class="form-control" name="ProdCost" placeholder="Стоимость оборудования" value="{{$product->ProdCost}}" required >

                                                            <br>
                                                            Колличество, шт.:
                                                            <input type="text" class="form-control" name="ProdCount" placeholder="Количество оборудования" value="{{$product->ProdCount}}"  required>
                                                        </p>
                                                        <hr>
                                                        <p class="card-text">
                                                             <textarea type="text" class="form-control" name="ItemText" placeholder="Описание оборудования">
                                                                {{$product->ProdText}}
                                                            </textarea>
                                                        </p>
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
                                                        <hr>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <input class="btn btn-sm btn-outline-secondary" type="submit" value="Сохранить">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    @else
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
                                    @endif
                                    @endif
                                @empty
                                    <h1>Нет предложений</h1>
                                @endforelse
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="nav-notpub" role="tabpanel" aria-labelledby="nav-notpub-tab">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                @forelse($products as $product)
                                    @if(!isset($product->ProdPublished))
                                        @if($product->id == $product_id)
                                            <form action="{{route('products.update', ['IdCategories'=>$Categor->id, 'product_id'=>$product->id])}}" method="post">
                                                {{ csrf_field() }}
                                                <div class="col">
                                                    <div class="card text-center shadow-sm">
                                                        <div class="card-header py-3 text-white bg-secondary border-secondary">
                                                            <h4 class="my-0 fw-normal">
                                                                Название
                                                                <input type="text" class="form-control" name="ProdName" placeholder="Название оборудования" value="{{$product->ProdName}}" required>
                                                            </h4>
                                                        </div>

                                                        <div class="card-body">
                                                            <p class="card-text">
                                                                Категория
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
                                                            </p>
                                                            <hr>
                                                            <p class="card-text">
                                                                Стоимость, руб.:
                                                                <input type="text" class="form-control" name="ProdCost" placeholder="Стоимость оборудования" value="{{$product->ProdCost}}" required >

                                                                <br>
                                                                Колличество, шт.:
                                                                <input type="text" class="form-control" name="ProdCount" placeholder="Количество оборудования" value="{{$product->ProdCount}}"  required>
                                                            </p>
                                                            <hr>
                                                            <p class="card-text">
                                                             <textarea type="text" class="form-control" name="ItemText" placeholder="Описание оборудования">
                                                                {{$product->ProdText}}
                                                            </textarea>
                                                            </p>
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
                                                            <hr>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <input class="btn btn-sm btn-outline-secondary" type="submit" value="Сохранить">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @else
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
                                        @endif
                                    @endif
                                @empty
                                    <h1>Нет предложений</h1>
                                @endforelse
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tab">
                            <form class="form-horizontal" action="{{route('products.store',['IdCategories' => $Categor->id]) }}" method="post">
                                {{ csrf_field() }}
                                <label for="">Наименование</label>
                                <input type="text" class="form-control" name="ProdName" placeholder="Название оборудования" value=""  required>

                                <label for="">Стоимость</label>
                                <input class="form-control" type="text" name="ProdCost" placeholder="Стоимость оборудования" value="" required>

                                <label for="">Колличество</label>
                                <input class="form-control" type="text" name="ProdCount" placeholder="Цена оборудования" value="" required>

                                <label for="">Колличество</label>
                                <textarea class="form-control" type="text" name="ProdText" placeholder="Описание оборудования"required>
                                </textarea>

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
        </div>
    </div>
@endsection
