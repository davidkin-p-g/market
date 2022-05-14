@extends('layouts.app')

@section('content')

    <div class="container">
        <hr>
        <table class="table table-striped">
            <thead>
            <th>Наименование</th>
            <th>Описание</th>
            <th>Дата публикации</th>
            <th>Срок реализации</th>
            <th class="text-right">Действие</th>
            </thead>
            <tbody>
            @forelse ($quotas as $quota)
                <tr>
                    <td>{{$quota->Name}}</td>
                    <td>
                        @if(isset($quota->Text))
                            {{$quota->Text}}
                        @else
                            ---
                        @endif
                    </td>
                    <td>
                            {{$quota->QPublishedDate}}
                    </td>
                    <td>
                        @if (isset($quota->QRealizationDate))
                            {{$quota->QRealizationDate}}
                        @else
                            Неограничено
                        @endif

                    </td>
                    <td>
                        <a href="{{route('offers.create_buyer', ['id'=>$id, 'quota_id'=> $quota->id])}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                        <td colspan="6" class="text-center"><h2>Создайте квоту</h2></td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
