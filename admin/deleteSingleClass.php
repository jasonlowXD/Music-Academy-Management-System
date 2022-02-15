<?php
session_start();
$userID = $_SESSION["userID"];
$classID = $_POST['classID'];
$classGroupID = $_POST['classGroupID'];
$response = array();

$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {

    $sql = "DELETE FROM CLASS WHERE CLASS_ID = '$classID'";
    if (mysqli_query($conn, $sql)) {

        // CHECK IF THERE ARE STILL GOT REMAIN CLASS FOR THAT CLASSGROUP 
        $sql2 = "SELECT * FROM CLASS WHERE CLASSGROUP_ID = '$classGroupID' ";
        $result2 = $conn->query($sql2);

        // IF STILL GOT CLASS, KEEP CLASSGROUP
        if ($result2->num_rows > 0) {
            $response['title']  = 'Done!';
            $response['status']  = 'success';
            $response['message'] = 'Class successfully deleted!';
        }
        // IF NO MORE CLASS, DELETE CLASSGROUP 
        else if ($result2->num_rows == 0) {
            $sql4 = "DELETE FROM CLASS_GROUP WHERE CLASSGROUP_ID = '$classGroupID' AND ADMIN_ID = '$userID'";
            if (mysqli_query($conn, $sql4)) {
                $response['title']  = 'Done!';
                $response['status']  = 'success';
                $response['message'] = 'All classes successfully deleted!';
            } else {
                $response['title']  = 'Error!';
                $response['status']  = 'error';
                $response['message'] = 'update classgroup error!';
            }
        }
    } else {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] = 'delete class error!';
    }
} else {
    die("FATAL ERROR");
}
$conn->close();
echo json_encode($response);
