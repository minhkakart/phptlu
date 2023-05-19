<?php
require_once 'includes/header.php';
require_once 'connectdatabase.php';

$id = $_POST['article-id'];
$new_title = $_POST['title'];
$new_summery = $_POST['summery'];
$new_content = $_POST['content'];
$new_category_id = (int) $_POST['category'];
$new_member_id = (int) $_POST['member'];

$sql_update = 'update article set title = ?, summary = ?, content = ?, category_id = ?, member_id = ? where id = ?';
$stmt = $pdo->prepare($sql_update);
$stmt->bindParam(1, $new_title, PDO::PARAM_STR);
$stmt->bindParam(2, $new_summery, PDO::PARAM_STR);
$stmt->bindParam(3, $new_content, PDO::PARAM_STR);
$stmt->bindParam(4, $new_category_id, PDO::PARAM_INT);
$stmt->bindParam(5, $new_member_id, PDO::PARAM_INT);
$stmt->bindParam(6, $id, PDO::PARAM_INT);
$stmt->execute();
header('location: index.php');