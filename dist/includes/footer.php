<footer class="footer">
  <ul class="footer__links">
    <li>
      <a href="news" class="footer__link">
        News
      </a>
      <a href="catalog" class="footer__link">
        Catalog
      </a>
      <a href="contacts" class="footer__link">
        Contacts
      </a>
    </li>
    <li>
      <a href="about" class="footer__link">
        About Us
      </a>
      <a href="delivery" class="footer__link">
        Delivery
      </a>
      <a href="faq" class="footer__link">
        FAQ
      </a>
    </li>
  </ul>
  <div class="footer__socials">
    <a href="/" class="footer__title title">
      Global Shop
    </a>
    <div class="footer__row">
      <a href="mailto:raibrahim360@gmail.com" class="footer__social" target="_blank">
        <i class="fas fa-envelope"></i>
      </a>
      <a href="https://t.me/RAIbrahim360" class="footer__social" target="_blank">
        <i class="fab fa-telegram-plane"></i>
      </a>
      <a href="https://wa.me/994517833377" class="footer__social" target="_blank">
        <i class="fab fa-whatsapp"></i>
      </a>

      <a href="https://www.instagram.com/raibrahim360/" class="footer__social" target="_blank">
        <i class="fab fa-instagram"></i>
      </a>
    </div>
  </div>
  <form class="subscribe" action="/#subscribe" method="POST" id="subscribe">
    <input type="email" name="email" placeholder="Enter Email" required />
    <button type="submit" class="submit btn">
      Subscribe <i class="fas fa-chevron-right"></i>
    </button>
    <?php
    if (isset($_POST['email'])) :
      $email = htmlspecialchars(stripslashes(trim($_POST['email'])));
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) : ?>
        <p class="error">Invalid email format</p>
      <?php elseif (mail(
        $email,
        'Thank you for subscribing to our Global Shop',
        "For questions about this list, please contact:\r\nglbalshop@mail.ru",
        'From: glbalshop@mail.ru'
      )) :
        mysqli_query($connection, "INSERT IGNORE INTO `subscribe` (`email`) VALUES ('$email')");
      ?>
        <p class="success">Congratulations! You're on our subscription list now</p>
      <?php else : ?>
        <p class="error">Oops, subscription unsuccessful. Please try again</p>
    <?php
      endif;
    endif;
    ?>
  </form>
</footer>