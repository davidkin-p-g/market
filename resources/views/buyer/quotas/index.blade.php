@extends('layouts.app')

@section('content')

    <div class="container">
        <hr>

        <a href="{{route('quotas.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать квоту</a>
        <table class="table table-striped">
            <thead>
            <th>Наименование</th>
            <th>Описание</th>
            <th class="text-right">Действие</th>
            </thead>
            <tbody>
            @forelse ($quotas as $q)
                <tr>
                    <td>{{$q->Name}}</td>
                    <td>{{$q->Text}}</td>
                    <td>
                        <form onsubmit="if(confirm('Удалить?')){return true} else {return false}" action="{{route('quotas.destroy', ['quota'=>$q->id])}}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <a href="{{route('quotas.edit', ['qoutas'=>$q, 'quota'=>$q->id])}}"><i class="fa fa-edit"></i></a>
                            <button type="submit" class="btn"><i class="fa fa-trash"></i></button>
                        </form>
{{--                        <a href="{{route('quotas.destroy', ['quota'=>$q->id])}}"><i class="fa fa-trash"></i></a>--}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
