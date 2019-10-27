<?php


namespace common\actions;


use common\models\PhotoGallery;
use Imagine\Image\ImageInterface;
use Yii;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;

class UploadGalleryAction extends BaseGalleryAction
{
    private $attributeName;

    private $formName;

    private $galleryId;

    private $dirPath;

    private $fileName;

    public $deleteRoute;

    public $versionImage;

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

        $this->dirPath = Yii::getAlias($this->fileStorageGallery->basePath) .'/' . mb_strtolower($this->formName) . '/' . $this->galleryId;
        $this->fileName = Yii::$app->security->generateRandomString();
    }

    public function run()
    {
        if (!is_dir($this->dirPath)) {
            FileHelper::createDirectory($this->dirPath);
        }

        $uploadFile = UploadedFile::getInstancesByName($this->formName . '[' . $this->attributeName . ']');
        foreach ($uploadFile as $file) {

            if ($this->saveFileAs($file)) {
                $file = $this->setGalleryObject($file);

                if (!empty($file)) {
                    return Yii::$app->controller->asJson([
                        'initialPreviewConfig' => [
                            [
                                'caption' => $file->file_name,
                                'size' => $file->file_size,
                                'url' => $this->deleteRoute,
                                'key' => $file->id,
                                'filetype' => $file->type,
                                'type' => $file->templateFile
                            ]
                        ],
                        'initialPreview' => [
                            $file->iPObject,
                        ],
                        'initialPreviewAsData' => true,
                        'extra' => [
                            'gallery_id' => $file->gallery_id,
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

    public function setGalleryObject(UploadedFile $file)
    {
        $model = new PhotoGallery();
        $model->path = '/' . mb_strtolower($this->formName) . '/' . $this->galleryId . '/';
        $model->file_name = $this->fileName;
        $model->extension = $file->extension;
        $model->file_size = $file->size;
        $model->base_path = Yii::getAlias($this->fileStorageGallery->baseUrl);
        $model->type = $file->type;
        $model->gallery_id = $this->galleryId;
        $model->save();

        return $model;
    }

    public function saveFileAs(UploadedFile $file)
    {
        $savePath = $this->dirPath . '/' . $this->fileName . '.' . $file->extension;

        if (stristr($file->type, 'image') && $file->saveAs($savePath) && !empty($this->versionImage)) {
            $originalImage = Image::getImagine()->open($savePath);

            foreach ($this->versionImage as $version => $fn) {
                /** @var ImageInterface $image */

                $image = call_user_func($fn, $originalImage);
                if (is_array($image)) {
                    list($image, $options) = $image;
                } else {
                    $options = [];
                }

                $image->save($this->dirPath . '/' . $this->fileName . '_' . $version . '.' . $file->extension, $options);
            }

            return true;
        }

        if (!stristr($file->type, 'image') && $file->saveAs($savePath)) {
            return true;
        }

        return false;
    }

}