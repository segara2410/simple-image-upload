<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Login</title>
</head>

<body>
  <div class="container mt-3">
    <div class="row d-flex justify-content-center">
      <div class="col-md-4">
        <h2 class="text-center mt-4 mb-4">Upload Gambar</h2>
        <?php
        if (isset($_GET['pesan'])) {
          echo "<div><b>";
          if ($_GET['pesan'] == "gagal") {
            echo "Wrong Username and Password!";
          }
          else if ($_GET['pesan'] == "berhasil") {
            echo "Gambar berhasil di upload! Total gambar: ".$_GET['total'];
          }
          echo "</b></div><br>";
        }
        ?>
        <form method="post" action="sendFace.php">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
          </div>
          <div class="form-group">
            <label for="base64_image">Base64 Image</label>
            <input type="text" class="form-control" name="base64_image" placeholder="Enter Base64 Image" required>
          </div>
          <button type="submit" class="btn btn-outline-dark mb-3" style="width: 100%">Submit Image</button>
        </form>
      </div>
    </div>
    <div class="row mt-5 justify-content-center">
      <h2>Upload Log</h2>
      <div class="row">
        <?php 
        $db_connection = mysqli_connect("localhost","root","","tugas-pweb-image");

        $sql = "select * FROM upload";
        $query = mysqli_query($db_connection, $sql);
        while ($upload = mysqli_fetch_array($query)) { ?>

        <div class="col-md-4 mt-4">
          <div class="card mb-4 box-shadow">
            <img class="img-fluid" src="<?=$upload['username']."/".$upload['path']?>" alt="<?=$upload['username'].$upload['path']?>">
            <div class="card-body">
              <p class="card-text">Uploader: <?=$upload['username']?><br>image: <?=$upload['path']?></p>
              <div class="float-right">
                <small class="text-muted"><?=$upload['uploaded_at']?></small>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>