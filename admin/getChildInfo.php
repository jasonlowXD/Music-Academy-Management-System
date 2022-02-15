<?php
session_start();
$userID = $_SESSION["userID"];
$child_output = '';
$child_output .= '<option hidden disabled selected value="">-- select a child --</option>';
$course_output = '<input type = "text" name = "course" class="form-control" value="" placeholder="Select a child first" readonly>';
$duration_output = '<input type = "text" name = "duration" class="form-control" value="" placeholder="Select a child first" readonly>';

$response = array();
$teacher_id = $_POST['teacher_id'];
$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    $sql = "SELECT * FROM CHILD WHERE TEACHER_ID = '$teacher_id' AND CHILD_STATUS ='active' ";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $child_id = $row["CHILD_ID"];
        $child_name = $row["CHILD_NAME"];

        $child_output .= '<option value="' . $child_id . '">' . $child_name . '</option>';

    }
}else {
    die("FATAL ERROR");
}

$response['child_output']  =  $child_output;
$response['course_output']  =  $course_output;
$response['duration_output']  =  $duration_output;
$conn->close();
echo json_encode($response);