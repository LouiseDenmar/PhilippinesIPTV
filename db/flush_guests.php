<?php
  header("Content-Type: application/json; charset=utf-8");
  include("connect.php");

  if (!auth($_GET["token"])) {
    header("HTTP/1.0 403 Forbidden");
    echo json_encode(["status" => 403, "message" => "Unauthorized."], JSON_PRETTY_PRINT);
    die();
  }

  $result = $conn->query("TRUNCATE TABLE visitors");
  $conn->close();

  $message = ($result === TRUE) ? "[Guests Manager] Guests have been successfully flushed from the database." : $conn->error;
  echo json_encode(["status" => 200, "message" => $message], JSON_PRETTY_PRINT);

  function auth($token) {
    if (is_null($token))
      return false;

    return (strcmp($token, $_ENV["APP_IV"]) !== 0) ? false : true;
  }
//end flush_guests.php