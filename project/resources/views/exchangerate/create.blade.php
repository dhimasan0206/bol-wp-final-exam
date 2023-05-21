@extends('adminlte::page')

@section('title', 'Create Exchange Rate')

@section('content_header')
    <h1>Create Exchange Rate</h1>
@stop

@section('content')
    <form action="{{route('exchangerates.store')}}" method="POST">
        @csrf
        <div>
            {!! Form::label('currency', 'currency', []) !!}
        </div>
        <div>
            {!! Form::text('currency', null, []) !!}
            @error('currency')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('sell', 'Sell', []) !!}
        </div>
        <div>
            {!! Form::number('sell', 0, []) !!}
            @error('sell')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('buy', 'Buy', []) !!}
        </div>
        <div>
            {!! Form::number('buy', 0, []) !!}
            @error('buy')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('date', 'Date', []) !!}
        </div>
        <div>
            {!! Form::date('date', null, []) !!}
            @error('date')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <button type="submit">Save</button>
        </div>
    </form>
@stop

@section('css')
@stop

@section('js')
@stop
