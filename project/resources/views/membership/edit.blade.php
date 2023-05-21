@extends('adminlte::page')

@section('title', 'Edit Membership')

@section('content_header')
    <h1>Edit Membership</h1>
@stop

@section('content')
    <form action="{{route('memberships.update', ['membership' => $membership->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div>
            {!! Form::label('name', 'Name', []) !!}
        </div>
        <div>
            {!! Form::text('name', $membership->name, []) !!}
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('discount', 'Discount', []) !!}
        </div>
        <div>
            {!! Form::number('discount', $membership->discount, []) !!}
            @error('discount')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('minimum_profit', 'minimum_profit', []) !!}
        </div>
        <div>
            {!! Form::number('minimum_profit', $membership->minimum_profit, []) !!}
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
