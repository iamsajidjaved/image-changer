<?php
$error = false;
$success = false;
$successMessage = "";
$errorMessage = "";
if (isset($_POST["submit"])) {
    $target_files = "images/" . basename($_FILES["newimage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_files, PATHINFO_EXTENSION));
    if ($_FILES["newimage"]["size"] > 500000) {
        $errorMessage = "Sorry, your file is too large.";
        $success = false;
        $error = true;
    }

//Allow certain file formats
    if ($imageFileType != "png") {
        $errorMessage = "Sorry, only  PNG FILE are allowed.";
        $success = false;
        $error = true;

    }
    if ($_FILES["newimage"]["size"] == 0) {
        $errorMessage = "Please a Upload Image";
        $success = false;
        $error = true;
    }

    $target_dir = "images/";
    $target_file = $target_dir . $_POST['oldimage'];
    if (file_exists($target_file) && $_FILES['newimage']['size'] != 0 && $error == false) {

        if (move_uploaded_file($_FILES["newimage"]["tmp_name"], "images/" . $_POST['oldimage']));
        {
            $successMessage = "Image successfully changed";
            $success = true;
            $error = false;
        }

    } else {

        $success = false;
        $error = true;
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>


<div class="container mt-5">



  <div class="row">
     <div class="col-md-8 offset-2">
     <h1 class="text-center">Easy Image Changer</h1>
<form method="POST" enctype="multipart/form-data" action="">

  <div class="card">

    <div class="card-body">


<div class="form-group">
  <label>Select Image to Change</label>
    <?php

$images = glob("images/*.{png}", GLOB_BRACE);
echo '<select name="oldimage" class="form-control">';
foreach ($images as $image) {
    echo '<option value="' . basename($image) . '">' . basename($image) . '</option>';

}

echo '</select>';

?>
</div>
<div class="form-group">
  <label>Upload new image</label>
    <input id="file-input" name="newimage" type="file"/>
</div>
<div class="form-group mb-5">
  <input type="submit" class="btn btn-success" name="submit" value="Change a image">
  </div>

</div>
<?php
if ($error == true) {
    echo $result = '<div class="alert alert-danger">' . $errorMessage . '</div>';
} else {

}
if ($success == true) {
    echo $result = '<div class="alert alert-success">' . $successMessage . '</div>';
} else {

}
?>
</div>
</div>
</form>
</div>
</div>
  </div>
</div>

</body>
</html>
