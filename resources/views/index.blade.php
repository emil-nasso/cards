@extends('layouts.app')

@section('menu')
    <navigation-menu :categories="{{$categories}}"></navigation-menu>
@endsection

@section('content')
    <posts :categories="{{$categories}}"></posts>
@endsection
