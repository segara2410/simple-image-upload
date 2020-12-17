<?php

$conn = mysqli_connect("localhost","root","","tugas-pweb-image");

$base64_string = $_POST['base64_image'];
$username = $_POST['username'];
$password = $_POST["password"];

$data = mysqli_query($conn, "select * from user where username='$username'");

$cek = mysqli_num_rows($data);

if ($cek > 0) {
  while ($row = mysqli_fetch_assoc($data)) {
    if(password_verify($password, $row["password"])){
        $image_name = "D:\\xampp\\htdocs\\tugas-pweb-image\\".$username;
        if (!file_exists($image_name)) {
            if (!mkdir($image_name)) {
                $m=array('msg' => "REJECTED, cant create folder");
                echo json_encode($m);
                return;
            }
        }

        $fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
        $fileCount = iterator_count($fi)+1;
        $data = explode(',', $base64_string);
        $last_image_name = "\\X__".$fileCount."_". date("YmdHis") .".png";
        $fullName = $image_name.$last_image_name;

        $sql = "insert into upload values (NULL, '$username', '$last_image_name', NULL)";
        $query = mysqli_query($conn, $sql);

        $ifp = fopen($fullName, "wb");
        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);
        if (!$ifp) {
            $m=array('msg' => "REJECTED, ".$fullName."not saved");
            echo json_encode($m);
            return;
        }

        $fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
        $fileCount = iterator_count($fi);
        $m = array('msg' => "Berhasil Mengirim"." total(".$fileCount.")");
        echo json_encode($m);
        header("location:index.php?pesan=berhasil&total=".$fileCount);

    } else {
      header("location:index.php?pesan=gagal");
    }
  }
}


?>
