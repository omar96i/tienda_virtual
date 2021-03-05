@extends('template.template_main')

@section('content')

<section id="app" class="container-fluid">
    @foreach ($categories as $item)
        @if (count($item->product)>0)
        <div class="row bg-info">
            <h2 class="ml-5 p-3"><a class="text-white" href="{{ route('products.categories',array('id' => $item->id, 'tipo' => 'vista'))}}">{{$item->name}}</a></h2>
        </div>

            <div>
                <products-with-category :categories="{{$item}}"></products-with-category>
            </div>
        @endif
    @endforeach
</section>
@endsection
