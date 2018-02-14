<?php

namespace app\models;

use Imagine\Image\ManipulatorInterface;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $text
 * @property string $image
 * @property integer $position
 * @property integer $is_deleted
 * @property integer $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @method string getThumbUploadPath($attribute, $profile = 'thumb', $old = false) 
 * @method string|null getThumbUploadUrl($attribute, $profile = 'thumb') 
 * @method string|null getUploadPath($attribute, $old = false) Returns file path for the attribute.
 * @method string|null getUploadUrl($attribute) Returns file url for the attribute.
 * @method bool sanitize($filename) Replaces characters in strings that are illegal/unsafe for filename.
 * @method bool movePrev() Moves owner record by one position towards the start of the list.
 * @method bool moveNext() Moves owner record by one position towards the end of the list.
 * @method bool moveFirst() Moves owner record to the start of the list.
 * @method bool moveLast() Moves owner record to the end of the list.
 * @method bool moveToPosition($position) Moves owner record to the specific position.
 * @method bool getIsFirst() Checks whether this record is the first in the list.
 * @method bool getIsLast() Checks whether this record is the the last in the list.
 * @method \BaseActiveRecord|static|null findPrev() Finds record previous to this one.
 * @method \BaseActiveRecord|static|null findNext() Finds record next to this one.
 * @method \BaseActiveRecord|static|null findFirst() Finds the first record in the list.
 * @method \BaseActiveRecord|static|null findLast() Finds the last record in the list.
 * @method mixed beforeInsert($event) Handles owner 'beforeInsert' owner event, preparing its positioning.
 * @method mixed beforeUpdate($event) Handles owner 'beforeInsert' owner event, preparing its possible re-positioning.
 * @method bool getReplaceRegularDelete() 
 * @method mixed setReplaceRegularDelete($replaceRegularDelete) 
 * @method int|bool softDelete() Marks the owner as deleted.
 * @method bool beforeSoftDelete() This method is invoked before soft deleting a record.
 * @method mixed afterSoftDelete() This method is invoked after soft deleting a record.
 * @method int|bool restore() Restores record from "deleted" state, after it has been "soft" deleted.
 * @method bool beforeRestore() This method is invoked before record is restored from "deleted" state.
 * @method mixed afterRestore() This method is invoked after record is restored from "deleted" state.
 * @method bool|int safeDelete() Attempts to perform regular [[BaseActiveRecord::delete()]], if it fails with exception, falls back to [[softDelete()]].
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'slug'], 'string'],
            [['position', 'is_deleted', 'is_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'file', 'on' => ['create', 'update'], 'extensions' => ['gif', 'jpg', 'png', 'jpeg']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'image' => Yii::t('app', 'Image'),
            'position' => Yii::t('app', 'Position'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'is_active' => Yii::t('app', 'Is Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    
    /**
     * @inheritdoc
     * @return \app\models\queries\PostsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\PostsQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'imageUpload' => [
                'class' => 'mongosoft\file\UploadImageBehavior',
                'attribute' => 'image',
                'path' => '@webroot/media/posts/{id}',
                'url' => '@web/media/posts/{id}',
                'scenarios' => ['create', 'update'],
                'thumbs' => ['thumb' => ['width' => 200, 'height' => 200, 'quality' => 90, 'mode' => ManipulatorInterface::THUMBNAIL_OUTBOUND], 'preview' => ['width' => 50, 'height' => 50, 'quality' => 90]],
            ],
            'positionSort' => [
                'class' => 'yii2tech\ar\position\PositionBehavior',
                'positionAttribute' => 'position',
            ],
            'softDeleteBehavior' => [
                'class' => 'yii2tech\ar\softdelete\SoftDeleteBehavior',
                'softDeleteAttributeValues' => ['is_deleted' => 1],
                'invokeDeleteEvents' => false,
            ],
            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => ['id', 'title']
            ],
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'value' => date('Y-m-d H:i:s')
            ]
        ];
    }
}
