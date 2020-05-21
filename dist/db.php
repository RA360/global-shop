<?php
$connection = mysqli_connect('localhost', 'root', 'root', 'global-shop');
if (!$connection) {
  echo mysqli_connect_error();
  exit();
}
