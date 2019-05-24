@extends('layouts.master.app')

@section('content')

<div class="container-fluid icon-sidebar-nav h-100">
    <div class="row h-100">
        <main class="main-content col">
            <div class="main-content-container container-fluid px-4 my-auto h-100">
                <div class="row no-gutters h-100">
                    <div class="col-lg-5 col-md-5 auth-form mx-auto my-auto">
                        <br><br>
                        <div class="card">
                            <div class="card-body">
                                <img class="auth-form__logo d-table mx-auto mb-3" src="storage/app/public/{{$data->logo}}" alt="Brand">
                                <h5 class="auth-form__title text-center mb-4">Create New Account</h5>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Full Name</label>
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Enter name" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter email" required>

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputPassword2">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">Register As</label>
                                        <div class="custom-radio mb-1">
                                            <label><input type="radio" name="role" value="3" id="formsRadioDefault">
                                            Author + Participant Seminar</label>
                                        </div>
                                        <div class="custom-radio mb-1">
                                            <label><input type="radio" name="role" value="4" id="formsRadioDefault">
                                            Participant Seminar Only</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-pill btn-accent d-table mx-auto">Create Account</button>
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
                            <a href="{{ route('password.request') }}">Forgot your password?</a>
                            <a class="ml-auto" href="{{ route('login') }}">Sign In?</a>
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

@endsection
