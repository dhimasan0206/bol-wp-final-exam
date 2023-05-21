@extends('adminlte::page')

@section('title', 'Create Transaction')

@section('content_header')
    <h1>Create Transaction</h1>
@stop

@section('content')
    <form action="{{route('transactions.store')}}" method="POST">
        @csrf
        <div>
            {!! Form::label('customer_id', 'Customer', []) !!}
        </div>
        <div>
            {!! Form::select('customer_id', $customers, []) !!}
            @error('customer_id')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('exchangerate_id', 'Exchange Rate', []) !!}
        </div>
        <div>
            {!! Form::select('exchangerate_id', $exchangerates, []) !!}
            @error('exchangerate_id')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('quantity', 'Quantity', []) !!}
        </div>
        <div>
            {!! Form::number('quantity', 1, []) !!}
            @error('quantity')
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
