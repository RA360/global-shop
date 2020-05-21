<?php
require_once('../db.php');

$cartGoods = json_decode(file_get_contents('php://input'), true);
$goodsId = implode(',', array_map(
  function ($e) {
    return array_keys($e)[0];
  },
  $cartGoods
));
$goods = mysqli_fetch_all(mysqli_query($connection, "SELECT * FROM `goods` WHERE `id` IN ($goodsId) ORDER BY FIELD(`id`,$goodsId)"), MYSQLI_ASSOC);
$count = 0;
$grandTotal = 0;
foreach ($goods as $index => $item) :
  foreach ($cartGoods as $obj) {
    if ($obj[$item['id']]) {
      $count = +$obj[$item['id']];
      break;
    }
  }
  $total = $item['price'] * $count;
  $grandTotal += $total;
?>
  <div class="cart__box" data-goods-id=<?php echo $item['id'] ?>>
    <a href="detail.php?id=<?php echo $item['id'] ?>" class="goods-img" target="_blank">
      <img src="assets/img/<?php echo $item['imgSm'] ?>" alt="<?php echo $item['title'] ?>" />
    </a>
    <div>
      <a href="detail.php?id=<?php echo $item['id'] ?>" class="goods-txt" target="_blank">
        <?php echo $item['title'] ?>
      </a>
      <p class="goods-desc">
        <?php echo substr(
          $item['text'],
          0,
          47
        ) ?>...
      </p>
      <ul class="stars">
        <li class="star star_painted"></li>
        <li class="star star_painted"></li>
        <li class="star star_painted"></li>
        <li class="star star_unpainted"></li>
        <li class="star star_unpainted"></li>
      </ul>
    </div>
    <div class="cart__group">
      <?php if (!$index) : ?>
        <h4 class="cart__title">Price</h4>
      <?php endif; ?>
      <p class="price">$<span class="js-price"><?php echo $item['price'] ?></span></p>
    </div>
    <div class="cart__group">
      <?php if (!$index) : ?>
        <h4 class="cart__title">Qty</h4>
      <?php endif; ?>
      <div class="quantity cart__item">
        <button class="quantity__btn js-decrease" <?php if ($count == 1) echo 'disabled' ?>>
          <i class="fas fa-minus"></i>
        </button>
        <input class="quantity__num" value="<?php echo $count ?>" data-quantity="<?php echo $item['quantity'] ?>" />
        <button class="quantity__btn js-increase" <?php if ($count == $item['quantity']) echo 'disabled' ?>>
          <i class="fas fa-plus"></i>
        </button>
      </div>
    </div>
    <div class="cart__group">
      <?php if (!$index) : ?>
        <h4 class="cart__title">Total</h4>
      <?php endif; ?>
      <p class="cart__item">
        $<span class="js-total"><?php echo $total ?></span>
      </p>
    </div>
    <div class="cart__group">
      <?php if (!$index) : ?>
        <h4 class="cart__title">Delete</h4>
      <?php endif; ?>
      <button class="cart__delete cart__item">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
<?php endforeach ?>
<div class="cart__bottom">
  <p class="cart__title">Grand Total</p>
  <p class="grand-total">$<span id="grandTotalNum"><?php echo $grandTotal ?></span></p>
  <button class="checkout black-btn" id="checkout">Checkout</button>
</div>