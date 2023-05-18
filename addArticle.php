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
    $category = $_POST['category'];
    $member = $_POST['member'];

    $sql_category_id = "select c.id as cId from category c where c.name = '$category'";
    $stmt = $pdo->prepare($sql_category_id);
    $stmt->execute();
    $category_id = $stmt->fetch()['cId'];

    $sql_member_id = "select m.id as mId from member m where m.forename like '$member'";
    $stmt = $pdo->prepare($sql_member_id);
    $stmt->execute();
    $member_id = $stmt->fetch()['mId'];

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