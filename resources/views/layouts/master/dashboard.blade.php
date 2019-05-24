<!doctype html>
<html class="no-js h-100" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ICTCRED | Control Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="{{asset('public/dashboard/styles/shards-dashboards.1.1.0.min.css')}}" rel="stylesheet"  type="text/css">
    <link href="{{asset('public/dashboard/styles/extras.1.1.0.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('public/dashboard/styles/daterangepicker.css')}}">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <link href="{{asset('public/iconpicker/css/bootstrap-iconpicker.min.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('public/logo.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css">
    <style>
        .img-preview-mask{width: 100%;height: 100%;position: fixed;top: 0;left: 0;z-index: 9998;}
        .img-preview-popover{position: fixed;z-windex: 9999;}
        .img-preview-foot{width: 96%;padding:0 2%;position: absolute;bottom: 0;background-color: rgba(0,0,0,.5);}
        .img-foot-title{font-size: 16px;color: #fff;margin-top: 5px;}
        .img-foot-desc{font-size: 12px;color: #fff;margin-top: 5px;line-height: 24px;}
    </style>
  </head>
  <body class="h-100">

    <div class="container-fluid">
      <div class="row">
        <!-- Main Sidebar -->
        @if (CekRole() == 'administrator')
            @include('/layouts/sidebar/administrator')
        @elseif (CekRole() == 'reviewer')
            @include('/layouts/sidebar/reviewer')
        @elseif (CekRole() == 'author')
            @include('/layouts/sidebar/author')
        @elseif (CekRole() == 'participant')
            @include('/layouts/sidebar/participant')
        @endif
        <!-- End Main Sidebar -->
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
          <div class="main-navbar sticky-top bg-white">
            <!-- Main Navbar -->
            <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
              <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                <div class="input-group input-group-seamless ml-3">
                  <div class="input-group-prepend">
                    <div class="input-group-text">

                    </div>
                  </div>
                  </div>
              </form>
              <ul class="navbar-nav border-left flex-row ">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#data" role="button" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle mr-2" src="storage/app/public/user/{{Auth::user()->photo}}" alt="User Avatar">
                    <span class="d-none d-md-inline-block">{{Auth::user()->name}}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-small" id="data">
                    <a class="dropdown-item" href="{{route('profile.read')}}">
                      <i class="material-icons">&#xE7FD;</i> Profile</a>
                    @if (CekDoubleDashboard() == 1)
                    <a class="dropdown-item" href="{{route('changedashboard.read')}}">
                        @if (Auth::user()->role == 2)
                        <i class="material-icons">&#xE7FD;</i>Login Sebagai Author
                        @else
                        <i class="material-icons">&#xE7FD;</i> Login Sebagai Reviewer
                        @endif
                        </a>
                    @endif
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item text-danger" href="{{ route('logout')}}">
                      <i class="material-icons text-danger">&#xE879;</i> Logout </a>
                  </div>
                </li>
              </ul>
              <nav class="nav">
                <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
                  <i class="material-icons">&#xE5D2;</i>
                </a>
              </nav>
            </nav>
          </div>
          <!-- / .main-navbar -->
          <div class="main-content-container container-fluid px-4">
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
          </div>
          <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
            <span class="copyright ml-auto my-auto mr-2">Copyright © 2019 - made with &hearts; by <a href="htttp://aufalmarom.id" rel="nofollow">Aufal Marom as Developer</a>
            </span>
          </footer>
        </main>
      </div>
    </div>

    <script src="//cdn.ckeditor.com/4.11.4/full/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script src="{{asset('public/dashboard/scripts/extras.1.1.0.min.js')}}"></script>
    <script src="{{asset('public/dashboard/scripts/shards-dashboards.1.1.0.min.js')}}"></script>
    <script src="{{asset('public/dashboard/scripts/app/app-blog-overview.1.1.0.js')}}"></script>
    <script src="{{asset('public/dashboard/scripts/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('public/dashboard/scripts/moment.min.js')}}"></script>
    <script src="{{asset('public/dashboard/scripts/daterangepicker.js')}}"></script>
    <script src="{{asset('public/iconpicker/js/bootstrap-iconpicker.bundle.min.js')}}"></script>
    <script src="{{asset('public/js/imgPreview.min.js')}}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>

    <script>
        $(document).ready( function () {
            var t = $('#myTable').DataTable( {
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                } ],
                "order": [[ 1, 'asc' ]]
            } );

            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        } );

        $(() => $.imgPreview());

        $(function() {
	  $(document).on('change', ':file', function() {
		var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [numFiles, label]);
	  });

	  $(document).ready( function() {
		  $(':file').on('fileselect', function(event, numFiles, label) {

			  var input = $(this).parents('.input-group').find(':text'),
				  log = numFiles > 1 ? numFiles + ' files selected' : label;

			  if( input.length ) {
				  input.val(log);
			  } else {
				  if( log ) alert(log);
			  }

		  });
	  });

	});


    </script>
  </body>
</html>
