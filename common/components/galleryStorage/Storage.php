<?php

namespace common\components\galleryStorage;

use Yii;
use yii\base\Component;
use yii\helpers\FileHelper;

class Storage extends Component
{
    public $baseUrl;

    public $basePath;

    public function fileDelete(string $filePath)
    {
        if (@file_exists(Yii::getAlias($this->basePath) . $filePath) && FileHelper::unlink(Yii::getAlias($this->basePath) . $filePath)) {
            return true;
        }

        return false;
    }

    public function dirDelete(string $dirPath)
    {
        $fileInDir = FileHelper::findFiles(Yii::getAlias($this->basePath) . $dirPath);
        if (empty($fileInDir)) {
            FileHelper::removeDirectory(Yii::getAlias($this->basePath) . $dirPath);
        }
    }
}