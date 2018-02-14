<?php

namespace app\models\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Posts]].
 *
 * @see \app\models\Posts
 */
class PostsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Posts[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    public function active()
    {
        return $this->andWhere(['is_active' => true])->andWhere(['is_deleted' => false]);
    }

    public function positioned()
    {
        return $this->addOrderBy(['position' => SORT_ASC]);
    }

    /**
     * @inheritdoc
     * @return \app\models\Posts|array|null
     */
    public function one($db = null)
    {
    return parent::one($db);
    }
}
