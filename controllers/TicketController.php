<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

use app\models\Ticket;
use app\models\TicketSearch;
use app\models\User;
use app\models\Message;

/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller
{
    public function init() {
        parent::init();
       
        if (Yii::$app->user->identity->role != User::ROLE_ADMIN) {
      //      throw new ForbiddenHttpException('The requested page does not permitted');
        }
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TicketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReply($ticket_id)
    {
         
        if (($ticket_model = Ticket::findOne($ticket_id)) !== null) {
            if (Yii::$app->user->identity->role != User::ROLE_ADMIN || 
                Yii::$app->user->id != $ticket_model->user_id) {
                throw new ForbiddenHttpException('The requested page does not permitted');
            }
            $message_model = new Message();
            if ($ticket_model->load(Yii::$app->request->post()) &&  // get status
                $ticket_model->save()
            ) {
                $message_model->load(Yii::$app->request->post()); // get Text
                $message_model->user_id = $ticket_model->user->id;
                $message_model->ticket_id = $ticket_model->id;
                $message_model->created_date = time();
                $message_model->save();
                return $this->redirect(['view', 'id' => $ticket_model->id]);
            } else {
               
            }

            return $this->render('reply', [
                'ticket_model' => $ticket_model,
                'message_model'=> $message_model
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionSubmit()
    {
        
    }
    /**
     * Displays a single Ticket model.
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
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ticket();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ticket model.
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
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ticket model.
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
     * Finds the Ticket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ticket::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
