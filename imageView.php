<?php
    $conn = mysqli_connect("localhost", "root", "", "instagram");
    if(isset($_GET['image_id'])) {
        session_start();
        $sql = "select foto FROM `photo`";
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type: " . $row["imageType"]);
        echo $row["imageData"];
	}
	mysqli_close($conn);
?>