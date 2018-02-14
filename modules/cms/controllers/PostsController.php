<?php

namespace app\modules\cms\controllers;

use naffiq\bridge\controllers\BaseAdminController;
use yii\helpers\ArrayHelper;
use yii2tech\admin\actions\Position;
use yii2tech\admin\actions\SoftDelete;
use yii2tech\admin\actions\Restore;
use dosamigos\grid\actions\ToggleAction;

/**
 * PostsController implements the CRUD actions for [[app\models\Posts]] model.
 * @see app\models\Posts
 */
class PostsController extends BaseAdminController
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'app\models\Posts';
    /**
     * @inheritdoc
     */
    public $searchModelClass = 'app\modules\cms\models\PostsSearch';

    /**
    * @inheritdoc
    */
    public $createScenario = 'create';

    /**
    * @inheritdoc
    */
    public $updateScenario = 'update';


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return ArrayHelper::merge(
            parent::actions(),
            [
                'toggle' => [
                    'class' => ToggleAction::className(),
                    'modelClass' => 'app\models\Posts',
                    'onValue' => 1,
                    'offValue' => 0
                ],
                'position' => [
                    'class' => Position::className(),
                ],
                'delete' => [
                    'class' => SoftDelete::className(),
                ],
                'restore' => [
                    'class' => Restore::className(),
                ],
            ]
        );
    }
}
