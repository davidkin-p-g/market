@extends('layouts.app')

@section('content')

    <div class="container">
        <hr>
        @if($user = auth()->user()->Roles == 'Покупатель')
        <a href="{{route('quotas.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать квоту</a>
        @endif
        <table class="table table-striped">
            <thead>
            @if($user = auth()->user()->Roles == 'Поставщик')
                <th>Покупатель</th>
            @endif
            <th>Наименование</th>
            <th>Описание</th>
            <th>Дата публикации</th>
            <th>Срок реализации</th>
            <th class="text-right">Действие</th>
            </thead>
            <tbody>
            @forelse ($quotas as $quota)
                <tr>
                    @if($user = auth()->user()->Roles == 'Поставщик')
                        <td>{{$quota->Buyer}}</td>
                    @endif
                    <td>{{$quota->Name}}</td>
                    <td>
                        @if(isset($quota->Text))
                        {{$quota->Text}}
                        @else
                        ---
                        @endif
                    </td>
                    <td>
                            @if (isset($quota->QPublished))
                                {{$quota->QPublishedDate}}
                            @else
                                        Неопубликовано
                            @endif
                    </td>
                    <td>
                            @if (isset($quota->QRealizationDate))
                                {{$quota->QRealizationDate}}
                            @else
                                Неограничено
                            @endif

                    </td>
                    <td>
                        @if($user = auth()->user()->Roles == 'Покупатель')
                        <form onsubmit="if(confirm('Удалить?')){return true} else {return false}" action="{{route('quotas.destroy', ['quota_id'=>$quota->id])}}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <a href="{{route('quotas.edit', ['quota_id'=>$quota->id])}}"><i class="fa fa-edit"></i></a>
                            <button type="submit" class="btn"><i class="fa fa-trash"></i></button>
                        </form>
                        @endif
                            @if($user = auth()->user()->Roles == 'Поставщик')
                                    <a href="{{route('quotas.show', ['quota_id'=>$quota->id])}}"><i class="fa fa-eye"></i></a>
                            @endif
                    </td>
                </tr>
            @empty
                <tr>
                    @if($user = auth()->user()->Roles == 'Покупатель')
                    <td colspan="6" class="text-center"><h2>Создайте квоту</h2></td>
                    @endif
                    @if ($user = auth()->user()->Roles == 'Поставщик')
                    <td colspan="7" class="text-center"><h2>Нет квот</h2></td>
                    @endif

                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
