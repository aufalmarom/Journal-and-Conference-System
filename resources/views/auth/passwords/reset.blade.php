@extends('layouts.master.app')

@section('content')



<div class="container-fluid">
    <div class="row h-100">
        <main class="main-content col">
            <div class="main-content-container container-fluid px-4 my-auto h-100">
                <div class="row no-gutters h-100">
                    <div class="col-lg-10 col-md-10 auth-form mx-auto my-auto"><br><br><br><br>
                        <div class="card">
                            <div class="card-body">
                                <img class="auth-form__logo d-table mx-auto mb-3" src="{{asset('public/Logo.png')}}" alt="Brand">
                                <h5 class="auth-form__title text-center mb-4">Reset Password</h5>
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group row">
                                        <label for="email" class="col-md-5 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-7">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-5 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-7">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-5 col-form-label text-md-right">{{ __('Confirm Pass') }}</label>

                                        <div class="col-md-7">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Reset Password') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

@endsection
