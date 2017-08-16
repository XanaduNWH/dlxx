<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class TestController extends Controller
{
	public function actionSay()
    {
		// $message = Yii::$app->security->generateRandomKey();
		$message = \Faker\Provider\Uuid::uuid();
        return $this->render('say', ['message' => $message]);
    }
}
