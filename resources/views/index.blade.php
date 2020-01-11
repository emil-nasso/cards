@extends('layouts.app')

@section('content')
    <posts :categories="{{$categories}}"></posts>
@endsection
