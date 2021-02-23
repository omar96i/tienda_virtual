@extends('template.template_main')

@section('content')
<section id="app">

    <h3>@php
        echo $products[0]->categories->name;
    @endphp</h3>
    <div>
        <category-with-products :products="{{$products}}"></category-with-products>
    </div>

</section>

@endsection
