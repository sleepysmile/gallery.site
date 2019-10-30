<?php

namespace common\models;

use common\behaviors\UploadGalleryBehaviour;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property string $title Заголовок
 * @property string $announcement Анонс
 * @property int $created_by
 * @property int $created_at
 * @property int $gallery_id [bigint(20)]
 * @property PhotoGallery $gallery
 */
class Gallery extends ActiveRecord
{
    public $gallery;

    public function behaviors()
    {
        return [
            [
                'class' => UploadGalleryBehaviour::class,
                'attribute' => 'gallery',
                'galleryIdAttribute' => 'gallery_id',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%gallery}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['announcement'], 'string'],
            [['created_by', 'created_at', 'gallery_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['gallery'], 'file', 'skipOnEmpty' => true]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Заголовок'),
            'announcement' => Yii::t('app', 'Анонс'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'gallery' => Yii::t('app', 'Gallery'),
        ];
    }
}
