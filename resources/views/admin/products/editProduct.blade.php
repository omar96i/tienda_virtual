@extends('template.template_main')

@section('content')
    <section id="app">
        <form-product :category="{{$category}}" :product="{{$product}}" type="update"></form-product>
    </section>
@endsection
