<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 2/15/18
 * Time: 00:41
 */

namespace app\controllers;


use app\models\Posts;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class PostController
 *
 * List and view posts
 *
 * @package app\controllers
 */
class PostController extends Controller
{
    /**
     * Renders list of posts.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Posts::find()->active();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['position' => SORT_ASC]
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($slug)
    {
        $post = Posts::find()->andWhere(['slug' => $slug])->active()->one();

        if (!$post) {
            throw new NotFoundHttpException();
        }

        return $this->render('view', [
            'post' => $post
        ]);
    }
}