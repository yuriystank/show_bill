<?php
use yii\helpers\Html;

/* @var $model app\models\Area */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="row">
    <div class="col-md-9">
        <?= Html::img('/'.Yii::$app->params['uploadPath'].$model->image, ['class' => 'img-responsive'])?>
    </div>
    <div class="col-md-3">
        <h1 class="page-header">
            <?= $model->title?>
        </h1>
        <p><?= $model->description?></p>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            <?= Yii::t('app', '{area}, события', ['area' => $model->title])?>
            <small><?= Yii::t('app', '(cегодня {date})', ['date' => date('Y-m-d')])?></small>
        </h3>
    </div>
</div>

<div class="row">
    <?php if (!empty($dataProvider->getModels())) : ?>
        <?php $i = 0?>
        <?php foreach ($dataProvider->getModels() as $event) : ?>
            <div class="col-md-4 portfolio-item">
                <?= Html::img('/'.Yii::$app->params['uploadPath'].$event->show->image, ['class' => 'img-responsive'])?>
                <h3>
                    <?= $event->show->title?>
                    <br>
                    <small><?=$event->date?></small>
                </h3>
                <i><?=$model->title?></i>
                <p><?=$event->show->description?></p>
            </div>
            <?php $i++?>
            <?php if ($i%3 == 0) : ?>
                </div><div class="row">
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <p><?= Yii::t('app', 'Сообытий пока нет...')?></p>
    <?php endif; ?>

</div>

<div class="row">
    <div class="col-md-12 text-center">
        <?php echo \yii\widgets\LinkPager::widget([
            'pagination'=>$dataProvider->pagination,
        ]);?>
    </div>
</div>