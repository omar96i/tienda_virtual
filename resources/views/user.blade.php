@extends('template.template_main')

@section('content')
<section id="app">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-4">
                <register-admin type="admin"></register-admin>
            </div>
            <div class="col-8">
                <user :users="{{ $users }}"></user>
            </div>
        </div>
    </div>


</section>

@endsection
