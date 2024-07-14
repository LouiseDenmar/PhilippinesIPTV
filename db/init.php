<?php
  include("connect.php");

  $setup = array(
    "File Storage" => "CREATE TABLE files (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, filename VARCHAR(30) NOT NULL, file MEDIUMBLOB NOT NULL)",
    "Token Manager" => "CREATE TABLE token (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, token VARCHAR(40) NOT NULL)",
    "Visitor Manager" => "CREATE TABLE visitors (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ip_address VARCHAR(16) NOT NULL, expiry VARCHAR(3) NOT NULL)"
  );

  foreach ($setup as $key => $sql) {
    $result = $conn->query($sql);
    echo ($result === TRUE) ? "Success setting up: $key...<br>" : $conn->error;
  }

  $conn->close();
//end db_init.php