@extends('layouts.app')
@section('content')
asdasdasd
<div id="chart" style="height: 400px"></div>
<div id="chart1" style="height: 300px"></div>
<!-- Charting library -->

{{-- <script src="https://unpkg.com/chart.js@3.1.1/dist/chart.min.js"></script> --}}
{{-- <script src="https://unpkg.com/@chartisan/chartjs/dist/chartisan_chartjs.js"></script> --}}
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
<script>
    const chart = new Chartisan({
        el: '#chart',
        // url: "@chart('test_chart')",
        data: {
            chart: { "labels": ["First", "Second", "Third"] },
            datasets: [
                { "name": "Sample 1", "values": [10, 3, 7] },
                // { "name": "Sample 2", "values": [5, 6, 2] }
            ],
        },
        hooks: new ChartisanHooks()
            // .beginAtZero()
            .colors()
            // .borderColors()
            .datasets([{ type: 'line', fill: false }, 'bar']),
    });
    
    // chart.destroy();
</script>
sdfsf
@endsection