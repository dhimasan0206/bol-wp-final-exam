@extends('adminlte::page')

@section('title', 'Exchange Rate List')

@section('content_header')
    <h1>Exchange Rate List</h1>
@stop

@section('content')
    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads">
        @foreach($config['data'] as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

@section('css')
@stop

@section('js')
@stop
