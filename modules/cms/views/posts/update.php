<?php

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = Yii::t('admin', 'Update Posts: ') . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Update');
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>


