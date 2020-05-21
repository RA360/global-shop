<?php
require_once('./db.php');
$goods = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `goods` WHERE `id` = " . +$_GET['id']));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=1219" name="viewport" />
  <meta name="description" content="Get the most out of your music with an award-winning, emotionally
    charged Beats listening experience." />
  <title>
    <?php
    echo empty($goods) ? 'No Product Found - Global Shop' : $goods['title'] . ' - buy at a bargain price | Global Shop';
    ?>
  </title>
  <link rel="icon" href="favicon.png" type="image/x-icon" />
  <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="assets/css/main.min.css" />
</head>

<body class="<?php if (empty($goods)) echo 'full-height' ?>">
  <?php require('./includes/header.php') ?>
  <section class="detail">
    <?php if (empty($goods)) : ?>
      <p class="not-found center">No product found</p>
    <?php else : ?>
      <div class="detail__box">
        <h2 class="offer"><?php echo $goods['title'] ?></h2>
        <ul class="stars">
          <li class="star star_painted"></li>
          <li class="star star_painted"></li>
          <li class="star star_painted"></li>
          <li class="star star_unpainted"></li>
          <li class="star star_unpainted"></li>
        </ul>
        <p class="detail__desc">
          <?php echo $goods['text'] ?>
        </p>
        <input class="detail__input" id="detailI" type="number" min="1" max="<?php echo $goods['quantity'] ?>" value="1" />
        <button class="detail__btn black-btn" id="addToCart" data-goods-id="<?php echo $goods['id'] ?>">Add to cart</button>
      </div>
      <img src="assets/img/<?php echo $goods['imgLg'] ?>" alt="<?php echo $goods['title'] ?>" />
    <?php endif; ?>
  </section>
  <script src="assets/js/detail.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>