@extends('layouts.layout-dashboard')

@section('stats')

    <div class="statistics-box">

        <div class="graph">
            {!! $chartjs1->render() !!}
        </div>

        <div class="graph">
            {!! $chartjs2->render() !!}
        </div>

    </div>

@endsection