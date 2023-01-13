<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link" href="{{ route('teacher.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <a class="nav-link" href="{{ route('teacher.batches') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-chair"></i></div>
                Batches   
            </a>
            <a class="nav-link" href="# ">
                <div class="sb-nav-link-icon"><i class="fas fa-arrow-right"></i></div>
                Attendence
            </a>
            <a class="nav-link" href="#">
                <div class="sb-nav-link-icon"><i class="fas fa-pen"></i></div>
                Remarks
            </a> 
        </div>
    </div>
    <div class="sb-sidenav-footer ">
           <div class="small">
            {{ Auth::user()->name }}</div>
    </div>
</nav>
