<?php

/* @var $this yii\web\View */
/* @var $models[] \common\models\Gallery */
/* @var $model \common\models\Gallery */
/* @var $item \common\models\PhotoGallery */

?>

<?php foreach ($models as $model) : ?>

    <h1><?= $model->title ?></h1>

    <?php foreach ($model->gallery as $item) : ?>
        
        <?php if ($item->templateFile === 'image') : ?>

            <img src="<?= $item->getImage('small') ?>" alt="">

        <?php endif; ?>

        <?php if ($item->templateFile === 'video') : ?>

            <video controls="controls">
                <source src="<?= $item->absolutePath ?>" type="<?= $item->type ?>">
            </video>

        <?php endif; ?>
        
    <?php endforeach; ?>

<?php endforeach; ?>
