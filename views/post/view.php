<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\Posts $post
 */

$this->title = $post->title;
?>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h1><?= $this->title ?></h1>

        <hr>

        <img src="<?= $post->getUploadUrl('image') ?>" alt="" class="img-responsive">

        <br>

        <?= $post->text ?>
    </div>
</div>
