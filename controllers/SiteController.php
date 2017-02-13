<?php

namespace app\controllers;

use app\models\Area;
use app\models\Event;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Event::find()->where(['>=', 'date', date('Y-m-d h:i:s')])
                ->orderBy(['date' => SORT_ASC])->with(['show', 'area']),
            'pagination' => array('pageSize' => 9),
        ]);

        return $this->render('index', compact('dataProvider'));
    }


    /**
     * Displays areas list.
     *
     * @return string
     */
    public function actionAreas()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Area::find()->orderBy(['sort' => SORT_ASC]),
            'pagination' => array('pageSize' => 12),
        ]);

        return $this->render('area/index', compact('dataProvider'));
    }

    /**
     * Displays areas list.
     *
     * @return string
     */
    public function actionArea($id)
    {
        $model = Area::findOne($id);

        if (!empty($model)) {

            $dataProvider = new ActiveDataProvider([
                'query' => Event::find()->where(['>=', 'date', date('Y-m-d h:i:s')])
                    ->andWhere(['area_id' => $model->id])->orderBy(['date' => SORT_ASC])->with(['show', 'area']),
                'pagination' => array('pageSize' => 9),
            ]);

            return $this->render('area/view', compact('model', 'dataProvider'));
        } else {
            throw new NotFoundHttpException('The requested area does not exist.');
        }
    }

}
