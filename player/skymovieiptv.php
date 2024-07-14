<?php
  require __DIR__ . "/../util/base64_crypt.php";
  require __DIR__ . "/../util/get_channel_token.php";
  require __DIR__ . "/../util/check_server_status.php";

  if (!auth(base64url_encode("skymovieiptv@d0Bo+V" . date("FjY")))) {
    header("HTTP/1.0 403 Forbidden");
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode(["status" => 403, "message" => "Unauthorized."], JSON_PRETTY_PRINT);
    die();
  }

  if (check_server_status(getenv("SM_STATUS_URL")) == "down") {
    header("Location: " . getenv("CHANNEL_NA_URL"));
    die();
  }

  $token = get_token(getenv("SM_AUTH_URL"), getenv("SM_ACCOUNTS_TOTAL"));
  header("Location: http://iptv.skymovieph.com:8443$token" . $_GET["channel"] . ".m3u8");

  function auth($token) {
    if (!isset($_GET["key"]))
      return false;

    return (strcmp($token, $_GET["key"]) !== 0) ? false : true;
  }
//end skymovieiptv.php