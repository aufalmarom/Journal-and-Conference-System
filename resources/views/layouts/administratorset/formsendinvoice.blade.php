@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Participant</span>
            <h3 class="page-title">Send Invoice</h3>
        </div>
    </div>
    <!-- End Page Header -->

    @if ($data == NULL)
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Account Details</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                    <div class="row">
                        <div class="col">
                        <form method="POST" action="{{route('invoice.post')}}">
                        @csrf
                        <input type="hidden" name="id_user" value="{{$participant->id}}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Price</label>
                                    <input type="number" class="form-control" name="price" placeholder="Price">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Virtual Account</label>
                                <input type="number" class="form-control" name="va" placeholder="Virtual Account">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-accent">Send Invoice</button>
                        </form>
                        </div>
                    </div>
                    </li>
                </ul>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Account was received invoice.</h6>
                    </div>
                </div>
            </div>
        </div>
    @endif


@endsection
