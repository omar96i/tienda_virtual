@extends('template.template_main')

@section('content')

<section id="app">

    @foreach ($categories as $item)
    <h2><a href="{{ route('products.categories',array('id' => $item->id, 'tipo' => 'vista'))}}">{{$item->name}}</a></h2>

    <div>
        <products-with-category :categories="{{$item}}"></products-with-category>
    </div>
    @endforeach

</section>
@endsection
