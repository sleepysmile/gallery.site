<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Gallery */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Gallery',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Galleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
