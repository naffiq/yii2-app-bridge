<?php
/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Posts'
?>

<h1>Posts</h1>

<div class="row">
    <div class="col-md-8">
<?= \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_list-item'
]) ?>
    </div>
</div>
