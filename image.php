<?php 

// Include config file
require_once "config.php";


//if button with the name uploadfilesub has been clicked
if($_SERVER["REQUEST_METHOD"] == "POST"){
//declaring variables
$filename = $_FILES['uploadfile']['name'];
$filetmpname = $_FILES['uploadfile']['tmp_name'];
//folder where images will be uploaded
$folder = 'imagesuploadedf/';
//function for saving the uploaded images in a specific folder
move_uploaded_file($filetmpname, $folder.$filename);
//inserting image details (ie image name) in the database
$sql = "INSERT INTO `uploadedimage` (`imagename`) VALUES ('$filename')";
$qry = mysqli_query($link, $sql);
if( $qry) {
echo "</br>image uploaded";
}
}
?>
<!DOCTYPE html>
<html>
<body>
<!-- <! — Make sure to put "enctype="multipart/form-data" inside form tag when uploading files → -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" >
<!-- <! — input tag for file types should have a "type" attribute with value "file" → -->
<input type="file" name="uploadfile" />
<input type="submit" name="uploadfilesub" value="upload" />
</form>
</body>
</html>