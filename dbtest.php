<?php
  require 'lib/DB.php';
  $db = new DB();

  $query = $db->getConn()->prepare("SELECT 1");
  $query->execute();
  
  echo $query->fetchColumn();