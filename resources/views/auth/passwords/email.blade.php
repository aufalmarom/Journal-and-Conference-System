@extends('layouts.master.app')

@section('content')

<div class="container-fluid">
    <div class="row h-100">
        <main class="main-content col">
            <div class="main-content-container container-fluid px-4 my-auto h-100">
                <div class="row no-gutters h-100">
                    <div class="col-lg-3 col-md-5 auth-form mx-auto my-auto"><br><br><br><br>
                        <div class="card">
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <img class="auth-form__logo d-table mx-auto mb-3" src="{{asset('public/Logo.png')}}" alt="Brand">
                                <h5 class="auth-form__title text-center mb-4">Reset Password</h5>
                                <form method="POST" action="{{ route('password.email') }}">
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
                                <button type="submit" class="btn btn-pill btn-accent d-table mx-auto">Send Password Reset Link</button>
                                </form>
                            </div>
                            <div class="card-footer border-top">
                                <ul class="auth-form__social-icons d-table mx-auto">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fas fa-envelope"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>





</div>

@endsection
