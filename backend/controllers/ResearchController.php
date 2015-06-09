<?php

namespace backend\controllers;

use Yii;
use backend\models\Room;
use backend\models\Research;
use backend\models\ResearchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;

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

    public function actionRoomMonitor($seminar_id){
        $searchModel = new ResearchSearch();
        $searchModel->seminar_id = $seminar_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('room_monitor', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'seminar_id'=>$seminar_id
        ]);
       
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
     * Updates an existing Research model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionMonitorUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['room-monitor                                                                           ', 'seminar_id' => $model->seminar_id]);
        } else {
            return $this->render('monitor-update', [
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

    public function actionStart($id){

        Yii::$app->response->format = 'json';
        $response = ['success'=>false];

        if(Yii::$app->request->getIsAjax()){
              $model = $this->findModel($id);
              $status = Yii::$app->request->post('dataCheck');
              $model->real_start = $status==0?NULL:date('Y-m-d H:i:s');
              $model->save();
              $response = ['success'=> $model->getErrors()];
        }
        return $response;

    }
    public function actionStop($id){

        Yii::$app->response->format = 'json';
        $response = ['success'=>false];

        if(Yii::$app->request->getIsAjax()){
              $model = $this->findModel($id);
              $status = Yii::$app->request->post('dataCheck');
              $model->real_end = $status==0?NULL:date('Y-m-d H:i:s');
              $model->save();
              $response = ['success'=>true];
        }
        return $response;
    }

    public function actionPreview($seminar_id,$date=null){

        $this->layout ='main-login';
        $model= Research::find()->bySeminar($seminar_id)->all();

        $searchModel = new ResearchSearch();
        $searchModel->seminar_id = $seminar_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('preview',[
            'searchModel' => $searchModel,
            'dataProvider' => $this->getResearch(),
            'seminar_id'=>$seminar_id,
            'model' => $model,
            'rooms' => Room::find()->all()
        ]);
    }


    public function getResearch(){

      $sql = "SELECT
                room.room_name,
                r.*
            FROM
                lib_room room
            right JOIN (
                SELECT
                    *
                FROM
                    research
                where !ISNULL(real_start) and ISNULL(real_end)
            ) r ON r.room_id = room.id

            group by r.room_id
            ORDER BY room.room_name asc,r.start_date asc";

        // $count = Yii::$app->db->createCommand('
        //     SELECT COUNT(*) FROM user WHERE status=:status
        // ', [':status' => 1])->queryScalar();

        return  new SqlDataProvider([
            'sql' => $sql,
        ]);
    }
}
