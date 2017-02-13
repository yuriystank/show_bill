<?php

namespace app\modules\admin\controllers;

use app\models\Area;
use app\models\Show;
use Yii;
use app\models\Event;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends DefaultController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];

        return array_merge(parent::behaviors(), $behaviors);
    }

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Event::find()->with(['show', 'area']),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Event();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $showQuery = Show::find()->all();
            $shows = ArrayHelper::merge(
                ['' => Yii::t('app', 'Выберите шоу')],
                empty($showQuery) ? [] : ArrayHelper::map($showQuery, 'id', 'title')
            );
            $areaQuery = Area::find()->asArray()->all();
            $areas = ArrayHelper::merge(
                ['' => Yii::t('app', 'Выберите площадку')],
                empty($areaQuery) ? [] : ArrayHelper::map($areaQuery, 'id', 'title')
            );

            return $this->render('create', [
                'model' => $model,
                'shows' => $shows,
                'areas' => $areas,
            ]);
        }
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $showQuery = Show::find()->all();
            $shows = ArrayHelper::merge(
                ['' => Yii::t('app', 'Выберите шоу')],
                empty($showQuery) ? [] : ArrayHelper::map($showQuery, 'id', 'title')
            );
            $areaQuery = Area::find()->asArray()->all();
            $areas = ArrayHelper::merge(
                ['' => Yii::t('app', 'Выберите площадку')],
                empty($areaQuery) ? [] : ArrayHelper::map($areaQuery, 'id', 'title')
            );

            return $this->render('create', [
                'model' => $model,
                'shows' => $shows,
                'areas' => $areas,
            ]);
        }
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
