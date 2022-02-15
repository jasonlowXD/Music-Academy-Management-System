<?php
session_start();
$userID = $_SESSION["userID"];
$course_output = '';
$duration_output = '';
$response = array();
$child_id = $_POST['child_id'];
$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    $sql = "SELECT * FROM CHILD LEFT JOIN COURSE ON CHILD.COURSE_ID = COURSE.COURSE_ID WHERE CHILD.CHILD_ID = '$child_id'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $course_name = $row["COURSE_NAME"];
        $duration = $row["DURATION_PER_CLASS"];
        $course_output .= '<input type = "text" name = "course" class="form-control addClass_course_input" value="' . $course_name . '" readonly>';
        $duration_output .= '<input type = "text" name = "duration" class="form-control addClass_duration_input" value="' . $duration . '" readonly>';
    }
}else {
    die("FATAL ERROR");
}

$response['course_output']  =  $course_output;
$response['duration_output']  =  $duration_output;
$conn->close();
echo json_encode($response);