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

                        <a href="{{route('quotas.index')}}" class="btn btn-primary" role="button" aria-disabled="true">Квота</a>
                        <a href="{{route('category.index')}}" class="btn btn-primary" role="button" aria-disabled="true">Категории</a>
                        <a href="{{route('products.index')}}" class="btn btn-primary" role="button" aria-disabled="true">Пробукты</a>

                        {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
