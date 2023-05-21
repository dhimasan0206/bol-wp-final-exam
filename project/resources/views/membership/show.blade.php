@extends('adminlte::page')

@section('title', 'Membership')

@section('content_header')
    <h1>Membership</h1>
@stop

@section('content')
    <p>Name: {{ $membership->name }}</p>
    <p>Discount: {{ $membership->discount }}</p>
    <p>Minimum Profit: {{ $membership->minimum_profit }}</p>
    <a href="{{route('memberships.edit', ['membership' => $membership->id])}}">Edit</a>
    {!! Form::open(['url' => route('memberships.destroy', ['membership'=> $membership->id])]) !!}
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