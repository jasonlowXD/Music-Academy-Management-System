<?php
require_once('../mailServer.php');

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

$emailCrash = false;
$phoneCrash = false;
session_start();
$response = array();
$userID = $_SESSION["userID"];
$teacherName = $_POST['teacherName'];
$teacherEmail = $_POST['teacherEmail'];
$teacherPhone = $_POST['teacherPhone'];

$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {

    // CHECK GOT CRASH EMAIL OR PHONE NUM IN DATABASE OR NOT

    // CHECK EMAIL IN ADMIN TABLE 
    $sql = "SELECT COUNT(*) FROM ADMIN WHERE ADMIN_EMAIL =  '$teacherEmail' ";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $admin_email_count = $row["COUNT(*)"];
    }

    // CHECK EMAIL IN TEACHER TABLE 
    $sql0 = "SELECT COUNT(*) FROM TEACHER WHERE TEACHER_EMAIL =  '$teacherEmail' ";
    $result0 = $conn->query($sql0);
    while ($row0 = $result0->fetch_assoc()) {
        $teacher_email_count = $row0["COUNT(*)"];
    }

    // CHECK EMAIL IN PARENT TABLE 
    $sql1 = "SELECT COUNT(*) FROM PARENT WHERE PARENT_EMAIL =  '$teacherEmail' ";
    $result1 = $conn->query($sql1);
    while ($row1 = $result1->fetch_assoc()) {
        $parent_email_count = $row1["COUNT(*)"];
    }

    // IF EMAIL CRASH IN DATABASE
    if ($admin_email_count > 0 || $teacher_email_count > 0 || $parent_email_count > 0) {
        $emailCrash = true;
    }

    // CHECK PHONE IN TEACHER TABLE 
    $sql2 = "SELECT COUNT(*) FROM TEACHER WHERE TEACHER_PHONE_NUM =  '$teacherPhone' ";
    $result2 = $conn->query($sql2);
    while ($row2 = $result2->fetch_assoc()) {
        $teacher_phone_count = $row2["COUNT(*)"];
    }

    // CHECK PHONE IN PARENT TABLE 
    $sql3 = "SELECT COUNT(*) FROM PARENT WHERE PARENT_PHONE_NUM =  '$teacherPhone' ";
    $result3 = $conn->query($sql3);
    while ($row3 = $result3->fetch_assoc()) {
        $parent_phone_count = $row3["COUNT(*)"];
    }

    // IF EMAIL CRASH IN DATABASE
    if ($teacher_phone_count > 0 || $parent_phone_count > 0) {
        $phoneCrash = true;
    }

    if ($emailCrash) {
        $response['title']  = 'Error email';
        $response['status']  = 'error';
        $response['message'] = 'Email already registered in system! Please use other email!';
    } else if ($phoneCrash) {
        $response['title']  = 'Error phone';
        $response['status']  = 'error';
        $response['message'] = 'Phone number already registered in system! Please use other phone number!';
    }

    // IF ALL NO CRASH, SET RANDOM PASSWORD AND ADD NEW TEACHER
    else {
        $teacherPass = random_str(8);
        $mdTeacherPass = md5($teacherPass);
        $teacherStatus = 'active';

        $sql4 = "INSERT INTO TEACHER (TEACHER_ID,ADMIN_ID,TEACHER_NAME,TEACHER_EMAIL,TEACHER_PASS,TEACHER_PHONE_NUM,TEACHER_STATUS) 
        VALUES ('','$userID','$teacherName','$teacherEmail','$mdTeacherPass','$teacherPhone','$teacherStatus')";

        // SEND EMAIL 
        if (mysqli_query($conn, $sql4)) {
            $link = "http://localhost/MusicAMS";
            $mail->setFrom('musicacademyfypp@gmail.com', 'Music Academy');
            $mail->addAddress($teacherEmail);
            $mail->isHTML(true);
            $mail->Subject = 'New Account Registered';
            $mail->Body    = "Hi, $teacherName
            <br />
            Your account has been created with password: $teacherPass
            <br />
            You can edit your password after you login with this link: $link.
            <br />
            <br />
            Thanks & Regard";
            $mailsend = $mail->send();
            if ($mailsend) {
                $response['title']  = 'Done!';
                $response['status']  = 'success';
                $response['message'] = 'New teacher added and email is sent!';
            } else {
                $response['title']  = 'Error!';
                $response['status']  = 'error';
                $response['message'] = 'email cannot send to user.';
            }
        } else {
            $response['title']  = 'Error!';
            $response['status']  = 'error';
            $response['message'] = 'mysql error';
        }
    }
} else {
    die("FATAL ERROR");
}

$conn->close();
echo json_encode($response);
