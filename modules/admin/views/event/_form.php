<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $shows array */
/* @var $areas array */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'date')->widget(\kartik\datetime\DateTimePicker::classname(), [
        'name' => 'dp_2',
        'type' => \kartik\datetime\DateTimePicker::TYPE_COMPONENT_PREPEND,
        'value' => date('yyyy-mm-dd hh:ii:ss',time()),
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd hh:ii:ss'
        ]
    ]) ?>

    <?= $form->field($model, 'show_id')->dropDownList($shows); ?>

    <?= $form->field($model, 'area_id')->dropDownList($areas); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
