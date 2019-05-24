@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
            <h3 class="page-title">Author</h3>
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
    @endif

    @if($message = Session::get('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{$message}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (CekStatusFormVerif() == NULL)
    <div class="row">
            <div class="col-lg-6">
                <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Verfication Personal Data</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                    <div class="row">
                        <div class="col">
                        <form method="POST" action="{{route('authorid.post')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <select class="form-control" name="id_author_categories">
                                            @foreach ($datas as $data)
                                                <option value="{{$data->id}}">{{$data->categories}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                                <label>Upload Document Proof(ID Card/KTP/KTM)</label>
                                <div class="form-group custom-file">
                                    <input type="file" name="doc_proof" class="custom-file-input" required>
                                    <label class="custom-file-label"">{{$data->doc_proof}}</label>
                                    <p class="text-small">Overseas Participant : Passport</p>
                                    <p class="text-small">General Participant : KTP</p>
                                    <p class="text-small">Undergraduate Participant : KTM</p>
                                    <p class="text-small">format file : .jpg, .jpeg, max size : 1 MB</p>
                                </div>
                            <button type="submit" class="btn btn-accent">Send</button>
                        </form>
                        </div>
                    </div>
                    </li>
                </ul>
                </div>
            </div>
        </div>
    @elseif(CekStatusVerifikasiAuthorInfo() == NULL)
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
            <div class="card-header border-bottom">
            <h6 class="m-0">Please waiting personal data verification from Adminstrator!</h6>
            </div>
            </div>
        </div>
    </div>
    @elseif(CekStatusVerifikasiAuthorInfo() != NULL)
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
            <div class="card-header border-bottom">
            <h6 class="m-0">Personal Data was verified</h6>
            </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('dashboard')}}"><i class="material-icons">keyboard_arrow_left</i> Back to Dashboard</a>
        </div>
    </div>
    <br>

    @endif



@endsection
