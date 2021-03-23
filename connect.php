<?php
/**
 * Include this to connect. Change the dbname to match your database,
 * and make sure your login information is correct after you upload
 * to csunix or your app will stop working.
 *
 *
 */
try {
    $dbh = new PDO(
        "mysql:host=127.0.0.1;dbname=000798153",
        "root",
        ""
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}

