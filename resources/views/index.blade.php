@extends('layouts.app')

@php
    if ($errors->any()) {
        flash('Not a valid url')->error();
    }
@endphp
@include('flash::message')

@section('container')
    <div class="flex-center">
        <div class="content">
            <h1>Page Analyzer</h1>
            <h4>Check web pages for free</h4>
            <div>
                <form action="{{ route('domains.store') }}" method="POST">
                    @csrf
                    <input type="url" name="domain" value="" placeholder="https://www.google.com">
                    <input class="button" type="submit" value="CHECK">
                </form>
            </div>
        </div>
    </div>
@endsection
