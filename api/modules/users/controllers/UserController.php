<?php
namespace api\modules\users\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

class UserController extends ActiveController {
	public $modelClass = 'api\models\User';

	public function behaviors() {
		$behaviors = parent::behaviors();

		$behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;

		$behaviors['tokenAuth'] = [
			'class' => \conquer\oauth2\TokenAuth::className(),
		];

		return $behaviors;
	}
}