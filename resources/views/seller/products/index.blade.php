@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-2">
            <div class="container">
                <hr />
                    <div class="card-body">
                        <h5 class="card-title">Категории</h5>
                        @include('seller.products.categories', ['categories' => $categories])
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
