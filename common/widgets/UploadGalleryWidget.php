<?php


namespace common\widgets;


use common\models\PhotoGallery;
use common\widgets\assets\gallery\GalleryAssets;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;

class UploadGalleryWidget extends FileInput
{
    public $deleteUrl;

    public function init()
    {
        parent::init();

        if (empty($this->pluginOptions['uploadExtraData'])) {
            $this->pluginOptions['uploadExtraData'] = [
                'attributeName' => $this->attribute,
                'formName' => $this->model->formName(),
                'galleryId' => PhotoGallery::lastGalleryId($this->model->gallery_id)
            ];
        } else {
            $this->pluginOptions['uploadExtraData'] = ArrayHelper::merge($this->pluginOptions['uploadExtraData'], [
                'attributeName' => $this->attribute,
                'formName' => $this->model->formName(),
                'galleryId' => PhotoGallery::lastGalleryId($this->model->gallery_id)
            ]);
        }

        if (empty($this->pluginOptions['initialPreview']) && empty($this->pluginOptions['initialPreviewConfig'])) {
            $this->pluginOptions['initialPreview'] = $this->model->iPObject;
            $this->pluginOptions['initialPreviewConfig'] = $this->model->getIPCaption($this->deleteUrl);
            $this->pluginOptions['initialPreviewAsData'] = true;
            $this->pluginOptions['overwriteInitial'] = false;
        }
    }

    public function run()
    {
        GalleryAssets::register($this->view);
        return parent::run();
    }

}