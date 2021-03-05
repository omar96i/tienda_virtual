@extends('template.template_main')

@section('content')
<section id="app">


    <div class="row bg-info">
        <h2 class="ml-5 p-3"><a class="text-white">{{$products[0]->categories->name}}</a></h2>
    </div>
    <div>
        <category-with-products :products="{{$products}}"></category-with-products>
    </div>

</section>

@endsection
