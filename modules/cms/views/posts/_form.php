<?php

use yii\bootstrap\Html;
use naffiq\bridge\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form naffiq\bridge\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-8">

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'text')->richTextArea(['options' => ['rows' => 6]]) ?>

    </div>

    <div class="col-md-4">


        <?= $form->field($model, 'image')->imageUpload() ?>

        <?= $form->field($model, 'is_deleted')->switchInput() ?>

        <?= $form->field($model, 'is_active')->switchInput() ?>

        <?= $form->field($model, 'created_at')->dateTimePicker() ?>

        <?= $form->field($model, 'updated_at')->dateTimePicker() ?>

    </div>
</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
