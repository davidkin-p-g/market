@foreach ($categories as $category_list)

{{--    <span class="text-muted">Toggleable via the navbar brand.</span>--}}
<div class="alert alert-info" role="alert">
    {!! $delimiter !!}
    <a href="{{route('buyerproducts.indexcategory', ['IdCategories'=>$category_list->id])}}"
        role="button" aria-pressed="true"> {{$category_list->Categories}}</a>

</div>

    @if (count($category_list->children) > 0)

        @include('buyer.products.categories', [
          'categories' => $category_list->children,
          'delimiter'  => '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $delimiter
        ])

    @endif
@endforeach
