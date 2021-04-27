<?php

session_start();

function connect(){
  try {
    return new PDO('mysql:host=localhost;dbname=portforio;charset=utf8','root','',
    array(PDO::ATTR_EMULATE_PREPARES => false));
  }
  catch (PDOException $e) {
    die('データベース接続失敗。'.$e->getMessage());
  }
}


?>