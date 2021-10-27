<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="TCalendar.php">
                <!-- Logo icon -->
                <b class="m-l-5 m-r-5">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <i class="fa fa-music"></i>
                    <!-- Dark Logo icon -->
                    <!-- <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" /> -->
                    <!-- Light Logo icon -->
                    <!-- <img src="../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" /> -->
                </b>
                <!--End Logo icon -->
                <span class="hidden-xs"><span class="font-bold">MUSIC</span> ACADEMY</span>
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
            </ul>
            <!-- ============================================================== -->
            <!-- User profile -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Notifications -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ti-bell"></i>
                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                        <ul>
                            <li>
                                <div class="drop-title">Notifications</div>
                            </li>
                            <li>
                                <div class="message-center">
                                     <!-- Message -->
                                     <a href="javascript:void(0)">
                                        <div class="">
                                            <h5 class=" font-weight-bold">New Reschedule Request by Parent A </h5>
                                            <p class=" text-muted">Parent A request to change 1/10/2021 8am class to 7/10/2021 2pm class</p> <span class="text-info">9:30 AM</span>
                                        </div>
                                    </a>
                                     <!-- Message -->
                                     <a href="javascript:void(0)">
                                        <div class="">
                                            <h5 class=" font-weight-bold">You have new children assigned </h5>
                                            <p class=" text-muted">New children (Kid ABC name) has assigned to your list</p> <span class="text-info">11:30 PM</span>
                                        </div>
                                    </a>
                                     <!-- Message -->
                                     <a href="javascript:void(0)">
                                        <div class="">
                                            <h5 class=" font-weight-bold">test notification </h5>
                                            <p class=" text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec consectetur imperdiet ornare. </p> <span class="text-info">9:30 AM</span>
                                        </div>
                                    </a>
                                     <!-- Message -->
                                     <a href="javascript:void(0)">
                                        <div class="">
                                            <h5 class=" font-weight-bold">test notification </h5>
                                            <p class=" text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec consectetur imperdiet ornare. </p> <span class="text-info">9:30 AM</span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <!-- <li>
                                <a class="nav-link text-center link" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                            </li> -->
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End Notifications -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- User Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown u-pro">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="hidden-md-down" id="userProfile">Teacher ABC &nbsp;<i class="fa fa-angle-down"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <!-- text-->
                        <a href="TAccount.php" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                        <!-- text-->
                        <a href="../index.php" class="dropdown-item"><i class="ti-power-off"></i> Logout</a>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End User Profile -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>