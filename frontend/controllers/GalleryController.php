<?php


namespace frontend\controllers;


use common\models\Gallery;
use yii\web\Controller;

class GalleryController extends Controller
{
    public function actionIndex()
    {
        $models = Gallery::find()->all();

        return $this->render('index', ['models' => $models]);
    }
}