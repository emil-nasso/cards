@extends('layouts.app')

@section('content')
    <vego-app :categories="{{$categories}}"></vego-app>
@endsection
