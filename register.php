<?php
$db_connection = mysqli_connect("localhost","root","","tugas-pweb-image");
$username = "admin";
$password = password_hash("admin", PASSWORD_DEFAULT);

$sql = "insert into user values (NULL, '$username', '$password')";
$query = mysqli_query($db_connection, $sql);