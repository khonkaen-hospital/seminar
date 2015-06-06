<?php

namespace backend\controllers;

use Yii;
use backend\models\Schedule;
use backend\models\Room;
use backend\models\ScheduleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ScheduleController implements the CRUD actions for Schedule model.
 */
class ScheduleController extends Controller
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
     * Lists all Schedule models.
     * @return mixed
     */
    public function actionIndex($seminar_id)
    {
        return $this->renderIndex($seminar_id);
    }

    /**
     * Displays a single Schedule model.
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
     * Creates a new Schedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new Schedule();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('create', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    public function actionCreate($seminar_id)
    {
        $model = Yii::createObject([
            'class'  => Schedule::className(),
            'status' => Schedule::STATUS_ACTIVE,
            'type'   => Schedule::TYPE_SCHEDULE,
            'seminar_id' => $seminar_id
        ]);

        if ($model->load(Yii::$app->request->post()) && ($success = $model->save())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'success'=> $success?true:false,
                'message' => $success?[]:$model->getErrors(),
                'data'=>(array)$model->getAttributes()
            ];
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Schedule model.
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
     * Deletes an existing Schedule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model       = $this->findModel($id);
        $seminar_id  = $model->seminar_id;
        $model->delete();

        return $this->redirect(['index','seminar_id'=>$seminar_id]);
    }

    /**
     * Finds the Schedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Schedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Schedule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPreview($seminar_id,$date=null){

        $this->layout ='main-login';
        $model= Schedule::find()->bySeminar($seminar_id)->byDate($date)->all();

        return $this->render('preview',[
            'model' => $model,
            'rooms' => Room::find()->all()
        ]);
    }

    public function actionCopy($seminar_id,$id){

        $copy = $this->findModel($id);
        $model = new Schedule;
        $model->attributes = $copy->attributes;
        $model->save();
        $this->renderIndex($seminar_id);
        
    }

    public function renderIndex($seminar_id){

        $searchModel = new ScheduleSearch();
        $searchModel->seminar_id = $seminar_id;
        $dataProvider = $searchModel->schedule()->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


}
