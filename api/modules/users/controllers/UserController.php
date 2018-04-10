<?php
namespace api\modules\users\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\web\ForbiddenHttpException;

class UserController extends ActiveController {
	public $modelClass = 'api\models\User';

	public function behaviors() {
		$behaviors = parent::behaviors();

		$behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;

		$behaviors['tokenAuth'] = [
			'class' => \conquer\oauth2\TokenAuth::class,
		];

		return $behaviors;
	}

	/**
	 * Checks the privilege of the current user.
	 *
	 * This method should be overridden to check whether the current user has the privilege
	 * to run the specified action against the specified data model.
	 * If the user does not have access, a [[ForbiddenHttpException]] should be thrown.
	 *
	 * @param string $action the ID of the action to be executed
	 * @param object $model the model to be accessed. If null, it means no specific model is being accessed.
	 * @param array $params additional parameters
	 * @throws ForbiddenHttpException if the user does not have access
	 */
	public function checkAccess($action, $model = null, $params = array()) {
		if($action == 'index' && !Yii::$app->user->can('admin')) {
			throw new ForbiddenHttpException('Forbidden!');
		}
	}

}