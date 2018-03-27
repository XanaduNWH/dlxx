<?php
namespace oauth\modules\user\controllers;

use Yii;
use common\models\LoginForm;
use yii\web\Controller;

class AuthController extends Controller
{
	public function behaviors()
	{
		return [
			/** 
			 * checks oauth2 credentions
			 * and performs OAuth2 authorization, if user is logged on
			 */
			'oauth2Auth' => [
				'class' => \conquer\oauth2\AuthorizeFilter::className(),
				'only' => ['index'],
			],
		];
	}
	public function actions()
	{
		$params = Yii::$app->params;
		return [
			// returns access token
			'token' => [
				'class' => \conquer\oauth2\TokenAction::classname(),
				'grantTypes' => [
					'authorization_code' => [
						'class' => 'conquer\oauth2\granttypes\Authorization',
						'accessTokenLifetime' => $params['accessTokenLifetime'],
					],
					'refresh_token' => 'conquer\oauth2\granttypes\RefreshToken',
				]
			],
		];
	}
	/**
	 * Display login form to authorize user
	 */
	public function actionIndex()
	{
		$model = new LoginForm();
		if ($model->load(\Yii::$app->request->post()) && $model->login()) {
			// $this->render('authorization');
			return $this->goBack();
		} else {
			// return $this->render('//site/login', [
			return $this->render('@frontend/views/site/login', [
				'model' => $model,
			]);
		}
	}
}