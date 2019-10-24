<?php


namespace common\actions;


use common\models\PhotoGallery;
use trntv\filekit\actions\BaseAction;
use yii\helpers\FileHelper;

class DeleteGalleryAction extends BaseGalleryAction
{
    public function run()
    {
        $id = \Yii::$app->request->post('key');

        if (!empty($id)) {
            $photo = PhotoGallery::find()->andWhere(['id' => $id])->one();
        }

        if (!empty($photo) && $this->fileStorageGallery->fileDelete($photo->filePath) && $photo->delete()) {
            $this->fileStorageGallery->dirDelete($photo->dirPath);
            return \Yii::$app->controller->asJson([
                'success' => true
            ]);
        }

        return \Yii::$app->controller->asJson([
            'success' => false,
            'error' => \Yii::t('common', 'file not delete')
        ]);
    }
}