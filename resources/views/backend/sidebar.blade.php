<style>
    /* .sidebar-item.active {
        background-color: green;
    } */
    /* Background color for active dropdown */
    .sidebar-item.active>a {
        background: #f3f4f6;
        border-radius: 5px;
    }

    /* Background for dropdown items */
    .first-level {
        background: #e9ecef;
    }

    /* Spacing & Hover Effects */
    .sidebar-link {
        padding: 10px;
        border-radius: 5px;
        transition: 0.3s ease;
    }

    .sidebar-link:hover {
        background: #dee2e6;
    }

    /* Dropdown Arrow Animation */
    .dropdown-arrow {
        transition: transform 0.3s;
    }

    .sidebar-item.open .dropdown-arrow {
        transform: rotate(180deg);
    }
</style>


<!-- Sidebar Start -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="" class="text-nowrap logo-img">
                <img src="{{ asset('logo2.png') }}" alt="" style="width : 80%;">
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin') }}"
                        aria-expanded="false">
                        <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('admin/tools') ? 'active' : '' }}"
                        href="{{ route('tools') }}" aria-expanded="false">
                        <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                        <span class="hide-menu">Tools</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>


<!--  Sidebar End -->
<!--  Main wrapper -->
<div class="body-wrapper">
    <!--  Header Start -->
    <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item d-block d-xl-none">
                    <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="javascript:void(0)">
                        <iconify-icon icon="solar:bell-linear" class="fs-6"></iconify-icon>
                        <div class="notification bg-primary rounded-circle"></div>
                    </a>
                </li>
            </ul>
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCaJqEdRntMw1qPg2HdvHmlPdxRCBeRs7qLQ&s" alt="" width="35" height="35" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body">
                                <a href="" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    <p class="mb-0 fs-3">My Profile</p>
                                </a>
                                <a href="" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    <p class="mb-0 fs-3">Change Password</p>
                                </a>
                                <a href="" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!--  Header End -->






    <script>
        document.querySelectorAll(".sidebar-link.has-arrow").forEach(item => {
            item.addEventListener("click", function () {
                this.parentElement.classList.toggle("open");
                this.nextElementSibling.classList.toggle("show");
            });
        });
    </script>