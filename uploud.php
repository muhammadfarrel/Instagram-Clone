<?php
// if (count($_FILES) > 0) {
//     if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
//         require_once "db.php";
//         $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
//         $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
        
//         $sql = "INSERT INTO output_images(imageType ,imageData) VALUES('{$imageProperties['mime']}', '{$imgData}')";
//         $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
//         if (isset($current_id)) {
//             header("Location: listImages.php");
//         }
//     }
//}
if(isset($_POST['submit'])){
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "instagram");
    $image = $_FILES['userImage']['name'];
    $target = 'images/' . $image;
    echo $target;
    if (move_uploaded_file($_FILES['userImage']['tmp_name'], $target)) {
        $capt = $_POST['caption'];
        $like = 0;
        $user = $_SESSION['user'];
        $query = mysqli_query($conn, "INSERT INTO photo VALUES (NULL, '$user', '$target', '$capt', 0)");

    }
}
?>
<HTML>
<HEAD>
<TITLE>Upload Image to MySQL</TITLE>
<!-- <link href="imageStyles.css" rel="stylesheet" type="text/css" /> -->
</HEAD>
<BODY>
    <form name="frmImage" enctype="multipart/form-data" action="" method="post" class="frmImageUpload">
        <label>Upload Image File:</label><br /> 
        <input name="userImage" type="file" class="inputFile" /> <br>
        <input name="caption" type="text" class="inputFile" />

        <input type="submit"value="Submit" class="btnSubmit" name="submit"/>
    </form>
    </div>
</BODY>
</HTML>