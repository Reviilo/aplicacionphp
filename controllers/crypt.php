<?php
  function encriptar ($dato) {

    $salt = '$2y$14$';
    for ($i = 0; $i < 22; $i++) {
    $salt .= substr('./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', mt_rand(0, 63), 1);
    }
    $salt .= '$';

    return crypt($dato, $salt);
  }
?>
