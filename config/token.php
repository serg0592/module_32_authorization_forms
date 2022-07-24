<?php
    $token = hash('murmur3a', random_int(0,999999));
    $_SESSION["CSRF"] = $token;
?>