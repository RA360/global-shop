<?php
$msg = [
  'error' => true,
  'txt' => ''
];
$email = htmlspecialchars(stripslashes(trim($_POST['email'])));
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  $msg['txt'] = 'Invalid email format';
else if (mail(
  $email,
  'Thank you for your order',
  "For questions, please contact:\r\nglbalshop@mail.ru",
  'From: glbalshop@mail.ru'
)) {
  $msg['error'] = false;
  $msg['txt'] = 'Payment details sent to email';
}

echo json_encode($msg);
