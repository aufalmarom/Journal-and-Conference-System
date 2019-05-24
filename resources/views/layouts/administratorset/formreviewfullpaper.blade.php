@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Review Full Paper</h3>
        </div>
    </div>
    <!-- End Page Header -->

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @elseif($message = Session::get('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('reviewfullpaper.read')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
        </div>
    </div>
    <br>


    <div class="row">
        <div class="col-lg-12">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Upload Paper Review</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                        <form method="POST" action="{{route('reviewfullpaper.post')}}" enctype="multipart/form-data">
                            @csrf
                            <label>Upload Document Full Paper Review*</label>
                            <div class="form-row">
                                <div class="form-group">
                                    <input type="hidden" name="id_paper" value="{{$paper->id_paper}}">
                                    <input type="hidden" name="title" value="{{$paper->submissions->title}}">
                                    <input type="hidden" name="topic" value="{{$paper->submissions->topics->title}}">
                                    <input type="file"  name="file" class="form-control" required>
                                <p class="small">*file type : .docx & .doc; max size : 5MB*</p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Detail Comments</label>
                                    <textarea class="form-control" rows="10" name="comments"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-accent">Submit Paper Review</button>
                        </form>
                    </div>
                </div>
                </li>
            </ul>
            </div>
        </div>
    </div>

@endsection
