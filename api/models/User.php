<?php

namespace api\models;

class User extends \common\models\User
{
	public function init()
	{
		parent::init();
		\Yii::$app->user->enableSession = false;
	}

	public function fields() {
		return [
			'username',
			'email',
			'status',
			'created_at' => function($model) {
				return \Yii::$app->formatter->asTimestamp($model->created_at);
			},
			'updated_at'
		];
	}
}