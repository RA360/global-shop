<?php
require_once('../db.php');

$orderBy = file_get_contents('php://input');
$goods = mysqli_query($connection, "SELECT * FROM `goods` $orderBy LIMIT 6");

while ($item = mysqli_fetch_assoc($goods)) :
?>
  <a href="detail.php?id=<?php echo $item['id'] ?>" class="goods__item" target="_blank">
    <div class="goods-img">
      <img src="assets/img/<?php echo $item['img'] ?>" alt="<?php echo $item['title'] ?>" />
    </div>
    <h3 class="goods-txt"><?php echo $item['title'] ?></h3>
    <p class="goods-desc"><?php echo substr($item['text'], 0, 47) ?>...</p>
    <div class="pricing">
      <p class="price goods-txt">$<?php echo $item['price'] ?></p>
      <ul class="stars">
        <li class="star star_painted"></li>
        <li class="star star_painted"></li>
        <li class="star star_painted"></li>
        <li class="star star_unpainted"></li>
        <li class="star star_unpainted"></li>
      </ul>
    </div>
  </a>
<?php endwhile;
