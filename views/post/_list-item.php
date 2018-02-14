<?php

use yii\helpers\Url;

/**
 * @var \yii\web\View $this ;
 * @var \app\models\Posts $model the data model
 * @var mixed $key the key value associated with the data item
 * @var integer $index the zero-based index of the data item in the items array returned by [[dataProvider]].
 * @var \yii\widgets\ListView $widget this widget instance
 */
?>

<article>
    <h3><?= $model->title ?></h3>
    <div class="row">
        <div class="col-md-4">
            <a href="<?= Url::to(['/post/view', 'slug' => $model->slug]) ?>">
                <img src="<?= $model->getThumbUploadUrl('image', 'thumb') ?>" class="img-responsive" alt="">
            </a>
        </div>
        <div class="col-md-8">
            <?= $model->text ?>
        </div>

    </div>

    <hr>
    <a href="<?= Url::to(['/post/view', 'slug' => $model->slug]) ?>">Learn more</a>
    <span style="color: #727272">
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <?= \Yii::$app->formatter->asDate($model->created_at, 'php: d M Y') ?>
    </span>
    <hr>
</article>
