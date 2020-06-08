<?php
require_once 'vendor/autoload.php';
use Gregwar\Image\Image;

$images = glob("images/*.{jpg,JPG,jpeg,JPEG,png,PNG}", GLOB_BRACE);

$status = '';
$message = "";

if (isset($_POST["submit"])) {
    $old_image = $_POST['oldimage'];
    $target_dir = 'dummy/';
    $target_file = $target_dir . basename($_FILES["newimage"]["name"]);
    $post_tmp_img = $_FILES["newimage"]["tmp_name"];
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($_FILES["newimage"]["size"] < 500000) {
        if (move_uploaded_file($post_tmp_img, $target_file)) {
            Image::open($target_file)
                ->negate()
                ->save('images/' . $old_image);

            $status = 1;
            $message = "Image has been overwriten successfully!";
        } else {
            $status = 0;
            $message = "Image is failed to overwrite!";
        }
    }else {
      $status = 0;
      $message = "Image is failed to overwrite because size is bigger than 5mb";
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
              <?php
if ($status == 1) {
    echo '<div class="alert alert-success">' . $message . '</div>';
}if ($status == 0 && $message != '') {
    echo '<div class="alert alert-danger">' . $message . '</div>';
}
?>
                            <div class="form-group">
                              <label>Select the Image which you want to change:</label>
                              <select name="oldimage" class="form-control">
                                <?php
foreach ($images as $image) {
    echo '<option value="' . basename($image) . '">' . basename($image) . '</option>';
}
?>
                </select>
              </div>
              <div class="form-group">
                <label>Upload new image</label>
                <input id="file-input" name="newimage" type="file" accept="image/*"/>
              </div>
              <div class="form-group mb-5">
                <input type="submit" class="btn btn-success" name="submit" value="CHANGE IMAGE NOW">
              </div>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>
  </div>
  </div>
</body>
</html>