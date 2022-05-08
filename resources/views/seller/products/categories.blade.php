@foreach ($categories as $category_list)

    <a>{!! $delimiter !!}</a>
    <a href="#" class="btn btn-link" role="button" aria-pressed="true">{{$category_list->Categories}}</a>
    <br>
    @if (count($category_list->children) > 0)

        @include('seller.products.categories', [
          'categories' => $category_list->children,
          'delimiter'  => '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $delimiter
        ])

    @endif
@endforeach
