<?php
session_start();
$userID = $_SESSION["userID"];
$progress_id = $_GET["progress_id"];
$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    // GET PROGRESS DATA TO DISPLAY IN MODAL 
    $sql = "SELECT * FROM PRACTICE_PROGRESS LEFT JOIN CHILD ON PRACTICE_PROGRESS.CHILD_ID = CHILD.CHILD_ID WHERE PRACTICE_PROGRESS.PROGRESS_ID = '$progress_id' AND PRACTICE_PROGRESS.TEACHER_ID = '$userID'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $progress_child_id = $row["CHILD_ID"];
        $progress_child_name = $row["CHILD_NAME"];
        $progress_course = $row["PROGRESS_COURSE"];
        $progress_title = $row["PROGRESS_TITLE"];

        if ($row["PROGRESS_FILEPATH"] != null) {
            $progress_filepath = $row["PROGRESS_FILEPATH"];
            $progress_filename =  basename($progress_filepath);
        } else {
            $progress_filepath = null;
            $progress_filename = '-';
        }
    }
} else {
    die("FATAL ERROR");
}
?>

<div class="modal-header">
    <h4 class="modal-title" id="exampleModalLabel1">Edit Practice Progress</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<form enctype="multipart/form-data" class="form-control-line" id="editProgressForm" method="post" action="editProgress.php?progress_id=<?= $progress_id ?>">
    <div class="modal-body">
        <div class='form-group'>
            <label class='control-label col-md-12'>Select Child</label>
            <div class="col-md-12">
                <select class='form-control text-muted child_option' name='childProgress' required>
                    <?php
                    if ($conn) {
                        $sql2 = "SELECT * FROM CHILD WHERE TEACHER_ID = '$userID'";
                        $result2 = $conn->query($sql2);
                        while ($row2 = $result2->fetch_assoc()) {
                            $child_id = $row2["CHILD_ID"];
                            $child_name = $row2["CHILD_NAME"];
                            $child_status = $row2["CHILD_STATUS"];
                            if ($progress_child_id == $child_id && $child_status == 'inactive') {
                    ?>
                                <option hidden value="<?php echo $child_id ?>" selected> <?php echo $child_name ?> </option>
                            <?php
                            }
                        }
                        $sql3 = "SELECT * FROM CHILD WHERE TEACHER_ID = '$userID' AND CHILD_STATUS ='active'";
                        $result3 = $conn->query($sql3);
                        while ($row3 = $result3->fetch_assoc()) {
                            $child_id = $row3["CHILD_ID"];
                            $child_name = $row3["CHILD_NAME"];
                            if ($progress_child_id == $child_id) {
                            ?>
                                <option value="<?php echo $child_id ?>" selected><?php echo $child_name ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="<?php echo $child_id ?>"><?php echo $child_name ?></option>
                    <?php
                            }
                        }
                    } else {
                        die("FATAL ERROR");
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12" for="example-text">Child's Course</span>
            </label>
            <div class="col-md-12 course_option">
                <input type="text" name="courseName" class="form-control" placeholder="Select a child first" value="<?php echo $progress_course; ?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12" for="example-text3">Practice Progress Title</span>
            </label>
            <div class="col-md-12">
                <input type="text" id="example-text3" name="progressTitle" class="form-control text-muted" placeholder="enter title" value="<?php echo $progress_title; ?>" required>
            </div>
        </div>
        <div class="form-group" id="editProgressFileDiv">
            <label class="col-sm-12">Practice Progress File</label>
            <div class="col-sm-12 fileinput fileinput-exists input-group" data-provides="fileinput">
                <div class="col-sm-12 form-control" data-trigger="fileinput">
                    <i class="glyphicon glyphicon-file fileinput-exists"></i>
                    <input type="hidden" id="oldFileValue" name="oldFile" value="<?php echo $progress_filepath; ?>">
                    <span class="fileinput-filename text-muted"><?php echo $progress_filename; ?></span>
                </div>
                <div class="col-sm-12 p-l-0">
                    <span class="p-l-0 border-bottom-0 input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">Select file (only accept video file, max 500MB)</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="hidden">
                        <!-- get file data from this below input -->
                        <?php
                        if ($progress_filepath != null) {
                        ?>
                            <input type="file" id="editProgressFileInput" name="progressFile" accept="video/mp4, video/webm">
                        <?php
                        } else {
                        ?>
                            <input type="file" id="editProgressFileInput" name="progressFile" accept="video/mp4, video/webm" required>
                        <?php
                        }
                        ?>
                    </span>
                    <a href="javascript:void(0)" id="btnFileRemove2" class=" border-bottom-0 input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
                <span class="p-l-0 col-sm-12" id="editProgressFileFeedback"></span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>

<script>
    $('#btnFileRemove2').click(function() {
        editProgressFileRemoveClass();
        $("#editProgressFileInput").val('');
        $("#oldFileValue").val('');
        $("#editProgressFileInput").prop('required', true);
    });

    // get course name after select child 
    $(document).on('change', 'select.child_option', function() {
        var progressFormid = $(this).closest("form[id]").attr("id");
        var childSelected = $(this).val();
        $.ajax({
                url: 'getCourseName.php',
                type: 'POST',
                data: {
                    child_id: childSelected
                },
                dataType: 'json',
            })
            .done(function(response) {
                $('#' + progressFormid).find(".course_option").html(response.output);
            }).fail(function(xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);
            })
    });


    $("#editProgressForm").submit(function(e) {
        e.preventDefault();
        $('html, body').css("cursor", "wait");
        var formData = new FormData(this);
        $.ajax({
                enctype: 'multipart/form-data',
                url: $("#editProgressForm").attr('action'),
                type: $("#editProgressForm").attr('method'),
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json'
            })
            .done(function(response) {
                if (response.status == 'success') {
                    editProgressFileRemoveClass();
                    Swal.fire(
                        response.title,
                        response.message,
                        response.status
                    ).then(() => {
                        window.location.href = "TPractice.php";
                    })
                    $('html, body').css("cursor", "auto");
                } else if (response.status == 'error' && response.title == 'Error practice progress file') {
                    editProgressFileAddClass(response.message);
                    $('html, body').css("cursor", "auto");
                } else {
                    editProgressFileRemoveClass();
                    Swal.fire(
                        response.title,
                        response.message,
                        response.status
                    )
                    $('html, body').css("cursor", "auto");
                }
            })
            .fail(function(xhr, textStatus, errorThrown) {
                Swal.fire(
                    'Oops...',
                    'Something went wrong with ajax!',
                    'error'
                )
                $('html, body').css("cursor", "auto");
                console.log(xhr);
            })
    })
</script>