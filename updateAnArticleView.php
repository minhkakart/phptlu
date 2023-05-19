<?php
require_once 'includes/header.php';
require_once 'connectdatabase.php';

$article_id = (int) $_GET['id'];

$sql_article = 'select * from article where id = ?';
$sql_category = 'select id, name from category';
$sql_members = 'select id,forename, surname from member';

$stmt = $pdo->prepare($sql_article);
$stmt->bindValue(1, $article_id, PDO::PARAM_INT);
$stmt->execute();
$article = $stmt->fetch();

$stmt = $pdo->prepare($sql_category);
$stmt->execute();
$categories = $stmt->fetchAll();

$stmt = $pdo->prepare($sql_members);
$stmt->execute();
$members = $stmt->fetchAll();

function isChecked($id, $article)
{
    return $id == $article ? true : false;
}

?>

<div class="main">

    <h2>Sửa bài viết</h2>
    <form action="updateAnarticle.php?id=<?= $article_id ?>" method="POST">
        <div class="row mb-3">
            <label for="article-id" class="col-sm-2 col-form-label">Id</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="article-id" readonly value="<?= $article_id ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="title" value="<?= $article['title'] ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="summery" class="col-sm-2 col-form-label">Summery</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="summery" value="<?= $article['summary'] ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="content" class="col-sm-2 col-form-label">Content</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="content" rows="7"><?= $article['content'] ?></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="category" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
                <select name="category" id="category">
                    <?php
                    foreach ($categories as $category) {
                        ?>
                        <option value="<?= $category['id'] ?>" 
                        <?php 
                        if(isChecked($category['id'], $article['category_id'])){
                        ?>
                        selected
                        <?php
                        }
                        ?>><?= $category['name'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="member" class="col-sm-2 col-form-label">Member</label>
            <div class="col-sm-10">
                <select name="member" id="member">
                    <?php
                    foreach ($members as $member) {
                        ?>
                        <option value="<?= $member['id'] ?>"
                        <?php 
                        if(isChecked($member['id'], $article['member_id'])){
                        ?>
                        selected
                        <?php
                        }
                        ?>
                        ><?= $member['forename'] . ' ' . $member['surname'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>


        <!-- <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1"
                        checked>
                    <label class="form-check-label" for="gridRadios1">
                        First radio
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                    <label class="form-check-label" for="gridRadios2">
                        Second radio
                    </label>
                </div>
                <div class="form-check disabled">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3"
                        disabled>
                    <label class="form-check-label" for="gridRadios3">
                        Third disabled radio
                    </label>
                </div>
            </div>
        </fieldset> -->
        <!-- <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                        Example checkbox
                    </label>
                </div>
            </div>
        </div> -->
        <button type="submit" class="btn btn-primary">Xác nhận</button>
    </form>
</div>

<?php
require_once 'includes/footer.php';
?>