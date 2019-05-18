@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
            <h3 class="page-title">News Letter Section</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col">
            <a class="btn btn-accent" href="{{route('lp.read')}}"><i class="material-icons">keyboard_arrow_left</i> Back</a>
        </div>
    </div>
    <br>

    {{-- <form method="POST" action="{{route('newsletter.blast')}}">
        @csrf
        <button type="submit" class="mb-2 btn btn-primary mr-2">Blast E-mail</button>
    </form> --}}

    <!-- Default Light Table -->
    <div class="row">
        <div class="col-sm-6">
          <div class="card card-small mb-4">
            <div class="card-header border-bottom">
              <h6 class="m-0">E-mail Subscribers</h6>
            </div>
            <div class="card-body p-0 pb-3 text-center">
              <table class="table mb-0">
                  @php
                      $no = 1;
                  @endphp
                <thead class="bg-light">
                  <tr>
                    <th scope="col" class="border-0">No.</th>
                    <th scope="col" class="border-0">E-Mail</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$data->email}}</td>
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- End Default Light Table -->






@endsection
