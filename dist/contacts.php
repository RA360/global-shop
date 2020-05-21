<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no, maximum-scale=1" />
  <meta content="width=1219" name="viewport" />
  <meta name="description" content="Get the most out of your music with an award-winning, emotionally
    charged Beats listening experience." />
  <title>Contacts | Global Shop</title>
  <link rel="icon" href="favicon.png" type="image/x-icon" />
  <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
  <link rel="stylesheet" href="assets/css/main.min.css" />
  <script src="https://api-maps.yandex.ru/2.1/?lang=en_US"></script>
</head>

<body>
  <?php require('./includes/header.php') ?>
  <!-- Contacts -->
  <section class="contacts">
    <div class="contacts__map">
      <!-- Yandex Map -->
      <div id="map" class="map"></div>
      <!-- End Yandex Map -->
      <div class="map-btns" id="mapBtns">
      </div>
    </div>
    <div class="contacts__box">
      <h2 class="contacts__offer offer">
        Contact US
      </h2>
      <h3 class="contacts__subtitle">
        Visit US
      </h3>
      <a href="https://yandex.com/maps/202/new-york/?from=api-maps&ll=-74.002191%2C40.711317&mode=usermaps&origin=jsapi_2_1_75&um=constructor%3A053ac146a13f9b06135dce78314c8de17b1091c123b2629090bc3eeb43ababa3&z=16.2" class="contacts__txt" target="_blank">
        2127 West 6th Street<br>Brooklyn, New York<br>USA
      </a>
      <h3 class="contacts__subtitle">
        Email
      </h3>
      <a href="mailto:glbalshop@mail.ru" class="contacts__txt" target="_blank">
        glbalshop@mail.ru
      </a>
      <h3 class="contacts__subtitle">
        Phone
      </h3>
      <a href="tel:+1319978978" class="contacts__txt" target="_blank">
        +1319978978
      </a>
      <form class="contact" action="/contacts" method="POST">
        <input type="email" name='email' placeholder="Enter Email" required>
        <input type="tel" name="tel" placeholder="Phone" title="Must contain only digits" pattern="^[0-9]+$" required>
        <textarea name="msg" placeholder="Message" required></textarea>
        <button type="submit" name="submit" class="submit btn">
          Contact US <i class="fas fa-chevron-right"></i>
        </button>
        <?php
        $email = htmlspecialchars(stripslashes(trim($_POST['email'])));
        $tel = $_POST['tel'];
        $msg = htmlspecialchars(stripslashes(trim($_POST['msg'])));
        if (isset($_POST['submit'])) :
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
        ?>
            <p class="error">Invalid email format</p>
          <?php elseif (!is_numeric($tel)) : ?>
            <p class="error">Telephone number must contain only digits</p>
          <?php elseif (!$msg) : ?>
            <p class="error">Message can't be blank</p>
          <?php elseif (mail('glbalshop@mail.ru', 'Contact Us', "email: $email\r\ntel: $tel\r\nmessage: $msg")) : ?>
            <p class="success">Message has been sent</p>
          <?php else : ?>
            <p class="error">Sorry, sending the message failed. Please try again.</p>
        <?php
          endif;
        endif;
        ?>
      </form>
    </div>
  </section>
  <!-- End contacts -->
  <script src="assets/js/contacts.min.js"></script>
  <script src="assets/js/main.min.js"></script>
</body>

</html>