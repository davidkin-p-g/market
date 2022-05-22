@extends('layouts.app')
@section('content')
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb default-color">
                <li class="breadcrumb-item active" aria-current="page"><a href="/">Главная</a></li>
                <li class="breadcrumb-item" aria-current="page">Квоты</li>
            </ol>
        </nav>
        @if($user = auth()->user()->Roles == 'Покупатель')
        <a href="{{route('quotas.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать квоту</a>
        @endif
        <br>
        @if($user = auth()->user()->Roles == 'Покупатель')
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-pub-tab" data-bs-toggle="tab" data-bs-target="#nav-pub" type="button" role="tab" aria-controls="nav-pub" aria-selected="true">Опубликованные</button>
                    <button class="nav-link" id="nav-notpub-tab" data-bs-toggle="tab" data-bs-target="#nav-notpub" type="button" role="tab" aria-controls="nav-notpub" aria-selected="false">Неопубликованные</button>
                    <button class="nav-link" id="nav-hist-tab" data-bs-toggle="tab" data-bs-target="#nav-hist" type="button" role="tab" aria-controls="nav-hist" aria-selected="false">История</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-pub" role="tabpanel" aria-labelledby="nav-pub-tab">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        @foreach($quotas as $quota)
                            @if(isset($quota->QPublished))
                            <div class="col">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header py-3 text-white bg-secondary border-secondary">
                                        <h4 class="my-0 fw-normal">{{$quota->Name}}</h4>
                                    </div>
                                    <div class="card-body">
                                        @if(isset($quota->Text))
                                            <p class="card-text">{{$quota->Text}}</p>
                                        @else
                                            <p class="card-text">---</p>
                                        @endif
                                        <hr>
                                        @if(isset($quota->ItemsAll))
                                                <p class="card-text">Позиций: {{$quota->ItemsAll}}</p>
                                        @else
                                                <p class="card-text">Позиций: Нет</p>
                                        @endif
                                        @if(isset($quota->ItemsAllCount))
                                            @if(isset($quota->TotalCount))
                                                <p class="card-text">Заполненость: {{$quota->TotalCount}}/{{$quota->ItemsAllCount}} шт.</p>
                                            @else
                                                <p class="card-text">Заполненость: 0/{{$quota->ItemsAllCount}} шт.</p>
                                            @endif
                                        @else
                                            <p class="card-text">Заполненость: ---</p>
                                        @endif
                                        <p class="card-text">
                                            Предложения:
                                            <br>
                                            Всего
                                            @if(isset($quota->offers_count))
                                               {{$quota->offers_count}}
                                            @else
                                                0
                                            @endif
                                            /Согласовано
                                            @if(isset($quota->offers_count_pub))
                                                {{$quota->offers_count_pub}}
                                            @else
                                                0
                                            @endif
                                        </p>
                                        <hr>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <a href="{{route('quotas.show', ['quota_id'=>$quota->id])}}" type="button" class="btn btn-sm btn-outline-secondary">
                                                        Открыть
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <a href="{{route('offers.quota', ['quota_id'=>$quota->id])}}" type="button" class="btn btn-sm btn-outline-secondary">
                                                        Предложениия
                                                        <span class="badge bg-secondary rounded-pill">{{$quota->offers_count}}</span>
                                                    </a>
                                                </li>

                                            </ul>
                                            <small class="text-muted">
                                               Срок реализации:
                                                <br>
                                                @if (isset($quota->QRealizationDate))
                                                    {{$quota->QRealizationDate}}
                                                @else
                                                    Неограничено
                                                @endif
                                                <hr>
                                                Дата публикации:
                                                <br>
                                                {{$quota->QPublishedDate}}
                                            </small>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-notpub" role="tabpanel" aria-labelledby="nav-notpub-tab">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        @foreach($quotas as $quota)
                            @if(!isset($quota->QPublished))
                                <div class="col">
                                    <div class="card text-center shadow-sm">
                                        <div class="card-header py-3 text-white bg-secondary border-secondary">
                                            <h4 class="my-0 fw-normal">{{$quota->Name}}</h4>
                                        </div>
                                        <div class="card-body">
                                            @if(isset($quota->Text))
                                                <p class="card-text">{{$quota->Text}}</p>
                                            @else
                                                <p class="card-text">---</p>
                                            @endif
                                            <hr>
                                            @if(isset($quota->ItemsAll))
                                                <p class="card-text">Позиций: {{$quota->ItemsAll}}</p>
                                            @else
                                                <p class="card-text">Позиций: Нет</p>
                                            @endif
                                            @if(isset($quota->ItemsAllCount))
                                                    @if(isset($quota->TotalCount))
                                                        <p class="card-text">Заполненость: {{$quota->TotalCount}}/{{$quota->ItemsAllCount}} шт.</p>
                                                    @else
                                                        <p class="card-text">Заполненость: 0/{{$quota->ItemsAllCount}} шт.</p>
                                                    @endif
                                            @else
                                                <p class="card-text">Заполненость: ---</p>
                                            @endif
                                            <p class="card-text">
                                                Предложения:
                                                <br>
                                                Всего
                                                @if(isset($quota->offers_count))
                                                    {{$quota->offers_count}}
                                                @else
                                                    0
                                                @endif
                                                /Согласовано
                                                @if(isset($quota->offers_count_pub))
                                                    {{$quota->offers_count_pub}}
                                                @else
                                                    0
                                                @endif
                                            </p>
                                            <hr>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <a href="{{route('quotas.edit', ['quota_id'=>$quota->id])}}" type="button" class="btn btn-sm btn-outline-secondary" >
                                                            Изменить
                                                        </a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <form onsubmit="if(confirm('Удалить?')){return true} else {return false}" action="{{route('quotas.destroy', ['quota_id'=>$quota->id])}}" method="post">
                                                            {{ method_field('delete') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                                Удалить
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                                <small class="text-muted">
                                                    Срок реализации:
                                                    <br>
                                                    @if (isset($quota->QRealizationDate))
                                                        {{$quota->QRealizationDate}}
                                                    @else
                                                        Неограничено
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-hist" role="tabpanel" aria-labelledby="nav-hist-tab">
                    В разработке
                </div>
            </div>
        @endif
        @if ($user = auth()->user()->Roles == 'Поставщик')
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-pub-tab" data-bs-toggle="tab" data-bs-target="#nav-pub" type="button" role="tab" aria-controls="nav-pub" aria-selected="true">Квоты</button>
                        <button class="nav-link" id="nav-hist-tab" data-bs-toggle="tab" data-bs-target="#nav-hist" type="button" role="tab" aria-controls="nav-hist" aria-selected="false">История</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-pub" role="tabpanel" aria-labelledby="nav-pub-tab">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                            @foreach($quotas as $quota)
                                @if(isset($quota->QPublished))
                                    <div class="col">
                                        <div class="card text-center shadow-sm">
                                            <div class="card-header py-3 text-white bg-secondary border-secondary">
                                                <h4 class="my-0 fw-normal">{{$quota->Name}}</h4>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{$quota->Buyer}}</p>
                                                <hr>
                                                @if(isset($quota->Text))
                                                    <p class="card-text">{{$quota->Text}}</p>
                                                @else
                                                    <p class="card-text">---</p>
                                                @endif
                                                <hr>
                                                @if(isset($quota->ItemsAll))
                                                    <p class="card-text">Позиций: {{$quota->ItemsAll}}</p>
                                                @else
                                                    <p class="card-text">Позиций: Нет</p>
                                                @endif
                                                @if(isset($quota->ItemsAllCount))
                                                    @if(isset($quota->TotalCount))
                                                        <p class="card-text">Заполненость: {{$quota->TotalCount}}/{{$quota->ItemsAllCount}} шт.</p>
                                                    @else
                                                        <p class="card-text">Заполненость: 0/{{$quota->ItemsAllCount}} шт.</p>
                                                    @endif
                                                @else
                                                    <p class="card-text">Заполненость: ---</p>
                                                @endif
                                                <p class="card-text">
                                                    Предложения:
                                                    <br>
                                                    Всего
                                                    @if(isset($quota->offers_count))
                                                        {{$quota->offers_count}}
                                                    @else
                                                        0
                                                    @endif
                                                    /Согласовано
                                                    @if(isset($quota->offers_count_pub))
                                                        {{$quota->offers_count_pub}}
                                                    @else
                                                        0
                                                    @endif
                                                </p>
                                                <hr>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <a href="{{route('quotas.show', ['quota_id'=>$quota->id])}}" type="button" class="btn btn-sm btn-outline-secondary">
                                                                Открыть
                                                            </a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <a href="{{route('offers.quota', ['quota_id'=>$quota->id])}}" type="button" class="btn btn-sm btn-outline-secondary">
                                                                Предложениия
                                                                <span class="badge bg-secondary rounded-pill">{{$quota->offers_count}}</span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                    <small class="text-muted">
                                                        Срок реализации:
                                                        <br>
                                                        @if (isset($quota->QRealizationDate))
                                                            {{$quota->QRealizationDate}}
                                                        @else
                                                            Неограничено
                                                        @endif
                                                        <hr>
                                                        Дата публикации:
                                                        <br>
                                                        {{$quota->QPublishedDate}}
                                                    </small>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-hist" role="tabpanel" aria-labelledby="nav-hist-tab">
                        В разработке
                    </div>
                </div>
        @endif
    </div>


@endsection
