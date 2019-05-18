@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Invoice</span>
        <h3 class="page-title">Participant</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('dashboard')}}"><i class="material-icons">keyboard_arrow_left</i> Back to Dashboard</a>
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
                        <h6 class="m-0">Pembayaran</h6>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-small list-group-flush">
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">Please pay to <b>Bank Mandiri</b> with Virtual Account(VA) - {{$data->va}} a.n Panitia ICTCRED 2019 - Rp. {{$data->price}},-</span>
                        </li>
                        </ul>
                    </div>
                    <form method="POST" action="{{route('fileproof.post')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-footer">
                            <p>Upload Transaction Proof</p>
                            <input type="hidden" name="no_invoice" value="{{$data->no_invoice}}">
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="feEmailAddress">Nominal Transfered</label>
                                    <input type="text" class="form-control" name="nominal_transfered" id="feEmailAddress" placeholder="Nominal Transfered" value="{{$data->nominal_transfered}}">
                                </div>
                            </div>
                            <div class="form-group custom-file">
                                <input type="file" name="file_proof" class="custom-file-input" required>
                                    <label class="custom-file-label" for="validatedCustomFile">{{$data->file_proof}}</label>
                            </div>
                                <p class="small">*format file : png/jpeg; max size : 1MB</p>

                            <button type="submit" class="btn btn-accent">Upload Transaction Proof</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        @elseif($data->nominal_transfered != NULL && $data->file_proof != NULL && $data->status == NULL)


        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="card card-small">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Transaction proof was uplaoded. Please waiting confirm from Administrator or send email to administrator ictcred@live.undip.ac.id</h6>
                    </div>
                </div>
            </div>
        </div>

        @elseif($data->nominal_transfered != NULL && $data->file_proof != NULL && $data->status != NULL)
        <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                    <div class="card card-small">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Invoice #{{$data->no_invoice}}</h6>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-small list-group-flush">
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">ID User</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">P - {{$data->id_user}}</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">Name</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">{{Auth::user()->name}}</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">Email</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">{{Auth::user()->email}}</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">Address</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">{{Auth::user()->alamat}}</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">Affiliation</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">{{Auth::user()->affiliation}}</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">Status</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">{{StatusParticipant()}}</span>
                        </li>
                        </ul>
                        @if ($data->status != NULL)
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">QR Code</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate('No. Invoice : '.$data->no_invoice.'ID User :'.$data->id_user)) !!} "></span>

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
