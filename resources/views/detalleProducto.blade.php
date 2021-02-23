@extends('template.template_main')

@section('content')
<section id="app">
    <div>
        <detalle-producto :products="{{ $products }}"></detalle-producto>
    </div>
</section>

@endsection
