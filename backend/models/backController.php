<?php
namespace backend\models;

use yii\web\Controller;
use yii\filters\AccessControl;

class backController extends Controller {
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
		];
	}
}