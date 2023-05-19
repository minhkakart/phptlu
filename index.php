<?php
require_once 'includes/header.php';
require_once 'connectdatabase.php';

$sql = 'select id, title, summary, content, created from article group by created desc';
$stmt = $pdo->prepare($sql);
$stmt->execute();

$articles = $stmt->fetchAll();

?>

<div class="main">
    <div class="row">
        <h2 class="text-center">Danh sách bài viết</h2>
    </div>
    <a href="addArticleView.php" class="btn btn-primary">Thêm bài viết</a>
    <div class="row" style="
        border: 2px solid;
        border-radius: 16px;
        background-color: yellowgreen;
        padding: 12px 0;
        margin: 12px 0;
        ">
        <div class="col-md-2">
            Title
        </div>
        <div class="col-md-3">
            Summary
        </div>
        <div class="col-md-4">
            Content
        </div>
        <div class="col-md-1">
            Created
        </div>
        <div class="col-md-1">
            Edit
        </div>
        <div class="col-md-1">
            Delete
        </div>
    </div>
    <?php
    foreach ($articles as $article) {
        ?>
        <div class="row" style="
        border: 2px solid;
        border-radius: 16px;
        background-color: cornsilk;
        padding: 12px 0;
        margin: 12px 0;
        ">
            <div class="col-md-2">
                <?= $article['title'] ?>
            </div>
            <div class="col-md-3">
                <?= $article['summary'] ?>
            </div>
            <div class="col-md-4">
                <?= $article['content'] ?>
            </div>
            <div class="col-md-1">
                <?= $article['created'] ?>
            </div>
            <div class="col-md-1">
                <a href="updateAnarticleView.php?id=<?= $article['id'] ?>"><i class="bi bi-pencil-square"></i></a>
            </div>
            <div class="col-md-1">
                <a href="deleteArticle.php?id=<?= $article['id'] ?>"><i class="bi bi-trash3"></i></a>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<?php
require_once 'includes/footer.php';
?>