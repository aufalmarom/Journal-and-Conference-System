@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Review Abstract Final</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('reviewabstractfinal.read')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Meta Data Abstract Final Author</h6>
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
                                <label>Presentation : {{$abstract->submissions->presentation}}</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <textarea disabled="disabled" rows="100" class="ckeditor" name="ck_input" id="editor" required>{{$abstract->abstract_final}}</textarea>
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
                <h6 class="m-0">Decision of Presentation Abstract Final</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                    <form method="POST" action="{{route('reviewabstractfinal.send')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$abstract->id_paper}}">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Presentation*</label>
                                <div class="custom-radio mb-1">
                                    <label><input type="radio" name="presentation" value="Poster">
                                    Poster Presentation</label>
                                </div>
                                <div class="custom-radio mb-1">
                                    <label><input type="radio" name="presentation" value="Oral">
                                    Oral Presentation</label>
                                </div>
                            </div>
                        </div>
                        <div class="row text-left">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-accent">Submit Presentation Abstract Final</button>
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
