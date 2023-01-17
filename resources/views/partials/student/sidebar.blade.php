<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link" href="{{ route('student.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <a class="nav-link" href="{{ route('student.batch.enrollment', Auth::user()->student) }}">
                <div class="sb-nav-link-icon"><i class="fas fa-chair"></i></div>
                Batches   
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer ">
           <div class="small">
            {{ Auth::user()->name }}</div>
    </div>
</nav>
