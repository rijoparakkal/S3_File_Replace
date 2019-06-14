<!DOCTYPE html>
<html lang="en">
<head>
  <title>S3 file replace</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
span {
  background-color: yellow;
}
</style>
</head>
<body>

<form action="uploadaction.php" enctype="multipart/form-data" method="post">

    <div class="form-group">
      <h2> S3 File Replace</h2>
      <div class="col-sm-12" style="background-color:lavender;">
        <label for='upload'>Upload the Images</label>
        <input id='upload' name="upload[]" type="file" multiple="multiple" />
      </div>
      <div class="col-sm-12" style="background-color:lavender;">
         <label for='comment'>Enter the Existing URLs (For ex: https://s3.eu-central-1.amazonaws.com/bucket_name/folder_name/file_name.png)</label>

	<textarea class="form-control" rows="5" id="comment" name="comment1"></textarea>
</div>
<div class="col-sm-12" style="background-color:lavender;">
<label for='bucket1'>Enter the bucket name (https://s3.eu-central-1.amazonaws.com/<span>bucket_name</span>/folder_name/file_name.png)</label>
<input type="text" class="form-control" name="bucket" id="bucket1">
</div>
<div class="col-sm-12" style="background-color:lavender;">
<label for='region1'>Enter the region (https://s3.<span>eu-central-1</span>.amazonaws.com/bucket_name/folder_name/file_name.png)</label>
<input type="text" class="form-control" name="region" id="region1">
	</div>
    
<div class="col-sm-12" style="background-color:lavender;">
    <p><input type="submit" name="submit" value="Submit"></p>
  </div>
</div>
</form>
<style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: lavender;
  color: black;
  text-align: center;
}
</style>

<div class="footer">
  <p><h5>devopsonline.in</h5></p>
</div>
</body>
</html>
