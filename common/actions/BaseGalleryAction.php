<?php


namespace common\actions;


use common\components\galleryStorage\Storage;
use Yii;
use yii\base\Action;

/** @property Storage $fileStorageGallery */
class BaseGalleryAction extends Action
{
    public $fileStorageComponentName = 'galleryStorage';

    /**
     * @return Storage
     */
    public function getFileStorageGallery()
    {
        return Yii::$app->{$this->fileStorageComponentName};
    }
}