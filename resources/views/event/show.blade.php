@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            {{ $event->title }}
            <img src="{{ asset("storage/" . $event->foto) }}">
        </div>
    </div>
@endsection