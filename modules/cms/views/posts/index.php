<?php

use dosamigos\grid\GridView;
use yii2tech\admin\grid\ActionColumn;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin', 'Posts') . ($searchModel->is_deleted ? ' — ' . \Yii::t('bridge', 'Trash') : '');
$this->params['breadcrumbs'][] = $this->title;
$this->params['contextMenuItems'] = [
    [
    'url' => ['index', Html::getInputName($searchModel, 'is_deleted') => !$searchModel->is_deleted],
    'label' => $searchModel->is_deleted ? \Yii::t('bridge', 'All records') : \Yii::t('bridge', 'Trash'),
    'icon' => $searchModel->is_deleted ? 'share-alt' : 'trash',
    'class' => 'btn btn-' . ($searchModel->is_deleted ? 'soft-info' : 'trash'),
    ],
    ['create'],
];
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'options' => ['class' => 'grid-view table-responsive'],
    'behaviors' => [
        \dosamigos\grid\behaviors\ResizableColumnsBehavior::className()
    ],
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        [
            'class' => 'naffiq\bridge\widgets\columns\TitledImageColumn',
            'attribute' => 'title',
            'imageAttribute' => 'image',
        ],
        [
            'class' => 'naffiq\bridge\widgets\columns\TruncatedTextColumn',
            'attribute' => 'text',
        ],
        [
            'class' => 'yii2tech\admin\grid\PositionColumn',
            'value' => 'position',
            'template' => '<div class="btn-group">{first}&nbsp;{prev}&nbsp;{next}&nbsp;{last}</div>',
            'buttonOptions' => ['class' => 'btn btn-info btn-xs'],
        ],
        [
            'class' => 'dosamigos\grid\columns\ToggleColumn',
            'attribute' => 'is_active',
            'onValue' => 1,
            'onLabel' => 'Active',
            'offLabel' => 'Not active',
            'contentOptions' => ['class' => 'text-center'],
            'afterToggle' => 'function(r, data){if(r){console.log("done", data)};}',
            'filter' => ['1' => 'Active', '0' => 'Not active'],
        ],
        // 'created_at',
        // 'updated_at',

        [
            'class' => ActionColumn::className(),
            'buttons' => [
                'delete' => [
                    'visible' => function ($model) {
                        /* @var $model \yii\db\BaseActiveRecord */
                        if (is_object($model) && $model->canGetProperty('is_deleted')) {
                            return !$model->is_deleted;
                        }
                        return true;
                    },
                ],
                'restore' => [
                    'visible' => function ($model) {
                        /* @var $model \yii\db\BaseActiveRecord */
                        if (is_object($model) && $model->canGetProperty('is_deleted')) {
                            return $model->is_deleted;
                        }
                        return false;
                    },
                ],
            ]
        ],
    ],
]); ?>
