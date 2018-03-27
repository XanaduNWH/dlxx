<?php

namespace frontend\modules\Layui;

use Yii;
use frontend\assets\LayuiAsset;

/**
 * Layui module definition class
 */
class Module extends \yii\base\Module
{
	/**
	 * @inheritdoc
	 */
	public $controllerNamespace = 'frontend\modules\Layui\controllers';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		$this->layout = 'main';
		LayuiAsset::register(Yii::$app->view);

		// custom initialization code goes here
	}
}
