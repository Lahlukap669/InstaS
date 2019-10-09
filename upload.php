<?php
include_once("head.php");
?>
<!DOCTYPE html>
<html>
<body>

<form action="upload_process.php" method="post" enctype="multipart/form-data">

<div class="input-group scale60 posc">
  <div class="custom-file">
  <input type="text" id="title" placeholder="title" name="title" class="form-control custom-file-label" required>
  </div>
</div>

<div class="input-group scale60 posc">
  <div class="custom-file">
  <input type="text" placeholder="Description..." name="des" class="form-control custom-file-label" required>
  </div>
</div>

<div class="input-group scale60 posc">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
  </div>
  <div class="custom-file">
      <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload" aria-describedby="inputGroupFileAddon01" required>
    <label id="display" class="custom-file-label" for="fileToUpload">Choose file</label>
  </div>
</div>

<input class="btn btn-primary mbut" type="submit" value="Upload Image" name="submit">
</form>





<form action="upload_story.php" method="post" enctype="multipart/form-data">

<div class="input-group scale60 posc">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
  </div>
  <div class="custom-file">
      <input type="file" class="custom-file-input" name="fileToUpload1" id="fileToUpload1" aria-describedby="inputGroupFileAddon02" required>
    <label id="display1" class="custom-file-label" for="fileToUpload">Choose file</label>
  </div>
</div>

<input class="btn btn-primary mbut" type="submit" value="Upload story" name="submit">
</form>

<script type="text/javascript">
    $('#fileToUpload').on('change',function(){
       $('#display').text($(this).val()); 
    });
    $('#fileToUpload1').on('change',function(){
       $('#display1').text($(this).val()); 
    });

</script>

</body>
</html>