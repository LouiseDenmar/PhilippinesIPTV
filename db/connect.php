<?php
  $url = getenv("JAWSDB_MARIA_URL");
  $dbparts = parse_url($url);

  $hostname = $dbparts["host"];
  $username = $dbparts["user"];
  $password = $dbparts["pass"];
  $database = ltrim($dbparts["path"], "/");

  $conn = new mysqli($hostname, $username, $password, $database);

  if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);
//end connect.php