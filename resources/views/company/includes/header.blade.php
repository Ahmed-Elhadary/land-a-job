<nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-secondary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('company.dashboard') }}">
            <span class="ml-3 text-white font-weight-bold">LAND A JOB</span>
        </a>
        <button class="navbar-toggler navbar-toggler-right border-0" type="button"
                data-toggle="collapse" data-target="#navbar4">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbar4">
            <ul class="navbar-nav mr-auto pl-lg-4">
                <li class="nav-item px-lg-2">
                    <a class="nav-link text-white" href="{{ route('company.dashboard') }}">Dashboard</a>
                </li>

                <li class="nav-item px-lg-2 dropdown d-menu">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="dropdown01"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Jobs</a>

                    <div class="dropdown-menu shadow-sm sm-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="{{route('all-jobs.index')}}">All jobs</a>
                        <a class="dropdown-item" href="{{route('all-jobs.create')}}">Add a new job</a>
                    </div>
                </li>
            </ul>


            <ul class="navbar-nav ml-auto pl-lg-4">
                <li class="nav-item mx-2" id="nav-search">
                </li>
                <li class="nav-item px-lg-2 dropdown d-menu">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="dropdown01"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">{{ auth()->user()->first_name." ".auth()->user()->last_name }}</a>

                    <div class="dropdown-menu shadow-sm sm-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="{{ route("company.profile") }}">{{ auth()->user()->company->name }}</a>
                        <a class="dropdown-item" href="{{ route('company.edit') }}"><i class="fas fa-pencil-alt text-muted mr-1"></i> Edit Profile</a>

                        <form action="{{ route("logout") }}" method="POST">
                            @csrf
                            <input type="submit" class="dropdown-item" value="Logout">
                        </form>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
