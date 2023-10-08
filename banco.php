<?php

require "config.php";

try {
    $pdo = new PDO(BD_DSN, BD_USERNAME, BD_PASSWORD);
} catch (\PDOException $e) {
    echo 'There\'s a problem here' . $e->getMessage();
}