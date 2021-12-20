<!-- check email in database -->
<!-- if email exist and correct compare, update password database and send email -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Reset Password</title>

    <!-- page css -->
    <link href="dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet">
    <script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<?php
require_once('mailServer.php');

function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces[] = $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

$flag = FALSE;
$email = $_POST["email"];
$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {
    $admin_sql = "SELECT ADMIN_EMAIL FROM ADMIN";
    $admin_result = $conn->query($admin_sql);

    $teacher_sql = "SELECT TEACHER_EMAIL FROM TEACHER";
    $teacher_result = $conn->query($teacher_sql);

    $parent_sql = "SELECT PARENT_EMAIL FROM PARENT";
    $parent_result = $conn->query($parent_sql);

    // ADMIN
    if (mysqli_query($conn, $admin_sql)) {
        while ($row = $admin_result->fetch_assoc()) {
            $user_mail = $row["ADMIN_EMAIL"];

            if ($email == $user_mail) {
                // echo "match" . "</br>";
                $adminCheck = true;
                $newPass = random_str(8);
                $mdPass = md5($newPass);
                $admin_reset_sql = "UPDATE ADMIN SET ADMIN_PASS = '$mdPass' WHERE ADMIN_EMAIL = '$user_mail'";
                if (mysqli_query($conn, $admin_reset_sql)) {
                    // echo "reset admin success" . "</br>";
                    $flag = TRUE;
                    break;
                } else {
                    // echo "reset admin fail" . "</br>";
                }
            } else {
                $adminCheck = false;
                // echo "no matching" . "</br>";
            }
        }
    }
    if (!$adminCheck) {
        // TEACHER
        if (mysqli_query($conn, $teacher_sql)) {
            while ($row = $teacher_result->fetch_assoc()) {
                $user_mail = $row["TEACHER_EMAIL"];

                if ($email == $user_mail) {
                    // echo "match" . "</br>";
                    $teacherCheck = true;
                    $newPass = random_str(8);
                    $mdPass = md5($newPass);
                    $teacher_reset_sql = "UPDATE TEACHER SET TEACHER_PASS = '$mdPass' WHERE TEACHER_EMAIL = '$user_mail'";
                    if (mysqli_query($conn, $teacher_reset_sql)) {
                        // echo "reset teacher success" . "</br>";
                        $flag = TRUE;
                        break;
                    } else {
                        // echo "reset teacher fail" . "</br>";
                    }
                } else {
                    $teacherCheck = false;
                    // echo "no matching" . "</br>";
                }
            }
        }
        if (!$teacherCheck) {
            // PARENT
            if (mysqli_query($conn, $parent_sql)) {
                while ($row = $parent_result->fetch_assoc()) {
                    $user_mail = $row["PARENT_EMAIL"];

                    if ($email == $user_mail) {
                        // echo "match" . "</br>";
                        $newPass = random_str(8);
                        $mdPass = md5($newPass);
                        $parent_reset_sql = "UPDATE PARENT SET PARENT_PASS = '$mdPass' WHERE PARENT_EMAIL = '$user_mail'";
                        if (mysqli_query($conn, $parent_reset_sql)) {
                            // echo "reset parent success" . "</br>";
                            $flag = TRUE;
                            break;
                        } else {
                            // echo "reset parent fail" . "</br>";
                        }
                    } else {
                        // echo "no matching" . "</br>";
                    }
                }
            }
        }
    }
} else {
    die("FATAL ERROR");
}

$conn->close();

if ($flag == TRUE) {

    $mail->setFrom('musicacademyfypp@gmail.com', 'Music Academy');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Reset Password';
    $mail->Body    = "Hi, 
	<br />
	Your new password is: '$newPass'
	<br />
    You can edit your password after you login.
    <br />
    <br />
	Thanks & Regard";
    $mailsend = $mail->send();
    if ($mailsend) {
?>
        <script>
            $(document).ready(function() {
                Swal.fire(
                    'Password reset email sent!',
                    'Please check your email for new password.',
                    'success'
                ).then(() => {
                    window.location.replace('index.php');
                })
            })
        </script>
    <?php
    } else {
        echo 'email fail';
    }
} else {
    ?>
    <script>
        $(document).ready(function() {
            Swal.fire(
                'Email does not exist',
                'Please check your email again.',
                'error'
            ).then(() => {
                window.location.replace('index.php');
            })
        })
    </script>
<?php
}
?>

<body class="skin-blue card-no-border login-bg">

</body>