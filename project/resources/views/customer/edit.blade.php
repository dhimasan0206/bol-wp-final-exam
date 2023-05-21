@extends('adminlte::page')

@section('title', 'Edit Customer')

@section('content_header')
    <h1>Edit Customer</h1>
@stop

@section('content')
    <form action="{{route('customers.update', ['customer' => $customer->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div>
            {!! Form::label('name', 'Name', []) !!}
        </div>
        <div>
            {!! Form::text('name', $customer->name, []) !!}
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('address', 'Address', []) !!}
        </div>
        <div>
            {!! Form::text('address', $customer->address, []) !!}
            @error('address')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('membership_id', 'Membership', []) !!}
        </div>
        <div>
            {!! Form::select('membership_id', $memberships, $customer->membership_id) !!}
            @error('membership_id')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <button type="submit">Save Changes</button>
        </div>
    </form>
@stop

@section('css')
@stop

@section('js')
@stop
