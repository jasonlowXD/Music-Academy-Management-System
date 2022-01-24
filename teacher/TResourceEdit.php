<?php
session_start();
$userID = $_SESSION["userID"];
$resource_id = $_GET["resource_id"];
$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    // GET RESOURCE DATA TO DISPLAY IN MODAL 
    $sql = "SELECT * FROM LEARNING_RESOURCE LEFT JOIN CHILD ON LEARNING_RESOURCE.CHILD_ID = CHILD.CHILD_ID WHERE LEARNING_RESOURCE.RESOURCE_ID = '$resource_id' AND LEARNING_RESOURCE.TEACHER_ID = '$userID'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $resource_child_id = $row["CHILD_ID"];
        $resource_child_name = $row["CHILD_NAME"];
        $resource_title = $row["RESOURCE_TITLE"];
        if ($row["RESOURCE_URL"] != null) {
            $resource_url = $row["RESOURCE_URL"];
        } else {
            $resource_url = null;
        }
        if ($row["RESOURCE_FILEPATH"] != null) {
            $resource_filepath = $row["RESOURCE_FILEPATH"];
            $resource_filename =  basename($resource_filepath);
        } else {
            $resource_filepath = null;
            $resource_filename = '-';
        }
    }
} else {
    die("FATAL ERROR");
}
?>

<div class="modal-header">
    <h4 class="modal-title" id="exampleModalLabel1">Edit Resource</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<form enctype="multipart/form-data" class="form-control-line" id="editResourceForm" method="post" action="editResource.php?resource_id=<?= $resource_id ?>">
    <div class="modal-body">
        <div class='form-group'>
            <label class='control-label col-md-12'>Select Child</label>
            <div class="col-md-12">
                <select class='form-control text-muted' name='childResource' required>
                    <?php
                    if ($conn) {
                        $sql2 = "SELECT * FROM CHILD WHERE TEACHER_ID = '$userID'";
                        $result2 = $conn->query($sql2);
                        while ($row2 = $result2->fetch_assoc()) {
                            $child_id = $row2["CHILD_ID"];
                            $child_name = $row2["CHILD_NAME"];
                            $child_status = $row2["CHILD_STATUS"];
                            if ($resource_child_id == $child_id && $child_status == 'inactive') {
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
                            if ($resource_child_id == $child_id) {
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
            <label class="col-md-12" for="example-text3">Resource Title</span>
            </label>
            <div class="col-md-12">
                <input type="text" id="example-text3" name="resourceTitle" class="form-control text-muted" placeholder="enter resource title" value="<?php echo $resource_title; ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Resource Url</label>
            <div class="col-md-12">
                <input type="url" id="example-url" name="resourceUrl" class="form-control text-muted" placeholder="example:  https://www.youtube.com/" value="<?php echo $resource_url; ?>">
            </div>
        </div>
        <div class="form-group" id="editResourceFileDiv">
            <label class="col-sm-12">Resource File</label>
            <div class="col-sm-12 fileinput fileinput-exists input-group" data-provides="fileinput">
                <div class="col-sm-12 form-control" data-trigger="fileinput">
                    <i class="glyphicon glyphicon-file fileinput-exists"></i>
                    <input type="hidden" id="oldFileValue" name="oldFile" value="<?php echo $resource_filepath; ?>">
                    <span class="fileinput-filename text-muted"><?php echo $resource_filename; ?></span>
                </div>
                <div class="col-sm-12 p-l-0">
                    <span class="p-l-0 border-bottom-0 input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">Select file (only accept pdf or image file, max 2MB)</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="hidden">
                        <!-- get file data from this below input -->
                        <input type="file" id="editResourceFileInput" name="resourceFile" accept="image/jpeg,image/png,application/pdf">
                    </span>
                    <a href="javascript:void(0)" id="btnFileRemove2" class=" border-bottom-0 input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
                <span class="p-l-0 col-sm-12" id="editResourceFileFeedback"></span>
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
        editResourceFileRemoveClass();
        $("#editResourceFileInput").val('');
        $("#oldFileValue").val('');
    });

    $("#editResourceForm").submit(function(e) {
        e.preventDefault();
        $('html, body').css("cursor", "wait");
        var formData = new FormData(this);
        $.ajax({
                enctype: 'multipart/form-data',
                url: $("#editResourceForm").attr('action'),
                type: $("#editResourceForm").attr('method'),
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json'
            })
            .done(function(response) {
                if (response.status == 'success') {
                    editResourceFileRemoveClass();
                    Swal.fire(
                        response.title,
                        response.message,
                        response.status
                    ).then(() => {
                        window.location.href = "TResource.php";
                    })
                    $('html, body').css("cursor", "auto");
                } else if (response.status == 'error' && response.title == 'Error resource file') {
                    editResourceFileAddClass(response.message);
                    $('html, body').css("cursor", "auto");
                } else {
                    editResourceFileRemoveClass();
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