<?php

use common\widgets\UploadGalleryWidget;
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
            'showClose' => false
        ],
    ]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <div id="openModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-sm btn-kv btn-default btn-outline-secondary btn-close" data-dismiss="modal" aria-label="Закрыть">
                        <i class="glyphicon glyphicon-remove"></i>
                    </button>
                    <h4 class="modal-title" id="gridModalLabel">Заголовок модального окна</h4>
                </div>
                <div class="modal-body">
                    <!-- основное содержимое (тело) модального окна -->
                    <div class="container-fluid">
                        <!-- Контейнер, в котором можно создавать классы системы сеток -->
                        <div class="row">
                            <div class="col-md-6">...</div>
                            <div class="col-md-6">...</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Изменить</button>
                </div>
            </div>
        </div>
    </div>

</div>
