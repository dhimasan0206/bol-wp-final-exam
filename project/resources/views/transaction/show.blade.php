@extends('adminlte::page')

@section('title', 'Transaction')

@section('content_header')
    <h1>Transaction</h1>
@stop

@section('content')
    <p>Customer: {{ $transaction->customer }}</p>
    <p>Date: {{ $transaction->date }}</p>
    <p>Discount: {{ $transaction->discount }}</p>
    @foreach ($transaction->details as $detail)
        <p>Currency: {{ $detail->currency }}</p>
        <p>Rate: {{ $detail->rate }}</p>
        <p>Quantity: {{ $detail->quantity }}</p>
        <p>Total: {{ $detail->total() }}</p>
    @endforeach
    {{-- <a href="{{route('transactions.edit', ['transaction' => $transaction->id])}}">Edit</a> --}}
    {!! Form::open(['url' => route('transactions.destroy', ['transaction'=> $transaction->id])]) !!}
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