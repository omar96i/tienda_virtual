@extends('template.template_main')

@section('content')
    <section id="app">
        <hr>
        <div class="container-fluid">
            <h3 class="mt-5">Products</h3>
        </div>
        <hr>
        <store-product :category="{{$category}}"></store-product>
        <index-product :products="{{$products}}"></index-product>
    </section>

@endsection
