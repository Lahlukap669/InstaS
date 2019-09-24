<?php
include_once("head.php");
?>
<!DOCTYPE html>
<html>
<body>

<form action="upload_process.php" method="post" enctype="multipart/form-data">
    <input type="text" placeholder="Title..." name="title" class="form-control"><br>
    <input type="text" placeholder="Description..." name="des" class="form-control"><br>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>