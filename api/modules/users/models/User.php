<?php

namespace api\modules\models;

class User extends \common\models\User
{
	public function init()
	{
		parent::init();
		\Yii::$app->user->enableSession = false;
	}
}