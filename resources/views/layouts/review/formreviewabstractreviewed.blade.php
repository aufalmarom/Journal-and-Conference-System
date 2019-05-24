@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Review Abstract Reviewed</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Meta Data Abstract Reviewed Author</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Title : {{$abstract->submissions->title}}</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Topic : {{$abstract->submissions->topics->title}}</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <textarea disabled="disabled" rows="100" class="ckeditor" name="ck_input" id="editor" required>{{$abstract->abstract_after_review}}</textarea>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                </li>
            </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Review Abstract Reviewed</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                    <form method="POST" action="{{route('reviewabstractreviewed.send')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$abstract->id_paper}}">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Abstract*</label>
                                <textarea rows="100" class="ckeditor" name="ck_input" id="editor" required></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Detail Comments</label>
                                <textarea class="form-control" rows="10" name="comments" id="editor" placeholder="Detail Comments" ></textarea>
                            </div>
                        </div>
                        <div class="row text-left">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-accent">Submit Abstract Reviewed</button>
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
