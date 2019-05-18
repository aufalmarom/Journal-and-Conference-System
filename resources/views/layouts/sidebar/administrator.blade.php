<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
        <a class="navbar-brand w-100 mr-0" href="{{route('dashboard')}}" style="line-height: 25px;">
            <div class="d-table m-auto">
            <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{asset('public/logo.png')}}" alt="Shards Dashboard">
            <span class="d-none d-md-inline ml-1">ICTCRED Administrator</span>
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
                <a class="nav-link collapsed" data-toggle="collapse" href="#dashboard" aria-expanded="false">
                    <i class="material-icons">apps</i>
                    <span>General Setup</span>
                </a>

                <div class="collapse" id="dashboard">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{route('dashboard')}}">
                            <span class="sidebar-normal">All Set Up</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{route('lp.read')}}">
                            <span class="sidebar-normal">Landing Page Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{route('ac.read')}}">
                            <span class="sidebar-normal">Author Categories Setup</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{route('evaluationsystem.read')}}">
                            <span class="sidebar-normal">Evaluation System</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('allreviewer.read')}}">
                    <i class="material-icons">touch_app</i>
                    <span>Reviewer</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('sidebarauthor')}}">
                    <i class="material-icons">people</i>
                    <span>Author</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('sidebarpaper')}}">
                    <i class="material-icons">book</i>
                    <span>Paper</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('sidebarparticipant')}}">
                    <i class="material-icons">person</i>
                    <span>Participant</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('sidebarsecretary')}}">
                    <i class="material-icons">library_books</i>
                    <span>Recap Data Secretary</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('sidebarfinance')}}">
                    <i class="material-icons">attach_money</i>
                    <span>Input Data Finance</span>
                </a>
            </li>

            <li class="nav-item"class="nav-item">
                <a class="nav-link collapsed" data-toggle="collapse" href="#log" aria-expanded="false">
                    <i class="material-icons">history</i>
                    <span>Log Activity</span>
                </a>

                <div class="collapse" id="log">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{route('sidebarlogactivityreviewer')}}">
                            <span class="sidebar-normal">Reviewer</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{route('sidebarlogactivityauthor')}}">
                            <span class="sidebar-normal">Author</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{route('sidebarlogactivityparticipant')}}">
                            <span class="sidebar-normal">Participant</span>
                        </a>
                    </li>
                </ul>

            </div>
            </li>


        </ul>
    </div>

</aside>




