@extends('template.template_main')

@section('content')
    <section id="app">
        <hr>
        <div class="container">
            <h3 class="mt-5">Products</h3>
        </div>
        <hr>
        <add-product :category="{{$category}}"></add-product>
        <product :products="{{$products}}"></product>
    </section>

@endsection
