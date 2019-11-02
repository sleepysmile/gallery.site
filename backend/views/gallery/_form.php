<?php

use common\widgets\UploadGalleryWidget;
use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */
/* @var $form yii\bootstrap\ActiveForm */

?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'announcement')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'text')->widget(TinyMce::class, [
        'options' => ['rows' => 6],
        'language' => 'ru',
        'clientOptions' => [
            'plugins' => [
                "image imagetools"
            ],
            'toolbar' => "image",
            'height' => 400,
            'images_upload_url' => '/file/storage/upload'
        ]
    ]) ?>

    <?php echo $form->field($model, 'gallery')->widget(UploadGalleryWidget::class, [
        'options' => [
            'multiple' => true,
            'class' => 'fileInput',
        ],
        'sortUrl' => Url::to(['gallery/sort-gallery']),
        'pluginOptions' => [
            'uploadUrl' => Url::to(['/gallery/upload-gallery']),
            'showRemove' => false,
            'showUpload' => false,
            'showClose' => false,
        ],
    ]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
