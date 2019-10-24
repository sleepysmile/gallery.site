<?php

namespace common\widgets\assets\gallery;

use backend\assets\BackendAsset;
use common\assets\Html5shiv;
use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

class GalleryAssets extends AssetBundle
{
    public $sourcePath = '@common/widgets/assets/gallery';

    public $js = [
        'js/galleryJs.js'
    ];

    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        Html5shiv::class,
    ];
}