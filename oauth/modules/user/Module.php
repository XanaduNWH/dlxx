<?php

namespace oauth\modules\user;

/**
 * Thred module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'oauth\modules\user\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
		// \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
