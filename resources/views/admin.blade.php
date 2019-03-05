@extends('master-layout')

@section('title', 'Golfito')

@section('headscript')
@endsection

@section('header')
    @if ( $header == 'dashboard' )
        @include('includes.header')
    @endif
@endsection

@section('container')
    @include('includes.'.$container)
@endsection

@section('footerscript')
@endsection