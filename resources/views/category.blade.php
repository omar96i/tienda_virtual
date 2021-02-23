@extends('template.template_main')

@section('content')
    <section id="app">
        <div class="container">
            <h3 class="mt-5">Categories</h3>
        </div>
        <hr>
        <store-category></store-category>
        <index-category :categories="{{ $categories }}" ref="categories"></index-category>
    </section>
@endsection
