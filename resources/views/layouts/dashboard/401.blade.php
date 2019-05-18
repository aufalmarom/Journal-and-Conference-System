@extends('layouts.master.dashboard')

@section('content')

    <div class="error">
        <div class="error__content">
          <h2>401</h2>
          <h3>Unauthorized!</h3>
          <p>Access to this resource is denied.</p>
            <a href="{{route('dashboard')}}" class="btn btn-accent btn-pill">&larr; Go Back</a>
        </div>
        <!-- / .error_content -->
      </div>

@endsection
