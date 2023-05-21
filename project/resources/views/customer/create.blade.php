@extends('adminlte::page')

@section('title', 'Create Customer')

@section('content_header')
    <h1>Create Customer</h1>
@stop

@section('content')
    <form action="{{route('customers.store')}}" method="POST">
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
            {!! Form::label('address', 'Address', []) !!}
        </div>
        <div>
            {!! Form::text('address', null, []) !!}
            @error('address')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('membership_id', 'Membership', []) !!}
        </div>
        <div>
            {!! Form::select('membership_id', $memberships, null) !!}
            @error('membership_id')
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
