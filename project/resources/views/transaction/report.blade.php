@extends('adminlte::page')

@section('title', 'Reports')

@section('content_header')
    <h1>Reports</h1>
@stop

@section('content')
    <h3>Total Profit Report Rp {{ number_format($profit) }}</h3>
    <hr>
    <h3>By Currency By Month Report</h3>
    <form action="{{route('transactions.report')}}" method="GET">
        <div>
            {!! Form::label('year', 'Year') !!}
        </div>
        <div>
            {!! Form::select('year', $years, $year) !!}
            @error('year')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('month', 'Month') !!}
        </div>
        <div>
            {!! Form::select('month', $months, $month) !!}
            @error('month')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            {!! Form::label('currency', 'currency') !!}
        </div>
        <div>
            {!! Form::select('currency', $currencies, $currency) !!}
            @error('currency')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <button type="submit">View</button>
        </div>
    </form>
    <div>
        <canvas id="chart"></canvas>
    </div>
@stop

@section('css')
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    var labels =  {{Js::from($labels)}};
    var values =  {{Js::from($data)}};
    const data = {
        labels: labels,
        datasets: [{
            label: 'Report {{$currency}} {{$month}} {{$year}}',
            data: values,
        }]
    };
    const config = {
        type: 'line',
        data: data
    };

    const all = new Chart(
        document.getElementById('chart'),
        config
    );
</script>
@stop
