<?php

namespace api\models;

class Country extends \frontend\models\Country
{
	public function init()
	{
		parent::init();
		\Yii::$app->user->enableSession = false;
	}
}
