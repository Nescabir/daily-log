<?php

require_once('db.php');

$id = $_GET['id'];

$sql = "DELETE FROM `activities` WHERE `activities`.`id` = $id";
$stmt = $conn->prepare($sql);
try {
    $conn->beginTransaction();
    $stmt->execute();
    $conn->commit();
    header('Location: index.php');
} catch (Exception $e) {
    $conn->rollback();
    throw e;
}