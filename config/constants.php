<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
define('ROOT_URL','http://localhost/blog/');
define('DB_HOST','localhost');
define('DB_USER','cold');
define('DB_PASSWORD','admin666');
define('DB_NAME','golden-blog');
