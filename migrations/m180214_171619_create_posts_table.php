<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts`.
 */
class m180214_171619_create_posts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'slug' => $this->string(),
            'text' => $this->text(),
            'image' => $this->string(),
            'position' => $this->integer(),
            'is_deleted' => $this->boolean(),
            'is_active' => $this->boolean(),
            'created_at' => $this->datetime()->defaultExpression('NOW()'),
            'updated_at' => $this->datetime()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('posts');
    }
}
