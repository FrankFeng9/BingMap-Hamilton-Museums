<?php
/**
 * Created by PhpStorm.
 * User: ole21
 * Date: 2021/3/1
 * Time: 8:45
 */

include "connect.php";

$data = $_POST;
$total = $data["total"] ?? "";
$cardnum = $data["cardnum"] ?? "";
$card = $data["card"] ?? "";
$id = $data['id'] ?? "";
if (!empty($id)) {
    $sql = "insert into `order`  set map_id='$id',card='$card',cardnum='$cardnum',total='$total'";
    $st = $dbh->query($sql);
    $success = $st->execute();
    echo $success;
}