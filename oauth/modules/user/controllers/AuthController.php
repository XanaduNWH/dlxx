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
//				'class' => \oauth\modules\myAuthorizeFilter::class,
				'class' => \conquer\oauth2\AuthorizeFilter::class,
				'only' => ['index'],
				'storeKey' => '11234455667slldjglerkjg',
			],
		];
	}
	public function actions()
	{
		$params = Yii::$app->params;
		return [
			// returns access token
			'token' => [
				'class' => \conquer\oauth2\TokenAction::class,
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
			if ($this->isOauthRequest) {
				$this->finishAuthorization();
			} else {
				return $this->goBack();
			}
		} else {
			return $this->render('@frontend/views/site/login', [
				'model' => $model,
			]);
		}
	}

	public function Authorize() {
		if($this->haveAuthorization()) {
			return $this->goBack();
		} else {
			return $this->render('authorization');
		}
	}

	/**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}