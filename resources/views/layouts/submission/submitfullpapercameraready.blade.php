@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Full Paper Camera Ready</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('fullpapercameraready.read')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Submit Full Paper Camera Ready</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                    <form method="POST" action="{{route('fullpapercameraready.post')}}" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="id" value="{{$data->id_paper}}">
                        <input type="hidden" name="topic" value="{{$data->submissions->topics->title}}">
                        <input type="hidden" name="title" value="{{$data->submissions->title}}">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label>Title : {{$data->submissions->title}}</label>
                            </div>
                        </div>
                        <label>Upload Document Full Paper Camera Ready*</label>
                        <div class="form-row">
                            <div class="form-group">
                                <input type="file"  name="file" class="form-control" required>
                            <p class="small">*file type : .docx & .doc; max size : 5MB*</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Additional Info</label>
                                <textarea class="form-control" rows="10" name="comments"></textarea>
                            </div>
                        </div>
                        <div class="row text-left">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-accent">Submit Paper Camera Ready</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                </li>
            </ul>
            </div>
        </div>
    </div>

@endsection
