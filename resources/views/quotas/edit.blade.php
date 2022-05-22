@extends('layouts.app')
{{$quota_id}}
@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb default-color">
                <li class="breadcrumb-item active" aria-current="page"><a href="/">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('quotas.index')}}">Квоты</a></li>
                <li class="breadcrumb-item" aria-current="page">Редактирование квоты</li>
            </ol>
        </nav>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-quota-tab" data-bs-toggle="tab" data-bs-target="#nav-quota" type="button" role="tab" aria-controls="nav-quota" aria-selected="true">Квота</button>
                <button class="nav-link" id="nav-add-tab" data-bs-toggle="tab" data-bs-target="#nav-add" type="button" role="tab" aria-controls="nav-add" aria-selected="false">Добавить</button>
             </div>
        </nav>
        <br>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-quota" role="tabpanel" aria-labelledby="nav-quota-tab">
                <div class="col-md-7 col-lg-8">
                    <form class="form-horizontal" action="{{route('quotas.update', ['quota_id'=>$quotas->id]) }}" method="post">
                        {{ method_field('put') }}
                        {{ csrf_field() }}
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="Name" class="form-label">Наименование</label>
                                <input type="text" class="form-control" name="Name" placeholder="Название Квоты" value="{{$quotas->Name}}" required>

                                <label for="Text">Описание</label>
                                <textarea class="form-control" name="Text" placeholder="Описание квоты" rows="3">{{$quotas->Text}}</textarea>

                                <label for="QRealizationDate">Срок реализации</label>
                                <input type="date" class="form-control" name="QRealizationDate" placeholder="Срок реализации" value="{{$quotas->QRealizationDate}}">
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
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <h4 class="mb-3">Номенклатура</h4>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($items as $item)
                        @if(isset($item_id) && $item->id == $item_id)
                            <form action="{{route('quotas.updateitem', ['item_id'=>$item->id, 'quota_id'=>$quotas->id]) }}" method="post">
                                {{ csrf_field() }}
                                <div class="col">
                                    <div class="card text-center shadow-sm">
                                        <div class="card-header py-3 text-white bg-secondary border-secondary">
                                            <h4 class="my-0 fw-normal">
                                                Название
                                                <input type="text" class="form-control" name="ItemName" placeholder="Название оборудования" value="{{$item->ItemName}}" required>
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">
                                                Категория
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
                                            </p>
                                            <hr>
                                            <p class="card-text">
                                                Стоимость, руб.:
                                                <input type="text" class="form-control" name="ItemCost" placeholder="Стоимость оборудования" value="{{$item->ItemCost}}" required >

                                                <br>
                                                Колличество, шт.:
                                                <input type="text" class="form-control" name="ItemCount" placeholder="Количество оборудования" value="{{$item->ItemCount}}"  required>
                                            </p>
                                            <hr>
                                            <p class="card-text">
                                                <textarea type="text" class="form-control" name="ItemText" placeholder="Описание оборудования">
                                                    {{$item->ItemText}}
                                                </textarea>
                                            </p>
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
                                        <h4 class="my-0 fw-normal">{{$item->ItemName}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{$item->Categories}}</p>
                                        <hr>
                                        <p class="card-text">Стоимость:{{$item->ItemCost}}руб./ Количество: {{$item->ItemCount}} шт. </p>
                                        <hr>
                                        @if(isset($item->ItemText))
                                            <p class="card-text">{{$item->ItemText}}</p>
                                        @else
                                            <p class="card-text">---</p>
                                        @endif
                                        <hr>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <a href="{{route('quotas.edititem', ['item_id'=>$item->id,'quota_id'=>$item->QuotasId])}}" type="button" class="btn btn-sm btn-outline-secondary" >
                                                        Изменить
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <form onsubmit="if(confirm('Удалить?')){return true} else {return false}" action="{{route('quotas.destroyitem', ['item_id'=>$item->id, 'quota_id'=>$item->QuotasId])}}" method="post">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                            Удалить
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade show" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tab">
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
                <input class="form-control" type="text" name="ItemCount" placeholder="Количество оборудования" value="" required>

                <label for="">Описание</label>
                <textarea class="form-control" name="ItemText" placeholder="Описание оборудования" rows="3"></textarea>

                <input type="text" class="form-control" name="QuotasId"  value="{{$quotas->id}}" hidden>
                <br>
                <input class="btn btn-primary" type="submit" value="Добавить">

            </form>
        </div>
        </div>
    </div>


@endsection
