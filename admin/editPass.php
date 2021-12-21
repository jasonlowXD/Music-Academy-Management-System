<?php
session_start();
$response = array();
$userID = $_SESSION["userID"];

$oldPassword = $_POST['oldPassword'];
$md5oldPass = md5($oldPassword);
$newPassword = $_POST['newPassword'];
$md5newPassword = md5($newPassword);

$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {

    $sql = "SELECT * FROM ADMIN WHERE ADMIN_ID = '$userID'";
    $result = $conn->query($sql);
    if (mysqli_query($conn, $sql)) {
        while ($row = $result->fetch_assoc()) {
            $tempPass = $row["ADMIN_PASS"];
            if ($md5newPassword == $tempPass) {
                $response['title']  = 'Error!';
                $response['status']  = 'error';
                $response['message'] = 'New password cannot same as your current password!';
            } else if ($md5oldPass != $tempPass) {
                $response['title']  = 'Error!';
                $response['status']  = 'error';
                $response['message'] = 'Your old password is not match with your current password!';
            } else if ($md5oldPass == $tempPass && $md5newPassword != $tempPass) {
                $sql2 = "UPDATE ADMIN SET ADMIN_PASS='$md5newPassword' WHERE ADMIN_ID =  '$userID' ";
                if (mysqli_query($conn, $sql2)) {
                    $response['title']  = 'Done!';
                    $response['status']  = 'success';
                    $response['message'] = 'Password Updated!';
                }
            }
        }
    }
}
echo json_encode($response);
