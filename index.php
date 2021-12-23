<?php
$emailErr = null;
$passErr = null;
session_start();

if (!isset($_SESSION["logged"])) {
    $_SESSION["logged"] = "";
}

if ($_SESSION["logged"] == TRUE &&  $_SESSION["accType"] == 0) {
    // admin
    header("Location:admin/ACalendar.php");
} else if ($_SESSION["logged"] == TRUE &&  $_SESSION["accType"] == 1) {
    // teacher
    header("Location:teacher/TCalendar.php");
} else if ($_SESSION["logged"] == TRUE &&  $_SESSION["accType"] == 2) {
    // parent
    header("Location:parent/PCalendar.php");
}


if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passValid = FALSE;

    $conn = mysqli_connect("localhost", "root", "", "music_academy");

    if ($conn) {
        $admin_sql = "SELECT * FROM ADMIN";
        $admin_result = $conn->query($admin_sql);

        $teacher_sql = "SELECT TEACHER_ID,TEACHER_NAME,TEACHER_EMAIL,TEACHER_PASS,TEACHER_STATUS FROM TEACHER";
        $teacher_result = $conn->query($teacher_sql);

        $parent_sql = "SELECT PARENT_ID,PARENT_NAME,PARENT_EMAIL,PARENT_PASS,PARENT_STATUS FROM PARENT";
        $parent_result = $conn->query($parent_sql);

        // CHECK ADMIN
        if (mysqli_query($conn, $admin_sql)) {
            while ($row = $admin_result->fetch_assoc()) {
                $tempUserID = $row["ADMIN_ID"];
                $tempName = $row["ADMIN_NAME"];
                $tempEmail = $row["ADMIN_EMAIL"];
                $tempPass = $row["ADMIN_PASS"];

                // check email
                if ($email == $tempEmail) {
                    // echo "admin yes email" . "</br>";
                    $adminCheck = true;
                    $emailErr = '';
                    // check password
                    if (md5($password) == $tempPass) {
                        $_SESSION["logged"] = TRUE;
                        $_SESSION["email"] = $email;
                        $_SESSION["userID"] = $tempUserID;
                        $_SESSION["name"] = $tempName;
                        $_SESSION["accType"] = 0; //admin
                        $passErr = '';
                        break;
                    } else {
                        $passErr = "Wrong password";
                    }
                    break;
                } else {
                    // echo "admin no email" . "</br>";
                    $adminCheck = false;
                    $emailErr = "Email does not exists!";
                }
            }
        }

        if (!$adminCheck) {
            // CHECK TEACHER
            if (mysqli_query($conn, $teacher_sql)) {
                while ($row = $teacher_result->fetch_assoc()) {
                    $tempUserID = $row["TEACHER_ID"];
                    $tempName = $row["TEACHER_NAME"];
                    $tempEmail = $row["TEACHER_EMAIL"];
                    $tempPass = $row["TEACHER_PASS"];
                    $tempStatus = $row["TEACHER_STATUS"];

                    // check email and status
                    if ($email == $tempEmail && $tempStatus == 'active') {
                        // echo "teacher yes email" . "</br>";
                        $teacherCheck = true;
                        $emailErr = '';

                        // check password
                        if (md5($password) == $tempPass) {
                            $_SESSION["logged"] = TRUE;
                            $_SESSION["email"] = $email;
                            $_SESSION["userID"] = $tempUserID;
                            $_SESSION["name"] = $tempName;
                            $_SESSION["accType"] = 1; //teacher
                            $passErr = '';
                            break;
                        } else {
                            $passErr = "Wrong password";
                        }
                        break;
                    } else if ($email == $tempEmail && $tempStatus == 'inactive') {
                        // echo "teacher no active" . "</br>";
                        $teacherCheck = TRUE;
                        $emailErr = "Your email is currently inactive, please contact your admin!";
                        break;
                    } else {
                        // echo "teacher no email" . "</br>";
                        $teacherCheck = false;
                        $emailErr = "Email does not exists!";
                    }
                }
            }
            if (!$teacherCheck) {
                // CHECK PARENT
                if (mysqli_query($conn, $parent_sql)) {
                    while ($row = $parent_result->fetch_assoc()) {
                        $tempUserID = $row["PARENT_ID"];
                        $tempName = $row["PARENT_NAME"];
                        $tempEmail = $row["PARENT_EMAIL"];
                        $tempPass = $row["PARENT_PASS"];
                        $tempStatus = $row["PARENT_STATUS"];

                        // check email and status
                        if ($email == $tempEmail && $tempStatus == 'active') {
                            // echo "parent yes email" . "</br>";
                            $emailErr = '';

                            // check password
                            if (md5($password) == $tempPass) {
                                $_SESSION["logged"] = TRUE;
                                $_SESSION["email"] = $email;
                                $_SESSION["userID"] = $tempUserID;
                                $_SESSION["name"] = $tempName;
                                $_SESSION["accType"] = 2; //parent
                                $passErr = '';
                                break;
                            } else {
                                $passErr = "Wrong password";
                            }
                            break;
                        } else if ($email == $tempEmail && $tempStatus == 'inactive') {
                            // echo "parent no active" . "</br>";
                            $emailErr = "Your email is currently inactive, please contact your admin!";
                            break;
                        } else {
                            // echo "parent no email" . "</br>";
                            $emailErr = "email does not exists";
                        }
                    }
                }
            }
        }
    } else {
        die("FATAL ERROR");
    }

    $conn->close();

    if ($_SESSION["logged"] == TRUE &&  $_SESSION["accType"] == 0) {
        // admin
        header("Location:admin/ACalendar.php");
    } else if ($_SESSION["logged"] == TRUE &&  $_SESSION["accType"] == 1) {
        // teacher
        header("Location:teacher/TCalendar.php");
    } else if ($_SESSION["logged"] == TRUE &&  $_SESSION["accType"] == 2) {
        // parent
        header("Location:parent/PCalendar.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Login</title>

    <!-- page css -->
    <link href="dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="skin-blue card-no-border login-bg">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Loading</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register">
            <div class="login-box card border border-dark rounded">
                <div class="card-body">
                    <form class="form-control-line" id="loginform" method="post" action="">
                        <h3 class="box-title m-b-20">Sign In</h3>

                        <div class="form-group m-b-30 <?php echo (!empty($emailErr)) ? 'has-danger' : ''; ?>">
                            <div class="col-xs-12">
                                <input class="form-control <?php echo (!empty($emailErr)) ? 'form-control-danger' : ''; ?>" value="<?php echo htmlspecialchars($email ?? '') ?>" type="email" name="email" required="" placeholder="Email" autofocus>
                                <span class="form-control-feedback"><?php echo $emailErr; ?></span>
                            </div>
                        </div>
                        <div class="form-group m-b-30 <?php echo (!empty($passErr)) ? 'has-danger' : ''; ?>">
                            <div class="col-xs-12">
                                <input class="form-control <?php echo (!empty($passErr)) ? 'form-control-danger' : ''; ?>" type="password" name="password" required="" placeholder="Password">
                                <span class="form-control-feedback"><?php echo $passErr; ?></span>
                            </div>
                        </div>
                        <div class="form-group m-b-30 row">
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox pl-0">
                                    <!-- <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember me</label> -->
                                    <a href="javascript:void(0)" id="to-recover" class="text-dark pull-left"><i class="fa fa-lock m-r-5"></i> Forgot password?</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center m-b-0">
                            <div class="col-xs-12 p-b-10">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit" name="login">Log In</button>
                            </div>
                        </div>
                        <!-- <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                Don't have an account? <a href="register.php" class="text-info m-l-5"><b>Sign Up</b></a>
                            </div>
                        </div> -->
                    </form>
                    <form class="form-horizontal" id="recoverform" action="resetPass.php" method="post">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Reset Password</h3>
                                <p class="text-muted">Enter your Email and a new password will be sent to you! </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="email" id="email" name="email" required="" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                                <a href="javascript:void(0)" id="to-login" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="button">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/node_modules/popper/popper.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").delay(100).fadeOut('fast');
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });

        $('#to-login').on("click", function() {
            $("#recoverform").fadeOut();
            $("#loginform").slideDown();
        });

        $("#recoverform").submit(function(e) {
            e.preventDefault();
            $('html, body').css("cursor", "wait");
            $.ajax({
                    url: $("#recoverform").attr('action'),
                    type: $("#recoverform").attr('method'),
                    data: $("#recoverform").serialize(),
                    dataType: 'json'
                })
                .done(function(response) {
                    Swal.fire(
                        response.title,
                        response.message,
                        response.status
                    ).then(() => {
                        $("#recoverform #email").val('');
                        $("#recoverform").fadeOut();
                        $("#loginform").slideDown();
                    })
                    $('html, body').css("cursor", "auto");
                })
                .fail(function(xhr, textStatus, errorThrown) {
                    // alert(errorThrown);
                    Swal.fire(
                        'Oops...',
                        'Something went wrong with ajax !',
                        'error'
                    ).then(() => {
                        $("#recoverform #email").val('');
                        $("#recoverform").fadeOut();
                        $("#loginform").slideDown();
                    })
                    $('html, body').css("cursor", "auto");
                })
        })
    </script>

</body>

</html>