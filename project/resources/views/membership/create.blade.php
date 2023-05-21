@extends('adminlte::page')

@section('title', 'Create Membership')

@section('content_header')
    <h1>Create Membership</h1>
@stop

@section('content')
    <form action="{{route('memberships.store')}}" method="POST">
        @csrf
        <div>
            {!! Form::label('name', 'Name', []) !!}
        </div>
        <div>
            {!! Form::text('name', null, []) !!}
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('discount', 'Discount', []) !!}
        </div>
        <div>
            {!! Form::number('discount', 0, []) !!}
            @error('discount')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('minimum_profit', 'minimum_profit', []) !!}
        </div>
        <div>
            {!! Form::number('minimum_profit', 0, []) !!}
            @error('minimum_profit')
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
