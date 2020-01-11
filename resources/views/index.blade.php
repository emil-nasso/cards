@extends('layouts.app')

@section('content')
    <posts :posts="{{$posts}}"></posts>
@endsection
