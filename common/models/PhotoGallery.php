<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "photo_gallery".
 *
 * @property int $id
 * @property string $base_path
 * @property string $path
 * @property string $type
 * @property int $gallery_id
 * @property string $absolutePath
 * @property string $filePath
 * @property string $file_name
 * @property string $file_size
 * @property string $dirPath
 * @property string $iPObject
 * @property string $templateFile
 */
class PhotoGallery extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%photo_gallery}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gallery_id', 'file_size'], 'integer'],
            [['base_path', 'path', 'type', 'file_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'base_path' => Yii::t('app', 'Base Path'),
            'path' => Yii::t('app', 'Path'),
            'type' => Yii::t('app', 'Type'),
            'gallery_id' => Yii::t('app', 'Gallery ID'),
        ];
    }

    public function getAbsolutePath()
    {
        return $this->base_path . $this->path . $this->file_name;
    }

    public function getFilePath()
    {
        return $this->path . $this->file_name;
    }

    public function getDirPath()
    {
        return $this->path;
    }

    /**
     * Возвращает тип шаблона для krajee file input
     *
     * @return string
     */
    public function getTemplateFile()
    {
        switch ($this->type) {
            case (stristr($this->type, 'image')) :
                return 'image';
            case (stristr($this->type, 'audio')) :
                return 'audio';
            case (stristr($this->type, 'video')) :
                return 'video';
            case (stristr($this->type, 'pdf')) :
                return 'pdf';
            case (stristr($this->type, 'text')) :
                return 'text';
            case (stristr($this->type, 'application')) :
                return 'object';
            default :
                return 'object';
        }

    }

    public function getIPObject()
    {
        return $this->absolutePath;
    }

    /**
     * Возвращает последний gallery_id из таблицы gallery_photo
     *
     * @param int $gallery_id
     * @return int
     */
    public static function lastGalleryId(?int $gallery_id = 0)
    {
        if (empty($gallery_id)) {
            return (int)static::find()->max('gallery_id') + 1;
        }

        return $gallery_id;
    }

    public static function galleryImages(?int $galleryId = 0)
    {
        if (!empty($galleryId)) {
            return static::find()->andWhere(['gallery_id' => $galleryId])->all();
        }

        return $galleryId;
    }
}
