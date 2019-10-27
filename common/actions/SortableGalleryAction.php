<?php


namespace common\actions;


use common\models\PhotoGallery;

class SortableGalleryAction extends BaseGalleryAction
{
    /** @var PhotoGallery */
    private $object;

    private $newIndex;

    public function init()
    {
        if (!empty(\Yii::$app->request->post('objectId'))) {
            $this->object = PhotoGallery::findOne(['id' => \Yii::$app->request->post('objectId')]);
        }

        if (\Yii::$app->request->post('newIndex') !== null) {
            $this->newIndex = (int)\Yii::$app->request->post('newIndex') + 1;
        }

        parent::init();
    }

    public function run()
    {
        if (null !== $this->object) {
            $this->object->moveToPosition($this->newIndex);
            return \Yii::$app->controller->asJson([
                'success' => true,
                'error' => [],
            ]);
        }

        return \Yii::$app->controller->asJson([
            'success' => false,
            'error' => 'not element by sortable',
        ]);
    }
}