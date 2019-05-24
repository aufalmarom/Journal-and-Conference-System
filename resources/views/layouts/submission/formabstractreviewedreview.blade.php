@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Abstract Final</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('abstractreviewedreviewauthor.read')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col">
            @if (@$abstract[0]->abstractfinal[0]->id_paper == NULL)
            <form method="POST" action="{{route('abstractfinal.post')}}">
                @csrf
                <input type="hidden" name="id" value="{{$abstract[0]->id_paper}}">
                <button type="submit" class="btn btn-accent">Submit Abstract Final <i class="material-icons">send</i> </button>
            </form>
            @else
                <button class="btn btn-accent">Abstract Final was submitted<i class="material-icons"></i> </button>
            @endif

        </div>
    </div>
    <br>

    @php
        $no = 1;
    @endphp
    @foreach ($abstract as $data)

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Reviewer {{$no}} </h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                        @if ($data->abstract_after_review_revision == NULL)
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Reviewer not yet review.</label>
                            </div>
                        </div>
                        @else
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Title : {{$data->submissions->title}}</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Content Abstract Reviewed After Review</label>
                                <textarea disabled="disabled" rows="100" class="ckeditor" id="editor" required>{{$data->abstract_after_review_revision}}</textarea>
                                <br>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Detail Comments</label>
                                <textarea class="form-control" disabled="disabled" rows="10" required>{{$data->comments}}</textarea>
                                <br>
                            </div>
                        </div>

                        @endif

                    </div>
                </div>
                </li>
            </ul>
            </div>
        </div>
    </div>




    @php
    $no++;
    @endphp
    @endforeach




@endsection
