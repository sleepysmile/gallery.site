<?php


namespace common\actions;


use common\models\PhotoGallery;
use trntv\filekit\actions\BaseAction;
use Yii;
use yii\base\Action;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;

class UploadGalleryAction extends BaseGalleryAction
{
    private $attributeName;

    private $formName;

    private $galleryId;

    public $deleteRoute;

    public function init()
    {
        if (!empty(\Yii::$app->request->post('attributeName'))) {
            $this->attributeName = \Yii::$app->request->post('attributeName');
        }

        if (!empty(\Yii::$app->request->post('formName'))) {
            $this->formName = \Yii::$app->request->post('formName');
        }

        if (!empty(\Yii::$app->request->post('galleryId'))) {
            $this->galleryId = \Yii::$app->request->post('galleryId');
        }
    }

    public function run()
    {
        $dirPath = Yii::getAlias($this->fileStorageGallery->basePath) .'/' . mb_strtolower($this->formName) . '/' . $this->galleryId;

        if (!is_dir($dirPath)) {
            FileHelper::createDirectory($dirPath);
        }

        $uploadFile = UploadedFile::getInstancesByName($this->formName . '[' . $this->attributeName . ']');
        foreach ($uploadFile as $file) {
            $fileName = Yii::$app->security->generateRandomString();

            if ($file->saveAs($dirPath . '/' . $fileName . '.' . $file->extension)) {
                $image = $this->setGalleryObject($file, $fileName);

                if (!empty($image)) {
                    return Yii::$app->controller->asJson([
                        'initialPreviewConfig' => [
                            [
                                'caption' => $image->file_name,
                                'size' => $image->file_size,
                                'url' => $this->deleteRoute,
                                'key' => $image->id,
                                'filetype' => $image->type,
                                'type' => $image->templateFile
                            ]
                        ],
                        'initialPreview' => [
                            $image->iPObject,
                        ],
                        'initialPreviewAsData' => true,
                        'extra' => [
                            'gallery_id' => $image->gallery_id,
                        ],
                        'error' => [],
                        'append' => true
                    ]);
                }
            }

            return Yii::$app->controller->asJson([
                'initialPreview' => [],
                'error' => $file->error,
            ]);
        }

        return Yii::$app->controller->asJson([
            'initialPreview' => [],
            'error' => []
        ]);
    }

    public function setGalleryObject(UploadedFile $file, string $filename)
    {
        $model = new PhotoGallery();
        $model->path = '/' . mb_strtolower($this->formName) . '/' . $this->galleryId . '/';
        $model->file_name = $filename . '.' . $file->extension;
        $model->file_size = $file->size;
        $model->base_path = Yii::getAlias($this->fileStorageGallery->baseUrl);
        $model->type = $file->type;
        $model->gallery_id = $this->galleryId;
        $model->save();

        return $model;
    }

}