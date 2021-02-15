@extends('template.template_main')

@section('content')
    <section id="app">
        <div class="container">
            <h3 class="mt-5">Categories</h3>
        </div>
        <hr>
        <add-category></add-category>
        <category :categories="{{ $categories }}" ref="categories"></category>
    </section>
@endsection
