@extends('layouts.default')

@section('title')
Cloudflare
@stop

@section('controls')
<p class="lead">Here is your visitor stats:</p>
<hr>
@stop

@section('content')
<?php $traffic = $stats['response']['result']['objs']['0']['trafficBreakdown']; ?>
<div class="well">
    <table class="table">
        <thead>
            <th>Type</th>
            <th>Regular</th>
            <th>Threat</th>
            <th>Crawler</th>
            <th>Total</th>
        </thead>
        <tbody>
            <tr>
                <td>Page Views</td>
                <td>{{ $traffic['pageviews']['regular'] }}</td>
                <td>{{ $traffic['pageviews']['threat'] }}</td>
                <td>{{ $traffic['pageviews']['crawler'] }}</td>
                <td>{{ $traffic['pageviews']['regular']+$traffic['pageviews']['threat']+$traffic['pageviews']['crawler'] }}</td>
            </tr>
            <tr>
                <td>Unique Visitors</td>
                <td>{{ $traffic['uniques']['regular'] }}</td>
                <td>{{ $traffic['uniques']['threat'] }}</td>
                <td>{{ $traffic['uniques']['crawler'] }}</td>
                <td>{{ $traffic['uniques']['regular']+$traffic['uniques']['threat']+$traffic['uniques']['crawler'] }}</td>
            </tr>
        </tbody>
    </table>
</div>
@stop
