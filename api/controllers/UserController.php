<?php
namespace api\controllers;

use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class UserController extends ActiveController
{
    public $modelClass = 'api\models\User';

	public function behaviors()
	{
		return ArrayHelper::merge(parent::behaviors(), [
			[
				'class' => 'yii\filters\ContentNegotiator',

				'formats' => [
					'application/json' => Response::FORMAT_JSON,
				],
			],
		]);
	}
}