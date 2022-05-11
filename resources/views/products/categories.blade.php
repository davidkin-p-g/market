@foreach ($categories as $category_list)

{{--    <span class="text-muted">Toggleable via the navbar brand.</span>--}}
<div class="alert alert-info" role="alert">
    {!! $delimiter !!}
    @if($Role == 'Поставщик')
    <a href="{{route('products.create', ['IdCategories'=>$category_list->id])}}"
        role="button" aria-pressed="true"> {{$category_list->Categories}}</a>
    @endif
    @if($Role == 'Покупатель')
        <a href="{{route('products.indexid', ['IdCategories'=>$category_list->id])}}"
           role="button" aria-pressed="true"> {{$category_list->Categories}}</a>
    @endif

</div>

    @if (count($category_list->children) > 0)

        @include('products.categories', [
          'categories' => $category_list->children,
          'delimiter'  => '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $delimiter,
          'Role' => $Role
        ])

    @endif
@endforeach
