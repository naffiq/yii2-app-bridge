<?php

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = Yii::t('admin', 'Create Posts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

