<?php
namespace api\controllers;

use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

class CountryController extends ActiveController
{
    public $modelClass = 'api\models\Country';

	public function behaviors()
	{
		$behaviors = parent::behaviors();

		$behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
		// remove authentication filter
		// $auth = $behaviors['authenticator'];
		// unset($behaviors['authenticator']);

		// add CORS filter
		$behaviors['corsFilter'] = [
			'class' => \yii\filters\Cors::className(),
		];

		// re-add authentication filter
		$behaviors['authenticator'] = [
		// 	'class' => HttpBasicAuth::className(),

			'class' => CompositeAuth::className(),
			'authMethods' => [
				HttpBasicAuth::className(),
				HttpBearerAuth::className(),
				QueryParamAuth::className(),
			],
		];
		// avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
		$behaviors['authenticator']['except'] = ['options'];

		return $behaviors;
	}
}
