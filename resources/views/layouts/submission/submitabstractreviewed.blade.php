@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Submit Abstract Reviewed</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('abstractafterreview.read')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Meta Data Paper</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                    <form method="POST" action="{{route('submitabstractreviewed.post')}}">
                    @csrf
                        <input type="hidden" name="id" value="{{$reviewed->id}}">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Title : {{$reviewed->title}}</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Abstract*</label>
                                <textarea rows="10" class="ckeditor" name="ck_input" id="editor" required></textarea>
                            </div>
                        </div>
                        <div class="row text-left">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-accent">Submit Paper</button>
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
