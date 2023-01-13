<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                Dashboard
            </a>

            <a class="nav-link" href="{{ route('admin.courses') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                Courses
            </a>

            <a class="nav-link" href="{{ route('admin.shifts') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                Shifts
            </a>

            <a class="nav-link" href="{{ route('admin.batches') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                Batches
            </a>

            <a class="nav-link" href="{{ route('admin.teachers') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                Teachers
            </a>

            <a class="nav-link" href="{{ route('admin.students') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Students
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small"> </div>
        {{ Auth::user()->name }}
    </div>
</nav>