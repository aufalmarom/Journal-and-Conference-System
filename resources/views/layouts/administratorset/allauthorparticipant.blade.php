@extends('layouts.master.dashboard')

@section('content')

    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Re-registration</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
            <div class="col">
              <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                  <h6 class="m-0">All Participants & Authors</h6>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                  <table class="table mb-0">
                    <thead class="bg-light">
                      <tr>
                        <th scope="col" class="border-0">No</th>
                        <th scope="col" class="border-0">Name</th>
                        <th scope="col" class="border-0">Email</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($datas as $data)
                      <tr>
                      <td>{{$no}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                      </tr>
                      @php
                          $no++;
                      @endphp
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

   @endsection
