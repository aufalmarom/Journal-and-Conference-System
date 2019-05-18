@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
            <h3 class="page-title">Key Notes Section</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('lp.read')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
        </div>
    </div>
    <br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{$message}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if($message = Session::get('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8 mb-4">
          <div class="card card-small mb-4">
            <ul class="list-group list-group-flush">
              <li class="list-group-item p-3">

                <div class="row">
                  <div class="col-sm-12 col-md-12">
                    <form method="POST" action="{{route('guidelines.post')}}" enctype="multipart/form-data">
                        @csrf
                        <strong class="text-muted d-block mb-2">File Guidelines</strong>
                        <div class="form-group custom-file">
                            <input type="file" name="guidelines" class="custom-file-input" required>
                                <label class="custom-file-label" for="validatedCustomFile">{{$datas->guidelines}}</label>
                        </div>
                        <div class="border-bottom">
                        </div>
                        <p class="small">*format file : pdf</p>
                        <button type="submit" class="mb-2 btn btn-primary mr-2">Save</button>
                    </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
    </div>

@endsection
