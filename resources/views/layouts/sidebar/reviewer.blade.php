<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
        <a class="navbar-brand w-100 mr-0" href="{{route('dashboard')}}" style="line-height: 25px;">
            <div class="d-table m-auto">
            <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{asset('public/logo.png')}}">
            <span class="d-none d-md-inline ml-1">ICTCRED Reviewer</span>
            </div>
        </a>
        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
            <i class="material-icons">&#xE5C4;</i>
        </a>
        </nav>
    </div>
    <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
        <div class="input-group input-group-seamless ml-3">
        <div class="input-group-prepend">
            <div class="input-group-text">
            <i class="fas fa-search"></i>
            </div>
        </div>
        <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
    </form>
    <div class="nav-wrapper">
        <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="material-icons">apps</i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#paper" aria-expanded="false">
                <i class="material-icons">book</i>
                <span>Paper</span>
            </a>
            <div class="collapse" id="paper">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{route('abstracttoscore.read')}}">
                            <span class="sidebar-normal">Abstract to score</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{route('reviewabstract.read')}}">
                            <span class="sidebar-normal">Abstract to review</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{route('reviewabstractreviewed.read')}}">
                            <span class="sidebar-normal">Abstract Reviewed</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{route('reviewabstractfinal.read')}}">
                            <span class="sidebar-normal">Abstract Final</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{route('reviewfullpaper.read')}}">
                            <span class="sidebar-normal">Full Paper</span>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a class="dropdown-item" href="{{route('reviewfullpaperunderview.read')}}">
                            <span class="sidebar-normal">Full Paper Underview</span>
                        </a>
                    </li>
                    <span class="sidebar-normal text-center">-----------After Conference--------------</span>
                    <li class="nav-item">
                    <a class="dropdown-item" href="{{route('reviewerfullpapercameraready.read')}}">
                            <span class="sidebar-normal">Full Paper Camera Ready</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{route('logactivityreviwer.read')}}">
                <i class="material-icons">history</i>
                <span>Log Acitivity</span>
            </a>
        </li> --}}
        </ul>
    </div>
</aside>
