<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use yii\filters\AccessControl;

use app\models\User;
use app\models\Message;

class MessageController extends \yii\web\Controller
{
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
        ];
    }

    public function actionIndex()
    {
		if (Yii::$app->user->identity->role == User::ROLE_ADMIN) {
			
		}
		elseif (Yii::$app->user->identity->role == User::ROLE_USER) {
		}

        return $this->render('index');
    }

}
