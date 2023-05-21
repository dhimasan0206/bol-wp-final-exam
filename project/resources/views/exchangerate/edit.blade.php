@extends('adminlte::page')

@section('title', 'Edit Exchange Rate')

@section('content_header')
    <h1>Edit Exchange Rate</h1>
@stop

@section('content')
    <form action="{{route('exchangerates.update', ['exchangerate' => $exchangerate->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div>
            {!! Form::label('currency', 'currency', []) !!}
        </div>
        <div>
            {!! Form::text('currency', $exchangerate->currency, []) !!}
            @error('currency')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('sell', 'Sell', []) !!}
        </div>
        <div>
            {!! Form::number('sell', $exchangerate->sell, []) !!}
            @error('sell')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('buy', 'Buy', []) !!}
        </div>
        <div>
            {!! Form::number('buy', $exchangerate->buy, []) !!}
            @error('buy')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('date', 'Date', []) !!}
        </div>
        <div>
            {!! Form::date('date', new DateTime($exchangerate->date), []) !!}
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
