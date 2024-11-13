@extends('layout.main')

@section('title', 'Halo Data Table')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Hello Highcharts</h1>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        This chart shows the use of a logarithmic y-axis. Logarithmic axes can be useful when dealing with data with spikes or large value gaps, as they allow variance in the smaller values to remain visible.
    </p>
</figure>

<script>
Highcharts.chart('container', {
    title: {
        text: 'Growth of Internet Users Worldwide (logarithmic scale)'
    },
    accessibility: {
        point: {
            valueDescriptionFormat: '{xDescription}{separator}{value} million(s)'
        }
    },
    xAxis: {
        title: {
            text: 'Year'
        },
        categories: [1995, 2000, 2005, 2010, 2015, 2020, 2023]
    },
    yAxis: {
        type: 'logarithmic',
        title: {
            text: 'Number of Users (millions)'
        }
    },
    series: [{
        name: 'Users',
        data: [16, 78, 360, 1000, 2200, 3800, 5000]
    }]
});
</script>
</body>
</html>
@endsection
