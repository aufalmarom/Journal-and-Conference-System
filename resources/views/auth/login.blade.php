@extends('layouts.master.app')

@section('content')

@if ($message = Session::get('success_register'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>{{$message}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>


@endif

    <div class="container-fluid">
        <div class="row h-100">
            <main class="main-content col">
                <div class="main-content-container container-fluid px-4 my-auto h-100">
                    <div class="row no-gutters h-100">
                        <div class="col-lg-3 col-md-5 auth-form mx-auto my-auto"><br><br><br><br>
                            <div class="card">
                            <div class="card-body">
                                <img class="auth-form__logo d-table mx-auto mb-3" src="storage/app/public/{{$data->logo}}" alt="Brand">
                                <h5 class="auth-form__title text-center mb-4">Login {{$data->brand}} </h5>
                                <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter email" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-pill btn-accent d-table mx-auto">Access Account</button>
                                </form>
                            </div>
                            {{-- <div class="card-footer border-top">
                                <ul class="auth-form__social-icons d-table mx-auto">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fas fa-envelope"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                </ul>
                            </div> --}}
                            </div>
                            <div class="auth-form__meta d-flex mt-4">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            @if (Route::has('register'))
                                <a class="ml-auto" href="{{ route('register') }}">Create New Account?</a>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
              </main>
        </div>





    </div>
@endsection
