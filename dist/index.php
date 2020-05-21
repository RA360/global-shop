<?php require_once('./db.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=1219" name="viewport" />
  <meta name="description" content="Get the most out of your music with an award-winning, emotionally
    charged Beats listening experience in Global Store." />
  <title>
    Global Shop - get the most out of your music with an award-winning,
    emotionally charged Beats listening experience
  </title>
  <link rel="icon" href="./favicon.png" type="image/x-icon" />
  <link rel="shortcut icon" href="./favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
  <link rel="stylesheet" href="assets/css/main.min.css" />
</head>

<body>
  <!-- Header -->
  <header class="header_home header">
    <div class="header__nav">
      <div class="header__nav-left">
        <div class="hamburger" id="hamburger">
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
        </div>
        <p class="hamburger-txt">
          Menu
        </p>
      </div>
      <a href="/" class="title" id="title">
        Global Shop
      </a>
      <div class="header__btns">
        <button class="search-btn" id="searchBtn"></button>
        <a href="cart" class="basket">
          <span class="basket__count" id="basketCount">0</span>
        </a>
      </div>
    </div>
    <div class="search">
      <input class="search__input" id="searchI" autocomplete="off" placeholder="Beats EP" />
      <div class="suggests" id="suggests"></div>
    </div>
    <div class="dropdown popup" id="dropdown">
      <a href="news" class="dropdown__item">News</a>
      <a href="catalog" class="dropdown__item">Catalog</a>
      <a href="contacts" class="dropdown__item">Contacts</a>
      <a href="about" class="dropdown__item">About Us</a>
      <a href="delivery" class="dropdown__item">Delivery</a>
      <a href="faq" class="dropdown__item">FAQ</a>
    </div>
    <div class="header__row">
      <?php
      $goods = mysqli_fetch_all(mysqli_query($connection, 'SELECT * FROM `goods` WHERE `imgXl` IS NOT NULL ORDER BY `id` DESC LIMIT 5'), MYSQLI_ASSOC);
      ?>
      <div class="header__content">
        <p class="header__tagline tagline">
          Technique
        </p>
        <h1 class="header__offer offer">
          Got No Strings
        </h1>
        <p class="header__desc">
          Get the most out of your music with an award-winning, emotionally
          charged Beats listening experience.
        </p>
        <a href="detail?id=<?php echo $goods[0]['id'] ?>" class="show-btns" id="showBtns" target="_blank">
          <span class="show-btns-txt show-btn">
            Show Item
          </span>
          <div class="show-btns-icon show-btn">
            <i class="fas fa-chevron-right"></i>
          </div>
        </a>
        <div class="header__videos">
          <?php
          $videos = mysqli_query($connection, 'SELECT * FROM `videos` ORDER BY `id` DESC LIMIT 2');
          while ($video = mysqli_fetch_assoc($videos)) :
          ?>
            <div class="header__video">
              <img class="full" src="assets/img/<?php echo $video['poster'] ?>" alt="" />
              <button class="header__play center play" data-video="<?php echo $video['video'] ?>"></button>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
      <div class="slider" id="slider">
        <div class="slider__wrap">
          <?php
          foreach ($goods as $index => $item) {
          ?>
            <a href="detail?id=<?php echo $item['id'] ?>" class="slide <?php if (!$index) echo 'active' ?>" data-goods-id="<?php echo $item['id'] ?>" target="_blank">
              <img src="assets/img/<?php echo $item['imgXl'] ?>" alt="<?php echo $item['title'] ?>" />
            </a>
          <?php } ?>
        </div>
        <div class="slider__dots">
          <?php
          for ($i = 1; $i <= count($goods); $i++) :
          ?>
            <span class="slider__dot <?php if ($i == 1) echo 'active' ?>"><?php echo $i ?></span>
          <?php endfor; ?>
        </div>
        <div class="slider__prev slider__btn" id="sliderPrev">
          Prev <i class="fas fa-arrow-right"></i>
        </div>
        <div class="slider__next slider__btn" id="sliderNext">
          Next <i class="fas fa-arrow-right"></i>
        </div>
      </div>
    </div>
  </header>
  <!-- End header -->
  <!-- Goods -->
  <section class="goods">
    <div>
      <h2 class="offer">
        Our<br>Products
      </h2>
      <div class="sorts_cat sorts">
        <button class="sort active" data-cat="headphones">Headphones</button>
        <button class="sort" data-cat="earphones">Earphones</button>
        <button class="sort" data-cat="speakers">Speakers</button>
      </div>
      <div class="sorts_color sorts">
        <h3 class="sorts__title">
          Colors
        </h3>
        <button class="sort" data-color="pink">Pink</button>
        <button class="sort" data-color="blue">Blue</button>
        <button class="sort" data-color="gold">Gold</button>
        <button class="sort" data-color="green">Green</button>
      </div>
    </div>
    <div>
      <div class="goods__row">
        <p>Sort By:</p>
        <select class="goods__sel" id="goodsSel">
          <option value="newness">Newness</option>
          <option value="ascending">Price: Low to High</option>
          <option value="descending">Price: High to Low</option>
        </select>
      </div>
      <div class="goods__list" id="goodsList"></div>
    </div>
  </section>
  <!-- End Goods -->
  <!-- Intro -->
  <section class="intro">
    <img class="full" src="assets/img/intro.jpg" alt="" />
    <button class="intro__play center play" data-video="intro.mp4"></button>
  </section>
  <!-- End intro -->
  <!-- Resource -->
  <section class="resource">
    <div class="resource__box">
      <p class="resource__tagline tagline">
        Resourses
      </p>
      <h2 class="offer">
        Service And<br>Warranty
      </h2>
      <p class="resource__desc">
        Shop for genuine Beats by Dr. Dre goods at an Apple Online
        Store, Apple Retail Store, or an authorized retailer.
      </p>
      <a href="warranty" class="resource__link btn">
        View Service And Warranty <i class="fas fa-chevron-right"></i>
      </a>
    </div>
    <img src="assets/img/resourse.jpg" class="resource__img" alt="Resource" />
  </section>
  <!-- End resource -->
  <?php require('./includes/footer.php') ?>
  <script src="assets/js/home.min.js"></script>
  <script src="assets/js/main.min.js"></script>
</body>

</html>