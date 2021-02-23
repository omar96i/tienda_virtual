@extends('template.template_main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Sign In</h5>
                        <form class="form-signin" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Login</button>

                            </div>
                            <a href="{{route('register')}}">Register new user</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="app">

    </div>

@endsection
