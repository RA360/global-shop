<?php
require_once('../db.php');

$searchTxt = file_get_contents('php://input');
$goods = mysqli_query($connection, "SELECT * FROM `goods` WHERE `title` LIKE '$searchTxt%' LIMIT 10");

while ($item = mysqli_fetch_assoc($goods)) :
?>
  <a href="detail.php?id=<?php echo $item['id'] ?>" class="suggest" target="_blank">
    <span><?php echo substr($item['title'], 0, strlen($searchTxt)) ?></span><?php echo substr($item['title'], strlen($searchTxt)) ?>
  </a>
<?php endwhile;
