<?php

namespace backend\controllers;

use Yii;
use backend\models\Research;
use backend\models\ResearchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResearchController implements the CRUD actions for Research model.
 */
class ResearchController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Research models.
     * @return mixed
     */
    public function actionIndex($seminar_id)
    {
         return $this->renderIndex($seminar_id);
    }

    /**
     * Displays a single Research model.
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
     * Creates a new Research model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($seminar_id)
    {
        $model = Yii::createObject([
            'class'  => Research::className(),
            'seminar_id' => $seminar_id
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'seminar_id' => $model->seminar_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'seminar_id'=>$seminar_id
            ]);
        }
    }

    /**
     * Updates an existing Research model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'seminar_id' => $model->seminar_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Research model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $seminar_id = $model->seminar_id;
        $model->delete();

        return $this->redirect(['index','seminar_id'=>$seminar_id]);
    }

    /**
     * Finds the Research model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Research the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Research::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionCopy($seminar_id,$id){

        $copy = $this->findModel($id);
        $model = new Research;
        $model->attributes = $copy->attributes;
        $model->save();

        //$this->redirect(['index','seminar_id'=>$seminar_id]);
        $this->renderIndex($seminar_id);
        
    }

    public function renderIndex($seminar_id){

        $searchModel = new ResearchSearch();
        $searchModel->seminar_id = $seminar_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'seminar_id'=>$seminar_id
        ]);
    }
}
