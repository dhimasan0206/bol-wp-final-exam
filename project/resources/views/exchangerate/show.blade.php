@extends('adminlte::page')

@section('title', 'Exchange Rate')

@section('content_header')
    <h1>Exchange Rate</h1>
@stop

@section('content')
    <p>Currency: {{ $exchangerate->currency }}</p>
    <p>Sell: {{ $exchangerate->sell }}</p>
    <p>Buy: {{ $exchangerate->buy }}</p>
    <p>Date: {{ $exchangerate->date }}</p>
    <a href="{{route('exchangerates.edit', ['exchangerate' => $exchangerate->id])}}">Edit</a>
    {!! Form::open(['url' => route('exchangerates.destroy', ['exchangerate'=> $exchangerate->id])]) !!}
    @csrf
    @method('DELETE')
    {!! Form::submit('delete') !!}
    {!! Form::close() !!}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop