<?php


namespace common\widgets;


use common\models\PhotoGallery;
use common\widgets\assets\gallery\GalleryAssets;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
// todo попробовать сделать кнопку для alt картинки
class UploadGalleryWidget extends FileInput
{
    public $sortUrl;

    public function init()
    {
        parent::init();

        if (empty($this->pluginOptions['uploadExtraData'])) {
            $this->pluginOptions['uploadExtraData'] = [
                'attributeName' => $this->attribute,
                'formName' => $this->model->formName(),
                'galleryId' => PhotoGallery::lastGalleryId($this->model->gallery_id),
                'deleteRoute' => $this->pluginOptions['uploadUrl']
            ];
        } else {
            $this->pluginOptions['uploadExtraData'] = ArrayHelper::merge($this->pluginOptions['uploadExtraData'], [
                'attributeName' => $this->attribute,
                'formName' => $this->model->formName(),
                'galleryId' => PhotoGallery::lastGalleryId($this->model->gallery_id),
                'deleteRoute' => $this->pluginOptions['uploadUrl']
            ]);
        }

        if (empty($this->pluginOptions['initialPreview']) && empty($this->pluginOptions['initialPreviewConfig'])) {
            $this->pluginOptions['initialPreview'] = $this->model->iPObject;
            $this->pluginOptions['initialPreviewConfig'] = $this->model->getIPCaption($this->pluginOptions['uploadUrl']);
            $this->pluginOptions['initialPreviewAsData'] = true;
            $this->pluginOptions['overwriteInitial'] = false;
//            $this->pluginOptions['otherActionButtons'] = '<button type="button" data-toggle="modal" data-target="#openModal" class="kv-file-pencil btn btn-sm btn-kv btn-default btn-outline-secondary" {dataKey} ><i class="glyphicon glyphicon-pencil"></i></button>';//todo Добавить альт и дискрипшн картинки и МОДАЛ ОЧКА
        }

        if (!empty($this->sortUrl)) {
            $this->pluginEvents['filesorted'] = new JsExpression('function(event, params) {
                $.ajax({
                    url: "' . $this->sortUrl . '",
                    type: "post",
                    data: {
                        objectId: params.stack[params.newIndex].key,
                        newIndex: params.newIndex,
                    },
                })
            }');
        }


    }

    public function run()
    {
        GalleryAssets::register($this->view);
        return parent::run();
    }

}