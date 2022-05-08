@extends('layouts.app')

@section('content')

    <div class="container">
        <hr />
        <div class="card w-50">
            <div class="card-body">
                <h5 class="card-title">Категории</h5>
                @include('seller.products.categories', ['categories' => $categories])
            </div>
        </div>
    </div>

@endsection
