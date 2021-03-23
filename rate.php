<?php
/**
 * Created by PhpStorm.
 * User: ole21
 * Date: 2021/2/22
 * Time: 16:54
 */
include "connect.php";

$data = $_POST;
$id = isset($data['id'])?$data['id']:null;
$rate = isset($data['rate'])?$data['rate']:"";

if (!empty($id)) {
    $sql = "select * from map where OBJECTID = {$id}";
    $stmt = $dbh->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $Rating = $row['Rating'];
    $reviews = $row['review_numbers'];
    $newreviews = $reviews+1;
    $newrate = ($Rating*$reviews+$rate)/$newreviews;
    $newrate = number_format($newrate,2);
    $insertSql = "update map set Rating={$newrate} , review_numbers={$newreviews} where OBJECTID = {$id}";
    $st = $dbh->query($insertSql);
    $success = $st->execute();
    echo $success;
}