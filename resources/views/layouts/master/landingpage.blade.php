<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ICTCRED 2019</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="public/landingpage/css/shards.min.css?version=2.1.0">
        <link rel="stylesheet" href="public/landingpage/css/shards-extras.min.css?version=2.1.0">
        <link rel="stylesheet" href="public/landingpage/css/style.css">
        <link rel="shortcut icon" href="public/logo.png">
        <link href="public/iconpicker/css/bootstrap-iconpicker.min.css" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    </head>
    <body class="shards-landing-page--1">

        <div class="loader">
            <div class="page-loader"></div>
        </div>

        <!-- Welcome Section -->
        <div class="welcome d-flex justify-content-center flex-column">
            <div class="container">
                <!-- Navigation -->
                <nav class="navbar navbar-expand-lg navbar-dark pt-4 px-0">
                <a class="navbar-brand" href="/">
                    <img src="storage/app/public/{{$data->logo}}" class="mr-2">
                    {{$data->brand}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav nav bg-faded">
                    <li class="nav-item active">
                    <a class="nav-link" href="{{route('landingpage.read')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#topics-scopes">Topics & Scopes</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#important-dates">Important Dates</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#guidelines">Guidelines</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#publication">Publication</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#faq">FAQs</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#contact-us">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('login')}}" class="btn btn-md btn-outline-white btn-pill align-self-center">Login</a>
                    </li>
                    </ul>
                </div>
                </nav>
                <!-- / Navigation -->
            </div>
            <!-- .container -->


            <!-- Inner Wrapper -->
            <div class="inner-wrapper mt-auto mb-auto container">
                <div class="row">
                <div class="col-md-12">
                    @if ($message = Session::get('success1'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{$message}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h1 class="welcome-heading display-7 text-white"> {{$data->title}}</h1>
                        <p class="text-white">{{Bulan(date('m',strtotime($data->date_from)))}} {{RangeDate()}} | {{$data->location}}</p>
                    <a href="{{route('register')}}" class="btn btn-lg btn-outline-white btn-pill align-self-center">Registration</a>
                </div>
                </div>
            </div>
            <!-- / Inner Wrapper -->
        </div>
        <!-- / Welcome Section -->

        <!-- Topics & Scopes -->
        <div id="topics-scopes" class="our-services section py-4"><br>
        <h2 class="text-center">CALL FOR PAPER</h2><br>
        <h3 class="section-title text-center my-4">Topics & Scopes</h3>
            <div class="row justify-content-md-center">
                <div class="col-sm-9">
                    <h4 class="text-center">"{{$data->main_theme}}"</h4>
                    <p class="text-center">{{$data->overview}}</p>
                </div>
            </div>
        <!-- Features -->

        <div class="features py-4 mb-4">
            <div class="container">
            @php
                $nomor_row = 3;
            @endphp
            @foreach ($data1 as $data)
            @if ($nomor_row % 3 == 0)
            <div class="row">
            @endif
                    <div class="feature py-4 col-md-4 d-flex">
                    <div class="icon text-primary mr-3"><i class="{{$data->favicon}}"></i></div>
                    <div class="px-4 text-left">
                        <br>
                        <h5>{{$data->title}}</h5>
                    </div>
                    </div>
            @if (count($data1) % 3 != 0 && $nomor_row == count($data1) + 2)
            </div>
            @endif
            @if ($nomor_row % 3 == 2)
            </div>
            @endif
            @php
                $nomor_row++;
            @endphp
            @endforeach
            </div>
        </div>
        <!-- / Features -->
        </div>
        <!-- / Topics & Scopes -->

        <!-- Important Dates -->
        <div id="important-dates" class="app-features section-invert">
            <div class="container-fluid">
                <div class="row">
                <!-- App Features Wrapper -->
                    <div class="app-features-wrapper col-lg-4 col-md-6 col-sm-12 py-5 mx-auto">
                        <div class="container">
                        <h3 class="section-title text-center my-5">Important Dates</h3>
                        @foreach ($data2 as $data)
                            <div class="feature py-1 d-flex">
                                <div class="icon text-white bg-success mr-5"><i class="{{$data->favicon}}"></i></div>
                                <div>
                                    <h5>{{$data->title}}</h5>
                                    <p>{{date('Y',strtotime($data->date_from))}}, {{RangeDateImportantDate($data->id)}}</p>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Important Dates -->


        <!-- Key Notes -->
        <div id="key-notes" class="testimonials section py-4">
            <h3 class="section-title text-center m-5">Key Notes</h3>
            <div class="container py-5">
                @php
                    $row = 3;
                @endphp
                @foreach ($data3 as $data)
                @if ($row % 3 == 0)
                    <div class="row">
                    @endif
                        <div class="col-md-4 testimonial text-center">
                            <div class="avatar rounded-circle with-shadows mb-3 ml-auto mr-auto">
                                <img src="storage/app/public/keynotes/{{$data->photo}}" class="w-100" alt="Avatar" />
                            </div>
                            <h5 class="mb-1">{{$data->name}}</h5>
                            <span class="text-muted d-block mb-2">{{$data->sector}}</span>
                            <p>{{$data->description}}</p>
                        </div>
                @if (count($data3) % 3 != 0 && $row == count($data3) + 2)
                </div>
                @endif
                @if ($row % 3 == 2)
                    </div>
                @endif
                @php
                    $row++;
                @endphp
                @endforeach
                <p class="text-right">*to be confirmed</p>
            </div>
        </div>
        <!-- / Key Notes -->

        <!-- Guidelines -->
        <div id="guidelines" class="subscribe section bg-dark py-4">
            <h3 class="section-title text-center text-white m-5">Guidelines</h3>
            <p class="text-muted col-md-6 text-center mx-auto">Download this guidelines to explain your curious</p>
            <form class="form-inline d-table mb-5 mx-auto">
                <button class="btn btn-primary mb-2" onClick="getFile();">Download Guidelines</button>
            </form>
        </div>

        <script language="javascript">
        function getFile(){
            $.ajax({
                url: "download",
                type:'GET',
                success: function() {
                    window.location = 'download';
                }
            });
        }
        </script>
        <!-- /  Guidelines -->

         <!-- Registration Fee -->
         <div id="key-notes" class="testimonials section-invert py-4">
                <h3 class="section-title text-center m-5">Registration Fee</h3>
                <div class="container py-5">
                    <table class="table table-hover">
                        <thead class="thead bg-primary text-white">
                        <tr>
                            <th scope="col">Category</th>
                            <th scope="col" class="text-center">Early Bird (July 17 - August 18)</th>
                            <th scope="col" class="text-center">Regular(August 18 - Sept 16)</th>
                            <th scope="col" class="text-center">On Site</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($data9 as $data)
                            <tr>
                                <td>{{$data->category}}</td>
                                <td class="text-center">{{$data->early_bird}}</td>
                                <td class="text-center">{{$data->regular}}</td>
                                <td class="text-center">{{$data->on_site}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <p>*additional paper Rp. 1.500.000,-/paper (early bird/regular)</p>
                </div>
            </div>
            <!-- /  Registration Fee -->

        <!-- Publication -->
        <div id="publication" class="testimonials section py-4">
            <h3 class="section-title text-center m-5">Publication</h3>
            <div class="container py-5">
                <div class="row justify-content-md-center">
                    <div class="col-sm-9">
                        <p class="text-center"> The article presented at ICTCRED will be published in the proceedings of the <b><a href="https://iopscience.iop.org/journal/1755-1315">Institute of Physics (IOP)</a></b> and published at
                            @foreach ($data4 as $data)
                            <b><a href="{{$data->link}}">{{$data->name}}</a></b>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Publication -->

        <!-- Scientific Committe -->
        <div id="committe" class="testimonials section-invert py-4">
            <h3 class="section-title text-center m-5">Scientific Committe</h3>
            <div class="container py-5 text-center">
                <div class="row justify-content-md-center">
                    <div class="col-lg-6 mb-4">
                        <div class="row text-center">
                            <div class="col-sm-12 text-center">
                                @foreach ($data5 as $data)
                                    <li class="list-group-item">{{$data->name}}</li>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Scientific Committe -->

        <!-- Organizing Committe -->
        <div class="testimonials section py-3">
            <h3 class="section-title text-center m-5">Organizing Committe</h3>

            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-lg-6 mb-4">
                        <div class="card card-small mb-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    @foreach ($data6 as $data)
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group text-center">
                                                <h6 class="text-muted d-block mb-2">{{$data->position}} : {{$data->name}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            </li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Organizing Committe -->

        <!-- Sponsorship -->
        <div id="sponsorship" class="testimonials section-invert py-4">
            <h3 class="section-title text-center m-5">Sponsorship & Partnership</h3>
            <div class="container py-5">
                @php

                    $row = 3;
                @endphp

                @foreach ($data7 as $data)
                @if ($row % 3 == 0)
                    <div class="row">
                @endif
                    <div class="col-md-4 testimonial text-center">
                        <img src="storage/app/public/sponsorship/{{$data->photo}}" alt="publication-{{$data->id}}"/>
                    </div>
                @if (count($data7) % 3 != 0 && $row == count($data7) + 2)
                </div>
                @endif
                @if ($row % 3 == 2)
                    </div>
                @endif
                @php
                    $row++;
                @endphp
                @endforeach
            </div>
        </div>
        <!-- / Sponsorship -->

        <!-- Subscribe Section -->
        <div id="newsletter" class="subscribe section bg-dark py-2">
            <h3 class="section-title text-center text-white m-5">Newsletter</h3>
            <p class="text-muted col-md-6 text-center mx-auto">Subscribe us to get more information that up to date</p>
            <form class="form-inline d-table mb-5 mx-auto" method="POST" action="{{route('newsletter.create')}}">
                @csrf
                <div class="form-group">
                <input class="form-control border-0 mr-3 mb-2" type="email" name="email" placeholder="Email address">
                <button class="btn btn-primary mb-2" type="submit">Subscribe</button>
                </div>
            </form>
        </div>
        <!-- / Subscribe Section -->

        <!-- FAQs -->
        <div id="faq" class="testimonials section py-4">
            <h3 class="section-title text-center m-5">Frequently Asked & Questions</h3>

            <div class="container py-5">
                @foreach ($data8 as $data)
                    <ul class="list-group">
                        <style type="text/css">
                            .liop{
                                opacity: .8;
                            }
                        </style>
                        <li class="list-group-item active liop">{{$data->question}}</li>
                        <li class="list-group-item">{{$data->answer}}</li>
                    </ul>
                    <br>
                @endforeach
            </div>
        </div>
        <!-- / FAQs -->

        <!-- Address Section -->
        <div id="address" class="subscribe section bg-dark py-2">
            <h3 class="section-title text-center text-white m-5">Address</h3>
            <p class="text-white col-md-6 text-center mx-auto">Faculty of Fisheries and Marine Sciences, Jl. Prof. Soedarto, S.H. Tembalang, Semarang, Indonesia.</p>
        </div>
        <!-- / Address Section -->

        <!-- Contact Section -->
        <div id="contact-us" class="contact section-invert py-4">
            <h3 class="section-title text-center m-5">Contact Us</h3>
            <div class="container py-4">
                <div class="row justify-content-md-center px-4">
                <div class="contact-form col-sm-12 col-md-10 col-lg-7 p-4 mb-4 card">
                    <form method="POST" action="{{route('contactus.create')}}">
                        @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="contactFormFullName">Full Name</label>
                            <input type="text" name="name" class="form-control" id="contactFormFullName" placeholder="Enter your full name">
                        </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="contactFormEmail">Email address</label>
                            <input type="email" name="email" class="form-control" id="contactFormEmail" placeholder="Enter your email address">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="contactFormFullName">Title</label>
                            <input type="text" name="title" class="form-control" id="contactFormFullName" placeholder="Enter your title">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label for="exampleInputMessage1">Message</label>
                            <textarea id="exampleInputMessage1" class="form-control mb-4" rows="10" placeholder="Enter your message..." name="message"></textarea>
                        </div>
                        </div>
                    </div>
                    <input class="btn btn-primary btn-pill d-flex ml-auto mr-auto" type="submit" value="Send Your Message">
                    </form>
                </div>
                </div>
            </div>
        </div>
        <!-- / Contact Section -->

        <!-- Footer Section -->
        <footer>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                <a class="navbar-brand" href="http://aufalmarom.id">Copyright © 2019 - made with &hearts; by Aufal Marom as Developer</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                </div>
            </nav>
        </footer>
        <!-- / Footer Section -->

        <!-- JavaScript Dependencies -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <!-- JavaScript -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="public/landingpage/js/shards.min.js"></script>
        <script src="public/landingpage/js/demo.min.js"></script>
        <script src="public/landingpage/js/jquery.min.js"></script>
        <script src="public/iconpicker/js/boostrap-iconpicker.bundle.min.js"></script>
    </body>
</html>
