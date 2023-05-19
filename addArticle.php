<?php
if ($_POST['category'] == '<-- Select Category -->' && $_POST['member'] == '<-- Select Member -->') {
    $err_message = 'Bạn chưa chọn Category và Member';
    header("location: addArticleView.php?err=$err_message");
} else if ($_POST['category'] == '<-- Select Category -->') {
    $err_message = 'Bạn chưa chọn Category';
    header("location: addArticleView.php?err=$err_message");
} else if ($_POST['member'] == '<-- Select Member -->') {
    $err_message = 'Bạn chưa chọn Member';
    header("location: addArticleView.php?err=$err_message");
} else {
    require_once 'connectdatabase.php';

    $title = $_POST['title'];
    $summery = $_POST['summery'];
    $content = $_POST['content'];
    $category_id = (int)$_POST['category'];
    $member_id = (int)$_POST['member'];

    $sql_insert = 'insert into article (title, summary, content, created, category_id, member_id, image_id, published) values (?,?,?, NOW(),?,?, 1, 1)';
    $stmt = $pdo->prepare($sql_insert);
    $stmt->bindParam(1, $title, PDO::PARAM_STR);
    $stmt->bindParam(2, $summery, PDO::PARAM_STR);
    $stmt->bindParam(3, $content, PDO::PARAM_STR);
    $stmt->bindParam(4, $category_id, PDO::PARAM_INT);
    $stmt->bindParam(5, $member_id, PDO::PARAM_INT);
    $stmt->execute();
    header('location: index.php');
}