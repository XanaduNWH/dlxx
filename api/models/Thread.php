<?php

namespace api\models;

class Thread extends \frontend\modules\Thread\models\Thread
{
	public function init()
	{
		parent::init();
		\Yii::$app->user->enableSession = false;
	}
}