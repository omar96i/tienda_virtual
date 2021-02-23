@extends('template.template_main')

@section('content')

    @role('admin')
        <section class="container mt-5">
            <h5>Welcome {{ auth()->user()->name }}  </h5>
        </section>
    @else

        <section id="app">
            <div>
                <home-products :products="{{ $products }}"></home-products>
            </div>
        </section>
    @endrole


@endsection
