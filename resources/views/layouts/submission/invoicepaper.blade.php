@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Invoice</span>
        <h3 class="page-title">Paper</h3>
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
    @elseif($message = Session::get('fail'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('abstractsubmitted.read')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
        </div>
    </div>
    <br>

    @if ($data == NULL)
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Please waiting invoice from Administrator or you can send email to administrator ictcred@live.undip.ac.id</h6>
                </div>
            </div>
        </div>
    </div>
    @else
        @if ($data->nominal_transfered == NULL && $data->file_proof == NULL)
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                <div class="card card-small">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Pembayaran Invoice-#{{$data->no_invoice}}</h6>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-small list-group-flush">
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">Please pay to <b>Bank Mandiri</b> with Virtual Account(VA) - {{$data->va}} a.n Panitia ICTCRED 2019 -  {{Rupiah($data->price)}},-</span>
                        </li>
                        </ul>
                    </div>
                    <form method="POST" action="{{route('fileproofpaper.post')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-footer">
                            <p>Upload Transaction Proof</p>
                            <input type="hidden" name="no_invoice" value="{{$data->no_invoice}}">
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="feEmailAddress">Nominal Transfered</label>
                                    <input type="text" class="form-control" name="nominal_transfered"  placeholder="Nominal Transfered" value="{{$data->nominal_transfered}}">
                                    <p class="small-text">nominal transfered must match with bill</p>
                                </div>
                            </div>
                            <div class="form-group custom-file">
                                <input type="file" name="file_proof" class="custom-file-input" required>
                                    <label class="custom-file-label">{{$data->file_proof}}</label>
                            </div>
                                <p class="small">*format file : png/jpeg; max size : 1MB</p>

                            <button type="submit" class="btn btn-accent">Upload Transaction Proof</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        @elseif($data->nominal_transfered != NULL && $data->file_proof != NULL && $data->status_payment == NULL)


        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="card card-small">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Transaction proof was uploaded. Please waiting confirm from Administrator or send email to administrator ictcred@live.undip.ac.id</h6>
                    </div>
                </div>
            </div>
        </div>

        @elseif($data->nominal_transfered != NULL && $data->file_proof != NULL && $data->status_payment == 0)
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                <div class="card card-small">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Pembayaran Invoice-#{{$data->no_invoice}}</h6>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-small list-group-flush">
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">Please pay to <b>Bank Mandiri</b> with Virtual Account(VA) - {{$data->va}} a.n Panitia ICTCRED 2019 - Rp. {{$data->price}},-</span>
                        </li>
                        </ul>
                    </div>
                    <form method="POST" action="{{route('fileproofpaper.post')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-footer">
                            <p>Upload Transaction Proof</p>
                            <input type="hidden" name="no_invoice" value="{{$data->no_invoice}}">
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="feEmailAddress">Nominal Transfered</label>
                                    <input type="text" class="form-control" name="nominal_transfered"  placeholder="Nominal Transfered" value="{{$data->nominal_transfered}}">
                                </div>
                            </div>
                            <div class="form-group custom-file">
                                <input type="file" name="file_proof" class="custom-file-input" required>
                                    <label class="custom-file-label">{{$data->file_proof}}</label>
                            </div>
                                <p class="small">*format file : png/jpeg; max size : 1MB</p>

                            <button type="submit" class="btn btn-accent">Upload Transaction Proof</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @elseif($data->nominal_transfered != NULL && $data->file_proof != NULL && $data->status_payment == 1)
        <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
                    <div class="card card-small">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Invoice #{{$data->no_invoice}}</h6>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-small list-group-flush">
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">ID Paper</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">P - {{$data->id_paper}}</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">Title</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">{{$data->submissions->title}}</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">Status</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">{{StatusPaper($data->id)}}<a>
                        </li>
                        </ul>
                        @if ($data->status_payment != NULL)
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">QR Code</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate('No. Invoice : '.$data->no_invoice." ".'ID User :'.$data->id_paper)) !!} "></span>

                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-center text-semibold text-fiord-blue">Please Save or Screenshoot this QR Code for re-registration. See you on Sept 17 at Gumawa Hotel Semarang!</span>
                        </li>
                        @endif
                        </ul>
                    </div>
                    </div>

                </div>
            </div>
        @endif
    @endif

   @endsection
