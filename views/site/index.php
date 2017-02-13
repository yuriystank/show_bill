<?php
use yii\helpers\Html;

/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?= Yii::t('app', 'Список ближайших событий')?>
            <small><?= Yii::t('app', '(cегодня {date})', ['date' => date('Y-m-d')])?></small>
        </h1>
    </div>
</div>


<div class="row">
    <?php if (!empty($dataProvider->getModels())) : ?>
        <?php $i = 0?>
        <?php foreach ($dataProvider->getModels() as $model) : ?>
            <div class="col-md-4 portfolio-item">
                <?= Html::img(Yii::$app->params['uploadPath'].$model->show->image, ['class' => 'img-responsive'])?>
                <h3>
                    <?= $model->show->title?>
                    <br>
                    <small><?=$model->date?></small>
                </h3>
                <i><?= Html::a($model->area->title, ['area', 'id' => $model->area->id])?></i>
                <p><?=$model->show->description?></p>
            </div>
            <?php $i++?>
            <?php if ($i%3 == 0) : ?>
                </div><div class="row">
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <p><?=Yii::t('app', 'Событий пока нет...')?></p>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-md-12 text-center">
        <?php echo \yii\widgets\LinkPager::widget([
            'pagination'=>$dataProvider->pagination,
        ]);?>
    </div>
</div>