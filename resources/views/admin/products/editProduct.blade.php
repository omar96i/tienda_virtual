@extends('template.template_main')

@section('content')
    <section id="app">
        <edit-product :category="{{$category}}" :product="{{$product}}"></edit-product>
    </section>
@endsection
