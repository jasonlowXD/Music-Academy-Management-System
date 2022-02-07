<?php
session_start();
$output = '';
$response = array();
$userID = $_SESSION["userID"];
$progressID = $_POST['progressID'];
$content = htmlspecialchars($_POST['content']);

$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {
    $sql = "INSERT INTO COMMENT (COMMENT_ID,PROGRESS_ID,TEACHER_ID,PARENT_ID,COMMENT_CONTENT,COMMENT_DATETIME) 
    VALUES ('','$progressID','$userID',NULL,'$content',CURRENT_TIMESTAMP())";

    // IF INSERT COMMENT OK, ADD NEW DIV FOR NEW COMMENT 
    if (mysqli_query($conn, $sql)) {
        // GET THE COMMENT ID FROM THE LAST INSERT QUERY
        $last_comment_id = mysqli_insert_id($conn);
        $sql2 = "SELECT * FROM COMMENT LEFT JOIN TEACHER ON COMMENT.TEACHER_ID = TEACHER.TEACHER_ID LEFT JOIN PARENT ON COMMENT.PARENT_ID = PARENT.PARENT_ID WHERE COMMENT.COMMENT_ID='$last_comment_id' AND COMMENT.PROGRESS_ID = '$progressID' ";
        $result2 = $conn->query($sql2);
        while ($row2 = $result2->fetch_assoc()) {
            $comment_id = $row2["COMMENT_ID"];
            $teacher_name = $row2["TEACHER_NAME"];
            $comment_content = $row2["COMMENT_CONTENT"];
            $comment_content = str_replace("\n", "<br/>", $comment_content);
            $comment_datetime = date_create($row2["COMMENT_DATETIME"]);
            $datetime_display = date_format($comment_datetime, 'Y-m-d g:ia');
        }
        $response['status']  = 'success';
        $output .= ' <div id="' . $comment_id .'" class="comment-row pb-1 border-bottom deletableCommentDiv">
                        <div class="comment-text w-100">
                            <div class="d-flex no-block">
                                <h5 class="mr-auto"><strong>' . $teacher_name . '</strong></h5>
                                <div class="ml-auto">
                                    <button type="button" id="" class=" deleteCommentBtn btn btn-danger btn-xs waves-effect waves-light">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <p class="m-b-10 m-t-10">' . $comment_content . '</p>
                            <small class=" text-primary">' . $datetime_display . '</small>
                        </div>
                    </div>';
        $response['output'] = $output;
    } else {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] = 'comment mysql error';
    }
} else {
    die("FATAL ERROR");
}

$conn->close();
echo json_encode($response);
