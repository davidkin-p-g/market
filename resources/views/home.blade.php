@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div>
                            <a href="{{route('quotas.index')}}" class="btn btn-primary" role="button" aria-disabled="true">Квота</a>
                            <a href="{{route('buyerproducts.index')}}" class="btn btn-primary" role="button" aria-disabled="true">Товары для покупателя</a>
                        </div>
                        <br>
                        <div>
                            <a href="{{route('category.index')}}" class="btn btn-primary" role="button" aria-disabled="true">Категории</a>
                        </div>
                        <br>
                        <div>
                            <a href="{{route('products.index')}}" class="btn btn-primary" role="button" aria-disabled="true">Товары</a>
                            <a href="{{route('products.index')}}" class="btn btn-primary" role="button" aria-disabled="true">Квоты для продавцов</a>
                        </div>
                        <br>

                        {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
