<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= SITE_URL ?>/admin/" id="index">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                   href="#doctorCollapse">
                    <span>
                        <span data-feather="user"></span>
                    Doctors
                    </span>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-plus-circle" aria-hidden="true"><circle cx="12" cy="12"
                                                                                            r="10"></circle><line
                                    x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16"
                                                                                y2="12"></line></svg>
                    </span>
                </a>
                <div class="collapse" id="doctorCollapse">
                    <ul class=" nav flex-column ps-2">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITE_URL ?>/admin/active_doctors.php" id="active_doctors">
                                <span data-feather="check-square"></span>
                                Active
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITE_URL ?>/admin/requests.php" id="requests">
                                <span data-feather="x-square"></span>
                                Disabled
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>