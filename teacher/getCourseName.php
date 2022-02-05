<?php
session_start();
$userID = $_SESSION["userID"];
$output = '';
$response = array();
$child_id = $_POST['child_id'];
$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    $sql = "SELECT * FROM CHILD LEFT JOIN COURSE ON CHILD.COURSE_ID = COURSE.COURSE_ID WHERE CHILD.TEACHER_ID = '$userID' AND CHILD.CHILD_ID = '$child_id'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $course_name = $row["COURSE_NAME"];
        $output .= '<input type = "text" name = "courseName" class="form-control" value="' . $course_name . '" readonly>';
    }
} else {
    die("FATAL ERROR");
}

$response['output']  =  $output;
$conn->close();
echo json_encode($response);
