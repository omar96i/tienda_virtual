@extends('template.template_main')

@section('content')
    <section id="app">
        <div>
            <home-products :products="{{ $products }}"></home-products>
        </div>
    </section>

@endsection
