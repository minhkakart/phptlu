<?php
require_once 'connectdatabase.php';

$article_id = (int)$_GET['id'];

$sql_delete = 'delete from article where id = ?';
$stmt = $pdo->prepare($sql_delete);
$stmt->bindParam(1, $article_id, PDO::PARAM_INT);
$stmt->execute();
header('location: index.php');