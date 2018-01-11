<?php
namespace api\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

class ThreadController extends ActiveController {
	public $modelClass = 'api\models\Thread';

	public function behaviors() {
		$behaviors = parent::behaviors();

		$behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;

		$behaviors['tokenAuth'] = [
			'class' => \conquer\oauth2\TokenAuth::className(),
		];

		return $behaviors;
	}
}