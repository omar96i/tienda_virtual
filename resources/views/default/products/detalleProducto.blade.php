@extends('template.template_main')

@section('content')
<div class="container-fluid mt-4 p-5">
    <section id="app">
        <div>
            <detalle-producto :products="{{ $products }}"></detalle-producto>
        </div>
    </section>
</div>


@endsection
