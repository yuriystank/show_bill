<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Area */
/* @var $form yii\widgets\ActiveForm */
/* @var $sort_count array */
?>

<div class="area-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->hiddenInput(['value' => $model->image, 'id' => 'img_delete_input']); ?>
    <?php if (!empty($model->image)) : ?>
        <div class="row" id="img_can_be_deleted">
            <div class="col-md-3">
                <img src="/<?=Yii::$app->params['uploadPath'].$model->image?>" alt="" class="img-responsive">
                <?= Html::button(Yii::t('app', 'Удалить'), ['id' => 'img_delete'])?>
            </div>
        </div>
    <?php endif; ?>
    <?= $form->field($model, 'upload_image')->fileInput()->label('') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sort')->dropDownList($sort_count, ['value' => $model->sort?$model->sort:max($sort_count)]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
