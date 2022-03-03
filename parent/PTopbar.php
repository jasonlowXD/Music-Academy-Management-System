<?php
session_start();
if (!($_SESSION["logged"])) {
    $_SESSION["logged"] = "";
    header("Location:../index.php");
} else {
    if ($_SESSION["logged"] == TRUE &&  $_SESSION["accType"] == 0) {
        // admin
        header("Location:../admin/ACalendar.php");
    } else if ($_SESSION["logged"] == TRUE &&  $_SESSION["accType"] == 1) {
        // teacher
        header("Location:../teacher/TCalendar.php");
    }
}
$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    $sql = "DELETE FROM NOTIFICATION WHERE DATETIME < date_sub(now(),interval 1 month)";
    if (mysqli_query($conn, $sql)) {
    } else {
        echo mysqli_error($conn);
    }
} else {
    die("FATAL ERROR");
}

$conn->close();
?>
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="PCalendar.php">
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
                        <div class="notify"> <span id="heartbit" class="heartbit"></span> <span id="point" class="point"></span> </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                        <ul>
                            <li>
                                <div class="drop-title font-weight-bold pl-3">Notifications</div>
                            </li>
                            <div class="message-center">
                                <li>
                                    <div class="dropdownNotification">
                                    </div>
                                </li>
                            </div>
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
                        <span class="hidden-md-down" id="userProfile"><?php echo $_SESSION["name"] ?> &nbsp;<i class="fa fa-angle-down"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <!-- text-->
                        <a href="PAccount.php" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                        <!-- text-->
                        <a href="../logout.php" class="dropdown-item"><i class="ti-power-off"></i> Logout</a>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End User Profile -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>

<script src="../assets/jquery/jquery-3.2.1.min.js"></script>
<script>
    // load notification 
    function loadNotification() {
        $.ajax({
                type: "POST",
                url: "loadNotification.php",
                dataType: "json"
            })
            .done(function(response) {
                // if got one notification is unseen 
                if (response.unseen == 'true') {
                    $("#heartbit").addClass("heartbit");
                    $("#point").addClass("point");
                    $('.dropdownNotification').html(response.notification);
                } else {
                    $("#heartbit").removeClass("heartbit");
                    $("#point").removeClass("point");
                    $('.dropdownNotification').html(response.notification);
                }
            })
            .fail(function(xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);
            })
    }

    loadNotification();

    // auto refresh notification every 5 seconds 
    setInterval(function() {
        loadNotification();;
    }, 5000);

    // update notification to seen status after user click 
    function updateNotification(id) {
        $.ajax({
                type: "GET",
                url: "updateNotification.php",
                data: {
                    id: id,
                }
            }).done(function(response) {
                console.log(response);
            })
            .fail(function(xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);
            })
    }
</script>