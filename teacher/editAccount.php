<?php
$emailCrash = false;
$phoneCrash = false;
session_start();
$response = array();
$userID = $_SESSION["userID"];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {
    // IF NOTHING CHANGE 
    if ($name == $_SESSION["name"] && $email == $_SESSION["email"] && $phone == $_SESSION["phone"]) {
        $response['title']  = 'Nothing Changed!';
        $response['status']  = 'info';
        $response['message'] = 'All info are same!';
    }

    // IF GOT CHANGE
    else {
        // IF INPUT EMAIL IS NOT SAME AS CURRENT EMAIL, CHECK GOT CRASH IN DATABASE OR NOT 
        if ($email != $_SESSION["email"]) {

            $sql = "SELECT COUNT(*) FROM ADMIN WHERE ADMIN_EMAIL =  '$email' ";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $admin_email_count = $row["COUNT(*)"];
            }

            $sql1 = "SELECT COUNT(*) FROM TEACHER WHERE TEACHER_EMAIL =  '$email' ";
            $result1 = $conn->query($sql1);
            while ($row1 = $result1->fetch_assoc()) {
                $teacher_email_count = $row1["COUNT(*)"];
            }

            $sql1_1 = "SELECT COUNT(*) FROM PARENT WHERE PARENT_EMAIL =  '$email' ";
            $result1_1 = $conn->query($sql1_1);
            while ($row1_1 = $result1_1->fetch_assoc()) {
                $parent_email_count = $row1_1["COUNT(*)"];
            }

            // IF EMAIL CRASH IN DATABASE
            if ($admin_email_count > 0 || $teacher_email_count > 0 || $parent_email_count > 0) {
                $emailCrash = true;
            }
        }

        // IF INPUT PHONE IS NOT SAME AS CURRENT PHONE, CHECK GOT CRASH IN DATABASE OR NOT 
        if ($phone != $_SESSION["phone"]) {

            $sql2 = "SELECT COUNT(*) FROM TEACHER WHERE TEACHER_PHONE_NUM =  '$phone' ";
            $result2 = $conn->query($sql2);
            while ($row2 = $result2->fetch_assoc()) {
                $teacher_phone_count = $row2["COUNT(*)"];
            }

            $sql2_1 = "SELECT COUNT(*) FROM PARENT WHERE PARENT_PHONE_NUM =  '$phone' ";
            $result2_1 = $conn->query($sql2_1);
            while ($row2_1 = $result2_1->fetch_assoc()) {
                $parent_phone_count = $row2_1["COUNT(*)"];
            }

            // IF PHONE CRASH IN DATABASE
            if ($teacher_phone_count > 0 || $parent_phone_count > 0) {
                $phoneCrash = true;
            }
        }

        if ($emailCrash) {
            $response['title']  = 'Error!';
            $response['status']  = 'error';
            $response['message'] = 'Email existed! Please use other email!';
        } else if ($phoneCrash) {
            $response['title']  = 'Error!';
            $response['status']  = 'error';
            $response['message'] = 'Phone number existed! Please use other phone number!';
        }
        // IF ALL NO CRASH, UPDATE DATABASE
        else {
            $sql3 = "UPDATE TEACHER SET TEACHER_NAME='$name', TEACHER_EMAIL='$email', TEACHER_PHONE_NUM='$phone' WHERE TEACHER_ID =  '$userID' ";
            if (mysqli_query($conn, $sql3)) {
                $_SESSION["name"] = $name;
                $_SESSION["email"] = $email;
                $_SESSION["phone"] = $phone;
                $response['title']  = 'Done!';
                $response['status']  = 'success';
                $response['message'] = 'All info updated!';
            }
        }
    }
} else {
    die("FATAL ERROR");
}

$conn->close();
echo json_encode($response);
