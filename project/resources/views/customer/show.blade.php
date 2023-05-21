@extends('adminlte::page')

@section('title', 'Customer')

@section('content_header')
    <h1>Customer</h1>
@stop

@section('content')
    <p>Name: {{ $customer->name }}</p>
    <p>Address: {{ $customer->address }}</p>
    <p>Membership: {{ $customer->membership->name }}</p>
    <a href="{{route('customers.edit', ['customer' => $customer->id])}}">Edit</a>
    {!! Form::open(['url' => route('customers.destroy', ['customer'=> $customer->id])]) !!}
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