<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Area;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AreaController implements the CRUD actions for Area model.
 */
class AreaController extends DefaultController
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
     * Lists all Area models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Area::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Area model.
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
     * Creates a new Area model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Area();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // image saving
            $image = UploadedFile::getInstance($model, 'upload_image');
            if (!empty($image)) {
                $ext = end(explode(".", $image->name));
                $model->image = Yii::$app->security->generateRandomString().".{$ext}";
                $path = Yii::$app->params['uploadPath'] . $model->image;
                $image->saveAs($path);
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $sort_count = range(1, Area::find()->count()+1);

            return $this->render('create', [
                'model' => $model,
                'sort_count' => array_combine($sort_count, $sort_count)
            ]);
        }
    }

    /**
     * Updates an existing Area model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // image saving
            $image = UploadedFile::getInstance($model, 'upload_image');
            if (!empty($image)) {
                $ext = end(explode(".", $image->name));
                $model->image = Yii::$app->security->generateRandomString().".{$ext}";
                $path = Yii::$app->params['uploadPath'] . $model->image;
                $image->saveAs($path);
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $sort_count = range(1, Area::find()->count());

            return $this->render('create', [
                'model' => $model,
                'sort_count' => array_combine($sort_count, $sort_count)
            ]);
        }
    }

    /**
     * Deletes an existing Area model.
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
     * Finds the Area model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Area the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Area::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
