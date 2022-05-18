@extends('layouts.app')

@section('content')
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Dashboard') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                        <div>--}}
{{--                            <a href="{{route('quotas.index')}}" class="btn btn-primary" role="button" aria-disabled="true">Квота</a>--}}
{{--                        </div>--}}
{{--                        <br>--}}
{{--                        <div>--}}
{{--                            <a href="{{route('category.index')}}" class="btn btn-primary" role="button" aria-disabled="true">Категории</a>--}}
{{--                        </div>--}}
{{--                        <br>--}}
{{--                        <div>--}}
{{--                            <a href="{{route('products.index')}}" class="btn btn-primary" role="button" aria-disabled="true">Товары</a>--}}
{{--                        </div>--}}
{{--                        <br>--}}

{{--                        {{ __('You are logged in!') }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


<div class="container py-3">
    <main>
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Квоты на оборудование</h4>
                    </div>
                    <div class="card-body">
                            @if($user = auth()->user()->Roles == 'Покупатель')
                                <h4 class="my-0 fw-normal">Текст</h4>
                            @endif
                            @if($user = auth()->user()->Roles == 'Поставщик')
                                <h4 class="my-0 fw-normal">Текст</h4>
                            @endif
                        <a href="{{route('quotas.index')}}" class="w-100 btn btn-lg btn-primary" role="button" aria-disabled="true">Список квот</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Опубликованное оборудование</h4>
                    </div>
                    <div class="card-body">
                            @if($user = auth()->user()->Roles == 'Покупатель')
                                <h4 class="my-0 fw-normal">Текст</h4>
                            @endif
                            @if($user = auth()->user()->Roles == 'Поставщик')
                                <h4 class="my-0 fw-normal">Текст</h4>
                            @endif
                        <a href="{{route('products.index')}}" class="w-100 btn btn-lg btn-primary" role="button" aria-disabled="true">Список оборудования</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Предложения</h4>
                    </div>
                    <div class="card-body">
                            @if($user = auth()->user()->Roles == 'Покупатель')
                                <h4 class="my-0 fw-normal">Текст</h4>
                            @endif
                            @if($user = auth()->user()->Roles == 'Поставщик')
                                <h4 class="my-0 fw-normal">Текст</h4>
                            @endif
                        <a href="{{route('offers.index')}}" class="w-100 btn btn-lg btn-primary" role="button" aria-disabled="true">Список оборудования</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
